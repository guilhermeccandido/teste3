    <div class="container top">
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
              <?php echo ucfirst($this->uri->segment(2));?>
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
	  <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_empreendimentos = array();    
            foreach ($empreendimentos as $array) {
              foreach ($array as $key => $value) {
                $options_empreendimentos[$key] = $key;
              }
              break;
            }

            echo form_open("admin/empreendimentos", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_empreendimentos, $order, 'class="form-control"');

              $data_submit = array("name" => "mysubmit", "class" => "btn btn-primary", "value" => "Ir");

              $options_order_type = array("Asc" => "Asc", "Desc" => "Desc");
              echo form_dropdown("order_type", $options_order_type, $order_type_selected, 'class="form-control"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
            	<th class="header">#</th>
				<th class="yellow header headerSortDown">Código</th>
				<th class="yellow header headerSortDown">Empreendimento</th>
				<th class="yellow header headerSortDown">Observações</th>
				
	    				</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($empreendimentos as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['codigo'].'</td>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
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
	          echo '<td class="crud-actions">
            	  <a href="'.site_url("admin").'/anteprojetos/lista_anteprojetos/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Anteprojetos</a>	
                  <a href="'.site_url("admin").'/empreendimentos/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>
                </td>';
                echo "</tr>";
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>        </div>	
	<script>
		
		function open_modal(id){
			$("#actionModal").attr("href", "empreendimentos/delete/"+id);
		}
		
	</script>