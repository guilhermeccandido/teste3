<?php
    			require_once(APPPATH . 'controllers/App_controller' . EXT);
    			class logs extends App_controller {
    			const VIEW_FOLDER = 'admin/logs';
    		public function __construct()
		    {
		        parent::__construct();
		        $this->load->model('logsdao');
		
		       
		    }
    	
    public function index()
    {

        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 30;

        $config['base_url'] = base_url().'admin/logs';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<nav class="navbar navbar-default navbar-fixed-bottom"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav.';
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';

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
            $data['count_products']= $this->logsdao->count_logs($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['logs'] = $this->logsdao->get_logs($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['logs'] = $this->logsdao->get_logs($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['logs'] = $this->logsdao->get_logs('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['logs'] = $this->logsdao->get_logs('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['log_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'ID_LOG';

            //fetch sql data into arrays
            $data['count_products']= $this->logsdao->count_logs();
            $data['logs'] = $this->logsdao->get_logs('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/logs/list';
        $this->load->view('includes/template', $data);  

    }//index    
    	
public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
        	$this->form_validation->set_rules('ID_TRECHO', 'ID_TRECHO', 'required'); 
        	$this->form_validation->set_rules('VELOCIDADE', 'VELOCIDADE', 'required'); 
        	$this->form_validation->set_rules('HODOMETRO_TRECHO', 'HODOMETRO_TRECHO', 'required'); 
        	$this->form_validation->set_rules('GPS_VELOCIDADE', 'GPS_VELOCIDADE', 'required'); 
        	$this->form_validation->set_rules('GPS_HODOMETRO', 'GPS_HODOMETRO', 'required'); 
        	$this->form_validation->set_rules('GPS_LATITUDE', 'GPS_LATITUDE', 'required'); 
        	$this->form_validation->set_rules('GPS_LONGITUDE', 'GPS_LONGITUDE', 'required'); 
        	$this->form_validation->set_rules('GPS_ALTITUDE', 'GPS_ALTITUDE', 'required'); 
        	$this->form_validation->set_rules('GPS_ERRO', 'GPS_ERRO', 'required'); 
        	$this->form_validation->set_rules('GPS_QTDE_SATELITES', 'GPS_QTDE_SATELITES', 'required'); 
        	$this->form_validation->set_rules('GPS_X', 'GPS_X', 'required'); 
        	$this->form_validation->set_rules('GPS_Y', 'GPS_Y', 'required'); 
        	$this->form_validation->set_rules('GPS_AZIMUTE', 'GPS_AZIMUTE', 'required'); 
        	$this->form_validation->set_rules('GPS_NMEA_GPRMC', 'GPS_NMEA_GPRMC', 'required'); 
        	$this->form_validation->set_rules('GPS_NMEA_GPGGA', 'GPS_NMEA_GPGGA', 'required'); 
        	$this->form_validation->set_rules('FRAME_CAMERA_1', 'FRAME_CAMERA_1', 'required'); 
        	$this->form_validation->set_rules('FRAME_CAMERA_2', 'FRAME_CAMERA_2', 'required'); 
        	$this->form_validation->set_rules('TEMPO_CAMERA_1', 'TEMPO_CAMERA_1', 'required'); 
        	$this->form_validation->set_rules('TEMPO_CAMERA_2', 'TEMPO_CAMERA_2', 'required'); 
        	$this->form_validation->set_rules('DATA_HORA', 'DATA_HORA', 'required'); 
        	$this->form_validation->set_rules('TEMPO_LOG', 'TEMPO_LOG', 'required'); 
        	$this->form_validation->set_rules('BAROMETRO_PRESSAO', 'BAROMETRO_PRESSAO', 'required'); 
        	$this->form_validation->set_rules('BAROMETRO_TEMPERATURA', 'BAROMETRO_TEMPERATURA', 'required'); 
        	$this->form_validation->set_rules('BAROMETRO_ALTITUDE', 'BAROMETRO_ALTITUDE', 'required'); 
        	$this->form_validation->set_rules('IRI_INTERNO', 'IRI_INTERNO', 'required'); 
        	$this->form_validation->set_rules('IRI_EXTERNO', 'IRI_EXTERNO', 'required'); 
        	$this->form_validation->set_rules('EXTENSAO_LOG', 'EXTENSAO_LOG', 'required'); 
        	$this->form_validation->set_rules('PERIMETRO_URBANO', 'PERIMETRO_URBANO', 'required'); 
        	$this->form_validation->set_rules('SINALIZACAO_VERT_DIREITA', 'SINALIZACAO_VERT_DIREITA', 'required'); 
        	$this->form_validation->set_rules('SINALIZACAO_VERT_ESQUERDA', 'SINALIZACAO_VERT_ESQUERDA', 'required'); 
        	$this->form_validation->set_rules('ACESSO_DIREITA', 'ACESSO_DIREITA', 'required'); 
        	$this->form_validation->set_rules('ACESSO_ESQUERDA', 'ACESSO_ESQUERDA', 'required'); 
        	$this->form_validation->set_rules('TIPO_REVESTIMENTO', 'TIPO_REVESTIMENTO', 'required'); 
        	$this->form_validation->set_rules('ID_LOG_ORIGINAL', 'ID_LOG_ORIGINAL', 'required'); 
        	$this->form_validation->set_rules('odometro', 'odometro', 'required'); 
        	$this->form_validation->set_rules('Flecha_Int', 'Flecha_Int', 'required'); 
        	$this->form_validation->set_rules('Flecha_Ext', 'Flecha_Ext', 'required'); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('ID_TRECHO' => $this->input->post('ID_TRECHO'),'VELOCIDADE' => $this->input->post('VELOCIDADE'),'HODOMETRO_TRECHO' => $this->input->post('HODOMETRO_TRECHO'),'GPS_VELOCIDADE' => $this->input->post('GPS_VELOCIDADE'),'GPS_HODOMETRO' => $this->input->post('GPS_HODOMETRO'),'GPS_LATITUDE' => $this->input->post('GPS_LATITUDE'),'GPS_LONGITUDE' => $this->input->post('GPS_LONGITUDE'),'GPS_ALTITUDE' => $this->input->post('GPS_ALTITUDE'),'GPS_ERRO' => $this->input->post('GPS_ERRO'),'GPS_QTDE_SATELITES' => $this->input->post('GPS_QTDE_SATELITES'),'GPS_X' => $this->input->post('GPS_X'),'GPS_Y' => $this->input->post('GPS_Y'),'GPS_AZIMUTE' => $this->input->post('GPS_AZIMUTE'),'GPS_NMEA_GPRMC' => $this->input->post('GPS_NMEA_GPRMC'),'GPS_NMEA_GPGGA' => $this->input->post('GPS_NMEA_GPGGA'),'FRAME_CAMERA_1' => $this->input->post('FRAME_CAMERA_1'),'FRAME_CAMERA_2' => $this->input->post('FRAME_CAMERA_2'),'TEMPO_CAMERA_1' => $this->input->post('TEMPO_CAMERA_1'),'TEMPO_CAMERA_2' => $this->input->post('TEMPO_CAMERA_2'),'DATA_HORA' => $this->input->post('DATA_HORA'),'TEMPO_LOG' => $this->input->post('TEMPO_LOG'),'BAROMETRO_PRESSAO' => $this->input->post('BAROMETRO_PRESSAO'),'BAROMETRO_TEMPERATURA' => $this->input->post('BAROMETRO_TEMPERATURA'),'BAROMETRO_ALTITUDE' => $this->input->post('BAROMETRO_ALTITUDE'),'IRI_INTERNO' => $this->input->post('IRI_INTERNO'),'IRI_EXTERNO' => $this->input->post('IRI_EXTERNO'),'EXTENSAO_LOG' => $this->input->post('EXTENSAO_LOG'),'PERIMETRO_URBANO' => $this->input->post('PERIMETRO_URBANO'),'SINALIZACAO_VERT_DIREITA' => $this->input->post('SINALIZACAO_VERT_DIREITA'),'SINALIZACAO_VERT_ESQUERDA' => $this->input->post('SINALIZACAO_VERT_ESQUERDA'),'ACESSO_DIREITA' => $this->input->post('ACESSO_DIREITA'),'ACESSO_ESQUERDA' => $this->input->post('ACESSO_ESQUERDA'),'TIPO_REVESTIMENTO' => $this->input->post('TIPO_REVESTIMENTO'),'ID_LOG_ORIGINAL' => $this->input->post('ID_LOG_ORIGINAL'),'odometro' => $this->input->post('odometro'),'Flecha_Int' => $this->input->post('Flecha_Int'),'Flecha_Ext' => $this->input->post('Flecha_Ext'),
                );
                //if the insert has returned true then we show the flash message
                if($this->logsdao->store_log($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/logs/add';
        $this->load->view('includes/template', $data);  
    }       
    			
    	
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
        	$this->form_validation->set_rules('ID_TRECHO', 'ID_TRECHO', 'required');
        	$this->form_validation->set_rules('VELOCIDADE', 'VELOCIDADE', 'required');
        	$this->form_validation->set_rules('HODOMETRO_TRECHO', 'HODOMETRO_TRECHO', 'required');
        	$this->form_validation->set_rules('GPS_VELOCIDADE', 'GPS_VELOCIDADE', 'required');
        	$this->form_validation->set_rules('GPS_HODOMETRO', 'GPS_HODOMETRO', 'required');
        	$this->form_validation->set_rules('GPS_LATITUDE', 'GPS_LATITUDE', 'required');
        	$this->form_validation->set_rules('GPS_LONGITUDE', 'GPS_LONGITUDE', 'required');
        	$this->form_validation->set_rules('GPS_ALTITUDE', 'GPS_ALTITUDE', 'required');
        	$this->form_validation->set_rules('GPS_ERRO', 'GPS_ERRO', 'required');
        	$this->form_validation->set_rules('GPS_QTDE_SATELITES', 'GPS_QTDE_SATELITES', 'required');
        	$this->form_validation->set_rules('GPS_X', 'GPS_X', 'required');
        	$this->form_validation->set_rules('GPS_Y', 'GPS_Y', 'required');
        	$this->form_validation->set_rules('GPS_AZIMUTE', 'GPS_AZIMUTE', 'required');
        	$this->form_validation->set_rules('GPS_NMEA_GPRMC', 'GPS_NMEA_GPRMC', 'required');
        	$this->form_validation->set_rules('GPS_NMEA_GPGGA', 'GPS_NMEA_GPGGA', 'required');
        	$this->form_validation->set_rules('FRAME_CAMERA_1', 'FRAME_CAMERA_1', 'required');
        	$this->form_validation->set_rules('FRAME_CAMERA_2', 'FRAME_CAMERA_2', 'required');
        	$this->form_validation->set_rules('TEMPO_CAMERA_1', 'TEMPO_CAMERA_1', 'required');
        	$this->form_validation->set_rules('TEMPO_CAMERA_2', 'TEMPO_CAMERA_2', 'required');
        	$this->form_validation->set_rules('DATA_HORA', 'DATA_HORA', 'required');
        	$this->form_validation->set_rules('TEMPO_LOG', 'TEMPO_LOG', 'required');
        	$this->form_validation->set_rules('BAROMETRO_PRESSAO', 'BAROMETRO_PRESSAO', 'required');
        	$this->form_validation->set_rules('BAROMETRO_TEMPERATURA', 'BAROMETRO_TEMPERATURA', 'required');
        	$this->form_validation->set_rules('BAROMETRO_ALTITUDE', 'BAROMETRO_ALTITUDE', 'required');
        	$this->form_validation->set_rules('IRI_INTERNO', 'IRI_INTERNO', 'required');
        	$this->form_validation->set_rules('IRI_EXTERNO', 'IRI_EXTERNO', 'required');
        	$this->form_validation->set_rules('EXTENSAO_LOG', 'EXTENSAO_LOG', 'required');
        	$this->form_validation->set_rules('PERIMETRO_URBANO', 'PERIMETRO_URBANO', 'required');
        	$this->form_validation->set_rules('SINALIZACAO_VERT_DIREITA', 'SINALIZACAO_VERT_DIREITA', 'required');
        	$this->form_validation->set_rules('SINALIZACAO_VERT_ESQUERDA', 'SINALIZACAO_VERT_ESQUERDA', 'required');
        	$this->form_validation->set_rules('ACESSO_DIREITA', 'ACESSO_DIREITA', 'required');
        	$this->form_validation->set_rules('ACESSO_ESQUERDA', 'ACESSO_ESQUERDA', 'required');
        	$this->form_validation->set_rules('TIPO_REVESTIMENTO', 'TIPO_REVESTIMENTO', 'required');
        	$this->form_validation->set_rules('ID_LOG_ORIGINAL', 'ID_LOG_ORIGINAL', 'required');
        	$this->form_validation->set_rules('odometro', 'odometro', 'required');
        	$this->form_validation->set_rules('Flecha_Int', 'Flecha_Int', 'required');
        	$this->form_validation->set_rules('Flecha_Ext', 'Flecha_Ext', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'ID_TRECHO' => $this->input->post('ID_TRECHO'),
        	'VELOCIDADE' => $this->input->post('VELOCIDADE'),
        	'HODOMETRO_TRECHO' => $this->input->post('HODOMETRO_TRECHO'),
        	'GPS_VELOCIDADE' => $this->input->post('GPS_VELOCIDADE'),
        	'GPS_HODOMETRO' => $this->input->post('GPS_HODOMETRO'),
        	'GPS_LATITUDE' => $this->input->post('GPS_LATITUDE'),
        	'GPS_LONGITUDE' => $this->input->post('GPS_LONGITUDE'),
        	'GPS_ALTITUDE' => $this->input->post('GPS_ALTITUDE'),
        	'GPS_ERRO' => $this->input->post('GPS_ERRO'),
        	'GPS_QTDE_SATELITES' => $this->input->post('GPS_QTDE_SATELITES'),
        	'GPS_X' => $this->input->post('GPS_X'),
        	'GPS_Y' => $this->input->post('GPS_Y'),
        	'GPS_AZIMUTE' => $this->input->post('GPS_AZIMUTE'),
        	'GPS_NMEA_GPRMC' => $this->input->post('GPS_NMEA_GPRMC'),
        	'GPS_NMEA_GPGGA' => $this->input->post('GPS_NMEA_GPGGA'),
        	'FRAME_CAMERA_1' => $this->input->post('FRAME_CAMERA_1'),
        	'FRAME_CAMERA_2' => $this->input->post('FRAME_CAMERA_2'),
        	'TEMPO_CAMERA_1' => $this->input->post('TEMPO_CAMERA_1'),
        	'TEMPO_CAMERA_2' => $this->input->post('TEMPO_CAMERA_2'),
        	'DATA_HORA' => $this->input->post('DATA_HORA'),
        	'TEMPO_LOG' => $this->input->post('TEMPO_LOG'),
        	'BAROMETRO_PRESSAO' => $this->input->post('BAROMETRO_PRESSAO'),
        	'BAROMETRO_TEMPERATURA' => $this->input->post('BAROMETRO_TEMPERATURA'),
        	'BAROMETRO_ALTITUDE' => $this->input->post('BAROMETRO_ALTITUDE'),
        	'IRI_INTERNO' => $this->input->post('IRI_INTERNO'),
        	'IRI_EXTERNO' => $this->input->post('IRI_EXTERNO'),
        	'EXTENSAO_LOG' => $this->input->post('EXTENSAO_LOG'),
        	'PERIMETRO_URBANO' => $this->input->post('PERIMETRO_URBANO'),
        	'SINALIZACAO_VERT_DIREITA' => $this->input->post('SINALIZACAO_VERT_DIREITA'),
        	'SINALIZACAO_VERT_ESQUERDA' => $this->input->post('SINALIZACAO_VERT_ESQUERDA'),
        	'ACESSO_DIREITA' => $this->input->post('ACESSO_DIREITA'),
        	'ACESSO_ESQUERDA' => $this->input->post('ACESSO_ESQUERDA'),
        	'TIPO_REVESTIMENTO' => $this->input->post('TIPO_REVESTIMENTO'),
        	'ID_LOG_ORIGINAL' => $this->input->post('ID_LOG_ORIGINAL'),
        	'odometro' => $this->input->post('odometro'),
        	'Flecha_Int' => $this->input->post('Flecha_Int'),
        	'Flecha_Ext' => $this->input->post('Flecha_Ext'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->logsdao->update_log($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/logs/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['log'] = $this->logsdao->get_log_by_id($id);
        //load the view
        $data['main_content'] = 'admin/logs/edit';
        $this->load->view('includes/template', $data);            

    }//update    			
    	
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->logsdao->delete_log($id);
        redirect('admin/logs');
    }//edit    			
    	}