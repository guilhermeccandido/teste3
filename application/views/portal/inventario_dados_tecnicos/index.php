<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">Inventário dados Técnicos</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url('home'); ?>" class="home">SGPLAN</a></li>
			<li class="current_item">Inventário dados Técnicos</li>
        </ol>
    </div>
</header>
<?php



	if(isset($link_acessos)){
		//print_r($link_acessos);
		
		foreach($link_acessos as $item){
		
			switch ($item[key($item)]){
		
				case 'inventario/lego' :
					$acessoLego = $item['acesso'];
					break;
						
				case 'inventario/unifilar' :
					$acessoUnifilar = $item['acesso'];
					break;
					
				case 'inventario/clustergram' :
					$acessoClustergram = $item['acesso'];
					break;
					
				case 'inventario/unifilar2' :
					$acessoUnifilar2 = $item['acesso'];
					break;
				
			}
			
		}
		

?>	
        <section id="mind-features">
            <div class="container">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInDown animation-delay-1">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/clustergrama.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Clustergrama</h3>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam probarem. Antiqua adiit erat conscientia prorsus facta.</p>
                               <?php
                               		if(isset($acessoClustergram)){
										echo '<a href="'.base_url().'admin/inventario/clustergram" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-2">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/booble.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Booble Chart</h3>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam probarem. Antiqua adiit erat conscientia prorsus facta.</p>
                               <?php
                               		if(isset($acessoUnifilar)){
										echo '<a href="'.base_url().'admin/inventario/unifilar" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-6">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/lego.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Lego</h3>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam probarem. Antiqua adiit erat conscientia prorsus facta.</p>
                               <?php
                               		if(isset($acessoLego)){
										echo '<a href="'.base_url().'admin/inventario/lego" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-6">
                           <div class="item-icon" style=" padding : 0;">
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/unifilar.png">
                           </div>
                           <div class="item-content menu-transparent"  >
                               <h3>Unifilar</h3>
                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam probarem. Antiqua adiit erat conscientia prorsus facta.</p>
                               <?php
                               		if(isset($acessoUnifilar2)){
										echo '<a href="'.base_url().'admin/inventario/unifilar2" class="btn btn-success pull-right">Acesso</a>';	
									}	
								?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
            </div>
        </section>

<?php } ?>        

?>
