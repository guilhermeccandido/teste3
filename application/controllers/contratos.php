<?php

require_once(APPPATH . 'controllers/App_controller' . EXT);

class contratos extends App_controller {
	const VIEW_FOLDER = 'admin/contratos';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('contratosdao');

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

        $config['base_url'] = base_url().'admin/contratos';
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
            $data['count_products']= $this->contratosdao->count_contratos($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['contratos'] = $this->contratosdao->get_contratos($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['contratos'] = $this->contratosdao->get_contratos($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['contratos'] = $this->contratosdao->get_contratos('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['contratos'] = $this->contratosdao->get_contratos('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['contratos_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->contratosdao->count_contratos();
            $data['contratos'] = $this->contratosdao->get_contratos('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   
        
        $data = array_merge($data, $this->foreingControllers());
        
        //$this->PAR($data);
        //die;
        
        //load the view
        $data['main_content'] = 'admin/contratos/list';
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
        	$this->form_validation->set_rules('contrato', 'contrato', 'required');
        	//$this->form_validation->set_rules('alias', 'alias', ''); 
        	$this->form_validation->set_rules('id_executora', 'id_executora', ''); 
        	$this->form_validation->set_rules('fiscal', 'fiscal', ''); 
        	$this->form_validation->set_rules('local', 'local', ''); 
        	$this->form_validation->set_rules('coordenacao', 'coordenacao', ''); 
        	$this->form_validation->set_rules('id_intervencao', 'id_intervencao', ''); 
        	$this->form_validation->set_rules('situacao', 'situacao', ''); 
        	$this->form_validation->set_rules('objeto', 'objeto', ''); 
        	$this->form_validation->set_rules('edital', 'edital', ''); 
        	$this->form_validation->set_rules('data_proposta_base', 'data_proposta_base', ''); 
        	$this->form_validation->set_rules('data_aprovacao', 'data_aprovacao', ''); 
        	$this->form_validation->set_rules('data_assinatura', 'data_assinatura', ''); 
        	$this->form_validation->set_rules('data_publicacao', 'data_publicacao', ''); 
        	$this->form_validation->set_rules('data_ordem_inicio', 'data_ordem_inicio', ''); 
        	$this->form_validation->set_rules('data_termino', 'data_termino', ''); 
        	$this->form_validation->set_rules('prazo', 'prazo', ''); 
        	$this->form_validation->set_rules('valor_pi', 'valor_pi', ''); 
        	$this->form_validation->set_rules('valor_reajuste', 'valor_reajuste', ''); 
        	$this->form_validation->set_rules('valor_aditivo', 'valor_aditivo', ''); 
        	$this->form_validation->set_rules('valor_contrato', 'valor_contrato', ''); 
        	$this->form_validation->set_rules('valor_medido_pi', 'valor_medido_pi', ''); 
        	$this->form_validation->set_rules('valor_pago', 'valor_pago', ''); 
        	$this->form_validation->set_rules('empenhado', 'empenhado', ''); 
        	$this->form_validation->set_rules('saldo_empenho', 'saldo_empenho', ''); 
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            	/*
                $data_to_store = array('titulo' => $this->input->post('titulo'),
                		'id_executora' => $this->input->post('id_executora'),
                		'fiscal' => $this->input->post('fiscal'),
                		'local' => $this->input->post('local'),
                		'coordenacao' => $this->input->post('coordenacao'),
                		'id_intervencao' => $this->input->post('id_intervencao'),
                		'situacao' => $this->input->post('situacao'),
                		'objeto' => $this->input->post('objeto'),
                		'edital' => $this->input->post('edital'),
                		'data_proposta_base' => $this->input->post('data_proposta_base'),
                		'data_aprovacao' => $this->input->post('data_aprovacao'),
                		'data_assinatura' => $this->input->post('data_assinatura'),
                		'data_publicacao' => $this->input->post('data_publicacao'),
                		'data_ordem_inicio' => $this->input->post('data_ordem_inicio'),
                		'data_termino' => $this->input->post('data_termino'),
                		'prazo' => $this->input->post('prazo'),
                		'valor_pi' => $this->input->post('valor_pi'),
                		'valor_reajuste' => $this->input->post('valor_reajuste'),
                		'valor_aditivo' => $this->input->post('valor_aditivo'),
                		'valor_contrato' => $this->input->post('valor_contrato'),
                		'valor_medido_pi' => $this->input->post('valor_medido_pi'),
                		'valor_pago' => $this->input->post('valor_pago'),
                		'empenhado' => $this->input->post('empenhado'),
                		'saldo_empenho' => $this->input->post('saldo_empenho'),
                		'observacoes' => $this->input->post('observacoes')
                );
                */
            	$data_to_store = array(
            			'contrato' => $this->input->post('contrato'),
            			'observacoes' => $this->input->post('observacoes')
            	);
                //if the insert has returned true then we show the flash message
                if($this->contratosdao->store_contratos($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        
        
        
        //load the view
        $data['main_content'] = 'admin/contratos/add';
        
        // additional controller data
        $data = array_merge($data, $this->foreingControllers());
        
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
        	$this->form_validation->set_rules('contrato', 'contrato', 'required');
        	//$this->form_validation->set_rules('alias', 'alias', '');
        	$this->form_validation->set_rules('id_executora', 'id_executora', '');
        	$this->form_validation->set_rules('fiscal', 'fiscal', '');
        	$this->form_validation->set_rules('local', 'local', '');
        	$this->form_validation->set_rules('coordenacao', 'coordenacao', '');
        	$this->form_validation->set_rules('id_intervencao', 'id_intervencao', '');
        	$this->form_validation->set_rules('situacao', 'situacao', '');
        	$this->form_validation->set_rules('objeto', 'objeto', '');
        	$this->form_validation->set_rules('edital', 'edital', '');
        	$this->form_validation->set_rules('data_proposta_base', 'data_proposta_base', '');
        	$this->form_validation->set_rules('data_aprovacao', 'data_aprovacao', '');
        	$this->form_validation->set_rules('data_assinatura', 'data_assinatura', '');
        	$this->form_validation->set_rules('data_publicacao', 'data_publicacao', '');
        	$this->form_validation->set_rules('data_ordem_inicio', 'data_ordem_inicio', '');
        	$this->form_validation->set_rules('data_termino', 'data_termino', '');
        	$this->form_validation->set_rules('prazo', 'prazo', '');
        	$this->form_validation->set_rules('valor_pi', 'valor_pi', '');
        	$this->form_validation->set_rules('valor_reajuste', 'valor_reajuste', '');
        	$this->form_validation->set_rules('valor_aditivo', 'valor_aditivo', '');
        	$this->form_validation->set_rules('valor_contrato', 'valor_contrato', '');
        	$this->form_validation->set_rules('valor_medido_pi', 'valor_medido_pi', '');
        	$this->form_validation->set_rules('valor_contrato_pi_r', 'valor_contrato_pi_r', '');
        	$this->form_validation->set_rules('valor_pago', 'valor_pago', '');
        	$this->form_validation->set_rules('empenhado', 'empenhado', '');
        	$this->form_validation->set_rules('saldo_empenho', 'saldo_empenho', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    			/*
                $data_to_store = array(
		        	'titulo' => $this->input->post('titulo'),
		        	'id_executora' => $this->input->post('id_executora'),
		        	'fiscal' => $this->input->post('fiscal'),
		        	'local' => $this->input->post('local'),
		        	'coordenacao' => $this->input->post('coordenacao'),
		        	'id_intervencao' => $this->input->post('id_intervencao'),
		        	'situacao' => $this->input->post('situacao'),
		        	'objeto' => $this->input->post('objeto'),
		        	'edital' => $this->input->post('edital'),
		        	'data_proposta_base' => $this->input->post('data_proposta_base'),
		        	'data_aprovacao' => $this->input->post('data_aprovacao'),
		        	'data_assinatura' => $this->input->post('data_assinatura'),
		        	'data_publicacao' => $this->input->post('data_publicacao'),
		        	'data_ordem_inicio' => $this->input->post('data_ordem_inicio'),
		        	'data_termino' => $this->input->post('data_termino'),
		        	'prazo' => $this->input->post('prazo'),
		        	'valor_pi' => $this->input->post('valor_pi'),
		        	'valor_reajuste' => $this->input->post('valor_reajuste'),
		        	'valor_aditivo' => $this->input->post('valor_aditivo'),
		        	'valor_contrato' => $this->input->post('valor_contrato'),
		        	'valor_medido_pi' => $this->input->post('valor_medido_pi'),
		        	'valor_contrato_pi_r' => $this->input->post('valor_contrato_pi_r'),
		        	'valor_pago' => $this->input->post('valor_pago'),
		        	'empenhado' => $this->input->post('empenhado'),
		        	'saldo_empenho' => $this->input->post('saldo_empenho'),
		        	'observacoes' => $this->input->post('observacoes'),                    
                );
                */
            	$data_to_store = array(
            			'contrato' => $this->input->post('contrato'),
            			'observacoes' => $this->input->post('observacoes'),
            	);
                //if the insert has returned true then we show the flash message
                if($this->contratosdao->update_contratos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/contratos/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['contratos'] = $this->contratosdao->get_contratos_by_id($id);
        // additional controller data
        $data = array_merge($data, $this->foreingControllers());
        
        //load the view
        $data['main_content'] = 'admin/contratos/edit';
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
        $this->contratosdao->delete_contratos($id);
        redirect('admin/contratos');
    }//edit    			

    
    public function detalhes(){
    	
    	$data = array_merge($data, $this->foreingControllers());
    	
    	//load the view
    	$data['main_content'] = 'admin/contratos/list';
    	$this->load->view('includes/template', $data);
    }
    
    public function foreingControllers(){
    	
    	$this->load->model('empresasdao');
    	$empresa = new empresasdao();
    	$data['empresas'] = $empresa->get_empresas(null, null, 'titulo' );
    	
    	$this->load->model('intervencaodao');
    	$ntervencao = new intervencaodao();
    	$data['intervencoes'] = $ntervencao->get_intervencao(null, null, 'titulo' );
    	
    	$this->load->model('coordenacao_geraldao');
    	$coordenacao_geral = new coordenacao_geraldao();
    	$data['coordenacao_geral'] = $coordenacao_geral->get_coordenacao_geral();
    	
    	$this->load->model('coordenacao_setorialdao');
    	$coordenacao_setorial = new coordenacao_setorialdao();
    	$data['coordenacao_setorial'] = $coordenacao_setorial->get_coordenacao_setorial();
    	
    	$this->load->model('programasdao');
    	$programas = new programasdao();
    	$data['programas'] = $programas->get_programas();
    	
    	return $data;
    	
    } 
    
    public function controle(){
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$this->load->library('gcharts');
    	
    	$this->gcharts->load('LineChart');

        $this->gcharts->DataTable('Cronograma')
                      ->addColumn('string', 'Meses', 'meses')
                      ->addColumn('number', 'Estimado', 'estimado')
                      ->addColumn('number', 'Real', 'real');

        $meses = array('JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'); 
        
        //Or pass an array with the configuration options into the function
        $tooltipStyle = new textStyle(array(
        		'color' => '#C0C0B0',
        		'fontName' => 'Courier New',
        		'fontSize' => 10
        ));
        
        $tooltip = new tooltip(array(
        		'showColorCode' => TRUE,
        		'textStyle' => $tooltipStyle
        ));
        
        $dados 	= array('JAN', 30131271, 25823643);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('FEV', 33228688, 30297756);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados 	= array('MAR', 25260094, 20260000);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('ABR', 29425602, 25426665);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('MAI', 26001679, 26001679);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('JUN', 27830196, 25909573);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);        
        $dados	= array('JUL', 28135393, 27094975);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('AGO', 27400743, 27000000);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('SET', 22713864, 21984983);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('OUT', 16557695, 15777593);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('NOV', 17807007, 18943049);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('DEZ', 38169727, 36437938);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
       
        $config = array(
            	'title' => 'Cronograma',
        		'tooltip' => $tooltip,
        		'pointSize' => 4,
        		'lineWidth' => 2,
        		
        		
        );

        $this->gcharts->LineChart('Cronograma')->setConfig($config);
    	
        $this->gcharts->load('ColumnChart');
        
        $this->gcharts->DataTable('Inventory')
        ->addColumn('string', 'Classroom', 'class')
        ->addColumn('number', 'Pencils', 'pencils')
        ->addColumn('number', 'Markers', 'markers')
        ->addColumn('number', 'Erasers', 'erasers')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Erasers', 'erasers')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addRow(array(
        		'Science Class',
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100)
        ));
        
        $config = array(
        		'title' => 'Inventory'
        );
        
        $this->gcharts->ColumnChart('Inventory')->setConfig($config);
        
        
        $this->gcharts->load('DonutChart');
        
        $slice1 = rand(0,50);
        $slice2 = rand(0,50);
        $slice3 = rand(0,50);
        $slice4 = rand(0,50);
        
        $this->gcharts->DataTable('Foods')
        ->addColumn('string', 'Foods', 'food')
        ->addColumn('string', 'Amount', 'amount')
        ->addRow(array('Pizza', $slice1))
        ->addRow(array('Beer', $slice2))
        ->addRow(array('Steak', $slice3))
        ->addRow(array('Bacon', $slice4));
        
        $config = array(
        		'title' => 'My Foods',
        		'pieHole' => .4
        );
        
        $this->gcharts->DonutChart('Foods')->setConfig($config);
        
        
    	//all the posts sent by the view
    	$search_string = $this->input->post('search_string');
    	$order = $this->input->post('order');
    	$order_type = $this->input->post('order_type');
    	
    	//pagination settings
    	$config['per_page'] = 30;
    	
    	$config['base_url'] = base_url().'admin/contratos';
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
    			$data['count_products']= $this->contratosdao->count_contratos($search_string, $order);
    				$config['total_rows'] = $data['count_products'];
    	
    				//fetch sql data into arrays
    						if($search_string){
    				if($order){
    				$data['contratos'] = $this->contratosdao->get_contratos($search_string, $order, $order_type, $config['per_page'],$limit_end);
    				}else{
    				$data['contratos'] = $this->contratosdao->get_contratos($search_string, '', $order_type, $config['per_page'],$limit_end);
    		}
    		}else{
    		if($order){
    		$data['contratos'] = $this->contratosdao->get_contratos('', $order, $order_type, $config['per_page'],$limit_end);
    		}else{
    		$data['contratos'] = $this->contratosdao->get_contratos('', '', $order_type, $config['per_page'],$limit_end);
    		}
    		}
    	
    		}else{
    	
    		//clean filter data inside section
    		$filter_session_data['contratos_selected'] = null;
    		$filter_session_data['search_string_selected'] = null;
    				$filter_session_data['order'] = null;
    				$filter_session_data['order_type'] = null;
    						$this->session->set_userdata($filter_session_data);
    	
    		//pre selected options
    			$data['search_string_selected'] = '';
    					$data['order'] = 'id';
    	
    					//fetch sql data into arrays
    					$data['count_products']= $this->contratosdao->count_contratos();
    						$data['contratos'] = $this->contratosdao->get_contratos('', '', $order_type, $config['per_page'],$limit_end);
    						$config['total_rows'] = $data['count_products'];
    	
    		}//!isset($search_string) && !isset($order)
    			 
    			//initializate the panination helper
    			$this->pagination->initialize($config);
    	
    		$data = array_merge($data, $this->foreingControllers());
    	
    		
    	
    	$data['main_content'] = 'admin/contratos/controle';
    	$this->load->view('includes/template', $data);
    	
    }
    
    
    public function upload_data()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		if($_FILES["file"]["name"]){
    			$fileName = $_FILES["file"]["name"] ;
    	
    			$colecao = array(
    					'"Contrato"',
    					'"UF Unidade Local"',
    					'"Todas BR´s"',
    					'"Empresa"',
    					'"Situação do Contrato"',
    					'"Cnpj/Cpf da Empresa"',
    					'"Modalidade da Licitação"',
    					'"Número do Edital"',
    					'"Número do Processo"',
    					'"Objeto da Contratação"',
    					'"Programa"',
    					'"Tipo de Licitação"',
    					'"Tipo Intervenção"',
    					'"Tipo Contrato"',
    					'"Unidade Gestora"',
    					'"Fiscal Titular"',
    					'"Unidade de Lotação do Fiscal Titular"',
    					'"Data de Início"',
    					'"Data do Término Atualizada"',
    					'"Data da Aprovação"',
    					'"Data da Assinatura"',
    					'"Data da Proposta"',
    					'"Data da Publicação"',
    					'"Valor Inicial"',
    					'"Valor Total de Reajuste"',
    					'"Valor Inicial + Adtivo"',
    					'"Valor Inicial +Aditivos+Reajuste"',
    					'"Valor PI Medição"',
    					'"Valor Medição (PI+R)"'
    			);
    			 
    			$colecao_id = array(
    					'contrato' => '"Contrato"',
    					'uf' =>  '"UF Unidade Local"',
    					'rodovia' => '"Todas BR´s"',
    					'executora' => '"Empresa"',
    					'situacao' => '"Situação do Contrato"',
    					'cnpj' => '"Cnpj/Cpf da Empresa"',
    					'modalidade' => '"Modalidade da Licitação"',
    					'edital' => '"Número do Edital"',
    					'processo' =>'"Número do Processo"',
    					'objeto' => '"Objeto da Contratação"',
    					'programa' => '"Programa"',
    					'tipo_licitacao' => '"Tipo de Licitação"',
    					'tipo_intervencao' => '"Tipo Intervenção"',
    					'tipo_contrato' => '"Tipo Contrato"',
    					'unidade_gestora' => '"Unidade Gestora"',
    					'fiscal' => '"Fiscal Titular"',
    					'unidade_lotacao_fiscal' => '"Unidade de Lotação do Fiscal Titular"',
    					'data_ordem_inicio' => '"Data de Início"',
    					'data_termino' => '"Data do Término Atualizada"',
    					'data_aprovacao' => '"Data da Aprovação"',
    					'data_assinatura' => '"Data da Assinatura"',
    					'data_proposta_base' => '"Data da Proposta"',
    					'data_publicacao' => '"Data da Publicação"',
    					'valor_pi' => '"Valor Inicial"',
    					'valor_reajuste' => '"Valor Total de Reajuste"',
    					'valor_aditivo' => '"Valor Inicial + Adtivo"',
    					'valor_contrato' => '"Valor Inicial +Aditivos+Reajuste"',
    					'valor_medido_pi' => '"Valor PI Medição"',
    					'valor_medido_pi_r_acum' => '"Valor Medição (PI+R)"'
    			);
    			 
    			
    			// start to read the file
    			 
    			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    			$inputFile = $_FILES["file"]["tmp_name"];
    	
    			$uploadOk = 1;
    			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    			 
    			// Check if $uploadOk is set to 0 by an error
    			if ($uploadOk == 0 or $fileName == '') {
    			} else {
    				/*
    				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    					$inputFile  = HCS_FOLDER . str_replace(' ', '_', $this->createRandWord(10).'_'.$fileName);
    					copy ( $target_file , $inputFile );
    					unlink($target_file);
    					 
    				} else {
    					echo "Desculpe, ouve um erro no upload do arquivo.";
    					die;
    				}
    				*/
    			}
    	
    			
    			$separador = '";';
    			 
    			$fp = fopen($inputFile, "r");
    			$fileLines = array();
    			 
    			$i = 0;
    			$lin_cab = 0;
    			$linhas = 0;
    			$reg_lin = 0;
    			$reg_total = 0;
    			$first = true;
    			$tmpInsert = array();
    			$insertData = array(); 
    			 
    			while (!feof($fp)){
    				//echo $i;
    				$convert = fgets($fp);
    				if($convert <> ''){
    					$temp =  str_replace('"~"', '"~~"',$convert);
    					$temp =  str_replace('";"', '"~~"',$temp);
    					$temp =  str_replace(';', ',',$temp);
    					$temp =  str_replace('"~~"', '";"',$temp);
    					//echo "<br>";
    					$temp =  explode(";", $temp);
    					
    					$i++;
    					//echo 'TEMP<BR>';
    					//$this->PAR($temp);
    					//die;
    					if($first){
    						$first = false;
    						$viewData[] = $temp;
    						// coletando a localizacao dos indices
    						foreach($colecao as $item){
    							//$item = str_replace('+', '', $item);
    							//echo "Buscando ".$item."<br>";
    							$key = array_search( $item , $temp);
    							//echo "Encontrato na posição: ".$key." o indice ".$item."<br>";
    							
    							$arrayIndices[$item] = $key;
    							
    							//$i++;
    							//echo $item.' '.$key;
    							//echo '<br>';
    							
    						};
    						//echo '<BR>ARRAY IND <BR>';
    						//$this->PAR($arrayIndices);
    						//die;
    						$lin_cab++;
    					}else{
    						
    						foreach($colecao_id as $key => $value){
    							 
    							 $label =  substr($key, 0, 4);
    							 if( $label == 'data'  ){
    							 	//$tmpInsert[$linhas][$key] =  implode("-",array_reverse(explode("/",$temp[$arrayIndices[$value]] ))) ; // formata a data para padrão MySQL
    							 	$tmpInsert[$key] = implode("-",array_reverse(explode("/",$temp[$arrayIndices[$value]] )));
    							 	$tmpInsert[$key] = str_replace('"', '',$tmpInsert[$key]);
    							 	
    							 //TODO check this rule
    							 }else if($label == 'valo') {
    							 	$tmpValue 	= strstr($temp[$arrayIndices[$value]], 'R$', false); // coleta os valores depois de R$, incluindo R$
    							 	$tmpValue 	= str_replace('.', '',$tmpValue);
    							 	$tmpValue 	= str_replace('R$', '',$tmpValue);
    							 	$tmpValue 	= str_replace(',', '.',$tmpValue);
    							 	//$pos_dec 	= strrchr($tmpValue, '.'); // coleta os valores apos a ultima casa decimal, incluindo o ponto "."
    							 	//$tmpValue 	= str_replace('.', '', strstr($tmpValue, $pos_dec , true)); // retira os pontos da string resultante, que é a string sem as ultimas casas decimais e ponto
    							 	//$tmpInsert[$linhas][$key] = $tmpValue.$pos_dec; // reinsere o valor formatado padrão americano no array
    							 	$tmpInsert[$key] = str_replace('"', '', $tmpValue);
    							 
    							 }else{
    							 	//$tmpInsert[$linhas][$key] =  $temp[$arrayIndices[$value]] ;
    							 	$tmpInsert[$key] = str_replace('"', '', $temp[$arrayIndices[$value]]);
    							 	
    							 }
    							 
    							// echo $value.' '.$temp[$arrayIndices[$value]]. '<br>';
    							// echo '<br>';
    							// echo $key;
    							// echo '<br>'; 
    							 $reg_lin++;
    							 $reg_total++;
    						}
    						//$this->PAR($tmpInsert);
    						//die;
    						if($this->contratosdao->store_contratos($tmpInsert)){
    							$data['flash_message'] = TRUE;
    						}else{
    							$data['flash_message'] = FALSE;
    						}
    						
    						
    						
    						
    						//$this->PAR($tmpInsert);
    						$linhas++;
    						echo '<br>';
    						echo 'Linha: ' . $linhas . ' Registros: ' . $reg_lin;
    						echo '<br>';
    						$reg_lin = 0;
    						
    			    
    			    
    			    
    					}
	    					
    				}
    			}
    			echo '<br><br>';
    			echo 'Linhas de Cabeçalho:' . $lin_cab;
    			echo '<br>';
    			echo 'Linhas de Dados:' . $linhas;
    			echo '<br>';
    			echo 'Total de linhas:' . ($linhas + $lin_cab);
    			echo '<br><br>';
    			echo 'Registros Totais:' . $reg_total; 
    			die;
    			fclose($fp);
    			//fclose($fpOut);
    			unlink($inputFile);
    		}
    	
    	}
    
    	//load the view
        $data['main_content'] = 'admin/contratos/upload_data';
        $this->load->view('includes/template', $data);   
    }
    
    public function upload_medicoes()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    
    	 
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		if($_FILES["file"]["name"]){
    			$fileName = $_FILES["file"]["name"] ;
    			 
    			$colecao = array(
    					'"Contrato"',
    					'"Número da Medição"',
    					'"Data Término Medição"',
    					'"Data Processamento Medição"',
    					'"Valor PI Medição"',
    					'"Valor Reajuste Medição"'
    			);
    
    			$colecao_id = array(
    					'contrato' => '"Contrato"',
    					'n_medicao' =>  '"Número da Medição"',
    					'data_termino_medicao' => '"Data Término Medição"',
    					'data_processamento_medicao' => '"Data Processamento Medição"',
    					'valor_medido_pi' => '"Valor PI Medição"',
    					'valor_medido_pi_r' => '"Valor Reajuste Medição"'
    			);
    
    			$distinct_contratos = $this->contratosdao->get_contratos_distinct();
    			
    			//$this->PAR($colecao);
    			//$this->PAR($colecao_id);
    			//$this->PAR($distinct_contratos);
    			$lisContratos[] = 'XX';
    			foreach($distinct_contratos as $item){
    				$lisContratos[] = $item['contrato'];
    			}
    			//$this->PAR($lisContratos);
    			//die;
    			
    			// start to read the file
    
    			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    			$inputFile = $_FILES["file"]["tmp_name"];
    			 
    			$uploadOk = 1;
    			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    			// Check if $uploadOk is set to 0 by an error
    			if ($uploadOk == 0 or $fileName == '') {
    			} else {
    				/*
    				 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    				$inputFile  = HCS_FOLDER . str_replace(' ', '_', $this->createRandWord(10).'_'.$fileName);
    				copy ( $target_file , $inputFile );
    				unlink($target_file);
    
    				} else {
    				echo "Desculpe, ouve um erro no upload do arquivo.";
    				die;
    				}
    				*/
    			}
    			 
    			 
    			$separador = ";";
    
    			$fp = fopen($inputFile, "r");
    			$fileLines = array();
    
    			$i = 0;
    			$lin_cab = 0;
    			$linhas = 0;
    			$reg_lin = 0;
    			$reg_total = 0;
    			$first = true;
    			$tmpInsert = array();
    			$insertData = array();
    
    			while (!feof($fp)){
    				//echo $i;
    				$convert = fgets($fp);
    				if($convert <> ''){
    					
    					//echo "<br>";
    					
    					if(mb_detect_encoding($convert, $this->enclist) != 'UTF-8'){
    						$temp =  utf8_encode($convert);
    						
    					}else{
    						$temp =  $convert;
    						
    					}
    					$temp =  explode(";", $temp);
    					// TODO :  CREATE A RULE TO IDENTIFY THIS
    					//$temp =  explode(";", utf8_encode($convert));
    					
    					
    					$i++;
    					//echo 'TEMP<BR>';
    					//$this->PAR($temp);
    					//die;
    					if($first){
    						$first = false;
    						$viewData[] = $temp;
    						// coletando a localizacao dos indices
    						foreach($colecao as $item){
    							$key = array_search( $item , $temp);
    							$arrayIndices[$item] = $key;
    							//echo $key." ind ".$item."<br>";
    							//$i++;
    							//echo $item.' '.$key;
    							//echo '<br>';
    								
    						};
    						//echo '<BR>ARRAY IND <BR>';
    						//$this->PAR($arrayIndices);
    						//die;
    						$lin_cab++;
    					}else{
    						
    						//$this->PAR($temp);
    						//die;
    						// insere somente dados de contratos cadastrados no sistema
    						
    						if( array_search( str_replace('"', '',$temp[$arrayIndices['"Contrato"']]) , $lisContratos )){
    							
	    						foreach($colecao_id as $key => $value){
	    
	    							$label =  substr($key, 0, 4);
	    							if( $label == 'data'  ){
	    								//$tmpInsert[$linhas][$key] =  implode("-",array_reverse(explode("/",$temp[$arrayIndices[$value]] ))) ; // formata a data para padrão MySQL
	    								$tmpInsert[$key] = implode("-",array_reverse(explode("/",$temp[$arrayIndices[$value]] )));
	    								$tmpInsert[$key] = str_replace('"', '',$tmpInsert[$key]);
	    									
	    								//TODO check this rule
	    							}else if($label == 'valo') {
	    								$tmpValue 	= strstr($temp[$arrayIndices[$value]], 'R$', false); // coleta os valores depois de R$, incluindo R$
	    								$tmpValue 	= str_replace('.', '',$tmpValue);
	    								$tmpValue 	= str_replace('R$', '',$tmpValue);
	    								$tmpValue 	= str_replace(',', '.',$tmpValue);
	    								//$pos_dec 	= strrchr($tmpValue, '.'); // coleta os valores apos a ultima casa decimal, incluindo o ponto "."
	    								//$tmpValue 	= str_replace('.', '', strstr($tmpValue, $pos_dec , true)); // retira os pontos da string resultante, que é a string sem as ultimas casas decimais e ponto
	    								//$tmpInsert[$linhas][$key] = $tmpValue.$pos_dec; // reinsere o valor formatado padrão americano no array
	    								$tmpInsert[$key] = str_replace('"', '', $tmpValue);
	    							
	    							}else{
	    								//$tmpInsert[$linhas][$key] =  $temp[$arrayIndices[$value]] ;
	    								$tmpInsert[$key] = str_replace('"', '', $temp[$arrayIndices[$value]]);
	    									
	    							}
	    							
	    							 //echo $value.' '.$temp[$arrayIndices[$value]]. '<br>';
	    							 //echo '<br>';
	    							 //echo $key;
	    							 //echo '<br>';
	    							$reg_lin++;
	    							$reg_total++;
	    							//die;
	    						}
	    						//$this->PAR($tmpInsert);
	    						//die;
	    						
	    						if($this->contratosdao->store_contratos_medicoes($tmpInsert)){
	    							$data['flash_message'] = TRUE;
	    						}else{
	    							$data['flash_message'] = FALSE;
	    						}
	    						
	    						
	    
	    						//$this->PAR($tmpInsert);
	    						$linhas++;
	    						//echo '<br>';
	    						//echo 'Linha: ' . $linhas . ' Registros: ' . $reg_lin;
	    						//echo '<br>';
	    						$reg_lin = 0;
    						}	
    					}
    
    				}
    			}
    			echo '<br><br>';
    			echo 'Linhas de Cabeçalho:' . $lin_cab;
    			echo '<br>';
    			echo 'Linhas de Dados:' . $linhas;
    			echo '<br>';
    			echo 'Total de linhas:' . ($linhas + $lin_cab);
    			echo '<br><br>';
    			echo 'Registros Totais:' . $reg_total;
    			//die; 
    			fclose($fp);
    			//fclose($fpOut);
    			unlink($inputFile);
    		}
    		 
    	}
    
    	//load the view
    	$data['main_content'] = 'admin/contratos/upload_medicoes';
    	$this->load->view('includes/template', $data);
    }
    
    public function upload_empenhos()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    
    
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		if($_FILES["file"]["name"]){
    			$fileName = $_FILES["file"]["name"] ;
    
    			$colecao = array(
    					'"Contrato"',
    					'"Nota de Empenho"',
    					'"Data Emissão Empenho"',
    					'"Valor Empenho Inicial"',
    					'"Valor Empenho Consumido"'
    			);
    
    			$colecao_id = array(
    					'contrato' => '"Contrato"',
    					'nota_empenho' =>  '"Nota de Empenho"',
    					'data_emissao_empenho' => '"Data Emissão Empenho"',
    					'valor_empenho_inicial' => '"Valor Empenho Inicial"',
    					'valor_empenho_consumido' => '"Valor Empenho Consumido"'
    			);
    
    			$distinct_contratos = $this->contratosdao->get_contratos_distinct();
    			 
    			//$this->PAR($colecao);
    			//$this->PAR($colecao_id);
    			//die;
    			//$this->PAR($distinct_contratos);
    			$lisContratos[] = 'XX';
    			foreach($distinct_contratos as $item){
    				$lisContratos[] = $item['contrato'];
    			}
    			//$this->PAR($lisContratos);
    			//die;
    			 
    			// start to read the file
    
    			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
    			$inputFile = $_FILES["file"]["tmp_name"];
    
    			$uploadOk = 1;
    			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    			// Check if $uploadOk is set to 0 by an error
    			if ($uploadOk == 0 or $fileName == '') {
    			} else {
    				/*
    				 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    				$inputFile  = HCS_FOLDER . str_replace(' ', '_', $this->createRandWord(10).'_'.$fileName);
    				copy ( $target_file , $inputFile );
    				unlink($target_file);
    
    				} else {
    				echo "Desculpe, ouve um erro no upload do arquivo.";
    				die;
    				}
    				*/
    			}
    
    
    			$separador = ";";
    
    			$fp = fopen($inputFile, "r");
    			$fileLines = array();
    
    			$i = 0;
    			$lin_cab = 0;
    			$linhas = 0;
    			$reg_lin = 0;
    			$reg_total = 0;
    			$first = true;
    			$tmpInsert = array();
    			$insertData = array();
    
    			while (!feof($fp)){
    				//echo $i;
    				$convert = fgets($fp);
    				if($convert <> ''){
    
    					// TODO :  CREATE A RULE TO IDENTIFY THIS
    					//$temp =  explode(";", utf8_encode($convert));
    					if(mb_detect_encoding($convert, $this->enclist) != 'UTF-8'){
    						$temp =  utf8_encode($convert);
    					}else{
    						$temp =  $convert;
    					}
    						
    					$temp =  explode(";", $temp);
    					$i++;
    					//echo 'TEMP<BR>';
    					//$this->PAR($temp);
    					//die;
    					// TODO :  N ESTA LOCALIZANDO O INDICE "Valor Empenho Consumido"
    					if($first){
    						$first = false;
    						$viewData[] = $temp;
    						// coletando a localizacao dos indices
    						foreach($colecao as $item){
    							$key = array_search( $item , $temp);
    							$arrayIndices[$item] = $key;
    							//echo $key." ind ".$item."<br>";
    							//$i++;
    							//echo $item.' '.$key;
    							//echo '<br>';
    
    						};
    						// tive que forçar
    						$arrayIndices['"Valor Empenho Consumido"'] = 4;
    						//echo '<BR>ARRAY IND <BR>';
    						//$this->PAR($arrayIndices);
    						//die;
    						$lin_cab++;
    					}else{
    
    						
    
    						// insere somente dados de contratos cadastrados no sistema
    
    						if( array_search( str_replace('"', '',$temp[$arrayIndices['"Contrato"']]) , $lisContratos )){
    							
	    						foreach($colecao_id as $key => $value){
	    
	    							$label =  substr($key, 0, 4);
	    							if( $label == 'data'  ){
	    								//$tmpInsert[$linhas][$key] =  implode("-",array_reverse(explode("/",$temp[$arrayIndices[$value]] ))) ; // formata a data para padrão MySQL
	    								$tmpInsert[$key] = implode("-",array_reverse(explode("/",$temp[$arrayIndices[$value]] )));
	    								$tmpInsert[$key] = str_replace('"', '',$tmpInsert[$key]);
	    									
	    								//TODO check this rule
	    							}else if($label == 'valo') {
	    								$tmpValue 	= strstr($temp[$arrayIndices[$value]], 'R$', false); // coleta os valores depois de R$, incluindo R$
	    								$tmpValue 	= str_replace('.', '',$tmpValue);
	    								$tmpValue 	= str_replace('R$', '',$tmpValue);
	    								$tmpValue 	= str_replace(',', '.',$tmpValue);
	    								//$pos_dec 	= strrchr($tmpValue, '.'); // coleta os valores apos a ultima casa decimal, incluindo o ponto "."
	    								//$tmpValue 	= str_replace('.', '', strstr($tmpValue, $pos_dec , true)); // retira os pontos da string resultante, que é a string sem as ultimas casas decimais e ponto
	    								//$tmpInsert[$linhas][$key] = $tmpValue.$pos_dec; // reinsere o valor formatado padrão americano no array
	    								$tmpInsert[$key] = str_replace('"', '', $tmpValue);
	    							
	    							}else{
	    								//$tmpInsert[$linhas][$key] =  $temp[$arrayIndices[$value]] ;
	    								$tmpInsert[$key] = str_replace('"', '', $temp[$arrayIndices[$value]]);
	    									
	    							}
    								 
    								// echo $value.' '.$temp[$arrayIndices[$value]]. '<br>';
    								// echo '<br>';
    								// echo $key;
    								// echo '<br>';
    								$reg_lin++;
    								$reg_total++;
    							}
    							//$this->PAR($tmpInsert);
    							//die;
    								
    							if($this->contratosdao->store_contratos_empenhos($tmpInsert)){
    								$data['flash_message'] = TRUE;
    							}else{
    								$data['flash_message'] = FALSE;
    							}
    							
    							
    								
    							 
    							//$this->PAR($tmpInsert);
    							$linhas++;
    							//echo '<br>';
    							//echo 'Linha: ' . $linhas . ' Registros: ' . $reg_lin;
    							//echo '<br>';
    							$reg_lin = 0;
    						}
    					}
    
    				}
    			}
    			echo '<br><br>';
    			echo 'Linhas de Cabeçalho:' . $lin_cab;
    			echo '<br>';
    			echo 'Linhas de Dados:' . $linhas;
    			echo '<br>';
    			echo 'Total de linhas:' . ($linhas + $lin_cab);
    			echo '<br><br>';
    			echo 'Registros Totais:' . $reg_total;
    
    			fclose($fp);
    			//fclose($fpOut);
    			unlink($inputFile);
    		}
    		 
    	}
    
    	//load the view
    	$data['main_content'] = 'admin/contratos/upload_empenhos';
    	$this->load->view('includes/template', $data);
    }
    
    
    function orcamento(){
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$id_orcamento = strtoupper( $this->uri->segment(4) );
    	$id_setorial = strtoupper( $this->uri->segment(5) );
    	$id_programa = strtoupper( $this->uri->segment(6) );
    	
    	if(!$id_orcamento ){
    		$tempArray = $this->contratosdao->get_last_record_by_base_data();
    		$id_orcamento = $tempArray[0]['id_orcamento'];
    		$data['id_orcamento'] = $id_orcamento;
    		
    	}else if(!(is_numeric($id_orcamento))){
    		
    		$tempArray = $this->contratosdao->get_last_record_by_base_data();
    		$id_orcamento = $tempArray[0]['id_orcamento'];
    		$data['id_orcamento'] = $id_orcamento;
    		$id_setorial = strtoupper( $this->uri->segment(4) );
    		$id_programa = strtoupper( $this->uri->segment(5) );
    		
    		
    	}else{
    		$data['id_orcamento'] = $id_orcamento;
    	}
    	
    	
    	$data['nav_bar'] = $this->contratosdao->get_menu_nav($id_orcamento);
    	
    	//$this->PAR($data['nav_bar']);
    	//DIE;
    	
    	$this->load->model('coordenacao_setorialdao');
    	$tmpId =  $this->coordenacao_setorialdao->get_id_by_alias($id_setorial);
    	$id_setorial = !empty($tmpId[0]['id']) ? $tmpId[0]['id'] : null ;
    	
    	$this->load->model('programasdao');
    	$tmpId =   $this->programasdao->get_id_by_alias($id_programa);
    	$id_programa = !empty($tmpId[0]['id']) ? $tmpId[0]['id'] : null ;
    	
    	$data['orcamentos'] = $this->contratosdao->get_orcamento_contratos_by_option($id_orcamento, 1, $id_setorial, $id_programa);
    	$data['orcamento_totais'] = $this->contratosdao->get_top_content_values_by_option($id_orcamento, 1, $id_setorial, $id_programa);
    	
    	$data['orcamento_totais'][0]['previsao_pagamento_ano_corrente'] = 
    	$data['orcamento_totais'][0]['med_n_pagas_ano_anterior'] +
    		$data['orcamento_totais'][0]['prev_medicoes_ano_anterior'] + 
    		$data['orcamento_totais'][0]['total_cronograma_partial'];

    	
    	$data['orcamento_totais'][0]['necessidade_empenho_ano_corrente'] =
	    	$data['orcamento_totais'][0]['est_saldo_empenho'] - (
	    	$data['orcamento_totais'][0]['total_cronograma_partial'] +
    		$data['orcamento_totais'][0]['total_dez'] );
		//$this->PAR($data['orcamento_totais']);
		//die;
    	
    	$this->load->library('gcharts');
    	
    	$this->gcharts->load('LineChart');

        $this->gcharts->DataTable('Cronograma')
                      ->addColumn('string', 'Meses', 'meses')
                      ->addColumn('number', 'Estimado', 'estimado')
                      ->addColumn('number', 'Real', 'real');

        $meses = array('JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'); 
        
        //Or pass an array with the configuration options into the function
        $tooltipStyle = new textStyle(array(
        		'color' => '#C0C0B0',
        		'fontName' => 'Courier New',
        		'fontSize' => 10
        ));
        
        $tooltip = new tooltip(array(
        		'showColorCode' => TRUE,
        		'textStyle' => $tooltipStyle
        ));
        
        $dados 	= array('JAN', 30131271, 25823643);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('FEV', 33228688, 30297756);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados 	= array('MAR', 25260094, 20260000);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('ABR', 29425602, 25426665);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('MAI', 26001679, 26001679);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('JUN', 27830196, 25909573);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);        
        $dados	= array('JUL', 28135393, 27094975);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('AGO', 27400743, 27000000);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('SET', 22713864, 21984983);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('OUT', 16557695, 15777593);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('NOV', 17807007, 18943049);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
        $dados	= array('DEZ', 38169727, 36437938);
        $this->gcharts->DataTable('Cronograma')->addRow($dados);
       
        $config = array(
            	'title' => 'Cronograma',
        		'tooltip' => $tooltip,
        		'pointSize' => 4,
        		'lineWidth' => 2,
        		
        		
        );

        $this->gcharts->LineChart('Cronograma')->setConfig($config);
    	
        $this->gcharts->load('ColumnChart');
        
        $this->gcharts->DataTable('Inventory')
        ->addColumn('string', 'Classroom', 'class')
        ->addColumn('number', 'Pencils', 'pencils')
        ->addColumn('number', 'Markers', 'markers')
        ->addColumn('number', 'Erasers', 'erasers')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Erasers', 'erasers')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addColumn('number', 'Binders', 'binders')
        ->addRow(array(
        		'Science Class',
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100),
        		rand(50, 100)
        ));
        
        $config = array(
        		'title' => 'Inventory'
        );
        
        $this->gcharts->ColumnChart('Inventory')->setConfig($config);
        
        
        $this->gcharts->load('DonutChart');
        
        $slice1 = rand(0,50);
        $slice2 = rand(0,50);
        $slice3 = rand(0,50);
        $slice4 = rand(0,50);
        
        $this->gcharts->DataTable('Foods')
        ->addColumn('string', 'Foods', 'food')
        ->addColumn('string', 'Amount', 'amount')
        ->addRow(array('Pizza', $slice1))
        ->addRow(array('Beer', $slice2))
        ->addRow(array('Steak', $slice3))
        ->addRow(array('Bacon', $slice4));
        
        $config = array(
        		'title' => 'My Foods',
        		'pieHole' => .4
        );
        
        $this->gcharts->DonutChart('Foods')->setConfig($config);
        
        
    	//all the posts sent by the view
    	$search_string = $this->input->post('search_string');
    	$order = $this->input->post('order');
    	$order_type = $this->input->post('order_type');
    	
    	//pagination settings
    	$config['per_page'] = 30;
    	
    	$config['base_url'] = base_url().'admin/contratos';
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
    			$data['count_products']= $this->contratosdao->count_contratos($search_string, $order);
    				$config['total_rows'] = $data['count_products'];
    	
    				//fetch sql data into arrays
    						if($search_string){
    				if($order){
    				$data['contratos'] = $this->contratosdao->get_contratos($search_string, $order, $order_type, $config['per_page'],$limit_end);
    				}else{
    				$data['contratos'] = $this->contratosdao->get_contratos($search_string, '', $order_type, $config['per_page'],$limit_end);
    		}
    		}else{
    		if($order){
    		$data['contratos'] = $this->contratosdao->get_contratos('', $order, $order_type, $config['per_page'],$limit_end);
    		}else{
    		$data['contratos'] = $this->contratosdao->get_contratos('', '', $order_type, $config['per_page'],$limit_end);
    		}
    		}
    	
    		}else{
    	
    		//clean filter data inside section
    		$filter_session_data['contratos_selected'] = null;
    		$filter_session_data['search_string_selected'] = null;
    				$filter_session_data['order'] = null;
    				$filter_session_data['order_type'] = null;
    						$this->session->set_userdata($filter_session_data);
    	
    		//pre selected options
    			$data['search_string_selected'] = '';
    					$data['order'] = 'id';
    	
    					//fetch sql data into arrays
    					$data['count_products']= $this->contratosdao->count_contratos();
    						$data['contratos'] = $this->contratosdao->get_contratos('', '', $order_type, $config['per_page'],$limit_end);
    						$config['total_rows'] = $data['count_products'];
    	
    		}//!isset($search_string) && !isset($order)
    			 
    			//initializate the panination helper
    			$this->pagination->initialize($config);
    	
    		$data = array_merge($data, $this->foreingControllers());
    	
    	$data['main_content'] = 'admin/contratos/orcamento';
    	$this->load->view('includes/template', $data);
    }
    
    
    function gerencial(){
    	 
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	
    	$this->load->model('contratosdao');
    	 
    	$id_orcamento = 4;
    	$data['id_orcamento'] = 4;
    	
    	$id_setorial = strtoupper( $this->uri->segment(4) );
    	$id_programa = strtoupper( $this->uri->segment(5) );
    	$id_contrato = strtoupper( $this->uri->segment(6) );
    	
    	//die;
    	
    	$data['nav_bar'] = $this->contratosdao->get_menu_nav_gerencial();
    	
    	$data['contrato'] = null;
    	$data['tabela_resumo'] = null;
    	
    	//$this->PAR($data['nav_bar']);
    	//DIE;
    	 
    	$this->load->model('coordenacao_setorialdao');
    	$tmpId =  $this->coordenacao_setorialdao->get_id_by_alias($id_setorial);
    	$id_setorial = !empty($tmpId[0]['id']) ? $tmpId[0]['id'] : null ;
    	 
    	$this->load->model('programasdao');
    	$tmpId =   $this->programasdao->get_id_by_alias($id_programa);
    	$id_programa = !empty($tmpId[0]['id']) ? $tmpId[0]['id'] : null ;
    	
		// caso seja especificada a setorial
    	if($id_setorial){
    		
    		//caso seja especificada a setorial e o programa
    		if($id_programa){
    			
    			if($id_contrato){
    				
    				$data['contrato'] = $this->contratosdao->get_contratos_by_id($id_contrato);
    				$tmpArray = $this->contratosdao->get_valor_contratado_by_setorial_programa_or_by_id_contrato($id_setorial, $id_programa, $id_contrato);
    				$data['valor_contrato'] =  $tmpArray[0]['valor_contrato'];
    				$contrato = $tmpArray[0]['titulo'];
    				
    				$tmpArray = $this->contratosdao->get_valor_medido_acumulado_by_setorial_programa_or_by_id_contrato($id_setorial, $id_programa, $id_contrato);
    				$data['valor_medido_acumulado_pi_r'] =  isset($tmpArray[0]['valor_medido_acumulado_pi_r']) ? $tmpArray[0]['valor_medido_acumulado_pi_r'] : null ;
    				
    				$tmpArray = $this->contratosdao->get_valor_medido_mes_corrente_by_contrato($contrato);
    				$data['valor_medido_pi'] =  $tmpArray[0]['valor_medido_pi'];
    				
    				$tmpArray = $this->contratosdao->get_valor_saldo_empenho_by_contrato($data['contrato'][0]['contrato']);
    				$data['contrato'][0]['saldo_empenho'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_saldo_empenho'] : '0' ;
    				$data['valor_saldo_empenho'] = $data['contrato'][0]['saldo_empenho'];
    				$data['contrato'][0]['valor_empenhado'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_empenhado'] : '0' ;
    				$data['valor_empenhado'] = $data['contrato'][0]['valor_empenhado'];
    				
    				$tmpArray = $this->contratosdao->get_all_valores_medidos_by_contrato($contrato);
    				$data['lineChartAcum'] = false;
    				
    				
    				if(isset($tmpArray[0])){
    					$data['medicoes_last_year'][$tmpArray[0]['label']] = $tmpArray;
    					$lineChartAcum[$tmpArray[0]['label']] = $tmpArray; 
    					$arrayColunm[] = $tmpArray[0]['label'];
    					$data['lineChartAcum'] = true;
    				}
    				$tmpArray = $this->contratosdao->get_all_valores_empenho_by_contrato($contrato);
    				
    				
    				if(isset($tmpArray[0])){
    					$data['empenho_last_year'][$tmpArray[0]['label']] = $tmpArray;
    					$lineChartAcum[$tmpArray[0]['label']] = $tmpArray;
    					$arrayColunm[] = $tmpArray[0]['label'];
    					$data['lineChartAcum'] = true;
    				}
    				
    				//$this->PAR($lineChartAcum);
    				//die;
    				
    				$data['tabela_resumo'] = null;
    				
    				//$this->pieChart($dataPieChart);
    				//$this->columnChart($dataPieChart);
    				//$this->PAR($lineChartAcum);
    				$data['lineChartAcum'] ? $this->lineChartAcum($arrayColunm, $lineChartAcum, null, "Valores Acumulados") : NULL; 
    				
    				
    			}else{
    				
    				// consultar por programa
    				$data['programa'] = true;
    				
    				$tmpArray = $this->contratosdao->get_valor_contratado_by_coordenacao_setorial_or_by_id_programa($id_setorial, $id_programa);
    				$data['valor_contrato'] =  $tmpArray[0]['valor_contrato'];
    				 
    				$tmpArray = $this->contratosdao->get_valor_medido_acumulado_by_coordenacao_setorial_or_by_id_programa($id_setorial, $id_programa);
    				$data['valor_medido_acumulado_pi_r'] =  $tmpArray[0]['valor_medido_acumulado_pi_r'];
    				
    				$tmpArray = $this->contratosdao->get_valor_medido_mes_corrente_by_programa($id_programa);
    				$data['valor_medido_pi'] =  $tmpArray[0]['valor_medido_pi'];
    				
    				$tmpArray = $this->contratosdao->get_valor_saldo_empenho_by_programa($id_programa);
    				$data['valor_saldo_empenho'] =   isset($tmpArray[0]) ? $tmpArray[0]['valor_saldo_empenho'] : 0 ;
    				$data['valor_empenhado'] =   isset($tmpArray[0]) ? $tmpArray[0]['valor_empenhado'] : 0 ;
    				
    				
    				// TABELA RESUMO
    				 
    				$data['tabela_resumo'] = $this->contratosdao->get_valor_contratado_by_setorial_programa_or_by_id_contrato($id_setorial, $id_programa);
    				
    				$indTabelaResumo = 0;
    				foreach($data['tabela_resumo'] as $item){
    					
    					$tmpArray = $this->contratosdao->get_contratos_by_id($item['id']);
    					$data['tabela_resumo'][$indTabelaResumo]['contrato'] = isset($tmpArray[0]) ? $tmpArray[0] : null ;
    					
    					//$this->PAR($data['tabela_resumo']);
    					
    					$tmpArray = $this->contratosdao->get_valor_medido_acumulado_by_setorial_programa_or_by_id_contrato($id_setorial, $id_programa, $item['id']);
    					$data['tabela_resumo'][$indTabelaResumo]['valor_medido_acumulado_pi_r'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_medido_acumulado_pi_r'] : 0 ;
    					
    					$tmpArray = $this->contratosdao->get_valor_medido_mes_corrente_by_contrato($item['titulo']);
    					//$this->PAR($tmpArray);
    					$data['tabela_resumo'][$indTabelaResumo]['valor_medido_mes_corrente'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_medido_pi'] : '0' ;
    					
    					
    					// METHODOS ADICIONAIS
    					$tmpArray = $this->contratosdao->get_valor_saldo_empenho_by_contrato($item['titulo']);
	    				$data['tabela_resumo'][$indTabelaResumo]['valor_saldo_empenho'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_saldo_empenho'] : '0' ;
	    				$data['tabela_resumo'][$indTabelaResumo]['valor_empenhado'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_empenhado'] : '0' ;
	    				
	    				// N DE CONTRATOS
	    				$data['tabela_resumo'][$indTabelaResumo]['n_contratos'] = 1;
	    				
	    				$tmpArray = $this->contratosdao->get_last_year_medido_mes_corrente_by_contrato($item['titulo']);
	    				//echo "START<br>".$item['titulo']."<br>";
	    				//$this->PAR($tmpArray);
	    				//echo "END<br>";
	    				
	    				if(isset($tmpArray[0])){
	    					$data['medicoes_last_year'][$tmpArray[0]['titulo']] = $tmpArray;
	    					$arrayColunm[] = $tmpArray[0]['titulo'];
	    				}
	    				
    					$indTabelaResumo++;
    				}
    				//DIE;
    				//$this->PAR($data['tabela_resumo']);
    				$tamanho = sizeof($data['tabela_resumo']);
    				
    				if($tamanho > 1){
    					$data['pieChart'] = true;
    				}
    				
    				$dataPieChart =  $data['tabela_resumo'];
    				$this->pieChart($dataPieChart);
    				
    				$this->columnChart($dataPieChart);
    				$this->lineChart($arrayColunm, $data['medicoes_last_year'] );
    				
    			}
    			
    			
    			
    		}else{
    			// consultar por setorial
    			$data['setorial'] = true;
    			
    			$tmpArray = $this->contratosdao->get_valor_contratado_by_id_geral_setorial(1, $id_setorial);
    			$data['valor_contrato'] =  $tmpArray[0]['valor_contrato'];
    			
    			$tmpArray = $this->contratosdao->get_valor_medido_acumulado_by_id_geral_setorial( 1, $id_setorial);
    			$data['valor_medido_acumulado_pi_r'] =  $tmpArray[0]['valor_medido_acumulado_pi_r'];
    			
    			$tmpArray = $this->contratosdao->get_valor_saldo_empenho_by_setorial($id_setorial);
    			$data['valor_saldo_empenho'] =   isset($tmpArray[0]) ? $tmpArray[0]['valor_saldo_empenho'] : 0 ;
    			$data['valor_empenhado'] =   isset($tmpArray[0]) ? $tmpArray[0]['valor_empenhado'] : 0 ;
    			
    			$tmpArray = $this->contratosdao->get_valor_medido_mes_corrente_by_setorial($id_setorial);
    			$data['valor_medido_pi'] =  $tmpArray[0]['valor_medido_pi'];
    			
    			
    			// TABELA RESUMO
    			$data['tabela_resumo'] = $this->contratosdao->get_valor_contratado_by_coordenacao_setorial_or_by_id_programa($id_setorial);
    			
    			$indTabelaResumo = 0;
    			foreach($data['tabela_resumo'] as $item){
    				
    				$tmpArray = $this->contratosdao->get_valor_medido_acumulado_by_coordenacao_setorial_or_by_id_programa($id_setorial, $item['id']);
    				$data['tabela_resumo'][$indTabelaResumo]['valor_medido_acumulado_pi_r'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_medido_acumulado_pi_r'] : 0 ;
    				
    				// get by programa
    				$tmpArray = $this->contratosdao->get_n_contratos_by_programa($item['id']);
    				$data['tabela_resumo'][$indTabelaResumo]['n_contratos'] = isset($tmpArray[0]) ? $tmpArray[0]['n_contratos'] : 0 ;
    				// get by programa
    				$tmpArray = $this->contratosdao->get_valor_medido_mes_corrente_by_programa($item['id']);
    				
    				//$this->PAR($tmpArray);
    				$data['tabela_resumo'][$indTabelaResumo]['valor_medido_mes_corrente'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_medido_pi'] : 0 ;
    				
    				
    				// METHODOS ADICIONAIS
    				$tmpArray = $this->contratosdao->get_valor_saldo_empenho_by_programa($item['id']);
    				$data['tabela_resumo'][$indTabelaResumo]['valor_saldo_empenho'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_saldo_empenho'] : 0 ;
    				$data['tabela_resumo'][$indTabelaResumo]['valor_empenhado'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_empenhado'] : 0 ;
    				
    				$tmpArray = $this->contratosdao->get_last_year_medido_mes_corrente_by_programa($item['id']);
    				
    				if(isset($tmpArray[0])){
	    				$data['medicoes_last_year'][$tmpArray[0]['titulo']] = $tmpArray;
	    				$arrayColunm[] = $tmpArray[0]['titulo'];
	    			}
    				
    				
    				$indTabelaResumo++;
    			}
    			
    			$tamanho = sizeof($data['tabela_resumo']);
    			if($tamanho > 1){
    				$data['pieChart'] = true;
    			}
    			
    			$dataPieChart =  $data['tabela_resumo'];
    			
    			$this->pieChart($dataPieChart);
    			$this->columnChart($dataPieChart);
    			$this->lineChart($arrayColunm, $data['medicoes_last_year'] );
    			
    		}
    		
    	// somente especificacao por coordenacao geral(so existe uma cadastrada)	
    	}else{
    		
    		$data['geral'] = true; 
    		$tmpArray = $this->contratosdao->get_valor_contratado();
    		$data['valor_contrato'] =  $tmpArray[0]['valor_contrato'];
    		
    		$tmpArray = $this->contratosdao->get_valor_medido_acumulado_pi_r();
    		$data['valor_medido_acumulado_pi_r'] =  $tmpArray[0]['valor_medido_acumulado_pi_r'];
    		
    		// USANDO MES CORRENTE
    		$tmpArray = $this->contratosdao->get_valor_medido_mes_corrente();
    		$data['valor_medido_pi'] =  $tmpArray[0]['valor_medido_pi'];
    		
    		$tmpArray = $this->contratosdao->get_valor_saldo_empenho();
    		$data['valor_saldo_empenho'] =  $tmpArray[0]['valor_saldo_empenho'];
    		$data['valor_empenhado'] =  $tmpArray[0]['valor_empenhado'];
    		
    		$data['tabela_resumo'] = $this->contratosdao->get_valor_contratado_by_id_geral_setorial();
    		
    		$data['medicoes_last_year'] = array();
    		
    		$indTabelaResumo = 0;
    		foreach($data['tabela_resumo'] as $item){
    			
    			$tmpArray = $this->contratosdao->get_valor_medido_acumulado_by_id_geral_setorial( 1, $item['id']);
    			$data['tabela_resumo'][$indTabelaResumo]['valor_medido_acumulado_pi_r'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_medido_acumulado_pi_r'] : 0 ;
    			
    			$tmpArray = $this->contratosdao->get_n_contratos_by_setorial($item['id']);
    			$data['tabela_resumo'][$indTabelaResumo]['n_contratos'] = isset($tmpArray[0]) ? $tmpArray[0]['n_contratos'] : 0 ;
    			
    			$tmpArray = $this->contratosdao->get_valor_medido_mes_corrente_by_setorial($item['id']);
    			$data['tabela_resumo'][$indTabelaResumo]['valor_medido_mes_corrente'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_medido_pi'] : 0 ;
    			
    			$tmpArray = $this->contratosdao->get_valor_saldo_empenho_by_setorial($item['id']);
    			$data['tabela_resumo'][$indTabelaResumo]['valor_saldo_empenho'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_saldo_empenho'] : 0 ;
    			$data['tabela_resumo'][$indTabelaResumo]['valor_empenhado'] = isset($tmpArray[0]) ? $tmpArray[0]['valor_empenhado'] : 0 ;
    			
    			$tmpArray = $this->contratosdao->get_last_year_medido_mes_corrente_by_setorial($item['id']);
    			if(isset($tmpArray[0])){
	    			$data['medicoes_last_year'][$tmpArray[0]['titulo']] = $tmpArray;
					$arrayColunm[] = $tmpArray[0]['titulo'];
	    		}
    			$indTabelaResumo++;
    		}
    		
    		$tamanho = sizeof($data['tabela_resumo']);
    		if($tamanho > 1){
    			$data['pieChart'] = true;
    		}
    		
    		$dataPieChart =  $data['tabela_resumo'];
    		
    		$this->pieChart($dataPieChart);
    		$this->columnChart($dataPieChart);
    		$this->lineChart($arrayColunm, $data['medicoes_last_year'] );
    		
    	}
    	
    		 
    	$data['main_content'] = 'admin/contratos/gerencial';
    	$this->load->view('includes/template', $data);
    }
    
    function lineChartAcum($colunmChart, $arrayData, $lineChartName = null, $title = null ){
    	 
    	if(!$lineChartName){
    		$lineChartName = 'Cronograma';
    	}
    	 
    	$this->load->library('gcharts');
    	$this->gcharts->load('LineChart');
    	 
    	//$meses = array('JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ');
    	 
    	$dataBase = date("Y-m-01",  strtotime(date("Y-m-01")."-1 year")) ;
    	$dataArray[] = $dataBase;
    
    	for($i = 1; $i<13; $i++){
    		$dataArray[] = date("Y-m-01",  strtotime($dataBase."+".$i." Month"));
    	}
    
    	$this->gcharts->DataTable($lineChartName)->addColumn('string', 'Data', 'data');
    	$arrayDataColumn = array('Data');
    	 
    	foreach($colunmChart as $row){
    		$this->gcharts->DataTable($lineChartName)->addColumn('number', $row, $row);
    		$arrayDataColumn = array_merge($arrayDataColumn, array($row));
    	}
    
    	$tmpArray = array();
    	/*
    	foreach($colunmChart as $row){
    		$tempValue[$row] = 0;
    	}
    	*/
    	$tempValue = 0;
    	
    	foreach($dataArray as $timeStep){
    		
    		foreach($colunmChart as $row){	
    			foreach($arrayData[$row] as $item){
    				//echo $item['titulo'];
    				//echo '<br>';
    				//echo $item['valor_medido'];
    				//echo '<br>';
    				$item['data'] = date("Y-m-d", strtotime($item['data']));
    				//echo '<br>';
    				//echo $timeStep;
    				//echo '<br>';
	    			if($item['data'] == $timeStep ){
    					//echo 'Aqui';
    					$tempValue = $item['valor'];
    					//echo '<br>';
    					//echo $item['titulo'];
    					//echo '<br>';
    					//echo $item['data'];
    					//echo '<br>';
    					break;
	    			}else{
    					$tempValue = 0;
    				}
    			}	    			
    			$tmpArray = array_merge($tmpArray, array($tempValue));
    		}
    		$year =  date("Y", strtotime($timeStep));
    		$month =  date("m", strtotime($timeStep));
    		$resultArray[] = array_merge(array($month.'/'.$year), $tmpArray);
    		$tmpArray = array();
    		
    	}
    	
    	$tmpArray = array();
    	foreach($colunmChart as $row){
    		$tempValue = 0;
    		
    		foreach($arrayData[$row] as $item){
    			$item['data'] = date("Y-m-d", strtotime($item['data']));
    			
    			if(strtotime($item['data']) < strtotime($dataBase)){
    				$tempValue += $item['valor'];
    			}
    			
    		}
    		$tmpArray = array_merge($tmpArray, array($tempValue));
    	}
    	
    	$tmpArray[0] = array_merge(array("Meses Anteriores"), $tmpArray);
    	unset($tmpArray[1]);
    	$tmpArray = array_merge($tmpArray, $resultArray);    	
    	$resultArray = $tmpArray;
    	//$this->PAR($resultArray);
    	//$this->PAR($arrayData);
    	//DIE;
    	
    	for($i = 1; $i <= sizeof($colunmChart); $i++){
    		$indResult = 0;
    		$first = true;
	    	foreach($resultArray as $rom){
	    		if($first){
	    			$tmp = array($rom[$i]);
	    			$first = false;
	    		}else{
	    			$tmp = array_merge($tmp, array($rom[$i]) );
	    			$resultArray[$indResult][$i] =  array_sum($tmp);
	    			
	    		}
	    		$indResult++;
	    	}
    	}
    	foreach($resultArray as $row){
    		$this->gcharts->DataTable($lineChartName)->addRow($row);
    	}
    	
    	//$this->PAR($resultArray);
    	//die;
    
    	$legend = new legend(array(
    			'position' => 'bottom',
    			'alignment' => 'start'
    	));
    
    	 
    	$config = array(
    			'title' => $title,
    			'legend' => $legend,
    			'pointSize' => 4,
    			'lineWidth' => 2,
    			'height' => 300,
    			 
    	);
    	 
    	$this->gcharts->LineChart($lineChartName)->setConfig($config);
    	 
    }
    
    
    function lineChart($colunmChart, $arrayData, $lineChartName = null ){
    	
    	if(!$lineChartName){
    		$lineChartName = 'Cronograma';
    	}
    	
    	//$this->PAR($arrayData);
    	
    	$this->load->library('gcharts');
    	$this->gcharts->load('LineChart');
    	
    	//$meses = array('JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ');
    	
    	$dataBase = date("Y-m-01",  strtotime(date("Y-m-01")."-1 year")) ;
    	$dataArray[] = $dataBase;
    	 
    	for($i = 1; $i<13; $i++){
    		$dataArray[] = date("Y-m-01",  strtotime($dataBase."+".$i." Month"));
    	}
    	 
    	$this->gcharts->DataTable($lineChartName)->addColumn('string', 'Data', 'data');
    	$arrayDataColumn = array('Data');
    	
    	foreach($colunmChart as $row){
    		$this->gcharts->DataTable($lineChartName)->addColumn('number', $row, $row);
    		$arrayDataColumn = array_merge($arrayDataColumn, array($row));
    	}
    	 
    	$tmpArray = array();
    	foreach($dataArray as $timeStep){
    		 
    		foreach($colunmChart as $row){
    			 
    			foreach($arrayData[$row] as $item){
    				//echo $item['titulo'];
    				//echo '<br>';
    				//echo $item['valor_medido'];
    				//echo '<br>';
    				$item['data'] = date("Y-m-d", strtotime($item['data']));
    				//echo '<br>';
    				//echo $timeStep;
    				//echo '<br>';
    				if($item['data'] == $timeStep ){
    					//echo 'Aqui';
    					$tempValue = $item['valor'];
    					//echo '<br>';
    					//echo $item['titulo'];
    					//echo '<br>';
    					//echo $item['data'];
    					//echo '<br>';
    					break;
    				}else{
    					$tempValue = 0;
    				}
    			}
    			$tmpArray = array_merge($tmpArray, array($tempValue));
    		}
    		
    		$year =  date("Y", strtotime($timeStep));
    		$month =  date("m", strtotime($timeStep));
    		
    		$resultArray = array_merge(array($month.'/'.$year), $tmpArray);
    		$this->gcharts->DataTable($lineChartName)->addRow($resultArray);
    		//$this->PAR($resultArray);
    		$tmpArray = array();
    	}
    	//$this->PAR($resultArray);
    	//die;
    	 
    	$legend = new legend(array(
    			'position' => 'bottom',
    			'alignment' => 'start'
    	));
    	 
    	
    	$config = array(
    			'title' => 'Valor Medido Processado',    			
    			'legend' => $legend,
    			'pointSize' => 4,
    			'lineWidth' => 2,
    			'height' => 300,
    	
    	);
    	
    	$this->gcharts->LineChart($lineChartName)->setConfig($config);
    	
    }
    
    
    function pieChart($dataPieChart){
    	
    	$this->load->library('gcharts');
    	$this->gcharts->load('PieChart');

    	$this->gcharts->DataTable('ValorContratado')
	    	->addColumn('string', 'Valor', 'valor')
	    	->addColumn('number', 'Quantidade', 'quantidade');
    	
    	$this->gcharts->DataTable('ValorMedidoAcumulado')
	    	->addColumn('string', 'Valor', 'valor')
	    	->addColumn('number', 'Quantidade', 'quantidade');
    	
    	
    	$this->gcharts->DataTable('ValorMedidoCorrente')
	    	->addColumn('string', 'Valor', 'valor')
	    	->addColumn('string', 'Quantidade', 'quantidade');
	    
    	$this->gcharts->DataTable('ValorSaldoEmpenho')
	    	->addColumn('string', 'Valor', 'valor')
	    	->addColumn('string', 'Quantidade', 'quantidade');
    	
    	//$this->PAR($dataPieChart);
    	//die;
    	
		foreach($dataPieChart as $row){
			$this->gcharts->DataTable('ValorContratado')->addRow(array($row['titulo'], ROUND($row['valor_contrato'])));
			$this->gcharts->DataTable('ValorMedidoAcumulado')->addRow(array($row['titulo'],ROUND($row['valor_medido_acumulado_pi_r'])));
			$this->gcharts->DataTable('ValorSaldoEmpenho')->addRow(array($row['titulo'],ROUND($row['valor_saldo_empenho'])));
			$this->gcharts->DataTable('ValorMedidoCorrente')->addRow(array($row['titulo'],ROUND($row['valor_medido_mes_corrente'])));
		}
    	
		$titleStyle = $this->gcharts->textStyle()
                                    ->fontSize(11);

        
    	$legend = new legend(array(
    			'position' => 'bottom',
    			'alignment' => 'end',
    	));
    	 
    	$config = array(
    			'title' => 'Valor Contratado(PI+R)',
    			'legend' => $legend,
    			'titleTextStyle' => $titleStyle,
    	);
    	
    	$this->gcharts->PieChart('ValorContratado')->setConfig($config);
    	
    	$legend2 = new legend(array(
    			'position' => 'none'
    	));
    	
    	$config = array(
    			'title' => 'Valor Medido Acumulado',
    			'legend' => $legend2,
    			'titleTextStyle' => $titleStyle,
    	);
    	
    	$this->gcharts->PieChart('ValorMedidoAcumulado')->setConfig($config);
    	$config['title'] = 'Saldo de Empenho';
    	$this->gcharts->PieChart('ValorSaldoEmpenho')->setConfig($config);
    	$config['title'] = 'Valor Medido Mês Corrente';
    	$this->gcharts->PieChart('ValorMedidoCorrente')->setConfig($config);
    }
    
    function columnChart($dataPieChart){
    	
    	$this->load->library('gcharts');
    	$this->gcharts->load('ColumnChart');
    	
    	$legend = new legend(array(
            'position' => 'bottom',
            'alignment' => 'start'
        ));
    	 
    	$config = array(
    			'title' => 'Valor Medido Mês Corrente',
    			'legend' => $legend,
    			'height' => 250,
    	);
    	
    	unset($dataPieChart0);
    	
    	$this->gcharts->DataTable('Inventory')->addColumn('string', 'Valor', 'valor');
    	$rowData[] = 'Valor';
    	foreach($dataPieChart as $row){
    		$this->gcharts->DataTable('Inventory')->addColumn('number', $row['titulo'], $row['titulo']);
    		$rowData[] = $row['valor_medido_mes_corrente'];
    		
    	}
    	
    	$this->gcharts->DataTable('Inventory')->addRow($rowData);
    
    	
    	$this->gcharts->ColumnChart('Inventory')->setConfig($config);
    }

    public function get_contrato_all_events(){
    
    	header('Content-type: application/json');
    
    	$cont = new contratosdao();
    	$data_contratos =  $cont->get_contratos();
    
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
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
    					"title" => 'Contrato: ' .$row['contrato'] . ' (Fim)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_termino'] ) . '000',
    					"end" 	=> strtotime($row['data_termino'] ) . '000');
    		}
    
    	}
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    public  function teste()
    {
    	$this->load->model('contratosdao');
    	$contrato = new contratosdao();
    	$contrato->teste_acessoSIAC();
    	
    }
    
    
    public  function get_siac_filter_by()
    {
    	$this->load->model('contratosdao');
    	$contrato = new contratosdao();
    	$dataFilter = array('ds_tip_intervencao' => 'EVTE-ESTUDOS DE VIABILIDADE TEC. E ECON.' );
    	
    	$contrato->get_contratos_from_SIAC($dataFilter);
    	
    }
    
    public  function get_siac_by_nm_contrato()
    {
    	$this->load->model('contratosdao');
    	$contrato = new contratosdao();
    	$nmContrato = "940";
    	
    	$contrato->get_contratos_from_SIAC_by_nm_contrato($nmContrato);
    	
    }
    
}




