    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            Home
	          </a> 	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/gestao_estudos_projetos'; ?>">
	            Gestão de Estudos e Projetos
	          </a> 	          
	        </li>
    		<li>
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	            EVTEAS
	          </a> 	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/pas_documentos/lista_documento/'.$id_pas ?>">
	            Documentos
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo 'Lote '.$pas[0]['lote']; ?>
	        </li>
	      </ol>    
	      <?php
	      //flash messages
	      if(isset($flash_message)){
	        if($flash_message == TRUE)
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> novo  pas_documentos criado com sucesso.';
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
		      
		      $options_documentos = array();
		      $options_documentos['tecnico'] = 'Técnico';
		      $options_documentos['processual'] = 'Processual';
		      
		      /*
		      foreach ($documentos as $row)
		      {
		      	$options_documentos[$row["id"]] = $row["titulo"];
		      }
		      */
			  /*
			  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }
			  
			  echo '<div class="form-group">';
		          echo '<label for="inputError" class="control-label">Camada</label>';
		          echo '<div class="controls">';			          
		          	echo form_dropdown('id_', $options_, set_value('id_'), 'class="span2"');			          
		          echo '</div>';
	          echo '</div>';	
				
			  */
				
		      //form validation
		      echo validation_errors();
		      
		      
		     ?>
		   <div class="row">
            <div class="col-lg-10">		     
		     <?php echo form_open("admin/pas_documentos/add/".$id_pas, $attributes);?>
		     <fieldset>
		     <legend>Adicionar</legend>
		     	<div class="form-group">
		          <input type="hidden" id="" name="id_pas" value="<?php echo $id_pas; ?>" >
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" placeholder="Documento" type="text" id="titulo" name="titulo" value="<?php echo set_value('titulo'); ?>" >
		              <!--<span class="help-inline">Woohoo!</span>-->
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <?php echo form_dropdown('tipo', $options_documentos, set_value('tipo'), 'class="form-control"'); ?>
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <textarea class="form-control" placeholder="Observações" row="3" type="text" id="" name="observacao" ><?php echo set_value('observacao'); ?></textarea>
		              <!--<span class="help-inline">Woohoo!</span>-->
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" id="file"  name="file"  type="file">
		              <!--<span class="help-inline">Woohoo!</span>-->
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