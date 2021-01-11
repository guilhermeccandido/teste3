<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

	$relatorio = 'Contrato;Executora;Lote;Rodovia;UF;km Inicial;km Final;Extensão;'."\n";
	
	$options_contratos = array();
	foreach($contratos as $rowContrato){
		$options_contratos[$rowContrato['id']] =  array( 'contrato' => $rowContrato['contrato'], 'executora' => $rowContrato['executora']);
	}
	
	foreach($pas as $row)
	{
		$relatorio .= '"=""'.$options_contratos[$row['id_contrato']]['contrato'].'""";'.$options_contratos[$row['id_contrato']]['executora'].';'.$row['lote'].';'.$row['rodovia'].';'.$row['uf'] .';'.$row['km_inicial'].';'.$row['km_final'].';'.$row['extensao'].';'."\n";
	}
	 
	$nameFile  = 'resumo_trechos_lotes_'.date('Y-m-d').'.csv';
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
	              	<th class="yellow header headerSortDown">Contrato</th>
	              	<th class="yellow header headerSortDown">Executora</th>
					<th class="yellow header headerSortDown">Lote</th>
					<th class="yellow header headerSortDown">Rodovia</th>
					<th class="yellow header headerSortDown">UF</th>
					<th class="yellow header headerSortDown">SNV</th>
					<th class="yellow header headerSortDown">km Inicial</th>
					<th class="yellow header headerSortDown">km Final</th>
					<th class="yellow header headerSortDown">Extensão</th>
				  </tr>
				  <tr class="warning no-result">
			      	<td colspan="10"><i class="fa fa-warning"></i>Sem Resultados</td>
			      </tr>
	            </thead>
	            <tbody>
	           <?php
				  
	              foreach($pas as $row)
	              {
	                echo '<tr>'; 
	                echo '<td>'.$options_contratos[$row['id_contrato']]['contrato'].'</td>';
	                echo '<td>'.$options_contratos[$row['id_contrato']]['executora'].'</td>';
	                echo '<td>'.$row['lote'].'</td>';
	                echo '<td>'.$row['rodovia'].'</td>';
	                echo '<td>'.$row['uf'].'</td>';
	                echo '<td>'.$row['snv'].'</td>';
	                echo '<td>'.$row['km_inicial'].'</td>';
	                echo '<td>'.$row['km_final'].'</td>';
	                echo '<td>'.$row['extensao'].'</td>';
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
	
