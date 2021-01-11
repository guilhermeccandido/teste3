<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class fases_checklist extends App_controller {
const VIEW_FOLDER = 'admin/fases_checklist';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fases_checklistdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_fases'] = $id;
    	 
    	$this->load->model('fases_checklistdao');
    	$ant = new fases_checklistdao();
    	 
    	$data['fases_checklist'] = $ant->get_fases_checklist_by_id_fases($id);
    	//$this->PAR($data['fases_checklist']);
    
        //load the view
        $data['main_content'] = 'admin/fases_checklist/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_fases = $this->uri->segment(4);
    	$data['id_fases'] = $id_fases;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required'); 
        	$this->form_validation->set_rules('id_checklist', 'id_checklist', 'required');
        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required'); 
        	$this->form_validation->set_rules('id_checklist', 'id_checklist', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('id_fases' => $this->input->post('id_fases'),'id_checklist' => $this->input->post('id_checklist'),'id_fases' => $this->input->post('id_fases'),'id_checklist' => $this->input->post('id_checklist'),'descricao' => $this->input->post('descricao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->fases_checklistdao->store_fases_checklist($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['checklist'] = $this->fases_checklistdao->get_checklist_not_related_fases_by_id_fases($id_fases);
        //$this->PAR($data['checklist']);
                		
        //load the view
        $data['main_content'] = 'admin/fases_checklist/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_fases = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required');
        	$this->form_validation->set_rules('id_checklist', 'id_checklist', 'required');
		        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required'); 
		        	$this->form_validation->set_rules('id_checklist', 'id_checklist', 'required'); 
		        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'id_fases' => $this->input->post('id_fases'),
        	'id_checklist' => $this->input->post('id_checklist'),
        	'id_fases' => $this->input->post('id_fases'),
        	'id_checklist' => $this->input->post('id_checklist'),
        	'descricao' => $this->input->post('descricao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->fases_checklistdao->update_fases_checklist($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/fases_checklist/update/'.$id.'/'.$id_fases);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['fases_checklist'] = $this->fases_checklistdao->get_fases_checklist_by_id($id);
        		
        $data['checklist'] = $this->fases_checklistdao->get_checklist_not_related_fases_by_id_fases($id_fases, $data['fases_checklist'][0]['id_checklist']);
        //$this->PAR($data['checklist']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/fases_checklist/edit';
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
    	$id_fases = $this->uri->segment(5);
        $this->fases_checklistdao->delete_fases_checklist($id);
        redirect('admin/fases_checklist/'.$id_fases);
    }//edit
    	
    /*
    public function foreingControllers(){
    	
    	$this->load->model('');		
    			
    	return $data;
    	
    }
    	
     */
    	
    /*
    public function JSON_METHOD(){
    
    	header('Content-type: application/json');
   
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
     */
    	}