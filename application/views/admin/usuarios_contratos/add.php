    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/usuario'; ?>">
	            <?php echo ucfirst("usuario") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$id_usuario; ?>">
	          <?php echo ucfirst($this->uri->segment(2));?>
	         </a>
	        </li>
	        <li class="active">
	          Novo
	        </li>
	      </ol> 
	      <?php
	      //flash messages
	      if(isset($flash_message)){
	        if($flash_message == TRUE)
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> novo registro adicionado com sucesso.';
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
    
			  $options_contratos = array();
		      foreach ($contratos as $row)
		      {
		      	$options_contratos[$row["id"]] = $row["contrato"];
		      }
    
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/usuarios_contratos/add/".$id_usuario, $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
			  <input class="form-control" type="hidden" id="id_usuario" name="id_usuario"  value="<?php echo $id_usuario; ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_contratos", $options_contratos, set_value("id_contratos"), 'class="form-control"' );?>
		            <span class="input-group-addon">contratos</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"   rows="5" id="observacoes" name="observacoes" placeholder="Observações" ><?php echo set_value('observacoes'); ?></textarea>
		            <span class="input-group-addon">Observações</span>
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
	   	</div>        </div>