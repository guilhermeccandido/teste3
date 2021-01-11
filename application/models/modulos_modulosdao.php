<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class modulos_modulosdao extends App_DAO {
const VIEW_FOLDER = 'admin/modulos_modulos';
    
    	var $modulosTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'modulos_modulos';
	        $this->modulosTable = 'modulos';
	    }
    	
    	/**
	    * Get modulos_modulos by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_modulos_modulos_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch modulos_modulos data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_modulos_modulos($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_modulos_modulos($search_string=null, $order=null)
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
	    function store_modulos_modulos($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update modulos_modulos
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_modulos_modulos($id, $data)
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
	    * Delete modulos_modulos
	    * @param int $id - modulos_modulos id
	    * @return boolean
	    */
		function delete_modulos_modulos($id){
			$this->delete_query($id); 
		}

    	function get_modulos_not_related_modulos_by_id_modulos($id, $id_modulos = null){

			$query = 'select '.$this->modulosTable.'.*
					from '.$this->modulosTable.'
					where
					'.$this->modulosTable.'.id NOT IN (
						select '. $this->table.'.id_modulo2 from '. $this->table.' 
							where  '. $this->table.'.id_modulo1 = '.$id.'  
					) ';
			
			if($id_modulos){
				$query .= 'OR
						'.$this->modulosTable.'.id = '.$id_modulos;
			}
								
				 $query .= '	order by '.$this->modulosTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_modulos_modulos_by_id_modulos($id){
    			
    		$this->db->select($this->table.'.*, '.$this->modulosTable.'.titulo as modulos, '.$this->modulosTable.'.alias as alias'  );
    		$this->db->from($this->modulosTable);
    		$this->db->join($this->table, $this->table.'.id_modulo2 = '.$this->modulosTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_modulo1', $id);
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		return $query->result_array();
    			
    	}
}