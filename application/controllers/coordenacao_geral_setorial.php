<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class coordenacao_geral_setorial extends App_controller {
 
	const VIEW_FOLDER = 'admin/coordenacao_geral_setorial';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('coordenacao_geral_setorialdao');

       
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        $id = $this->uri->segment(3);
    	$data['id_coordenacao_geral'] = $id;
    	 
    	$this->load->model('coordenacao_geral_setorialdao');
    	$ant = new coordenacao_geral_setorialdao();
    	 
    	$data['coordenacao_geral_setorial'] = $ant->get_coordenacao_geral_setorial_by_id_coordenacao_geral($id);
    	//$this->PAR($data['coordenacao_geral_setorial']);
    	
    	//load the view
        $data['main_content'] = 'admin/coordenacao_geral_setorial/list';
        $this->load->view('includes/template', $data);  

    }//index    

    public function lista_setorial(){
    	 
    	 
    	
    
    }   			
    
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$id_coordenacao_geral = $this->uri->segment(4);
    	$data['id_coordenacao_geral'] = $id_coordenacao_geral;
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('id_coordenacao_geral', 'id_coordenacao_geral', 'required'); 
        	$this->form_validation->set_rules('id_coordenacao_setorial', 'id_coordenacao_setorial', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('id_coordenacao_geral' => $this->input->post('id_coordenacao_geral'),'id_coordenacao_setorial' => $this->input->post('id_coordenacao_setorial'),
                );
                //if the insert has returned true then we show the flash message
                if($this->coordenacao_geral_setorialdao->store_coordenacao_geral_setorial($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        
        $data['coordenacao_setorial'] = $this->coordenacao_geral_setorialdao->get_coordenacao_setorial_not_related_coordenacao_geral_by_id_coordenacao_geral($id_coordenacao_geral);
        
        //load the view
        $data['main_content'] = 'admin/coordenacao_geral_setorial/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
        
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        //product id 
        $id = $this->uri->segment(4);
        $id_coordenacao_geral = $this->uri->segment(5);
  		$data['id_coordenacao_geral'] = $id_coordenacao_geral;
  		
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
        	$this->form_validation->set_rules('id_coordenacao_geral', 'id_coordenacao_geral', 'required');
        	$this->form_validation->set_rules('id_coordenacao_setorial', 'id_coordenacao_setorial', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'id_coordenacao_geral' => $this->input->post('id_coordenacao_geral'),
		        	'id_coordenacao_setorial' => $this->input->post('id_coordenacao_setorial'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->coordenacao_geral_setorialdao->update_coordenacao_geral_setorial($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/coordenacao_geral_setorial/update/'.$id.'/'.$id_coordenacao_geral);

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['coordenacao_geral_setorial'] = $this->coordenacao_geral_setorialdao->get_coordenacao_geral_setorial_by_id($id);
        
        $data['coordenacao_setorial'] = $this->coordenacao_geral_setorialdao->get_coordenacao_setorial_not_related_coordenacao_geral_by_id_coordenacao_geral($id_coordenacao_geral, $data['coordenacao_geral_setorial'][0]['id_coordenacao_setorial']);
        //$this->PAR($data['coordenacao_setorial']);
        
        
        //load the view
        $data['main_content'] = 'admin/coordenacao_geral_setorial/edit';
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
        $id_coordenacao_geral = $this->uri->segment(5);
        $this->coordenacao_geral_setorialdao->delete_coordenacao_geral_setorial($id);
        redirect('admin/coordenacao_geral_setorial/'.$id_coordenacao_geral);
    }//edit    			
    	
}