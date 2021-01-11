<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_localizacaodao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_localizacao';
    
    	var $pasTable = null;
		var $localizacaoTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas_localizacao';
	        $this->pasTable = 'pas';
	        $this->localizacaoTable = 'localizacao';
	    }
    	
    	/**
	    * Get pas_localizacao by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_localizacao_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas_localizacao data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_localizacao($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_pas_localizacao($search_string=null, $order=null)
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
	    function store_pas_localizacao($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update pas_localizacao
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_localizacao($id, $data)
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
	    * Delete pas_localizacao
	    * @param int $id - pas_localizacao id
	    * @return boolean
	    */
		function delete_pas_localizacao($id){
			$this->delete_query($id); 
		}

    	function get_localizacao_not_related_pas_by_id_pas($id, $id_localizacao = null){

			$query = 'select '.$this->localizacaoTable.'.*
					from '.$this->localizacaoTable.'
					where
					'.$this->localizacaoTable.'.id NOT IN (
						select '. $this->table.'.id_localizacao from '. $this->table.' 
							where  '. $this->table.'.id_pas = '.$id.'  
					) ';
			
			if($id_localizacao){
				$query .= 'OR
						'.$this->localizacaoTable.'.id = '.$id_localizacao;
			}
								
				$query .= '	order by '.$this->localizacaoTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

    	function get_pas_localizacao_by_id_pas($id){
    			
    		$this->db->select($this->table.'.*, '.$this->localizacaoTable.'.tipo, '.$this->localizacaoTable.'.titulo ' );
    		$this->db->from($this->pasTable);
    		$this->db->join($this->table, $this->pasTable.'.id = '.$this->table.'.id_pas' , 'inner');
    		$this->db->join($this->localizacaoTable, $this->localizacaoTable.'.id = '.$this->table.'.id_localizacao' , 'inner');
    		$this->db->where($this->pasTable.'.id', $id );
    		$this->db->group_by($this->localizacaoTable.'.tipo');
    		$this->db->order_by($this->localizacaoTable.'.tipo' , 'ASC');
    		
    		$query = $this->db->get();
    		
    		return $query->result_array();
    		
    			
    	}
    	
    	public function get_pas_localizacao_not_defined_by_id_pas($id)
    	{
    	
    		$query = 'select '.$this->localizacaoTable.'.* from '.$this->localizacaoTable.' where '.$this->localizacaoTable.'.id NOT IN ('
    				.'select '.$this->localizacaoTable.'.id from '.$this->pasTable.'
							inner join '.$this->table.' on ('.$this->pasTable.'.id = '.$this->table.'.id_pas)
							inner join '.$this->localizacaoTable.' on ('.$this->table.'.id_localizacao = '.$this->localizacaoTable.'.id )
							where '.$this->pasTable.'.id = '.$id.' ) ';
    	
    	
    	
    		return $this->exec_query($query);	;
    	}
    	
    	
}