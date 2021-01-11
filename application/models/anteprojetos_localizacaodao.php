<?php
require_once(APPPATH . 'models/App_DAO' . EXT);

class anteprojetos_localizacaodao extends App_DAO {

	const VIEW_FOLDER = 'admin/anteprojetos_localizacao';
	
		public $anteprojetoTable = null;
		public $localizacaoTable = null;
		
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'anteprojetos_localizacao';
	        
	        $this->anteprojetoTable = 'anteprojetos';
	        $this->localizacaoTable = 'localizacao';
	    }
    	
    	/**
	    * Get anteprojetos_localizacao by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_anteprojetos_localizacao_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch anteprojetos_localizacao data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_anteprojetos_localizacao($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_anteprojetos_localizacao($search_string=null, $order=null)
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
	    function store_anteprojetos_localizacao($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update anteprojetos_localizacao
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_anteprojetos_localizacao($id, $data)
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
	    * Delete anteprojetos_localizacao
	    * @param int $id - anteprojetos_localizacao id
	    * @return boolean
	    */
		function delete_anteprojetos_localizacao($id){
			$this->delete_query($id); 
		}    			

		
		public function get_anteprojetos_localizacao_by_id_anteprojeto($id)
		{
			 
			//$this->db->select($this->table.'.*, '.$this->localizacaoTable.'.codigo, '.$this->localizacaoTable.'.titulo ' );
			$this->db->select($this->table.'.*, '.$this->localizacaoTable.'.tipo, '.$this->localizacaoTable.'.titulo ' );
			$this->db->from($this->anteprojetoTable);
			$this->db->join($this->table, $this->anteprojetoTable.'.id = '.$this->table.'.id_anteprojeto' , 'inner');
			$this->db->join($this->localizacaoTable, $this->localizacaoTable.'.id = '.$this->table.'.id_localizacao' , 'inner');
			$this->db->where($this->anteprojetoTable.'.id', $id );
			//$this->db->group_by($this->localizacaoTable.'.tipo');
			$this->db->order_by($this->localizacaoTable.'.tipo' , 'ASC');
			 
			$query = $this->db->get();
			 
			return $query->result_array();
		}
		
		public function get_anteprojetos_localizacao_not_defined_by_id_anteprojeto($id)
		{
			// TODO : OK 
			
			$query = 'select '.$this->localizacaoTable.'.* from '.$this->localizacaoTable.' where '.$this->localizacaoTable.'.id NOT IN ('
					.'select '.$this->localizacaoTable.'.id from '.$this->anteprojetoTable.'
							inner join '.$this->table.' on ('.$this->anteprojetoTable.'.id = '.$this->table.'.id_anteprojeto)
							inner join '.$this->localizacaoTable.' on ('.$this->table.'.id_localizacao = '.$this->localizacaoTable.'.id )
							where '.$this->anteprojetoTable.'.id = '.$id.' ) ';
		
			 
		
			//$this->PQUERY();	
					
			return $this->exec_query($query);	;
		}
		
}