<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	            <?php echo ucfirst("pas") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$pas_pendencias[0]['id_pas'] ; ?>">
	          PAS Pendências
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
    		  
    		  $options_pendencias = array();
		      foreach ($pendencias as $row)
		      {
		      	$options_pendencias[$row["id"]] = $row["titulo"];
		      }
    		 
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/pas_pendencias/update/".$this->uri->segment(4)."/".$pas_pendencias[0]['id_pas'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_pas" name="id_pas"  value="<?php echo $pas_pendencias[0]['id_pas'] ?>" >
			  <div class="form-group col-lg-12">
			        <div class="input-group col-lg-8">
			        	<?php echo form_dropdown("id_pendencias", $options_pendencias, set_value("id_pendencias"), 'class="form-control"' );?>
			            <span class="input-group-addon">pendencias</span>
			        </div>
			      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Descrição" value="<?php echo set_value('titulo') ?  set_value('titulo') :  $pas_pendencias[0]['titulo']; ?>" >
	              <span class="input-group-addon">Descrição</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="responsabilidade" name="responsabilidade" placeholder="Responsabilidade" value="<?php echo set_value('responsabilidade') ?  set_value('responsabilidade') :  $pas_pendencias[0]['responsabilidade']; ?>" >
	              <span class="input-group-addon">Responsabilidade</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" type="textarea" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $pas_pendencias[0]['observacoes']; ?></textarea>
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