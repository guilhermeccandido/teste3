<?php
require_once(APPPATH . 'models/App_DAO' . EXT);
class atividadesdao extends App_DAO {
const VIEW_FOLDER = 'admin/atividades';
    	/**
	    * Responsable for auto load the database and the tables
	    * @return void
	    */
	    public function __construct()
	    {
	        $this->load->database();
	        $this->table = 'atividades';
	    }
    	
    	/**
	    * Get atividades by his is
	    * @param int $id 
	    * @return array
	    */
	    public function get_atividades_by_id($id)
	    {
	    	return $this->select_by_id($id);		 
	    } 
    	
	    /**
	    * Fetch atividades data from the database
	    * possibility to mix search, filter and order
	    * @param string $search_string 
	    * @param strong $order
	    * @param string $order_type 
	    * @param int $limit_start
	    * @param int $limit_end
	    * @return array
	    */
	    public function get_atividades($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
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
	    function count_atividades($search_string=null, $order=null)
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
	    function store_atividades($data)
	    {
	    	$dateInterval = $this->getDateInterval();
	    	
	    	if( $data['data_atividade'] < $dateInterval['date_min'] OR  $data['data_atividade'] > $dateInterval['date_max'] ){
	    		return false;
	    		
	    	}else{
	    		return $this->insert_query($data);
	    	}
	    	
		}
    	
    	/**
	    * Update atividades
	    * @param array $data - associative array with data to store
	    * @return boolean
	    */
	    function update_atividades($id, $data)
	    {
	    	
	    	$dateInterval = $this->getDateInterval();
	    	
	    	if( $data['data_atividade'] < $dateInterval['date_min'] OR  $data['data_atividade'] > $dateInterval['date_max'] ){
	    		return false;
	    		
	    	}else{
	    		
	    		$this->db->trans_start();
	    		
	    			$tmp = $this->select_by_id($id);
	    			$data['count_update'] = $tmp[0]['count_update'] + 1;
	    			
		    		$this->db->where('id', $id);
		    		$this->db->update($this->table, $data);
		    		
		    		$report = array();
		    		$report['error'] = $this->db->_error_number();
		    		$report['message'] = $this->db->_error_message();
		    		
	    		$this->db->trans_complete();
	    		
	    		if($report !== 0){
	    			return true;
	    		}else{
	    			return false;
	    		}
	    		
	    	}
	    	
			
		}
    	
		function atividade_inativa($id)
		{
			$this->db->where('id', $id);
			$this->db->update($this->table, array('ativo' => 'inativo'));
			$report = array();
			$report['error'] = $this->db->_error_number();
			$report['message'] = $this->db->_error_message();
			if($report !== 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function get_atividades_by_id_usuario_ativas_interval($id, $dateInterval)
		{
		
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id_usuario', $id);
			$this->db->where('ativo', 'ativo');
			$this->db->where('data_atividade >= ',$dateInterval["date_min"] );
			$this->db->where('data_atividade <= ',$dateInterval["date_max"] );
			$this->db->order_by('data_atividade', 'ASC');
			 
			 
			$query = $this->db->get();
				
			return $query->result_array();
		}
		
	    /**
	    * Delete atividades
	    * @param int $id - atividades id
	    * @return boolean
	    
		function delete_atividades($id){
			$this->delete_query($id); 
		}
		*/
		
		
		public function getDateInterval($date = null) {
			 
		
			$rules = array(  	'Monday'    => array(0,4),
					'Tuesday'   => array(1,3),
					'Wednesday' => array(2,2),
					'Thursday'  => array(3,1),
					'Friday'    => array(4,0)
			);
		
			$date_min =  date('Y-m-d', strtotime(date("Y-m-d") .' -'.$rules[date("l")][0].' day' ));
			$date_max =  date('Y-m-d', strtotime(date("Y-m-d") .' +'.$rules[date("l")][1].' day'));
		
			return array( 'date_min' => $date_min,  'date_max' => $date_max);
		}
		
		
}