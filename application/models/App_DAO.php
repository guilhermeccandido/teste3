<?php

class App_DAO extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
        
    }
    
    /*
     * Base do Model onde todos os modelos poderão acessar
     * 
     */
    
    protected $table;
    
    function select_query()
    {
    	$result = $this->db->get($this->table);
    	return $result->result_array();
    }
    
    function select_by_id($id)
    {
    	$result = $this->db->get_where($this->table, array( 'id' => $id));
    	return $result->result_array();
    }
    
    function select_id($id)
    {
    	$result = $this->db->query('SELECT id from '.$this->table.' where id = "'.$id.'"');
    	return $result->result_array();
    }
    
    function select_by_val($val,$col)
    {
    	$result = $this->db->get_where($this->table, array( $col => $val));
    	return $result->result_array();
    }
    
    function select_order_by($col, $dir = null )
    {
    	if($dir == null or $dir == 'ASC'){
    		$dir = 'ASC';
    	}
    	else{
    		$dir = 'DESC';
    	}
    	$this->db->order_by($col, $dir);
    	$result = $this->db->get($this->table);
    	return $result->result_array();
    }
    
    function select_order_by_limit($col, $dir, $limit)
    {
    	$result = $this->db->query('select * from '.$this->table.' order by '.$col.' '.$dir.' limit '.$limit.';');
    	return $result->result_array();
    }
    
    function select_where($where)
    {
    	// array('name !=' => $name, 'id' => $id)
    	$result = $this->db->get_where($this->table, $where);
    	return $result->result_array();
    }
    
    function select_where_limit($where, $limit)
    {
    	$this->db->limit($limit);
    	// array('name !=' => $name, 'id' => $id)
    	$result = $this->db->get_where($this->table, $where);
    	return $result->result_array();
    }
    
    function select_where_order_by($where,$col, $dir)
    {
    	$result  =  $this->db->query('select * from '.$this->table.
    			' where '.$where.
    			' order by '.$col.' '.$dir.' ;');
    	return $result->result_array();
    }
    // array where, order(coluna, direcao). int limit
    function select_where_order_by_limit($where,$col, $dir, $limit)
    {
    	$result  =  $this->db->query('select * from '.$this->table.
    			' where '.$where.
    			' order by '.$col.' '.$dir.' limit '.$limit.' ;');
    	return $result->result_array();
    }
    
    function select_like($col, $val){
    	$result = $this->db->query('select * from '.$this->table.' where '.$col.' LIKE "%'.$val.'%" ;');
    	return $result->result_array();
    }
    
    function select_newsletter($no = null, $ag = null, $co = null, $pr = null){
    	$result = $this->db->query("select email from ".$this->table."
			where (noticias = '".$no."' or agenda = '".$ag."' or convenios = '".$co."' or promocoes = '".$pr."')
			  and (inativo <> 'on')");
    	return $result->result_array();
    }
    function delete_query($id)
    {
    	// ver documentaÃ§Ã£o
    	$result = $this->db->query('DELETE FROM '.$this->table.' where id = '. $id );
    	return $result;
    }
    
    function insert_query($data)
    {
    
    	unset($data['id']);
    	$result = $this->db->insert($this->table, $data);
    	return $result;
    }
    
    function insert_query_in($data, $table)
    {
    
    	unset($data['id']);
    	$result = $this->db->insert($table, $data);
    	return $result;
    }
    
    
    function update_query($id, $data, $table = null)
    {
    	$where = 'id = '.$id;
    	if($table){
    		$result = $this->db->update($table, $data, $where);
    	}else{
    		$result = $this->db->update($this->table, $data, $where);
    	}
    	
    	return $result;
    }
    
    // lista a partir de um join
    function select_join_list($col, $tab_to_join, $col_tab_to_join, $data = null){
    	if(!$data){$data = '*';};
    	$result = $this->db->query(
    			'select '.$data.
    			' from '.$tab_to_join.
    			' inner join '.$this->table.
    			' on ('.$tab_to_join.'.'.$col_tab_to_join.' = '.$this->table.'.'.$col.');');
    	return $result->result_array();
    }
    
    // lista a partir de um join ordenado
    function select_join_list_order($col, $tab_to_join, $col_tab_to_join, $orderCol, $orderDir,  $data = null){
    	if(!$data){$data = '*';};
    	$result = $this->db->query(
    			'select '.$data.
    			' from '.$tab_to_join.
    			' inner join '.$this->table.
    			' on ('.$tab_to_join.'.'.$col_tab_to_join.' = '.$this->table.'.'.$col.
    			' 	  )
		  order by  '.$orderCol.' '.$orderDir.' ;');
    	return $result->result_array();
    }
    
    // valor a partir de um join + condicional
    function select_join_where($col, $val, $tab_to_join, $col_tab_to_join, $data = null){
    	if(!$data){$data = '*';	};
    	$result = $this->db->query(
    			'select '.$data.
    			' from '.$tab_to_join.
    			' inner join '.$this->table.
    			' on ('.$tab_to_join.'.'.$col_tab_to_join.' = '.$this->table.'.'.$col.
    			')'.
    			' where '.$tab_to_join.'.'.$col_tab_to_join.' = '.$val.' ;');
    	return $result->result_array();
    }
    
    function select_join_where_quero_ver( $val, $col_tab, $tab_to_join, $col_tab_to_join, $data = null){
    	if(!$data){$data = '*';	};
    	$result = $this->db->query(
    			'select '.$data.
    			' from '.$tab_to_join.
    			' inner join '.$this->table.
    			' on ('.$tab_to_join.'.'.$col_tab_to_join.' = '.$this->table.'.'.$col_tab.
    			')'.
    			' where '.$tab_to_join.'.'.$col_tab_to_join.' = '.$val.';');
    	return $result->result_array();
    }
    
    function select_join_where_resp_participante( $val, $col_tab, $tab_to_join, $col_tab_to_join, $data = null){
    	if(!$data){$data = '*';	};
    	$result = $this->db->query(
    			'select '.$data.
    			' from '.$tab_to_join.
    			' inner join '.$this->table.
    			' on ('.$tab_to_join.'.'.$col_tab_to_join.' = '.$this->table.'.'.$col_tab.
    			')'.
    			' where '.$this->table.'.id = '.$val.';');
    	return $result->result_array();
    }
    
    function sel_join_() {
    	// coluna, tab to join, coluna tab to join, retorno*(titulo, id)
    	return  $this->select_join_list('id_prod','produto','id', $this->table.'.id as id, '.$this->table.'.id_prod as id_prod, titulo' );
    }
    
    function getMaiorId($val){
    	$result = $this->db->query('select max('.$val.') as val from '.$this->table.' ;');
    	$result = $result->result_array();
    	return $result[0]['val'];
    }
    
    function votar($id, $col){
    	$result = $this->db->query('update '.$this->table.' set '.$col.'='.$col.'+1 where id = '.$id.';');
    	return $result;
    }
    
    function select_distinct($data = null){
    	if(!$data){$data = '*';	};
    	$result = $this->db->query('select disctinct '.$data.' from '.$this->table.';');
    	return $result->result_array();
    }
    
    function truncate(){
    	$this->db->query('TRUNCATE '.$this->table);
    }
    
    function exec_query($query){
    	$result = $this->db->query($query);
    	return $result->result_array();
    }
    
    function exec_query_rows($data){
    	$result = $this->db->query($data);
    	return $result->num_rows();
    }
    
    function exec_delete_query($data){
    	$result = $this->db->query($data);
    	return $result;
    }
    
    public function PAR($array)
    {
    	echo '<PRE>';
    	echo print_r($array);
    	echo '</PRE>';
    }
    
    public function PQUERY(){
    	echo $this->db->last_query();
    	die;
    }
    
    public function debugMark($text = null, $array = null,  $var = null){
    	echo ($text) ? '<br>Debug: '.$text.'<br>' : '';
    	
    	if($array){
    		$this->PAR($array);
    	}
    	echo ($var) ? $var : '';
    	
    	DIE;
    }
    public function semAspas(){
    	$this->db->_protect_identifiers = false;
    }
    
}