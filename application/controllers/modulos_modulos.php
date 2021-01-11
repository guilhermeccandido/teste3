<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class modulos_modulos extends App_controller {
const VIEW_FOLDER = 'admin/modulos_modulos';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modulos_modulosdao');

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
    	$data['id_modulos'] = $id;
    	 
    	$this->load->model('modulos_modulosdao');
    	$ant = new modulos_modulosdao();
    	 
    	$data['modulos_modulos'] = $ant->get_modulos_modulos_by_id_modulos($id);
    	//$this->PAR($data['modulos_modulos']);
    
        //load the view
        $data['main_content'] = 'admin/modulos_modulos/list';
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
        	$this->form_validation->set_rules('id_modulo1', 'id_modulo1', 'required');
        	$this->form_validation->set_rules('id_modulo2', 'id_modulo2', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                			'id_modulo1' => $this->input->post('id_modulo1'),
	                		'id_modulo2' => $this->input->post('id_modulo2'),
                			'descricao' => $this->input->post('descricao'),
                );
                //$this->debugMark('Data Array', $data_to_store);
                
                //if the insert has returned true then we show the flash message
                if($this->modulos_modulosdao->store_modulos_modulos($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['modulos'] = $this->modulos_modulosdao->get_modulos_not_related_modulos_by_id_modulos($id_modulos);
        //$this->PAR($data['modulos']);
                		
        //load the view
        $data['main_content'] = 'admin/modulos_modulos/add';
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
        	$this->form_validation->set_rules('id_modulo1', 'id_modulo1', 'required');
        	$this->form_validation->set_rules('id_modulo2', 'id_modulo2', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                			'id_modulo1' => $this->input->post('id_modulo1'),
	                		'id_modulo2' => $this->input->post('id_modulo2'),
                			'descricao' => $this->input->post('descricao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->modulos_modulosdao->update_modulos_modulos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/modulos_modulos/update/'.$id.'/'.$id_modulos);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['modulos_modulos'] = $this->modulos_modulosdao->get_modulos_modulos_by_id($id);
        //$this->debugMark('Modulos ', $data['modulos_modulos']);		
        $data['modulos'] = $this->modulos_modulosdao->get_modulos_not_related_modulos_by_id_modulos($id_modulos, $data['modulos_modulos'][0]['id_modulo1']);
        //$this->debugMark('Modulos ', $data['modulos']);
        //$this->PAR($data['modulos']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/modulos_modulos/edit';
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
        $this->modulos_modulosdao->delete_modulos_modulos($id);
        redirect('admin/modulos_modulos/'.$id_modulos);
    }//edit
    	
    
    public function foreingControllers($id_modulo = null){
    	
    	$this->load->model('modulosdao');		
    	$modulo = new modulosdao();
    	
    	if($id_modulo){
    		$data['modulo_filho'] = $modulo->get_modulos_by_id($id_modulo);
    	}else{
    		$data['modulo_filho'] = $modulo->get_modulos(null, 'titulo');
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