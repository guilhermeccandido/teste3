<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
	$options_pas = array();
	foreach($pas as $item){
		$options_pas[$item['id']] = $item['lote'];
	}
	
	$options_fases = array();
	foreach($fases as $item){
		$options_fases[$item['id']] = $item['titulo'];
	}
	
	$options_subfases = array();
	foreach ($subfases as $row)
	{
		$options_subfases[$row["id"]] = $row["titulo"];
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
	        <li>
	          <a href="<?php echo site_url("admin/pas_fases/".$id_pas); ?>">
	            Atividade
	          </a> 	          
	        </li>
	        <li class="active">
	          Subprodutos
	        </li>
	      </ol>
		  
	      <div class="page-header users-header">
    		<h2>
              <?php echo 'Lote '. $options_pas[$id_pas] .' - '.$options_fases[$id_fases]; ?>
              <a  href="<?php echo site_url("admin/".$this->uri->segment(2)."/add").'/'.$id_pas.'/'.$id_fases ; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
						<th class="yellow header headerSortDown">Subproduto</th>
						<th class="yellow header headerSortDown">Quantidade</th>
						<th class="yellow header headerSortDown">Observações</th>
	    			</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($pas_financeiro_subfases as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$options_subfases[$row['id_subfases']].'</td>';
					echo '<td>'.$row['quantidade'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
		          echo '<td class="crud-actions">
	                  <a href="'.site_url("admin").'/pas_financeiro_subfases/update/'.$row['id'].'/'.$id_pas.'/'.$id_fases.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_pas.','.$id_fases.');" style="width: 130px;">deletar</a>
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
		
		function open_modal(id, id2, id3){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/pas_financeiro_subfases/delete/"+id+"/"+id2+"/"+id3);
		}

		/*
		function open_modal(id){
			$("#actionModal").attr("href", "pas_financeiro_subfases/delete/"+id);
		}		
		*/
	</script>