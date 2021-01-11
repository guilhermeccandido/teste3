<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	//print_r($usuarioPerfil);
	
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
	          <?php echo str_replace("_", " ", ucfirst("Atividades")) ;?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php 
    			echo 'LOTE '.$lote;
    			if($usuarioPerfil['acesso'] == 'editar'){ 
    		  ?>
              	<a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_pas; ?>" class="btn btn-success">Adicionar Novo</a>
              <?php } ?>	
              
              <a  href="<?php echo site_url("admin/pas/detalhes/".$id_pas);?>" class="btn btn-info glyphicon glyphicon-eye-open"  ></a>				
            </h2>
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
					<th class="yellow header headerSortDown">Produtos</th>
					<th class="yellow header headerSortDown">Progresso</th>
					<th class="yellow header headerSortDown">Status</th>
					<th class="yellow header headerSortDown">Última Avaliação</th>
					<th class="yellow header headerSortDown">Início Contratado</th>
					<th class="yellow header headerSortDown">Início planejado</th>
					<th class="yellow header headerSortDown">Início</th>
					<th class="yellow header headerSortDown">Fim Contratado</th>
					<th class="yellow header headerSortDown">Fim Planejado</th>
					<th class="yellow header headerSortDown">Fim</th>
				</tr>
	        </thead>
	        <tbody>
              <?php
              
              
			  $options_status = array();
              foreach ($status as $row)
              {
              	$options_status[$row["id"]] = array( 'titulo' => $row["titulo"], 'peso' => $row["peso"], 'composicao' => $row["composicao"]) ;
              }
              
              $options_avaliacoes = array();
              foreach ($avaliacoes as $row)
              {
              	$options_avaliacoes[$row["id"]] = array( 'titulo' => $row["titulo"], 'peso' => $row["peso"]) ;
              }
              /*
			  echo "<pre>";
              print_r($pas_fases);
              echo "</pre>";
              die;
              */
              
              
              foreach($pas_fases as $row)
              {
                echo "<tr>";
                  echo "<td>".$row['fases']."</td>";
               	  //echo "<td>".strstr($row['fases'], '-', true)."</td>";
               	  
                	if(sizeof($row["lastmov"]) > 0){
                		//$id_status 		= (sizeof($row["last_status"]) > 0 ) ? $row["last_status"]["id_status"] : 1;
                		$id_avaliacao 	= (sizeof($row["last_avaliation"]) > 0 ) ? $row["last_avaliation"]["id_avaliacoes"] : 1;
                		$progresso_total = (sizeof($row["progresso"]) > 0 ) ? $row["progresso"] : 0;
                		//$progresso_total = ($row["lastmov"]['status_peso'] + $row["lastmov"]['avaliacao_peso']); 
                		
                		echo '<td>
		                		<div class="progress progress-striped active">
			                		<div class="progress-bar"
			                				role="progressbar"
			                				aria-valuenow="'.$progresso_total.'"
			                				aria-valuemin="0"
			                				aria-valuemax="100"
			                				style="width: '.$progresso_total.'%">'.$progresso_total.'%
	                				</div>
                				</div>
                			</td>';
                		echo '<td>'.$options_status[$row["lastmov"]["id_status"]]['titulo'].'</td>';
                		echo '<td>';
              			echo $options_avaliacoes[$id_avaliacao]['titulo'];
                		echo '</td>';
                		echo '<td>'.date('d/m/Y', strtotime($row['data_ini'])).'</td>';
                		echo '<td>'.date('d/m/Y', strtotime($row['data_ini_planejada'])).'</td>';
                		echo '<td>';
                		echo (sizeof($row['start_date']) > 0 ) ? date('d/m/Y H:i:s', strtotime($row['start_date']['start_date']))  : 'Sem Registro';
                		echo '</td>';
                		echo '<td>'.date('d/m/Y', strtotime($row['data_fim'])).'</td>';
                		echo '<td>'.date('d/m/Y', strtotime($row['data_fim_planejada'])).'</td>';
                		if($progresso_total >= 100 ){
                			// TODO :  ACERTAR A DATA DO ÚLTIMO PROTOCOLO
                			echo '<td>'.date('d/m/Y H:i:s', strtotime($row["lastmov"]["data_protocolo"])).'</td>';
                			
                		}else{
                			
                			echo '<td>Em Andamento</td>';
                		}
                		
                		
                		
                	}else{
                		echo '<td>Não Iniciado</td>';
                		echo '<td>Não Iniciado</td>';
                		echo '<td>Sem Avaliação</td>';
                		echo '<td>'.$row['data_ini'].'</td>';
                		echo '<td>'.$row['data_ini_planejada'].'</td>';
                		echo '<td>Sem Registro</td>';
                		echo '<td>'.$row['data_fim'].'</td>';
                		echo '<td>'.$row['data_fim_planejada'].'</td>';
                		echo '<td>Sem Registro</td>';
                	}
                  

		          echo '<td class="crud-actions">';
		          
		          if($pas_status == 'Ativo' OR sizeof($row["lastmov"]) > 0){
		          	echo '<a href="'.site_url("admin").'/pas_fases_movimentacao/'.$id_pas.'/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Movimentações</a>';
		          }
		          if($row['subfases'] == 'true'){
		          	echo '<a href="'.site_url("admin").'/pas_financeiro_subfases/'.$id_pas.'/'.$row['id_fases'].'" class="btn btn-info" style="width: 130px;">Subprodutos</a>';
		          }
		            echo '<a href="'.site_url("admin").'/pas_fases/update/'.$row['id'].'/'.$id_pas.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>';
		            echo '<a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].', '.$id_pas.');" style="width: 130px;">deletar</a>';
		          echo '</td>';
	                echo "</tr>";
	              }
    	
	              foreach($pas_fases_not_defined as $row)
	              {
	              	echo '<tr>';
	              	echo "<td>".$row["titulo"]."</td>";
	              	echo '<td colspan="9" style="color:red;">Esses registros não possuem nenhum dado adicionado.</td>';
	              	echo '<td class="crud-actions">
			                  <a href="'.site_url("admin").'/'.$this->uri->segment(2).'/add/'.$id_pas.'/'.$row['id'].'" class="btn btn-success">Adicionar</a>
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
					    <p>
					    	A deleção desse registro irá deletar todas as movimentações associadas a ele!<br>
					    	Você realmente gostaria de Deletar esse Registro?
					    </p>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/pas_fases/delete/"+id+"/"+id2);
		}

		$(function(){
 		  $("table").tablesorter({
 		  onRenderHeader: function(){
 		      this.prepend('<span class="icon"></span>');
 		    }, 
 		    dateFormat: "uk",
 		  });
 		});
    
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "pas_fases/delete/"+id);
		}
		*/
	</script>