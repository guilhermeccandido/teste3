<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("configuracao_geral"); ?>">
	            Configurações Gerais
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("configuracao_geral/pas"); ?>">
	            EVTEAS
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            Configurações dos EVTEAS - Status
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
		      
		      $options_composicao = array('Simples' => 'Simples', 'Composto' => 'Composto');
		      
		      $options_tipos = array("Inicial" => "Inicial", "Normal" => "Normal", "Final" => "Final" );
		      
		      $options_modulos = array();
		      foreach ($modulos as $row)
		      {
		      	$options_modulos[$row["id"]] = $row["titulo"];
		      }
		      
		      $options_perfil = array();
		      foreach ($perfil as $row)
		      {
		      	$options_perfil[$row["id"]] = $row["titulo"];
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
		    		 echo form_dropdown('id_', $options_, $status[0]['id_'] , 'class="form-control"' );
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
			 <?php echo form_open("admin/status/update/".$this->uri->segment(4), $attributes); ?>	      		
		     <fieldset>
			 <legend>Editar</legend>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Status" value="<?php echo set_value('titulo') ?  set_value('titulo') : $status[0]['titulo']; ?>" >
	              <span class="input-group-addon">Status</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="peso" name="peso" placeholder="Peso" value="<?php echo set_value('peso') ?  set_value('peso') : $status[0]['peso']; ?>" >
	              <span class="input-group-addon">Peso</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php
	             	 echo form_dropdown('composicao', $options_composicao, set_value('composicao') ?  set_value('composicao') : $status[0]['composicao'] , 'class="form-control"' );
	              ?>
	              <span class="input-group-addon">Composição</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php
	             	 echo form_dropdown('tipo', $options_tipos, set_value('tipo') ?  set_value('tipo') : $status[0]['tipo'] , 'class="form-control"' );
	              ?>
	              <span class="input-group-addon">Tipo</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
		     	 <?php
		     	 	echo form_dropdown('id_usuario_perfil', $options_perfil, set_value('id_usuario_perfil') ?  set_value('id_usuario_perfil') : $status[0]['id_usuario_perfil'], 'class="form-control"' );
		     	 ?>
	              <span class="input-group-addon">Perfil Responsável</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
		     	 <?php
		     	 	echo form_dropdown('id_modulo', $options_modulos, set_value('id_modulo') ?  set_value('id_modulo') : $status[0]['id_modulo'], 'class="form-control"' );
		     	 ?>
	              <span class="input-group-addon">Modulo</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="color" id="color" name="color"  placeholder="Cor" value="<?php echo set_value('color') ?  set_value('color') : $status[0]['color']; ?>" >
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" rows="5" placeholder="Descrição" id="descricao" name="descricao"><?php echo set_value('descricao') ?  set_value('descricao') :  $status[0]['descricao']; ?></textarea>		
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