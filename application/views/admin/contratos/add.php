    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
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
		      
		      $options_empresas = array();
		      foreach ($empresas as $row)
		      {
		      	$options_empresas[$row["id"]] = $row["titulo"];
		      }
		      
		      $options_intervencoes = array();
		      foreach ($intervencoes as $row)
		      {
		      	$options_intervencoes[$row["id"]] = $row["titulo"];
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
         	<?php echo form_open("admin/contratos/add", $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="contrato" name="contrato"  placeholder="Contrato" value="<?php echo set_value('contrato'); ?>" >
		            <span class="input-group-addon">Contrato</span>
		        </div>
		      </div>		     
		      <!-- 
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('id_executora', $options_empresas, set_value('id_executora'), 'class="form-control"'); ?>
		            <span class="input-group-addon">Executora</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="fiscal" name="fiscal"  placeholder="Fiscal" value="<?php echo set_value('fiscal'); ?>" >
		            <span class="input-group-addon">Fiscal</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="local" name="local"  placeholder="Município Unidade Local" value="<?php echo set_value('local'); ?>" >
		            <span class="input-group-addon">Município Unidade Local</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="coordenacao" name="coordenacao"  placeholder="Unidade Gestora" value="<?php echo set_value('coordenacao'); ?>" >
		            <span class="input-group-addon">Unidade Gestora</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown('id_intervencao', $options_intervencoes, set_value('id_intervencao'), 'class="form-control"'); ?>
		            <span class="input-group-addon">Intervenção</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="situacao" name="situacao"  placeholder="Situação" value="<?php echo set_value('situacao'); ?>" >
		            <span class="input-group-addon">Situação</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="objeto" name="objeto"  placeholder="Objeto" value="<?php echo set_value('objeto'); ?>" >
		            <span class="input-group-addon">Objeto</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="edital" name="edital"  placeholder="Edital" value="<?php echo set_value('edital'); ?>" >
		            <span class="input-group-addon">Edital</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_proposta_base" name="data_proposta_base"  placeholder="Data de Proposta/Base" value="<?php echo set_value('data_proposta_base'); ?>" >
		            <span class="input-group-addon">Data de Proposta/Base</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_aprovacao" name="data_aprovacao"  placeholder="Data de Aprovação" value="<?php echo set_value('data_aprovacao'); ?>" >
		            <span class="input-group-addon">Data de Aprovação</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_assinatura" name="data_assinatura"  placeholder="Data de Assinatura" value="<?php echo set_value('data_assinatura'); ?>" >
		            <span class="input-group-addon">Data de Assinatura</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_publicacao" name="data_publicacao"  placeholder="Data de Publicação" value="<?php echo set_value('data_publicacao'); ?>" >
		            <span class="input-group-addon">Data de Publicação</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_ordem_inicio" name="data_ordem_inicio"  placeholder="Data de Ordem de Início" value="<?php echo set_value('data_ordem_inicio'); ?>" >
		            <span class="input-group-addon">Data de Ordem de Início</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_termino" name="data_termino"  placeholder="Data de Término" value="<?php echo set_value('data_termino'); ?>" >
		            <span class="input-group-addon">Data de Término</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="prazo" name="prazo"  placeholder="Prazo" value="<?php echo set_value('prazo'); ?>" >
		            <span class="input-group-addon">Prazo</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_pi" name="valor_pi"  placeholder="Valor PI" value="<?php echo set_value('valor_pi'); ?>" >
		            <span class="input-group-addon">Valor PI</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_reajuste" name="valor_reajuste"  placeholder="Valor Reajuste" value="<?php echo set_value('valor_reajuste'); ?>" >
		            <span class="input-group-addon">Valor Reajuste</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_aditivo" name="valor_aditivo"  placeholder="Valor Aditivo" value="<?php echo set_value('valor_aditivo'); ?>" >
		            <span class="input-group-addon">Valor Aditivo</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_contrato" name="valor_contrato"  placeholder="Valor Contrato (PI+R+A)" value="<?php echo set_value('valor_contrato'); ?>" >
		            <span class="input-group-addon">Valor Contrato (PI+R+A)</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_medido_pi" name="valor_medido_pi"  placeholder="Valor Medido (PI)" value="<?php echo set_value('valor_medido_pi'); ?>" >
		            <span class="input-group-addon">Valor Medido (PI)</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_contrato_pi_r" name="valor_contrato_pi_r"  placeholder="Valor Medido (PI+R)" value="<?php echo set_value('valor_contrato_pi_r'); ?>" >
		            <span class="input-group-addon">Valor Medido (PI+R)</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="valor_pago" name="valor_pago"  placeholder="Valor Pago" value="<?php echo set_value('valor_pago'); ?>" >
		            <span class="input-group-addon">Valor Pago</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="empenhado" name="empenhado"  placeholder="Empenhado" value="<?php echo set_value('empenhado'); ?>" >
		            <span class="input-group-addon">Empenhado</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="saldo_empenho" name="saldo_empenho"  placeholder="Saldo de Empenho" value="<?php echo set_value('saldo_empenho'); ?>" >
		            <span class="input-group-addon">Saldo de Empenho</span>
		        </div>
		      </div>
		      !-->
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