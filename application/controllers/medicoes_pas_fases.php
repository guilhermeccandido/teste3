<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class medicoes_pas_fases extends App_controller {
const VIEW_FOLDER = 'admin/medicoes_pas_fases';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('medicoes_pas_fasesdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$data['id_financeiro_medicoes'] = $this->uri->segment(3);
    	$id_financeiro_medicoes = $data['id_financeiro_medicoes'];
    	
    	$data = array_merge($data, $this->foreingControllers($id_financeiro_medicoes));
    	
    	$this->load->model('financeiro_medicoesdao');
    	$arraTemp = $this->financeiro_medicoesdao->get_financeiro_medicoes_by_id($id_financeiro_medicoes);
    	$data['id_registro_financeiro'] =$arraTemp[0]['id_registro_financeiro'];
    	
        $data['medicoes_pas_fases'] = $this->medicoes_pas_fasesdao->get_medicoes_pas_fases_by_id_financeiro_medicoes($id_financeiro_medicoes);
        
        //$this->debugMark('data', $data['medicoes_pas_fases'] );
        
        //load the view
        $data['main_content'] = 'admin/medicoes_pas_fases/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$data['id_financeiro_medicoes'] = $this->uri->segment(4);
    	$id_financeiro_medicoes = $data['id_financeiro_medicoes'];
    	
    	$data = array_merge($data, $this->foreingControllers($id_financeiro_medicoes));
    	
    	//$this->debugMark('data', $data);
    	
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        	
        		
        		foreach( $this->input->post() as $key => $posted){
        			
        			if( is_numeric($key)){
        				
        				$this->form_validation->set_rules('id_pas_fases_'.$key, "Identificador do Relacionamento do Produto/Subproduto", 'required');
        				$this->form_validation->set_rules('quantidade_'.$key, 'Quantidades', 'required');
        				$this->form_validation->set_rules('valor_'.$key, 'Valores', 'required');
        				
        			}
        		}
        		
        		//$this->debugMark(null,  $this->input->post());
        	
            //form validation
	        	
           		 $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
            	foreach( $this->input->post() as $key => $posted){
            		 
            		if( is_numeric($key)){
            	
            			$data_to_store[] = array(
            					'id_financeiro_medicoes' => $id_financeiro_medicoes,
            					'id_pas_fases' => $this->input->post('id_pas_fases_'.$key),
            					'id_subfases' => $this->input->post('id_subfases_'.$key) ? $this->input->post('id_subfases_'.$key) : 0,
            					'quantidade' => $this->input->post('quantidade_'.$key),
            					'valor' => $this->input->post('valor_'.$key),
            					'observacoes' => $this->input->post('observacoes_'.$key)
            			);
            		}
            	}
            	
            	//$this->debugMark(null,  $data_to_store);
            	
            	if($this->medicoes_pas_fasesdao->store_medicoes_pas_fases_bacth($data_to_store)){
            		$data['flash_message'] = TRUE;
            	}else{
            		$data['flash_message'] = FALSE;
            	}
            	
                //if the insert has returned true then we show the flash message
                

            }

        }
        //load the view
        $data['main_content'] = 'admin/medicoes_pas_fases/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    	
    	$id = $this->uri->segment(4);
    	$data['id_financeiro_medicoes'] = $this->uri->segment(5);
    	$id_financeiro_medicoes = $data['id_financeiro_medicoes'];
    	
    	$this->load->model('financeiro_medicoesdao');
    	$arraTemp = $this->financeiro_medicoesdao->get_financeiro_medicoes_by_id($id_financeiro_medicoes);
    	$data['id_registro_financeiro'] =$arraTemp[0]['id_registro_financeiro'];
    	
    	$data = array_merge($data, $this->foreingControllers($id_financeiro_medicoes));
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
			        	
			        	$this->form_validation->set_rules('quantidade', 'quantidade', 'required'); 
			        	$this->form_validation->set_rules('valor', 'valor', 'required'); 
			        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'quantidade' => $this->input->post('quantidade'),
		        	'valor' => $this->input->post('valor'),
		        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->medicoes_pas_fasesdao->update_medicoes_pas_fases($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/medicoes_pas_fases/update/'.$id.'/'.$id_financeiro_medicoes.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['medicoes_pas_fases'] = $this->medicoes_pas_fasesdao->get_medicoes_pas_fases_by_id($id);
        //load the view
        $data['main_content'] = 'admin/medicoes_pas_fases/edit';
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
        $data['id_financeiro_medicoes'] = $this->uri->segment(5);
        $id_financeiro_medicoes = $data['id_financeiro_medicoes'];
        
        $this->load->model('financeiro_medicoesdao');
        $arraTemp = $this->financeiro_medicoesdao->get_financeiro_medicoes_by_id($id_financeiro_medicoes);
        $data['id_registro_financeiro'] = $arraTemp[0]['id_registro_financeiro'];
        
        $this->medicoes_pas_fasesdao->delete_medicoes_pas_fases($id);
        redirect('admin/medicoes_pas_fases/'.$id_financeiro_medicoes);
    }//edit    			
    	
    
    public function foreingControllers($id_financeiro_medicoes){
    	
    	$this->load->model('financeiro_medicoesdao');
    	$arrayTemp = $this->financeiro_medicoesdao->get_financeiro_medicoes_by_id($id_financeiro_medicoes);
    	 
    	$data['id_registro_financeiro'] = $arrayTemp[0]['id_registro_financeiro'];
    	$data['data_medicao'] = $arrayTemp[0]['data'];
    	
    	$this->load->model('financeiro_fases_subfasesdao');
    	$financeiro = new financeiro_fases_subfasesdao();
    	$data['fases_subfases'] = $financeiro->get_financeiro_fases_subfases_by_id_registro_financeiro($data['id_registro_financeiro']);
    	
    	$this->load->model('registro_financeirodao');
    	$registro = new registro_financeirodao();
    	$arrayTemp = $registro->get_registro_financeiro_by_id($data['id_registro_financeiro']);
    	
    	$data['id_contrato'] = $arrayTemp[0]['id_contrato'];
    	
    	$data['aproved'] = $this->medicoes_pas_fasesdao->get_all_aproved_by_base_date( $data['id_contrato'] , $data['data_medicao']  );
    	
    	$this->load->model('financeiro_reajustedao');
    	$reajuste = new financeiro_reajustedao();
    	$arrayTemp = $reajuste->get_financeiro_reajuste_by_id_registro_financeiro_data_base($data['id_registro_financeiro'], $data['data_medicao']);
    	
    	$data['reajuste'] = (sizeof($arrayTemp) > 0) ? $arrayTemp[0]['reajuste'] : 1;  
    	//$this->debugMark($data['data_medicao'], $data['reajuste']);
    	
    	$this->load->model('fasesdao');
    	$fases = new fasesdao();
    	$data['fases'] = $fases->get_fases(null, 'id');
    	
    	$this->load->model('subfasesdao');
    	$subfases = new subfasesdao();
    	$data['subfases'] = $subfases->get_subfases(null, 'id');
    	
    	
    	
    	//$this->debugMark(null, $data);
    	//$this->debugMark(null, $data['fases_subfases']);
    	
    			
    	return $data;
    	
    }
    	

    	
    /**
    * Delete product by his id
    * @return void
    */
    /*
    public function JSON_METHOD(){
    	 
    	header('Content-type: application/json');    	
    	
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    	 
    }
        		
     */   		
    	}