<?php 
	//$tipo_documentos = array('tecnico', 'processual');
	function switchProgressBar($fase){
		
		switch ($fase) {
		
			case 'Elaboração' :
				$resultProgress = 'info';	
				break;
			
			case 'Análise' :
				$resultProgress = 'warning';
				break;
				
			case 'Aceite' :
				$resultProgress = 'success';
				break;
			
			case 'Revisão' :
				$resultProgress = 'danger';
				break;
				
			default: 
				$resultProgress = '';
			
		}
		return	$resultProgress;
	} 
	
	$documentos_classificados = array();
	foreach($tipo_documentos as $item){
		foreach($documentos as $row)
		{
			if($row['tipo'] == $item['tipo']){
				$documentos_classificados[$item['tipo']][] = $row;
			}
		}	
	}
	$id_anteprojeto = $anteprojetos[0]['id'];
	
?>
  
    <div class="container-fluid">    
	  <div class="row">
    <div class="main">
    	<ol class="breadcrumb">	        
	        <li>
	          <a href="<?php echo site_url("anteprojetos").'/lista_anteprojetos/'; ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a>
	           
	        </li>
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(2));?>
	        </li>
	      </ol>
    	<h1 class="page-header">Anteprojetos</h1>
    	
	 <div class="row">
	      <div class="col-sm-4" >
	          <div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
	              <h3 class="panel-title">Localização</h3>
	            </div>
	            <div class="panel-body" style="height:566px;">
	            <?php
	            
	            /*
				echo $this->gcharts->GeoChart('Debt')->outputInto('debt_div');
	            echo $this->gcharts->div(0,0,'');
	            if($this->gcharts->hasErrors()) {
	            	echo $this->gcharts->getErrors();
	            }	
				*/
					
				
	            
	            echo $map['html'];
	            //die;
	            
	            
				?>
	            </div>
	          </div>
	       </div><!-- /.col-sm-6 -->
	        <div class="col-sm-4">
	          <div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" onclick="" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
	              <h3 class="panel-title">Detalhes do Anteprojeto</h3>
	            </div>
	            <div class="panel-body">
	            	<h5><b>Progresso Total (Anteprojeto)</b></h5>
		            <div class="progress progress-striped active">
	        			<div class="progress-bar progress-bar-<?php echo switchProgressBar(''); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="60" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $anteprojetos[0]['progresso']; ?>%;">
	        				Progresso <?php echo $anteprojetos[0]['progresso']; ?>%; 
	        			</div>
	      			</div>
	      			<h5><b>Progresso Fase 1 (<?php echo $anteprojetos[0]['fase1']; ?>)</b></h5>
	      			<div class="progress progress-striped green active">
	        			<div class="progress-bar progress-bar-<?php echo switchProgressBar($anteprojetos[0]['fase1']); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="73" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $anteprojetos[0]['progresso1']; ?>%;">
	        				<?php echo $anteprojetos[0]['fase1'].' '.$anteprojetos[0]['progresso1'] ; ?>%; 
	        			</div>
	      			</div>
	      			<h5><b>Progresso Fase 2 (<?php echo $anteprojetos[0]['fase2']; ?>)</b></h5>
	      			<div class="progress progress-striped green active">
	        			<div class="progress-bar progress-bar-<?php echo switchProgressBar($anteprojetos[0]['fase2']); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="45" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $anteprojetos[0]['progresso2']; ?>%;">
	        				<?php echo $anteprojetos[0]['fase2'].' '.$anteprojetos[0]['progresso2'] ; ?>%; 
	        			</div>
	      			</div>
	      			<h5><b>Progresso Fase 3 (<?php echo $anteprojetos[0]['fase3']; ?>)</b></h5>
	      			<div class="progress progress-striped green active">
	        			<div class="progress-bar progress-bar-<?php echo switchProgressBar($anteprojetos[0]['fase3']); ?>" 
	        				role="progressbar" 
	        				aria-valuenow="30" 
	        				aria-valuemin="0" 
	        				aria-valuemax="100" 
	        				style="width: <?php echo $anteprojetos[0]['progresso3']; ?>%;">
	        				<?php echo $anteprojetos[0]['fase3'].' '.$anteprojetos[0]['progresso3'] ; ?>%;
	        			</div>
	      			</div>
	      			
	      			
		            <table class="table table-striped table-hover">
			            <thead>
			              <tr>
							<th class="header" colspan="1"><b>Prioridade: <?php echo $anteprojetos[0]['prioridade']; ?></b></th>
							<th class="header" colspan="2"><b>Status: <?php echo $anteprojetos[0]['status']; ?></b></th>
				    	  </tr>
				            </thead>
				            <tbody>
				              <?php
				                echo '<tr>';
				                echo '<td><b>UF:</b> '.$anteprojetos[0]['uf'].'</td>';
				                echo '<td><b>Rodovia:</b> '.$anteprojetos[0]['rodovia'].'</td>';
				                echo '<td><b>Extensão:</b> '.$anteprojetos[0]['extensao'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				               	 	echo '<td><b>km Final:</b> '.$anteprojetos[0]['km_inicial'].'</td>';
				               	 	echo '<td colspan="2" ><b>km Inicial:</b> '.$anteprojetos[0]['km_final'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				                	echo '<td colspan="3" ><b>Lotes:</b> '.$anteprojetos[0]['lotes'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				                	echo '<td colspan="3" ><b>Subtrecho:</b> '.$anteprojetos[0]['subtrecho'].'</td>';
				                echo '</tr>';
				                echo '<tr>';
				               	 echo '<td colspan="3" ><b>Intervenção:</b> '.$anteprojetos[0]['intervencao'].'</td>';
				                echo '</tr>';
				                /*
				                echo '<td>'.$anteprojetos[0]['prioridade'].'</td>';
								echo '<td>'.$anteprojetos[0]['rodovia'].'</td>';
								echo '<td>'.$anteprojetos[0]['uf'].'</td>';
								echo '<td>'.$anteprojetos[0]['km_inicial'].'</td>';
								echo '<td>'.$anteprojetos[0]['km_final'].'</td>';
								echo '<td>'.$anteprojetos[0]['extensao'].'</td>';
								echo '<td>'.$anteprojetos[0]['lotes'].'</td>';
								echo '<td>'.$anteprojetos[0]['subtrecho'].'</td>';
								echo '<td>'.$anteprojetos[0]['intervencao'].'</td>';
								echo '</tr>';
								*/
				                //'.site_url('admin').'/anteprojetos/delete/'.$row['id'].'
			
			              	
			              ?>  
			            </tbody>
			          </table>	
	            </div>
	          </div>
	       </div><!-- /.col-sm-6 -->
	       <div class="col-sm-4">
	          <div class="panel panel-default">
	            <div class="panel-heading">
		            <div class="panel-heading-btn">
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	                </div>
	              <h3 class="panel-title">Observações</h3>
	            </div>
	            <div class="panel-body">
	              <!-- <blockquote>  -->
	              	<p>
	              		<?php  echo $anteprojetos[0]['observacoes']; ?>
	              	</p>
	              <!-- </blockquote>  -->
	            </div>
	          </div>
	       </div><!-- /.col-sm-4 -->
	          <!-- 
	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title">Panel title</h3>
	            </div>
	            <div class="panel-body">
	              Panel content
	            </div>
	          </div>
	           -->
	      </div>
    	
    	<?php /* 
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
				<th class="header">Prioridade</th>
				<th class="yellow header">Rodovia</th>
				<th class="yellow header">UF</th>
				<th class="yellow header">Km Inicial</th>
				<th class="yellow header">Km Final </th>
				<th class="yellow header">Extensão</th>
				<th class="yellow header">Lotes</th>
				<th class="yellow header">Subtrecho</th>
				<th class="yellow header">Intervenção</th>
				
	    	  </tr>
	            </thead>
	            <tbody>
	              <?php
	                echo '<tr>';
	                echo '<td>'.$anteprojetos[0]['prioridade'].'</td>';
					echo '<td>'.$anteprojetos[0]['rodovia'].'</td>';
					echo '<td>'.$anteprojetos[0]['uf'].'</td>';
					echo '<td>'.$anteprojetos[0]['km_inicial'].'</td>';
					echo '<td>'.$anteprojetos[0]['km_final'].'</td>';
					echo '<td>'.$anteprojetos[0]['extensao'].'</td>';
					echo '<td>'.$anteprojetos[0]['lotes'].'</td>';
					echo '<td>'.$anteprojetos[0]['subtrecho'].'</td>';
					echo '<td>'.$anteprojetos[0]['intervencao'].'</td>';
					echo '</tr>';
	                //'.site_url('admin').'/anteprojetos/delete/'.$row['id'].'

              	
              ?>  
            </tbody>
          </table>
          */ ?>
            <ul class="nav nav-tabs nav-justified">
               <li class="dropdown active " >
			   	 <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Documentos<b class="caret"></b></a>
			    <ul class="dropdown-menu">
			      <li class="active" >
			      	<a href="#documentos" data-toggle="tab" >Todos os Documentos</a>
			      </li>
			      <?php
			      	foreach($tipo_documentos as $item){
				  ?>
			      		<li >
							<a href="<?php echo '#'.$item['tipo'];?>" data-toggle="tab" aria-expanded="false" ><?php echo ucfirst($item['tipo']);?></a>
						</li>
				<?php 
			      	} 
			      ?>
			    </ul>
			   </li>
			  <li class="dropdown" >
			   	 <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" >Acompanhamento Físico<b class="caret"></b></a>
			    <ul class="dropdown-menu">
			    <?php
			    	foreach($acompanhamento_fisico as $item){
				?>
			    		<li>
							<a href="<?php echo '#'.$item['titulo']; ?>" data-toggle="tab" aria-expanded="false" ><?php echo $item['tipo']; ?></a>
						</li>
				<?php 
			    	} 
			    ?>
			    </ul>
			   </li>
			   <li class="dropdown" >
			   	 <a href="#anteprojetos_imagens" class="dropdown-toggle" data-toggle="tab" href="#" aria-expanded="true" >Banco de Imagens</a>
			   </li>
			</ul>
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="documentos">
			
              <table class="table table-responsive table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
					<th class="yellow header headerSortDown">Documento</th>
					<th class="yellow header headerSortDown">Tipo</th>
					<th class="yellow header headerSortDown">Observação</th>
					<th class="yellow header headerSortDown">Última Atualização</th>
				  </tr>
		        </thead>
		            <tbody>
		              <?php
		              foreach($documentos as $row)
		              {
		                echo '<tr>';
		                echo '<td>'.$row['id'].'</td>';
						echo '<td>'.$row['titulo'].'</td>';
						echo '<td>'.$row['tipo'].'</td>';
						echo '<td>'.$row['observacao'].'</td>';
						echo '<td>'.$row['last_update'].'</td>';
						
		          echo '<td class="crud-actions">
	                  <a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/documentos/'.$row['nome'].'" target="blank" class="btn btn-info">Ver / Download</a>
	                  
	                </td>';
	                echo "</tr>";
	              }
	              ?>      
	            </tbody>
	          </table>
            </div>
             <?php
					foreach($tipo_documentos as $item){
			 ?>
						<div class="tab-pane fade" id="<?php echo $item['tipo']; ?>">
							<table class="table table-striped table-bordered table-condensed">
							<thead>
								<tr>
									<th class="header">#</th>
									<th class="yellow header headerSortDown">Documento</th>
									<th class="yellow header headerSortDown">Tipo</th>
									<th class="yellow header headerSortDown">Observação</th>
									<th class="yellow header headerSortDown">Última Atualização</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							foreach($documentos_classificados[$item['tipo']] as $row)
							{
								echo '<tr>';
								echo '<td>'.$row['id'].'</td>';
								echo '<td>'.$row['titulo'].'</td>';
								echo '<td>'.$row['tipo'].'</td>';
								echo '<td>'.$row['observacao'].'</td>';
								echo '<td>'.$row['last_update'].'</td>';
							
								echo '<td class="crud-actions">
								          <a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/documentos/'.$row['nome'].'" target="blank" class="btn btn-info">Ver / Download</a>
								      </td>';
								echo "</tr>";
							}
							?>
				            </tbody>
				          </table>
			            </div>
			  <?php 
				}
	        
             
			    foreach($acompanhamento_fisico as $item){
				?>
		    		<div class="tab-pane fade" id="<?php echo $item['titulo']; ?>">
		    		<a href="#myModal<?php echo $item['id'];?>" class="btn btn-default" data-toggle="modal">Outros Formatos</a>
		             <center>
		             	<img src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.jpg' ?>" style="width: 90%" />
		             </center>
		             <?php
		             	$link = '<a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.jpg">
									<img src="'.base_url().'assets/img/icons/jpg.jpg" style="width:50px;" />
								</a> ';
			            foreach($item['list'] as $list){
							if(empty($list)){
								break;
							}else{
								$link .= '<a href="'.base_url().'assets/anteprojetos/'.$id_anteprojeto.'/acompanhamento_fisico/'.$item['titulo'].'/'.$id_anteprojeto.'.'.$list['tipo'].'" target="_blank">
											<img src="'.base_url().'assets/img/icons/'.$list['tipo'].'.jpg" style="width:50px;" />
										  </a> ';
							}
			            }
			            echo ' <div id="myModal'.$item['id'].'" class="modal fade" role="dialog">
								 <div class="modal-dialog">
							 	   <div class="modal-content"> 
	          						 <div class="modal-header">
								      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								      <h3>Download de Arquivos</h3>
								     </div>
								     <div class="modal-body">
								      <p>O documento selecionado encontra-se disponível nos seguintes formatos:</p>'.
									   $link.'
								     </div>
								    <div class="modal-footer">
								     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								    </div>
								  </div>
            				    </div>
						       </div>';
			            
			          ?> 
		            </div>
		       <?php
		    	} 
		    ?>
             <!-- Anteprojetos Imagem Tab Content  -->
		    <div class="tab-pane fade" id="anteprojetos_imagens">
		    <br />
		    <!--  Imagens  -->
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
			                  <img width="800" height="533" src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>" class="attachment-, img-responsive wp-post-image" alt="<?php echo $row['titulo']; ?>" />                                       
			                  <div class="caption">
			                       <div class="caption-content">
			                           <a href="#" class="animated fadeInDown" data-toggle="modal" data-target="#myModalImg<?php echo $row['id']; ?>">
			                           	<i class="fa fa-search"></i>Mais Informações
			                           </a>
			                           <h4><?php echo $row['titulo']; ?></h4>
			                       </div>
			                   </div>
			               </div>
			           </div>
			           <!-- Modal -->
			           <div class="modal fade" id="myModalImg<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			               <div class="modal-dialog">
			                   <div class="modal-content">
			                       <div class="modal-header">
			                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                           <h4 class="modal-title" id="myModalLabel"><?php echo $row['titulo']; ?></h4>
			                       </div>
			                       <div class="modal-body">
			                       <img width="800" height="533" src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>" class="attachment-, img-responsive wp-post-image" alt="<?php echo $row['titulo']; ?>" />                                                      
			                       <div class="no-img">
				                       <p>
					                       <a href="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>">
					                       		<img src="<?php echo base_url().'assets/anteprojetos/'.$id_anteprojeto.'/img/'.$row['id'].'.'.$row['tipo']; ?>" alt="<?php echo $row['titulo']; ?>" width="800" height="533" class="aligncenter imageborder img-responsive size-full wp-image-121" />
					                       </a>
				                       </p>
										<p>
										<?php echo $row['descricao']; ?>
										</p>
									</div>
			                       </div>
			                       <div class="modal-footer">
			                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                       </div>
			                   </div><!-- modal-content -->
			               </div><!-- modal-dialog -->
			           </div><!-- modal -->
			           
			      <?php
			      } 
			      ?>	             
			   </div>			   
			   <!--  Imagens  -->		    
          </div>
          <!-- Anteprojetos Imagem Tab Content  -->
          </div>

      </div>
     </div>   
 </div>	
 
 <style>
	.panel-heading span {
	    margin-top: -18px;
	    margin-right: 5px;
	    font-size: 15px;
	}
	.clickable {
	    cursor: pointer;
	}

	 html{
	 	height: 100%
	 };
	 
     body{
     	height: 100%; 
     	margin: 0; 
     	padding: 0
     }
     
	 #map_canvas {
	  height: 100%;
	  width: 100%;
	}
	
	
</style>
 	
	<script>

		$(document).ready(function() {
			App.init();
			
		});
		
		function open_modal(id){
			$("#actionModal").attr("href", "anteprojetos/delete/"+id);
		};

		$(function(){
			  $("table").tablesorter({
			    onRenderHeader: function(){
			      this.prepend('<span class="icon"></span>');
			    }
			  });
			});


		$(function() {
		    $('#Grid').mixitup();
		});

		$(window).resize(function(){
			initialize_map();
		});

		$("#menu-toggle").click(function(e) {
        	e.preventDefault();
	        $("#wrapper").toggleClass("active");
		});

		 $('[data-toggle=offcanvas]').click(function() {
		    $('.row-offcanvas').toggleClass('active');
		  });

		 
			
	</script>

<?php 
 	echo $map['js']; 
 ?>
