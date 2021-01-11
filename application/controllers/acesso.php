<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class acesso extends App_controller {
	const VIEW_FOLDER = 'portal/acesso';
    
    public function __construct()
    {
        parent::__construct();
       
    }
    	
    public function index()
    {

       
        //load the view
        $data['main_content'] = 'portal/acesso/index';
        $this->load->view('includes/portal_template', $data);  

    }//index    
    	
}