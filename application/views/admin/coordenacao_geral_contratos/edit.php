<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/coordenacao_geral'; ?>">
	            <?php echo ucfirst("coordenacao_geral") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$coordenacao_geral_contratos[0]['id_coordenacao_geral'] ; ?>">
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
		      $attributes = array("class" => "form-horizontal", "id" => "");
    		  
    		  $options_contratos = array();
		      foreach ($contratos as $row)
		      {
		      	$options_contratos[$row["id"]] = $row["titulo"];
		      }
    		 
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/coordenacao_geral_contratos/update/".$this->uri->segment(4)."/".$coordenacao_geral_contratos[0]['id_coordenacao_geral'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_coordenacao_geral" name="id_coordenacao_geral"  value="<?php echo $coordenacao_geral_contratos[0]['id_coordenacao_geral'] ?>" >
			  <div class="form-group col-lg-12">
			        <div class="input-group col-lg-8">
			        	<?php echo form_dropdown("id_contratos", $options_contratos, set_value("id_contratos"), 'class="form-control"' );?>
			            <span class="input-group-addon">contratos</span>
			        </div>
			      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" type="textarea" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo $coordenacao_geral_contratos[0]['observacoes']; ?></textarea>
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