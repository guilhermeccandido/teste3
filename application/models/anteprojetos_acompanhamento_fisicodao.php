<?php
require_once(APPPATH . 'models/App_DAO' . EXT);

class anteprojetos_acompanhamento_fisicodao extends App_DAO {

	const VIEW_FOLDER = 'admin/anteprojetos_acompanhamento_fisico';
	
	
		public $anteprojetoTable = null;
		public $acompanhamento_fisicoTable = null;
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'anteprojetos_acompanhamento_fisico';
	        
	        $this->anteprojetoTable = 'anteprojetos';
	        $this->acompanhamento_fisicoTable = 'acompanhamento_fisico';
	    }
    	
    	/**
	    * Get anteprojetos_acompanhamento_fisico by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_anteprojetos_acompanhamento_fisico_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch anteprojetos_acompanhamento_fisico data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_anteprojetos_acompanhamento_fisico($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_anteprojetos_acompanhamento_fisico($search_string=null, $order=null)
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
	    function store_anteprojetos_acompanhamento_fisico($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update anteprojetos_acompanhamento_fisico
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_anteprojetos_acompanhamento_fisico($id, $data)
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
	    * Delete anteprojetos_acompanhamento_fisico
	    * @param int $id - anteprojetos_acompanhamento_fisico id
	    * @return boolean
	    */
		function delete_anteprojetos_acompanhamento_fisico($id){
			$this->delete_query($id); 
		}    			
    	
		public function get_anteprojetos_acompanhamento_fisico_by_id_anteprojeto($id)
	    {
	    
	    	//$this->db->select($this->table.'.*, '.$this->acompanhamento_fisicoTable.'.codigo, '.$this->acompanhamento_fisicoTable.'.titulo , '.$this->acompanhamento_fisicoTable.'.adm '  );
	    	$this->db->select($this->table.'.*, '.$this->acompanhamento_fisicoTable.'.tipo, '.$this->acompanhamento_fisicoTable.'.titulo, '.$this->acompanhamento_fisicoTable.'.adm '  );
	    	$this->db->from($this->anteprojetoTable);
	    	$this->db->join($this->table, $this->anteprojetoTable.'.id = '.$this->table.'.id_anteprojeto' , 'inner');
	    	$this->db->join($this->acompanhamento_fisicoTable, $this->acompanhamento_fisicoTable.'.id = '.$this->table.'.id_acompanhamento_fisico' , 'inner');
	    	$this->db->where($this->anteprojetoTable.'.id', $id );
	    	// TODO : AFTER POSTGRES
	    	//$this->db->group_by($this->acompanhamento_fisicoTable.'.tipo');    	
	    	$this->db->order_by($this->acompanhamento_fisicoTable.'.tipo' , 'ASC');
	    	 
	    	$query = $this->db->get();
	    		
	    	return $query->result_array();
	    }
    	
	    public function get_anteprojetos_acompanhamento_fisico_not_defined_by_id_anteprojeto($id)
	    {
	    	// TODO : OK 
	    	$query = 'select '.$this->acompanhamento_fisicoTable.'.* from '.$this->acompanhamento_fisicoTable.' where '.$this->acompanhamento_fisicoTable.'.id NOT IN ('
	    			 .'select '.$this->acompanhamento_fisicoTable.'.id from '.$this->anteprojetoTable.' 
							inner join '.$this->table.' on ('.$this->anteprojetoTable.'.id = '.$this->table.'.id_anteprojeto)
							inner join '.$this->acompanhamento_fisicoTable.' on ('.$this->table.'.id_acompanhamento_fisico = '.$this->acompanhamento_fisicoTable.'.id )
							where '.$this->anteprojetoTable.'.id = '.$id.' ) ';	
	    	
	    		
	    	
	    	return $this->exec_query($query);	;
	    }
		
}