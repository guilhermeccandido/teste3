<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class financeiro_fases_subfasesdao extends App_DAO {
const VIEW_FOLDER = 'admin/financeiro_fases_subfases';
    	
    	var $fasesTable = null;
    	var $subfasesTable = null;
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'financeiro_fases_subfases';
	        $this->fasesTable = 'fases';
	        $this->subfasesTable = 'subfases';
	    }
    	
    	/**
	    * Get financeiro_fases_subfases by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_financeiro_fases_subfases_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch financeiro_fases_subfases data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_financeiro_fases_subfases($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    
	    public function get_financeiro_fases_subfases_by_id_registro_financeiro($id_registro_financeiro, $order=null, $order_type='Asc')
	    {
	    
	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    
	    	$this->db->where($this->table.'.id_registro_financeiro',$id_registro_financeiro );
	    
	    	if($order){
	    		$this->db->order_by($order, $order_type);
	    	}else{
	    		$this->db->order_by('id', $order_type);
	    	}
	    	 
	    	$query = $this->db->get();
	    		
	    	return $query->result_array();
	    }
	    
	    public function get_financeiro_fases_subfases_by_id_registro_financeiro_with_fases($id_registro_financeiro, $order=null, $order_type='Asc')
	    {
	    	 
	    	$this->db->select('*');
	    	$this->db->from($this->table);
	    	$this->db->join($this->fasesTable,$this->fasesTable.'.id = '.$this->table.'.id_fases', 'inner' );
	    	 
	    	$this->db->where($this->table.'.id_registro_financeiro',$id_registro_financeiro );
	    	 
	    	if($order){
	    		$this->db->order_by($order, $order_type);
	    	}else{
	    		$this->db->order_by($this->table.'.id', $order_type);
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
	    function count_financeiro_fases_subfases($search_string=null, $order=null)
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
	    function store_financeiro_fases_subfases($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update financeiro_fases_subfases
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_financeiro_fases_subfases($id, $data)
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
	    * Delete financeiro_fases_subfases
	    * @param int $id - financeiro_fases_subfases id
	    * @return boolean
	    */
		function delete_financeiro_fases_subfases($id){
			$this->delete_query($id); 
		}
		
		function get_fases_subfases_not_related_financeiro_by_id_registro_financeiro($id){
    		
			// TODO :  VERIFICAR ESSE SQL
			
    		 $query = 'select '.$this->fasesTable.'.id as id_fases, '.$this->fasesTable.'.titulo as fases,'.$this->fasesTable.'.subfases as havesubfase,
    		 				  '.$this->subfasesTable.'.id as id_subfases,'.$this->subfasesTable.'.titulo as subfases  
					from '.$this->fasesTable.'
						left join '.$this->subfasesTable.' on('.$this->fasesTable.'.id = '.$this->subfasesTable.'.id_fases)
					where
					'.$this->fasesTable.'.id NOT IN (
						select '. $this->table.'.id_fases from '. $this->table.' 
							where  '. $this->table.'.id_registro_financeiro = '.$id.' AND
								   '. $this->table.'.id_subfases = 0
					)  ';
				$query .= '	order by '.$this->fasesTable.'.id asc, '.$this->fasesTable.'.titulo asc,  '.$this->fasesTable.'.grupo asc,'.$this->subfasesTable.'.titulo asc';
			
				//echo $query;
				//die;
				
				//die;
			return $this->exec_query($query);
			
		}
		
}