<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class home extends App_controller {
	const VIEW_FOLDER = 'portal/home';
    
    public function __construct()
    {
        parent::__construct();
        
    }
    	
    public function index()
    {
    	
    	if($this->session->userdata('logged_in')){
    		
    		
    		/*
    		$data['link_acessos'] = array( 
    				array('Anteprojetos' => 'anteprojetos'),
    				array('Gestão de Estudos e Projetos' => 'estudos_projetos'), 
    				array('Gestão de Contratos' => 'contratos'),
    				array('Dados Técnicos' => 'dados_tecnicos'),
    				array('Relatório Gerencial' => 'gerenciais'),
    				array('Contrato 551' => 'contrato_551')
    		);
    		*/
    		$data['para_voce'] = true;
    		$data['logout'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    		
    	}else{
    		$data['slide_show'] = true;
    		$data['sobre_nos'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/home/index';
    	$this->load->view('includes/portal_template', $data);
    	 
    	
    }//index    

    function teste(){
    	$this->load->view('portal/home/home');
    }
    
    function contatos(){
    	$this->load->view('portal/home/contatos');
    }
    
}






