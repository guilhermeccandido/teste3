<?php if(!$this->session->userdata('logged_in')) $this->load->view('/mobile/v_principal'); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div data-role="page" id="pageFormConfigBoiaSensor" data-theme="a">
    <div data-role="content" data-theme="a"> 
        <h3>Desativando Sensores</h3>
        <p>Escolhe uma boia abaixo e clique em Editar</p>
        <form name="configBoia" id="configBoia" method="post" action="<?php echo base_url(); ?>mobile/formDesativarSensor">    	
            	<select id="boia" name="boia">   
            	<?php		
            		foreach($boias as $boia){
            			if($this->session->userdata('tipo') == 999 ) echo '<option value="'.$boia['id_fundeio'].'">Boia '.$boia['titulo'].'</option>';
            			if( ($this->session->userdata('tipo') != 999) && ($boia['titulo'] == 'PR-2') ) echo '<option value="'.$boia['id_fundeio'].'">Boia '.$boia['titulo'].'</option>';
            		}
            	?>
            	</select><br />
            	<input class="submit" type="submit" name="Editar" value="Editar" data-icon="arrow-r" data-iconpos="right" />
        </form>    
        <a href="<?php echo base_url();?>mobile/opcoesAdmin/sensores" data-role="button" data-transition="slide" data-icon="arrow-l" data-iconpos="left">
        Voltar</a>
    </div>
</div>
</body>
</html>