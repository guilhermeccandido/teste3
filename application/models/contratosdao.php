<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class contratosdao extends App_DAO {

	const VIEW_FOLDER = 'admin/contratos';
    	
		public $contratosOrcamentoTable = null;
		public $contratosMedicoesTable = null;
		public $pasTable = null;
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'contratos';
	        $this->contratosOrcamentoTable = 'controle_orcamento';
	        $this->contratosMedicoesTable = 'contratos_medicoes';
	        $this->pasTable = 'pas';
	    }
    	
    	/**
	    * Get contratos by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_contratos_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch contratos data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_contratos($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
	    {
		    
			$this->db->select('*');
			$this->db->from($this->table);
	
			if($search_string){
				$this->db->like('contrato', $search_string);
			}
			$this->db->group_by('id');
	
			if($order){
				$this->db->order_by($order, $order_type);
			}else{
				$this->db->order_by('SUBSTRING( '.$this->table.'.contrato FROM \'.{4}$\') asc, '.$this->table.'.contrato asc' );
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
	    function count_contratos($search_string=null, $order=null)
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
    	
	    public function get_contratos_with_pas($order=null, $order_type='Asc')
	    {
	    
	    	$this->db->select($this->table.'.*');
	    	$this->db->from($this->table);
	    	$this->db->join($this->pasTable, $this->pasTable.'.id_contrato = '.$this->table.'.id', 'inner' );
	    
	    	
	    	if($order){
	    		$this->db->order_by($order, $order_type);
	    	}else{
	    		$this->db->order_by('id', $order_type);
	    	}
	    	 
	    	$query = $this->db->get();
	    		
	    	return $query->result_array();
	    }
	    
	    /**
	    * Store the new item into the database
	    * @param array $data - associative array with data to store
	    * @return boolean 
	    */
	    function store_contratos($data)
	    {
	    	return $this->insert_query($data);
		}
    	
		function store_contratos_medicoes($data)
		{
			unset($data['id']);
	    	$result = $this->db->insert($this->contratosMedicoesTable, $data);
	    	return $result;
		}
		
		
		function store_contratos_empenhos($data)
		{
			unset($data['id']);
			$result = $this->db->insert('contratos_empenhos', $data);
			return $result;
		}
		
    	/**
	    * Update contratos
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_contratos($id, $data)
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
    	
		
		public function get_contratos_not_included()
		{
		
			$query = 'select '.$this->table.'.id,   
							 '.$this->table.'.contrato 
						from '.$this->table.'
						where
						'.$this->table.'.contrato NOT IN (
							select contratos_relacoes.contrato from contratos_relacoes
								group by contratos_relacoes.contrato
								order by contratos_relacoes.contrato
						)
					   group by '.$this->table.'.contrato  
					   order by '.$this->table.'.contrato ';
			
				
			return $this->exec_query($query);
			
		}
		
		
		
		
	    /**
	    * Delete contratos
	    * @param int $id - contratos id
	    * @return boolean
	    */
		function delete_contratos($id){
			$this->delete_query($id); 
		}  

		
		function get_contratos_distinct(){
			
			$query = 'select distinct(contrato)
						from '.$this->table.' ;';
			return $this->exec_query($query);
		
		}
		
		// CONSULTA PARA VALORES DE COORDENACAO GERAL
		function get_valor_medido_acumulado_pi_r(){
			$query = 'select ROUND( (SUM(valor_medido_pi) + 
									SUM(contratos_medicoes.valor_medido_pi_r))::numeric, 2) as valor_medido_acumulado_pi_r
						from contratos_medicoes
							inner join contratos_relacoes ON ( contratos_relacoes.contrato = contratos_medicoes.contrato )
									where contratos_relacoes.coordenacao_geral = 1;';
			return $this->exec_query($query);
			
		}
		
		function get_valor_contratado(){
			$query = 'select 
						ROUND( SUM(contratos.valor_contrato)::numeric, 2) as valor_contrato 
							from contratos 
						inner join contratos_relacoes ON ( contratos_relacoes.contrato = contratos.contrato )
							where contratos_relacoes.coordenacao_geral = 1;';
			return $this->exec_query($query);
		}
		
		function get_valor_medido_mes_corrente(){
			$query = 'select ROUND( (SUM(valor_medido_pi) + SUM(valor_medido_pi_r))::numeric,2) as valor_medido_pi
							from contratos_medicoes 
							where EXTRACT(YEAR FROM data_processamento_medicao) = EXTRACT(YEAR FROM now()) 
								AND EXTRACT(MONTH FROM  data_processamento_medicao) = EXTRACT(MONTH FROM now()); ';
			return $this->exec_query($query);
		}
		
		function get_valor_saldo_empenho(){
			$query = 'select ROUND( (SUM(contratos_empenhos.valor_empenho_inicial) - 
									SUM(contratos_empenhos.valor_empenho_consumido))::numeric, 2) as valor_saldo_empenho, 
							ROUND( SUM(contratos_empenhos.valor_empenho_inicial)::numeric, 2) as valor_empenhado
						from contratos_empenhos
							inner join contratos_relacoes ON ( contratos_relacoes.contrato = contratos_empenhos.contrato )
									where contratos_relacoes.coordenacao_geral = 1;';
			return $this->exec_query($query);
		}
		
		// FIM CONSULTA PARA VALORES COORDENACAO GERAL
		
		function get_valor_contratado_by_id_geral_setorial($id_geral = null, $id_setorial = null){
		
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = ' where contratos_relacoes.coordenacao_geral = 1 ';
			$where .= $id_setorial ? ' AND coordenacao_setorial.id = '.$id_setorial : ' ';
			$where .= ' group by coordenacao_setorial.id, coordenacao_setorial.titulo, coordenacao_setorial.alias  ';
			$query = 'select
						 coordenacao_setorial.id,
						 coordenacao_setorial.titulo as titulo ,
						 coordenacao_setorial.alias as alias,
						 ROUND(SUM(contratos.valor_contrato)::numeric,2) as valor_contrato
							from contratos_relacoes
							inner join coordenacao_setorial
								ON (coordenacao_setorial.id = contratos_relacoes.coordenacao_setorial)
							inner join contratos
								ON (contratos.contrato = contratos_relacoes.contrato)
							  '.$where.'
							order by coordenacao_setorial.titulo  ASC ';
			//die;
			return $this->exec_query($query);
		
		}
		
		// CONSULTA PARA VALORES DE COORDENACAO SETORIAL
		function get_valor_medido_acumulado_by_id_geral_setorial($id_geral = null, $id_setorial = null){
		
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = ' where contratos_relacoes.coordenacao_geral = 1 ';
			$where .= $id_setorial ? ' AND coordenacao_setorial.id = '.$id_setorial : '';
				
			$query = 'select
						 ROUND(
					 			(	SUM(contratos_medicoes.valor_medido_pi) +
					 				SUM(contratos_medicoes.valor_medido_pi_r)
								)::numeric,2 ) as valor_medido_acumulado_pi_r
							from contratos_relacoes
							inner join coordenacao_setorial
								ON (coordenacao_setorial.id = contratos_relacoes.coordenacao_setorial)
							inner join contratos_medicoes
								ON (contratos_medicoes.contrato = contratos_relacoes.contrato)
							  '.$where.'
							group by coordenacao_setorial.titulo 
							order by coordenacao_setorial.titulo  ASC ';
			return $this->exec_query($query);
		
		}
		
		// CONSULTA PARA VALORES DE COORDENACAO SETORIAL
		function get_valores_group_by_coordenacao_geral_or_by_id_coordenacao_setorial($id = null){
				
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = ' where contratos_relacoes.coordenacao_geral = 1 ';
			$where .= $id ? ' AND coordenacao_setorial.id = '.$id : ' group by coordenacao_setorial.titulo ';
			
			$query = 'select
						 coordenacao_setorial.id,
						 coordenacao_setorial.titulo as titulo ,
						 coordenacao_setorial.alias as alias,
						 ROUND(SUM(contratos.valor_contrato)::numeric,2) as valor_contrato,
						 ROUND(
						 			(	SUM(contratos_medicoes.valor_medido_pi) +
						 				SUM(contratos_medicoes.valor_medido_pi_r)
									)::numeric,2 ) as valor_medido_acumulado_pi_r
							from contratos_relacoes
							inner join coordenacao_setorial
								ON (coordenacao_setorial.id = contratos_relacoes.coordenacao_setorial)
							inner join contratos
								ON (contratos.contrato = contratos_relacoes.contrato)
							inner join contratos_medicoes
								ON (contratos_medicoes.contrato = contratos_relacoes.contrato)
							  '.$where.' 
							order by coordenacao_setorial.titulo  ASC ';
			return $this->exec_query($query);
				
		}
		
		function get_n_contratos_by_setorial($id){
				
			$query = 'select count(*) as n_contratos
						from contratos_relacoes
						 where coordenacao_setorial  = '.$id.'
						group by coordenacao_setorial ;';
			return $this->exec_query($query);
				
		}
		
		function get_valor_medido_mes_corrente_by_setorial($id){
			
			// AND Month(data_processamento_medicao) = Month(now()) 
			
			$query = 'select ROUND( (SUM(valor_medido_pi) + SUM(valor_medido_pi_r))::numeric,2) as valor_medido_pi
											from contratos_medicoes
												inner join contratos_relacoes
													ON ( contratos_medicoes.contrato = contratos_relacoes.contrato)
											where EXTRACT(YEAR FROM data_processamento_medicao) = EXTRACT(YEAR FROM now()) 
												AND EXTRACT(MONTH FROM data_processamento_medicao) = EXTRACT(MONTH FROM now()) 
												AND contratos_relacoes.coordenacao_setorial = '.$id ;
			return $this->exec_query($query);
		}
		
		function get_valor_saldo_empenho_by_setorial($id){
			
			$query = 'select ROUND( (SUM(contratos_empenhos.valor_empenho_inicial) -
									SUM(contratos_empenhos.valor_empenho_consumido))::numeric, 2) as valor_saldo_empenho, 
							ROUND( SUM(contratos_empenhos.valor_empenho_inicial)::numeric, 2) as valor_empenhado
						from contratos_empenhos
										inner join contratos_relacoes
											ON ( contratos_empenhos.contrato = contratos_relacoes.contrato)
									where contratos_relacoes.coordenacao_setorial = '.$id ;
			
			return $this->exec_query($query);
		}
		
		function get_last_year_medido_mes_corrente_by_setorial($id_setorial){
				
			$query = "select coordenacao_setorial.titulo as titulo, 
					       CONCAT(EXTRACT(YEAR FROM contratos_medicoes.data_processamento_medicao) , '-' , EXTRACT(MONTH FROM contratos_medicoes.data_processamento_medicao), '-1')  as data, 
					       ROUND(SUM(contratos_medicoes.valor_medido_pi_r) + SUM(contratos_medicoes.valor_medido_pi) )::numeric as valor 
							from contratos_medicoes 
							inner join contratos_relacoes ON(contratos_relacoes.contrato = contratos_medicoes.contrato) 
							inner join coordenacao_setorial ON(contratos_relacoes.coordenacao_setorial = coordenacao_setorial.id) 
							where data_processamento_medicao > (CONCAT((EXTRACT(YEAR FROM Now())-1), '-' , EXTRACT(MONTH FROM Now()),'-1' ))::date 
							AND coordenacao_setorial = ".$id_setorial." 
							group by 1, 2
							 order by 1;";
			
				
			return $this->exec_query($query);
				
				
		}
		
		// FIM CONSULTA PARA VALORES COORDENACAO SETORIAL
		
		// CONSULTA PARA VALORES COORDENACAO PROGRAMAS
		
		function get_valor_contratado_by_coordenacao_setorial_or_by_id_programa($id_setorial, $id_programa = null){
			
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = ' where
						contratos_relacoes.coordenacao_geral = 1
						AND contratos_relacoes.coordenacao_setorial = '.$id_setorial;
			$where .= $id_programa ? ' AND programas.id = '.$id_programa : ' ';
			$where .= ' group by programas.id, programas.titulo, programas.alias ';
		
			$query = 'select
						 programas.id,
						 programas.titulo as titulo ,
						 programas.alias as alias,
						 ROUND(SUM(contratos.valor_contrato)::numeric,2) as valor_contrato
							from contratos_relacoes
							inner join programas
								ON (programas.id = contratos_relacoes.programa)
							inner join contratos
								ON (contratos.contrato = contratos_relacoes.contrato)
							  '.$where.'
							order by programas.titulo  ASC ';
			
			return $this->exec_query($query);
		}
		
		function get_valor_medido_acumulado_by_coordenacao_setorial_or_by_id_programa($id_setorial, $id_programa = null){
		
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = ' where
						contratos_relacoes.coordenacao_geral = 1
						AND contratos_relacoes.coordenacao_setorial = '.$id_setorial;
			$where .= $id_programa ? ' AND programas.id = '.$id_programa : ' ';
			$where .= ' group by programas.titulo ';
			
			$query = 'select
						 ROUND(
						 			(	SUM(contratos_medicoes.valor_medido_pi) +
						 				SUM(contratos_medicoes.valor_medido_pi_r)
									)::numeric,2 ) as valor_medido_acumulado_pi_r
							from contratos_relacoes
							inner join programas
								ON (programas.id = contratos_relacoes.programa)
							inner join contratos_medicoes
								ON (contratos_medicoes.contrato = contratos_relacoes.contrato)
							  '.$where.'
							order by programas.titulo  ASC ';
			//die;
			return $this->exec_query($query);
		}
		
		
		function get_valores_group_by_coordenacao_setorial_or_by_id_programa($id_setorial, $id_programa = null){
		
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = ' where 
						contratos_relacoes.coordenacao_geral = 1
						contratos_relacoes.coordenacao_setorial = '.$id_setorial; 
			$where .= $id_programa ? ' AND programas.id = '.$id_programa : ' group by programas.titulo ';
				
			$query = 'select
						 programas.id,
						 programas.titulo as titulo ,
						 programas.alias as alias,
						 ROUND(SUM(contratos.valor_contrato)::numeric,2) as valor_contrato,
						 ROUND(
						 			(	SUM(contratos_medicoes.valor_medido_pi) +
						 				SUM(contratos_medicoes.valor_medido_pi_r)
									)::numeric,2 ) as valor_medido_acumulado_pi_r
							from contratos_relacoes
							inner join programas
								ON (programas.id = contratos_relacoes.programa)
							inner join contratos
								ON (contratos.contrato = contratos_relacoes.contrato)
							inner join contratos_medicoes
								ON (contratos_medicoes.contrato = contratos_relacoes.contrato)
							  '.$where.' 	
							order by programas.titulo  ASC ';
			return $this->exec_query($query);
		}
		
		
		function get_n_contratos_by_programa($id){
		
			$query = 'select count(*) as n_contratos
					from contratos_relacoes
					 where programa  = '.$id.'
					group by programa ;';
			return $this->exec_query($query);
		
		}
		
		function get_valor_medido_mes_corrente_by_programa($id){
				
			// AND Month(data_processamento_medicao) = Month(now())
				
			 $query = 'select ROUND( SUM(valor_medido_pi)::numeric + SUM(valor_medido_pi_r )::numeric,2) as valor_medido_pi
										from contratos_medicoes
											inner join contratos_relacoes
												ON ( contratos_medicoes.contrato = contratos_relacoes.contrato)
										where EXTRACT(YEAR FROM data_processamento_medicao) = EXTRACT(YEAR FROM now())
											AND EXTRACT(MONTH FROM data_processamento_medicao) = EXTRACT(MONTH FROM now())
											AND contratos_relacoes.programa = '.$id ;
			//die;
			return $this->exec_query($query);
		}

		function get_valor_saldo_empenho_by_programa($id){
				
			 $query = 'select ROUND( SUM(contratos_empenhos.valor_empenho_inicial)::numeric -
									SUM(contratos_empenhos.valor_empenho_consumido)::numeric, 2) as valor_saldo_empenho, 
							ROUND( SUM(contratos_empenhos.valor_empenho_inicial)::numeric, 2) as valor_empenhado
						from contratos_empenhos
										inner join contratos_relacoes
											ON ( contratos_empenhos.contrato = contratos_relacoes.contrato)
									where contratos_relacoes.programa = '.$id ;
				
			return $this->exec_query($query);
		}
		
		function get_last_year_medido_mes_corrente_by_programa($id_programa){
			//echo 'get_last_year_medido_mes_corrente_by_programa';
			//die;	
			$query = 'select
						 programas.titulo as titulo,
						 CONCAT(
							EXTRACT(YEAR FROM contratos_medicoes.data_processamento_medicao), \'-\',
						 	EXTRACT(MONTH FROM contratos_medicoes.data_processamento_medicao), \'-1\'
						 ) as data,
						ROUND(SUM(contratos_medicoes.valor_medido_pi_r)::numeric +  SUM(contratos_medicoes.valor_medido_pi)::numeric ) as valor
						from contratos_medicoes
							inner join contratos_relacoes
								ON(contratos_relacoes.contrato = contratos_medicoes.contrato)
							inner join programas
								ON(contratos_relacoes.programa = programas.id)
							where data_processamento_medicao > (CONCAT( (EXTRACT(YEAR FROM Now())-1),\'-\',EXTRACT(MONTH FROM Now()),\'-1\'))::date 
									AND contratos_relacoes.programa = '.$id_programa.'
							group by
								programas.titulo, 
  								contratos_medicoes.data_processamento_medicao,
								EXTRACT(MONTH FROM contratos_medicoes.data_processamento_medicao),
								EXTRACT(YEAR FROM contratos_medicoes.data_processamento_medicao)
							order by data_processamento_medicao;';
			
			//die;
			return $this->exec_query($query);
			
				
				
		}
		
		
		// FIM CONSULTA PARA VALORES  PROGRAMAS
		
		// CONSULTA PARA VALORES DE CONTRATOS
		
		function get_valor_contratado_by_setorial_programa_or_by_id_contrato($id_setorial, $id_programa, $id_contrato = null){
		
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = $id_contrato ? ' AND contratos.id = '.$id_contrato : '';
				
			$query = 'select
						 contratos.id,
						 contratos.contrato as titulo ,
						 contratos.id as alias,
						 ROUND( (contratos.valor_contrato)::numeric,2 ) as valor_contrato
							from contratos_relacoes
							inner join contratos
								ON (contratos.contrato = contratos_relacoes.contrato)
							where
								contratos_relacoes.coordenacao_geral = 1
								AND contratos_relacoes.coordenacao_setorial = '.$id_setorial.' 
								AND contratos_relacoes.programa = '.$id_programa.'
							 '.$where.'
							group by 
							 		contratos.id,
							 		contratos.contrato
							order by titulo  ASC ';
			//die;
			return $this->exec_query($query);
		}
		
		function get_valor_medido_acumulado_by_setorial_programa_or_by_id_contrato($id_setorial, $id_programa, $id_contrato = null){
		
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = $id_contrato ? ' AND contratos.id = '.$id_contrato : '';
				
			$query = 'select
						 ROUND(
						 			(	SUM(contratos_medicoes.valor_medido_pi)::numeric +
						 				SUM(contratos_medicoes.valor_medido_pi_r)::numeric
									),2 ) as valor_medido_acumulado_pi_r
							from contratos_relacoes
							inner join contratos
								ON (contratos.contrato = contratos_relacoes.contrato)
							inner join contratos_medicoes
								ON (contratos_medicoes.contrato = contratos_relacoes.contrato)
							where 
								contratos_relacoes.coordenacao_geral = 1
								AND contratos_relacoes.coordenacao_setorial = '.$id_setorial.' 
								AND contratos_relacoes.programa = '.$id_programa.'
							 '.$where.'
							group by contratos.contrato';
			//die;
			return $this->exec_query($query);
		}
		
		function get_valores_group_by_coordenacao_programa_or_by_id_contrato($id_programa, $id_contrato = null){
		
			// TODO : checar esse SQL pq os dados da tabela contratos estão repetidos;
			$where = $id_contrato ? ' AND contratos.id = '.$id_contrato : '';
			
			$query = 'select
						 contratos.id,
						 contratos.contrato as titulo ,
						 contratos.id as alias,
						 ROUND( contratos.valor_contrato,2 ) as valor_contrato,
						 ROUND(
						 			(	SUM(contratos_medicoes.valor_medido_pi) +
						 				SUM(contratos_medicoes.valor_medido_pi_r)
									)::numeric,2 ) as valor_medido_acumulado_pi_r
							from contratos_relacoes
							inner join contratos
								ON (contratos.contrato = contratos_relacoes.contrato)
							inner join contratos_medicoes
								ON (contratos_medicoes.contrato = contratos_relacoes.contrato)
							where contratos_relacoes.programa = '.$id_programa.' 
							 '.$where.' 		
							group by contratos.contrato 		
							order by titulo  ASC ';
			//die;
			return $this->exec_query($query);
		}
		
		function get_valor_medido_mes_corrente_by_contrato($contrato){
		
			// AND Month(data_processamento_medicao) = Month(now())
		
			$query = 'select ROUND( (SUM(valor_medido_pi)::numeric + SUM(valor_medido_pi_r)::numeric) ,2) as valor_medido_pi
						from contratos_medicoes
						where EXTRACT( YEAR FROM data_processamento_medicao) = EXTRACT( YEAR FROM now())
							AND EXTRACT( MONTH FROM data_processamento_medicao) = EXTRACT( MONTH FROM now())
							AND contratos_medicoes.contrato = \''.$contrato.'\'; ' ;
			return $this->exec_query($query);
		}
		
		function get_valor_saldo_empenho_by_contrato($id){
		
			$query = 'select ROUND( (SUM(contratos_empenhos.valor_empenho_inicial)::numeric -
									SUM(contratos_empenhos.valor_empenho_consumido)::numeric), 2) as valor_saldo_empenho, 
							ROUND( SUM(contratos_empenhos.valor_empenho_inicial)::numeric, 2) as valor_empenhado
						from contratos_empenhos
										inner join contratos_relacoes
											ON ( contratos_empenhos.contrato = contratos_relacoes.contrato)
									where contratos_empenhos.contrato = \''.$id.'\';' ;
		
			return $this->exec_query($query);
		}
		
		function get_last_year_medido_mes_corrente_by_contrato($id){
		
			 $query = "select
			  		     'MEDIDO' as label,
						 contratos_medicoes.contrato as titulo,
						 CONCAT(
							EXTRACT( YEAR FROM contratos_medicoes.data_processamento_medicao), '-',
						 	EXTRACT( MONTH FROM contratos_medicoes.data_processamento_medicao), '-1'
						 ) as data,
						ROUND((SUM(contratos_medicoes.valor_medido_pi_r)::numeric + SUM(contratos_medicoes.valor_medido_pi)::numeric)) as valor
						from contratos_medicoes
							where data_processamento_medicao >= (CONCAT( (EXTRACT( YEAR FROM Now())-1),'-',EXTRACT( MONTH FROM Now()),'-1'))::date AND
									contratos_medicoes.contrato = '".$id."'
							group by
								contratos_medicoes.contrato,
								contratos_medicoes.data_processamento_medicao,
								EXTRACT( MONTH FROM contratos_medicoes.data_processamento_medicao),
								EXTRACT( YEAR FROM contratos_medicoes.data_processamento_medicao)
							order by data_processamento_medicao;";
				
			
			return $this->exec_query($query);
		
		
		}
		
		function get_last_year_saldo_empenho_by_contrato($id){
		
			 $query = 'select
			  		     \'EMPENHO\' as label,
						 contratos_empenhos.contrato as titulo,
						 CONCAT(
							EXTRACT( YEAR FROM contratos_empenhos.data_emissao_empenho), \'-\',
						 	EXTRACT( MONTH FROM contratos_empenhos.data_emissao_empenho), \'-1\'
						 ) as data,
						 ROUND(  (SUM(contratos_empenhos.valor_empenho_inicial)::numeric - 
 		 						 SUM(contratos_empenhos.valor_empenho_consumido)::numeric)) as valor 
						from contratos_empenhos
							where data_emissao_empenho > (CONCAT( (EXTRACT( YEAR FROM Now())-1),\'-\',EXTRACT( MONTH FROM Now()),\'-1\'))::date AND
									contrato = \''.$id.'\'
							 group by EXTRACT( MONTH FROM contratos_empenhos.data_emissao_empenho), 
								 EXTRACT( YEAR FROM contratos_empenhos.data_emissao_empenho) 
								 order by data_emissao_empenho;';
		
			
			return $this->exec_query($query);
		
		
		}
		
		function get_all_valores_medidos_by_contrato($id){
		
			$query = 'select
			  		     \'MEDIDO\' as label,
						 contratos_medicoes.contrato as titulo,
						 CONCAT(
							EXTRACT( YEAR FROM contratos_medicoes.data_processamento_medicao), \'-\',
						 	EXTRACT( MONTH FROM contratos_medicoes.data_processamento_medicao), \'-1\'
						 ) as data,
						ROUND((SUM(contratos_medicoes.valor_medido_pi_r)::numeric + SUM(contratos_medicoes.valor_medido_pi)::numeric)) as valor
						from contratos_medicoes
							where 
									contratos_medicoes.contrato = \''.$id.'\'
							group by
								contratos_medicoes.contrato,
								contratos_medicoes.data_processamento_medicao,
								EXTRACT( MONTH FROM contratos_medicoes.data_processamento_medicao),
								EXTRACT( YEAR FROM contratos_medicoes.data_processamento_medicao)
							order by data_processamento_medicao;';
		
				
			return $this->exec_query($query);
		
		
		}
		
		function get_all_valores_empenho_by_contrato($id){
		
			$query = 'select
			  		     \'EMPENHO\' as label,
						 contratos_empenhos.contrato as titulo,
						 CONCAT(
							EXTRACT( YEAR FROM contratos_empenhos.data_emissao_empenho), \'-\',
						 	EXTRACT( MONTH FROM contratos_empenhos.data_emissao_empenho), \'-1\'
						 ) as data,
						 ROUND( SUM(contratos_empenhos.valor_empenho_inicial)::numeric) as valor
						from contratos_empenhos
							where contrato = \''.$id.'\'
							 group by 
								 contratos_empenhos.contrato,
								 contratos_empenhos.data_emissao_empenho,
								 EXTRACT( MONTH FROM contratos_empenhos.data_emissao_empenho),
								 EXTRACT( YEAR FROM contratos_empenhos.data_emissao_empenho)
								 order by data_emissao_empenho;';
		
				
			return $this->exec_query($query);
		
		
		}
		
		// FIM CONSULTA PARA VALORES DE CONTRATOS
		
		
		function get_orcamento_contratos_by_coordenacao_geral($id_coordenacao_geral = null, $coordenacao_geral = null){
			$query = '';
			return $this->exec_query($query);
			
		}
		
		function get_orcamento_contratos_by_coordenacao_setorial($id_coordenacao_setorial = null, $coordenacao_setorial = null){
			$query = '';
			return $this->exec_query($query);
			
		}
		
		function get_orcamento_contratos_by_programa($programa){
			$query = '';
			return $this->exec_query($query);
			
		}
		
		function get_orcamento_contratos_by_executora($executora){
				
		}
		
		function get_orcamento_contratos_by_option($id_orcamento,  $coordenacao_geral, $coordenacao_setorial = null, $programa = null){

			$where = '';
			if($coordenacao_setorial){
				$where .= ' AND coordenacao_setorial = "'.$coordenacao_setorial.'"';
			}
				
			if($programa){
				$where .= ' AND programa = "'.$programa.'"';
			}
				
			$query = 'select *
						from '.$this->contratosOrcamentoTable.'
					where
						id_orcamento = "'.$id_orcamento.'" AND
						coordenacao_geral = "'.$coordenacao_geral.'" '.$where.';';
			return $this->exec_query($query);
				
		}
		
		function get_top_content_values_by_option($id_orcamento,  $coordenacao_geral, $coordenacao_setorial = null, $programa = null){
			
			// TODO: SETAR ESSA OPCAO POR DATA, AINDA NAO SEI COMO 
			
			$where = '';
			
			if($coordenacao_setorial){
				$where .= ' AND coordenacao_setorial = "'.$coordenacao_setorial.'"';
			}
			
			if($programa){
				$where .= ' AND programa = "'.$programa.'"';
			}
			
			$query = 'select 	
							ROUND(SUM( rap )::numeric) as RAP , 
							ROUND(SUM( medicoes_processadas_n_pagas_ano_anterior )::numeric) as med_n_pagas_ano_anterior, 
							ROUND(SUM( previsao_medicoes_processar_ano_anterior )::numeric) as prev_medicoes_ano_anterior,  
							ROUND( (SUM(rap) - SUM(previsao_medicoes_processar_ano_anterior) )::numeric ) as est_saldo_empenho,
							ROUND(  (SUM(jan) + SUM(fev) + SUM(mar) + SUM(abr) + SUM(mai) + SUM(jun) + SUM(jul) + SUM(ago) + SUM(`set`) + SUM(`out`) + SUM(nov))::numeric ) as total_cronograma_partial,
							ROUND( SUM(dez)::numeric ) as total_dez,
							COUNT(*) as num_contratos
						from '.$this->contratosOrcamentoTable.'
					where 
						id_orcamento = "'.$id_orcamento.'" AND
						coordenacao_geral = "'.$coordenacao_geral.'" '.$where.';';
			
			
			return $this->exec_query($query);
			
		}
		
		function get_last_record_by_base_data(){
			$query = 'select id_orcamento, data_base from '.$this->contratosOrcamentoTable.'
						group by id_orcamento, data_base
						order by data_base desc
						limit 1; ';
			return $this->exec_query($query);
		}
		
		// config query string
		function get_menu_nav($id_orcamento){
			
			 $query = 'select 
					     coordenacao_geral.titulo as geral, 
						 coordenacao_geral.alias as geral_alias,
						 coordenacao_setorial.titulo as setorial , 
						 coordenacao_setorial.alias as setorial_alias,
						 programas.titulo as programas,
						 programas.alias as programas_alias 
					from controle_orcamento
					inner join coordenacao_geral 
						ON (coordenacao_geral.id = controle_orcamento.coordenacao_geral)
					inner join coordenacao_setorial 
						ON (coordenacao_setorial.id = controle_orcamento.coordenacao_setorial)
					inner join programas 
						ON (programas.id = controle_orcamento.programa)
					where id_orcamento = '.$id_orcamento.'	
					group by
							 coordenacao_geral.titulo as geral, 
							 coordenacao_geral.alias as geral_alias,
							 coordenacao_setorial.titulo as setorial , 
							 coordenacao_setorial.alias as setorial_alias,
							 programas.titulo as programas,
							 programas.alias as programas_alias 
							 programa
					order by geral, setorial, programas ASC';
			//die;
			return $this->exec_query($query);
			
		}
		
		// config query string
		function get_menu_nav_gerencial(){
				
			$query = 'select
					     coordenacao_geral.titulo as geral,
						 coordenacao_geral.alias as geral_alias,
						 coordenacao_setorial.titulo as setorial ,
						 coordenacao_setorial.alias as setorial_alias,
						 programas.titulo as programas,
						 programas.alias as programas_alias
							from contratos_relacoes
							inner join coordenacao_geral
								ON (coordenacao_geral.id = contratos_relacoes.coordenacao_geral)
							inner join coordenacao_setorial
								ON (coordenacao_setorial.id = contratos_relacoes.coordenacao_setorial)
							inner join programas
								ON (programas.id = contratos_relacoes.programa)
							group by 
									coordenacao_geral.titulo, 
									coordenacao_geral.alias, 
									coordenacao_setorial.titulo, 
									coordenacao_setorial.alias,
									 programas.titulo,
									 programas.alias, 
									 programa 
							order by geral, setorial, programas ASC';
			
			return $this->exec_query($query);
				
		}
		
		
		function teste_acessoSIAC()
		{
			$siadDb = $this->load->database('siac', TRUE);
			
			//$siadDb->select('NU_CON_FORMATADO');
			$siadDb->select('*');
			$siadDb->from('Dados_Contrato');
			//ds_tip_intervencao
			$siadDb->where('NU_CON_FORMATADO', '23 00658/2011');
			$siadDb->order_by('SK_CONTRATO');
			$siadDb->limit(10);
			
			//$siadDb->group_by('NU_CON_FORMATADO');
			
			$query = $siadDb->get();
			//$this->PQUERY();
			$this->debugMark('teste', $query->result_array());
		}
		
		function get_contratos_from_SIAC($dataFilterAND = null, $dataFilterOR = null,$dataOrder = null)
		{
			$siadDb = $this->load->database('siac', TRUE);
			
			//$siadDb->select('NU_CON_FORMATADO');
			$siadDb->select('*');
			$siadDb->from('Dados_Contrato');
			//ds_tip_intervencao
			//$siadDb->where('NU_CON_FORMATADO', '23 00658/2011');
			
			if(sizeof($dataFilterAND) > 0)
			{
				foreach($dataFilterAND as $key => $filter)
				{
					$siadDb->where($key,$filter);
				}
				
			}
			
			if(sizeof($dataFilterOR) > 0)
			{
				foreach($dataFilterOR as $key => $filter)
				{
					$siadDb->or_where($key,$filter);
				}
				
			}
			
			$siadDb->order_by('SK_CONTRATO');
			$siadDb->limit(100);
			
			//$siadDb->group_by('NU_CON_FORMATADO');
			
			$query = $siadDb->get();
			//$this->PQUERY();
			$this->debugMark('teste', $query->result_array());
		}
		
		function get_contratos_from_SIAC_by_nm_contrato($nmcontrato)
		{
			$siadDb = $this->load->database('siac', TRUE);
			
			//$siadDb->select('NU_CON_FORMATADO');
			$siadDb->select('*');
			$siadDb->from('Dados_Contrato');
			$siadDb->like('NU_CON_FORMATADO', $nmcontrato);
			$siadDb->order_by('SK_CONTRATO');
			
			
			$query = $siadDb->get();
			//$this->PQUERY();
			//$this->debugMark($nmcontrato, $query->result_array());
			//$this->PAR($query->result_array());
			return $query->result_array();
		}
		
}


















