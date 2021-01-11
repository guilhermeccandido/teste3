<?php
require_once(APPPATH . 'models/App_DAO' . EXT);

class usuariosdao extends App_DAO {

	const VIEW_FOLDER = 'admin/usuarios';
	
		var $perfilTable = null;
		var $usuarioPerfilTable = null;
		
		var $modulosTable = null;
		var $modulosPerfilTable = null;
		var $usuarioModulosTable = null;
		
		var $submodulosTable = null;
		var $modulosSubmodulosTable = null;
		
	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        //$this->table = 'usuarios';
	        $this->table = 'usuario';
	        $this->usuarioPerfilTable = 'usuario_perfil';
	        
	        $this->modulosTable = 'modulos'; 
	        $this->modulosPerfilTable = 'modulos_perfil';
	        $this->usuarioModulosTable = 'usuarios_modulos';
	        
	        $this->submodulosTable = 'submodulos';
	        $this->modulosSubmodulosTable = 'modulos_submodulos';
	        
	    }
    	
    	/**
	    * Get usuario by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_usuario_by_id($id)
	    {
	    	$result = $this->db->get_where($this->table, array( 'id_usuario' => $id));
    		return $result->result_array();		 
	    } 
    	
	    /**
	    * Fetch usuarios data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_usuarios($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
	    {
	    	
	    	$this->db->select('*');
			
			$this->db->from($this->table);
	
			if($search_string){
				$this->db->like('nome', $search_string);
			}
			
	
			if($order){
				$this->db->order_by($order, $order_type);
			}else{
			    $this->db->order_by('id_usuario', $order_type);
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
    	
	    /**
	    * Count the number of rows
	    * @param int $search_string
	    * @param int $order
	    * @return int
	    */
	    function count_usuarios($search_string=null, $order=null)
	    {
			$this->db->select('*');		
			$this->db->from($this->table);
			
			if($search_string){
				$this->db->like('nome', $search_string);
			}
			if($order){
				$this->db->order_by($order, 'Asc');
			}else{
			    $this->db->order_by('id_usuario', 'Asc');
			}
			$query = $this->db->get();
			return $query->num_rows();        
	    }    			
    	
	    /**
	    * Store the new item into the database
	    * @param array $data - associative array with data to store
	    * @return boolean 
	    */
	    function store_usuario($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update usuario
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_usuario($id, $data)
	    {
			$this->db->where('id_usuario', $id);
			$this->db->update($this->table, $data);
			$report = array();
			$report['error'] = $this->db->_error_number();
			$report['message'] = $this->db->_error_message();
			if($report !== 0){
				return true;
			}else{
				return false;
			}
		}
    	
	    /**
	    * Delete usuario
	    * @param int $id - usuario id
	    * @return boolean
	    */
		function delete_usuario($id){
			// ver documentaÃ§Ã£o
    		$result = $this->db->query('DELETE FROM '.$this->table.' where id_usuario = '. $id );
    		return $result; 
		}    
		
		
		function get_usuario_perfil_by_id_usuario_alias_modulo($id, $submodulo){
			//echo __FUNCTION__ ;
			/*
			$this->db->select(
					 $this->usuarioPerfilTable.'.id as id_usuario_perfil, '
					.$this->usuarioPerfilTable.'.titulo as perfil, '
				   	.$this->modulosPerfilTable.'.acesso , '
					.$this->modulosTable.'.titulo as modulo_principal , '
					.$this->submodulosTable.'.titulo as modulo , '
					.$this->submodulosTable.'.alias ' 
					
			);
			
			$this->db->from($this->usuarioPerfilTable);
			$this->db->join( $this->modulosPerfilTable ,    $this->modulosPerfilTable .'.id_usuario_perfil = '.$this->usuarioPerfilTable.'.id' ,'inner');
			$this->db->join( $this->modulosTable , 	     	$this->modulosPerfilTable .'.id_modulos = '.$this->modulosTable.'.id ','inner');
			$this->db->join( $this->usuarioModulosTable ,   $this->usuarioModulosTable.'.id_modulos = '.$this->modulosTable.'.id'  ,'inner');
			$this->db->join( $this->modulosSubmodulosTable, $this->modulosSubmodulosTable.'.id_modulos = '.$this->modulosTable.'.id','inner');
			$this->db->join( $this->submodulosTable,        $this->modulosPerfilTable.'.id_submodulo = '.$this->submodulosTable.'.id' ,'inner');
			
			$this->db->where($this->usuarioModulosTable.'.id_usuarios', $id);
			$this->db->where($this->submodulosTable.'.alias', $submodulo);
			
			$this->db->group_by( 
				array( 
					$this->usuarioPerfilTable.'.id', 
					$this->usuarioPerfilTable.'.titulo',
				   	$this->modulosPerfilTable.'.acesso',
					$this->modulosTable.'.titulo',
					$this->submodulosTable.'.titulo',
					$this->submodulosTable.'.alias'
				)
			);
			
			$query = $this->db->get();
			
		    //$this->PQUERY();
			//die;
			*/
			
			$query = 'select 
						  "modulos"."id", 
						  "usuario_perfil"."id" as id_usuario_perfil,
						  "usuario_perfil"."titulo" as perfil,
						  "modulos_perfil"."acesso", 
						  "modulos"."titulo" as modulo_principal, 
						  "submodulos"."titulo" as modulo, 
						  "submodulos"."alias" 
					    from usuarios_modulos
						inner join modulos ON "modulos"."id" = "usuarios_modulos"."id_modulos"
						INNER JOIN "modulos_submodulos" ON "modulos_submodulos"."id_modulos" = "modulos"."id"
						INNER JOIN "submodulos" ON "modulos_submodulos"."id_submodulos" = "submodulos"."id"
						INNER JOIN "usuario_perfil" ON "usuario_perfil"."id"  = "usuarios_modulos"."id_usuario_perfil" 
						INNER JOIN "modulos_perfil" ON "submodulos"."id"  = "modulos_perfil"."id_submodulo" 
						
					   where 
						usuarios_modulos.id_usuarios = '.$id.' AND
						submodulos.alias = \''.$submodulo.'\' AND 
						modulos_perfil.id_usuario_perfil = ( select usuario_perfil.id
									    from usuarios_modulos
										inner join modulos ON "modulos"."id" = "usuarios_modulos"."id_modulos"
										INNER JOIN "modulos_submodulos" ON "modulos_submodulos"."id_modulos" = "modulos"."id"
										INNER JOIN "submodulos" ON "modulos_submodulos"."id_submodulos" = "submodulos"."id"
										INNER JOIN "usuario_perfil" ON "usuario_perfil"."id"  = "usuarios_modulos"."id_usuario_perfil" 
									   where 
										usuarios_modulos.id_usuarios = '.$id.' AND
										submodulos.alias = \''.$submodulo.'\' );';
												
			
			$result = $this->exec_query($query) ;
			//$this->PQUERY();
			return $result;
			
		}
		
		public function getUsuarioByLoginEmail($login = null, $mail = null){
			$this->db->select('*');
				
			$this->db->from($this->table);
			
			if($login){
				$this->db->where('login',$login );
			}else if($mail){
				$this->db->where('email', $mail);
			}else{
				return array();
			}
			
			$this->db->limit(1);
			
			$query = $this->db->get();
				
			return $query->result_array();
		}
		
		public function getUsuarioByKey($key ){
				
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('hash_cadastro',$key );
			$this->db->limit(1);
		
			$query = $this->db->get();
		
			return $query->result_array();
		}
 }
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 