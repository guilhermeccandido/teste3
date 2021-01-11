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
<header class="wrap-title">
	<div class="container">
    	<h1 class="page-title">Configurações Gerais EVTEAs</h1>
		<ol class="breadcrumb">
			<li class="home"><a title="SGPLAN" href="<?php echo base_url(); ?>home" class="home">SGPLAN</a></li>
			<li class="home"><a title="Configurações Gerais" href="<?php echo base_url(); ?>configuracao_geral" class="configuracao_geral">Configurações Gerais</a></li>
			<li class="current_item">EVTEAs</li>
		</ol>
	</div>
</header>
        <section id="mind-features">
            <div class="container">
                <div class="row">
                   <!--  configurações  -->
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('admin/fases'); ?>" >Atividades/Produtos</a></h3>
                               <p>
                               Configuração de Atividades/Produtos possíveis de serem relacionados aos EVTEAS.
                               </p>
                               <a href="<?php echo base_url('admin/fases'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('admin/status'); ?>">Status</a></h3>
                               <p>
                               Configuração de Status possíveis de serem relacionados aos EVTEAS, com definição de pesos e tipos de status.
                               </p>
                               <a href="<?php echo base_url('admin/status'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('admin/avaliacoes'); ?>">Avaliações</a></h3>
                               <p>
                               	Configuração de Avaliações possíveis de serem relacionados ao EVTEAS, com definição de pesos.
                               </p>
                               <a href="<?php echo base_url('admin/avaliacoes'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('admin/prioridades') ; ?>">Prioridades</a></h3>
                               <p>
                               	Configuração de Prioridades e pesos.
                               </p>
                               <a href="<?php echo base_url('admin/prioridades'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                
               	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('admin/pas_prazos') ; ?>"> Cronogramas</a></h3>
                               <p>
                               	Configuração de Cronogramas dos EVTEAS.
                               </p>
                               <a href="<?php echo base_url('admin/pas_prazos'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
               <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('admin/local_execucao'); ?>">Locais de Execução</a></h3>
                               <p>
                               	Configuração de Locais de Execução dos EVTEAS.
                               </p>
                               <a href="<?php echo base_url('admin/local_execucao'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
            	</div>
            </div>
        </section>

<?php } ?>        
           



