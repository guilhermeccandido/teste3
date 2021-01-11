<!DOCTYPE html>
<html  lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SGPLAN</title>

    <!-- CSS -->
    <link href="<?php echo base_url(); ?>assets/portal/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/portal/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/portal/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/portal/css/lightbox.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/portal/css/style.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/portal/css/color-niceblue.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo base_url(); ?>assets/portal/css/width-full.css" rel="stylesheet" media="screen" title="default">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>assets/portal/js/html5shiv.js"></script>
    <![endif]-->

    
<link rel="alternate" type="application/rss+xml" title="Open Mind &raquo; Home Option 1 Comments Feed" href="<?php echo base_url(); ?>assets/portal/xml/home-option-1.xml" />
<link rel='stylesheet' id='bootstrap-fa-icon-css'  href='<?php echo base_url(); ?>assets/portal/css/font-awesome.min.css?ver=4.1.10' type='text/css' media='all' />
<!--  <link rel='stylesheet' id='ebs_dynamic_css-css'  href='http://razonartificial.com/themes/openmind/wordpress/wp-content/plugins/easy-bootstrap-shortcodes/styles/ebs_dynamic_css.php?ver=4.1.10' type='text/css' media='all' />  -->
<link rel='stylesheet' id='jetpack_css-css'  href='<?php echo base_url(); ?>assets/portal/css/jetpack.css?ver=3.3.3' type='text/css' media='all' />

<script type='text/javascript' src='<?php echo base_url(); ?>assets/portal/js/jquery-1.11.3.js'></script>

<!-- 
<script type='text/javascript' src='http://razonartificial.com/themes/openmind/wordpress/wp-includes/js/jquery/jquery.js?ver=1.11.1'></script>
<script type='text/javascript' src='http://razonartificial.com/themes/openmind/wordpress/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
 -->


<!-- Jetpack Open Graph Tags -->
<meta property="og:type" content="website" />
<meta property="og:title" content="Open Mind" />
<meta property="og:description" content="Clean and elegant theme" />
<meta property="og:url" content="<?php echo base_url(); ?>" />
<meta property="og:site_name" content="Open Mind" />
<meta property="og:image" content="<?php echo base_url(); ?>assets/img/pre3.png" />
<meta property="og:image" content="<?php echo base_url(); ?>assets/img/pre2.png" />
<meta property="og:image" content="<?php echo base_url(); ?>assets/img/au.jpg" />
<meta property="og:image" content="<?php echo base_url(); ?>assets/img/pre.png" />
<meta name="twitter:site" content="@jetpack" />
<meta name="twitter:image" content="<?php echo base_url(); ?>assets/img/pre.png?w=240" />
<meta name="twitter:card" content="summary" />
<style type="text/css" id="syntaxhighlighteranchor"></style>
</head>

<body>

    <!-- Setting Options -->
    <?php 
    /*
    <div id="color-switcher" class="animated fadeIn animation-dalay-10">
        <div id="color-switcher-tab">
            <i class="fa fa-gear fa fa-2x"></i>
        </div>
        <div id="color-switcher-content">
            <h3>Color Selector</h3>
            <a href="#" rel="color-default.css" class="color default">default</a>
            <a href="#" rel="color-niceblue.css" class="color niceblue">niceblue</a>
            <a href="#" rel="color-intenseblue.css" class="color intenseblue">intenseblue</a>
            <a href="#" rel="color-otherblue.css" class="color otherblue">otherblue</a>
            <a href="#" rel="color-blue.css" class="color blue">blue</a>
            <a href="#" rel="color-puregreen.css" class="color puregreen">puregreen</a>
            <a href="#" rel="color-grassgreen.css" class="color grassgreen">grassgreen</a>
            <a href="#" rel="color-green.css" class="color green">green</a>        
            <a href="#" rel="color-olive.css" class="color olive">olive</a>
            <a href="#" rel="color-gold.css" class="color gold">gold</a>
            <a href="#" rel="color-orange.css" class="color orange">orange</a>
            <a href="#" rel="color-pink.css" class="color pink">pink</a>
            <a href="#" rel="color-fuchsia.css" class="color fuchsia">fuchsia</a>
            <a href="#" rel="color-violet.css" class="color violet">violet</a>
            <a href="#" rel="color-red.css" class="color red">red</a>

            <h3>Container Selector</h3>
            <div class="btn-group">
                <button href="#" class="option btn btn-sm btn-primary" rel="width-boxed.css">Boxed</button>
                <button href="#" class="option btn btn-sm btn-primary" rel="width-full.css">Full Width</button>
            </div>
        </div>
    </div>
    */ 
    ?>
    <!-- color-switcher -->

<div class="boxed">

<header id="header" class="hidden-xs">
    <div class="container">
        <div id="header-title">
            <h1 class="animated fadeInDown"><a href="<?php echo base_url().'home'?>">SIGA <span>PLAN</span></a></h1>
            <p class="animated fadeInLeft">Sistema de Gestão do Planejamento</p>
        </div>

        <div id="search-header" class="hidden-xs animated fadeInRight">
            <form class="navbar-search" method="get" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar..." name="s" id="s">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                </div>
                <!-- /input-group -->
            </form>
        </div>
    </div> <!-- container -->
</header> <!-- header -->



<nav class="navbar navbar-static-top navbar-mind" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand visible-xs" href="<?php echo base_url().'home'?>">SIGA <span>PLAN</span></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-mind-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars fa-inverse"></i>
            </button>
        </div>
         
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-mind-collapse">
            <ul id="menu-mainmenu" class="nav navbar-nav">
            	<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
            		<a title="Home" href="<?php echo base_url()."home"?>">Home</a>
            	</li>
            	<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
            		<a title="Notícias" href="<?php echo base_url()."home"?>">Noticias</a>
            	</li>
            	<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
            		<a title="Informações" href="<?php echo base_url()."home"?>">Informações</a>
            	</li>
            	<li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35">
            		<a title="Contatos" href="<?php echo base_url()."home"?>">Contatos</a>
            	</li>
            	<?php
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
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                    <div class="dropdown-menu dropdown-login animated fadeInUp">
                        <form role="form" name="loginform" id="loginform" action="" method="post">
                            <h4 class="section-title">Login Form</h4>
                    
                            <div class="form-group">
                                <div class="input-group login-input">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Username" name="log" id="user_login">
                                </div>
                                <br>
                                <div class="input-group login-input">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Password" name="pwd" id="user_pass">
                                </div>
                                <!-- 
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"  name="rememberme" id="rememberme" value="forever" tabindex="90"> Remember me
                                    </label>
                                </div>
                                 -->
                                <button type="submit" class="btn btn-primary pull-right" name="wp-submit" id="wp-submit">Login</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>      
                    </div>
                </li> <!-- dropdown -->
            </ul> <!-- nav nabvar-nav -->
            
        </div><!-- navbar-collapse -->
    </div> <!-- container -->
</nav> <!-- navbar navbar-default -->
            <section>
            <div id="carousel-example-generic" class="carousel carousel-mind slide" data-ride="carousel" data-interval="5000">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-sm-7">
                                    <div class="carousel-caption">
                                        <div class="carousel-text">
                                           <h1 class="animated fadeInDownBig">Layout Moderno para um Projeto Robusto</h1>
                                           <ul class="list-unstyled carousel-list">
                                               <li class="animated bounceInLeft"><i class="fa fa-code"></i><span>Construido Sob Medida</span></li>
                                               <li class="animated bounceInLeft"><i class="fa fa-html5"></i><span>HTML5 e CSS3</span></li>
                                               <li class="animated bounceInLeft"><i class="fa fa-table"></i><span>Site Responsivo</span></li>
                                           </ul>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-5 hidden-xs carousel-img-wrap">
                                    <div class="carousel-img">
                                        <img src="<?php echo base_url();?>assets/portal/img/pre.png" alt="pre" width="960" height="518" class="aligncenter size-full wp-image-72 img-responsive animated bounceInUp" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-sm-8">
                                    <div class="carousel-caption">
                                        <div class="carousel-text">
                                           <h1 class="animated fadeInDownBig">Desenvolvido para uso de forma intuitiva</h1>
                                           <ul class="list-unstyled carousel-list">
                                               <li class="animated bounceInLeft"><i class="fa fa-eye"></i><span>módulos planejados </span></li>
                                               <li class="animated bounceInLeft"><i class="fa fa-th-large"></i><span>Componentes Customizáveis</span></li>
                                               <li class="animated bounceInLeft"><i class="fa fa-files-o"></i><span>Um portal moderno</span></li>
                                           </ul>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-4 hidden-xs carousel-img-wrap">
                                    <div class="carousel-img">
                                        <img src="<?php echo base_url();?>assets/portal/img/pre2.png" alt="pre" class="aligncenter size-full wp-image-72 img-responsive animated bounceInUp" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 col-sm-9">
                                    <div class="carousel-caption">
                                        <div class="carousel-text">
                                           <h1 class="animated fadeInDownBig">Verão completa em breve</h1>
                                           <ul class="list-unstyled carousel-list">
                                               <li class="animated bounceInLeft"><i class="fa fa-code"></i><span>Atalhos para acesso rápido</span></li>
                                               <li class="animated bounceInLeft"><i class="fa fa-files-o"></i><span>Sistema pronto para o uso</span></li>
                                               <li class="animated bounceInLeft"><i class="fa fa-upload"></i><span>Gerenciamento de dados</span></li>
                                           </ul>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-sm-3 hidden-xs carousel-img-wrap">
                                    <div class="carousel-img">
                                        <img src="<?php echo base_url();?>assets/portal/img/pre3.png" alt="pre" class="aligncenter size-full wp-image-72 img-responsive animated bounceInUp" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </section> <!-- carousel -->

        <section id="mind-features">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6" >
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                           	<img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/anteprojetos.png">
                           </div>
                           <div class="item-content">
                               <h3>ANTEPROJETOS</h3>
                               <p>Lorem ipsum Labore adipisicing nisi magna do nisi pariatur an aliquip eu sed voluptate in dour consequat sunt aute aliquacy ut exercitation minim cupidatat.</p>
                               <a href="#" class="btn btn-success pull-right">Read more</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-3">
                           <div class="item-icon" style=" padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao.png">
                           </div>
                           <div class="item-content">
                               <h3>Gestão de Estudos e Projetos</h3>
                               <p>Lorem ipsum Labore adipisicing nisi magna do nisi pariatur an aliquip eu sed voluptate in dour consequat sunt aute aliquacy ut exercitation minim cupidatat.</p>
                               <a href="#" class="btn btn-success pull-right">Read more</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-6">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos.png">
                           </div>
                           <div class="item-content" >
                               <h3>Gestão de Contratos</h3>
                               <p>Lorem ipsum Labore adipisicing nisi magna do nisi pariatur an aliquip eu sed voluptate in dour consequat sunt aute aliquacy ut exercitation minim cupidatat.</p>
                               <a href="#" class="btn btn-success pull-right">Read more</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-10">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/inventario.png">
                           </div>
                           <div class="item-content">
                               <h3>Lorem ipsum mollit</h3>
                               <p>Lorem ipsum Labore adipisicing nisi magna do nisi pariatur an aliquip eu sed voluptate in dour consequat sunt aute aliquacy ut exercitation minim cupidatat.</p>
                               <a href="#" class="btn btn-success pull-right">Read more</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-9">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorio.png">
                           </div>
                           <div class="item-content">
                               <h3>Lorem ipsum mollit</h3>
                               <p>Lorem ipsum Labore adipisicing nisi magna do nisi pariatur an aliquip eu sed voluptate in dour consequat sunt aute aliquacy ut exercitation minim cupidatat.</p>
                               <a href="#" class="btn btn-success pull-right">Read more</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-2">
                           <div class="item-icon" style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/551.png">
                           </div>
                           <div class="item-content">
                               <h3>Lorem ipsum mollit</h3>
                               <p>Lorem ipsum Labore adipisicing nisi magna do nisi pariatur an aliquip eu sed voluptate in dour consequat sunt aute aliquacy ut exercitation minim cupidatat.</p>
                               <a href="#" class="btn btn-success pull-right">Read more</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                </div>
            </div>
        </section>

        <section class="animated fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="section-title">About us</h2>

                        <img src="<?php echo base_url();?>assets/portal/img/au.jpg" alt="pre" class="img-responsive alignleft imageborder size-full wp-image-72 img-responsive" />
                        <p class="p-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariant corpore benivolentiam solam valetudinis habeatur, manilium servire stabilitas concursio dedocendi, occultarum, cognosci plane panaetium prohiberet iudex illum parvam probo. Invidiae deserere multis argumentum quem. Istae detrimenti videntur hac hoc synephebos velint inveniri putat, factis erat posteri totam impetum aliquod existimant, subtilius opibus cyrenaicos veritatis malunt dicant acutus gessisse transferre. Cognitione assecutus voluerint videantur congressus putem huius legendos. Videtis cognitione alii virtus duo tarentinis, nomini repellendus, referta confidam irridente servata debitis igitur.</p>
                        <p class="p-lg">Domo splendido octavio. Maximasque. Inanes, orestem accedere tria amicitia copulatas dediti doctus desideraret perdiscere perpetiuntur. Attulit praeclara fingitur requietis fieri. Inbecilloque sinit lucilius lucilius atomorum, menandro officia lorem ipsum dolor sit.</p>
                        <div class="alert alert-info">
                            <strong>important info!</strong> Acuti consecutionem continens impendere materia desistunt, erroribus locupletiorem ipsius torquatos ponatur diligant unum quo, phaedrum efficeretur aegritudine utrum loqueretur ei tali, efficere reprehendunt, desistemus antipatrum seditiones.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h2 class="section-title">Our mission</h2>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Collapsible Group Item #1
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                            Collapsible Group Item #2
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                            Collapsible Group Item #3
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </section>    


   <!--  bom design para noticias -->
   <?php
   /* 
    
    <section id="home-blog">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="section-title">Latest post</h2>
                </div>
                <div class="col-md-7">
                    <section class="home-post">
                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/know-the-best-deals-on-getaway-for-the-weekend/" class="thumbnail">
                                                            <img width="727" height="360" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/7-727x360.jpg" class="attachment-, img-responsive wp-post-image" alt="7" />                                                    </a>
                        <h2 class="home-post-title"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/know-the-best-deals-on-getaway-for-the-weekend/">Know the best deals on getaway for the weekend</a></h2>
                        <div class="no-img"><p><img src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/7.jpg" alt="7" width="760" height="405" class="aligncenter img-responsive imageborder size-full wp-image-89" /></p>

<p>Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Quisque id mi. Ut tincidunt tincidunt erat. Etiam feugiat lorem non metus. Vestibulum dapibus nunc ac augue. Curabitur vestibulum aliquam leo. Praesent egestas neque eu enim. In hac habitasse platea dictumst. Fusce a quam. Etiam ut purus mattis mauris sodales aliquam. Curabitur nisi. Quisque malesuada placerat nisl. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus.</p>

<p>Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Vestibulum facilisis, purus nec pulvinar iaculis,&#8230;</div>
                        <div class="row home-post-footer">
                            <div class="col-md-8">
                                <div class="home-post-meta">
                                    <i class="fa fa-clock-o"></i> May 20, 2014 
                                    <i class="fa fa-folder-open"></i> <a href="http://razonartificial.com/themes/openmind/wordpress/category/nature/" rel="category tag">Nature</a>                                    <i class="fa fa-tags"></i><a href="http://razonartificial.com/themes/openmind/wordpress/tag/landscape/" rel="tag">Landscape</a>, <a href="http://razonartificial.com/themes/openmind/wordpress/tag/nature/" rel="tag">Nature</a>, <a href="http://razonartificial.com/themes/openmind/wordpress/tag/weekend/" rel="tag">Weekend</a>                                </div>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="btn btn-primary btn-block">Read more</a>
                            </div>
                        </div>
                    </section>
                </div>
    

<div class="col-md-5">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#nature" data-toggle="tab">Nature</a></li><li><a href="#news" data-toggle="tab">News</a></li><li><a href="#sports" data-toggle="tab">Sports</a></li><li><a href="#travels" data-toggle="tab">Travels</a></li>    </ul>

    <div class="tab-content">
                                                                                    <div class="tab-pane active" id="nature">
                                                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/know-the-best-deals-on-getaway-for-the-weekend/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/7-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="7" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/know-the-best-deals-on-getaway-for-the-weekend/">Know the best deals on getaway for the weekend</a></h4>
                                <p class="no-img">Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-places-to-get-away-to-nature/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/6829124859_2ef9402e85_b-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="6829124859_2ef9402e85_b" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-places-to-get-away-to-nature/">The best places to get away to nature</a></h4>
                                <p class="no-img">Cras id dui. Aenean ut eros et nisl sagittis...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/time-to-go-to-the-forest-relax-in-a-forest-dream/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/yosemite-meadows-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="yosemite-meadows" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/time-to-go-to-the-forest-relax-in-a-forest-dream/">Time to go to the forest, relax in a forest dream</a></h4>
                                <p class="no-img">Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/04/a-first-post-in-category-nature/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/openphotonet_152-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="openphotonet_152" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/04/a-first-post-in-category-nature/">A first post in category nature</a></h4>
                                <p class="no-img">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean...</p>
                            </div>
                        </div>
                                         
                    <a href="http://razonartificial.com/themes/openmind/wordpress/category/nature/" class="btn btn-default pull-right">Read more articles</a>
                    <div class="clearfix"></div>
                                                </div>
                                                                <div class="tab-pane " id="news">
                                                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/gran-canaria-has-the-best-climate-in-the-world-according-to-a-u-s-university/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/2255332986_c00b655dd0_b-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="2255332986_c00b655dd0_b" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/gran-canaria-has-the-best-climate-in-the-world-according-to-a-u-s-university/">Gran Canaria has the best climate according to a U.S. university</a></h4>
                                <p class="no-img">Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/san-francisco-the-city-to-close-big-business/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/2-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="2" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/san-francisco-the-city-to-close-big-business/">San Francisco, the city to close big business</a></h4>
                                <p class="no-img">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/sydney-opera-hosts-the-greatest-show-ever-created/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/5-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="5" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/sydney-opera-hosts-the-greatest-show-ever-created/">Sydney opera hosts the greatest show ever created</a></h4>
                                <p class="no-img">Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/businesses-signed-big-cities/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/1-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="1" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/businesses-signed-big-cities/">The best businesses are signed in big cities.</a></h4>
                                <p class="no-img">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean...</p>
                            </div>
                        </div>
                                         
                    <a href="http://razonartificial.com/themes/openmind/wordpress/category/news/" class="btn btn-default pull-right">Read more articles</a>
                    <div class="clearfix"></div>
                                                </div>
                                                                                    <div class="tab-pane " id="sports">
                                                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-places-for-diving/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/494098132_42137a4d35_b-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="494098132_42137a4d35_b" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-places-for-diving/">The best places for diving</a></h4>
                                <p class="no-img">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/nadal-win-roland-garros/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/3785190850_d1a1534d90_b-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="3785190850_d1a1534d90_b" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/nadal-win-roland-garros/">Rafael Nadal is the winner of Roland Garros</a></h4>
                                <p class="no-img">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/03/the-final-of-the-champions-will-be-for-madrid/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/3659446860_ea180d5868_b-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="3659446860_ea180d5868_b" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/03/the-final-of-the-champions-will-be-for-madrid/">The final of the champions will be for Madrid</a></h4>
                                <p class="no-img">Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id,...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2013/11/sports-at-sea-a-great-choice-for-the-whole-family/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/12119934993_f3f76910c9_b-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="12119934993_f3f76910c9_b" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2013/11/sports-at-sea-a-great-choice-for-the-whole-family/">Sports at sea, a great choice for the whole family</a></h4>
                                <p class="no-img">Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in...</p>
                            </div>
                        </div>
                                         
                    <a href="http://razonartificial.com/themes/openmind/wordpress/category/sports/" class="btn btn-default pull-right">Read more articles</a>
                    <div class="clearfix"></div>
                                                </div>
                                                                                    <div class="tab-pane " id="travels">
                                                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/gran-canaria-has-the-best-climate-in-the-world-according-to-a-u-s-university/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/2255332986_c00b655dd0_b-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="2255332986_c00b655dd0_b" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/gran-canaria-has-the-best-climate-in-the-world-according-to-a-u-s-university/">Gran Canaria has the best climate according to a U.S. university</a></h4>
                                <p class="no-img">Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/sydney-opera-hosts-the-greatest-show-ever-created/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/5-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="5" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/sydney-opera-hosts-the-greatest-show-ever-created/">Sydney opera hosts the greatest show ever created</a></h4>
                                <p class="no-img">Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac,...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/businesses-signed-big-cities/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/1-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="1" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/businesses-signed-big-cities/">The best businesses are signed in big cities.</a></h4>
                                <p class="no-img">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean...</p>
                            </div>
                        </div>
                                            <div class="media">
                            <a class="pull-left" href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-cities-to-visit-this-vacation/">
                                                                    <img width="100" height="100" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/8192703395_1059e26cc2_o-100x100.jpg" class="attachment-, img-responsive wp-post-image" alt="8192703395_1059e26cc2_o" />                                                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-cities-to-visit-this-vacation/">The best cities to visit this vacation</a></h4>
                                <p class="no-img">Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem...</p>
                            </div>
                        </div>
                                         
                    <a href="http://razonartificial.com/themes/openmind/wordpress/category/travels/" class="btn btn-default pull-right">Read more articles</a>
                    <div class="clearfix"></div>
                                                </div>
                                    </div> <!-- tab-content -->
                    
            </div>
        </div>
    </div> <!-- container -->
</section>
*/
?>


    
            <section id="home-works">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="section-title text-center">Recents works</h2>
                    </div>
                            
                        <div class="col-md-4 col-sm-6">
                            <div class="img-caption">
                                                                    <img width="800" height="533" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w2.jpg" class="attachment-, img-responsive wp-post-image" alt="w2" />                                                                <div class="caption">
                                    <div class="caption-content">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/pretty-spring/" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>
                                        <h4>Pretty spring</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-4 col-sm-6">
                            <div class="img-caption">
                                                                    <img width="800" height="533" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w1.jpg" class="attachment-, img-responsive wp-post-image" alt="w1" />                                                                <div class="caption">
                                    <div class="caption-content">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/in-the-sea/" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>
                                        <h4>In the Sea</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-4 col-sm-6">
                            <div class="img-caption">
                                                                    <img width="800" height="533" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w6.jpg" class="attachment-, img-responsive wp-post-image" alt="w6" />                                                                <div class="caption">
                                    <div class="caption-content">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/relaxing-on-the-mountain/" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>
                                        <h4>Relaxing on the mountain</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-4 col-sm-6">
                            <div class="img-caption">
                                                                    <img width="800" height="533" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w5.jpg" class="attachment-, img-responsive wp-post-image" alt="w5" />                                                                <div class="caption">
                                    <div class="caption-content">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/africa-wild/" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>
                                        <h4>Africa Wild</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-4 col-sm-6">
                            <div class="img-caption">
                                                                    <img width="800" height="533" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/2255332986_c00b655dd0_b-800x533.jpg" class="attachment-, img-responsive wp-post-image" alt="2255332986_c00b655dd0_b" />                                                                <div class="caption">
                                    <div class="caption-content">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/maspalomas/" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>
                                        <h4>Maspalomas</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-4 col-sm-6">
                            <div class="img-caption">
                                                                    <img width="800" height="533" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w3.jpg" class="attachment-, img-responsive wp-post-image" alt="w3" />                                                                <div class="caption">
                                    <div class="caption-content">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/summery-camp/" class="animated fadeInDown"><i class="fa fa-search"></i>More info</a>
                                        <h4>summery camp</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    </div> <!-- row -->
            </div> <!-- container -->
        </section>
    
    <div class="container">
    </div>
<?php 
/*
<aside id="footer-widgets">
    <div class="container">
        <div class="row">
            
                <div class="col-md-4">
                    <h3 class="footer-widget-title">Sitemap</h3>
                    <ul id="menu-footer" class="list-unstyled three_cols"><li id="menu-item-80" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-80"><a href="http://razonartificial.com/themes/openmind/wordpress/">Home</a></li>
<li id="menu-item-82" class="menu-item menu-item-type-post_type menu-item-object-page current_page_parent menu-item-82"><a href="http://razonartificial.com/themes/openmind/wordpress/blog/">Blog</a></li>
<li id="menu-item-86" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-86"><a href="http://razonartificial.com/themes/openmind/wordpress/portfolio/">Portfolio</a></li>
<li id="menu-item-207" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-207"><a href="http://razonartificial.com/themes/openmind/wordpress/about-us/">About us</a></li>
<li id="menu-item-211" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-211"><a href="http://razonartificial.com/themes/openmind/wordpress/pricing/">Pricing</a></li>
<li id="menu-item-212" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-212"><a href="http://razonartificial.com/themes/openmind/wordpress/services/">Services</a></li>
<li id="menu-item-87" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-87"><a href="http://razonartificial.com/themes/openmind/wordpress/register/">Register</a></li>
<li id="menu-item-209" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-209"><a href="http://razonartificial.com/themes/openmind/wordpress/faq/">FAQ</a></li>
<li id="menu-item-210" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-210"><a href="http://razonartificial.com/themes/openmind/wordpress/contact/">Contact</a></li>
</ul>                    <h3 class="footer-widget-title">Subscribe</h3>
                    <p>Lorem ipsum Amet fugiat elit nisi anim mollit in labore ut esse Duis ullamco ad dolor veniam velit lorem ipsum dolor sit amet, consectetur adipisicing..</p>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Email Adress">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button">Subscribe</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3 class="footer-widget-title">Recent Post</h3>
                                                <ul class="media-list"><li class="media"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/know-the-best-deals-on-getaway-for-the-weekend/" title="Know the best deals on getaway for the weekend" class="pull-left media-object"><img width="80" height="80" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/7-80x80.jpg" class="attachment-post_list wp-post-image" alt="7" /></a><div class="media-body"><p class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/know-the-best-deals-on-getaway-for-the-weekend/" title="Know the best deals on getaway for the weekend">Know the best deals on getaway for the weekend</a></p><small>May 20, 2014</small></div><li class="media"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-places-to-get-away-to-nature/" title="The best places to get away to nature" class="pull-left media-object"><img width="80" height="80" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/6829124859_2ef9402e85_b-80x80.jpg" class="attachment-post_list wp-post-image" alt="6829124859_2ef9402e85_b" /></a><div class="media-body"><p class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/the-best-places-to-get-away-to-nature/" title="The best places to get away to nature">The best places to get away to nature</a></p><small>May 20, 2014</small></div><li class="media"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/gran-canaria-has-the-best-climate-in-the-world-according-to-a-u-s-university/" title="Gran Canaria has the best climate according to a U.S. university" class="pull-left media-object"><img width="80" height="80" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/2255332986_c00b655dd0_b-80x80.jpg" class="attachment-post_list wp-post-image" alt="2255332986_c00b655dd0_b" /></a><div class="media-body"><p class="media-heading"><a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/gran-canaria-has-the-best-climate-in-the-world-according-to-a-u-s-university/" title="Gran Canaria has the best climate according to a U.S. university">Gran Canaria has the best climate according to a U.S. university</a></p><small>May 20, 2014</small></div></ul>                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3 class="footer-widget-title">Recent Works</h3>
                        <div class="row">
                                                                                                                            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/pretty-spring/" class="thumbnail">
                                                                             <img width="360" height="240" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w2-360x240.jpg" class="attachment-, img-responsive wp-post-image" alt="w2" />                                                                             </a>
                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/in-the-sea/" class="thumbnail">
                                                                             <img width="360" height="240" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w1-360x240.jpg" class="attachment-, img-responsive wp-post-image" alt="w1" />                                                                             </a>
                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/relaxing-on-the-mountain/" class="thumbnail">
                                                                             <img width="360" height="240" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w6-360x240.jpg" class="attachment-, img-responsive wp-post-image" alt="w6" />                                                                             </a>
                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                        <a href="http://razonartificial.com/themes/openmind/wordpress/2014/05/africa-wild/" class="thumbnail">
                                                                             <img width="360" height="240" src="http://razonartificial.com/themes/openmind/wordpress/wp-content/uploads/2014/05/w5-360x240.jpg" class="attachment-, img-responsive wp-post-image" alt="w5" />                                                                             </a>
                                    </div>
                                                                                    </div>
                    </div>
                </div>

                    </div> <!-- row -->
    </div> <!-- container -->
</aside> <!-- footer-widgets -->
*/
?>
<footer id="footer">
    <p>&copy; 2019 <a href="<?php echo base_url(); ?>home/teste">SGPLAN</a></p>
</footer>

</div> <!-- boxed -->

<div id="back-top">
    <a href="#header"><i class="fa fa-chevron-up"></i></a>
</div>

    <!-- Scripts -->
    <!--   
    	<script src="<?php echo base_url(); ?>assets/portal/js/jquery.cookie.js"></script>
    	<script src="<?php echo base_url(); ?>assets/portal/js/jquery.mixitup.min.js"></script>
     -->
    <script src="<?php echo base_url(); ?>assets/portal/js/bootstrap.min.js"></script>    
    <script src="<?php echo base_url(); ?>assets/portal/js/lightbox-2.6.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/portal/js/holder.js"></script>
    <script src="<?php echo base_url(); ?>assets/portal/js/app2.js"></script>
	
<script>
    window.location.refresh()
</script>

</body>

</html>
