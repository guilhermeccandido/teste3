<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class pas_fases extends App_controller {
const VIEW_FOLDER = 'admin/pas_fases';

	private $movdao = null; 

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_fasesdao');
        $this->load->model('pas_fases_movimentacaodao');
        $this->movdao = new pas_fases_movimentacaodao();

        
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_pas'] = $id;
    	 
    	$this->load->model('pas_fasesdao');
    	$ant = new pas_fasesdao();
    	 
    	$data['pas_fases'] = $ant->get_pas_fases_by_id_pas($id);
    	
    	$data['pas_fases_not_defined'] = $ant->get_fases_not_related_pas_by_id_pas($id);
    	
    	$this->load->model('pas_fases_movimentacaodao');
    	$lastMov = new pas_fases_movimentacaodao();
    	
    	$i = 0;
    	foreach($data['pas_fases'] as $item){
    		
    		$tmpArray = $lastMov->get_first_movimentacao_by_id_pas_fases($item['id']);    		
    		$data['pas_fases'][$i]['start_date']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    		
    		
    		$tmpArray = $lastMov->get_last_movimentacao_by_id_pas_fases($item['id']);    		
    		$data['pas_fases'][$i]['lastmov']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    		
    		//$this->PAR($tmpArray);
    		
    		$tmpArray = $lastMov->get_last_avaliation_by_id_fases($item['id']);
    		$data['pas_fases'][$i]['last_avaliation']  = (sizeof($tmpArray) > 0 ) ? $tmpArray[0] : array();
    		
    		if(sizeof($tmpArray) > 0 ) {
    			$data['pas_fases'][$i]['last_avaliation']  = $tmpArray[0];
    			$peso = ($tmpArray[0]['peso']) ? $tmpArray[0]['peso'] : 0;
    		}else{
    			$data['pas_fases'][$i]['last_avaliation']  = array();
    			$peso = null;
    		}
    		
    		// APROVEITA-SE A CONSULTA ANTERIOR PARA POPULAR O VALOR DO PESO
    		$data['pas_fases'][$i]['progresso']  = $this->get_progresso_by_pas_fase($item['id'], $peso);
    		
    		//$this->PAR($tmpArray);
    			 
    		$i++;
    		
    	}
    	//$this->PAR($data['pas_fases']);
    	//die;
    	$data = array_merge($data, $this->foreingControllers($id));
    	
    	
    	//$this->PAR($data['pas_fases']);
    	//die;
    
        //load the view
        $data['main_content'] = 'admin/pas_fases/list';
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
    			
		$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	
    	$id_fase = $this->uri->segment(5);
    	$data['id_fase'] = $id_fase;
    			
    	$data = array_merge($data, $this->foreingControllers($id_pas));
    	
    	
    	
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_pas', 'id_pas', 'required'); 
        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required');
        	$this->form_validation->set_rules('id_responsavel', 'id_responsavel', '');
        	$this->form_validation->set_rules('prazo', 'prazo', 'required');
        	$this->form_validation->set_rules('data_ini', 'data_ini', 'required');
        	$this->form_validation->set_rules('data_ini_planejada', 'data_ini_planejada', 'required');
        	$this->form_validation->set_rules('id_prioridade', 'id_prioridade', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
            	$prazo  = $this->input->post('prazo');
            	// data registrada para o início do PAS
            	$data_ini = $this->input->post('data_ini');
            	$data_termino = new DateTime($data_ini);
            	$data_termino->add(new DateInterval('P'.$prazo.'D'));
            	$data_fim = $data_termino->format('Y-m-d');
            	
            	$inicio = $this->input->post('data_ini_planejada');
            	$data_termino = new DateTime($inicio);
            	$data_termino->add(new DateInterval('P'.$prazo.'D'));
            	$data_fim_planejada = $data_termino->format('Y-m-d');
            	
                $data_to_store = array(
                		'id_pas' => $this->input->post('id_pas'),
                		'id_fases' => $this->input->post('id_fases'),
                		'id_responsavel' => $this->input->post('id_responsavel'),
                		'prazo' => $this->input->post('prazo'),
                		'data_ini' => $data_ini,
                		'data_ini_planejada' => $this->input->post('data_ini_planejada'),
                		'data_fim' => $data_fim,
                		'data_fim_planejada' => $data_fim_planejada,
                		'id_prioridade' => $this->input->post('id_prioridade'),
                		'observacoes' => $this->input->post('observacoes')
                );
                
               //$this->PAR($data_to_store);
                //DIE;
                
                //if the insert has returned true then we show the flash message
                if($this->pas_fasesdao->store_pas_fases($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
        
        $data['fases'] = $this->pas_fasesdao->get_fases_not_related_pas_by_id_pas($id_pas);
        if(sizeof($data['fases']) > 0 ){
			// busca a data final do grupo anterior, caso n encontre, insere a data inicial do pas
			$tmpArray = $this->pas_fasesdao->get_last_date_inserted_by_id_pas_grupo($id_pas, ($data['fases'][0]['grupo'] - 1 ) );
			$data['data_ini_planejada'] = (sizeof($tmpArray) > 0 ) ? $tmpArray[0]['data_fim_atividade'] : $data['data_ini_planejada'];
			
			$tmpArray = $this->pas_fasesdao->get_last_date_inserted_by_id_pas_grupo_edital($id_pas, ($data['fases'][0]['grupo'] - 1 ) );
			$data['data_ini'] = (sizeof($tmpArray) > 0 ) ? $tmpArray[0]['data_fim_atividade'] : $data['data_ini'];
		}else{
		
        
			$data['data_ini_planejada'] = $data['data_ini_planejada'];
			$data['data_ini'] =  $data['data_ini'];
		}
        
        
        //load the view
        $data['main_content'] = 'admin/pas_fases/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));	
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_pas = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_pas', 'id_pas', 'required');
        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required');
        	$this->form_validation->set_rules('id_responsavel', 'id_responsavel', 'required');
        	$this->form_validation->set_rules('data_ini', 'data_ini', '');
        	$this->form_validation->set_rules('data_ini_planejada', 'data_ini_planejada', '');
        	$this->form_validation->set_rules('data_fim', 'data_fim', '');
        	$this->form_validation->set_rules('data_fim_planejada', 'data_fim_planejada', '');
        	$this->form_validation->set_rules('id_prioridade', 'id_prioridade', 'required');
        	$this->form_validation->set_rules('prazo', 'prazo', 'required');
        	
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
                $data_to_store = array(
		        	'id_pas' => $this->input->post('id_pas'),
		        	'id_fases' => $this->input->post('id_fases'),
                	'id_responsavel' => $this->input->post('id_responsavel'),
                	'prazo' => $this->input->post('prazo'),
                	'data_ini' => $this->input->post('data_ini'),
		        	'data_ini_planejada' => $this->input->post('data_ini_planejada'),
                	'data_fim' => $this->input->post('data_fim'),
                	'data_fim_planejada' => $this->input->post('data_fim_planejada'),
                	'id_prioridade' => $this->input->post('id_prioridade'),
		        	'observacoes' => $this->input->post('observacoes'),
                );
                //$this->debugMark($id, $data_to_store );
               // $this->PAR($data_to_store);
               // DIE;
                //if the insert has returned true then we show the flash message
                if($this->pas_fasesdao->update_pas_fases($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas_fases/update/'.$id.'/'.$id_pas);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['pas_fases'] = $this->pas_fasesdao->get_pas_fases_by_id($id);
        //$this->debugMark('Teste', $data['pas_fases']);		
        $data['fases'] = $this->pas_fasesdao->get_fases_not_related_pas_by_id_pas($id_pas, $data['pas_fases'][0]['id_fases']);
        //$this->PAR($data['fases']);		
        
        $data = array_merge($data, $this->foreingControllers($id_pas));
        		
        //load the view
        $data['main_content'] = 'admin/pas_fases/edit';
        $this->load->view('includes/template', $data);
    
    }//update
    	
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
    
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));
    					
        $id = $this->uri->segment(4);
    	$id_pas = $this->uri->segment(5);
        $this->pas_fasesdao->delete_pas_fases($id);
        redirect('admin/pas_fases/'.$id_pas);
    }//edit
    
    
    public function foreingControllers($id){
    
    	
    	$this->load->model('statusdao');
    	$status = new statusdao();
    	$data['status'] = $status->get_status(null,'id');
    	 
    	 
    	$this->load->model('avaliacoesdao');
    	$avaliacoes = new avaliacoesdao();
    	$data['avaliacoes'] = $avaliacoes->get_avaliacoes(null,'id');
    	
    	
    	// TODO :  temporario para responsável
    	
    	$this->load->model('usuariosdao');
    	$responsavel = new usuariosdao();
    	$data['responsaveis'] = $responsavel->get_usuarios(null, 'nome');
    	
    	$this->load->model('pasdao');
    	$pas = new pasdao();
    	$tmpArray = $pas->get_pas_by_id($id);
    	
    	$this->load->model('prioridadesdao');
    	$prioridades = new prioridadesdao();
    	$data['prioridades'] = $prioridades->get_prioridades(null, 'peso', 'asc');
    	
    	//$this->debugMark('Teste', $pasArray);
    	
    	$data['id_responsavel'] = (isset($tmpArray[0]['id_responsavel'])) ? $tmpArray[0]['id_responsavel'] : 0;
    	$data['lote'] = (isset($tmpArray[0]['lote'])) ? $tmpArray[0]['lote'] : 0;
    	$data['pas_status'] = (isset($tmpArray[0]['status'])) ? $tmpArray[0]['status'] : 'Ativo';
    	$data['data_ini'] = (isset($tmpArray[0]['data_ini_pas'])) ? $tmpArray[0]['data_ini_pas'] : 0;
    	$data['data_ini_planejada'] = (isset($tmpArray[0]['data_ini_planejada'])) ? $tmpArray[0]['data_ini_planejada'] : 0;
    	
    	 
    	return $data;
    	 
    }
    
    
    	
}
