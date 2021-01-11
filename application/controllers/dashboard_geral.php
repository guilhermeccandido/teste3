<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
class dashboard_geral extends App_controller {
const VIEW_FOLDER = 'admin/dashboard_geral';

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
    	$data['main_content'] = 'portal/dashboard_geral/index';
    	$this->load->view('includes/portal_template', $data);	
        

    }//index    

       			
}