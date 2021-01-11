<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

	$id_contrato = isset($id_contrato) ? $id_contrato : null;
	
	$options_status = array();
	foreach ($status as $row)
	{
		$options_status[$row["id"]] = array( 'titulo' => $row["titulo"], 'peso' => $row["peso"], 'composicao' => $row["composicao"]) ;
	}
	
	$options_avaliacoes = array();
	foreach ($avaliacoes as $row)
	{
		$options_avaliacoes[$row["id"]] = array( 'titulo' => $row["titulo"], 'peso' => $row["peso"]) ;
	}
	
	$options_locais = array();
	foreach($local_execucao as $rowLocal){
		$options_locais[$rowLocal['id']] = $rowLocal['titulo'];
	}
	
	$options_contratos = array();
	foreach($contratos as $rowContrato){
		$options_contratos[$rowContrato['id']] = $rowContrato['contrato'];
	}
	
	
	$relatorio = 'Local;Contrato;Lote;Trechos;Extensão;Progresso;Data Inicial (Planejada);Data de Início;Data Final (Planejada);Data Fim;Status;'."\n";
	
	foreach($pas as $row)
	{
		$progresso_total = ( $row['progresso_total'] > 0 ) ? $row['progresso_total'] : 0;
		
		$local = $options_locais[$row['id_local_execucao']];
		 
		if($progresso_total < 100){
			$row['data_last_mov'] = 'Não Disponível';
		};
		if(!isset($row['data_first_mov'])){
			$row['data_first_mov'] = 'Não Disponível';
		};
		if($row['data_ini_planejada'] > $row['data_fim_planejada']){
			$row['data_fim_planejada'] = 'Não Disponível';
		};
		if($row['titulo']){
			$row['trechos'] = $row['titulo'];
		};
		 
		$relatorio .= $local.';"=""'.$options_contratos[$row['id_contrato']].'""";'.$row['lote'].';'.$row['trechos'].';'.$row['extensao'] .';'.$progresso_total.'%;'.
				$row['data_ini_planejada'].';'.$row['data_first_mov'].';'.$row['data_fim_planejada'].';'.$row['data_last_mov'].';'.$row['status'].';'."\n";
	}
	 
	$nameFile  = 'resumo_'.date('Y-m-d').'.csv';
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
	          Resumo EVTEAS
	        </li>
	      </ol>
	    
	    	<h3>Baixar Relatório</h3>
			<a href="<?php echo base_url('assets/gestao_estudos_projetos/pas/relatorios').'/'.$nameFile ?>"><img src="<?php echo base_url('assets/img/icons/xls.png');?>" width="64"  height="64" /></a>
			
          <div class="well well-pas">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            ?>

             <div class="form-group form-inline reset-margin">
             	<?php echo  form_label("Buscar:", "search_string"); ?>
             	<label></label>
			    <input type="text" class="search form-control" placeholder="Oque você está procurando?">
			</div>
			
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed  table-hover results">
	            <thead>
	              <tr>
	              	<th class="yellow header headerSortDown">Local</th>
	              	<th class="yellow header headerSortDown">Contrato</th>
					<th class="yellow header headerSortDown">Lote</th>
					<th class="yellow header headerSortDown">Trechos</th>
					<th class="yellow header headerSortDown">Extensão</th>
					<th class="yellow header headerSortDown">Progresso</th>
					<!-- <th class="yellow header headerSortDown">Data Inicial (Contratada)</th> -->
					<th class="yellow header headerSortDown">Data Inicial (Planejada)</th>
					<th class="yellow header headerSortDown">Data de Início</th>
					<!--<th class="yellow header headerSortDown">Data Final (Contratada)</th>-->
					<th class="yellow header headerSortDown">Data Final (Planejada)</th>
					<th class="yellow header headerSortDown">Data Fim</th>
					<th class="yellow header headerSortDown">Status</th>
				  </tr>
				  <tr class="warning no-result">
			      	<td colspan="10"><i class="fa fa-warning"></i>Sem Resultados</td>
			      </tr>
	            </thead>
	            <tbody>
	           <?php
				  $relatorio = 'Local;Lote;Trechos;Extensão;Progresso;Data Inicial (Planejada);Data de Início;Data Final (Planejada);Data Fim;Status;'."\n";	
				  
	              foreach($pas as $row)
	              {
	              	$progresso_total = ( $row['progresso_total'] > 0 ) ? $row['progresso_total'] : 0;
	              	$tituloTrecho = '';
	              	
	                echo '<tr>'; 
	                echo '<td>'.$options_locais[$row['id_local_execucao']].'</td>';
	                echo '<td scope="row"  >'.$options_contratos[$row['id_contrato']].'</td>';
					echo '<td scope="row"  >'.$row['lote'].'</td>';
					echo '<td>';
					echo 	($row['titulo']) ? $row['titulo'] : $row['trechos'];
					echo '</td>';
					echo '<td>'. $row['extensao'] .'</td>';
					echo '<td>
	            		<div class="progress progress-striped active">
		        			<div class="progress-bar"
		        				role="progressbar"
		        				aria-valuenow="'.$progresso_total.'"
		        				aria-valuemin="0"
		        				aria-valuemax="100"
		        				style="width: '.$progresso_total.'%">'.$progresso_total.'%
		        			</div>
		      			</div>
              		</td>';
					//echo '<td>'.$row['data_ini_pas'].'</td>';
					echo '<td>'.$row['data_ini_planejada'].'</td>';
					echo '<td>';
    				echo 	isset($row['data_first_mov']) ? $row['data_first_mov'] : ' Não Disponível ' ;
    				echo '</td>';
    				/*
					echo '<td>';
					echo ($row['data_ini_pas'] < $row['data_fim_pas']) ? $row['data_fim_pas']  : ' Não Disponível '; 
					echo '</td>';
					*/
					echo '<td>';
					echo ($row['data_ini_planejada'] < $row['data_fim_planejada']) ? $row['data_fim_planejada']  : ' Não Disponível ';
					echo '</td>';
					echo ($progresso_total < 100 ) ? '<td>Não Disponível</td>' : '<td>'.$row['data_last_mov'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					
		         /*
				  echo 	'<a href="'.site_url("admin").'/pas/detalhes/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Visualizar</a>
	              		  <a href="'.site_url("admin").'/pas_trechos/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Trechos</a>		
	              		  <a href="'.site_url("admin").'/pas_fases/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Atividades</a>	
	            		  <a href="'.site_url("admin").'/pas_documentos/lista_documento/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Documentos</a>
	                      <a href="'.site_url("admin").'/pas/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
		                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>';
		                 
				  */
					
					
	              echo "</tr>";
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
		
		  $(".search").keyup(function () {
		    var searchTerm = $(".search").val();
		    var listItem = $('.results tbody').children('tr');
		    var searchSplit = searchTerm.replace(/ /g, "'):containsi('");
		    
		  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
		        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		    }
		  });
		    
		  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
		    $(this).attr('visible','false');
		  });
	
		  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
		    $(this).attr('visible','true');
		  });
	
		  var jobCount = $('.results tbody tr[visible="true"]').length;
		    $('.counter').text(jobCount + ' item');
	
		  if(jobCount == '0') {$('.no-result').show();}
		  else {$('.no-result').hide();}
		});
	});

	
	

 	$(function(){
		  $("table").tablesorter({
		    onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }
		  });
		});

 	
</script>
	
