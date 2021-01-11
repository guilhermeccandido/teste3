<!DOCTYPE html> 
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url(); ?>assets/portal/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/portal/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/portal/css/dashboard.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/portal/css/bootstrap.css.map" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/portal/css/calendar.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/portal/css/font-awesome.min.css" rel="stylesheet" media="screen">
  
  <link href="<?php echo base_url(); ?>assets/portal/css/animate.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>assets/portal/css/lightbox.css" rel="stylesheet" media="screen">
   <link href="<?php echo base_url(); ?>assets/portal/css/admin.css" rel="stylesheet" type="text/css">
   <link href="<?php echo base_url(); ?>assets/portal/cleditor1_4_5/jquery.cleditor.css" rel="stylesheet" type="text/css">
   <link href="<?php echo base_url(); ?>assets/portal/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
   
   <link rel="stylesheet" href="https://js.arcgis.com/3.27/esri/css/esri.css" type="text/css">
   <link rel="stylesheet" href="https://js.arcgis.com/3.27/dijit/themes/claro/claro.css">
   
   
   <?php 
		if( file_exists( CSS_FOLDER . 'color-'.$this->uri->segment(2).'.css')){
			echo '<link href="'.base_url().'assets/portal/css/color-'.$this->uri->segment(2).'.css" rel="stylesheet" media="screen" title="default">';		
		}else{
			echo '<link href="'.base_url().'assets/portal/css/color-.css" rel="stylesheet" media="screen" title="default">';
		}	   
   ?>
   
  
  <link href="<?php echo base_url(); ?>assets/portal/css/width-full.css" rel="stylesheet" media="screen" title="default">
  
  <link rel='stylesheet' id='bootstrap-fa-icon-css'  href='<?php echo base_url(); ?>assets/portal/css/font-awesome.min.css?ver=4.1.10' type='text/css' media='all' />
  
  <link href="<?php echo base_url(); ?>assets/portal/css/jquery-ui.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>assets/portal/css/morris.css" rel="stylesheet" media="screen">
  
    
  <!-- 
  <link href="<?php echo base_url(); ?>assets/portal/css/animate.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>assets/portal/css/style2.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>assets/portal/css/responsive2.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>assets/portal/css/default.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>assets/portal/css/pace.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>assets/portal/css/morris.css" rel="stylesheet" media="screen">
   -->
  
  
  
  
  <!--
    
  	
  	<link href="<?php echo base_url(); ?>assets/portal/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
   
   -->
   
  <title>Sistema de Gestão do Planejamento</title>
  <!--  
  	<script src="<?php echo base_url(); ?>assets/portal/js/pace.min.js"></script>
  -->
  
  
  	<script src="<?php echo base_url(); ?>assets/portal/js/jquery-2.1.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/admin.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/jquery.tablesorter.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/jquery.mixitup.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/morris.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/chart-morris.demo.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/raphael.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/chart.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/bootstrap-select.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
	
	<!-- cdn for modernizr, if you haven't included it already -->
	<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
	<!-- polyfiller file to detect and load polyfills -->
	<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
		
	
	<!-- 
	<script src="<?php echo base_url(); ?>assets/portal/js/jquery.cookie.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/raphael.min.js""></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/morris.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/chart-morris.demo.min.js"></script>
	 -->
	 
	 
	<script src="<?php echo base_url(); ?>assets/portal/js/apps.minbk.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/chart-js.demo.min.js"></script>
	
	
	<script src="<?php echo base_url(); ?>assets/portal/js/calendar.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/underscore-min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/jstz.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/language/pt-BR.js"></script>
	
	
	<!--
	<script src="<?php echo base_url(); ?>assets/portal/js/moment-with-locales.js"></script>
	<script src="<?php echo base_url(); ?>assets/portal/js/bootstrap-datetimepicker.js"></script>
	<script src = "https://maps.googleapis.com/maps/api/js?sensor=false"></script> 
	
	-->
    
</head>
<body>

<div class="boxed">
	<header id="header" class="hidden-xs">
	    <div class="container">
	        <div id="header-title">
	            <h1 class="animated fadeInDown"><a href="<?php echo base_url().'home'?>">
	            <b>SGPLAN</b>
	            </a></h1>
	            <p class="animated fadeInLeft">Sistema de Gestão do Planejamento</p>
	        </div>
	    </div> <!-- container -->
	</header> <!-- header -->
	<nav class="navbar navbar-fixed-top navbar-mind" role="navigation">
	    <div class="container">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <a class="navbar-brand visible-xs" href="<?php echo base_url().'home'?>">SG <span>PLAN</span></a>
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-mind-collapse">
	                <span class="sr-only">Toggle navigation</span>
	                <i class="glyphicon glyphicon-menu-hamburger"></i>
	            </button>
	        </div>
	         
	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse navbar-mind-collapse">
	            <ul id="menu-mainmenu" class="nav navbar-nav">
	            	<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
	            		<a title="Home" href="<?php echo base_url()."home"?>">Home</a>
	            	</li>
	            	<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
	            		<a title="Informações" href="<?php echo base_url()."informacoes"?>">Informações</a>
	            	</li>
	            	<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
	            		<a title="Contatos" href="<?php echo base_url()."contatos"?>">Contatos</a>
	            	</li>
	            	<?php
	            	if(isset($link_acessos)){
	            		
		            	echo '<li id="menu-item-26" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-26 dropdown"><a title="Área Administrativa" href="#" data-toggle="dropdown" class="dropdown-toggle">Área Administrativa <span class="caret"></span></a>';
		            	echo '<ul role="menu" class=" dropdown-menu">';
						foreach($link_acessos as $item ){
							if($item[key($item)] == 'relatorio_gerencial'){	
								echo '<li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a title="'. key($item).'" href="'.base_url().'gerenciais ">'. key($item).'</a></li>';
								
							}else if($item[key($item)] == 'gestao_estudos_projetos'){
								echo '<li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a title="'. key($item).'" href="'.base_url().$item[key($item)].' ">'. key($item).'</a></li>';
									
							}else if($item['direct_link'] == 'true'){
								echo '<li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a title="'. key($item).'" href="'.base_url().'admin/'.$item[key($item)].' ">'. key($item).'</a></li>';
								
							}else{
								
							}
							   
							echo '</li>';
								
	            		}
	            		echo '</ul>';
	            		echo '</li>';
	            	}
	            	
	            	/* 
	            	<li id="menu-item-26" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-26 dropdown"><a title="Blog" href="#" data-toggle="dropdown" class="dropdown-toggle">Blog <span class="caret"></span></a>
						<ul role="menu" class=" dropdown-menu">
							<li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a title="Blog" href="http://razonartificial.com/themes/openmind/wordpress/blog/">Blog</a></li>
							<li id="menu-item-38" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-38"><a title="Blog Left Sidebar" href="http://razonartificial.com/themes/openmind/wordpress/blog-left-sidebar/">Blog Left Sidebar</a></li>
							<li id="menu-item-37" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-37"><a title="Blog Full" href="http://razonartificial.com/themes/openmind/wordpress/blog-full/">Blog Full</a></li>
						</ul>
					</li>
					*/
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<?php
					
					if(isset($logout)){
					?>
					
						<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
		            		<a title="Logout" href="<?php echo base_url()."admin/logout_home"?>"><?php echo (isset($nomeUsuario) ? $nomeUsuario." - " : ''); ?>Logout</a>
		            	</li>
		            	
					<?php 	
					}else{
						
	
					?>
						
						<li class="dropdown <?php /* open*/?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" <?php /*aria-expanded="true"*/ ?> >Login</a>
							<div class="dropdown-menu dropdown-login animated fadeInUp">
							<?php
								$attributes = array('id' => 'myform');
								echo form_open('admin/login/validate_credentials_temp', $attributes);
								/*
								 <form role="form" name="loginform" id="loginform" action="admin/login/validate_credentials_temp" method="post">
								*/
								?>
	                            <h4 class="section-title">Login</h4>
	                    
	                            <div class="form-group">
	                                <div class="input-group login-input">
	                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	                                    <input type="text" class="form-control" placeholder="Login" name="login" id="user_login">
	                                </div>
	                                <br>
	                                <div class="input-group login-input">
	                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                                    <input type="password" class="form-control" placeholder="Senha" name="senha" id="user_pass">
	                                </div>
	                                <!-- 
	                                <div class="checkbox">
	                                    <label>
	                                        <input type="checkbox"  name="rememberme" id="rememberme" value="forever" tabindex="90"> Remember me
	                                    </label>
	                                </div>
	                                 -->
	                                <?php 
	                                echo form_submit('submit', 'Login', 'class="btn btn-primary pull-right"');
	      							echo form_close();
	      							?>
	                                <div class="clearfix"></div>
	                                <?php 	
	                                	/*                               
	                                	// Get Flash data on view 
										$message_error = $this->session->flashdata('message_name');
										
		                                if(isset($message_error)){
											if($message_error){
												echo '<div class="alert alert-danger alert-dismissible" role="alert">';
												echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
												echo '<strong>Oh snap!</strong> mude algumas coisas e tente novamente.';
												echo '</div>';	
											}
										}
										*/									
									?>
	                            </div>
	                        </form>      
	                    </div>
	                </li> <!-- dropdown -->
	                <?php 
					}
				
				?>
	            
	               
	            </ul> <!-- nav nabvar-nav -->
	            
	        </div><!-- navbar-collapse -->
	    </div> <!-- container -->
	</nav> <!-- navbar navbar-default -->
</div>

<!-- // fix the firefox and ie incompetence to behave with datetime types -->
<script>
 	 webshims.setOptions('waitReady', false);
 	 webshims.setOptions('forms-ext', {
	  	types: 'date',
	  	widgets: {
			calculateWidth: false
		}

	});
  

	(function(){
		var stateMatches = {
			'true': true,
			'false': false,
			'auto': 'auto'
		};
		var enhanceState = (location.search.match(/enhancelist\=([true|auto|false|nopolyfill]+)/) || ['', 'auto'])[1];

		webshim.ready('jquery', function(){
			$(function () {
				$('.polyfill-type select')
						.val(enhanceState)
						.on('change', function () {
							location.search = 'enhancelist=' + $(this).val();
						});
			});
		});
		webshim.setOptions('forms', {
			customDatalist: stateMatches[enhanceState]
		});
		webshims.activeLang("pt-br");
		webshim.setOptions('forms-ext', {
			replaceUI: stateMatches[enhanceState]
		});

	})();

	webshims.polyfill('forms forms-ext');

  
</script>

<?php /*
	<nav class="navbar navbar-inverse navbar-fixed-top">
	    <div class="container-fluid">
	      <div class="navbar-header">
	    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
	      	<a href="<?php echo base_url(); ?>home" class="navbar-brand">SGPLAN</a>
	       </div>
	       <div id="navbar"  class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
		     	
		     	<?php

		     	 foreach($link_acessos as $item){ ?>
		     		<li class="dropdown">
		     			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo key($item) ?> <b class="caret"></b></a>
		     			<ul class="dropdown-menu">
				           <li>
				              <a href="<?php echo base_url().'admin/'.$item[key($item)] ; ?>"><?php echo key($item) ?></a>
				           </li>
				           <?php
					           if($item['acesso'] == 'editar' AND $item['alias'] == 'anteprojetos'){
									
							?>
									<li>
						              <a href="<?php echo base_url(); ?>admin/acompanhamento_fisico">Acompanhamento Físico</a>
						            </li>
						             <li>
						              <a href="<?php echo base_url(); ?>admin/">Tipos Documentos</a>
						            </li>
						            <!-- 
						              <li>
						              <a href="<?php echo base_url(); ?>admin/localizacao">Localização</a>
						            </li>
						             -->
						             <li>
						              <a href="<?php echo base_url(); ?>admin/anteprojetos_categorias_imagens">Categorias de Imagens</a>
						            </li>
						    <?php 
							    } else if($item['acesso'] == 'editar' AND $item['alias'] == 'relatorio_gerencial'){
							    
				           ?>
									 
						    <?php 
							    } else if($item['alias'] == 'contratos'){
									if($item['acesso'] == 'editar'){
									?>
									<li>
						              <a href="<?php echo base_url(); ?>admin/contratos/controle">Controle Contratos</a>
						            </li>
						             <li>
						              <a href="<?php echo base_url(); ?>admin/coordenacao_geral">Coordenação Geral</a>
						            </li>
						            <li>
						              <a href="<?php echo base_url(); ?>admin/coordenacao_setorial">Coordenação Setorial</a>
						            </li>
						            <li>
						              <a href="<?php echo base_url(); ?>admin/programas">Programas</a>
						            </li>
						            <li>
						              <a href="<?php echo base_url(); ?>admin/intervencao">Intervenções</a>
						            </li>
						            <li>
						              <a href="<?php echo base_url(); ?>admin/empresas">Empresas</a>
						            </li>
									
									<?php 	
									}else{
									?>
									<li>
						              <a href="<?php echo base_url(); ?>admin/contratos/controle">Controle Contratos</a>
						            </li>								
									<?php 
									}
							
				           ?>
									
						    <?php 
							    } else if($item['acesso'] == 'editar' AND $item['alias'] == 'usuarios'){
						
				           ?>
						            <li>
						              <a href="<?php echo base_url(); ?>admin/modulos">Módulos</a>
						            </li>
						    <?php 
							    } else {
							    	
							    }
				           ?>
				        </ul>
				    </li>
		     			
		     	<?php 	
					} 
				?>
		     	
		        <li class="dropdown">
		          <a href="<?php echo base_url(); ?>admin/logout_home">Logout</a>
		          <ul class="dropdown-menu">
		            <li>
		              <a >Logout</a>
		            </li>
		          </ul>
		        </li>	         
		      </ul>
	    	</div>
	    </div>
	</nav>	
*/
?>			
