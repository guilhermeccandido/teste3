    <div class="container top">
	       <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 
	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	          	PAS
	          </a> 
	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/pas_acompanhamento_fisico/lista_acompanhamento_fisico/'.$id_pas; ?>">
	          	Acompanhamento Físico
	          </a> 
	          
	        </li>
	        <li class="active">
	          Acompanhamento Físico Files
	        </li>
	      </ol> 
	      <?php
	      //flash messages
	      if(isset($flash_message)){
	        if($flash_message == TRUE)
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> novo  pas_list_acompanhamento_fisico criado com sucesso.';
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
		      $attributes = array("class" => "form-horizontal", "id" => "",  "enctype" => "multipart/form-data");
			  /*
			  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }
			  
			  echo '<div class="control-group">';
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
		     <?php echo form_open('admin/pas_list_acompanhamento_fisico/add/'.$id_pas.'/'.$id_acompanhamento_fisico, $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
		            <input type="hidden" id="" name="id_pas_acompanhamento_fisico" value="<?php echo $id_acompanhamento_fisico; ?>" >
		            <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" type="file" multiple="" name="files[]">  
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