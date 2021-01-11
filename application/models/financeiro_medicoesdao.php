<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class financeiro_medicoesdao extends App_DAO {
const VIEW_FOLDER = 'admin/financeiro_medicoes';
    	
    	
    	var $medicoesPasFasesTable = null;
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'financeiro_medicoes';
	        $this->medicoesPasFasesTable = 'medicoes_pas_fases';
	    }
    	
    	/**
	    * Get financeiro_medicoes by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_financeiro_medicoes_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch financeiro_medicoes data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_financeiro_medicoes($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    
	    public function get_financeiro_medicoes_by_id_registro_financeiro($id_registro_financeiro, $order=null, $order_type='Asc')
	    {
	    
	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    
	    	$this->db->where($this->table.'.id_registro_financeiro', $id_registro_financeiro);
	    
	    	if($order){
	    		$this->db->order_by($order, $order_type);
	    	}else{
	    		$this->db->order_by('id', $order_type);
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
	    function count_financeiro_medicoes($search_string=null, $order=null)
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
	    function store_financeiro_medicoes($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update financeiro_medicoes
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_financeiro_medicoes($id, $data)
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
	    * Delete financeiro_medicoes
	    * @param int $id - financeiro_medicoes id
	    * @return boolean
	    */
		function delete_financeiro_medicoes($id){
			
			$this->db->trans_start();
			$this->delete_query($id); 
			$query = 'delete from '.$this->medicoesPasFasesTable.' where '.$this->medicoesPasFasesTable.'.id_financeiro_medicoes = '.$id;
			$this->exec_delete_query($query);
			
			$this->db->trans_complete();
		}
		
		function get_valor_total_medicao_by_id_financeiro_medicao($id_financeiro_medicao){
			
			$this->db->select($this->table.'.acrecimos + '.$this->table.'.descontos + sum('.$this->medicoesPasFasesTable.'.valor) as total');
			$this->db->from($this->table);
			$this->db->join($this->medicoesPasFasesTable, $this->medicoesPasFasesTable.'.id_financeiro_medicoes = '.$this->table.'.id', 'inner' );
			 
			$this->db->where($this->table.'.id', $id_financeiro_medicao);
			
			$this->db->group_by($this->table.'.id');
			
			$query = $this->db->get();
			 
			return $query->result_array();
			
		}











}