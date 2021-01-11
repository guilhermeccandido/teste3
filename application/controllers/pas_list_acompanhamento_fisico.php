<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class pas_list_acompanhamento_fisico extends App_controller {

	const VIEW_FOLDER = 'admin/pas_list_acompanhamento_fisico';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_list_acompanhamento_fisicodao');
        Echo 'AINDA UTILIZADA, DESABILITAR';
        DIE;
               
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

        $config['base_url'] = base_url().'admin/pas_list_acompanhamento_fisico';
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
            $data['count_products']= $this->pas_list_acompanhamento_fisicodao->count_pas_list_acompanhamento_fisico($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['pas_list_acompanhamento_fisico'] = $this->pas_list_acompanhamento_fisicodao->get_pas_list_acompanhamento_fisico($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['pas_list_acompanhamento_fisico'] = $this->pas_list_acompanhamento_fisicodao->get_pas_list_acompanhamento_fisico($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['pas_list_acompanhamento_fisico'] = $this->pas_list_acompanhamento_fisicodao->get_pas_list_acompanhamento_fisico('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['pas_list_acompanhamento_fisico'] = $this->pas_list_acompanhamento_fisicodao->get_pas_list_acompanhamento_fisico('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['pas_list_acompanhamento_fisico_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->pas_list_acompanhamento_fisicodao->count_pas_list_acompanhamento_fisico();
            $data['pas_list_acompanhamento_fisico'] = $this->pas_list_acompanhamento_fisicodao->get_pas_list_acompanhamento_fisico('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/pas_list_acompanhamento_fisico/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_pas = $this->uri->segment(4);
    	$id_acompanhamento_fisico = $this->uri->segment(5);
    	
    	$data['id_pas'] = $id_pas;
    	$data['id_acompanhamento_fisico'] = $id_acompanhamento_fisico;
    	
    	$this->load->model('pas_acompanhamento_fisicodao');
    	$acompanhamento = new pas_acompanhamento_fisicodao();
    	
    	$resultTitulo = $acompanhamento->get_titulo_by_id_acompanhamento_fisico($id_acompanhamento_fisico);
    	$titulo = $resultTitulo[0]['titulo'];
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('id_pas_acompanhamento_fisico', 'id_pas_acompanhamento_fisico', 'required'); 
        	$this->form_validation->set_rules('tipo', 'tipo', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            
            //$this->PAR($_FILES);
           // DIE;
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $total = count($_FILES['files']['name']); 
                
                
                $i = 0;
                for($i = 0; $i < $total; $i++){
					//echo $item['name']; 
                	
                	
                	$fileName = $_FILES["files"]["name"][$i];
	                $target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
	                 
	                $uploadOk = 1;
	                $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                	
                	// Check if $uploadOk is set to 0 by an error
                	
                	if ($uploadOk == 0 or $fileName == '') {
                		$data['flash_message'] = FALSE;
                	}
                	else if( $fileType == 'jpg' or $fileType == 'jpeg' or $fileType == 'JPEG' or $fileType == 'JPG'){
                		
                	}
                	else {
                		if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $target_file)) {
                	
                			$file_out = PAS_FOLDER . $id_pas.'/acompanhamento_fisico/'.$titulo;
                	
                			if( !file_exists($file_out)){
                				mkdir($file_out, 0777, true);
                			}
                	
                			if(file_exists($file_out.'/' .$id_pas.'.'.$fileType)){
                				unlink($file_out.'/' .$id_pas.'.'.$fileType);
                			}
                	
                			copy ( $target_file , $file_out.'/' .$id_pas.'.'.$fileType);
                			unlink($target_file);
                			
                			
                			$data_to_store = array(	'id_pas_acompanhamento_fisico' => $id_acompanhamento_fisico,
                									'tipo' => $fileType);
                			
							if($this->pas_list_acompanhamento_fisicodao->count_pas_list_acompanhamento_fisico_by_id_tipo($id_acompanhamento_fisico,$fileType ) > 0){
								$data['flash_message'] = TRUE;
							}else{
								//if the insert has returned true then we show the flash message
								if($this->pas_list_acompanhamento_fisicodao->store_pas_list_acompanhamento_fisico($data_to_store)){
									$data['flash_message'] = TRUE;
								}else{
									$data['flash_message'] = FALSE;
								}	
							}	
                			
                			 
                		} else {
                			$data['flash_message'] = FALSE;
                		}
                	}
                	
                }

            }

        }
        
        //load the view
        $data['main_content'] = 'admin/pas_list_acompanhamento_fisico/add';
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
        	$this->form_validation->set_rules('id_pas_acompanhamento_fisico', 'id_pas_acompanhamento_fisico', 'required');
        	$this->form_validation->set_rules('tipo', 'tipo', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'id_pas_acompanhamento_fisico' => $this->input->post('id_pas_acompanhamento_fisico'),
        	'tipo' => $this->input->post('tipo'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_list_acompanhamento_fisicodao->update_pas_list_acompanhamento_fisico($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas_list_acompanhamento_fisico/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['pas_list_acompanhamento_fisico'] = $this->pas_list_acompanhamento_fisicodao->get_pas_list_acompanhamento_fisico_by_id($id);
        //load the view
        $data['main_content'] = 'admin/pas_list_acompanhamento_fisico/edit';
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
        $this->pas_list_acompanhamento_fisicodao->delete_pas_list_acompanhamento_fisico($id);
        
        $this->load->model('pas_list_acompanhamento_fisicodao');
        
        redirect('admin/pas_list_acompanhamento_fisico');
    }//edit    	

    /**
     * Delete product by his id pas_acomp_fisico
     * @return void
     */
    public function delete_by_pas_acomp_fisico($id = null)
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	if($id == null ){
    		$id = $this->uri->segment(4);
    	}
    	
    	$result = $this->pas_list_acompanhamento_fisicodao->delete_pas_list_acompanhamento_fisico_by_id_pas_acompanhamento_fisico($id);
    
    	return $result;
    }
    
    	
}