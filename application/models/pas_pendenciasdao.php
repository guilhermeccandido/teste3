<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_pendenciasdao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_pendencias';
    
    	var $pasTable = null;
		var $pendenciasTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas_pendencias';
	        $this->pasTable = 'pas';
	        $this->pendenciasTable = 'pendencias';
	    }
    	
    	/**
	    * Get pas_pendencias by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_pendencias_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas_pendencias data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_pendencias($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_pas_pendencias($search_string=null, $order=null)
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
	    function store_pas_pendencias($data)
	    {
	    	unset($data['id']);
	    	
	    	$this->db->trans_start();
	    	
	    	$query = 'select max(identificacao) as identificacao 
						from '.$this->table.' 
						where id_pas = '.$data['id_pas'].'
						order by identificacao DESC
						limit 1 ';
	    	$last_id =  $this->exec_query($query);
	    	
	    	if($last_id[0]['identificacao'] == NULL){
	    		$data['identificacao'] = 1;
	    	}else{
	    		$data['identificacao'] = $last_id[0]['identificacao'] + 1;
	    	}
	    	
	    	$result = $this->db->insert($this->table, $data);
	    	
	    	$this->db->trans_complete();
	    	
	    	return $result;
		}
    	
    	/**
	    * Update pas_pendencias
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_pendencias($id, $data)
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
	    * Delete pas_pendencias
	    * @param int $id - pas_pendencias id
	    * @return boolean
	    */
		function delete_pas_pendencias($id){
			$this->delete_query($id); 
		}

    	function get_pendencias_not_related_pas_by_id_pas($id, $id_pendencias = null){

			$query = 'select '.$this->pendenciasTable.'.*
					from '.$this->pendenciasTable.'
					where
					'.$this->pendenciasTable.'.id NOT IN (
						select '. $this->table.'.id_pendencias from '. $this->table.' 
							where  '. $this->table.'.id_pas = '.$id.'  
					) ';
			
			if($id_pendencias){
				$query .= 'OR
						'.$this->pendenciasTable.'.id = '.$id_pendencias;
			}
								
				$query .= '	order by '.$this->pendenciasTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_pas_pendencias_by_id_pas($id){
    		
    		$this->db->select($this->table.'.*, '.
    				$this->pendenciasTable.'.titulo as pendencias, '.
    				$this->pendenciasTable.'.cor as cor, '.
    				$this->pendenciasTable.'.categoria as categoria, '
    		);
    		$this->db->from($this->pendenciasTable);
    		$this->db->join($this->table, $this->table.'.id_pendencias = '.$this->pendenciasTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_pas', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
}