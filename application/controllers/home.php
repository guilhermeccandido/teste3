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
    	if ($this->session->userdata('logged_in')) {
    		$data['para_voce'] = true;
    		$data['logout'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    	}
		else {
    		redirect('auth');
    	}
    	
    	//load the view
    	$data['main_content'] = 'portal/home/index';
    	$this->load->view('includes/portal_template', $data);   	
    }//index    

    function teste()
	{
    	$this->load->view('portal/home/home');
    }
    
    function contatos()
	{
    	$this->load->view('portal/home/contatos');
    }
}






