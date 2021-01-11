  <div class="container-fluid">		  
	<div class="row">	  	  
		<div class="main">
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
		      
			  
				$options_fases_subfases = array();
				foreach ($fases_subfases as $row)
				{
					$options_fases[$row["id_fases"]] = array($row["quantidade"], $row["valor"], $row["unidade"]);
					$options_subfases[$row["id_subfases"]] = array($row["quantidade"], $row["valor"], $row["unidade"]);
				}
				
				
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-12">
	          <div class="table-responsive">
		          <table class="table table-striped table-bordered table-condensed" id="table">
		            <thead>
		              <tr>
		            	<th class="header">
		            		<?php echo 'Marcar/Desmarcar Todas ';  echo form_checkbox('all', '', TRUE, 'onClick="toggle(this)"');?>
		            	</th>
		            	<th class="yellow header headerSortDown">Lote</th>
						<th class="yellow header headerSortDown">Produto/Subproduto</th>
						<th class="yellow header headerSortDown">Quantidade</th>
						<th class="yellow header headerSortDown">Valor Un.</th>
						<th class="yellow header headerSortDown">Unidade</th>
						<th class="yellow header headerSortDown">Reajuste</th>
						<th class="yellow header headerSortDown">Total</th>
						<th class="yellow header headerSortDown">Observações</th>
		    		</tr>
		            </thead>
		            <tbody>
		            <!-- 
		               [lote] => 1
            [id] => 1
            [titulo] => PRODUTO 2.1 - RELATÓRIO PRELIMINAR DE DADOS
            [id_modulos] => 8
            [grupo] => 2
            [demanda] => Padrão
            [observacoes] => 
            [last_update] => 2016-10-11 15:30:44
            [subfases] => false
            [id_pas_fases] => 1
            [id_subfase] => 
            [subfase] => 
             -->
		              <?php
		              
		              echo form_open("admin/medicoes_pas_fases/add/".$id_financeiro_medicoes, $attributes); 
		              
		              $i = 1;
		              foreach($aproved as $row)
		              {
		                echo '<tr class="row_'.$i.'">';
		                echo '<td>';
		                echo form_hidden("id_pas_fases_".$i, $row['id_pas_fases']);
		                echo form_hidden("id_subfases_".$i, $row['id_subfase']);
		                echo form_checkbox($i, "true", TRUE, ' class="checkboxtable"');
		                echo '</td>';
		                echo '<td>'.$row['lote'].'</td>';
						echo '<td>'.$row['titulo'].'<br>'.$row['subfase'].'</td>';
						echo '<td>';
								if($row['id_subfase']){
									//echo $options_subfases[$row['id_subfase']][0];
									echo form_input("quantidade_".$i, 1, ' class="quantidade" style="width:40px;"');
								}else{
									//echo $options_fases[$row["id"]][0];
									echo form_input("quantidade_".$i, 1, ' class="quantidade" style="width:40px;"');
								}
						echo '</td>';
						echo '<td class="unitario" >';
							if($row['id_subfase']){
								echo $options_subfases[$row['id_subfase']][1];
							}else{
								echo $options_fases[$row["id"]][1];
							}
	          			echo '</td>';
	          			echo '<td>';
	          			if($row['id_subfase']){
	          				echo $options_subfases[$row['id_subfase']][2];
	          				
	          			}else{
	          				echo $options_fases[$row["id"]][2];
	          				
	          			}
	          			echo '</td>';
	          			echo '<td class="reajuste">';
	          			echo $reajuste;
	          			echo '</td>';
						echo '<td>';
							if($row['id_subfase']){
								echo form_input("valor_".$i, $options_subfases[$row['id_subfase']][1] * $reajuste , ' class="valor"  style="width:80px;"');
								 
							}else{
								echo form_input("valor_".$i, $options_fases[$row["id"]][1] * $reajuste, ' class="valor" style="width:80px;"');
							}
	            		echo '</td>';
	            		echo '<td>';
	            		echo form_input("observacoes_".$i, '', 'style="width:300px;"');
	            		echo '</td>';
		                echo "</tr>";
		                $i++;
		              }
		              
		              ?>      
		            </tbody>
		          </table>
		          <fieldset>
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
	  </div>
	 </div>
	 </div>

<script>


	$('.quantidade').change(function () {
	    
	    var val1, val2, val3;
	    
	    var self = $(this).closest('tr').find('.valor');
	    val1 = $(this).closest('td').find("input").val();
	    val2 = $(this).closest('tr').find(".unitario").html();
	    val3 = $(this).closest('tr').find(".reajuste").html();    
	    
	    $(self).val(val1*val2*val3);
	 	
	});


	function toggle(source) {
  	  checkboxes = document.getElementsByClassName('checkboxtable');
  	  for(var i=0, n=checkboxes.length;i<n;i++) {
  	    checkboxes[i].checked = source.checked;
  	  }
  	}
	
	

	/*
	$(".checkboxtable").change(function () {
		var self = $("#table").find(".checkboxtable").each(function() {
			
			//console.log($(this).closest('tr').find('.valor').val());
			
	    });

		camposMarcados = new Array();
		$("input[type=checkbox][class='checkboxtable']:checked").each(function(){
		   // camposMarcados.push($(this).val());
			   console.log($(this).closest('tr').find('.valor').val());
		});
	});
	*/	
	
	 
	

</script>	 
	 
	 
	 