<?php 
	//$tipo_documentos = array('tecnico', 'processual');
	function switchProgressBar($fase){
		
		switch ($fase) {
		
			case 'Elaboração' :
				$resultProgress = 'info';	
				break;
			
			case 'Análise' :
				$resultProgress = 'warning';
				break;
				
			case 'Aceite' :
				$resultProgress = 'success';
				break;
			
			case 'Revisão' :
				$resultProgress = 'danger';
				break;
				
			default: 
				$resultProgress = '';
			
		}
		return	$resultProgress;
	} 
	
	$documentos_classificados = array();
	foreach($tipo_documentos as $item){
		foreach($documentos as $row)
		{
			if($row['tipo'] == $item['tipo']){
				$documentos_classificados[$item['tipo']][] = $row;
			}
		}
		foreach($documentos_movimentacoes as $row)
		{
			if($row['tipo'] == $item['tipo']){
				$documentos_classificados[$item['tipo']][] = $row;
			}
		}
	}
	$id_pas = $pas[0]['id'];
	
	foreach($link_acessos as $item){
	
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
	
	$progresso_total = isset($progresso_total) ? $progresso_total : 0;
	
	
	
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
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	            EVTEA
	          </a>
	        </li>
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(3));?>
	        </li>
	      </ol>
    	<h1 class="page-header">
    	<?php 
    		$tituloTrecho = '';
    		$first = true;
    		foreach($trechos as $item){
    			if($first){
    				$first = false;
    				$tituloTrecho .= 'BR-'.$item['rodovia'].'/'.$item['uf'];
    			}else{
    				$tituloTrecho .= ' e '.'BR-'.$item['rodovia'].'/'.$item['uf'];
    			}	
    			
    			
    		}
    		$tituloTrecho = $pas[0]['titulo'] ? $pas[0]['titulo'] : $tituloTrecho ;
    		echo 'LOTE 	'.$pas[0]['lote'].' – '.$tituloTrecho;
    		if(isset($pas[0]['progresso_total'] )){
    			$progresso_total = ( $pas[0]['progresso_total'] > 0 ) ? $pas[0]['progresso_total'] : 0;
    		}else{
    			$progresso_total = 0 ;
    		}
    		
    		
    		$data_ini_pas = $pas[0]['data_ini_pas'] ? date('d/m/Y', strtotime($pas[0]['data_ini_pas'])) : 'Sem Registro';
    		$data_fim_pas = ($progresso_total >= 100 )  ? date('d/m/Y', strtotime($pas[0]['data_last_mov'] )) : 'Sem Registro';
    		
    		
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
    		
    		$options_resposaveis = array();
    		foreach ($responsaveis as $row)
    		{
    			$options_resposaveis[$row["id_usuario"]] = $row['nome'];
    		}
    		
    		$options_local_execucao  = array();
    		foreach ($local_execucao as $row)
    		{
    			$options_local_execucao[$row["id"]] = $row["titulo"];
    		}
    	?>
    	</h1>
    	
	 <div class="row">
	 	  <!-- desktop medium-devices tablet cell -->
	        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-warning">
				<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
	              <h3 class="panel-title">Detalhes do EVTEA</h3>
	            </div>
	            <div class="panel-body">
	            	<h5>
        				Data Inicial: <b><?php echo $data_ini_pas ; ?> </b> - Data Final: <b> <?php echo $data_fim_pas; ?> </b>
        			</h5>
	            	<h4><b>PROGRESSO TOTAL <?php echo $progresso_total; ?>%</b></h4>
		            <div class="progress progress-striped active" style="height: 27px ; border-style: solid; border-color: #EA4335;">
	        			<div class="progress-bar progress-bar-<?php echo switchProgressBar(''); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="60" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $progresso_total; ?>%;">
	        				Progresso <?php echo $progresso_total; ?>%; 
	        			</div>
	        			
	      			</div>
	            <?php 
	            	
	            	$first = true;
	            	$count = 1;
	            	$modalContent = '';
	            	$grupo = '';
	            	$andamentoProdutos = '';
	            	$statusGrupo = ''; 
// 	            	/[ 'Washington', new Date(1789, 3, 30), new Date(1797, 2, 4) ],
	            	if(isset($pas_fases) AND !empty($pas_fases) ){
						 
		            	foreach($pas_fases as $item){
	
							
							
							$id_avaliacao 	= (sizeof($item["last_avaliation"]) > 0 ) ? $item["last_avaliation"]["id_avaliacoes"] : 1;
							
							if(sizeof($item["lastmov"]) > 0 ){
								$statusFase = $options_status[$item["lastmov"]["id_status"]]['titulo'];
								$data_ini_item = date('d/m/Y', strtotime($item['start_date']['start_date']));
								$data_fim_item = date('d/m/Y', strtotime($item["lastmov"]["data_protocolo"]));
								
								$avaliacao = $options_avaliacoes[$id_avaliacao]['titulo'];
							}else{
								$data_ini_item = !($item['data_ini'] == '0000-00-00') ? 'P' . date('d/m/Y', strtotime($item['data_ini'])) : "Sem Registro";
								$data_fim_item = !($item['data_fim'] == '0000-00-00') ? 'P' . date('d/m/Y', strtotime($item['data_fim'])) : "Sem Registro";
								
								
								$statusFase = 'Aguardando Iniciar';
								$avaliacao  = 'Sem Avaliação';
							}
							
							if($first){
								$first = false;
								$grupo = $item['grupo'];
								$progressoTotalGrupo = $item['progresso'];
								$modalContent .= '
								<h5><b>'.$item['fases'].'</b></h5>
								<h5>
			        				Data Inicial: <b>'.$data_ini_item.' </b> - 
	          		 				Data Final:<b>'.$data_fim_item.' </b>
	          						Status:'.$statusFase.' Avaliação: '.$avaliacao.'
			        			</h5>
				      			<div class="progress progress-striped green active">
				        			<div class="progress-bar progress-bar-'. switchProgressBar($statusFase).'"
				        				role="progressbar"
				        				aria-valuenow="73"
				        				aria-valuemin="0"
				        				aria-valuemax="100"
				        				style="width: '.$item['progresso'].'%;">
				        				'.$item['progresso'].'%;
				        			</div>
				      			</div>';
								
							}else if($grupo == $item['grupo']){
								$count++;
								$progressoTotalGrupo += $item['progresso'];
								$modalContent .= '
								<h5><b>'.$item['fases'].'</b></h5>
					    		<h5>
			        				Data Inicial: <b>'.$data_ini_item.' </b> - 
	          		 				Data Final:<b>'.$data_fim_item.' </b>
	          						Status:'.$statusFase.' Avaliação: '.$avaliacao.'
			        			</h5>
				      			<div class="progress progress-striped green active">
				        			<div class="progress-bar progress-bar-'. switchProgressBar($statusFase).'" 
				        				role="progressbar" 
				        				aria-valuenow="73" 
				        				aria-valuemin="0" 
				        				aria-valuemax="100" 
				        				style="width: '.$item['progresso'].'%;">
				        				'.$item['progresso'].'%; 
				        			</div>
				      			</div>';
								
							}else{
								
								$progressoTotalGrupo = Round($progressoTotalGrupo/$count, 2);
								$statusGrupo = ($progressoTotalGrupo >= 100 ) ? 'Aceite' : '' ;  
							?>
				      			<h5>
				      				<b>Atividade <?php echo $grupo; ?></b>
				      				<a href="#modal-<?php echo $grupo; ?>" class="btn btn-xs btn-circle btn-success" data-toggle="modal" data-target="#modal-<?php echo $grupo; ?>" ><i class="">Detalhes</i></a>
				      			</h5>
				      			<div class="progress progress-striped green active">
				        			<div class="progress-bar progress-bar-<?php echo switchProgressBar($statusGrupo); ?>" 
				        				role="progressbar" 
				        				aria-valuenow="73" 
				        				aria-valuemin="0" 
				        				aria-valuemax="100" 
				        				style="width: <?php echo $progressoTotalGrupo; ?>%;">
				        				<?php echo $progressoTotalGrupo; ?>%; 
				        			</div>
				      			</div>
				      			<div id="modal-<?php echo $grupo; ?>" class="modal fade" role="dialog">
									 <div class="modal-dialog">
								 	   <div class="modal-content"> 
		          						 <div class="modal-header">
									      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									      <h3>Atividade <?php echo $grupo; ?></h3>
									     </div>
									     <div class="modal-body">
									      <?php echo $modalContent; ?>
									     </div>
									    <div class="modal-footer">
									     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									    </div>
									  </div>
	            				    </div>
							       </div>
							<?php	
								$modalContent = '
								<h5><b>'.$item['fases'].'</b></h5>
								<h5>
			        				Data Inicial: <b>'.$data_ini_item.' </b> - 
	          		 				Data Final:<b>'.$data_fim_item.' </b>
	          						Status: '.$statusFase.' Avaliação: '.$avaliacao.' 
			        			</h5>
				      			<div class="progress progress-striped green active">
				        			<div class="progress-bar progress-bar-'. switchProgressBar($statusFase).'" 
				        				role="progressbar" 
				        				aria-valuenow="73" 
				        				aria-valuemin="0" 
				        				aria-valuemax="100" 
				        				style="width: '.$item['progresso'].'%;">
				        				'.$item['progresso'].'%; 
				        			</div>
				      			</div>';
								$count = 1;
								$grupo = $item['grupo'];
								$progressoTotalGrupo = $item['progresso'];
								$statusGrupo = ($progressoTotalGrupo >= 100 ) ? 'Aceite' : '' ;
							}
		            		
		            	}
		            	$progressoTotalGrupo = Round($progressoTotalGrupo/$count, 2);
		            	$statusGrupo = ($progressoTotalGrupo >= 100 ) ? 'Aceite' : '' ;  
	            ?>
			            <h5>
			            	<b>Atividade <?php echo $grupo; ?></b>
			            	<a href="#modal-<?php echo $grupo; ?>" class="btn btn-xs btn-circle btn-success" data-toggle="modal" data-target="#modal-<?php echo $grupo; ?>" ><i class="">Detalhes</i></a>
			            </h5>
			            
		      			<div class="progress progress-striped green active">
		        			<div class="progress-bar progress-bar-<?php echo switchProgressBar($statusGrupo); ?>" 
		        				role="progressbar" 
		        				aria-valuenow="73" 
		        				aria-valuemin="0" 
		        				aria-valuemax="100" 
		        				style="width: <?php echo $progressoTotalGrupo; ?>%;">
		        				<?php echo $progressoTotalGrupo; ?>%; 
		        			</div>
		      			</div>
		      			<div id="modal-<?php echo $grupo; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content"> 
			          				<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h3>Atividade <?php echo $grupo; ?></h3>
									</div>
									<div class="modal-body">
										<?php echo $modalContent; ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									</div>
								</div>
			            	</div>
						</div>
	      		<?php 
	      			
	      		 	} // END FOREACH ITENS
	      		
	            ?>  
	            </div>
	          </div>
	       </div><!-- /.col-sm-6 -->
	       
	       <!-- PIE CHART  -->
		 	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
		        	<div class="panel panel-warning" style="heigth:600px;">
		            <div class="panel-heading">
		              <div class="panel-heading-btn">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:drawChart_pie('tempo_medio_status_lote_chart/<?php echo $id_pas; ?>');" class="btn btn-xs btn-icon btn-circle btn-success" ><i class="fa fa-repeat"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                  </div>
		              <h3 class="panel-title">Média de Movimentações</h3>
		            </div>
		            <div class="panel-body" >	
					  <div id="chart-pie-media" style="heigth:100%;"></div>
		            </div>
		          </div>
		       </div><!-- /.col-sm-8 -->
	       
	       
	       <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-warning">
				<div class="panel-heading">
				  <div class="panel-heading-btn">
				  <?php if($usuarioPerfil['acesso'] == 'editar'){ ?>
							<a href="javascript:void(0);" target="_blank"  class="btn btn-xs btn-icon btn-circle btn-info" 
							onclick="window.open('<?php echo site_url('admin/pas_trechos/'.$id_pas); ?>', ''); return false"><i class="fa fa-edit"></i></a>		
						<?php }?>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  </div>
	              <h3 class="panel-title">Trechos EVTEA</h3>
	            </div>
	            <div class="panel-body" style="height:100%;">
	            	<div id="map"></div>
	            </div>
	          </div>
	       </div><!-- /.col-sm-8 -->
	       
		  </div>
		 <div class="row">
		 	
		 
		 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="panel panel-warning">
	            <div class="panel-heading">
	              <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  </div>
	              <h3 class="panel-title">Calendário</h3>
	            </div>
	            <div class="panel-body">
				   <div class="row">
				   		<div class="page-header">
				   		<div class="pull-right form-inline">
							<div class="btn-group">
								<button class="btn btn-primary prev" data-calendar-nav="prev"> << </button>
								<button class="btn btn-default today" data-calendar-nav="today">Hoje</button>
								<button class="btn btn-primary next" data-calendar-nav="next"> >> </button>
							</div>
							<div class="btn-group">
								<button class="btn btn-warning year" data-calendar-view="year">Ano</button>
								<button class="btn btn-warning month active" data-calendar-view="month">Mês</button>
								<button class="btn btn-warning week" data-calendar-view="week">Semana</button>
								<button class="btn btn-warning day" data-calendar-view="day">Dia</button>
							</div>
						</div>
				   		<h3 style="margin-left: 10px;"></h3>
					</div> 
					<div id="events-modal" class="modal fade" role="dialog">
					<div class="modal-dialog">
					 <div class="modal-content">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					    <h3>Evento</h3>
					  </div>
					  <div class="modal-body">
					    <p>Evento</p>
					  </div>
					  <div class="modal-footer">
					    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					  </div>
					 </div>
				    </div>
				   </div>
				   </div>
				   <div class="row">
				   		<div id="calendar"></div>
				   </div>
	            </div>
	          </div>
	       </div><!-- /.col-sm-8 -->
		        
		</div> 
		 
<?php
	// SET A DIFFERENT VIEW FOR ADM AND MANAGER
	if($usuarioPerfil['perfil'] == 'Gerente'  OR $usuarioPerfil['perfil'] == 'Administrador'){ 

	
?>
<?php
/*
?>
		 <div class="row">
		 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		 		<div class="panel panel-warning">
					<div class="panel-heading">
					  <div class="panel-heading-btn">
					 		<?php if($usuarioPerfil['acesso'] == 'editar'){ ?>
								<a href="javascript:void(0);" target="_blank"  class="btn btn-xs btn-icon btn-circle btn-info" 
								onclick="window.open('<?php echo site_url('admin/pas_fases/'.$id_pas); ?>', ''); return false"><i class="fa fa-edit"></i></a>		
							<?php }?>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
	                  </div>
		              <h3 class="panel-title">Produtos Andamento</h3>
		            </div>
		            <div class="panel-body" style="display:none;">
		            	<div class="row" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
		            		<div id="chart-pie-1" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-2" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-3" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-4" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
		            	
			            	<div id="chart-pie-5" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-6" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-7" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-8" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
		            	
		            		<div id="chart-pie-9" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div> 
		            		<div id="chart-pie-10" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-11" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
			            	<div id="chart-pie-12" class="col-lg-3 col-md-3 col-sm-4 col-xs-6" ></div>
		            	</div>
		           </div>
		 	
		 	
		 		</div>
		 	</div>
		 </div>
<?php
*/
?>		 

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
		 <div class="row">
		 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-warning">
				<div class="panel-heading">
				  <div class="panel-heading-btn">
				 		<?php if($usuarioPerfil['acesso'] == 'editar'){ ?>
							<a href="javascript:void(0);" target="_blank"  class="btn btn-xs btn-icon btn-circle btn-info" 
							onclick="window.open('<?php echo site_url('admin/pas_fases/'.$id_pas); ?>', ''); return false"><i class="fa fa-edit"></i></a>		
						<?php }?>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                  </div>
	              <h3 class="panel-title">Produtos</h3>
	            </div>
	            <div class="panel-body table-responsive" >
	            	 <div class="table-responsive" id="pendencias-table">
				          <table class="table table-striped table-bordered table-condensed table-hover results editable">
				            <thead>
				              <tr>
								<th class="yellow header headerSortDown">Produtos</th>
								<th class="yellow header headerSortDown">Progresso</th>
								<th class="yellow header headerSortDown">Status</th>
								<th class="yellow header headerSortDown">Última Avaliação</th>
								<th class="yellow header headerSortDown">Responsável</th>
								<th class="yellow header headerSortDown">Último Movimento</th>
								<th class="yellow header headerSortDown">Prioridade</th>
							</tr>
							<tr class="warning no-result">
						      <td colspan="6"><i class="fa fa-warning"></i>Sem Resultados</td>
						    </tr>
				        </thead>
				        <tbody>
			            <?php
			              
			              $options_usuario_perfil = array();
			              foreach($usuario_perfil as $item){
			              	$options_usuario_perfil[$item['id']] = $item['titulo']; 
			              }
			              
			              $options_prioridades = array();
			              foreach($prioridades as $item){
			              	$options_prioridades[$item['id']] = $item['titulo'];
			              }
			            
			              foreach($pas_fases as $row)
			              {
			                echo "<tr class='".$row['classe']."' id='".$row['id']."' >";
			                  	$key = array_search($row['id_pas'], array_column($pas, 'id'));
			               	  echo "<td>".$row['fases']."</td>";
			               	  
			               	  	   //$id_status 		= (sizeof($row["last_status"]) > 0 ) ? $row["last_status"]["id_status"] : 1;
			                		$id_avaliacao 	= (sizeof($row["last_avaliation"]) > 0 ) ? $row["last_avaliation"]["id_avaliacoes"] : 1;
			                		$progresso_total = (sizeof($row["progresso"]) > 0 ) ? $row["progresso"] : 0;
			                		//$progresso_total = ($row["lastmov"]['status_peso'] + $row["lastmov"]['avaliacao_peso']); 
			                		
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
			                		echo '<td>';
			                		if(isset($row["lastmov"]["id_status"])){
			                			echo $options_status[$row["lastmov"]["id_status"]]['titulo'];	
			                		}else{
			                			echo 'Não Iniciado';	
			                		}
			                		echo '</td>';
			                		echo '<td>';
			              			echo $options_avaliacoes[$id_avaliacao]['titulo'];
			                		echo '</td>';
			                		echo '<td>';
			                		if(isset($row['lastmov']['id_usuario_perfil']) ){
			                			echo $options_usuario_perfil[$row['lastmov']['id_usuario_perfil']];	
			                		}else{
			                			echo ' --- ';
			                		}
			                		echo '</td>';
			                		echo '<td>';
			                		if(isset($row['lastmov']['data_protocolo']) ){
			                			//echo $row['lastmov']['data_protocolo'];
			                			echo  date('d/m/Y H:i:s', strtotime($row['lastmov']['data_protocolo']));
			                		}else{
			                			echo ' --- ';
			                		}
			                		echo '</td>';
			                		echo '<td>';
			                		echo '<label>'.$row['prioridade'].'</label>';
			                		echo form_dropdown("id_prioridade", $options_prioridades, $row['id_prioridade'] );
			                		echo '</td>';
			                	
				                echo "</tr>";
				              }
				              
				              ?>
				            </tbody>
				          </table>
				          <script>
				          
				            $( ".table td" ).on('click', function(e) {
								console.log( $( this ).text() );
								e.preventDefault();
								$(this).find('label').hide();
								$(this).find('input').show();
								$(this).find('select').show();
								$(this).find('input').focus();
							});
	
							$( ".table input" ).on('focusout', function(e) {
								e.preventDefault();
								
								var newValue = $( this ).val() ;
								var oldValue = $(this).prev().show().text(); 
								if(newValue == oldValue){
									console.log( 'igual' );
								}else{
									var idRow = $(this).closest('tr').attr('id');
									var nameRow = $( this ).attr('name');
									
									$(this).prev().show().text($( this ).val());
									exCall(idRow, newValue, nameRow);
									
								}
											
								$(this).hide();
								
								
							});
	
							
							$( ".table select" ).on('focusout', function(e) {
								
								e.preventDefault();
								
								var newValue = $( this ).val() ;
								var oldValue = $(this).prev().show().text(); 
								if(newValue == oldValue){
									console.log( 'igual' );
								}else{
									var idRow = $(this).closest('tr').attr('id');
									var nameRow = $( this ).attr('name');
									
									$(this).prev().show().text($( this ).find('option:selected').text());
									exCall(idRow, newValue, nameRow);
									
								}
											
								$(this).hide();
							});
	
							function exCall(idRow, newValue, nameRow ){
								
								$.ajax({
									  dataType: "json",
									  type: 	"POST",
									  url: "<?php echo base_url().'admin/pas/edit_table_pendencias' ?>",
									  data : { id: idRow, value: newValue, name : nameRow }
									})
									.done( function( data ) {
									    console.log('done');
									    console.log(data);
									})
									.fail( function( data ) {
									    console.log('fail');
									    console.log(data);
									});
								
							}
			            </script>
					  </div>
	            </div>
	          </div>
	       </div><!-- /.col-sm-8 -->
		 
		 </div>
<?php 
// END IF VIEW ADM AND MANAGER
	}
?>		
	     <div class="row">
	       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-warning">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<?php if($usuarioPerfil['acesso'] == 'editar'){ ?>
							<a href="javascript:void(0);" target="_blank"  class="btn btn-xs btn-icon btn-circle btn-info" 
							onclick="window.open('<?php echo site_url('admin/pas/update/'.$id_pas); ?>', ''); return false"><i class="fa fa-edit"></i></a>		
						<?php }?>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
	              <h3 class="panel-title">Detalhes do Estudo</h3>
	            </div>
	            <div class="panel-body">	            
		            <table class="table table-striped table-hover" >
			            <thead>
			              <tr>
							<th class="header" colspan="4"><b>Ordem de Serviço: <?php echo $pas[0]['ordem_servico']; ?></b></th>
							<th class="header" colspan="1"><b>Status: <?php echo $pas[0]['status']; ?></b></th>
							<th class="header" colspan="1"><b>Local: <?php echo $options_local_execucao[$pas[0]['id_local_execucao']]; ?></b></th>
				    	  </tr>
				            </thead>
				            <tbody>
				              <?php
				              	$extTotal = 0;
				                echo '<tr>';
					                echo '<td><b>UF</b></td>';
					                echo '<td><b>Rodovia</b></td>';
					                echo '<td><b>km Inicial</b></td>';
					                echo '<td><b>km Final</b></td>';
					                echo '<td><b>Extensão</td>';
					                echo '<td><b>Subtrecho</td>';
				                echo '</tr>';
				                foreach($trechos as $item){
				                	echo '<tr>';
					                	echo '<td>'.$item['uf'].'</td>';
					                	echo '<td>BR-'.$item['rodovia'].'</td>';
					                	echo '<td>'.$item['km_inicial'].'</td>';
					                	echo '<td>'.$item['km_final'].'</td>';
					                	echo '<td>'.$item['extensao'].'</td>';
					                	echo '<td>'.$item['subtrecho'].'</td>';
				                	echo '</tr>';
				                	$extTotal += $item['extensao'];
				                }
				                echo '<tr>';
				                echo '<td colspan="6" ><b>Extensão Total:</b> '.$extTotal.'</td>';
				                echo '</tr>';
				                echo '<tr>';
				                	echo '<td colspan="6" ><b>Lote:</b> '.$pas[0]['lote'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				               		 echo '<td colspan="6" ><b>Responsáveis</b></td>';
				                echo '</tr>';
				                echo '<tr>';
				               	 	echo '<td colspan="6" ><b>Responsável Geral:</b> ';
				               	 	if(isset($options_resposaveis[$pas[0]['id_responsavel']])){
				               	 		echo $options_resposaveis[$pas[0]['id_responsavel']];
				               	 	}else{
				               	 		' --- ';
				               	 	}
				               	 	echo '</td>';
				                echo '</tr>';
				                foreach($pas_fases as $item){
				                	if($item['id_responsavel'] != $pas[0]['id_responsavel'] ){
				                		echo '<tr>';
				                			echo '<td colspan="6" ><b>Responsável '.$item['fases'].' :</b> '.$options_resposaveis[$item['id_responsavel']].'</td>';
				                		echo '</tr>';
				                	}
				                }
				                
				                echo '<tr>';
				                echo '<td colspan="6" ><b>Descrição do Empreendimento:</b> '.$pas[0]['descricao'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				                echo '<td colspan="6" ><b>Observações:</b> '.$pas[0]['observacoes'].'</td>';
				                echo '</tr>';
			
			              ?>  
			            </tbody>
			            
			          </table>	
	            </div>
	          </div>
	       </div><!-- /.col-sm-6 -->
	       
	       
	       
	      </div>
    	
            <ul class="nav nav-tabs nav-justified">
               <li class="dropdown " >
			   	 <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Documentos<b class="caret"></b></a>
			    <ul class="dropdown-menu">
			      <li>
			      	<a href="#documentos" data-toggle="tab" >Todos os Documentos</a>
			      </li>
			      <?php
			      	foreach($tipo_documentos as $item){
				  ?>
			      		<li >
							<a href="<?php echo '#'.str_replace(" ", "_", $item['tipo']); ?>" data-toggle="tab" aria-expanded="false" ><?php echo ucfirst($item['tipo']);?></a>
						</li>
				<?php 
			      	} 
			      ?>
			    </ul>
			   </li>
			  <li class="dropdown active" >
			   	 <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" >Acompanhamento Físico<b class="caret"></b></a>
			    <ul class="dropdown-menu">
		    		<li class="active">
						<a href="<?php echo '#acompanhamento_fisico';?> " onclick="drawChart_stock_div2('get_cronograma_atividade/<?php echo $id_pas; ?>');"  data-toggle="tab" aria-expanded="false" >Por Atividade</a>
					</li>
					<li >
						<a href="<?php echo '#acompanhamento_fisico';?> " onclick="drawChart_stock_div2('get_cronograma_atividade_planejada/<?php echo $id_pas; ?>');"  data-toggle="tab" aria-expanded="false" >Por Atividade Planejada</a>
					</li>
					<li>
						<a href="<?php echo '#acompanhamento_fisico';?> "onclick="drawChart_stock_div2('get_cronograma_atividade_contratada/<?php echo $id_pas; ?>');"  data-toggle="tab" aria-expanded="false" >Por Atividade Contratada</a>
					</li>
					<li>
						<a href="<?php echo '#acompanhamento_fisico';?> "onclick="drawChart_stock_div2('get_cronograma_produto/<?php echo $id_pas; ?>');"  data-toggle="tab" aria-expanded="false" >Por Produto</a>
					</li>
					<li>
						<a href="<?php echo '#acompanhamento_fisico';?> "onclick="drawChart_stock_div2('get_cronograma_all_lotes');"  data-toggle="tab" aria-expanded="false" >Totos os Lotes</a>
					</li>
			    </ul>
			   </li>
			</ul>
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade" id="documentos">
			
              <table class="table table-responsive table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
					<th class="yellow header headerSortDown">Documento</th>
					<th class="yellow header headerSortDown">Tipo</th>
					<th class="yellow header headerSortDown">Observação</th>
					<th class="yellow header headerSortDown">Última Atualização</th>
				  </tr>
		        </thead>
		            <tbody>
		              <?php
		              foreach($documentos as $row)
		              {
		                echo '<tr>';
						echo '<td>'.$row['titulo'].'</td>';
						echo '<td>'.$row['tipo'].'</td>';
						echo '<td>'.$row['observacao'].'</td>';
						echo '<td>'.$row['last_update'].'</td>';
						
		        		echo '<td class="crud-actions">
	                  	<a onclick="window.open (\''.base_url().'assets/gestao_estudos_projetos/pas/'.$id_pas.'/documentos/'.$row['nome'].'\', \'\'); return false" href="javascript:void(0);" target="_blank" class="btn btn-info">Ver / Download</a>
	                  
	                				</td>';
	                	echo "</tr>";
	             	  }
	             	  
	             	  foreach($documentos_movimentacoes as $row)
	             	  {
	             	  	echo '<tr>';
	             	  	echo '<td>'.$row['titulo'].'</td>';
	             	  	echo '<td>'.$row['tipo'].'</td>';
	             	  	echo '<td>'.$row['observacao'].'</td>';
	             	  	echo '<td>'.$row['last_update'].'</td>';
	             	  	 
	             	  	echo '<td class="crud-actions">
	                  			<a onclick="window.open (\''.base_url().'assets/gestao_estudos_projetos/pas/'.$id_pas.'/documentos/'.$row['nome'].'\', \'\'); return false" href="javascript:void(0);" target="_blank" class="btn btn-info">Ver / Download</a>
	             	  
	                			</td>';
	             	  	echo "</tr>";
	             	  }
	              ?>      
	            </tbody>
	          </table>
            </div>
             <?php
             		
					foreach($tipo_documentos as $item){
			 ?>
						<div class="tab-pane fade" id="<?php echo str_replace(" ", "_", $item['tipo']); ?>">
							<table class="table table-striped table-bordered table-condensed">
							<thead>
								<tr>
									<th class="header">#</th>
									<th class="yellow header headerSortDown">Documento</th>
									<th class="yellow header headerSortDown">Tipo</th>
									<th class="yellow header headerSortDown">Observação</th>
									<th class="yellow header headerSortDown">Última Atualização</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							foreach($documentos_classificados[$item['tipo']] as $row)
							{
								echo '<tr>';
								echo '<td>'.$row['titulo'].'</td>';
								echo '<td>'.$row['tipo'].'</td>';
								echo '<td>'.$row['observacao'].'</td>';
								echo '<td>'.$row['last_update'].'</td>';
							
								echo '<td class="crud-actions">
								          <a href="'.base_url().'assets/gestao_estudos_projetos/pas/'.$id_pas.'/documentos/'.$row['nome'].'" target="_blank" class="btn btn-info">Ver / Download</a>
								      </td>';
								echo "</tr>";
							}
							?>
				            </tbody>
				          </table>
			            </div>
			  <?php 
				}
	           ?> 
    		<div class="tab-pane fade active in" id="<?php echo 'acompanhamento_fisico'; ?>">
		    		<div class="grid">
  					  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		    				<div id="stock_div1" style="height: 1600px; width:100%"></div>
	    				<?php
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
	
	.table input {
	    display: none;
	}
	
	.table select {
	    display: none;
	}
	
	.table label {
	    margin: 0;
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

<?php
	
	echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
	echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
	
?>

<script type="text/javascript"> 
	 google.charts.load('current', {'packages':['timeline'], language:'br'});
	 google.charts.load('current', {'packages':['corechart']});
	 
	 google.setOnLoadCallback(function(){
			 drawChart_stock_div2("get_cronograma_atividade/<?php echo $id_pas; ?>");
			 drawChart_pie("tempo_medio_status_lote_chart/<?php echo $id_pas; ?>"	);
	 }); 

	function drawChart_stock_div2(string) { 

		console.log(string);

		
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/pas/" + string ,
            data:{position:'teste'},
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
            	var rowHeight = 20;
            	var data = new google.visualization.DataTable(response.result);
    		    var chartHeight = (data.getNumberOfRows() + 1) * rowHeight;
    		    var numRows = data.getNumberOfRows();
            	var colors = [];
    		    var colorMap = response.colorMap;
    		    
    		    colorMap["Hoje"] = "BLACK";
    		    
    		    for (var i = 0; i < numRows; i++) {
    		        colors.push(colorMap[data.getValue(i, 1)]);
    		    };
    		    
    		    var options_chart = {
    					"title":"Perido", 
    					"avoidOverlappingGridLines":false,
    					"colorByRowLabel":true,
    					"height":chartHeight,
    					colors: colors,
    			}; 
    			
    			var chart = new google.visualization.Timeline(document.getElementById('stock_div1')); 
    			
    			chart.draw(data, options_chart);               
    			MarcarHoje('stock_div1',-1);
    			google.visualization.events.addListener(
        	    		chart,'onmouseover', function() {
        	    			MarcarHoje('stock_div1', numRows);
        		 		} 
        		);

    			google.visualization.events.addListener(
    	    			chart, 'onmouseout', function() {
    	    				MarcarHoje('stock_div1',-1);
    					}
    	    	);
               
            },
            error: function(xhr, status, error) {
                
            }
        });
        
		 
			
	}; 

	function MarcarHoje (div, filas){

	  var altura = 0;
	  $('#'+div+' rect').each(function( index ) {
	    yValor = parseFloat($(this).attr('y'));
	    xValor = parseFloat($(this).attr('x'));
	    if ( yValor == 0 && yValor == 0 ) { altura = parseFloat($(this).attr('height')) };
	  });	
		
	  $('#'+div+' text:contains("Hoje")').css('font-size','11px').attr('fill','#A6373C').prev().first().attr('height',altura+'px').attr('width','1px').attr('y','0');

	  if (filas != -1) {
	    if ( 0 == filas )
	        $('.google-visualization-tooltip').css('display','none');
	    else
	        $('.google-visualization-tooltip').css('display','inline');
	   }
	}

	function RemoveFirstLine(div, filas){

		  var altura = 0;
		  $('#'+div+' rect').each(function( index ) {
		    yValor = parseFloat($(this).attr('y'));
		    xValor = parseFloat($(this).attr('x'));
		    if ( yValor == 0 && yValor == 0 ) { altura = parseFloat($(this).attr('height')) };
		  });	
			
		  $('#'+div+' text:contains("Hoje")').css('font-size','11px').attr('fill','#A6373C').prev().first().attr('height',altura+'px').attr('width','1px').attr('y','0');

		  if (filas != -1) {
		    if ( 0 == filas )
		        $('.google-visualization-tooltip').css('display','none');
		    else
		        $('.google-visualization-tooltip').css('display','inline');
		   }
		}
	
	 function myClickHandler(chart){
		  var selection = chart.getSelection();
		  var message = '';

		  for (var i = 0; i < selection.length; i++) {
		    var item = selection[i];
		    if (item.row != null && item.column != null) {
		      message += '{row:' + item.row + ',column:' + item.column + '}';
		    } else if (item.row != null) {
		      message += '{row:' + item.row + '}';
		    } else if (item.column != null) {
		      message += '{column:' + item.column + '}';
		    }
		  }
		  if (message == '') {
		    message = 'nothing';
		  }
		  alert('You selected ' + message);
		}

	 function drawChart_pie(string, div) { 

			$.ajax({
	            type: "POST",
	            url: "<?php echo base_url('pas'); ?>/" + string ,
	            data:{position:'teste'},
	            dataType: "json",
	            contentType: "application/json",
	            success: function(response) {
	            	var data = new google.visualization.DataTable(response.lote);
	            	//console.log(response.produtos);
	            	
	            	var colors = [];
	            	var numRows = data.getNumberOfRows();
	    		    var colorMap = {

	    		    	'Inicio da Execução': '#fad201',
	    		        'Protocolo': '#f54021',
	    		        'Entregue para Análise': '#cc0605',
	    		        'Em Análise': '#a03472',
	    		        'Em Revisão': '#308446',
	    		        'RACP': '#063971',
	    		        'RACD': '#8d948d',
	    		        
	    		    };
	    		    for (var i = 0; i < numRows; i++) {
	    		        colors.push(colorMap[data.getValue(i, 0)]);
	    		    };

	    		   		    		   
					var options_chart = {
	    					"avoidOverlappingGridLines":false,
	    					"colorByRowLabel":true,
	    					"colorByRowLabel":true,
	    					"height" : 400,
	    					"is3D" : false,
	    					"legend" : {
		    					"position" : "bottom",
		    					"maxLines" : "10",	
	    					}, 
	    					"chartArea" :{
		    					"left":'12.5%',
		    					"top":'10%',
		    					"width":'75%',
		    					"height":'75%'
			    			},
			    			"colors" : colors,
			    			"title"  : "Total de Movimentações do Lote"
	    					
	    			};
	    			/*
	    			"legend" : {
		    					"position" : "bottom",	
		    					} 
	    			*/
	    		    
					//console.log(data);
	    			//console.log(data);
	    	        
	    			var chart = new google.visualization.PieChart(document.getElementById('chart-pie-media'));
	    			chart.draw(data, options_chart);
					
					var produtos = response.produtos;
	    			var ind = 1;
	    			for (var key in produtos) {
	    				
	    			    // skip loop if the property is from prototype
	    			    if (!produtos.hasOwnProperty(key)) continue;
	    			    //console.log(key);
	    			    /* uncomment this to load all charts
	    			    data = new google.visualization.DataTable(produtos[key]);
	    			    chart = new google.visualization.PieChart(document.getElementById('chart-pie-' + ind));
	    			    options_chart.title = key;
	    			    options_chart.legend = "none";
	    				chart.draw(data, options_chart);
	    				ind++;
	    				*/
	    			    //console.log(produtos[key]);
	    			   // console.log(obj);
	    			    /*
	    			    for (var prop in obj) {
	    			        // skip loop if the property is from prototype
	    			        if(!obj.hasOwnProperty(prop)) continue;

	    			        // your code
	    			        console.log(prop + " = " + obj[prop]);
	    			    }

		    			*/
	    			}
		               
	            },
	            error: function(xhr, status, error) {
	                
	            }
	        });
	        
			 
				
		}; 

		
</script>  	

<script src="https://js.arcgis.com/3.27/"></script> 	
<script>

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

		$(window).resize(function(){
			drawChart_pie("tempo_medio_status_lote_chart/<?php echo $id_pas; ?>"); 
		});
		
		function open_modal(id){
			$("#actionModal").attr("href", "pas/delete/"+id);
		};

		$(function(){
		  $("table").tablesorter({
		    onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }, 
		    dateFormat: "uk",
		  });
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


		 /* AGENDA : ''*/
		
		 var options = {
					events_source: "<?php echo base_url(); ?>admin/pas/get_pas_planejamento_by_id/<?php echo $id_pas; ?>",
					view: 'year',
					tmpl_path: "<?php echo base_url(); ?>/assets/portal/tmpls/",
					tmpl_cache: false,
					language: 'pt-BR',
					onAfterEventsLoad: function(events) {
						if(!events) {
							return;
						}
						var list = $('#eventlist');
						list.html('');

						$.each(events, function(key, val) {
							$(document.createElement('li'))
								.html('<a href="' + val.url + '">' + val.title + '</a>')
								.appendTo(list);
						});
					},
					onAfterViewLoad: function(view) {
						$('.page-header h3').text(this.getTitle());
						$('.btn-group button').removeClass('active');
						$('button[data-calendar-view="' + view + '"]').addClass('active');
					},
					classes: {
						months: {
							general: 'label'
						}
					}
				};
			
			var calendar = $('#calendar').calendar(options);

			$('.btn-group button[data-calendar-nav]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.navigate($this.data('calendar-nav'));
				});
			});

			$('.btn-group button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.view($this.data('calendar-view'));
				});
			});

			

			var map;
		    dojo.require("esri.geometry.Polyline");
		    dojo.require("esri.graphic");
		    dojo.require("esri.symbols.SimpleLineSymbol");
		    dojo.require("esri.layers.FeatureLayer");
		    dojo.require("esri.tasks.FeatureSet");
		    dojo.require("esri.renderers.SimpleRenderer");
		    dojo.require("esri.InfoTemplate");
		    dojo.require("dojox.widget.ColorPicker");
		    dojo.require("dojo.parser");
		    dojo.require("dijit.registry");

			   
			  
			  require([	"esri/map", 
			     	  	"esri/geometry/Extent", 
			     	  	"esri/geometry/Polyline",
			     	  	"esri/layers/ArcGISDynamicMapServiceLayer",   
			     	  	"dojo/dom", 
			     	  	"dojo/on", 
			     	  	"dojo/query", 
			     	  	"dojo/_base/array",  
			     	  	"dojo/domReady!"], function (Map, Extent, Polyline,  ArcGISDynamicMapServiceLayer, dom, on, query, arrayUtils  ) {
			        
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
			            extent: initialExtent,
			        });

				      
		        	var jsArray =  [];
		        	
		        	<?php
		        		if(isset($coordenadas)){
		        			foreach($coordenadas as $item){
		        				if( $item['coordenadas'] != '' ){
		        					echo 'var jsArray = '.$item['coordenadas'].';';
		        				
		        				
		        	?>
		        				var singlePathPolyline = new esri.geometry.Polyline({ "paths": jsArray, "spatialReference": { "wkid": 4326 } });
		                        var i = singlePathPolyline.paths.length - 1;
		                        var p = parseInt((singlePathPolyline.paths[i].length - 1) / 2);
		                        var point = singlePathPolyline.getPoint(i, p);
		                        var url = "https://servicos.dnit.gov.br/vgeo?lat=" + point.y + "&lon=" + point.x;
		                        var graphic = new esri.Graphic(singlePathPolyline, null, { "DNIT": "<a href=\"" + url + "\"  target='_blank'>mais detalhes</a>" });
		                        criarLayer(graphic, 'teste');
		                        map.setExtent(singlePathPolyline.getExtent());
		        	<?php 
								}
		        			}
						}
		        	?>
		        	
		        	
		        	
					
			  });


			  function changeRenderer(featureLayer) {
				  
			        var symbol = null;
			        var cor = '#336699';

		        switch (featureLayer.geometryType) {
		            case 'esriGeometryPolyline':
		                symbol = new esri.symbol.SimpleLineSymbol(esri.symbol.SimpleLineSymbol.STYLE_SOLID, new dojo.Color(cor), 5);
		                break;
		        }
		        if (symbol) {
		            featureLayer.setRenderer(new esri.renderer.SimpleRenderer(symbol));
		        }
		        return featureLayer;
		     }
			     
		    
			  
			  function criarLayer(graphic, nm_versao) {
			        var featureCollection = {
			            "layerDefinition": null,
			            "featureSet": {
			                "features": [graphic],
			                "geometryType": "esriGeometryPolyline"
			            }
			        };
			        featureCollection.layerDefinition = {
			            "geometryType": "esriGeometryPolyline",
			            "objectIdField": "ObjectID",
			            "drawingInfo": {
			                "renderer": {
			                    "Simple Renderer": {
			                        "symbol": {
			                            "Style": "esriSLSSolid",
			                            "Color": [255, 0, 0, 1],
			                            "width": 3
			                        },
			                        "Label": null,
			                        "Description": null
			                    },
			                    "Transparency": 0
			                }
			            },
			            "fields": [{
			                "name": "ObjectID",
			                "alias": "ObjectID",
			                "type": "esriFieldTypeOID"
			            }, {
			                "name": "url",
			                "alias": "url",
			                "type": "esriFieldTypeString"
			            }]
			        };


			        var infoTemplate = new esri.InfoTemplate("Details", "${*}");
			        var featureLayer = new esri.layers.FeatureLayer(featureCollection, {
			            infoTemplate: infoTemplate,
			            className: nm_versao
			        });

			        dojo.connect(featureLayer, 'onClick', function (evt) {
			            map.infoWindow.setFeatures([evt.graphic]);
			            
			        });
			        map.addLayer(changeRenderer(featureLayer));

			    }

		  
</script>
