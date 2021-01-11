<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class fases_checklistdao extends App_DAO {
const VIEW_FOLDER = 'admin/fases_checklist';
    
    	var $fasesTable = null;
		var $checklistTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'fases_checklist';
	        $this->fasesTable = 'fases';
	        $this->checklistTable = 'checklist';
	    }
    	
    	/**
	    * Get fases_checklist by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_fases_checklist_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch fases_checklist data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_fases_checklist($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_fases_checklist($search_string=null, $order=null)
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
	    function store_fases_checklist($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update fases_checklist
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_fases_checklist($id, $data)
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
	    * Delete fases_checklist
	    * @param int $id - fases_checklist id
	    * @return boolean
	    */
		function delete_fases_checklist($id){
			$this->delete_query($id); 
		}

    	function get_checklist_not_related_fases_by_id_fases($id, $id_checklist = null){

			$query = 'select '.$this->checklistTable.'.*
					from '.$this->checklistTable.'
					where
					'.$this->checklistTable.'.id NOT IN (
						select '. $this->table.'.id_checklist from '. $this->table.' 
							where  '. $this->table.'.id_fases = '.$id.'  
					) ';
			
			if($id_checklist){
				$query .= 'OR
						'.$this->checklistTable.'.id = '.$id_checklist;
			}
								
				$query .= '	order by '.$this->checklistTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_fases_checklist_by_id_fases($id){
    			
    		$this->db->select($this->table.'.*, '.$this->checklistTable.'.titulo as checklist' );
    		$this->db->from($this->checklistTable);
    		$this->db->join($this->table, $this->table.'.id_checklist = '.$this->checklistTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_fases', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
}