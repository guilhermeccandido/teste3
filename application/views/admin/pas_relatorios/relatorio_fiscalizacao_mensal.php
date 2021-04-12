<?php
	// CODE
    foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
    // CSV Header
	$relatorio = 'contrato;id;id_lote;titulo_lote;uf;km_inicial;km_final;extensao;subtrecho;nr_lote;id_produto;nm_produto;data_ini;data_fim;data_ini_planejada;data_fim_planejada;nm_status;data_protocolo;descricao;nome_responsavel;'."\n";
	
    // Copy of response object
    $csvResponse = $response;

	$dataSet = array();
	foreach($csvResponse as $item){
        // CSV Body
        $relatorio .= '"=""'. $item->contrato .'""";'. $item->id .';'. $item->id_lote .';'. $item->titulo_lote .';'. $item->uf .';'. $item->km_inicial .';'. $item->km_final .';'. $item->extensao .';'. $item->subtrecho .';'. $item->nr_lote .';'. $item->id_produto .';'. $item->nm_produto .';'. $item->data_ini .';'. $item->data_fim .';'. $item->data_ini_planejada .';'. $item->data_fim_planejada .';'. $item->nm_status .';'. $item->data_protocolo .';'. $item->descricao .';'. $item->nome_responsavel.';'."\n";		
		
		$dataIni = new DateTime($item->data_ini);
		$dataFim = new DateTime($item->data_fim);
		$dataProtocolo = new DateTime($item->data_protocolo);

		// View on Grid
		$dataSet[] = array($item->contrato,$item->nome_responsavel,$item->nr_lote,$item->titulo_lote,$item->uf,$item->nm_produto,$dataIni->format("d/m/Y"),$dataFim->format("d/m/Y"),$item->nm_status,$dataProtocolo->format("d/m/Y"),$item->descricao);
	}
	$dataSet = json_encode($dataSet);

	$nameFile  = 'fiscalizacao-mensal-de-'. date('d-m-Y') .'-referente-ano-' . $anoSelected . '.csv';
    $pathFile = PAS_RELATORIOS_FOLDER . $nameFile;

    if (!file_exists($pathFile)) {
        $csvFile = fopen($pathFile,'w');
        if ($csvFile == false) die('Não foi possível criar o arquivo.');
    }
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
	          Fiscalização Mensal
	        </li>
	      </ol>
	    
			<h3>Baixar Relatório</h3>
			
			<a href="<?php echo base_url('assets/gestao_estudos_projetos/pas/relatorios').'/'.$nameFile ?>"><img src="<?php echo base_url('assets/img/icons/xls.png');?>" width="64"  height="64" /></a>	
			
			<p><br /></p>
			<input type="hidden" name="url-relatorio" id="url-relatorio" value="<?php echo base_url('pas_relatorios/fiscalizacao_mensal'); ?>" />
			<span>Filtro de pesquisa:</span>&nbsp;
			<select name="cmb-ano" id="cmb-ano">
				<?php
				$ano = date("Y");
				while($ano >= 2000) {
					if ($anoSelected == $ano) {
						echo "<option value='$ano' selected='selected'>$ano</option>";
					}
					else{
						echo "<option value='$ano'>$ano</option>";
					}					
					$ano--;
				}
				?>
			</select>
			&nbsp;
			<span>Resultados referentes ao ano: <strong><?php echo $anoSelected; ?></strong></span>
			<p><br /></p>
			<div class="table-responsive"><table id="grid" class="display" width="100%"></table></div>
                        
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
		var dataSet = <?php echo $dataSet; ?>
		
		$('#grid').DataTable( {
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
			},
			data: dataSet,
			columns: [
				{ title: "Contrato" },
				{ title: "Responsavel" },
				{ title: "Nr Lote" },
				{ title: "Título Lote" },
				{ title: "UF" },
				{ title: "Produto" },
				{ title: "Data ini" },
				{ title: "Data fim" },
				{ title: "Status" },
				{ title: "Data protocolo" },
				{ title: "Descricao" }
			]
		} );

		$('#cmb-ano').on('change', function(){
			let url = $('#url-relatorio').val() + '/ano/' + $('#cmb-ano').val();
			$(location).attr('href',url);
		});

	});
</script>