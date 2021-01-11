<div class="container-fluid">		  
	  <div class="row">	  	  
        <div class="main">
	        <ol class="breadcrumb">
		        <li>
		          <a href="<?php echo site_url("admin"); ?>">
		            <?php echo ucfirst($this->uri->segment(1));?>
		          </a> 
		          
		        </li>
		        <li class="active">
		          <?php echo ucfirst($this->uri->segment(2));?>
		        </li>
		      </ol>
		      <div class="page-header users-header">
	    		<h2>
	              <?php echo ucfirst($this->uri->segment(2));?>
	              
	              <!-- <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a> -->
	            </h2>
	          </div>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
				<th class="header">Prioridade</th>
				<th class="yellow header headerSortDown">Rodovia-UF</th>
				<th class="yellow header headerSortDown">Km Inicial</th>
				<th class="yellow header headerSortDown">Km Final </th>
				<th class="yellow header headerSortDown">Extensão</th>
				<!-- 
				<th class="yellow header headerSortDown">Lotes</th>
				<th class="yellow header headerSortDown">Subtrecho</th>
				 -->
				<th class="yellow header headerSortDown">Status</th>
				<th class="yellow header headerSortDown">Progresso</th>
				<th class="yellow header headerSortDown" colspan="2" >Intervenção</th>
				<!--<th class="yellow header headerSortDown">Status</th> -->
				
	    	  </tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($anteprojetos as $row)
	              {
	                echo '<tr>';
	                echo '<td style="width: 95px;">'.$row['prioridade'].'</td>';
					echo '<td>'.$row['rodovia'].'-'.$row['uf'].'</td>';
					echo '<td>'.$row['km_inicial'].'</td>';
					echo '<td>'.$row['km_final'].'</td>';
					echo '<td>'.$row['extensao'].'</td>';
					//echo '<td style="width: 65px;">'.$row['lotes'].'</td>';
					//echo '<td>'.$row['subtrecho'].'</td>';
					echo '<td>'.$row['status'].'</td>';
					echo '<td>
			              	<div class="progress progress-striped active">
			        			<div class="progress-bar" 
			        				role="progressbar" 
			        				aria-valuenow="'.$row['progresso'].'" 
			        				aria-valuemin="0" 
			        				aria-valuemax="100" 
			        				style="width: '.$row['progresso'].'%">'.$row['progresso'].'% 
			        			</div>
			      			</div>
            			  </td>';
					echo '<td>'.$row['intervencao'].'</td>';
					/*
					echo '<td style="width: 70px;">
              				<div class="progress" style="margin-bottom:10px;">
							  <div class="bar" style="width: 100%;"></div>
							</div>
              				<div class="progress progress-danger" style="margin-bottom:10px;">
							  <div class="bar" style="width: 100%"></div>
							</div>
              				<div class="progress progress-success" style="margin-bottom:10px;">
							  <div class="bar" style="width: 50%;">Documentação</div>
							</div>
		            	  </td>';
		           */
				
					
			       echo '<td class="crud-actions">
		        		  <a href="'.site_url("admin").'/anteprojetos/detalhes/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Visualizar</a> 
		                  <a href="'.site_url("admin").'/anteprojetos/update/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Editar</a>
	            		  <a href="'.site_url("admin").'/anteprojetos_documentos/lista_documento/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Documentos</a>  
              			  <a href="'.site_url("admin").'/anteprojetos_acompanhamento_fisico/lista_acompanhamento_fisico/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Acomp. Físico</a>
 						  <a href="'.site_url("admin").'/anteprojetos_localizacao/lista_localizacao/'.$row['id'].'" class="btn btn-info" 	style="width: 130px;">Localização</a>             		
		                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>
		                </td>';
	                echo '</tr>';
	                //'.site_url('admin').'/anteprojetos/delete/'.$row['id'].'
	              }

              		echo ' <div id="myModal" class="modal fade" role="dialog">
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
						   </div>';
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>       
    </div>
</div>
	<script>
		
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
		
	</script>

	
	