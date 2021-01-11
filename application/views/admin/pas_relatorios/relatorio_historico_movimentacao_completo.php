<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
	$relatorio = 'Contrato;Executora;Lote;Responsável;Produto;Movimento;Data;Duração;Prazo Acumulado;'."\n";
	
	$options_contratos = array();
	foreach($contratos as $rowContrato){
		$options_contratos[$rowContrato['id']] =  array( 'contrato' => $rowContrato['contrato'], 'executora' => $rowContrato['executora']);
	}
	
	foreach($historico as $row)
	{
		$relatorio .=	 '"=""'.$options_contratos[$row['id_contrato']]['contrato'].'""";'.$options_contratos[$row['id_contrato']]['executora'].';'.$row['lote'].';'.$row['responsavel'].';'.$row['produto'].';'.$row['movimento'].';'.$row['data_protocolo'].';'.$row['diff'].';'.$row['acumulado'].';'."\n";
		 
	}
	
	$nameFile  = 'medicoes_historico'.date('Y-m-d').'.csv';
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
	          Histórico Movimentações Todos os Produtos
	        </li>
	      </ol>
	    
	    	<h3>Baixar Relatório</h3>
			
		   <a href="<?php echo base_url('assets/gestao_estudos_projetos/pas/relatorios').'/'.$nameFile ?>"><img src="<?php echo base_url('assets/img/icons/xls.png');?>" width="64"  height="64" /></a>	
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed  table-hover results">
	            <thead>
	              <tr>
	                <th class="yellow header headerSortDown">Contrato</th>
	                <th class="yellow header headerSortDown">Executora</th>
	              	<th class="yellow header headerSortDown">Lote</th>
					<th class="yellow header headerSortDown">Responsável</th>
					<th class="yellow header headerSortDown">Produto</th>
					<th class="yellow header headerSortDown">Movimento</th>
					<th class="yellow header headerSortDown">Data</th>
					<th class="yellow header headerSortDown">Duração</th>
					<th class="yellow header headerSortDown">Prazo Acumulado</th>
				  </tr>
	            </thead>
	            <tbody>
	           <?php
	           if(sizeof($historico) > 0) {
	           	foreach($historico as $row)
		              {
		              	echo '<tr>';
			              	echo '<td>'.$options_contratos[$row['id_contrato']]['contrato'].'</td>';
			              	echo '<td>'.$options_contratos[$row['id_contrato']]['executora'].'</td>';
	              			echo '<td>'.$row['lote'].'</td>';
		              		echo '<td>'.$row['responsavel'].'</td>';
		              		echo '<td>'.$row['produto'].'</td>';
		              		echo '<td>'.$row['movimento'].'</td>';
		              		echo '<td>'.$row['data_protocolo'].'</td>';
		              		echo '<td>'.$row['diff'].'</td>';
		              		echo '<td>'.$row['acumulado'].'</td>';	
		              	echo '</tr>';
			              		
				  	 }   
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
	
