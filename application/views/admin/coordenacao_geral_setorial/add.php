    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo 'Home';?>
	          </a> 	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/coordenacao_geral'; ?>">
	            <?php echo 'Coordenação Geral';?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/coordenacao_geral_setorial/'.$id_coordenacao_geral; ?>">
	          <?php echo 'Coordenações Setoriais';?>
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
			  
			  $options_coordenacao_setorial = array();
		      foreach ($coordenacao_setorial as $row)
		      {
		      	$options_coordenacao_setorial[$row["id"]] = $row["titulo"];
		      }
			  /*
			  echo '<div class="form-group col-lg-12">';
		          echo '<div class="input-group col-lg-8">';		          
		          	echo form_dropdown('id_', $options_, set_value('id_'), 'class="form-control"');
					echo '<span class="input-group-addon">XXXXXXX</span>';			          
		          echo '</div>';
	          echo '</div>';	
			  */
			  
				
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/coordenacao_geral_setorial/add/".$id_coordenacao_geral, $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>
		       <input class="form-control" type="hidden" id="id_coordenacao_geral" name="id_coordenacao_geral"  placeholder="Coordenação Geral" value="<?php echo $id_coordenacao_geral; ?>" >
		            
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('id_coordenacao_setorial', $options_coordenacao_setorial, set_value('id_coordenacao_setorial'), 'class="form-control"');?>
		            <span class="input-group-addon">Coordenação Setorial</span>
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