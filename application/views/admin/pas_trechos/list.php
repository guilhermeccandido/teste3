<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
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
	          <a href="<?php echo site_url("admin").'/gestao_estudos_projetos'; ?>">
	            Gestão de Estudos e Projetos
	          </a> 	          
	        </li>
    		<li>
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	            EVTEAS
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo str_replace("_", " ", ucfirst("trechos")) ;?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php 
    			echo "Lote ".$pas['lote']." – Trechos" ;
    			//echo $usuarioPerfil['acesso'];
    			if($usuarioPerfil['acesso'] == 'editar'){ 
    		  ?>
              	<a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_pas; ?>" class="btn btn-success">Adicionar Novo</a>
              <?php } 	
              

              	
              	$options_estados = array();
              	foreach($estados as $item){
              		$options_estados[$item['id']] = $item['uf'];  
              	}
              	
              	
              ?>					
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
					<th class="yellow header headerSortDown">UF</th>
					<th class="yellow header headerSortDown">Rodovia</th>
					<th class="yellow header headerSortDown">Km Inicial</th>
					<th class="yellow header headerSortDown">Km Final</th>
					<th class="yellow header headerSortDown">Extensão</th>
					<th class="yellow header headerSortDown">Subtrecho</th>
					<th class="yellow header headerSortDown">Observações</th>
					</tr>
		        </thead>
	        <tbody>
              <?php
              foreach($pas_trechos as $row)
              {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
				echo '<td>'.$options_estados[$row['id_estados']].'</td>';
				echo '<td>'.$row['rodovia'].'</td>';
				echo '<td>'.$row['km_inicial'].'</td>';
				echo '<td>'.$row['km_final'].'</td>';
				echo '<td>'.$row['extensao'].'</td>';
				echo '<td>'.$row['subtrecho'].'</td>';
				echo '<td>'.$row['observacoes'].'</td>';

		          echo '<td class="crud-actions">
	                  <a href="'.site_url("admin").'/pas_trechos/update/'.$row['id'].'/'.$id_pas.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].', '.$id_pas.');" style="width: 130px;">deletar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/pas_trechos/delete/"+id+"/"+id2);
		}
    
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "pas_trechos/delete/"+id);
		}
		*/
	</script>