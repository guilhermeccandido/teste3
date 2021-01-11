<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class pas_prazos_fases extends App_controller {
const VIEW_FOLDER = 'admin/pas_prazos_fases';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_prazos_fasesdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_pas_prazos'] = $id;
    	 
    	$this->load->model('pas_prazos_fasesdao');
    	$ant = new pas_prazos_fasesdao();
    	 
    	$data['pas_prazos_fases'] = $ant->get_pas_prazos_fases_by_id_pas_prazos($id);
    	//$this->PAR($data['pas_prazos_fases']);
    	
    	$data = array_merge($data, $this->foreingControllers($id));
    
        //load the view
        $data['main_content'] = 'admin/pas_prazos_fases/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_pas_prazos = $this->uri->segment(4);
    	$data['id_pas_prazos'] = $id_pas_prazos;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_pas_prazos', 'id_pas_prazos', 'required'); 
        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required');
        	$this->form_validation->set_rules('prazo', 'prazo', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('id_pas_prazos' => $this->input->post('id_pas_prazos'),'id_fases' => $this->input->post('id_fases'),'prazo' => $this->input->post('prazo'),
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_prazos_fasesdao->store_pas_prazos_fases($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['fases'] = $this->pas_prazos_fasesdao->get_fases_not_related_pas_prazos_by_id_pas_prazos($id_pas_prazos);
        //$this->PAR($data['fases']);
        $data = array_merge($data, $this->foreingControllers($id_pas_prazos));
        
        //load the view
        $data['main_content'] = 'admin/pas_prazos_fases/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_pas_prazos = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_pas_prazos', 'id_pas_prazos', 'required');
        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required');
        	$this->form_validation->set_rules('prazo', 'prazo', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'id_pas_prazos' => $this->input->post('id_pas_prazos'),
		        	'id_fases' => $this->input->post('id_fases'),
		        	'prazo' => $this->input->post('prazo'),
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_prazos_fasesdao->update_pas_prazos_fases($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas_prazos_fases/update/'.$id.'/'.$id_pas_prazos);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['pas_prazos_fases'] = $this->pas_prazos_fasesdao->get_pas_prazos_fases_by_id($id);
        		
        $data['fases'] = $this->pas_prazos_fasesdao->get_fases_not_related_pas_prazos_by_id_pas_prazos($id_pas_prazos, $data['pas_prazos_fases'][0]['id_fases']);
        //$this->PAR($data['fases']);		
        $data = array_merge($data, $this->foreingControllers($id_pas_prazos));
        		
        //load the view
        $data['main_content'] = 'admin/pas_prazos_fases/edit';
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
    	$id_pas_prazos = $this->uri->segment(5);
        $this->pas_prazos_fasesdao->delete_pas_prazos_fases($id);
        redirect('admin/pas_prazos_fases/'.$id_pas_prazos);
    }//edit
    
    function foreingControllers($id){
    	
    	$this->load->model('pas_prazosdao');
    	$prazos = new pas_prazosdao();
    	$data['prazo'] = $prazos->get_pas_prazos_by_id($id);    	
    	
    	$this->load->model('contratosdao');
    	$contratos = new contratosdao();
    	$data['contrato'] = $contratos->get_contratos_by_id($data['prazo'][0]['id_contrato']);
    	
    	return $data;
    }
    
}