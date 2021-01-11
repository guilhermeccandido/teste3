<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class pas_trechos extends App_controller {
const VIEW_FOLDER = 'admin/pas_trechos';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_trechosdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_pas'] = $id;
    	
    	
    	$data['pas_trechos'] = $this->pas_trechosdao->get_pas_trechos_by_id_pas($id);
    	//$this->PAR($data['pas_trechos']);
    
    	
    	$data = array_merge($data, $this->foreingControllers($id));
    	
    	
        //load the view
        $data['main_content'] = 'admin/pas_trechos/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));			
    			
		$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_pas', 'id_pas', 'required');
        	$this->form_validation->set_rules('id_estados', 'id_estados', 'required');
        	$this->form_validation->set_rules('rodovia', 'rodovia', 'required');
        	$this->form_validation->set_rules('trecho', 'trecho', '');
        	$this->form_validation->set_rules('subtrecho', 'subtrecho', '');
        	$this->form_validation->set_rules('km_inicial', 'km_inicial', 'required');
        	$this->form_validation->set_rules('km_final', 'km_final', 'required');
        	$this->form_validation->set_rules('extensao', 'extensao', '');
        	$this->form_validation->set_rules('snv', 'snv', '');
        	$this->form_validation->set_rules('snv_versao', 'snv_versao', '');
        	$this->form_validation->set_rules('coordenadas', 'coordenadas', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
        	$this->form_validation->set_rules('erro', 'erro', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	
            	$kmIni = $this->input->post('km_inicial');
            	$kmFim = $this->input->post('km_final');
            	
            	if($this->input->post('extensao')){
            		$extensao = $this->input->post('extensao');
            	}else{
            		$extensao = ($kmIni > $kmFim ) ? ($kmIni - $kmFim) : ($kmFim - $kmIni);
            	}
            	
            	
            	
                $data_to_store = array(
                		'id_pas' => $this->input->post('id_pas'),
                		'id_estados' => $this->input->post('id_estados'),
                		'rodovia' => $this->input->post('rodovia'),
                		'trecho' => $this->input->post('trecho'),
                		'subtrecho' => $this->input->post('subtrecho'),
                		'km_inicial' => $this->input->post('km_inicial'),
                		'km_final' => $this->input->post('km_final'),
                		'extensao' => $extensao,
                		'snv' => $this->input->post('snv'),
                		'snv_versao' => $this->input->post('snv_versao'),
                		'coordenadas' => $this->input->post('coordenadas'),
                		'observacoes' => $this->input->post('observacoes'),
                		'erro' => $this->input->post('erro')
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_trechosdao->store_pas_trechos($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }

        $data = array_merge($data, $this->foreingControllers($id_pas));
                		
        //load the view
        $data['main_content'] = 'admin/pas_trechos/add';
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
        	$this->form_validation->set_rules('id_estados', 'id_estados', 'required');
        	$this->form_validation->set_rules('rodovia', 'rodovia', 'required');
        	$this->form_validation->set_rules('trecho', 'trecho', '');
        	$this->form_validation->set_rules('subtrecho', 'subtrecho', '');
        	$this->form_validation->set_rules('km_inicial', 'km_inicial', 'required');
        	$this->form_validation->set_rules('km_final', 'km_final', 'required');
        	$this->form_validation->set_rules('extensao', 'extensao', '');
        	$this->form_validation->set_rules('snv', 'snv', '');
        	$this->form_validation->set_rules('snv_versao', 'snv_versao', '');
        	$this->form_validation->set_rules('coordenadas', 'coordenadas', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
        	$this->form_validation->set_rules('erro', 'erro', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {

            	$kmIni = $this->input->post('km_inicial');
            	$kmFim = $this->input->post('km_final');
            	if($this->input->post('extensao')){
            		$extensao = $this->input->post('extensao');
            	}else{
            		$extensao = ($kmIni > $kmFim ) ? ($kmIni - $kmFim) : ($kmFim - $kmIni);
            	}
            	
            	
            	
                $data_to_store = array(
		        	'id_pas' => $this->input->post('id_pas'),
		        	'id_estados' => $this->input->post('id_estados'),
		        	'rodovia' => $this->input->post('rodovia'),
                	'trecho' => $this->input->post('trecho'),
                	'subtrecho' => $this->input->post('subtrecho'),
		        	'km_inicial' => $this->input->post('km_inicial'),
		        	'km_final' => $this->input->post('km_final'),
		        	'extensao' => $extensao,
                	'snv' => $this->input->post('snv'),
                	'snv_versao' => $this->input->post('snv_versao'),
                	'coordenadas' => $this->input->post('coordenadas'),
		        	'observacoes' => $this->input->post('observacoes'),
                	'erro' => $this->input->post('erro')
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_trechosdao->update_pas_trechos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas_trechos/update/'.$id.'/'.$id_pas);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['pas_trechos'] = $this->pas_trechosdao->get_pas_trechos_by_id($id);
        		
        $data = array_merge($data, $this->foreingControllers($id_pas));
        		
        		
        //load the view
        $data['main_content'] = 'admin/pas_trechos/edit';
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
        $this->pas_trechosdao->delete_pas_trechos($id);
        redirect('admin/pas_trechos/'.$id_pas);
    }//edit

    
    public function foreingControllers($id_pas){
    	
    	$this->load->model('estadosdao');
    	$data['estados'] = $this->estadosdao->get_estados(null, 'uf');
    	
    	$this->load->model('pasdao');
    	$arrayPas = $this->pasdao->get_pas_by_id($id_pas);
    	$data['pas'] = $arrayPas[0];
    	//$this->debugMark(null, $data['pas']);
    	return $data;
    	
    }
    
}