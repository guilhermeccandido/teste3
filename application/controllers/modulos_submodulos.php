<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class modulos_submodulos extends App_controller {
const VIEW_FOLDER = 'admin/modulos_submodulos';

    		public function __construct()
		    {
		        parent::__construct();
		        $this->load->model('modulos_submodulosdao');
		
		        if(!$this->session->userdata('logged_in')){
		            redirect('admin/login');
		        }
		    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_modulos'] = $id;
    	 
    	$this->load->model('modulos_submodulosdao');
    	$ant = new modulos_submodulosdao();
    	 
    	$data['modulos_submodulos'] = $ant->get_modulos_submodulos_by_id_modulos($id);
    	//$this->PAR($data['modulos_submodulos']);
    
        //load the view
        $data['main_content'] = 'admin/modulos_submodulos/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_modulos = $this->uri->segment(4);
    	$data['id_modulos'] = $id_modulos;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required'); 
        	$this->form_validation->set_rules('id_submodulos', 'id_submodulos', 'required');
        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required'); 
        	$this->form_validation->set_rules('id_submodulos', 'id_submodulos', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('id_modulos' => $this->input->post('id_modulos'),'id_submodulos' => $this->input->post('id_submodulos'),'id_modulos' => $this->input->post('id_modulos'),'id_submodulos' => $this->input->post('id_submodulos'),
                );
                //if the insert has returned true then we show the flash message
                if($this->modulos_submodulosdao->store_modulos_submodulos($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['submodulos'] = $this->modulos_submodulosdao->get_submodulos_not_related_modulos_by_id_modulos($id_modulos);
        //$this->PAR($data['submodulos']);
                		
        //load the view
        $data['main_content'] = 'admin/modulos_submodulos/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_modulos = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required');
        	$this->form_validation->set_rules('id_submodulos', 'id_submodulos', 'required');
		        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required'); 
		        	$this->form_validation->set_rules('id_submodulos', 'id_submodulos', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'id_modulos' => $this->input->post('id_modulos'),
        	'id_submodulos' => $this->input->post('id_submodulos'),
        	'id_modulos' => $this->input->post('id_modulos'),
        	'id_submodulos' => $this->input->post('id_submodulos'),
                );
                //if the insert has returned true then we show the flash message
                if($this->modulos_submodulosdao->update_modulos_submodulos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/modulos_submodulos/update/'.$id.'/'.$id_modulos);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['modulos_submodulos'] = $this->modulos_submodulosdao->get_modulos_submodulos_by_id($id);
        		
        $data['submodulos'] = $this->modulos_submodulosdao->get_submodulos_not_related_modulos_by_id_modulos($id_modulos, $data['modulos_submodulos'][0]['id_submodulos']);
        //$this->PAR($data['submodulos']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/modulos_submodulos/edit';
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
    	$id_modulos = $this->uri->segment(5);
        $this->modulos_submodulosdao->delete_modulos_submodulos($id);
        redirect('admin/modulos_submodulos/'.$id_modulos);
    }//edit
    	
    
    public function foreingControllers(){
    	
    	$this->load->model('modulos_submodulosdao');	
    	$submodulos = new modulos_submodulosdao();
    	
    	//$arraySubmodulos = $submodulos->
    			
    	return $data;
    	
    }
     
    	
    /*
    public function JSON_METHOD(){
    
    	header('Content-type: application/json');
   
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
     */
    	}