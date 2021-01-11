    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            <?php echo ucfirst($this->uri->segment(2));?>
	          </a> 
	          
	        </li>
	        <li class="active">
	          <a href="">Novo</a>
	        </li>
	      </ol> 
	      <?php
	      //flash messages
	      if(isset($flash_message)){
	        if($flash_message == TRUE)
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> novo  anteprojetos criado com sucesso.';
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
			  echo '<div class="form-group">';
		          echo '<label for="inputError" class="control-label">Camada</label>';
		          echo '<div class="col-lg-6">';			          
		          	echo form_dropdown('id_', $options_, set_value('id_'), 'class="span2"');			          
		          echo '</div>';
	          echo '</div>';	
				
			  */
				
		      //form validation
		      echo validation_errors();
		      
		     
		     ?>
		   <div class="row">
            <div class="col-lg-10">
		     <?php  echo form_open("admin/anteprojetos/add/".$id_empreendimento, $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
		     	  <input type="hidden" id="" name="id_empreendimento" value="<?php echo $id_empreendimento; ?>" >
		     	  <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="prioridade" name="prioridade" placeholder="Prioridade" value="<?php echo set_value('prioridade'); ?>" >
		              <span class="input-group-addon">Prioridade</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Título" value="<?php echo set_value('titulo'); ?>" >
		              <span class="input-group-addon">Título</span>
		            </div>
		          </div>
		     	  <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="rodovia" placeholder="Rodovia" value="<?php echo set_value('rodovia'); ?>" >
		              <span class="input-group-addon">Rodovia</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="uf" placeholder="UF" value="<?php echo set_value('uf'); ?>" >
		              <span class="input-group-addon">UF</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="km_inicial" placeholder="km Inicial" value="<?php echo set_value('km_inicial'); ?>" >
		              <span class="input-group-addon">km Inicial</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="km_final" placeholder="km Final" value="<?php echo set_value('km_final'); ?>" >
		              <span class="input-group-addon">km Final</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="extensao" placeholder="Extensão" value="<?php echo set_value('extensao'); ?>" >
		              <span class="input-group-addon">Extensão</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="lotes" placeholder="Lotes" value="<?php echo set_value('lotes'); ?>" >
		              <span class="input-group-addon">Lotes</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="subtrecho" placeholder="Subtrecho" value="<?php echo set_value('subtrecho'); ?>" >
		              <span class="input-group-addon">Subtrecho</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="intervencao" placeholder="Intervenção" value="<?php echo set_value('intervencao'); ?>" >
		              <span class="input-group-addon">Intervenção</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="status" placeholder="Status" value="<?php echo set_value('status'); ?>" >
		              <span class="input-group-addon">Status</span>
		            </div>
		          </div>
		          <!-- 
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="progresso" placeholder="Progresso Tatal" value="<?php echo set_value('progresso'); ?>" >
		              <span class="input-group-addon">Progresso</span>
		            </div>
		          </div>
		           -->
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_ini_anteprojeto" placeholder="Data Inicial Anteprojeto" value="<?php echo set_value('data_ini_anteprojeto'); ?>" >
		              <span class="input-group-addon">Data Inicial Anteprojeto</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_fim_anteprojeto" placeholder="Data Final Anteprojeto" value="<?php echo set_value('data_fim_anteprojeto'); ?>" >
		              <span class="input-group-addon">Data Final Anteprojeto</span>
		            </div>
		          </div>
		          <!-- fase 1 -->
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <?php echo form_dropdown('fase1', $options_fases, set_value('fase1'), 'class="form-control"'); ?>
		              <span class="input-group-addon">Status Fase 1</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="progresso1" placeholder="Progresso Fase 1" value="<?php echo set_value('progresso1'); ?>" >
		              <span class="input-group-addon">Progresso (Fase 1)%</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_ini_fase1" placeholder="Data Inicial Fase 1" value="<?php echo set_value('data_ini_fase1'); ?>" >
		              <span class="input-group-addon">Data Inicial Fase 1</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_fim_fase1" placeholder="Data Final Fase 1" value="<?php echo set_value('data_fim_fase1'); ?>" >
		              <span class="input-group-addon">Data Final Fase 1</span>
		            </div>
		          </div>
		          <!-- fase 1 -->
		          <!-- fase 2 -->
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <?php echo form_dropdown('fase2', $options_fases, set_value('fase2'), 'class="form-control"'); ?>
		              <span class="input-group-addon">Status Fase 2</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="progresso2" placeholder="Progresso Fase 2" value="<?php echo set_value('progresso2'); ?>" >
		              <span class="input-group-addon">Progresso (Fase 2)%</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_ini_fase2" placeholder="Data Inicial Fase 2" value="<?php echo set_value('data_ini_fase2'); ?>" >
		              <span class="input-group-addon">Data Inicial Fase 2</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_fim_fase2" placeholder="Data Final Fase 2" value="<?php echo set_value('data_fim_fase2'); ?>" >
		              <span class="input-group-addon">Data Final Fase 2</span>
		            </div>
		          </div>
		          <!-- fase 2 -->
		          <!-- fase 3 -->
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <?php echo form_dropdown('fase3', $options_fases, set_value('fase3'), 'class="form-control"'); ?>
		              <span class="input-group-addon">Status Fase 3</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="progresso3" placeholder="Progresso Fase 3" value="<?php echo set_value('progresso3'); ?>" >
		              <span class="input-group-addon">Progresso (Fase 3)%</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_ini_fase3" placeholder="Data Inicial Fase 3" value="<?php echo set_value('data_ini_fase3'); ?>" >
		              <span class="input-group-addon">Data Inicial Fase 3</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="date" id="" name="data_fim_fase3" placeholder="Data Final Fase 3" value="<?php echo set_value('data_fim_fase3'); ?>" >
		              <span class="input-group-addon">Data Final Fase 3</span>
		            </div>
		          </div>
		          <!-- fase 3 -->
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="concepcao" placeholder="Concepção" value="<?php echo set_value('concepcao'); ?>" >
		              <span class="input-group-addon">Concepção</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="desenvolvimento" placeholder="Desenvolvimento" value="<?php echo set_value('desenvolvimento'); ?>" >
		              <span class="input-group-addon">Desenvolvimento</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="documentacao" placeholder="Documentação" value="<?php echo set_value('documentacao'); ?>" >
		              <span class="input-group-addon">Documentação</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="empresa_responsavel" placeholder="Empresa Responsável" value="<?php echo set_value('empresa_responsavel'); ?>" >
		              <span class="input-group-addon">Empresa Responsável</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="lat" placeholder="Latitude" value="<?php echo set_value('lat'); ?>" >
		              <span class="input-group-addon">Latitude</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">
		              <input class="form-control" type="text" id="" name="lon" placeholder="Longitude" value="<?php echo set_value('lon'); ?>" >
		              <span class="input-group-addon">Longitude</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-12">
		              <textarea class="form-control"  type="textarea" rows="5" id="descricao" name="descricao" placeholder="Descrição" ><?php echo set_value('descricoes'); ?></textarea>
		              <span class="input-group-addon">Descrição</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-12">
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