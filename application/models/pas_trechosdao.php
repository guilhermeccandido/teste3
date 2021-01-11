<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_trechosdao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_trechos';
    
    	var $pasTable = null;
		var $estadosTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas_trechos';
	        $this->pasTable = 'pas';
	        $this->estadosTable = 'estados';
	    }
    	
    	/**
	    * Get pas_trechos by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_trechos_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas_trechos data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_trechos($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_pas_trechos($search_string=null, $order=null)
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
	    function store_pas_trechos($data)
	    {
	    	/*
	    	$this->PAR($data);
	    	$data['coordenadas'] = $data['coordenadas'] 
	    	foreach($data as $item){
	    		echo $item.'<br>';
	    	}
	    	die;
	    	*/
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update pas_trechos
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_trechos($id, $data)
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
	    * Delete pas_trechos
	    * @param int $id - pas_trechos id
	    * @return boolean
	    */
		function delete_pas_trechos($id){
			$this->delete_query($id); 
		}

		
		// TODO :  NOT USED
		/*
    	function get_estados_not_related_pas_by_id_pas($id, $id_estados = null){

			$query = 'select '.$this->estadosTable.'.*
					from '.$this->estadosTable.'
					where
					'.$this->estadosTable.'.id NOT IN (
						select '. $this->table.'.id_estados from '. $this->table.' 
							where  '. $this->table.'.id_pas = '.$id.'  
					) ';
			
			if($id_estados){
				$query .= 'OR
						'.$this->estadosTable.'.id = '.$id_estados;
			}
								
				$query .= '	order by '.$this->estadosTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}
		*/
    	function get_pas_trechos_by_id_pas($id){
    			
    		$this->db->select($this->table.'.*, '.$this->estadosTable.'.titulo as estados, '.$this->estadosTable.'.uf ');
    		$this->db->from($this->estadosTable);
    		$this->db->join($this->table, $this->table.'.id_estados = '.$this->estadosTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_pas', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
    	
    	function get_pas_trechos_label_by_id_pas($id){
    		 
    		$this->db->select($this->table.'.rodovia, '.$this->table.'.extensao, '.$this->estadosTable.'.uf ');
    		$this->db->from($this->estadosTable);
    		$this->db->join($this->table, $this->table.'.id_estados = '.$this->estadosTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_pas', $id);
    		$query = $this->db->get();
    		//$this->PQUERY();
    		
    		return $query->result_array();
    		 
    	}
    	
    	function get_pas_trechos_lotes(){
    		 
    		$this->db->select(
    				$this->table.'.rodovia, '.
    				$this->table.'.km_inicial, '.
    				$this->table.'.km_final, '.
    				$this->table.'.extensao,'.
    				$this->table.'.snv, '.
    				$this->estadosTable.'.uf, '.
    				$this->pasTable.'.lote,'.
    				$this->pasTable.'.id_contrato' );
    		$this->db->from($this->estadosTable);
    		$this->db->join($this->table, $this->table.'.id_estados = '.$this->estadosTable.'.id ', 'inner');
    		$this->db->join($this->pasTable, $this->table.'.id_pas = '.$this->pasTable.'.id ', 'inner');
    		$this->db->order_by($this->pasTable.'.lote' , 'Asc');
    		$query = $this->db->get();
    		return $query->result_array();
    		 
    	}
    	
    	// TODO : NOT USED
    	/*
    	function get_group_pas_trechos_by_id_pas($id){
    		$query = " select CONCAT(".$this->estadosTable.".uf, ' BR-', ".$this->table.".rodovia,  ' / ') as trechos
    					from pas_trechos
    					inner join estados on (".$this->estadosTable.".id = ".$this->table.".id_estados) 
    					where ".$this->table.".id_pas = ". $id ;
    		//die;
    		
    		return $this->exec_query($query);
    	}
    	*/
    	
    	function get_pas_trechos_coordenadas_by_id_pas($id){
    		 
    		$this->db->select($this->table.'.coordenadas ');
    		$this->db->from($this->table);
    		$this->db->where($this->table.'.id_pas', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    		 
    	}
    	
    	function get_pas_trechos_coordenadas_pas(){
    		 
    		$this->db->select($this->table.'.coordenadas ');
    		$this->db->from($this->table);
    		$query = $this->db->get();
    		return $query->result_array();
    		 
    	}
    	
}