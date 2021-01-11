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
           
            
            $options_direct_link = array('true' => 'Sim', 'false' => 'Não');
            $options_tipo = array('principal' => 'Principal', 'acesso' => 'Acesso');            
            
            ?>

          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	            <tr>
		            <th class="header">#</th>
					<th class="yellow header headerSortDown">Módulo</th>
					<th class="yellow header headerSortDown">Alias</th>
					<th class="yellow header headerSortDown">Acesso Direto</th>
					<th class="yellow header headerSortDown">Tipo</th>
					<th class="yellow header headerSortDown">Observações</th>
				</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($modulos as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['titulo'].'</td>';
					echo '<td>'.$row['alias'].'</td>';
					echo '<td>'.$options_direct_link[$row['direct_link']].'</td>';
					echo '<td>'.$options_tipo[$row['tipo']].'</td>';
					echo '<td>'.$row['observacoes'].'</td>';
					
		          echo '<td class="crud-actions">';
		         
		          	echo '<a href="'.site_url("admin").'/modulos_modulos/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Módulos</a>';
		            echo '<a href="'.site_url("admin").'/modulos/update/'.$row['id'].'" class="btn btn-info" style="width: 130px;">Ver & editar</a>
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
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/modulos/delete/"+id);
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
			$("#actionModal").attr("href", "modulos/delete/"+id);
		}		
		*/
	</script>