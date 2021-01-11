<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class documentos_repositorio extends App_controller {
const VIEW_FOLDER = 'admin/documentos_repositorio';

    		public function __construct()
		    {
		        parent::__construct();
		        $this->load->model('documentos_repositoriodao');
		
		        if(!$this->session->userdata('logged_in')){
		            redirect('admin/login');
		        }
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

        $config['base_url'] = base_url().'admin/documentos_repositorio';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<nav class="navbar navbar-default navbar-fixed-bottom"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['next_tag_open'] = '<li>';
		$config['next_tagl_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tagl_close'] = '</li>';

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
        	}else if($search_string == '' AND $page == null){	
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
            $data['count_products']= $this->documentos_repositoriodao->count_documentos_repositorio($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['documentos_repositorio'] = $this->documentos_repositoriodao->get_documentos_repositorio($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['documentos_repositorio'] = $this->documentos_repositoriodao->get_documentos_repositorio($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['documentos_repositorio'] = $this->documentos_repositoriodao->get_documentos_repositorio('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['documentos_repositorio'] = $this->documentos_repositoriodao->get_documentos_repositorio('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['documentos_repositorio_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->documentos_repositoriodao->count_documentos_repositorio();
            $data['documentos_repositorio'] = $this->documentos_repositoriodao->get_documentos_repositorio('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        $data = array_merge($data, $this->foreingControllers());
        
        //load the view
        $data['main_content'] = 'admin/documentos_repositorio/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
	        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
	        	$this->form_validation->set_rules('tipo_documento', 'tipo_documento', 'required'); 
	        	$this->form_validation->set_rules('n_documento', 'n_documento', ''); 
	        	$this->form_validation->set_rules('data', 'data', 'required'); 
	        	$this->form_validation->set_rules('uf', 'uf', ''); 
	        	$this->form_validation->set_rules('rodovia', 'rodovia', ''); 
	        	$this->form_validation->set_rules('atividade', 'atividade', 'required'); 
	        	$this->form_validation->set_rules('palavra_chave', 'palavra_chave', ''); 
	        	$this->form_validation->set_rules('origem', 'origem', 'required'); 
	        	$this->form_validation->set_rules('destino', 'destino', 'required'); 
	        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
            	//FILE
            	$fileName = $_FILES["file"]["name"];
            	$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
            	
            	$uploadOk = 1;
            	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            	 
            	
            	// palavras chave
            	$arraySelected = $this->input->post('palavra_chave') ;
            	$data['wk_selected'] = $arraySelected;
            	$first = true;
            	$palavra_chave = '';
            	foreach($arraySelected as $item){
            		if($first){
            			$palavra_chave .= '/'.$item.'/';
            			$first = false;
            		}else{
            			$palavra_chave .= $item.'/';
            		}
            	}
            	
            	if($uploadOk == 0 or $fileName == ''){
            		
            		$data['flash_message'] = FALSE;
            		
            	}else{
            		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            		
            			$nome = $this->createRandWord(30).'.'.$fileType;
            			$data_to_store = array('nome' => $nome);
            		
            			if(!file_exists(REPOSITORIO_DOC_FOLDER )){
            				mkdir(REPOSITORIO_DOC_FOLDER , 0777, true);
            			}
            		
            			copy ( $target_file , REPOSITORIO_DOC_FOLDER .$nome);
            			unlink($target_file);
            			
            			$data_to_store = array(
            					'titulo' => $this->input->post('titulo'),
            					'tipo_documento' => $this->input->post('tipo_documento'),
            					'n_documento' => $this->input->post('n_documento'),
            					'data' => $this->input->post('data'),
            					'uf' => $this->input->post('uf'),
            					'rodovia' => $this->input->post('rodovia'),
            					'atividade' => $this->input->post('atividade'),
            					'palavra_chave' => $palavra_chave,
            					'origem' => $this->input->post('origem'),
            					'destino' => $this->input->post('destino'),
            					'file' => $nome,
            					'observacoes' => $this->input->post('observacoes')
            			);
            			//if the insert has returned true then we show the flash message
            			if($this->documentos_repositoriodao->store_documentos_repositorio($data_to_store)){
            				$data['flash_message'] = TRUE;
            			}else{
            				$data['flash_message'] = FALSE;
            			}
            		}
            	}
            		
            }

        }
        
        $data = array_merge($data, $this->foreingControllers());
        //load the view
        $data['main_content'] = 'admin/documentos_repositorio/add';
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
        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
        	$this->form_validation->set_rules('tipo_documento', 'tipo_documento', 'required'); 
        	$this->form_validation->set_rules('n_documento', 'n_documento', ''); 
        	$this->form_validation->set_rules('data', 'data', 'required'); 
        	$this->form_validation->set_rules('uf', 'uf', ''); 
        	$this->form_validation->set_rules('rodovia', 'rodovia', ''); 
        	$this->form_validation->set_rules('atividade', 'atividade', 'required'); 
        	$this->form_validation->set_rules('palavra_chave', 'palavra_chave', ''); 
        	$this->form_validation->set_rules('origem', 'origem', 'required'); 
        	$this->form_validation->set_rules('destino', 'destino', 'required'); 
        	$this->form_validation->set_rules('file', 'file', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
            	
            	// FILE
            	$fileName = $_FILES["file"]["name"];
            	$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
            	
            	$uploadOk = 1;
            	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            	
            	// PALAVRAS CHAVA
            	$arraySelected = $this->input->post('palavra_chave') ;
            	$data['wk_selected'] = $arraySelected;
            	$first = true;
            	$palavra_chave = '';
            	foreach($arraySelected as $item){
            		if($first){
            			$palavra_chave .= '/'.$item.'/';
            			$first = false;
            		}else{
            			$palavra_chave .= $item.'/';
            		}
            	}
            	
            	
            	if ($uploadOk == 0 or $fileName == '') {
            		//
            		$data_to_store = array(
			        	'titulo' => $this->input->post('titulo'),
			        	'tipo_documento' => $this->input->post('tipo_documento'),
			        	'n_documento' => $this->input->post('n_documento'),
			        	'data' => $this->input->post('data'),
			        	'uf' => $this->input->post('uf'),
			        	'rodovia' => $this->input->post('rodovia'),
			        	'atividade' => $this->input->post('atividade'),
			        	'palavra_chave' => $palavra_chave,
			        	'origem' => $this->input->post('origem'),
			        	'destino' => $this->input->post('destino'),
			        	'observacoes' => $this->input->post('observacoes'),                    
	                );
            		            		
            	}else {
            		
            		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            			 
            			$nome = $this->createRandWord(30).'.'.$fileType;
            			 
            			if(!file_exists(REPOSITORIO_DOC_FOLDER )){
            				mkdir(REPOSITORIO_DOC_FOLDER , 0777, true);
            			}
            			$arrTemp = $this->documentos_repositoriodao->get_documentos_repositorio_by_id($id);
            			copy ( $target_file , REPOSITORIO_DOC_FOLDER .$nome);
            			unlink($target_file);
            			 
            			$data_to_store = array(
				        	'titulo' => $this->input->post('titulo'),
				        	'tipo_documento' => $this->input->post('tipo_documento'),
				        	'n_documento' => $this->input->post('n_documento'),
				        	'data' => $this->input->post('data'),
				        	'uf' => $this->input->post('uf'),
				        	'rodovia' => $this->input->post('rodovia'),
				        	'atividade' => $this->input->post('atividade'),
				        	'palavra_chave' => $palavra_chave,
				        	'origem' => $this->input->post('origem'),
				        	'destino' => $this->input->post('destino'),
            				'file' => $nome,
				        	'observacoes' => $this->input->post('observacoes'),                    
		                );
            		
            		} else {
            			$this->session->set_flashdata('flash_message', 'not_updated');
            		}
            		
            	}
            	
                
                //if the insert has returned true then we show the flash message
                if($this->documentos_repositoriodao->update_documentos_repositorio($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                    // unlink the old file
                    if(isset($nome)){
                    	unlink(REPOSITORIO_DOC_FOLDER . $arrTemp[0]['file']);
                    }
                    
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/documentos_repositorio/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        $data = array_merge($data, $this->foreingControllers());
        //product data 
        $data['documentos_repositorio'] = $this->documentos_repositoriodao->get_documentos_repositorio_by_id($id);
        //$this->PAR($data['documentos_repositorio']);
        //die;
        //load the view
        $data['main_content'] = 'admin/documentos_repositorio/edit';
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
    			
        $id = $this->uri->segment(4);
        $this->documentos_repositoriodao->delete_documentos_repositorio($id);
        redirect('admin/documentos_repositorio');
    }//edit    			

    public function foreingControllers(){
    	
    	$this->load->model('documentos_tiposdao');
    	$tipos_doc = new documentos_tiposdao();
    	$data['tipo_documento'] = $tipos_doc->get_documentos_tipos(null, 'titulo');
    	
    	$this->load->model('documentos_atividadesdao');
    	$atividade_doc = new documentos_atividadesdao();
    	$data['atividade'] = $atividade_doc->get_documentos_atividades(null, 'titulo');
    	
    	$this->load->model('documentos_oddao');
    	$od_doc = new documentos_oddao();
    	$data['od_doc'] = $od_doc->get_documentos_od(null, 'titulo');
    	
    	$this->load->model('documentos_palavra_chavedao');
    	$kw_doc = new documentos_palavra_chavedao();
    	$data['palavra_chave'] = $kw_doc->get_documentos_palavra_chave(null, 'titulo');
    	
    	$this->load->model('estadosdao');
    	$data['estados'] = $this->estadosdao->get_estados(null, 'uf');
    	
    	return $data;
    }

}