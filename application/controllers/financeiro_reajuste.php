<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class financeiro_reajuste extends App_controller {
const VIEW_FOLDER = 'admin/financeiro_reajuste';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('financeiro_reajustedao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_registro_financeiro = $this->uri->segment(3);
    	$data['id_registro_financeiro'] = $id_registro_financeiro;
    			
       
      	$data['financeiro_reajuste'] = $this->financeiro_reajustedao->get_financeiro_reajuste_by_id_registro_financeiro($id_registro_financeiro, 'data_base', 'DESC');        
        

        //load the view
        $data['main_content'] = 'admin/financeiro_reajuste/list';
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
	        	$this->form_validation->set_rules('data_base', 'data_base', 'required'); 
	        	$this->form_validation->set_rules('reajuste', 'reajuste', 'required'); 
	        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_registro_financeiro' => $this->input->post('id_registro_financeiro'),
                		'data_base' => $this->input->post('data_base'),
                		'reajuste' => $this->input->post('reajuste'),
                		'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->financeiro_reajustedao->store_financeiro_reajuste($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/financeiro_reajuste/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id 
        $id = $this->uri->segment(4);
        $id_registro_financeiro = $this->uri->segment(5);
        $data['id_registro_financeiro'] = $id_registro_financeiro;
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
			        	$this->form_validation->set_rules('id_registro_financeiro', 'id_registro_financeiro', 'required'); 
			        	$this->form_validation->set_rules('data_base', 'data_base', 'required'); 
			        	$this->form_validation->set_rules('reajuste', 'reajuste', 'required'); 
			        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
			        	'id_registro_financeiro' => $this->input->post('id_registro_financeiro'),
			        	'data_base' => $this->input->post('data_base'),
			        	'reajuste' => $this->input->post('reajuste'),
			        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->financeiro_reajustedao->update_financeiro_reajuste($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/financeiro_reajuste/update/'.$id.'/'.$id_registro_financeiro.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['financeiro_reajuste'] = $this->financeiro_reajustedao->get_financeiro_reajuste_by_id($id);
        //load the view
        $data['main_content'] = 'admin/financeiro_reajuste/edit';
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
        
        $this->financeiro_reajustedao->delete_financeiro_reajuste($id);
        redirect('admin/financeiro_reajuste/'.$id_registro_financeiro);
    }//edit    			
    	
    /*
    public function foreingControllers(){
    	
    	$this->load->model('');		
    			
    	return $data;
    	
    }
    	
     */
    	
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