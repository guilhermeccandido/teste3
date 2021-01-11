<?php if(!$this->session->userdata('logged_in')) $this->load->view('/mobile/v_principal'); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div data-role="page" id="pageAcessoSensores" data-theme="a">
    <div data-role="content" data-theme="a">    
		<ul data-role="listview" data-divider-theme="a" data-inset="true">
			<li data-role="list-divider" role="heading">
				Opções - Sensores
			</li>
			<li data-theme="a">
				<a href="<?php echo base_url();?>mobile/desativandoSensores" data-transition="slide">
				    Desativar Sensores
				</a>
			</li>				
		</ul>
		<a href="<?php echo base_url();?>mobile/opcoesAdmin/menuInicial" data-role="button" data-transition="slide" data-icon="arrow-l" data-iconpos="left">
        Voltar</a>  
		<a href="<?php echo base_url();?>mobile/logout" data-role="button" data-transition="slide" data-icon="home" data-iconpos="left">
        Sair</a>  
    </div>
</div>
</body>
</html>