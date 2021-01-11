<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class modulos_perfildao extends App_DAO {
const VIEW_FOLDER = 'admin/modulos_perfil';
    
    	var $modulosTable = null;
		var $usuario_perfilTable = null;
		var $modulosSubmodulosTable = null;
		var $submodulosTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'modulos_perfil';
	        $this->modulosTable = 'modulos';
	        $this->usuario_perfilTable = 'usuario_perfil';
	        $this->modulosSubmodulosTable = 'modulos_submodulos';
	        $this->submodulosTable = 'submodulos';
	    }
    	
    	/**
	    * Get modulos_perfil by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_modulos_perfil_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    public function get_modulos_perfil_by_id_modulo_id_usuario_perfil($id_modulo, $id_usuario_perfil)
	    {
	    
	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    	$this->db->where($this->table.'.id_modulos',$id_modulo );
	    	$this->db->where($this->table.'.id_usuario_perfil',$id_usuario_perfil );
	    	 
	    	$query = $this->db->get();
	    		
	    	return $query->result_array();
	    }
	    
	    /**
	    * Fetch modulos_perfil data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_modulos_perfil($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_modulos_perfil($search_string=null, $order=null)
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
	    function store_modulos_perfil($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update modulos_perfil
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_modulos_perfil($id, $data)
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
	    * Delete modulos_perfil
	    * @param int $id - modulos_perfil id
	    * @return boolean
	    */
		function delete_modulos_perfil($id){
			$this->delete_query($id); 
		}

    	function get_usuario_perfil_not_related_modulos_by_id_modulos($id, $id_usuario_perfil = null){

			$query = 'select '.$this->usuario_perfilTable.'.*
					from '.$this->usuario_perfilTable.'
					where
					'.$this->usuario_perfilTable.'.id NOT IN (
						select '. $this->table.'.id_usuario_perfil from '. $this->table.' 
							where  '. $this->table.'.id_modulos = '.$id.'  
					) ';
			
			if($id_usuario_perfil){
				$query .= 'OR
						'.$this->usuario_perfilTable.'.id = '.$id_usuario_perfil;
			}
								
			$query .= '	order by '.$this->usuario_perfilTable.'.titulo asc';

				
			return $this->exec_query($query);
			
		}
		
		
		function get_usuario_perfil_not_related_id_modulo_submodulo($id_modulo, $id_usuario_perfil = null){
		
			$query = 'select '
						.$this->submodulosTable.'.id, '
						.$this->submodulosTable.'.titulo
					from '.$this->modulosSubmodulosTable.'
					inner join '.$this->submodulosTable.' 
						on ('.$this->modulosSubmodulosTable.'.id_submodulos = '.$this->submodulosTable.'.id)
					where
					'.$this->submodulosTable.'.id NOT IN (
						select '. $this->table.'.id_submodulo from '. $this->table.'
							where  '. $this->table.'.id_modulos = '.$id_modulo.' AND '
									. $this->table.'.id_usuario_perfil = '.$id_usuario_perfil.'
							
											
					) AND '
							.$this->modulosSubmodulosTable.'.id_modulos = '.$id_modulo;
			
		
			$query .= '	order by '.$this->submodulosTable.'.titulo asc';
			//die;
		
			return $this->exec_query($query);
				
		}
		
    	function get_modulos_perfil_by_id_modulos($id){
    			
    		$this->db->select($this->table.'.*, '.$this->usuario_perfilTable.'.titulo as usuario_perfil' );
    		$this->db->from($this->usuario_perfilTable);
    		$this->db->join($this->table, $this->table.'.id_usuario_perfil = '.$this->usuario_perfilTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_modulos', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
    	
    	function count_modulos_perfil_by_id_modulos_id_usuario_perfil($id_modulo, $id_usuario_perfil){
    		 
    		$this->db->select('*');
    		$this->db->from($this->table);
    		$this->db->where($this->table.'.id_modulos', $id_modulo);
    		$this->db->where($this->table.'.id_usuario_perfil', $id_usuario_perfil);
    		$query = $this->db->get();
			return $query->num_rows();    
    		 
    	}
    	
    	
}