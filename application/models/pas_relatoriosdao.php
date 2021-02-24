<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_relatoriosdao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_relatorios';
    	
    	
    	var $medicoesPasFasesTable = null;
    	var $reajustesTable = null;
    	var $pasfasesTable = null;
    	var $pasTable = null;
    	var $pasFasesMovimentacoesTable = null;
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'financeiro_medicoes';
	        $this->medicoesPasFasesTable = 'medicoes_pas_fases';
	        $this->reajustesTable = 'financeiro_reajuste';
	        $this->pasfasesTable = 'pas_fases';
	        $this->pasTable = 'pas';
	        $this->pasFasesMovimentacoesTable = 'pas_fases_movimentacao';
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
			$this->delete_query($id); 
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
		
		function get_produtos_medidos_by_id_registro_financeiro($id_registro_financeiro){
			
			$this->db->select(
					$this->table.'.titulo, '
					.$this->table.'.data, '
					.$this->table.'.acrecimos, '
					.$this->table.'.descontos, '
					.$this->table.'.observacoes as obs_medicao, '
					.$this->pasTable.'.lote, '
					.$this->pasfasesTable.'.id_fases, '
					.$this->medicoesPasFasesTable.'.id_pas_fases, '
					.$this->medicoesPasFasesTable.'.id_subfases, '
					.$this->medicoesPasFasesTable.'.quantidade, '
					.$this->medicoesPasFasesTable.'.valor, '
					.$this->medicoesPasFasesTable.'.observacoes as obs_produto, '
					.'( select '.$this->reajustesTable.'.reajuste  from '.$this->reajustesTable.' where 
						'.$this->reajustesTable.'.data_base <= '.$this->table.'.data order by '.$this->reajustesTable.'.data_base desc limit 1 )'
			);
		
			$this->db->from($this->table);
			$this->db->join($this->medicoesPasFasesTable, $this->medicoesPasFasesTable.'.id_financeiro_medicoes = '.$this->table.'.id', 'inner' );
			$this->db->join($this->pasfasesTable, $this->medicoesPasFasesTable.'.id_pas_fases = '.$this->pasfasesTable.'.id', 'inner' );
			$this->db->join($this->pasTable, $this->pasfasesTable.'.id_pas = '.$this->pasTable.'.id', 'inner' );
			
			$this->db->where($this->table.'.id_registro_financeiro', $id_registro_financeiro);
			$this->db->order_by($this->pasfasesTable.'.id');
				
			$query = $this->db->get();
			
			return $query->result_array();
			
		}
		
		function get_reajustes_by_id_registro_financeiro($id_registro_financeiro){
			
			$this->db->select();
			
			$this->db->from($this->reajustesTable);
			$this->db->where($this->reajustesTable.'.id_registro_financeiro', $id_registro_financeiro);
			$this->db->order_by($this->reajustesTable.'.data_base');
			
			$query = $this->db->get();
				
			return $query->result_array();
		}
		
		function get_historico_completo_movimentacoes(){
			
			$this->db->select(
			   'fases.id as id,
				usuario.nome as responsavel,
				fases.titulo as produto,
				pas.lote,
				pas.id_contrato,
				status.titulo as movimento,
				status.tipo as tipo,
				pas_fases_movimentacao.data_protocolo');
			
			$this->db->from($this->pasFasesMovimentacoesTable);
			$this->db->join('pas_fases', 'pas_fases_movimentacao.id_pas_fases = pas_fases.id' );
			$this->db->join('pas', 'pas_fases.id_pas = pas.id');
			$this->db->join('status', 'pas_fases_movimentacao.id_status = status.id');
			$this->db->join('fases', 'pas_fases.id_fases = fases.id');
			$this->db->join('usuario', 'pas_fases.id_responsavel = usuario.id_usuario');
			
			
			$this->db->_protect_identifiers = false;
			$this->db->order_by( "CASE WHEN pas.lote >= 'A' THEN pas.lote ELSE to_char(to_number(pas.lote, '9999'),'0000') END, fases.id, pas_fases_movimentacao.data_protocolo");
			
			$query = $this->db->get();
			
			return $query->result_array();
		}

		function get_fiscalizacao_mensal()
		{
			$this->load->database();
			$strQry = "SELECT * FROM vw_relatorio_completo";
			$query = $this->db->query($strQry);
			return $query->result();
		}


		
		
		
		
		








}