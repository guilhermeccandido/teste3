    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
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
	        <li class="active">
	          Movimentar
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
		      $attributes = array("class" => "form-horizontal", "id" => "" , "enctype" => "multipart/form-data");
    
		      $options_status = array();
		      $js_status = array();
		      foreach ($status as $row)
		      {
		      	$options_status[$row["id_status2"]] = $row["status"];
		      	$js_status[$row["id"]] = $row["composicao"];
		      }
		      
			  $options_avaliacoes = array();
			  
			  if(sizeof($avaliacoes) > 0 ){
			  	foreach ($avaliacoes as $row)
			  	{
			  		$options_avaliacoes[$row["id"]] = $row["titulo"];
			  	}
			  } 
		      
    
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/pas_fases_movimentacao/analista/".$id_pas."/".$id_pas_fases, $attributes); ?>
		     <fieldset>
		     <legend><?php echo 'LOTE:'.$lote.' '.'ATIVIDADE:'.$fases[0]['grupo'].' '.$fases[0]['titulo']; ?></legend>
			  <input class="form-control" type="hidden" id="id_pas_fases" name="id_pas_fases"  value="<?php echo $id_pas_fases; ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_status", $options_status, set_value("id_status"), 'class="form-control" id="id_status"' );?>
		            <span class="input-group-addon">Status/Movimentação</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_avaliacoes", $options_avaliacoes, set_value("id_avaliacoes"), 'class="form-control"  id="id_avaliacoes"' );?>
		            <span class="input-group-addon">Avaliações</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_protocolo" name="data_protocolo"  placeholder="Data Ocorrência" value="<?php echo set_value('data_protocolo') ? set_value('data_protocolo') : date('Y-m-d'); ?>" >
		            <span class="input-group-addon">Data Ocorrência</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-12">
		        	<textarea class="form-control"  rows="5" id="descricao" name="descricao" placeholder="Descrição" ><?php echo set_value('descricao'); ?></textarea>
		            <span class="input-group-addon">Descrição</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="file" id="file" name="file"  placeholder="File" value="<?php echo set_value('file'); ?>" >
		            <span class="input-group-addon">File</span>
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
	   
<script  type="text/javascript" >
<?php
	$js_array = json_encode($js_status);
	echo "var js_array = ". $js_array . ";\n";
	
?>
	$(function() {
	   
	 });
	
	console.log(js_array);
	
	var a = js_array[$('#id_status').val()];
	if( a == 'Simples'){

   	 console.log(a);
	     $("#id_avaliacoes").prop('disabled', true);
	     $("#id_avaliacoes").val($("#id_avaliacoes option:first").val());
	     
	 } else{

		 console.log(a);
		 $("#id_avaliacoes").prop('disabled', false);
		 
	 }

	
	$('#id_status').on({
	    change: function(){

		     var a = js_array[$('#id_status').val()];
		     if( a == 'Simples'){

		    	 console.log(a);
			     $("#id_avaliacoes").prop('disabled', true);
			     
			 } else{

				 console.log(a);
				 $("#id_avaliacoes").prop('disabled', false);
				 $("#id_avaliacoes").val($("#id_avaliacoes option:first").val());
				 
			 }
		}
	   
	});

	$(document).ready(
			function () { 
				
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







