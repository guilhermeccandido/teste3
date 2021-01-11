    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/anteprojetos'; ?>">
	            <?php echo ucfirst("anteprojetos") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$id_anteprojetos; ?>">
	          Imagens
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
		      $attributes = array("class" => "form-horizontal", "id" => "", "enctype" => "multipart/form-data");

			  $options_categorias_selected =  explode(" ", set_value('categoria') );
		      
    		  $options_categorias_imagens = array();    		  
		      foreach ($categorias_imagens as $row)
		      {
		      	$options_categorias_imagens[$row["titulo"]] = $row["titulo"];
		      }
			  
    
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/anteprojetos_imagens/add/".$id_anteprojetos, $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
			  <input class="form-control" type="hidden" id="id_anteprojetos" name="id_anteprojetos"  value="<?php echo $id_anteprojetos; ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="titulo" name="titulo"  placeholder="Título" value="<?php echo set_value('titulo'); ?>" >
		            <span class="input-group-addon">Título</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_registro" name="data_registro"  placeholder="Data Registro" value="<?php echo set_value('data_registro'); ?>" >
		            <span class="input-group-addon">Data Registro</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_multiselect('categoria[]', $options_categorias_imagens, $options_categorias_selected, 'class="form-control" ' ); ?>
		            <span class="input-group-addon">Categoria</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"  type="textarea" rows="5" id="descricao" name="descricao" placeholder="Descrição" ><?php echo set_value('descricao'); ?></textarea>
		            <span class="input-group-addon">Descrição</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
	            <div class="input-group col-lg-8">
	              <input class="form-control" id="file"  name="file"  type="file">
	              <span class="input-group-addon">Arquido de Imagem</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"  type="textarea" rows="5" id="observacoes" name="observacoes" placeholder="Observações" ><?php echo set_value('observacoes'); ?></textarea>
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