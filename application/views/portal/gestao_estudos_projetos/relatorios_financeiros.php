<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">Relatórios Financeiros</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url('home'); ?>" class="home">SGPLAN</a></li>
			<li class="home"><a title="SGPLAN" href="<?php echo base_url('gestao_estudos_projetos');?>" class="home">Gestão de Estudos e Projetos</a></li>
			<li class="current_item">Relatórios Financeiros</li>
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
		            Relatórios Financeiros
		        </li>
		      </ol>
                <div class="row">
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                           <a href="<?php echo base_url('pas_relatorios/produtos_medidos_contrato'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/relatorios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#bf0000;">
                               <h3><a href="<?php echo base_url('pas_relatorios/produtos_medidos_contrato'); ?>">Produtos Medidos Por Contrato</a></h3>
                               <p>
                               Apresenta os produtos medidos por contrato, data, quantidade, valores e Reajuste.
                               </p>
                               <a href="<?php echo base_url('pas_relatorios/produtos_medidos_contrato'); ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                </div>
            </div>
        </section>

<?php } ?>        
           



