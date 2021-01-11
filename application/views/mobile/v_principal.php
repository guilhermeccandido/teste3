<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title></title>  
  <meta name="author" content="SiMCosta - FURG"> 
  <meta name="description" content="Movel - SiMCosta" />
  <meta name="keywords" content="movel,mobile, simcosta, sistema, monitoramento, costa, brasileira, boias" />
  <meta name="language" content="pt-br" />
  <meta name="rating" content="general" />
  <meta http-equiv="content-language" content="pt-br, en-US" />
  <meta name="language" content="pt-br" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/mobile-themes/tema.min.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />  
  
  <!-- jQuery and jQuery Mobile -->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

</head>
<body>
<!-- Home -->
<div data-role="page" id="page1" data-theme="a">
    <div data-theme="a" data-role="header">
        <h3>
            SiMCosta Mobile
        </h3>
    </div>
    <div data-role="content" data-theme="a">    
        <h2 class="tituloPrincipal">
            Sistema de Monitoramento da Costa Brasileira
        </h2>
      <div data-role="collapsible-set">
            <div data-role="collapsible">
				<h3>
				Projeto
				</h3>
				<p>
				 O projeto SiMCosta - Sistema de Monitoramento da Costa Brasileira visa a implantação e manutenção de uma rede de monitoramento em fluxo contínuo de variáveis oceanográficas e meteorológicas ao longo da costa brasileira. O SiMCosta visa, em médio prazo, atender toda a região costeira ao longo do território brasileiro. Na fase inicial, atenderá aos estados do RS, SC, PR e SP (região sul-sudeste). Para mais informações acesse o SiMCosta para navegadores em  <a href=<?=base_url()?>"/portal/inicial?opcao=home" data-transition="none" rel="external"><?=$this->config->item['base_simcosta']?></a>
				</p>
			</div>
		</div>


      <div data-role="collapsible-set">
            <div data-role="collapsible">
				<h3>
				Parâmetros
				</h3>
				<p>
				 Na seção de Monitoramento, são disponibilizadas as boias que estão sendo monitoradas no momento. Os parâmetros que estas verificam são:
				</p>
			  <table>
				  <tr><th>Metereológicos</th></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/Temperatura" target=_blank>Temperatura</a></td></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/Vento" target=_blank>Direção do Vento</a></td></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/Vento#Medi.C3.A7.C3.A3o_da_velocidade" target=_blank>Velocidade do Vento</a></td></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/Press%C3%A3o_atmosf%C3%A9rica" target=_blank>Pressão Atmosférica</a></td></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/Precipita%C3%A7%C3%A3o_%28meteorologia%29" target=_blank>Precipitação Pluviométrica</a></td></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/CO2" target=_blank>Concentração de CO<sub>2</sub></a></td></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/Radia%C3%A7%C3%A3o_solar" target=_blank>Radiação Solar</a></td></tr>
				  <tr><td><a href="http://pt.wikipedia.org/wiki/Umidade_relativa_do_ar#Umidade_relativa" target=_blank>Umidade Relativa do Ar</a></td></tr>
			</table>
			<table >
				  <tr><th>Oceanográficos</th></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Temperatura_da_superf%C3%ADcie_do_mar" target=_blank>Temperatura da Água</a></td></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Turbidez" target=_blank>Turbidez</a></td></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Salinidade" target=_blank>Salinidade</a></td></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Hidrost%C3%A1tica" target=_blank>Profundidade (Pressão)</a></td></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Polui%C3%A7%C3%A3o_da_%C3%A1gua#Hip.C3.B3xia" target=_blank>O<sub>2</sub> Dissolvido</a></td></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Ciclo_do_nitrog%C3%AAnio" target=_blank>Concentração de Nitrato Dissolvido</a></td></tr>
				  <tr><td><a href="https://en.wikipedia.org/wiki/Colored_dissolved_organic_matter" target=_blank>CDOM</a></td></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Fitopl%C3%A2ncton" target=_blank>Concentração de Clorofila-a</a></td></tr>
				  <tr><td><a href="https://pt.wikipedia.org/wiki/Luz" target=_blank>Retroespalhammento de Luz</a></td></tr>
				  <tr><td><a href="https://www.nortekbrasil.com/br/produtos/sistemas-de-ondas/awac" target=_blank>Perfis de Correntes e Altura de Ondas - AWAC</a></td></tr>
			</table>
			</div>
		</div>

		<ul data-role="listview" data-divider-theme="a" data-inset="true">
			<li data-role="list-divider" role="heading">
				Monitoramento
			</li>
			<li data-theme="a">
				<a href="mobile/boias/rs" data-transition="slide">
				    Boia - RS
				</a>
			</li>
			<li data-theme="a">
				<a href="mobile/boias/sc" data-transition="slide">
				    Boia - SC
				</a>
			</li>
			<li data-theme="a">
				<a href="mobile/boias/pr" data-transition="slide">
				    Boia - PR
				</a>
			</li>
			<li data-theme="a">
				<a href="mobile/boias/pr-2" data-transition="slide">
				    Boia - PR2 (UFPR)
				</a>
			</li>
			<li data-theme="a">
				<a href="mobile/boias/sp" data-transition="slide">
				    Boia - SP
				</a>
			</li>
		</ul>
        
        <div data-role="collapsible" data-mini="true">
            <h4>Acesso Administrativo</h4>
            <form name="acesso" action="<?php echo base_url(); ?>mobile/login" method="post" data-ajax="true">
                <label for="login">Login:</label>
                <input type="text" name="login" id="login" data-mini="true" />
                <label for="pass">Senha:</label>
                <input type="password" name="pass" id="pass" data-mini="true" />
                <input type="submit" name="acessar" value="Acessar" data-mini="true" />
            </form>
        </div>
        
    </div>
</div>
</body>
</html>
