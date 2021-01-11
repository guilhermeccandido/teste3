<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class contatos extends App_controller {
	const VIEW_FOLDER = 'portal/contatos';
    
    public function __construct()
    {
        parent::__construct();
       
    }
    	
    public function index(){
       
    	if($this->session->userdata('logged_in')){
    		
    		$data['logout'] = true;
    		$data['link_relacionados'] = true;
    		$data = array_merge($data, $this->get_acesso_user());
    		
    	}else{
    		$data['slide_show'] = true;
    	}
    	
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		
    		//form validation
    		$this->form_validation->set_rules('nome', 'nome', 'required');
    		$this->form_validation->set_rules('email', 'email', 'required');
    		$this->form_validation->set_rules('mensagem', 'mensagem', 'required');
    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
    	
    	
    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    			$emailArray = array();
    			
    			$emailData = array(
    					'emailsTo' => array('aspolavori@yahoo.com.br'),
    					'emailsCc' => array(),
    					'titulo' => 'Email enviado da Área de Contatos SGPLAN' ,
    					'emailBody' => $this->input->post('mensagem') ,
    					'nomeRemetente' => $this->input->post('nome'),
    					'emailRemetente' => $this->input->post('email') 
    			);
    			
    			$result = $this->emailJson($emailData);
    			
    			//$this->debugMark(null, $result);
    			//echo $result->sucesso;		
    			
    			if($result->sucesso){
    				$data['flash_message'] = TRUE;
    			}else{
    				$data['flash_message'] = FALSE;
    			}
    	
    		}
    		
    	}
    	
    	
    	
    	
    	
        //load the view
        $data['main_content'] = 'portal/contatos/index';
        $this->load->view('includes/portal_template', $data);

    }//index    
     
}