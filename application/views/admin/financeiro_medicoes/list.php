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
	          <a href="<?php echo site_url("admin/registro_financeiro"); ?>">
	            Registro Financeiro
	          </a>
	        </li>
	        <li class="active">
	          Medições
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Medições
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/add/'.$id_registro_financeiro; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
						<th class="yellow header headerSortDown">Medição</th>
						<th class="yellow header headerSortDown">Data</th>
						<th class="yellow header headerSortDown">Acréscimos</th>
						<th class="yellow header headerSortDown">Descontos</th>
						<th class="yellow header headerSortDown">Total</th>
						<th class="yellow header headerSortDown">Observações</th>
					</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($financeiro_medicoes as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$row['data'].'</td>';
					echo '<td>R$ '. number_format($row['acrecimos'],4,",",".").'</td>';
					echo '<td>R$ '. number_format($row['descontos'],4,",",".").'</td>';
					echo '<td>R$ '. number_format($row['total'],4,",",".").'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
		          echo '<td class="crud-actions">
	            	  <a href="'.site_url("admin").'/medicoes_pas_fases/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Produtos</a>
	                  <a href="'.site_url("admin").'/financeiro_medicoes/update/'.$row['id'].'/'.$id_registro_financeiro.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_registro_financeiro.');" style="width: 130px;">deletar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/financeiro_medicoes/delete/"+id+"/"+id2);
		}

		/*
		function open_modal(id){
			$("#actionModal").attr("href", "financeiro_medicoes/delete/"+id);
		}		
		*/
	</script>