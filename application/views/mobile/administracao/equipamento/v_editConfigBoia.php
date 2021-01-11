<?php if(!$this->session->userdata('logged_in')) $this->load->view('/mobile/v_principal'); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div data-role="page" id="pageConfigBoia" data-theme="a">
    <div data-role="content" data-theme="a"> 
        <h3>Boia <?php echo $boia['titulo']; ?></h3>
        <form name="formeditar" id="formeditar" method="post" action="<?php echo base_url(); ?>mobile/configurarBoia">
        	    	
                <label for="download">Download FTP:</label>
                <?php
                    if($configuracao->download == 1){
                ?>         
                        <select name="download" id="download" data-role="slider">
                        	<option value="0">OFF</option>
                        	<option value="1" selected="selected">ON</option>
                        </select>                    
                <?php 
                    }
                    if($configuracao->download != 1){
                ?>
                        <select name="download" id="download" data-role="slider">
                        	<option value="0" selected="selected">OFF</option>
                        	<option value="1">ON</option>
                        </select>   
                <?php 
                    } 
                ?>
                <br /><label for="processar">Processar Dados:</label>
                 <?php
                    if($configuracao->processar == 1){
                ?>
                        <select name="processar" id="processar" data-role="slider">
                        	<option value="0">OFF</option>
                        	<option value="1" selected="selected">ON</option>
                        </select>
                <?php 
                    }
                    if($configuracao->processar != 1){
                ?>
                        <select name="processar" id="processar" data-role="slider">
                        	<option value="0" selected="selected">OFF</option>
                        	<option value="1">ON</option>
                        </select>
                <?php 
                    } 
                ?>
                <br /><br /><label>Definir status:</label>
                <select name="status" id="status">
                    <?php foreach($status as $stats){
                        if($configuracao->id_status == $stats['id_status']) echo '<option value="'.$stats['id_status'].'" selected="selected">'.$stats['titulo'].'</option>';
                        if($configuracao->id_status != $stats['id_status']) echo '<option value="'.$stats['id_status'].'">'.$stats['titulo'].'</option>';
                    }?>
                </select>
                <input type="hidden" name="boiaId" value="<?=$configuracao->id_fundeio;?>">
            	<br />
            
            	<input class="submit" type="submit" name="salvar" value="Salvar" data-icon="check" data-iconpos="right" />
    
        </form>
         <a href="<?php echo base_url();?>mobile/opcoesAdmin/boias" data-role="button" data-transition="slide" data-icon="arrow-l" data-iconpos="left">
        Voltar</a>
    </div>
</div>
</body>
</html>