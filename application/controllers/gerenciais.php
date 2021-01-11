<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class gerenciais extends App_controller {
	const VIEW_FOLDER = 'portal/gerenciais';
    
    public function __construct()
    {
        parent::__construct();
       
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
    	$data['main_content'] = 'portal/gerenciais/index';
    	$this->load->view('includes/portal_template', $data);
    	 
    	
    }//index    

    function teste(){
    	$this->load->view('portal/gerenciais/gerenciais');
    }
    
    function contatos(){
    	$this->load->view('portal/gerenciais/contatos');
    }
    
    
}