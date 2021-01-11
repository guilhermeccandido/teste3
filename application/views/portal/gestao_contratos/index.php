<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">Gestão de Contratos</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url('home'); ?>" class="home">SGPLAN</a></li>
			<li class="current_item">Gestão de Contratos</li>
        </ol>
    </div>
</header>
<?php



	if(isset($link_acessos)){
		
		foreach($link_acessos as $item){
		
			switch ($item[key($item)]){
		
				case 'contratos' :
					$acessoContratos = $item['acesso'];
					break;
						
				case 'contratos/gerencial' :
					$acessoContratosGerencial = $item['acesso'];
					break;
					
				case 'contratos/orcamento' :
					$acessoContratosOrcamento = $item['acesso'];
					break;
				
				case 'coordenacao_setorial' :
					$acessoCoordenacaoSetorial =  $item['acesso'];
					break;
					
				case 'programas' :
					$acessoProgramas = $item['acesso'];
					break;
				
				case 'contratos_relacoes' :
					$acessoContratoRelacoes=  $item['acesso'];
					break;						

				case 'contratos/controle' :
					$acessoContratoControle=  $item['acesso'];
					break;
				
			}
			$acessoContratoControle = true;
		}
		

?>	
        <section id="mind-features">
            <div class="container">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInDown animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_consultas.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/contratos'); ?>" >Consulta de Contratos</a></h3>
                               <p>Consulta, cadastro e atualização de Contratos da CGPLAN.</p>
                               <?php
                               		if(isset($acessoContratos)){
										echo '<a href="'.base_url().'admin/contratos" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-2">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_gerencial.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/contratos/gerencial'); ?>">Contratos Gerencial</a></h3>
                               <p>Consulta de Andamento de contratos da CGPLAN.</p>
                               <?php
								echo '<a href="'.base_url().'admin/contratos/gerencial" class="btn btn-success pull-right">Acesso</a>';	
										
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-6">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_projecoes.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/contratos/orcamento'); ?>">"Contratos Projeções</a></h3>
                               <p>Módulo de Projeções de Orçamentos de Contratos(EM PRODUÇÃO).</p>
                               <?php
                               		if(isset($acessoContratosOrcamento)){
										echo '<a href="'.base_url().'admin/contratos/orcamento" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInLeft  animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_setoriais.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/coordenacao_setorial'); ?>">Coordenações Setoriais</a></h3>
                               <p>Área de Adição/Edição de Coordenações Setoriais da CGPLAN.</p>
								<a href="<?php echo base_url() ?>admin/coordenacao_setorial" class="btn btn-success pull-right">Acesso</a>	
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
								<a href="<?php echo base_url() ?>admin/programas" class="btn btn-success pull-right">Acesso</a>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                <?php if(isset($acessoContratoRelacoes)){ ?>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_relacoes.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/contratos_relacoes'); ?>" >Contratos Relações</a></h3>
                               <p>Área de configurações para definicação de Relações entre Contratos, Coordenações e Programas.</p>
								<a href="<?php echo base_url() ?>admin/contratos_relacoes" class="btn btn-success pull-right">Acesso</a>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                <?php } ?>    
                
                <?php if(isset($acessoContratoControle)){ ?>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_controle.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/contratos_relacoes'); ?>">Contratos Controle</a></h3>
                               <p>Área de configurações para definicação de Relações entre Contratos, Coordenações e Programas.</p>
								<a href="<?php echo base_url() ?>admin/contratos_relacoes" class="btn btn-success pull-right">Acesso</a>	
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                <?php } ?>   
                   
                   
            </div>
        </section>

<?php } ?>        
