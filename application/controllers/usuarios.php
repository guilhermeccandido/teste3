<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class usuarios extends App_controller {

	const VIEW_FOLDER = 'admin/usuarios';
    public function __construct()
	{
		parent::__construct();
		$this->load->model('usuariosdao');
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

        $config['base_url'] = base_url().'admin/usuarios';
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
            $data['count_products']= $this->usuariosdao->count_usuarios($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['usuarios'] = $this->usuariosdao->get_usuarios($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['usuarios'] = $this->usuariosdao->get_usuarios($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['usuarios'] = $this->usuariosdao->get_usuarios('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['usuarios'] = $this->usuariosdao->get_usuarios('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['usuario_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->usuariosdao->count_usuarios();
            $data['usuarios'] = $this->usuariosdao->get_usuarios('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   
        $data = array_merge($data, $this->foreingController());
        //load the view
        $data['main_content'] = 'admin/usuarios/list';
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
        	
        	$this->form_validation->set_rules('instituicao', 'instituicao', 'required'); 
        	$this->form_validation->set_rules('login', 'login', 'required'); 
        	$this->form_validation->set_rules('nome', 'nome', 'required'); 
        	$this->form_validation->set_rules('local', 'local', ''); 
        	$this->form_validation->set_rules('id_local_execucao', 'id_local_execucao', 'required');
        	$this->form_validation->set_rules('email', 'email', 'required');
        	/* 
        	$this->form_validation->set_rules('senha', 'senha', 'required'); 
        	$this->form_validation->set_rules('tokensenha', 'tokensenha', 'required'); 
        	$this->form_validation->set_rules('ativo', 'ativo', 'required');
        	*/ 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array( 'instituicao' => $this->input->post('instituicao'),
                						'login' => $this->input->post('login'),
                		 				'nome' => $this->input->post('nome'),
                						'local' => $this->input->post('local'),
                						'email' => $this->input->post('email'),
                						'senha' => sha1($this->input->post('senha')),
                						'tokensenha' => $this->input->post('tokensenha'),
                						'id_local_execucao' => $this->input->post('id_local_execucao'),
                						'ativo' => $this->input->post('ativo'),
                );
                //if the insert has returned true then we show the flash message
                if($this->usuariosdao->store_usuario($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        
        $data = array_merge($data, $this->foreingController());
        //load the view
        $data['main_content'] = 'admin/usuarios/add';
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
        	
        	$this->form_validation->set_rules('instituicao', 'instituicao', 'required');
        	$this->form_validation->set_rules('login', 'login', 'required');
        	$this->form_validation->set_rules('nome', 'nome', 'required');
        	$this->form_validation->set_rules('local', 'local', '');
        	$this->form_validation->set_rules('id_local_execucao', 'id_local_execucao', 'required');
        	$this->form_validation->set_rules('email', 'email', 'required');
        	/*
        	$this->form_validation->set_rules('senha', 'senha', 'required');
        	$this->form_validation->set_rules('tokensenha', 'tokensenha', 'required');
        	$this->form_validation->set_rules('ativo', 'ativo', 'required');
        	*/
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
               $data_to_store = array(
			        	'instituicao' => $this->input->post('instituicao'),
			        	'login' => $this->input->post('login'),
			        	'nome' => $this->input->post('nome'),
			        	'local' => $this->input->post('local'),
			        	'email' => $this->input->post('email'),
		                'senha' => sha1($this->input->post('senha')),
		                'tokensenha' => $this->input->post('tokensenha'),
		                'ativo' => $this->input->post('ativo'),
               			'id_local_execucao' => $this->input->post('id_local_execucao'),
               );
               /*
	                'senha' => $this->input->post('senha'),
		        	'tokensenha' => $this->input->post('tokensenha'),
		        	'ativo' => $this->input->post('ativo')
               */
               
                //if the insert has returned true then we show the flash message
                if($this->usuariosdao->update_usuario($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/usuarios/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
       
        
        //product data 
        $data['usuario'] = $this->usuariosdao->get_usuario_by_id($id);
        $data = array_merge($data, $this->foreingController());
        //load the view
        $data['main_content'] = 'admin/usuarios/edit';
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
        $this->usuariosdao->delete_usuario($id);
        redirect('admin/usuarios');
    }//edit  
    
    
    function foreingController(){
    	$this->load->model('local_execucaodao');
    	$local = new local_execucaodao();
    	$data['local'] = $local->get_local_execucao(null, 'titulo');
    	
    	return $data;
    	
    }
    
    public function UsuarioRecPass($data = null) {
    	 
    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		 
    		//form validation
    		 
    		$this->form_validation->set_rules('email', 'email', '');
    		$this->form_validation->set_rules('login', 'login', '');
    		
    		$this->form_validation->set_error_delimiters(
    				'<div class="alert alert-danger alert-dismissible" role="alert">
    					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    					</button>
    					<strong>', '</strong></div>');
    
    
    		if(	($this->input->post('login')) || ($this->input->post('email')) ){
    			 
    			//$this->debugMark($this->input->post('login'));
    			$data2 = array();
    			$data2 = $this->usuariosdao->getUsuarioByLoginEmail($this->input->post('login'), $this->input->post('email'));
    					
    			
    			
    			if(empty($data2)){
    				$data['mens'] = 'Ocorreu um erro na digitação de seus dados. Ou talvez um problema de inconsistência. Por favor entre em contato com a administração do SGPLAN.';
    					
    			}else{
    				if($data2[0]['email'] == ''){
    					$data['mens'] =  'Você não possui um email cadastrado em nosso sistema. Por favor entre em contato com a administração do SGPLAN para cadastrar um email válido.';
    
    				}else{
    						
    					$randWord = $this->createRandWord(20);
    					$data_to_store = array(
    							'hash_cadastro' => $randWord
    								
    					);
    					if($this->usuariosdao->update_usuario($data2[0]['id_usuario'], $data_to_store) == TRUE){
    						
    						$mensUser = 'Você precisa redefinir sua senha, clique no link abaixo para que o procedimento seja realizado.<br/><br/>Login: <b>'.$data2[0]['login'].'</b><br/><br/>';
    						$mensUser = $mensUser.'<a href="'.base_url('recuperar_senha').'/'.$randWord.'" >Recuperar Senha</a>';
    							
    						$emailData = array(
									'toEmails' => array($data2[0]['email']),
									'toCopyEmails' => array(),
									'title' => 'Redefinir Senha' ,
									'body' => $mensUser ,
									'name' => 'SGPLAN' ,
									'fromEmail' => 'sgplan@dnit.gov.br'
							);	
											
    						$result = $this->emailJson($emailData);    						
    						
	    					//if($result->sucesso){
	    						$data['mens'] =  'Você recebera um email contendo as instruções para alterar sua senha. Caso não receba o email em até 24hrs, por favor entre em contato com a administração do SGPLAN.';
	    					//}else{
	    						//$data['mens'] = 'Ocorreu um problema no processo, por favor tente mais tarde ou entre em contato com nossa equipe.';
							//	$data['mens'] = json_encode($result);
	    					//}
    							
    					}else{
    						$data['mens'] = 'Ocorreu um problema no processo, por favor tente mais tarde ou entre em contato com nossa equipe.';
    							
    					}
    						
    				}
    				 
    			}
    				
    			 
    			 
    		}else{
    			$data['mens'] = 'Preencha ao menos um valor.';
    			 
    		}
    
    	}
    	 
    	$data['main_content'] = 'portal/usuarios/recuperar_senha';
    	$this->load->view('includes/portal_template', $data);
    	 
    	 
    }
    
    function recover_pass($key = null){
    	 
    	 
    	if($key){
    
    		$data = array();
    		$data = array_merge($data, $this->get_acesso_user());
    
    		//product id
    		$result = $this->usuariosdao->getUsuarioByKey($key);
    		if(sizeof($result) > 0){
    			 
    			$id = $result[0]['id_usuario'];
    			 
    			 
    			//if save button was clicked, get the data sent via post
    			if ($this->input->server('REQUEST_METHOD') === 'POST')
    			{
    				//form validation
    				 
    				$this->form_validation->set_rules('pass', 'Senha', 'required');
    				$this->form_validation->set_rules('pass2', 'Confirmar Senha', 'required|matches[pass]');
    					
    				$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    				//if the form has passed through the validation
    				if ($this->form_validation->run())
    				{
    					 
    					$data_to_store = array(
    							'senha' => sha1($this->input->post('pass')),
    							'hash_cadastro' => '',
    							 
    					);
    					//$this->debugMark(null, $data_to_store);
    					 
    					//if the insert has returned true then we show the flash message
    					if($this->usuariosdao->update_usuario($id, $data_to_store) == TRUE){
    						$data['mens'] = 'Sua senha foi alterada com sucesso.';
    							
    					}else{
    						$data['mens'] = 'Ocorreu um problema, por favor entre em contato conosco.';
    					}
    					//redirect('recuperar_senha');
    					 
    				}
    				 
    			}
    			 
    		}
    
    	}
    	 
    	 
    	$data['main_content'] = 'portal/usuarios/recuperar_senha2';
    	$this->load->view('includes/portal_template', $data);
    }
    
    	
}