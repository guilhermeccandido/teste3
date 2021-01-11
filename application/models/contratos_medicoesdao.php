<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class contratos_medicoesdao extends App_DAO {
const VIEW_FOLDER = 'admin/contratos_medicoes';
    
    	var $contratosTable = null;
		var $medicoesTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'contratos_medicoes';
	        $this->contratosTable = 'contratos';
	        $this->medicoesTable = 'medicoes';
	    }
    	
    	/**
	    * Get contratos_medicoes by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_contratos_medicoes_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch contratos_medicoes data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_contratos_medicoes($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_contratos_medicoes($search_string=null, $order=null)
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
	    function store_contratos_medicoes($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update contratos_medicoes
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_contratos_medicoes($id, $data)
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
	    * Delete contratos_medicoes
	    * @param int $id - contratos_medicoes id
	    * @return boolean
	    */
		function delete_contratos_medicoes($id){
			$this->delete_query($id); 
		}

    	function get_medicoes_not_related_contratos_by_id_contratos($id, $id_medicoes = null){

			$query = 'select '.$this->medicoesTable.'.*
					from '.$this->medicoesTable.'
					where
					'.$this->medicoesTable.'.id NOT IN (
						select '. $this->table.'.id_medicoes from '. $this->table.' 
							where  '. $this->table.'.id_contratos = '.$id.'  
					) ';
			
			if($id_medicoes){
				$query .= 'OR
						'.$this->medicoesTable.'.id = '.$id_medicoes;
			}
								
				$query .= '	order by '.$this->medicoesTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_contratos_medicoes_by_id_contratos($contrato){
    			
    		$this->db->select($this->table.'.* ');
    		$this->db->from($this->table);
    		$this->db->where($this->table.'.contrato', $contrato);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
}