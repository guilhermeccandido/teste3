<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class status extends App_controller {
const VIEW_FOLDER = 'admin/status';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('statusdao');

        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
    }
    	
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    			
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 30;

        $config['base_url'] = base_url().'admin/status';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<nav class="navbar navbar-default navbar-fixed-bottom"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['next_tag_open'] = '<li>';
		$config['next_tagl_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tagl_close'] = '</li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
        	}else if($search_string == '' AND $page == null){	
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->statusdao->count_status($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['status'] = $this->statusdao->get_status($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['status'] = $this->statusdao->get_status($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['status'] = $this->statusdao->get_status('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['status'] = $this->statusdao->get_status('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['status_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->statusdao->count_status();
            $data['status'] = $this->statusdao->get_status('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //$this->debugMark('Status', $data['status']);
        $this->load->model('status_statusdao');
        $statusRel = new status_statusdao();
        
        $this->load->model('status_perfildao');
        $statusPerfil = new status_perfildao();
        
        $i = 0;
        foreach($data['status'] as $item){
        	
        	$arrayTemp = $statusRel->get_status_status_by_id_status($data['status'][$i]['id']);
        	$data['status'][$i]['next'] = $arrayTemp;
        	//$this->debugMark('Status', $arrayTemp);
        	$i++;
        }
        
        $i = 0;
        foreach($data['status'] as $item){
        	
        	$arrayTemp = $statusPerfil->get_status_perfil_by_id_status($data['status'][$i]['id']);
        	$data['status'][$i]['perfil'] = $arrayTemp;
        	//$this->debugMark('Status', $arrayTemp);
        	 
        	$i++;
        }
        unset($arrayTemp);
        //$this->debugMark('Status', $data['status']);
        
        //initializate the panination helper 
        $this->pagination->initialize($config);   
        
        $data = array_merge($data, $this->foreingControllers());

        //load the view
        $data['main_content'] = 'admin/status/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
	        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
	        	$this->form_validation->set_rules('peso', 'peso', 'required'); 
	        	$this->form_validation->set_rules('id_modulo', 'id_modulo', 'required');
	        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', '');
	        	$this->form_validation->set_rules('composicao', 'composicao', 'required');
	        	$this->form_validation->set_rules('tipo', 'tipo', 'required');
	        	$this->form_validation->set_rules('descricao', 'descricao', '');
	        	$this->form_validation->set_rules('color', 'cor', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
		        	'titulo' => $this->input->post('titulo'),
		        	'peso' => $this->input->post('peso'),
		            'composicao' => $this->input->post('composicao'),
		        	'id_modulo' => $this->input->post('id_modulo'),
                	'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
                	'tipo' => $this->input->post('tipo'),
		        	'descricao' => $this->input->post('descricao'),
                	'color' => $this->input->post('color'),  
                );
                //if the insert has returned true then we show the flash message
                if($this->statusdao->store_status($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        
        $data = array_merge($data, $this->foreingControllers());
        
        //load the view
        $data['main_content'] = 'admin/status/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        //form validation
        	$this->form_validation->set_rules('titulo', 'titulo', 'required');
        	$this->form_validation->set_rules('peso', 'peso', 'required');
        	$this->form_validation->set_rules('composicao', 'composicao', 'required');
        	$this->form_validation->set_rules('id_modulo', 'id_modulo', 'required');
        	$this->form_validation->set_rules('id_usuario_perfil', 'id_usuario_perfil', '');
        	$this->form_validation->set_rules('tipo', 'tipo', 'required');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('color', 'cor', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'titulo' => $this->input->post('titulo'),
		        	'peso' => $this->input->post('peso'),
		            'composicao' => $this->input->post('composicao'),
		        	'id_modulo' => $this->input->post('id_modulo'),
                	'id_usuario_perfil' => $this->input->post('id_usuario_perfil'),
                	'tipo' => $this->input->post('tipo'),
		        	'descricao' => $this->input->post('descricao'),      
                	'color' => $this->input->post('color'),  
                );
                //if the insert has returned true then we show the flash message
                if($this->statusdao->update_status($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/status/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['status'] = $this->statusdao->get_status_by_id($id);
        
        $data = array_merge($data, $this->foreingControllers());
        
        //load the view
        $data['main_content'] = 'admin/status/edit';
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
        $this->statusdao->delete_status($id);
        redirect('admin/status');
    }//edit
    
    
    public function foreingControllers(){
    	
    	
    	$this->load->model('modulosdao');
    	$modulos = new modulosdao();
    	$data['modulos'] = $modulos->get_modulos(null,'titulo');
    	
    	$this->load->model('usuario_perfildao');
    	$usuarioPerfil = new usuario_perfildao();
    	$data['perfil'] = $usuarioPerfil->get_usuario_perfil(null,'titulo');
    	
    	return $data;
    	
    	
    }
    
    
    
    
}
















