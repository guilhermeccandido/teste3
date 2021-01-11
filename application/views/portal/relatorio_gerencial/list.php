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
	          <?php echo 'Relatório Gerencial';?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php echo 'Relatório Gerencial';?>
            </h2>
          </div>
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_relatorio_gerencial = array();    
            foreach ($relatorio_gerencial as $array) {
              foreach ($array as $key => $value) {
                $options_relatorio_gerencial[$key] = $key;
              }
              break;
            }

            echo form_open("relatorio_gerencial/lista_relatorios", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_relatorio_gerencial, $order, 'class="form-control"');

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
					<th class="header">Relatório Gerencial</th>
					<th class="yellow header headerSortDown">Período do Relatório</th>
					<th class="yellow header headerSortDown">Descrição</th>
					<th class="yellow header headerSortDown">Observações</th>
	    		  </tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($relatorio_gerencial as $row)
	              {
	                echo '<tr>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$row['data_ini'].'</td>';
					echo '<td>'.$row['descricao'].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
					$link = '';
					 
					if(file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$row['id'].'/doc/'.$row['id'].'.'.$row['doc'])){
						$link .= '<a href="'.base_url().'assets/relatorios_gerenciais/'.$row['id'].'/doc/'.$row['id'].'.'.$row['doc'].'" target="_blank">
								<img src="'.base_url().'assets/img/icons/'.$row['doc'].'.jpg"  />
							  </a> ';
					}
					 
					if(file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$row['id'].'/pdf/'.$row['id'].'.'.$row['pdf'])){
						$link .= '<a href="'.base_url().'assets/relatorios_gerenciais/'.$row['id'].'/pdf/'.$row['id'].'.'.$row['pdf'].'" target="_blank">
								<img src="'.base_url().'assets/img/icons/'.$row['pdf'].'.jpg"  />
							  </a> ';
					}
					
					if(file_exists(RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$row['id'].'/colecao/'.$row['id'].'.'.$row['colecao'])){
						$link .= '<a href="'.base_url().'assets/relatorios_gerenciais/'.$row['id'].'/colecao/'.$row['id'].'.'.$row['colecao'].'" target="_blank">
								<img src="'.base_url().'assets/img/icons/'.$row['colecao'].'.jpg"  />
							  </a> ';
					}
					
					if($link){
						echo ' <div id="myModal'.$row['id'].'" class="modal fade" role="dialog">
								 <div class="modal-dialog">
							 	   <div class="modal-content">
	          						 <div class="modal-header">
								      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								      <h3>Download de Arquivos</h3>
								     </div>
								     <div class="modal-body">
								      <p>O documento selecionado encontra-se disponível nos seguintes formatos:</p>'.
													      $link.'
								     </div>
								    <div class="modal-footer">
								     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								    </div>
								  </div>
            				    </div>
						       </div>';
						$btClass = 'btn-info';
					}else{
						$btClass = 'btn-default';
					}
					
					
		          echo '<td class="crud-actions">
              		  <a href="#myModal'.$row['id'].'" class="btn '.$btClass.'" data-toggle="modal" style="width: 130px;">Documentos</a>
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
		
		function open_modal(id){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/relatorio_gerencial/delete/"+id);
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
			$("#actionModal").attr("href", "relatorio_gerencial/delete/"+id);
		}		
		*/
	</script>