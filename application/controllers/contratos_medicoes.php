<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class contratos_medicoes extends App_controller {
const VIEW_FOLDER = 'admin/contratos_medicoes';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contratos_medicoesdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_contratos'] = $id;

		$this->load->model('contratosdao');
		$contrato = new contratosdao();
		$arrayTemp = $contrato->get_contratos_by_id($id);
		$data['contrato'] =  isset($arrayTemp[0]) ? $arrayTemp[0] : null;    	
    	
    	$this->load->model('contratos_medicoesdao');
    	$ant = new contratos_medicoesdao();
    	 
    	$data['contratos_medicoes'] = $ant->get_contratos_medicoes_by_id_contratos($data['contrato']['contrato']);
    	//$this->PAR($data['contratos_medicoes']);
    
        //load the view
        $data['main_content'] = 'admin/contratos_medicoes/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
  		$id_contratos = $this->uri->segment(4);
  		$data['id_contratos'] = $id_contratos;
  		
  		
  		$this->load->model('contratosdao');
  		$contrato = new contratosdao();
  		$arrayTemp = $contrato->get_contratos_by_id($id_contratos);
  		$data['contrato'] = isset($arrayTemp[0]) ? $arrayTemp[0] : null;
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('n_medicao', 'n_medicao', 'required'); 
        	$this->form_validation->set_rules('data_termino_medicao', 'data_termino_medicao', 'required'); 
        	$this->form_validation->set_rules('data_processamento_medicao', 'data_processamento_medicao', 'required'); 
        	$this->form_validation->set_rules('valor_medido_pi', 'valor_medido_pi', 'required'); 
        	$this->form_validation->set_rules('valor_medido_pi_r', 'valor_medido_pi_r', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'contrato' => $data['contrato']['contrato'],
                		'n_medicao' => $this->input->post('n_medicao'),
                		'data_termino_medicao' => $this->input->post('data_termino_medicao'),
                		'data_processamento_medicao' => $this->input->post('data_processamento_medicao'),
                		'valor_medido_pi' => str_replace(',', '.', $this->input->post('valor_medido_pi')),
                		'valor_medido_pi_r' => str_replace(',', '.', $this->input->post('valor_medido_pi_r')),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->contratos_medicoesdao->store_contratos_medicoes($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }	
                		
        //load the view
        $data['main_content'] = 'admin/contratos_medicoes/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        $id = $this->uri->segment(4);
  		$id_contratos = $this->uri->segment(5);
  		$data['id_contratos'] = $id_contratos;
  		
  		$this->load->model('contratosdao');
  		$contrato = new contratosdao();
  		$arrayTemp = $contrato->get_contratos_by_id($id_contratos);
  		$data['contrato'] = isset($arrayTemp[0]) ? $arrayTemp[0] : null;
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('n_medicao', 'n_medicao', 'required');
        	$this->form_validation->set_rules('data_termino_medicao', 'data_termino_medicao', 'required');
        	$this->form_validation->set_rules('data_processamento_medicao', 'data_processamento_medicao', 'required');
        	$this->form_validation->set_rules('valor_medido_pi', 'valor_medido_pi', 'required');
        	$this->form_validation->set_rules('valor_medido_pi_r', 'valor_medido_pi_r', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                		'n_medicao' => $this->input->post('n_medicao'),
                		'data_termino_medicao' => $this->input->post('data_termino_medicao'),
                		'data_processamento_medicao' => $this->input->post('data_processamento_medicao'),
                		'valor_medido_pi' => str_replace(',', '.', $this->input->post('valor_medido_pi')),
                		'valor_medido_pi_r' => str_replace(',', '.', $this->input->post('valor_medido_pi_r')),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->contratos_medicoesdao->update_contratos_medicoes($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/contratos_medicoes/update/'.$id.'/'.$id_contratos);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['contratos_medicoes'] = $this->contratos_medicoesdao->get_contratos_medicoes_by_id($id);
        		
        		
        //load the view
        $data['main_content'] = 'admin/contratos_medicoes/edit';
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
    	$id_contratos = $this->uri->segment(5);
        $this->contratos_medicoesdao->delete_contratos_medicoes($id);
        redirect('admin/contratos_medicoes/'.$id_contratos);
    }//edit
    	}