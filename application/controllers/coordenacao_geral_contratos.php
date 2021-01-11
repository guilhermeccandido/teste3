<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class coordenacao_geral_contratos extends App_controller {
const VIEW_FOLDER = 'admin/coordenacao_geral_contratos';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('coordenacao_geral_contratosdao');

       
    }
    	
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$id = $this->uri->segment(3);
    	$data['id_coordenacao_geral'] = $id;
    	 
    	$this->load->model('coordenacao_geral_contratosdao');
    	$ant = new coordenacao_geral_contratosdao();
    	 
    	$data['coordenacao_geral_contratos'] = $ant->get_coordenacao_geral_contratos_by_id_coordenacao_geral($id);
    	//$this->PAR($data['coordenacao_geral_contratos']);
    
        //load the view
        $data['main_content'] = 'admin/coordenacao_geral_contratos/list';
        $this->load->view('includes/template', $data);
    
    }//index
    	
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
        	$this->form_validation->set_rules('id_contratos', 'id_contratos', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('id_coordenacao_geral' => $this->input->post('id_coordenacao_geral'),'id_contratos' => $this->input->post('id_contratos'),'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->coordenacao_geral_contratosdao->store_coordenacao_geral_contratos($data_to_store)){
                    $data['flash_message'] = TRUE;
                }else{
                    $data['flash_message'] = FALSE;
                }
    
            }
    
        }
                		
        $data['contratos'] = $this->coordenacao_geral_contratosdao->get_contratos_not_related_coordenacao_geral_by_id_coordenacao_geral($id_coordenacao_geral);
        //$this->PAR($data['contratos']);
                		
        //load the view
        $data['main_content'] = 'admin/coordenacao_geral_contratos/add';
        $this->load->view('includes/template', $data);
    }
    
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        //product id
        $id = $this->uri->segment(4);
  		$id_coordenacao_geral = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('id_coordenacao_geral', 'id_coordenacao_geral', 'required');
        	$this->form_validation->set_rules('id_contratos', 'id_contratos', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'id_coordenacao_geral' => $this->input->post('id_coordenacao_geral'),
        	'id_contratos' => $this->input->post('id_contratos'),
        	'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->coordenacao_geral_contratosdao->update_coordenacao_geral_contratos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/coordenacao_geral_contratos/update/'.$id.'/'.$id_coordenacao_geral);
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data['coordenacao_geral_contratos'] = $this->coordenacao_geral_contratosdao->get_coordenacao_geral_contratos_by_id($id);
        		
        $data['contratos'] = $this->coordenacao_geral_contratosdao->get_contratos_not_related_coordenacao_geral_by_id_coordenacao_geral($id_coordenacao_geral, $data['coordenacao_geral_contratos'][0]['id_contratos']);
        //$this->PAR($data['contratos']);		
        		
        		
        //load the view
        $data['main_content'] = 'admin/coordenacao_geral_contratos/edit';
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
        $this->coordenacao_geral_contratosdao->delete_coordenacao_geral_contratos($id);
        redirect('admin/coordenacao_geral_contratos/'.$id_coordenacao_geral);
    }//edit
    	
}