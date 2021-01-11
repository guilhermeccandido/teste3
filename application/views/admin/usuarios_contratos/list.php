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
	          <a href="<?php echo site_url("usuarios"); ?>">
	            <?php echo ucfirst("usuários");?>
	          </a>
	        </li>
	        <li class="active">
	          Contratos Relacionados
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Contratos Relacionados
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_usuario; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
						<th class="yellow header headerSortDown">Contrato</th>
						<th class="yellow header headerSortDown">Observações</th>
					</tr>
	            </thead>
	            <tbody>
	              <?php
	              
		              $options_contratos = array();
		              foreach($contratos as $row){
		              	$options_contratos[$row['id']] = $row['contrato'];
		              }
		              
		              foreach($usuarios_contratos as $row)
		              {
		                echo '<tr>';
		                echo '<td>'.$row['id'].'</td>';
		                echo '<td>'.$options_contratos[$row['id_contratos']].'</td>';
						echo '<td>'.$row['observacoes'].'</td>';
						
			          echo '<td class="crud-actions">
		                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].', '.$id_usuario.');" style="width: 130px;">deletar</a>
		                </td>';
		                echo "</tr>";
		              }
	                  		
	              ?>      
	            </tbody>
	          </table>
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
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>              
		</div>       
	</div>
</div>	
	<script>
		
		function open_modal(id, id2){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/usuarios_contratos/delete/"+id+"/"+id2);
		}
		
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "usuarios_contratos/delete/"+id);
		}		
		*/
	</script>