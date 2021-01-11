<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class anteprojetos_pendenciasdao extends App_DAO {
const VIEW_FOLDER = 'admin/anteprojetos_pendencias';
    
    	var $anteprojetosTable = null;
		var $pendenciasTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'anteprojetos_pendencias';
	        $this->anteprojetosTable = 'anteprojetos';
	        $this->pendenciasTable = 'pendencias';
	    }
    	
    	/**
	    * Get anteprojetos_pendencias by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_anteprojetos_pendencias_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch anteprojetos_pendencias data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_anteprojetos_pendencias($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_anteprojetos_pendencias($search_string=null, $order=null)
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
	    function store_anteprojetos_pendencias($data)
	    {
	    	unset($data['id']);
	    	
	    	$this->db->trans_start();
	    	
	    	$query = 'select max(identificacao) as identificacao 
						from '.$this->table.' 
						where id_anteprojetos = '.$data['id_anteprojetos'].'
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
	    * Update anteprojetos_pendencias
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_anteprojetos_pendencias($id, $data)
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
	    * Delete anteprojetos_pendencias
	    * @param int $id - anteprojetos_pendencias id
	    * @return boolean
	    */
		function delete_anteprojetos_pendencias($id){
			$this->delete_query($id); 
		}

    	function get_pendencias_not_related_anteprojetos_by_id_anteprojetos($id, $id_pendencias = null){

			$query = 'select '.$this->pendenciasTable.'.*
					from '.$this->pendenciasTable.'
					where
					'.$this->pendenciasTable.'.id NOT IN (
						select '. $this->table.'.id_pendencias from '. $this->table.' 
							where  '. $this->table.'.id_anteprojetos = '.$id.'  
					) ';
			
			if($id_pendencias){
				$query .= 'OR
						'.$this->pendenciasTable.'.id = '.$id_pendencias;
			}
								
				$query .= '	order by '.$this->pendenciasTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_anteprojetos_pendencias_by_id_anteprojetos($id){
    			
    		$this->db->select($this->table.'.*, '.
    				$this->pendenciasTable.'.titulo as pendencias, '.
    				$this->pendenciasTable.'.cor as cor, '.
					$this->pendenciasTable.'.categoria as categoria, ' 
			);
    		$this->db->from($this->pendenciasTable);
    		$this->db->join($this->table, $this->table.'.id_pendencias = '.$this->pendenciasTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_anteprojetos', $id);
    		$this->db->order_by($this->table.'.id_pendencias', 'ASC');
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
    	
}