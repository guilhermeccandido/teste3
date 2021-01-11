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
		      
		      $option_status = array('Em Andamento' => 'Em Andamento', 'Concluído' => 'Concluído', 'Atrasado' => 'Atrasado', 'Paralisado' => 'Paralisado' );
		      
			  /*
			  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }
			  
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
         	<?php echo form_open("admin/atividades/add", $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_atividade" name="data_atividade"  placeholder="Data"  min="<?php echo $dateInterval['date_min']?>" max="<?php echo $dateInterval['date_max']?>" value="<?php echo set_value('data_atividade'); ?>" >
		            <span class="input-group-addon">Data</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="titulo" name="titulo"  placeholder="Atividade" value="<?php echo set_value('titulo'); ?>" >
		            <span class="input-group-addon">Atividade</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('status', $option_status, set_value('status'), 'class="form-control"'); ?>
		            <span class="input-group-addon">Status</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control" id="descricao" type="textarea" rows="5" id="descricao" name="descricao" placeholder="Descrição" ><?php echo set_value('descricao'); ?></textarea>
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
<script>
	$(document).ready(function () { 
		
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
	   
	   