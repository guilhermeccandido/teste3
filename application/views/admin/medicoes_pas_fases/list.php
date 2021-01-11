<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
	
	$options_fases = array();
	foreach ($fases as $row)
	{
		$options_fases[$row["id"]] = $row["titulo"];
	}
	
	$options_subfases = array( 0 => '');
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
	          <a href="<?php echo site_url("configuracao_geral"); ?>">
	            Configurações Gerais
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("configuracao_geral/pas"); ?>">
	            EVTEAS
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin/registro_financeiro"); ?>">
	            Registro Financeiro
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin/financeiro_medicoes/".$id_registro_financeiro); ?>">
	            Medições
	          </a>
	        </li>
	        <li class="active">
	          Produtos
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Produtos
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/add/'.$id_financeiro_medicoes; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="yellow header headerSortDown">Lote</th>
					<th class="yellow header headerSortDown">Produto/Sub Produto</th>
					<th class="yellow header headerSortDown">Quantidade</th>
					<th class="yellow header headerSortDown">Valor</th>
					<th class="yellow header headerSortDown">Observações</th>
	    		</tr>
	            </thead>
	            <tbody>
	              <?php
	              	
	              	//print_r($medicoes_pas_fases);
	              	
	              foreach($medicoes_pas_fases as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['lote'].'</td>';
					echo '<td>'.$options_fases[$row['id_fases']].'<br>'.$options_subfases[$row['id_subfases']].'</td>';
					echo '<td>'.$row['quantidade'].'</td>';
					echo '<td>'.$row['valor'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
		          echo '<td class="crud-actions">
	                  <a href="'.site_url("admin").'/medicoes_pas_fases/update/'.$row['id'].'/'.$id_financeiro_medicoes.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_financeiro_medicoes.');" style="width: 130px;">deletar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/medicoes_pas_fases/delete/"+id+"/"+id2);
		}

		/*
		function open_modal(id){
			$("#actionModal").attr("href", "medicoes_pas_fases/delete/"+id);
		}		
		*/
	</script>