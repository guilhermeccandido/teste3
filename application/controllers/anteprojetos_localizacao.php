<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class anteprojetos_localizacao extends App_controller {

	const VIEW_FOLDER = 'admin/anteprojetos_localizacao';
    
    public function __construct()
	{
		parent::__construct();
        $this->load->model('anteprojetos_localizacaodao');

       
    }
    	
    public function index()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 30;

        $config['base_url'] = base_url().'admin/anteprojetos_localizacao';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<nav class="navbar navbar-default navbar-fixed-bottom"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav.';
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';

        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        
        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->anteprojetos_localizacaodao->count_anteprojetos_localizacao($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['anteprojetos_localizacao'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos_localizacao'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['anteprojetos_localizacao'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos_localizacao'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['anteprojetos_localizacao_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->anteprojetos_localizacaodao->count_anteprojetos_localizacao();
            $data['anteprojetos_localizacao'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/anteprojetos_localizacao/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
    public function lista_localizacao(){
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	//product id
    	$id = $this->uri->segment(4);
    	
    	$data['id_anteprojeto'] = $id;
    	 
    	$data['anteprojetos_localizacao'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao_by_id_anteprojeto($id);
    	 
    	$i = 0;
    	$this->load->model('lista_acompanhamento_fisicodao');
    	$list_acompanhamento = new lista_acompanhamento_fisicodao();
    	 
    	foreach($data['anteprojetos_localizacao'] as $item){
    
    		$arrayTipo = $list_acompanhamento->get_lista_acompanhamento_fisico_tipo_by_id_anteprojetos_acompanhamento_fisico($item['id']);
    
    		$data['acompanhamento_fisico'][$i]['list'] = $arrayTipo;
    		$i++;
    	}
    	//$this->PAR($data['acompanhamento_fisico']);
    	 
    	$data['localizacao_not_defined'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao_not_defined_by_id_anteprojeto($id);
    	 
    	//load the view
    	$data['main_content'] = 'admin/anteprojetos_localizacao/list';
    	$this->load->view('includes/template', $data);
    }
    
    
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$id_anteprojeto = $this->uri->segment(4);
    	$data['id_anteprojeto'] = $id_anteprojeto;
    	
    	$id_localizacao = $this->uri->segment(5);
    	
    	if($id_localizacao){
    		$data['id_localizacao']  = $id_localizacao;
    	}
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('id_anteprojeto', 'id_anteprojeto', 'required'); 
        	$this->form_validation->set_rules('id_localizacao', 'id_localizacao', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_anteprojeto' => $this->input->post('id_anteprojeto'),
                		'id_localizacao' => $this->input->post('id_localizacao'),
                );
                
                
                $this->load->model('localizacaodao');
                $localizacao = new localizacaodao();
                $localizacaoData = $localizacao->get_localizacao_by_id($id_localizacao);
                
                $fileName = $_FILES["file"]["name"];
                $target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
                 
                $uploadOk = 1;
                $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                
                if ($uploadOk == 0 or $fileName == '') {
                	$data['flash_message'] = FALSE;
                }
                else {
                	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                
                		$file_out = ANTEPROJETOS_FOLDER . $id_anteprojeto.'/localizacao';
                
                		if( !file_exists($file_out)){
                			mkdir($file_out, 0777, true);
                		}
                
                		if(file_exists($file_out.'/' .$id_anteprojeto.'.kmz')){
                			unlink($file_out.'/' .$id_anteprojeto.'.kmz');
                		}
                
                		copy ( $target_file , $file_out.'/' .$id_anteprojeto.'.kmz');
                		unlink($target_file);
                
                		//if the insert has returned true then we show the flash message
                		if($this->anteprojetos_localizacaodao->store_anteprojetos_localizacao($data_to_store)){
                			$data['flash_message'] = TRUE;
                		}else{
                			$data['flash_message'] = FALSE;
                		}
                		 
                	} else {
                		$data['flash_message'] = FALSE;
                	}
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/anteprojetos_localizacao/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
        	$this->form_validation->set_rules('id_anteprojeto', 'id_anteprojeto', 'required');
        	$this->form_validation->set_rules('id_localizacao', 'id_localizacao', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
        	if ($this->form_validation->run())
            {
    
            	$id_anteprojeto = $this->input->post('id_anteprojeto');
            	$id_localizacao = $this->input->post('id_localizacao');
            	
            	$this->load->model('localizacaodao');
            	$localizacao = new localizacaodao();
            	$localizacaoData = $localizacao->get_localizacao_by_id($id_localizacao);
            	
            	$fileName = $_FILES["file"]["name"];
            	$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
            	 
            	$uploadOk = 1;
            	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

            	// Check if $uploadOk is set to 0 by an error
            	
            	if ($uploadOk == 0 or $fileName == '') {
            		$this->session->set_flashdata('flash_message', 'not_updated');
            		
            	}else {
            		
                	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {                
                		$file_out = ANTEPROJETOS_FOLDER . $id_anteprojeto.'/localizacao';                		
                		copy ( $target_file , $file_out.'/' .$id_anteprojeto.'.kmz');
                		unlink($target_file);
                		
                		$this->session->set_flashdata('flash_message', 'updated');
                		                		 
                	} else {
                		$this->session->set_flashdata('flash_message', 'not_updated');
                	}
                }
            	
                redirect('admin/anteprojetos_localizacao/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['anteprojetos_localizacao'] = $this->anteprojetos_localizacaodao->get_anteprojetos_localizacao_by_id($id);
        //load the view
        $data['main_content'] = 'admin/anteprojetos_localizacao/edit';
        $this->load->view('includes/template', $data);            

    }//update    			
    	
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        //product id 
        $id = $this->uri->segment(4);
        $id_anteprojeto = $this->uri->segment(5);
        $this->anteprojetos_localizacaodao->delete_anteprojetos_localizacao($id);
        redirect('admin/anteprojetos_localizacao/lista_localizacao/'.$id_anteprojeto);
    }//edit    			
    	
}



