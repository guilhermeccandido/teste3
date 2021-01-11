<?php if(!$this->session->userdata('logged_in')) $this->load->view('/mobile/v_principal'); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div data-role="page" id="pageMensagemForms" data-theme="a">
    <div data-role="content" data-theme="a"> 
        <?php echo $mensagem; ?>
         <a href="<?php echo base_url();?>mobile/opcoesAdmin/menuInicial" data-role="button" data-transition="slide" data-icon="back" data-iconpos="left">
        Voltar ao menu principal</a>
        <a href="<?php echo base_url();?>mobile/logout" data-role="button" data-transition="slidedown" data-icon="home" data-iconpos="left">
        Sair</a>
    </div>
</div>
</body>
</html>