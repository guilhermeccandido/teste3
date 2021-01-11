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
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(2));?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php 
	              echo ucfirst($this->uri->segment(2));
	              if($usuarioPerfil['acesso'] == 'editar'){
			  ?>
	              	<a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
	          <?php 
	              }
              ?>
            </h2>
          </div>
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_contratos = array();    
            foreach ($contratos as $array) {
              foreach ($array as $key => $value) {
                $options_contratos[$key] = $key;
              }
              break;
            }
            
            $options_empresas = array( 0 => '' );
            foreach ($empresas as $array) {
            	$options_empresas[$array['id']] = $array['titulo'];
            }
            
            $options_intervencoes = array( 0 => '' );
            foreach ($intervencoes as $array) {
            	$options_intervencoes[$array['id']] = $array['titulo'];
            }
            

            echo form_open("admin/contratos", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_contratos, $order, 'class="form-control"');

              $data_submit = array("name" => "mysubmit", "class" => "btn btn-primary", "value" => "Ir");

              $options_order_type = array("Asc" => "Asc", "Desc" => "Desc");
              echo form_dropdown("order_type", $options_order_type, $order_type_selected, 'class="form-control"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	
				<?php
				/*
				 <th class="yellow header headerSortDown">Fiscal</th>
				 <th class="yellow header headerSortDown">Unidade Gestora</th>
				 <th class="yellow header headerSortDown">Situação</th>
				<th class="yellow header headerSortDown">Objeto</th>
				<th class="yellow header headerSortDown">Edital</th>
				
				<th class="yellow header headerSortDown">Data de Proposta/Base</th>
				<th class="yellow header headerSortDown">Data de Aprovação</th>
				<th class="yellow header headerSortDown">Data de Assinatura</th>
				<th class="yellow header headerSortDown">Data de Publicação</th>
				<th class="yellow header headerSortDown">Prazo</th>
				<th class="yellow header headerSortDown">Valor PI</th>
				<th class="yellow header headerSortDown">Valor Reajuste</th>
				<th class="yellow header headerSortDown">Valor Aditivo</th>				
				<th class="yellow header headerSortDown">Valor Medido (PI)</th>				
				<th class="yellow header headerSortDown">Valor Pago</th>				
				<th class="yellow header headerSortDown">Saldo de Empenho</th>
				<th class="yellow header headerSortDown">Observações</th>
				 
				 */
				?>
					<th class="header">#</th>
					<th class="yellow header headerSortDown">Contrato</th>
					<th class="yellow header headerSortDown">Início</th>
					<th class="yellow header headerSortDown">Término</th>
					<th class="yellow header headerSortDown">Valor Contrato</th>
					<th class="yellow header headerSortDown">Valor Medido</th>
					<th class="yellow header headerSortDown">Valor Medido Acumulado</th>
					
				</tr>
	            </thead>
	            <tbody>
	              <?php
	              /*
	                echo '<td>'.$row['fiscal'].'</td>';
					echo '<td>'.$row['local'].'</td>';
					echo '<td>'.$row['coordenacao'].'</td>';
	                echo '<td>'.$row['situacao'].'</td>';
					echo '<td>'.$row['objeto'].'</td>';
					echo '<td>'.$row['edital'].'</td>';
					echo '<td>'.$row['data_proposta_base'].'</td>';
					echo '<td>'.$row['data_aprovacao'].'</td>';
					echo '<td>'.$row['data_assinatura'].'</td>';
					echo '<td>'.$row['data_publicacao'].'</td>';
	                echo '<td>'.$row['prazo'].'</td>';
					echo '<td>'.$row['valor_pi'].'</td>';
					echo '<td>'.$row['valor_reajuste'].'</td>';
					echo '<td>'.$row['valor_aditivo'].'</td>';	               
					echo '<td>'.$row['valor_medido_pi'].'</td>';
					echo '<td>'.$row['valor_pago'].'</td>';					
					echo '<td>'.$row['saldo_empenho'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
	               */
	              foreach($contratos as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['contrato'].'</td>';						
					echo '<td>'.$row['data_ordem_inicio'].'</td>';
					echo '<td>'.$row['data_termino'].'</td>';					
					echo '<td>'.$row['valor_contrato'].'</td>';
					echo '<td>'.$row['valor_medido_pi'].'</td>';					
					echo '<td>'.$row['valor_medido_pi_r_acum'].'</td>';
				
		          echo '<td class="crud-actions">';
		          echo '<a href="'.site_url("admin").'/contratos_medicoes/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Medições</a>';
		          echo '<a href="'.site_url("admin").'/contratos_empenhos/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Empenhos</a>';
		          if($usuarioPerfil['acesso'] == 'editar'){
			         echo '<a href="'.site_url("admin").'/contratos/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
		                   <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>';	
		          }
		          
	              echo '</td>';
	              
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
		  </div> 	
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>              
		</div>       
	</div>
</div>	
	<script>
		
		function open_modal(id){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/contratos/delete/"+id);
		}

		$(function(){
		  $("table").tablesorter({
		    onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }
		  });
		});
	</script>