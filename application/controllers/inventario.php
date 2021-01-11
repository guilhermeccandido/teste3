<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class inventario extends App_controller {
const VIEW_FOLDER = 'admin/inventario';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventariodao');

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

        $config['base_url'] = base_url().'admin/inventario';
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
            $data['count_products']= $this->inventariodao->count_inventario($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['inventario'] = $this->inventariodao->get_inventario($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['inventario'] = $this->inventariodao->get_inventario($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['inventario'] = $this->inventariodao->get_inventario('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['inventario'] = $this->inventariodao->get_inventario('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['inventario_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->inventariodao->count_inventario();
            $data['inventario'] = $this->inventariodao->get_inventario('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/inventario/list';
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
	        	$this->form_validation->set_rules('inventario', 'inventario', 'required'); 
	        	$this->form_validation->set_rules('observacoes', 'observacoes', ''); 
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array('inventario' => $this->input->post('inventario'),'observacoes' => $this->input->post('observacoes'),
                );
                //if the insert has returned true then we show the flash message
                if($this->inventariodao->store_inventario($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/inventario/add';
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
        	$this->form_validation->set_rules('inventario', 'inventario', 'required');
        	$this->form_validation->set_rules('observacoes', 'observacoes', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
        	'inventario' => $this->input->post('inventario'),
        	'observacoes' => $this->input->post('observacoes'),                    
                );
                //if the insert has returned true then we show the flash message
                if($this->inventariodao->update_inventario($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/inventario/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['inventario'] = $this->inventariodao->get_inventario_by_id($id);
        //load the view
        $data['main_content'] = 'admin/inventario/edit';
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
        $this->inventariodao->delete_inventario($id);
        redirect('admin/inventario');
    }//edit    			
    	

    public function unifilar(){
    	
    	$data = array();
    	//$data = array_merge($data, $this->get_acesso_user(true));
    	
    	$this->create_unifilar_data();
    	
    	$data['main_content'] = 'admin/inventario/booble';
    	$this->load->view('includes/template', $data);
    	
    }

    
    public function create_unifilar_data(){
    	
    	$occupation =  'occupationsbyage.csv';
		$parent = 	'idofparentlevels.csv';
		$occupationJson = 'occupation.json'; 
    	
    	$model =  new inventariodao();
    	
    	$arrayLegend = array(
    			'funcionais' => 'Dados Funcionais Rodovia',
    			'fwd' => 'FWD',
    			'trafego' => 'Tráfego',
    			'intersecoes' => 'Cadastro de Interseções',
    			'oae' => 'Cadastro de OAE',
    			'sondagem' => 'Sondagem',
    			'topografia' => 'Topografia',
    			'sinalizacao' => 'Sinalização e Dispositivos',
    		
    	);
    	
    	$arrayTempRegioes = $model->get_regioes();
    	
    	$csvData = '"ID","age","value"'."\r\n";
    	$parentID =  '"name","ID"'."\r\n";
    	$parentID .= '"brasil",""'."\r\n";	

    	foreach($arrayTempRegioes as $item){
    		
    		$parentID .= '"'.$item['regiao'].'","'.$item['id_regiao'].'"'."\r\n";
    		
    		$arrayTempEstado = $model->get_estados_by_id_regiao($item['id_regiao']);
    		foreach($arrayTempEstado as $item2){
    			
    			$parentID .= '"'.$item2['estado'].'","'.$item['id_regiao'].'.'.$item2['id_estado'].'"'."\r\n";
    			
    			$arrayTempFilhosEstado = $model->get_data_by_id_regiao_id_estado($item['id_regiao'], $item2['id_estado'], true);
    			foreach($arrayTempFilhosEstado as $item3){
    				
    				$filhoEstadoID = $item3['id_regiao'].'.'.$item3['id_estado'].'.'.$item3['id'];
    				$filhoEstadoName = 'BR-'.$item3['rodovia'].'/'.$item3['uf'];    				
    				$filhosEstado[] = array('name' => $filhoEstadoName, 
    										'ID' => $filhoEstadoID,
    									    'size' => $item3['extensao'] );
    				
    				$parentID .= '"'.$filhoEstadoName.'","'.$filhoEstadoID.'"'."\r\n";
    				
    				foreach($arrayLegend as $key => $item4){
    					if($item3[$key] == 'true'){
    						$csvData .= '"'.$filhoEstadoID.'","'.$item4.'","1"'."\r\n";
    					};
    				}
    			}
    			$arrayEstado[] = array('name' => $item2['estado'],  'children' => $filhosEstado);
    			$filhosEstado = array();
    		}
    		
    		$arrayRegioes[] = array('name' => $item['regiao'],  'children' => $arrayEstado);
    		$arrayEstado = array();
    	}
    	
    	//echo nl2br($parentID);
    	//echo nl2br($csvData);
    	$jsonData = json_encode(array('name' => 'brasil',  'children' => $arrayRegioes));
    	
    	file_put_contents( ASSETS_PORTAL . $occupation , $csvData);
    	file_put_contents( ASSETS_PORTAL . $parent, $parentID );
    	file_put_contents( ASSETS_PORTAL . $occupationJson, $jsonData );
    }
    
    public function clustergram(){
    	
    	$data = array();
    	//$data = array_merge($data, $this->get_acesso_user(true));
    	 
    	$data['jsonData']  = $this->create_clustergram();
    	 
    	$data['main_content'] = 'admin/inventario/clustergram';
    	$this->load->view('includes/template', $data);
    	
    }
    
    public function create_clustergram(){
    	 
    	$model =  new inventariodao();
    	 
    	$arrayLegend = array(
    			'funcionais' => 'Dados Funcionais Rodovia',
    			'fwd' => 'FWD',
    			'trafego' => 'Tráfego',
    			'intersecoes' => 'Cadastro de Interseções',
    			'oae' => 'Cadastro de OAE',
    			'sondagem' => 'Sondagem',
    			'topografia' => 'Topografia',
    			'sinalizacao' => 'Sinalização e Dispositivos',
    	
    	);
    	 
    	$rowNodes = array();
    	$colNodes = array();
    	$links    = array();
    	
    	$clustergramData = $model->get_unifilar( "id_regiao", "DESC");
    	
    	$cluster = 0;
    	$rank = 0;
    	$rankvar = 0;
    	$ind = 0;
    	$arrayRankLegend = array();
    	$first = true;
    	
    	foreach($clustergramData as $item){
    		
    		foreach($arrayLegend as $key => $value){
    			if($first){
    				$arrayRankLegend[$key] = 0;
    			}
    			if($item[$key] == 'true'){
    				$links[] = array( "source" => $cluster, "target" => $ind, "value" => 1);
    				$arrayRankLegend[$key]++; 
    				$rank++;
    			}else{
    				$links[] = array( "source" => $cluster, "target" => $ind, "value" => -0.5);
    			}
    			$ind++;
    		}
    		$first = false;
    		
    		$nameRowNode = 'BR-'.$item['rodovia'].'/'.$item['uf'];
    		$rowNodes[] = array( 'name' => "$nameRowNode", 'clust' => $cluster, 'rank' => $rank, 'rankvar' => $rankvar);
    		
    		$cluster++;
    		$ind = 0;
    		$rank = 0;
    		$rankvar = 0;
    	}
    	
    	$cluster = 7;
    	foreach($arrayLegend as $key => $value){
    		$colNodes[] = array("name" => "$value", "clust" => $cluster, "rank" => $arrayRankLegend[$key],"rankvar" => $rankvar );
    		$cluster--;
    	}
    	
    	return json_encode(array('row_nodes' =>  $rowNodes, 'col_nodes' => $colNodes, 'links' => $links));
    	
    	
    }

    public function lego(){
    	
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    	
    	
    	
    	$data['main_content'] = 'admin/inventario/lego';
    	$this->load->view('includes/template', $data);
    }
    
}



















