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
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            Orçamento
	          </a>	          
	        </li>
	        <li class="active">
	          Projeções
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Projeções
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add_projecao/<?php echo $this->uri->segment(4); ?>" class="btn btn-success">Adicionar Linha</a>
            </h2>
          </div>
          
           
            <?php
            
            $id_projecao = $this->uri->segment(4);
            
            
            $options_geral = array();
            foreach ($coordenacao_geral as $row) {
            	$options_geral[$row['id']] = $row['titulo'];
            };
            
			$options_setorial = array();
            foreach ($coordenacao_setorial as $row) {
            		$options_setorial[$row['id']] = $row['titulo'];
            };
            
            $options_programas = array();
            foreach ($programas as $row) {
            		$options_programas[$row['id']] = $row['titulo'];
            };
            
            $options_empresas = array();
            foreach ($empresas as $row) {
            		$options_empresas[$row['titulo']] = $row['titulo'];
            };
            
           /*
            * <div class="well">
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_orcamento = array();    
            foreach ($projecoes as $array) {
              foreach ($array as $key => $value) {
                $options_orcamento[$key] = $key;
              }
              break;
            }

            echo form_open("admin/orcamento/projecoes/".$this->uri->segment(4), $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected, 'class="form-control"');

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_orcamento, $order, 'class="form-control"');

              $data_submit = array("name" => "mysubmit", "class" => "btn btn-primary", "value" => "Ir");

              $options_order_type = array("Asc" => "Asc", "Desc" => "Desc");
              echo form_dropdown("order_type", $options_order_type, $order_type_selected, 'class="form-control"');

              echo form_submit($data_submit);

            echo form_close();
            </div>
            */
            ?>

          
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">Coordenação Geral</th>
						<th class="header ">Coordenação Setorial</th>
						<th class="header ">Programa</th>
						<th class="header ">Edital</th>
						<th class="header ">Contrato</th>
						<th class="header ">Empresa</th>
						<th class="header ">RAP</th>
						<th class="header ">Medições Processadas não Pagas</th>
						<th class="header ">Jan</th>
						<th class="header ">Fev</th>
						<th class="header ">Mar</th>
						<th class="header ">Abr</th>
						<th class="header ">Mai</th>
						<th class="header ">Jun</th>
						<th class="header ">Jul</th>
						<th class="header ">Ago</th>
						<th class="header ">Set</th>
						<th class="header ">Out</th>
						<th class="header ">Nov</th>
						<th class="header ">Dez</th>
						
					</tr>
		            </thead>
		            <tbody>
		              <?php
		              
		              foreach($projecoes as $row)
		              {
		                echo '<tr id="'.$row['id'].'">';
						echo '<td>';
						//echo	$row['coordenacao_geral'];
						echo '<label>'.$options_geral[$row['coordenacao_geral'] ].'</label>';
						//echo '<input type="text" name="cordenacao_geral" value="'.$row['coordenacao_geral'].'" />';	
						echo form_dropdown("coordenacao_geral", $options_geral, $row['coordenacao_geral']);
						echo '</td>';
						echo '<td>';
						echo '<label>'.$options_setorial[$row['coordenacao_setorial']].'</label>';
	          			echo form_dropdown("coordenacao_setorial", $options_setorial, $row['coordenacao_setorial']);
	          			echo '</td>';					
						echo '<td>';
           				echo '<label>'.$options_programas[$row['programa']].'</label>';
           				echo form_dropdown("programa", $options_programas, $row['programa']);
           				echo '</td>';					
						echo '<td>';
            			echo '<label>'.$row['edital'].'</label>';
            			echo '<input type="text" name="edital" value="'.$row['edital'].'" class="table-input" />';
            			echo '</td>';
						echo '<td>';
            			echo '<label>'.$row['contrato'].'</label>';
            			echo '<input type="text" name="contrato" value="'.$row['contrato'].'" class="table-input" />';
            			echo '</td>';					
						echo '<td>';
            			echo '<label>'.$row['empresa'].'</label>';
            			echo form_dropdown("empresa", $options_empresas, $row['empresa']);
            			echo '</td>';
						echo '<td>';
            			echo '<label>'.$row['rap'].'</label>';
            			echo '<input type="text" name="rap" value="'.$row['rap'].'" class="table-input" />';
            			echo '</td>';					
						echo '<td>';
            			echo '<label>'.$row['medicoes_processadas_n_pagas_ano_anterior'].'</label>';
            			echo '<input type="text" name="medicoes_processadas_n_pagas_ano_anterior" value="'.$row['medicoes_processadas_n_pagas_ano_anterior'].'" class="table-input" />';
            			echo '</td>';
            			echo '<td>';
            			echo '<label>'.$row['jan'].'</label>';
            			echo '<input type="text" name="jan" value="'.$row['jan'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['fev'].'</label>';
            			echo '<input type="text" name="fev" value="'.$row['fev'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['mar'].'</label>';
            			echo '<input type="text" name="mar" value="'.$row['mar'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['abr'].'</label>';
            			echo '<input type="text" name="abr" value="'.$row['abr'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['mai'].'</label>';
            			echo '<input type="text" name="mai" value="'.$row['mai'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['jun'].'</label>';
            			echo '<input type="text" name="" value="jun'.$row['jun'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['jul'].'</label>';
            			echo '<input type="text" name="" value="jul'.$row['jul'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['ago'].'</label>';
            			echo '<input type="text" name="" value="ago'.$row['ago'].'" class="table-input" />';
            			echo '</td>'; 	 
            			echo '<td>';
            			echo '<label>'.$row['set'].'</label>';
            			echo '<input type="text" name="set" value="'.$row['set'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['out'].'</label>';
            			echo '<input type="text" name="out" value="'.$row['out'].'" class="table-input" />';
            			echo '</td>';            			 
            			echo '<td>';
            			echo '<label>'.$row['nov'].'</label>';
            			echo '<input type="text" name="nov" value="'.$row['nov'].'" class="table-input" />';
            			echo '</td>';            			
            			echo '<td>';
            			echo '<label>'.$row['dez'].'</label>';
            			echo '<input type="text" name="dez" value="'.$row['dez'].'" class="table-input" />';
            			echo '</td>';
            			/*
            			echo '<td>';
            			echo '<label>'.$row[''].'</label>';
            			echo '<input type="date" name="" value="'.$row[''].'" class="table-input" />';
            			echo '</td>';
            			*/
            			echo '<td class="crud-actions">';
            			echo '<a href="#myModal" class="btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="open_modal('.$id_projecao.','.$row['id'].');" style="width: 130px;">deletar</a>';
            			echo '</td>';
						echo '<td></td>';
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
 <style>
 
	.table input {
	    display: none;
	}
	
	.table select {
	    display: none;
	}
	
</style>
 	
	<script>
		
		function open_modal(id, id2){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/orcamento/delete_projecao/"+id+"/"+id2 );
		}

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
				  url: "<?php echo base_url().'orcamento/editTable' ?>",
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


		
		/*
		function open_modal(id){
			$("#actionModal").attr("href", "orcamento/delete/"+id);
		}		
		*/
	</script>