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
	             Registros Financeiros
	          </a>
	        </li>
	        <li>
	        	<a href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/'.$id_registro_financeiro; ?>">
	          	Produtos/Subprodutos
	          	</a>
	        </li>
	        <li class="active">
	        	Adicionar
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
		      
		      $arrayData = '';
		      $options_fases = array();
		      $options_subfases = array( );
		      
		      foreach ($fases_subfases as $row)
		      {
		      	
		      	$options_fases[$row["id_fases"]] = $row["fases"];
		      	
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
          <div class="col-lg-12">
         	<?php echo form_open("admin/financeiro_fases_subfases/add/".$id_registro_financeiro, $attributes); ?>		     
		     <fieldset>
		     <legend>Adicionar</legend>
			  <input class="form-control" type="hidden" id="id_registro_financeiro" name="id_registro_financeiro"  placeholder="Financeiro" value="<?php echo $id_registro_financeiro; ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-12">
		        	<?php echo form_dropdown('id_fases', $options_fases, set_value('id_fases'), 'class="form-control"'); ?>
		            <span class="input-group-addon">Produto</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-12">
		        	<?php echo form_dropdown('id_subfases', $options_subfases, set_value('id_subfases'), 'class="form-control"'); ?>
		            <span class="input-group-addon">Subproduto</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-12">
		        	<input class="form-control" type="text" id="quantidade" name="quantidade"  placeholder="Quantidade" value="<?php echo set_value('quantidade'); ?>" >
		            <span class="input-group-addon">Quantidade</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-12">
		        	<input class="form-control" type="text" id="valor" name="valor"  placeholder="Valor" value="<?php echo set_value('valor'); ?>" >
		            <span class="input-group-addon">Valor</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-12">
		        	<input class="form-control" type="text" id="unidade" name="unidade"  placeholder="Unidade" value="<?php echo set_value('unidade'); ?>" >
		            <span class="input-group-addon">Unidade</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-12">
		        	<textarea class="form-control"  rows="5" id="observacoes" name="observacoes" placeholder="Observações" ><?php echo set_value('observacoes'); ?></textarea>
		            <span class="input-group-addon">Observações</span>
		        </div>
		      </div>
	          <div class="form-group">
	          	<div class="col-lg-6">
	            	<button class="btn btn-primary" type="submit">Salvar Modificações</button>
	          	</div>
	          </div>
	        </fieldset>	
	      <?php echo form_close(); ?>
    	 </div>
	   	</div> 
	</div>
	
<script>

$(document).ready(
		function () { 	
			get_lista_subfases();
			
});

$('select[name=id_fases]').on({
    change: function(){
    	get_lista_subfases();	
	}
   
});	


function get_lista_subfases(){
	
	elFocus   = $('select[name=id_fases]');
	el   	  = $('select[name=id_subfases]');
	el.find('option').remove();
	el.attr('disabled');
	
	var data = <?php echo json_encode($fases_subfases); ?>;	

	for (var i = 0; i <= data.length - 1; i++) {
		
		if(elFocus.val() == data[i].id_fases){
			if(data[i].id_subfases){
				el.append($('<option>', { 
			        value: data[i].id_subfases,
			        text : data[i].subfases 
			    }));
			};	
		};
    };
	
	
	
};

</script>









	
