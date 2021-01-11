<header class="wrap-title">
    <div class="container">
        <h1 class="page-title">Anteprojetos</h1>
        <ol class="breadcrumb">
            <!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url().'home'?>" class="home">SGPLAN</a></li>
			<li class="current_item">Anteprojetos</li>
        </ol>
    </div>
</header>
<?php



	if(isset($link_acessos)){
		//print_r($link_acessos);
		
		foreach($link_acessos as $item){
		
			switch ($item[key($item)]){
		
				case 'anteprojetos' :
					$acessoAnteprojetos = $item['acesso'];
					break;
			}
			
		}
		

?>	
        <section id="mind-features">
            <div class="container">
                <div class="row">
                	<!-- 1 -->
                    <div class="col-md-3 col-sm-6" >
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-8">
                           <div class="item-icon" style=" padding : 0;">
                           <a href="<?php echo base_url('admin/anteprojetos/') ?>">
                           		<img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/anteprojetos.png">
                           	</a>
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#0b9a00;">
                               <h3><a href="<?php echo base_url('admin/anteprojetos/') ?>">Anteprojetos</a></h3>
                               <p>Apresenta todas as informações acerca de cada anteprojeto que compõe a carteira definida pela CGPLAN. Desde documentos técnicos e processuais, cronogramas localização, etc..</p>
                               <?php
                               		if(isset($acessoAnteprojetos)){
                               			echo '<a href="'.base_url().'admin/anteprojetos/" class="btn btn-success pull-right">Acesso</a>';	 
                               		} 
                               ?>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                </div>
            </div>
        </section>

<?php } ?>        

