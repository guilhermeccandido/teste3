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
		          <a href="<?php echo base_url('home'); ?>">
		            <?php echo 'Home';?>
		          </a> 
		          
		        </li>
		        <li class="active">
		          <?php echo ucfirst($this->uri->segment(2));?>
		        </li>
		      </ol>
		      <div class="page-header users-header">
	    		<h2>
	              <?php 
	              	echo ucfirst($this->uri->segment(2));
	              	if($usuarioPerfil['acesso'] == 'editar'){ 	
	              ?>
	              		<a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
	              <?php 		
	              	}	
	              	?>
	            </h2>
	          </div>
	      <div class="row">
	        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" >
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
	       
	       <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-success">
				<div class="panel-heading">
				  <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="initialize_map();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                  </div>
	              <h3 class="panel-title">Localização Anteprojetos</h3>
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
	            
	            
	            
				?>
	            </div>
	          </div>
	       </div>
	       <!-- /.col-sm-4 -->
	          <!-- 
	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title">Panel title</h3>
	            </div>
	            <div class="panel-body">
	              Panel content
	            </div>
	          </div>
	           -->
	      </div>
	          
	          
	          
          <div class="well well-anteprojetos ">
           
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
         <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
				<th class="header"><li class="glyphicon glyphicon-plus"></li></th>
				<th class="yellow header headerSortDown">Prioridade</th>
				<th class="yellow header headerSortDown">Rodovia</th>
				<th class="yellow header headerSortDown">UF</th>
				<!-- 
				<th class="yellow header headerSortDown">Lotes</th>
				<th class="yellow header headerSortDown">Subtrecho</th>
				 -->
				<th class="yellow header headerSortDown">Status</th>
				<th class="yellow header headerSortDown">Progresso</th>
				<th class="yellow header headerSortDown">Data Inicial</th>
				<th class="yellow header headerSortDown">Data Final</th>
				<th class="yellow header headerSortDown">Intervenção</th>
				<th class="yellow header headerSortDown">Empresa Responsável</th>
				<!--<th class="yellow header headerSortDown">Status</th> -->
				
	    	  </tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($anteprojetos as $row)
	              {
	              	
	              	$progresso_total = round( ( $row['progresso1'] / 3 ) + ( $row['progresso2'] / 3 ) + ( $row['progresso3'] / 3 ) );
	              	
	                echo '<tr>';
	                echo '<td style="width: 35px;">
	        		<div class="action-buttons">
						<a href="#" class="green bigger-140 show-details-btn" title="Mostrar Detalhes">
							<i class="icon glyphicon glyphicon-chevron-down"></i>
							<span class="sr-only">Detalhes</span>
						</a>
					</div>
	        		</td>';
	                echo '<td style="width: 95px;">'.$row['prioridade'].'</td>';
					echo '<td>'.$row['rodovia'].'</td>';
					echo '<td>'.$row['uf'].'</td>';
					//echo '<td style="width: 65px;">'.$row['lotes'].'</td>';
					//echo '<td>'.$row['subtrecho'].'</td>';
					echo '<td>'.$row['status'].'</td>';
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
					echo ($row['data_ini_anteprojeto']) ? date('d/m/Y',strtotime($row['data_ini_anteprojeto'])) : 'Sem Registro';
					echo '</td>';
					echo '<td>';
					echo $row['data_fim_anteprojeto'] ? date('d/m/Y',strtotime($row['data_fim_anteprojeto'])) : 'Sem Registro';
					echo '</td>';
					echo '<td>'.$row['intervencao'].'</td>';
					echo '<td>'.$row['empresa_responsavel'].'</td>';
					/*
					echo '<td style="width: 70px;">
              				<div class="progress" style="margin-bottom:10px;">
							  <div class="bar" style="width: 100%;"></div>
							</div>
              				<div class="progress progress-danger" style="margin-bottom:10px;">
							  <div class="bar" style="width: 100%"></div>
							</div>
              				<div class="progress progress-success" style="margin-bottom:10px;">
							  <div class="bar" style="width: 50%;">Documentação</div>
							</div>
		            	  </td>';
		           */
				
					
			       echo '<td class="crud-actions">
		        		  <a href="'.site_url("admin").'/anteprojetos/detalhes/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Visualizar</a>
		                </td>';
	                echo '</tr>';
	                echo '<tr class="detail-row">';
		                echo '<td colspan="10" >
				        		<div class="action-buttons">
									<table class="table table-striped table-bordered table-condensed">
						              <tr>
										<td>Km Inicial: '.$row['km_inicial'].'</td>	              		
										<td>Km Final: '.$row['km_final'].'</td>
										<td>Extensão(km): '.$row['extensao'].'</td>
									  </tr>
	              					 <tr>
										<td colspan="3" >Subtrecho: '.$row['subtrecho'].'</td>	
									  </tr>
	              					  <tr>
										<td colspan="3">'.$row['observacoes'].'</td>	
									  </tr>
									 </table>
								</div>
				        		</td>';
		               echo '<td class="crud-actions">';
		               if($usuarioPerfil['acesso'] == 'editar'){ 	
		               	echo '<a href="'.site_url("admin").'/anteprojetos/update/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Editar</a>
                        	  <a href="'.site_url("admin").'/anteprojetos_pendencias/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Pendências</a>	
		            		  <a href="'.site_url("admin").'/anteprojetos_documentos/lista_documento/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Documentos</a>
	              			  <a href="'.site_url("admin").'/anteprojetos_acompanhamento_fisico/lista_acompanhamento_fisico/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Acomp. Físico</a>
	            			  <a href="'.site_url("admin").'/anteprojetos_imagens/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Imagens</a>
	 						  <a href="'.site_url("admin").'/anteprojetos_localizacao/lista_localizacao/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Localização</a>
			                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>';
		               }
		               echo '</td>'; 
            			
			                  
			                
	                echo '</tr>';
	               
	                //'.site_url('admin').'/anteprojetos/delete/'.$row['id'].'
	              }
				  if($usuarioPerfil['acesso'] == 'editar'){ 	

              		echo ' <div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
							 <div class="modal-content">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							    <h3>Deleção de Registro</h3>
							  </div>
							  <div class="modal-body">
							    <p>Você realmente gostaria de Deletar esse Registro?</p>
							  </div>
							  <div class="modal-footer">
							    <a id ="actionModal" href="'.site_url('admin').'" class="btn btn-danger">Deletar</a>
							    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
							  </div>
							 </div>
						    </div>
						   </div>';
              	}
              ?>      
            </tbody>
          </table>
		</div>
		
		<div class="row" >
			<div class="col-sm-12">
		          <div class="panel panel-success">
		            <div class="panel-heading">
		              <div class="panel-heading-btn">
		              	<?php if($usuarioPerfil['acesso'] == 'editar'){ 	?>
		              		<a href="<?php echo  site_url("admin").'/anteprojetos/add_img'; ?>" class="btn btn-xs btn-icon btn-circle btn-success" ><i class="fa ">Adicionar Cronograma</i></a>
		              	<?php }; ?>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                  </div>
		              <h3 class="panel-title">Cronograma Geral</h3>
		            </div>
		            <div class="panel-body">
		 			<?php
						if(file_exists($titulo = ANTEPROJETOS_FOLDER .'cronograma.jpg')){
					?>
		            	<center>
			             	<img src="<?php echo base_url().'assets/anteprojetos/cronograma.jpg' ?>" style="width: 90%" />
			             </center>
			        <?php 
						}	
			  
					?>
		            </div>
		          </div>
		       </div>
		</div>
		
		
		
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

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
	
	.detail-row {
		display: none;
	}
	
	.open {
		display: table-row;
	}
	
</style>
 
	<script>

		$(document).ready(function() {
			App.init();
			
		});
	
		function open_modal(id){
			$("#actionModal").attr("href", "anteprojetos/delete/"+id);
		};


		$('.show-details-btn').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find('.icon').toggleClass('glyphicon-chevron-down').toggleClass('glyphicon-chevron-up');
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

	
	 	/* modal : '#events-modal',*/
		
	 	var options = {
				events_source: "<?php echo base_url(); ?>admin/anteprojetos/get_anteprojetos_events",
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

		
		/*
		
		
		$(function(){
			  $("table").tablesorter({
			    onRenderHeader: function(){
			      this.prepend('<span class="icon"></span>');
			    }
			  });
			});
		
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
 	echo $map['js']; 
 ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	