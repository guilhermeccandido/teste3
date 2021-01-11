    <?php
   		$id_anteprojeto =  $anteprojetos_localizacao[0]['id_anteprojeto']
   ?>
    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 
	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/anteprojetos'; ?>">
	            <?php echo "Anteprojetos";?>
	          </a> 
	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/lista_localizacao/'.$id_anteprojeto; ?>">
	            <?php echo "Localização";?>
	          </a> 
	          
	        </li>
	        <li class="active">
	          <a href="#">Update</a>
	        </li>
	      </ol>
	     <?php
	      //flash messages
	      if($this->session->flashdata('flash_message')){
	        if($this->session->flashdata('flash_message') == 'updated')
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> anteprojetos_localizacao editado com sucesso.';
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
    		  <?php 
				     echo 
				     	  '<div class="control-group">
				            <label for="inputError" class="control-label">Classe </label>
				            <div class="controls">';
				              
		    		 echo form_dropdown('id_', $options_, anteprojetos_localizacao[0]['id_'] );	
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
		     <?php echo form_open("admin/anteprojetos_localizacao/update/".$this->uri->segment(4), $attributes); ?>
		     <fieldset>
		     <legend>Editar</legend>
		     	<input type="hidden" id="" name="id_anteprojeto" value="<?php echo $anteprojetos_localizacao[0]['id_anteprojeto']; ?>" >
		     	<input type="hidden" id="" name="id_localizacao" value="<?php echo $anteprojetos_localizacao[0]['id_localizacao']; ?>" >
		     	 <div class="form-group">
		            <div class="col-lg-6">
		    			<input class="form-control" id="file" type="file" name="file" class=""  />
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
			    <p>O sistema aceita somente imagens no formato kmz</p>
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
			  </div>
			</div>
		   </div>
		  </div> 
	    
	    
	 </div>
	 
	 
<script language="javascript" type="text/javascript">
		     
		$('INPUT[type="file"]').change(function () {
		    var ext = this.value.match(/\.(.+)$/)[1];
		    switch (ext) {
		        case 'kmz':
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