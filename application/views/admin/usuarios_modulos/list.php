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
	          <a href="<?php echo site_url("admin").'/usuarios'; ?>">
	            <?php echo str_replace("_", " ", ucfirst("usuarios")) ;?>
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo "Módulos do Usuário" ;?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Módulos do Usuário
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_usuarios; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
					<th class="yellow header headerSortDown"><?php echo ucfirst("modulos"); ?></th>
					<th class="yellow header headerSortDown">Perfil</th>
					<th class="yellow header headerSortDown">Acesso</th>
				<th class="yellow header headerSortDown">Observações</th>
				</tr>
	        </thead>
	        <tbody>
              <?php
              
              $options_perfil = array();
              foreach($perfil as $row){
              	$options_perfil[$row['id']] = $row['titulo']; 
              }
              foreach($usuarios_modulos as $row)
              {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
				echo "<td>".$row["modulos"]."</td>";
				echo '<td>'.$options_perfil[$row['id_usuario_perfil']].'</td>';
				echo '<td>'.$row["acesso"].'</td>';
				echo '<td>'.$row['observacoes'].'</td>';

		          echo '<td class="crud-actions">
	                  <a href="'.site_url("admin").'/usuarios_modulos/update/'.$row['id'].'/'.$id_usuarios.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].', '.$id_usuarios.');" style="width: 130px;">deletar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/usuarios_modulos/delete/"+id+"/"+id2);
		}
    
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "usuarios_modulos/delete/"+id);
		}
		*/
	</script>