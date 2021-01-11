<div class="container-fluid">		  
	<div class="row">	  	  
		<div class="main">
		  <ol class="breadcrumb">
	       <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
    		<li>
	          <a href="<?php echo site_url("admin").'/anteprojetos'; ?>">
	            <?php echo str_replace("_", " ", ucfirst("anteprojetos")) ;?>
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo str_replace("_", " ", ucfirst("imagens")) ;?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Anteprojetos Registro de Imagens
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_anteprojetos; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          
   <ul class="portfolio-control">
        <li class="filter active" data-filter="all">Todas as Imagens</li>
        <?php foreach($categorias_imagens as $row ){ ?>
        		<li class="filter" data-filter="<?php echo $row['titulo']; ?>"><?php echo $row['titulo']; ?></li>
        <?php }	?>
    </ul>

    <div class="row" id="Grid">
    
    <?php
    	foreach($anteprojetos_imagens as $row){
    		
    ?>	        
     	  <div class="col-sm-6 col-lg-3 col-md-4 mix <?php echo $row['categoria']?>">
               <div class="img-caption">
                  <img width="800" height="533" src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojetos.'/img/'.$row['id'].'.'.$row['tipo']; ?>" class="attachment-, img-responsive wp-post-image" alt="w2" />                                       
                  <div class="caption">
                       <div class="caption-content">
                           <a href="#" class="animated fadeInDown" data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>">
                           	<i class="fa fa-search"></i>Mais Informações
                           </a>
                           <h4><?php echo $row['titulo']; ?></h4>
                       </div>
                   </div>
               </div>
           </div>
           <!-- Modal -->
           <div class="modal fade" id="myModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                           <h4 class="modal-title" id="myModalLabel"><?php echo $row['titulo']; ?></h4>
                       </div>
                       <div class="modal-body">
                       <img width="800" height="533" src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojetos.'/img/'.$row['id'].'.'.$row['tipo']; ?>" class="attachment-, img-responsive wp-post-image" alt="w2" />                                                      
                       <div class="no-img">
	                       <p>
		                       <a href="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojetos.'/img/'.$row['id'].'.'.$row['tipo']; ?>">
		                       		<img src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojetos.'/img/'.$row['id'].'.'.$row['tipo']; ?>" alt="w2" width="800" height="533" class="aligncenter imageborder img-responsive size-full wp-image-121" />
		                       </a>
	                       </p>
							<p>
							<?php echo $row['descricao']; ?>
							</p>
						</div>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a href="<?php echo site_url("admin").'/anteprojetos_imagens/update/'.$row['id'].'/'.$id_anteprojetos; ?>" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  		<a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('<?php echo $row['id'] ;?>', '<?php echo $id_anteprojetos; ?>');" style="width: 130px;">deletar</a>
                       </div>
                   </div><!-- modal-content -->
               </div><!-- modal-dialog -->
           </div><!-- modal -->
           
      <?php
      } 
      ?>
     </div>
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			 <div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3>Deleção de Registro</h3>
			  </div>
			  <div class="modal-body">
			    <p>Você realmente gostaria de Deletar esse Registro?</p>
			  </div>
			  <div class="modal-footer">
			    <a id ="actionModal" href="" class="btn btn-danger">Deletar</a>
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			  </div>
			</div>
	       </div>
	     </div>         
		</div>       
	</div>
</div>
	<script>
    
		function open_modal(id, id2){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/anteprojetos_imagens/delete/"+id+"/"+id2);
		}

		$(function() {
		    $('#Grid').mixitup();
		});
		
	    
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "anteprojetos_imagens/delete/"+id);
		}
		*/
	</script>