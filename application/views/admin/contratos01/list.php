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
		      <div class="page-header users-header">
	    		<h2>
	              <?php echo ucfirst($this->uri->segment(2));?>
	              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
	            </h2>
	          </div>
	      <div class="row">
	        <div class="col-sm-8" >
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
					
				
	            
	            
	            
	            
	            
				?>
	            </div>
	          </div>
	       </div><!-- /.col-sm-4 -->
	       <div class="col-sm-4">
	          <div class="panel panel-default">
	            <div class="panel-heading">
	              <h3 class="panel-title">Dados</h3>
	              <span class="pull-right clickable chevron"><i class="glyphicon glyphicon-chevron-up"></i></span>
	              <!--  <span class="pull-right clickable eyes"><i class="glyphicon glyphicon-eye-open"></i></span>  -->
	              
	              <div class="pull-right form-inline" style="margin: -26px 20px 0 0;">
					
				</div>    
	            </div>
	            <div class="panel-body">
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
     	padding: 0
     }
     
	 #map_canvas {
	  height: 100%;
	  width: 100%;
	}
	
	
	.row{
        margin-left: -15px;
	   	margin-right: -15px;
	}
}

 * Style tweaks
 * --------------------------------------------------
 */
body {
  padding-top: 50px;
  background-color: #f5f5f5;
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

		/*
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	