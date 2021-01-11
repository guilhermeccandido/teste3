<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class subfases extends App_controller {
const VIEW_FOLDER = 'admin/subfases';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subfasesdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_fases = $this->uri->segment(3);
       
		$data['subfases'] = $this->subfasesdao->get_subfases_by_id_fases($id_fases);
		$data['id_fases'] = $id_fases;

        //load the view
        $data['main_content'] = 'admin/subfases/list';
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
	        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
	        	$this->form_validation->set_rules('demanda', 'demanda', 'required'); 
	        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                			'id_fases' => $this->input->post('id_fases'),
                			'titulo' => $this->input->post('titulo'),
                			'demanda' => $this->input->post('demanda'),
                			'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->subfasesdao->store_subfases($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/subfases/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id 
        $id = $this->uri->segment(4);
        $id_fases = $this->uri->segment(5);
        $data['id_fases'] = $id_fases;
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
			        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required'); 
			        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
			        	$this->form_validation->set_rules('demanda', 'demanda', 'required'); 
			        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
			        	'id_fases' => $this->input->post('id_fases'),
			        	'titulo' => $this->input->post('titulo'),
			        	'demanda' => $this->input->post('demanda'),
			        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->subfasesdao->update_subfases($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/subfases/update/'.$id.'/'.$id_fases.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['subfases'] = $this->subfasesdao->get_subfases_by_id($id);
        //load the view
        $data['main_content'] = 'admin/subfases/edit';
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
        $this->subfasesdao->delete_subfases($id);
        redirect('admin/subfases');
    }//edit    			
    	
    
    public function foreingControllers(){
    	
    	$this->load->model('fasesdao');		
    	$data['fases'] = $this->fasesdao->get_fases();	
    	
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