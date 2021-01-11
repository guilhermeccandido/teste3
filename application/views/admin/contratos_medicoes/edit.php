<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/contratos'; ?>">
	            <?php echo ucfirst("contratos") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$id_contratos; ?>">
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
    		  
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/contratos_medicoes/update/".$this->uri->segment(4)."/".$id_contratos , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>			  
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="n_medicao" name="n_medicao" placeholder="N. Medição" value="<?php echo set_value('n_medicao') ?  set_value('n_medicao') :  $contratos_medicoes[0]['n_medicao']; ?>" >
	              <span class="input-group-addon">N. Medição</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_termino_medicao" name="data_termino_medicao" placeholder="Data Término" value="<?php echo set_value('data_termino_medicao') ?  set_value('data_termino_medicao') :  $contratos_medicoes[0]['data_termino_medicao']; ?>" >
	              <span class="input-group-addon">Data Término</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_processamento_medicao" name="data_processamento_medicao" placeholder="Data Processamento" value="<?php echo set_value('data_processamento_medicao') ?  set_value('data_processamento_medicao') :  $contratos_medicoes[0]['data_processamento_medicao']; ?>" >
	              <span class="input-group-addon">Data Processamento</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="valor_medido_pi" name="valor_medido_pi" placeholder="Valor Medido PI" value="<?php echo set_value('valor_medido_pi') ?  set_value('valor_medido_pi') :  $contratos_medicoes[0]['valor_medido_pi']; ?>" >
	              <span class="input-group-addon">Valor Medido PI</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="valor_medido_pi_r" name="valor_medido_pi_r" placeholder="Valor Medido PI R" value="<?php echo set_value('valor_medido_pi_r') ?  set_value('valor_medido_pi_r') :  $contratos_medicoes[0]['valor_medido_pi_r']; ?>" >
	              <span class="input-group-addon">Valor Medido PI R</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" type="textarea" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $contratos_medicoes[0]['observacoes']; ?></textarea>
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