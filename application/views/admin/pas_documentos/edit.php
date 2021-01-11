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
	          <a href="<?php echo site_url("admin").'/pas_documentos/lista_documento/'.$pas_documentos[0]['id_pas']?>">
	            Documentos
	          </a> 
	          
	        </li>	        
	        <li class="active">
	          <?php echo 'Lote '.$pas[0]['lote']; ?>
	        </li>
	      </ol>
	     <?php
	      //flash messages
	      if($this->session->flashdata('flash_message')){
	        if($this->session->flashdata('flash_message') == 'updated')
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> pas_documentos editado com sucesso.';
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
		      $attributes = array("class" => "form-horizontal", "id" => "", "enctype" => "multipart/form-data" );
		      
		      $options_documentos = array();
		      $options_documentos['tecnico'] = 'Técnico';
		      $options_documentos['processual'] = 'Processual';
		      
    		  /*
    		  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }	
    		  <?php 
				     echo 
				     	  '<div class="control-group">
				            <label for="inputError" class="control-label">Classe </label>
				            <div class="controls">';
				              
		    		 echo form_dropdown('id_', $options_, pas_documentos[0]['id_'] );	
				     echo          
				            '</div>
				          </div>';	
			  ?>
    		  */
		      //form validation
		      echo validation_errors();
    
		      
		     ?>
		   <div class="row">
            <div class="col-lg-10">		     
		     <?php echo form_open("admin/pas_documentos/update/".$this->uri->segment(4), $attributes); ?>
		     <fieldset>
		     	  <legend>Atualizar</legend>
		          <input type="hidden" id="" name="id_pas" value="<?php echo $pas_documentos[0]['id_pas']; ?>" >
		          <input type="hidden" id="" name="nome" value="<?php echo $pas_documentos[0]['nome']; ?>" >
		          <div class="form-group col-lg-12">		          
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" placeholder="Documento" id="titulo" name="titulo" value="<?php echo $pas_documentos[0]['titulo']; ?>" >
		              <span class="input-group-addon">Documento</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <?php echo form_dropdown('tipo', $options_documentos, $pas_documentos[0]['tipo'], 'class="form-control"'); ?>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <textarea class="form-control" type="text" placeholder="Observação" row="3" id="observacao" name="observacao" ><?php echo $pas_documentos[0]['observacao']; ?></textarea>
		              <!--<span class="help-inline">Woohoo!</span>-->
		            </div>
		          </div>
		           <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" id="file"  name="file"  type="file">
		              <span class="help-block">Caso selecione um novo arquivo, o arquivo do sistema será substituido</span>
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