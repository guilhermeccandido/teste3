<?php
require_once(APPPATH . 'controllers/App_controller' . EXT);

class User extends App_controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		
		if($this->session->userdata('logged_in')){
			redirect('admin/usuarios');
        }else{
        	$this->load->view('admin/login');	
        }
	}

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials($login)
	{
		
		$dadosPagina = array();
		
		$this->load->model('usuario');
		$usuario = new Usuario();
		$validaAcesso = $usuario->confirmarCredenciais($login);

		if($validaAcesso){
		
			$dados = $usuario->criarSessao($login);
			$this->session->set_userdata($usuario->criarSessao($login));
			redirect('admin/anteprojetos');
		
		}
		else // incorrect username or password
		{
			$data['slide_show'] = true;
			$data['sobre_nos'] = true;
			$data['message_error'] = true;

			//load the view
			$data['main_content'] = 'portal/home/index';
			$this->load->view('includes/portal_template', $data);
		}
		
	}	

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
		
	}
	
	/**
	 * check the username and the password with the database
	 * @return void
	 */
	function validate_credentials_temp()
	{
	
		
		$dadosPagina = array();
		$login = $this->input->post('login');
		$senha = $this->input->post('senha');
	
		$this->load->model('usuario');
		$usuario = new Usuario();
		$validaAcesso = $usuario->confirmarCredenciais($login,$senha);
	
		if($validaAcesso){
	
			$dados = $usuario->criarSessao($login);
			$this->session->set_userdata($usuario->criarSessao($login));
			
			//$this->session->set_flashdata('message_error', 'false');
			
			redirect('home');
	
		}
		else // incorrect username or password
		{
			// Set flash data 
			//$this->session->set_flashdata('message_error', 'true');
			//echo 'Usuário ou Senha inválida!'
			//$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>', '</strong></div>');
			echo '<script>alert("Usuário ou Senha inválida!"); location.href="/sgplan/home" </script>';
			//var_dump("oi");
			//redirect('home');			
			//$this->load->view('home.php');			
		}
	
	}
	
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}
	
	/**
	 * Destroy the session, and logout the user.
	 * @return void
	 */
	function logout_home()
	{
		$this->session->sess_destroy();
		redirect('home');
	}

}