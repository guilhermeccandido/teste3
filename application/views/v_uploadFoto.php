<form name="alteraFoto" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>inicial/carregaFoto">
	<input type="file" name="uploadFoto" />
	<input type="hidden" name="id_usuario_equipe" value="<?php echo $idUsuario; ?>" />
	<input type="submit" value="Clique aqui para alterar foto" />
</form>
<p>Arquivos aceitos: JPG, JPEG, PNG.</p>
