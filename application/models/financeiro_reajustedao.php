<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class financeiro_reajustedao extends App_DAO {
const VIEW_FOLDER = 'admin/financeiro_reajuste';
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'financeiro_reajuste';
	    }
    	
    	/**
	    * Get financeiro_reajuste by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_financeiro_reajuste_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch financeiro_reajuste data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_financeiro_reajuste($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
    	
	    public function get_financeiro_reajuste_by_id_registro_financeiro($id_registro_financeiro, $order=null, $order_type='Asc')
	    {
	    
	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    	
	    	if($order){
	    		$this->db->order_by($order, $order_type);
	    	}else{
	    		$this->db->order_by('id', $order_type);
	    	}
	    
	    	$this->db->where($this->table.'.id_registro_financeiro', $id_registro_financeiro);
	    	
	    	$query = $this->db->get();
	    		
	    	return $query->result_array();
	    }
	    
	    public function get_financeiro_reajuste_by_id_registro_financeiro_data_base($id_registro_financeiro, $data_base)
	    {
	    	 
	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    	
	    	$this->db->where($this->table.".id_registro_financeiro", $id_registro_financeiro);
	    	$this->db->where($this->table.".data_base <= '".$data_base."'" );
	    	
	    	$this->db->order_by($this->table.".data_base", "desc");
	    	
	    	$this->db->limit(1);
	    	
	    	$query = $this->db->get();
	    	
	    	//$this->PQUERY();
	    	 
	    	return $query->result_array();
	    }
	    
	    /**
	    * Count the number of rows
	    * @param int $search_string
	    * @param int $order
	    * @return int
	    */
	    function count_financeiro_reajuste($search_string=null, $order=null)
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
	    function store_financeiro_reajuste($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update financeiro_reajuste
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_financeiro_reajuste($id, $data)
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
	    * Delete financeiro_reajuste
	    * @param int $id - financeiro_reajuste id
	    * @return boolean
	    */
		function delete_financeiro_reajuste($id){
			$this->delete_query($id); 
		}
}