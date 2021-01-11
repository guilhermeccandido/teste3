<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class contratos_empenhosdao extends App_DAO {
const VIEW_FOLDER = 'admin/contratos_empenhos';
    
    	var $contratosTable = null;
		var $empenhosTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'contratos_empenhos';
	        $this->contratosTable = 'contratos';
	        $this->empenhosTable = 'empenhos';
	    }
    	
    	/**
	    * Get contratos_empenhos by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_contratos_empenhos_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch contratos_empenhos data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_contratos_empenhos($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
	    {
		    
			$this->db->select('*');
			$this->db->from($this->table);
	
			if($search_string){
				$this->db->like('nota_empenho', $search_string);
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
	    function count_contratos_empenhos($search_string=null, $order=null)
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
	    function store_contratos_empenhos($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update contratos_empenhos
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_contratos_empenhos($id, $data)
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
	    * Delete contratos_empenhos
	    * @param int $id - contratos_empenhos id
	    * @return boolean
	    */
		function delete_contratos_empenhos($id){
			$this->delete_query($id); 
		}

    	function get_empenhos_not_related_contratos_by_id_contratos($id, $id_empenhos = null){

			$query = 'select '.$this->empenhosTable.'.*
					from '.$this->empenhosTable.'
					where
					'.$this->empenhosTable.'.id NOT IN (
						select '. $this->table.'.id_empenhos from '. $this->table.' 
							where  '. $this->table.'.id_contratos = '.$id.'  
					) ';
			
			if($id_empenhos){
				$query .= 'OR
						'.$this->empenhosTable.'.id = '.$id_empenhos;
			}
								
				$query .= '	order by '.$this->empenhosTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_contratos_empenhos_by_id_contratos($contrato){
    			
    		$this->db->select($this->table.'.* ' );
    		$this->db->from($this->table);
    		$this->db->where($this->table.'.contrato', $contrato);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
}