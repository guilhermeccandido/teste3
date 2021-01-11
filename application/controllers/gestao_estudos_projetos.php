<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class gestao_estudos_projetos extends App_controller {
const VIEW_FOLDER = 'admin/gestao_estudos_projetos';

    public function __construct()
	{
        parent::__construct();
        $this->load->model('gestao_estudos_projetosdao');

       
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
    	$data['main_content'] = 'portal/gestao_estudos_projetos/index';
    	$this->load->view('includes/portal_template', $data);	
        

    }//index    
    
    public function relatorios(){
    	
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
    	$data['main_content'] = 'portal/gestao_estudos_projetos/relatorios';
    	$this->load->view('includes/portal_template', $data);
    }	
    
    public function relatorios_financeiros(){
    	
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
    	$data['main_content'] = 'portal/gestao_estudos_projetos/relatorios_financeiros';
    	$this->load->view('includes/portal_template', $data);
    }

       			
}