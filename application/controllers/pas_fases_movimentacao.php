<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class pas_fases_movimentacao extends App_controller {
const VIEW_FOLDER = 'admin/pas_fases_movimentacao';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_fases_movimentacaodao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    	
    	$id_pas = $this->uri->segment(3);
    	$data['id_pas'] = $id_pas;
    	
    	$id = $this->uri->segment(4);
    	$data['id_pas_fases'] = $id;
    	 
    	$this->load->model('pas_fases_movimentacaodao');
    	$ant = new pas_fases_movimentacaodao();
    	 
    	$data['pas_fases_movimentacao'] = $ant->get_pas_fases_movimentacao_by_id_pas_fases($id, 'data_protocolo');
    	//$this->PAR($data['pas_fases_movimentacao']);
    
    	$this->load->model('fasesdao');
    	$produtos = new fasesdao();
    	$data['fases'] = $produtos->get_fase_by_id_pas_fases($id);
    	 
    	$data = array_merge($data, $this->foreingControllers($id_pas));
    	
        //load the view
        $data['main_content'] = 'admin/pas_fases_movimentacao/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
	public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));			
    	
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	
		$id_pas_fases = $this->uri->segment(5);
    	$data['id_pas_fases'] = $id_pas_fases;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_pas_fases', 'id_pas_fases', 'required'); 
        	$this->form_validation->set_rules('id_avaliacoes', 'id_avaliacoes', '');
        	$this->form_validation->set_rules('id_status', 'id_status', 'required');
        	$this->form_validation->set_rules('data_protocolo', 'data_protocolo', 'required');
        	$this->form_validation->set_rules('time_protocolo', 'time_protocolo', 'required');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('file', 'file', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
            	$avaliacao =  $this->input->post('id_avaliacoes') ? $this->input->post('id_avaliacoes') : 1;
            	
                
                $fileName = $_FILES["file"]["name"];
                $target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
                 
                $uploadOk = 1;
                $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                
                $data_protocolo = $this->input->post('data_protocolo');
                $time_protocolo = $this->input->post('time_protocolo');
                $date_time_protocolo = $data_protocolo.' '.$time_protocolo;
                
                if ($uploadOk == 0 or $fileName == '') {
                	//
                	$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
                		'id_avaliacoes' => $avaliacao,
                		'id_status' => $this->input->post('id_status'),
                		'data_protocolo' => $date_time_protocolo,
                		'descricao' => $this->input->post('descricao')
                	);
                	
                	if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
                		 
                		$data['flash_message'] = TRUE;
                	}else{
                		$data['flash_message'] = FALSE;
                	}
                	
                }else {
                	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                
                		$nome = $id_pas.'_'.$this->createRandWord(20).'.'.$fileType;
                		$data_to_store = array('nome' => $nome);
                
                		if(!file_exists(PAS_FOLDER . $id_pas.'/documentos')){
                			mkdir(PAS_FOLDER . $id_pas.'/documentos', 0777, true);
                		}
                
                		copy ( $target_file , PAS_FOLDER . $id_pas.'/documentos/' .$nome);
                		unlink($target_file);
                		
                		$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
                				'id_avaliacoes' => $avaliacao,
                				'id_status' => $this->input->post('id_status'),
                				'data_protocolo' => $date_time_protocolo,
                				'descricao' => $this->input->post('descricao'),
                				'file' => $nome
                		);
                
                		//if the insert has returned true then we show the flash message
	                	if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
	                	
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
        
        
        $data = array_merge($data, $this->foreingControllersEdit($id_pas_fases));
        //$this->PAR($data['avaliacoes']);
                		
        //load the view
        $data['main_content'] = 'admin/pas_fases_movimentacao/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));		
    		
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	
        //product id
        $id = $this->uri->segment(5);
  		$id_pas_fases = $this->uri->segment(6);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_pas_fases', 'id_pas_fases', 'required');
        	$this->form_validation->set_rules('id_status', 'id_status', 'required');
        	$this->form_validation->set_rules('id_avaliacoes', 'id_avaliacoes', '');
        	$this->form_validation->set_rules('data_protocolo', 'data_protocolo', 'required');
        	$this->form_validation->set_rules('time_protocolo', 'time_protocolo', 'required');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('file', 'file', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
            	$avaliacao =  $this->input->post('id_avaliacoes') ? $this->input->post('id_avaliacoes') : 1; 
            	
    
            	$fileName = $_FILES["file"]["name"];
            	$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
            	 
            	$uploadOk = 1;
            	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            	
            	$data_protocolo = $this->input->post('data_protocolo');
            	$time_protocolo = $this->input->post('time_protocolo');
            	$date_time_protocolo = $data_protocolo.' '.$time_protocolo;
            	//$this->debugMark('DateTime Protocolo', null,  $date_time_protocolo );
            	
            	if ($uploadOk == 0 or $fileName == '') {
            		//
            		$data_to_store = array(
			        	'id_pas_fases' => $this->input->post('id_pas_fases'),
	                	'id_status' => $this->input->post('id_status'),
			        	'id_avaliacoes' => $avaliacao,
			        	'data_protocolo' => $date_time_protocolo,
			        	'descricao' => $this->input->post('descricao')
	                );
            		 
            		//if the insert has returned true then we show the flash message
	                if($this->pas_fases_movimentacaodao->update_pas_fases_movimentacao($id, $data_to_store) == TRUE){
	                    $this->session->set_flashdata('flash_message', 'updated');
	                }else{
	                    $this->session->set_flashdata('flash_message', 'not_updated');
	                }
	                redirect('admin/pas_fases_movimentacao/update/'.$id_pas.'/'.$id.'/'.$id_pas_fases);
            		 
            	}else {
            		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            	
            			$nome = $id_pas.'_'.$this->createRandWord(20).'.'.$fileType;
            			$data_to_store = array('nome' => $nome);
            	
            			if(!file_exists(PAS_FOLDER . $id_pas.'/documentos')){
            				mkdir(PAS_FOLDER . $id_pas.'/documentos', 0777, true);
            			}
            	
            			copy ( $target_file , PAS_FOLDER . $id_pas.'/documentos/' .$nome);
            			unlink($target_file);
            	
            			$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
            					'id_avaliacoes' => $avaliacao,
            					'id_status' => $this->input->post('id_status'),
            					'data_protocolo' => $date_time_protocolo,
            					'descricao' => $this->input->post('descricao'), 
            					'file' => $nome
            			);
            	
            			//if the insert has returned true then we show the flash message
		                if($this->pas_fases_movimentacaodao->update_pas_fases_movimentacao($id, $data_to_store) == TRUE){
		                    $this->session->set_flashdata('flash_message', 'updated');
		                }else{
		                    $this->session->set_flashdata('flash_message', 'not_updated');
		                }
		                redirect('admin/pas_fases_movimentacao/update/'.$id_pas.'/'.$id.'/'.$id_pas_fases);
            			 
            		} else {
            			$this->session->set_flashdata('flash_message', 'not_updated');
            		}
            		 
            	}
            	
            }//validation run
    
        }
    
        $data['pas_fases_movimentacao'] = $this->pas_fases_movimentacaodao->get_pas_fases_movimentacao_by_id($id);
        // SOLUCAÇÃO TEMPORARIA
        $arrayDataTemp = explode(' ', $data['pas_fases_movimentacao'][0]['data_protocolo']);	 
        $data['pas_fases_movimentacao'][0]['data_protocolo'] = $arrayDataTemp[0];
        $data['pas_fases_movimentacao'][0]['time_protocolo'] = $arrayDataTemp[1];
        
        //$this->debugMark('DateTime', $data['pas_fases_movimentacao']);
        
        $this->load->model('fasesdao');
        $produtos = new fasesdao();
        $data['fases'] = $produtos->get_fase_by_id_pas_fases($id_pas_fases);
        		
        $data = array_merge($data, $this->foreingControllers($id_pas));
        
        //$this->PAR($data);
        //DIE;
        
        //load the view
        $data['main_content'] = 'admin/pas_fases_movimentacao/edit';
        $this->load->view('includes/template', $data);
    
    }//update
    	
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
    
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true,  __FUNCTION__));
    	
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	
        $id = $this->uri->segment(5);
    	$id_pas_fases = $this->uri->segment(6);
        $this->pas_fases_movimentacaodao->delete_pas_fases_movimentacao($id);
        redirect('admin/pas_fases_movimentacao/'.$id_pas.'/'.$id_pas_fases);
    }//edit
    
    
    public function foreingControllers($id_pas = null){
    	
    	$this->load->model('statusdao');
    	$status = new statusdao();
    	$data['status'] = $status->get_status(null,'id');
    	
    	
    	$this->load->model('avaliacoesdao');
    	$avaliacoes = new avaliacoesdao();
    	$data['avaliacoes'] = $avaliacoes->get_avaliacoes(null,'id');
    	
    	if($id_pas){
    		$this->load->model('pasdao');
    		$pas = new pasdao();
    		$pasArray = $pas->get_pas_by_id($id_pas);
    		$data['lote'] = sizeof($pasArray) > 0 ? $pasArray[0]['lote'] : 0;
    	}
    	
    	return $data;
    	
    }
    
    public function foreingControllersEdit($id, $id_status = null){
    	
    	if($id_status){
    		$this->load->model('status_statusdao');
    		$status = new status_statusdao();
    		$data['status'] = $status->get_status_status_by_id_status($id_status);
    	}else{
    		$this->load->model('statusdao');
    		$status = new statusdao();
    		$data['status'] = $status->get_status(null,'id');
    	}
    	
    	 
    	$this->load->model('pas_fases_movimentacaodao');
    	$movimentacao = new pas_fases_movimentacaodao();
    	$data['avaliacoes'] =  $movimentacao->get_possible_avaliacoes_by_pas_fases($id);
    	
        $this->load->model('fasesdao');
        $produtos = new fasesdao();
        $data['fases'] = $produtos->get_fase_by_id_pas_fases($id);
        
    	//$this->debugMark('Edit',$data['fases'] );
    	$this->load->model('pasdao');
    	$pas = new pasdao();
    	$pasArray = $pas->get_pas_by_id($data['fases'][0]['id_pas']);
    	$data['lote'] = sizeof($pasArray) > 0 ? $pasArray[0]['lote'] : 0;
    
    	return $data;
    	 
    }
   
    public function gerente()
    {
    
    	$data = array();
    	//$this->debugMark(__FUNCTION__);
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));
    
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    
    	$id_pas_fases = $this->uri->segment(5);
    	$data['id_pas_fases'] = $id_pas_fases;
    	 
    	// GET THE LAST MOVE TO SET THE NEXTS MOVES
    	$tmpArray = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas_fases($id_pas_fases);
    	//$this->debugMark("Last Mov",$tmpArray );
    
    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    
    		//form validation
    		$this->form_validation->set_rules('id_pas_fases', 'id_pas_fases', 'required');
    		$this->form_validation->set_rules('id_avaliacoes', 'id_avaliacoes', '');
    		$this->form_validation->set_rules('id_status', 'id_status', 'required');
    		$this->form_validation->set_rules('descricao', 'descricao', '');
    		$this->form_validation->set_rules('file', 'file', '');
    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    
    			$avaliacao =  $this->input->post('id_avaliacoes') ? $this->input->post('id_avaliacoes') : 1;
    
    			// CONTROLE PARA NÃO REINSERIR O MESMO STATUS
    			if($this->input->post('id_status') == $tmpArray[0]['id_status']){
    				redirect('admin/pas');
    			}
    			
    			$fileName = $_FILES["file"]["name"];
    			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    
    			$uploadOk = 1;
    			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    
    			if ($uploadOk == 0 or $fileName == '') {
    
    				$dataNOW = date('Y-m-d H:i:s');
    				$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    						'id_avaliacoes' => $avaliacao,
    						'id_status' => $this->input->post('id_status'),
    						'data_protocolo' => $dataNOW,
    						'descricao' => $this->input->post('descricao')
    				);
    					
    				//$this->debugMark($dataNOW, $data_to_store);
    				if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    					redirect('admin/pas');
    						
    				}else{
    					$data['flash_message'] = FALSE;
    				}
    					
    			}else {
    				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    
    					$nome = $id_pas.'_'.$this->createRandWord(20).'.'.$fileType;
    					$data_to_store = array('nome' => $nome);
    
    					if(!file_exists(PAS_FOLDER . $id_pas.'/documentos')){
    						mkdir(PAS_FOLDER . $id_pas.'/documentos', 0777, true);
    					}
    
    					copy ( $target_file , PAS_FOLDER . $id_pas.'/documentos/' .$nome);
    					unlink($target_file);
    
    					$dataNOW = date('Y-m-d H:i:s');
    					$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    							'id_avaliacoes' => $avaliacao,
    							'id_status' => $this->input->post('id_status'),
    							'data_protocolo' => $dataNOW,
    							'descricao' => $this->input->post('descricao'),
    							'file' => $nome
    					);
    
    					//if the insert has returned true then we show the flash message
    					if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    						redirect('admin/pas');
    
    					}else{
    						$data['flash_message'] = FALSE;
    					}
    
    				} else {
    					$data['flash_message'] = FALSE;
    				}
    					
    			}
    
    		}
    
    	}
    
    
    	$data = array_merge($data, $this->foreingControllersEdit($id_pas_fases, $tmpArray[0]['id_status']));
    	//$this->PAR($data['avaliacoes']);
    
    	//load the view
    	$data['main_content'] = 'admin/pas_fases_movimentacao/'.__FUNCTION__;
    	$this->load->view('includes/template', $data);
    }
    
    
    public function analista()
    {
    
    	$data = array();
    	//$this->debugMark(__FUNCTION__);
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));
    	 
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	 
    	$id_pas_fases = $this->uri->segment(5);
    	$data['id_pas_fases'] = $id_pas_fases;
    	
    	// GET THE LAST MOVE TO SET THE NEXTS MOVES
    	$tmpArray = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas_fases($id_pas_fases);
    	//$this->debugMark("Last Mov",$tmpArray ); 
    	 
    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    
    		//form validation
    		$this->form_validation->set_rules('id_pas_fases', 'id_pas_fases', 'required');
    		$this->form_validation->set_rules('id_avaliacoes', 'id_avaliacoes', '');
    		$this->form_validation->set_rules('id_status', 'id_status', 'required');
    		$this->form_validation->set_rules('descricao', 'descricao', '');
    		$this->form_validation->set_rules('file', 'file', '');
    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    			 
    			$avaliacao =  $this->input->post('id_avaliacoes') ? $this->input->post('id_avaliacoes') : 1;
    			 
    			// CONTROLE PARA NÃO REINSERIR O MESMO STATUS
    			if($this->input->post('id_status') == $tmpArray[0]['id_status']){
    				redirect('admin/pas');
    			}
    
    			$fileName = $_FILES["file"]["name"];
    			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    			 
    			$uploadOk = 1;
    			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    
    			if ($uploadOk == 0 or $fileName == '') {
    				
    				$dataNOW = date('Y-m-d H:i:s');
    				$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    						'id_avaliacoes' => $avaliacao,
    						'id_status' => $this->input->post('id_status'),
    						'data_protocolo' => $dataNOW,
    						'descricao' => $this->input->post('descricao')
    				);
    				 
    				//$this->debugMark($dataNOW, $data_to_store);
    				if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    					redirect('admin/pas');
    					
    				}else{
    					$data['flash_message'] = FALSE;
    				}
    				 
    			}else {
    				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    
    					$nome = $id_pas.'_'.$this->createRandWord(20).'.'.$fileType;
    					$data_to_store = array('nome' => $nome);
    
    					if(!file_exists(PAS_FOLDER . $id_pas.'/documentos')){
    						mkdir(PAS_FOLDER . $id_pas.'/documentos', 0777, true);
    					}
    
    					copy ( $target_file , PAS_FOLDER . $id_pas.'/documentos/' .$nome);
    					unlink($target_file);
    
    					$dataNOW = date('Y-m-d H:i:s');
    					$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    							'id_avaliacoes' => $avaliacao,
    							'id_status' => $this->input->post('id_status'),
    							'data_protocolo' => $dataNOW,
    							'descricao' => $this->input->post('descricao'),
    							'file' => $nome
    					);
    
    					//if the insert has returned true then we show the flash message
    					if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    						redirect('admin/pas');
    						
    					}else{
    						$data['flash_message'] = FALSE;
    					}
    					 
    				} else {
    					$data['flash_message'] = FALSE;
    				}
    				 
    			}
    
    		}
    
    	}
    
    
    	$data = array_merge($data, $this->foreingControllersEdit($id_pas_fases, $tmpArray[0]['id_status']));
    	//$this->PAR($data['avaliacoes']);
    
    	//load the view
    	$data['main_content'] = 'admin/pas_fases_movimentacao/analista';
    	$this->load->view('includes/template', $data);
    }
    
    public function contratada()
    {
    
    	$data = array();
    	
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));
    	//$this->debugMark(__FUNCTION__);
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    
    	$id_pas_fases = $this->uri->segment(5);
    	$data['id_pas_fases'] = $id_pas_fases;
    	 
    	// GET THE LAST MOVE TO SET THE NEXTS MOVES
    	$tmpArray = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas_fases($id_pas_fases);
    	//$this->debugMark("Last Mov",$tmpArray );
    
    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    
    		//form validation
    		$this->form_validation->set_rules('id_pas_fases', 'id_pas_fases', 'required');
    		$this->form_validation->set_rules('id_avaliacoes', 'id_avaliacoes', '');
    		$this->form_validation->set_rules('id_status', 'id_status', 'required');
    		$this->form_validation->set_rules('descricao', 'descricao', '');
    		$this->form_validation->set_rules('file', 'file', '');
    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    
    			$avaliacao =  $this->input->post('id_avaliacoes') ? $this->input->post('id_avaliacoes') : 1;
    
    			// CONTROLE PARA NÃO REINSERIR O MESMO STATUS
    			if($this->input->post('id_status') == $tmpArray[0]['id_status']){
    				redirect('admin/pas');
    			}
    
    			$fileName = $_FILES["file"]["name"];
    			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    
    			$uploadOk = 1;
    			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    
    			if ($uploadOk == 0 or $fileName == '') {
    
    				$dataNOW = date('Y-m-d H:i:s');
    				$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    						'id_avaliacoes' => $avaliacao,
    						'id_status' => $this->input->post('id_status'),
    						'data_protocolo' => $dataNOW,
    						'descricao' => $this->input->post('descricao')
    				);
    					
    				//$this->debugMark($dataNOW, $data_to_store);
    				if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    					redirect('admin/pas');
    						
    				}else{
    					$data['flash_message'] = FALSE;
    				}
    					
    			}else {
    				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    
    					$nome = $id_pas.'_'.$this->createRandWord(20).'.'.$fileType;
    					$data_to_store = array('nome' => $nome);
    
    					if(!file_exists(PAS_FOLDER . $id_pas.'/documentos')){
    						mkdir(PAS_FOLDER . $id_pas.'/documentos', 0777, true);
    					}
    
    					copy ( $target_file , PAS_FOLDER . $id_pas.'/documentos/' .$nome);
    					unlink($target_file);
    
    					$dataNOW = date('Y-m-d H:i:s');
    					$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    							'id_avaliacoes' => $avaliacao,
    							'id_status' => $this->input->post('id_status'),
    							'data_protocolo' => $dataNOW,
    							'descricao' => $this->input->post('descricao'),
    							'file' => $nome
    					);
    
    					//if the insert has returned true then we show the flash message
    					if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    						redirect('admin/pas');
    
    					}else{
    						$data['flash_message'] = FALSE;
    					}
    
    				} else {
    					$data['flash_message'] = FALSE;
    				}
    					
    			}
    
    		}
    
    	}
    
    
    	$data = array_merge($data, $this->foreingControllersEdit($id_pas_fases, $tmpArray[0]['id_status']));
    	//$this->PAR($data['avaliacoes']);
    
    	//load the view
    	$data['main_content'] = 'admin/pas_fases_movimentacao/'.__FUNCTION__;
    	$this->load->view('includes/template', $data);
    }
    	
    
    public function administrador()
    {
    	
    	$data = array();
    	//$this->debugMark(__FUNCTION__);
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));
    	
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	
    	$id_pas_fases = $this->uri->segment(5);
    	$data['id_pas_fases'] = $id_pas_fases;
    	
    	// GET THE LAST MOVE TO SET THE NEXTS MOVES
    	$tmpArray = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas_fases($id_pas_fases);
    	//$this->debugMark("Last Mov",$tmpArray );
    	
    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		
    		//form validation
    		$this->form_validation->set_rules('id_pas_fases', 'id_pas_fases', 'required');
    		$this->form_validation->set_rules('id_avaliacoes', 'id_avaliacoes', '');
    		$this->form_validation->set_rules('id_status', 'id_status', 'required');
    		$this->form_validation->set_rules('descricao', 'descricao', '');
    		$this->form_validation->set_rules('file', 'file', '');
    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    		
    		
    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    			
    			$avaliacao =  $this->input->post('id_avaliacoes') ? $this->input->post('id_avaliacoes') : 1;
    			
    			// CONTROLE PARA NÃO REINSERIR O MESMO STATUS
    			if($this->input->post('id_status') == $tmpArray[0]['id_status']){
    				redirect('admin/pas');
    			}
    			
    			$fileName = $_FILES["file"]["name"];
    			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    			
    			$uploadOk = 1;
    			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    			
    			
    			if ($uploadOk == 0 or $fileName == '') {
    				
    				$dataNOW = date('Y-m-d H:i:s');
    				$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    						'id_avaliacoes' => $avaliacao,
    						'id_status' => $this->input->post('id_status'),
    						'data_protocolo' => $dataNOW,
    						'descricao' => $this->input->post('descricao')
    				);
    				
    				//$this->debugMark($dataNOW, $data_to_store);
    				if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    					redirect('admin/pas');
    					
    				}else{
    					$data['flash_message'] = FALSE;
    				}
    				
    			}else {
    				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    					
    					$nome = $id_pas.'_'.$this->createRandWord(20).'.'.$fileType;
    					$data_to_store = array('nome' => $nome);
    					
    					if(!file_exists(PAS_FOLDER . $id_pas.'/documentos')){
    						mkdir(PAS_FOLDER . $id_pas.'/documentos', 0777, true);
    					}
    					
    					copy ( $target_file , PAS_FOLDER . $id_pas.'/documentos/' .$nome);
    					unlink($target_file);
    					
    					$dataNOW = date('Y-m-d H:i:s');
    					$data_to_store = array('id_pas_fases' => $this->input->post('id_pas_fases'),
    							'id_avaliacoes' => $avaliacao,
    							'id_status' => $this->input->post('id_status'),
    							'data_protocolo' => $dataNOW,
    							'descricao' => $this->input->post('descricao'),
    							'file' => $nome
    					);
    					
    					//if the insert has returned true then we show the flash message
    					if($this->pas_fases_movimentacaodao->store_pas_fases_movimentacao($data_to_store)){
    						redirect('admin/pas');
    						
    					}else{
    						$data['flash_message'] = FALSE;
    					}
    					
    				} else {
    					$data['flash_message'] = FALSE;
    				}
    				
    			}
    			
    		}
    		
    	}
    	
    	
    	$data = array_merge($data, $this->foreingControllersEdit($id_pas_fases, $tmpArray[0]['id_status']));
    	//$this->PAR($data['avaliacoes']);
    	
    	//load the view
    	$data['main_content'] = 'admin/pas_fases_movimentacao/'.__FUNCTION__;
    	$this->load->view('includes/template', $data);
    }
    
    public function delete_file(){
    	
    	
    	$id_pas = $this->uri->segment(4);
    	$id = $this->uri->segment(5);
    	
    	$tmpArray = $this->pas_fases_movimentacaodao->get_pas_fases_movimentacao_by_id($id);
    	
    	$filename = PAS_FOLDER . $id_pas.'/documentos/'.$tmpArray[0]['file'];
    	
    	if(file_exists($filename) AND $tmpArray[0]['file']){
    		
    		$data_to_store = array('file' => '');
    		
    		if($this->pas_fases_movimentacaodao->update_pas_fases_movimentacao($id, $data_to_store) == TRUE){
    			unlink($filename);
    		}else{
    			exit;
    		}
    		
    	}
    	
    	echo json_encode(array('success' => 1, 'result' => ''));
    	exit;
    	
    }
    
    public function get_movimento_detalhes()
    {
    	header('Content-type: application/json');
    	$id_movimento = $this->uri->segment(4);
    	
    	$data['movimento'] = $this->pas_fases_movimentacaodao->get_pas_fases_movimentacao_detalhes_by_id($id_movimento);
    	
    	//$this->debugMark('teste', $data['movimento']);
    	
    	$httpResponse = $this->load->view('admin/pas_fases_movimentacao/movimento_anterior', $data, true);
    	
    	echo json_encode(array('success' => 1, 'result' => $httpResponse));
    	exit;
    }
    
}





