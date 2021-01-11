<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class usuarios_contratos extends App_controller {
const VIEW_FOLDER = 'admin/usuarios_contratos';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_contratosdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_usuario'] = $id;
    	 
    	$this->load->model('usuarios_contratosdao');
    	$ant = new usuarios_contratosdao();
    	 
    	$data['usuarios_contratos'] = $ant->get_usuarios_contratos_by_id_usuario($id);
    	//$this->PAR($data['usuarios_contratos']);
    	$data = array_merge($data, $this->foreingControllers());
    	
        //load the view
        $data['main_content'] = 'admin/usuarios_contratos/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
	public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_usuario = $this->uri->segment(4);
    	$data['id_usuario'] = $id_usuario;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_usuario', 'id_usuario', 'required'); 
        	$this->form_validation->set_rules('id_contratos', 'id_contratos', 'required');
        	$this->form_validation->set_rules('id_usuario', 'id_usuario', 'required'); 
        	$this->form_validation->set_rules('id_contratos', 'id_contratos', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('id_usuario' => $this->input->post('id_usuario'),'id_contratos' => $this->input->post('id_contratos'),'id_usuario' => $this->input->post('id_usuario'),'id_contratos' => $this->input->post('id_contratos'),'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->usuarios_contratosdao->store_usuarios_contratos($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['contratos'] = $this->usuarios_contratosdao->get_contratos_not_related_usuario_by_id_usuario($id_usuario);
        //$this->PAR($data['contratos']);
                		
        //load the view
        $data['main_content'] = 'admin/usuarios_contratos/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_usuario = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_usuario', 'id_usuario', 'required');
        	$this->form_validation->set_rules('id_contratos', 'id_contratos', 'required');
		        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'id_usuario' => $this->input->post('id_usuario'),
		        	'id_contratos' => $this->input->post('id_contratos'),
		        	'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->usuarios_contratosdao->update_usuarios_contratos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/usuarios_contratos/update/'.$id.'/'.$id_usuario);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['usuarios_contratos'] = $this->usuarios_contratosdao->get_usuarios_contratos_by_id($id);
        		
        $data['contratos'] = $this->usuarios_contratosdao->get_contratos_not_related_usuario_by_id_usuario($id_usuario, $data['usuarios_contratos'][0]['id_contratos']);
        //$this->PAR($data['contratos']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/usuarios_contratos/edit';
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
    	$id_usuario = $this->uri->segment(5);
        $this->usuarios_contratosdao->delete_usuarios_contratos($id);
        redirect('admin/usuarios_contratos/'.$id_usuario);
    }//edit
    	
    
    public function foreingControllers(){
    	
    	$this->load->model('contratosdao');
    	$contratos = new contratosdao();
    	$listaContratos = $contratos->get_contratos();
    	$data['contratos'] = $listaContratos;
    	
    	//$this->debugMark('', $data['contratos']);
    			
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