<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class usuarios_modulos extends App_controller {
const VIEW_FOLDER = 'admin/usuarios_modulos';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_modulosdao');		
       
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data = array_merge($data, $this->foreingControllers());
    	
    	$id = $this->uri->segment(3);
    	$data['id_usuarios'] = $id;
    	 
    	$this->load->model('usuarios_modulosdao');
    	$ant = new usuarios_modulosdao();
    	 
    	$data['usuarios_modulos'] = $ant->get_usuarios_modulos_by_id_usuarios($id);
    	//$this->PAR($data['usuarios_modulos']);
    
        //load the view
        $data['main_content'] = 'admin/usuarios_modulos/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data = array_merge($data, $this->foreingControllers());
    	
		$id_usuarios = $this->uri->segment(4);
    	$data['id_usuarios'] = $id_usuarios;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_usuarios', 'id_usuarios', 'required'); 
        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required');
        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', 'required');
        	$this->form_validation->set_rules('acesso', 'acesso', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_usuarios' => $this->input->post('id_usuarios'),
                		'id_modulos' => $this->input->post('id_modulos'),
                		'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
                		'acesso' => $this->input->post('acesso'),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->usuarios_modulosdao->store_usuarios_modulos($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['modulos'] = $this->usuarios_modulosdao->get_modulos_not_related_usuarios_by_id_usuarios($id_usuarios);
        //$this->PAR($data['modulos']);
                		
        //load the view
        $data['main_content'] = 'admin/usuarios_modulos/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data = array_merge($data, $this->foreingControllers());
    	
        //product id
        $id = $this->uri->segment(4);
  		$id_usuarios = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_usuarios', 'id_usuarios', 'required');
        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required');
        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', 'required');
        	$this->form_validation->set_rules('acesso', 'acesso', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'id_usuarios' => $this->input->post('id_usuarios'),
		        	'id_modulos' => $this->input->post('id_modulos'),
                	'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
		        	'acesso' => $this->input->post('acesso'),
		        	'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->usuarios_modulosdao->update_usuarios_modulos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/usuarios_modulos/update/'.$id.'/'.$id_usuarios);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['usuarios_modulos'] = $this->usuarios_modulosdao->get_usuarios_modulos_by_id($id);
        		
        $data['modulos'] = $this->usuarios_modulosdao->get_modulos_not_related_usuarios_by_id_usuarios($id_usuarios, $data['usuarios_modulos'][0]['id_modulos']);
        //$this->PAR($data['modulos']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/usuarios_modulos/edit';
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
    	$id_usuarios = $this->uri->segment(5);
        $this->usuarios_modulosdao->delete_usuarios_modulos($id);
        redirect('admin/usuarios_modulos/'.$id_usuarios);
    }//edit
    	
	public function foreingControllers(){
		
		$this->load->model('usuario_perfildao');
		$perfil = new usuario_perfildao();
		$data['perfil'] = $perfil->get_usuario_perfil(null, 'titulo');
		
		
		return $data;
	}
    
    
}













