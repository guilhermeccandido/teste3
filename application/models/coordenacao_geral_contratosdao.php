<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class coordenacao_geral_contratosdao extends App_DAO {
const VIEW_FOLDER = 'admin/coordenacao_geral_contratos';
    
    	var $coordenacao_geralTable = null;
		var $contratosTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'coordenacao_geral_contratos';
	        $this->coordenacao_geralTable = 'coordenacao_geral';
	        $this->contratosTable = 'contratos';
	    }
    	
    	/**
	    * Get coordenacao_geral_contratos by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_coordenacao_geral_contratos_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch coordenacao_geral_contratos data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_coordenacao_geral_contratos($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_coordenacao_geral_contratos($search_string=null, $order=null)
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
	    function store_coordenacao_geral_contratos($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update coordenacao_geral_contratos
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_coordenacao_geral_contratos($id, $data)
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
	    * Delete coordenacao_geral_contratos
	    * @param int $id - coordenacao_geral_contratos id
	    * @return boolean
	    */
		function delete_coordenacao_geral_contratos($id){
			$this->delete_query($id); 
		}

    	function get_contratos_not_related_coordenacao_geral_by_id_coordenacao_geral($id, $id_contratos = null){

			$query = 'select '.$this->contratosTable.'.*
					from '.$this->contratosTable.'
					where
					'.$this->contratosTable.'.id NOT IN (
						select '. $this->table.'.id_contratos from '. $this->table.' 
							where  '. $this->table.'.id_coordenacao_geral = '.$id.'  
					) ';
			
			if($id_contratos){
				$query .= 'OR
						'.$this->contratosTable.'.id = '.$id_contratos;
			}
								
				$query .= '	order by '.$this->contratosTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_coordenacao_geral_contratos_by_id_coordenacao_geral($id){
    			
    		$this->db->select($this->table.'.*, '.$this->contratosTable.'.titulo as contratos' );
    		$this->db->from($this->contratosTable);
    		$this->db->join($this->table, $this->table.'.id_contratos = '.$this->contratosTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_coordenacao_geral', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
}