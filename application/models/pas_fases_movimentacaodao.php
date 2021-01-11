<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class pas_fases_movimentacaodao extends App_DAO {
const VIEW_FOLDER = 'admin/pas_fases_movimentacao';
    
    	var $pas_fasesTable = null;
		var $avaliacoesTable = null;
		var $statusTable = null;
		var $pasTable = null;
		var $fasesTable = null;
		var $usuarioTable = null;
    	
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'pas_fases_movimentacao';
	        $this->pas_fasesTable = 'pas_fases';
	        $this->avaliacoesTable = 'avaliacoes';
	        $this->statusTable = 'status';
	        $this->pasTable = 'pas';
	        $this->fasesTable = 'fases';
	        $this->usuarioTable = 'usuario';
	    }
    	
    	/**
	    * Get pas_fases_movimentacao by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_pas_fases_movimentacao_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    
	    public function get_pas_fases_movimentacao_detalhes_by_id($id)
	    {
	    	$this->db->select(
	    			$this->pas_fasesTable.'.id_pas,'.
	    			$this->table.'.data_protocolo, '.
	    			$this->table.'.descricao, '.
	    			$this->table.'.file, '.
	    			$this->avaliacoesTable.'.titulo as avaliacao, '.
	    			$this->statusTable.'.titulo as status'
	    	);
	    	$this->db->from($this->table); 
	    	$this->db->join($this->pas_fasesTable, $this->pas_fasesTable.'.id = '.$this->table.'.id_pas_fases', 'inner');
	    	$this->db->join($this->avaliacoesTable, $this->avaliacoesTable.'.id = '.$this->table.'.id_avaliacoes', 'inner');
	    	$this->db->join($this->statusTable, $this->statusTable.'.id = '.$this->table.'.id_status', 'inner');
	    	$this->db->where($this->table.'.id', $id);
	    	$query = $this->db->get();
	    	
	    	return $query->result_array();
	    	
	    }
	    
	    
	    /**
	    * Fetch pas_fases_movimentacao data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_pas_fases_movimentacao($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_pas_fases_movimentacao($search_string=null, $order=null)
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
	    function store_pas_fases_movimentacao($data)
	    {
	    	/*
	    	$this->db->trans_start();
	    	
	    		$this->db->select()
	    	
	    	
	    	$this->db->trans_complete();
	    	*/
	    	
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update pas_fases_movimentacao
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_pas_fases_movimentacao($id, $data)
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
	    * Delete pas_fases_movimentacao
	    * @param int $id - pas_fases_movimentacao id
	    * @return boolean
	    */
		function delete_pas_fases_movimentacao($id){
			$this->delete_query($id); 
		}

    	function get_avaliacoes_not_related_pas_fases_by_id_pas_fases($id, $id_avaliacoes = null){

			$query = 'select '.$this->avaliacoesTable.'.*
					from '.$this->avaliacoesTable.'
					where
					'.$this->avaliacoesTable.'.id NOT IN (
						select '. $this->table.'.id_avaliacoes from '. $this->table.' 
							where  '. $this->table.'.id_pas_fases = '.$id.'  
					) ';
			
			if($id_avaliacoes){
				$query .= 'OR
						'.$this->avaliacoesTable.'.id = '.$id_avaliacoes;
			}
								
				$query .= '	order by '.$this->avaliacoesTable.'.titulo asc';
				
			return $this->exec_query($query);
			
		}

		// TODO :  RETIRAR ESSE JOIN
		
    	function get_pas_fases_movimentacao_by_id_pas_fases($id, $order_by = null){
    			
    		$this->db->select($this->table.'.*, '
    				.$this->avaliacoesTable.'.titulo as avaliacoes,'
    				.$this->statusTable.'.tipo'
    		);
    		$this->db->from($this->avaliacoesTable);
    		$this->db->join($this->table, $this->table.'.id_avaliacoes = '.$this->avaliacoesTable.'.id ', 'inner');
    		$this->db->join($this->statusTable, $this->table.'.id_status = '.$this->statusTable.'.id ', 'inner');
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		
    		if($order_by){
    			$this->db->order_by($this->table.'.'.$order_by);
    		}else{
    			$this->db->order_by($this->table.'.id');
    		}
    		
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		
    		return $query->result_array();
    			
    	}
    	
    	function get_first_movimentacao_by_id_pas_fases($id){
    	
    		$this->db->select( 'MIN('.$this->table.'.data_protocolo) as start_date' );
    		$this->db->from($this->table);
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		$query = $this->db->get();
    	
    		//$this->PQUERY();
    		return $query->result_array();
    	
    	}
    	
    	function get_last_movimentacao_by_id_pas_fases($id){
    		
    		$this->db->select(
    				$this->table.'.*,  '.
    				$this->statusTable.'.titulo as status, '.
    				$this->statusTable.'.id_usuario_perfil'
    		);
    		$this->db->from($this->table);
    		$this->db->join($this->statusTable, $this->statusTable.'.id = '.$this->table.'.id_status', 'inner');
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		$this->db->order_by($this->table.'.data_protocolo', 'DESC');
    		$this->db->limit(1);
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		
    	}
    	
    	function get_all_movimentacao_by_id_pas_fases($id){
    		
    		$this->db->select(
    				$this->table.'.*,  '.
    				$this->statusTable.'.titulo as status, '.
    				$this->statusTable.'.id_usuario_perfil'
    				);
    		$this->db->from($this->table);
    		$this->db->join($this->statusTable, $this->statusTable.'.id = '.$this->table.'.id_status', 'inner');
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		$this->db->order_by($this->table.'.data_protocolo', 'DESC');
    		$query = $this->db->get();
    		
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		
    	}
    	
    	function get_last_movimentacao_by_id_pas_fases_id_usuario_perfil($id, $id_usuario_perfil){
    	
    		$this->db->select(
    				$this->table.'.*,  '.
    				$this->statusTable.'.titulo as status'
    				
    		);
    		$this->db->from($this->table);
    		$this->db->join($this->statusTable, $this->statusTable.'.id = '.$this->table.'.id_status', 'inner');
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		$this->db->where($this->statusTable.'.id_usuario_perfil', $id_usuario_perfil);
    		$this->db->order_by($this->table.'.data_protocolo', 'DESC');
    		$this->db->limit(1);
    		$query = $this->db->get();
    	
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    	
    	}
    	
    	function get_first_movimentacao_by_id_pas($id){
    		 
    		$this->db->select( 'MIN('.$this->table.'.data_protocolo) as start_date' );
    		$this->db->from($this->table);
    		$this->db->join($this->pas_fasesTable, $this->table.'.id_pas_fases = '.$this->pas_fasesTable.'.id', 'inner' );
    		$this->db->join($this->pasTable, $this->pas_fasesTable.'.id_pas = '.$this->pasTable.'.id', 'inner' );
    		$this->db->where($this->pasTable.'.id', $id);
    		$query = $this->db->get();
    		 
    		//$this->PQUERY();
    		return $query->result_array();
    		 
    	}
    	 
    	function get_last_movimentacao_by_id_pas($id){
    	
    		$this->db->select(
    				$this->table.'.* ');
    		$this->db->from($this->table);
    		$this->db->join($this->pas_fasesTable, $this->table.'.id_pas_fases = '.$this->pas_fasesTable.'.id', 'inner' );
    		$this->db->join($this->pasTable, $this->pas_fasesTable.'.id_pas = '.$this->pasTable.'.id', 'inner' );
    		$this->db->where($this->pasTable.'.id', $id);
    		$this->db->order_by($this->table.'.data_protocolo', 'DESC');
    		$this->db->limit(1);
    		$query = $this->db->get();
    	
    		
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    	
    	}
    	
    	//TODO : verificar se fica a melhor avaliacao plicada
    	function get_last_avaliation_by_id_fases($id){
    	
    		$this->db->select(
    				$this->table.'.id_avaliacoes, '.$this->avaliacoesTable.'.peso');
    		$this->db->from($this->table);
    		$this->db->join($this->avaliacoesTable , $this->table.'.id_avaliacoes = '.$this->avaliacoesTable.'.id', 'inner');
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		$this->db->where($this->table.'.id_avaliacoes > ', 1 );
    		//$this->db->where($this->statusTable.'.peso > ', 0 );
    		$this->db->order_by($this->table.'.data_protocolo', 'DESC');
    		$this->db->limit(1);
    		$query = $this->db->get();
    	
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    	
    	}
    	
    	//TODO : verificar se fica a melhor avaliacao plicada
    	function get_last_status_with_peso_by_id_fases($id){
    		 
    		$this->db->select(
    				$this->table.'.id_status, '.$this->statusTable.'.peso , '.$this->statusTable.'.composicao ');
    		$this->db->from($this->table);
    		$this->db->join($this->statusTable , $this->table.'.id_status = '.$this->statusTable.'.id', 'inner');
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		$this->db->where($this->statusTable.'.peso > ', 0 );
    		$this->db->order_by($this->table.'.data_protocolo', 'DESC');
    		$this->db->order_by($this->statusTable.'.peso ', 'DESC');
    		$this->db->limit(1);
    		$query = $this->db->get();
    		 
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		 
    	}
    	
    	// TODO : passar isso para uma consulta descente 
    	function get_possible_avaliacoes_by_pas_fases($id){
    		 $query = 'select * from avaliacoes 
						where peso >= (
							select 
								max(avaliacoes.peso)
							 from pas_fases_movimentacao 
							 inner join avaliacoes on(pas_fases_movimentacao.id_avaliacoes = avaliacoes.id)
							where
								pas_fases_movimentacao.id_pas_fases = '.$id.' 
					
						)';
    		
    		return $this->exec_query($query);
    		
    	}
    	
    	
    	//TODO : verificar se fica a melhor avaliacao plicada
    	function get_max_peso_by_id_fases($id){
    		 
    		$this->db->select('max('.$this->statusTable.'.peso) as peso');
    		$this->db->from($this->table);
    		$this->db->join($this->statusTable , $this->table.'.id_status = '.$this->statusTable.'.id', 'inner');
    		$this->db->where($this->table.'.id_pas_fases', $id);
    		$query = $this->db->get();
    		 
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		 
    	}
    	
    	function get_list_documents_by_id_pas($id){
    		$this->db->select(	$this->statusTable.'.titulo as tipo,
								'.$this->fasesTable.'.titulo as titulo, 
								'.$this->table.'.last_update,
								'.$this->table.'.file as nome, 
								'.$this->table.'.descricao as observacao'
    		);
    		$this->db->from($this->table);
    		$this->db->join($this->pas_fasesTable, $this->pas_fasesTable.'.id = '.$this->table.'.id_pas_fases', 'inner' );
    		$this->db->join($this->fasesTable, $this->fasesTable.'.id = '.$this->pas_fasesTable.'.id_fases', 'inner' );
    		$this->db->join($this->statusTable, $this->statusTable.'.id = '.$this->table.'.id_status', 'inner'  );
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->pas_fasesTable.'.id_pas' , 'inner' );
    		$this->db->where($this->pas_fasesTable.'.id_pas', $id);
    		$this->db->where($this->table.".file <> '' ");
    		$this->db->order_by('grupo, '.$this->fasesTable.'.titulo, '.$this->table.'.data_protocolo');
    		
    		
    		$query = $this->db->get();
    		 
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		 
    		
    	}
    	
    	function get_tipo_list_documents_by_id_pas($id){
    		$this->db->select(	$this->statusTable.'.titulo as tipo');
    		$this->db->from($this->table);
    		$this->db->join($this->pas_fasesTable, $this->pas_fasesTable.'.id = '.$this->table.'.id_pas_fases', 'inner' );
    		$this->db->join($this->fasesTable, $this->fasesTable.'.id = '.$this->pas_fasesTable.'.id_fases', 'inner' );
    		$this->db->join($this->statusTable, $this->statusTable.'.id = '.$this->table.'.id_status', 'inner'  );
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->pas_fasesTable.'.id_pas' , 'inner' );
    		$this->db->where($this->pas_fasesTable.'.id_pas', $id);
    		$this->db->where($this->table.".file <> '' ");
    		$this->db->group_by($this->statusTable.'.titulo');
    	
    	
    		$query = $this->db->get();
    		 
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    		 
    	
    	}
    	
    	/*
    	

		select 
			local_execucao.titulo "Local da Execução",
			usuario.nome as Responsável,
			pas.lote,
			fases.titulo as Produto,
			status.titulo as status,
			pas_fases_movimentacao.data_protocolo as "Data Execução",
			pas_fases.data_ini_planejada as "Data Planejada Inicial", 
			pas_fases.data_fim_planejada as "Data Planejada Final", 
			pas_fases_movimentacao.descricao as "Observações"
			from pas_fases_movimentacao
			inner join pas_fases on (pas_fases.id = pas_fases_movimentacao.id_pas_fases )
			inner join fases on (fases.id = pas_fases.id_fases )
			inner join pas on (pas.id = pas_fases.id_pas)
			inner join usuario on (usuario.id_usuario = pas_fases.id_responsavel)
			inner join local_execucao on (local_execucao.id = pas.id_local_execucao)
			inner join status on (status.id = pas_fases_movimentacao.id_status)
			
			where pas.id_contrato = 23
			order by pas.lote, fases.id, pas_fases_movimentacao.data_protocolo
    		
    	*/
    	
    	function get_all_movimentacao_by_id_contrato($id_contrato = null){
    		
    		$this->db->select(	
    					 $this->usuarioTable.'.nome as responsavel, '
				    	.$this->fasesTable.'.titulo as produto, '
				    	.$this->pasTable.'.lote, '
				    	.$this->statusTable.'.titulo as movimento, '
				    	.$this->table.'.data_protocolo '
    		);
    		
    		$this->db->from($this->table);
    		$this->db->join($this->pas_fasesTable, $this->pas_fasesTable.'.id = '.$this->table.'.id_pas_fases', 'inner' );    		
    		$this->db->join($this->fasesTable, $this->fasesTable.'.id = '.$this->pas_fasesTable.'.id_fases', 'inner' );
    		$this->db->join($this->pasTable, $this->pasTable.'.id = '.$this->pas_fasesTable.'.id_pas' , 'inner' );
    		$this->db->join($this->usuarioTable, $this->usuarioTable.'.id_usuario = '.$this->pas_fasesTable.'.id_responsavel' , 'inner' );
    		$this->db->join($this->statusTable, $this->statusTable.'.id = '.$this->table.'.id_status', 'inner'  );
    		
    		
    		if($id_contrato){
    			$this->db->where($this->pasTable.'.id_contrato', $id_contrato);
    		}
    		
    		$this->db->order_by($this->pasTable.'.lote, '.$this->fasesTable.'.id, '.$this->table.'.data_protocolo');
    		 
    		 
    		$query = $this->db->get();
    		 
    		//$this->PQUERY();
    		//die;
    		return $query->result_array();
    	}
    	
    	
}