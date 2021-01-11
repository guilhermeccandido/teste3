<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class orcamentodao extends App_DAO {
const VIEW_FOLDER = 'admin/orcamento';

		public $controleOrcamentoTable = null;

    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'orcamento';
	        $this->controleOrcamentoTable = 'controle_orcamento';
	    }
    	
    	/**
	    * Get orcamento by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_orcamento_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch orcamento data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_orcamento($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_orcamento($search_string=null, $order=null)
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
	    function store_orcamento($data)
	    {
	    	$this->db->trans_start();
	    	
	    	$query = 'select * from '.$this->controleOrcamentoTable.' 
	    				where id_orcamento = '.$data['id_orcamento'].' 
	    				order by id asc;';
	    	/*
	    	 * 
	    	 * TODO :  TESTAR E SUBSTITUIR 
	    	$query = $this->db->get_where($this->controleOrcamentoTable, array($this->controleOrcamentoTable.".id_orcamento" => $data['id_orcamento']));
	    	*/
	    			
	    	$newData = $this->exec_query($query);
	    	unset($data['id_orcamento']);		
	    	$insert_data =  $this->insert_query($data);
	    	$insert_id = $this->db->insert_id();
	    	
	    	foreach($newData as $row){
	    		$row['id_orcamento'] = $insert_id;
	    		unset($row['id']);
	    		$this->db->insert($this->controleOrcamentoTable, $row);
	    	}
	    	
	    	$this->db->trans_complete();
	    	
	    	if ($this->db->trans_status() === FALSE){
	    		return false;
	    	}else{
	    		return true;
	    	}
		}
    	
    	/**
	    * Update orcamento
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_orcamento($id, $data)
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
		 * Update orcamento projecoes
		 * @param array $data - associative array with data to store
		 * @return boolean
		 */
		function update_orcamento_projecoes($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update($this->controleOrcamentoTable,  $data);
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
	    * Delete orcamento
	    * @param int $id - orcamento id
	    * @return boolean
	    */
		function delete_orcamento($id){
			$this->delete_query($id); 
		}
		
		function delete_orcamento_projecao($id){
			
			$result = $this->db->query('DELETE FROM '.$this->controleOrcamentoTable.' where id = '. $id );
    		return $result;
			
		}
		
		
		function get_projecoes_by_id_orcamento($id_orcamento){
			
			//$query = 'select * from '.$this->controleOrcamentoTable.'  where id_orcamento = '.$id_orcamento.' ;';
			$query = $this->db->get_where($this->controleOrcamentoTable, array($this->controleOrcamentoTable.".id_orcamento" => $id_orcamento ));
			
			
			return $query->result_array();
		}
		
		
		function get_projecoes_by_data_base(){
			
		}
		
		
}

















