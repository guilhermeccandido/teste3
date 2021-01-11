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
	          Atividades/ Produtos 
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
		      
		      $options_modulos = array();
		      foreach ($modulos as $row)
		      {
		      	$options_modulos[$row["id"]] = $row["titulo"];
		      }
		      
		      // TODO: PASSAR ISSO PARA UM CONTROLE CONFIGURÁVEL
		      $options_atividades = array( 1 => 'Atividade 1' ,  'Atividade 2',  'Atividade 3',  'Atividade 4',   'Atividade 5' ,  'Atividade 6' , 'Atividade 7', 
            								  'Atividade 8' ,  'Atividade 9',  'Atividade 10', 'Atividade 11' , 'Atividade 12',  'Atividade 13', 'Atividade 14',
            								  'Atividade 15',  'Atividade 16', 'Atividade 17', 'Atividade 18' , 'Atividade 19',  'Atividade 20', 'Atividade 21'
              );
		      
		      $options_demanda = array( 'Padrão' => 'Padrão' ,  'Opcional' => 'Opcional');
		      
		      $options_subfases = array( 'false' => 'Não' ,  'true' => 'Sim');
		      
		      
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
         	<?php echo form_open("admin/fases/add", $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="titulo" name="titulo"  placeholder="Fase" value="<?php echo set_value('titulo'); ?>" >
		            <span class="input-group-addon">Fase/Produto</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('grupo', $options_atividades, set_value('grupo'), 'class="form-control" placeholder="Atividade" ' ); ?>
		            <span class="input-group-addon">Grupo</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('id_modulos', $options_modulos, set_value('id_modulos'), 'class="form-control"'); ?>
		            <span class="input-group-addon">Módulo</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('demanda', $options_demanda, set_value('demanda'), 'class="form-control" placeholder="Demanda" ' ); ?>
		            <span class="input-group-addon">Demanda</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('subfases', $options_subfases, set_value('subfases'), 'class="form-control" placeholder="Possui Subprodutos?" ' ); ?>
		            <span class="input-group-addon">Possui Subproduto?</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"  rows="5" id="observacoes" name="observacoes" placeholder="Observvações" ><?php echo set_value('observacoes'); ?></textarea>
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