<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class medicoes_pas_fasesdao extends App_DAO {
const VIEW_FOLDER = 'admin/medicoes_pas_fases';
    	
    	var $fasesTable = null;
    	var $pasfasesTable = null;
    	var $pasTable = null;
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'medicoes_pas_fases';
	        $this->fasesTable = 'fases';
	        $this->pasfasesTable = 'pas_fases';
	        $this->pasTable = 'pas';
	        
	    }
    	
    	/**
	    * Get medicoes_pas_fases by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_medicoes_pas_fases_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch medicoes_pas_fases data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_medicoes_pas_fases($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    
	    public function get_medicoes_pas_fases_by_id_financeiro_medicoes($id_financeiro_medicoes, $order=null, $order_type='Asc')
	    {
	    
	    	$this->db->select($this->table.'.*, '.$this->pasfasesTable.'.id_fases, '.$this->pasTable.'.lote');
	    	$this->db->from($this->table);
	    	$this->db->join($this->pasfasesTable, $this->pasfasesTable.'.id = '.$this->table.'.id_pas_fases', 'inner');
	    	$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->pasfasesTable.'.id_pas', 'inner');
	    	
	    	$this->db->where($this->table.'.id_financeiro_medicoes', $id_financeiro_medicoes);
	    	
	    	if($order){
	    		$this->db->order_by($order, $order_type);
	    	}else{
	    		$this->db->order_by('lote', $order_type);
	    		$this->db->order_by('id', $order_type);
	    	}
	    	 
	    	$query = $this->db->get();
	    	
	    	//$this->PQUERY();
	    	
	    	return $query->result_array();
	    }
    	
	    /**
	    * Count the number of rows
	    * @param int $search_string
	    * @param int $order
	    * @return int
	    */
	    function count_medicoes_pas_fases($search_string=null, $order=null)
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
	    function store_medicoes_pas_fases($data)
	    {
	    	return $this->insert_query($data);
		}
		
		/**
		 * Store the new item into the database
		 * @param array $data - associative array with data to store
		 * @return boolean
		 */
		function store_medicoes_pas_fases_bacth($data)
		{
			$this->db->trans_start();
				$this->db->insert_batch($this->table, $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return false;
			}else{
				return true;
			}
		}
    	
    	/**
	    * Update medicoes_pas_fases
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_medicoes_pas_fases($id, $data)
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
	    * Delete medicoes_pas_fases
	    * @param int $id - medicoes_pas_fases id
	    * @return boolean
	    */
		function delete_medicoes_pas_fases($id){
			$this->delete_query($id); 
		}
		
		function get_all_aproved_by_base_date($id_contrato = null, $base_date = null){
			$query =  "select 
							pas.lote,
							fases.*,
							pas_fases.id as id_pas_fases,
							subfases.id as id_subfase,
							subfases.titulo as subfase
							--pas_fases.*
							from pas_fases 
							inner join pas on (pas_fases.id_pas = pas.id)
							inner join fases on (pas_fases.id_fases = fases.id)
							left join subfases on (subfases.id_fases = fases.id)
								
							where pas_fases.id IN (
								select 
									t.id_pas_fases
									--,max(t.data_protocolo)
								
						
									from	(
						
										select 	pas.lote, 
											pas_fases.*,
											pas_fases_movimentacao.*
											from pas 
											inner join pas_fases on(pas_fases.id_pas = pas.id)
											inner join pas_fases_movimentacao on (pas_fases_movimentacao.id_pas_fases = pas_fases.id)
						
											where 
												--pas.id = 8 AND
												id_contrato = ".$id_contrato." AND
												pas_fases_movimentacao.id_status > 5  AND
												pas_fases_movimentacao.id_status <= 7  AND
												pas_fases_movimentacao.data_protocolo <=  '".$base_date." 23:59:59'
											ORDER BY pas_fases.id
									) t
									group by t.id_pas_fases
							)
							AND
								
								pas_fases.id NOT IN (
							
									select id_pas_fases from medicoes_pas_fases
								)
														
							order by pas_fases.id, fases.id, subfases.id;";
			
			//$this->debugMark($query);
			
			$result = $this->exec_query($query);
			
			return $result;
			
		}
}