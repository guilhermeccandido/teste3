<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

	$id_contrato = isset($id_contrato) ? $id_contrato : null;
	
	$options_contratos = array();
	foreach ($contratos as $row)
	{
		$options_contratos[$row["id"]] = $row["contrato"];
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
	          <a href="<?php echo base_url() .'gestao_estudos_projetos'; ?>">
	            <?php echo ucfirst('Gestão de Estudos e Projetos');?>
	          </a>
	        </li>
	        <?php
	        	if($id_contrato){
			?>	 
			<li>
	          <a href="<?php echo base_url() .'admin/pas/contratos'; ?>">
	            <?php echo ucfirst('Contratos');?>
	          </a>
	        </li>  		
	        <?php 	} ?>
	        <li class="active">
	          EVTEAS
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
    			EVTEAS
              <?php 
              if($usuarioPerfil['acesso'] == 'editar'){
              ?>
              		<a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
              <?php 		
              	}	
              	?>
            </h2>
          </div>
          <div class="row">
          <?php 
          /*
	        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" >
	        	<div class="panel panel-warning">
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
	       */
			?>
	       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-warning">
				<div class="panel-heading">
				  <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  </div>
	              <h3 class="panel-title">Trechos EVTEAS</h3>
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
	       <!-- /.col-sm-4 -->
          </div>
          
          <div class="well well-pas">
           
            <?php
           die;
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
	              	<th class="yellow header headerSortDown">Local</th>
	              	<th class="yellow header headerSortDown">Contrato</th>
					<th class="yellow header headerSortDown">Lote</th>
					<th class="yellow header headerSortDown">Trechos</th>
					<th class="yellow header headerSortDown">Progresso</th>
					<th class="yellow header headerSortDown">Data Inicial (Contratada)</th>
					<th class="yellow header headerSortDown">Data Inicial (Planejada)</th>
					<th class="yellow header headerSortDown">Data de Início</th>
					<th class="yellow header headerSortDown">Data Final (Contratada)</th>
					<th class="yellow header headerSortDown">Data Final (Planejada)</th>
					<th class="yellow header headerSortDown">Data Fim</th>
					<th class="yellow header headerSortDown">Status</th>
				  </tr>
				  <tr class="warning no-result">
			      	<td colspan="10"><i class="fa fa-warning"></i>Sem Resultados</td>
			      </tr>
	            </thead>
	            <tbody>
	              <?php
		              $options_locais = array();
		              foreach($local_execucao as $rowLocal){
		              	$options_locais[$rowLocal['id']] = $rowLocal['titulo'];
		              }
	              
	              foreach($pas as $row)
	              {
	              	$progresso_total = ( $row['progresso_total'] > 0 ) ? $row['progresso_total'] : 0;
	              	$tituloTrecho = '';
	              	
	                echo '<tr>'; 
	                echo '<td>'.$options_locais[$row['id_local_execucao']].'</td>';
	                echo '<td>'.$options_contratos[$row['id_contrato']].'</td>';
					echo '<th scope="row"  >'.$row['lote'].'</th>';
					echo '<td>';
					echo 	($row['titulo']) ? $row['titulo'] : $row['trechos'];
					echo '</td>';
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
					echo '<td>'.date('d/m/Y', strtotime($row['data_ini_planejada'])).'</td>';
					echo '<td>';
					echo 	isset($row['data_first_mov']) ? date('d/m/Y H:i:s', strtotime($row['data_first_mov']))  : ' Não Disponível ' ;
					echo '</td>';
					echo '<td>';
					echo 	($row['data_ini_planejada'] < $row['data_fim_planejada']) ? date('d/m/Y', strtotime($row['data_fim_planejada'] )) : ' Não Disponível ';
					echo '</td>';
					echo ($progresso_total < 100 ) ? '<td>Não Disponível</td>' : '<td>'. date('d/m/Y H:i:s', strtotime($row['data_last_mov'])) .'</td>';
					echo '<td>'.$row['status'].'</td>';
					
		         /*
				  echo 	'<a href="'.site_url("admin").'/pas/detalhes/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Visualizar</a>
	              		  <a href="'.site_url("admin").'/pas_trechos/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Trechos</a>		
	              		  <a href="'.site_url("admin").'/pas_fases/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Atividades</a>	
	            		  <a href="'.site_url("admin").'/pas_documentos/lista_documento/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Documentos</a>
	                      <a href="'.site_url("admin").'/pas/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
		                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>';
		                 
				  */
					
					echo '<td>';
					echo 	'
					    <div class="btn-group" role="group">
							<button href=""  type="button" class="btn btn-info" aria-label="Visualizar" role="group" 
								 onclick="window.location.href =\''.site_url("admin").'/pas/detalhes/'.$row['id'].'\'">
				              	<span class="glyphicon glyphicon-eye-open">
										<a href="'.site_url("admin").'/pas/detalhes/'.$row['id'].'"></a>
								</span>
				            </button>
							<div class="btn-group" role="group" >
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="glyphicon glyphicon-plus"></span>
								</button>
								  <ul class="dropdown-menu dropdown-menu-right">
								    <li>
										<a href="'.site_url("admin").'/pas_trechos/'.$row['id'].'" >Trechos</a>
									</li>
								    <li>
										<a href="'.site_url("admin").'/pas_fases/'.$row['id'].'" >Atividades</a>
									</li>
								    <li>
										<a href="'.site_url("admin").'/pas_documentos/lista_documento/'.$row['id'].'">Documentos</a>
									</li>
									<li>
										<a href="'.site_url("admin").'/pas/update/'.$row['id'].'" >Ver & editar</a>
									</li>
								  </ul>
						  	</div>
							<button href="#myModal"  type="button" class="btn btn-danger" aria-label="Deletar" data-toggle="modal" onclick="open_modal('.$row['id'].');" role="group"  >
				              		<span class="glyphicon glyphicon-trash"></span>
				            </button>
                        </div>
	        
	       				</div>';
					echo  '</td>';
					
	              echo "</tr>";
	              }
	                  		
	              ?>      
	            </tbody>
	          </table>
		  </div>
			<div id="myModal" class="modal fade" role="dialog">
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
					    <a id ="actionModal" href="" class="btn btn-danger">Deletar</a>
					    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					  </div>
					</div>
			       </div>
			     </div>
			 
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
          <div class="row">
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-warning">
				<div class="panel-heading">
				  <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:drawChart_stock_div2()" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  </div>
	              <h3 class="panel-title">Cronograma Físico</h3>
	            </div>
	            <div class="panel-body" style="height:100%;">
	            	<div id="stock_div1"></div>
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
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="https://js.arcgis.com/3.27/"></script>


<script type="text/javascript"> 
google.load('visualization', '1.0', { packages:['timeline'], language:'br'});
	 google.setOnLoadCallback(drawChart_stock_div2); 

	function drawChart_stock_div2() { 
		
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/pas/get_cronograma_all_lotes/<?php echo $id_contrato; ?>",
            data:{position:'teste'},
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
            	var rowHeight = 3;
            	var data = new google.visualization.DataTable(response.result);
    		    var chartHeight = (data.getNumberOfRows() + 1) * rowHeight;
    		    var numRows = data.getNumberOfRows();
            	var colors = [];
    		    var colorMap = {

    				'Hoje' : 'BLACK',
    	    		    
    		        'Executado': '#cc3300',
    		        'Contratado': '#009933',
    		        'Planejado': '#0077b3',
    		        'Planejado 1': '#fad201',
    		        'Planejado 2': '#005580',
    		        
    		        'Inicio da Execução': '#fad201',
    		        'Protocolo': '#f54021',
    		        'Entregue para Análise': '#cc0605',
    		        'Em Análise': '#a03472',
    		        'Em Revisão': '#308446',
    		        'RACP': '#063971',
    		        'RACD': '#8d948d',
    		        
    		    };
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
    			MarcarHoy('stock_div1',-1);
    			/*
    			google.visualization.events.addListener(
    	    		chart, 
    	    		'select', function() {
    	    			MarcarHoy('stock_div1', -1);
    		 		}
		 		);
		 		*/
    			google.visualization.events.addListener(
        	    		chart,'onmouseover', function() {
        	    			MarcarHoy('stock_div1', numRows);
        		 		} 
        		);

    			google.visualization.events.addListener(
    	    			chart, 'onmouseout', function() {
    			    		MarcarHoy('stock_div1',-1);
    					}
    	    	);
               
            },
            error: function(xhr, status, error) {
                
            }
        });
        
		 
			
	}; 

	function MarcarHoy (div, filas){

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

	
	function open_modal(id){
		$("#actionModal").attr("href", "pas/delete/"+id);
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
		drawChart_stock_div2();
	});

	$("#menu-toggle").click(function(e) {
    	e.preventDefault();
        $("#wrapper").toggleClass("active");
	});

 	$('[data-toggle=offcanvas]').click(function() {
    	$('.row-offcanvas').toggleClass('active');
  	});

 	$(function(){
		  $("table").tablesorter({
		  onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }, 
		    dateFormat: "uk",
		  });
		});


 	/* modal : '#events-modal',*/
	<?php 
	/*
	 
	  http://stackoverflow.com/questions/21872915/vertical-reference-line-in-google-timeline-visualization
	 
 	var options = {
			events_source: "<?php echo base_url(); ?>admin/pas/get_pas_events",
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
		*/
		?>
		
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

		        
		         var url ="https://servicos.dnit.gov.br/dnitgeo/SNV/MapServer/"; 
		        var snv = new ArcGISDynamicMapServiceLayer(url, {
		            id: "DNIT"
		        });
		        map.addLayer(snv);

		        
		        url = "https://servicos.dnit.gov.br/arcgis/rest/services/DNIT_Geo/PAS/MapServer/";
		        snv = new ArcGISDynamicMapServiceLayer(url, {
		            id: "PAS"
		        });
		       // map.addLayer(snv);
		        
		       
		        var info = new InfoMap({ map: map });
	        	
	               	
	        	
	        	
				
		  });


		 

		  
		  
	</script>
	
