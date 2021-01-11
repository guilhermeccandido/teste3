<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class Production extends App_controller {
   
	var $newControllerName = null;
	var $newControllerNamePlural = null;
	var $sonController = null;
	var $fatherController = null;
	
	var $atributos = null;
	
	var $container = null;
	var $containerView = null;
	var $containerController = null;
	var $containerModel = null;
	var $containerRoutes = null;
	var $containerSQLs = null;
	var $containerPostgreSQLs = null;
	var $containerMakeAll = null;
	var $nodeContainer = null;
		
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            redirect('admin/login');
        }
        // config set
        $this->newControllerName = 	'usuarios_contratos';
        // bdName, Namedao, controllerName
        $this->newControllerNamePlural = 'usuarios_contratos';
        
        // IF SET, THIS WILL CONNECT 2 CLASSES
        $this->fatherController = 'usuario';
        $this->sonController = 'contratos';
        
        
        // container set
        $this->container 			=  APPPATH . 'containerProduction/';
        $this->containerView 		=  $this->container . 'view/' . $this->newControllerNamePlural.'/';
        $this->containerController	=  $this->container . 'controller/';
        $this->containerModel		=  $this->container . 'model/';
        $this->containerRoutes		=  $this->container . 'routes/';
        $this->containerSQLs		=  $this->container . 'sqls/';	
        $this->containerPostgreSQLs =  $this->container . 'postgresqls/';
        $this->containerMakeAll		=  $this->container . 'makeall/';
        $this->nodeContainer		=  $this->container . 'nodeData/';
        
        
        // TODO
        // adicionar servico para criação de bd com multi arrays para atribulos
        $this->atributos = array(
        						
        						'Usuario'  	=> 'id_usuario',
        						'Contrato'  	=> 'id_contratos',
        						'Observações' 	=> 'observacoes'
        
        );
		
        
        
        
        
    }
    
    public function index()
    {
    }
    
    public function createAllTemplate($nameTemplate = null, $nameTemplatePlural = null){
    	if(!file_exists($this->container)){
    		mkdir($this->container, 777);
    	}
    	$this->addTemplate();
    	$this->listTemplate();
    	$this->editTemplate();
    	$this->controllerTemplate();
    	$this->modelTemplate();
    	$this->routesTemplate();
    	$this->sqlCreateTemplate();
    	$this->postgreSqlCreateTemplate();
    	
    }
    
    public function addTemplate(){
    	
    	$addPage = '    <div class="container top">';
    	
    	if($this->sonController AND $this->fatherController){
    		$addPage = $addPage.$this->breadcrumbAddConnected();
    		$addPage = $addPage.$this->pageHeaderAdd();
    		$addPage = $addPage.$this->flashMenssageAdd();
    		$addPage = $addPage.$this->pageFormAddConnected();
    	}else{
    		$addPage = $addPage.$this->breadcrumbAdd();
    		$addPage = $addPage.$this->pageHeaderAdd();
    		$addPage = $addPage.$this->flashMenssageAdd();
    		$addPage = $addPage.$this->pageFormAdd();
    	}
    	
    	$addPage = $addPage.'        </div>';
    	if(!file_exists($this->containerView)){
    		mkdir($this->containerView, 777, TRUE );
    	}
    	file_put_contents($this->containerView.'add.php', $addPage);
    	//echo $addPage; 
    	
    }
    
    public function listTemplate(){
    	$addPage = '<?php
						foreach($link_acessos as $item){
							
							if( $item[key($item)] == $this->uri->segment(2)) {
								$acesso = $item[\'acesso\'];
								break;
							}else{
								$acesso = \'visualizar\';
							}
						}
					
					?>
   <div class="container-fluid">		  
	<div class="row">	  	  
		<div class="main">';
    	
    	if($this->sonController AND $this->fatherController){
    		$addPage = $addPage.$this->breadcrumbListConnected();
    		$addPage = $addPage.$this->pageHeaderListConnected();
    		$addPage = $addPage.$this->pageFormListConnected();
    	}else{
    		$addPage = $addPage.$this->breadcrumbList();
    		$addPage = $addPage.$this->pageHeaderList();
    		$addPage = $addPage.$this->pageFormList();
    	}
    	
    	
    	$addPage = $addPage.'              
		</div>       
	</div>
</div>';
    	if($this->sonController AND $this->fatherController){
    		$addPage = $addPage.$this->endPageListConnected();
    	}else{
    		$addPage = $addPage.$this->endPageList();
    	}
    	
    	file_put_contents($this->containerView.'list.php', $addPage);
    	//echo $addPage;
    }
    
    public function editTemplate(){
    	$addPage = '<div class="container top">';
    	
    	if($this->sonController AND $this->fatherController){
    		$addPage = $addPage.$this->breadcrumbEditConnected();
    		$addPage = $addPage.$this->pageHeaderEdit();
    		$addPage = $addPage.$this->flashMenssageEdit();
    		$addPage = $addPage.$this->pageFormEditConnected();
    	}else{
    		$addPage = $addPage.$this->breadcrumbEdit();
    		$addPage = $addPage.$this->pageHeaderEdit();
    		$addPage = $addPage.$this->flashMenssageEdit();
    		$addPage = $addPage.$this->pageFormEdit();
    	}
    	
    	
    	$addPage = $addPage."\r\n".'</div>';
    	file_put_contents($this->containerView.'edit.php', $addPage);
    	//echo $addPage;
    }
    
    public function controllerTemplate(){
    	
    	$addPage = '<?php';
    	$addPage = $addPage.'
require_once(APPPATH . \'controllers/App_controller\' . EXT);';    	
    	$addPage = $addPage.'
class '.$this->newControllerNamePlural.' extends App_controller {';    	
    	$addPage = $addPage.'
const VIEW_FOLDER = \'admin/'.$this->newControllerNamePlural.'\';'."\r\n";
    	$addPage = $addPage.$this->controllerConstruct();
    	
    	if($this->sonController AND $this->fatherController){
    		
    		$addPage = $addPage.$this->controllerIndexConnected();
    		$addPage = $addPage.$this->controllerAddConnected();
    		$addPage = $addPage.$this->controllerUpdateConnected();
    		$addPage = $addPage.$this->controllerDeleteConnected();
    		$addPage = $addPage.$this->controllerforeingControllers();
    		$addPage = $addPage.$this->controllerJSONConnected();
    		
    		
    	}else{
    		
    		$addPage = $addPage.$this->controllerIndex();
    		$addPage = $addPage.$this->controllerAdd();
    		$addPage = $addPage.$this->controllerUpdate();
    		$addPage = $addPage.$this->controllerDelete();
    		$addPage = $addPage.$this->controllerforeingControllers();
    		$addPage = $addPage.$this->controllerJSON();
    	}
    	
    	$addPage = $addPage.'';
    	$addPage = $addPage.'}';
    	if(!file_exists($this->containerController)){
    		mkdir($this->containerController, 777);
    	}
    	file_put_contents($this->containerController.$this->newControllerNamePlural.'.php', $addPage);
    	//echo $addPage; 
    	
    }
	
	public function modelTemplate(){
		
		$addPage = '<?php';
		$addPage = $addPage.'
require_once(APPPATH . \'models/App_DAO\' . EXT);';
		$addPage = $addPage.'
class '.$this->newControllerNamePlural.'dao extends App_DAO {';
		$addPage = $addPage.'
const VIEW_FOLDER = \'admin/'.$this->newControllerNamePlural.'\';';
		if($this->sonController AND $this->fatherController){
			$addPage = $addPage.$this->modelConstructConnected();
		}else{
			$addPage = $addPage.$this->modelConstruct();
		}
		
		$addPage = $addPage.$this->modelGetById();
		$addPage = $addPage.$this->modelGet();
		$addPage = $addPage.$this->modelCount();
		$addPage = $addPage.$this->modelAdd();
		$addPage = $addPage.$this->modelUpdate();
		$addPage = $addPage.$this->modelDelete();
		
		if($this->sonController AND $this->fatherController){
			$addPage = $addPage.$this->modelGetExcludeConnected();
			$addPage = $addPage.$this->modelGetbyFatherIdConnected();
		}
		
		$addPage = $addPage.'}';
		if(!file_exists($this->containerModel)){
			mkdir($this->containerModel, 777);
		}
		file_put_contents($this->containerModel.$this->newControllerNamePlural.'dao.php', $addPage);
		//echo $addPage/
    }

 	public function modelConstruct(){
    	$tag = '
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = \''.$this->newControllerNamePlural.'\';
	    }
    	';
    	return $tag;
    }
    
    public function modelConstructConnected(){
    	$tag = '
    
    	var $'.$this->fatherController.'Table = null;
		var $'.$this->sonController.'Table = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = \''.$this->newControllerNamePlural.'\';
	        $this->'.$this->fatherController.'Table = \''.$this->fatherController.'\';
	        $this->'.$this->sonController.'Table = \''.$this->sonController.'\';
	    }
    	';
    	return $tag;
    }
    
    public function modelGetById(){
    	$tag = '
    	/**
	    * Get '.$this->newControllerName.' by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_'.$this->newControllerName.'_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	';
    	return $tag;
    }
    
    public function modelGet(){
    	$tag = '
	    /**
	    * Fetch '.$this->newControllerNamePlural.' data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_'.$this->newControllerNamePlural.'($search_string=null, $order=null, $order_type=\'Asc\', $limit_start=null, $limit_end=null)
	    {
		    
			$this->db->select(\'*\');
			$this->db->from($this->table);
	
			if($search_string){
				$this->db->like(\'titulo\', $search_string);
			}
			$this->db->group_by(\'id\');
	
			if($order){
				$this->db->order_by($order, $order_type);
			}else{
			    $this->db->order_by(\'id\', $order_type);
			}
	
	        if($limit_start && $limit_end){
	          $this->db->limit($limit_start, $limit_end);	
	        }
	
	        if($limit_start != null){
	          $this->db->limit($limit_start, $limit_end);    
	        }
	        
			$query = $this->db->get();
			
			return $query->result_array(); 	
	    }    			
    	';
    	return $tag;
    }
    
    public function modelCount(){
    	$tag = '
	    /**
	    * Count the number of rows
	    * @param int $search_string
	    * @param int $order
	    * @return int
	    */
	    function count_'.$this->newControllerNamePlural.'($search_string=null, $order=null)
	    {
			$this->db->select(\'*\');
			$this->db->from($this->table);
			if($search_string){
				$this->db->like(\'titulo\', $search_string);
			}
			if($order){
				$this->db->order_by($order, \'Asc\');
			}else{
			    $this->db->order_by(\'id\', \'Asc\');
			}
			$query = $this->db->get();
			return $query->num_rows();        
	    }    			
    	';
    	return $tag;
    }
    
    public function modelAdd(){
    	$tag = '
	    /**
	    * Store the new item into the database
	    * @param array $data - associative array with data to store
	    * @return boolean 
	    */
	    function store_'.$this->newControllerName.'($data)
	    {
	    	return $this->insert_query($data);
		}
    	';
    	return $tag;
    }
    
    public function modelUpdate(){
    	$tag = '
    	/**
	    * Update '.$this->newControllerName.'
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_'.$this->newControllerName.'($id, $data)
	    {
			$this->db->where(\'id\', $id);
			$this->db->update($this->table, $data);
			$report = array();
			$report[\'error\'] = $this->db->_error_number();
			$report[\'message\'] = $this->db->_error_message();
			if($report !== 0){
				return true;
			}else{
				return false;
			}
		}
    	';
    	return $tag;
    }

    public function modelDelete(){
    	$tag = '
	    /**
	    * Delete '.$this->newControllerName.'
	    * @param int $id - '.$this->newControllerName.' id
	    * @return boolean
	    */
		function delete_'.$this->newControllerName.'($id){
			$this->delete_query($id); 
		}'."\r\n";
    	
    	return $tag;
    }
    
    public function modelGetExcludeConnected(){
    	
    	$tag = '
    	function get_'.$this->sonController.'_not_related_'.$this->fatherController.'_by_id_'.$this->fatherController.'($id, $id_'.$this->sonController.' = null){

			$query = \'select \'.$this->'.$this->sonController.'Table.\'.*
					from \'.$this->'.$this->sonController.'Table.\'
					where
					\'.$this->'.$this->sonController.'Table.\'.id NOT IN (
						select \'. $this->table.\'.id_'.$this->sonController.' from \'. $this->table.\' 
							where  \'. $this->table.\'.id_'.$this->fatherController.' = \'.$id.\'  
					) \';
			
			if($id_'.$this->sonController.'){
				$query .= \'OR
						\'.$this->'.$this->sonController.'Table.\'.id = \'.$id_'.$this->sonController.';
			}
								
				$query .= \'	order by \'.$this->'.$this->sonController.'Table.\'.titulo asc\';
				
			return $this->exec_query($query);
			
		}'."\r\n";
    	
    	return $tag;
    	
    	
    }

    public function modelGetbyFatherIdConnected(){
    
    	$tag = '
    	function get_'.$this->newControllerNamePlural.'_by_id_'.$this->fatherController.'($id){
    			
    		$this->db->select($this->table.\'.*, \'.$this->'.$this->sonController.'Table.\'.titulo as '.$this->sonController.'\' );
    		$this->db->from($this->'.$this->sonController.'Table);
    		$this->db->join($this->table, $this->table.\'.id_'.$this->sonController.' = \'.$this->'.$this->sonController.'Table.\'.id \', \'inner\');
    		$this->db->where($this->table.\'.id_'.$this->fatherController.'\', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}'."\r\n";
    	
    	return $tag;
    	
    	
    }
    
    public function controllerConstruct(){
    	$tag = '
    		public function __construct()
		    {
		        parent::__construct();
		        $this->load->model(\''.$this->newControllerNamePlural.'dao\');
		
		        if(!$this->session->userdata(\'logged_in\')){
		            redirect(\'admin/login\');
		        }
		    }
    	';
    	return $tag;
    }

    public function controllerIndex(){
    	$tag = '
    public function index()
    {
		$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    			
        //all the posts sent by the view
        $search_string = $this->input->post(\'search_string\');        
        $order = $this->input->post(\'order\'); 
        $order_type = $this->input->post(\'order_type\'); 

        //pagination settings
        $config[\'per_page\'] = 30;

        $config[\'base_url\'] = base_url().\'admin/'.$this->newControllerNamePlural.'\';
        $config[\'use_page_numbers\'] = TRUE;
        $config[\'num_links\'] = 20;
        $config[\'full_tag_open\'] = \'<nav class="navbar navbar-default navbar-fixed-bottom"><ul class="pagination">\';
        $config[\'full_tag_close\'] = \'</ul></nav>\';
        $config[\'num_tag_open\'] = \'<li>\';
        $config[\'num_tag_close\'] = \'</li>\';
        $config[\'cur_tag_open\'] = \'<li class="disabled"><li class="active"><a href="#">\';
        $config[\'cur_tag_close\'] = \'<span class="sr-only"></span></a></li>\';
        $config[\'next_tag_open\'] = \'<li>\';
		$config[\'next_tagl_close\'] = \'</li>\';
		$config[\'prev_tag_open\'] = \'<li>\';
		$config[\'prev_tagl_close\'] = \'</li>\';
		$config[\'first_tag_open\'] = \'<li>\';
		$config[\'first_tagl_close\'] = \'</li>\';
		$config[\'last_tag_open\'] = \'<li>\';
		$config[\'last_tagl_close\'] = \'</li>\';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config[\'per_page\']) - $config[\'per_page\'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data[\'order_type\'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata(\'order_type\')){
                $order_type = $this->session->userdata(\'order_type\');    
            }else{
                //if we have nothing inside session, so it\'s the default "Asc"
                $order_type = \'Asc\';    
            }
        }
        //make the data type var avaible to our view
        $data[\'order_type_selected\'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it\'s the first time we load the content
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
                $filter_session_data[\'search_string_selected\'] = $search_string;
        	}else if($search_string == \'\' AND $page == null){	
            }else{
                $search_string = $this->session->userdata(\'search_string_selected\');
            }
            $data[\'search_string_selected\'] = $search_string;

            if($order){
                $filter_session_data[\'order\'] = $order;
            }
            else{
                $order = $this->session->userdata(\'order\');
            }
            $data[\'order\'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data[\'count_products\']= $this->'.$this->newControllerNamePlural.'dao->count_'.$this->newControllerNamePlural.'($search_string, $order);
            $config[\'total_rows\'] = $data[\'count_products\'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data[\''.$this->newControllerNamePlural.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->newControllerNamePlural.'($search_string, $order, $order_type, $config[\'per_page\'],$limit_end);        
                }else{
                    $data[\''.$this->newControllerNamePlural.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->newControllerNamePlural.'($search_string, \'\', $order_type, $config[\'per_page\'],$limit_end);           
                }
            }else{
                if($order){
                    $data[\''.$this->newControllerNamePlural.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->newControllerNamePlural.'(\'\', $order, $order_type, $config[\'per_page\'],$limit_end);        
                }else{
                    $data[\''.$this->newControllerNamePlural.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->newControllerNamePlural.'(\'\', \'\', $order_type, $config[\'per_page\'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data[\''.$this->newControllerName.'_selected\'] = null;
            $filter_session_data[\'search_string_selected\'] = null;
            $filter_session_data[\'order\'] = null;
            $filter_session_data[\'order_type\'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data[\'search_string_selected\'] = \'\';
            $data[\'order\'] = \'id\';

            //fetch sql data into arrays
            $data[\'count_products\']= $this->'.$this->newControllerNamePlural.'dao->count_'.$this->newControllerNamePlural.'();
            $data[\''.$this->newControllerNamePlural.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->newControllerNamePlural.'(\'\', \'\', $order_type, $config[\'per_page\'],$limit_end);        
            $config[\'total_rows\'] = $data[\'count_products\'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data[\'main_content\'] = \'admin/'.$this->newControllerNamePlural.'/list\';
        $this->load->view(\'includes/template\', $data);  

    }//index    
    	';
    	return $tag;
    }
    
    public function controllerIndexConnected(){
    	$tag = '
    public function index()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
    	$id = $this->uri->segment(3);
    	$data[\'id_'.$this->fatherController.'\'] = $id;
    	 
    	$this->load->model(\''.$this->newControllerNamePlural.'dao\');
    	$ant = new '.$this->newControllerNamePlural.'dao();
    	 
    	$data[\''.$this->newControllerNamePlural.'\'] = $ant->get_'.$this->newControllerNamePlural.'_by_id_'.$this->fatherController.'($id);
    	//$this->PAR($data[\''.$this->newControllerNamePlural.'\']);
    
        //load the view
        $data[\'main_content\'] = \'admin/'.$this->newControllerNamePlural.'/list\';
        $this->load->view(\'includes/template\', $data);
    
    }//index
    	';
    	return $tag;
    }
    
    public function controllerAdd(){
    	$tag = '
public function add()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server(\'REQUEST_METHOD\') === \'POST\')
        {

            //form validation';
        foreach($this->atributos as $key => $atributo) : 
	        if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricoes' OR $atributo == 'descricao'){
	        	$tag = $tag . '
	        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'\'); ';
	        }else{
	        	$tag = $tag . '
	        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'required\'); ';
	        }
        endforeach;
        $tag = $tag .'
            $this->form_validation->set_error_delimiters(\'<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>\', \'</strong></div>\');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(';
        foreach($this->atributos as $key => $atributo) :
        	$tag = $tag . '\''.$atributo.'\' => $this->input->post(\''.$atributo.'\'),';
        endforeach;
        $tag = $tag . '
                );
                //if the insert has returned true then we show the flash message
                if($this->'.$this->newControllerNamePlural.'dao->store_'.$this->newControllerName.'($data_to_store)){
                    $data[\'flash_message\'] = TRUE; 
                }else{
                    $data[\'flash_message\'] = FALSE; 
                }

            }

        }
        //load the view
        $data[\'main_content\'] = \'admin/'.$this->newControllerNamePlural.'/add\';
        $this->load->view(\'includes/template\', $data);  
    }       
    			
    	';
    	return $tag;
    }
    
    public function controllerAddConnected(){
    	$tag = '
public function add()
    {

    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));			
    			
		$id_'.$this->fatherController.' = $this->uri->segment(4);
    	$data[\'id_'.$this->fatherController.'\'] = $id_'.$this->fatherController.';		
    			
    			
        //if save button was clicked, get the data sent via post
        if ($this->input->server(\'REQUEST_METHOD\') === \'POST\')
        {
    
            //form validation';
    	$tag = $tag . '
        	$this->form_validation->set_rules(\'id_'.$this->fatherController.'\', \'id_'.$this->fatherController.'\', \'required\'); 
        	$this->form_validation->set_rules(\'id_'.$this->sonController.'\', \'id_'.$this->sonController.'\', \'required\');';
    	foreach($this->atributos as $key => $atributo) :
    	if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricoes' OR $atributo == 'descricao'){
    		$tag = $tag . '
        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'\'); ';
    	}else{
    		$tag = $tag . '
        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'required\'); ';
    	}    	
    	endforeach;
    	$tag = $tag .'
            $this->form_validation->set_error_delimiters(\'<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>\', \'</strong></div>\');
    
    
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(';
    	$tag = $tag . '\'id_'.$this->fatherController.'\' => $this->input->post(\'id_'.$this->fatherController.'\'),';
    	$tag = $tag . '\'id_'.$this->sonController.'\' => $this->input->post(\'id_'.$this->sonController.'\'),';
    	foreach($this->atributos as $key => $atributo) :
    	$tag = $tag . '\''.$atributo.'\' => $this->input->post(\''.$atributo.'\'),';
    	endforeach;
    	$tag = $tag . '
                );
                //if the insert has returned true then we show the flash message
                if($this->'.$this->newControllerNamePlural.'dao->store_'.$this->newControllerName.'($data_to_store)){
                    $data[\'flash_message\'] = TRUE;
                }else{
                    $data[\'flash_message\'] = FALSE;
                }
    
            }
    
        }
                		
        $data[\''.$this->sonController.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->sonController.'_not_related_'.$this->fatherController.'_by_id_'.$this->fatherController.'($id_'.$this->fatherController.');
        //$this->PAR($data[\''.$this->sonController.'\']);
                		
        //load the view
        $data[\'main_content\'] = \'admin/'.$this->newControllerNamePlural.'/add\';
        $this->load->view(\'includes/template\', $data);
    }
    
    	';
    	return $tag;
    }
    
    public function controllerUpdate(){
    	$tag = '
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server(\'REQUEST_METHOD\') === \'POST\')
        {
        //form validation';
        foreach($this->atributos as $key => $atributo) : 
			    if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricoes' OR $atributo == 'descricao'){
			    		$tag = $tag . '
			        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'\'); ';
			    	}else{
			    		$tag = $tag . '
			        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'required\'); ';
			    	} 
        endforeach;
        $tag = $tag .'
            $this->form_validation->set_error_delimiters(\'<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>\', \'</strong></div>\');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(';
        foreach($this->atributos as $key => $atributo) : 
        	$tag = $tag . '
        	\''.$atributo.'\' => $this->input->post(\''.$atributo.'\'),';
        endforeach;
        $tag = $tag .'                    
                );
                //if the insert has returned true then we show the flash message
                if($this->'.$this->newControllerNamePlural.'dao->update_'.$this->newControllerName.'($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata(\'flash_message\', \'updated\');
                }else{
                    $this->session->set_flashdata(\'flash_message\', \'not_updated\');
                }
                redirect(\'admin/'.$this->newControllerNamePlural.'/update/\'.$id.\'\');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data[\''.$this->newControllerName.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->newControllerName.'_by_id($id);
        //load the view
        $data[\'main_content\'] = \'admin/'.$this->newControllerNamePlural.'/edit\';
        $this->load->view(\'includes/template\', $data);            

    }//update    			
    	';
    	return $tag;
    }

    public function controllerUpdateConnected(){
    	$tag = '
    public function update()
    {
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));		
    			
        //product id
        $id = $this->uri->segment(4);
  		$id_'.$this->fatherController.' = $this->uri->segment(5);  
  				
        //if save button was clicked, get the data sent via post
        if ($this->input->server(\'REQUEST_METHOD\') === \'POST\')
        {
        //form validation';
    	$tag = $tag . '
        	$this->form_validation->set_rules(\'id_'.$this->fatherController.'\', \'id_'.$this->fatherController.'\', \'required\');
        	$this->form_validation->set_rules(\'id_'.$this->sonController.'\', \'id_'.$this->sonController.'\', \'required\');';
    	foreach($this->atributos as $key => $atributo) :
		    if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricoes' OR $atributo == 'descricao'){
		    		$tag = $tag . '
		        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'\'); ';
		    	}else{
		    		$tag = $tag . '
		        	$this->form_validation->set_rules(\''.$atributo.'\', \''.$atributo.'\', \'required\'); ';
		    	} 
    	endforeach;
    	$tag = $tag .'
            $this->form_validation->set_error_delimiters(\'<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>\', \'</strong></div>\');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(';
    	$tag = $tag . '
        	\'id_'.$this->fatherController.'\' => $this->input->post(\'id_'.$this->fatherController.'\'),';
    	$tag = $tag . '
        	\'id_'.$this->sonController.'\' => $this->input->post(\'id_'.$this->sonController.'\'),';
    	foreach($this->atributos as $key => $atributo) :
    	$tag = $tag . '
        	\''.$atributo.'\' => $this->input->post(\''.$atributo.'\'),';
    	endforeach;
    	$tag = $tag .'
                );
                //if the insert has returned true then we show the flash message
                if($this->'.$this->newControllerNamePlural.'dao->update_'.$this->newControllerName.'($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata(\'flash_message\', \'updated\');
                }else{
                    $this->session->set_flashdata(\'flash_message\', \'not_updated\');
                }
                redirect(\'admin/'.$this->newControllerNamePlural.'/update/\'.$id.\'/\'.$id_'.$this->fatherController.');
    
            }//validation run
    
        }
    
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
    
        //product data
        $data[\''.$this->newControllerName.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->newControllerName.'_by_id($id);
        		
        $data[\''.$this->sonController.'\'] = $this->'.$this->newControllerNamePlural.'dao->get_'.$this->sonController.'_not_related_'.$this->fatherController.'_by_id_'.$this->fatherController.'($id_'.$this->fatherController.', $data[\''.$this->newControllerNamePlural.'\'][0][\'id_'.$this->sonController.'\']);
        //$this->PAR($data[\''.$this->sonController.'\']);		
        		
        		
        //load the view
        $data[\'main_content\'] = \'admin/'.$this->newControllerNamePlural.'/edit\';
        $this->load->view(\'includes/template\', $data);
    
    }//update
    	';
    	return $tag;
    }
     
    public function controllerDelete(){
    	$tag = '
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        $data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    			
        $id = $this->uri->segment(4);
        $this->'.$this->newControllerNamePlural.'dao->delete_'.$this->newControllerName.'($id);
        redirect(\'admin/'.$this->newControllerNamePlural.'\');
    }//edit    			
    	';
    	return $tag;
    }
    
    public function controllerDeleteConnected(){
    	$tag = '
    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
    
    	$data = array();
    	$data = array_merge($data, $this->get_acesso_user(true));
    					
        $id = $this->uri->segment(4);
    	$id_'.$this->fatherController.' = $this->uri->segment(5);
        $this->'.$this->newControllerNamePlural.'dao->delete_'.$this->newControllerName.'($id);
        redirect(\'admin/'.$this->newControllerNamePlural.'/\'.$id_'.$this->fatherController.');
    }//edit
    	';
    	return $tag;
    }
    
    public function controllerJSON(){
    	$tag = '
    /**
    * Delete product by his id
    * @return void
    */
    /*
    public function JSON_METHOD(){
    	 
    	header(\'Content-type: application/json\');    	
    	
    	echo json_encode(array(\'success\' => 1, \'result\' => $out));
    	exit;
    	 
    }
        		
     */   		
    	';
    	return $tag;
    }
    
    
    public function controllerJSONConnected(){
    	$tag = '
    /*
    public function JSON_METHOD(){
    
    	header(\'Content-type: application/json\');
   
    	echo json_encode(array(\'success\' => 1, \'result\' => $out));
    	exit;
    
    }
    
     */
    	';
    	return $tag;
    }
    
    public function controllerforeingControllers(){
    	$tag = '
    /*
    public function foreingControllers(){
    	
    	$this->load->model(\'\');		
    			
    	return $data;
    	
    }
    	
     */
    	';
    	return $tag;
    	
    		
    }
    
    public function routesTemplate(){
    	$addPage='
    				$route[\'admin/'.$this->newControllerNamePlural.'\'] = \''.$this->newControllerNamePlural.'/index\';
				$route[\'admin/'.$this->newControllerNamePlural.'/add\'] = \''.$this->newControllerNamePlural.'/add\';
				$route[\'admin/'.$this->newControllerNamePlural.'/add/(:any)\'] = \''.$this->newControllerNamePlural.'/add/$1\';
				$route[\'admin/'.$this->newControllerNamePlural.'/update\'] = \''.$this->newControllerNamePlural.'/update\';
				$route[\'admin/'.$this->newControllerNamePlural.'/update/(:any)\'] = \''.$this->newControllerNamePlural.'/update/$1\';
				$route[\'admin/'.$this->newControllerNamePlural.'/delete/(:any)\'] = \''.$this->newControllerNamePlural.'/delete/$1\';
				$route[\'admin/'.$this->newControllerNamePlural.'/(:any)\'] = \''.$this->newControllerNamePlural.'/index/$1\'; //$1 = page number
    			';
    	// echo $addPage; 
    	if(!file_exists($this->containerRoutes)){
    		mkdir($this->containerRoutes, 777);
    	}
    	file_put_contents($this->containerRoutes.$this->newControllerNamePlural.'.php', $addPage);
    	
    } 
    
    public function sqlCreateTemplate(){
    	$tag = 'CREATE TABLE `'.$this->newControllerNamePlural.'` ( '."\r\n";
    	$tag .= "\t".'`id` INT(11) NOT NULL AUTO_INCREMENT,'."\r\n";
    			
        foreach($this->atributos as $key => $atributo) : 
        
        	$dataTag = strpos($atributo, 'ata');
			$valorTag = strpos($atributo, 'alor');   
			$idTag = substr_count($atributo, 'id_');
         
	        if($atributo == 'observacoes'){
	        	$tag .= "\t".'`observacoes` TEXT NULL,'."\r\n";
	        }else if($atributo == 'observacao'){
	        	$tag .= "\t".'`observacao` TEXT NULL,'."\r\n";
	        }else if($atributo == 'descricao'){
	        	$tag .= "\t".'`descricao` TEXT NULL,'."\r\n";
	        }else if($atributo == 'titulo'){
	        	$tag .= "\t".''.$atributo.' VARCHAR(255) NULL DEFAULT NULL,'."\r\n";
	        }else if($dataTag == 1){
	        	$tag .= "\t".'`'.$atributo.'` DATE NULL DEFAULT NULL,'."\r\n";
	        }else if($valorTag == 1){
	        	$tag .= "\t".'`'.$atributo.'` FLOAT NULL DEFAULT NULL,'."\r\n";
	        }else if($idTag > 0){
	        	$tag .= "\t".''.$atributo.' INT(11),'."\r\n";	        	
	        }else{
	        	$tag .= "\t".'`'.$atributo.'` VARCHAR(255) INT(11) FLOAT NULL DEFAULT NULL,'."\r\n";
	        }
        
        endforeach;
        
        $tag .= "\t".'`last_update` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,'."\r\n".
        		'PRIMARY KEY (`id`)'."\r\n".
        		')'."\r\n".
        		'COLLATE=\'utf8_general_ci\''."\r\n".
        		'ENGINE=InnoDB'."\r\n".
        		'AUTO_INCREMENT=1;'."\r\n";
        
    	if(!file_exists($this->containerRoutes)){
    		mkdir($this->containerRoutes, 777);
    	}
    	file_put_contents($this->containerSQLs.$this->newControllerNamePlural.'.php', $tag);
    }
   
    public function postgreSqlCreateTemplate(){
    	$tag = 'CREATE TABLE '.$this->newControllerNamePlural.' ( '."\r\n";
    	$tag .= "\t".'id serial PRIMARY KEY,'."\r\n";
    	 
    	foreach($this->atributos as $key => $atributo) :
    
    	$dataTag = strpos($atributo, 'ata');
    	$valorTag = strpos($atributo, 'alor');
    	$idTag = substr_count($atributo, 'id_');
    	 
    	if($atributo == 'observacoes'){
    		$tag .= "\t".'observacoes TEXT NULL,'."\r\n";
    	}else if($atributo == 'observacao'){
    		$tag .= "\t".'observacao TEXT NULL,'."\r\n";
    	}else if($atributo == 'descricao'){
    		$tag .= "\t".'descricao TEXT NULL,'."\r\n";
    	}else if($atributo == 'titulo'){
    		$tag .= "\t".''.$atributo.' VARCHAR(255) ,'."\r\n";
    	}else if($dataTag == 1){
    		$tag .= "\t".''.$atributo.' DATE,'."\r\n";
    	}else if($valorTag == 1){
    		$tag .= "\t".''.$atributo.' FLOAT,'."\r\n";
    	}else if($idTag > 0){
    		$tag .= "\t".''.$atributo.' INTEGER,'."\r\n";
    	}else{
    		$tag .= "\t".''.$atributo.' VARCHAR(255) INTEGER FLOAT NULL DEFAULT NULL,'."\r\n";
    	}
    
    	endforeach;
    
    	$tag .= "\t".'last_update timestamp without time zone DEFAULT now()'."\r\n".
    			
    			');'."\r\n";
    
    	if(!file_exists($this->containerRoutes)){
    		mkdir($this->containerRoutes, 777);
    	}
    	file_put_contents($this->containerPostgreSQLs.$this->newControllerNamePlural.'.php', $tag);
    }
    
    public function breadcrumbAdd(){
    	$tag  = '
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").\'/\'.$this->uri->segment(2); ?>">
	            <?php echo ucfirst($this->uri->segment(2));?>
	          </a>	          
	        </li>
	        <li class="active">
	          Novo
	        </li>
	      </ol>';
    	return  $tag;
    }
    
    public function breadcrumbAddConnected(){
    	$tag  = '
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").\'/'.$this->fatherController.'\'; ?>">
	            <?php echo ucfirst("'.$this->fatherController.'") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").\'/\'.$this->uri->segment(2)."/".$id_'.$this->fatherController.'; ?>">
	          <?php echo ucfirst($this->uri->segment(2));?>
	         </a>
	        </li>
	        <li class="active">
	          Novo
	        </li>
	      </ol>';
    	return  $tag;
    }
    
	public function breadcrumbEdit(){
    	$tag  = '
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").\'/\'.$this->uri->segment(2); ?>">
	            <?php echo ucfirst($this->uri->segment(2));?>
	          </a>	          
	        </li>
	        <li class="active">
	          Update
	        </li>
	      </ol>';
    	return  $tag;
    }
    
    public function breadcrumbEditConnected(){
    	$tag  = '
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").\'/'.$this->fatherController.'\'; ?>">
	            <?php echo ucfirst("'.$this->fatherController.'") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").\'/\'.$this->uri->segment(2)."/".$'.$this->newControllerNamePlural.'[0][\'id_'.$this->fatherController.'\'] ; ?>">
	          <?php echo ucfirst($this->uri->segment(2));?>
	         </a>
	        </li>
	        <li class="active">
	          Update
	        </li>
	      </ol>';
    	return  $tag;
    }
    
    public function breadcrumbList(){
    	$tag  = '
		  <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(2));?>
	        </li>
	      </ol>';
    	return  $tag;
    }    

    public function breadcrumbListConnected(){
    	$tag  = '
		  <ol class="breadcrumb">
	       <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
    		<li>
	          <a href="<?php echo site_url("admin").\'/'.$this->fatherController.'\'; ?>">
	            <?php echo str_replace("_", " ", ucfirst("'.$this->fatherController.'")) ;?>
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo str_replace("_", " ", ucfirst("'.$this->sonController.'")) ;?>
	        </li>
	      </ol>';    	
    	
    	return  $tag;
    }
    
    public function pageHeaderAdd(){
    	$tag ='';
    	/*
		$tag = '      
	      <div class="page-header">
	        <h2>
	          Adicionar <?php echo ucfirst($this->uri->segment(2));?>
	        </h2>
	      </div>';
	    */
      	return $tag;    
    }
    
    public function pageHeaderEdit(){
    	$tag ='';
    	/*
    	$tag = '
	      <div class="page-header">
	        <h2>
	          Atualizar <?php echo ucfirst($this->uri->segment(2));?>
	        </h2>
	      </div>';
	     */
    	return $tag;
    }
    
    public function pageHeaderList(){
    	$tag ='';
    	
    	$tag = '
	      <div class="page-header users-header">
    		<h2>
              <?php echo ucfirst($this->uri->segment(2));?>
              <a  href="<?php echo site_url("admin").\'/\'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>';
        
    	return $tag;
    }
    
    public function pageHeaderListConnected(){
    	$tag ='';
    	 
    	$tag = '
	      <div class="page-header users-header">
    		<h2>
              <?php 
    			echo ucfirst($this->uri->segment(2));
    			if($usuarioPerfil[\'acesso\'] == \'editar\'){
    		  ?>
              	<a  href="<?php echo site_url("admin").\'/\'.$this->uri->segment(2); ?>/add/<?php echo $id_'.$this->fatherController.'; ?>" class="btn btn-success">Adicionar Novo</a>
              <?php
              	}		
              ?>					
            </h2>
          </div>';
    
    	return $tag;
    }
    
    public function flashMenssageAdd(){
    	$tag = ' 
	      <?php
	      //flash messages
	      if(isset($flash_message)){
	        if($flash_message == TRUE)
	        {
	          echo \'<div class="alert alert-success alert-dismissible" role="alert">\';
	            echo \'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\';
	            echo \'<strong>Parabéns!</strong> novo registro adicionado com sucesso.\';
	          echo \'</div>\';       
	        }else{
	          echo \'<div class="alert alert-danger alert-dismissible" role="alert">\';
	            echo \'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\';
	            echo \'<strong>Oh snap!</strong> mude algumas coisas e tente novamente.\';
	          echo \'</div>\';          
	        }
	      }
	      ?>'; 
	     return $tag;     
    }
    
    public function flashMenssageEdit(){
    	$tag = '
	     <?php
	      //flash messages
	      if($this->session->flashdata(\'flash_message\')){
	        if($this->session->flashdata(\'flash_message\') == \'updated\')
	        {
	          echo \'<div class="alert alert-success alert-dismissible" role="alert">\';
	            echo \'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\';
	            echo \'<strong>Parabéns!</strong> editado com sucesso.\';
	          echo \'</div>\';       
	        }else{
	          echo \'<div class="alert alert-danger alert-dismissible" role="alert">\';
	            echo \'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\';
	            echo \'<strong>Oh snap!</strong> mude algumas coisas e tente novamente.\';
	          echo \'</div>\';          
	        }
	      }
	      ?>';
    	return $tag;
    }
    
    public function pageFormAdd(){
    	
    	
		$tag = ' 
		    <?php
		      //form data
		      $attributes = array("class" => "form-horizontal", "id" => "");
			  /*
			  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }
			  
			  echo \'<div class="form-group col-lg-12">\';
		          echo \'<div class="input-group col-lg-8">\';		          
		          	echo form_dropdown(\'id_\', $options_, set_value(\'id_\'), \'class="form-control"\');
					echo \'<span class="input-group-addon">XXXXXXX</span>\';			          
		          echo \'</div>\';
	          echo \'</div>\';	
				
			  */
				
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/'.$this->newControllerNamePlural.'/add", $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>';
    	if(empty($this->atributos)){
			$tag = $tag . '	  
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo"  placeholder="'.$key.'" value="<?php echo set_value(\'titulo\'); ?>" >
	              <span class="input-group-addon">Título</span>
	            </div>
	          </div>';	    		
    	}else{    		
			foreach($this->atributos as $key => $atributo)	:
			if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricao'){
				$tag = $tag.
"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"  rows="5" id="'.$atributo.'" name="'.$atributo.'" placeholder="'.$key.'" ><?php echo set_value(\''.$atributo.'\'); ?></textarea>
		            <span class="input-group-addon">'.$key.'</span>
		        </div>
		      </div>';
			}else{
				$tag = $tag.
"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="'.$atributo.'" name="'.$atributo.'"  placeholder="'.$key.'" value="<?php echo set_value(\''.$atributo.'\'); ?>" >
		            <span class="input-group-addon">'.$key.'</span>
		        </div>
		      </div>';
				
			}	
			endforeach;    	
    	
    	}	
    	$tag = $tag.'
	          <div class="form-group">
	          	<div class="col-lg-6">
	            	<button class="btn btn-primary" type="submit">Salvar Modificações</button>
	            	<button class="btn btn-default" type="reset">Cancelar</button>
	          	</div>
	          </div>
	        </fieldset>	
	      <?php echo form_close(); ?>
    	 </div>
	   	</div>';
    	return $tag;
    }

    public function pageFormAddConnected(){
    	 
    	 
    	$tag = '
		    <?php
		      //form data
		      $attributes = array("class" => "form-horizontal", "id" => "");
    
			  $options_'.$this->sonController.' = array();
		      foreach ($'.$this->sonController.' as $row)
		      {
		      	$options_'.$this->sonController.'[$row["id"]] = $row["titulo"];
		      }
    
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/'.$this->newControllerNamePlural.'/add/".$id_'.$this->fatherController.', $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>';
    			$tag = $tag.
    			"\r\n"."\t"."\t"."\t".'  <input class="form-control" type="hidden" id="id_'.$this->fatherController.'" name="id_'.$this->fatherController.'"  value="<?php echo $id_'.$this->fatherController.'; ?>" >';
    			$tag = $tag.
    			"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_'.$this->sonController.'", $options_'.$this->sonController.', set_value("id_'.$this->sonController.'"), \'class="form-control"\' );?>
		            <span class="input-group-addon">'.$this->sonController.'</span>
		        </div>
		      </div>';
    		foreach($this->atributos as $key => $atributo)	:
    		if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricao'){
    			$tag = $tag.
    			"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"   rows="5" id="'.$atributo.'" name="'.$atributo.'" placeholder="'.$key.'" ><?php echo set_value(\''.$atributo.'\'); ?></textarea>
		            <span class="input-group-addon">'.$key.'</span>
		        </div>
		      </div>';
    		}else if(!($atributo == 'id_'.$this->sonController OR $atributo == 'id_'.$this->fatherController)){
    			$tag = $tag.
    			"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="'.$atributo.'" name="'.$atributo.'"  placeholder="'.$key.'" value="<?php echo set_value(\''.$atributo.'\'); ?>" >
		            <span class="input-group-addon">'.$key.'</span>
		        </div>
		      </div>';
    
    		}
    		endforeach;
    		
    	$tag = $tag.'
	          <div class="form-group">
	          	<div class="col-lg-6">
	            	<button class="btn btn-primary" type="submit">Salvar Modificações</button>
	            	<button class="btn btn-default" type="reset">Cancelar</button>
	          	</div>
	          </div>
	        </fieldset>
	      <?php echo form_close(); ?>
    	 </div>
	   	</div>';
    	return $tag;
    }
    
    public function pageFormEdit(){
    	$tag = '
		    <?php
		      //form data
		      $attributes = array("class" => "form-horizontal", "id" => "");
    		  /*
    		  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }	
    		  <?php 
				     echo \'<div class="form-group col-lg-12">\';
					 echo \'<div class="input-group col-lg-8">\';
		    		 echo form_dropdown(\'id_\', $options_, $'.$this->newControllerNamePlural.'[0][\'id_\'] , \'class="form-control"\' );
		    		 echo \'<span class="input-group-addon">XXXXXXXXX</span>\';			
				     echo \'</div>\';
				     echo \'</div>\';	
			  ?>
    		  */
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/'.$this->newControllerNamePlural.'/update/".$this->uri->segment(4), $attributes); ?>	      		
		     <fieldset>
			 <legend>Editar</legend>';
    	if(empty($this->atributos)){
    		$tag = $tag .
"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		     	<div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="'.$key.'" value="<?php echo set_value(\'titulo\') ?  set_value(\'titulo\') :  $'.$this->newControllerName.'[0][\'titulo\']; ?>" >
	              <span class="input-group-addon">Título</span>
	            </div>
	          </div>';
    	}else{
    		foreach($this->atributos as $key => $atributo)	:
    		
    		if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricao'){
    			$tag = $tag.
"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control"  rows="5" placeholder="'.$key.'" id="'.$atributo.'" name="'.$atributo.'"><?php echo set_value(\''.$atributo.'\') ?  set_value(\''.$atributo.'\') :  $'.$this->newControllerName.'[0][\''.$atributo.'\']; ?></textarea>		
	              <span class="input-group-addon">'.$key.'</span>
	            </div>
	          </div>';
    		}else{
    			$tag = $tag.
"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="'.$atributo.'" name="'.$atributo.'" placeholder="'.$key.'" value="<?php echo set_value(\''.$atributo.'\') ?  set_value(\''.$atributo.'\') : $'.$this->newControllerName.'[0][\''.$atributo.'\']; ?>" >
	              <span class="input-group-addon">'.$key.'</span>
	            </div>
	          </div>';
    		}
    		
    		
    		endforeach;
    		 
    	}
    	$tag = $tag.'
	          <div class="form-group">
	          	<div class="col-lg-6">
	            	<button class="btn btn-primary" type="submit">Salvar Modificações</button>
	            	<button class="btn btn-default" type="reset">Cancelar</button>
    			</div>
	          </div>
	        </fieldset>    
	      <?php echo form_close(); ?>
    	</div>
	   </div>';
    	return $tag;
    }

    public function pageFormEditConnected(){
    	$tag = '
		    <?php
		      //form data
		      $attributes = array("class" => "form-horizontal", "id" => "");
    		  
    		  $options_'.$this->sonController.' = array();
		      foreach ($'.$this->sonController.' as $row)
		      {
		      	$options_'.$this->sonController.'[$row["id"]] = $row["titulo"];
		      }
    		 
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/'.$this->newControllerNamePlural.'/update/".$this->uri->segment(4)."/".$'.$this->newControllerNamePlural.'[0][\'id_'.$this->fatherController.'\'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>';
	    	$tag = $tag.
	    	"\r\n"."\t"."\t"."\t".'  <input class="form-control" type="hidden" id="id_'.$this->fatherController.'" name="id_'.$this->fatherController.'"  value="<?php echo $'.$this->newControllerNamePlural.'[0][\'id_'.$this->fatherController.'\'] ?>" >';
	    	$tag = $tag.
	    	"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
			        <div class="input-group col-lg-8">
			        	<?php echo form_dropdown("id_'.$this->sonController.'", $options_'.$this->sonController.', set_value("id_'.$this->sonController.'"), \'class="form-control"\' );?>
			            <span class="input-group-addon">'.$this->sonController.'</span>
			        </div>
			      </div>';
    		foreach($this->atributos as $key => $atributo)	:
    
    		if($atributo == 'observacoes' OR $atributo == 'observacao' OR $atributo == 'descricao'){
    			$tag = $tag.
    			"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control"  rows="5" placeholder="'.$key.'" id="'.$atributo.'" name="'.$atributo.'"><?php echo set_value(\''.$atributo.'\') ?  set_value(\''.$atributo.'\') :  $'.$this->newControllerName.'[0][\''.$atributo.'\']; ?></textarea>
	              <span class="input-group-addon">'.$key.'</span>
	            </div>
	          </div>';
    		}else if(!($atributo == 'id_'.$this->sonController OR $atributo == 'id_'.$this->fatherController)){
    			$tag = $tag.
    			"\r\n"."\t"."\t"."\t".'  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="'.$atributo.'" name="'.$atributo.'" placeholder="'.$key.'" value="<?php echo set_value(\''.$atributo.'\') ?  set_value(\''.$atributo.'\') :  $'.$this->newControllerName.'[0][\''.$atributo.'\']; ?>" >
	              <span class="input-group-addon">'.$key.'</span>
	            </div>
	          </div>';
    		}
    
    
    		endforeach;
    	
    	$tag = $tag.'
	          <div class="form-group">
	          	<div class="col-lg-6">
	            	<button class="btn btn-primary" type="submit">Salvar Modificações</button>
	            	<button class="btn btn-default" type="reset">Cancelar</button>
    			</div>
	          </div>
	        </fieldset>
	      <?php echo form_close(); ?>
    	</div>
	   </div>';
    	return $tag;
    }
    
    public function pageFormList(){    	
    	
    	$i = 0;   
    	$tag = '
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_'.$this->newControllerNamePlural.' = array();    
            foreach ($'.$this->newControllerNamePlural.' as $array) {
              foreach ($array as $key => $value) {
                $options_'.$this->newControllerNamePlural.'[$key] = $key;
              }
              break;
            }

            echo form_open("admin/'.$this->newControllerNamePlural.'", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, \'class="form-control"\');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_'.$this->newControllerNamePlural.', $order, \'class="form-control"\');

              $data_submit = array("name" => "mysubmit", "class" => "btn btn-primary", "value" => "Ir");

              $options_order_type = array("Asc" => "Asc", "Desc" => "Desc");
              echo form_dropdown("order_type", $options_order_type, $order_type_selected, \'class="form-control"\');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>'."\r\n"."\t"."\t"."\t"."\t";
    	
		if(empty($this->atributos)){
          	$tag = $tag . '                
    			<th class="yellow header headerSortDown">Título</th>    	
    		  </tr>
	        </thead>
	        <tbody>
              <?php
              foreach('.$this->newControllerNamePlural.' as $row)
              {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
    			echo "<td>".$row["titulo"]."</td>;';
    		
    	}else{
    		foreach($this->atributos as $key => $atributo)	:
	    		if($i == 0){
	    			$tag = $tag.'<th class="yellow header headerSortDown">'.$key.'</th>'."\r\n"."\t"."\t"."\t"."\t";
	    		}else if($i == 1){
	    			$tag = $tag.'<th class="green header">'.$key.'</th>'."\r\n"."\t"."\t"."\t"."\t";
	    		}else{
	    			$tag = $tag.'<th class="red header">'.$key.'</th>'."\r\n"."\t"."\t"."\t"."\t";
	    		};
    		endforeach;
    		$tag = $tag . '
	    				</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($'.$this->newControllerNamePlural.' as $row)
	              {
	                echo \'<tr>\';
	                echo \'<td>\'.$row[\'id\'].\'</td>\';'."\r\n"."\t"."\t"."\t"."\t"."\t";
    		
    		foreach($this->atributos as $key => $atributo)	:
    			$tag = $tag . 'echo \'<td>\'.$row[\''.$atributo.'\'].\'</td>\';'."\r\n"."\t"."\t"."\t"."\t"."\t";
    		endforeach;
    		
    	}
    	
    	$tag = $tag.'
		          echo \'<td class="crud-actions">
	                  <a href="\'.site_url("admin").\'/'.$this->newControllerNamePlural.'/update/\'.$row[\'id\'].\'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal(\'.$row[\'id\'].\');" style="width: 130px;">deletar</a>
	                </td>\';
	                echo "</tr>";
	              }
	                  		
	              ?>      
	            </tbody>
	          </table>
		  </div>'."\r\n";
    	
		  $tag = $tag . "\t"."\t"."\t".'<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					 <div class="modal-content">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h3>Deleção de Registro</h3>
					  </div>
					  <div class="modal-body">
					    <p>Você realmente gostaria de Deletar esse Registro?</p>
					  </div>
					  <div class="modal-footer">
					    <a id ="actionModal" href="" class="btn btn-danger">Deletar</a>
					    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					  </div>
					</div>
			       </div>
			     </div>
          <?php echo \'<div class="pagination">\'.$this->pagination->create_links().\'</div>\'; ?>';
	      
    	return $tag;
    }

    public function pageFormListConnected(){
    	 
    	$i = 0;
    	$tag = '
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>'."\r\n"."\t"."\t"."\t"."\t";
    	 
    	
    		$tag = $tag . 
    			"\t".'<th class="yellow header headerSortDown"><?php echo ucfirst("'.$this->sonController.'"); ?></th>';

    		foreach($this->atributos as $key => $atributo)	:
	    		if($i == 0){
	    			$tag = $tag.'<th class="yellow header headerSortDown">'.$key.'</th>'."\r\n"."\t"."\t"."\t"."\t";
	    		}else if($i == 1){
	    			$tag = $tag.'<th class="green header">'.$key.'</th>'."\r\n"."\t"."\t"."\t"."\t";
	    		}else{
	    			$tag = $tag.'<th class="red header">'.$key.'</th>'."\r\n"."\t"."\t"."\t"."\t";
	    		};
    		endforeach;
    		$tag = $tag . 
    		  '</tr>
	        </thead>
	        <tbody>
              <?php
              foreach($'.$this->newControllerNamePlural.' as $row)
              {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";'."\r\n"."\t"."\t"."\t"."\t".
               'echo "<td>".$row["'.$this->sonController.'"]."</td>";'."\r\n";
    
    		foreach($this->atributos as $key => $atributo)	:
    			if( !($atributo == 'id_'.$this->fatherController) ){
    				$tag = $tag . "\t"."\t"."\t"."\t".'echo \'<td>\'.$row[\''.$atributo.'\'].\'</td>\';'."\r\n";
    			}
    			
    		endforeach;
    
    	
    	 
    	$tag = $tag.'
		          echo \'<td class="crud-actions">
	                  <a href="\'.site_url("admin").\'/'.$this->newControllerNamePlural.'/update/\'.$row[\'id\'].\'/\'.$id_'.$this->fatherController.'.\'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal(\'.$row[\'id\'].\', \'.$id_'.$this->fatherController.'.\');" style="width: 130px;">deletar</a>
	                </td>\';
	                echo "</tr>";
	              }
    	
    	
	              ?>
	            </tbody>
	          </table>
		  </div>'."\r\n";
    	
		  $tag = $tag . "\t"."\t"."\t".'<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					 <div class="modal-content">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h3>Deleção de Registro</h3>
					  </div>
					  <div class="modal-body">
					    <p>Você realmente gostaria de Deletar esse Registro?</p>
					  </div>
					  <div class="modal-footer">
					    <a id ="actionModal" href="" class="btn btn-danger">Deletar</a>
					    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					  </div>
					</div>
			       </div>
			     </div>
          <?php echo \'<div class="pagination">\'.$this->pagination->create_links().\'</div>\'; ?>';
    	 
    	return $tag;
    }
  
    public function endPageList(){
    	 
    	$tag = '	
	<script>
		
		function open_modal(id){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/'.$this->newControllerNamePlural.'/delete/"+id);
		}

		/*
		function open_modal(id){
			$("#actionModal").attr("href", "'.$this->newControllerNamePlural.'/delete/"+id);
		}		
		*/
	</script>';
    	 
    	return $tag;
    }
    
    public function endPageListConnected(){
    
    	$tag = '
	<script>
    
		function open_modal(id, id2){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/'.$this->newControllerNamePlural.'/delete/"+id+"/"+id2);
		}
    
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "'.$this->newControllerNamePlural.'/delete/"+id);
		}
		*/
	</script>';
    
    	return $tag;
    }
    
    public function MakeControllers($nameTemplate = null, $nameTemplatePlural = null){
    	
    	if(!file_exists($this->container)){
    		mkdir($this->container, 777);
    	}
    	$this->addTemplate();
    	$this->listTemplate();
    	$this->editTemplate();
    	$this->controllerTemplate();
    	$this->modelTemplate();
    	$this->routesTemplate();
    	$this->sqlCreateTemplate();
    	$this->postgreSqlCreateTemplate();
    	
    }
    
    public function MakeAll(){
    	
    	$addPage = '';
    	$metodo = 'HistoricoMovimentoRGV';
    	$projeto = 'Fluxo';
    	$DTO = 'HistoricoMov';
    	$repositorio = 'movimento';
    	$manager = 'RGVFluxo';
    	$getOrPost = 'get';
    	
    	$methodGetPost = ($getOrPost = 'get') ? 'GetAsync' : 'PostAsJsonAsync';
    	
    	/*
    	 TABELA DE METODOS
    	 	1 . IN STRING OUT LIST
    	 	2 . IN STRING OUT OBJ
			3 . IN LINT<INT> OUT *...
    	 
    	 */
    	
    	$tipoMetodo = '1';
    	
    	// seleciona todas as camadas e cria o controle com o nome padrão
    	// TODO: criar tipos diferentes de controles padrão baseado na entrada e saída de dados
    	
    	$addPage .=
    	'
		// WEB CONTROLLER
    			
    	// selecionar o metodo por aqui..		
		[Http'.ucfirst($getOrPost).']
        public JsonResult '.$metodo.'(string str)
        {
            return Json(_'.$manager.'Manager.'.$metodo.'(str), JsonRequestBehavior.AllowGet);
        }

        [Http'.ucfirst($getOrPost).']
        public JsonResult '.$metodo.'(string str)
        {
            return Json(_'.$manager.'Manager.'.$metodo.'(str), JsonRequestBehavior.AllowGet);
        }
            		
		';
    	
    	
    	$addPage .=
    	'
		// WEB MANAGER


		 public IEnumerable<string> '.$metodo.'(string str)
        {
            var client = new HttpClientHelper<List<string>>();
            List<string> XXX = client.'.$methodGetPost.'(_urlServidor, string.Format("bus/'.strtolower($projeto).'/'.$metodo.'?str={0}", str));

            return contratos;
        }


        public Contrato '.$metodo.'(string str)
        {
            var client = new HttpClientHelper<'.ucfirst($repositorio).'>();
            '.ucfirst($repositorio).' XXX = client.'.$methodGetPost.'(_urlServidor, string.Format("bus/'.strtolower($projeto).'/'.$metodo.'?str={0}", str));

            return XXX;
        }

		';
    	
    	
    	$addPage .=
    	'
		// SERVICE BUS CONTROLLERS    			


    	[Route("bus/'.strtolower($projeto).'/'.$metodo.'")]
        [Http'.ucfirst($getOrPost).']
        public HttpResponseMessage '.$metodo.'([FromUri]string str)
        {
            var XXX = new HttpClientHelper<List<string>>();
            List<string> XXXs = XXX.'.$methodGetPost.'(urlWebServiceSiac, string.Format("service/'.strtolower($projeto).'/'.$metodo.'"), str);
          

            return Request.CreateResponse(HttpStatusCode.OK, XXXs);
        }

        [Route("bus/'.strtolower($projeto).'/'.$metodo.'")]
        [Http'.ucfirst($getOrPost).']
        public HttpResponseMessage '.$metodo.'([FromUri]string str)
        {
            var XXX = new HttpClientHelper<'.ucfirst($DTO).'DTO>();
            '.ucfirst($DTO).'DTO result = XXX.'.$methodGetPost.'(urlWebServiceSiac, string.Format("service/'.strtolower($projeto).'/'.$metodo.'"), str);

            return Request.CreateResponse(HttpStatusCode.OK, result);
        }
    				
		';
    	
    	
    	
    	$addPage .=
    	'
		// API CONTROLLERS     	

    	[Route("service/'.strtolower($projeto).'/'.$metodo.'")]
    	[Http'.ucfirst($getOrPost).']
    	public IActionResult '.$metodo.'([FromBody]string str)
    	{
    		return Ok(_'.strtolower($projeto).'Service.'.$metodo.'(str));
    	}
    	
		';
    	
    	
    	$addPage .= 
    	'
		//WEB SERVICE DOMAIN INTERFACES SERVICES

		using DNIT.SGPLAN.'.$projeto.'.Entities.DTO;
		namespace DNIT.SGPLAN.'.$projeto.'.Domain.Interfaces.Service
		{
		    public interface I'.$projeto.'Service
		    {   
		        IEnumerable<string> '.$metodo.'(string str);
		        '.ucfirst($DTO).'DTO '.$metodo.'(string str);
		    }
		}	
			
		';
    	
    	
    	$addPage .= 
    	
    	'
		// WEB SERVICE DOMAIN SERVICES		
		
		namespace DNIT.SGPLAN.'.$projeto.'.Domain.Services
		{
		    public class '.ucfirst($projeto).'Service : I'.ucfirst($projeto).'Service
		    {
				
				private readonly I'.strtolower($repositorio).'Repository _'.strtolower($repositorio).'Repository;
        		private readonly I'.strtolower($repositorio).'FiscalRepository _'.strtolower($repositorio).'Repository;

				public IEnumerable<string> '.$metodo.'(string str)
		        {
					// just a few examples
		            //return _'.strtolower($repositorio).'Repository.GetAll().Where(y => y.XXX.ToLower().Contains(str.ToLower())).Select(x => x.XXX).Distinct().Take(10).ToList();
					return _'.strtolower($repositorio).'Repository.GetAll().Where(y => y.XXX.ToLower().Contains(str.ToLower())).Select(x => x.XXX).Distinct().ToList();
		        }
		
		
				public '.ucfirst($DTO).'DTO '.$metodo.'(string str)
		    	{
		    		var retorno = new '.ucfirst($DTO).'DTO();
		    		
		    		if (str != null)
		    		{
		    			var _'.strtolower($repositorio).' = _'.strtolower($repositorio).'Repository.Get(x => x.XXX == str);
		    			
		    			if ( _'.strtolower($repositorio).'  != null)
		    			{ 
		    				retorno.XXX =  _'.strtolower($repositorio).' .XXX;
		    			}
		    		}
		    		
		    		return retorno;
		    	}
			}
		}


		';
    	
    	if(!file_exists($this->containerMakeAll)){
    		mkdir($this->containerMakeAll, 777, TRUE );
    	}
    	file_put_contents($this->containerMakeAll.'makeAll.txt', $addPage);
    }
    
    //echo $addPage; 
    
    public function makeMontreal(){
    	
    	$arrayData['newObj'] = true;
    	$arrayData['basePath'] = 'emprenho';
    	$arrayData['subPath'] = 'nota-debito';
    	$arrayData['service'] = 'nota-debito';
    	$arrayData['class'] = array('name' => 'NotaDebito', 'proprieties' => array(
	    	array( 'name' => 'id', 'type' => 'integer','format' => ''),
	    	array( 'name' => 'tipoAdquirente', 'type' => 'object','format' => ''),
	    	array( 'name' => 'cnpj', 'type' => 'integer','format' => ''),
	    	array( 'name' => 'razaoSocial', 'type' => 'string','format' => ''),
	    	array( 'name' => 'notaDebito', 'type' => 'integer','format' => ''),
	    	array( 'name' => 'situacao', 'type' => 'string','format' => ''),
    		array( 'name' => 'dataLancamento', 'type' => 'string','format' => 'date'),
    		array( 'name' => 'dataEmissao', 'type' => 'string','format' => 'date'),
    		array( 'name' => 'dataVencimento', 'type' => 'string','format' => 'date'),
    		array( 'name' => 'valor', 'type' => 'string','format' => ''),
    		array( 'name' => 'observacao', 'type' => 'string','format' => ''),
    		array( 'name' => 'totalNotas', 'type' => 'integer','format' => ''))
	    );
    	
    	/*
    	 $arrayData['class'] = array('name' => 'NotaDebito', 'proprieties' => array(
	    	array( 'name' => 'id', 'type' => 'integer','format' => ''),
	    	array( 'name' => 'tipoAdquirente', 'type' => 'object','format' => ''),
	    	array( 'name' => 'qtdMinima', 'type' => 'integer','format' => ''),
	    	array( 'name' => 'qtdMaxima', 'type' => 'integer','format' => ''),
	    	array( 'name' => 'dataInicioVigencia', 'type' => 'string','format' => 'date'),
	    	array( 'name' => 'dataFimVigencia', 'type' => 'string','format' => 'date'),
	    	array( 'name' => 'registro', 'type' => 'object','format' => ''))
	    ); 
    	  
    	 */
    	
    	$string = '';
    	$string = $this->gatewayServer($arrayData);
    	$this->createNodeFiles($arrayData, $string, 'gateWay');
    	
    	$string = $this->makeModel($arrayData);
    	$this->createNodeFiles($arrayData, $string);
    	
    	$this->debugMark($string, $arrayData);
    	
    }
    
    public function gatewayServer($arrayData){
    	
    	$string = "//FACTORY "."\r\n";    	
    	$string .= 'sbeFactory.create(`${sbeBasePath}/' . $arrayData['basePath'] .'/';
    	
    	if($arrayData['subPath'] != ''){
    		$string .= $arrayData['subPath'] . '/';
    	}
    	$string .= $arrayData['service'] . '.service`);';
    	
    	$string .= "\r\n";
    	
    	$string .= "//SWAGGER DEFINITION "."\r\n";
    	$string .= ', "./app/resources/sbe/' . $arrayData['basePath'] . '/';    	
    	if($arrayData['subPath'] != ''){
    		$string .= $arrayData['subPath'] . '/';
    	}
    	$string .='*.js"';
    	
    	return $string;
    } 
    
    public function makeModel($arrayData){
    	
    	$string = '// MODEL';
    	$string .= "\r\n";
    	
    	if($arrayData['newObj']){
    		$string = 'use strict';    		
    	}
    	$string .= "\r\n";
    	
    	$string .= $this->makeLetModel($arrayData['class']);
    	$string .= $this->makeSwaggerModel($arrayData['class']);
    	$string .= "\r\n";
    	
    	$string .= 'class '.ucfirst($arrayData['class']['name']).' {';
    	$string .= "\r\n";
    	
    	$string .= $this->makeConstructorModel($arrayData['class']);    	
    
    	
    	$string .= '
		}
    	try {
    		module.exports = exports = '.ucfirst($arrayData['class']['name']).';
    	} catch (e) {
    		exports = '.ucfirst($arrayData['class']['name']).';
    	}';
    	
    	return $string;
    	
    }
    
    public function makeLetModel($arrayData){
    	
    	$string = '';
    	foreach($arrayData['proprieties'] as $item){
    		if($item['type'] == 'object'){
    			$string .= 'let '.ucfirst($item['name']).' = require(\'../XXXXX.model\');';
    			$string .= "\r\n";
    		}
    	}
    	return $string;
    }
    
    public function makeSwaggerModel($arrayData){
    	
    	$string = '';
    	$string .=
    	'/**
    		 *
    		 * @swagger
    		 *  definitions:
    		 *      '.$arrayData['name'].':
    		 *          type: object
    		 *          properties:';
    	
    	foreach($arrayData['proprieties'] as $item){
    		
    		if($item['type'] == 'object'){
    			$string .='
    		 *              '.$item['name'].' :
    		 *                  $ref: \'#/definitions/'.ucfirst($item['name']).'\'';
	
    		}else{
    			$string .='
    		 *              '.$item['name'].':
    		 *                  type: '.$item['type'];
	    		if($item['format'] != ""){
	    		 	$string .='
				 *                  format: '.$item['format']; 
	    		 }
    		 
    		}
    		
    	}
    	$string .= '*/';
    	
    	return $string;
    }
    
    public function makeConstructorModel($arrayData){
    	
    	$string = 'constructor(';
    	
    	foreach($arrayData['proprieties'] as $item){
    		$string .= 	$item['name'].' = ';
    		if($item['type'] == 'object'){
    			$string .= 'new '.ucfirst($item['name']).'(),';
    		}else{
    			$string .= 'null,';
    		}
    	}
    	$string = substr($string, 0, -1);
    	
    	$string .= "\r\n";
    	$string .= '){';
    	
    	foreach($arrayData['proprieties'] as $item){
    		$string .= 	
    		'/*
        	@Annotation()';
    		$string .= "\r\n";
    		if($item['type'] == 'object'){
    			$string .= '@type{class}';
    		}else{
    			if($item['type'] ==  'integer'){
    				$string .= '@type{number}';
    				$string .= "\r\n";
    			}else if($item['type'] ==  'string' && $item['format'] ==  'date'){
    				$string .= '@type{date}';
    				$string .= "\r\n";
    			}else{
    				$string .= '@type{string}';
    				$string .= "\r\n";
    			}
    		}
    		$string .= "\r\n";
    		$string .= 'this.'.$item['name'].' = '.$item['name'].
    		'*/';
    		$string .= "\r\n";
    	}
    	
    	
    	$string .= "\r\n";
    	$string .= '}';
    	$string .= "\r\n";
    	
    	return $string;
    	
    }
    
    
    public function createNodeFiles($arrayData, $dataToWrite, $fileFocus = 'model'){    	
    	if($dataToWrite){
    		if(!file_exists($this->nodeContainer.$arrayData['basePath'])){
    			mkdir($this->nodeContainer.$arrayData['basePath'], 777);
    		}
    		if(!file_exists($this->nodeContainer.$arrayData['basePath'].'/'.$arrayData['subPath'])){
    			mkdir($this->nodeContainer.$arrayData['basePath'].'/'.$arrayData['subPath'], 777);
    		}
    		file_put_contents($this->nodeContainer.$arrayData['basePath'].'/'.$arrayData['subPath'].'/'.$arrayData['service'].'.'.$fileFocus.'.js', $dataToWrite);
    	}
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function end(){}
    
}














