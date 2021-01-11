<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

	if(isset($geral)	) { 
		$panelTitle = 'Informações Gerenciais das Setoriais';
 		$tableName  = 'Setoriais';
	}
	if(isset($setorial) ) { 
		$panelTitle = 'Informações Gerenciais dos Programas';
		$tableName  = 'Programas';
	}
	if(isset($programa) ) { 
		$panelTitle = 'Informações Gerenciais dos Contratos';
		$tableName  = 'Contratos';
	}
	
	if(isset($contrato) ) { 
		$panelTitle = 'Detalhes do Contrato';
		$option_contrato = array();
		foreach($contrato as $item){
			$option_contrato[$item['id']] = $item['contrato']; 
		} 
	}
	
	
?>
<div class="container-fluid">
  <div class="row row-offcanvas row-offcanvas-left">	
	<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
           <div  class="nav nav-sidebar">
            <ul class="nav nav-sidebar">
            
            <?php
            	//print_r($option_nav_bar);
            	//die;
            	$lv1 = '';
            	$lv2 = '';
            	$lv3 = '';
            	$first = true;
            	$option_nav_bar = array();
            	
				foreach($nav_bar as $item){

					$option_nav_bar[$item['geral_alias']] = $item['geral'];
					$option_nav_bar[$item['setorial_alias']] = $item['setorial'];
					$option_nav_bar[$item['programas_alias']] = $item['programas'];

					if($first){
						$first = false;
						$lv1 = $item['geral'];
						$lv2 = $item['setorial'];
						
						echo '<li class="active"><a href="'.base_url().'admin/contratos/gerencial/'.'">'.$item['geral'].'</a></li>';
						?>
						  <li>
			              	<a href="<?php echo base_url().'admin/contratos/gerencial/'.$item['setorial_alias']; ?>" ><?php echo $item['setorial']; ?></a>
			              </li>
			              <ul class="sub-menu " id="products">
			              	<li class="active">
			              		<a href="<?php echo base_url().'admin/contratos/gerencial/'.$item['setorial_alias'].'/'.$item['programas_alias']; ?>"><?php echo $item['programas']; ?></a>
			              	</li>
			            <?php 
					}else if($lv2 == $item['setorial'] ){

						?>
							<li>
			              		<a href="<?php echo base_url().'admin/contratos/gerencial/'.$item['setorial_alias'].'/'.$item['programas_alias']; ?>"><?php echo $item['programas']; ?></a>
			              	</li>
						<?php 
					}else{
						$lv2 = $item['setorial'];
						
						?>
						
						   </ul>
			               <li>
			              	 <a href="<?php echo base_url().'admin/contratos/gerencial/'.$item['setorial_alias']; ?>" ><?php echo $item['setorial']; ?></a>
			               </li>
			                <ul class="sub-menu " id="products">
			              	  <li>
			              		<a href="<?php echo base_url().'admin/contratos/gerencial/'.$item['setorial_alias'].'/'.$item['programas_alias']; ?>"><?php echo $item['programas']; ?></a>
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
        	$site_base = site_url("admin").'/contratos/gerencial/';
        		if($this->uri->segment(6)){
        			$breadCrumb = '  <li class="active">
										<a href="'.$site_base.'">
							          		Gerencial / CGPLAN
            							</a>
							        </li>
									<li>
              							<a href="'.$site_base.$this->uri->segment(4).'">
							          	 '.$option_nav_bar[$this->uri->segment(4)].'
              							</a>
							        </li>
              						<li>
              							<a href="'.$site_base.$this->uri->segment(4).'/'.$this->uri->segment(5).'">
							          	 '.$option_nav_bar[$this->uri->segment(5)].'
              							</a>
							        </li>
              		 				<li class="active">
							          '.$option_contrato[$this->uri->segment(6)].'
							        </li>';
        			$site_base .= $this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/';
        		}else if($this->uri->segment(5)){
        			$breadCrumb = ' <li class="active">
										<a href="'.$site_base.'">
							          		Gerencial / CGPLAN
            							</a>
							        </li>
									<li class="active">
										<a href="'.$site_base.$this->uri->segment(4).'">
							          		'.$option_nav_bar[$this->uri->segment(4)].'
            							</a>
							        </li>
									<li class="active">
							          '.$option_nav_bar[$this->uri->segment(5)].'
							        </li>';
        			$site_base .= $this->uri->segment(4).'/'.$this->uri->segment(5).'/';
        		}else if($this->uri->segment(4)){
        				$site_base = $site_base;
        				$breadCrumb = ' <li class="active">
										<a href="'.$site_base.'">
							          		Gerencial / CGPLAN
            							</a>
							        </li>
									<li class="active">
							          '.$option_nav_bar[$this->uri->segment(4)].'
							        </li>';
        				$site_base .= $this->uri->segment(4).'/';
        		}else{
        				$breadCrumb = '
							        <li class="active">
							          Gerencial / CGPLAN
							        </li>';
        		} 
        	?>
	        <ol class="breadcrumb">
		        <li>
		          <a href="<?php echo base_url('home'); ?>">
		            <?php echo 'Home';?>
		          </a>
		        </li>
		        <li>
		          <a href="<?php echo base_url('gestao_contratos'); ?>">
		            <?php echo 'Gestão de Contratos';?>
		          </a> 
		        </li>
		        <?php echo  $breadCrumb ;?>
		      </ol>
		  
		  <?php 
		  if(isset($tabela_resumo[0]['n_contratos'])){
		  	$n_contratosTemp = 0;
			foreach($tabela_resumo as $row)
			{
				$n_contratosTemp +=  $row['n_contratos'];
			}	
		  }
		  
		  
		  ?>
		  
	      <div class="row" >
	      	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="widget widget-stats bg-green-darker">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Empenho</h4>
						<p><?php echo  isset($valor_empenhado) ? 'R$ '.number_format($valor_empenhado,2,",",".") : 'R$ 0,00';  ?></p>	
					</div>
					<!--
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
					-->
				</div>
	          </div>
	        
	          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="widget widget-stats bg-blue-darker">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Valor Medido Acumulado (PI+R)</h4>
						<p><?php echo  isset($valor_medido_acumulado_pi_r) ? 'R$ '.number_format($valor_medido_acumulado_pi_r,2,",",".") : 'R$ 0,00';  ?></p>	
					</div>
					<!--
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
					-->
				</div>
	          </div>
	          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="widget widget-stats bg-purple-darker" >	
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Valor Contratado (PI+R)</h4>
						<p><?php echo  isset($valor_contrato) ? 'R$ '.number_format($valor_contrato,2,",",".") : 'R$ 0,00';  ?></p>	
					</div>
					<!--
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
					 -->
				</div>
	          </div>
	          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="widget widget-stats bg-green">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Saldo de Empenho</h4>
						<p><?php echo  isset($valor_saldo_empenho) ? 'R$ '.number_format($valor_saldo_empenho,2,",",".") : 'R$ 0,00';  ?></p>	
					</div>
					<!--
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
					-->
				</div>
	          </div>
	           <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="widget widget-stats bg-blue">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Valor Medido Mês Corrente</h4>
						<p><?php echo  isset($valor_medido_pi) ? 'R$ '.number_format($valor_medido_pi,2,",",".") : 'R$ 0,00';  ?></p>	
					</div>
					<!--
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
					-->
				</div>
	          </div>
	          <?php if(!isset($contrato)){ ?>
	          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="widget widget-stats bg-purple">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Número de Contratos</h4>
						<p><?php echo  (isset($n_contratosTemp ))  ? $n_contratosTemp : '-';  ?></p>	
					</div>
					<!--
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
					-->
				</div>
	          </div>
	          <?php }else{ ?>
	          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="widget widget-stats bg-purple">
					<div class="stats-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="stats-info">
						<h4>Percentual Executado</h4>
						<p><?php echo  (isset($valor_contrato) AND isset($valor_medido_acumulado_pi_r) )  ? number_format($valor_medido_acumulado_pi_r*100/$valor_contrato,2,",",".").'%' : '-';  ?></p>	
					</div>
					<!--
					<div class="stats-link">
						<a href="javascript:;">Detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
					-->
				</div>
	          </div>
	          <?php } ?>	          
	      </div>
	      <?php
			if(!isset($contrato)){
				if( isset($pieChart) ) { // PIECHART START
		  ?>
		  <div class="row"><!-- ROW 3 -->
		  			   		
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >		    	
		      	<div class="panel panel-contratos" data-sortable-id="morris-chart-3" data-init="true">
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="drawChart_ValorMedidoAcumulado_div(); drawChart_ValorContratado_div();drawChart_ValorMedidoCorrente_div(); drawChart_ValorSaldoEmpenho_div();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Resumo Financeiro</h3>                  	
			    	</div>
			    	<div class="panel-body">
			    	
			    	<div class="grid">
  						<div class="col-1-4">
					    <?php 
					    	
						    echo $this->gcharts->PieChart('ValorContratado')->outputInto('ValorContratado_div');
						    echo $this->gcharts->div(0,0,'chart');
						    if($this->gcharts->hasErrors())
						    {
						        echo $this->gcharts->getErrors();
						    }
						    
					    ?>
					  </div>
					  <div class="col-1-4">
					    <?php 
						    echo $this->gcharts->PieChart('ValorMedidoAcumulado')->outputInto('ValorMedidoAcumulado_div');
						    echo $this->gcharts->div(0,0,'chart');
						    
						    if($this->gcharts->hasErrors())
						    {
						        echo $this->gcharts->getErrors();
						    }
						    
					    ?>
					  </div>
					  <div class="col-1-4">
					    <?php 
					    	
						    echo $this->gcharts->PieChart('ValorMedidoCorrente')->outputInto('ValorMedidoCorrente_div');
						    echo $this->gcharts->div(0,0,'chart');
						    if($this->gcharts->hasErrors())
						    {
						        echo $this->gcharts->getErrors();
						    }
						   	
						    
					    ?>
					  </div>
					  <div class="col-1-4">
					    <?php 
					    
						    echo $this->gcharts->PieChart('ValorSaldoEmpenho')->outputInto('ValorSaldoEmpenho_div');
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
				} // PIECHART END 
		   ?>
	       <div class="row"><!-- ROW 1 -->
	      	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" >
	      		<div class="panel panel-contratos" data-sortable-id="morris-chart-1" data-init="true">
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="drawChart_cronograma_div();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Valor Medido Processado</h3>
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
		  	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" >	      		
		      	<div class="panel panel-contratos" data-sortable-id="morris-chart-2" data-init="true" >
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="drawChart_inventory_div();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Valor Medido Mês Corrente</h3>
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
	      <?php 
			}else if(isset($lineChartAcum) AND $lineChartAcum == true){ 
	      ?>
	       <div class="row"><!-- ROW 1 -->
	      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
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
  						<div>
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
		  </div><!-- ROW 1 -->
	      <?php } ?>
		  
		  <?php 
		  	if(isset($programa)) {
				$size = sizeof($tabela_resumo) * 52;
				if($size <= 200){
					$size = 200;
				}
				
		  ?>
		  <div class="row">
		  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
	      		<div class="panel panel-contratos" data-sortable-id="morris-chart-1" data-init="true">
					<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="drawChart_stock_div();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
					<h3 class="panel-title">Data de Inicio e Fim de Contratos</h3>
			    	</div>
			    	<div class="panel-body">
			    	
			    	<div class="grid">
  					  <div>
						<div id="stock_div1"  class="chart" style="height: <?php echo $size;?>px;"></div> 
					  </div>
					</div>
                  	</div>
		   		</div>
		  	</div>
		  </div>
		  <?php } ?>		
 
		<?php
            $vis1 = false;
            $vis2 = false;
            $vis3 = true;
                         	
            if(isset($contrato)){
				if($vis1){
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
						<h4 class="panel-title"><?php echo $panelTitle; ?></h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">
	                         	
										<table class="table table-striped table-hover" >
										<thead>
											<tr>
											<th class="header" colspan="5" style="width:200px;" ><b>Contrato: <?php echo $contrato[0]['contrato']; ?></b></th>
											<th class="header" colspan="1"><b><?php echo $contrato[0]['unidade_gestora']; ?></b></th>
								    	  </tr>
								        </thead>
								        <tbody>
							               <tr>
							              	 <td colspan="1" ><b>UF:</b> <?php echo $contrato[0]['uf']; ?> </td>
							                 <td colspan="5"><b>Rodovia:</b> <?php echo $contrato[0]['rodovia']; ?></td>
							               </tr>
							                <tr>
							               	 	<td colspan="3" ><b>Executora:</b> <?php echo $contrato[0]['executora']; ?></td>
							               	 	<td colspan="3" ><b>Fiscal:</b> <?php echo $contrato[0]['fiscal']; ?></td>
							                </tr>
							                <tr>
							                	<td colspan="6" ><b>Objeto:</b> <?php echo $contrato[0]['objeto']; ?></td>
							                </tr>
							                <tr>
							                	<td colspan="2" ><b>Edital:</b> <?php echo $contrato[0]['edital']; ?></td>
							                	<td colspan="4" ><b>Situação:</b> <?php echo $contrato[0]['situacao']; ?></td>
							                </tr>
							                <tr>
							                	<td colspan="1" ><b>Proposta/Base</b> <?php echo $contrato[0]['data_proposta_base'] ? date('d/m/Y', strtotime($contrato[0]['data_proposta_base'])) : '-' ; ?></td>
							                	<td colspan="1" ><b>Aprovação</b> <?php echo $contrato[0]['data_aprovacao'] ? date('d/m/Y', strtotime($contrato[0]['data_aprovacao'])) : '-' ; ?></td>
							                	<td colspan="1" ><b>Assinatura</b> <?php echo $contrato[0]['data_assinatura'] ? date('d/m/Y', strtotime($contrato[0]['data_assinatura'])) : '-' ; ?></td>
							                	<td colspan="1" ><b>Publicação</b> <?php echo $contrato[0]['data_publicacao'] ? date('d/m/Y', strtotime($contrato[0]['data_publicacao'])) : '-' ; ?></td>
							                	<td colspan="1" ><b>Ordem de Início</b> <?php echo $contrato[0]['data_ordem_inicio'] ? date('d/m/Y', strtotime($contrato[0]['data_ordem_inicio'])) : '-' ; ?></td>
							                	<td colspan="1" ><b>Término</b> <?php echo $contrato[0]['data_termino'] ? date('d/m/Y', strtotime($contrato[0]['data_termino'] )) : '-' ; ?></td>
							                </tr>
							                <tr>
							                	<td colspan="1" ><b>Valor PI</b>
							                	<br><b>R$ </b>
							                		<?php echo $contrato[0]['valor_pi'] ? number_format($contrato[0]['valor_pi'],2,",",".") : 0  ; ?></td>
							                	<td colspan="1" ><b>Valor Reajuste</b>
							                	<br><b>R$ </b> 
							                		<?php echo $contrato[0]['valor_reajuste'] ? number_format($contrato[0]['valor_reajuste'],2,",",".") : 0  ;  ?></td>
							                	<td colspan="1" ><b>Valor Aditivo</b> 
							                	<br><b>R$ </b> 
							                		<?php echo $contrato[0]['valor_aditivo'] ? number_format($contrato[0]['valor_aditivo'],2,",",".") : 0  ;  ?></td>
							                	<td colspan="1" ><b>Valor Contrato(PI+R+A)</b> 
							                	<br><b>R$ </b> 
							                		<?php echo $contrato[0]['valor_contrato'] ? number_format($contrato[0]['valor_contrato'],2,",",".") : 0  ;  ?></td>
							                	<td colspan="1" ><b>Valor Medido(PI)</b> 
							                	<br><b>R$ </b> 
							                		<?php echo $contrato[0]['valor_medido_pi'] ? number_format($contrato[0]['valor_medido_pi'],2,",",".") : 0  ;  ?></td>
							                	<td colspan="1" ><b>Valor Medido(PI+R)</b> 
							                	<br><b>R$ </b> 
							                		<?php echo $contrato[0]['valor_medido_pi_r_acum'] ? number_format($contrato[0]['valor_medido_pi_r_acum'],2,",",".") : 0  ;  ?></td>
							                </tr> 
							                <tr>
							                	<td colspan="4" ></td>
							                	<td colspan="1" ><b>Empenho</b>
							                	<br><b>R$ </b> 
							                		<?php echo $contrato[0]['valor_empenhado'] ? number_format($contrato[0]['valor_empenhado'],2,",",".") : 0  ;  ?></td>
							                	<td colspan="1" ><b>Saldo de Empenho</b>
							                	<br><b>R$ </b> 
							                		<?php echo $contrato[0]['saldo_empenho'] ? number_format($contrato[0]['saldo_empenho'],2,",",".") : 0  ;  ?></td>
							                </tr>                
							            </tbody>
							            
							          </table>
							        </div> 
							</div>
	                	</div>
	                </div>
			    </div>
			</div> 
							          
		 	<?php
			}
			if($vis3){ 
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
						<h4 class="panel-title"><?php echo $panelTitle; ?></h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">				    		
				    			<table class="table table-striped table-hover" >
									<thead>
									  <tr>
										<th class="header" colspan="1"><b>Contrato: </b></th>
										<th class="header" colspan="2"><?php echo $contrato[0]['contrato']; ?></th>
							    	  </tr>
							        </thead>
							        <tbody>
							          <tr>
							        	<th class="header" colspan="1"><b>Executora</b></th>
							        	<th class="header" colspan="5"><?php echo $contrato[0]['executora']; ?></th>
							    	  </tr>
							    	  <tr>
							        	<th class="header" colspan="1"><b>Intervenção</b></th>
							        	<th class="header" colspan="5"><?php echo $contrato[0]['tipo_intervencao']; ?></th>
							    	  </tr>
							    	  <tr>
							        	<th class="header" colspan="1"><b>Situação</b></th>
							        	<th class="header" colspan="5"><?php echo $contrato[0]['situacao']; ?></th>
							    	  </tr>
							    	  <tr>
							        	<th class="header" colspan="1"><b>Objeto</b></th>
							        	<th class="header" colspan="5"><?php echo $contrato[0]['objeto']; ?></th>
							    	  </tr>
							    	  <tr>
							        	<th class="header" colspan="1"><b>Edital</b></th>
							        	<th class="header" colspan="5"><?php echo $contrato[0]['edital']; ?></th>
							    	  </tr>
							    	  <thead>
							    	  <tr>
							        	<th class="header" colspan="1"><b>Segmentos</b></th>
							        	<th class="header" colspan="5"><?php ?></th>
							    	  </tr>
							    	  </thead>
							    	  <tr>
										<th class="header" colspan="1"><b>Proposta/Base</b></th>
										<th class="header" colspan="5"><b><?php echo $contrato[0]['data_proposta_base'] ? date('d/m/Y', strtotime($contrato[0]['data_proposta_base'])) : '-' ; ?></b></th>
							    	  </tr>
						                <tr>
						                	<th class="header" colspan="1" style="width:200px;" ><b>Aprovação</b> </th>
						                	<th class="header" colspan="5"align="left" ><?php echo $contrato[0]['data_aprovacao'] ? date('d/m/Y', strtotime($contrato[0]['data_aprovacao'])) : '-' ; ?></th>
						                </tr>
						                <tr>
						                	<th class="header" colspan="1"><b>Assinatura</b> </th>
						                	<th class="header" colspan="5"><?php echo $contrato[0]['data_assinatura'] ? date('d/m/Y', strtotime($contrato[0]['data_assinatura'])) : '-' ; ?></th>
						                </tr>
						                <tr>
						                	<th class="header" colspan="1"><b>Publicação</b> </th>
						                	<th class="header" colspan="5" ><?php echo $contrato[0]['data_publicacao'] ? date('d/m/Y', strtotime($contrato[0]['data_publicacao'])) : '-' ; ?></th>
						                </tr>
						                <tr>
						                	<th class="header" colspan="1" ><b>Ordem de Início</b> </th>
						                	<th class="header" colspan="5"><?php echo $contrato[0]['data_ordem_inicio'] ? date('d/m/Y', strtotime($contrato[0]['data_ordem_inicio'])) : '-' ; ?></th>
						                </tr>
						                <tr>
						                	<th class="header" colspan="1"><b>Término</b> </th>
						                	<th class="header" colspan="5"><?php echo $contrato[0]['data_termino'] ? date('d/m/Y', strtotime($contrato[0]['data_termino'] )) : '-' ; ?></th>
						                </tr>
						                <thead>
						                <tr>
						                	<th class="header" colspan="1"><b>Prazo (Dias)</b> </th>
						                	<th class="header" colspan="5"><?php echo $contrato[0]['data_termino'] ? ROUND(( strtotime($contrato[0]['data_termino'] ) - strtotime($contrato[0]['data_ordem_inicio']) )/3600/24) : '-' ; ?></th>
						                </tr>
						                </thead>
										<tr>
											<th class="header" colspan="1"><b>Valor PI</b></th>
											<th class="header" colspan="5"><b><?php echo 'R$ '.$contrato[0]['valor_pi'] ? number_format($contrato[0]['valor_pi'],2,",",".") : 0  ; ?></b></th>
							    	    </tr>
						                <tr>
						                	<th class="header" colspan="1" style="width:200px;" ><b>Valor Reajuste</b> </th>
						                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['valor_reajuste'] ? number_format($contrato[0]['valor_reajuste'],2,",",".") : 0  ;  ?></th>
						                </tr>
						                <tr>
						                	<th class="header" colspan="1"><b>Valor Aditivo</b> </th>
						                	<th class="header" colspan="5"><?php echo 'R$ '.$contrato[0]['valor_aditivo'] ? number_format($contrato[0]['valor_aditivo'],2,",",".") : 0  ;  ?></th>
						                </tr>
						                <thead>
						                <tr>
						                	<th class="header" colspan="1"><b>Valor Contrato(PI+R+A)</b> </th>
						                	<th class="header" colspan="5"><?php echo 'R$ '.$contrato[0]['valor_contrato'] ? number_format($contrato[0]['valor_contrato'],2,",",".") : 0  ;  ?></th>
						                </tr>
						                </thead>
						                <tr>
											<th class="header" colspan="1"><b>Valor Medido(PI)</b></th>
											<th class="header" colspan="5"><b><?php echo 'R$ '.$contrato[0]['valor_medido_pi'] ? number_format($contrato[0]['valor_medido_pi'],2,",",".") : 0  ; ?></b></th>
								    	  </tr>
								    	 <thead> 
							    	     <tr>
						                	<th class="header" colspan="1" style="width:200px;" ><b>Saldo Contratual(PI)</b> </th>
						                	<th class="header" colspan="5"align="left" ><!-- valor contratado PI menos valor medido PI  --></th>
						                 </tr>
						                 </thead>
						                <tr>
						                	<th class="header" colspan="1" style="width:200px;" ><b>Valor Medido(PI+R)</b> </th>
						                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['valor_medido_pi_r_acum'] ? number_format($contrato[0]['valor_medido_pi_r_acum'],2,",",".") : 0  ;  ?></th>
						                </tr>
						                <tr>
						                	<th class="header" colspan="1" style="width:200px;" ><b>Saldo Contratual(PI+R)</b> </th>
						                	<th class="header" colspan="5"align="left" ><!-- VALOR CONTRATADO ac PI+R - VALOR MEDIDO acPI+R --></th>
						                </tr>
						                <tr>
						                	<th class="header" colspan="1" style="width:200px;" ><b>Empenho</b> </th>
						                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['valor_empenhado'] ? number_format($contrato[0]['valor_empenhado'],2,",",".") : 0  ;  ?></th>
						                </tr> 
						                <tr>
						                	<th class="header" colspan="1" style="width:200px;" ><b>Saldo de Empenho</b> </th>
						                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['saldo_empenho'] ? number_format($contrato[0]['saldo_empenho'],2,",",".") : 0  ;  ?></th>
						                </tr>
						            </tbody>
						            
						          </table>
				    			</div> 
							</div>
	                	</div>
	                </div>
			    </div>
			</div> 
    		<?php 	 
    		}
    		if($vis2){ 
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
							<h4 class="panel-title"><?php echo $panelTitle; ?> - Datas</h4>
	                   </div>
	                   <div class="panel-body">
		                    <div class="grid">
		                         <div class="table-responsive">
								    			
											<table class="table table-striped table-hover" >
												<thead>
												  <tr>
													<th class="header" colspan="1"><b>Contrato: </b></th>
													<th class="header" colspan="2"><?php echo $contrato[0]['contrato']; ?></th>
										    	  </tr>
										        </thead>
										        <tbody>
										          <tr>
										        	<th class="header" colspan="1"><b>Executora</b></th>
										        	<th class="header" colspan="5"><?php echo $contrato[0]['executora']; ?></th>
										    	  </tr>
										    	  <tr>
										        	<th class="header" colspan="1"><b>Intervenção</b></th>
										        	<th class="header" colspan="5"><?php echo $contrato[0]['tipo_intervencao']; ?></th>
										    	  </tr>
										    	  <tr>
										        	<th class="header" colspan="1"><b>Situação</b></th>
										        	<th class="header" colspan="5"><?php echo $contrato[0]['situacao']; ?></th>
										    	  </tr>
										    	  <tr>
										        	<th class="header" colspan="1"><b>Objeto</b></th>
										        	<th class="header" colspan="5"><?php echo $contrato[0]['objeto']; ?></th>
										    	  </tr>
										    	  <tr>
										        	<th class="header" colspan="1"><b>Edital</b></th>
										        	<th class="header" colspan="5"><?php echo $contrato[0]['edital']; ?></th>
										    	  </tr>
										    	  <tr>
										        	<th class="header" colspan="1"><b>Segmentos</b></th>
										        	<th class="header" colspan="5"><?php ?></th>
										    	  </tr>												  
									            </tbody>
									            
									          </table>
				    			</div> 
							</div>
	                	</div>
	                </div>
			    </div>
			</div>
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
						<h4 class="panel-title"><?php echo $panelTitle; ?> - Datas</h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">
	                         <table class="table table-striped table-hover" >
								<thead>
									<tr>
									<th class="header" colspan="1"><b>Proposta/Base</b></th>
									<th class="header" colspan="5"><b><?php echo $contrato[0]['data_proposta_base'] ? date('d/m/Y', strtotime($contrato[0]['data_proposta_base'])) : '-' ; ?></b></th>
						    	  </tr>
						        </thead>
						        <tbody>
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Aprovação</b> </th>
					                	<th class="header" colspan="5"align="left" ><?php echo $contrato[0]['data_aprovacao'] ? date('d/m/Y', strtotime($contrato[0]['data_aprovacao'])) : '-' ; ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1"><b>Assinatura</b> </th>
					                	<th class="header" colspan="5"><?php echo $contrato[0]['data_assinatura'] ? date('d/m/Y', strtotime($contrato[0]['data_assinatura'])) : '-' ; ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1"><b>Publicação</b> </th>
					                	<th class="header" colspan="5" ><?php echo $contrato[0]['data_publicacao'] ? date('d/m/Y', strtotime($contrato[0]['data_publicacao'])) : '-' ; ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1" ><b>Ordem de Início</b> </th>
					                	<th class="header" colspan="5"><?php echo $contrato[0]['data_ordem_inicio'] ? date('d/m/Y', strtotime($contrato[0]['data_ordem_inicio'])) : '-' ; ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1"><b>Término</b> </th>
					                	<th class="header" colspan="5"><?php echo $contrato[0]['data_termino'] ? date('d/m/Y', strtotime($contrato[0]['data_termino'] )) : '-' ; ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1"><b>Prazo (Dias)</b> </th>
					                	<th class="header" colspan="5"><?php echo $contrato[0]['data_termino'] ? ROUND(( strtotime($contrato[0]['data_termino'] ) - strtotime($contrato[0]['data_ordem_inicio']) )/3600/24) : '-' ; ?></th>
					                </tr>
					              </tbody>
					              </table>           
						       </div> 
							</div>
	                	</div>
	                </div>
			    </div>
			</div>
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
						<h4 class="panel-title"><?php echo $panelTitle; ?> - Valores</h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">
	                         <table class="table table-striped table-hover" >
								<thead>
									<tr>
									<th class="header" colspan="1"><b>Valor PI</b></th>
									<th class="header" colspan="5"><b><?php echo 'R$ '.$contrato[0]['valor_pi'] ? number_format($contrato[0]['valor_pi'],2,",",".") : 0  ; ?></b></th>
						    	  </tr>
						        </thead>
						        <tbody>
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Valor Reajuste</b> </th>
					                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['valor_reajuste'] ? number_format($contrato[0]['valor_reajuste'],2,",",".") : 0  ;  ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1"><b>Valor Aditivo</b> </th>
					                	<th class="header" colspan="5"><?php echo 'R$ '.$contrato[0]['valor_aditivo'] ? number_format($contrato[0]['valor_aditivo'],2,",",".") : 0  ;  ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1"><b>Valor Contrato(PI+R+A)</b> </th>
					                	<th class="header" colspan="5"><?php echo 'R$ '.$contrato[0]['valor_contrato'] ? number_format($contrato[0]['valor_contrato'],2,",",".") : 0  ;  ?></th>
					                </tr>
					              </tbody>
					              </table>           
						       </div> 
							</div>
	                	</div>
	                </div>
			    </div>
			</div>
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
						<h4 class="panel-title"><?php echo $panelTitle; ?></h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">
	                         <table class="table table-striped table-hover" >
								<thead>
								  <tr>
									<th class="header" colspan="1"><b>Valor Medido(PI)</b></th>
									<th class="header" colspan="5"><b><?php echo 'R$ '.$contrato[0]['valor_medido_pi'] ? number_format($contrato[0]['valor_medido_pi'],2,",",".") : 0  ; ?></b></th>
						    	  </tr>
						        </thead>
						        <tbody>
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Saldo Contratual</b> </th>
					                	<th class="header" colspan="5"align="left" ></th>
					                </tr>
					              </tbody>
					              </table>           
						       </div> 
							</div>
	                	</div>
	                </div>
			    </div>
			</div>        
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
						<h4 class="panel-title"><?php echo $panelTitle; ?></h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">
	                         <table class="table table-striped table-hover" >
								<thead>
								  <tr>
									<th class="header" colspan="1"><b>Valor Pago(PI+R)</b></th>
									<th class="header" colspan="5"><b></b></th>
						    	  </tr>
						        </thead>
						        <tbody>
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Saldo Contratual</b> </th>
					                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['valor_medido_pi_r_acum'] ? number_format($contrato[0]['valor_medido_pi_r_acum'],2,",",".") : 0  ;  ?></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Valor Medido(PI+R)</b> </th>
					                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['valor_medido_pi_r_acum'] ? number_format($contrato[0]['valor_medido_pi_r_acum'],2,",",".") : 0  ;  ?></th>
					                </tr> 
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Pendente</b> </th>
					                	<th class="header" colspan="5"align="left" ></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Saldo(PI+R)</b> </th>
					                	<th class="header" colspan="5"align="left" ></th>
					                </tr>
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Empenho</b> </th>
					                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['valor_empenhado'] ? number_format($contrato[0]['valor_empenhado'],2,",",".") : 0  ;  ?></th>
					                </tr> 
					                <tr>
					                	<th class="header" colspan="1" style="width:200px;" ><b>Saldo de Empenho</b> </th>
					                	<th class="header" colspan="5"align="left" ><?php echo 'R$ '.$contrato[0]['saldo_empenho'] ? number_format($contrato[0]['saldo_empenho'],2,",",".") : 0  ;  ?></th>
					                </tr> 
					              </tbody>
					              </table>           
						       </div> 
							</div>
	                	</div>
	                </div>
			    </div>
			</div>   
			
														
	    	<?php 
				} 
						    		      
          }else{
                         			
                         		
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
						<h4 class="panel-title"><?php echo $panelTitle; ?></h4>
                   </div>
                   <div class="panel-body">
	                    <div class="grid">
	                         <div class="table-responsive">
	                         
						          <table class="table table-striped table-bordered table-condensed">
						            <thead>
						              <tr>
						            	<th class="header "><?php echo $tableName; ?></th>
										<th class="header ">Valor Contratado(PI+R)</th>
										<th class="header ">Valor Medido Acumulado(PI+R)</th>
										<th class="header ">Empenho</th>
										<th class="header ">Saldo de Empenho</th>
										<th class="header ">Valor Medido Mês Corrente</th>
										<?php
											if(isset($tabela_resumo[0]['n_contratos']) AND !isset($programa) ){
												echo '<th class="header ">Número de Contratos</th>';		
											}
											if(isset($tabela_resumo[0]['contrato'])){
												echo '<th class="header ">Data Inicio</th>';
												echo '<th class="header ">Data Término</th>';
											}
											
										?>
										
										
									</tr>
						            </thead>
						            <tbody>
						            <?php
						              $pediodoTable = '';
						              $i = 1;
						              foreach($tabela_resumo as $row)
						              {
						              		
						                echo '<tr>';
										echo '<td>';
										echo	'<a href="'.$site_base.$row['alias'].'">'.$row['titulo'].'</a>';
										echo '</td>';
										echo '<td>R$ '.($row['valor_contrato'] ? number_format($row['valor_contrato'],2,",",".") : 0).'</td>';	
										echo '<td>R$ '.($row['valor_medido_acumulado_pi_r'] ? number_format($row['valor_medido_acumulado_pi_r'],2,",",".") : 0).'</td>';
										echo '<td>R$ '.($row['valor_empenhado'] ? number_format($row['valor_empenhado'],2,",",".") : 0).'</td>';
										echo '<td>R$ '.($row['valor_saldo_empenho'] ? number_format($row['valor_saldo_empenho'],2,",",".") : 0).'</td>';
										echo '<td>R$ '.($row['valor_medido_mes_corrente'] ? number_format($row['valor_medido_mes_corrente'],2,",",".") : 0).'</td>';
										echo (isset($row['n_contratos']) AND !isset($programa) ) ? '<td>'.$row['n_contratos'].'</td>' : '';
										echo isset($row['contrato']) ? '<td>'.date('d/m/Y', strtotime($row['contrato']['data_ordem_inicio'])).'</td>' : '';
										echo isset($row['contrato']) ? '<td>'.date('d/m/Y', strtotime($row['contrato']['data_termino'])).'</td>' : '';
						                echo "</tr>";
						                if(isset($programa)){
						                	$pediodoTable.= '["'.$row['titulo'].'", new Date('.date('Y,m,d', strtotime($row['contrato']['data_ordem_inicio'])).'), new Date('.date('Y,m,d', strtotime($row['contrato']['data_termino'])).') ],';
						                	$i++;
						                }
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
			
		<?php } ?>  
							  
          
      </div>       
    </div>
</div>
</div>
</div>
<?php if(isset($programa)) { ?>
<script type="text/javascript"> 
	 google.load('visualization', '1', {'packages':['timeline']}); 
	 google.setOnLoadCallback(drawChart_stock_div); 
	 function drawChart_stock_div() { 
		 var data = new google.visualization.DataTable();
				 
				    
				    data.addColumn({ type: 'string', id: 'Name' });
				    data.addColumn({ type: 'date', id: 'Start' });
				    data.addColumn({ type: 'date', id: 'End' });
				    data.addRows([
					<?php echo $pediodoTable; ?>
				     ]);
	
	
		  
			var options = {"title":"Perido dos Contratos", "avoidOverlappingGridLines":false}; 
			var chart = new google.visualization.Timeline(document.getElementById('stock_div1')); 
			chart.draw(data, options); 
	} 
</script> 
<?php  } ?>


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
		  drawChart_ValorContratado_div();
		  drawChart_ValorMedidoAcumulado_div();
		  drawChart_ValorMedidoCorrente_div();
		  drawChart_ValorSaldoEmpenho_div();
		  <?php echo isset($programa) ? 'drawChart_stock_div();' : '' ?> 
		});
	
		$(document).ready(function() {
			App.init();
			/*
			ChartJs.init();
			MorrisChart.init();
			*/
		});

		$(function() {
		    $('#Grid').mixitup();
		});
		
		
		

		$("#menu-toggle").click(function(e) {
	        	e.preventDefault();
		        $("#wrapper").toggleClass("active");
		});

		 $('[data-toggle=offcanvas]').click(function() {
		    $('.row-offcanvas').toggleClass('active');
		  });
	</script>
 <?php 
 	
 ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	