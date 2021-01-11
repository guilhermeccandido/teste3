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
	          <a href="<?php echo site_url("admin/fases"); ?>">
	            Atividades/ Produtos 
	          </a>
	        </li>
	        <li class="active">
	          Subprodutos
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              	Configurações dos EVTEAS - Subprodutos
              <a  href="<?php echo base_url("admin/subfases/add/".$id_fases);?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
				<th class="yellow header headerSortDown">Sub Produto</th>
				<th class="yellow header headerSortDown">Demanda</th>
				<th class="yellow header headerSortDown">Observações</th>
				
	    				</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($subfases as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$row['demanda'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
		          echo '<td class="crud-actions">
	                  <a href="'.site_url("admin").'/subfases/update/'.$row['id'].'/'.$id_fases.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>
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
		</div>       
	</div>
</div>	
	<script>
		
		function open_modal(id){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/subfases/delete/"+id);
		}

		/*
		function open_modal(id){
			$("#actionModal").attr("href", "subfases/delete/"+id);
		}		
		*/
	</script>