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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/portal/css/custom_new.css">
   <div class="container-fluid">		  
	<div class="row">	  	  
		<div class="main"  style="height: 1800px;" >
		  <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("inventario_dados_tecnicos"); ?>">
	            Inventário de Dados Técnicos
	          </a>
	        </li>
	        <li class="active">
	          Clustergram
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
             	Clustergram
             </h2>
          </div>
			 <!-- Required JS Libraries -->
			  <script src="<?php echo base_url(); ?>assets/portal/js/d3.js"></script>
			  <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js"></script> -->
			  
			  <!-- clustergram.js -->
			  <script src='<?php echo base_url(); ?>assets/portal/js/clustergrammer.v1.3.1.js'></script>
			  <script src='<?php echo base_url(); ?>assets/portal/js/load_viz_new.js'></script>
						
		<!-- Wrap all page content here -->
		  <div id="wrap" class='toggled'>
		
		      <!-- main container - required --> 
		      <div id='main_container'>	
		      <div class="row">
		      
				<!-- visualization will be put here -->
				  <div id='container-id-1'>
				      <h1 class='wait_message'>Por favor aguarde...</h1>
				  </div>
			   </div>
			</div>	  
		  </div>	  
		</div>
	</div>
</div>
<style>
html {
  /*min-width: 1040px;*/
  max-width: 100%;
  overflow-x: hidden;
  overflow-y: scroll;
}
</style>	
		
<script>
	network_data = <?php echo $jsonData; ?>;

	load_viz_new(network_data);

	$(document).ready(function() {
		App.init();
	});
	
	$(function() {
	    $('#Grid').mixitup();
	});
</script>
			