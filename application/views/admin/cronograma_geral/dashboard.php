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
		        <li class="active">
		          <?php echo ucfirst($this->uri->segment(2));?>
		        </li>
		      </ol>
		      <div class="page-header users-header">
	    		<h2>
	              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
	            </h2>
	          </div>
	    	<h1 class="page-header">
	    		Cronograma Geral Dashboard
	    	</h1>
	    	 <div class="row">
	    	 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		        	<div class="panel panel-success">
		            <div class="panel-heading">
		              <div class="panel-heading-btn">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                  </div>
		              <h3 class="panel-title">Cronogramas Gerais</h3>
		            </div>
		            <div class="panel-body">
					   <div class="row">
					   		<div class="page-header">
						   		<div class="pull-right form-inline">
									<div class="btn-group btn-geral">
										<button class="btn btn-primary prev" data-calendar-nav="prev"> << </button>
										<button class="btn btn-default today" data-calendar-nav="today">Hoje</button>
										<button class="btn btn-primary next" data-calendar-nav="next"> >> </button>
									</div>
									<div class="btn-group btn-geral">
										<button class="btn btn-warning year" data-calendar-view="year">Ano</button>
										<button class="btn btn-warning month active" data-calendar-view="month">Mês</button>
										<button class="btn btn-warning week" data-calendar-view="week">Semana</button>
										<button class="btn btn-warning day" data-calendar-view="day">Dia</button>
									</div>
								</div>
								<div class="geral-h3">
					   				<h3 style="margin-left: 10px;"></h3>
					   			</div>
							</div> 						
					   </div>
					   <div class="row">
					   		<div id="geral"></div>
					   </div>
		            </div>
		          </div>
		       </div><!-- /.col-sm-4 -->
      		 </div>
	    		        
		      <div class="row">
		       <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" >
		        	<div class="panel panel-success">
		            <div class="panel-heading">
		              <div class="panel-heading-btn">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                  </div>
		              <h3 class="panel-title">Anteprojetos</h3>
		            </div>
		            <div class="panel-body">
					   <div class="row">
					   		<div class="page-header">
						   		<div class="pull-right form-inline">
									<div class="btn-group btn-anteprojetos">
										<button class="btn btn-primary prev" data-calendar-nav="prev"> << </button>
										<button class="btn btn-default today" data-calendar-nav="today">Hoje</button>
										<button class="btn btn-primary next" data-calendar-nav="next"> >> </button>
									</div>
									<div class="btn-group btn-anteprojetos">
										<button class="btn btn-warning year" data-calendar-view="year">Ano</button>
										<button class="btn btn-warning month active" data-calendar-view="month">Mês</button>
										<button class="btn btn-warning week" data-calendar-view="week">Semana</button>
										<button class="btn btn-warning day" data-calendar-view="day">Dia</button>
									</div>
								</div>
								<div class="anteprojetos-h3">
					   				<h3 style="margin-left: 10px;"></h3>
					   			</div>
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
					   		<div id="anteprojetos"></div>
					   </div>
		            </div>
		          </div>
		       </div><!-- /.col-sm-4 -->
		       
		       <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" >
		        	<div class="panel panel-success">
		            <div class="panel-heading">
		              <div class="panel-heading-btn">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                  </div>
		              <h3 class="panel-title">PAS-Evtea</h3>
		            </div>
		            <div class="panel-body pas">
					   <div class="row">
					   		<div class="page-header">
						   		<div class="pull-right form-inline">
									<div class="btn-group btn-pas">
										<button class="btn btn-primary prev" data-calendar-nav="prev"> << </button>
										<button class="btn btn-default today" data-calendar-nav="today">Hoje</button>
										<button class="btn btn-primary next" data-calendar-nav="next"> >> </button>
									</div>
									<div class="btn-group btn-pas">
										<button class="btn btn-warning year" data-calendar-view="year">Ano</button>
										<button class="btn btn-warning month active" data-calendar-view="month">Mês</button>
										<button class="btn btn-warning week" data-calendar-view="week">Semana</button>
										<button class="btn btn-warning day" data-calendar-view="day">Dia</button>
									</div>
								</div>
								<div class="pas-h3">
						   			<h3 style="margin-left: 10px;"></h3>
						   		</div>
							</div> 
					   </div>
					   <div class="row">
					   		<div id="pas"></div>
					   </div>
		            </div>
		          </div>
		       </div><!-- /.col-sm-4 -->
		     </div>  
		     
		     
		     <div class="row">
		       <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" >
		        	<div class="panel panel-success">
		            <div class="panel-heading">
		              <div class="panel-heading-btn">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                  </div>
		              <h3 class="panel-title">Contratos</h3>
		            </div>
		            <div class="panel-body contratos">
					   <div class="row">
					   		<div class="page-header">
						   		<div class="pull-right form-inline">
									<div class="btn-group btn-contratos">
										<button class="btn btn-primary prev" data-calendar-nav="prev"> << </button>
										<button class="btn btn-default today" data-calendar-nav="today">Hoje</button>
										<button class="btn btn-primary next" data-calendar-nav="next"> >> </button>
									</div>
									<div class="btn-group btn-contratos">
										<button class="btn btn-warning year" data-calendar-view="year">Ano</button>
										<button class="btn btn-warning month active" data-calendar-view="month">Mês</button>
										<button class="btn btn-warning week" data-calendar-view="week">Semana</button>
										<button class="btn btn-warning day" data-calendar-view="day">Dia</button>
									</div>
								</div>
								<div class="contratos-h3">
						   			<h3 style="margin-left: 10px;"></h3>
						   		</div>
							</div> 
					   </div>
					   <div class="row">
					   		<div id="contratos"></div>
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
		

		$("#menu-toggle").click(function(e) {
        	e.preventDefault();
	        $("#wrapper").toggleClass("active");
		});

		 $('[data-toggle=offcanvas]').click(function() {
		    $('.row-offcanvas').toggleClass('active');
		  });

		 var options_geral = {
					events_source: "<?php echo base_url(); ?>admin/cronograma_geral/allCronogramas",
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
						$('.geral-h3 h3').text(this.getTitle());
						$('.btn-geral button').removeClass('active');
						$('.btn-geral button[data-calendar-view="' + view + '"]').addClass('active');
					},
					classes: {
						months: {
							general: 'label'
						}
					}
				};

		 
		 var options_anteprojetos = {
					events_source: "<?php echo base_url(); ?>admin/anteprojetos/get_anteprojeto_all_events",
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
						$('.anteprojetos-h3 h3').text(this.getTitle());
						$('.btn-anteprojetos button').removeClass('active');
						$('.btn-anteprojetos button[data-calendar-view="' + view + '"]').addClass('active');
					},
					classes: {
						months: {
							general: 'label'
						}
					}
				};

		 var options_pas = {
					events_source: "<?php echo base_url(); ?>admin/pas/get_pas_all_events",
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
						$('.pas-h3 h3').text(this.getTitle());
						$('.btn-pas button').removeClass('active');
						$('.btn-pas button[data-calendar-view="' + view + '"]').addClass('active');
					},
					classes: {
						months: {
							general: 'label'
						}
					}
				};

		 var options_contratos = {
					events_source: "<?php echo base_url(); ?>admin/contratos/get_contrato_all_events",
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
						$('.contratos-h3 h3').text(this.getTitle());
						$('.btn-contratos button').removeClass('active');
						$('.btn-contratos button[data-calendar-view="' + view + '"]').addClass('active');
					},
					classes: {
						months: {
							general: 'label'
						}
					}
				};
		 
		    var calendarGeral = $('#geral').calendar(options_geral);
		 
			var calendarAnteprojetos = $('#anteprojetos').calendar(options_anteprojetos);

			var calendarPas = $('#pas').calendar(options_pas);

			var calendarContratos = $('#contratos').calendar(options_contratos);
			

			$('.btn-geral button[data-calendar-nav]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendarGeral.navigate($this.data('calendar-nav'));
				});
			});

			$('.btn-geral button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendarGeral.view($this.data('calendar-view'));
				});
			});

			$('.btn-anteprojetos button[data-calendar-nav]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendarAnteprojetos.navigate($this.data('calendar-nav'));
				});
			});

			$('.btn-anteprojetos button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendarAnteprojetos.view($this.data('calendar-view'));
				});
			});

			$('.btn-pas button[data-calendar-nav]').each(function() {
				var $this = $(this);
				
				$this.click(function() {
					calendarPas.navigate($this.data('calendar-nav'));
				});
			});

			$('.btn-pas button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendarPas.view($this.data('calendar-view'));
				});
			});


			$('.btn-contratos button[data-calendar-nav]').each(function() {
				var $this = $(this);
				
				$this.click(function() {
					calendarContratos.navigate($this.data('calendar-nav'));
				});
			});

			$('.btn-contratos button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendarContratos.view($this.data('calendar-view'));
				});
			});
			
			
	</script>
