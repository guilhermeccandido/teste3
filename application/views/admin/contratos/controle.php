<div class="container-fluid">
  <div class="row row-offcanvas row-offcanvas-left">	
	<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
           
            <ul class="nav nav-sidebar">
              <li class="active"><a href="#">Overview</a></li>
              <li><a href="" target="_ext">Themes</a></li>
              <li><a href="" target="_ext">Analytics</a></li>
              <li><a href="" target="_ext">Export</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="">Nav item</a></li>
              <li><a href="">Nav item again</a></li>
              <li><a href="">One more nav</a></li>
              <li><a href="">Another nav item</a></li>
              <li><a href="">More navigation</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="">Nav item again</a></li>
              <li><a href="">One more nav</a></li>
              <li><a href="">Another nav item</a></li>
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
            	 
            	
            	echo form_open("admin/anteprojetos", $attributes);
            	 
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
		  
		  
	      <div class="row" >
	        <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-green" >
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>RAP 2016</h4>
						<p>235.012.781</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	          <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-orange">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Medições Processadas(n pagas)</h4>
						<p>8.033.463</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	          <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-blue">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Medições a Processar</h4>
						<p>6.005.137</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	           <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-purple">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Estimativa Saldo de Empenho</h4>
						<p>229.629.189</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	          
	       	  <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-grey-lighter">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Previsão Pagamento 2016</h4>
						<p>389.631.862</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	           <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-green-darker">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>N. Empenho em 2016</h4>
						<p>243.255.375</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	        <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-green">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Pagamentos 2016</h4>
						<p>235.012.781</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>
	          <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-orange">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Pagamentos Mês Atual</h4>
						<p>8.033.463</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
	          </div>	          
	      </div>
	      
	      <div class="row"><!-- ROW 2 -->
		  
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
		  </div><!-- ROW 2 -->
	      
	      
	      <div class="row"><!-- ROW 1 -->
	      
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
		  </div><!-- ROW 1 -->
		  
		  
		  
		  <div class="row"><!-- ROW 3 -->
		  
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
		    	 		    
		   </div><!--  end ROW --> 
		   
		 <?php  
		 /*
		   <!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Chart</a></li>
				<li class="active">Morris Chart</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Morris Chart <small>header small text goes here...</small></h1>
			<!-- end page-header -->
			
		    <!-- begin row -->
		    <div class="row">
		        <!-- begin col-6 -->
		        <div class="col-md-6">
                    <div class="panel panel-contratos" data-sortable-id="morris-chart-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Morris Line Chart</h4>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center">Audi Vehicles Sales Report in UK</h4>
                            <div id="morris-line-chart" class="height-sm"></div>
                        </div>
                    </div>
                    <div class="panel panel-contratos" data-sortable-id="morris-chart-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Morris Area Chart</h4>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center">Quarterly Apple iOS device unit sales</h4>
                            <div id="morris-area-chart" class="height-sm"></div>
                        </div>
                    </div>
		        </div>
		        <!-- end col-6 -->
		        <!-- begin col-6 -->
		        <div class="col-md-6">
                    <div class="panel panel-contratos" data-sortable-id="morris-chart-3">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Morris Bar Chart</h4>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center">Phone CPU benchmarks</h4>
                            <div id="morris-bar-chart" class="height-sm"></div>
                        </div>
                    </div>
                    <div class="panel panel-contratos" data-sortable-id="morris-chart-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Morris Donut Chart</h4>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center">Donut flavours</h4>
                            <div id="morris-donut-chart" class="height-sm"></div>
                        </div>
                    </div>
		        </div>
		        <!-- end col-6 -->
		    </div>
		    <!-- end row -->
		</div>  
		 */
		?>
          <div class="well well-contratos">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_anteprojetos = array();
	            $options_anteprojetos['id'] = 'Ordem de Criação';
	            $options_anteprojetos['rodovia'] = 'Rodovia';
	            $options_anteprojetos['uf'] = 'UF';
	            $options_anteprojetos['status'] = 'Status';
	            $options_anteprojetos['progresso'] = 'Progresso';         
	            

            echo form_open("admin/anteprojetos", $attributes);
     
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

		$(window).resize(function(){
		  drawChart_cronograma_div();
		  drawChart_inventory_div();
		  drawChart_foods_div();
		});
	
		$(document).ready(function() {
			App.init();
			ChartJs.init();
			/*
			ChartJs.init();
			MorrisChart.init();
			*/
		});

		$(function() {
		    $('#Grid').mixitup();
		});
		
		function open_modal(id){
			$("#actionModal").attr("href", "anteprojetos/delete/"+id);
		};

		$(function(){
			  $("table").tablesorter({
			    onRenderHeader: function(){
			      this.prepend('<span class="icon"></span>');
			    }
			  });
			});

		$("#menu-toggle").click(function(e) {
	        	e.preventDefault();
		        $("#wrapper").toggleClass("active");
		});

		 $('[data-toggle=offcanvas]').click(function() {
		    $('.row-offcanvas').toggleClass('active');
		  });

		
		 /*
		 var data = {
				    labels: ["JAN", "FEV", "MAR", "ABR", "MAI", "JUN", "JUL", "AGO", "SET", "OUT", "NOV", "DEZ"],
				    datasets: [
				        {
				            label: "My First dataset",
				            fillColor: "rgba(220,220,220,0.2)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "rgba(220,220,220,1)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: [65, 59, 80, 81, 56, 55, 40, 59, 80, 81, 56, 55]
				        },
				        {
				            label: "My Second dataset",
				            fillColor: "rgba(151,187,205,0.2)",
				            strokeColor: "rgba(151,187,205,1)",
				            pointColor: "rgba(151,187,205,1)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(151,187,205,1)",
				            data: [28, 48, 40, 19, 86, 27, 90, 48, 40, 19, 86, 27]
				        }
				    ]
				};
		 var ctx = document.getElementById("line-chart").getContext("2d");
		 var myNewChart = new Chart(ctx).Line(data);
		 
		 var radardata = {
				    labels: ["Eficiência", "Eficacia", "Efetividade", "Capacidade", "Economicidade", "Dependencia", "Desempenho"],
				    datasets: [
				        {
				            label: "Covide",
				            fillColor: "rgba(220,220,220,0.2)",
				            strokeColor: "rgba(220,220,220,1)",
				            pointColor: "rgba(220,220,220,1)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(220,220,220,1)",
				            data: [65, 59, 90, 81, 56, 55, 40]
				        },
				        {
				            label: "Coplan",
				            fillColor: "rgba(151,187,205,0.2)",
				            strokeColor: "rgba(151,187,205,1)",
				            pointColor: "rgba(151,187,205,1)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(151,187,205,1)",
				            data: [28, 48, 40, 19, 96, 27, 100]
				        },
				        {
				            label: "Geo",
				            fillColor: "rgba(245,299,73,0.2)",
				            strokeColor: "rgba(245,299,73,1)",
				            pointColor: "rgba(245,299,73,1)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(245,299,73,1)",
				            data: [80, 28, 27, 14, 30, 78, 36]
				        }
				    ]
				};
			
		 var options = { 
				    responsive: true,
				    maintainAspectRatio: true
				};

		 var ctx = document.getElementById("radar-chart").getContext("2d");
		 var myRadarChart = new Chart(ctx).Radar(radardata);
		
		
		$(function () {
            $('#datetimepicker12').datetimepicker({
                inline: true,
            });
        });
		
		
		 var map;	
		 var lat_longs_map = new Array();	
		 var markers_map = new Array(); 
		 var iw_map;	iw_map = new google.maps.InfoWindow(); 

		 function initialize_map() {	
			 	var myLatlng = new google.maps.LatLng(-15.78, -53);	
			 	var myOptions = {	
					 	zoom: 4,	
					 	center: myLatlng,	
					 	mapTypeId: google.maps.MapTypeId.HYBRID};
			 		
			 	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);	
			 	var kmlLayerOptions = {	map: map};	
			 	var kmlLayer_0 = new google.maps.KmlLayer("www.google.com.br/maps/dir/Ribeir%C3%A3o+Cascalheira/Vila+Rica/@-12.4311298,-51.8825712,767090m/data=!3m1!1e3!4m13!4m12!1m5!1m1!1s0x93133b1a1676501d:0x3d98e5626a9d5e30!2m2!1d-51.8248805!2d-12.9371655!1m5!1m1!1s0x93197640598dceff:0x5328f495a40ed6b4!2m2!1d-51.1190487!2d-10.0140784", kmlLayerOptions);	
			 }	

		 	function createMarker_map(markerOptions) {	
			 	var marker = new google.maps.Marker(markerOptions);	
			 	markers_map.push(marker);	
			 	lat_longs_map.push(marker.getPosition());	
			 	return marker;	
			 }	

			 google.maps.event.addDomListener(window, "load", initialize_map);
			       
			 */
	</script>
 <?php 
 	
 ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	