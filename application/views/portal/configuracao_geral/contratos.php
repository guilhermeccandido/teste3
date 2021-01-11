<br />
<br />
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
                       <article class="mind-features-item hover animated bounceInLeft  animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_setoriais.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/coordenacao_setorial'); ?>">Coordenações Setoriais</a></h3>
                               <p>Área de Adição/Edição de Coordenações Setoriais da CGPLAN.</p>
								<a href="<?php echo base_url('admin/coordenacao_setorial'); ?>" class="btn btn-success pull-right">Acesso</a>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_programas.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/programas'); ?>">Programas</a></h3>
                               <p>Área de Adição/Edição de Programas da CGPLAN.</p>
								<a href="<?php echo base_url('admin/programas'); ?>" class="btn btn-success pull-right">Acesso</a>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/contratos_relacoes') ?>" >Contratos Relações</a></h3>
                               <p>Área de configurações para definicação de Relações entre Contratos, Coordenações e Programas.</p>
								<a href="<?php echo base_url('admin/contratos_relacoes') ?>" class="btn btn-success pull-right">Acesso</a>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_controle.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/contratos_relacoes'); ?>">Contratos Controle</a></h3>
                               <p>Área de configurações para definicação de Relações entre Contratos, Coordenações e Programas.</p>
								<a href="<?php echo base_url('admin/contratos_relacoes') ?>" class="btn btn-success pull-right">Acesso</a>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
            </div>
           </div>
        </section>

<?php } ?>        
           



