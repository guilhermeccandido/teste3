<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class anteprojetos_pendencias extends App_controller {
const VIEW_FOLDER = 'admin/anteprojetos_pendencias';

    		public function __construct()
		    {
		        parent::__construct();
		        $this->load->model('anteprojetos_pendenciasdao');
		
		       
		    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data['id_anteprojetos'] = $id;
    	 
    	$this->load->model('anteprojetos_pendenciasdao');
    	$ant = new anteprojetos_pendenciasdao();
    	 
    	$data['anteprojetos_pendencias'] = $ant->get_anteprojetos_pendencias_by_id_anteprojetos($id);
    	//$this->PAR($data['anteprojetos_pendencias']);
    
        //load the view
        $data['main_content'] = 'admin/anteprojetos_pendencias/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_anteprojetos = $this->uri->segment(4);
    	$data['id_anteprojetos'] = $id_anteprojetos;		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
            //form validation
        	$this->form_validation->set_rules('id_anteprojetos', 'id_anteprojetos', 'required'); 
        	$this->form_validation->set_rules('id_pendencias', 'id_pendencias', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
        	
        	$this->form_validation->set_rules('responsabilidade', 'responsabilidade', 'required'); 
        	/*
        	$this->form_validation->set_rules('data_ini', 'data_ini', 'required'); 
        	$this->form_validation->set_rules('data_fim', 'data_fim', 'required');
        	*/ 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_anteprojetos' => $this->input->post('id_anteprojetos'),
                		'id_pendencias' => $this->input->post('id_pendencias'),
                		'titulo' => $this->input->post('titulo'),
                		'responsabilidade' => $this->input->post('responsabilidade'),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->anteprojetos_pendenciasdao->store_anteprojetos_pendencias($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }

        $this->load->model('pendenciasdao');
        $data['pendencias'] = $this->pendenciasdao->get_pendencias('', 'id');
        
        //$this->PAR($data['pendencias']);
                		
        //load the view
        $data['main_content'] = 'admin/anteprojetos_pendencias/add';
        $this->load->view('includes/template', $data);
    }
    
    
    public function add_json(){
    
    	header('Content-type: application/json');
    	$id_anteprojetos = $this->uri->segment(4);
    	$data['id_anteprojetos'] = $id_anteprojetos;		
    			
    	$data_to_store = $this->deserialize($this->input->post('post'));
    	
		$this->anteprojetos_pendenciasdao->store_anteprojetos_pendencias($data_to_store);
    
        $data['pendencias'] = $this->anteprojetos_pendenciasdao->get_anteprojetos_pendencias_by_id_anteprojetos($id_anteprojetos);
         
        $this->load->model('pendenciasdao');
        $listPendencias = new pendenciasdao();
        $data['lista_pendencias'] = $listPendencias->get_pendencias(null, 'id');
        
                                		
        //load the view
        $this->load->view('admin/anteprojetos/list_pendencias', $data);
    	/*
    	 //$this->PAR($editData);
    	die;
    	$myJSON = json_encode();
    	echo($myJSON);
    	*/
    
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_anteprojetos = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_anteprojetos', 'id_anteprojetos', 'required');
        	$this->form_validation->set_rules('id_pendencias', 'id_pendencias', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('responsabilidade', 'responsabilidade', 'required');
        	/*
        	$this->form_validation->set_rules('data_ini', 'data_ini', 'required');
        	$this->form_validation->set_rules('data_fim', 'data_fim', 'required');
        	*/
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
	        	'id_anteprojetos' => $this->input->post('id_anteprojetos'),
	        	'id_pendencias' => $this->input->post('id_pendencias'),
	        	'titulo' => $this->input->post('titulo'),
	        	'responsabilidade' => $this->input->post('responsabilidade'),
	        	
	        	'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->anteprojetos_pendenciasdao->update_anteprojetos_pendencias($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/anteprojetos_pendencias/update/'.$id.'/'.$id_anteprojetos);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['anteprojetos_pendencias'] = $this->anteprojetos_pendenciasdao->get_anteprojetos_pendencias_by_id($id);
        		
        $data['pendencias'] = $this->anteprojetos_pendenciasdao->get_pendencias_not_related_anteprojetos_by_id_anteprojetos($id_anteprojetos, $data['anteprojetos_pendencias'][0]['id_pendencias']);
        //$this->PAR($data['pendencias']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/anteprojetos_pendencias/edit';
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
    	$id_anteprojetos = $this->uri->segment(5);
        $this->anteprojetos_pendenciasdao->delete_anteprojetos_pendencias($id);
        redirect('admin/anteprojetos_pendencias/'.$id_anteprojetos);
    }//edit
    	
}