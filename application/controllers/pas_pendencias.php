<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class pas_pendencias extends App_controller {
const VIEW_FOLDER = 'admin/pas_pendencias';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_pendenciasdao');

        
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_pas'] = $id;
    	 
    	$this->load->model('pas_pendenciasdao');
    	$ant = new pas_pendenciasdao();
    	 
    	$data['pas_pendencias'] = $ant->get_pas_pendencias_by_id_pas($id);
    	//$this->PAR($data['pas_pendencias']);
    
        //load the view
        $data['main_content'] = 'admin/pas_pendencias/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_pas', 'id_pas', 'required'); 
        	$this->form_validation->set_rules('id_pendencias', 'id_pendencias', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
        	$this->form_validation->set_rules('responsabilidade', 'responsabilidade', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_pas' => $this->input->post('id_pas'),
                		'id_pendencias' => $this->input->post('id_pendencias'),
                		'titulo' => $this->input->post('titulo'),
                		'responsabilidade' => $this->input->post('responsabilidade'),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_pendenciasdao->store_pas_pendencias($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['pendencias'] = $this->pas_pendenciasdao->get_pendencias_not_related_pas_by_id_pas($id_pas);
        //$this->PAR($data['pendencias']);
                		
        //load the view
        $data['main_content'] = 'admin/pas_pendencias/add';
        $this->load->view('includes/template', $data);
    }
    

    public function add_json(){
    
    	header('Content-type: application/json');
    	
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	 
    	$data_to_store = $this->deserialize($this->input->post('post'));
    	 
    	$this->pas_pendenciasdao->store_pas_pendencias($data_to_store);
    
    	$data['pendencias'] = $this->pas_pendenciasdao->get_pas_pendencias_by_id_pas($id_pas);
    	 
    	$this->load->model('pendenciasdao');
    	$listPendencias = new pendenciasdao();
    	$data['lista_pendencias'] = $listPendencias->get_pendencias(null, 'id');
    
    
    	//load the view
    	$this->load->view('admin/pas/list_pendencias', $data);
    	/*
    	 //$this->PAR($editData);
    	die;
    	$myJSON = json_encode();
    	echo($myJSON);
    	*/
    
    }
    
    
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_pas = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_pas', 'id_pas', 'required');
        	$this->form_validation->set_rules('id_pendencias', 'id_pendencias', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('responsabilidade', 'responsabilidade', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'id_pas' => $this->input->post('id_pas'),
        	'id_pendencias' => $this->input->post('id_pendencias'),
        	'titulo' => $this->input->post('titulo'),
        	'responsabilidade' => $this->input->post('responsabilidade'),
        	'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_pendenciasdao->update_pas_pendencias($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas_pendencias/update/'.$id.'/'.$id_pas);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['pas_pendencias'] = $this->pas_pendenciasdao->get_pas_pendencias_by_id($id);
        		
        $data['pendencias'] = $this->pas_pendenciasdao->get_pendencias_not_related_pas_by_id_pas($id_pas, $data['pas_pendencias'][0]['id_pendencias']);
        //$this->PAR($data['pendencias']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/pas_pendencias/edit';
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
    	$id_pas = $this->uri->segment(5);
        $this->pas_pendenciasdao->delete_pas_pendencias($id);
        redirect('admin/pas_pendencias/'.$id_pas);
    }//edit
    	}