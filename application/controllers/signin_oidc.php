<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class signin_oidc extends App_controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArdakN+RbPwpirAr2xyBB
mi2NRtxGrWy02yR0gwO3yCwR2iQFXehng7yDWv6SfPyhGFoXV6efK/1bUgrnhRB1
RnrIjS/QPu7n7la2L2Fv63AI92mNtMhNkOcBXzDrvKA3KciQmSI+8jFwHdkyqwtY
7YZklCEG0aFcdZq9QgXQRSZF9exU7qcG3HqVAKlSKk4gjhTYBH0sGEX/iiGWhwRl
uXjG/BvHneyrn7vGxBxPX3n9ssUfa6UZQIUPyuruLQwdg/vlOuO/H8JhLsptLgX1
JgtCca/gb4molfjC5/0lAiW54fiRSgiM2WwlmD7KIxoIouvhXuqicLovsMxaLKeb
xQIDAQAB
-----END PUBLIC KEY-----
EOD;
        $this->load->library('JWT');
        $token = JWT::decode($this->input->post("id_token"),$publicKey,array('RS256'));
        $this->load->library('../controllers/user');
        $this->user->validate_credentials($token->email);
    }
}
?>