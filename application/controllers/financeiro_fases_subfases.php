<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class financeiro_fases_subfases extends App_controller {
const VIEW_FOLDER = 'admin/financeiro_fases_subfases';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('financeiro_fases_subfasesdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	$data = array_merge($data, $this->foreingControllers());
    	
    	$id_registro_financeiro = $this->uri->segment(3);
    	$data['id_registro_financeiro'] = $id_registro_financeiro;
       
		$data['financeiro_fases_subfases'] = $this->financeiro_fases_subfasesdao->get_financeiro_fases_subfases_by_id_registro_financeiro($id_registro_financeiro);
		
        //load the view
        $data['main_content'] = 'admin/financeiro_fases_subfases/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    	
    	$id_registro_financeiro = $this->uri->segment(4);
    	$data['id_registro_financeiro'] = $id_registro_financeiro;
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
	        	$this->form_validation->set_rules('id_registro_financeiro', 'id_registro_financeiro', 'required'); 
	        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required'); 
	        	$this->form_validation->set_rules('id_subfases', 'id_subfases', ''); 
	        	$this->form_validation->set_rules('quantidade', 'quantidade', 'required'); 
	        	$this->form_validation->set_rules('valor', 'valor', 'required'); 
	        	$this->form_validation->set_rules('unidade', 'unidade', 'required'); 
	        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                				'id_registro_financeiro' => $this->input->post('id_registro_financeiro'),
		                		'id_fases' => $this->input->post('id_fases'),
		                		'id_subfases' => $this->input->post('id_subfases'),
		                		'quantidade' => $this->input->post('quantidade'),
		                		'valor' => $this->input->post('valor'),
		                		'unidade' => $this->input->post('unidade'),
		                		'observacoes' => $this->input->post('observacoes')
                );
                //$this->debugMark("Mark",$data_to_store );
                //if the insert has returned true then we show the flash message
                if($this->financeiro_fases_subfasesdao->store_financeiro_fases_subfases($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        
        $data['fases_subfases'] = $this->financeiro_fases_subfasesdao->get_fases_subfases_not_related_financeiro_by_id_registro_financeiro($id_registro_financeiro);
        //load the view
        $data['main_content'] = 'admin/financeiro_fases_subfases/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id 
        $id = $this->uri->segment(4);
        $id_registro_financeiro = $this->uri->segment(4);
        $data['id_registro_financeiro'] = $id_registro_financeiro;
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
			        	$this->form_validation->set_rules('id_registro_financeiro', 'id_registro_financeiro', 'required'); 
			        	$this->form_validation->set_rules('id_fases', 'id_fases', 'required'); 
			        	$this->form_validation->set_rules('id_subfases', 'id_subfases', 'required'); 
			        	$this->form_validation->set_rules('quantidade', 'quantidade', 'required'); 
			        	$this->form_validation->set_rules('valor', 'valor', 'required'); 
			        	$this->form_validation->set_rules('unidade', 'unidade', 'required'); 
			        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'id_registro_financeiro' => $this->input->post('id_registro_financeiro'),
		        	'id_fases' => $this->input->post('id_fases'),
		        	'id_subfases' => $this->input->post('id_subfases'),
		        	'quantidade' => $this->input->post('quantidade'),
		        	'valor' => $this->input->post('valor'),
		        	'unidade' => $this->input->post('unidade'),
		        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->financeiro_fases_subfasesdao->update_financeiro_fases_subfases($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/financeiro_fases_subfases/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['financeiro_fases_subfases'] = $this->financeiro_fases_subfasesdao->get_financeiro_fases_subfases_by_id($id);
        //load the view
        $data['main_content'] = 'admin/financeiro_fases_subfases/edit';
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
        $id_registro_financeiro = $this->uri->segment(5);
    	$data['id_registro_financeiro'] = $id_registro_financeiro;
         
        $this->financeiro_fases_subfasesdao->delete_financeiro_fases_subfases($id);
        redirect('admin/financeiro_fases_subfases/'.$id_registro_financeiro);
    }//edit    			
    	
    
    public function foreingControllers(){
    	
    	$this->load->model('fasesdao');
    	$data['fases'] = $this->fasesdao->get_fases();
    	
    	$this->load->model('subfasesdao');
    	$data['subfases'] = $this->subfasesdao->get_subfases();
    			
    	return $data;
    	
    }
    	
    public function edit_table(){
    
    	header('Content-type: application/json');
    	//$teste = json_decode($data);
    
    	$id 	= $this->input->post('id');
    	$value = $this->input->post('value');
    	$name 	= $this->input->post('name');
    
    	$arrayRules = array(
    			'id' => 'required|numeric'
    	);
    
    	$this->form_validation->set_rules('id', 'id', $arrayRules['id']);
    
    	if ($this->form_validation->run()){
    
    		$data_to_store = array(
    				$name => $value
    		);
    
    		//$this->debugMark('Edit',$data_to_store );
    		// EDITAR PENDENCIAS DO PAS
    		if($this->financeiro_fases_subfasesdao->update_financeiro_fases_subfases($id, $data_to_store) == TRUE){
    			//$this->session->set_flashdata('flash_message', 'updated');
    			return true;
    		}else{
    			return false;
    			//$this->session->set_flashdata('flash_message', 'not_updated');
    		}
    
    
    	}
    
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