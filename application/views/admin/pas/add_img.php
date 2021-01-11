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
		      $attributes = array("class" => "form-horizontal", "id" => "",  "enctype" => "multipart/form-data");
			 
		      
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
		     <?php  echo form_open("admin/pas/add_img", $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
		     <div class="form-group">
	            <div class="col-lg-6">
	              <input class="form-control" type="file" name="file">  
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
	   
	   <div id="myModal" class="modal fade" role="dialog">
	       <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3>Atenção</h3>
			  </div>
			  <div class="modal-body">
			    <p>O sistema aceita somente imagens no formato jpg</p>
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
			  </div>
			</div>
		   </div>
		  </div>  
		  
	   </div>
	   
<script  type="text/javascript">
		     
		$('INPUT[type="file"]').change(function () {
		    var ext = this.value.match(/\.(.+)$/)[1];
		    switch (ext) {
		        case 'jpg':
		            $('#uploadButton').attr('disabled', false);
		            break;
		        case 'jpeg':
		            $('#uploadButton').attr('disabled', false);
		            break;
		        case 'JPG':
		            $('#uploadButton').attr('disabled', false);
		            break;
		        case 'JPEG':
		            $('#uploadButton').attr('disabled', false);
		            break;
		            
		        default:
		        	$('#myModal').modal({
		        		  keyboard: false
		        	});
		            this.value = '';
		    }
		});

		
</script>	   