<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}
	
	$options_fases = array();
	foreach ($fases as $row)
	{	 
		$options_fases[$row["id"]] = $row["titulo"];
	}
	
	$options_subfases = array( 0 => '');
	foreach ($subfases as $row)
	{
		$options_subfases[$row["id"]] = $row["titulo"];
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
	        <li>
	          <a href="<?php echo site_url("admin/registro_financeiro"); ?>">
	             Registros Financeiros
	          </a>
	        </li>
	        <li class="active">
	          Produtos/Subprodutos
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Produtos/Subprodutos
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2).'/add/'.$id_registro_financeiro; ?>" class="btn btn-success">Adicionar Novo</a>
            </h2>
          </div>
          <?php
          		
          
          ?>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
						<th class="yellow header headerSortDown">Produto/Subprotudo</th>
						<th class="yellow header headerSortDown">Quantidade</th>
						<th class="yellow header headerSortDown">Valor</th>
						<th class="yellow header headerSortDown">Unidade</th>
	    			</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($financeiro_fases_subfases as $row)
	              {
	                echo "<tr id='".$row['id']."' >";
	                echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$options_fases[$row['id_fases']].'<br>'.$options_subfases[$row['id_subfases']].'</td>';
					echo '<td>';
					echo '<label>'.$row['quantidade'].'</label>';
					echo '<input type="text" value="'.$row['quantidade'].'" name="quantidade"  />';
					echo '</td>';
					echo '<td>';
					echo '<label>'.$row['valor'].'</label>';
					echo '<input type="text" value="'.$row['valor'].'" name="valor"  />';
					echo '</td>';
					echo '<td>';
					echo '<label>'.$row['unidade'].'</label>';
					echo '<input type="text" value="'.$row['unidade'].'" name="unidade"  />';
					echo '</td>';
					
		          echo '<td class="crud-actions">
	                  <a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].','.$id_registro_financeiro.');" style="width: 130px;">deletar</a>
	                </td>';
	                echo "</tr>";
	              }
	                  		
	              ?>      
	            </tbody>
	          </table>
	          <script>
				          
				            $( ".table td" ).on('click', function(e) {
								console.log( $( this ).text() );
								e.preventDefault();
								$(this).find('label').hide();
								$(this).find('input').show();
								$(this).find('select').show();
								$(this).find('input').focus();
							});
	
							$( ".table input" ).on('focusout', function(e) {
								e.preventDefault();
								
								var newValue = $( this ).val() ;
								var oldValue = $(this).prev().show().text(); 
								if(newValue == oldValue){
									console.log( 'igual' );
								}else{
									var idRow = $(this).closest('tr').attr('id');
									var nameRow = $( this ).attr('name');
									
									$(this).prev().show().text($( this ).val());
									exCall(idRow, newValue, nameRow);
									
								}
											
								$(this).hide();
								
								
							});
	
							
							$( ".table select" ).on('focusout', function(e) {
								
								e.preventDefault();
								
								var newValue = $( this ).val() ;
								var oldValue = $(this).prev().show().text(); 
								if(newValue == oldValue){
									console.log( 'igual' );
								}else{
									var idRow = $(this).closest('tr').attr('id');
									var nameRow = $( this ).attr('name');
									
									$(this).prev().show().text($( this ).find('option:selected').text());
									exCall(idRow, newValue, nameRow);
									
								}
											
								$(this).hide();
							});
	
							function exCall(idRow, newValue, nameRow ){
								
								$.ajax({
									  dataType: "json",
									  type: 	"POST",
									  url: "<?php echo base_url('financeiro_fases_subfases/edit_table') ?>",
									  data : { id: idRow, value: newValue, name : nameRow }
									})
									.done( function( data ) {
									    console.log('done');
									    console.log(data);
									})
									.fail( function( data ) {
									    console.log('fail');
									    console.log(data);
									});
								
							}
			            </script>
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
 <style>
	.panel-heading span {
	    margin-top: -18px;
	    margin-right: 5px;
	    font-size: 15px;
	}
	.clickable {
	    cursor: pointer;
	}

	 html{
	 	height: 100%
	 };
	 
     body{
     	height: 100%; 
     	margin: 0; 
     	padding: 0
     }
     
	 #map_canvas {
	  height: 100%;
	  width: 100%;
	}
	
	.table input {
	    display: none;
	    width: 40px;
	}
	
	.table select {
	    display: none;
	}
	
	.table label {
	    margin: 0;
	}
	
	.results tr[visible='false'],
	.no-result{
	  display:none;
	}
	
	.results tr[visible='true']{
	  display:table-row;
	}
	
	.counter{
	  padding:8px; 
	  color:#ccc;
	}
	
</style>
	<script>
		
		function open_modal(id, id2){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/financeiro_fases_subfases/delete/"+id+"/"+id2);
		}
		
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "financeiro_fases_subfases/delete/"+id);
		}		
		*/
	</script>