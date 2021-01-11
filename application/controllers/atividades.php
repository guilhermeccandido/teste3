<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class atividades extends App_controller {
const VIEW_FOLDER = 'admin/atividades';

    public function __construct()
		    {
	parent::__construct();
        $this->load->model('atividadesdao');
        
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_usuario = $this->session->userdata('id');
    	$dateInterval = $this->getDateInterval();
    	
    	$model = new atividadesdao();
    	$data['atividades'] = $model->get_atividades_by_id_usuario_ativas_interval($id_usuario, $dateInterval);

        //load the view
        $data['main_content'] = 'admin/atividades/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));

    	$data['dateInterval'] = $this->getDateInterval();
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('data_atividade', 'data_atividade', 'required'); 
        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
        	$this->form_validation->set_rules('status', 'status', 'required');
        	$this->form_validation->set_rules('descricao', 'descricao', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_usuario' => $this->session->userdata('id'),
                		'data_atividade' => $this->input->post('data_atividade'),
                		'titulo' => $this->input->post('titulo'),
                		'status' => $this->input->post('status'),
                		'descricao' => $this->input->post('descricao')
                );
                //if the insert has returned true then we show the flash message
                if($this->atividadesdao->store_atividades($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/atividades/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));

    	$data['dateInterval'] = $this->getDateInterval();
    			
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('data_atividade', 'data_atividade', 'required');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('status', 'status', 'required');
        	$this->form_validation->set_rules('descricao', 'descricao', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                		'id_usuario' => $this->session->userdata('id'),
			        	'data_atividade' => $this->input->post('data_atividade'),
			        	'titulo' => $this->input->post('titulo'),
                		'status' => $this->input->post('status'),
			        	'descricao' => $this->input->post('descricao'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->atividadesdao->update_atividades($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/atividades/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['atividades'] = $this->atividadesdao->get_atividades_by_id($id);
        //load the view
        $data['main_content'] = 'admin/atividades/edit';
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
        $this->atividadesdao->atividade_inativa($id);
        redirect('admin/atividades');
    }//edit    			
    	

    public function getDateInterval($date = null) {
    	

    	$rules = array(  	'Monday'    => array(0,4),
    			'Tuesday'   => array(1,3),
    			'Wednesday' => array(2,2),
    			'Thursday'  => array(3,1),
    			'Friday'    => array(4,0)
    	);
    	 
    	$date_min =  date('Y-m-d', strtotime(date("Y-m-d") .' -'.$rules[date("l")][0].' day' ));
    	$date_max =  date('Y-m-d', strtotime(date("Y-m-d") .' +'.$rules[date("l")][1].' day'));
    
    	return array( 'date_min' => $date_min,  'date_max' => $date_max);
    }
    
}














