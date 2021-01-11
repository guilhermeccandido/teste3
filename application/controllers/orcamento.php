<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class orcamento extends App_controller {
const VIEW_FOLDER = 'admin/orcamento';

    		public function __construct()
		    {
		        parent::__construct();
		        $this->load->model('orcamentodao');
		
		        
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

        $config['base_url'] = base_url().'admin/orcamento';
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
            $data['count_products']= $this->orcamentodao->count_orcamento($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['orcamento'] = $this->orcamentodao->get_orcamento($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['orcamento'] = $this->orcamentodao->get_orcamento($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['orcamento'] = $this->orcamentodao->get_orcamento('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['orcamento'] = $this->orcamentodao->get_orcamento('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['orcamento_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->orcamentodao->count_orcamento();
            $data['orcamento'] = $this->orcamentodao->get_orcamento('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/orcamento/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$data['orcamento_modelo'] = $this->orcamentodao->get_orcamento(null, 'data_base', 'DESC' );
    	
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('id_orcamento', 'id_orcamento', 'orcamento_modelo');
        	$this->form_validation->set_rules('titulo', 'titulo', 'required'); 
        	$this->form_validation->set_rules('data_base', 'data_base', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                		'id_orcamento' => $this->input->post('id_orcamento'),
                		'titulo' => $this->input->post('titulo'),
                		'data_base' => $this->input->post('data_base'),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                if($this->orcamentodao->store_orcamento($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/orcamento/add';
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
        	$this->form_validation->set_rules('data_base', 'data_base', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
		        	'titulo' => $this->input->post('titulo'),
		        	'data_base' => $this->input->post('data_base'),
		        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->orcamentodao->update_orcamento($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/orcamento/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['orcamento'] = $this->orcamentodao->get_orcamento_by_id($id);
        //load the view
        $data['main_content'] = 'admin/orcamento/edit';
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
        $this->orcamentodao->delete_orcamento($id);
        redirect('admin/orcamento');
    }//edit    			
    	
    
    public function projecoes(){
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	//product id
    	$id = $this->uri->segment(4);
    	
    	$data = array_merge($data, $this->foreingControllersProjecoes());
    	
    	$projetacao = new orcamentodao();
    	$data['projecoes'] = $projetacao->get_projecoes_by_id_orcamento($id);
    	
    	
    	
    	//$this->PAR($data);
    	//die;
    	
    	
    	//load the view
    	$data['main_content'] = 'admin/orcamento/projecoes';
    	$this->load->view('includes/template', $data);
    }
    
    
    public function foreingControllersProjecoes(){
    	
    	$this->load->model('coordenacao_geraldao');
    	$coordenacao_geral = new coordenacao_geraldao();
    	$data['coordenacao_geral'] = $coordenacao_geral->get_coordenacao_geral('', 'titulo');
    	
    	$this->load->model('coordenacao_setorialdao');
    	$coordenacao_setorial = new coordenacao_setorialdao();
    	$data['coordenacao_setorial'] = $coordenacao_setorial->get_coordenacao_setorial('', 'titulo');    	
    	
    	$this->load->model('programasdao');
    	$programasdao = new programasdao();
    	$data['programas'] = $programasdao->get_programas('', 'titulo');
    	
    	$this->load->model('empresasdao');
    	$empresas = new empresasdao();
    	$data['empresas'] = $empresas->get_empresas('', 'titulo');
    	
    	return $data;
    	
    }
    
    public function editTable(){
    
    	header('Content-type: application/json');
    	//$teste = json_decode($data);
    	        
    	$id 	= $this->input->post('id');
    	$value = $this->input->post('value');
    	$name 	= $this->input->post('name');
    	
    	$arrayRules = array(
    		'id' 		=> 'required|numeric',
    		'rap' 		=> 	'required|numeric',
    		'cordenacao_geral'		=> 'required',
    		'coordenacao_setorial' 	=> 'required',
    		'programa' 	=> 'required',
    		'edital'	=> '',
    		'contrato' 	=> 'required',
    		'empresa'	=> '',
    		'rap'		=> 'required|numeric',
    		'medicoes_processadas_n_pagas_ano_anterior' => 	'required|numeric'		
    	);
    	
    	$this->form_validation->set_rules('id', 'id', $arrayRules['id']);
    	$this->form_validation->set_rules('value', 'value', $arrayRules[$name]);
    	
     	if ($this->form_validation->run()){
    
                $data_to_store = array(
		        	$name => $value                    
                );
                //if the insert has returned true then we show the flash message
                if($this->orcamentodao->update_orcamento_projecoes($id, $data_to_store) == TRUE){
                    //$this->session->set_flashdata('flash_message', 'updated');
                    return true;
                }else{
                	return false;
                    //$this->session->set_flashdata('flash_message', 'not_updated');
                }
                

         }
    	/*
    	//$this->PAR($editData);
    	die;
    	$myJSON = json_encode();
    	echo($myJSON);
    	*/
    
    }
    
    public function add_projecao()
    {
    	 
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$data['orcamento_modelo'] = $this->orcamentodao->get_orcamento(null, 'data_base', 'DESC' );
    	echo $data['id_orcamento'] =  $this->uri->segment(4);
    	die;
    	 
    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    
    		//form validation
    		$this->form_validation->set_rules('id_orcamento', 'id_orcamento', 'orcamento_modelo');
    		$this->form_validation->set_rules('titulo', 'titulo', 'required');
    		$this->form_validation->set_rules('data_base', 'data_base', 'required');
    		$this->form_validation->set_rules('observacoes', 'observacoes', '');
    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    
    
    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    			$data_to_store = array(
    					'id_orcamento' => $this->input->post('id_orcamento'),
    					'titulo' => $this->input->post('titulo'),
    					'data_base' => $this->input->post('data_base'),
    					'observacoes' => $this->input->post('observacoes')
    			);
    			//if the insert has returned true then we show the flash message
    			if($this->orcamentodao->store_orcamento($data_to_store)){
    				$data['flash_message'] = TRUE;
    			}else{
    				$data['flash_message'] = FALSE;
    			}
    
    		}
    
    	}
    	//load the view
    	$data['main_content'] = 'admin/orcamento/add';
    	$this->load->view('includes/template', $data);
    }
    
    public function delete_projecao()
    {
    	//$data = array();
    	//$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$id_projecao = $this->uri->segment(4);
    	$id = $this->uri->segment(5);
    	
    	$this->orcamentodao->delete_orcamento_projecao($id);
    	redirect('admin/orcamento/projecoes/'.$id_projecao);
    }//edit
    
}










