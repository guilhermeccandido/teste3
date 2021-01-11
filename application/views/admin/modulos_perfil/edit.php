<?php 
	$options_modulos = array();
	foreach($modulos as $row){
		$options_modulos[$row['id']] = $row['titulo'];
	}
	
	$options_perfil = array();
	foreach($perfil as $row){
		$options_perfil[$row['id']] = $row['titulo'];
	}
	
	$options_submodulos = array();
	foreach($submodulos as $row){
		$options_submodulos[$row['id']] = $row['titulo'];
	}
?>

<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/modulos'; ?>">
	            <?php echo ucfirst("modulos") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$modulos_perfil[0]['id_modulos'] ; ?>">
	          Módulos Perfil
	         </a>
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/lista_submodulos/".$modulos_perfil[0]['id_modulos']."/".$modulos_perfil[0]['id_usuario_perfil']  ; ?>">
	          Perfil Submódulos
	         </a>
	        </li>
	        <li class="active">
	          Update
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
	      	<?php echo   $options_modulos[$modulos_perfil[0]['id_modulos']]." / "
						.$options_perfil[$modulos_perfil[0]['id_usuario_perfil']]." / "
						.$options_submodulos[$modulos_perfil[0]['id_submodulo']]; ?> 
	      	</h2>
	      </div>
	     <?php
	      //flash messages
	      if($this->session->flashdata('flash_message')){
	        if($this->session->flashdata('flash_message') == 'updated')
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> editado com sucesso.';
	          echo '</div>';       
	        }else{
	          echo '<div class="alert alert-danger alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Oh snap!</strong> mude algumas coisas e tente novamente.';
	          echo '</div>';          
	        }
	      }
	      ?>
		    <?php
		      //form data
		      $attributes = array("class" => "form-horizontal", "id" => "");
    		  
		      $options_acesso = array('visualizar' => 'Visualizar', 'editar' => 'Editar', 'negado' => 'Negado' );
		      
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/modulos_perfil/update/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6) , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_modulos" name="id_modulos"  value="<?php echo $modulos_perfil[0]['id_modulos'] ?>" >
			  <input class="form-control" type="hidden" id="id_usuario_perfil" name="id_usuario_perfil"  value="<?php echo $modulos_perfil[0]['id_usuario_perfil']; ?>" >
			  <input class="form-control" type="hidden" id="id_submodulo" name="id_submodulo"  value="<?php echo $modulos_perfil[0]['id_submodulo']; ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("acesso", $options_acesso, set_value("acesso") ? set_value("acesso") : $modulos_perfil[0]['acesso'], 'class="form-control"' );?>
		            <span class="input-group-addon">Acesso</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control"  rows="5" placeholder="Descrição" id="descricao" name="descricao"><?php echo set_value('descricao') ?  set_value('descricao') :  $modulos_perfil[0]['descricao']; ?></textarea>
	              <span class="input-group-addon">Descrição</span>
	            </div>
	          </div>
	          <div class="form-group">
	          	<div class="col-lg-6">
	            	<button class="btn btn-primary" type="submit">Salvar Modificações</button>
	            	<button class="btn btn-default" type="reset">Cancelar</button>
    			</div>
	          </div>
	        </fieldset>
	      <?php echo form_close(); ?>
    	</div>
	   </div>
</div>