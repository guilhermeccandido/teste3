<?php if(!$this->session->userdata('logged_in')) $this->load->view('/mobile/v_principal'); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div data-role="page" id="pageAcesso" data-theme="a">
    <div data-role="content" data-theme="a">    
		<ul data-role="listview" data-divider-theme="a" data-inset="true">
			<li data-role="list-divider" role="heading">
				Opções
			</li>
			<li data-theme="a">
				<a href="<?php echo base_url();?>mobile/opcoesAdmin/boias" data-transition="slide">
				    Boias
				</a>
			</li>
			<li data-theme="a">
				<a href="<?php echo base_url();?>mobile/opcoesAdmin/sensores" data-transition="slide">
				    Sensores
				</a>
			</li>			
		</ul>
		<a href="<?php echo base_url();?>mobile/logout" data-role="button" data-transition="slide" data-icon="home" data-iconpos="left">
        Sair</a>        
    </div>
</div>
</body>
</html>