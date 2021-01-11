<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class contratos_empenhos extends App_controller {
const VIEW_FOLDER = 'admin/contratos_empenhos';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contratos_empenhosdao');

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
    	 
    	$this->load->model('contratos_empenhosdao');
    	$ant = new contratos_empenhosdao();

    	$this->load->model('contratosdao');
    	$contrato = new contratosdao();
    	$arrayTemp = $contrato->get_contratos_by_id($id); 
     	$data['contrato'] = isset($arrayTemp[0]) ? $arrayTemp[0] : null;
     	
    	$data['contratos_empenhos'] = $ant->get_contratos_empenhos_by_id_contratos($data['contrato']['contrato']);
    	//$this->PAR($data['contratos_empenhos']);
    
        //load the view
        $data['main_content'] = 'admin/contratos_empenhos/list';
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
        	$this->form_validation->set_rules('nota_empenho', 'nota_empenho', 'required'); 
        	$this->form_validation->set_rules('data_emissao_empenho', 'data_emissao_empenho', 'required'); 
        	$this->form_validation->set_rules('valor_empenho_inicial', 'valor_empenho_inicial', 'required'); 
        	$this->form_validation->set_rules('valor_empenho_consumido', 'valor_empenho_consumido', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'contrato' => $data['contrato']['contrato'],
                		'nota_empenho' => $this->input->post('nota_empenho'),
                		'data_emissao_empenho' => $this->input->post('data_emissao_empenho'),
                		'data_emissao_empenho' => str_replace(',', '.', $this->input->post('data_emissao_empenho')),
			        	'valor_empenho_inicial' => str_replace(',', '.', $this->input->post('valor_empenho_inicial')) ,
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->contratos_empenhosdao->store_contratos_empenhos($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        //load the view
        $data['main_content'] = 'admin/contratos_empenhos/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
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
        	$this->form_validation->set_rules('nota_empenho', 'nota_empenho', 'required');
        	$this->form_validation->set_rules('data_emissao_empenho', 'data_emissao_empenho', 'required');
        	$this->form_validation->set_rules('valor_empenho_inicial', 'valor_empenho_inicial', 'required');
        	$this->form_validation->set_rules('valor_empenho_consumido', 'valor_empenho_consumido', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
			        	'contrato' => $data['contrato']['contrato'],
			        	'nota_empenho' => $this->input->post('nota_empenho'),
			        	'data_emissao_empenho' => str_replace(',', '.', $this->input->post('data_emissao_empenho')),
			        	'valor_empenho_inicial' => str_replace(',', '.', $this->input->post('valor_empenho_inicial')) ,
			        	'valor_empenho_consumido' => $this->input->post('valor_empenho_consumido'),
			        	'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->contratos_empenhosdao->update_contratos_empenhos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/contratos_empenhos/update/'.$id.'/'.$id_contratos);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['contratos_empenhos'] = $this->contratos_empenhosdao->get_contratos_empenhos_by_id($id);
        		
       			
        //load the view
        $data['main_content'] = 'admin/contratos_empenhos/edit';
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
        $this->contratos_empenhosdao->delete_contratos_empenhos($id);
        redirect('admin/contratos_empenhos/'.$id_contratos);
    }//edit
    	
}