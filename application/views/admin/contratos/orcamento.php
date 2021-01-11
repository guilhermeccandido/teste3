<div class="container-fluid">
  <div class="row row-offcanvas row-offcanvas-left">	
	<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
           <div  class="nav nav-sidebar">
            <ul class="nav nav-sidebar">
            
            <?php
            	//print_r($nav_bar);
            	//die;
            	$lv1 = '';
            	$lv2 = '';
            	$lv3 = '';
            	$first = true;
				foreach($nav_bar as $item){
					if($first){
						$first = false;
						$lv1 = $item['geral'];
						$lv2 = $item['setorial'];
						echo '<li class="active"><a href="'.base_url().'admin/contratos/orcamento/'.$id_orcamento.'">'.$item['geral'].'</a></li>';
						?>
						  <li>
			              	<a href="<?php echo base_url().'admin/contratos/orcamento/'.$id_orcamento.'/'.$item['setorial_alias']; ?>" ><?php echo $item['setorial']; ?></a>
			              </li>
			              <ul class="sub-menu " id="products">
			              	<li class="active">
			              		<a href="<?php echo base_url().'admin/contratos/orcamento/'.$id_orcamento.'/'.$item['setorial_alias'].'/'.$item['programas_alias']; ?>"><?php echo $item['programas']; ?></a>
			              	</li>
			            <?php 
					}else if($lv2 == $item['setorial'] ){
						?>
							<li>
			              		<a href="<?php echo base_url().'admin/contratos/orcamento/'.$id_orcamento.'/'.$item['setorial_alias'].'/'.$item['programas_alias']; ?>"><?php echo $item['programas']; ?></a>
			              	</li>
						<?php 
					}else{
						$lv2 = $item['setorial']
						?>
						
						   </ul>
			               <li>
			              	 <a href="<?php echo base_url().'admin/contratos/orcamento/'.$id_orcamento.'/'.$item['setorial_alias']; ?>" ><?php echo $item['setorial']; ?></a>
			               </li>
			                <ul class="sub-menu " id="products">
			              	  <li>
			              		<a href="<?php echo base_url().'admin/contratos/orcamento/'.$id_orcamento.'/'.$item['setorial_alias'].'/'.$item['programas_alias']; ?>"><?php echo $item['programas']; ?></a>
			              	  </li>
						<?php 
					}					
					
				}	
            ?>
             </ul>
            </ul>
          </div>
		</div><!--/span-->


<div class="col-sm-9 col-md-10 main">
          
   <!--toggle sidebar button-->
   <p class="visible-xs">
   		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
   </p>	  
	  <div class="row">	  	  
        <div class="main">
        	<?php
        		if($this->uri->segment(6)){
					$site_base = site_url("admin").'/contratos/orcamento/'.$this->uri->segment(4);
        			$breadCrumb = '  <li class="active">
										<a href="'.$site_base.'">
							          		Orçamento
            							</a>
							        </li>
              						<li>
              							<a href="'.$site_base.'/'.$this->uri->segment(5).'">
							          	 '.ucfirst($this->uri->segment(5)).'
              							</a>
							        </li>
              		 				<li class="active">
							          '.ucfirst($this->uri->segment(6)).'
							        </li>';
        			
        		}else if($this->uri->segment(5)){
					$site_base = site_url("admin").'/contratos/orcamento/'.$this->uri->segment(4);
        			$breadCrumb = ' <li class="active">
										<a href="'.$site_base.'">
							          		Orçamento
            							</a>
							        </li>
									<li class="active">
							          '.ucfirst($this->uri->segment(5)).'
							        </li>';
        			
        		} else{
        			$breadCrumb = '
							        <li class="active">
							          Orçamento
							        </li>';
        		} 
        	?>
	        <ol class="breadcrumb">
		        <li>
		          <a href="<?php echo site_url("admin"); ?>">
		            <?php echo ucfirst($this->uri->segment(1));?>
		          </a> 
		          
		        </li>
		        <?php echo  $breadCrumb ;?>
		      </ol>
		  
		  
	      <div class="row" >
	        <div class="col-md-3 col-sm-6" >
	        	<div class="widget widget-stats bg-green" >
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>RAP</h4>
						<p><?php echo  isset($orcamento_totais[0]['RAP']) ? number_format($orcamento_totais[0]['RAP'],0,",",".") : 'Sem dados';  ?></p>	
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
						<p><?php echo  isset($orcamento_totais[0]['med_n_pagas_ano_anterior']) ? number_format($orcamento_totais[0]['med_n_pagas_ano_anterior'],0,",",".") : 'Sem dados';  ?></p>	
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
						<p><?php echo  isset($orcamento_totais[0]['prev_medicoes_ano_anterior']) ? number_format($orcamento_totais[0]['prev_medicoes_ano_anterior'],0,",",".") : 'Sem dados';  ?></p>	
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
						<p><?php echo  isset($orcamento_totais[0]['est_saldo_empenho']) ? number_format($orcamento_totais[0]['est_saldo_empenho'],0,",",".") : 'Sem dados';  ?></p>	
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
						<p><?php echo  isset($orcamento_totais[0]['previsao_pagamento_ano_corrente']) ? number_format($orcamento_totais[0]['previsao_pagamento_ano_corrente'],0,",",".") : 'Sem dados';  ?></p>	
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
						<p><?php echo  isset($orcamento_totais[0]['necessidade_empenho_ano_corrente']) ? number_format($orcamento_totais[0]['necessidade_empenho_ano_corrente'],0,",",".") : 'Sem dados';  ?></p>	
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
						<h4>N. de Contratos</h4>
						<p><?php echo  isset($orcamento_totais[0]['num_contratos']) ? $orcamento_totais[0]['num_contratos'] : 'Sem dados';  ?></p>	
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
		<div class="row"><!-- ROW 3 -->
		  
		  	<div class="col-md-12">
            	<div class="panel panel-contratos" data-sortable-id="table-data-1" data-init = "true">
                	<div class="panel-heading">
                    	<div class="panel-heading-btn">
                        	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
						<h4 class="panel-title">Dados de Orçamento</h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">
						          <table class="table table-striped table-bordered table-condensed">
						            <thead>
						              <tr>
						            	
									<?php
									
									$options_coordenacao_geral = array( 0 => '' );
									foreach ($coordenacao_geral as $array) {
										$options_coordenacao_geral[$array['id']] = $array['titulo'];
									}
									
									$options_coordenacao_setorial = array( 0 => '' );
									foreach ($coordenacao_setorial as $array) {
										$options_coordenacao_setorial[$array['id']] = $array['titulo'];
									}
									
									$options_programas = array( 0 => '' );
									foreach ($programas as $array) {
										$options_programas[$array['id']] = $array['titulo'];
									}
									
									/*
									 <th class="yellow header headerSortDown">Fiscal</th>
									 <th class="yellow header headerSortDown">Unidade Gestora</th>
									 <th class="yellow header headerSortDown">Situação</th>
									<th class="yellow header headerSortDown">Objeto</th>
									<th class="yellow header headerSortDown">Edital</th>
									
									<th class="yellow header headerSortDown">Data de Proposta/Base</th>
									<th class="yellow header headerSortDown">Data de Aprovação</th>
									<th class="yellow header headerSortDown">Data de Assinatura</th>
									<th class="yellow header headerSortDown">Data de Publicação</th>
									<th class="yellow header headerSortDown">Prazo</th>
									<th class="yellow header headerSortDown">Valor PI</th>
									<th class="yellow header headerSortDown">Valor Reajuste</th>
									<th class="yellow header headerSortDown">Valor Aditivo</th>				
									<th class="yellow header headerSortDown">Valor Medido (PI)</th>				
									<th class="yellow header headerSortDown">Valor Pago</th>				
									<th class="yellow header headerSortDown">Saldo de Empenho</th>
									<th class="yellow header headerSortDown">Observações</th>
									 
									 */
									
									
									
									?>
										<th class="header">Coordenação Geral</th>
										<th class="header ">Coordenação Setorial</th>
										<th class="header ">Programa</th>
										<th class="header ">Edital</th>
										<th class="header ">Contrato</th>
										<th class="header ">Empresa</th>
										<th class="header ">RAP</th>
										<th class="header ">Medições Processadas não Pagas</th>
										
									</tr>
						            </thead>
						            <tbody>
						              <?php
						              
						              foreach($orcamentos as $row)
						              {
						                echo '<tr>';
										echo '<td>';
										echo	$options_coordenacao_geral[$row['coordenacao_geral']];
										echo '</td>';
										echo '<td>'.$options_coordenacao_setorial[$row['coordenacao_setorial']].'</td>';					
										echo '<td>'.$options_programas[$row['programa']].'</td>';					
										echo '<td>'.$row['edital'].'</td>';
										echo '<td>'.$row['contrato'].'</td>';					
										echo '<td>'.$row['empresa'].'</td>';
										echo '<td>'.$row['rap'].'</td>';					
										echo '<td>'.$row['medicoes_processadas_n_pagas_ano_anterior'].'</td>';
						                echo "</tr>";
						              }
						     		?>	            
						            </tbody>
						          </table>
							  </div> 
						</div>
                	</div>
                </div>
		    </div>
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	