<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class signin_oidc extends App_controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('JWT');
        $token = JWT::decode(
            $this->input->post("id_token"),
            $this->config->item('oauth2_jwt_public_key'),
            array('RS256')
        );
        $this->load->library('../controllers/user');
        $this->user->validate_credentials($token->email);
    }
}
?>