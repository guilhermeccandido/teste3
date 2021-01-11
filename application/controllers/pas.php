<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
//require_once(APPPATH . 'controllers/pas_fases' . EXT);
class pas extends App_controller {
const VIEW_FOLDER = 'admin/pas';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pasdao');
		$this->load->model('pas_fases_movimentacaodao');
		$this->load->model('pas_fasesdao');
		$this->load->model('contratosdao');
		
		$this->load->library('gcharts');
		$this->load->library('googlemaps');
		  
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	if (method_exists($this, $data['usuarioPerfil']['perfil']))
    	{
			$param =array();
    		return call_user_func_array(array($this, $data['usuarioPerfil']['perfil']), $param);
    	}
    			
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 1000;

        $config['base_url'] = base_url().'admin/pas';
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
            $data['count_products']= $this->pasdao->count_pas($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['pas'] = $this->pasdao->get_pas($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['pas'] = $this->pasdao->get_pas($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['pas'] = $this->pasdao->get_pas('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['pas'] = $this->pasdao->get_pas('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['pas_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->pasdao->count_pas();
            $data['pas'] = $this->pasdao->get_pas('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);  
        
        $this->load->model('pas_trechosdao');
        
        
        $i = 0;
        $tmpArray = array();
        $tmpFaseArray = array();
        
        //$pasFases = new pas_fases();
        // GET ALL DATA TO POPULATE CRONOGRAMA
        foreach($data['pas'] as $item){
        	$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
        	$tmpArray = array();
        	foreach($tmpFaseArray as $row){
        		// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
        		$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
        	}
        	//echo '<br>';
        	$progressoTotalSoma =  array_sum($tmpArray);
        	//echo '<br>';
        	$totalFases = sizeof($tmpArray) ;
        	//echo '<br>';
        	//$this->PAR($tmpArray);
        	
        	if($progressoTotalSoma AND $totalFases){
        		$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
        		
        		// verifica a data do primeiro movimento
        		$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
        		
        		$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
        		
        		if($data['pas'][$i]['progresso_total'] >= 100){
        			// verifica a data do ultimo movimento
        			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);        			
        			$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
        		}
        		
        	}else{
        		$data['pas'][$i]['progresso_total'] = 0;
        	}
        	
        	
        	$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_label_by_id_pas($item['id']);
        	if(sizeof($arrayTrechos) > 0){
        		$firstTrecho = true;
        		$labelTrecho = '';
        		$ext = 0;
        		foreach($arrayTrechos as $rowTrecho){
        			if($firstTrecho){
        				$firstTrecho = false;
        				$labelTrecho = 'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}else{
        				$labelTrecho .= ' e '.'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}
        			$ext += $rowTrecho['extensao'];
        		}
        		$data['pas'][$i]['trechos'] = $labelTrecho;
        		$data['pas'][$i]['extensao'] = $ext;
        		
        	}else{
        		$data['pas'][$i]['trechos'] = ' --- ';
        		$data['pas'][$i]['extensao'] = 'Não Disponível';
        	}
        	
        	$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
        	$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
        	
        	$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
        	$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
        	
        	
        	$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
        	//$this->debugMark('data fim plan',$tmpLastDataPlan );
        	$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
        	
        	//echo '<br>';
        	$i++; 
        	
        	
        }
       
        unset($tmpArray);
        unset($tmpFaseArray);
        
        $data['id_responsavel'] = $this->session->userdata('id');
        $data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_localizacao();
        //$this->debugMark( $data['usuarioPerfil']['id_perfil']);
        
        
        $this->load->model('pas_fases_movimentacaodao');
        $lastMov = new pas_fases_movimentacaodao();
        
        $i = 0;
        foreach($data['pas_fases'] as $item){
        	
        	$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
        	//$this->debugMark("Pas Fases", $data['pas_fases'] );
        	
        	if(sizeof($tmpArray) > 0 AND $tmpArray[0]['id_usuario_perfil'] == 5){
        		
        		$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
        		$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
        		
        		if($data['pas_fases'][$i]['progresso']  >= 100 ){
        			unset($data['pas_fases'][$i]);
        		}else{
        			$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);
        			$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
        			
        			$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
        			$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
        			
        		}
        		
        	}else{
        		unset($data['pas_fases'][$i]);
        	}
        	
        	$i++;
        	
        }
        
        $pasFasesTmp = array();
        
        foreach($data['pas_fases'] as $item){
        	$pasFasesTmp[$item['local_execucao']][$item['id_responsavel']][] = $item;
        }
        
        $data['pas_fases'] = $pasFasesTmp;
        
        
        unset($tmpArray);
        unset($tmpFaseArray);
        
        
        $data = array_merge($data, $this->foreingControllers());
        $data = array_merge($data, $this->foreingControllersContratos());
        

        //load the view
        $data['main_content'] = 'admin/pas/list';
        $this->load->view('includes/template', $data);  

    }//index    
    
    /**
     * Get Progresso produto by his id
     * Verifica o ultimo status com peso maior que ZERO e consulta se necessário a ultima avaliação
     * @return int progresso
     */
    public function get_progresso_by_pas_fase($id_pas_fases, $peso = null){
    	 
    	$tmpArray = $this->pas_fases_movimentacaodao->get_last_status_with_peso_by_id_fases($id_pas_fases);
    	// SEMPRE VALE O MAIOR PESO ADQUIRIDO
    	$tmpArrayPeso = $this->pas_fases_movimentacaodao->get_max_peso_by_id_fases($id_pas_fases);
    	
    	$tmpStatus = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    	$tmpPeso = (sizeof($tmpArrayPeso) > 0 ) ? $tmpArrayPeso[0]['peso'] : 0;
    	
    	$progresso = 0;
    	 
    	if((sizeof($tmpStatus) > 0 ) ){
    		if($tmpStatus['composicao'] == 'Simples'){
    			$progresso = ( $tmpStatus['peso'] ) ? $tmpStatus['peso'] : 0;
    
    		}else{
    			$progresso = ( $tmpStatus['peso'] ) ? $tmpStatus['peso'] : 0;
    			 
    			if($peso){
    				$progresso += $peso;
    			}else{
    				$tmpArray = $this->pas_fases_movimentacaodao->get_last_avaliation_by_id_fases($id_pas_fases);
    				$tmpAvaliacao = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    				$progresso += ( isset($tmpAvaliacao['peso']) ) ? $tmpAvaliacao['peso'] : 0;
    			}
    
    		}
    			
    	}
    	$progresso = ($progresso >= $tmpPeso ) ? $progresso : $tmpPeso;
    	 
    	return $progresso;
    }
    
    public function add()
    {
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));		
    	
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('ordem_servico', 'ordem_servico', '');
        	$this->form_validation->set_rules('id_responsavel', 'id_responsavel', 'required');
        	$this->form_validation->set_rules('id_pas_prazos', 'id_pas_prazos', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', '');
        	$this->form_validation->set_rules('lote', 'lote', 'required'); 
        	$this->form_validation->set_rules('status', 'status', ''); 
        	$this->form_validation->set_rules('id_contrato', 'id_contrato', '');
        	$this->form_validation->set_rules('data_ini_pas', 'data_ini_pas', '');
        	$this->form_validation->set_rules('data_ini_planejada', 'data_ini_planejada', '');
        	$this->form_validation->set_rules('id_local_execucao', 'id_local_execucao', '');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'ordem_servico' => $this->input->post('ordem_servico'),
                		'id_responsavel' => $this->input->post('id_responsavel'),
                		'id_pas_prazos' => $this->input->post('id_pas_prazos'),
                		'titulo' => $this->input->post('titulo'),
                		'lote' => $this->input->post('lote'),
                		'status' => $this->input->post('status'),
                		'id_contrato' => $this->input->post('id_contrato'),
                		'data_ini_pas' => $this->input->post('data_ini_pas'),
                		'data_ini_planejada' => $this->input->post('data_ini_planejada'),
                		'id_local_execucao' => $this->input->post('id_local_execucao'),
                		'descricao' => $this->input->post('descricao'),
                		'observacoes' => $this->input->post('observacoes')
                );
                
                
                /*
                 
                 	'rodovia' => $this->input->post('rodovia'),
                	'uf' => $this->input->post('uf'),
                	'km_inicial' => $this->input->post('km_inicial'),
                	'km_final' => $this->input->post('km_final'),
                	'extensao' => $this->input->post('extensao'),
                	'subtrecho' => $this->input->post('subtrecho'),
                 
                 */
                //if the insert has returned true then we show the flash message
             	$id_pas = $this->pasdao->store_pas($data_to_store);
                if($id_pas){
                    $data['flash_message'] = TRUE; 
                    if(!file_exists(PAS_FOLDER . $id_pas)){
                    	mkdir(PAS_FOLDER . $id_pas, 0777, true);
                    }
                    if(!file_exists(PAS_FOLDER . $id_pas.'/acompanhamento_fisico')){
                    	mkdir(PAS_FOLDER . $id_pas.'/acompanhamento_fisico', 0777, true);
                    }
                    if(!file_exists(PAS_FOLDER . $id_pas.'/documentos')){
                    	mkdir(PAS_FOLDER . $id_pas.'/documentos', 0777, true);
                    }
                    if(!file_exists(PAS_FOLDER . $id_pas.'/localizacao')){
                    	mkdir(PAS_FOLDER . $id_pas.'/localizacao', 0777, true);
                    }
                    if(!file_exists(PAS_FOLDER . $id_pas.'/img')){
                    	mkdir(PAS_FOLDER . $id_pas.'/img', 0777, true);
                    }
                    
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        
        $data = array_merge($data, $this->foreingControllersEdit());
        
        //load the view
        $data['main_content'] = 'admin/pas/add';
        $this->load->view('includes/template', $data);  
    }       
   	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));		
    			
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('ordem_servico', 'ordem_servico', '');
        	$this->form_validation->set_rules('id_responsavel', 'id_responsavel', 'required');
        	$this->form_validation->set_rules('id_pas_prazos', 'id_pas_prazos', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', '');        	
        	$this->form_validation->set_rules('lote', 'lote', 'required'); 
        	$this->form_validation->set_rules('status', 'status', '');
        	$this->form_validation->set_rules('id_contrato', 'id_contrato', '');
        	$this->form_validation->set_rules('data_ini_pas', 'data_ini_pas', ''); 
        	$this->form_validation->set_rules('data_ini_planejada', 'data_ini_planejada', '');
        	$this->form_validation->set_rules('id_local_execucao', 'id_local_execucao', '');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                		'ordem_servico' => $this->input->post('ordem_servico'),
                		'id_responsavel' => $this->input->post('id_responsavel'),
                		'id_pas_prazos' => $this->input->post('id_pas_prazos'),
                		'titulo' => $this->input->post('titulo'),
                		'lote' => $this->input->post('lote'),
                		'status' => $this->input->post('status'),
                		'id_contrato' => $this->input->post('id_contrato'),
                		'data_ini_pas' => $this->input->post('data_ini_pas'),
                		'data_ini_planejada' => $this->input->post('data_ini_planejada'),
                		'id_local_execucao' => $this->input->post('id_local_execucao'),
                		'descricao' => $this->input->post('descricao'),
                		'observacoes' => $this->input->post('observacoes')
                );
                
              
                //if the insert has returned true then we show the flash message
                if($this->pasdao->update_pas($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        
        //product data 
        $data['pas'] = $this->pasdao->get_pas_by_id($id);
        
        $data = array_merge($data, $this->foreingControllersEdit($id));
        
        //load the view
        $data['main_content'] = 'admin/pas/edit';
        $this->load->view('includes/template', $data);            

    }//update    			
       
    public function delete()
    {
        $data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));
    			
        $id = $this->uri->segment(4);
        $this->pasdao->delete_pas($id);
        redirect('admin/pas');
    }//edit
    
    public function foreingControllers(){
    	
    	$this->load->model('usuariosdao');
    	$responsavel = new usuariosdao();
    	$data['responsaveis'] = $responsavel->get_usuarios(null, 'nome');
    	
    	$this->load->model('local_execucaodao');
    	$localExecucao = new local_execucaodao();
    	$data['local_execucao'] = $localExecucao->get_local_execucao(null, 'titulo');
    	
    	// STATUS DAS FASES DO PAS
    	$this->load->model('statusdao');
    	$status = new statusdao();
    	$data['status'] = $status->get_status(null,'id');
    	
    	 
    	// AVALIACOES DAS FASES DO PAS
    	$this->load->model('avaliacoesdao');
    	$avaliacoes = new avaliacoesdao();
    	$data['avaliacoes'] = $avaliacoes->get_avaliacoes(null,'id');
    	
    	$this->load->model('prioridadesdao');
    	$prioridades = new prioridadesdao();
    	$data['prioridades'] = $prioridades->get_prioridades(null, 'peso', 'desc');
    	
    	return $data;
    }
   
    
    public function foreingControllersEdit($id = null){
    	 
    	$this->load->model('usuariosdao');
    	$responsavel = new usuariosdao();
    	$data['responsaveis'] = $responsavel->get_usuarios(null, 'nome');
    	 
    	// TRECHOS DO PAS
    	 
    	$this->load->model('contratosdao');
    	$contratos = new contratosdao();
    	$data['contratos'] = $contratos->get_contratos(null, 'titulo');
    	
    	
    	$this->load->model('pas_prazosdao');
    	$prazos = new pas_prazosdao();
    	$data['prazos'] = $prazos->get_pas_prazos(null, 'titulo');
    	
    
    	if($id){
    		$this->load->model('pas_trechosdao');
    		$trechos = new pas_trechosdao();
    		$data['trechos'] = $trechos->get_pas_trechos_by_id_pas($id);
    	}
    	 
    	$this->load->model('local_execucaodao');
    	$localExecucao = new local_execucaodao();
    	$data['local_execucao'] = $localExecucao->get_local_execucao(null, 'titulo');
    	 
    	
    	
    	return $data;
    }
    
    
    public function foreingControllersDetalhes($id, $data = null){

    	// DOCUMENTOS DO PAS
    	$this->load->model('pas_documentosdao');
    	$documentos = new pas_documentosdao();
    	$data['documentos'] = $documentos->get_pas_documentos_by_id_pas($id);

    	// TIPOS DE DOCUMENTOS DO PAS
    	$data['tipo_documentos'] = $documentos->get_tipos_documentos_by_pas_id($id);
    	
    	// TRECHOS DO PAS    	 
    	$this->load->model('pas_trechosdao');
    	$trechos = new pas_trechosdao();
    	$data['trechos'] = $trechos->get_pas_trechos_by_id_pas($id);
    	
    	$arrayCoordenadas = $trechos->get_pas_trechos_coordenadas_by_id_pas($id);
    	
    	if(!empty($arrayCoordenadas)){
    		if(!isset($data['coordenadas'])  ){
    			$data['coordenadas'] =  $arrayCoordenadas ;
    		}else{
    			$data['coordenadas']  = array_merge($data['coordenadas'] ,$arrayCoordenadas );
    		}
    	}
    	
    	// FASES DO PAS
    	$data['pas_fases'] = $this->pas_fasesdao->get_pas_fases_by_id_pas($id);
    
    	// MOVIMENTACAO DO DAS FASES DO PAS
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    	
    	// STATUS DAS FASES DO PAS
    	$this->load->model('statusdao');
    	$status = new statusdao();
    	$data['status'] = $status->get_status(null,'id');
    	
    	$status_option = array();
    	foreach($data['status'] as $rowStatus){
    		$status_option[$rowStatus['id']] = $rowStatus['titulo']; 
    	}
    	// AVALIACOES DAS FASES DO PAS
    	$this->load->model('avaliacoesdao');
    	$avaliacoes = new avaliacoesdao();
    	$data['avaliacoes'] = $avaliacoes->get_avaliacoes(null,'id');
    	    	
    	$i = 0;
    	
    	if(sizeof($data['pas_fases']) > 0){
	    	foreach($data['pas_fases'] as $row){
	    		
	    		$tmpArrayMov = $lastMov->get_first_movimentacao_by_id_pas_fases($row['id']);
	    		
	    		if((sizeof($tmpArrayMov) > 0 ) ){
	    			
	    			$data['pas_fases'][$i]['start_date']  = $tmpArrayMov[0];
	    			
	    			$tmpArrayMov = $lastMov->get_last_movimentacao_by_id_pas_fases($row['id']);
	    			
	    			
	    			if((sizeof($tmpArrayMov) > 0 )){
	    				$data['pas_fases'][$i]['lastmov']  =  $tmpArrayMov[0];
	    				//$string .= 'new Date('.date('Y,m,d', strtotime($tmpArrayMov[0]['data_protocolo'])).')],';
	    			}else{
	    				//$string .= 'new Date('.date('Y,m,d').')],';
	    				$data['pas_fases'][$i]['lastmov']  =   array();
	    			}
	    			
	    			
	    		}else{
	    			$data['pas_fases'][$i]['start_date']  = array();
	    			$data['pas_fases'][$i]['lastmov']  =  array();
	    		}
	    		
	    		
	    		$tmpArrayMov = $lastMov->get_last_avaliation_by_id_fases($row['id']);
	    		$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArrayMov) > 0 ) ? $tmpArrayMov[0] : array();
	    		
	    		if(sizeof($tmpArrayMov) > 0 ) {
	    			$data['pas_fases'][$i]['last_avaliation']  = $tmpArrayMov[0];
	    			$peso = ($tmpArrayMov[0]['peso']) ? $tmpArrayMov[0]['peso'] : 0;
	    		}else{
	    			$data['pas_fases'][$i]['last_avaliation']  = array();
	    			$peso = null;
	    		}
	    		
	    		$tmpArray[] = $this->get_progresso_by_pas_fase($row['id'], $peso);
	    		$data['pas_fases'][$i]['progresso'] = $tmpArray[$i];
	    		$i++;
	    	}
	    	
	    	$totalFases = sizeof($tmpArray) ;
	    	$progressoTotalSoma =  array_sum($tmpArray);
	    	
	    	 
	    	if($progressoTotalSoma AND $totalFases){
	    		$data['pas'][0]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
	    		 
	    		// verifica a data do primeiro movimento
	    		$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas_fases($id);
	    		$data['pas'][0]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
	    		 
	    		if($data['pas'][0]['progresso_total'] >= 100){
	    			// verifica a data do ultimo movimento
	    			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($id);
	    			$data['pas'][0]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
					//$this->debugMark('id '.$id, $arrayLastMov);
	    		}
	    		 
	    	}else{
	    		$data['pas'][0]['progresso_total'] = 0;
	    	}
	    	
	    	$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($id);
	    	
	    	$arrayDiasCorridos = sizeof($arrayDiasCorridos) > 0 ? $arrayDiasCorridos[0]['total_dias'] : 0;
	    	//echo 'dias corridos '.$arrayDiasCorridos;
	    	//echo '<br>';
	    	//echo 'data inicial edital '.$data['pas'][$i]['data_ini_pas'];
	    	$data_termino = new DateTime($data['pas'][0]['data_ini_pas']);
	    	//echo '<br>';
	    	$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
	    	$data['pas'][0]['data_fim_pas'] = $data_termino->format('Y-m-d');
	    	
    	}
     	
    	
    	$this->load->model('usuariosdao');
    	$responsavel = new usuariosdao();
    	$data['responsaveis'] = $responsavel->get_usuarios(); 
    	
    	$data['documentos_movimentacoes'] = $lastMov->get_list_documents_by_id_pas($id);
    	$data['tipo_documentos'] = array_merge($data['tipo_documentos'], $lastMov->get_tipo_list_documents_by_id_pas($id));
    	
    	$this->load->model('usuario_perfildao');
    	$userPerfil = new usuario_perfildao();
    	$data['usuario_perfil'] = $userPerfil->get_usuario_perfil();
    	
    	$this->load->model('prioridadesdao');
    	$prioridades = new prioridadesdao();
    	$data['prioridades'] = $prioridades->get_prioridades(null, 'peso', 'desc');
    	
    	$this->load->model('local_execucaodao');
    	$localExecucao = new local_execucaodao();
    	$data['local_execucao'] = $localExecucao->get_local_execucao(null, 'titulo');
    	
    	 
    	
    	unset($arrayCoordenadas);
    	unset($tmpArrayMov);
    	unset($tmpArray);
    
    	 	
    	 	
    	return $data;
    
    }
    
    public function foreingControllersAnalista(){
    	// STATUS DAS FASES DO PAS
    	$this->load->model('statusdao');
    	$status = new statusdao();
    	$data['status'] = $status->get_status(null,'id');
    	 
    	
    	// AVALIACOES DAS FASES DO PAS
    	$this->load->model('avaliacoesdao');
    	$avaliacoes = new avaliacoesdao();
    	$data['avaliacoes'] = $avaliacoes->get_avaliacoes(null,'id');
    	
    	$this->load->model('local_execucaodao');
    	$localExecucao = new local_execucaodao();
    	$data['local_execucao'] = $localExecucao->get_local_execucao(null, 'titulo');
    	
    	return $data;
    }
    
    public function foreingControllersContratos(){
    	
    	$this->load->model('contratosdao');
    	$contratos = new contratosdao();
    	$data['contratos'] =  $contratos->get_contratos();
    	
    	return $data;
    }
    
    public function detalhes()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    
    	$id = $this->uri->segment(4);
    	//$id_contrato = $this->uri->segment(4);
    	
    	//$this->pasdao->get_cronograma_atividade_by_pas($id);
    	
    	//$this->load->library('gcharts');
    	 
    	//product data
    	$data['pas'] = $this->pasdao->get_pas_by_id($id);
    	//$this->PAR($data);
    	
    	$data = array_merge($data, $this->foreingControllersDetalhes($id, $data));
    	
    	
        //$this->debugMark('Detalhes', $data);
    	//$this->PAR($data);
    	//die;
    	
    	//load the view
    	$data['main_content'] = 'admin/pas/detalhes';
    	$this->load->view('includes/template', $data);
    
    }
    
    public function analista(){
    	
    	// O SISTEMA IDENTIFICA O TIPO DE USUÁRIO E USA ESSES DADOS PARA ACESSAR A ÁREA ESPECIFICA DELE
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data['id_responsavel'] = $this->session->userdata('id');
    	//$this->debugMark('Chegou Aqui', $data);
    	$this->load->model('pas_trechosdao');
    	
    	$data['pas'] = $this->pasdao->get_pas_by_id_responsavel($data['id_responsavel']);
    	
    	$i = 0;
    	$tmpArray = array();
    	$tmpFaseArray = array();
    	
    	foreach($data['pas'] as $item){
    		$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
    		$tmpArray = array();
    		foreach($tmpFaseArray as $row){
    			// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
    			$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
    		}
    	
    		$progressoTotalSoma =  array_sum($tmpArray);    		
    		$totalFases = sizeof($tmpArray) ;
    	
    		 
    		if($progressoTotalSoma AND $totalFases){
    			$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
    	
    			// verifica a data do primeiro movimento
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    	
    			$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    	
    			if($data['pas'][$i]['progresso_total'] >= 100){
    				// verifica a data do ultimo movimento
    				$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
    				$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
    			}
    	
    		}else{
    			$data['pas'][$i]['progresso_total'] = 0;
    		}
    		 
    		
    		$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_label_by_id_pas($item['id']);
    		if(sizeof($arrayTrechos) > 0){
        		$firstTrecho = true;
        		$labelTrecho = '';
        		$ext = 0;
        		foreach($arrayTrechos as $rowTrecho){
        			if($firstTrecho){
        				$firstTrecho = false;
        				$labelTrecho = 'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}else{
        				$labelTrecho .= ' e '.'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}
        			$ext += $rowTrecho['extensao'];
        		}
        		$data['pas'][$i]['trechos'] = $labelTrecho;
        		$data['pas'][$i]['extensao'] = $ext;
        		
        	}else{
        		$data['pas'][$i]['trechos'] = ' --- ';
        		$data['pas'][$i]['extensao'] = 'Não Disponível';
        	}
    	
    		$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
    		
    		$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
    		
    		$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
    		 
    		// PARA DATA PLANEJADA DE ACORDO COM O CRONOGRAMA
        	//$data_termino = new DateTime($data['pas'][$i]['data_ini_planejada']);
        	//$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	
        	$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
        	//$this->debugMark('data fim plan',$tmpLastDataPlan );
        	$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
    		 
    		//echo '<br>';
    		$i++;
    		 
    	}	
    	//$this->debugMark("Pas Fases", $data['pas'] );
    	
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_responsavel($data['id_responsavel'] );
    	//$this->debugMark("Mark", $data['pas_fases'] );
    	
    	$this->load->model('pas_fases_movimentacaodao');    	
    	$lastMov = new pas_fases_movimentacaodao();
    	 
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    	
    		$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
    		$tmpArray = $lastMov->get_all_movimentacao_by_id_pas_fases($item['id']);
    		//$data['pas_fases'][$i]['lastmov']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    		// $data['usuarioPerfil']['id_perfil']
    		
    		//$this->debugMark("Mark", $tmpArray);
    		// SELETOR DE DADOS DO PERFIL
    		if(sizeof($tmpArray) > 0 AND $tmpArray[0]['id_usuario_perfil'] == $data['usuarioPerfil']['id_perfil']){
    			
    			$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    			$data['pas_fases'][$i]['beforeLastMov']  = (isset($tmpArray[1])) ? $tmpArray[1]['id'] : $tmpArray[0]['id'];
    			$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    			
    			if($data['pas_fases'][$i]['progresso']  >= 100 ){
    				unset($data['pas_fases'][$i]);
    			}else{
    				$tmpArray = end($tmpArray);
    				//$this->debugMark($tmpArray['data_protocolo'],$tmpArray);
    				$data['pas_fases'][$i]['start_date']  = $tmpArray['data_protocolo'];
    				$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    				$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    				
    			}
    			
    		}else{
    			unset($data['pas_fases'][$i]);
    		}
    		
    		$i++;
    	
    		
    	}

    	//$this->debugMark("Pas Fases", $data['pas_fases'] );
    	
    	unset($tmpArray);
    	unset($tmpFaseArray);
    	
    	$data = array_merge($data, $this->foreingControllersAnalista());
    	$data = array_merge($data, $this->foreingControllersContratos());
    	
    	
    	$data['main_content'] = 'admin/pas/'.__FUNCTION__;
        $this->load->view('includes/template', $data);  
    }
    
    public function gerente(){
    	 
    	// O SISTEMA IDENTIFICA O TIPO DE USUÁRIO E USA ESSES DADOS PARA ACESSAR A ÁREA ESPECIFICA DELE
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data['pas'] = $this->pasdao->get_pas('', 'lote' );
         
        $this->load->model('pas_trechosdao');
        
        
        $i = 0;
        $tmpArray = array();
        $tmpFaseArray = array();
        
        //$pasFases = new pas_fases();
        // GET ALL DATA TO POPULATE CRONOGRAMA
        foreach($data['pas'] as $item){
        	$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
        	$tmpArray = array();
        	foreach($tmpFaseArray as $row){
        		// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
        		$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
        	}
        	//echo '<br>';
        	$progressoTotalSoma =  array_sum($tmpArray);
        	//echo '<br>';
        	$totalFases = sizeof($tmpArray) ;
        	//echo '<br>';
        	//$this->PAR($tmpArray);
        	
        	if($progressoTotalSoma AND $totalFases){
        		$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
        		
        		// verifica a data do primeiro movimento
        		$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
        		
        		$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
        		
        		if($data['pas'][$i]['progresso_total'] >= 100){
        			// verifica a data do ultimo movimento
        			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);        			
        			$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
        		}
        		
        	}else{
        		$data['pas'][$i]['progresso_total'] = 0;
        	}
        	
        	
        	$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_label_by_id_pas($item['id']);
        	if(sizeof($arrayTrechos) > 0){
        		$firstTrecho = true;
        		$labelTrecho = '';
        		$ext = 0;
        		foreach($arrayTrechos as $rowTrecho){
        			if($firstTrecho){
        				$firstTrecho = false;
        				$labelTrecho = 'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}else{
        				$labelTrecho .= ' e '.'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}
        			$ext += $rowTrecho['extensao'];
        		}
        		$data['pas'][$i]['trechos'] = $labelTrecho;
        		$data['pas'][$i]['extensao'] = $ext;
        		
        	}else{
        		$data['pas'][$i]['trechos'] = ' --- ';
        		$data['pas'][$i]['extensao'] = 'Não Disponível';
        	}
        	 
        	
        	$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
       
        	$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
        	
        	$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
        	$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
        	
        	$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
        	//$this->debugMark('data fim plan',$tmpLastDataPlan );
        	$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
        	
        	//echo '<br>';
        	$i++; 
        	
        	
        }
        
        unset($tmpArray);
        unset($tmpFaseArray);
        
        $data['id_responsavel'] = $this->session->userdata('id');
        $data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_localizacao();
        //$this->debugMark( $data['usuarioPerfil']['id_perfil']);
        
        
        $this->load->model('pas_fases_movimentacaodao');
        $lastMov = new pas_fases_movimentacaodao();
        
        $i = 0;
        foreach($data['pas_fases'] as $item){
        
        	$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
        	//$this->debugMark("Pas Fases", $data['pas_fases'] );
        	
        	if(sizeof($tmpArray) > 0 AND $tmpArray[0]['id_usuario_perfil'] >= 3){
        		 
        		$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
        		$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
        		 
        		if($data['pas_fases'][$i]['progresso']  >= 100 ){
        			unset($data['pas_fases'][$i]);
        		}else{
        			$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);
        			$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
        
        			$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
        			$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
        
        		}
        		 
        	}else{
        		unset($data['pas_fases'][$i]);
        	}
        
        	$i++;
        
        }
        
        $pasFasesTmp = array();
        
        foreach($data['pas_fases'] as $item){
        	$pasFasesTmp[$item['local_execucao']][$item['id_responsavel']][] = $item;
        }
        
        $data['pas_fases'] = $pasFasesTmp;
        
        //$this->debugMark("Pas Fases", $data['pas_fases']);
         
        unset($tmpArray);
        unset($tmpFaseArray);
        
        
        $data = array_merge($data, $this->foreingControllers());
        $data = array_merge($data, $this->foreingControllersContratos());
        
        $data['main_content'] = 'admin/pas/'.__FUNCTION__;
        $this->load->view('includes/template', $data);
    	 
    }
    
    public function contratada(){
    	 
    	// O SISTEMA IDENTIFICA O TIPO DE USUÁRIO E USA ESSES DADOS PARA ACESSAR A ÁREA ESPECIFICA DELE
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data['id_responsavel'] = $this->session->userdata('id');
    	//$this->debugMark('Chegou Aqui', $data);
    	$this->load->model('pas_trechosdao');
    	
    	$this->load->model('usuarios_contratosdao');
    	$usuarioContrato =  new usuarios_contratosdao();
    	$arrayTemContrato = $usuarioContrato->get_usuarios_contratos_by_id_usuario($data['id_responsavel']);
    	
    	$data['pas'] = $this->pasdao->get_pas_by_contrato($arrayTemContrato);
    	
    	//$this->debugMark('teset', $data['pas']);
    	$i = 0;
    	$tmpArray = array();
    	$tmpFaseArray = array();
    	
    	foreach($data['pas'] as $item){
    		$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
    		$tmpArray = array();
    		foreach($tmpFaseArray as $row){
    			// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
    			$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
    		}
    	
    		$progressoTotalSoma =  array_sum($tmpArray);    		
    		$totalFases = sizeof($tmpArray) ;
    		
    		if($progressoTotalSoma AND $totalFases){
    			$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
    	
    			// verifica a data do primeiro movimento
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    	
    			$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    	
    			if($data['pas'][$i]['progresso_total'] >= 100){
    				// verifica a data do ultimo movimento
    				$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
    				$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
    			}
    	
    		}else{
    			$data['pas'][$i]['progresso_total'] = 0;
    			
    		}
    		 
    		
    		$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_label_by_id_pas($item['id']);
    		if(sizeof($arrayTrechos) > 0){
        		$firstTrecho = true;
        		$labelTrecho = '';
        		$ext = 0;
        		foreach($arrayTrechos as $rowTrecho){
        			if($firstTrecho){
        				$firstTrecho = false;
        				$labelTrecho = 'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}else{
        				$labelTrecho .= ' e '.'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}
        			$ext += $rowTrecho['extensao'];
        		}
        		$data['pas'][$i]['trechos'] = $labelTrecho;
        		$data['pas'][$i]['extensao'] = $ext;
        		
        	}else{
        		$data['pas'][$i]['trechos'] = ' --- ';
        		$data['pas'][$i]['extensao'] = 'Não Disponível';
        	}
    	
    		$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
    		
    		$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
    		
    		$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
    		 
    		// PARA DATA PLANEJADA DE ACORDO COM O CRONOGRAMA
        	//$data_termino = new DateTime($data['pas'][$i]['data_ini_planejada']);
        	//$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	
        	$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
        	//$this->debugMark('data fim plan',$tmpLastDataPlan );
        	$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
    		 
    		//echo '<br>';
    		$i++;
    		 
    	}	

    	// TESTAR VALIDADE DISSO
    	// UNSET PROGRESSO 0 
    	
    	$i=0;
    	foreach($data['pas'] as $item){
    		if($item['progresso_total']  === 0){
    			//echo $data['pas'][$i]['id'].' '.$item['progresso_total'] ;
    			//echo '<br>';
    			unset($data['pas'][$i]);
    		}
    		$i++;
    	}
    	$data['pas'] = array_values($data['pas']);
    	//$this->debugMark("Pas", $data['pas'] );
    	
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$this->load->model('pas_fasesdao');
    	$pasFases = new pas_fasesdao();
    	
    	$data['pas_fases']  = $pasFases->get_pas_fases_by_contrato($arrayTemContrato);
    	//$this->debugMark("Mark", $data['pas_fases'] );
    	
    	$this->load->model('pas_fases_movimentacaodao');    	
    	$lastMov = new pas_fases_movimentacaodao();
    	 
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    	
    		$tmpArray = $lastMov->get_all_movimentacao_by_id_pas_fases($item['id']);
    		//$tmpArray = end($tmpArray);
    		//$this->debugMark($tmpArray['data_protocolo'],$tmpArray);
    		//$this->debugMark('test',$tmpArray);
    		//$data['pas_fases'][$i]['lastmov']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    		// $data['usuarioPerfil']['id_perfil']
    		
    		//$this->debugMark("Mark", $tmpArray);
    		if(sizeof($tmpArray) > 0 AND $tmpArray[0]['id_usuario_perfil'] == $data['usuarioPerfil']['id_perfil']){
    			$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    			$data['pas_fases'][$i]['beforeLastMov']  = (isset($tmpArray[1])) ? $tmpArray[1]['id'] : $tmpArray[0]['id'];
    			
    			$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    			if($data['pas_fases'][$i]['progresso']  >= 100 ){
    				unset($data['pas_fases'][$i]);
    			}else{
    				$tmpArray = end($tmpArray);
    				//$this->debugMark($tmpArray['data_protocolo'],$tmpArray);
    				$data['pas_fases'][$i]['start_date']  = $tmpArray['data_protocolo'];
    				$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    				$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    			}
    			
    		}else{
    			unset($data['pas_fases'][$i]);
    		}
    	
    		$i++;
    	
    	}
       //$this->debugMark("Pas Fases", $data['pas_fases'] );
    	
    	// UNSET AREA
    	unset($tmpArray);
    	unset($tmpFaseArray);
    	
    	$data = array_merge($data, $this->foreingControllersAnalista());
    	$data = array_merge($data, $this->foreingControllersContratos());
    	
    	$data['main_content'] = 'admin/pas/'.__FUNCTION__;
        $this->load->view('includes/template', $data);  
    }
    
    public function convidado(){
    
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        $data['pas'] = $this->pasdao->get_pas('', '');
        
        $this->load->model('pas_trechosdao');
        
        $i = 0;
        $tmpArray = array();
        $tmpFaseArray = array();
        
        //$pasFases = new pas_fases();
        // GET ALL DATA TO POPULATE CRONOGRAMA
        foreach($data['pas'] as $item){
        	$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
        	$tmpArray = array();
        	foreach($tmpFaseArray as $row){
        		// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
        		$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
        	}
        	//echo '<br>';
        	$progressoTotalSoma =  array_sum($tmpArray);
        	//echo '<br>';
        	$totalFases = sizeof($tmpArray) ;
        	//echo '<br>';
        	//$this->PAR($tmpArray);
        	
        	if($progressoTotalSoma AND $totalFases){
        		$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
        		
        		// verifica a data do primeiro movimento
        		$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
        		
        		$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
        		
        		if($data['pas'][$i]['progresso_total'] >= 100){
        			// verifica a data do ultimo movimento
        			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);        			
        			$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
        		}
        		
        	}else{
        		$data['pas'][$i]['progresso_total'] = 0;
        	}
        	
        	
        	$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_label_by_id_pas($item['id']);
        	if(sizeof($arrayTrechos) > 0){
        		$firstTrecho = true;
        		$labelTrecho = '';
        		$ext = 0;
        		foreach($arrayTrechos as $rowTrecho){
        			if($firstTrecho){
        				$firstTrecho = false;
        				$labelTrecho = 'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}else{
        				$labelTrecho .= ' e '.'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
        			}
        			$ext += $rowTrecho['extensao'];
        		}
        		$data['pas'][$i]['trechos'] = $labelTrecho;
        		$data['pas'][$i]['extensao'] = $ext;
        		
        	}else{
        		$data['pas'][$i]['trechos'] = ' --- ';
        		$data['pas'][$i]['extensao'] = 'Não Disponível';
        	}
        	 
        	
        	/*
        	$arrayCoordenadas = $this->pas_trechosdao->get_pas_trechos_coordenadas_by_id_pas($item['id']);
        	
        	if(!empty($arrayCoordenadas)){
        		if(!isset($data['coordenadas'])  ){
	        		$data['coordenadas'] =  $arrayCoordenadas ;
	        	}else{
	        		$data['coordenadas']  = array_merge($data['coordenadas'] ,$arrayCoordenadas );
	        	}
        	}
        	
        	*/
        	//$this->PAR($data['coordenadas']);
        	
        	
        	$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
        	//$this->PAR($arrayDiasCorridos);
        	$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
        	
        	//echo 'dias corridos '.$arrayDiasCorridos;
        	//echo '<br>';
        	//echo 'data inicial edital '.$data['pas'][$i]['data_ini_pas'];
        	
        	$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
        	$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
        	
        	// PARA DATA PLANEJADA DE ACORDO COM O CRONOGRAMA
        	//$data_termino = new DateTime($data['pas'][$i]['data_ini_planejada']);
        	//$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	
        	$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
        	//$this->debugMark('data fim plan',$tmpLastDataPlan );
        	$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
        	
        	//echo '<br>';
        	$i++; 
        	
        	
        }
       
        $data = array_merge($data, $this->foreingControllers());
        $data = array_merge($data, $this->foreingControllersContratos());
    
    	$data['main_content'] = 'admin/pas/list';
    	$this->load->view('includes/template', $data);
    }
    
    public function relatorios(){
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	
    	$data['main_content'] = 'portal/gestao_estudos_projetos/relatorios';
    	$this->load->view('includes/portal_template', $data);
    }
    
    public function edit_table_pendencias(){
    
    	header('Content-type: application/json');
    	//$teste = json_decode($data);
    
    	$id 	= $this->input->post('id');
    	$value = $this->input->post('value');
    	$name 	= $this->input->post('name');
    
    	$arrayRules = array(
    			'id' 				=> 'required|numeric',
    			'id_prioridade' 	=> 	'required'
    	);
    
    	$this->form_validation->set_rules('id', 'id', $arrayRules['id']);
    	$this->form_validation->set_rules('value', 'value', $arrayRules[$name]);
    
    	if ($this->form_validation->run()){
    
    		$data_to_store = array(
    				$name => $value
    		);
    
    		//$this->debugMark('Edit',$data_to_store );
    		// EDITAR PENDENCIAS DO PAS
    		if($this->pas_fasesdao->update_pas_fases($id, $data_to_store) == TRUE){
    			//$this->session->set_flashdata('flash_message', 'updated');
    			return true;
    		}else{
    			return false;
    			//$this->session->set_flashdata('flash_message', 'not_updated');
    		}
    	}
    
    }
    
    function get_location_list($arrayData, $link_area = null, $kmz_id = false){
    	 
    	$config['center'] = '-15.78, -53';
    	$config['zoom'] = '4';
    	$config['map_height'] = 537;
    	/*
    	 ESTQ-KML-BR423_PE(LT01)-V01.KMZ
    
    	$config['kmlLayerURL'] = array('http://kml-samples.googlecode.com/svn/trunk/kml/Placemark/placemark.kml',
    			'http://www.sgplan.engenharia.ws/assets/anteprojetos/2/localizacao/2.kml');
    	$config['kmlLayerPreserveViewport'] = FALSE;
    	 
    	$config['kmlLayerURL'] = 'www.google.com.br/maps/dir/Ribeir%C3%A3o+Cascalheira/Vila+Rica/@-12.4311298,-51.8825712,767090m/data=!3m1!1e3!4m13!4m12!1m5!1m1!1s0x93133b1a1676501d:0x3d98e5626a9d5e30!2m2!1d-51.8248805!2d-12.9371655!1m5!1m1!1s0x93197640598dceff:0x5328f495a40ed6b4!2m2!1d-51.1190487!2d-10.0140784';
    	*/
    	 
    	if($kmz_id){
    		//$kmz_id = 2;
    		$config['kmlLayerURL'] = array(
    				 LOCATION_ADDRESS . 'assets/gestao_estudos_projetos/pas/'.$kmz_id.'/localizacao/'.$kmz_id.'.kmz',
    				 LOCATION_ADDRESS . 'assets/gestao_estudos_projetos/pas/'.$kmz_id.'/localizacao/'.$kmz_id.'.kml',
    		);
    		//$this->PAR($config['kmlLayerURL']);
    	}
    	 
    	//$this->PAR($config['kmlLayerURL']);
    	//DIE;
    	$this->googlemaps->initialize($config);
    	 
    	 
    	 
    	$marker = array();
    	 
    	 
    	if($link_area == null){
    		$link = 'admin/pas/detalhes/';
    
    	}else{
    		$link = $link_area;
    
    	}
    	 
    	foreach($arrayData as $item){
    
    		$marker['position'] = $item['lat'].','. $item['lon'];
    		$marker['onclick'] = 'window.location.href = "'.base_url().$link.$item['id'].'";';
    		$marker['animation'] = 'DROP';
    		$marker['title'] = $item['titulo'];
    		$marker['icon'] ='https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=P|A00000|FFFFFF';
    		$this->googlemaps->add_marker($marker);
    	}
    	 
    	return  $this->googlemaps->create_map();
    }
    
    public function add_img()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    
    		$fileName = $_FILES["file"]["name"];
    		$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    			
    
    		$uploadOk = 1;
    		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    		 
    		// Check if $uploadOk is set to 0 by an error
    		 
    		if ($uploadOk == 0 or $fileName == '') {
    			$data['flash_message'] = FALSE;
    		}
    		else if( $fileType == 'jpg' or $fileType == 'jpeg' or $fileType == 'JPEG' or $fileType == 'JPG'){
    			 
    			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    				 
    				$titulo = 'cronograma.jpg';
    				 
    				$file_out = PAS_FOLDER .$titulo;
    				 
    				if(file_exists($file_out)){
    					unlink($file_out);
    				}
    				 
    				copy ( $target_file , $file_out);
    				unlink($target_file);
    				$data['flash_message'] = TRUE;
    				 
    			}
    			 
    		}else {
    
    			$data['flash_message'] = FALSE;
    
    		}
    
    	}
    
    
    
    	//load the view
    	$data['main_content'] = 'admin/pas/add_img';
    	$this->load->view('includes/template', $data);
    }
   
   
    public function get_pas_event_by_id($id){
    	 
    	header('Content-type: application/json');
    	// MONTA UM HISTÓRICO AO LONGO DO TEMPO APENAS DO PRODUTO 
    	$data = array();
    	 
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_pas($id);
    	//$this->debugMark("Mark", $data['pas_fases'] );
    
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    	 
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    		 
    		$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
    
    		if(sizeof($tmpArray) > 0 ){
    
    			$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    			$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    			 
    			$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);
    			$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    			 
    			$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    			$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    			 
    		}
    		 
    		$i++;
    		 
    	}
    	 
    	//$this->debugMark('PAS Fases', $data['pas_fases']);
    
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
    	foreach($data['pas_fases'] as $row){
    
    		// DATAS ENVOLVIDAS
    		$dataIniPlan = strtotime($row['data_ini_planejada']);
    		$dataFimPlan = strtotime($row['data_fim_planejada']);
    		$diaAtual 	 = strtotime(date('Y-m-d'));
    
    		// PRODUTO FINALIZADO
    		if(isset($row['progresso'])){
    			$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
    			 
    			if($row['progresso'] >= 100){
    
    				if( $lastMov > strtotime($row['data_fim_planejada'])){
    					$class = 'event-warning';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue fora do Prazo';
    				}else{
    					$class = 'event-success';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue no Prazo';
    				}
    				 
    				// PRODUTO EM ANDAMENTO
    			}else{
    				// SELECIONAR A CLASSE PARA APRESENTAR NA AGENDA
    
    				if($dataFimPlan > $diaAtual ){
    					$class = 'event-info';
    					$mensAdditional = 'Não Finalizado, ainda no Prazo';
    				}else{
    					$class = 'event-important';
    					$mensAdditional = 'Não Finalizado, fora do Prazo';
    				}
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    
    			}
    			 
    		}else{
    			 
    			if($dataIniPlan > $diaAtual ){
    				$class = 'event-special';
    				$mensAdditional = 'Não Iniciado, no prazo.';
    				$dataIni = $diaAtual;
    				$dataEnd = $diaAtual;
    					
    			}else if($dataIniPlan < $diaAtual AND $diaAtual < $dataFimPlan ){
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, ainda prazo.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}else{
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, fora do prazo';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}
    		}
    
    
    		$out[] = array(
    				"id" 	=> $row['id'],
    				"title" => $row['fases'] . ' (Lote '. $row['lote'].') '.$mensAdditional ,
    				"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    				"class" => $class ,
    				"start" => $dataIni . '000',
    				"end" 	=> $dataEnd  . '000');
    
    	}
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    
    public function get_pas_planejamento_by_id($id){
    
    	header('Content-type: application/json');
    	// MONTA UM HISTÓRICO AO LONGO DO TEMPO APENAS DO PRODUTO
    	$data = array();
    
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_pas($id);
    	//$this->debugMark("Mark", $data['pas_fases'] );
    
    	//$this->debugMark(null, $data['pas_fases']);
    	
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    		 
    		$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
    
    		if(sizeof($tmpArray) > 0 ){
    
    			$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    			$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    
    			$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);
    			$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    
    			$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    			$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    
    		}
    		 
    		$i++;
    		 
    	}
    
    	//$this->debugMark('PAS Fases', $data['pas_fases']);
    
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
    	
    	//$this->debugMark(null, $data['pas_fases']);
    	
    	foreach($data['pas_fases'] as $row){
    
    		// DATAS ENVOLVIDAS
    		$dataFimPlan = strtotime($row['data_fim_planejada']);
    		$diaAtual 	 = strtotime(date('Y-m-d'));
    		
    		$diffDays = $this->diff_date($dataFimPlan,$diaAtual);
    
    		// PRODUTO FINALIZADO
    		if(isset($row['progresso'])){
    			if($row['progresso']){
    				$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
    				$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' '.$row['lastmov']['status'].' '.$row['progresso'].'%';
    			}else{
    				$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
    			}
    			
    		}else{
    			$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
    		}
    		
    		
    		
    		if($dataFimPlan >= $diaAtual ){
    					
    			if($diffDays <= 10){
    				$class = 'event-warning';
    			}else{
    				$class = 'event-info';
    			}
    					
    		}else{
    			$class = 'event-important';
    		}
    		
    		$dataIni = $dataFimPlan;
    		$dataEnd = $dataFimPlan;
    		
    			    
    
    		$out[] = array(
    				"id" 	=> $row['id'],
    				"title" => $mensAdditional ,
    				"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    				"class" => $class ,
    				"start" => $dataIni . '000',
    				"end" 	=> $dataEnd  . '000');
    
    	}
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    public function get_pas_planejamento_all_lotes(){
    
    	header('Content-type: application/json');
    	// MONTA UM HISTÓRICO AO LONGO DO TEMPO APENAS DO PRODUTO
    	$data = array();
    	
    	$out = array();
    	
    	$this->load->model('pas_fases_movimentacaodao');
    
    	$data['pas'] = $this->pasdao->get_pas(null, 'id');
    	
    	foreach($data['pas'] as $itemPas){
    		
    		if(!isset($itemPas['id'])){
    			break;
    		}
    		
    		$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_pas($itemPas['id']);
    		 
    		$i = 0;
    		foreach($data['pas_fases'] as $item){
    			 
    			$tmpArray = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas_fases($item['id']);
    			
    			//$this->debugMark(null, $tmpArray);
    			
    			if(sizeof($tmpArray) > 0 ){
    		
    				$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    				$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    		
    				$tmpArray = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas_fases($item['id']);
    				$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    		
    				$tmpArray = $this->pas_fases_movimentacaodao->get_last_avaliation_by_id_fases($item['id']);
    				$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    		
    			}
    			 
    			$i++;
    			 
    		}
    		
    		//$this->debugMark('PAS Fases', $data['pas_fases']);
    		
    		$arrayClass = array(	'event-success',
    				'event-important',
    				'event-warning',
    				'event-info',
    				'event-inverse',
    				'event-special',
    				''
    		);
    		
    		//$this->debugMark(null, $data['pas_fases']);
    		
    		foreach($data['pas_fases'] as $row){
    		
    			// DATAS ENVOLVIDAS
    			$dataFimPlan = strtotime($row['data_fim_planejada']);
    			$diaAtual 	 = strtotime(date('Y-m-d'));
    		
    			$diffDays = $this->diff_date($dataFimPlan,$diaAtual);
    		
    			// PRODUTO FINALIZADO
	    		if(isset($row['progresso'])){
	    			if($row['progresso']){
	    				$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
	    				$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' '.$row['lastmov']['status'].' '.$row['progresso'].'%';
	    			}else{
	    				$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
	    			}
	    			
	    		}else{
	    			$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
	    		}
    		
    		
    		
    			if($dataFimPlan >= $diaAtual ){
    		
    				if($diffDays <= 10){
    					$class = 'event-warning';
    				}else{
    					$class = 'event-info';
    				}
    		
    			}else{
    				$class = 'event-important';
    			}
    		
    			$dataIni = $dataFimPlan;
    			$dataEnd = $dataFimPlan;
    		
    			 
    		
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $mensAdditional ,
    					"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    					"class" => $class ,
    					"start" => $dataIni . '000',
    					"end" 	=> $dataEnd  . '000');
    		
    		}
    		
    	}
    	
    	
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    public function get_pas_planejamento_by_id_contrato($id_contrato){
    
    	header('Content-type: application/json');
    	// MONTA UM HISTÓRICO AO LONGO DO TEMPO APENAS DO PRODUTO
    	$data = array();
    	 
    	$out = array();
    	 
    	$this->load->model('pas_fases_movimentacaodao');
    
    	$data['pas'] = $this->pasdao->get_pas_by_id_contrato($id_contrato);
    	 
    	foreach($data['pas'] as $itemPas){
    
    		if(!isset($itemPas['id'])){
    			break;
    		}
    
    		$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_pas($itemPas['id']);
    		 
    		$i = 0;
    		foreach($data['pas_fases'] as $item){
    
    			$tmpArray = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas_fases($item['id']);
    			 
    			//$this->debugMark(null, $tmpArray);
    			 
    			if(sizeof($tmpArray) > 0 ){
    
    				$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    				$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    
    				$tmpArray = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas_fases($item['id']);
    				$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    
    				$tmpArray = $this->pas_fases_movimentacaodao->get_last_avaliation_by_id_fases($item['id']);
    				$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    
    			}
    
    			$i++;
    
    		}
    
    		//$this->debugMark('PAS Fases', $data['pas_fases']);
    
    		$arrayClass = array(	'event-success',
    				'event-important',
    				'event-warning',
    				'event-info',
    				'event-inverse',
    				'event-special',
    				''
    		);
    
    		//$this->debugMark(null, $data['pas_fases']);
    
    		foreach($data['pas_fases'] as $row){
    
    			// DATAS ENVOLVIDAS
    			$dataFimPlan = strtotime($row['data_fim_planejada']);
    			$diaAtual 	 = strtotime(date('Y-m-d'));
    
    			$diffDays = $this->diff_date($dataFimPlan,$diaAtual);
    
    			// PRODUTO FINALIZADO
    			if(isset($row['progresso'])){
    				if($row['progresso']){
    					$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
    					$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' '.$row['lastmov']['status'].' '.$row['progresso'].'%';
    				}else{
    					$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
    				}
    
    			}else{
    				$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
    			}
    
    
    
    			if($dataFimPlan >= $diaAtual ){
    
    				if($diffDays <= 10){
    					$class = 'event-warning';
    				}else{
    					$class = 'event-info';
    				}
    
    			}else{
    				$class = 'event-important';
    			}
    
    			$dataIni = $dataFimPlan;
    			$dataEnd = $dataFimPlan;
    
    
    
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $mensAdditional ,
    					"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    					"class" => $class ,
    					"start" => $dataIni . '000',
    					"end" 	=> $dataEnd  . '000');
    
    		}
    
    	}
    	 
    	 
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    
    public function get_pas_planejamento_all_lotes_by_contratos(){
    	
    	header('Content-type: application/json');
    	// MONTA UM HISTÓRICO AO LONGO DO TEMPO APENAS DO PRODUTO
    	$data = array();
    	
    	$out = array();
    	
    	$this->load->model('pas_fases_movimentacaodao');
    	
    	$i = 0;
    	$tmpArray = array();
    	$tmpFaseArray = array();
    	
    	$data['id_responsavel'] = $this->session->userdata('id');
    	
    	$this->load->model('usuarios_contratosdao');
    	$usuarioContrato =  new usuarios_contratosdao();
    	$arrayTemContrato = $usuarioContrato->get_usuarios_contratos_by_id_usuario($data['id_responsavel']);
    	
    	$data['pas'] = $this->pasdao->get_pas_by_contrato($arrayTemContrato);
    	
    	foreach($data['pas'] as $itemPas){
    		
    		if(!isset($itemPas['id'])){
    			break;
    		}
    		
    		$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_pas($itemPas['id']);
    		
    		$i = 0;
    		foreach($data['pas_fases'] as $item){
    			
    			$tmpArray = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas_fases($item['id']);
    			
    			//$this->debugMark(null, $tmpArray);
    			
    			if(sizeof($tmpArray) > 0 ){
    				
    				$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    				$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    				
    				$tmpArray = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas_fases($item['id']);
    				$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    				
    				$tmpArray = $this->pas_fases_movimentacaodao->get_last_avaliation_by_id_fases($item['id']);
    				$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    				
    			}
    			
    			$i++;
    			
    		}
    		
    		//$this->debugMark('PAS Fases', $data['pas_fases']);
    		
    		$arrayClass = array(	'event-success',
    				'event-important',
    				'event-warning',
    				'event-info',
    				'event-inverse',
    				'event-special',
    				''
    		);
    		
    		//$this->debugMark(null, $data['pas_fases']);
    		
    		foreach($data['pas_fases'] as $row){
    			
    			// DATAS ENVOLVIDAS
    			$dataFimPlan = strtotime($row['data_fim_planejada']);
    			$diaAtual 	 = strtotime(date('Y-m-d'));
    			
    			$diffDays = $this->diff_date($dataFimPlan,$diaAtual);
    			
    			// PRODUTO FINALIZADO
    			if(isset($row['progresso'])){
    				if($row['progresso']){
    					$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
    					$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' '.$row['lastmov']['status'].' '.$row['progresso'].'%';
    				}else{
    					$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
    				}
    				
    			}else{
    				$mensAdditional = 'Lote '.$row['lote'].' '.$row['fases'].' ainda não inicializado.';
    			}
    			
    			
    			
    			if($dataFimPlan >= $diaAtual ){
    				
    				if($diffDays <= 10){
    					$class = 'event-warning';
    				}else{
    					$class = 'event-info';
    				}
    				
    			}else{
    				$class = 'event-important';
    			}
    			
    			$dataIni = $dataFimPlan;
    			$dataEnd = $dataFimPlan;
    			
    			
    			
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $mensAdditional ,
    					"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    					"class" => $class ,
    					"start" => $dataIni . '000',
    					"end" 	=> $dataEnd  . '000');
    			
    		}
    		
    	}
    	
    	
    	
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    	
    }
    
    /*
     *  Coleta os eventos do pas para preenchimento da agenda do analista
     *  a nivel de produtos
     */
    public function get_pas_all_events_analista(){
    
    	header('Content-type: application/json');
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data['id_responsavel'] = $this->session->userdata('id');
    	
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_responsavel($data['id_responsavel'] );
    	//$this->debugMark("Mark", $data['pas_fases'] );
    	 
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    	
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    		 
    		$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
    		
    		if(sizeof($tmpArray) > 0 ){
    			 
    			$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    			$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    			
    			$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);
    			$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    	
    			$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    			$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    	
    		}	
    		 
    		$i++;
    		 
    	}
    	
    	//$this->debugMark('PAS Fases', $data['pas_fases']);
    	 
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
    	foreach($data['pas_fases'] as $row){
    
    		// DATAS ENVOLVIDAS
    		$dataIniPlan = strtotime($row['data_ini_planejada']);
    		$dataFimPlan = strtotime($row['data_fim_planejada']);
    		$diaAtual 	 = strtotime(date('Y-m-d'));
    		
    		// PRODUTO FINALIZADO
    		if(isset($row['progresso'])){
    			$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
    			
    			if($row['progresso'] >= 100){ 
    				
    				if( $lastMov > strtotime($row['data_fim_planejada'])){
    					$class = 'event-warning';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue fora do Prazo';
    				}else{
    					$class = 'event-success';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue no Prazo';
    				}
    			
    				// PRODUTO EM ANDAMENTO
    			}else{
    				// SELECIONAR A CLASSE PARA APRESENTAR NA AGENDA
    				
    				if($dataFimPlan > $diaAtual ){
    					$class = 'event-info';
    					$mensAdditional = 'Não Finalizado, ainda no Prazo';
    				}else{
    					$class = 'event-important';
    					$mensAdditional = 'Não Finalizado, fora do Prazo';
    				}
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    				
    			}	 
    			
    		}else{
    			
    			if($dataIniPlan > $diaAtual ){
    				$class = 'event-special';
    				$mensAdditional = 'Não Iniciado, no prazo.';
    				$dataIni = $diaAtual;
    				$dataEnd = $diaAtual;
    					
    			}else if($dataIniPlan < $diaAtual AND $diaAtual < $dataFimPlan ){
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, ainda prazo.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}else{
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, fora do prazo';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}
    		}
    		
    		
    		$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['fases'] . ' (Lote '. $row['lote'].') '.$mensAdditional ,
    					"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    					"class" => $class ,
    					"start" => $dataIni . '000',
    					"end" 	=> $dataEnd  . '000');
    		
    	}
    	 
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    /*
     *  Coleta todos os eventos pas a nivel de produtos
     */
    public function get_pas_all_events(){
    
    	header('Content-type: application/json');
    	 
    	$data = array();
    	 
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_all();
    	//$this->debugMark("Mark", $data['pas_fases'] );
    
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    	 
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    		 
    		$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
    
    		if(sizeof($tmpArray) > 0 ){
    
    			$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    			$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    			 
    			$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);
    			$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    			 
    			$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    			$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    			 
    		}
    		 
    		$i++;
    		 
    	}
    	 
    	//$this->debugMark('PAS Fases', $data['pas_fases']);
    
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
    	foreach($data['pas_fases'] as $row){
    
    		// DATAS ENVOLVIDAS
    		$dataIniPlan = strtotime($row['data_ini_planejada']);
    		$dataFimPlan = strtotime($row['data_fim_planejada']);
    		$diaAtual 	 = strtotime(date('Y-m-d'));
    
    		// PRODUTO FINALIZADO
    		if(isset($row['progresso'])){
    			$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
    			 
    			if($row['progresso'] >= 100){
    
    				if( $lastMov > strtotime($row['data_fim_planejada'])){
    					$class = 'event-warning';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue fora do Prazo';
    				}else{
    					$class = 'event-success';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue no Prazo';
    				}
    				 
    				// PRODUTO EM ANDAMENTO
    			}else{
    				// SELECIONAR A CLASSE PARA APRESENTAR NA AGENDA
    
    				if($dataFimPlan > $diaAtual ){
    					$class = 'event-info';
    					$mensAdditional = 'Não Finalizado, ainda no Prazo';
    				}else{
    					$class = 'event-important';
    					$mensAdditional = 'Não Finalizado, fora do Prazo';
    				}
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    
    			}
    			 
    		}else{
    			 
    			if($dataIniPlan > $diaAtual ){
    				$class = 'event-special';
    				$mensAdditional = 'Não Iniciado, no prazo.';
    				$dataIni = $diaAtual;
    				$dataEnd = $diaAtual;
    					
    			}else if($dataIniPlan < $diaAtual AND $diaAtual < $dataFimPlan ){
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, ainda prazo.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}else{
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, fora do prazo';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}
    		}
    
    
    		$out[] = array(
    				"id" 	=> $row['id'],
    				"title" => $row['fases'] . ' (Lote '. $row['lote'].') '.$mensAdditional ,
    				"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    				"class" => $class ,
    				"start" => $dataIni . '000',
    				"end" 	=> $dataEnd  . '000');
    
    	}
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    public function get_pas_all_events_by_id_contrato($id_contrato){
    
    	header('Content-type: application/json');
    
    	$data = array();
    
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$data['pas_fases']  = $this->pas_fasesdao->get_pas_fases_by_id_contrato();
    	//$this->debugMark("Mark", $data['pas_fases'] );
    
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    		 
    		$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);
    
    		if(sizeof($tmpArray) > 0 ){
    
    			$data['pas_fases'][$i]['lastmov']  = $tmpArray[0];
    			$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id']);
    
    			$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);
    			$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    
    			$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    			$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    
    		}
    		 
    		$i++;
    		 
    	}
    
    	//$this->debugMark('PAS Fases', $data['pas_fases']);
    
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
    	foreach($data['pas_fases'] as $row){
    
    		// DATAS ENVOLVIDAS
    		$dataIniPlan = strtotime($row['data_ini_planejada']);
    		$dataFimPlan = strtotime($row['data_fim_planejada']);
    		$diaAtual 	 = strtotime(date('Y-m-d'));
    
    		// PRODUTO FINALIZADO
    		if(isset($row['progresso'])){
    			$lastMov 	 = strtotime($row['lastmov']['data_protocolo']);
    
    			if($row['progresso'] >= 100){
    
    				if( $lastMov > strtotime($row['data_fim_planejada'])){
    					$class = 'event-warning';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue fora do Prazo';
    				}else{
    					$class = 'event-success';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue no Prazo';
    				}
    					
    				// PRODUTO EM ANDAMENTO
    			}else{
    				// SELECIONAR A CLASSE PARA APRESENTAR NA AGENDA
    
    				if($dataFimPlan > $diaAtual ){
    					$class = 'event-info';
    					$mensAdditional = 'Não Finalizado, ainda no Prazo';
    				}else{
    					$class = 'event-important';
    					$mensAdditional = 'Não Finalizado, fora do Prazo';
    				}
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    
    			}
    
    		}else{
    
    			if($dataIniPlan > $diaAtual ){
    				$class = 'event-special';
    				$mensAdditional = 'Não Iniciado, no prazo.';
    				$dataIni = $diaAtual;
    				$dataEnd = $diaAtual;
    					
    			}else if($dataIniPlan < $diaAtual AND $diaAtual < $dataFimPlan ){
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, ainda prazo.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}else{
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, fora do prazo';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}
    		}
    
    
    		$out[] = array(
    				"id" 	=> $row['id'],
    				"title" => $row['fases'] . ' (Lote '. $row['lote'].') '.$mensAdditional ,
    				"url" 	=> base_url().'admin/pas/detalhes/'.$row['id_pas'],
    				"class" => $class ,
    				"start" => $dataIni . '000',
    				"end" 	=> $dataEnd  . '000');
    
    	}
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }

    
    public function get_pas_all_lote_events(){
    	
    	header('Content-type: application/json');
    	
    	$data = array();
    	
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$i = 0;
        $tmpArray = array();
        $tmpFaseArray = array();
        
        $data['pas'] = $this->pasdao->get_pas(null, 'lote');
        
        
        foreach($data['pas'] as $item){
        	$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
        	$tmpArray = array();
        	foreach($tmpFaseArray as $row){
        		// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
        		$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
        	}
        	//echo '<br>';
        	$progressoTotalSoma =  array_sum($tmpArray);
        	//echo '<br>';
        	$totalFases = sizeof($tmpArray) ;
        	//echo '<br>';
        	//$this->PAR($tmpArray);
        	
        	if($progressoTotalSoma AND $totalFases){
        		$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
        		
        		// verifica a data do primeiro movimento
        		$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
        		
        		$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
        		
        		if($data['pas'][$i]['progresso_total'] >= 100){
        			// verifica a data do ultimo movimento
        			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);        			
        			$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
        		}
        		
        	}else{
        		$data['pas'][$i]['progresso_total'] = 0;
        	}
        	
        	$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
        	//$this->PAR($arrayDiasCorridos);
        	$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
        	
        	$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
        	$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
        	
        	$data_termino = new DateTime($data['pas'][$i]['data_ini_planejada']);
        	$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
        	$data['pas'][$i]['data_fim_planejada'] = $data_termino->format('Y-m-d');
        	
        	//echo '<br>';
        	$i++; 
        	
        }
    	
    	//$this->debugMark('PAS', $data['pas']);
    	
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    	
    	//$this->debugMark('PAS', $data['pas'] );
    	$out = array();
    	foreach($data['pas'] as $row){
    	
    		// DATAS ENVOLVIDAS
    		$dataIniPlan = strtotime($row['data_ini_planejada']);
    		$dataFimPlan = strtotime($row['data_fim_planejada']);
    		$diaAtual 	 = strtotime(date('Y-m-d'));
    	
    		// PRODUTO FINALIZADO
    		if(isset($row['progresso_total'])){
    			
    	
    			if($row['progresso_total'] >= 100){
    				// FINALIZOU AS MOVIMENTAÇÕES
    				$lastMov 	 = strtotime($row['data_last_mov']);
    				$diffDays = $this->diff_date($dataFimPlan,$lastMov);
    				if( $lastMov > $dataFimPlan ){
    					$class = 'event-warning';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue fora do Prazo com '.$diffDays.' de atraso.';
    				}else{
    					$class = 'event-success';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue no Prazo com '.$diffDays.' adiantados.';
    				}
    					
    				// PRODUTO EM ANDAMENTO
    			}else{
    				// SELECIONAR A CLASSE PARA APRESENTAR NA AGENDA
    				$diffDays = $this->diff_date($diaAtual,$dataFimPlan);
    				if($dataFimPlan > $diaAtual ){
    					$class = 'event-info';
    					$mensAdditional = 'Não Finalizado, ainda no Prazo restando '.$diffDays.' em com '.$row['progresso_total'].'% concluído.' ;
    				}else{
    					$class = 'event-important';
    					$mensAdditional = 'Não Finalizado, fora do Prazo e com '.$diffDays.' dias de atraso e '.$row['progresso_total'].'% concluído.';
    				}
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    	
    			}
    	
    		}else{
    	
    			if($dataIniPlan > $diaAtual ){
    				$class = 'event-special';
    				$mensAdditional = 'Não Iniciado, no prazo.';
    				$dataIni = $diaAtual;
    				$dataEnd = $diaAtual;
    					
    			}else if($dataIniPlan < $diaAtual AND $diaAtual < $dataFimPlan ){
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, ainda prazo.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}else{
    				$diffDays = $this->diff_date($dataIniPlan,$diaAtual);
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, fora do prazo e com '.$diffDays.' dias de atraso.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}
    		}
    	
    	
    		$out[] = array(
    				"id" 	=> $row['id'],
    				"title" => ' (Lote '. $row['lote'].') '.$mensAdditional ,
    				"url" 	=> base_url().'admin/pas/detalhes/'.$row['id'],
    				"class" => $class ,
    				"start" => $dataIni . '000',
    				"end" 	=> $dataEnd  . '000');
    	
    	}
    	
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    }

    public function get_pas_all_lote_events_by_contrato(){
    	
    	header('Content-type: application/json');
    	
    	$data = array();
    	
    	// AMOSTRAGEM POR PRODUTO RELACIONADO AO ANALISTA;
    	$i = 0;
    	$tmpArray = array();
    	$tmpFaseArray = array();
    	
    	$data['id_responsavel'] = $this->session->userdata('id');
    	
    	$this->load->model('usuarios_contratosdao');
    	$usuarioContrato =  new usuarios_contratosdao();
    	$arrayTemContrato = $usuarioContrato->get_usuarios_contratos_by_id_usuario($data['id_responsavel']);
    	
    	$data['pas'] = $this->pasdao->get_pas_by_contrato($arrayTemContrato);
    	
    	
    	foreach($data['pas'] as $item){
    		$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
    		$tmpArray = array();
    		foreach($tmpFaseArray as $row){
    			// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
    			$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
    		}
    		//echo '<br>';
    		$progressoTotalSoma =  array_sum($tmpArray);
    		//echo '<br>';
    		$totalFases = sizeof($tmpArray) ;
    		//echo '<br>';
    		//$this->PAR($tmpArray);
    		
    		if($progressoTotalSoma AND $totalFases){
    			$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
    			
    			// verifica a data do primeiro movimento
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    			
    			$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    			
    			if($data['pas'][$i]['progresso_total'] >= 100){
    				// verifica a data do ultimo movimento
    				$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
    				$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
    			}
    			
    		}else{
    			$data['pas'][$i]['progresso_total'] = 0;
    		}
    		
    		$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
    		//$this->PAR($arrayDiasCorridos);
    		$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
    		
    		$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
    		
    		$data_termino = new DateTime($data['pas'][$i]['data_ini_planejada']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data['pas'][$i]['data_fim_planejada'] = $data_termino->format('Y-m-d');
    		
    		//echo '<br>';
    		$i++;
    		
    	}
    	
    	//$this->debugMark('PAS', $data['pas']);
    	
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    	
    	//$this->debugMark('PAS', $data['pas'] );
    	$out = array();
    	foreach($data['pas'] as $row){
    		
    		// DATAS ENVOLVIDAS
    		$dataIniPlan = strtotime($row['data_ini_planejada']);
    		$dataFimPlan = strtotime($row['data_fim_planejada']);
    		$diaAtual 	 = strtotime(date('Y-m-d'));
    		
    		// PRODUTO FINALIZADO
    		if(isset($row['progresso_total'])){
    			
    			
    			if($row['progresso_total'] >= 100){
    				// FINALIZOU AS MOVIMENTAÇÕES
    				$lastMov 	 = strtotime($row['data_last_mov']);
    				$diffDays = $this->diff_date($dataFimPlan,$lastMov);
    				if( $lastMov > $dataFimPlan ){
    					$class = 'event-warning';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue fora do Prazo com '.$diffDays.' de atraso.';
    				}else{
    					$class = 'event-success';
    					$dataIni = $dataIniPlan;
    					$dataEnd = $lastMov;
    					$mensAdditional = 'Entregue no Prazo com '.$diffDays.' adiantados.';
    				}
    				
    				// PRODUTO EM ANDAMENTO
    			}else{
    				// SELECIONAR A CLASSE PARA APRESENTAR NA AGENDA
    				$diffDays = $this->diff_date($diaAtual,$dataFimPlan);
    				if($dataFimPlan > $diaAtual ){
    					$class = 'event-info';
    					$mensAdditional = 'Não Finalizado, ainda no Prazo restando '.$diffDays.' em com '.$row['progresso_total'].'% concluído.' ;
    				}else{
    					$class = 'event-important';
    					$mensAdditional = 'Não Finalizado, fora do Prazo e com '.$diffDays.' dias de atraso e '.$row['progresso_total'].'% concluído.';
    				}
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    				
    			}
    			
    		}else{
    			
    			if($dataIniPlan > $diaAtual ){
    				$class = 'event-special';
    				$mensAdditional = 'Não Iniciado, no prazo.';
    				$dataIni = $diaAtual;
    				$dataEnd = $diaAtual;
    				
    			}else if($dataIniPlan < $diaAtual AND $diaAtual < $dataFimPlan ){
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, ainda prazo.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}else{
    				$diffDays = $this->diff_date($dataIniPlan,$diaAtual);
    				$class = 'event-inverse';
    				$mensAdditional = 'Não Iniciado, fora do prazo e com '.$diffDays.' dias de atraso.';
    				$dataIni = $dataIniPlan;
    				$dataEnd = $diaAtual;
    			}
    		}
    		
    		
    		$out[] = array(
    				"id" 	=> $row['id'],
    				"title" => ' (Lote '. $row['lote'].') '.$mensAdditional ,
    				"url" 	=> base_url().'admin/pas/detalhes/'.$row['id'],
    				"class" => $class ,
    				"start" => $dataIni . '000',
    				"end" 	=> $dataEnd  . '000');
    		
    	}
    	
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    }
    
    public function get_pas_prazos_by_id_pas_id_fase(){
    
    	header('Content-type: application/json');
    	 
    	$id = $this->uri->segment(4);
    	$id_fase = $this->uri->segment(5);
    
    	$tmpArray = $this->pasdao->get_prazo_by_id_pas_id_fase($id,$id_fase) ;
    	$out = sizeof($tmpArray) > 0 ? $tmpArray[0] : 0;   
    	
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out['prazo']));
    	exit;
    
    }
    
    public function get_progress_by_pas($id){
    	 
    	$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($id);
    	$tmpArray = array();
    	foreach($tmpFaseArray as $row){
    		// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
    		$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
    	}
    	//echo '<br>';
    	$progressoTotalSoma =  array_sum($tmpArray);
    	//echo '<br>';
    	$totalFases = sizeof($tmpArray) ;
    	 
    	if($progressoTotalSoma AND $totalFases){
    		$progressoTotal = round( ($progressoTotalSoma/$totalFases) , 2);
    		 
    	}else{
    		$progressoTotal = 0;
    	}
    	 
    	 
    	return $progressoTotal;
    }
    
    public function get_cronograma_atividade(){
    	
    	header('Content-type: application/json');
    	
    	$id = $this->uri->segment(4);
    	
    	
    	$this->load->model('pasdao');
    	$pas = new pasdao();
    	
    	$data['pas'] = $pas->get_cronograma_atividade_by_pas($id);
    	
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	
    	//$this->debugMark('Data', $data['pas']);
    	$first = true;
    	
    	foreach($data['pas'] as $row){
    		
    		
    		
    		if($first){
    		
    			$first = false;
    			$legendArray = array( 'Executado' => '#cc3300', 'Contratado' => '#009933' , 'Planejado' => '#0077b3');
    			
    			$iniDate = $row['data_contratada'];
    			foreach($legendArray as $itemleg => $itemColor){
    		
    				$leg_data_termino = new DateTime($iniDate);
    				$leg_data_termino->add(new DateInterval('P60D'));
    				$leg_data_fim_pas = $leg_data_termino->format('Y-m-d');
    		
    				$temp = explode("-", $iniDate);
    				$LegtempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$temp = explode("-", $leg_data_fim_pas);
    				$LegtempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $itemleg),
    						array('v' => $itemleg),
    						array('v' => "Date(".$LegtempDate1.")"),
    						array('v' => "Date(".$LegtempDate2.")")
    				));
    		
    				$iniDate = $leg_data_fim_pas;
    			}
    		
    		}
    		
    		$temp = explode("-", $row['data_contratada']);
    		$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_fim_contratada']);
    		$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_planejada']);
    		$tempDate3 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_fim_planejada']);
    		$tempDate4 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$out['rows'][] = array('c' => array(
    				array('v' => $row['atividade']),
    				array('v' => "Contratado"),
    				array('v' => null),
    				array('v' => "Date(".$tempDate1.")"),
    				array('v' => "Date(".$tempDate2.")")
    		));
    		
    		$out['rows'][] = array('c' => array(
    				array('v' => $row['atividade']),
    				array('v' => "Planejado"),
    				array('v' => null),
    				array('v' => "Date(".$tempDate3.")"),
    				array('v' => "Date(".$tempDate4.")")
    		));
    		
    		if($row['start_movement'] != '' ){
    			
    			if($row['peso'] >= 100){
    				
    				$temp = explode("-", $row['start_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$temp = explode("-", $row['last_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => $row['atividade']." (Executada)"),
    						array('v' => "Executado"),
    						array('v' => null),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$tempDate2.")")
    				));
    				
    			}else{
    				
    				$temp = explode("-", $row['start_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$lastDate = date('Y,m,d');    				
    				
    				$temp = explode(",", $lastDate);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$lastDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				//$lastDate = date('Y,m,d');
    				
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => $row['atividade']." (Executada)"),
    						array('v' => "Executado"),
    						array('v' => null),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$lastDate.")")
    				));
    				    				
    			}
    		}
    		
    	}
    	
    	echo json_encode(array('success' => 1, 'result' => $out, 'colorMap' => $legendArray));
    	exit;
    	
    }
    
    public function get_cronograma_atividade_planejada(){
    	 
    	header('Content-type: application/json');
    	 
    	$id = $this->uri->segment(4);
    	 
    	 
    	$this->load->model('pasdao');
    	$pas = new pasdao();
    	 
    	$data['pas'] = $pas->get_cronograma_atividade_by_pas($id);
    	 
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	
    	$first = true;
    	
    	foreach($data['pas'] as $row){
    
    		if($first){
    		
    			$first = false;
    			$legendArray = array( 'Executado' => '#cc3300', 'Planejado' => '#0077b3');
    			
    			$iniDate = $row['data_contratada'];
    			foreach($legendArray as $itemleg => $itemColor){
    		
    				$leg_data_termino = new DateTime($iniDate);
    				$leg_data_termino->add(new DateInterval('P60D'));
    				$leg_data_fim_pas = $leg_data_termino->format('Y-m-d');
    		
    				$temp = explode("-", $iniDate);
    				$LegtempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$temp = explode("-", $leg_data_fim_pas);
    				$LegtempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $itemleg),
    						array('v' => $itemleg),
    						array('v' => "Date(".$LegtempDate1.")"),
    						array('v' => "Date(".$LegtempDate2.")")
    				));
    		
    				$iniDate = $leg_data_fim_pas;
    			}
    			//break;
    		
    		}
    		
    		$temp = explode("-", $row['data_planejada']);
    		$tempDate3 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_fim_planejada']);
    		$tempDate4 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$out['rows'][] = array('c' => array(
    				array('v' => $row['atividade']),
    				array('v' => "Planejado"),
    				array('v' => null),
    				array('v' => "Date(".$tempDate3.")"),
    				array('v' => "Date(".$tempDate4.")")
    		));
    
    		if($row['start_movement'] != '' ){
    			 
    			if($row['peso'] >= 100){
    
    				$temp = explode("-", $row['start_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$temp = explode("-", $row['last_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => $row['atividade']),
    						array('v' => "Executado"),
    						array('v' => null),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$tempDate2.")")
    				));
    
    			}else{
    				
    				$temp = explode("-", $row['start_movement']);
    				$tempTime = explode(" ", $temp[2]); 
    				$temp[2] = $tempTime[0];
    				
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$lastDate = date('Y,m,d');
    				
    				$temp = explode(",", $lastDate);
    				$lastDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => $row['atividade']),
    						array('v' => "Executado"),
    						array('v' => null),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$lastDate.")")
    				));
    
    			}
    		}
    
    	}
    	//$this->debugMark(null, $out); 
    	echo json_encode(array('success' => 1, 'result' => $out, 'colorMap' => $legendArray));
    	exit;
    	 
    }
    //
    public function get_cronograma_atividade_contratada(){
    	 
    	header('Content-type: application/json');
    	 
    	$id = $this->uri->segment(4);
    	 
    	 
    	$this->load->model('pasdao');
    	$pas = new pasdao();
    	 
    	$data['pas'] = $pas->get_cronograma_atividade_by_pas($id);
    	 
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	 
    	$first = true;
    	foreach($data['pas'] as $row){
    		
    		if($first){
    			 
    			$first = false;
    			$legendArray = array( 'Executado' => '#cc3300', 'Contratado' => '#009933' );
    			 
    			$iniDate = $row['data_contratada'];
    			foreach($legendArray as $itemleg => $itemColor ){
    		
    				$leg_data_termino = new DateTime($iniDate);
    				$leg_data_termino->add(new DateInterval('P60D'));
    				$leg_data_fim_pas = $leg_data_termino->format('Y-m-d');
    		
    				$temp = explode("-", $iniDate);
    				$LegtempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$temp = explode("-", $leg_data_fim_pas);
    				$LegtempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $itemleg),
    						array('v' => $itemleg),
    						array('v' => "Date(".$LegtempDate1.")"),
    						array('v' => "Date(".$LegtempDate2.")")
    				));
    		
    				$iniDate = $leg_data_fim_pas;
    			}
    			//break;
    		    
    		}
    		
    		$temp = explode("-", $row['data_contratada']);
    		$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_fim_contratada']);
    		$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    
    		$out['rows'][] = array('c' => array(
    				array('v' => $row['atividade']),
    				array('v' => "Contratado"),
    				array('v' => null),
    				array('v' => "Date(".$tempDate1.")"),
    				array('v' => "Date(".$tempDate2.")")
    		));
    
    		if($row['start_movement'] != '' ){
    			 
    			if($row['peso'] >= 100){
    				
    				$temp = explode("-", $row['start_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$temp = explode("-", $row['last_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    
    				$out['rows'][] = array('c' => array(
    						array('v' => $row['atividade']),
    						array('v' => "Executado"),
    						array('v' => null),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$tempDate2.")")
    				));
    
    			}else{
    				
    				$temp = explode("-", $row['start_movement']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$lastDate = date('Y,m,d');
    				
    				$temp = explode(",", $lastDate);
    				$lastDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => $row['atividade']),
    						array('v' => "Executado"),
    						array('v' => null),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$lastDate.")")
    				));
    				
    
    			}
    		}
    
    	}
    	 
    	echo json_encode(array('success' => 1, 'result' => $out, 'colorMap' => $legendArray));
    	exit;
    	 
    }
    
    public function get_cronograma_produto(){
    	 
    	header('Content-type: application/json');
    	 
    	$id = $this->uri->segment(4);
    	// PAS FASES 
    	$data['pas_fases'] = $this->pas_fasesdao->get_pas_fases_by_id_pas($id);
    
    	// MOVIMENTACAO DO DAS FASES DO PAS
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    	
    	// STATUS DAS FASES DO PAS
    	$this->load->model('statusdao');
    	$status = new statusdao();
    	$data['status'] = $status->get_status(null,'id');
    	
    	$status_option = array();
    	foreach($data['status'] as $rowStatus){
    		$status_option[$rowStatus['id']] = $rowStatus['titulo']; 
    	}
    	    	
    	$i = 0;
    	$string = '';
    	
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	
    	$first = true;
    	
    	foreach($data['pas_fases'] as $row){
    		
    		
    		if($first){ 
    			
    			$first = false; 
    			$legendArray = array( 'Contratado' => '#009933' , 'Planejado' => '#0077b3');
    			
    			
    			 $this->load->model('statusdao');
    			 $status = new statusdao();
    			 $tmpStatus = $status->get_status_for_legenda();
    			 
    			 foreach($tmpStatus as $itemStatus)
    			 {
    			 	$legendArray[$itemStatus['titulo']] = $itemStatus['color'];
    			 };
    			
    			
    			$iniDate = $row['data_ini'];
    			foreach($legendArray as $item => $itemColor ){
    				
    				$data_termino = new DateTime($iniDate);
    				$data_termino->add(new DateInterval('P80D'));
    				$data_fim_pas = $data_termino->format('Y-m-d');
    				
    				$temp = explode("-", $iniDate);
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$temp = explode("-", $data_fim_pas);
    				$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $item),
    						array('v' => $item),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$tempDate2.")")
    				));
    				
    				$iniDate = $data_fim_pas;
    			}
    			//break;
    			
    		}
    		
    		$temp = explode("-", $row['data_ini']);
    		$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_fim']);
    		$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_ini_planejada']);
    		$tempDate3 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $row['data_fim_planejada']);
    		$tempDate4 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$out['rows'][] = array('c' => array(
    				array('v' => $row['fases']),
    				array('v' => "Contratado"),
    				array('v' => null),
    				array('v' => "Date(".$tempDate1.")"),
    				array('v' => "Date(".$tempDate2.")")
    		));
    		
    		$out['rows'][] = array('c' => array(
    				array('v' => $row['fases']),
    				array('v' => "Planejado"),
    				array('v' => null),
    				array('v' => "Date(".$tempDate3.")"),
    				array('v' => "Date(".$tempDate4.")")
    		));
    		
    		
    		$tmpArrayMov = $lastMov->get_first_movimentacao_by_id_pas_fases($row['id']);
    		
    		if((sizeof($tmpArrayMov) > 0 AND $tmpArrayMov[0]['start_date'] != '' ) ){
    			
    			$data['pas_fases'][$i]['start_date']  = $tmpArrayMov[0];
    			
    			$tmpArrayMov = $lastMov->get_last_movimentacao_by_id_pas_fases($row['id']);
    			
    			
    			if((sizeof($tmpArrayMov) > 0 )){
    				$data['pas_fases'][$i]['lastmov']  =  $tmpArrayMov[0];
    				//$string .= 'new Date('.date('Y,m,d', strtotime($tmpArrayMov[0]['data_protocolo'])).')],';
    			}else{
    				//$string .= 'new Date('.date('Y,m,d').')],';
    				$data['pas_fases'][$i]['lastmov']  =   array();
    			}
    			
    			$tmpArrayMov = $lastMov->get_pas_fases_movimentacao_by_id_pas_fases($row['id'], 'data_protocolo');
    			//$this->debugMark('Array Movimento', $tmpArrayMov);
    			$first = true;
    			$end = false;
    			foreach($tmpArrayMov as $movimento){
    				if($first){
    			
    					$tmpDate = $movimento['data_protocolo'];
    					$tmpMov = $movimento['id_status'];
    					$first = false;
    			
    				}else{
    					
    					
    					$temp = explode("-",$tmpDate);
    					$tempTime = explode(" ", $temp[2]);
    					$temp[2] = $tempTime[0];
    					$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    					
    					$temp = explode("-", $movimento['data_protocolo']);
    					$tempTime = explode(" ", $temp[2]);
    					$temp[2] = $tempTime[0];
    					$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    					
    					$faseTemp = $row['fases'].'(Executado)';
    					
    					$out['rows'][] = array('c' => array(
    							array('v' => $faseTemp),
    							array('v' => $status_option[$tmpMov]),
    							array('v' => null),
    							array('v' => "Date(".$tempDate1.")"),
    							array('v' => "Date(".$tempDate2.")")
    					));
    					
	    					
    					
    					$tmpDate = $movimento['data_protocolo'];
    					$tmpMov = $movimento['id_status'];
    				}
    				// TODO :  ALTERAR ISSO
    				if($movimento['tipo'] == 'Final'){
    					
    					//$this->debugMark('Produto', $movimento);
    						
    					$temp = explode("-", $movimento['data_protocolo']);
    					$tempTime = explode(" ", $temp[2]);
    					$temp[2] = $tempTime[0];
    					$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    					$tempDate2 = $temp[0].','.($temp[1]-1).','.($temp[2]+1);
    					
    					$out['rows'][] = array('c' => array(
    							array('v' => $row['fases'].'(Executado)'),
    							array('v' => $status_option[$tmpMov]),
    							array('v' => null),
    							array('v' => "Date(".$tempDate1.")"),
    							array('v' => "Date(".$tempDate2.")")
    					));
    					
    					$end = true;
    				}
    			}
    			
    			if(!$end){
    				if(strtotime($movimento['data_protocolo']) > strtotime(date('Y-m-d')) ){
    					$lastDate = date('Y,m,d', strtotime($movimento['data_protocolo']));
    				}else{
    					 $lastDate = date('Y,m,d');
    					
    				}
    			
    				
    				$temp = explode("-", $movimento['data_protocolo']);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				
    				$temp = explode(",", $lastDate);
    				$tempTime = explode(" ", $temp[2]);
    				$temp[2] = $tempTime[0];
    				$lastDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => $row['fases'].'(Executado)'),
    						array('v' => $status_option[$tmpMov]),
    						array('v' => null),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$lastDate.")")
    				));
    				
    				
    				$end = false;
    			}
    			
    		}
    		
    		$i++;
    	}
    	
    	
    	echo json_encode(array('success' => 1, 'result' => $out, 'colorMap' => $legendArray));
    	exit;
    	 
    }
    
    public function get_cronograma_produto_id_fases(){
    
    	header('Content-type: application/json');
    
    	$id = $this->uri->segment(4);
    	$id_fases = $this->uri->segment(5);
    	// PAS FASES
    	$data['pas_fases'] = $this->pas_fasesdao->get_pas_fases_by_id_pas($id);
    
    	// MOVIMENTACAO DO DAS FASES DO PAS
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    	 
    	// STATUS DAS FASES DO PAS
    	$this->load->model('statusdao');
    	$status = new statusdao();
    	$data['status'] = $status->get_status(null,'id');
    	 
    	$status_option = array();
    	foreach($data['status'] as $rowStatus){
    		$status_option[$rowStatus['id']] = $rowStatus['titulo'];
    	}
    
    	$i = 0;
    	$string = '';
    	 
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	 
    	$first = true;
    	
    	//$this->debugMark('mov', $data['pas_fases']); 
    	
    	foreach($data['pas_fases'] as $row){
    		
    		if($first){
    			 
    			$first = false;
    			    			 
    			$legendArray = array( 'Contratado' => '#009933' , 'Planejado' => '#0077b3');
    			
    			$this->load->model('statusdao');
    			$status = new statusdao();
    			$tmpStatus = $status->get_status_for_legenda();
    			
    			foreach($tmpStatus as $itemStatus)
    			{
    				$legendArray[$itemStatus['titulo']] = $itemStatus['color'];
    			};
    			
    			
    			$iniDate = $row['data_ini'];
    			foreach($legendArray as $itemleg => $itemColor){
    				
    				$leg_data_termino = new DateTime($iniDate);
    				$leg_data_termino->add(new DateInterval('P20D'));
    				$leg_data_fim_pas = $leg_data_termino->format('Y-m-d');
    				
    				$temp = explode("-", $iniDate);
    				$LegtempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$temp = explode("-", $leg_data_fim_pas);
    				$LegtempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $itemleg),
    						array('v' => $itemleg),
    						array('v' => "Date(".$LegtempDate1.")"),
    						array('v' => "Date(".$LegtempDate2.")")
    				));
    				
    				$iniDate = $leg_data_fim_pas;
    			}
    		    
    		}
    		
    
    		if($id == $row['id_pas'] ){
    			
    			$temp = explode("-", $row['data_ini']);
    			$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $row['data_fim']);
    			$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $row['data_ini_planejada']);
    			$tempDate3 = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $row['data_fim_planejada']);
    			$tempDate4 = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			
    			$out['rows'][] = array('c' => array(
    					array('v' => $row['fases']),
    					array('v' => "Contratado"),
    					array('v' => null),
    					array('v' => "Date(".$tempDate1.")"),
    					array('v' => "Date(".$tempDate2.")")
    			));
    			
    			$out['rows'][] = array('c' => array(
    					array('v' => $row['fases']),
    					array('v' => "Planejado"),
    					array('v' => null),
    					array('v' => "Date(".$tempDate3.")"),
    					array('v' => "Date(".$tempDate4.")")
    			));
    			
    			
    			$tmpArrayMov = $lastMov->get_first_movimentacao_by_id_pas_fases($row['id']);
    			
    			if((sizeof($tmpArrayMov) > 0 AND $tmpArrayMov[0]['start_date'] != '' ) ){
    			
    				$data['pas_fases'][$i]['start_date']  = $tmpArrayMov[0];
    			
    				$tmpArrayMov = $lastMov->get_last_movimentacao_by_id_pas_fases($row['id']);
    			
    			
    				if((sizeof($tmpArrayMov) > 0 )){
    					$data['pas_fases'][$i]['lastmov']  =  $tmpArrayMov[0];
    					//$string .= 'new Date('.date('Y,m,d', strtotime($tmpArrayMov[0]['data_protocolo'])).')],';
    				}else{
    					//$string .= 'new Date('.date('Y,m,d').')],';
    					$data['pas_fases'][$i]['lastmov']  =   array();
    				}
    			
    				$tmpArrayMov = $lastMov->get_pas_fases_movimentacao_by_id_pas_fases($row['id'], 'data_protocolo');
    				$first = true;
    				$end = false;
    				foreach($tmpArrayMov as $movimento){
    					if($first){
    			
    						$tmpDate = explode(" ", $movimento['data_protocolo']);
    						$tmpDate = $tmpDate[0];
    						$tmpMov = $movimento['id_status'];
    						$first = false;
    			
    					}else{
    			
    			
    						$temp = explode("-",$tmpDate);
    						$tempTime = explode(" ", $temp[2]);
    						$temp[2] = $tempTime[0];
    						$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    						$temp = explode("-", $movimento['data_protocolo']);
    						$tempTime = explode(" ", $temp[2]);
    						$temp[2] = $tempTime[0];
    						$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    						$faseTemp = $row['fases'].'(Executado)';
    			
    						$out['rows'][] = array('c' => array(
    								array('v' => $faseTemp),
    								array('v' => $status_option[$tmpMov]),
    								array('v' => null),
    								array('v' => "Date(".$tempDate1.")"),
    								array('v' => "Date(".$tempDate2.")")
    						));
    			
    			
    			
    						$tmpDate = $movimento['data_protocolo'];
    						$tmpMov = $movimento['id_status'];
    					}
    					// TODO :  ALTERAR ISSO
    					if($movimento['tipo'] == 'Final'){
    			
    			
    						$temp = explode("-", $movimento['data_protocolo']);
    						$tempTime = explode(" ", $temp[2]);
    						$temp[2] = $tempTime[0];
    						$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    						$tempDate2 = $temp[0].','.($temp[1]-1).','.($temp[2]+1);
    			
    						$out['rows'][] = array('c' => array(
    								array('v' => $row['fases'].'(Executado)'),
    								array('v' => $status_option[$tmpMov]),
    								array('v' => null),
    								array('v' => "Date(".$tempDate1.")"),
    								array('v' => "Date(".$tempDate2.")")
    						));
    			
    						$end = true;
    					}
    				}
    			
    				if(!$end){
    					if(strtotime($movimento['data_protocolo']) > strtotime(date('Y-m-d')) ){
    						$lastDate = date('Y,m,d', strtotime($movimento['data_protocolo']));
    					}else{
    						$lastDate = date('Y,m,d');
    			
    					}
    						
    			
    					$temp = explode("-", $movimento['data_protocolo']);
    					$tempTime = explode(" ", $temp[2]);
    					$temp[2] = $tempTime[0];
    					$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			
    					$temp = explode(",", $lastDate);
    					$lastDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    					$out['rows'][] = array('c' => array(
    							array('v' => $row['fases'].'(Executado)'),
    							array('v' => $status_option[$tmpMov]),
    							array('v' => null),
    							array('v' => "Date(".$tempDate1.")"),
    							array('v' => "Date(".$lastDate.")")
    					));
    			
    			
    					$end = false;
    				}
    			
    			}
    			
    			$i++;
    			break;
    			
    		}
    		
    		
    	}
    	 
    	 
    	echo json_encode(array('success' => 1, 'result' => $out, 'colorMap' => $legendArray));
    	exit;
    
    }
    
	public function get_cronograma_all_lotes($id_contrato = null){
    	 
    	header('Content-type: application/json');    	
    	
    	if($id_contrato){
    		$pasData  = $this->pasdao->get_pas_by_id_contrato($id_contrato);
    	}else{
    		$pasData  = $this->pasdao->get_pas(null, 'lote');
    	}
    	
    	$tmpContratos = array();
    	$tmpContratos = array_merge($tmpContratos, $this->foreingControllersContratos());
    	
    	foreach($tmpContratos['contratos'] as $item)
    	{
    		$contrato[$item['id']] = $item['contrato'];
    	}
    	
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	
    	
    	
    	 
    	$i = 0;
    	$tmpArrayExec = array();
    	$first = true;
    	
    	$currentDate = date('Y,m,d');
    	$temp = explode(",", $currentDate);
    	$currentDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    	
    	foreach($pasData as $item){
    		
    		$progressoTotal = $this->get_progress_by_pas($item['id']);
    		//lote iza
    		$tmpLote = ( is_numeric($item['lote']) ) ? $contrato[$item['id_contrato']].' Lote: '.$item['lote'] : $contrato[$item['id_contrato']];
    		
    		if($progressoTotal == 0){
    			$tmpArrayExec = array();
    		}else if($progressoTotal >= 100){
    			
    			
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    			$firstMov = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    			
    			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
    			$lastMov = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
    			
    			$temp = explode("-", $firstMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $lastMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$lastMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$tmpArrayExec = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Executado"),
    					array('v' => null),
    					array('v' => "Date(".$firstMov.")"),
    					array('v' => "Date(".$lastMov.")")
    			));
    			
    		}else{
    			
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    			$firstMov = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    			
    			
    			
    			$temp = explode("-", $firstMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$tmpArrayExec = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Executado"),
    					array('v' => null),
    					array('v' => "Date(".$firstMov.")"),
    					array('v' => "Date(".$currentDate.")")
    			));
    		}
    		
    		
    		$arrayLastPlanejado = $this->pas_fasesdao->get_data_fim_planejada_by_id_pas($item['id']);
    		$lastPlanejadoFases = ($arrayLastPlanejado[0]['data_fim_planejada'] != '') ? $arrayLastPlanejado[0]['data_fim_planejada'] : 0;
    		
    		$arrayFirstPlanejado = $this->pas_fasesdao->get_data_ini_planejada_by_id_pas($item['id']);
    		$firstPlanejadoFases = ($arrayFirstPlanejado[0]['data_ini_planejada'] != '') ? $arrayFirstPlanejado[0]['data_ini_planejada'] : 0;
    		
    		
    		$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
    		
    		$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
    		 
    		$data_termino = new DateTime($item['data_ini_pas']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data_fim_pas = $data_termino->format('Y-m-d');
    		 
    		$data_termino = new DateTime($item['data_ini_planejada']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data_fim_planejada = $data_termino->format('Y-m-d');
    		
    		if($i == 3){
    			//echo 'data ini pas '.$item['data_ini_pas'];
    			//echo ' data fim pas'. $data_fim_pas;
    		} 
    		// MONTANDO A LEGENDA
    		if($first){
    		
    		
    			$first = false;
    			$legendArray = array( 'Executado' => '#cc3300', 'Contratado' => '#009933' , 'Planejado' => '#0077b3', 'Planejado 1' => '#fad201', 'Planejado 2' => '#005580');
    		
    			$out['rows'][] = array('c' => array(
    					array('v' => "Data Atual"),
    					array('v' => "Hoje"),
    					array('v' => "Hoje"),
    					array('v' => "Date(".$currentDate.")"),
    					array('v' => "Date(".$currentDate.")")
    			));
    		
    			$iniDate = $item['data_ini_pas'];
    		
    			foreach($legendArray as $leg_row => $itemColor){
    		
    				$leg_data_termino = new DateTime($iniDate);
    				$leg_data_termino->add(new DateInterval('P80D'));
    				$leg_data_fim_pas = $leg_data_termino->format('Y-m-d');
    		
    				$temp = explode("-", $iniDate);
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$temp = explode("-", $leg_data_fim_pas);
    				$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $leg_row),
    						array('v' => $leg_row),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$tempDate2.")")
    				));
    		
    				$iniDate = $leg_data_fim_pas;
    			}
    			//break;
    		
    		}
    		
    		$temp = explode("-", $item['data_ini_pas']);
    		$tempTime = explode(" ", $temp[2]);
    		$temp[2] = $tempTime[0];
    		$item['data_ini_pas'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $data_fim_pas);
    		$tempTime = explode(" ", $temp[2]);
    		$temp[2] = $tempTime[0];
    		$data_fim_pas = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$out['rows'][] = array('c' => array(
    				array('v' => $tmpLote),
    				array('v' => "Contratado"),
    				array('v' => null),
    				array('v' => "Date(".$item['data_ini_pas'].")"),
    				array('v' => "Date(".$data_fim_pas.")")
    		));
    		
    		$dfp = strtotime($data_fim_planejada); 
    		$dfpf = strtotime($lastPlanejadoFases);
    		
    		
    		if( $dfpf){
    			
    			$temp = explode("-", $item['data_ini_planejada']);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$item['data_ini_planejada'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $data_fim_planejada);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$data_fim_planejada = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $lastPlanejadoFases);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$lastPlanejadoFases = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $firstPlanejadoFases);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstPlanejadoFases = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			
    			$out['rows'][] = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Planejado 1"),
    					array('v' => null),
    					array('v' => "Date(".$item['data_ini_planejada'].")"),
    					array('v' => "Date(".$data_fim_planejada.")")
    			));
    			$out['rows'][] = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Planejado 2"),
    					array('v' => null),
    					array('v' => "Date(".$firstPlanejadoFases.")"),
    					array('v' => "Date(".$lastPlanejadoFases.")")
    			));
    	
    			
    		}else{
    			
    			$temp = explode("-", $item['data_ini_planejada']);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$item['data_ini_planejada'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    			 
    			$temp = explode("-", $data_fim_planejada);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$data_fim_planejada = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$out['rows'][] = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Planejado 1"),
    					array('v' => null),
    					array('v' => "Date(".$item['data_ini_planejada'].")"),
    					array('v' => "Date(".$data_fim_planejada.")")
    			));
    		}
    		
    		if(sizeof($tmpArrayExec) > 0){
    			$out['rows'][] = $tmpArrayExec; 
    		}
    			
    		$i++;
    	}
    	
    	echo json_encode(array('success' => 1, 'result' => $out, 'colorMap' => $legendArray));
    	exit;
    	 
    }
    
    public function get_cronograma_all_lotes_responsavel($id_responsavel = null){
    
    	header('Content-type: application/json');
    	 
    	if($id_responsavel){
    		$pasData  = $this->pasdao->get_pas_by_id_responsavel($id_responsavel);
    	}else{
    		$pasData  = $this->pasdao->get_pas(null, 'lote');
    	}
    	
    	 
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	
    	
    	$i = 0;
    	$tmpArrayExec = array();
    	$first = true;
    	
    	$currentDate = date('Y,m,d');
    	$temp = explode(",", $currentDate);
    	$currentDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    	
    	foreach($pasData as $item){
    
    		$progressoTotal = $this->get_progress_by_pas($item['id']);
    
    		if($progressoTotal == 0){
    			$tmpArrayExec = array();
    		}else if($progressoTotal >= 100){
    			 
    			if($i == 3){
    				//echo "aqui";
    			}
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    			$firstMov = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    			 
    			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
    			$lastMov = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
    			 
    			$temp = explode("-", $firstMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			 
    			$temp = explode("-", $lastMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$lastMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			 
    			$tmpArrayExec = array('c' => array(
    					array('v' => "Lote ".$item['lote']),
    					array('v' => "Executado"),
    					array('v' => null),
    					array('v' => "Date(".$firstMov.")"),
    					array('v' => "Date(".$lastMov.")")
    			));
    			 
    		}else{
    			if($i == 3){
    				//echo "aqui";
    			}
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    			$firstMov = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    			 
    			$temp = explode("-", $firstMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			 
    			$tmpArrayExec = array('c' => array(
    					array('v' => "Lote ".$item['lote']),
    					array('v' => "Executado"),
    					array('v' => null),
    					array('v' => "Date(".$firstMov.")"),
    					array('v' => "Date(".$currentDate.")")
    			));
    		}
    
    
    		$arrayLastPlanejado = $this->pas_fasesdao->get_data_fim_planejada_by_id_pas($item['id']);
    		$lastPlanejadoFases = ($arrayLastPlanejado[0]['data_fim_planejada'] != '') ? $arrayLastPlanejado[0]['data_fim_planejada'] : 0;
    		
    		$arrayFirstPlanejado = $this->pas_fasesdao->get_data_ini_planejada_by_id_pas($item['id']);
    		$firstPlanejadoFases = ($arrayFirstPlanejado[0]['data_ini_planejada'] != '') ? $arrayFirstPlanejado[0]['data_ini_planejada'] : 0;
    		 
    		
    		$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
    
    		$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
    		 
    		$data_termino = new DateTime($item['data_ini_pas']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data_fim_pas = $data_termino->format('Y-m-d');
    		 
    		$data_termino = new DateTime($item['data_ini_planejada']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data_fim_planejada = $data_termino->format('Y-m-d');
    
    		if($i == 3){
    			//echo 'data ini pas '.$item['data_ini_pas'];
    			//echo ' data fim pas'. $data_fim_pas;
    		}
    
    		if($first){
    		
    		
    			$first = false;
    			$legendArray = array('Executado', 'Contratado' , 'Planejado 1', 'Planejado 2');
    		
    			$out['rows'][] = array('c' => array(
    					array('v' => "Data Atual"),
    					array('v' => "Hoje"),
    					array('v' => "Hoje"),
    					array('v' => "Date(".$currentDate.")"),
    					array('v' => "Date(".$currentDate.")")
    			));
    		
    			$iniDate = $item['data_ini_pas'];
    		
    			foreach($legendArray as $leg_row ){
    		
    				$leg_data_termino = new DateTime($iniDate);
    				$leg_data_termino->add(new DateInterval('P80D'));
    				$leg_data_fim_pas = $leg_data_termino->format('Y-m-d');
    		
    				$temp = explode("-", $iniDate);
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$temp = explode("-", $leg_data_fim_pas);
    				$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $leg_row),
    						array('v' => $leg_row),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$tempDate2.")")
    				));
    		
    				$iniDate = $leg_data_fim_pas;
    			}
    			//break;
    		
    		}
    		
    		
    		$temp = explode("-", $item['data_ini_pas']);
    		$item['data_ini_pas'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    
    		$temp = explode("-", $data_fim_pas);
    		$data_fim_pas = $temp[0].','.($temp[1]-1).','.$temp[2];
    
    		$out['rows'][] = array('c' => array(
    				array('v' => "Lote ".$item['lote']),
    				array('v' => "Contratado"),
    				array('v' => null),
    				array('v' => "Date(".$item['data_ini_pas'].")"),
    				array('v' => "Date(".$data_fim_pas.")")
    		));
    
    		$dfp = strtotime($data_fim_planejada);
    		$dfpf = strtotime($lastPlanejadoFases);
    
    		if($dfpf){
    			 
    			$temp = explode("-", $item['data_ini_planejada']);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$item['data_ini_planejada'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $data_fim_planejada);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$data_fim_planejada = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $lastPlanejadoFases);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$lastPlanejadoFases = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $firstPlanejadoFases);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstPlanejadoFases = $temp[0].','.($temp[1]-1).','.$temp[2];;
    			
    			
    			if($i == 3){
    				//echo ' fim menor que planejado por fase ';
    			}
    			 
    			$out['rows'][] = array('c' => array(
    					array('v' => "Lote ".$item['lote']),
    					array('v' => "Planejado 1"),
    					array('v' => null),
    					array('v' => "Date(".$item['data_ini_planejada'].")"),
    					array('v' => "Date(".$data_fim_planejada.")")
    			));
    			$out['rows'][] = array('c' => array(
    					array('v' => "Lote ".$item['lote']),
    					array('v' => "Planejado 2"),
    					array('v' => null),
    					array('v' => "Date(".$firstPlanejadoFases.")"),
    					array('v' => "Date(".$lastPlanejadoFases.")")
    			));
    	
    		
    		}else{
    			 
    			$temp = explode("-", $item['data_ini_planejada']);
    			$item['data_ini_planejada'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    
    			$temp = explode("-", $data_fim_planejada);
    			$data_fim_planejada = $temp[0].','.($temp[1]-1).','.$temp[2];
    			 
    			$out['rows'][] = array('c' => array(
    					array('v' => "Lote ".$item['lote']),
    					array('v' => "Planejado 1"),
    					array('v' => null),
    					array('v' => "Date(".$item['data_ini_planejada'].")"),
    					array('v' => "Date(".$data_fim_planejada.")")
    			));
    		}
    
    		if(sizeof($tmpArrayExec) > 0){
    			$out['rows'][] = $tmpArrayExec;
    		}
    		 
    		$i++;
    	}
    	 
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    
    public function get_cronograma_all_lotes_by_contratos($id_contrato = null){
    	
    	header('Content-type: application/json');
    	
    	$tmpContratos = array();
    	$tmpContratos = array_merge($tmpContratos, $this->foreingControllersContratos());
    	
    	foreach($tmpContratos['contratos'] as $item)
    	{
    		$contrato[$item['id']] = $item['contrato'];
    	}
    	//$this->debugMark('mark',$contrato);
    	
    	$data['id_responsavel'] = $this->session->userdata('id');
    	
    	$this->load->model('usuarios_contratosdao');
    	$usuarioContrato =  new usuarios_contratosdao();
    	$arrayTemContrato = $usuarioContrato->get_usuarios_contratos_by_id_usuario($data['id_responsavel']);
    	
    	$pasData = $this->pasdao->get_pas_by_contrato($arrayTemContrato);
    	
    	
    	$out = array (
    			'cols' => array (
    					array('type' => 'string', 'label' => 'GRUPO' ),
    					array('type' => 'string', 'label' => 'CATEGORIA' ),
    					array('type' => 'string', 'role' => 'tooltip' ),
    					array('type' => 'date', 'label' => 'Inicio'),
    					array('type' => 'date', 'label' => 'Fim')
    			),
    			'rows' => array()
    	);
    	
    	
    	
    	
    	$i = 0;
    	$tmpArrayExec = array();
    	$first = true;
    	
    	$currentDate = date('Y,m,d');
    	$temp = explode(",", $currentDate);
    	$currentDate = $temp[0].','.($temp[1]-1).','.$temp[2];
    	
    	foreach($pasData as $item){
    		
    		$progressoTotal = $this->get_progress_by_pas($item['id']);
    		$tmpLote = ( is_numeric($item['lote']) ) ? $contrato[$item['id_contrato']].' Lote: '.$item['lote'] : $contrato[$item['id_contrato']];
    		
    		if($progressoTotal == 0){
    			$tmpArrayExec = array();
    		}else if($progressoTotal >= 100){
    			
    			
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    			$firstMov = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    			
    			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);
    			$lastMov = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
    			
    			$temp = explode("-", $firstMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $lastMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$lastMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$tmpArrayExec = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Executado"),
    					array('v' => null),
    					array('v' => "Date(".$firstMov.")"),
    					array('v' => "Date(".$lastMov.")")
    			));
    			
    		}else{
    			
    			$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
    			$firstMov = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
    			
    			
    			
    			$temp = explode("-", $firstMov);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstMov = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$tmpArrayExec = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Executado"),
    					array('v' => null),
    					array('v' => "Date(".$firstMov.")"),
    					array('v' => "Date(".$currentDate.")")
    			));
    		}
    		
    		
    		$arrayLastPlanejado = $this->pas_fasesdao->get_data_fim_planejada_by_id_pas($item['id']);
    		$lastPlanejadoFases = ($arrayLastPlanejado[0]['data_fim_planejada'] != '') ? $arrayLastPlanejado[0]['data_fim_planejada'] : 0;
    		
    		$arrayFirstPlanejado = $this->pas_fasesdao->get_data_ini_planejada_by_id_pas($item['id']);
    		$firstPlanejadoFases = ($arrayFirstPlanejado[0]['data_ini_planejada'] != '') ? $arrayFirstPlanejado[0]['data_ini_planejada'] : 0;
    		
    		
    		$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
    		
    		$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
    		
    		$data_termino = new DateTime($item['data_ini_pas']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data_fim_pas = $data_termino->format('Y-m-d');
    		
    		$data_termino = new DateTime($item['data_ini_planejada']);
    		$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
    		$data_fim_planejada = $data_termino->format('Y-m-d');
    		
    		if($i == 3){
    			//echo 'data ini pas '.$item['data_ini_pas'];
    			//echo ' data fim pas'. $data_fim_pas;
    		}
    		// MONTANDO A LEGENDA
    		if($first){
    			
    			
    			$first = false;
    			$legendArray = array( 'Executado' => '#cc3300', 'Contratado' => '#009933' , 'Planejado 1' => '#fad201', 'Planejado 2' => '#005580');
    			
    			/*
    			$this->load->model('statusdao');
    			$status = new statusdao();
    			$tmpStatus = $status->get_status_for_legenda();
    			
    			foreach($tmpStatus as $itemStatus)
    			{
    				$legendArray[$itemStatus['titulo']] = $itemStatus['color'];
    			};
    			*/
    			$out['rows'][] = array('c' => array(
    					array('v' => "Data Atual"),
    					array('v' => "Hoje"),
    					array('v' => "Hoje"),
    					array('v' => "Date(".$currentDate.")"),
    					array('v' => "Date(".$currentDate.")")
    			));
    			
    			$iniDate = $item['data_ini_pas'];
    			
    			foreach($legendArray as $leg_row => $leg_color ){
    				
    				$leg_data_termino = new DateTime($iniDate);
    				$leg_data_termino->add(new DateInterval('P160D'));
    				$leg_data_fim_pas = $leg_data_termino->format('Y-m-d');
    				
    				$temp = explode("-", $iniDate);
    				$tempDate1 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$temp = explode("-", $leg_data_fim_pas);
    				$tempDate2 = $temp[0].','.($temp[1]-1).','.$temp[2];
    				
    				$out['rows'][] = array('c' => array(
    						array('v' => 'LEGENDA'),
    						array('v' => $leg_row),
    						array('v' => $leg_row),
    						array('v' => "Date(".$tempDate1.")"),
    						array('v' => "Date(".$tempDate2.")")
    				));
    				
    				$iniDate = $leg_data_fim_pas;
    			}
    			//break;
    			
    		}
    		
    		$temp = explode("-", $item['data_ini_pas']);
    		$tempTime = explode(" ", $temp[2]);
    		$temp[2] = $tempTime[0];
    		$item['data_ini_pas'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$temp = explode("-", $data_fim_pas);
    		$tempTime = explode(" ", $temp[2]);
    		$temp[2] = $tempTime[0];
    		$data_fim_pas = $temp[0].','.($temp[1]-1).','.$temp[2];
    		
    		$out['rows'][] = array('c' => array(
    				array('v' => $tmpLote),
    				array('v' => "Contratado"),
    				array('v' => null),
    				array('v' => "Date(".$item['data_ini_pas'].")"),
    				array('v' => "Date(".$data_fim_pas.")")
    		));
    		
    		$dfp = strtotime($data_fim_planejada);
    		$dfpf = strtotime($lastPlanejadoFases);
    		
    		if( $dfpf){
    			
    			$temp = explode("-", $item['data_ini_planejada']);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$item['data_ini_planejada'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $data_fim_planejada);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$data_fim_planejada = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $lastPlanejadoFases);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$lastPlanejadoFases = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $firstPlanejadoFases);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$firstPlanejadoFases = $temp[0].','.($temp[1]-1).','.$temp[2];    			
    			
    			$out['rows'][] = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Planejado 1"),
    					array('v' => null),
    					array('v' => "Date(".$item['data_ini_planejada'].")"),
    					array('v' => "Date(".$data_fim_planejada.")")
    			));
    			$out['rows'][] = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Planejado 2"),
    					array('v' => null),
    					array('v' => "Date(".$firstPlanejadoFases.")"),
    					array('v' => "Date(".$lastPlanejadoFases.")")
    			));
    			
    			
    		}else{
    			
    			$temp = explode("-", $item['data_ini_planejada']);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$item['data_ini_planejada'] = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$temp = explode("-", $data_fim_planejada);
    			$tempTime = explode(" ", $temp[2]);
    			$temp[2] = $tempTime[0];
    			$data_fim_planejada = $temp[0].','.($temp[1]-1).','.$temp[2];
    			
    			$out['rows'][] = array('c' => array(
    					array('v' => $tmpLote),
    					array('v' => "Planejado 1"),
    					array('v' => null),
    					array('v' => "Date(".$item['data_ini_planejada'].")"),
    					array('v' => "Date(".$data_fim_planejada.")")
    			));
    		}
    		
    		if(sizeof($tmpArrayExec) > 0){
    			$out['rows'][] = $tmpArrayExec;
    		}
    		
    		$i++;
    	}
    	
    	echo json_encode(array('success' => 1, 'result' => $out, 'colorMap' => $legendArray));
    	exit;
    	
    }
    
    public function check_access($method){
    	
    	switch ($method) {
    		
    		case 'add' :
    			$type = 'editar';
    			break;
    			
    		case 'update' :
    			$type = 'editar';
    			break;
    			
    		case 'delete' :
    			$type = 'editar';
    			break;   
    			
    		default :
    			$type = 'visualizar';
    		break;
    			
    	}
    	
    	return $type;
    	
    }
    
	/*
	 *  Visualização de Evteas com acesso via contratos
	 */
    
	public function contratos(){
		
		$data = array();
		$data = array_merge($data, $this->get_acesso_user(true));
		
		$page = $this->uri->segment(3);
		$id_contrato = $this->uri->segment(4);
		
		 
		if($id_contrato == null){
			$data['contratos']= $this->pasdao->get_contratos_pas($id_contrato);
			
			$this->load->model('contratosdao');
			$contrato = new contratosdao();
			
			$i = 0;
			foreach($data['contratos'] as $item)
			{
				$tmpData = $contrato->get_contratos_from_SIAC_by_nm_contrato($item['contrato']);
				//$this->debugMark('teste', $tmpData);
				$data['contratos'][$i]['status'] = sizeof($tmpData) > 0 ? $tmpData[0]['DS_FAS_CONTRATO'] : '';
				$data['contratos'][$i]['empresa'] = sizeof($tmpData) > 0 ? $tmpData[0]['NO_EMPRESA'] : '';
				$tmp = $this->pasdao->count_pas_by_id_contrato($item['id']);
				$data['contratos'][$i]['iniciados'] = $tmp['count'];
				$data['contratos'][$i]['extensao'] = $tmp['extensao'];
				$i++;
			}
			//$this->debugMark('contratos', $data['contratos']);
			$data['main_content'] = 'admin/pas/list_contratos';
			
		}else{
			
			$data = array_merge($data, $this->foreingControllersContratos());
			
			// mostra os dados do PAS em uma nova visualização
			// INICIO PAS CONTRATOS ID
			$data['id_contrato'] = $id_contrato;
			$this->load->model('pasdao');
			$data['pas'] = $this->pasdao->get_pas_by_id_contrato($id_contrato);
			
			$this->load->model('pas_trechosdao');
			
			
			$i = 0;
			$tmpArray = array();
			$tmpFaseArray = array();
			
			//$pasFases = new pas_fases();
			// GET ALL DATA TO POPULATE CRONOGRAMA
			foreach($data['pas'] as $item){
	        	$tmpFaseArray = $this->pas_fasesdao->get_pas_fases_by_id_pas($item['id']);
	        	$tmpArray = array();
	        	foreach($tmpFaseArray as $row){
	        		// REPETIR ESSE METODO PARA O SISTEMA N FICAR DESLOGANDO (TESTAR)
	        		$tmpArray[] = $this->get_progresso_by_pas_fase($row['id']);
	        	}
	        	//echo '<br>';
	        	$progressoTotalSoma =  array_sum($tmpArray);
	        	//echo '<br>';
	        	$totalFases = sizeof($tmpArray) ;
	        	//echo '<br>';
	        	//$this->PAR($tmpArray);
	        	
	        	if($progressoTotalSoma AND $totalFases){
	        		$data['pas'][$i]['progresso_total'] = round( ($progressoTotalSoma/$totalFases) , 2);
	        		
	        		// verifica a data do primeiro movimento
	        		$arrayDataFirstMov = $this->pas_fases_movimentacaodao->get_first_movimentacao_by_id_pas($item['id']);
	        		
	        		$data['pas'][$i]['data_first_mov'] = ($arrayDataFirstMov)  ? $arrayDataFirstMov[0]['start_date'] : ' --- ';
	        		
	        		if($data['pas'][$i]['progresso_total'] >= 100){
	        			// verifica a data do ultimo movimento
	        			$arrayLastMov = $this->pas_fases_movimentacaodao->get_last_movimentacao_by_id_pas($item['id']);        			
	        			$data['pas'][$i]['data_last_mov'] = ($arrayLastMov)  ? $arrayLastMov[0]['data_protocolo'] : ' --- ';
	        		}
	        		
	        	}else{
	        		$data['pas'][$i]['progresso_total'] = 0;
	        	}
	        	
	        	
	        	$arrayTrechos = $this->pas_trechosdao->get_pas_trechos_label_by_id_pas($item['id']);
	        	if(sizeof($arrayTrechos) > 0){
	        		$firstTrecho = true;
	        		$labelTrecho = '';
	        		$ext = 0;
	        		foreach($arrayTrechos as $rowTrecho){
	        			if($firstTrecho){
	        				$firstTrecho = false;
	        				$labelTrecho = 'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
	        			}else{
	        				$labelTrecho .= ' e '.'BR-'.$rowTrecho['rodovia'].'/'.$rowTrecho['uf'];
	        			}
	        			$ext += $rowTrecho['extensao'];
	        		}
	        		$data['pas'][$i]['trechos'] = $labelTrecho;
	        		$data['pas'][$i]['extensao'] = $ext;
	        		
	        	}else{
	        		$data['pas'][$i]['trechos'] = ' --- ';
	        		$data['pas'][$i]['extensao'] = 'Não Disponível';
	        	}
	        	
	        	$arrayDiasCorridos = $this->pas_fasesdao->get_dias_corridos_by_id_pas($item['id']);
	        	$arrayDiasCorridos = ($arrayDiasCorridos[0]['total_dias'] != '') ? $arrayDiasCorridos[0]['total_dias'] : 0;
	        	
	        	$data_termino = new DateTime($data['pas'][$i]['data_ini_pas']);
	        	$data_termino->add(new DateInterval('P'.$arrayDiasCorridos.'D'));
	        	$data['pas'][$i]['data_fim_pas'] = $data_termino->format('Y-m-d');
	        	
	        	
	        	$tmpLastDataPlan = $this->pas_fasesdao->get_last_data_planejada_by_id_pas($item['id']);
	        	//$this->debugMark('data fim plan',$tmpLastDataPlan );
	        	$data['pas'][$i]['data_fim_planejada'] = $tmpLastDataPlan[0]['max'];
	        	
	        	//echo '<br>';
	        	$i++; 
	        	
	        	
	        }
			
			$data['main_content'] = 'admin/pas/list';
			
		}
		
		$data = array_merge($data, $this->foreingControllers());
		
		
		$this->load->view('includes/template', $data);
		
	}
	
	//public function 
    
	public function tempo_medio_status_lote_chart(){
		
		header('Content-type: application/json');
		
		$id = $this->uri->segment(3);
		
		// PAS FASES
		$data['pas_fases'] = $this->pas_fasesdao->get_pas_fases_by_id_pas($id);
		
		$legendArray = array( 'Inicio da Execução', 'Protocolo', 'Entregue para Análise', 'Em Análise', 'Em Revisão', 'RACP', 'RACD');
		
		//$this->debugMark(null, $arrayBuffTemp);
		//LOTE
		foreach($legendArray as $key => $item){
			$arrayBuff[$item] = 0;
		}
		
		//$this->debugMark(null, $arrayBuff);
		
		// MOVIMENTACAO DO DAS FASES DO PAS
		$this->load->model('pas_fases_movimentacaodao');
		$lastMov = new pas_fases_movimentacaodao();
		 
		// STATUS DAS FASES DO PAS
		$this->load->model('statusdao');
		$status = new statusdao();
		$data['status'] = $status->get_status(null,'id');
		 
		$status_option = array();
		foreach($data['status'] as $rowStatus){
			$status_option[$rowStatus['id']] = $rowStatus['titulo'];
		}
		
		$i = 0;
		$string = '';
		 
		$out = 	array( 'pas' =>
					array (
						'cols' => array (
								array('type' => 'string', 'label' => 'Movimento' ),
								array('type' => 'number', 'label' => 'Dias' )
						),
						'rows' => array()
					)
				);
			 
		$first = true;
		
		//$this->debugMark(null, $data['pas_fases']);
		
		foreach($data['pas_fases'] as $row){
		
		
			$tmpArrayMov = $lastMov->get_first_movimentacao_by_id_pas_fases($row['id']);
			
			if((sizeof($tmpArrayMov) > 0 AND $tmpArrayMov[0]['start_date'] != '' ) ){
				 
				$tmpArrayMov = $lastMov->get_pas_fases_movimentacao_by_id_pas_fases($row['id'], 'data_protocolo');
				//echo $row['fases'];
				//echo '<br>';
				$tempBuffArray = array();
				$tempBuffArrayProduto = array();
				
				
				foreach($legendArray as $key => $item){
					$tempBuffArray[$item] = 0;
				}
				
				foreach($legendArray as $key => $item){
					$arrayBuffProduto[$item] = 0;
				}
				foreach($legendArray as $key => $item){
					$tempBuffArrayProduto[$item] = 0;
				}
				
				
				
				//$this->debugMark('Array Movimento', $tmpArrayMov);
				$first = true;
				$end = false;
				foreach($tmpArrayMov as $movimento){
					if($first){
						 
						$tmpDate = $movimento['data_protocolo'];
						$tmpMov = $movimento['id_status'];
						$first = false;
						
						$out[$row['fases']] = array (
											'cols' => array (
													array('type' => 'string', 'label' => 'Movimento' ),
													array('type' => 'number', 'label' => 'Dias' )
											),
											'rows' => array()
									);
						
						//$this->debugMark(null, $out);
					}else{
							
							
						$tempTime = explode(" ", $tmpDate);
						$tempTime2 = explode(" ", $movimento['data_protocolo']);
						
						$diffDaysTemp = $this->diff_date_Db_Format($tempTime[0], $tempTime2[0]);
						
						//$this->debugMark(null, $arrayBuffProduto);
						// PRODUTO
						$arrayBuffProduto[$status_option[$tmpMov]] = $arrayBuffProduto[$status_option[$tmpMov]] + $diffDaysTemp;
						$tempBuffArrayProduto[$status_option[$tmpMov]] = $tempBuffArrayProduto[$status_option[$tmpMov]] + $diffDaysTemp;
						
						// LOTE
						$arrayBuff[$status_option[$tmpMov]] = $arrayBuff[$status_option[$tmpMov]] + $diffDaysTemp;
						$tempBuffArray[$status_option[$tmpMov]] = $tempBuffArray[$status_option[$tmpMov]] + $diffDaysTemp; 
						
						
						$tmpDate = $movimento['data_protocolo'];
						$tmpMov = $movimento['id_status'];
					}
					// TODO :  ALTERAR ISSO
					if($movimento['tipo'] == 'Final'){
							
						//$this->debugMark('Produto', $movimento);
		
						$diffDaysTemp = 1;
						$arrayBuffProduto[$status_option[$tmpMov]] = 1;
						$tempBuffArrayProduto[$status_option[$tmpMov]] = 1;
						//LOTE
						$arrayBuff[$status_option[$tmpMov]] = 1;
						$tempBuffArray[$status_option[$tmpMov]] = 1;
						
						$end = true;
					}
				}
				 
				if(!$end){
					if(strtotime($movimento['data_protocolo']) > strtotime(date('Y-m-d')) ){
						$lastDate = $movimento['data_protocolo'];
					}else{
						$lastDate = date('Y-m-d');
							
					}
		
					$tempTime = explode(" ", $movimento['data_protocolo']);
					
					$diffDaysTemp = $this->diff_date_Db_Format($tempTime[0], $lastDate);
					
					//produto
					$arrayBuffProduto[$status_option[$tmpMov]] = $arrayBuffProduto[$status_option[$tmpMov]] + $diffDaysTemp;
					$tempBuffArrayProduto[$status_option[$tmpMov]] = $tempBuffArrayProduto[$status_option[$tmpMov]] + $diffDaysTemp;
					
					//lote
					$arrayBuff[$status_option[$tmpMov]] = $arrayBuff[$status_option[$tmpMov]] + $diffDaysTemp;
					$tempBuffArray[$status_option[$tmpMov]] = $tempBuffArray[$status_option[$tmpMov]] + $diffDaysTemp;
		
		
					$end = false;
				}
				 
				
				foreach($arrayBuffProduto as $key => $value){
						
					$out[$row['fases']]['rows'][] = array('c' => array(
							array('v' => $key),
							array('v' => $value)
					));
						
				}
				
				$arrayBuffProduto = array();
				$tempBuffArrayProduto = array();
				
				
			}
		
			$i++;
		}
		
		//die;
		
		
		foreach($arrayBuff as $key => $value){
			
			$out['pas']['rows'][] = array('c' => array(
					array('v' => $key),
					array('v' => $value)
			));
			
		}
		
		;
		
		$resp = array('success' => 1, 'lote' => $out['pas']);
		unset($out['pas']);
		$resp['produtos'] =  $out;
		//$this->debugMark(null, $out);
		echo json_encode($resp);
		exit;
	}
	
	public function tempo_medio_status_produto_chart(){
		header('Content-type: application/json');
	
		echo json_encode(array('success' => 1, 'result' => $out));
		exit;
	}
	
	// relatorios
	public function get_tempo_medio_movimento_produto($id_fase){
		
		$data = array();
		
		$this->debugMark('dados', $data);
	}
	
	
	
}






