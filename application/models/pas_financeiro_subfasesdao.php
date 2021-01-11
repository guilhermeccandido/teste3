<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_financeiro_subfasesdao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_financeiro_subfases';
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas_financeiro_subfases';
	    }
    	
    	/**
	    * Get pas_financeiro_subfases by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_financeiro_subfases_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas_financeiro_subfases data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_financeiro_subfases($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
    	
	    public function get_pas_financeiro_subfases_by_id_pas_id_fase($id_pas, $id_fases, $order=null, $order_type='Asc')
	    {
	    
	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    
	    	$this->db->where($this->table.'.id_pas', $id_pas);
	    	$this->db->where($this->table.'.id_fases', $id_fases);
	    
	    	if($order){
	    		$this->db->order_by($order, $order_type);
	    	}else{
	    		$this->db->order_by('id_subfases', $order_type);
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
	    function count_pas_financeiro_subfases($search_string=null, $order=null)
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
	    function store_pas_financeiro_subfases($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update pas_financeiro_subfases
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_financeiro_subfases($id, $data)
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
	    * Delete pas_financeiro_subfases
	    * @param int $id - pas_financeiro_subfases id
	    * @return boolean
	    */
		function delete_pas_financeiro_subfases($id){
			$this->delete_query($id); 
		}
}