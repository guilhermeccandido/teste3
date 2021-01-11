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
	}
	$id_anteprojeto = $anteprojetos[0]['id'];
	
	$progresso_total = round( ( $anteprojetos[0]['progresso1'] / 3 ) + ( $anteprojetos[0]['progresso2'] / 3 ) + ( $anteprojetos[0]['progresso3'] / 3 ) ); 
	
	
	foreach($link_acessos as $item){
	
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
	$status1 = ($anteprojetos[0]['progresso1'] >= 100 ) ? 'Aceite' : $anteprojetos[0]['fase1'];
	$status2 = ($anteprojetos[0]['progresso2'] >= 100 ) ? 'Aceite' : $anteprojetos[0]['fase2'];
	$status3 = ($anteprojetos[0]['progresso3'] >= 100 ) ? 'Aceite' : $anteprojetos[0]['fase3'];
	
?>
  
    <div class="container-fluid">    
	  <div class="row">
	    
    <div class="main">
    	<ol class="breadcrumb">	        
	        <li>
	          <a href="<?php echo site_url("admin").'/anteprojetos'; ?>">
	            <?php echo ucfirst($this->uri->segment(2));?>
	          </a>
	           
	        </li>
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(3));?>
	        </li>
	      </ol>
    	<h1 class="page-header">
    	<?php 
    		echo $anteprojetos[0]['titulo'] ? $anteprojetos[0]['titulo'] : $anteprojetos[0]['rodovia'].' '.$anteprojetos[0]['uf'] ;
    	?>
    	</h1>
    	
	 <div class="row">
	 	  <!-- desktop medium-devices tablet cell -->
	      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	          <div class="panel panel-success">
				<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="initialize_map();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
	              <h3 class="panel-title">Localização</h3>
	            </div>
	            <div class="panel-body" style="height:566px;">
	            <?php
	            
	            /*
				echo $this->gcharts->GeoChart('Debt')->outputInto('debt_div');
	            echo $this->gcharts->div(0,0,'');
	            if($this->gcharts->hasErrors()) {
	            	echo $this->gcharts->getErrors();
	            }	
				*/
					
				
	            
	            echo $map['html'];
	            //die;
	            
	            
				?>
	            </div>
	          </div>
	       </div><!-- /.col-sm-6 -->
	        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-success">
				<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
	              <h3 class="panel-title">Detalhes do Anteprojeto</h3>
	            </div>
	            <div class="panel-body">
	            	<h5>
        				Data Inicial: <b><?php echo $anteprojetos[0]['data_ini_anteprojeto'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_ini_anteprojeto'])) : 'Sem Registro' ; ?> </b> - Data Final: <b> <?php echo $anteprojetos[0]['data_fim_anteprojeto'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_fim_anteprojeto'])) : 'Sem Registro' ; ?> </b>
        			</h5>
	            	<h4><b>PROGRESSO TOTAL (Anteprojeto)</b></h4>
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
	      			<h5>
        				Data Inicial: <b><?php echo $anteprojetos[0]['data_ini_fase1'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_ini_fase1'])) : 'Sem Registro' ; ?> </b> - Data Final: <b> <?php echo $anteprojetos[0]['data_fim_fase1'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_fim_fase1'])) : 'Sem Registro' ; ?> </b>
        			</h5>
	      			<h5><b>Progresso Fase 1 (<?php echo $status1; ?>)</b></h5>
	      			<div class="progress progress-striped green active">
	        			<div class="progress-bar progress-bar-<?php echo  switchProgressBar($status1); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="73" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $anteprojetos[0]['progresso1']; ?>%;">
	        				<?php echo $status1.' '.$anteprojetos[0]['progresso1'] ; ?>%; 
	        			</div>
	      			</div>
	      			<h5>
        				Data Inicial: <b><?php echo $anteprojetos[0]['data_ini_fase2'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_ini_fase2'])) : 'Sem Registro' ; ?> </b> - Data Final: <b> <?php echo $anteprojetos[0]['data_fim_fase2'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_fim_fase2'])) : 'Sem Registro' ; ?> </b>
        			</h5>
	      			<h5><b>Progresso Fase 2 (<?php echo $status2; ?>)</b></h5>
	      			<div class="progress progress-striped green active">
	        			<div class="progress-bar progress-bar-<?php echo switchProgressBar($status2); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="45" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $anteprojetos[0]['progresso2']; ?>%;">
	        				<?php echo $status2.' '.$anteprojetos[0]['progresso2'] ; ?>%; 
	        			</div>
	      			</div>
	      			<h5>
        				Data Inicial: <b><?php echo $anteprojetos[0]['data_ini_fase3'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_ini_fase3'])) : 'Sem Registro' ; ?> </b> - Data Final: <b> <?php echo $anteprojetos[0]['data_fim_fase3'] ? date('d/m/Y', strtotime($anteprojetos[0]['data_fim_fase3'])) : 'Sem Registro' ; ?> </b> 
        			</h5>
	      			<h5><b>Progresso Fase 3 (<?php echo $status3; ?>)</b></h5>
	      			<div class="progress progress-striped green active">
	        			<div class="progress-bar progress-bar-<?php echo switchProgressBar($status3); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="30" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $anteprojetos[0]['progresso3']; ?>%;">
	        				<?php echo $status3.' '.$anteprojetos[0]['progresso3'] ; ?>%;
	        			</div>
	      			</div>
	      			
	      			
		            <table class="table table-striped table-hover" >
			            <thead>
			              <tr>
							<th class="header" colspan="1"><b>Prioridade: <?php echo $anteprojetos[0]['prioridade']; ?></b></th>
							<th class="header" colspan="2"><b>Status: <?php echo $anteprojetos[0]['status']; ?></b></th>
				    	  </tr>
				            </thead>
				            <tbody>
				              <?php
				                echo '<tr>';
				                echo '<td><b>UF:</b> '.$anteprojetos[0]['uf'].'</td>';
				                echo '<td><b>Rodovia:</b> '.$anteprojetos[0]['rodovia'].'</td>';
				                echo '<td><b>Extensão:</b> '.$anteprojetos[0]['extensao'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				               	 	echo '<td><b>km Final:</b> '.$anteprojetos[0]['km_inicial'].'</td>';
				               	 	echo '<td colspan="2" ><b>km Inicial:</b> '.$anteprojetos[0]['km_final'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				                	echo '<td colspan="3" ><b>Lotes:</b> '.$anteprojetos[0]['lotes'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				                	echo '<td colspan="3" ><b>Subtrecho:</b> '.$anteprojetos[0]['subtrecho'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				               	 echo '<td colspan="3" ><b>Intervenção:</b> '.$anteprojetos[0]['intervencao'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				                	echo '<td colspan="3" ><b>Empresa Responsável:</b> '.$anteprojetos[0]['empresa_responsavel'].'</td>';
				                echo '</tr>';
				                /*
				                echo '<td>'.$anteprojetos[0]['prioridade'].'</td>';
								echo '<td>'.$anteprojetos[0]['rodovia'].'</td>';
								echo '<td>'.$anteprojetos[0]['uf'].'</td>';
								echo '<td>'.$anteprojetos[0]['km_inicial'].'</td>';
								echo '<td>'.$anteprojetos[0]['km_final'].'</td>';
								echo '<td>'.$anteprojetos[0]['extensao'].'</td>';
								echo '<td>'.$anteprojetos[0]['lotes'].'</td>';
								echo '<td>'.$anteprojetos[0]['subtrecho'].'</td>';
								echo '<td>'.$anteprojetos[0]['intervencao'].'</td>';
								echo '</tr>';
								*/
				                //'.site_url('admin').'/anteprojetos/delete/'.$row['id'].'
			
			              	
			              ?>  
			            </tbody>
			            
			          </table>	
	            </div>
	          </div>
	       </div><!-- /.col-sm-6 -->
	       <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
			          <div class="panel panel-success">
			            <div class="panel-heading">
				            <div class="panel-heading-btn">
				            <?php  if($usuarioPerfil['acesso'] == 'editar'){ ?>
				            	<a href="#pendencias-modal" class="btn btn-xs btn-circle btn-success" data-toggle="modal" data-target="#pendencias-modal" ><i class="fa fa-plus"></i></a>
				            <?php  };  ?>
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			                </div>
			              <h3 class="panel-title">Pendências</h3>
			            </div>
			            <div class="panel-body table-responsive" id="pendencias-table" >
			              <table class="table table-striped table-bordered table-condensed editable" >
				            <thead>
				              <tr>
				            	<th class="header">ID</th>
								<th class="yellow header headerSortDown">Descrição</th>
								<th class="yellow header headerSortDown">Responsabilidade</th>
								<th class="yellow header headerSortDown">Prioridade</th>
							  </tr>
					        </thead>
					            <tbody>
					              <?php
					              
					              $options_pendencias = array();
					              foreach ($lista_pendencias as $row) {
					              	$options_pendencias[$row['id']] = $row['titulo'];
					              };
					              
					              
					              foreach($pendencias as $row)
					              {
					                echo '<tr class="alert alert-'.$row['categoria'].'" id="'.$row['id'].'">';
					                echo '<td >';
					                echo $row['identificacao'];
					                //echo '<a class="btn btn-xs btn-circle btn-danger" ><li class="fa fa-minus"></li></a>';
					                echo '</td>';
									echo '<td>';
									echo '<label>'.$row['titulo'].'</label>';
									echo '<input type="text" name="titulo" value="'.$row['titulo'].'" class="table-input" />';
									echo '</td>';
									echo '<td>';
									echo '<label>'.$row['responsabilidade'].'</label>';
									echo '<input type="text" name="responsabilidade" value="'.$row['responsabilidade'].'" class="table-input" />';
									echo '</td>';
									echo '<td>';
									echo '<label>'.$row['pendencias'].'</label>';
									echo form_dropdown("id_pendencias", $options_pendencias, $row['pendencias']);
									echo '</td>';
					                echo "</tr>";
					              }
				              ?>      
				            </tbody>
				          </table>
				          <script>
				          <?php  if($usuarioPerfil['acesso'] == 'editar'){ ?>
				          
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
									  url: "<?php echo base_url().'admin/anteprojetos/edit_table_pendencias' ?>",
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
							
							<?php  };  ?>
			            </script>
			            </div>
			            	  <div id="pendencias-modal" class="modal fade" role="dialog">
								 <div class="modal-dialog">
							 	   <div class="modal-content"> 
	          						 <div class="modal-header">
								      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								      <h3>Adicionar Pendência</h3>
								     </div>
								     <div class="modal-body">
								      <form method="post" action="" id="dependencias-form" name="dependencias-form" >
								      <fieldset>
									      	<input class="form-control" type="hidden" id="id_anteprojetos" name="id_anteprojetos"  value="<?php echo $id_anteprojeto; ?>" >
											  <div class="form-group col-lg-12">
										        <div class="input-group col-lg-8">
										        	<?php echo form_dropdown("id_pendencias", $options_pendencias, set_value("id_pendencias"), 'class="form-control"' );?>
										            <span class="input-group-addon">Prioridade</span>
										        </div>
										      </div>
											  <div class="form-group col-lg-12">
										        <div class="input-group col-lg-8">
										        	<input class="form-control" type="text" id="titulo" name="titulo"  placeholder="Descrição" value="<?php echo set_value('titulo'); ?>" >
										            <span class="input-group-addon">Descrição</span>
										        </div>
										      </div>
											  <div class="form-group col-lg-12">
										        <div class="input-group col-lg-8">
										        	<input class="form-control" type="text" id="responsabilidade" name="responsabilidade"  placeholder="Responsabilidade" value="<?php echo set_value('responsabilidade'); ?>" >
										            <span class="input-group-addon">Responsabilidade</span>
										        </div>
										      </div>
									     	  
								          <div class="form-group">
								          	<div class="col-lg-6">
								             <button onclick="post_object('#pendencias-table', '#dependencias-form');" class="btn btn-primary" type="button">Salvar Modificações</button>
								             <button class="btn btn-default" type="reset">Cancelar</button>
								            </div>
								          </div>
								        </fieldset>
							    
								      </form>
								     </div>
								    <div class="modal-footer">
								     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								    </div>
								  </div>
            				    </div>
						       </div>
			          </div>
			       </div><!-- /.col-sm-4 -->
	       
		  </div>
		        
	      <div class="row">
	       <?php

	       		foreach($acompanhamento_fisico as $item){
	       			if($item['adm'] == 'true'){
			?>
	
				 <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
			          <div class="panel panel-success">
			            <div class="panel-heading">
				            <div class="panel-heading-btn">
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			                </div>
			              <h3 class="panel-title"><?php echo $item['tipo']; ?></h3>
			            </div>
			            <div class="panel-body">
			              <!-- <blockquote>  -->
			             	<a href="#myModal<?php echo $item['id'];?>" class="btn btn-default" data-toggle="modal">Outros Formatos</a>
				             <center>
				             	<img src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.jpg' ?>" style="width: 90%" />
				             </center>
			              <!-- </blockquote>  -->
			              <?php
			             	$link = '<a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.jpg">
										<img src="'.base_url().'assets/img/icons/jpg.jpg" style="width:50px;" />
									</a> ';
				            foreach($item['list'] as $list){
								if(empty($list)){
									break;
								}else{
									$link .= '<a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.'.$list['tipo'].'" target="_blank">
												<img src="'.base_url().'assets/img/icons/'.$list['tipo'].'.jpg" style="width:50px;" />
											  </a> ';
								}
				            }
				            echo ' <div id="myModal'.$item['id'].'" class="modal fade" role="dialog">
									 <div class="modal-dialog">
								 	   <div class="modal-content"> 
		          						 <div class="modal-header">
									      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									      <h3>Download de Arquivos</h3>
									     </div>
									     <div class="modal-body">
									      <p>O documento selecionado encontra-se disponível nos seguintes formatos:</p>'.
										   $link.'
									     </div>
									    <div class="modal-footer">
									     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									    </div>
									  </div>
	            				    </div>
							       </div>';
				            
				          ?> 
			            </div>
			          </div>
			       </div><!-- /.col-sm-4 -->
	
	       	<?php 			
	       			}
	       		}
	       
	       ?>
	       
	       <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="panel panel-success">
	            <div class="panel-heading">
	              <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
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
	       </div><!-- /.col-sm-4 -->
	     </div>  
	       
	     <div class="row">
	       <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-success">
	            <div class="panel-heading">
		            <div class="panel-heading-btn">
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                </div>
	              <h3 class="panel-title">Observações</h3>
	            </div>
	            <div class="panel-body">
	              <!-- <blockquote>  -->
	              	<p>
	              		<?php  echo $anteprojetos[0]['observacoes']; ?>
	              	</p>
	              <!-- </blockquote>  -->
	            </div>
	          </div>
	       </div><!-- /.col-sm-4 -->
	       <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-success">
	            <div class="panel-heading">
		            <div class="panel-heading-btn">
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                </div>
	              <h3 class="panel-title">Descrição do Empreendimento</h3>
	            </div>
	            <div class="panel-body">
	              <!-- <blockquote>  -->
	              	<p>
	              		<?php  echo $anteprojetos[0]['descricao']; ?>
	              	</p>
	              <!-- </blockquote>  -->
	            </div>
	          </div>
	       </div><!-- /.col-sm-4 -->
	       
	      </div>
    	
            <ul class="nav nav-tabs nav-justified">
               <li class="dropdown active " >
			   	 <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Documentos<b class="caret"></b></a>
			    <ul class="dropdown-menu">
			      <li class="active" >
			      	<a href="#documentos" data-toggle="tab" >Todos os Documentos</a>
			      </li>
			      <?php
			      	foreach($tipo_documentos as $item){
				  ?>
			      		<li >
							<a href="<?php echo '#'.$item['tipo'];?>" data-toggle="tab" aria-expanded="false" ><?php echo ucfirst($item['tipo']);?></a>
						</li>
				<?php 
			      	} 
			      ?>
			    </ul>
			   </li>
			  <li class="dropdown" >
			   	 <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" >Acompanhamento Físico<b class="caret"></b></a>
			    <ul class="dropdown-menu">
			    <?php
			    	foreach($acompanhamento_fisico as $item){
						if($item['adm'] == "false"){
						
				?>
			    		<li>
							<a href="<?php echo '#'.$item['titulo']; ?>" data-toggle="tab" aria-expanded="false" ><?php echo $item['tipo']; ?></a>
						</li>
				<?php 
						}
			    	} 
			    ?>
			    </ul>
			   </li>
			   <li class="dropdown" >
			   	 <a href="#anteprojetos_imagens" class="dropdown-toggle" data-toggle="tab" href="#" aria-expanded="true" >Banco de Imagens</a>
			   </li>
			</ul>
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="documentos">
			
              <table class="table table-responsive table-striped table-bordered table-condensed">
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
		              foreach($documentos as $row)
		              {
		                echo '<tr>';
		                echo '<td>'.$row['id'].'</td>';
						echo '<td>'.$row['titulo'].'</td>';
						echo '<td>'.$row['tipo'].'</td>';
						echo '<td>'.$row['observacao'].'</td>';
						echo '<td>'.$row['last_update'].'</td>';
						
		          echo '<td class="crud-actions">
					  <a onclick="window.open (\''.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/documentos/'.$row['nome'].'\', \'\'); return false" href="javascript:void(0);" target="_blank" class="btn btn-info">Ver / Download</a>
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
						<div class="tab-pane fade" id="<?php echo $item['tipo']; ?>">
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
								echo '<td>'.$row['id'].'</td>';
								echo '<td>'.$row['titulo'].'</td>';
								echo '<td>'.$row['tipo'].'</td>';
								echo '<td>'.$row['observacao'].'</td>';
								echo '<td>'.$row['last_update'].'</td>';
							
								echo '<td class="crud-actions">
								          <a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/documentos/'.$row['nome'].'" target="_blank" class="btn btn-info">Ver / Download</a>
								      </td>';
								echo "</tr>";
							}
							?>
				            </tbody>
				          </table>
			            </div>
			  <?php 
				}
	        
             
			    foreach($acompanhamento_fisico as $item){
					if($item['adm'] == "false"){
						
					
				?>
		    		<div class="tab-pane fade" id="<?php echo $item['titulo']; ?>">
		    		<a href="#myModal<?php echo $item['id'];?>" class="btn btn-default" data-toggle="modal">Outros Formatos</a>
		             <center>
		             	<img src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.jpg' ?>" style="width: 90%" />
		             </center>
		             <?php
		             	$link = '<a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.jpg">
									<img src="'.base_url().'assets/img/icons/jpg.jpg" style="width:50px;" />
								</a> ';
			            foreach($item['list'] as $list){
							if(empty($list)){
								break;
							}else{
								$link .= '<a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.'.$list['tipo'].'" target="_blank">
											<img src="'.base_url().'assets/img/icons/'.$list['tipo'].'.jpg" style="width:50px;" />
										  </a> ';
							}
			            }
			            echo ' <div id="myModal'.$item['id'].'" class="modal fade" role="dialog">
								 <div class="modal-dialog">
							 	   <div class="modal-content"> 
	          						 <div class="modal-header">
								      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								      <h3>Download de Arquivos</h3>
								     </div>
								     <div class="modal-body">
								      <p>O documento selecionado encontra-se disponível nos seguintes formatos:</p>'.
									   $link.'
								     </div>
								    <div class="modal-footer">
								     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								    </div>
								  </div>
            				    </div>
						       </div>';
			            
			          ?> 
		            </div>
		       <?php
		       		}
		    	} 
		    ?>
             <!-- Anteprojetos Imagem Tab Content  -->
		    <div class="tab-pane fade" id="anteprojetos_imagens">
		    <br />
		    <!--  Imagens  -->
             	<ul class="portfolio-control">
			        <li class="filter active" data-filter="all">Todas as Imagens</li>
			        <?php foreach($categorias_imagens as $row ){ ?>
			        		<li class="filter" data-filter="<?php echo $row['titulo']; ?>"><?php echo $row['titulo']; ?></li>
			        <?php }	?>
			    </ul>
			
			    <div class="row" id="Grid">
			    
			    <?php
			    	foreach($anteprojetos_imagens as $row){
			    		
			    ?>	        
			     	  <div class="col-sm-6 col-lg-3 col-md-4 mix <?php echo $row['categoria']?>">
			               <div class="img-caption">
			                  <img width="800" height="533" src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>" class="attachment-, img-responsive wp-post-image" alt="<?php echo $row['titulo']; ?>" />                                       
			                  <div class="caption">
			                       <div class="caption-content">
			                           <a href="#" class="animated fadeInDown" data-toggle="modal" data-target="#myModalImg<?php echo $row['id']; ?>">
			                           	<i class="fa fa-search"></i>Mais Informações
			                           </a>
			                           <h4><?php echo $row['titulo']; ?></h4>
			                       </div>
			                   </div>
			               </div>
			           </div>
			           <!-- Modal -->
			           <div class="modal fade" id="myModalImg<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			               <div class="modal-dialog">
			                   <div class="modal-content">
			                       <div class="modal-header">
			                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                           <h4 class="modal-title" id="myModalLabel"><?php echo $row['titulo']; ?></h4>
			                       </div>
			                       <div class="modal-body">
			                       <img width="800" height="533" src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>" class="attachment-, img-responsive wp-post-image" alt="<?php echo $row['titulo']; ?>" />                                                      
			                       <div class="no-img">
				                       <p>
					                       <a href="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>">
					                       		<img src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>" alt="<?php echo $row['titulo']; ?>" width="800" height="533" class="aligncenter imageborder img-responsive size-full wp-image-121" />
					                       </a>
				                       </p>
										<p>
										<?php echo $row['descricao']; ?>
										</p>
									</div>
			                       </div>
			                       <div class="modal-footer">
			                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                       </div>
			                   </div><!-- modal-content -->
			               </div><!-- modal-dialog -->
			           </div><!-- modal -->
			           
			      <?php
			      } 
			      ?>	             
			   </div>			   
			   <!--  Imagens  -->		    
          </div>
          <!-- Anteprojetos Imagem Tab Content  -->
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
	
</style>
 	
	<script>

		$(document).ready(function() {
			App.init();
			
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


		$(function() {
		    $('#Grid').mixitup();
		});

		$(window).resize(function(){
			initialize_map();
		});

		$("#menu-toggle").click(function(e) {
        	e.preventDefault();
	        $("#wrapper").toggleClass("active");
		});

		 $('[data-toggle=offcanvas]').click(function() {
		    $('.row-offcanvas').toggleClass('active');
		  });

		 var options = {
					events_source: "<?php echo base_url(); ?>admin/anteprojetos/get_anteprojeto_event_by_id/<?php echo $id_anteprojeto; ?>",
					view: 'month',
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

		  
		function post_object(elementName, form){
			var p = {};
			$(elementName).hide();
			p['post'] = $(form).serialize();
			console.log(elementName);
			console.log(form);
			$(elementName).load(
				"<?php echo base_url().'admin/anteprojetos_pendencias/add_json/'.$id_anteprojeto ?>",
				p,
				function(){$(elementName).fadeIn('slow')});
		};


			
	</script>

<?php 
 	echo $map['js']; 
 ?>