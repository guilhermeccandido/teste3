<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class configuracao_geral extends App_controller {
const VIEW_FOLDER = 'admin/configuracao_geral';

    public function __construct()
	{
        parent::__construct();
       // $this->load->model('gestao_estudos_projetosdao');

       
    }
    	
    public function index()
    {
		if($this->session->userdata('logged_in')){
    		
    		$data = array();
    		$data = array_merge($data, $this->get_acesso_user(true));
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/configuracao_geral/index';
    	$this->load->view('includes/portal_template', $data);	
        

    }//index    
    
    public function pas()
    {
    	if($this->session->userdata('logged_in')){
    
    		$data = array();
    		$data = array_merge($data, $this->get_acesso_user(true));
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    
    	}else{
    		$data['slide_show'] = true;
    	}
    	 
    	 
    	/*
    	 $this->load->view('portal/home/index', $data);
    	 */
    	 
    	//load the view
    	$data['main_content'] = 'portal/configuracao_geral/pas';
    	$this->load->view('includes/portal_template', $data);
    
    
    }

    public function contratos()
    {
    	if($this->session->userdata('logged_in')){
    
    		$data = array();
    		$data = array_merge($data, $this->get_acesso_user(true));
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    
    	}else{
    		$data['slide_show'] = true;
    	}
    
    
    	/*
    	 $this->load->view('portal/home/index', $data);
    	 */
    
    	//load the view
    	$data['main_content'] = 'portal/configuracao_geral/contratos';
    	$this->load->view('includes/portal_template', $data);
    
    
    }
    
       			
}