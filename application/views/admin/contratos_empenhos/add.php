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
    
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/contratos_empenhos/add/".$id_contratos, $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
			  <input class="form-control" type="hidden" id="contrato" name="contrato"  value="<?php echo $contrato['contrato']; ?>" >		  
			  
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="nota_empenho" name="nota_empenho"  placeholder="Nota de Empenho" value="<?php echo set_value('nota_empenho'); ?>" >
		            <span class="input-group-addon">Nota de Empenho</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_emissao_empenho" name="data_emissao_empenho"  placeholder="Data Emissão Empenho" value="<?php echo set_value('data_emissao_empenho'); ?>" >
		            <span class="input-group-addon">Data Emissão Empenho</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_empenho_inicial" name="valor_empenho_inicial"  placeholder="Empenho Inicial" value="<?php echo set_value('valor_empenho_inicial'); ?>" >
		            <span class="input-group-addon">Empenho Inicial</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_empenho_consumido" name="valor_empenho_consumido"  placeholder="Empenho Consumido" value="<?php echo set_value('valor_empenho_consumido'); ?>" >
		            <span class="input-group-addon">Empenho Consumido</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"  type="textarea" rows="5" id="observacoes" name="observacoes" placeholder="Observações" ><?php echo set_value('observacoes'); ?></textarea>
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
	   	</div>        </div>