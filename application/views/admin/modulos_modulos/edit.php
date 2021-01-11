<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/modulos/acesso'; ?>">
	            Módulos de Acesso
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$modulos_modulos[0]['id_modulo1']; ?>">
	          Módulos
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
    		  
    		  $options_modulos = array();
		      foreach ($modulos as $row)
		      {
		      	$options_modulos[$row["id"]] = $row["titulo"];
		      }
    		 
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/modulos_modulos/update/".$this->uri->segment(4)."/".$modulos_modulos[0]['id_modulo1'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_modulo1" name="id_modulo1"  value="<?php echo $modulos_modulos[0]['id_modulo1'] ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_modulo2", $options_modulos, set_value("id_modulo2"), 'class="form-control"' );?>
		            <span class="input-group-addon">Módulo</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control"  rows="5" placeholder="Descrição" id="descricao" name="descricao"><?php echo set_value('descricao') ?  set_value('descricao') :  $modulos_modulos[0]['descricao']; ?></textarea>
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