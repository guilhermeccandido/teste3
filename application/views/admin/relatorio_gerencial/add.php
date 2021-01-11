    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            <?php echo 'Relatório Gerencial';?>
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
		      $attributes = array("class" => "form-horizontal", "id" => "", "enctype" => "multipart/form-data");
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
         	<?php echo form_open("admin/relatorio_gerencial/add", $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="titulo" name="titulo"  placeholder="Relatório Gerencial" value="<?php echo set_value('titulo'); ?>" >
		            <span class="input-group-addon">Relatório Gerencial</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_ini" name="data_ini"  placeholder="Data Início" value="<?php echo set_value('data_ini'); ?>" >
		            <span class="input-group-addon">Data Início</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_fim" name="data_fim"  placeholder="Data Fim" value="<?php echo set_value('data_fim'); ?>" >
		            <span class="input-group-addon">Data Fim</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="descricao" name="descricao"  placeholder="Descrição" value="<?php echo set_value('descricao'); ?>" >
		            <span class="input-group-addon">Descrição</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
	            <div class="input-group col-lg-8">
	              <input class="form-control" id="relatorio"  name="relatorio"  type="file">
	              <span class="input-group-addon">Relatório</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
	            <div class="input-group col-lg-8">
	              <input class="form-control" id="portifolio"  name="portifolio"  type="file">
	              <span class="input-group-addon">Portifólio</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
	            <div class="input-group col-lg-8">
	              <input class="form-control" id="carta"  name="carta"  type="file">
	              <span class="input-group-addon">Carta</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
	            <div class="input-group col-lg-8">
	              <input class="form-control" id="colecao"  name="colecao"  type="file">
	              <span class="input-group-addon">Arquivo Comprimido</span>
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
	   	</div>        
	   	</div>