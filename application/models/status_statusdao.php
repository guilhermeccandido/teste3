<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class status_statusdao extends App_DAO {
const VIEW_FOLDER = 'admin/status_status';
    
    	var $statusTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'status_status';
	        $this->statusTable = 'status';
	    }
    	
    	/**
	    * Get status_status by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_status_status_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch status_status data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_status_status($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
	    {
		    
			$this->db->select('*');
			$this->db->from($this->table);
	
			if($search_string){
				$this->db->like('descricao', $search_string);
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
	    function count_status_status($search_string=null, $order=null)
	    {
			$this->db->select('*');
			$this->db->from($this->table);
			if($search_string){
				$this->db->like('descricao', $search_string);
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
	    function store_status_status($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update status_status
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_status_status($id, $data)
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
	    * Delete status_status
	    * @param int $id - status_status id
	    * @return boolean
	    */
		function delete_status_status($id){
			$this->delete_query($id); 
		}

    	function get_status_not_related_status_by_id_status($id, $id_status = null){

			$query = 'select '.$this->statusTable.'.*
					from '.$this->statusTable.'
					where
					'.$this->statusTable.'.id NOT IN (
						select '. $this->table.'.id_status2 from '. $this->table.' 
							where  '. $this->table.'.id_status1 = '.$id.'  
					) ';
			
			if($id_status){
				$query .= 'OR
						'.$this->statusTable.'.id = '.$id_status;
			}
								
				$query .= '	order by '.$this->statusTable.'.id asc';
				
			return $this->exec_query($query);
			
		}
    	
    	function get_status_status_by_id_status($id){
    		 
    		$this->db->select(
    					$this->table.'.*, '.
    					$this->statusTable.'.titulo as status, '.
    					$this->statusTable.'.composicao'
    		);
    		$this->db->from($this->statusTable);
    		$this->db->join($this->table, $this->table.'.id_status2 = '.$this->statusTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_status1', $id);
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		return $query->result_array();
    		 
    	}
    	
    	
}