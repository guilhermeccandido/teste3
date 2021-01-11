<?php
	if(isset($link_acessos)){
		
		foreach($link_acessos as $item){
		
			switch ($item[key($item)]){
		
				case 'usuarios' :
					$acessoUsuarios = $item['acesso'];
					break;
						
				case 'modulos' :
					$acessoModulos = $item['acesso'];
					break;
				
				case 'contratos' :
					$acessoContratos = $item['acesso'];
					break;
				
				case 'pas' :
					$acessoPas = $item['acesso'];
					break;
				
			}
			$acessoContratoControle = true;
		}
		

?>	
<header class="wrap-title">
	<div class="container">
    	<h1 class="page-title">Configurações Gerais</h1>
		<ol class="breadcrumb">
        	<!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url(); ?>home/home" class="home">SGPLAN</a></li>
			<li class="current_item">Configurações Gerais</li>
		</ol>
	</div>
</header>
	<section id="mind-features">
    	<div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                           <a href="<?php echo base_url('admin/usuarios'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/configuracao_usuarios.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/usuarios'); ?>"> Controle de Usuários</a></h3>
                               <p>Dashboard geral de Cronogramas de todos os módulos do SGPLAN.</p>
                               <?php
                               		if(isset($acessoUsuarios)){
										echo '<a href="'.base_url().'admin/usuarios" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                           <a href="<?php echo base_url('admin/modulos'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/configuracao_modulos.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('admin/modulos'); ?>">Controle de Módulos</a></h3>
                               <p>Módulo de Projeções de Orçamentos de Contratos(EM PRODUÇÃO).</p>
                               <?php
                               		if(isset($acessoModulos)){
										echo '<a href="'.base_url().'admin/modulos" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                           <a href="<?php echo base_url('configuracao_geral/pas') ;?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/gestao_projetos_evteas.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('configuracao_geral/pas') ;?>">Configurações dos EVTEAS</a></h3>
                               <p>Módulos Auxiliares para configuração dos dados dos EVTEAS.</p>
                               <?php
                               		if(isset($acessoPas)){
										echo '<a href="'.base_url().'configuracao_geral/pas" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                           <a href="<?php echo base_url('configuracao_geral/contratos'); ?>">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/contratos_setoriais.png">
                           </a>
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3><a href="<?php echo base_url('configuracao_geral/contratos'); ?>"> Configuração de Contratos</a></h3>
                               <p>Módulo de Configuração de contratos tais como: Coordenações Setoriais, Gerais e Empresas, suas relações, etc...</p>
                               <?php
                               		if(isset($acessoContratos)){
										echo '<a href="'.base_url().'configuracao_geral/contratos" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>                  
               </div>
            </div>
        </section>
       

    



<?php } ?>        
   


