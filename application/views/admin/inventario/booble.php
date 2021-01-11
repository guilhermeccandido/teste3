<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

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
	          <a href="<?php echo site_url("inventario_dados_tecnicos"); ?>">
	            Inventário de Dados Técnicos
	          </a>
	        </li>
	        <li class="active">
	          Booble
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
             	Gráfico SMCP
             </h2>
          </div>
	    
						<link href='https://fonts.googleapis.com/css?family=Oswald:300,400' rel='stylesheet' type='text/css'>
						<link href='https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700' rel='stylesheet' type='text/css'>
					
						<!-- D3.js -->
						<script src="<?php echo base_url(); ?>assets/portal/js/d3.min.js" charset="utf-8"></script>
						<script src="<?php echo base_url(); ?>assets/portal/js/queue.v1.min.js"></script>
					
						<!-- Combobox script for the search box -->
						<script src="<?php echo base_url(); ?>assets/portal/js/bootstrap-combobox.js"></script>
						<link href="<?php echo base_url(); ?>assets/portal/css/bootstrap-combobox.css" rel="stylesheet">
					
						<!-- Stylesheet -->
						<link rel="stylesheet" href="<?php echo base_url(); ?>assets/portal/css/style2booble.css">
											
						<div>
							
							<div class="row text-center">
								<div class="col-sm-4">
									<div id="subTitle">Small Multiple Circle Packing</div>
									<div id="topText">Nesta visualização, você pode investigar como os dados de levantamento de
														campo estão distribuídos em 359 rodovias federais. Os dados são agrupados
														por região, estado e rodovias por unidade da federação. Você pode clicar em
														qualquer um dos círculos para ampliar ou procurar as informações sobre os
														levantamentos de campo ou ainda por meio do "search box" abaixo.
														Obs: a rodovia aqui é tratada como o somatório de todos os segmentos do
														SNV por unidade da Federação.
									</div>
									
									<hr>
													  
									<div id="searchTitle" class="title">Procure por região, estado ou rodovia</div>
									<div class="form-group">			
										<select id="searchBox" class="combobox input-large form-control" style="display: none;" onchange="searchEvent(this.value)">
											 <option value="" selected="selected">Buscar...</option>
										</select>
									</div>
									
									<div class="row text-center" style=	"margin-top: 30px;">
										<div class="col-sm-6">
											<div id="legendTitle">Legenda</div>
											<div id="legendText">O tamanho de cada círculo é
																dimensionado de acordo com a
																extensão da(s) rodovia(s) em
																quilometros. Quanto maior o círculo,
																maior a extensão da rodovia ou o
																conjunto das rodovias de um
																determinado estado ou região.
											</div>
										</div>
										<div id="legendRowWrapper" class="col-sm-6">
											<div id="legendTitle" style="text-align: center;">Extensão em km</div>
											<div class="legendSubTitle">em km</div>
											<div id="legendCircles"></div>
										</div>
									</div>
									
									<hr>
									
									<div id="topText">
									<div id="legendTitle">Alguns exemplos:<br></div>
										1 - Procure por informaçoes de levantamentos de campo em uma rodovia
										qualquer clicando na região onde esta se encontra, em seguida, clique na
										unidade da federação, na sequência, clique no círculo onde se encontrada a
										rodovia desejada.<br>
										2 - No campo de busca são apresentadas todas as regiões, estados e as 359 rodovias
										federais, a informação desejada poderá ser buscada clicando na seta ao lado do campo de busca. 
										Outra forma de encontrar a informação desejada é
										digitando dentro do próprio campo de search box.
									</div>
									
								</div>
								<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" >		    	
							      	<div class="panel panel-contratos" data-sortable-id="morris-chart-3" data-init="true">
										<div class="panel-heading">
										<div class="panel-heading-btn">
					                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					                        <a href="javascript:;" onclick="" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					                    </div>
										<h3 class="panel-title">SMCP</h3>                  	
								    	</div>
								    	<div class="panel-body">
								    		<div class="grid">
												<div id="chart"></div>
											</div>
										</div>
									</div>
								</div>
						</div>
			</div>
		</div>
	</div>
</div>
		
<script src="<?php echo base_url(); ?>assets/portal/js/script6.js"></script>
<script>
	queue() 
	.defer(d3.csv, "<?php echo base_url(); ?>assets/portal/occupationsbyage.csv")
	.defer(d3.csv, "<?php echo base_url(); ?>assets/portal/idofparentlevels.csv")
	.defer(d3.json, "<?php echo base_url(); ?>assets/portal/occupation.json")
	.await(drawAll);


	$(window).resize(function(){
		
	});

	$(document).ready(function() {
		App.init();
	});
	
	$(function() {
	    $('#Grid').mixitup();
	});
</script>
			