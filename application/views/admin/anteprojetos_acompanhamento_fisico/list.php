    <div class="container top">
		  <ul class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 
	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/anteprojetos'; ?>">
	          	Anteprojetos
	          </a> 
	          
	        </li>
	        <li class="active">
	          Acompanhamento Físico
	        </li>
	      </ul>
	      <div class="page-header users-header">
    		<h2>
              <?php echo 'Anteprojetos Documentos';?>
            </h2>
          </div>
	  <div class="row">
        <div class="span12 columns">
            <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
					<th class="yellow header headerSortDown" colspan="4" >Acompanhamento Físico</th>
				  </tr>
		        </thead>
		            <tbody>
		              <?php
		              
		              foreach($acompanhamento_fisico_not_defined as $row)
		              {
		              	echo '<tr>';
		              	echo '<td>'.$row['tipo'].'</td>';
		              	echo '<td colspan="2" style="color:red;">Esses registros não possuem nenhum dado adicionado.</td>';
		              	echo '<td class="crud-actions">
			                  <a href="'.site_url("admin").'/'.$this->uri->segment(2).'/add/'.$id_anteprojeto.'/'.$row['id'].'" class="btn btn-success">Adicionar</a>
			                </td>';
		              	echo "</tr>";
		              }
		              
		              
		              foreach($acompanhamento_fisico as $row)
		              {
		                echo '<tr>';
						echo '<td>'.$row['tipo'].'</td>';
						echo '<td colspan="2" >';
						foreach($row['list'] as $item){
							//print_r($item); 
							echo '<a href="'.site_url("admin").'/'.$this->uri->segment(2).'" class="btn btn-success">'.$item['tipo'].'</a>';
						}
						echo '</td>';
			          	echo '<td class="crud-actions" style="width:180px;">
		              		  <a href="'.site_url("admin").'/lista_acompanhamento_fisico/add/'.$id_anteprojeto.'/'.$row['id'].'" class="btn btn-info">Files</a>
			                  <a href="'.site_url("admin").'/anteprojetos_acompanhamento_fisico/update/'.$row['id'].'" class="btn btn-info">Editar</a>  
			              	  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_anteprojeto.');">deletar</a>	
			                </td>';
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
     </div>
     
     <script>
		
		function open_modal(id, id2){
			$("#actionModal").attr("href","<?php echo site_url("admin"); ?>" + "/anteprojetos_acompanhamento_fisico/delete/"+id+"/"+id2);
		}

		$(function(){
			  $("table").tablesorter({
			    onRenderHeader: function(){
			      this.prepend('<span class="icon"></span>');
			    }
			  });
			});
		
	</script>