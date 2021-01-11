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
		      /*
		      $options_coordenacao_geral = array(0  => 'SEM RELACIONAMENTO DEFINIDO');
		      foreach($coordenacao_geral as $row){
		      	$options_coordenacao_geral[$row['id']] = $row['titulo'];
		      }
		      */
		      
		      $options_coordenacao_setorial = array(0  => 'SEM RELACIONAMENTO DEFINIDO');
		      foreach($coordenacao_setorial as $row){
		      	$options_coordenacao_setorial[$row['id']] = $row['titulo'];
		      }
		      
		      $options_programas = array(0  => 'SEM RELACIONAMENTO DEFINIDO');
		      foreach($programas as $row){
		      	$options_programas[$row['id']] = $row['titulo'];
		      }
		      
		      $options_contratos = array();
		      foreach($contratos as $row){
		      	$options_contratos[$row['contrato']] = $row['contrato'];
		      }
		      
    		  /*
    		  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }	
    		  <?php 
				     echo '<div class="form-group col-lg-12">';
					 echo '<div class="input-group col-lg-8">';
		    		 echo form_dropdown('id_', $options_, $contratos_relacoes[0]['id_'] , 'class="form-control"' );
		    		 echo '<span class="input-group-addon">XXXXXXXXX</span>';			
				     echo '</div>';
				     echo '</div>';	
			  ?>
    		  */
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/contratos_relacoes/update/".$this->uri->segment(4), $attributes); ?>	      		
		     <fieldset>
			 <legend><h2>Contrato: <?php echo $contratos_relacoes[0]['contrato']; ?></h2></legend>
			 
			 <br>
			 <?php
			 /* 
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
		     	  <?php echo form_dropdown('coordenacao_geral', $options_coordenacao_geral, set_value('coordenacao_geral') ?  $options_coordenacao_geral[set_value('coordenacao_geral')] : $contratos_relacoes[0]['coordenacao_geral'] , 'class="form-control"' ); >?
	              <span class="input-group-addon">Coordenação Geral</span>
	            </div>
	          </div>
	          */
	          ?>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
		     	 <?php echo form_dropdown('coordenacao_setorial', $options_coordenacao_setorial, set_value('coordenacao_setorial') ?  set_value('coordenacao_setorial') : $contratos_relacoes[0]['coordenacao_setorial'] , 'class="form-control"' ); ?>
	              <span class="input-group-addon">Coordenação Setorial</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
		     	 <?php echo form_dropdown('programa', $options_programas, set_value('programa') ?  set_value('programa') : $contratos_relacoes[0]['programa'] , 'class="form-control"' ); ?>
	              <span class="input-group-addon">Programa</span>
	            </div>
	          </div>			  
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" type="textarea" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $contratos_relacoes[0]['observacoes']; ?></textarea>		
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