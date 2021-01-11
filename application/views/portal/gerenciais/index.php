<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">Relatório Gerencial</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url('home'); ?>" class="home">SGPLAN</a></li>
			<li class="current_item">Relatório Gerencial</li>
        </ol>
    </div>
</header>
<?php

	if(isset($link_acessos)){

?>	
        <section id="mind-features">
            <div class="container">
                <div class="row">
                   <div class="col-md-6 col-sm-7">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-9">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('admin/relatorio_gerencial/lista_relatorios') ; ?>">
                               <img alt="" style="width: 360px;" src="<?php echo base_url(); ?>assets/portal/img/historico.png">
                           </a>
                           </div>
                           <div class="item-content">
                               <h3><a href="<?php echo base_url('admin/relatorio_gerencial/lista_relatorios') ; ?>">Relatório Gerencial Histórico</a></h3>
                               <p>Responsável por compilar mensalmente as informações gerenciais da CGPLAN, como resultado é gerado o conteúdo de apresentação do relatório AA4.</p>
                               <a href="<?php echo base_url('admin/relatorio_gerencial/lista_relatorios'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-6 col-sm-7">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-9">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 360px;" src="<?php echo base_url(); ?>assets/portal/img/relatorio-novo.png">
                           </div>
                           <div class="item-content">
                               <h3>Relatório Gerencial Atual</h3>
                               <p>Esta área de gerenciamento dos Relatórios Gerenciais AA4 encontra-se em fase de desenvolvimento, mas nossos colaboradores estão trabalhando arduamente para oferecer um serviço de altíssima qualidade.</p>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                </div>
            </div>
        </section>

<?php } ?>        
           

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<article class="post">
				<div class="panel panel-default">
			    	<div class="panel-body">
			        	<h3 class="post-title">Relatório Gerencial AA4</h3>
			            <div class="row">
			            	<div class="col-lg-4" style="text-align: justify; ">
			                	<img width="300"  src="<?php echo base_url(); ?>assets/portal/img/relatorio.png" alt="pre" class="img-responsive alignleft imageborder size-full  img-responsive" />
			                </div>
		                    	<p class="p-lg" style="text-align: justify; margin: 0 40px 0 20px;">
		                        	O Relatório Gerencial tem por objetivo apresentar o gerenciamento e o controle das demais atividades descritas no Termo de Referência do Contrato 551, prover os recursos necessários para garantir apoio à equipe da CGPLAN/DPP nos procedimentos técnicos, envolvendo ações de o assessoramento no desenvolvimento de mecanismos de gestão para determinação de um planejamento estratégico, procedimentos de gestão dos instrumentos legais (contratos, termos de cooperação, convênios e outros) e o suporte técnico necessário das atividades desenvolvidas no âmbito da CGPLAN.
		                        </p>
		                        <p class="p-lg" style="text-align: justify; margin: 0 40px 0 20px; ">
		                        	Destinado ao acompanhamento das atividades pela Fiscalização do Contrato, devem conter o resultado de todas as atividades desenvolvidas a cada mês, mostrando o andamento dos serviços que foram realizados. O Relatório Gerencial também visa fornecer elementos que permitam uma adequada avaliação do desempenho da empresa em suas obrigações contratuais.
		                        </p>
		                        <p class="p-lg" style="text-align: justify; margin: 0 40px 0 20px;">
		                        Os produtos dessa atividade deverão ser entregues, no máximo, até o quinto dia útil do mês subsequente ao de referência. A frequência de confecção deste Relatório é mensal. Este Relatório é entregue em 1 via em mídia digital - CD ou DVD, junto com os relatórios impressos.
		                        </p>
						</div>
					</div>
				</div>
			</article> <!-- post -->
		</div>
	</div>
</div>
   
   
   
<section>
	<div class="container">
		<div class="row">
			<h1 class="center-title">Atividades/ações de assessoramento</h1>
			<div class="col-md-3">
				
			</div>
			<div class="col-sm-6">
				<ol class="service-list list-unstyled">
					<li>
						Apoio na determinação dos segmentos rodoviários priorizados pela Gerência de Pavimentos.
					</li>
					<li>
						Assessoramento na avaliação dos segmentos rodoviários priorizados pelas demandas da política de transporte.
					</li>
					<li>
						Atualização dos custos econômicos dos veículos e tempo de viagem para entrada do HDM, considerando as 5 regiões brasileiras.
					</li>
					<li>
						Apoio na avaliação de soluções em pavimento rígido aplicáveis aos anos de intervenções.
					</li>
					<li>
						Elaboração de cronograma lógico de execução dos programas de intervenção e apoio na integração das programações de investimentos.
					</li>
					<li>
						Acompanhamento dos estágios de evolução das atividades programadas e desenvolvimento de relatório gerencial de acompanhamento dos programas.
					</li>
					<li>
						Coordenação geral das ações do Assessoramento a CGPLAN/DPP/DNIT e Suporte as auditorias e as demandas dos Órgãos de Controle.
					</li>
					
				</ol>
			</div>
		</div>
	</div>
</section>

?>
