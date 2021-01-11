<br />
<br />
<?php

	if(isset($link_acessos)){

?>	
        <section id="mind-features">
            <div class="container">
                <div class="row">
                   <div class="col-md-4 col-sm-6">
                       <article class="mind-features-item hover animated bounceInRight animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/nossa_equipe.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#8300ae;">
                               <h3>Nossa Equipe</h3>
                               <p>
                               Apresenta todas as informações de cada estudo do Plano de Avaliação Socioeconômica. Abrangendo documentos técnicos e processuais, cronogramas, detalhamento do estudo, etc..
                               </p>
                               <a href="<?php echo base_url(). 'gestao_551/nossa_equipe'; ?>" class="btn btn-success pull-right">Acesso</a>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-4 col-sm-6">
                       <article class="mind-features-item hover animated bounceInUp animation-delay-1">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/atividades.png">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#8300ae;">
                               <h3>Atividades</h3>
                               <p>Fonte de consulta para estudos, anteprojetos, licenciamento, obras em andamento, contratos de manutenção/operação, etc..</p>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                   <div class="col-md-4 col-sm-6">
                       <article class="mind-features-item hover animated bounceInLeft animation-delay-2">
                           <div class="item-icon"  style="padding : 0;" >
                               <img alt="" style="width: 260px;" src="<?php echo base_url(); ?>assets/portal/img/produtos.jpg">
                           </div>
                           <div class="item-content menu-transparent" style="background-color:#8300ae;">
                               <h3>Produtos</h3>
                               <p>
                               Base de dados sobre o que está ocorrendo e/ou previsto em toda a malha rodoviária federal, sintetizadas para os 359 “empreendimentos”,  independente do número de segmentos do SNV. 
                               </p>
                           </div>
                       </article> <!-- mind-features-item -->
                   </div>
                   
                </div>
            </div>
        </section>

<?php } ?>        
           


