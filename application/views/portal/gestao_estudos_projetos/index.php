<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">Gestão de Estudos e Projetos</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url().'home'?>" class="home">SGPLAN</a></li>
			<li class="current_item">Gestão de Estudos e Projetos</li>
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
                <div class="row">
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                           	<a href="<?php echo base_url('admin/pas'); ?>" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao_projetos_evteas.png">
                            </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#A52A2A;">
                               <h3><a href="<?php echo base_url('admin/pas'); ?>">EVTEAS</a></h3>
                               <p>
                               Apresenta todas as informações de cada estudo do Plano de Avaliação Socioeconômica e EVTEAS avulsos. Abrangendo documentos técnicos e processuais, cronogramas, detalhamento do estudo, etc..
                               </p>
                               <a href="<?php echo base_url('admin/pas'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInDown animation-delay-3">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('admin/pas/contratos'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao_projetos_evteas.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#A52A2A;">
                               <h3><a href="<?php echo base_url('admin/pas/contratos') ; ?>">CONTRATOS/EVTEAS</a></h3>
                               <p>
                               Apresenta todas as informações de cada estudo do Plano de Avaliação Socioeconômica e EVTEAS avulsos por contrato. Abrange documentos técnicos e processuais, cronogramas, detalhamento do estudo, etc..
                               </p>
                               <a href="<?php echo base_url('admin/pas/contratos') ; ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-2">
                           <div class="item-icon"  style="padding : 0;" >
                           	<a href="<?php echo base_url('admin/registro_financeiro'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/pas_financeiro.jpg">
                            </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#A52A2A;">
                               <h3><a href="<?php echo base_url('admin/registro_financeiro'); ?>">Controle Financeiro</a></h3>
                               <p>Módulo para acompanhamento financeiro dos EVTEAS.</p>
                               <a href="<?php echo base_url('admin/registro_financeiro'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                           	<a href="<?php echo base_url('gestao_estudos_projetos/relatorios'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao_projetos_consultas.png">
                            </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#A52A2A;">
                               <h3><a href="<?php echo base_url('gestao_estudos_projetos/relatorios'); ?>">Relatórios Físicos</a></h3>
                               <p>Módulo para geração de relatórios pré-definidos sobre o andamento dos EVTEAS.</p>
                                 <a href="<?php echo base_url('gestao_estudos_projetos/relatorios'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-2">
                           <div class="item-icon"  style="padding : 0;" >
                           	<a href="<?php echo base_url('gestao_estudos_projetos/relatorios_financeiros'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao_projetos_consultas.png">
                            </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#A52A2A;">
                               <h3><a href="<?php echo base_url('gestao_estudos_projetos/relatorios_financeiros'); ?>">Relatórios Financeiros</a></h3>
                               <p>Módulo para geração de relatórios pré-definidos sobre o andamento financeiro dos EVTEAS.</p>
                               <a href="<?php echo base_url('gestao_estudos_projetos/relatorios_financeiros'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <?php
                   /*
                   <div class="col-md-3 col-sm-6">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-2">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao_projetos_ordenamento.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#A52A2A;">
                               <h3>Ordenamento de Estudos e Projetos</h3>
                               <p>
                               	Base de dados sobre o que está ocorrendo e/ou previsto em toda a malha rodoviária federal, sintetizadas para os 359 “empreendimentos”,  independente do número de segmentos do SNV. 
                               </p>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   */
                   ?>
                </div>
            </div>
        </section>

<?php } ?>        
           



