<div class="container-fluid">		  
	  <div class="row">	  	  
        <div class="main">
	        <ol class="breadcrumb">
		        <li class="active">
		          <?php echo ucfirst($this->uri->segment(1));?>
		        </li>
		      </ol>
		      <div class="page-header users-header">
	    		<h2>
	              <?php echo ucfirst('Anteprojetos');?>
	            </h2>
	          </div>
	          <div class="row">
	        <div class=".col-xs-12 col-sm-10 col-md-8" >
	          <div class="panel panel-default">
				<div class="panel-heading">
	              <h3 class="panel-title">Detalhes dos Anteprojetos</h3>
                  <span class="pull-right clickable chevron"><i class="glyphicon glyphicon-chevron-up"></i></span>
                  <!--  <span class="pull-right clickable eyes"><i class="glyphicon glyphicon-eye-open"></i></span>  -->
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
	       </div><!-- /.col-sm-4 -->
	       <div class=".col-xs-12 col-sm-10 col-md-4">
	          <div class="panel panel-default">
	            <div class="panel-heading">
	              <h3 class="panel-title">Calendário</h3>
	              <span class="pull-right clickable chevron"><i class="glyphicon glyphicon-chevron-up"></i></span>
	              <!--  <span class="pull-right clickable eyes"><i class="glyphicon glyphicon-eye-open"></i></span>  -->
	              
	              <div class="pull-right form-inline" style="margin: -26px 20px 0 0;">
					<div class="btn-group">
						<button class="btn btn-primary prev" data-calendar-nav="prev"><< Anterios</button>
						<button class="btn btn-default today" data-calendar-nav="today">Hoje</button>
						<button class="btn btn-primary next" data-calendar-nav="next">Próximo >></button>
					</div>
					<div class="btn-group">
						<button class="btn btn-warning year" data-calendar-view="year">Ano</button>
						<button class="btn btn-warning month active" data-calendar-view="month">Mês</button>
						<button class="btn btn-warning week" data-calendar-view="week">Semana</button>
						<button class="btn btn-warning day" data-calendar-view="day">Dia</button>
					</div>
				</div>    
	            </div>
	            <div class="panel-body">
	            	<div id="datetimepicker12"></div>
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
	          
	          
	          
	          
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_anteprojetos = array();
	            $options_anteprojetos['id'] = 'Ordem de Criação';
	            $options_anteprojetos['rodovia'] = 'Rodovia';
	            $options_anteprojetos['uf'] = 'UF';
	            $options_anteprojetos['status'] = 'Status';
	            $options_anteprojetos['progresso'] = 'Progresso';         
	            

            echo form_open("anteprojetos/lista_anteprojetos", $attributes);
     
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
				<th class="yellow header headerSortDown" colspan="2" >Intervenção</th>
				<!--<th class="yellow header headerSortDown">Status</th> -->
				
	    	  </tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($anteprojetos as $row)
	              {
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
			        				aria-valuenow="'.$row['progresso'].'" 
			        				aria-valuemin="0" 
			        				aria-valuemax="100" 
			        				style="width: '.$row['progresso'].'%">'.$row['progresso'].'% 
			        			</div>
			      			</div>
            			  </td>';
					echo '<td>'.$row['intervencao'].'</td>';
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
		        		  <a href="'.site_url("anteprojetos").'/visualizar/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Visualizar</a>
		                </td>';
	                echo '</tr>';
	                echo '<tr class="detail-row">';
	                echo '<td colspan="9" >
			        		<div class="action-buttons">
								<table class="table table-striped table-bordered table-condensed">
									<tbody>
						              <tr>
										<td><b>Km Inicial:</b> '.$row['km_inicial'].'</td>
										<td><b>Km Final:</b> '.$row['km_final'].'</td>
										<td><b>Extensão(km):</b> '.$row['extensao'].'</td>
									  </tr>
	              					 <tr>
										<td colspan="3" ><b>Subtrecho:</b> '.$row['subtrecho'].'</td>
									  </tr>
	              					  <tr>
										<td colspan="3">'.$row['observacoes'].'</td>
									  </tr>
									</tbody>
								</table>
                
							</div>
			        		</td>';
	               	echo '</tr>';
	                //'.site_url('admin').'/anteprojetos/delete/'.$row['id'].'
	              }
              		
              ?>      
            </tbody>
          </table>

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


		$('.show-details-btn').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find('.icon').toggleClass('glyphicon-chevron-down').toggleClass('glyphicon-chevron-up');
		});
		

		jQuery(function ($) {

			var calendar = $("#datetimepicker12").calendar({
	            tmpl_path: "<?php echo base_url(); ?>/assets/portal/tmpls/",
	            events_source: function () { return []; },
	            language: 'pt-BR'
	            
	         });

			
	        $('.panel-heading span.clickable.chevron').on("click", function (e) {
	            if ($(this).hasClass('panel-collapsed')) {
	                $(this).parents('.panel').find('.panel-body').slideDown();
	                $(this).removeClass('panel-collapsed');
	                $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	            }
	            else {
	                $(this).parents('.panel').find('.panel-body').slideUp();
	                $(this).addClass('panel-collapsed');
	                $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	            }
	        });
	        
	        $('.panel-heading span.clickable.eyes').on("click", function (e) {
	            if ($(this).hasClass('panel-collapsed')) {
	                $(this).parents('.panel').find('.panel-body').slideDown();
	                $(this).removeClass('panel-collapsed');
	                $(this).find('i').removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
	            }
	            else {
	                $(this).parents('.panel').find('.panel-body').slideUp();
	                $(this).addClass('panel-collapsed');
	                $(this).find('i').removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
	            }
	        });


	        $('.prec').on("click", function (e) {
	             
                $(this).parents('.panel').find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                calendar.view();
	            
	        });

	        $('#first_day').change(function(){
				var value = $(this).val();
				value = value.length ? parseInt(value) : null;
				calendar.setOptions({first_day: value});
				calendar.view();
			});


	        $('#events-in-modal').change(function(){
				var val = $(this).is(':checked') ? $(this).val() : null;
				calendar.setOptions({modal: val});
			});
			$('#format-12-hours').change(function(){
				var val = $(this).is(':checked') ? true : false;
				calendar.setOptions({format12: val});
				calendar.view();
			});
			$('#show_wbn').change(function(){
				var val = $(this).is(':checked') ? true : false;
				calendar.setOptions({display_week_numbers: val});
				calendar.view();
			});
			$('#show_wb').change(function(){
				var val = $(this).is(':checked') ? true : false;
				calendar.setOptions({weekbox: val});
				calendar.view();
			});
			
			$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
				/*
				e.preventDefault();
				e.stopPropagation();
				*/
			});
			
	        
	    });
		
	</script>

<?php 
 	echo $map['js']; 
 ?>
	
	