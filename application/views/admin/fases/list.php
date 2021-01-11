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
	          Atividades/ Produtos 
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Configurações dos EVTEAS - Atividades/ Produtos 
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_fases = array();    
            foreach ($fases as $array) {
              foreach ($array as $key => $value) {
                $options_fases[$key] = $key;
              }
              break;
            }

            $options_modulos = array();
            foreach ($modulos as $row)
            {
            	$options_modulos[$row["id"]] = $row["titulo"];
            }
            
            $options_atividades = array( 1 => 'Atividade 1' ,  'Atividade 2',  'Atividade 3',  'Atividade 4',   'Atividade 5' ,  'Atividade 6' , 'Atividade 7', 
            								  'Atividade 8' ,  'Atividade 9',  'Atividade 10', 'Atividade 11' , 'Atividade 12',  'Atividade 13', 'Atividade 14',
            								  'Atividade 15',  'Atividade 16', 'Atividade 17', 'Atividade 18' , 'Atividade 19',  'Atividade 20', 'Atividade 21'
            );
            
            echo form_open("admin/fases", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_fases, $order, 'class="form-control"');

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
					<th class="yellow header headerSortDown">Fase</th>
					<th class="yellow header headerSortDown">Módulo</th>
					<th class="yellow header headerSortDown">Atividade</th>
					<th class="yellow header headerSortDown">Demanda</th>
					<th class="yellow header headerSortDown">Observvações</th>
    			  </tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($fases as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$options_modulos[$row['id_modulos']].'</td>';
					echo '<td>'.$options_atividades[$row['grupo']].'</td>';
					echo '<td>'.$row['demanda'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
		            echo '<td class="crud-actions">';
		          	  echo  '<a href="'.site_url("admin").'/fases_checklist/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Tarefas</a>';
		          	  echo   ($row['subfases'] == "true") ? '<a href="'.site_url("admin").'/subfases/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Subprodutos</a>' : '';
		              echo  '<a href="'.site_url("admin").'/fases/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>';
		              echo  '<a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].');" style="width: 130px;">deletar</a>';
	               	echo '</td>';
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/fases/delete/"+id);
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
			$("#actionModal").attr("href", "fases/delete/"+id);
		}		
		*/
	</script>