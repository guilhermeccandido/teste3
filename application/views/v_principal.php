<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta name="author" content="SiMCosta - FURG">
  <meta name="description" content="Sistema de Monitoramento da Costa Brasileira  - SiMCosta" />
  <meta name="keyWords" content="simcosta, sistema, monitoramento, costa, brasil, boias, oceanografico, meteorologico, buoy, brazil, monitoring, system, brazilian, coast" />  
  <meta name="language" content="pt-br" />
  <meta name="rating" content="general" />  
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="content-language" content="pt-br" />  
  <title><?= $inicialSiteTitulo; ?></title>
  <link rel="icon" href="<?=base_url() ?>images/pagina/simcosta-icon.ico" type="image/ico">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.min.css" />
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.min.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="<?= base_url(); ?>js/modernizr-1.5.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(); ?>js/sceditor/minified/themes/default.min.css" type="text/css" media="all" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/datapicker/jquery-ui-1.10.3.custom.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/sceditor/minified/jquery.sceditor.xhtml.min.js"></script>
  <script src="<?php echo base_url(); ?>js/sceditor/languages/pt-BR.js"></script>    
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB4byziShpFG6cm1nH_BkVI7RGyOdgW5es&sensor=false"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/mapa/mapa.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
		$("#carregando").hide();
		$("#carregando-mapa").hide();	
		$("a.itemMenu").click (function (event) {
			event.preventDefault();
			var menu = $(this).attr("href");
			$.ajax({
				type: "POST",
				url: "inicial",
				data: { opcao: menu },
				success: function(data){

					$("#content").html(data);

					}
				});
			});

		$(document).on( "click", "a.parametro", function(event) {			
			event.preventDefault();									
			var parametro = $(this).attr("href");	
			var boia = $(this).attr("rel");										
			$.ajax({
				type: "GET",
				url: "inicial/graficoInicial",
				data: { parametroLink: parametro, boiaMarcada: boia },
				success: function(data){
					d = new Date();
					if(data == 0){				
						$(".grafico-param").attr("src", "<?= base_url() ?>images/pagina/nao-disponivel.png?"+d.getTime());																		
					
					}
					if(data == 1){				
						$(".grafico-param").attr("src", "http://localhost/simcosta/graficos-gerados/graficoparam.png?"+d.getTime());
						$('#botoes-grafico').show();						
					}
					$("#botao_grafico_8h").attr("href", parametro);
					$("#botao_grafico_7d").attr("href", parametro);
					$("#botao_grafico_30d").attr("href", parametro);
				},
				beforeSend : function(){	
					d = new Date();			
					$(".grafico-param").attr("src", "<?= base_url() ?>images/pagina/loader-bar.gif?"+d.getTime());				
	            },
		        complete : function(){
		        	$( "#carregando" ).hide();
	            }
			});
		});
			
		$(document).on( "click", "a.linknoticia", function(event) {
			event.preventDefault();
			
			var id = $(this).attr("rel");
			$.ajax({
				type: "GET",
				url: "inicial/exibirNoticia",
				data: { idNoticia: id },
				success: function(data){
					
					$("#content").html(data);					
					
					},
				beforeSend : function(){
					$( "#carregando" ).show();
		            },
		        complete : function(){
		        	$( "#carregando" ).hide();
		            }
				});
			});

		$(function() {
		    $( "#data_inicio,#data_fim" ).datepicker({
		    	showOn: "both",
		        changeMonth: true,
		        changeYear: true,
		        showOtherMonths: true,

			    });
		});
		$( document ).ajaxStart(function() {
			$( "#carregando" ).show();
		});
		$( document ).ajaxStop(function() {
			$( "#carregando" ).hide();
		});	
		$(".grafico-param").attr("src", "<?= base_url() ?>images/pagina/brancopixel.png");


		$(document).on( "click", "a.botao_grafico_8h", function(event) {
			event.preventDefault();
			var parametro = $(this).attr("href");
			var boia = $("#boia").val();
			grafico_periodo_parametro(parametro,boia,"8h");
		});

		$(document).on( "click", "a.botao_grafico_7d", function(event) {
			event.preventDefault();
			var parametro = $(this).attr("href");
			var boia = $("#boia").val();
			grafico_periodo_parametro(parametro,boia,"7d");
		});	

		$(document).on( "click", "a.botao_grafico_30d", function(event) {
			event.preventDefault();
			var parametro = $(this).attr("href");
			var boia = $("#boia").val();
			grafico_periodo_parametro(parametro,boia,"30d");
		});		
		
	});	
	
	function grafico_periodo_parametro(sensor,boia,tempo){
		$.ajax({
			type: "POST",
			url: "inicial/graficoMapaSensor",
			data: { parametro: sensor,boiaAtiva: boia,tempoEscolhido: tempo },
			success: function(data){

				d = new Date();
				if(data == 0){				
					$(".grafico-param").attr("src", "<?= base_url() ?>images/pagina/nao-disponivel.png?"+d.getTime());
				
				}
				if(data == 1){				
					$(".grafico-param").attr("src", "http://localhost/simcosta/graficos-gerados/graficoparam.png?"+d.getTime());
				}
			},
			beforeSend : function(){	
				d = new Date();			
				$(".grafico-param").attr("src", "<?= base_url() ?>images/pagina/loader-bar.gif?"+d.getTime());
			},
			complete : function(){
	        	$( "#carregando" ).hide();
            }
		});
	}
  </script>
  
  <!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=9524678; 
var sc_invisible=1; 
var sc_security="1a9f76e9"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web counter"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/9524678/0/1a9f76e9/1/"
alt="web counter"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
  
</head>
<body>
<noscript>
	<h2>Seu navegador não suporta Javascript, é necessário ter o javascript ativado para utilizar este site.</h2>
</noscript> 
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="<?php echo base_url(); ?>inicial?opcao=home">Portal SiMCosta<span class="logo_colour">_beta</span></a></h1>
          <h2><?php echo $inicialSiteSubtitulo; ?></h2>
        </div>
      </div>
      <nav>
        <div id="menu_container">
          <ul class="sf-menu" id="nav">            
            <li><a href="<?php echo base_url(); ?>inicial?opcao=home">SiMCosta</a>
              <ul>              
                <li><a href="projeto" class="itemMenu"><?php echo $inicialMenuProjeto; ?></a></li>
				<li><a href="sobre_dados" class="itemMenu"><?php echo $inicialMenuSobreDados; ?></a>
                  <ul>
                    <li><a href="boia_simcosta" class="itemMenu"><?php echo $inicialMenuBoia?></a></li>
                    <li><a href="maregrafo_simcosta" class="itemMenu"><?php echo $inicialMenuMaregrafos?></a></li>
                    <li><a href="parametros_monitorados" class="itemMenu"><?php echo $inicialMenuParametrosMon; ?></a></li>
                  </ul>
                <li><a href="pmovel" class="itemMenu"><?php echo $inicialMenuMobile; ?></a></li>
                </li>
              </ul>
            </li>
			<li><a href="dados" class="itemMenu"><?php echo $inicialMenuProcessamento; ?></a>
				<ul>
					<li><a href="#" ><?php echo $inicialMenuDados; ?></a>
					   <ul>
					   	   <li><a href="dadosteste" class="itemMenu"><?php echo $inicialOceanograficos; ?></a></li>
					       <li><a href="dados" class="itemMenu"><?php echo $inicialMeteorologicos; ?></a></li>
					       <li><a href="medias" class="itemMenu"><?php echo $inicialDadosMedios; ?></a></li>
					       <li><a href="calibracao" class="itemMenu"><?php echo $inicialConfiguracoes; ?></a></li>
					   </ul>
					</li>
					<li>
					   <a href="#"><?php echo $inicialGraficos; ?></a>
    					   <ul>
    					       <li><a href="graficosusuario" class="itemMenu"><?php echo $inicialBoiaParametro; ?></a></li>
    					       <li><a href="graficointervalo" class="itemMenu"><?php echo $inicialGraficoPeriodo; ?></a></li>    					       
    					   </ul>
    			    </li>
					<li><a href="../service" target=_blank>Webservice</a></li>					
				</ul>
			</li>
			<li><a href="../forum" target=_blank><?php echo $inicialMenuforum; ?></a></li>

			<?php if($this->session->userdata('tipo') == 4){ ?>
				<li><a href="#">Administração</a>
					<ul>						
						<li><a href="#">Boias</a>
						  <ul>
						      <li><a href="editarBoias" class="itemMenu">Editar Boias</a></li>						      
						      <li><a href="formConfig" class="itemMenu">Configurar Boia</a></li>						      
						  </ul>
						</li>
						<li><a href="#">Sistema</a>
						  <ul>
						      <li><a href="estatistica-sistema" class="itemMenu">Estatísticas</a></li>
						  </ul>
						</li>
												
					</ul>
				</li>
			<?php } ?>
			
			<?php if($this->session->userdata('tipo') == 5){ ?>
				<li><a href="#">Administração</a>
					<ul>						
						<li><a href="#">Dados</a>
						  <ul>
						      <li><a href="#">Meteorológicos</a>
    						      <ul>
    						          <li><a href="relatorioBrutosMet" class="itemMenu">Listagem - Brutos</a></li>
    						          <li><a href="relatorioMet" class="itemMenu">Listagem - Decodificados</a></li>
    						          <li><a href="submeterDadosMeteorologicos" class="itemMenu">Upload Dados</a></li>
    						      </ul>
						      </li>						      
						  </ul>
						</li>
						
					</ul>
				</li>
			<?php } ?>				
			
			<?php if($this->session->userdata('tipo') == 999){ ?>
				<li><a href="#">Administração</a>
					<ul>
						<li><a href="#">Usuários</a>
						  <ul>
						      <a href="listarEquipes" class="itemMenu">Listar Usuários</a></li>
						      <a href="editarUsuarios" class="itemMenu">Editar Usuários</a></li>
						  </ul>	
						</li>				      
						<li><a href="editarPaginas" class="itemMenu">Editar Páginas</a></li>
						<li><a href="#">Notícias</a>
						  <ul>
						      <li><a href="formInserirNoticia"  class="itemMenu">Inserir Notícia</a></li>
						      <li><a href="formeditarNoticiaBoia" class="itemMenu">Editar Notícia</a></li>						      
						  </ul>
						</li>
						
						<li><a href="#">Boias</a>
						  <ul>
						      <li><a href="editarBoias" class="itemMenu">Editar Boias</a></li>
						      <li><a href="formInserirBoia" class="itemMenu">Inserir Boia</a></li>
						      <li><a href="formConfig" class="itemMenu">Configurar Boia</a></li>
						      <li><a href="#">Arquivos de Calibrações</a>
								<ul>
									<li><a href="formInserirCalibracao" class="itemMenu">Inserir Texto</a></li>
									<li><a href="editarCalibracao" class="itemMenu">Editar Texto</a></li>						      						      
								</ul>
							  </li>
						  </ul>
						</li>
						
						<li><a href="#" class="itemMenu">Sensores</a>
						 <ul>
						      <li><a href="editarParametros" class="itemMenu">Editar Sensores</a></li>
						      <li><a href="formInserirParametro" class="itemMenu">Inserir Sensor</a></li>
						      <li><a href="formParametroBoia" class="itemMenu">Ativar/Desativar Sensor</a></li>
						  </ul>
						</li>
						
						<li><a href="#">Sistema</a>
						  <ul>
						      <li><a href="estatistica-sistema" class="itemMenu">Estatísticas</a></li>
						      <li><a href="relatorios" class="itemMenu">Logs</a></li>
						  </ul>
						</li>
						
						<li><a href="#">Dados</a>
						  <ul>
						      <li><a href="#">Meteorológicos</a>
    						      <ul>
    						          <li><a href="relatorioBrutosMet" class="itemMenu">Listagem - Brutos</a></li>
    						          <li><a href="relatorioMet" class="itemMenu">Listagem - Decodificados</a></li>
    						          <li><a href="submeterDadosMeteorologicos" class="itemMenu">Upload Dados</a></li>
    						      </ul>
						      </li>						      
						  </ul>
						</li>
						
					</ul>
				</li>
			<?php } ?>			
			<li><a href="equipe" class="itemMenu"><?php echo $inicialMenuEquipe; ?></a></li>
            <li><a href="links" class="itemMenu">Links</a></li>
            <li><a href="contato" class="itemMenu"><?php echo $inicialMenuContato; ?></a></li>            
          </ul>	
        </div>               
      </nav>      
   					
    </header>
    
        <div class="login">

			<?php if(!$this->session->userdata('logged_in')){ ?>				
				<form name="form_login" id="form_login" method="post" action="<?php echo base_url(); ?>inicial/login">							
					<input type="text" name="login" size="3" value="<?php echo (!empty($username)) ? $username : $inicialInputNomeUsuario; ?>" />					
					<input type="password" name="senha" size="2" value="<?php echo (!empty($passwd)) ? $passwd : 'xxxxxxxx'; ?>" />       
									
                        <input class="submit" type="submit" name="name" value="Entrar" /> <br />						
						<a href="formRegistroUsuario" class="itemMenu"><?php echo $inicialLinkRegistrar; ?></a>				
						<a href="formResetSenha" class="itemMenu"><?php echo $inicialNovaSenha; ?></a>						    
					       
		   		</form>
		   	<?php } ?>
		   	<?php echo $this->session->flashdata('erroLogin'); ?>
			<?php if( $this->session->userdata('logged_in') ){ echo $this->session->userdata('nome'); ?>
				<br />
				<a href="editarUsuario" class="itemMenu"><?php echo $inicialLinkAlterar; ?></a> | 
				<a href="<?php echo base_url(); ?>inicial/logout"><?php echo $inicialLinkSair; ?></a>
			<?php } ?>
					
		</div>
            
    <div id="site_content">     
      <div id="content">  
		<div id="map-canvas">						
		</div>		
		<div id="carregando-mapa"><img alt="loading" src="<?php echo base_url(); ?>images/pagina/loader-bar-vert.gif" /></div>		  
        <div id="explanacao-mapa"><?php echo $inicialConteudoGmaps; ?></div>	 		       
        <div id="carregando"><img alt="loading" src="<?php echo base_url(); ?>images/pagina/loading.gif" width="90" /></div>
                                               		
        <br />
        <div class="noticias">
          <h3><?php echo $inicialNoticias; ?></h3>
          <?php foreach($noticias as $noticia){
            echo '<h4>'.$noticia['titulo'].'</h4>';
            echo '<h5>'.$noticia['data_formatada'].'</h5>';
            echo $noticia['resumo'];
            if(strlen($noticia['url']) <= 7) echo '<a href="noticia/'.$noticia['id_noticia'].'" class="linknoticia" rel="'.$noticia['id_noticia'].'">Ver notícia completa</a><br /><br />';
            if(strlen($noticia['url']) > 8) echo '<a href="'.$noticia['url'].'" target="_blank">Ver notícia completa</a><br /><br />';
          }          
          ?>          			
          <a href="noticias" class="itemMenu">Mais Notícias</a>
        </div> 
        <div id="map-legend"></div>	
         
      </div>
    </div>
    <div id="scroll">
      <a title="<?php echo $inicialLinkVoltarTopo; ?>" class="top" href="#"><img src="<?php echo base_url(); ?>images/pagina/top.png" alt="top" /></a>
    </div>
    <footer>
    
        <p>        
            <a href="<?php echo base_url(); ?>"><?php echo $inicialLinkInicio; ?></a>&nbsp;&nbsp;
            <a href="<?php echo base_url(); ?>mobile"><?php echo $inicialLinkMobile; ?></a>&nbsp;&nbsp;
            <a href="contato" class="itemMenu"><?php echo $inicialLinkFaleConosco; ?></a>
             <br /><br /><br />
        </p>
        <p>

            <a href="https://www.mma.gov.br/" target=_blank>
                <img alt="MMA" src="<?php echo base_url(); ?>images/pagina/logo-rodape/mma.png" />
            </a>&nbsp;&nbsp;&nbsp;
            
            <a href="https://www.mma.gov.br/apoio-a-projetos/fundo-nacional-sobre-mudanca-do-clima" target=_blank>
                <img alt="Fundo Clima" src="<?php echo base_url(); ?>images/pagina/logo-rodape/fundo_clima.png"  />
            </a>&nbsp;&nbsp;&nbsp;
            
            <a href="https://www.furg.br" target=_blank>
                <img alt="FURG" src="<?php echo base_url(); ?>images/pagina/logo-rodape/logo_furg.png"  />
            </a>&nbsp;&nbsp;&nbsp;
            
            
            <a href="https://memoria.cnpq.br/programas/inct/_apresentacao/inct_mudancas_climaticas.html" target=_blank>
                <img alt="INCT" src="<?php echo base_url(); ?>images/pagina/logo-rodape/inct-mc.png" />
            </a>&nbsp;&nbsp;&nbsp;
            
            
            <a href="https://redeclima.ccst.inpe.br/" target=_blank>
                <img alt="Rede Clima" src="<?php echo base_url(); ?>images/pagina/logo-rodape/rede-clima.png" />
            </a>&nbsp;&nbsp;&nbsp;
            
            
            <a href="https://www.cnpq.br/" target=_blank>
                <img alt="CNPq" src="<?php echo base_url(); ?>images/pagina/logo-rodape/cnpq.png" />
            </a>&nbsp;&nbsp;&nbsp;
            <br /><br ><br />      
                                                          
        </p>                           
    </footer>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.easing-sooper.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
    });    
  </script>
</body>
</html>
