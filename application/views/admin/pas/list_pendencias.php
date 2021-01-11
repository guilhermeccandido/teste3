<div class="panel-body table-responsive" id="pendencias-table" >

<table class="table table-striped table-bordered table-condensed editable" >
            <thead>
              <tr>
            	<th class="header">ID</th>
				<th class="yellow header headerSortDown">Descrição</th>
				<th class="yellow header headerSortDown">Responsabilidade</th>
				<th class="yellow header headerSortDown">Prioridade</th>
			  </tr>
	        </thead>
	            <tbody>
	              <?php
	              
	              $options_pendencias = array();
	              foreach ($lista_pendencias as $row) {
	              	$options_pendencias[$row['id']] = $row['titulo'];
	              };
	              
	              
	              foreach($pendencias as $row)
	              {
	                echo '<tr class="alert alert-'.$row['categoria'].'" id="'.$row['id'].'">';
	                echo '<td >';
	                echo $row['identificacao'];
	                //echo '<a class="btn btn-xs btn-circle btn-danger" ><li class="fa fa-minus"></li></a>';
	                echo '</td>';
					echo '<td>';
					echo '<label>'.$row['titulo'].'</label>';
					echo '<input type="text" name="titulo" value="'.$row['titulo'].'" class="table-input" />';
					echo '</td>';
					echo '<td>';
					echo '<label>'.$row['responsabilidade'].'</label>';
					echo '<input type="text" name="responsabilidade" value="'.$row['responsabilidade'].'" class="table-input" />';
					echo '</td>';
					echo '<td>';
					echo '<label>'.$row['pendencias'].'</label>';
					echo form_dropdown("id_pendencias", $options_pendencias, $row['pendencias']);
					echo '</td>';
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
					  url: "<?php echo base_url().'admin/pas/edit_table_pendencias' ?>",
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