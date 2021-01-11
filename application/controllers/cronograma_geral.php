<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class cronograma_geral extends App_controller {
const VIEW_FOLDER = 'admin/cronograma_geral';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cronograma_geraldao');

       
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

        $config['base_url'] = base_url().'admin/cronograma_geral';
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
            $data['count_products']= $this->cronograma_geraldao->count_cronograma_geral($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['cronograma_geral'] = $this->cronograma_geraldao->get_cronograma_geral($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['cronograma_geral'] = $this->cronograma_geraldao->get_cronograma_geral($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['cronograma_geral'] = $this->cronograma_geraldao->get_cronograma_geral('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['cronograma_geral'] = $this->cronograma_geraldao->get_cronograma_geral('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['cronograma_geral_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->cronograma_geraldao->count_cronograma_geral();
            $data['cronograma_geral'] = $this->cronograma_geraldao->get_cronograma_geral('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/cronograma_geral/list';
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
        	$this->form_validation->set_rules('data_ini', 'data_ini', 'required'); 
        	$this->form_validation->set_rules('data_fim', 'data_fim', 'required'); 
        	$this->form_validation->set_rules('ativo', 'ativo', 'required'); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('titulo' => $this->input->post('titulo'),'data_ini' => $this->input->post('data_ini'),'data_fim' => $this->input->post('data_fim'),'ativo' => $this->input->post('ativo'),'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->cronograma_geraldao->store_cronograma_geral($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/cronograma_geral/add';
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
        	$this->form_validation->set_rules('data_ini', 'data_ini', 'required');
        	$this->form_validation->set_rules('data_fim', 'data_fim', 'required');
        	$this->form_validation->set_rules('ativo', 'ativo', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'titulo' => $this->input->post('titulo'),
        	'data_ini' => $this->input->post('data_ini'),
        	'data_fim' => $this->input->post('data_fim'),
        	'ativo' => $this->input->post('ativo'),
        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->cronograma_geraldao->update_cronograma_geral($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/cronograma_geral/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['cronograma_geral'] = $this->cronograma_geraldao->get_cronograma_geral_by_id($id);
        //load the view
        $data['main_content'] = 'admin/cronograma_geral/edit';
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
        $this->cronograma_geraldao->delete_cronograma_geral($id);
        redirect('admin/cronograma_geral');
    }//edit    			

    
    public function dashboard(){
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	
    	
    	
    	//load the view
    	$data['main_content'] = 'admin/cronograma_geral/dashboard';
    	$this->load->view('includes/template', $data);
    	
    }
    
    
    public function allCronogramas(){
    	
    	header('Content-type: application/json');
    	
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    	
    	$out = array();

    	// ANTEPROJETOS EVENTS
    	$this->load->model('anteprojetosdao');
    	$data_anteprojetos =  $this->anteprojetosdao->get_anteprojetos(); 
    	
    	foreach($data_anteprojetos as $row){
    		 
    		$class = $arrayClass[rand(0, 6)];
    		 
    		if($row['data_ini_anteprojeto']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_anteprojeto'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_anteprojeto'] ) . '000');
    			 
    		}
    		 
    		if($row['data_fim_anteprojeto']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_anteprojeto'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_anteprojeto'] ) . '000');
    		}
    		 
    		if($row['data_ini_fase1']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] .' Fase 1 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase1'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase1'] ) . '000');
    			 
    		}
    		 
    		if($row['data_fim_fase1']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] .' Fase 1 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase1'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase1'] ) . '000');
    		}
    		 
    		if($row['data_ini_fase2']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] .' Fase 2 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase2'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase2'] ) . '000');
    			 
    		}
    		 
    		if($row['data_fim_fase2']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] .' Fase 2 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase2'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase2'] ) . '000');
    		}
    		 
    		if($row['data_ini_fase3']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] .' Fase3 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase3'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase3'] ) . '000');
    			 
    		}
    		 
    		if($row['data_fim_fase3']){
    			 
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] .' Fase 3 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase3'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase3'] ) . '000');
    		}
    		 
    		 
    		 
    	}

    	// PAS EVENTS
    	$this->load->model('pasdao');
    	$data_event = $this->pasdao->get_all_fases('ativo');
    	
    	foreach($data_event as $row){
    	
    		$class = $arrayClass[rand(0, 6)];
    	
    		if($row['data_ini']){
    	
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'].': '.$row['fases'] . ' - '.$row['status'].' (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini'] ) . '000',
    					"end" 	=> strtotime($row['data_ini'] ) . '000');
    	
    		}
    	
    		if($row['data_fim']){
    	
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'].': '.$row['fases'] . ' - '.$row['status'].' (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim'] ) . '000',
    					"end" 	=> strtotime($row['data_fim'] ) . '000');
    		}
    	
    	
    	}
    	
    	// CONTRATOS EVENTS
    	
    	$this->load->model('contratosdao');
    	$data_contratos =  $this->contratosdao->get_contratos();
    	
    
    	foreach($data_contratos as $row){
    	
    		$class = $arrayClass[rand(0, 6)];
    	
    		if($row['data_ordem_inicio']){
    	
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => 'Contrato: ' .$row['contrato'] . ' (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ordem_inicio'] ) . '000',
    					"end" 	=> strtotime($row['data_ordem_inicio'] ) . '000');
    	
    		}
    	
    		if($row['data_termino']){
    	
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => 'Contrato: '.$row['contrato'] . ' (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_termino'] ) . '000',
    					"end" 	=> strtotime($row['data_termino'] ) . '000');
    		}
    	
    	}
    	
    	
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    	
    	
    }
    
    
}