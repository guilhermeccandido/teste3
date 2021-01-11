<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class modulos_perfil extends App_controller {
const VIEW_FOLDER = 'admin/modulos_perfil';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('modulos_perfildao');

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
    	 
    	$this->load->model('modulos_perfildao');
    	$ant = new modulos_perfildao();
    	
    	$this->load->model('usuario_perfildao');
    	$perfil = new usuario_perfildao();
    	$data['perfil'] = $perfil->get_usuario_perfil(null, 'titulo');
    	
    	$this->load->model('modulos_submodulosdao');
    	$modulos = new modulos_submodulosdao();
    	$totalModulos = $modulos->count_modulos_submodulos_by_id_modulos($id);
    	
    	$i = 0;
    	foreach($data['perfil'] as $item){
    		$tmp1 = $ant->count_modulos_perfil_by_id_modulos_id_usuario_perfil($id, $item['id']);
    		$data['perfil'][$i]['relacao'] = $tmp1.'/'.$totalModulos;
    		$i++;
    		
    	}
    	
    	//$this->PAR($data['modulos_perfil']);
    	//die;
    	
    	$data['modulos_perfil'] = array();
    	//$this->PAR($data['modulos_perfil']);
    	//die;
    	
        //load the view
        $data['main_content'] = 'admin/modulos_perfil/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    	$data = array_merge($data, $this->foreingControllers());
    			
		$id_modulos = $this->uri->segment(4);
    	$data['id_modulos'] = $id_modulos;		
    		
    	$id_usuario_perfil = $this->uri->segment(5);
    	$data['id_usuario_perfil'] = $id_usuario_perfil;
    	
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required'); 
        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', 'required');
        	$this->form_validation->set_rules('id_submodulo', 'id_submodulo', 'required'); 
        	$this->form_validation->set_rules('acesso', 'acesso', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_modulos' => $this->input->post('id_modulos'),
                		'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
                		'id_submodulo' => $this->input->post('id_submodulo'),
                		'acesso' => $this->input->post('acesso'),
                		'descricao' => $this->input->post('descricao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->modulos_perfildao->store_modulos_perfil($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['submodulos'] = $this->modulos_perfildao->get_usuario_perfil_not_related_id_modulo_submodulo($id_modulos, $id_usuario_perfil);
        //$this->PAR($data['usuario_perfil']);
                		
        //load the view
        $data['main_content'] = 'admin/modulos_perfil/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));	
    	
    			
        //product id
  		$id_modulos = $this->uri->segment(4);
  		$id_usuario_perfil = $this->uri->segment(5);
  		$id = $this->uri->segment(6);
  		//die;
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_modulos', 'id_modulos', 'required');
        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', 'required');
        	$this->form_validation->set_rules('id_submodulo', 'id_submodulo', 'required'); 
        	$this->form_validation->set_rules('acesso', 'acesso', 'required'); 
        	$this->form_validation->set_rules('descricao', 'descricao', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'id_modulos' => $this->input->post('id_modulos'),
		        	'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
		        	'id_submodulo' => $this->input->post('id_submodulo'),
		        	'acesso' => $this->input->post('acesso'),
		        	'descricao' => $this->input->post('descricao'),
                );
                //if the insert has returned true then we show the flash message
                if($this->modulos_perfildao->update_modulos_perfil($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/modulos_perfil/update/'.$id_modulos.'/'.$id_usuario_perfil.'/'.$id);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['modulos_perfil'] = $this->modulos_perfildao->get_modulos_perfil_by_id($id);
        		
        $data['usuario_perfil'] = $this->modulos_perfildao->get_usuario_perfil_not_related_modulos_by_id_modulos($id_modulos, $data['modulos_perfil'][0]['id_usuario_perfil']);
        //$this->PAR($data['usuario_perfil']);		
        		
        $data = array_merge($data, $this->foreingControllers());
        
        //load the view
        $data['main_content'] = 'admin/modulos_perfil/edit';
        $this->load->view('includes/template', $data);
    
    }//update
    	
    public function lista_submodulos(){
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data = array_merge($data, $this->foreingControllers());
    	
    	$id_modulos = $this->uri->segment(4);
    	$data['id_modulos'] = $id_modulos;
    	
    	$id_usuario_perfil = $this->uri->segment(5);
    	$data['id_usuario_perfil'] = $id_usuario_perfil;
    	
    	$this->load->model('modulos_perfildao');
    	$ant = new modulos_perfildao();
    	
    	$data['modulos_perfil'] = $ant->get_modulos_perfil_by_id_modulo_id_usuario_perfil($id_modulos, $id_usuario_perfil);
    	
    	
    	
    	//load the view
    	$data['main_content'] = 'admin/modulos_perfil/list_submodulos';
    	$this->load->view('includes/template', $data);
    }
    
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
    	$id_usuario_perfil = $this->uri->segment(6);
    	//die;
        $this->modulos_perfildao->delete_modulos_perfil($id);
        redirect('admin/modulos_perfil/lista_submodulos/'.$id_modulos.'/'.$id_usuario_perfil);
    }//edit
    	
    
    public function foreingControllers(){
    	
    	$this->load->model('modulosdao');
    	$modulos = new modulosdao();
    	$data['modulos'] = $modulos->get_modulos(null, 'titulo');
    	
    	$this->load->model('usuario_perfildao');
    	$perfil = new usuario_perfildao();
    	$data['perfil'] = $perfil->get_usuario_perfil(null, 'titulo');
    	
    	$this->load->model('submodulosdao');
    	$submodulos = new submodulosdao();
    	$data['submodulos'] = $submodulos->get_submodulos(null, 'titulo');	
    			
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