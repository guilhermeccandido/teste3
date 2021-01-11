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
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(2));?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php echo ucfirst($this->uri->segment(2));?>
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            $options_coordenacao_geral = array(0  => 'SEM RELACIONAMENTO DEFINIDO');
            foreach($coordenacao_geral as $row){
            	$options_coordenacao_geral[$row['id']] = $row['titulo'];
            }
            
            $options_coordenacao_setorial = array(0  => 'SEM RELACIONAMENTO DEFINIDO');
            foreach($coordenacao_setorial as $row){
            	$options_coordenacao_setorial[$row['id']] = $row['titulo'];
            }
            
            $options_programas = array(0  => 'SEM RELACIONAMENTO DEFINIDO');
            foreach($programas as $row){
            	$options_programas[$row['id']] = $row['titulo'];
            }
            
            $options_contratos = array();
            foreach($contratos as $row){
            	$options_contratos[$row['id']] = $row['contrato'];
            }
            
            
            //save the columns names in a array that we will use as filter         
            $options_contratos_relacoes = array();    
            foreach ($contratos_relacoes as $array) {
              foreach ($array as $key => $value) {
                $options_contratos_relacoes[$key] = $key;
              }
              break;
            }

            echo form_open("admin/contratos_relacoes", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_contratos_relacoes, $order, 'class="form-control"');

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
	            		<th class="header">#</th>
						<th class="yellow header headerSortDown">Coordenação Geral</th>
						<th class="yellow header headerSortDown">Coordenação Setorial</th>
						<th class="yellow header headerSortDown">Programa</th>
						<th class="yellow header headerSortDown">Contrato</th>
						<th class="yellow header headerSortDown">Observações</th>
	    		  </tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($contratos_not_include as $row){
	              	echo '<tr>';
	              		echo '<td>#</td>';
						echo '<td >'.$row['contrato'].'</td>';
						echo '<td style="color:red;">Esse contrato não possui nenhum relacionamento ainda</td>';
						echo '<td style="color:red;">Esse contrato não possui nenhum relacionamento ainda</td>';
						echo '<td style="color:red;">Esse contrato não possui nenhum relacionamento ainda</td>';
						echo '<td style="color:red;">Esse contrato não possui nenhum relacionamento ainda</td>';
						echo '<td class="crud-actions">
				                  <a href="'.site_url("admin").'/contratos_relacoes/add/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Add</a>
				                </td>';
						echo "</tr>";
					echo "</tr>";
	              }
	              
	              
	              foreach($contratos_relacoes as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
	                $red = $row['coordenacao_geral'] ? '' : 'style="color:red;"'; 
	                echo '<td '.$red.'>'.$options_coordenacao_geral[$row['coordenacao_geral']].'</td>';
	                $red = $row['coordenacao_setorial'] ? '' : 'style="color:red;"';
					echo '<td '.$red.'>'.$options_coordenacao_setorial[$row['coordenacao_setorial']].'</td>';
					$red = $row['programa'] ? '' : 'style="color:red;"';
					echo '<td '.$red.'>'.$options_programas[$row['programa']].'</td>';
					echo '<td>'.$row['contrato'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
		          echo '<td class="crud-actions">
	                  <a href="'.site_url("admin").'/contratos_relacoes/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
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
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>              
		</div>       
	</div>
</div>	
	<script>
		
		function open_modal(id){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/contratos_relacoes/delete/"+id);
		}

		$(function(){
		  $("table").tablesorter({
		    onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }
		  });
		});
	</script>