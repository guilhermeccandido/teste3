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
	          <a href="<?php echo site_url("admin/registro_financeiro"); ?>">
	            Registro Financeiro
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin/financeiro_medicoes/".$id_registro_financeiro); ?>">
	            Medições
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin/medicoes_pas_fases/".$id_financeiro_medicoes); ?>">
	            Produtos
	          </a>
	        </li>
	        <li class="active">
	          Editar
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
    		  
				$options_fases_subfases = array();
				foreach ($fases_subfases as $row)
				{
					$options_fases[$row["id_fases"]] = array($row["quantidade"], $row["valor"], $row["unidade"]);
					$options_subfases[$row["id_subfases"]] = array($row["quantidade"], $row["valor"], $row["unidade"]);
				}
		      
		      /*
    		  <?php 
				     echo '<div class="form-group col-lg-12">';
					 echo '<div class="input-group col-lg-8">';
		    		 echo form_dropdown('id_', $options_, $medicoes_pas_fases[0]['id_'] , 'class="form-control"' );
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
			 <?php echo form_open("admin/medicoes_pas_fases/update/".$this->uri->segment(4)."/".$id_financeiro_medicoes, $attributes); ?>	      		
		     <fieldset>
			 <legend>
				Reajuste de: <?php echo $reajuste ;?>
			 </legend>			 
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="quantidade" name="quantidade" placeholder="Quantidade" value="<?php echo set_value('quantidade') ?  set_value('quantidade') : $medicoes_pas_fases[0]['quantidade']; ?>" >
	              <span class="input-group-addon">Quantidade</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="valor" name="valor" placeholder="Valor" value="<?php echo set_value('valor') ?  set_value('valor') : $medicoes_pas_fases[0]['valor']; ?>" >
	              <span class="input-group-addon">Valor</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control"  rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $medicoes_pas_fases[0]['observacoes']; ?></textarea>		
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
