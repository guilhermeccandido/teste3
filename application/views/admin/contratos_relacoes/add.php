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
		      
		      $options_coordenacao_setorial = array();
		      foreach($coordenacao_setorial as $row){
		      	$options_coordenacao_setorial[$row['id']] = $row['titulo'];
		      }
		      
		      $options_programas = array();
		      foreach($programas as $row){
		      	$options_programas[$row['id']] = $row['titulo'];
		      }
		      
		      $options_contratos = array();
		      $options_contratos_id = array();
		      foreach($contratos as $row){
		      	$options_contratos[$row['contrato']] = $row['contrato'];
		      	$options_contratos_id[$row['id']] = $row['contrato'];
		      }
		     
		      
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
         	<?php echo form_open("admin/contratos_relacoes/add", $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>
		     <?php
		     /* 
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="coordenacao_geral" name="coordenacao_geral"  placeholder="Coordenação Geral" value="<?php echo set_value('coordenacao_geral'); ?>" >
		            <span class="input-group-addon">Coordenação Geral</span>
		        </div>
		      </div>
		      */
		      ?>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('contrato', $options_contratos, set_value('contrato') ? set_value('contrato') : $options_contratos_id[$id_contrato] , 'class="form-control"' ); ?>
		            <span class="input-group-addon">Contrato</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('coordenacao_setorial', $options_coordenacao_setorial, set_value('coordenacao_setorial')  , 'class="form-control"' ); ?>
		            <span class="input-group-addon">Coordenação Setorial</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('programa', $options_programas, set_value('programa') , 'class="form-control"' ); ?>
		            <span class="input-group-addon">Programa</span>
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