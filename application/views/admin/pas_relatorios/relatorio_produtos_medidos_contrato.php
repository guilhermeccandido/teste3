<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

	$opt_registros = array();
	foreach($registro_finaceiro as $item){
		$opt_registros[$item['id']] = $item['contrato'];
	}
	
	$opt_fases = array();
	foreach($fases as $item){
		$opt_fases[$item['id']] = $item['titulo'];
	}
	
	$opt_subfases = array(0 => '');
	foreach($subfases as $item){
		$opt_subfases[$item['id']] = $item['titulo'];
	}
	
	
	$relatorio = 'Medição;Produto/Subproduto;Data;Quantidade;Valor;Reajuste;Total;Observações;'."\n";
	
	foreach($medicao as $row)
	{
		$relatorio .=	 $row['titulo'].';'.$opt_fases[$row['id_fases']].'<br>'.$opt_subfases[$row['id_subfases']].';'
						.$row['data'].';'.$row['quantidade'].';'.$row['valor'].$row['reajuste'].';'.($row['valor'] * $row['reajuste']).';'.($row['obs_produto']).';'."\n";
		 
	}
	
	$nameFile  = 'medicoes_contrato'.date('Y-m-d').'.csv';
	file_put_contents(PAS_RELATORIOS_FOLDER . $nameFile , utf8_decode($relatorio));
	 
	
?>
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
	          <a href="<?php echo base_url() .'gestao_estudos_projetos'; ?>">
	            <?php echo ucfirst('Gestão de Estudos e Projetos');?>
	          </a>
	        </li> 
			<li>
	          <a href="<?php echo base_url('gestao_estudos_projetos/relatorios'); ?>">
	            Relatórios Físicos
	          </a>
	        </li>  		
	        <li class="active">
	          Produtos Medidos por Contrato
	        </li>
	      </ol>
	    
	    	<h3>Baixar Relatório</h3>
				
		   <?php
			   if(isset($flash_message)){
			   	if($flash_message == TRUE)
			   	{	
			   		?>
			   		<a href="<?php echo base_url('assets/gestao_estudos_projetos/pas/relatorios').'/'.$nameFile ?>"><img src="<?php echo base_url('assets/img/icons/xls.png');?>" width="64"  height="64" /></a>
			   		<?php
			   	}else{
			   		echo '<div class="alert alert-danger alert-dismissible" role="alert">';
			   		echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			   		echo '<strong>Ocorreu algum problema na consulta ou não existem registros para o período.';
			   		echo '</div>';
			   	}
			   }
			   $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
			   
			   echo validation_errors();
		   ?>	
          <div class="well well-pas">
            
			<?php echo form_open("pas_relatorios/produtos_medidos_contrato", $attributes); ?>
             <div class="form-group form-inline reset-margin">
	             <label>Contrato:</label>
	             <?php echo form_dropdown('id_registro_financeiro', $opt_registros, set_value('id_registro_financeiro'), 'class="form-control"'); ?>
	             <button class="btn btn-primary" type="submit">Enviar</button>
			</div>
			<?php echo form_close(); ?>
			
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed  table-hover results">
	            <thead>
	              <tr>
					<th class="yellow header headerSortDown">Medição</th>
					<th class="yellow header headerSortDown">Lote</th>
					<th class="yellow header headerSortDown">Produto/Subproduto</th>
					<th class="yellow header headerSortDown">Data</th>
					<th class="yellow header headerSortDown">Quantidade</th>
					<th class="yellow header headerSortDown">Valor</th>
					<th class="yellow header headerSortDown">Reajuste</th>
					<th class="yellow header headerSortDown">Total</th>
					<th class="yellow header headerSortDown">Observações</th>
				  </tr>
	            </thead>
	            <tbody>
	           <?php
				  if(sizeof($medicao) > 0) {
		           	  $first = true;
		           	  $subTotal = 0;
		           	  $total = 0;
		              foreach($medicao as $row)
		              {
		              	if($first){
		              		$first =  false;
		              		$currentMed = $row['titulo'];
		              		$currentLote = $row['lote'];
		              		$currentData = $row['data'];
		              		$currentAcre = $row['acrecimos'];
		              		$currentDesc = $row['descontos'];
		              		$currentObs = $row['obs_medicao'];
		              	}
		              	
		              	if($currentMed != $row['titulo']){
		              		
		              		$total += $subTotal;
		              		$subTotal += ($currentAcre + $currentDesc);
		              		echo '<tr>';	
			              		echo '<td>'.$currentMed.'</td>';
			              		echo '<td></td>';
			              		echo '<td>Acréscimos</td>';
			              		echo '<td>'.$currentData.'</td>';
			              		echo '<td> - </td>';
			              		echo '<td> - </td>';
			              		echo '<td> - </td>';
			              		echo '<td>'.$currentAcre.'</td>';
			              		echo '<td>';
			              		echo $currentObs;
			              		echo '</td>';
		              		echo '</tr>';
		              		echo '<tr>';
			              		echo '<td>'.$currentMed.'</td>';
			              		echo '<td></td>';
			              		echo '<td>Descontos</td>';
			              		echo '<td>'.$currentData.'</td>';
			              		echo '<td> - </td>';
			              		echo '<td> - </td>';
			              		echo '<td> - </td>';
			              		echo '<td>'.$currentDesc.'</td>';
			              		echo '<td></td>';
			              	echo '</tr>';
				            echo '<tr>';
				            	echo '<td>'.$currentMed.'</td>';
				              	echo '<td><b>Subtotal</b></td>';
				              	echo '<td></td>';
				              	echo '<td></td>';
				              	echo '<td></td>';
				              	echo '<td></td>';
				              	echo '<td></td>';
				              	echo '<td><b>'.$subTotal.'</b></td>';
				              	echo '<td></td>';
			              	echo '</tr>';
		              		echo '<tr>';
			              		echo '<td>'.$row['titulo'].'</td>';
			              		echo '<td>Lote '.$row['lote'].'</td>';
			              		echo '<td>';
			              		echo  	$opt_fases[$row['id_fases']].'<br>'.$opt_subfases[$row['id_subfases']];
			              		echo '</td>';
			              		echo '<td>'.$row['data'].'</td>';
			              		echo '<td>'.$row['quantidade'].'</td>';
			              		echo '<td>'.$row['valor'].'</td>';
			              		echo '<td>'.$row['reajuste'].'</td>';
			              		echo '<td>'.$row['valor'] .'</td>';
			              		echo '<td>';
			              		echo $row['obs_produto'];
			              		echo '</td>';
		              		echo '</tr>';
		              		$currentMed = $row['titulo'];
		              		$currentMed = $row['titulo'];
		              		$currentData = $row['data'];
		              		$currentAcre = $row['acrecimos'];
		              		$currentDesc = $row['descontos'];
		              		$currentObs = $row['obs_medicao'];
		              		$subTotal = ($row['valor']);
		              		
		              	}else{
		              		
			              	echo '<tr>';
			              		echo '<td>'.$row['titulo'].'</td>';
			              		echo '<td>Lote '.$row['lote'].'</td>';
			              		echo '<td>';
			              		echo  	$opt_fases[$row['id_fases']].'<br>'.$opt_subfases[$row['id_subfases']];
			              		echo '</td>';
			              		echo '<td>'.$row['data'].'</td>';
			              		echo '<td>'.$row['quantidade'].'</td>';
			              		echo '<td>'.$row['valor'].'</td>';
			              		echo '<td>'.$row['reajuste'].'</td>';
			              		echo '<td>'.$row['valor'].'</td>';
			              		echo '<td>';
			              		echo $row['obs_produto'];
			              		echo '</td>';
		              		echo '</tr>';
		              		$subTotal += ($row['valor']);
		              	}
		              	
		              }
		              
		              $subTotal += ($currentAcre + $currentDesc);
		              $total += $subTotal;
		              echo '<tr>';
			              echo '<td>'.$currentMed.'</td>';
			              echo '<td></td>';
			              echo '<td>Acréscimos</td>';
			              echo '<td>'.$currentData.'</td>';
			              echo '<td> - </td>';
			              echo '<td> - </td>';
			              echo '<td> - </td>';
			              echo '<td>'.$currentAcre.'</td>';
			              echo '<td>';
			              echo $currentObs;
			              echo '</td>';
		              echo '</tr>';
		              echo '<tr>';
			              echo '<td>'.$currentMed.'</td>';
			              echo '<td></td>';
			              echo '<td>Descontos</td>';
			              echo '<td>'.$currentData.'</td>';
			              echo '<td> - </td>';
			              echo '<td> - </td>';
			              echo '<td> - </td>';
			              echo '<td>'.$currentDesc.'</td>';
			              echo '<td></td>';
		              echo '</tr>';
		              echo '<tr>';
		              	  echo '<td>'.$currentMed.'</td>';
			              echo '<td><b>Subtotal</b></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td><b>'.$subTotal.'</b></td>';
			              echo '<td></td>';
		              echo '</tr>';
		              
		              echo '<tr>';
		              	  echo '<td></td>';
			              echo '<td><b>Total</b></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td></td>';
			              echo '<td><b>'.$total.'<b></td>';
			              echo '<td></td>';
		              echo '</tr>';
		          
				  }    
	              ?>
	            </tbody>
	          </table>
		  </div> 
                        
		</div>
	</div>
</div>

<style>
	.panel-heading span {
	    margin-top: -18px;
	    margin-right: 5px;
	    font-size: 15px;
	}
	.clickable {
	    cursor: pointer;
	}

	 html{
	 	height: 100%
	 };
	 
     body{
     	height: 100%; 
     	margin: 0; 
     	padding: 0
     }
     
	 #map_canvas {
	  height: 100%;
	  width: 100%;
	}
		
		.results tr[visible='false'],
		.no-result{
		  display:none;
		}
		
		.results tr[visible='true']{
		  display:table-row;
		}
		
		.counter{
		  padding:8px; 
		  color:#ccc;
		}
		
</style>


<script type="text/javascript"> 
	$(document).ready(function() {
		App.init();
		
	});

	
	

 	

 	
</script>
	
