    <div class="container top">
		  <ul class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 
	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	          	PAS
	          </a> 
	          
	        </li>
	        <li class="active">
	          Documentos
	        </li>
	      </ul>
	      <div class="page-header users-header">
    		<h2>
              <?php echo 'Documentos';?>
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/add/'.$id_pas; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
	  <div class="row">
        <div class="span12 columns">
            <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
					<th class="yellow header headerSortDown">Documento</th>
					<th class="yellow header headerSortDown">Nome</th>
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
						echo '<td>
	          						<a href="'.base_url().'/assets/pas/'.$id_pas.'/documentos/'.$row['nome'].'" target="blank" >'.$row['nome'].'</a>
	          				  </td>';
						echo '<td>'.$row['tipo'].'</td>';
						echo '<td>'.$row['observacao'].'</td>';
						echo '<td>'.$row['last_update'].'</td>';
					
			          	echo '<td class="crud-actions">
			                  <a href="'.site_url("admin").'/pas_documentos/update/'.$row['id'].'" class="btn btn-info">Editar</a>  
			              	  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_pas.');">deletar</a>	
			                </td>';
			            echo "</tr>";
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
     
     <script>
		
		function open_modal(id, id2){
			$("#actionModal").attr("href","<?php echo site_url("admin"); ?>" + "/pas_documentos/delete/"+id+"/"+id2);
		}
		
	</script>