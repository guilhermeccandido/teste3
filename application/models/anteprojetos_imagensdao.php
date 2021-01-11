<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class anteprojetos_imagensdao extends App_DAO {
const VIEW_FOLDER = 'admin/anteprojetos_imagens';
    
    	var $anteprojetosTable = null;
		var $imagensTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'anteprojetos_imagens';
	        $this->anteprojetosTable = 'anteprojetos';
	        $this->imagensTable = 'imagens';
	    }
    	
    	/**
	    * Get anteprojetos_imagens by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_anteprojetos_imagens_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch anteprojetos_imagens data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_anteprojetos_imagens($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_anteprojetos_imagens($search_string=null, $order=null)
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
		function store_anteprojetos_imagens($data)
		{
		
			unset($data['id']);
			$this->db->trans_start();
		
			$result =  $this->db->insert($this->table, $data);
			$id = $this->db->insert_id();
			
			$this->db->trans_complete();

			if($id){
				return $id;
			}else{
				return false;
			}
		
			
		}
		
    	/**
	    * Update anteprojetos_imagens
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_anteprojetos_imagens($id, $data)
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
	    * Delete anteprojetos_imagens
	    * @param int $id - anteprojetos_imagens id
	    * @return boolean
	    */
		function delete_anteprojetos_imagens($id){
			$this->delete_query($id); 
		}

    	
    	function get_anteprojetos_imagens_by_id_anteprojetos($id){
    			
    		$this->db->select($this->table.'.*');
    		$this->db->from($this->table);
    		$this->db->where($this->table.'.id_anteprojetos', $id);
    		$query = $this->db->get();
    		return $query->result_array();
    			
    	}
}