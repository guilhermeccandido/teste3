<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_fasesdao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_fases';
    
    	var $pasTable = null;
		var $fasesTable = null;
		var $prioridadeTable = null;
		var $prazosTable = null;
		var $prazosFasesTable = null;
		var $pasLocalizacaoTable = null;
		var $localExecucao = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas_fases';
	        $this->pasTable = 'pas';
	        $this->fasesTable = 'fases';
	        $this->prioridadeTable = 'prioridades';
	        $this->prazosTable = 'pas_prazos';
	        $this->prazosFasesTable = 'pas_prazos_fases';
	        $this->pasLocalizacaoTable= 'pas_localizacao';
	        $this->localExecucao = 'local_execucao';
	    }
    	
    	/**
	    * Get pas_fases by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_fases_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas_fases data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_fases($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_pas_fases($search_string=null, $order=null)
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
	    function store_pas_fases($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update pas_fases
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_fases($id, $data)
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
	    * Delete pas_fases
	    * @param int $id - pas_fases id
	    * @return boolean
	    */
		function delete_pas_fases($id){
			$this->delete_query($id); 
		}

    	function get_fases_not_related_pas_by_id_pas($id, $id_fases = null){
    		
    		 $query = 'select '.$this->fasesTable.'.*
					from '.$this->fasesTable.'
					where
					'.$this->fasesTable.'.id NOT IN (
						select '. $this->table.'.id_fases from '. $this->table.' 
							where  '. $this->table.'.id_pas = '.$id.'  
					)  AND
    				'.$this->fasesTable.'.id IN (select '. $this->prazosFasesTable.'.id_fases  from '.$this->prazosFasesTable.' where 
    					'.$this->prazosFasesTable.'.id_pas_prazos  = (select id_pas_prazos from '.$this->pasTable.' where '.$this->pasTable.'.id = '.$id.' ))';
			
			if($id_fases){
				$query .= 'OR
						'.$this->fasesTable.'.id = '.$id_fases;
			}
				$query .= '	order by '.$this->fasesTable.'.demanda asc,  '.$this->fasesTable.'.grupo asc';
			
				//echo $query;
				
				//die;
			return $this->exec_query($query);
			
		}

    	function get_pas_fases_by_id_pas($id, $ativo = null){
    			
    		$this->db->select($this->table.'.*, '
    				.$this->fasesTable.'.titulo as fases,'
					.$this->fasesTable.'.grupo, '
    				.$this->fasesTable.'.subfases, '
    				.$this->pasTable.'.lote, '
    				.$this->pasTable.'.id_contrato, '
    				.$this->prioridadeTable.'.titulo as prioridade, '
    				.$this->prioridadeTable.'.classe '
			 );
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->join($this->prioridadeTable, $this->prioridadeTable.'.id = '.$this->table.'.id_prioridade ', 'inner');
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->table.'.id_pas ', 'inner');
    		
    		$this->db->where($this->table.'.id_pas', $id);
    		if($ativo){
    			$this->db->where($this->table.'.ativo', $ativo);
    		}
    		$this->db->order_by($this->fasesTable.'.grupo, '.$this->fasesTable.'.titulo ASC');
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    			
    	}
    	
    	function get_pas_fases_by_id_responsavel($id, $ativo = null){
    		 
    		$this->db->select($this->table.'.*, '
    				.$this->fasesTable.'.titulo as fases,'
    				.$this->fasesTable.'.grupo, '
    				.$this->pasTable.'.lote, '
    				.$this->prioridadeTable.'.titulo as prioridade, '
    				.$this->prioridadeTable.'.classe '
    				);
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->join($this->prioridadeTable, $this->prioridadeTable.'.id = '.$this->table.'.id_prioridade ', 'inner');
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->table.'.id_pas ', 'inner');
    		$this->db->where($this->table.'.id_responsavel', $id);
    		if($ativo){
    			$this->db->where($this->table.'.ativo', $ativo);
    		}
    		$this->db->order_by($this->prioridadeTable.'.peso DESC, '.$this->fasesTable.'.titulo ASC');
    		$query = $this->db->get();
    	
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		 
    	}
    	
    	function get_pas_fases_localizacao($ativo = null){
    		
    		$this->db->select($this->table.'.*, '
    				.$this->fasesTable.'.titulo as fases,'
    				.$this->fasesTable.'.grupo, '
    				.$this->fasesTable.'.subfases, '
    				.$this->pasTable.'.lote, '
    				.$this->prioridadeTable.'.titulo as prioridade, '
    				.$this->prioridadeTable.'.classe, '
    				.$this->localExecucao.'.titulo as local_execucao'
    				);
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->join($this->prioridadeTable, $this->prioridadeTable.'.id = '.$this->table.'.id_prioridade ', 'inner');
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->table.'.id_pas ', 'inner');
    		$this->db->join($this->localExecucao , $this->localExecucao.'.id = '.$this->pasTable.'.id_local_execucao ', 'inner');
    		
    		//$this->db->where($this->table.'.id_pas', $id);
    		if($ativo){
    			$this->db->where($this->table.'.ativo', $ativo);
    		}
    		$this->db->order_by(
    					 $this->localExecucao.'.id asc, '
    					.$this->table.'.id_responsavel asc, '
    					.$this->prioridadeTable.'.peso DESC, '
    					.$this->fasesTable.'.titulo ASC'
    		);
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		
    	}
    	
    	function get_pas_fases_all( $ativo = null){
    		 
    		$this->db->select($this->table.'.*, '
    				.$this->fasesTable.'.titulo as fases,'
    				.$this->fasesTable.'.grupo, '
    				.$this->pasTable.'.lote, '
    				.$this->prioridadeTable.'.titulo as prioridade, '
    				.$this->prioridadeTable.'.classe '
    				);
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->join($this->prioridadeTable, $this->prioridadeTable.'.id = '.$this->table.'.id_prioridade ', 'inner');
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->table.'.id_pas ', 'inner');
    	
    		//$this->db->where($this->table.'.id_pas', $id);
    		if($ativo){
    			$this->db->where($this->table.'.ativo', $ativo);
    		}
    		$this->db->order_by($this->prioridadeTable.'.peso DESC, '.$this->fasesTable.'.titulo ASC');
    		$query = $this->db->get();
    	
    		return $query->result_array();
    		 
    	}
    	
    	function count_pas_fases_by_id_pas($id, $ativo = null){
    		 
    		$this->db->select($this->table.'.id ');
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_pas', $id);
    		if($ativo){
    			$this->db->where($this->table.'.ativo', $ativo);
    		}
    		
    		$query = $this->db->get();
			return $query->num_rows();  
    		 
    	}
    	
    	function get_pas_fases_by_id_contrato($id, $ativo = null){
    		 
    		$this->db->select($this->table.'.*, '
    				.$this->fasesTable.'.titulo as fases,'
    				.$this->fasesTable.'.grupo, '
    				.$this->pasTable.'.lote, '
    				.$this->prioridadeTable.'.titulo as prioridade, '
    				.$this->prioridadeTable.'.classe '
    				);
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->join($this->prioridadeTable, $this->prioridadeTable.'.id = '.$this->table.'.id_prioridade ', 'inner');
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->table.'.id_pas ', 'inner');
    		 
    		//$this->db->where($this->table.'.id_pas', $id);
    		if($ativo){
    			$this->db->where($this->table.'.ativo', $ativo);
    		}
    		$this->db->where($this->pasTable.'.id_contrato', $id);
    		$this->db->order_by($this->prioridadeTable.'.peso DESC, '.$this->fasesTable.'.titulo ASC');
    		$query = $this->db->get();
    		 
    		return $query->result_array();
    		 
    	}
    	
    	// TODO :  NOT USED
    	function get_progresso_total_by_id_pas($id){
    		/*
    		$query = 'select round((sum(progresso) / count(*)), 2 ) as progresso 
						from '.$this->table.' 
							where id_pas = '.$id.' ;';
    		
    		return $this->exec_query($query);
    		*/
    		
    		$this->db->select("round((sum(progresso) / count(*)), 2 ) as progresso", FALSE);
    		$this->db->from($this->table);
    		$this->db->where($this->table.".id_pas",$id );
    		
    		$query = $this->db->get();
    		
    		return $query->result_array();
    		
    	}
    	
    	//TODO :  NOT USED
    	function get_data_ini_progresso_total_by_id_pas($id){
    		$query = 'select min(data_ini) as data_ini
						from '.$this->table.'
							where id_pas = '.$id.' ;';
    		
    		return $this->exec_query($query);
    		
    	}
    	//TODO :  NOT USED
    	function get_data_fim_progresso_total_by_id_pas($id){
    		$query = 'select max(data_fim) as data_fim
						from '.$this->table.'
							where id_pas = '.$id.' ;';
    	
    		return $this->exec_query($query);
    	
    	}
    	 
    	function get_data_fim_planejada_by_id_pas($id){
    		 
    		$this->db->select_max($this->table.".data_fim_planejada", "data_fim_planejada");
    		$this->db->from($this->table);
    		$this->db->where($this->table.".id_pas",$id );
    		
    		$query = $this->db->get();
    		
    		return $query->result_array();
    		 
    	}
    	
    	function get_data_ini_planejada_by_id_pas($id){
    		 
    		$this->db->select_min($this->table.".data_ini_planejada", "data_ini_planejada");
    		$this->db->from($this->table);
    		$this->db->where($this->table.".id_pas",$id );
    	
    		$query = $this->db->get();
    	
    		return $query->result_array();
    		 
    	}
    	
    	function get_last_date_inserted_by_id_pas_grupo($id_pas, $grupo){
    		/*
    		$query = 'Select max('.$this->table.' .data_fim_planejada) as data_fim_atividade		  
						from '.$this->table.' 
							inner join '.$this->fasesTable.
							' on ('.$this->fasesTable.'.id = '.$this->table.'.id_fases)
							where 
								id_pas = '.$id_pas.' and
								grupo = '.grupo.'
							group by grupo	; ';
    		
    		return $this->exec_query($query);
    		*/
    		$this->db->select_max($this->table.".data_fim_planejada", "data_fim_atividade");
    		$this->db->from($this->table);
    		$this->db->join($this->fasesTable, $this->fasesTable.".id = ".$this->table.".id_fases", "inner" );
    		
    		$this->db->where($this->table.".id_pas",$id_pas );
    		$this->db->where($this->fasesTable.".grupo ", "'".$grupo."'" );
    		$this->db->group_by($this->fasesTable.".grupo");
    		
    		$query = $this->db->get();
    		
    		return $query->result_array();
    	}
    	
    	function get_last_date_inserted_by_id_pas_grupo_edital($id_pas, $grupo){
    		/*
    		$query = 'Select max('.$this->table.' .data_fim) as data_fim_atividade
						from '.$this->table.'
							inner join '.$this->fasesTable.
    								' on ('.$this->fasesTable.'.id = '.$this->table.'.id_fases)
							where
								id_pas = '.$id_pas.' and
								grupo = '.$grupo.'
							group by grupo	; ';
    	
    		return $this->exec_query($query);
    		
    		*/
    		$this->db->select_max($this->table.".data_fim", "data_fim_atividade");
    		$this->db->from($this->table);
    		$this->db->join($this->fasesTable, $this->fasesTable.".id = ".$this->table.".id_fases", "inner" );
    		
    		$this->db->where($this->table.".id_pas",$id_pas );
    		$this->db->where($this->fasesTable.".grupo ", "'".$grupo."'" );
    		$this->db->group_by($this->fasesTable.".grupo");
    		
    		$query = $this->db->get();
    		
    		return $query->result_array();
    	}
    	
    	
		// TODO FUNCTION OK    	
    	function get_dias_corridos_by_id_pas($id_pas){
    		
    		$query = 'select sum( prazo) as total_dias from
						(
							Select max('.$this->table.' .prazo) as prazo 	  
							from '.$this->table.'  
								inner join '.$this->fasesTable.
								' on ('.$this->fasesTable.'.id = '.$this->table.' .id_fases)
								where 
									id_pas = '.$id_pas.'
								group by grupo	) t ;';
    		
    		return $this->exec_query($query);
    				
    	}
    	
    	function get_last_data_planejada_by_id_pas($id_pas){
    		$this->db->select('max('.$this->table.'.data_fim_planejada)');
    		$this->db->from($this->table);
    		$this->db->where($this->table.".id_pas",$id_pas );
    		$query = $this->db->get();
    		
    		return $query->result_array();
    		
    	}
    	
    	function get_pas_fases_by_contrato( $arrayContratos ){
    		//$this->debugMark('teset', $arrayContratos);
    		
    		$this->db->select($this->table.'.*, '
    				.$this->fasesTable.'.titulo as fases,'
    				.$this->fasesTable.'.grupo, '
    				.$this->pasTable.'.lote, '
    				.$this->prioridadeTable.'.titulo as prioridade, '
    				.$this->prioridadeTable.'.classe '
    				);
    		$this->db->from($this->fasesTable);
    		$this->db->join($this->table, $this->table.'.id_fases = '.$this->fasesTable.'.id ', 'inner');
    		$this->db->join($this->prioridadeTable, $this->prioridadeTable.'.id = '.$this->table.'.id_prioridade ', 'inner');
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->table.'.id_pas ', 'inner');
    		
    		$first = true;
    		foreach($arrayContratos as $item){
    			if($first){
    				$this->db->where($this->pasTable.'.id_contrato', $item['id_contratos']);
    				$first = false;
    			}else{
    				$this->db->or_where($this->pasTable.'.id_contrato', $item['id_contratos']);
    			}
    		}
    		$this->db->order_by($this->prioridadeTable.'.peso DESC, '.$this->fasesTable.'.titulo ASC, '.$this->pasTable.'.id_contrato ASC, '.$this->pasTable.'.lote ASC ');
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		
    		return $query->result_array();
    		
    	}
    	
    	
}