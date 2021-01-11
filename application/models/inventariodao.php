<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class inventariodao extends App_DAO {
const VIEW_FOLDER = 'admin/inventario';
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'inventario';
	    }
    	
    	/**
	    * Get inventario by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_inventario_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch inventario data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_inventario($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_inventario($search_string=null, $order=null)
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
	    function store_inventario($data)
	    {
	    	return $this->insert_query($data);
		}
    	
    	/**
	    * Update inventario
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_inventario($id, $data)
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
	    * Delete inventario
	    * @param int $id - inventario id
	    * @return boolean
	    */
		function delete_inventario($id){
			$this->delete_query($id); 
		}
		
		function get_unifilar($order = null, $order_parameter = 'ASC'){
			
			$orderQry ='';
			if($order){
				$orderQry = ' order by '.$order.' '.$order_parameter;
			}
			// TODO : OK
			$query = 'select regioes.titulo as regiao, 
						 estados.titulo as estado, 
						 unifilar.*
					from unifilar 
					inner join regioes on (regioes.id = unifilar.id_regiao)
					inner join estados on (estados.id = unifilar.id_estado) '.
					$orderQry ;
			
			return $this->exec_query($query);
		}
		
		function get_regioes(){
			// TODO : OK
			$query = 'select regioes.titulo as regiao,
						 unifilar.id_regiao as id_regiao
					from unifilar
					inner join regioes on (regioes.id = unifilar.id_regiao)
					group by regioes.titulo, id_regiao';
				
			return $this->exec_query($query);
		}
		
		function get_estados_by_id_regiao($id_regiao){
			
			$query = 'select estados.titulo as estado,
						 unifilar.id_estado as id_estado
					from unifilar
					inner join regioes on (regioes.id = unifilar.id_regiao)
					inner join estados on (estados.id = unifilar.id_estado)
					where unifilar.id_regiao = '.$id_regiao.' 
					group by estados.titulo, id_estado';
			
			return $this->exec_query($query);
		}
		
		function get_data_by_id_regiao_id_estado($id_regiao, $id_estado, $ifTrue = null ){
			// TODO : OK
			$where = '';
			if($ifTrue){
				$where = " AND (
									funcionais = 'true'  OR
									fwd = 'true'  OR
									intersecoes = 'true'  OR
									oae = 'true'  OR
									sondagem = 'true'  OR
									topografia = 'true'  OR
									sinalizacao = 'true'
						        )";
			}
			
		 	$query = "select 	unifilar.*
					from unifilar
					inner join regioes on (regioes.id = unifilar.id_regiao)
					inner join estados on (estados.id = unifilar.id_estado)
					where unifilar.id_regiao = ".$id_regiao." AND
						  unifilar.id_estado = ".$id_estado." ".$where." ;";
		
		//die;
				
			return $this->exec_query($query);
		}
}