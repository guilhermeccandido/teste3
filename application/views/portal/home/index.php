<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">SGPLAN</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url().'home'?>" class="home">SGPLAN</a></li>
        </ol>
    </div>
	<style>
	.col-centered{
    float: none;
    margin: 0 auto;
}
	</style>
</header>
<?php 

if(isset($link_acessos)){
	
	foreach($link_acessos as $item){
	
		switch ($item[key($item)]){
	
			case 'gestao_anteprojetos' :
				$acessoAnteprojetos = $item['acesso'];
				break;
					
			case 'relatorio_gerencial' :
				$acessoRelatori_gerencial = $item['acesso'];
				break;
					
			case 'gestao_estudos_projetos' :
				$acessoEstudos_projetos = $item['acesso'];
				break;
					
			case 'gestao_contratos' :
				$acessoContratos = $item['acesso'];
				break;
					
			case 'gestao_551' :
				$acessoContrato551 = $item['acesso'];
				break;
					
			case 'inventario_dados_tecnicos' :
				$acessoDados_tecnicos = $item['acesso'];
				break;

			case 'dashboard_geral' :
				$acessoDashboard = $item['acesso'];
				break;
				
			case 'configuracao_geral' :
				$acessoConfiguracaoGeral = $item['acesso'];
				break;
		}
	}
		
}


			if(isset($slide_show)){
				
			?>
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
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>Construido Sob Medida</span></li>
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>HTML5 e CSS3</span></li>
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>Site Responsivo</span></li>
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
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>módulos planejados </span></li>
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>Customizável</span></li>
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>Um portal moderno</span></li>
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
	                                           <h1 class="animated fadeInDownBig">Versão completa em breve</h1>
	                                           <ul class="list-unstyled carousel-list">
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>Acesso rápido</span></li>
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>Sistema pronto para o uso</span></li>
	                                               <li class="animated bounceInLeft"><i class="glyphicon glyphicon-menu-right"></i><span>Gerenciamento de dados</span></li>
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
	        <?php 
				}else{
					echo '<br><br>';
				}
	         
	        ?>
<?php

	if(isset($link_acessos)){

?>
        <section id="mind-features">
            <div class="container">
                <div class="row">
                	<!-- 1 -->
                    <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" >
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                          	<a href="<?php echo base_url('admin/gestao_anteprojetos'); ?>">
                           		<img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/anteprojetos.png">
                           	</a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#0b9a00;">
                               <h3><a href="<?php echo base_url().'gestao_anteprojetos/">Gestão de Anteprojetos' ?></a></h3>
                               <p>Apresenta todas as informações acerca de cada anteprojeto que compõe a carteira definida pela CGPLAN. Desde documentos técnicos e processuais, cronogramas localização, etc..</p>
                               <?php
                               		if(isset($acessoAnteprojetos)){
                               			echo '<a href="'.base_url().'gestao_anteprojetos/" class="btn btn-success pull-right">Acesso</a>';	 
                               		} 
                               ?>
                           </div>
                       </article> <!-- mind-features-item -->
                   <!--</div>-->
                   <!-- 1 -->
                   <!-- 2 -->
                   <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-9" >
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('gerenciais'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorio.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#008cba;" >
                               <h3><a href="<?php echo base_url().'gerenciais">Relatório Gerencial AA4';?></a></h3>
                               <p>Responsável por compilar mensalmente as informações gerencias da CGPLAN, como resultado é gerado o conteúdo de apresentação do relatório AA4.</p>
                               <?php
                               		if(isset($acessoRelatori_gerencial)){
										echo '<a href="'.base_url().'gerenciais" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                  <!-- </div>
                   <!-- 2 -->
                   <!-- 3 -->
	
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-3">
                           <div class="item-icon" style=" padding : 0;" >
                           		<a href="<?php echo base_url('admin/gestao_estudos_projetos'); ?>" >
                               		<img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao.png">
                               	</a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#A52A2A;">
                               <h3><a href="<?php echo base_url().'admin/gestao_estudos_projetos'; ?>" >Gestão de Estudos e Projetos</a></h3>
                               <p>De maneira prática, didática e intuitiva é possível obter informações acerca de qualquer rodovia federal no que se refere a estudos, projetos e obras.</p>
                               <?php
                               		if(isset($acessoEstudos_projetos)){
										echo '<a href="'.base_url().'admin/gestao_estudos_projetos" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <!-- 3 -->
                   <?php 
                   /*
                   <!-- 4 -->
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-6">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Gestão de Contratos</h3>
                               <p>Todas as informações relativas a dados contratuais da CGPLAN são apresentadas nesse módulo.</p>
                               <?php
                               		if(isset($acessoContratos)){
										echo '<a href="'.base_url().'gestao_contratos" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <!-- 4 -->
                   <!-- 5 -->
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-10">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/inventario.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#f89e01;">
                               <h3>Inventário de Dados Técnicos</h3>
                               <p>Fonte de consulta para dados de topografia, sondagem, estudo de tráfego, dados funcionais e estruturais do pavimento e cadastros em geral, sejam oriundos da CGPLAN e/ou demais setores do DNIT.</p>
                               <?php
                               		if(isset($acessoDados_tecnicos)){
										echo '<a href="'.base_url().'inventario_dados_tecnicos" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <!-- 5 -->
                   <!-- 6 -->
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-2">
                           <div class="item-icon" style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/551.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#8300ae;" >
                               <h3>551 Contrato 366/2012</h3>
                               <p>Neste módulo são disponibilizadas as informações gerenciáveis do contrato 551, sintetizando os dados de levantamento de campo e os dados dos produtos das ações de assessoramento.</p>
                               <?php
                               		if(isset($acessoContrato551)){
										echo '<a href="'.base_url().'gestao_551" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <!-- 6 -->
                   <!-- 7 -->
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-2">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/dashboard.png">
                           </div>
                           <div class="item-content menu-transparent"  style="background-color:#28364F;"  >
                               <h3>DashBoard Geral</h3>
                               <p>Painel de Controle com apresentação visual das informações mais importantes e necessárias para se obter uma visão geral das ações da CGPLAN.</p>
                               <?php
                               		if(isset($acessoDashboard)){
										echo '<a href="'.base_url().'dashboard_geral" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <!-- 7 -->
                   */
                   ?>
                   <!-- 8 -->
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInDown animation-delay-8">
                           <div class="item-icon"  style="padding : 0;" >
                           		<a href="<?php echo base_url('configuracao_geral');?>">
                               		<img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/config-modulo.png">
                               	</a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#9AE100;">
                               <h3><a href="<?php echo base_url().'configuracao_geral'?>"> Configurações Gerais</a></h3>
                               <p>
As Configurações gerais permitem controlar a exibição de elementos do Sistema. Nesta módulo são feitas algumas configurações básicas do sistema como, por exemplo, o controle de acesso dos usuários.</p>
                               <?php
                               		if(isset($acessoConfiguracaoGeral)){
										echo '<a href="'.base_url().'configuracao_geral" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
				
                   <!-- 8 -->
                   
                </div>
            </div>
        </section>

<?php } ?>        
 <?php

	if(isset($sobre_nos)){

?>
        
        <section class="animated fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="section-title">Sobre o Sistema</h2>

                        <img src="<?php echo base_url();?>assets/portal/img/sobre_sistema.jpg" alt="pre" class="img-responsive alignleft imageborder size-full wp-image-72 img-responsive" />
                        <p class="p-lg">
                        O SGPLAN é um sistema que está sendo desenvolvido pela GERENCIADORA representada pelo Consórcio Dynatest/Engemap para dar suporte e assessoramento à&nbsp; CGPLAN - Coordenação Geral de Planejamento e Programação de Investimento – CGPLAN. 
                        </p>
                        <p class="p-lg">
                        O mesmo é um Sistema via web para apoio à&nbsp; gestão da CGPLAN. Esta ferramenta irá subsidiar a CGPLAN com informações sobre o andamento dos estudos, projetos e intervenções em andamento no DNIT, visando o acompanhamento do ciclo de vida dos empreendimentos. Também será catalogado todos os insumos gerados pela CGPLAN, integrando, sempre que possível, os atuais sistemas em desenvolvimento e em uso. Ainda servirá de apoio ao gestor e o fiscal dos contratos atuais com controle padronizado de demandas.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="section-title">Propriedades</h2>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Utilidades
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <li>
                                       Inventário dos dados existentes sobre a malha rodoviária, disponibilizando os resultados quando possível;
                                       </li> 
                                       <li>
                                       Organização dos diversos estudos, anteprojetos e projetos em desenvolvimento pelo DNIT;
                                       </li>
                                       <li>
                                       Integração das diversas informações existentes nos sistemas atuais para subsidiar tomadas de decisão;
                                       </li>
                                       <li>
                                       Apoio à&nbsp; gestão de demandas e controle dos diversos contratos.
                                       </li>
                                       <li>
                                       Visualização das intervenções em andamento para acompanhamento dos ciclos de vida das ações.
                                       </li>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                            Benefícios
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <li>
                                        Visualização simplificada dos diversos estudos, projetos e intervenções em andamento;
                                        </li>
                                        <li>
                                        Rastreamento dos dados técnicos existentes;
                                        </li>
                                        <li>
                                        Padronização na gestão dos contratos;
                                        </li>
                                        <li>
                                        Visualização espacial das informações (integração com o VGEO).
                                        </li>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                            Características
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <li>
                                        Operado em ambiente Web com interface amigável;
                                        </li>
                                        <li>
                                        Base de dados desenvolvida em HTML5 E CSS3;
                                        </li>
                                        <li>
                                        Telas responsivas.
                                        </li>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed">
                                            Operação
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    	O desenvolvimento do Sistema será dividido em seis módulos principais:
                                        <li>
                                        Anteprojetos;
                                        </li>
                                        <li>
                                        Gestão de Contratos da CGPLAN;
                                        </li>
                                        <li>
                                        Gestão de Estudos e Projetos;
                                        </li>
                                        <li>
                                        Inventário de Dados Técnicos Disponíveis;
                                        </li>
                                        <li>
                                        Relatórios AA4;
                                        </li>
                                        <li>
                                        Contrato 551.
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </section>    


   <!--  bom design para noticias -->
   
   
   <section>
	<div class="container">
		<div class="row">
			<h1 class="center-title">Nosso Produto</h1>
			<div class="col-md-6">
				<img src="<?php echo base_url(); ?>assets/portal/img/bg-devices.png" alt="bg-devices" width="500" height="552" class="aligncenter img-responsive center-block size-full wp-image-157" />
			</div>
			<div class="col-md-6">
				<ol class="service-list list-unstyled">
					<li>
					<b>Acesso de qualquer lugar do mundo através da internet,</b> podendo acompanhar a evolução dos contratos, contato direto com o Consórcio contratado, analisar indicadores, sem precisar estar presente em um local específico para isso.
					</li>					
					<li>
					<b>Multi-Plataforma,</b> onde o Sistema foi desenvolvido, é possível o acesso via qualquer Sistema Operacional (Windows, Linux, Unix, Solaris ou quaisquer outras desde que possuam um navegador web adequado), desde que possuam um navegador web adequado.
					</li>
					<li>
					<b>Mobilidade e Praticidade,</b> construído sob medida para acesso desktop e mobile, com telas responsivas, dessa maneira, não há restrições no acesso via celular (Android e IOS) e/ou tablet.
					</li>					
					<li>
					<b>Desenvolvimento constante,</b> desta maneira o Sistema não precisa ser desenvolvido todo de uma só vez, visto que as atividades foram divididas em módulos, o que fará com que o Sistema esteja sempre acompanhando a necessidade solicitada pelo cliente.
					</li>
					<li>
					<b>Atualização automática do Sistema,</b> no modelo software-como-serviço, os novos recursos e atualizações de versões são incorporados automática e simultaneamente ao Sistema. Isso facilita a utilização dos novos recursos pelos usuários do sistema e permite que os mesmos tenham acesso imediato aos recursos incorporados.
					</li>
				</ol>
			</div>
		</div>
	</div>
</section>
 <?php
} 
 ?>
<?php

	if(isset($para_voce)){
	/*
?>

<section class="back">
	<div class="container">
		<h1 class="center-title">NÓS CRIAMOS PARA VOCÊ </h1>
		<div class="row">
			<div class="col-md-6">
				<div class="icon-item">
					<i class="fa fa-globe"></i>
					<div class="item-content">
						<h3>Conexão web em qualquer plataforma.</h3>
						<p>Desenvolvimento de soluções web para inúmeras necessidades que surgem atualmente para integrar as ações da CGPLAN na web. Acessível em todas as plataformas (desktop, tablet e celular).</p>
					</div>
				</div>
				<div class="icon-item">
					<i class="fa fa-users"></i>
					<div class="item-content">
						<h3>Controle de Acesso de Usuários.</h3>
						<p>Acesso personalizado do Sistema restrito aos usuários cadastrados, baseado em um conjunto de perfis de acesso, na área de abrangência de cada usuário e em um mecanismo de identificação única do usuário. Este controle objetiva prevenir o acesso de indivíduos não autorizados ao Sistema, garantido assim a confidencialidade das informações armazenadas no mesmo.</p>
					</div>
				</div>
				<div class="icon-item">
					<i class="fa fa-thumbs-up"></i>
					<div class="item-content">
						<h3>Sistema com interface amigável.</h3>
						<p>Construído sob medida e de fácil manuseio e aprendizado. Implementação de comandos intuitivos e visual simples. Interfaces em que o usuário se sinta confortável e encorajado a usar.</p>
					</div>
				</div>
				<div class="icon-item">
					<i class="fa fa-sitemap"></i>
					<div class="item-content">
						<h3>Estrutura com módulos independentes.</h3>
						<p>Mais facilidade e rapidez no desenvolvimento do Sistema, ao mesmo tempo em que os módulos se relacionam através de conteúdos inter-relacionados. Além disso, é possível a subdivisão do módulo, permitindo assim a execução de tarefas/atividades bem específicas, bem como o claro reconhecimento pelo usuário da estrutura do Sistema como um todo.</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="icon-item">
					<i class="fa fa-code"></i>
					<div class="item-content">
						<h3>Telas que se adaptam ao dispositivo.</h3>
						<p>Técnica de web design (design responsivo) no qual como o próprio nome já indica, consegue responder ao tamanho da tela para se adequar da melhor forma. Dessa maneira, não há restrições no acesso desktop e mobile.</p>
					</div>
				</div>
				<div class="icon-item">
					<i class="fa fa-lock"></i>
					<div class="item-content">
						<h3>Segurança dos dados com criptografia.</h3>
						<p>Garante a segurança em todo o ambiente computacional que necessite de sigilo em relação às&nbsp; informações. As informações e dados do Sistema são automaticamente criptografados e protegidos contra acesso indevido.</p>
					</div>
				</div>
				<div class="icon-item">
					<i class="fa fa-upload"></i>
					<div class="item-content">
						<h3>Base de informações para download.</h3>
						<p>Disponibilização de dados em formato aberto. Nas bases de dados dos Sistema é possível baixar os dados constantes em cada consulta para fazer os cruzamentos, análises, pesquisas e estudos que desejar.</p>
					</div>
				</div>
				<div class="icon-item">
					<i class="fa fa-signal"></i>
					<div class="item-content">
						<h3>Gráficos dinâmicos e interativos.</h3>
						<p>Os Gráficos Dinâmicos ajudarão a resumir, analisar, explorar e apresentar os dados com eficiência, sendo uma ferramenta  poderosa na análise de dados e no apoio à&nbsp; tomada de decisão. Permitem uma representação gráfica interativa dos dados e ajudam você a ver comparações, padrões e tendências.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>





<?php 
*/
}
?>
