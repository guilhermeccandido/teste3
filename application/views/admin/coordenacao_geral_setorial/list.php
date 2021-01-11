<div class="container-fluid">		  
	<div class="row">	  	  
		<div class="main">
		  <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo 'home';?>
	          </a> 	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/coordenacao_geral'; ?>">
	            <?php echo 'Coordenação Geral';?>
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo 'Coordenações Setoriais';?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php echo 'Coordenações Setoriais';?>
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_coordenacao_geral; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <?php 
          	//<div class="well">
          ?>
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           /*
            //save the columns names in a array that we will use as filter         
            $options_coordenacao_geral_setorial = array();    
            foreach ($coordenacao_geral_setorial as $array) {
              foreach ($array as $key => $value) {
                $options_coordenacao_geral_setorial[$key] = $key;
              }
              break;
            }

            echo form_open("admin/coordenacao_geral_setorial", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_coordenacao_geral_setorial, $order, 'class="form-control"');

              $data_submit = array("name" => "mysubmit", "class" => "btn btn-primary", "value" => "Ir");

              $options_order_type = array("Asc" => "Asc", "Desc" => "Desc");
              echo form_dropdown("order_type", $options_order_type, $order_type_selected, 'class="form-control"');

              echo form_submit($data_submit);

            echo form_close();
            */
            ?>

          <?php //</div> ?>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
					<th class="yellow header headerSortDown">Coordenação Setorial</th>
				
	    				</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($coordenacao_geral_setorial as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['coordenacao_setorial'].'</td>';
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
	                  <a href="'.site_url("admin").'/coordenacao_geral_setorial/update/'.$row['id'].'/'.$id_coordenacao_geral.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_coordenacao_geral.' );" style="width: 130px;">deletar</a>
	                </td>';
	                echo "</tr>";
	              }
	              ?>      
	            </tbody>
	          </table>
		  </div> 	
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>              
		</div>       
	</div>
</div>	
	<script>
		
		function open_modal(id, id2){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/coordenacao_geral_setorial/delete/"+id+"/"+id2);
		}

		/*
		function open_modal(id){
			$("#actionModal").attr("href", "coordenacao_geral_setorial/delete/"+id);
		}		
		*/
	</script>