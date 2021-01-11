<br />
<br />
<?php



	if(isset($link_acessos)){
		
		foreach($link_acessos as $item){
		
			switch ($item[key($item)]){
		
				case 'cronograma_geral/dashboard' :
					$acessoCronogramaDashboard = $item['acesso'];
					break;
						
				case 'mapeamento/dashboard' :
					$acessoMapeamentoDashboard = $item['acesso'];
					break;
				
			}
			$acessoContratoControle = true;
		}
		

?>	
        <section id="mind-features">
            <div class="container">
                <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInDown animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/calendario-dashboard.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Calendários</h3>
                               <p>
                               	Visão geral dos principais eventos (datas previstas de início e fim de anteprojetos, evtea's, apostilamento/encerramentos de contratos, acompanhamentos das demandas de campo, etc..
                               </p>
                               <?php
                               		if(isset($acessoCronogramaDashboard)){
										echo '<a href="'.base_url().'admin/cronograma_geral/dashboard" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-2">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/graf-dashboard.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Gráficos</h3>
                               <p>Conjunto de vários tipos de gráficos interativos para ser configurado e visualizado dos principais eventos da CGPLAN, demonstrando o avanço de um anteprojeto, desempenho de um contrato, análise de índices, comparações de dados.</p>
                              
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-6">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/indicadores_dashboard.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Indicadores</h3>
                               <p>Ferramenta que auxilia a gestão, permitindo a visualização de indicadores de forma flexível e dinâmica. Permite a gestão dos indicadores, através da criação e acompanhamento de planos de ação específicos.</p>
                               <?php
                               		if(isset($acessoContratosOrcamento)){
										echo '<a href="'.base_url().'admin/contratos/orcamento" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInLeft  animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/mapa-dashboard.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Localização</h3>
                               <p>Compila em um único lugar, todos os levantamentos e estudos por meio de mapas. Os dados são facilmente exportados, além de possuir integração com o VGeo.</p>
								 <?php
                               		if(isset($acessoMapeamentoDashboard)){
										echo '<a href="'.base_url().'admin/mapeamento/dashboard" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                  
                   
                   
            </div>
        </section>

<?php } ?>        



<section class="animated fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="section-title">Dashboard</h2>
                        <p class="p-lg">
                        Painel de Controle com apresentação visual das informações mais importantes e necessárias para se obter uma visão geral das ações da CGPLAN. A base de informações estão consolidadas e ajustadas em uma tela para fácil acompanhamento. 
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="section-title">Propriedades do Dashboard</h2>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
										O QUE É:
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>
                                        O Dashboard é construído para que os gestores possam ter acesso de forma sistemática à informação mais relevante sobre a performance organizacional da sua instituição, ou seja, a história da sua atividade. Toda a informação que está guardada nas bases de dados do não serve grande propósito se não soubermos como a devemos apresentar aos respectivos decisores da instituição. No essencial, por detrás desta informação está uma história que importa ser contada.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                            PARA QUE SERVE:
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                       <p>
                                       O Dashboard não é mais do que um report que irá auxiliar os responsáveis de uma organização, de uma área, de uma unidade orgânica ou simplesmente de um projeto na tomada de decisões de gestão. Numa mesma organização podem coabitar diferentes dashboards aplicados em diferentes níveis da instituição. O dashboard deve ser implementado sempre que exista a necessidade de monitorizar a performance da organização. É seguramente um instrumento privilegiado para a comunicação dos principais números/resultados/performance da atividade organizacional.
                                       </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                                        	SIGNIFICADO DE DASHBOARD:
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                        O significado de Dashboard pode ser traduzido para painel de informação. É essencialmente um instrumento de gestão para a monitorização que tem por objetivo servir os gestores e/ou demais colaboradores, na visualização e análise da informação crítica (KPI - Key Performance Indicators), de modo a sustentar a tomada de decisão. 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </section> 
   
<section>
	<div class="container">
		<div class="row">
			<h1 class="center-title">Atividades/ações de assessoramento</h1>
			<div class="col-md-3">
				
			</div>
			<div class="col-sm-6">
				<ol class="service-list list-unstyled">
					<li>
						É um essencialmente um instrumento de apoio à decisão.
					</li>
					<br>
					<li>
						Expõe rapidamente os principais indicadores de um contrato, programa, setorial, etc..
					</li>
					<li>
						Apresentação da informação numa única tela.
					</li>
					<br>
					<li>
						Possui uma apresentação gráfica simples, objetiva mas também elegante.
					</li>
					<br>
					<li>
						Utiliza técnicas de design de modo a reduzir o "lixo visual" e para dar maior eficácia na transmissão da informação/mensagem.
					</li>
					<li>
						Combina diferentes variáveis sobre diferentes perspectivas de modo a expor relações que seriam difíceis de identificar analisando os mesmo dados em separado.
					</li>
					<li>
						Permite a interação entre o analista e os dados de (ex: customizar, segmentar, selecionar, aprofundar, etc..).
					</li>
				</ol>
			</div>
		</div>
	</div>
</section>

?>
