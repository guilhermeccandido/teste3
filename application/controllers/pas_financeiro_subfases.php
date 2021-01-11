<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class pas_financeiro_subfases extends App_controller {
const VIEW_FOLDER = 'admin/pas_financeiro_subfases';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pas_financeiro_subfasesdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_pas = $this->uri->segment(3);
    	$data['id_pas'] = $id_pas;
        
    	$id_fases = $this->uri->segment(4);
    	$data['id_fases'] = $id_fases;
    	
    	$data = array_merge($data, $this->foreingControllers($id_pas, $id_fases));
    	
        $data['pas_financeiro_subfases'] = $this->pas_financeiro_subfasesdao->get_pas_financeiro_subfases_by_id_pas_id_fase($id_pas, $id_fases);        
           
        //load the view
        $data['main_content'] = 'admin/pas_financeiro_subfases/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_pas = $this->uri->segment(4);
    	$data['id_pas'] = $id_pas;
    	
    	$id_fases = $this->uri->segment(5);
    	$data['id_fases'] = $id_fases;
    	
    	$data = array_merge($data, $this->foreingControllers($id_pas, $id_fases));
    	 
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('quantidade', 'quantidade', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_pas' => $id_pas,
                		'id_fases' => $id_fases,
                		'id_subfases' => $this->input->post('id_subfases'),
                		'quantidade' => $this->input->post('quantidade'),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_financeiro_subfasesdao->store_pas_financeiro_subfases($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/pas_financeiro_subfases/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    	
    	$id = $this->uri->segment(4);
    	
    	$id_pas = $this->uri->segment(5);
    	$data['id_pas'] = $id_pas;
    	 
    	$id_fases = $this->uri->segment(6);
    	$data['id_fases'] = $id_fases;
    	
    	$data = array_merge($data, $this->foreingControllers($id_pas, $id_fases));
    			
        
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('quantidade', 'quantidade', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                		'id_pas' => $id_pas,
                		'id_fases' => $id_fases,
                		'id_subfases' => $this->input->post('id_subfases'),
                		'quantidade' => $this->input->post('quantidade'),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->pas_financeiro_subfasesdao->update_pas_financeiro_subfases($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/pas_financeiro_subfases/update/'.$id.'/'.$id_pas.'/'.$id_fases.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['pas_financeiro_subfases'] = $this->pas_financeiro_subfasesdao->get_pas_financeiro_subfases_by_id($id);
        //load the view
        $data['main_content'] = 'admin/pas_financeiro_subfases/edit';
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
    	$data['id_pas'] = $id_pas;
    	 
    	$id_fases = $this->uri->segment(6);
    	$data['id_fases'] = $id_fases;
        
        $this->pas_financeiro_subfasesdao->delete_pas_financeiro_subfases($id);
        redirect('admin/pas_financeiro_subfases/'.$id_pas.'/'.$id_fases);
    }//edit    			
    	
    
    public function foreingControllers($id_pas, $id_fases){
    	
    	$this->load->model('pasdao');
    	$pas = new pasdao();
    	$data['pas'] = $pas->get_pas_by_id($id_pas);
    	
    	$this->load->model('fasesdao');
    	$fases = new fasesdao();
    	$data['fases'] = $fases->get_fases_by_id($id_fases);
    	
    	$this->load->model('subfasesdao');
    	$subfases = new subfasesdao();
    	$data['subfases'] = $subfases->get_subfases_by_id_fases($id_fases);
    			
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