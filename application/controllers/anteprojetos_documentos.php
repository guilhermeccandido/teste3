<?php

require_once(APPPATH . 'controllers/App_controller' . EXT);

class anteprojetos_documentos extends App_controller {

	const VIEW_FOLDER = 'admin/anteprojetos_documentos';
	public function __construct()
    {
        parent::__construct();
        $this->load->model('anteprojetos_documentosdao');

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

        $config['base_url'] = base_url().'admin/anteprojetos_documentos';
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
            $data['count_products']= $this->anteprojetos_documentosdao->count_anteprojetos_documentos($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['anteprojetos_documentos'] = $this->anteprojetos_documentosdao->get_anteprojetos_documentos($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos_documentos'] = $this->anteprojetos_documentosdao->get_anteprojetos_documentos($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['anteprojetos_documentos'] = $this->anteprojetos_documentosdao->get_anteprojetos_documentos('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos_documentos'] = $this->anteprojetos_documentosdao->get_anteprojetos_documentos('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['anteprojetos_documentos_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->anteprojetos_documentosdao->count_anteprojetos_documentos();
            $data['anteprojetos_documentos'] = $this->anteprojetos_documentosdao->get_anteprojetos_documentos('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/anteprojetos_documentos/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
    public function lista_documento()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	//product id
    	$id = $this->uri->segment(4);
    	$data['id_anteprojeto'] = $id;
    
    	$data['documentos'] = $this->anteprojetos_documentosdao->get_anteprojetos_documentos_by_id_anteprojetos($id);
    
    	//load the view
    	$data['main_content'] = 'admin/anteprojetos_documentos/list_anteprojetos_documentos';
    	$this->load->view('includes/template', $data);
    
    }
    
    
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_anteprojeto = $this->uri->segment(4);
    	$data['id_anteprojeto'] = $id_anteprojeto;
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('id_anteprojeto', 'id_anteprojeto', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('tipo', 'tipo', 'required');
        	$this->form_validation->set_rules('observacao', 'observacao', '');  
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
                $data_to_store = array('id_anteprojeto' => $this->input->post('id_anteprojeto'),
                		'titulo' => $this->input->post('titulo'),
                		'tipo' => $this->input->post('tipo'),
                		'observacao' => $this->input->post('observacao')
                );
                
                //if the insert has returned true then we show the flash message
                $id_anteprojeto_documento = $this->anteprojetos_documentosdao->store_anteprojetos_documentos($data_to_store);
                
                
                $fileName = $_FILES["file"]["name"];
                $target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
                 
                $uploadOk = 1;
                $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                 
                // Check if file already exists
                /*
                 if (file_exists($target_file)) {
                echo "Desculpe, já existe um arquivo com esse nome.";
                $uploadOk = 0;
                }
                */
                // Check if $uploadOk is set to 0 by an error
                
                if ($uploadOk == 0 or $fileName == '') {
                	$data['flash_message'] = FALSE;
                } 
                else {
                	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                		
						$nome = $id_anteprojeto.'_'.$this->createRandWord(20).'.'.$fileType;                	
                		$data_to_store = array('nome' => $nome);
                		copy ( $target_file , ANTEPROJETOS_FOLDER . $id_anteprojeto.'/documentos/' .$nome);
                		unlink($target_file);
                		
                		//if the insert has returned true then we show the flash message
                		if($this->anteprojetos_documentosdao->update_anteprojetos_documentos($id_anteprojeto_documento, $data_to_store) == TRUE and $id_anteprojeto_documento <> null){
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
        $data['main_content'] = 'admin/anteprojetos_documentos/add';
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
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('tipo', 'tipo', 'required');
        	$this->form_validation->set_rules('nome', 'nome', '');
        	$this->form_validation->set_rules('observacao', 'observacao', '');  
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
                $data_to_store = array(
			        	'id_anteprojeto' => $this->input->post('id_anteprojeto'),
			        	'titulo' => $this->input->post('titulo'),
                		'tipo' => $this->input->post('tipo'),
                		'observacao' => $this->input->post('observacao')                  
                );
                
                $id_anteprojeto = $this->input->post('id_anteprojeto');
                
                $fileName = $_FILES["file"]["name"];
                if($fileName == ''){
                	
                	//if the insert has returned true then we show the flash message
                	if($this->anteprojetos_documentosdao->update_anteprojetos_documentos($id, $data_to_store) == TRUE){
                		$this->session->set_flashdata('flash_message', 'updated');
                	}else{
                		$this->session->set_flashdata('flash_message', 'not_updated');
                	}
                	
                }else{
                	
                	$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
                	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                	
                	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                		
                		$nome =  $this->input->post('nome');
                		if( strlen($nome) > 0 ){
                			unlink(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/documentos/' .$nome);
                		}
                		
                		$nome = $id_anteprojeto.'_'.$this->createRandWord(20).'.'.$fileType;
                		
                		if(!file_exists(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/documentos')){
                			mkdir(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/documentos', 0777, true);
                		}
                		
                		copy ( $target_file , ANTEPROJETOS_FOLDER . $id_anteprojeto.'/documentos/' .$nome);
                		unlink($target_file);
                	
                		$data_to_store['nome'] = $nome;
                		
                		//if the insert has returned true then we show the flash message
                		if($this->anteprojetos_documentosdao->update_anteprojetos_documentos($id, $data_to_store) == TRUE ){
                			$this->session->set_flashdata('flash_message', 'updated');
                		}else{
                			$this->session->set_flashdata('flash_message', 'not_updated');
                		}
                		 
                	} else {
                		$this->session->set_flashdata('flash_message', 'not_updated');
                	}
                }
                
                redirect('admin/anteprojetos_documentos/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['anteprojetos_documentos'] = $this->anteprojetos_documentosdao->get_anteprojetos_documentos_by_id($id);
        //load the view
        $data['main_content'] = 'admin/anteprojetos_documentos/edit';
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
        $this->anteprojetos_documentosdao->delete_anteprojetos_documentos($id);
        redirect('admin/anteprojetos_documentos/lista_documento/'.$id_anteprojeto);
    }//edit    			
    	
}