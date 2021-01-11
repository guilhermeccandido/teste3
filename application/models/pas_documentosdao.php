<?php

require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_documentosdao extends App_DAO {

	const VIEW_FOLDER = 'admin/pas_documentos';
	
		public $documentosTable = null;
		public $pasTable = null;
	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->pasTable = 'pas';
	        $this->table = 'pas_documentos';
	        $this->documentosTable = 'documentos';
	    }
    	
    	/**
	    * Get pas_documentos by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_documentos_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas_documentos data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_documentos($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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

	    function get_pas_documentos_by_id_pas($id_pas){
	    	
	    	$this->db->select(	$this->table.'.*, '
	    						.$this->pasTable.'.lote'  );
	    	$this->db->from($this->table);
	    	$this->db->join($this->pasTable, $this->pasTable.".id = ".$this->table.".id_pas", 'inner');
	    	$this->db->where($this->table.".id_pas",$id_pas );
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
	    function count_pas_documentos($search_string=null, $order=null)
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
	    function store_pas_documentos($data)
	    {
	    	unset($data['id']);
	    	$this->db->trans_start();
	    	
	    	$result =  $this->db->insert($this->table, $data);
	    	$id_pas_documento = $this->db->insert_id();
	    	
	    	$this->db->trans_complete();
	    	
	    	
	    	return $id_pas_documento;
	    	
		}
    	
    	/**
	    * Update pas_documentos
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_documentos($id, $data)
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
	    * Delete pas_documentos
	    * @param int $id - pas_documentos id
	    * @return boolean
	    */
		function delete_pas_documentos($id){
			$this->delete_query($id); 
		} 
		
		function get_tipos_documentos_by_pas_id($id_pas){
			
			$this->db->select($this->table.".tipo");
			$this->db->from($this->table);
			$this->db->where($this->table.".id_pas",$id_pas);
			$this->db->group_by($this->table.".tipo");
			$this->db->order_by($this->table.".tipo", "ASC");
				
			$query = $this->db->get();
				
			//$this->PQUERY();
				
			return $query->result_array();
		}
		   			
}