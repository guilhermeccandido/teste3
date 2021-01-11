<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/anteprojetos'; ?>">
	            <?php echo ucfirst("anteprojetos") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$anteprojetos_pendencias[0]['id_anteprojetos'] ; ?>">
	          Anteprojetos Pendências
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
			 <?php echo form_open("admin/anteprojetos_pendencias/update/".$this->uri->segment(4)."/".$anteprojetos_pendencias[0]['id_anteprojetos'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_anteprojetos" name="id_anteprojetos"  value="<?php echo $anteprojetos_pendencias[0]['id_anteprojetos'] ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_pendencias", $options_pendencias, set_value("id_pendencias"), 'class="form-control"' );?>
		            <span class="input-group-addon">Prioridade</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Descrição" value="<?php echo set_value('titulo') ?  set_value('titulo') :  $anteprojetos_pendencias[0]['titulo']; ?>" >
	              <span class="input-group-addon">Descrição</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="responsabilidade" name="responsabilidade" placeholder="Responsabilidade" value="<?php echo set_value('responsabilidade') ?  set_value('responsabilidade') :  $anteprojetos_pendencias[0]['responsabilidade']; ?>" >
	              <span class="input-group-addon">Responsabilidade</span>
	            </div>
	          </div>
	          <!-- 
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="data_ini" name="data_ini" placeholder="Data Inicial" value="<?php echo set_value('data_ini') ?  set_value('data_ini') :  $anteprojetos_pendencias[0]['data_ini']; ?>" >
	              <span class="input-group-addon">Data Inicial</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="data_fim" name="data_fim" placeholder="Data Final" value="<?php echo set_value('data_fim') ?  set_value('data_fim') :  $anteprojetos_pendencias[0]['data_fim']; ?>" >
	              <span class="input-group-addon">Data Final</span>
	            </div>
	          </div>
	           -->
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" type="textarea" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $anteprojetos_pendencias[0]['observacoes']; ?></textarea>
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