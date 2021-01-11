<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
	$options_modulos = array();
	foreach($modulo_filho as $row){
		$options_modulos[$row['id']] = $row['titulo'];
	}
	
?>
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
	          <a href="<?php echo site_url("admin").'/modulos/acesso'; ?>">
	            Módulos de Acesso
	          </a> 	          
	        </li>
	        <li class="active">
	          Módulos
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php
              	echo $options_modulos[$id_modulos];
    			if($usuarioPerfil['acesso'] == 'editar'){ 
    		  ?>
              	<a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_modulos; ?>" class="btn btn-success">Adicionar Novo</a>
              <?php
              	}		
              ?>					
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
					<th class="yellow header headerSortDown">Módulos</th>
					<th class="yellow header headerSortDown">Alias</th>
					<th class="yellow header headerSortDown">Descrição</th>
				</tr>
	        </thead>
	        <tbody>
              <?php
              //print_r($modulos_modulos);
              //die;
              
              
              foreach($modulos_modulos as $row)
              {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
				echo "<td>".$row["modulos"]."</td>";
				echo "<td>".$row["alias"]."</td>";
				echo '<td>'.$row['descricao'].'</td>';

		          echo '<td class="crud-actions">
	                  <a href="'.site_url("admin").'/modulos_modulos/update/'.$row['id'].'/'.$id_modulos.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].', '.$id_modulos.');" style="width: 130px;">deletar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/modulos_modulos/delete/"+id+"/"+id2);
		}
    
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "modulos_modulos/delete/"+id);
		}
		*/
	</script>