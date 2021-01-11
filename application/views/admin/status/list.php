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
	        <li class="active">
	        	Configurações dos EVTEAS - Status
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Configurações dos EVTEAS - Status
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
            
            $options_modulos = array();
            foreach ($modulos as $row)
            {
            	$options_modulos[$row["id"]] = $row["titulo"];
            }
            
            $options_perfil = array();
            foreach ($perfil as $row)
            {
            	$options_perfil[$row["id"]] = $row["titulo"];
            }
           
            
            //save the columns names in a array that we will use as filter         
            $options_status = array();    
            foreach ($status as $array) {
              foreach ($array as $key => $value) {
                $options_status[$key] = $key;
              }
              break;
            }

            echo form_open("admin/status", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_status, $order, 'class="form-control"');

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
						<th class="yellow header headerSortDown">Status</th>
						<th class="yellow header headerSortDown">Peso</th>
						<th class="yellow header headerSortDown">Composição</th>
						<th class="yellow header headerSortDown">Tipo</th>
						<th class="yellow header headerSortDown">Próximo</th>
						<th class="yellow header headerSortDown">Executado por</th>
						<th class="yellow header headerSortDown">Perfil Responsável</th>
						<th class="yellow header headerSortDown">Módulo</th>
						<th class="yellow header headerSortDown">Descrição</th>
	    			</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($status as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$row['peso'].'</td>';
					echo '<td>'.$row['composicao'].'</td>';
					echo '<td>'.$row['tipo'].'</td>';
					echo '<td>';
					if(sizeof($row['next']) > 0 ){
						foreach($row['next'] as $item){
							echo $item['status'].'<br>';
						}
					}else{
						echo '---';
					}
					echo '</td>';
					echo '<td>';
					if(sizeof($row['perfil']) > 0 ){
						foreach($row['perfil'] as $item){
							echo $item['usuario_perfil'].'<br>';
						}
					}else{
						echo '---';
					}
					echo '</td>';
					echo '<td>';
					if($row['id_usuario_perfil']){
						echo $options_perfil[$row['id_usuario_perfil']];
					}else{
						echo '---';
					}
					echo '</td>';
					echo '<td>'.$options_modulos[$row['id_modulo']].'</td>';
					echo '<td>'.$row['descricao'].'</td>';
					
		          echo '<td class="crud-actions">
	        		  <a href="'.site_url("admin").'/status_status/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Interações</a>
	          		  <a href="'.site_url("admin").'/status_perfil/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Executado por</a>
	                  <a href="'.site_url("admin").'/status/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/status/delete/"+id);
		}

		$(function(){
			  $("table").tablesorter({
			    onRenderHeader: function(){
			      this.prepend('<span class="icon"></span>');
			    }
			  });
			});
		
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "status/delete/"+id);
		}		
		*/
	</script>