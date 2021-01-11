<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class usuarios_modulosdao extends App_DAO {
const VIEW_FOLDER = 'admin/usuarios_modulos';
    
    	var $usuariosTable = null;
		var $modulosTable = null;
		var $usuarioPerfilTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'usuarios_modulos';
	        $this->usuariosTable = 'usuarios';
	        $this->modulosTable = 'modulos';
	        $this->usuarioPerfilTable = 'usuario_perfil';
	    }
    	
    	/**
	    * Get usuarios_modulos by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_usuarios_modulos_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch usuarios_modulos data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_usuarios_modulos($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
	    {
		    
			$this->db->select('*');
			$this->db->from($this->table);
	
			if($search_string){
				$this->db->like('titulo', $search_string);
			}
			$this->db->group_by('id');
	
			if($order){
				$this->db->order_by($order, $order_type);
			}else{
			    $this->db->order_by('id', $order_type);
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
	    function count_usuarios_modulos($search_string=null, $order=null)
	    {
			$this->db->select('*');
			$this->db->from($this->table);
			if($search_string){
				$this->db->like('titulo', $search_string);
			}
			if($order){
				$this->db->order_by($order, 'Asc');
			}else{
			    $this->db->order_by('id', 'Asc');
			}
			$query = $this->db->get();
			return $query->num_rows();        
	    }    			
    	
	    /**
	    * Store the new item into the database
	    * @param array $data - associative array with data to store
	    * @return boolean 
	    */
	    function store_usuarios_modulos($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update usuarios_modulos
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_usuarios_modulos($id, $data)
	    {
			$this->db->where('id', $id);
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
	    * Delete usuarios_modulos
	    * @param int $id - usuarios_modulos id
	    * @return boolean
	    */
		function delete_usuarios_modulos($id){
			$this->delete_query($id); 
		}

    	function get_modulos_not_related_usuarios_by_id_usuarios($id, $id_modulos = null){

			$query = 'select '.$this->modulosTable.'.*
					from '.$this->modulosTable.'
					where
					'.$this->modulosTable.'.id NOT IN (
						select '. $this->table.'.id_modulos from '. $this->table.' 
							where  '. $this->table.'.id_usuarios = '.$id.'  
					) ';
			
			if($id_modulos){
				$query .= 'OR
						'.$this->modulosTable.'.id = '.$id_modulos;
			}
								
				$query .= '	order by '.$this->modulosTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_usuarios_modulos_by_id_usuarios($id){
    			
    		$this->db->select($this->table.'.*, '
    				.$this->modulosTable.'.titulo as modulos, '
    				.$this->modulosTable.'.alias, '
					.$this->modulosTable.'.direct_link,  '
    				.$this->modulosTable.'.tipo,  '
    				.$this->usuarioPerfilTable.'.titulo as perfil '
    		);
    		$this->db->from($this->modulosTable);
    		$this->db->join($this->table, $this->table.'.id_modulos = '.$this->modulosTable.'.id ', 'inner');
    		$this->db->join(
    				$this->usuarioPerfilTable, 
    				$this->table.'.id_usuario_perfil = '.$this->usuarioPerfilTable.'.id ', 'inner' );
    		$this->db->where($this->table.'.id_usuarios', $id);
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		//die;
    		
    		return $query->result_array();
    			
    	}
    	
    	function get_perfil_modulo_by_id_usuario_id_modulo($id, $id_modulo){
    		$this->db->select(
    				$this->usuarioPerfilTable.'.id, '
    				.$this->usuarioPerfilTable.'.titulo as perfil '
    		);
    		$this->db->from($this->table );
    		$this->db->join(
    				$this->usuarioPerfilTable, 
    				$this->table.'.id_usuario_perfil = '.$this->usuarioPerfilTable.'.id ', 'inner' );
    		$this->db->where($this->table.'.id_usuarios', $id);
    		$this->db->where($this->table.'.id_modulos', $id_modulo);
    		
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		//die;
    		
    		return $query->result_array();
    		
    	}
    	
    	/*
    	function get_usuarios_modulo_by_id_usuario_alias_modulo($id, $alias){
    		 echo "aqui";
    		$this->db->select(
    				 $this->table.'.id_usuarios, '
    				.$this->table.'.id_modulos, '
    				.$this->table.'.acesso, '
    				.$this->modulosTable.'.titulo as modulos, '
    				.$this->modulosTable.'.alias, '
    				.$this->modulosTable.'.direct_link '  );
    		$this->db->from($this->table);
    		$this->db->join($this->table, $this->table.'.id_modulos = '.$this->modulosTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_usuarios', $id);
    		$this->db->where($this->modulosTable.'.alias', $alias);
    		$query = $this->db->get();
    	
    		$this->PQUERY();
    		die;
    	
    		return $query->result_array();
    		 
    	}
    	*/
    
}