<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class status_status extends App_controller {
const VIEW_FOLDER = 'admin/status_status';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('status_statusdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data = array_merge($data, $this->foreingControllers());
    			
    	$id = $this->uri->segment(3);
    	$data['id_status'] = $id;
    	 
    	$this->load->model('status_statusdao');
    	$ant = new status_statusdao();
    	 
    	$data['status_status'] = $ant->get_status_status_by_id_status($id);
    	//$this->PAR($data['status_status']);
    
        //load the view
        $data['main_content'] = 'admin/status_status/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));			
    			
		$id_status = $this->uri->segment(4);
    	$data['id_status'] = $id_status;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation 
        	$this->form_validation->set_rules('id_status1', 'id_status1', 'required');
        	$this->form_validation->set_rules('id_status2', 'id_status2', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_status1' => $this->input->post('id_status1'),
                		'id_status2' => $this->input->post('id_status2'),
                		'descricao' => $this->input->post('descricao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->status_statusdao->store_status_status($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['status'] = $this->status_statusdao->get_status_not_related_status_by_id_status($id_status);
        //$this->PAR($data['status']);
                		
        //load the view
        $data['main_content'] = 'admin/status_status/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true, __FUNCTION__));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_status = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_status1', 'id_status1', 'required');
        	$this->form_validation->set_rules('id_status2', 'id_status2', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'id_status1' => $this->input->post('id_status1'),
		        	'id_status2' => $this->input->post('id_status2'),
		        	'descricao' => $this->input->post('descricao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->status_statusdao->update_status_status($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/status_status/update/'.$id.'/'.$id_status);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['status_status'] = $this->status_statusdao->get_status_status_by_id($id);
        		
        $data['status'] = $this->status_statusdao->get_status_not_related_status_by_id_status($id_status, $data['status_status'][0]['id_status']);
        //$this->PAR($data['status']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/status_status/edit';
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
    	$id_status = $this->uri->segment(5);
        $this->status_statusdao->delete_status_status($id);
        redirect('admin/status_status/'.$id_status);
    }//edit
    	
 	public function foreingControllers($id_status = null){
    	
    	$this->load->model('statusdao');		
    	$status = new statusdao();
    	
    	if($id_status){
    		$data['status_filho'] = $status->get_status_by_id($id_status);
    	}else{
    		$data['status_filho'] = $status->get_status(null, 'titulo');
    	}
    	
    	
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