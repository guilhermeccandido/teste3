<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class informacoes extends App_controller {
	const VIEW_FOLDER = 'portal/informacoes';
    
    public function __construct()
    {
        parent::__construct();
        
    }
    	
    public function index()
    {
    	
    	if($this->session->userdata('logged_in')){
    		
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/informacoes/index';
    	$this->load->view('includes/portal_template', $data);
    	 
    	
    }//index    

    function dnit(){
    	
    	if($this->session->userdata('logged_in')){
    		
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/informacoes/dnit';
    	$this->load->view('includes/portal_template', $data);
    }
    
    function cgplan(){
    	if($this->session->userdata('logged_in')){
    		
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/informacoes/cgplan';
    	$this->load->view('includes/portal_template', $data);
    }
    
    function consorcio(){
    	if($this->session->userdata('logged_in')){
    		
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/informacoes/consorcio';
    	$this->load->view('includes/portal_template', $data);
    }
    function engemap(){
    	if($this->session->userdata('logged_in')){
    		
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/informacoes/engemap';
    	$this->load->view('includes/portal_template', $data);
    }
    function dynatest(){
    	if($this->session->userdata('logged_in')){
    		
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	
    	/*       
    	$this->load->view('portal/home/index', $data);
    	 */
    	
    	//load the view
    	$data['main_content'] = 'portal/informacoes/dynatest';
    	$this->load->view('includes/portal_template', $data);
    }
    
    
}