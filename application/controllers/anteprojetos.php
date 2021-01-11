<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class anteprojetos extends App_controller {

	const VIEW_FOLDER = 'admin/anteprojetos';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anteprojetosdao');
        $this->load->library('gcharts');
        $this->load->library('googlemaps');
        
    }
    	
    public function index()
    {

    	//echo htmlentities($text);
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 30;

        $config['base_url'] = base_url().'admin/anteprojetos';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<nav class="navbar navbar-default navbar-fixed-bottom"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav.';
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';

        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        
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
            $data['count_products']= $this->anteprojetosdao->count_anteprojetos($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['anteprojetos_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->anteprojetosdao->count_anteprojetos();
            $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        $data['map'] = $this->get_location_list($data['anteprojetos']);
        
        
        
        /*
         
        $this->PAR($data['map']);
        die;
          
         
        $this->gcharts->load('GeoChart');
        
        $dataTable = $this->gcharts->DataTable('Debt');
        
        $dataTable->addColumn('string', 'Estado', 'estado');
        $dataTable->addColumn('number', 'Operações', 'operacoes');
         
         
        $dataTable->addRow(array('AM', '1'));
        $dataTable->addRow(array('RS', '1'));
        $dataTable->addRow(array('MG', '1'));
        $dataTable->addRow(array('DF', '1'));
        $dataTable->addRow(array('MS', '1'));
         
        $colorAxis = $this->gcharts->colorAxis()
        ->minValue(0)
        ->maxValue(11)
        ->values(array(0, 4, 40))
        ->colors(array('#F0B518', '#F0B518', '#F0B518'));
        
        $backgroundColor = $this->gcharts->backgroundColor()
        ->fill('white')
        ->stroke('white')
        ->strokeWidth(0);
        
         
        $sizeAxis = new sizeAxis();
         $sizeAxis->minSize(15)->minValue(0)->maxSize(40)->maxValue(11);
         
        $config = array(
        		'colorAxis' => $colorAxis,
        		'region' => 'BR',
        		'datalessRegionColor' => '#C4C4C4',
        		'displayMode' => 'markers',
        		'enableRegionInteractivity' => TRUE,
        		'keepAspectRatio' => TRUE,
        		'sizeAxis' => $sizeAxis,
        		'markerOpacity' => 0.8,
        		'resolution' => 'provinces',
        		'backgroundColor' => $backgroundColor,
        		'magnifyingGlass' => new magnifyingGlass(3)
        );
         
        $this->gcharts->GeoChart('Debt')->setConfig($config);
        */
        
        //load the view
        $data['main_content'] = 'admin/anteprojetos/list';
        $this->load->view('includes/template', $data);  

    }//index    

    
    public function lista_anteprojetos(){
    	 
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	 //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 30;

        $config['base_url'] = base_url().'anteprojetos/lista_anteprojetos';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<nav class="navbar navbar-default navbar-fixed-bottom"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav.';
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';

        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        
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
            $data['count_products']= $this->anteprojetosdao->count_anteprojetos($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['anteprojetos_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->anteprojetosdao->count_anteprojetos();
            $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config); 

        $data['map'] = $this->get_location_list($data['anteprojetos'], 'anteprojetos/visualizar/');

        //load the view
        $data['main_content'] = 'portal/anteprojetos/list';
        $this->load->view('includes/template', $data); 
    
    }
    
    
	public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$id_empreendimento = $this->uri->segment(4);
    	$data['id_empreendimento'] = $id_empreendimento;
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	//$this->form_validation->set_rules('id_empreendimento', 'id_empreendimento', 'required');
        	$this->form_validation->set_rules('prioridade', 'prioridade', 'required');
        	$this->form_validation->set_rules('titulo', 'Título', 'required');
        	$this->form_validation->set_rules('rodovia', 'rodovia', 'required'); 
        	$this->form_validation->set_rules('uf', 'uf', 'required'); 
        	$this->form_validation->set_rules('km_inicial', 'km_inicial', 'required'); 
        	$this->form_validation->set_rules('km_final', 'km_final', 'required'); 
        	$this->form_validation->set_rules('extensao', 'extensao', 'required'); 
        	$this->form_validation->set_rules('lotes', 'lotes', 'required'); 
        	$this->form_validation->set_rules('subtrecho', 'subtrecho', 'required'); 
        	$this->form_validation->set_rules('intervencao', 'intervencao', 'required');
        	$this->form_validation->set_rules('status', 'Status', 'required');
        	$this->form_validation->set_rules('data_ini_anteprojeto', 'data_ini_anteprojeto', '');
        	$this->form_validation->set_rules('data_fim_anteprojeto', 'data_fim_anteprojeto', '');
        	$this->form_validation->set_rules('fase1', 'Fase1', 'required');
        	$this->form_validation->set_rules('progresso1', 'Progresso1', 'required|numeric');
        	$this->form_validation->set_rules('data_ini_fase1', 'data_ini_fase1', '');
        	$this->form_validation->set_rules('data_fim_fase1', 'data_fim_fase1', '');
        	$this->form_validation->set_rules('fase2', 'Fase2', 'required');
        	$this->form_validation->set_rules('progresso2', 'Progresso2', 'required|numeric');
        	$this->form_validation->set_rules('data_ini_fase2', 'data_ini_fase2', '');
        	$this->form_validation->set_rules('data_fim_fase2', 'data_fim_fase2', '');
        	$this->form_validation->set_rules('fase3', 'Fase3', 'required');
        	$this->form_validation->set_rules('progresso3', 'Progresso3', 'required|numeric');
        	$this->form_validation->set_rules('data_ini_fase3', 'data_ini_fase3', '');
        	$this->form_validation->set_rules('data_fim_fase3', 'data_fim_fase3', '');
        	$this->form_validation->set_rules('concepcao', 'concepcao', ''); 
        	$this->form_validation->set_rules('desenvolvimento', 'desenvolvimento', ''); 
        	
        	$this->form_validation->set_rules('empresa_responsavel', 'Enpresa Responsavel', '');
        	
        	$this->form_validation->set_rules('lat', 'Latitude', '');
        	$this->form_validation->set_rules('lon', 'Longiude', '');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {	
                $data_to_store = array(
                		
                		'prioridade' => $this->input->post('prioridade'),
                		'titulo' => $this->input->post('titulo'),
                		'rodovia' => $this->input->post('rodovia'),
                		'uf' => $this->input->post('uf'),
                		'km_inicial' => $this->input->post('km_inicial'),
                		'km_final' => $this->input->post('km_final'),
                		'extensao' => str_replace(',', '.', $this->input->post('extensao')),
                		'lotes' => $this->input->post('lotes'),
                		'subtrecho' => $this->input->post('subtrecho'),
                		'intervencao' => $this->input->post('intervencao'),
                		
                		'status' => $this->input->post('status'),  
                		'data_ini_anteprojeto' => $this->input->post('data_ini_anteprojeto') ? $this->input->post('data_ini_anteprojeto') : NULL,
                		'data_fim_anteprojeto' => $this->input->post('data_fim_anteprojeto') ? $this->input->post('data_fim_anteprojeto') : NULL,             		

                		'fase1' => $this->input->post('fase1'),
                		'progresso1' => $this->input->post('progresso1'),
                		'data_ini_fase1' => $this->input->post('data_ini_fase1') ? $this->input->post('data_ini_fase1') : NULL,
                		'data_fim_fase1' => $this->input->post('data_fim_fase1') ? $this->input->post('data_fim_fase1') : NULL,
                		
                		'fase2' => $this->input->post('fase2'),
                		'progresso2' => $this->input->post('progresso2'),
                		'data_ini_fase2' => $this->input->post('data_ini_fase2') ? $this->input->post('data_ini_fase2') : NULL,
                		'data_fim_fase2' => $this->input->post('data_fim_fase2') ? $this->input->post('data_fim_fase2') : NULL,
                		
                		'fase3' => $this->input->post('fase3'),
                		'progresso3' => $this->input->post('progresso3'),
                		'data_ini_fase3' => $this->input->post('data_ini_fase3') ? $this->input->post('data_ini_fase3') : NULL,
                		'data_fim_fase3' => $this->input->post('data_fim_fase3') ? $this->input->post('data_fim_fase3') : NULL,
                		
                		'concepcao' => $this->input->post('concepcao'),
                		'desenvolvimento' => $this->input->post('desenvolvimento'),
                		'empresa_responsavel' => $this->input->post('empresa_responsavel'),
                		'lat' => $this->input->post('lat'),
                		'lon' => $this->input->post('lon'),
                		'descricao' => $this->input->post('descricao'),
                		'observacoes' => $this->input->post('observacoes')
                );
                //if the insert has returned true then we show the flash message
                $id_anteprojeto = $this->anteprojetosdao->store_anteprojetos($data_to_store);
                if($id_anteprojeto){
                    $data['flash_message'] = TRUE; 
                    if(!file_exists(ANTEPROJETOS_FOLDER . $id_anteprojeto)){
                    	mkdir(ANTEPROJETOS_FOLDER . $id_anteprojeto, 0777, true);
                    }
                    if(!file_exists(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/acompanhamento_fisico')){
                    	mkdir(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/acompanhamento_fisico', 0777, true);
                    }
                    if(!file_exists(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/documentos')){
                    	mkdir(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/documentos', 0777, true);
                    }
                    if(!file_exists(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/localizacao')){
                    	mkdir(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/localizacao', 0777, true);
                    }
                    if(!file_exists(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/img')){
                    	mkdir(ANTEPROJETOS_FOLDER . $id_anteprojeto.'/img', 0777, true);
                    }
                    
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/anteprojetos/add';
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
        	//$this->form_validation->set_rules('id_empreendimento', 'id_empreendimento', 'required');
        	$this->form_validation->set_rules('prioridade', 'prioridade', 'required');
        	$this->form_validation->set_rules('titulo', 'Título', 'required');
        	$this->form_validation->set_rules('rodovia', 'rodovia', 'required');
        	$this->form_validation->set_rules('uf', 'uf', 'required');
        	$this->form_validation->set_rules('km_inicial', 'km_inicial', 'required');
        	$this->form_validation->set_rules('km_final', 'km_final', 'required');
        	$this->form_validation->set_rules('extensao', 'extensao', 'required');
        	$this->form_validation->set_rules('lotes', 'lotes', 'required');
        	$this->form_validation->set_rules('subtrecho', 'subtrecho', 'required');
        	$this->form_validation->set_rules('intervencao', 'intervencao', 'required');
        	$this->form_validation->set_rules('concepcao', 'concepcao', '');
        	$this->form_validation->set_rules('desenvolvimento', 'desenvolvimento', '');
        	$this->form_validation->set_rules('empresa_responsavel', 'Enpresa Responsavel', '');
        	
        	$this->form_validation->set_rules('status', 'Status', 'required');
        	$this->form_validation->set_rules('data_ini_anteprojeto', 'data_ini_anteprojeto', '');
        	$this->form_validation->set_rules('data_fim_anteprojeto', 'data_fim_anteprojeto', '');
        	
        	$this->form_validation->set_rules('fase1', 'Fase1', 'required');
        	$this->form_validation->set_rules('progresso1', 'Progresso1', 'required|numeric');
        	$this->form_validation->set_rules('data_ini_fase1', 'data_ini_fase1', '');
        	$this->form_validation->set_rules('data_fim_fase1', 'data_fim_fase1', '');
        	
        	$this->form_validation->set_rules('fase2', 'Fase2', 'required');
        	$this->form_validation->set_rules('progresso2', 'Progresso2', 'required|numeric');
        	$this->form_validation->set_rules('data_ini_fase2', 'data_ini_fase2', '');
        	$this->form_validation->set_rules('data_fim_fase2', 'data_fim_fase2', '');
        	
        	$this->form_validation->set_rules('fase3', 'Fase3', 'required');
        	$this->form_validation->set_rules('progresso3', 'Progresso3', 'required|numeric');
        	$this->form_validation->set_rules('data_ini_fase3', 'data_ini_fase3', '');
        	$this->form_validation->set_rules('data_fim_fase3', 'data_fim_fase3', '');
        	
        	$this->form_validation->set_rules('concepcao', 'concepcao', '');
        	$this->form_validation->set_rules('desenvolvimento', 'desenvolvimento', '');
        	$this->form_validation->set_rules('lat', 'Latitude', '');
        	$this->form_validation->set_rules('lon', 'Longiude', '');
        	$this->form_validation->set_rules('descricao', 'descricao', '');
        	$this->form_validation->set_rules('observacoes', 'observacoes', '');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                	
                	'prioridade' => $this->input->post('prioridade'),
                	'titulo' => $this->input->post('titulo'),
		        	'rodovia' => $this->input->post('rodovia'),
		        	'uf' => $this->input->post('uf'),
		        	'km_inicial' => $this->input->post('km_inicial'),
		        	'km_final' => $this->input->post('km_final'),
		        	'extensao' => str_replace(',', '.', $this->input->post('extensao')),
		        	'lotes' => $this->input->post('lotes'),
		        	'subtrecho' => $this->input->post('subtrecho'),
		        	'intervencao' => $this->input->post('intervencao'),
		        	'concepcao' => $this->input->post('concepcao'),
		        	'desenvolvimento' => $this->input->post('desenvolvimento'),
                	'empresa_responsavel' => $this->input->post('empresa_responsavel'),
                		
                	'status' => $this->input->post('status'),  
                	'data_ini_anteprojeto' => $this->input->post('data_ini_anteprojeto') ? $this->input->post('data_ini_anteprojeto') : NULL,
                	'data_fim_anteprojeto' => $this->input->post('data_fim_anteprojeto') ? $this->input->post('data_fim_anteprojeto') : NULL,             		

                	'fase1' => $this->input->post('fase1'),
                	'progresso1' => $this->input->post('progresso1'),
                	'data_ini_fase1' => $this->input->post('data_ini_fase1') ? $this->input->post('data_ini_fase1') : NULL,
                	'data_fim_fase1' => $this->input->post('data_fim_fase1') ? $this->input->post('data_fim_fase1') : NULL,
                		
                	'fase2' => $this->input->post('fase2'),
                	'progresso2' => $this->input->post('progresso2'),
                	'data_ini_fase2' => $this->input->post('data_ini_fase2') ? $this->input->post('data_ini_fase2') : NULL,
                	'data_fim_fase2' => $this->input->post('data_fim_fase2') ? $this->input->post('data_fim_fase2') : NULL,
                		
                	'fase3' => $this->input->post('fase3'),
                	'progresso3' => $this->input->post('progresso3'),
                	'data_ini_fase3' => $this->input->post('data_ini_fase3') ? $this->input->post('data_ini_fase3') : NULL,
                	'data_fim_fase3' => $this->input->post('data_fim_fase3') ? $this->input->post('data_fim_fase3') : NULL,
                	
                	'concepcao' => $this->input->post('concepcao'),
                	'desenvolvimento' => $this->input->post('desenvolvimento'),
                	'lat' => str_replace(",", ".", $this->input->post('lat')),
                	'lon' => str_replace(",", ".", $this->input->post('lon')),
                	'descricao' => $this->input->post('descricao'),
		        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->anteprojetosdao->update_anteprojetos($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/anteprojetos/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos_by_id($id);
        //load the view
        $data['main_content'] = 'admin/anteprojetos/edit';
        $this->load->view('includes/template', $data);            

    }//update    			
    	
    
    public function delete()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
        //product id 
        $id = $this->uri->segment(4);
        //$id_empreendimento = $this->uri->segment(5);
         
        $this->anteprojetosdao->delete_anteprojetos($id);
        // unlik(FILES);
        //redirect('admin/anteprojetos/lista_anteprojetos/'.$id_empreendimento);
        redirect('admin/anteprojetos');
    }//edit    			

    
    public function detalhes()
    {		
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$id = $this->uri->segment(4);
    	
    	//product data
    	$data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos_by_id($id);
    	
    	$data = array_merge($data, $this->foreingControllersDetalhes($id));
    	
    	// load map
    	$data['map'] = $this->get_location_list($data['anteprojetos'], 'admin/anteprojetos/detalhes/' ,$id);
    	
    	//load the view
    	$data['main_content'] = 'admin/anteprojetos/detalhes';
    	$this->load->view('includes/template', $data);
    
    }
    
    
    public function visualizar()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	//product id
    	$id = $this->uri->segment(3);    	
    	
    	$data['anteprojetos'] = $this->anteprojetosdao->get_anteprojetos_by_id($id);
    	
    	$data = array_merge($data, $this->foreingControllersDetalhes($id));
    	
    	//load map
    	$data['map'] = $this->get_location_list($data['anteprojetos'], 'anteprojetos/visualizar/' ,$id);
    	
    	//load the view
    	$data['main_content'] = 'portal/anteprojetos/detalhes';
    	$this->load->view('includes/template', $data);
    
    }
    
   
    function get_location_list($anteprojetosArray, $link_area = null, $kmz_id = false){
    	
    	$config['center'] = '-15.78, -53';
    	$config['zoom'] = '4';
    	$config['map_height'] = 537;
    	/*
    	 ESTQ-KML-BR423_PE(LT01)-V01.KMZ 
    	 
    	$config['kmlLayerURL'] = array('http://kml-samples.googlecode.com/svn/trunk/kml/Placemark/placemark.kml',
    								   'https://servicos.dnit.gov.br/sgplan/assets/anteprojetos/2/localizacao/2.kml');
    	$config['kmlLayerPreserveViewport'] = FALSE;
    	
    	$config['kmlLayerURL'] = 'www.google.com.br/maps/dir/Ribeir%C3%A3o+Cascalheira/Vila+Rica/@-12.4311298,-51.8825712,767090m/data=!3m1!1e3!4m13!4m12!1m5!1m1!1s0x93133b1a1676501d:0x3d98e5626a9d5e30!2m2!1d-51.8248805!2d-12.9371655!1m5!1m1!1s0x93197640598dceff:0x5328f495a40ed6b4!2m2!1d-51.1190487!2d-10.0140784';
    	*/
    	
    	if($kmz_id){
    		//$kmz_id = 2;
    		$config['kmlLayerURL'] = array(
    			'https://servicos.dnit.gov.br/sgplan/assets/anteprojetos/'.$kmz_id.'/localizacao/'.$kmz_id.'.kmz',
    			
    		);
    		//$this->PAR($config['kmlLayerURL']);
    	}
    	
    	//$this->PAR($config['kmlLayerURL']);
    	//DIE;
    	$this->googlemaps->initialize($config);
    	
    	
    	
    	$marker = array();
    	
    	
    	if($link_area == null){
    		$link = 'admin/anteprojetos/detalhes/';
    		
    	}else{
    		$link = $link_area;
    		
    	}
    	
    	foreach($anteprojetosArray as $item){
    		
    		if($item['lat'] AND $item['lon']){
    			$marker['position'] = $item['lat'].','. $item['lon'];
    			$marker['onclick'] = 'window.location.href = "'.base_url().$link.$item['id'].'";';
    			$marker['animation'] = 'DROP';
    			$marker['icon'] ='http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|87CE69|000000';
    			$marker['title'] = $item['titulo'];
    			$this->googlemaps->add_marker($marker);
    		}
    		
    	}
    	
    	return  $this->googlemaps->create_map();
    }
    
    
    public function edit_table_pendencias(){
    
    	header('Content-type: application/json');
    	//$teste = json_decode($data);
    	 
    	$id 	= $this->input->post('id');
    	$value = $this->input->post('value');
    	$name 	= $this->input->post('name');
    	 
    	$arrayRules = array(
    			'id' 				=> 'required|numeric',
    			'titulo' 			=> 	'required',
    			'responsabilidade'	=> 'required',
    			'id_pendencias' 	=> 'required'
    	);
    	 
    	$this->form_validation->set_rules('id', 'id', $arrayRules['id']);
    	$this->form_validation->set_rules('value', 'value', $arrayRules[$name]);
    	 
    	if ($this->form_validation->run()){
    
    		$data_to_store = array(
    				$name => $value
    		);
    		$this->load->model('anteprojetos_pendenciasdao');
    		
    		//if the insert has returned true then we show the flash message
    		if($this->anteprojetos_pendenciasdao->update_anteprojetos_pendencias($id, $data_to_store) == TRUE){
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
     
    
    public function foreingControllersDetalhes($id){
     
    	$this->load->model('anteprojetos_documentosdao');
    	$documentos = new anteprojetos_documentosdao();
    	$data['documentos'] = $documentos->get_anteprojetos_documentos_by_id_anteprojetos($id);
    	 
    	$data['tipo_documentos'] = $documentos->get_tipos_documentos_by_anteprojeto_id($id);
    	 
    	$this->load->model('anteprojetos_acompanhamento_fisicodao');
    	$acompanhamento= new anteprojetos_acompanhamento_fisicodao();
    	$data['acompanhamento_fisico'] = $acompanhamento->get_anteprojetos_acompanhamento_fisico_by_id_anteprojeto($id);
    	
    	$i = 0;
    	$this->load->model('lista_acompanhamento_fisicodao');
    	$list_acompanhamento = new lista_acompanhamento_fisicodao();
    	
    	foreach($data['acompanhamento_fisico'] as $item){
    		 
    		$arrayTipo = $list_acompanhamento->get_lista_acompanhamento_fisico_tipo_by_id_anteprojetos_acompanhamento_fisico($item['id']);
    		 
    		$data['acompanhamento_fisico'][$i]['list'] = $arrayTipo;
    		$i++;
    	}
    	
    	$this->load->model('anteprojetos_imagensdao');
    	$anteprojetos_imagens = new anteprojetos_imagensdao();
    	$data['anteprojetos_imagens'] = $anteprojetos_imagens->get_anteprojetos_imagens_by_id_anteprojetos($id );
    	
    	$this->load->model('anteprojetos_categorias_imagensdao');
    	$categorias_imagens = new anteprojetos_categorias_imagensdao();
    	$data['categorias_imagens'] = $categorias_imagens->get_anteprojetos_categorias_imagens(null, 'titulo' );
    	
    	$this->load->model('anteprojetos_localizacaodao');
    	$localizacao = new anteprojetos_localizacaodao();
    	$data['localizacao'] = $localizacao->get_anteprojetos_localizacao_by_id_anteprojeto($id);
    
    	$this->load->model('anteprojetos_pendenciasdao');
    	$pendencias = new anteprojetos_pendenciasdao();
    	$data['pendencias'] = $pendencias->get_anteprojetos_pendencias_by_id_anteprojetos($id);
    	
    	$this->load->model('pendenciasdao');
    	$listPendencias = new pendenciasdao();
    	$data['lista_pendencias'] = $listPendencias->get_pendencias(null, 'id');
    	
    	//$this->PAR($data['pendencias']);
    	//DIE;
    	
    	return $data;
    
    }
    
    
	public function add_img()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

         	$fileName = $_FILES["file"]["name"];
			$target_file = PORTALPATH . 'assets/upload/' . basename($fileName);
			
	                 
	        $uploadOk = 1;
	        $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
                	
            // Check if $uploadOk is set to 0 by an error
                	
            if ($uploadOk == 0 or $fileName == '') {
                $data['flash_message'] = FALSE;
            }
            else if( $fileType == 'jpg' or $fileType == 'jpeg' or $fileType == 'JPEG' or $fileType == 'JPG'){
            	
            	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            		 
            		$titulo = 'cronograma.jpg';
            	
            		$file_out = ANTEPROJETOS_FOLDER .$titulo;
            	
            		if(file_exists($file_out)){
            			unlink($file_out);
            		}
            	
            		copy ( $target_file , $file_out);
            		unlink($target_file);
            		$data['flash_message'] = TRUE;
            		 
            	}
            			
            }else {
                
            	$data['flash_message'] = FALSE;

            }

        }
        
        
        
        //load the view
        $data['main_content'] = 'admin/anteprojetos/add_img';
        $this->load->view('includes/template', $data);  
    }
    
    
    public function get_anteprojetos_events(){
    	header('Content-type: application/json');
    	
    	$data_anteprojetos =  $this->anteprojetosdao->get_anteprojetos();   
    	
    	$arrayClass = array(	'event-success',
								'event-important',
								'event-warning',
								'event-info',
								'event-inverse',
								'event-special',
    							'' 
    	);
    	    	
    	$out = array();
    	foreach($data_anteprojetos as $row){
    		
    		$class = $arrayClass[rand(0, 6)];
    		
    		if($row['data_ini_anteprojeto']){
    			
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' (Início)' ,
    					"url" 	=> base_url().'admin/anteprojetos/detalhes/'.$row['id'],
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_anteprojeto'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_anteprojeto'] ) . '000');
    			
    		}
    		
    		if($row['data_fim_anteprojeto']){
    		
	    		$out[] = array(
	    				"id" 	=> $row['id'],
	    				"title" => $row['titulo'] . ' (Fim)',
	    				"url" 	=> base_url().'admin/anteprojetos/detalhes/'.$row['id'],
	    				"class" => $class ,
	    				"start" => strtotime($row['data_fim_anteprojeto'] ) . '000',
	    				"end" 	=> strtotime($row['data_fim_anteprojeto'] ) . '000');
    		}
    		
    	}
    	
		//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
		exit;
    	
    }
    
    
    public function get_anteprojeto_event_by_id($id){
    	
    	header('Content-type: application/json');
    	 
    	$data_anteprojetos =  $this->anteprojetosdao->get_anteprojetos_by_id($id);
    	 
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
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
    					"title" => 'Fase 1 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase1'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase1'] ) . '000');
    		
    		}
    		
    		if($row['data_fim_fase1']){
    		
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => 'Fase 1 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase1'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase1'] ) . '000');
    		}
    		
    		if($row['data_ini_fase2']){
    		
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => 'Fase 2 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase2'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase2'] ) . '000');
    		
    		}
    		
    		if($row['data_fim_fase2']){
    		
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => 'Fase 2 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase2'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase2'] ) . '000');
    		}
    		
    		if($row['data_ini_fase3']){
    		
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => 'Fase3 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase3'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase3'] ) . '000');
    		
    		}
    		
    		if($row['data_fim_fase3']){
    		
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => 'Fase 3 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase3'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase3'] ) . '000');
    		}
    		
    		
    
    	}
    	 
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    	 
    }
    
    public function get_anteprojeto_all_events(){
    	 
    	header('Content-type: application/json');
    
    	$data_anteprojetos =  $this->anteprojetosdao->get_anteprojetos();
    
    	$arrayClass = array(	'event-success',
    			'event-important',
    			'event-warning',
    			'event-info',
    			'event-inverse',
    			'event-special',
    			''
    	);
    
    	$out = array();
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
    					"title" => $row['titulo'] . ' Fase 1 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase1'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase1'] ) . '000');
    
    		}
    
    		if($row['data_fim_fase1']){
    
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' Fase 1 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase1'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase1'] ) . '000');
    		}
    
    		if($row['data_ini_fase2']){
    
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' Fase 2 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase2'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase2'] ) . '000');
    
    		}
    
    		if($row['data_fim_fase2']){
    
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' Fase 2 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase2'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase2'] ) . '000');
    		}
    
    		if($row['data_ini_fase3']){
    
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' Fase3 (Início)' ,
    					"class" => $class ,
    					"start" => strtotime($row['data_ini_fase3'] ) . '000',
    					"end" 	=> strtotime($row['data_ini_fase3'] ) . '000');
    
    		}
    
    		if($row['data_fim_fase3']){
    
    			$out[] = array(
    					"id" 	=> $row['id'],
    					"title" => $row['titulo'] . ' Fase 3 (Fim)',
    					"class" => $class ,
    					"start" => strtotime($row['data_fim_fase3'] ) . '000',
    					"end" 	=> strtotime($row['data_fim_fase3'] ) . '000');
    		}
    
    
    
    	}
    
    	//$this->PAR($arr);
    	echo json_encode(array('success' => 1, 'result' => $out));
    	exit;
    
    }
    
    
}













