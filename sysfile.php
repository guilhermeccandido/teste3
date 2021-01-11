<?php
define('SIMCOSTA',str_replace(array( '\desenvolvimento', '/desenvolvimento'), '', dirname(__FILE__) )."/");

define('DADOS', SIMCOSTA."dados/");
	define('DADOSARQ', DADOS."arquivos/");
	define('DADOSPR' , DADOS."PR/");
	
define('FTP', '/Volume_2/boia_bd/720d0037403d8428/');	

define('DATA', SIMCOSTA."data/");
	define('METEO', DATA."meteorologicos/");
	define('OCEAN', DATA."oceanograficos/");
		define('OCEANRAW', OCEAN."raw/");
		define('OCEANORG', OCEAN."organizados/");
		define('OCEANCON', OCEAN."convertidos/");
		/**
		 * Path para arquivos de calibracao
		 */
		define('OCEANCAL', OCEAN."calibracao/");

define('FORMADOR', SIMCOSTA."formadorBaseSimcosta/");
	define('BASEDEDADOS'		, FORMADOR."BaseDeDados/");
	define('PHPMAILER'		, FORMADOR."PHPMailer/");
	define('SIMPLEHTMLDOM'		, FORMADOR."SimpleHtmlDOM/");
	define('SITEMANIPULATION'	, FORMADOR."SiteManipulation/");
	define('DADOSGRAVADOS'		, FORMADOR."dadosGravados/");
	
define('GRAFICOSGERADOS', SIMCOSTA."graficos-gerados/");

define('PORTAL', SIMCOSTA."/");
	define('PORTALFONTS', 	PORTAL."fonts/");
	define('PORTALIMAGES', 	PORTAL."images/");
	define('PORTALJS', 		PORTAL."js/");


?>
