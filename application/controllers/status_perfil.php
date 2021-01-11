<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class status_perfil extends App_controller {
const VIEW_FOLDER = 'admin/status_perfil';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('status_perfildao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_status'] = $id;
    	 
    	$this->load->model('status_perfildao');
    	$ant = new status_perfildao();
    	 
    	$data['status_perfil'] = $ant->get_status_perfil_by_id_status($id);
    	//$this->PAR($data['status_perfil']);
    
        //load the view
        $data['main_content'] = 'admin/status_perfil/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_status = $this->uri->segment(4);
    	$data['id_status'] = $id_status;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_status', 'id_status', 'required'); 
        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', 'required');
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_status' => $this->input->post('id_status'),
                		'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
                		'descricao' => $this->input->post('descricao'),
                );
               // $this->debugMark('ADD', $data_to_store);
                //if the insert has returned true then we show the flash message
                if($this->status_perfildao->store_status_perfil($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['usuario_perfil'] = $this->status_perfildao->get_usuario_perfil_not_related_status_by_id_status($id_status);
        //$this->PAR($data['usuario_perfil']);
                		
        //load the view
        $data['main_content'] = 'admin/status_perfil/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_status = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_status', 'id_status', 'required');
        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', 'required');
		    $this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
			        	'id_status' => $this->input->post('id_status'),
			        	'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
			        	'descricao' => $this->input->post('descricao'),
                );
                //$this->debugMark('Update', $data_to_store);
                //if the insert has returned true then we show the flash message
                if($this->status_perfildao->update_status_perfil($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/status_perfil/update/'.$id.'/'.$id_status);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['status_perfil'] = $this->status_perfildao->get_status_perfil_by_id($id);
        		
        $data['usuario_perfil'] = $this->status_perfildao->get_usuario_perfil_not_related_status_by_id_status($id_status, $data['status_perfil'][0]['id_usuario_perfil']);
        //$this->PAR($data['usuario_perfil']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/status_perfil/edit';
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
    	$id_status = $this->uri->segment(5);
        $this->status_perfildao->delete_status_perfil($id);
        redirect('admin/status_perfil/'.$id_status);
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