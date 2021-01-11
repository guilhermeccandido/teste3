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
	        	Configurações dos EVTEAS - Cronogramas
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Configurações dos EVTEAS - Cronogramas
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            $options_contratos = array();
            foreach ($contratos as $row)
            {
            	$options_contratos[$row["id"]] = $row["contrato"];
            }
            
            //save the columns names in a array that we will use as filter         
            $options_pas_prazos = array();    
            foreach ($pas_prazos as $array) {
              foreach ($array as $key => $value) {
                $options_pas_prazos[$key] = $key;
              }
              break;
            }

            echo form_open("admin/pas_prazos", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_pas_prazos, $order, 'class="form-control"');

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
					<th class="yellow header headerSortDown">Título</th>
					<th class="yellow header headerSortDown">Contrato</th>
					<th class="yellow header headerSortDown">Data Base</th>
					<th class="yellow header headerSortDown">Descrição</th>
					</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($pas_prazos as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$options_contratos[$row['id_contrato']].'</td>';
					echo '<td>'.$row['date_ini'].'</td>';
					echo '<td>'.$row['descricao'].'</td>';
					
		          echo '<td class="crud-actions">
			 		  <a href="'.site_url("admin").'/pas_prazos_fases/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Atividades</a>
	                  <a href="'.site_url("admin").'/pas_prazos/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/pas_prazos/delete/"+id);
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
			$("#actionModal").attr("href", "pas_prazos/delete/"+id);
		}		
		*/
	</script>