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
	          Localização
	        </li>
	      </ul>
	      <div class="page-header users-header">
    		<h2>
              Localização
            </h2>
          </div>
	  <div class="row">
        <div class="span12 columns">          
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
            	<th class="header">#</th>
				<th class="yellow header headerSortDown" colspan="4" >Localização</th>
	    		</tr>
	            </thead>
	            <tbody>
	              <?php
	              
	              foreach($localizacao_not_defined as $row)
	              {
	              	echo '<tr>';
	              	echo '<td>'.$row['id'].'</td>';
	              	echo '<td>'.$row['tipo'].'</td>';
	              	echo '<td colspan="2" style="color:red;">Esses registros não possuem nenhum dado adicionado.</td>';
	              	echo '<td class="crud-actions">
			                  <a href="'.site_url("admin").'/'.$this->uri->segment(2).'/add/'.$id_anteprojeto.'/'.$row['id'].'" class="btn btn-success">Adicionar</a>
			                </td>';
	              	echo "</tr>";
	              }
	              
	              foreach($anteprojetos_localizacao as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['tipo'].'</td>';
					
					
	          echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/anteprojetos_localizacao/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_anteprojeto.');" style="width: 130px;">deletar</a>
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

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>        
    </div>	
	<script>
		
	function open_modal(id, id2){
		$("#actionModal").attr("href","<?php echo site_url("admin"); ?>" + "/anteprojetos_localizacao/delete/"+id+"/"+id2);
	}

	$(function(){
		  $("table").tablesorter({
		    onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }
		  });
		});
		
	</script>