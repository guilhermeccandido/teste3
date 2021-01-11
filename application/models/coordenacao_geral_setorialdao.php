<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class coordenacao_geral_setorialdao extends App_DAO {
const VIEW_FOLDER = 'admin/coordenacao_geral_setorial';
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
		var $coordenacao_geralTable = null;
		var $coordenacao_setorialTable = null;

	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'coordenacao_geral_setorial';
	        $this->coordenacao_geralTable = 'coordenacao_geral';
	        $this->coordenacao_setorialTable = 'coordenacao_setorial';
	    }
    	
    	/**
	    * Get coordenacao_geral_setorial by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_coordenacao_geral_setorial_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch coordenacao_geral_setorial data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_coordenacao_geral_setorial($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_coordenacao_geral_setorial($search_string=null, $order=null)
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
	    function store_coordenacao_geral_setorial($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update coordenacao_geral_setorial
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_coordenacao_geral_setorial($id, $data)
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
	    * Delete coordenacao_geral_setorial
	    * @param int $id - coordenacao_geral_setorial id
	    * @return boolean
	    */
		function delete_coordenacao_geral_setorial($id){
			$this->delete_query($id); 
		}

		function get_coordenacao_geral_setorial_by_id_coordenacao_geral($id){
			
			$this->db->select($this->table.'.*, '.$this->coordenacao_setorialTable.'.titulo as coordenacao_setorial' );
			$this->db->from($this->coordenacao_setorialTable);
			$this->db->join($this->table, $this->table.'.id_coordenacao_setorial = '.$this->coordenacao_setorialTable.'.id ', 'inner');
			$this->db->where($this->table.'.id_coordenacao_geral', $id);
			$query = $this->db->get();
			return $query->result_array();
			
		}
		
		function get_coordenacao_setorial_not_related_coordenacao_geral_by_id_coordenacao_geral($id, $id_coordenacao_setorial = null){

			$query = 'select '.$this->coordenacao_setorialTable.'.*
					from '.$this->coordenacao_setorialTable.'
					where
					'.$this->coordenacao_setorialTable.'.id NOT IN (
						select '. $this->table.'.id_coordenacao_setorial from '. $this->table.' 
							where  '. $this->table.'.id_coordenacao_geral = '.$id.'  
					) ';
			
			if($id_coordenacao_setorial){
				$query .= 'OR
						'.$this->coordenacao_setorialTable.'.id = '.$id_coordenacao_setorial;
			}
								
				$query .= '	order by '.$this->coordenacao_setorialTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}
		
		
    	
}