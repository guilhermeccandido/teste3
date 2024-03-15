<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            <?php echo ucfirst($this->uri->segment(2));?>
	          </a>	          
	        </li>
	        <li class="active">
	          Update
	        </li>
	      </ol>
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
		      $attributes = array("class" => "form-horizontal", "id" => "" , "enctype" =>"multipart/form-data" );
		      
 			  $options_tipos = array();
		      foreach ($tipo_documento as $row)
		      {
		      	$options_tipos[$row["id"]] = $row["titulo"];
		      }
		      
		      $options_atividades = array();
		      foreach($atividade as $item){
		      	$options_atividades[$item['id']] = $item['titulo'];
		      }
		      
		      $options_estados = array();
		      foreach($estados as $item){
		      	$options_estados[$item['uf']] = $item['uf'];
		      }
		       
		      $options_ods = array();
		      foreach($od_doc as $item){
		      	$options_ods[$item['id']] = $item['titulo'];
		      }
		      $rodo = set_value('rodovia') ?  set_value('rodovia') :  $documentos_repositorio[0]['rodovia'];
		      
		      $options_palavra_chave = array();
		      foreach($palavra_chave as $item){
		      	$options_palavra_chave[$item['id']] = $item['titulo'];
		      }
		      if(isset($wk_selected) and !empty($wk_selected)){
		      	$selected_palavra_chave = $wk_selected;
		      	
		      }else if($documentos_repositorio[0]['palavra_chave'] != ''){
		      	$selected_palavra_chave =  explode("/",$documentos_repositorio[0]['palavra_chave']);
		      	
		      }else{
		      	$selected_palavra_chave = array();
		      }
		      
    		  /*
    		  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }	
    		  <?php 
				     echo '<div class="form-group col-lg-12">';
					 echo '<div class="input-group col-lg-8">';
		    		 echo form_dropdown('id_', $options_, $documentos_repositorio[0]['id_'] , 'class="form-control"' );
		    		 echo '<span class="input-group-addon">XXXXXXXXX</span>';			
				     echo '</div>';
				     echo '</div>';	
			  ?>
    		  */
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/documentos_repositorio/update/".$this->uri->segment(4), $attributes); ?>	      		
		     <fieldset>
			 <legend>Editar</legend>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Assunto" value="<?php echo set_value('titulo') ?  set_value('titulo') : $documentos_repositorio[0]['titulo']; ?>" >
	              <span class="input-group-addon">Assunto</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php echo form_dropdown('tipo_documento', $options_tipos,  set_value('tipo_documento') ? set_value('tipo_documento') : $documentos_repositorio[0]['tipo_documento'] , 'class="form-control"' ); ?>
	              <span class="input-group-addon">Tipo do Documento</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="n_documento" name="n_documento" placeholder="Número do Documento" value="<?php echo set_value('n_documento') ?  set_value('n_documento') : $documentos_repositorio[0]['n_documento']; ?>" >
	              <span class="input-group-addon">Número do Documento</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="data" name="data" placeholder="Data do Documento" value="<?php echo set_value('data') ?  set_value('data') : $documentos_repositorio[0]['data']; ?>" >
	              <span class="input-group-addon">Data do Documento</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php  echo form_dropdown('uf', $options_estados, set_value('uf') ?  set_value('uf') : $documentos_repositorio[0]['uf'], 'class="form-control"' ); ?>
	              <span class="input-group-addon">UF</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php echo form_dropdown("rodovia", array() , $rodo, 'class="form-control" placeholder="Rodovia"  ' );?>
	              <span class="input-group-addon">Rodovia</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php  echo form_dropdown('atividade', $options_atividades, set_value('atividade') ?  set_value('atividade') : $documentos_repositorio[0]['atividade'], 'class="form-control"'); ?>
	              <span class="input-group-addon">Atividade</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php  echo form_multiselect('palavra_chave[]', $options_palavra_chave, $selected_palavra_chave, 'class="selectpicker form-control " data-max-options="5"'); ?>
	              <span class="input-group-addon">Lista de Palavras Chave</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php  echo form_dropdown('origem', $options_ods, set_value('origem') ?  set_value('origem') : $documentos_repositorio[0]['origem'], 'id="origem"  class="form-control"'); ?>
	              <span class="input-group-addon">Origem</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php  echo form_dropdown('destino', $options_ods, set_value('destino') ?  set_value('destino') : $documentos_repositorio[0]['destino'], 'id="destino" class="form-control"'); ?>
	              <span class="input-group-addon">Destino</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control"  type="file" id="file" name="file" placeholder="Adicionar Documento" >
		            <span class="input-group-addon">Arquivo</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control"  rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $documentos_repositorio[0]['observacoes']; ?></textarea>		
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

$('select[name=uf]').on({
    change: function(){

    	var self = $(this),
		   uf   = $('select[name=uf] option:selected').text(),
		   el   = $('select[name=rodovia]');
		  el.find('option').remove();
		  el.prepend('<option value="<?php echo  $rodo ?>"><?php echo $rodo ?></option>');
		  el.attr('disabled');    
		  $.getJSON('json_snv/vw_snv_rod.json',		 
		  function( data ) {
			  console.log(data);			  
			  for (var i = data.filter(c => c.unidade_federacao === uf).length - 1; i >= 0; i--) {				
				el.prepend($('<option>', { 
			        value: data[i]['codigo_br'],
			        text : data[i]['codigo_br'] 
			    }));
		      };
			});
	}
   
});	

	var	uf   = $('select[name=uf] option:selected').text(),
	el   = $('select[name=rodovia]');
	el.find('option').remove();
	el.prepend('<option value="<?php echo  $rodo ?>"><?php echo $rodo ?></option>');
	el.attr('disabled');    
	$.getJSON('json_snv/vw_snv_rod.json',		 
		  function( data ) {
			  console.log(data);			  
			  for (var i = data.filter(c => c.unidade_federacao === uf).length - 1; i >= 0; i--) {				
				el.prepend($('<option>', { 
			        value: data[i]['codigo_br'],
			        text : data[i]['codigo_br'] 
			    }));
	   };	   
	   
	});
	
	
	$('select[name=origem]').on({
	    change: function(){
	    	var selected   = $('select[name=origem] option:selected').text();

	    	if(selected == '551'){
	    		$('select[name=destino]').each(function() {
	    			$(this).find('option').removeAttr("selected");
	    		});
	    		$('select[name=destino] option[value=2]').attr('selected','selected');
	    		$('select[name=destino] option:selected').text('CGPLAN');
	    		console.log('mudar para CGPLAN');
		    }else{
		    	$('select[name=destino]').each(function() {
		    		$(this).find('option').removeAttr("selected");
	    		});
		    	$('select[name=destino] option[value=1]').attr('selected','selected');
		    	$('select[name=destino] option:selected').text('551');
		    	console.log('mudar para 551');
			}
			
		}
	   
	});	

	$('select[name=destino]').on({
	    change: function(){
	    	var selected   = $('select[name=destino] option:selected').text();

	    	if(selected == '551'){
	    		$('select[name=origem]').each(function() {
	    			$(this).find('option').removeAttr("selected");
	    		});
	    		$('select[name=origem] option[value=2]').attr('selected','selected');
	    		$('select[name=origem] option:selected').text('CGPLAN');
	    		console.log('mudar para CGPLAN');
		    }else{
		    	$('select[name=origem]').each(function() {
		    		$(this).find('option').removeAttr("selected");
	    		});
		    	$('select[name=origem] option[value=1]').attr('selected','selected');
		    	$('select[name=origem] option:selected').text('551');
		    	console.log('mudar para 551');
			}
			
		}
	   
	});	

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

			CKEDITOR.editorConfig = function( config ) {
				config.extraPlugins = 'pastefromexcel';
				config.extraPlugins = 'qrc';
				config.extraPlugins = 'templates';
			}; 	
	});

</script>