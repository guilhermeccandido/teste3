<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_prazos_fasesdao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_prazos_fases';
    
    	var $pas_prazosTable = null;
		var $fasesTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas_prazos_fases';
	        $this->pas_prazosTable = 'pas_prazos';
	        $this->fasesTable = 'fases';
	    }
    	
    	/**
	    * Get pas_prazos_fases by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_prazos_fases_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas_prazos_fases data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_prazos_fases($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_pas_prazos_fases($search_string=null, $order=null)
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
	    function store_pas_prazos_fases($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update pas_prazos_fases
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_prazos_fases($id, $data)
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
	    * Delete pas_prazos_fases
	    * @param int $id - pas_prazos_fases id
	    * @return boolean
	    */
		function delete_pas_prazos_fases($id){
			$this->delete_query($id); 
		}

		// TODO : retirar exec_query, FUNCTION OK
		
    	function get_fases_not_related_pas_prazos_by_id_pas_prazos($id, $id_fases = null){

			$query = 'select '.$this->fasesTable.'.*
					from '.$this->fasesTable.'
					where
					'.$this->fasesTable.'.id NOT IN (
						select '. $this->table.'.id_fases from '. $this->table.' 
							where  '. $this->table.'.id_pas_prazos = '.$id.'  
					) ';
			
			if($id_fases){
				$query .= 'OR
						'.$this->fasesTable.'.id = '.$id_fases;
			}
								
				$query .= '	order by '.$this->fasesTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_pas_prazos_fases_by_id_pas_prazos($id){
    			
    		$this->db->select($this->table.'.*, '.$this->fasesTable.'.titulo as fases' );
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_pas_prazos', $id);
    		$this->db->order_by($this->fasesTable.'.id' );
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
}