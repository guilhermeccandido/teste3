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

			
	</script>
	
<?php 
 	echo $map['js']; 
 ?>
