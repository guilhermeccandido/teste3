    <div class="container top">
	      <ol class="breadcrumb">	        
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            <?php echo ucfirst($this->uri->segment(2));?>
	          </a> 
	          
	        </li>
	        <li class="active">
	          <a href="">Update</a>
	        </li>
	      </ol>
	     <?php
	      //flash messages
	      if($this->session->flashdata('flash_message')){
	        if($this->session->flashdata('flash_message') == 'updated')
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> anteprojetos editado com sucesso.';
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
		      
		      $options_fases = array('Elaboração' => 'Elaboração', 'Análise' => 'Análise', 'Revisão' => 'Revisão' , 'Suspenso' => 'Suspenso' );
		       
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
				              
		    		 echo form_dropdown('id_', $options_, anteprojetos[0]['id_'] );	
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
		     <?php echo form_open("admin/anteprojetos/update/".$this->uri->segment(4), $attributes); ?>
		     <fieldset>
		     	<legend>Editar</legend>
		      	<input type="hidden" id="" name="id_empreendimento" value="<?php echo $anteprojetos[0]['id_empreendimento']; ?>" >
		     	  <div class="form-group col-lg-12">
		     	      <div class="input-group col-lg-8">
		              <input class="form-control" type="text" placeholder="Prioridade" id="" name="prioridade" value="<?php echo  set_value('prioridade') ?  set_value('prioridade') : $anteprojetos[0]['prioridade'] ;?>" >
		              <span class="input-group-addon">Prioridade</span>
		            </div>
		          </div>
		           <div class="form-group col-lg-12">
		     	      <div class="input-group col-lg-8">
		              <input class="form-control" type="text" placeholder="titulo" id="" name="titulo" value="<?php echo set_value('titulo') ?  set_value('titulo') : $anteprojetos[0]['titulo']; ?>" >
		              <span class="input-group-addon">Título</span>
		            </div>
		          </div>
		     	  <div class="form-group col-lg-12">
		     	      <div class="input-group col-lg-8">
		     	      
		              <input class="form-control" type="text" placeholder="Rodovia" id="" name="rodovia" value="<?php echo  set_value('rodovia') ?  set_value('rodovia') :  $anteprojetos[0]['rodovia']; ?>" >
		              <span class="input-group-addon">Rodovia</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              
		              <input class="form-control" type="text" placeholder="UF" id="" name="uf" value="<?php echo set_value('uf') ?  set_value('uf') : $anteprojetos[0]['uf']; ?>" >
		              <span class="input-group-addon">UF</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              
		              <input class="form-control" type="text" placeholder="Km Inicial" id="" name="km_inicial" value="<?php echo set_value('km_inicial') ?  set_value('km_inicial') :  $anteprojetos[0]['km_inicial']; ?>" >
		              <span class="input-group-addon">Km Inicial</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              
		              <input class="form-control" type="text" placeholder="Km Final" id="" name="km_final" value="<?php echo set_value('km_final') ?  set_value('km_final') : $anteprojetos[0]['km_final']; ?>" >
		              <span class="input-group-addon">Km Final</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              
		              <input class="form-control" type="text" placeholder="Extensão" id="" name="extensao" value="<?php echo set_value('extensao') ?  set_value('extensao') : $anteprojetos[0]['extensao']; ?>" >
		              <span class="input-group-addon">Extensão</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              
		              <input class="form-control" type="text" placeholder="Lotes" id="" name="lotes" value="<?php echo set_value('lotes') ?  set_value('lotes') : $anteprojetos[0]['lotes']; ?>" >
		              <span class="input-group-addon">Lotes</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              
		              <input class="form-control" type="text" placeholder="Subtrecho" id="" name="subtrecho" value="<?php echo set_value('subtrecho') ?  set_value('subtrecho') : $anteprojetos[0]['subtrecho']; ?>" >
		              <span class="input-group-addon">Subtrecho</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Intervenção" id="" name="intervencao" value="<?php echo set_value('intervencao') ?  set_value('intervencao') : $anteprojetos[0]['intervencao']; ?>" >
		              <span class="input-group-addon">Intervenção</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="status" id="" name="status" value="<?php echo set_value('status') ?  set_value('status') : $anteprojetos[0]['status']; ?>" >
		              <span class="input-group-addon">Status</span>
		            </div>
		          </div>
		          <!-- 
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="progresso" id="" name="progresso" value="<?php echo  set_value('progresso') ?  set_value('progresso') : $anteprojetos[0]['progresso']; ?>" >
		              <span class="input-group-addon">Progresso</span>
		            </div>
		          </div>
		           -->
		           
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Inicial Anteprojeto" id="" name="data_ini_anteprojeto" value="<?php echo  set_value('data_ini_anteprojeto') ?  set_value('data_ini_anteprojeto') : $anteprojetos[0]['data_ini_anteprojeto']; ?>" >
		              <span class="input-group-addon">Data Inicial Anteprojeto</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Final Anteprojeto" id="" name="data_fim_anteprojeto" value="<?php echo  set_value('data_fim_anteprojeto') ?  set_value('data_fim_anteprojeto') : $anteprojetos[0]['data_fim_anteprojeto']; ?>" >
		              <span class="input-group-addon">Data Final Anteprojeto</span>
		            </div>
		          </div>
		          
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <?php echo form_dropdown('fase1', $options_fases, set_value('fase1') ?  set_value('fase1') : $anteprojetos[0]['fase1'], 'class="form-control"'); ?>
		              <span class="input-group-addon">Status Fase 1</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Progresso Fase 1" id="" name="progresso1" value="<?php echo set_value('progresso1') ?  set_value('progresso1') : $anteprojetos[0]['progresso1']; ?>" >
		              <span class="input-group-addon">Progresso (Fase 1)%</span>
		            </div>
		          </div>
		           
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Inicial Fase 1" id="" name="data_ini_fase1" value="<?php echo  set_value('data_ini_fase1') ?  set_value('data_ini_fase1') : $anteprojetos[0]['data_ini_fase1']; ?>" >
		              <span class="input-group-addon">Data Inicial Fase 1</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Final Fase 1" id="" name="data_fim_fase1" value="<?php echo  set_value('data_fim_fase1') ?  set_value('data_fim_fase1') : $anteprojetos[0]['data_fim_fase1']; ?>" >
		              <span class="input-group-addon">Data Final Fase 1</span>
		            </div>
		          </div>
		          
		          
		          <!-- fase 2 -->
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <?php echo form_dropdown('fase2', $options_fases, set_value('fase2') ?  set_value('fase2') : $anteprojetos[0]['fase2'], 'class="form-control"'); ?>
		              <span class="input-group-addon">Status Fase 2</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Progresso Fase 2" id="" name="progresso2" value="<?php echo set_value('progresso2') ?  set_value('progresso2') : $anteprojetos[0]['progresso2']; ?>" >
		              <span class="input-group-addon">Progresso (Fase 2)%</span>
		            </div>
		          </div>
		           
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Inicial Fase 2" id="" name="data_ini_fase2" value="<?php echo  set_value('data_ini_fase2') ?  set_value('data_ini_fase2') : $anteprojetos[0]['data_ini_fase2']; ?>" >
		              <span class="input-group-addon">Data Inicial Fase 2</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Final Fase 2" id="" name="data_fim_fase2" value="<?php echo  set_value('data_fim_fase2') ?  set_value('data_fim_fase2') : $anteprojetos[0]['data_fim_fase2']; ?>" >
		              <span class="input-group-addon">Data Final Fase 2</span>
		            </div>
		          </div>
		          <!-- fase 3 -->
		           <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <?php echo form_dropdown('fase3', $options_fases, set_value('fase3') ?  set_value('fase3') : $anteprojetos[0]['fase3'], 'class="form-control"'); ?>
		              <span class="input-group-addon">Status Fase 3</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Progresso Fase 3" id="" name="progresso3" value="<?php echo set_value('progresso3') ?  set_value('progresso3') : $anteprojetos[0]['progresso3']; ?>" >
		              <span class="input-group-addon">Progresso (Fase 3)%</span>
		            </div>
		          </div>
		           
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Inicial Fase 3" id="" name="data_ini_fase3" value="<?php echo  set_value('data_ini_fase3') ?  set_value('data_ini_fase3') : $anteprojetos[0]['data_ini_fase3']; ?>" >
		              <span class="input-group-addon">Data Inicial Fase 3</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="date" placeholder="Data Final Fase 3" id="" name="data_fim_fase3" value="<?php echo  set_value('data_fim_fase3') ?  set_value('data_fim_fase3') : $anteprojetos[0]['data_fim_fase3']; ?>" >
		              <span class="input-group-addon">Data Final Fase 3</span>
		            </div>
		          </div>
		                  
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Concepção" id="" name="concepcao" value="<?php echo set_value('concepcao') ?  set_value('concepcao') : $anteprojetos[0]['concepcao']; ?>" >
		              <!--<span class="help-inline">Woohoo!</span>-->
		              <span class="input-group-addon">Concepção</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Desenvolvimento" id="" name="desenvolvimento" value="<?php echo set_value('desenvolvimento') ?  set_value('desenvolvimento') : $anteprojetos[0]['desenvolvimento']; ?>" >
		              <span class="input-group-addon">Desenvolvimento</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Documentação" id="" name="documentacao" value="<?php echo set_value('documentacao') ?  set_value('documentacao') : $anteprojetos[0]['documentacao']; ?>" >
		              <span class="input-group-addon">Documentação</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="Empresa Responsável" id="" name="empresa_responsavel" value="<?php echo set_value('empresa_responsavel') ?  set_value('empresa_responsavel') : $anteprojetos[0]['empresa_responsavel']; ?>" >
		              <span class="input-group-addon">Empresa Responsável</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="lat" id="" name="lat" value="<?php echo set_value('lat') ?  set_value('lat') : $anteprojetos[0]['lat']; ?>" >
		              <span class="input-group-addon">Latitude</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">		              
		              <input class="form-control" type="text" placeholder="lon" id="" name="lon" value="<?php echo set_value('lon') ?  set_value('lon') : $anteprojetos[0]['lon']; ?>" >
		              <span class="input-group-addon">Longitude</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-12">
		              <textarea class="form-control" rows="5" placeholder="Descrição" id="descricao" name="descricao"><?php echo set_value('descricao') ?  set_value('descricao') : $anteprojetos[0]['descricao']; ?></textarea>
		               <span class="input-group-addon">Descrição</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-12">
		              <textarea class="form-control"  rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') : $anteprojetos[0]['observacoes']; ?></textarea>
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
	    </div>
	   </div>
	   
<script>
	$(document).ready(
			function () { 
				var editor = CKEDITOR.replace( 'observacoes',
		 				{
							toolbar :
							 [
							 ['Source','-','Save','NewPage','Preview','-','Templates'],
							 ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
							 ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
							 ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
							 '/',
							 ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
							 ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
							 ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
							 ['Link','Unlink','Anchor'],
							 ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
							 '/',
							 ['Styles','Format','Font','FontSize'],
							 ['TextColor','BGColor'],
							 ['Maximize', 'ShowBlocks','-','About']
							 ],
							extraPlugins : 'uicolor',
							
			 			});
	 			
				var editor2 = CKEDITOR.replace( 'descricao',
		 				{
							toolbar :
							 [
							 ['Source','-','Save','NewPage','Preview','-','Templates'],
							 ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
							 ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
							 ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
							 '/',
							 ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
							 ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
							 ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
							 ['Link','Unlink','Anchor'],
							 ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
							 '/',
							 ['Styles','Format','Font','FontSize'],
							 ['TextColor','BGColor'],
							 ['Maximize', 'ShowBlocks','-','About']
							 ],
							extraPlugins : 'uicolor',
							
			 			});						
				
				CKEDITOR.editorConfig = function( config ) {
					config.extraPlugins = 'pastefromexcel';
					config.extraPlugins = 'qrc';
					config.extraPlugins = 'templates';
				};

	});
</script>		   