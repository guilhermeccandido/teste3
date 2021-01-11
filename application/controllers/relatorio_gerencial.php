<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class relatorio_gerencial extends App_controller {
const VIEW_FOLDER = 'admin/relatorio_gerencial';

	public function __construct()
    {
        parent::__construct();
        $this->load->model('relatorio_gerencialdao');

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
        $config['per_page'] = 100;

        $config['base_url'] = base_url().'admin/relatorio_gerencial';
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
            $data['count_products']= $this->relatorio_gerencialdao->count_relatorio_gerencial($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['relatorio_gerencial_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->relatorio_gerencialdao->count_relatorio_gerencial();
            $data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial('', 'data_ini', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/relatorio_gerencial/list';
        $this->load->view('includes/template', $data);  

    }//index    

    public function lista_relatorios()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
	    	//all the posts sent by the view
	    	$search_string = $this->input->post('search_string');
	    	$order = $this->input->post('order');
	    	$order_type = $this->input->post('order_type');
	    
	    	//pagination settings
	    	$config['per_page'] = 100;
	    
	    	$config['base_url'] = base_url().'admin/relatorio_gerencial';
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
	    	}else{
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
	                $data['count_products']= $this->relatorio_gerencialdao->count_relatorio_gerencial($search_string, $order);
	                $config['total_rows'] = $data['count_products'];
	    
	                			//fetch sql data into arrays
	                if($search_string){
	                			
		                if($order){
		                	$data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial($search_string, $order, $order_type, $config['per_page'],$limit_end);
			    		}else{
			    			$data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial($search_string, '', $order_type, $config['per_page'],$limit_end);
			   			}
				    }else{
					    if($order){
					    	$data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial('', $order, $order_type, $config['per_page'],$limit_end);
					    }else{
					   		$data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial('', '', $order_type, $config['per_page'],$limit_end);
					    }
	    			}
	    
	    }else{
	    
	    //clean filter data inside section
		    $filter_session_data['relatorio_gerencial_selected'] = null;
		    $filter_session_data['search_string_selected'] = null;
		    $filter_session_data['order'] = null;
		    $filter_session_data['order_type'] = null;
	    	$this->session->set_userdata($filter_session_data);
	    
	    	//pre selected options
	    	$data['search_string_selected'] = '';
	    	$data['order'] = 'id';
	    
	    	//fetch sql data into arrays
	    	$data['count_products']= $this->relatorio_gerencialdao->count_relatorio_gerencial();
	    	$data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial('', 'data_ini', $order_type, $config['per_page'],$limit_end);
	    	$config['total_rows'] = $data['count_products'];
	    
	    }//!isset($search_string) && !isset($order)
	    		 
	    //initializate the panination helper
	    $this->pagination->initialize($config);
	    
	    //$this->debugMark(null, $data);
	    
	    	//load the view
	    	$data['main_content'] = 'portal/relatorio_gerencial/list';
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
        	$this->form_validation->set_rules('data_ini', 'data_ini', 'required'); 
        	$this->form_validation->set_rules('data_fim', 'data_fim', ''); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
            	$data_to_store = array(
            			'titulo' => $this->input->post('titulo'),
            			'data_ini' => $this->input->post('data_ini'),
            			'data_fim' => $this->input->post('data_fim'),
            			'descricao' => $this->input->post('descricao'),
            			'observacoes' => $this->input->post('observacoes')
            	);
            	
            	
            	$id_relatorio_gerencial = $this->relatorio_gerencialdao->store_relatorio_gerencial($data_to_store);
            	
            	if($id_relatorio_gerencial){
            		
            		$data['flash_message'] = TRUE;
            		
            		if(!file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial)){
            			mkdir(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial, 0777, true);
            		}
            		if(!file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial.'/doc')){
            			mkdir(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial.'/doc', 0777, true);
            		}
            		if(!file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial.'/pdf')){
            			mkdir(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial.'/pdf', 0777, true);
            		}
            		if(!file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial.'/colecao')){
            			mkdir(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$id_relatorio_gerencial.'/colecao', 0777, true);
            		}           		
            	}else{
            		$data['flash_message'] = FALSE;
            		
            	}
            		// RELATORIO
	            	$fileNameRelatorio = $_FILES["relatorio"]["name"];
	            	$target_file_relatorio = PORTALPATH . 'assets/upload/' . basename($fileNameRelatorio);
	            	$fileTypeRelatorio = pathinfo($target_file_relatorio,PATHINFO_EXTENSION);
	            	
            	
	            	if (move_uploaded_file($_FILES["relatorio"]["tmp_name"], $target_file_relatorio)) {
	            		
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypeRelatorio;
	            		$data_to_store = array('relatorio' => $nome);
	            		
	            		copy ( $target_file_relatorio , RELATORIOS_GERENCIAIS_AA4_FOLDER . $target_file_relatorio.'/pdf/' .$nome);
	            		unlink($target_file_relatorio);
	            		
	            	}
            	
	            	// PORTIFOLIO
	            	$fileNamePortifolio = $_FILES["portifolio"]["name"];
	            	$target_file_portifolio = PORTALPATH . 'assets/upload/' . basename($fileNamePortifolio);
	            	$fileTypePortifolio = pathinfo($target_file_portifolio,PATHINFO_EXTENSION);
	            	
	            	 
	            	if (move_uploaded_file($_FILES["portifolio"]["tmp_name"], $target_file_portifolio)) {
	            		 
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypePortifolio;
	            		$data_to_store = array('portifolio' => $nome);
	            		 
	            		copy ( $target_file_portifolio , RELATORIOS_GERENCIAIS_AA4_FOLDER . $target_file_portifolio.'/pdf/' .$nome);
	            		unlink($target_file_portifolio);
	            		 
	            	}
	            	
	            	//CARTA
	            	$fileNameCarta = $_FILES["carta"]["name"];
	            	$target_file_carta = PORTALPATH . 'assets/upload/' . basename($fileNameCarta);
	            	$fileTypeCarta = pathinfo($target_file_carta,PATHINFO_EXTENSION);
	            	
	            	 
	            	if (move_uploaded_file($_FILES["carta"]["tmp_name"], $target_file_carta)) {
	            		 
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypeCarta;
	            		$data_to_store = array('carta' => $nome);
	            		 
	            		copy ( $target_file_carta , RELATORIOS_GERENCIAIS_AA4_FOLDER . $target_file_carta.'/pdf/' .$nome);
	            		unlink($target_file_carta);
	            		 
	            	}
	            	//COLECAO
	            	$fileNameColecao = $_FILES["colecao"]["name"];
	            	$target_file_colecao = PORTALPATH . 'assets/upload/' . basename($fileNameColecao);
	            	$fileTypeColecao = pathinfo($target_file_colecao,PATHINFO_EXTENSION);
	            	
	            	 
	            	if (move_uploaded_file($_FILES["colecao"]["tmp_name"], $target_file_colecao)) {
	            		 
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypeColecao;
	            		$data_to_store = array('colecao' => $nome);
	            		 
	            		copy ( $target_file_colecao , RELATORIOS_GERENCIAIS_AA4_FOLDER . $target_file_colecao.'/colecao/' .$nome);
	            		unlink($target_file_colecao);
	            		 
	            	}
	            	
	            	if($this->relatorio_gerencialdao->update_relatorio_gerencial($id_relatorio_gerencial, $data_to_store) == TRUE){
	            		$data['flash_message'] = TRUE;
	            	}else{
	            		$data['flash_message'] = FALSE;
	            	}
	            	
            		
            	
            }

        }
        //load the view
        $data['main_content'] = 'admin/relatorio_gerencial/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
        //product id 
        $id = $this->uri->segment(4);
        $id_relatorio_gerencial = $id;
        
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('data_ini', 'data_ini', 'required');
        	$this->form_validation->set_rules('data_fim', 'data_fim', '');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
                $data_to_store = array(
		        	'titulo' => $this->input->post('titulo'),
		        	'data_ini' => $this->input->post('data_ini'),
		        	'data_fim' => $this->input->post('data_fim'),
		        	'descricao' => $this->input->post('descricao'),
		        	'observacoes' => $this->input->post('observacoes')                    
                );
                
                $tmpArray = $this->relatorio_gerencialdao->get_relatorio_gerencial_by_id($id);
                //$this->debugMark('arrayTemp', $tmpArray);
            // RELATORIO
	            	$fileNameRelatorio = $_FILES["relatorio"]["name"];
	            	$target_file_relatorio = PORTALPATH . 'assets/upload/' . basename($fileNameRelatorio);
	            	$fileTypeRelatorio = pathinfo($target_file_relatorio,PATHINFO_EXTENSION);
	            	
            	
	            	if (move_uploaded_file($_FILES["relatorio"]["tmp_name"], $target_file_relatorio)) {
	            		
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypeRelatorio;
	            		
	            		$data_to_store = array_merge($data_to_store, array('relatorio' => $nome));
	            		
	            		
	            		copy ( $target_file_relatorio , RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' .$nome);
	            		unlink($target_file_relatorio);
	            		
	            		if(file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' . $tmpArray[0]['relatorio'])  AND $tmpArray[0]['relatorio'] != ''){
	            			unlink(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' . $tmpArray[0]['relatorio']);
	            		}
	            		
	            	}
            	
	            	
	            	// PORTIFOLIO
	            	$fileNamePortifolio = $_FILES["portifolio"]["name"];
	            	$target_file_portifolio = PORTALPATH . 'assets/upload/' . basename($fileNamePortifolio);
	            	$fileTypePortifolio = pathinfo($target_file_portifolio,PATHINFO_EXTENSION);
	            	
	            	 
	            	if (move_uploaded_file($_FILES["portifolio"]["tmp_name"], $target_file_portifolio)) {
	            		 
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypePortifolio;
	            		$data_to_store = array_merge($data_to_store, array('portifolio' => $nome));
	            		
	            		 
	            		copy ( $target_file_portifolio , RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' .$nome);
	            		unlink($target_file_portifolio);
	            		if(file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' . $tmpArray[0]['portifolio'])  AND $tmpArray[0]['portifolio'] != ''){
	            			unlink(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' . $tmpArray[0]['portifolio']);
	            		} 
	            	}
	            	
	            	//CARTA
	            	$fileNameCarta = $_FILES["carta"]["name"];
	            	$target_file_carta = PORTALPATH . 'assets/upload/' . basename($fileNameCarta);
	            	$fileTypeCarta = pathinfo($target_file_carta,PATHINFO_EXTENSION);
	            	
	            	 
	            	if (move_uploaded_file($_FILES["carta"]["tmp_name"], $target_file_carta)) {
	            		 
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypeCarta;
	            		$data_to_store = array_merge($data_to_store,array('carta' => $nome));
	            		 
	            		copy ( $target_file_carta , RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' .$nome);
	            		unlink($target_file_carta);
	            		if(file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' . $tmpArray[0]['carta'])  AND $tmpArray[0]['carta'] != ''){
	            			unlink(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/pdf/' . $tmpArray[0]['carta']);
	            		}
	            		 
	            	}
	            	//COLECAO
	            	$fileNameColecao = $_FILES["colecao"]["name"];
	            	$target_file_colecao = PORTALPATH . 'assets/upload/' . basename($fileNameColecao);
	            	$fileTypeColecao = pathinfo($target_file_colecao,PATHINFO_EXTENSION);
	            	
	            	 
	            	if (move_uploaded_file($_FILES["colecao"]["tmp_name"], $target_file_colecao)) {
	            		 
	            		$nome = $id_relatorio_gerencial.'_'.$this->createRandWord(20).'.'.$fileTypeColecao;
	            		$data_to_store = array_merge($data_to_store,array('colecao' => $nome));
	            		 
	            		copy ( $target_file_colecao , RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/colecao/' .$nome);
	            		unlink($target_file_colecao);
	            		if(file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/colecao/' . $tmpArray[0]['colecao'])  AND $tmpArray[0]['colecao'] != ''){
	            			unlink(RELATORIOS_GERENCIAIS_AA4_FOLDER . $id_relatorio_gerencial.'/colecao/' . $tmpArray[0]['colecao']);
	            		}
	            		 
	            	}
	            	
                //if the insert has returned true then we show the flash message
                if($this->relatorio_gerencialdao->update_relatorio_gerencial($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
               // $this->debugMark('arrayTemp', $data_to_store);
               // die;
                redirect('admin/relatorio_gerencial/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['relatorio_gerencial'] = $this->relatorio_gerencialdao->get_relatorio_gerencial_by_id($id);
        //load the view
        $data['main_content'] = 'admin/relatorio_gerencial/edit';
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
        $this->relatorio_gerencialdao->delete_relatorio_gerencial($id);
        redirect('admin/relatorio_gerencial');
    }//edit  
    
    public function delete_file(){
    	 
    	 
    	$id = $this->uri->segment(4);
    	
    	$colunm = $this->uri->segment(5);
    	 
    	$tmpArray = $this->relatorio_gerencialdao->get_relatorio_gerencial_by_id($id);
    	
    	if($colunm == 'colecao'){
    		$folder = $colunm;
    	}else{
    		$folder = 'pdf';
    	}
    	
    	$filename = RELATORIOS_GERENCIAIS_AA4_FOLDER . $id .'/'.$folder.'/'.$tmpArray[0][$colunm];
    	
    	if(file_exists($filename) AND $tmpArray[0][$colunm]){
    
    		$data_to_store = array($colunm => '');
    		
    		if($this->relatorio_gerencialdao->update_relatorio_gerencial($id, $data_to_store) == TRUE){
    			unlink($filename);
    		}else{
    			exit;
    		}
    
    	}
    	 
    	echo json_encode(array('success' => 1, 'result' => ''));
    	exit;
    	 
    }
    	
}