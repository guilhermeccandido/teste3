<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);
require_once(APPPATH . 'libraries/paragonie/random' . EXT);

class auth extends App_controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('phpseclib/Math/BigInteger');
        $this->load->library('phpseclib/Crypt/Hash');
        $this->load->library('phpseclib/Crypt/RSA');        
        $this->load->library('OpenIDConnectClient');
    }
    	
    public function index()
    {
        try{            
            $oidc = new OpenIDConnectClient(
                $this->config->item('oauth2_host'),
                $this->config->item('oauth2_client_id'),
                $this->config->item('oauth2_secret_key')
            );

            $oidc->setVerifyHost(false);
            $oidc->setVerifyPeer(false);

            $oidc->addScope(array('openid','profile','email'));

            $oidc->setAllowImplicitFlow(true);

            $oidc->addAuthParam(array('response_mode' => 'form_post'));

            $oidc->setResponseTypes('id_token');

            $oidc->setRedirectUrl($this->config->item('oauth2_call_back'));

            $oidc->authenticate();            

        } catch(Exception $e){
            throw new Exception($e);
        }

    }
    	
}