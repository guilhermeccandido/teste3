<div class="container-fluid">
  <div class="row row-offcanvas row-offcanvas-left">	
	<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
           
            <ul class="nav nav-sidebar">
              <li class="active"><a href="#">Programa</a></li>
              <li><a href="" target="_ext">Dashboard</a></li>
              <li><a href="" target="_ext">Condição ICS</a></li>
              <li><a href="" target="_ext">Gerenciadora</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="">Lote 1</a></li>
              <li><a href="">Lote 2</a></li>
              <li><a href="">Lote 3</a></li>
              <li><a href="">Lote 4</a></li>
              <li><a href="">Lote 5</a></li>
              <li><a href="">Lote 6</a></li>
            </ul>
            <div>
            	<?php
            	$attributes = array("class" => "form-inline reset-margin", "id" => "myform");
            	$options_anteprojetos = array();
            	$options_anteprojetos['id'] = 'Ordem de Criação';
            	$options_anteprojetos['rodovia'] = 'Rodovia';
            	$options_anteprojetos['uf'] = 'UF';
            	$options_anteprojetos['status'] = 'Status';
            	$options_anteprojetos['progresso'] = 'Progresso';
            	 
            	
            	echo form_open("admin/iri", $attributes);
            	 
            	echo form_label("Buscar:", "search_string");
            	echo form_input("search_string", $search_string_selected, 'class="form-control"');
            	
            	echo form_label("Ordenar por:", "order");
            	echo form_dropdown("order", $options_anteprojetos, $order, 'class="form-control"');
            	
            	$data_submit = array("name" => "mysubmit", "class" => "btn btn-primary", "value" => "Ir");
            	
            	$options_order_type = array("Asc" => "Asc", "Desc" => "Desc");
            	echo form_dropdown("order_type", $options_order_type, $order_type_selected, 'class="form-control"');
            	
            	echo form_submit($data_submit);
            	
            	echo form_close();
            	?>
            </div>
          
	</div><!--/span-->

	<div class="col-sm-9 col-md-10 main">
          
   	   <!--toggle sidebar button-->
	   <p class="visible-xs">
	   		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
	   </p>	  
	  <div class="row">	  	  
        <div class="main">
	        <ol class="breadcrumb">
		        <li>
		          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 
	          
	        </li>
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(2));?>
	        </li>
	      </ol>
	 	</div>
	  </div>
	  
		
		  <!-- Inicio da Tabela e Mapa -->
		  	<div class="row">
				<!--  table easy pie container -->	  	
		  		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
		  			<!--  easy pie container -->
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					   <div class="row center-block" style="float: right">
							<div class="col-md-4">
								<span class="piechart easy-pie-chart green" data-percent="86">
									<span class="percent"></span>
								</span>
								<span class="btn js_update">AE 1</span>
							</div>
							<div class="col-md-4">
								<span class="piechart easy-pie-chart blue" data-percent="58">
									<span class="percent"></span>
								</span>		
								<span class="btn js_update">AE 2</span>				
							</div>
							<div class="col-md-4">
								<span class="piechart easy-pie-chart red" data-percent="37">
									<span class="percent"></span>
								</span>
								<span class="btn js_update">AE 3</span>
							</div>
					   </div>
					<!--  end easy pie -->
					</div>
				    <!--  easy pie container -->
		  			<!--  table container -->
				  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  	<div class="table-responsive">
				          <table class="table table-striped table-bordered table-condensed  table-hover results">
				            <thead>
				              <tr>
				              	<th class="yellow header headerSortDown">Lote</th>
								<th class="yellow header headerSortDown">Mês</th>
								<th class="yellow header headerSortDown">Total</th>
								<th class="yellow header headerSortDown">%</th>
							  </tr>
				            </thead>
				            <tbody>
				            	<tr>
					            	<td>1</td>
					            	<td>90</td>
					            	<td>15400</td>
					            	<td>16.5%</td>
					            </tr>
					            <tr>
					            	<td>2</td>
					            	<td>400</td>
					            	<td>5400</td>
					            	<td>16%</td>
					            </tr>
					            <tr>
					            	<td>3</td>
					            	<td>900</td>
					            	<td>4300</td>
					            	<td>20.2%</td>
					            </tr>
					            
					            <tr>
					            	<td>4</td>
					            	<td>876</td>
					            	<td>94037</td>
					            	<td>78.1%</td>
					            </tr>
					            <tr>
					            	<td>5</td>
					            	<td>436</td>
					            	<td>9333</td>
					            	<td>77.8%</td>
					            </tr>
					            <tr>
					            	<td>6</td>
					            	<td>322</td>
					            	<td>6488</td>
					            	<td>9.7%</td>
					            </tr>
				            </tbody>
				          </table>
				        </div>
				    </div>
				    <!--  table container -->
				    
				</div>
				<!--  table easy pie container -->
				
			    <!-- Inicio do Mapa -->
		        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
		          <div class="panel panel-contratos">
					<div class="panel-heading">
					  <div class="panel-heading-btn">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                  </div>
		              <h3 class="panel-title">Trechos</h3>
		            </div>
		            <div class="panel-body" style="height:100%;">
		            	
		            	
		            	<div data-dojo-type="dijit/layout/BorderContainer" data-dojo-props="design:'headline'"
					         style="width: 100%; height: 100%; margin: 0;">
					      <div id="map" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'center'"
					           style="border:1px solid #000;padding:0;">
					      </div>
					    </div>
		            </div>
		          </div>
		        </div>
		        <!-- Fim do Mapa -->
		       
		  </div>
		  <!--  Fim da tabela e do mapa -->
	      
	      <!--  Inicio dos Totalizadores -->
		<div class="row" >
	        <div class="col-md-4 col-sm-6" >
	        	<div class="widget widget-stats bg-green" >
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Total Averiguado</h4>
						<p>35.012</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	          <div class="col-md-4 col-sm-6" >
	        	<div class="widget widget-stats bg-orange">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Total Mês</h4>
						<p>8.033</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	          <div class="col-md-4 col-sm-6" >
	        	<div class="widget widget-stats bg-blue">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>% Executado</h4>
						<p>23.5%</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	          
	       	  <div class="col-md-4 col-sm-6" >
	        	<div class="widget widget-stats bg-grey-lighter">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>AE-1</h4>
						<p>31.862</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	           <div class="col-md-4 col-sm-6" >
	        	<div class="widget widget-stats bg-green-darker">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>AE-2</h4>
						<p>375</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	        <div class="col-md-4 col-sm-6" >
	        	<div class="widget widget-stats bg-green">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>AE-3</h4>
						<p>12.781</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>          
	      </div>
		  <!--  Fim dos Totalizadores -->
	      
	      
	      <!-- ROW 1 graficos -->
	      <div class="row">
		  
	        <div class="col-md-6">
            	<div class="panel panel-contratos" data-sortable-id="flot-chart-2">
                	<div class="panel-heading">
                    	<div class="panel-heading-btn">
                        	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
						<h4 class="panel-title">Line Chart</h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid" >
	                        <canvas id="line-chart" data-render="chart-js"></canvas>
						</div>
                	</div>
                </div>
		    </div>
		  	<div class="col-md-6" >
	      		<div class="panel panel-contratos" data-sortable-id="flot-chart-3" data-init="true">
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Polar Chart</h3>
			    	</div>
			    	<div class="panel-body">
			    	
			    	<div class="grid">
					  <canvas id="polar-area-chart" data-render="chart-js"></canvas>
					</div>
                  	</div>
		   		</div>
		  	</div>
		  </div><!-- ROW 1 graficos-->
	      
	      
	      <div class="row"><!-- ROW 2 graficos -->
	      
	      	<div class="col-md-6" >
	      		<div class="panel panel-contratos" data-sortable-id="morris-chart-1" data-init="true">
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="drawChart_cronograma_div();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Cronograma 2016 01</h3>
			    	</div>
			    	<div class="panel-body">
			    	
			    	<div class="grid">
  						<div >
					    <?php 
					    
						    echo $this->gcharts->LineChart('Cronograma')->outputInto('cronograma_div');
						    echo $this->gcharts->div(0,0,'chart');
						
						    if($this->gcharts->hasErrors())
						    {
						        echo $this->gcharts->getErrors();
						    }
						    
					    ?>
					  </div>
					</div>
                  	</div>
		   		</div>
		  	</div>
		  	
		  	<div class="col-md-6" >	      		
		      	<div class="panel panel-contratos" data-sortable-id="morris-chart-2" data-init="true" >
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="drawChart_inventory_div();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Cronograma 2016 03</h3>
			    	</div>
			    	<div class="panel-body">
			    	
			    	<div class="grid">
					  <div>
					    <?php 
					    
						    echo $this->gcharts->ColumnChart('Inventory')->outputInto('inventory_div');
						    echo $this->gcharts->div(0,0,'chart');
						
						    if($this->gcharts->hasErrors())
						    {
						        echo $this->gcharts->getErrors();
						    }
						    
					    ?>
					  </div>
					</div>
                  	</div>
		   		</div>
		   	</div>
		  </div><!-- ROW 2 graficos -->
		  
		  
		  
		  <div class="row"><!-- ROW 3 graficos -->
		  
		  	<div class="col-md-6">
            	<div class="panel panel-contratos" data-sortable-id="flot-chart-1" data-init = "true">
                	<div class="panel-heading">
                    	<div class="panel-heading-btn">
                        	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
						<h4 class="panel-title">Radar Chart</h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                        <canvas id="radar-chart" data-render="chart-js"></canvas>
						</div>
                	</div>
                </div>
		    </div>
		  	
	      			   		
		    <div class="col-md-6" >		    	
		      	<div class="panel panel-contratos" data-sortable-id="morris-chart-3" data-init="true">
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="drawChart_foods_div();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Cronograma 2016</h3>                  	
			    	</div>
			    	<div class="panel-body">
			    	
			    	<div class="grid">
  						<div class="col-1-2">
					    <?php 
					    
						    echo $this->gcharts->DonutChart('Foods')->outputInto('foods_div');
						    echo $this->gcharts->div(0,0,'chart');
						
						    if($this->gcharts->hasErrors())
						    {
						        echo $this->gcharts->getErrors();
						    }
						    
					    ?>
					  </div>
					</div>
                  	</div>
		   		</div>
		    </div>
		    	 		    
		   </div><!--  end ROW 3 graficos--> 
		  
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
     	padding: 50px 0 0 0;
  		background-color: #f5f5f5;
     }
     
	 #map_canvas {
	  height: 100%;
	  width: 100%;
	}
	
	
	.row{
        margin-left: -15px;
	   	margin-right: -15px;
	}
	
	footer {
	  padding-left: 15px;
	  padding-right: 15px;
	  background-color: #fff;
	}

	.piechart {
	  position: relative;
	  display: inline-block;
	  width: 110px;
	  height: 110px;
	  margin-top: 50px;
	  margin-bottom: 50px;
	  text-align: center;
	}
	.piechart canvas {
	  position: absolute;
	  top: 0;
	  left: 0;
	}

	.percent {
	  display: inline-block;
	  line-height: 110px;
	  z-index: 2;
	}
	.percent:after {
	  content: '%';
	  margin-left: 0.1em;
	  font-size: .8em;
	}




/*
 * Off Canvas
 * --------------------------------------------------
 */
@media screen and (max-width: 768px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
  }

  .row-offcanvas-left
  .sidebar-offcanvas {
    left: -33%;
  }

  .row-offcanvas-left.active {
    left: 33%;
  }

  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 33%;
    margin-left: 10px;
  }
}


/* Sidebar navigation */
.nav-sidebar {
  background-color: #f5f5f5;
  margin-right: -15px;
  margin-bottom: 20px;
  margin-left: -15px;
}
.nav-sidebar > li > a {
  padding-right: 20px;
  padding-left: 20px;
}
.nav-sidebar > .active > a {
  color: #fff;
  background-color: #428bca;
}

/*
 * Main content
 */

.main {
  padding: 20px;
  background-color: #fff;
}
@media (min-width: 768px) {
  .main {
    padding-right: 40px;
    padding-left: 40px;
  }
}
.main .page-header {
  margin-top: 0;
}

	
	
	
</style>

<script>
var djConfig = {
        locale: "pt-br",
        parseOnLoad: false,
        packages: [
             {
                 name: 'agsjs',
                 "location":  "<?php echo base_url('assets/portal/js/widget/'); ?>"
             },
        ],
        async: false
    };
	
	
</script>


<script src="<?php echo  base_url().'assets/portal/js'?>/jquery.easypiechart.min.js"></script>
<script src="https://js.arcgis.com/3.17/"></script>
 
	<script>

		$(window).resize(function(){
		  drawChart_cronograma_div();
		  drawChart_inventory_div();
		  drawChart_foods_div();
		});
	
	

		$(document).ready(function() {
			App.init();
			ChartJs.init();
			$('#Grid').mixitup();
			//MorrisChart.init();
			
			$(function(){
			  $("table").tablesorter({
			    onRenderHeader: function(){
			      this.prepend('<span class="icon"></span>');
			    }
			  });
			});
					
						  
		});


		$(window).resize(function(){
			drawChart_stock_div2();
		});

		if( $('.easy-pie-chart').length > 0 ) {

			var cOptions = {
					delay: 3000,
					barColor: '#69c',
					trackColor: '#ace',
					scaleColor: false,
					lineWidth: 20,
					trackWidth: 16,
					lineCap: 'butt',
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
			}

			$('.easy-pie-chart.blue').easyPieChart(cOptions);
			
			cOptions.barColor = '#EE6E73';
			cOptions.trackColor = '#F29396';
			$('.easy-pie-chart.red').easyPieChart(cOptions);
			
			cOptions.barColor = '#66BB6A';
			cOptions.trackColor = '#89CB8C';
			$('.easy-pie-chart.green').easyPieChart(cOptions);
			
		}

		var chart = window.chart = $('.chart').data('easyPieChart');
		$('.js_update').on('click', function() {
			chart.update(Math.random()*200-100);
		})


		
	 	/* modal : '#events-modal',*/
	 		
	 		
		    var map;
		   
		    
		
			  
			  require([	
						"dojo/parser",
						
			 		  	"esri/map", 
			 		  	"esri/geometry/Extent", 
			     	  	"esri/layers/ArcGISDynamicMapServiceLayer",
			     	  	"dojo/dom", 
			     	  	"dojo/on",  
			     	  	"agsjs/InfoMap",
			     	  	"dijit/layout/BorderContainer", 
			     	  	"dijit/layout/ContentPane",  
			     	  	"dojo/domReady!"],
			     	  	 function (parser , Map, Extent,  ArcGISDynamicMapServiceLayer,  dom, on,  InfoMap  ) {
			        
				  parser.parse();
			        initialExtent = new Extent({
			            xmin: -16079904.766291741,
			            ymin: -7007746.75318313,
			            xmax: 2705259.30506818,
			            ymax: 2316347.705153331,
			            "spatialReference": {
			                "wkid": 102100
			            }
			        });
			       
			        map = new Map("map", {
			            basemap: "topo",  
			            extent: initialExtent
			        });

			        
			        var url ="https://servicos.dnit.gov.br/arcgis/rest/services/DNIT_Geo/SNV/MapServer"; 
			        var snv = new ArcGISDynamicMapServiceLayer(url, {
			            id: "DNIT"
			        });
			        map.addLayer(snv);

			        var info = new InfoMap({ map: map });
					
			  });
	</script>
