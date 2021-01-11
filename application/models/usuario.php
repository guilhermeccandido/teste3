<?php

require_once(APPPATH . 'models/App_DAO' . EXT);

class Usuario extends App_DAO{

	function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * Pesquisa no banco de dados atraves do nome e email de um usuario. Utilizar esta funcao para pesquisar/confirmar por id,login,email.
	 * @param string $email
	 * @param string $nome
	 * @return array|boolean dados registrados para o nome e email ou false se nada encontrar
	 */
	public function getUserByName($email,$nome=null)
	{
	    $this->load->database();
	    $query = $this->db->query("SELECT id_usuario,nome,login,email FROM usuario WHERE email LIKE ".$this->db->escape($email));
	    
	    if($query->num_rows() > 0){
	        
	        return $query->row_array();
	              
	    }else{
	        return false;
	    }
	}
	
    /**
     * Altera a senha pela confirmacao do usuario.
     * @param int $idUsuario id do usuario
     * @param int $token token de seguranca 
     * @return boolean|string false em caso de problemas ou a nova senha para o usuario
     */
	public function resetSenha($idUsuario,$token)
	{
	    if(empty($idUsuario)) return false;
	    
	    
	    $this->load->database();
	    $query = $this->db->query("SELECT id_usuario FROM usuario WHERE id_usuario = ".$this->db->escape($idUsuario)." AND tokensenha = ".$this->db->escape($token));
	     
	    if($query->num_rows() <= 0){
	         
	        return false;
	         
	    }	    
	    
	    $novasenha = 'portal'.rand(0,99999);
	    $senhacripto = sha1($novasenha);
	    $dados = array(
	    	'senha' => $senhacripto
	    );	   
	    $atualizacao = $this->atualizar($dados, $idUsuario);
	    
	    
	    if(!$atualizacao) return false;
	    
	    if($atualizacao){
	        $dados = array(
	        	'tokensenha' => NULL
	        );
	        $this->atualizar($dados, $idUsuario);
	        return $novasenha;
	    }
	    	   
	}
	
	/**
	 * Metodo para enviar email, as configuracoes de email estao em application/conig/email.php
	 * @param string $destinatario
	 * @param string $assunto
	 * @param string $texto
	 */
	public function enviarEmail($destinatario,$assunto,$texto)
	{
	  
	  //$this->load->library('email');
	  $this->email->set_newline("\r\n");
      $this->email->from('simcosta.data@gmail.com', 'Sistemas SiMCosta');
      $this->email->to($destinatario); 
      $this->email->subject($assunto);
      $this->email->message($texto);        
      return $this->email->send();       
	}
	
	/**
	 * Envia email requisitando confirmacao do usuario em resetar senha
	 * @param array $usuario com dados sobre usuario (id, email, token...)
	 * @return boolean true se envou email, false do contrario
	 */
	public function emailResetSenha($usuario)
	{
	    $link = base_url().'inicial/novasenha/'.$usuario['id_usuario'].'/'.$usuario[0];
	    $texto = 'Olá '.$usuario['nome'].'<br /><br />Você está recebendo este e-mail para resetar a sua senha para o login <strong>'.$usuario['login'].'</strong>.
	      Caso você não tenha requisitado a mesma, por favor, ignore este e-mail.<br /><br />
	      Para confirmar o reset da sua senha clique no link abaixo ou copie e cole o mesmo em seu navegador:<br />
	      <a href="'.$link.'" target="_blank">'.$link.'</a><br /><br /><br />
	      Atenciosamente,<br />Portal SGPLAN';

	    $enviado = $this->enviarEmail($usuario['email'],'Requisição de nova senha',$texto);
	    if($enviado) return true;
	    if(!$enviado) return false;
	}
	
	/**
	 * Gera um token de seguranca para futura troca reset de senha pelo usuario
	 * @param int $id id do usuario
	 * @return number|boolean token gerado para usuario ou false em caso de problemas
	 */
	public function tokenSenha($id)
	{
	    $token = rand(0,999999);
	    $dados = array(
	        'tokensenha' => $token
	    	
	    );
	    $atualizacao = $this->atualizar($dados, $id);
	    
	    if($atualizacao) return $token;
	    if(!$atualizacao) return false;
	}
	
	/**
	 * Envia email ao usuario com a nova senha
	 * @param int $idUsuario
	 * @param string $senha
	 * @return boolean true se email foi enviado, false do contrario
	 */
	public function envioNovaSenha($idUsuario,$senha)
	{
	    $this->load->database();
	    $query = $this->db->query("SELECT email FROM usuario WHERE id_usuario = ".$this->db->escape($idUsuario));
	    $email = $query->row_array();
	    $texto = 'Olá,<br /><br />Sua nova senha para acessar o Portal SiMCosta é:<br /><br />
	              Senha: <strong>'.$senha.'</strong><br /><br />Recomendamos que acesse o Portal <a href="'.base_url().'">SiMCosta</a> e altere 
	              no cadastro para uma senha pessoal.<br /><br /><br />
	              Atenciosamente,<br />Portal SiMCosta';
	    $enviado = $this->enviarEmail($email,'Requisição de nova senha',$texto);
	    if($enviado) return true;
	    if(!$enviado) return false;
	}
	
	
	/**
	* Funcao que verifica login do usuario.
	* @param $nomeUsuario nome de login do usuario.
	* @param $senha a senha do usuario.
	* @return TRUE se o login foi efetuado com sucesso, FALSE do contrario
	**/
	public function confirmarCredenciais($login,$senha)
	{

		$this->load->database();
		$strQry =  "SELECT nome FROM usuario WHERE login = ".$this->db->escape($login)." AND 
		    senha = ".$this->db->escape(sha1($senha));
		
			
		$query = $this->db->query($strQry);

		if($query->num_rows() > 0){
			
			return true;

		}else{
			
			return false;

			}
	}

	/**
	* O metodo criar um array com os dados para retornar ao controller com o objetivo de criar uma sessao.
	* As sessoes nao ficam armazenadas em cookies e sim no banco de dados na tabela ci_sessions.
	* Por motivos obvios de seguranca, utilizar somente se o usuario a logar for aprovado pelo metodo confirmarCredenciais()
	* @param $login nome do usuario para login
	* @return array contendo informacoes para sessao
	*/
	public function criarSessao($login)
	{

    	$this->load->database();
    	$query = $this->db->query("SELECT u.nome, u.login, u.id_usuario FROM usuario u
    	    WHERE login = ".$this->db->escape($login));
    	$registro = $query->row();
    	$dadosSessao = array(
    	'id' 	=> $registro->id_usuario,
    	'login' => $registro->login,
    	'nome'  => $registro->nome,
    	'tipo'  => 999,
    	'logged_in' => TRUE
    	);
    	return $dadosSessao;

	}

	/**
	* A funcao apenas verifica se um determinado nome de usuario ja existe no banco de dados.
	* @return true se existe usuario cadastrado, false do contrario
	*/
	public function isUsuario($login)
	{

		$usuarioExiste = false;
		$this->load->database();
		$query = $this->db->query("SELECT id_usuario FROM usuario where login = ".$this->db->escape($login));
		if($query->num_rows() > 0){
			$usuarioExiste = true;
		}
		return $usuarioExiste;
	}


	/**
	* Realiza o INSERT na tabela usuario do banco de dados
	* @return true se o INSERT foi realizado com sucesso, false do contrario
	*/
	public function inserir($dadosUsuario)
	{

		$this->load->database();
		$novoUsuario = array(					
					'instituicao' => $dadosUsuario['instituto'],
					'login' 	  => $dadosUsuario['login'],
					'nome' 		  => $dadosUsuario['nome'],
					'local' 	  => $dadosUsuario['local'],
					'email' 	  => $dadosUsuario['email'],
					'senha' 	  => sha1($dadosUsuario['senha'])
		);
		$this->db->insert('usuario', $novoUsuario); 
	
		if($this->db->affected_rows()){
		    $ids = array(
		    	'id_usuario' => $this->db->insert_id(),
		        'id_perfil'  => 0 
		    );
		    $this->db->insert('usuario_perfil', $ids);
			return true;
		}else{
			return false;
		}
	}

	/**
	* Atualiza dados de um usuario do sistema. Utiliza Active record do Codeigniter.
	* @param $dadosUsuario um array contendo os dados que serao atualizados no banco (indices = colunas do banco).
	* @param $idUsuario identificado (int) do usuario para a clausula where().
	* @return true se conseguiu atualizar, false do contrario
	*/
	public function atualizar($dadosUsuario,$idUsuario)
	{

		$this->load->database();
		$this->db->where('id_usuario', $idUsuario);
		$this->db->update('usuario', $dadosUsuario);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Atualiza os niveis de acesso de um usuario
	 * @param array $niveis com os id dos perfis de acesso
	 * @param int $idUsuario id_usuario
	 * @return boolean
	 */
    public function atualizarPerfilUsuario($niveis,$idUsuario)
    {
        $quantidade = count($niveis);
        if($quantidade > 0){ //antes de deletar verificar se realmente veio niveis
            $this->load->database();
            $this->db->delete('usuario_perfil', array('id_usuario' => $idUsuario)); //deletar para refazer os acessos
            if($this->db->affected_rows() > 0){
                
                foreach($niveis as $nivel){
                    $data = array(
                        'id_usuario' => $idUsuario,
                        'id_perfil'  => $nivel
                    );
                    $this->db->insert('usuario_perfil', $data);
                }
                return true;
            }
            if($this->db->affected_rows() == 0) return false;
        }    
    }
	/**
	* Atualiza dados de um usuario da equipe (ou a criacao do registro na mesmo). Utiliza Active record do Codeigniter.
	* @param $dadosUsuario um array contendo os daddos que serao atualizados no banco (indices = colunas do banco).
	* @param $idUsuario identificacao (int) do usuario para a clausula where() e para averiguar se existe na equipe.
	* @return true se conseguiu atualizar, false do contrario
	*/
	public function atualizarEquipe($dadosUsuarioEquipe)
	{

		$this->load->database();
		$registroConfirmado = false;
		$query = $this->db->query("SELECT id_usuario_equipe FROM usuario_equipe WHERE id_usuario = ".$dadosUsuarioEquipe['id_usuario']);
		if ($query->num_rows() > 0){

			$this->db->where('id_usuario', $dadosUsuarioEquipe['id_usuario']);
			$this->db->update('usuario_equipe', $dadosUsuarioEquipe);
			if($this->db->affected_rows() > 0){
				$registroConfirmado = true;
			}

		}else{
			$this->db->insert('usuario_equipe', $dadosUsuarioEquipe); 
			$registroConfirmado = true;
		}
		return $registroConfirmado;
	}

	/**
	* Retorna informacoes sobre um usuario atraves do seu login (username).
	* @param $login o username do usuario.
	* @return um array com as informacoes do usuario se conseguiu localiza-lo, false do contrario
	*/
	public function getUsuarioLogin($login)
	{

		$this->load->database();
		$query = $this->db->query("SELECT u.id_usuario,MAX(p.id_perfil) as nivel,u.instituicao,u.login,u.nome,u.local,u.email 
		    FROM usuario u, usuario_perfil p WHERE u.id_usuario = p.id_usuario AND u.login = ".$this->db->escape($login));
		if($query->num_rows() > 0){
			$registro = $query->row_array(); 
			return $registro;
		}else{
			return false;
		}
	}

	/**
	 * Retorna todos os niveis de um usuario pelo seu nome de usuario
	 * @param string $login
	 * @return niveis|boolean conjunto de niveis ou false se nada encontrar
	 */
	public function getNiveisUsuario($login)
	{
	    $this->load->database();	    
	    $query = $this->db->query("SELECT p.id_usuario,p.id_perfil FROM `usuario_perfil` p, `usuario` u 
	        WHERE u.id_usuario = p.id_usuario AND u.login = ".$this->db->escape($login));
	    if($query->num_rows() > 0){
	       return $query->result_array();   
	    }
	    if($query->num_rows() == 0) return false;    	    
	}
	
	/**
	* Retorna informacoes sobre um usuario se ele for da equipe atraves do seu login (username).
	* @param $login o username do usuario da equipe.
	* @return um array com as informacoes do usuario se conseguiu localiza-lo, false do contrario
	*/
	public function getUsuarioEquipe($login)
	{

		$this->load->database();
		$query = $this->db->query("SELECT id_usuario FROM usuario WHERE login LIKE ".$this->db->escape($login));
		if ($query->num_rows() > 0){
			$registro = $query->row();
			$query = $this->db->query("SELECT * FROM usuario_equipe WHERE id_usuario = ".$registro->id_usuario);
			$registro = $query->row_array();
			return $registro;
		}else{
			return false;
		}
	}

    /**
     * Metodo ao estilo gambiarra para retorna apenas o coordenador do projeto
     * @return array com os dados do coordenador ou false se nada encontrar
     */
	public function getCoordenador()
	{
		
		$this->load->database();
		$query = $this->db->query('SELECT * FROM usuario u, usuario_equipe e WHERE u.id_usuario=e.id_usuario AND u.id_usuario=2');
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}		
	}

    /**
     * Metodo para retornar todos os usuarios membros da equipe (perfil > registrado).
     * @return array|boolean conjunto com os dados dos usuarios ou false em caso de falhas.
     */
	public function getAllColaboradores()
	{
		
		$colaboradores = array();
		$this->load->database();
// 		$query = $this->db->query('SELECT login,nivel,instituicao,nome,local,email,url_instituicao,
// 	                               instituto,url_instituto,departamento,url_departamento,url_lattes,
// 	                               titulo,descricao,home_page FROM usuario u, usuario_equipe e 
// 		                           WHERE u.id_usuario=e.id_usuario AND u.id_usuario!=2 AND u.nivel > 0 ORDER BY nome');
		$query = $this->db->query('SELECT u.login,p.id_perfil,u.instituicao,u.nome,u.local,u.email,e.url_instituicao,
		    e.instituto,e.url_instituto,e.departamento,e.url_departamento,e.url_lattes,e.titulo,e.descricao,e.home_page
		    FROM usuario u, usuario_equipe e, usuario_perfil p
		    WHERE u.id_usuario=e.id_usuario AND u.id_usuario!=2 AND u.id_usuario = p.id_usuario AND p.id_perfil > 0 ORDER BY nome');
		if ($query->num_rows() > 0){
			$colaboradores = $query->result_array();
			$colaboradores = $this->getFotosColaboradores($colaboradores);
			return $colaboradores;
		}else{
			return false;
		}		
	}
	
	/**
	 * Consulta todos os dados referente a colaboradores de acordo com seu perfil (pesquisadores,colaboradores, etc).
	 * @param integer $perfil codigo do perfil
	 * @param integer $perfil2 codigo de um segundo perfil casa se queira englobar usuarios de 2 perfis diferentes, nao obrigatorio
	 * @return array|boolean conjunto com os dados dos usuarios ou false em caso de falhas.
	 */
	public function getColaboradores($perfil,$perfil2 = null)
	{
	
	    $colaboradores = array();
	    $this->load->database();
	    if($perfil2 != null){
	        $query = $this->db->query('SELECT u.login,u.instituicao,u.nome,u.local,u.email,e.url_instituicao,
	            e.instituto,e.url_instituto,e.departamento,e.url_departamento,e.url_lattes,e.titulo,e.descricao,e.home_page 
	            FROM usuario u, usuario_equipe e, usuario_perfil p
	            WHERE u.id_usuario=e.id_usuario AND u.id_usuario!=2 AND u.id_usuario = p.id_usuario AND 
	            (p.id_perfil = '.$perfil.' OR p.id_perfil = '.$perfil2.') ORDER BY nome');
	    }
	    if($perfil2 == null){
	        $query = $this->db->query('SELECT u.login,u.instituicao,u.nome,u.local,u.email,e.url_instituicao,
	            e.instituto,e.url_instituto,e.departamento,e.url_departamento,e.url_lattes,e.titulo,e.descricao,e.home_page 
	            FROM usuario u, usuario_equipe e, usuario_perfil p
	            WHERE u.id_usuario=e.id_usuario AND u.id_usuario!=2 AND u.id_usuario = p.id_usuario AND 
	            p.id_perfil = '.$perfil.' ORDER BY nome');
	    }
	    if ($query->num_rows() > 0){
	        $colaboradores = $query->result_array();
	        $colaboradores = $this->getFotosColaboradores($colaboradores);
	        return $colaboradores;
	    }else{
	        return false;
	    }
	}
	
	/**
	 * Metodo especifico para retornar informacoes sobre membros da equipe tecnica. 
	 * Este metodo copia getColaboradores() mas consulta para perfis de equipe tecnica e administradores.
	 * @return array|boolean conjunto com os dados dos usuarios ou false em caso de falhas.
	 */
	public function getEquipeTecnica()
	{
	
	    $colaboradores = array();
	    $this->load->database();
	    $query = $this->db->query('SELECT u.login,p.id_perfil as nivel,u.instituicao,u.nome,u.local,u.email,e.url_instituicao,
	        e.instituto,e.url_instituto,e.departamento,e.url_departamento,e.url_lattes,e.titulo,e.descricao,e.home_page 
	        FROM usuario u, usuario_equipe e, usuario_perfil p
	        WHERE u.id_usuario=e.id_usuario AND u.id_usuario!=2 AND u.id_usuario = p.id_usuario AND 
	        (p.id_perfil = 3 OR p.id_perfil = 999) ORDER BY nome');
	    if ($query->num_rows() > 0){
	        $colaboradores = $query->result_array();
	        $colaboradores = $this->getFotosColaboradores($colaboradores);
	        return $colaboradores;
	    }else{
	        return false;
	    }
	}

    /**
     * Consulta usuarios registrados
     * @return array com login e nome dos usuarios registrados ou false em caso de falhas
     */
	public function getRegistrados()
	{

		$this->load->database();
		$query = $this->db->query('SELECT login,nome FROM usuario ORDER BY nome ASC');
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}	
	}

	/**
	* Metodo que retorna a estrutura de tipos de acesso adotado nesse sistema.
	* @return array com os tipos (niveis) de acesso para os usuarios registrados.
	*/
	public function getNiveisAcesso()
	{
        $this->load->database();
        $query = $this->db->query('SELECT nivel as valor,nome FROM perfil');
        if ($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
	}

    /**
     * Metodo que insere no servidor a foto que o usuario escolheu para seu perfil na equipe
     * @param integer $idUsuarioEquipe identificador do usuario_equipe no banco
     */
	public function setFoto($idUsuarioEquipe)
	{

		$diretorioDestino = PORTALIMAGES.'equipe/usuarios/'; //local final dos arquivos de fotos
		$arquivoUsuario = $_FILES['uploadFoto']['name'];
		$arquivoUsuario = explode(".",$arquivoUsuario); //pra pegar extensao do arquivo do usuario

		//verificando se arquivo eh aceitavel
		if( ($arquivoUsuario[1] == 'jpg') || ($arquivoUsuario[1] == 'jpeg') || ($arquivoUsuario[1] == 'png') ){

			unlink($diretorioDestino.$idUsuarioEquipe.'.jpg'); //apagando arquivos anteriores se usuario postar novos fotos
			unlink($diretorioDestino.$idUsuarioEquipe.'.jpeg');
			unlink($diretorioDestino.$idUsuarioEquipe.'.png');
			$arquivoFinal = $diretorioDestino.$idUsuarioEquipe.'.'.$arquivoUsuario[1]; //montando caminho absoluto final

			if (move_uploaded_file($_FILES['uploadFoto']['tmp_name'], $arquivoFinal)) { //carregamento final
				$mensagem = "O arquivo foi carregado com sucesso. Reabra o formulário para averiguar as atualizações.";
				chmod($arquivoFinal, 0777);
				//print_r($_FILES);
			} else {
				$mensagem = "Erro, tamanho máximo excedido ou o arquivo não pode ser copiado para servidor.";
				//print_r($_FILES);
			}

		}else{
			$mensagem = 'Arquivo inválido.';
		}			
		echo $mensagem;

	}

	/**
	* Metodo que retorna o caminho completo da foto de um determinado usuario atraves do seu nome de registro.
	* Se usuario nao possuir fotos, uma imagem padrao eh apontada.
	* @param $login o login do usuario.
	* @return uma string com o caminho absoluto da foto ou false em caso de falhas.
	*/
	public function getFotoUsuario($login)
	{

		$this->load->database();
		$query = $this->db->query("SELECT e.id_usuario_equipe FROM usuario_equipe e, usuario u WHERE u.login LIKE ".$this->db->escape($login)." and u.id_usuario = e.id_usuario");
		if ($query->num_rows() > 0){
			$registro = $query->row();
			$arquivoFinal = base_url().'images/equipe/usuarios/';
			$arquivoUsuario = ''; //no caso de nao existir arquivo de foto

			// abre o diretório
		    $ponteiro  = opendir(PORTALIMAGES.'equipe/usuarios/');
		    // monta os vetores com os itens encontrados na pasta
		    while ($nomeArquivo = readdir($ponteiro)) {

				//verificando arquivos no diretorios
				$verificaArquivo = $nomeArquivo;
				//expressao regular \bexp\b procura somente/exatamente por 'exp'
				if( preg_match('/\b'.$registro->id_usuario_equipe.'.jpg\b/',$verificaArquivo) ){
					$arquivoUsuario = $verificaArquivo; 
					break;				
				}

				if( preg_match('/\b'.$registro->id_usuario_equipe.'.jpeg\b/',$verificaArquivo) ){
					$arquivoUsuario = $verificaArquivo;
					break;				
				}

				if( preg_match('/\b'.$registro->id_usuario_equipe.'.png\b/',$verificaArquivo) ){
					$arquivoUsuario = $verificaArquivo;
					break;				
				}
	
			}

			if( $arquivoUsuario === ''){ //se usuario nao tem foto coloca uma imagem padrao			    
				$arquivoUsuario = 'sem_foto.jpeg';
			}
			$arquivoFinal .= $arquivoUsuario;
			return $arquivoFinal;

		}else{
			return false;
		}
	}
    
	/**
	 * Retorna conjunto dad fotos (nome dos arquivos) dos colaboradores da pagina equipe.
	 * @param array $colaboradores contendo o login dos colaboradores.
	 * @return array com loginn e nomes do arquivos das fotos dos colaboradores.
	 */
	public function getFotosColaboradores($colaboradores)
	{
		
	    $limite = count($colaboradores);
		for($i = 0; $i<$limite; ++$i){
			$colaboradores[$i]['foto'] = $this->getFotoUsuario($colaboradores[$i]['login']);
		}
		return $colaboradores;
	}
	
	/**
	 * Funcao para inserir no log do sistema.
	 * @param array $usuario com nome e login do usuario.
	 * @param string $data com data e horario no formato para o banco (use a funcao date("Y-m-d H:i:s") do PHP).
	 * @param string $operacao mensagem/descricao detalhada da operaco realizada pelo usuario
	 * @param string $tabela nomes das tabelas ou procedimentos relacionados a operacao (separe por virgulas se afetar mais que um local e utilize sublinha ao inves de espacos).
	 */
	public function setLog($usuario,$data,$operacao,$tabela)
	{
	    $dados = array(
	    	'nomeusuario' => $usuario['nome'],
	        'login'       => $usuario['login'],
	        'ip'          => $this->session->userdata('ip_address'),
	        'datahorario' => $data,
	        'operacao'    => $operacao,
	        'tabela'      => $tabela   	    
	    );
	    $this->db->insert('logs',$dados);	    
	}
	
	
	/**
	 * Retorna informacoes dos usuarios,pelo seu nivel de acesso. Possui a semantica correta em relacao a outras 
	 * funcoes como a getColaboradores() por selecionar mesmos aqueles que nao possuem informacoes de equipe.
	 * @param int $nivel o nivel de acesso ao qual o(s) usuario(s) possui(em)
	 * @return array|boolean conjunto de informacoes ou false se nada encontrar
	 */
	public function getUsuariosListaPorNivel($nivel)
	{
	    $usuarios = array();
	    $this->load->database();
	    $query = $this->db->query('SELECT usuario.login,usuario.instituicao,usuario.nome,usuario.local,usuario.email,
	        usuario_equipe.url_instituicao,usuario_equipe.instituto,usuario_equipe.url_instituto,
	        usuario_equipe.departamento,usuario_equipe.url_departamento,usuario_equipe.url_lattes,
	        usuario_equipe.titulo,usuario_equipe.descricao,usuario_equipe.home_page 
	        FROM usuario LEFT JOIN usuario_equipe ON usuario.id_usuario = usuario_equipe.id_usuario 
	        INNER JOIN usuario_perfil ON usuario.id_usuario = usuario_perfil.id_usuario 
	        WHERE usuario_perfil.id_perfil = '.$nivel.' ORDER BY usuario.nome');
	    if ($query->num_rows() > 0){
	        $usuarios = $query->result_array();	
	        $usuarios = $this->getFotosColaboradores($usuarios);        
	        return $usuarios;
	    }
	    if ($query->num_rows() <= 0) return false;	    
	}

	
	/**
	 * Retorna o maior nivel de acesso de um usuario pelo seu nome de usuario
	 * @param string $login
	 * @return int|boolean o nivel de acesso ou false se nada encontrar
	
	public function getNivelUsuario($login)
	{
	    $this->load->database();
	    $query = $this->db->query("SELECT MAX(p.id_perfil) as nivel FROM `usuario` u, `usuario_perfil` p 
	        WHERE u.id_usuario = p.id_usuario and login = ".$this->db->escape($login));
	    
	    if($query->num_rows() == 0) return false;
	    if ($query->num_rows() > 0)
	    {
	        $row = $query->row();
	        return $row->nivel;	        
	    }
	}
	 */
}
