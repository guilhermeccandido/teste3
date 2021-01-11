<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pasdao extends App_DAO {
const VIEW_FOLDER = 'admin/pas';
    	
		public $pasFasesTable = null;
    	public $fasesTable = null;
    	public $prazosFasesTable = null;
    	public $movimentacaoTable = null;
    	public $statusTable = null;
    	public $contratosTable = null;
    	 
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas';
	        $this->pasFasesTable = 'pas_fases';
	        $this->fasesTable = 'fases';
	        $this->prazosFasesTable = 'pas_prazos_fases';
	        $this->movimentacaoTable = 'pas_fases_movimentacao';
	        $this->statusTable = 'status';
	        $this->contratosTable = 'contratos';
	        $this->trechosTable = 'pas_trechos';
	        
	    }
    	
    	/**
	    * Get pas by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch pas data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
	    {
	    	
			$this->db->select('*');
			$this->db->from($this->table);
	
			if($search_string){
				$this->db->like('titulo', $search_string);
			}
			$this->db->group_by('id');
	
			$this->db->_protect_identifiers = false;
			
			if($order){
				if($order == 'lote'){
					$this->db->order_by(" CASE WHEN lote >= 'A' THEN lote ELSE to_char(to_number(lote, '9999'),'0000') END" );
				}else{
					$this->db->order_by($order, $order_type);
				}
				
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
	    function count_pas($search_string=null, $order=null)
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
	    function store_pas($data)
	    {
	    	$this->db->trans_start();
	    	
	    	unset($data['id']);
	    	$result = $this->db->insert($this->table, $data);
	    	$id_pas = $this->db->insert_id();
	    	
	    	$this->db->trans_complete();

	    	return $id_pas;
		}
    	
    	/**
	    * Update pas
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas($id, $data)
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
	    * Delete pas
	    * @param int $id - pas id
	    * @return boolean
	    */
		function delete_pas($id){
			$this->delete_query($id); 
		}
		
		function get_all_fases(){
			
		// TODO : RETIRAR OS EXEC_QUERY;	
			 $query='select '
						 .$this->table.'.id as id, '
						 .$this->table.'.titulo as titulo, ' 
						 .$this->pasFasesTable.'.progresso, '
						 .$this->pasFasesTable.'.status, '
						 .$this->pasFasesTable.'.data_ini, ' 
						 .$this->pasFasesTable.'.data_fim, '
						 .$this->fasesTable.'.titulo as fases 
					from '.$this->table.'
					inner join '.$this->pasFasesTable.' 
						on ('.$this->table.'.id = '.$this->pasFasesTable.'.id_pas)
								
					inner join '.$this->fasesTable.' 	
						on ('.$this->fasesTable.'.id = '.$this->pasFasesTable.'.id_fases)	
								
					where '.$this->pasFasesTable.'.ativo = "ativo"';
			
			return $this->exec_query($query);
			
		}
		
		function get_prazo_by_id_pas_id_fase($id, $id_fase){
			
			$this->db->select($this->prazosFasesTable.'.prazo');
			$this->db->from($this->table);
			$this->db->join($this->prazosFasesTable, $this->table.'.id_pas_prazos = '.$this->prazosFasesTable.'.id_pas_prazos', 'inner');
			$this->db->where($this->table.'.id', $id);
			$this->db->where($this->prazosFasesTable.'.id_fases', $id_fase);
				
			//$this->PQUERY();
			//die;
			
			$query = $this->db->get();
			return $query->result_array();
			
		}
		
		
		function get_cronograma_atividade_by_pas($id){
			
			/*
			
			$query = "select 
						CONCAT( 'Atividade ', ".$this->fasesTable.".grupo) as atividade,
					 	min(".$this->pasFasesTable.".data_ini) as data_contratada,
						min(".$this->pasFasesTable.".data_ini_planejada) as data_planejada,								
					 	max(".$this->pasFasesTable.".data_fim) as data_fim_contratada,
						max(".$this->pasFasesTable.".data_fim_planejada) as data_fim_planejada,								
						min(". $this->movimentacaoTable.".data_protocolo) as start_movement,
						max(". $this->movimentacaoTable.".data_protocolo) as last_movement,
						max(".$this->statusTable.".peso) as peso 
					from ".$this->pasFasesTable." 
						inner join ".$this->fasesTable." 
									ON (".$this->fasesTable.".id = ".$this->pasFasesTable.".id_fases)
						left join ". $this->movimentacaoTable." 
									ON (". $this->movimentacaoTable.".id_pas_fases = ".$this->pasFasesTable.".id)
						left join ".$this->statusTable."
									ON (".$this->statusTable.".id = ". $this->movimentacaoTable.".id_status)
					where ".$this->pasFasesTable.".id_pas = ".$id."
						group by ".$this->fasesTable.".grupo 
						order by ".$this->fasesTable.".grupo ASC";
			//die;
			 /return $this->exec_query($query);
			 */
			
			$this->db->select("CONCAT( 'Atividade ', ".$this->fasesTable.".grupo ) as atividade", FALSE);
			$this->db->select_min($this->pasFasesTable.".data_ini", "data_contratada");
			$this->db->select_min($this->pasFasesTable.".data_ini_planejada", "data_planejada");
			
			$this->db->select_max($this->pasFasesTable.".data_fim", "data_fim_contratada");
			$this->db->select_max($this->pasFasesTable.".data_fim_planejada", "data_fim_planejada");
			
			$this->db->select_min($this->movimentacaoTable.".data_protocolo", "start_movement");
			$this->db->select_max($this->movimentacaoTable.".data_protocolo", "last_movement");
			
			$this->db->select_max($this->statusTable.".peso", "peso");
			
			$this->db->from($this->pasFasesTable);
			$this->db->join($this->fasesTable, $this->fasesTable.".id = ".$this->pasFasesTable.".id_fases", 'inner');
			$this->db->join($this->movimentacaoTable, $this->movimentacaoTable.".id_pas_fases = ".$this->pasFasesTable.".id", "left");
			$this->db->join($this->statusTable, $this->statusTable.".id = ". $this->movimentacaoTable.".id_status", "left");
			
			$this->db->where($this->pasFasesTable.".id_pas", $id);
			$this->db->group_by($this->fasesTable.".grupo");
			$this->db->order_by($this->fasesTable.".grupo", "ASC");
			
			//$this->PQUERY();
			//die;
			
			$query = $this->db->get();
			return $query->result_array();
			
			
		}
		
		
		public function get_contratos_pas(){
			
			$this->db->select($this->contratosTable.'.id, '.$this->contratosTable.'.contrato');
			$this->db->from($this->table);
			$this->db->join($this->contratosTable, $this->table.'.id_contrato = '.$this->contratosTable.'.id', 'inner' );
			$this->db->group_by($this->contratosTable.'.id, '.$this->contratosTable.'.contrato');
			$this->db->order_by($this->contratosTable.'.contrato');
			$query = $this->db->get();
			
			//$this->PQUERY();
			
			return $query->result_array();
			
		}

		
		/**
		 * Fetch pas data from the database
		 * possibility to mix search, filter and order
		 * @param integer $id_contrato
		 * @param strong $order
		 * @return array
		 */
		public function get_pas_by_id_contrato($id_contrato=null, $order=null, $order_type='Asc')
		{
		
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where($this->table.'.id_contrato', $id_contrato);		
		
			if($order){
				$this->db->order_by($order, $order_type);
			}else{
				$this->db->order_by('id', $order_type);
			}
		
			 
			$query = $this->db->get();
			
			//$this->PQUERY();
			
			return $query->result_array();
		}
		
		public function count_pas_by_id_contrato($id_contrato)
		{
			
			$this->db->_protect_identifiers = false;
			
			$this->db->select($this->table.'.id, '.$this->trechosTable.'.extensao');
			$this->db->from($this->table);
			$this->db->join($this->pasFasesTable, $this->pasFasesTable.'.id_pas = '.$this->table.'.id', 'inner');
			$this->db->join($this->trechosTable, $this->trechosTable.'.id_pas = '.$this->table.'.id', 'left');
			$this->db->join($this->movimentacaoTable, $this->pasFasesTable.'.id = '.$this->movimentacaoTable.'.id_pas_fases', 'inner');
			$this->db->where($this->table.'.id_contrato', $id_contrato);
			$this->db->group_by($this->table.'.id, '.$this->trechosTable.'.extensao');
			
			$select1 = $this->db->get_compiled_select();
			
			$this->db->_protect_identifiers = false;
			
			$this->db->select('sum(extensao)');
			$this->db->from('(' .$select1.') as select1');
			$this->db->group_by('id');
			
			$query = $this->db->get();
			$arr = $query->result_array();
			$sum = 0;
			foreach($arr as $item){
				$sum += $item['sum'];
			}
			
			//$this->PQUERY();
			return array('count' => $query->num_rows(), 'extensao' => $sum );
			
		}
		
		/**
		 * Coleta lista de evteas relacionados ao usuário
		 * @param integer $id_responsavel
		 * @return array
		 */
		public function get_pas_by_id_responsavel($id_responsavel){
			
			$this->semAspas();
			
			$this->db->select($this->table.'.*');
			$this->db->from($this->table);
			$this->db->join($this->pasFasesTable,$this->pasFasesTable.'.id_pas = '.$this->table.'.id', 'inner' );
			$this->db->where($this->table.'.id_responsavel', $id_responsavel);
			$this->db->or_where($this->pasFasesTable.'.id_responsavel', $id_responsavel);
			$this->db->group_by($this->table.'.id');
			$this->db->order_by("CASE WHEN pas.lote >= 'A' THEN pas.lote ELSE to_char(to_number(pas.lote, '9999'),'0000') END");
			
			$query = $this->db->get();
			
			//$this->PQUERY();
			
			return $query->result_array();
		}
		
		public function get_pas_contrato_executora(){
			
			$this->db->select(
					$this->table.'.id, '.
					$this->table.'.ordem_servico, '.
					$this->table.'.lote, '.
					$this->table.'.status, '.
					$this->contratosTable.'.contrato, '.
					$this->contratosTable.'.executora,'.
					$this->table.'.data_ini_pas, '.
					$this->table.'.data_ini_planejada'
					);
			$this->db->from($this->table);
			$this->db->join($this->contratosTable, $this->contratosTable.'.id = '.$this->table.'.id_contrato', 'inner' );
			$this->db->order_by($this->table.'.lote');
			
			$query = $this->db->get();
			
			//$this->PQUERY();
			
			return $query->result_array();
			
		}
		
		public function get_planejado_executado(){
			$query = "select 
							pas.id,pas.lote,pas.id_contrato,
							min(fases.data_ini_planejada) dt_inicio_plan,
							max(fases.data_fim_planejada) dt_fim_plan,
							min(ini_exec.dt_inicio_execucao) dt_inicio_execucao,
							concluido.case 
					 from pas
						left join pas_fases fases
							on pas.id = fases.id_pas
						left join pas_fases_movimentacao mov
							on mov.id_pas_fases = fases.id
						left join (select id,id_pas_fases,id_status,min(data_protocolo) as dt_inicio_execucao from pas_fases_movimentacao
					where id_status = 1
					group by id,id_pas_fases,id_status
					order by id_status) ini_exec
						on ini_exec.id_pas_fases = fases.id
						left join (
							select pas.lote,case when count(id_status) = 11 then max(data_protocolo) end from pas_fases_movimentacao mov
								left join pas_fases
									on pas_fases.id = mov.id_pas_fases
								left join pas
									on pas.id = pas_fases.id_pas
							where mov.id_status = 7
							group by lote) concluido
								on concluido.lote = pas.lote
						group by pas.id,pas.lote,concluido.case
						order by  CASE WHEN pas.lote >= 'A' THEN pas.lote ELSE to_char(to_number(pas.lote, '9999'),'0000') END";
			
			return $this->exec_query($query);
			
		}
		
		// TODO : ADICIONAR FLAG DE APTO A SER MEDIDO 
		public function get_medido_periodo($data_ini, $data_fim){
			$query = "select id_pas_fases, min(id_status) as id_status, min(data_protocolo)
						from
						pas_fases_movimentacao
						where
						date(data_protocolo) >= '".$data_ini."'
								AND date(data_protocolo) <= '".$data_fim."'
										AND id_status >= 6
										AND id_status <= 7
										group by id_pas_fases
										order by id_pas_fases, id_status;";
				
			return $this->exec_query($query);
				
		}
		
		public function check_racp($id_pas_fases){
			$query = "select count(*) from pas_fases_movimentacao where id_pas_fases = ".$id_pas_fases." and id_status = 6;";
			
			$arrayResult = $this->exec_query($query);
			if($arrayResult[0]['count'] > 0){
				return true;
			}else{
				return false;	
			}
			
		}
		
		 public function get_medido_by_id_pas_fases_id_status($id_pas_fases, $id_status){
		 	
		 	$query = "select pas.lote, fases.titulo, status.titulo as status, data_protocolo, pas_fases_movimentacao.descricao
					 	from pas_fases_movimentacao
						 	inner join pas_fases on( pas_fases_movimentacao.id_pas_fases = pas_fases.id)
						 	inner join pas on( pas_fases.id_pas = pas.id)
						 	inner join fases on( pas_fases.id_fases = fases.id)
						 	inner join status on (pas_fases_movimentacao.id_status = status.id)
					 	where id_pas_fases = ".$id_pas_fases." and id_status = ".$id_status.";";
		 	
		 	return $this->exec_query($query);
		 }
		
		 public function get_pas_by_contrato($arrayContrato)
		 {
		 	
		 	if(sizeof($arrayContrato) > 0 ){
			 		
			 	$this->db->select('*');
			 	$this->db->from($this->table);
			 	//$this->debugMark('', $arrayContrato);
			 	
			 	$first = true;
			 	foreach($arrayContrato as $item)
			 	{
			 		if($first){
			 			$first = false;
			 			$this->db->where($this->table.'.id_contrato', $item['id_contratos']);
			 		}else{
			 			$this->db->or_where($this->table.'.id_contrato', $item['id_contratos']);
			 		}
			 	}
			 	
			 	$this->db->order_by($this->table.'.id', 'asc');
			 	
			 	$query = $this->db->get();
			 	
			 	return $query->result_array();
		 	}else{
		 		return array();
		 	}
		 }  
		 
}




