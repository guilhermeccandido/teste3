<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">Relatórios Físicos</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url('home'); ?>" class="home">SGPLAN</a></li>
			<li class="home"><a title="SGPLAN" href="<?php echo base_url('gestao_estudos_projetos');?>" class="home">Gestão de Estudos e Projetos</a></li>
			<li class="current_item">Relatórios Físicos</li>
        </ol>
    </div>
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

?>	
        <section id="mind-features">
            <div class="container">
               <ol class="breadcrumb">
		        <li>
		          <a href="<?php echo site_url("home"); ?>">
		            <?php echo ucfirst("home");?>
		          </a>
		        </li>
		         <li>
		          <a href="<?php echo base_url() .'gestao_estudos_projetos'; ?>">
		            <?php echo ucfirst('Gestão de Estudos e Projetos');?>
		          </a>
		        </li> 
				<li class="active">
		            Relatórios Físicos
		        </li>
		      </ol>
                <div class="row">
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/relatorio_medicoes_periodo'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/relatorio_medicoes_periodo'); ?>">Produtos Aprovados</a></h3>
                               <p>
                               Apresenta os produtos aprovados no decorrer do mês possíveis de serem Medidos.
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/relatorio_medicoes_periodo'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/relatorio_tempo_movimentos_produtos'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/relatorio_tempo_movimentos_produtos'); ?>">Tempo de Movimentações</a></h3>
                               <p>
                               Apresenta o tempo para cada movimentação de cada protudo em todos os Lotes.
                               </p>
                                 <a href="<?php echo base_url('pas_relatorios/relatorio_tempo_movimentos_produtos'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-2">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/relatorio_trechos_lote'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/relatorio_trechos_lote'); ?>">Trechos por Lote</a></h3>
                               <p>
                                Apresenta a lista de trechos de todos os Lotes.
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/relatorio_trechos_lote'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/relatorio_resumo'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/relatorio_resumo'); ?>">Andamento EVTEAS</a></h3>
                               <p>
                               Relatório que apresenta o andamento dos lotes dos EVTEAS um a um. 
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/relatorio_resumo'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/relatorio_andamento_trecho'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/relatorio_andamento_trecho'); ?>">Andamento no Trecho EVTEAS</a></h3>
                               <p>
                               Relatório que apresenta o andamento dos lotes dos EVTEAS com seus respectivos trechos. 
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/relatorio_andamento_trecho'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-3">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/relatorio_planejado_executado'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/relatorio_planejado_executado'); ?>">Planejado/Executado</a></h3>
                               <p>
                               Relatório que apresenta as datas de Planejamento e Execução dos Produtos dos lotes. 
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/relatorio_planejado_executado'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-6">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/historico_completo_movimentacoes'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/historico_completo_movimentacoes'); ?>">Histórico de Movimentações Completo</a></h3>
                               <p>
                               Relatório que apresenta o histórico de todos os Movimentos de todos os produtos de todos os lotes de todos os Contratos
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/historico_completo_movimentacoes'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>

                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-6">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/fiscalizacao_mensal'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/fiscalizacao_mensal'); ?>">Relatório de Fiscalização Mensal</a></h3>
                               <p>
                               Relatório apresenta o último movimento de todos os produtos de todos os lotes contratados.
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/fiscalizacao_mensal'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                </div>
            </div>
        </section>

<?php } ?>        
           



