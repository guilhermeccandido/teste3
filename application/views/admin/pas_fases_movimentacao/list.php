<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

	$options_status = array();
	foreach ($status as $row)
	{
		$options_status[$row["id"]] = array( 'titulo' => $row["titulo"], 'peso' => $row["peso"], 'composicao' => $row["composicao"]) ;
	}
	
	$options_avaliacoes = array();
	foreach ($avaliacoes as $row)
	{
		$options_avaliacoes[$row["id"]] = array( 'titulo' => $row["titulo"], 'peso' => $row["peso"]) ;
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
	          <a href="<?php echo site_url("admin").'/gestao_estudos_projetos'; ?>">
	            Gestão de Estudos e Projetos
	          </a> 	          
	        </li>
    		<li>
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	            EVTEAS
	          </a> 	          
	        </li>
    		<li>
	          <a href="<?php echo site_url("admin").'/pas_fases/'.$id_pas; ?>">
	            <?php echo str_replace("_", " ", ucfirst("atividades")) ;?>
	          </a> 	          
	        </li>
	        <li class="active">
	          <?php echo 'LOTE '.$lote.' – Atividade '.$fases[0]['grupo'] ; ?>
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              <?php echo $fases[0]['titulo']; 
    			if($usuarioPerfil['acesso'] == 'editar'){ 
    		  ?>
              	<a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add/<?php echo $id_pas.'/'.$id_pas_fases; ?>" class="btn btn-success">Adicionar Novo</a>
              <?php
              	}		
              ?>	
              <a  href="#myChart" data-toggle="modal" class="btn btn-info glyphicon glyphicon-signal" onclick="drawChart_stock_div2('get_cronograma_produto_id_fases/<?php echo $id_pas.'/'.$id_pas_fases; ?>');" ></a>
              <a  href="<?php echo site_url("admin/pas/detalhes/".$id_pas);?>" class="btn btn-info glyphicon glyphicon-eye-open"  ></a>				
            </h2>
          </div>
          <div id="stock_div1"></div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed">
	            <thead>
	              <tr>
	            	<th class="header">#</th>
	            	<th class="yellow header headerSortDown">Status</th>
					<th class="yellow header headerSortDown">Avaliação</th>
					<th class="yellow header headerSortDown">Data Ocorrência</th>
					<th class="yellow header headerSortDown">Descrição</th>
					<th class="yellow header headerSortDown">Progresso</th>
				</tr>
	        </thead>
	        <tbody>
              <?php
              
              $tmpStatus = 0;
              $tmpAvaliacao = 0;
              $first = true;
              $pediodoTable = '';
              
              foreach($pas_fases_movimentacao as $row)
              {
              	
              	/*
              	 
              	if($options_status[$row["id_status"]]['peso'] == 'Simples') 
              	echo $options_status[$row["id_status"]]['composicao'] ;
              	echo '<br>';
              	print_r($options_status);
              	
              	*/
              	
              	if($options_status[$row["id_status"]]['peso'] <> 0){
              		$tmpStatus = $options_status[$row["id_status"]]['peso'];
              		$protocol = false;
              	}else{
              		$protocol = true;
              	}
              	
              	if($options_avaliacoes[$row["id_avaliacoes"]]['peso'] <> 0){
              		$tmpAvaliacao = $options_avaliacoes[$row["id_avaliacoes"]]['peso'];
              	}
              	//echo $options_status[$row["id_status"]]['titulo']."<br>";
              	//echo $tmpStatus." ".$tmpAvaliacao."<br>";
              	$progresso_total = (($options_status[$row["id_status"]]['composicao'] == 'Simples') AND (!$protocol)) ? $tmpStatus : ($tmpStatus + $tmpAvaliacao );
              	//$progresso_total =  ($options_status[$row["id_status"]]['composicao'] == 'Simples') ?  $options_status[$row["id_status"]]['peso'] : $options_avaliacoes[$row["id_avaliacoes"]]['peso'] ;
              	//$progresso_total =  $options_status[$row["id_status"]]['peso'] + $options_avaliacoes[$row["id_avaliacoes"]]['peso'] ;
              	
              	if($first){
              		$progresso_temp = $progresso_total;
              		$first = false;
              	}else if($progresso_total > $progresso_temp){
              		$progresso_temp = $progresso_total;
              	}
              	
              	if($progresso_temp > 100){
              		$progresso_temp = 100;
              	}
              	
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$options_status[$row["id_status"]]['titulo']."</td>";
				echo "<td>".$options_avaliacoes[$row["id_avaliacoes"]]['titulo']."</td>";
				echo '<td>'.date('d/m/Y H:i:s', strtotime($row['data_protocolo'])).'</td>';
				echo '<td>'.$row['descricao'].'</td>';
				echo '<td>
			             <div class="progress progress-striped active">
			        		<div class="progress-bar"
			        			role="progressbar"
			        			aria-valuenow="'.$progresso_temp.'"
			        			aria-valuemin="0"
			        			aria-valuemax="100"
			        			style="width: '.$progresso_temp.'%">'.$progresso_temp.'%
			        		</div>
			      		</div>
            		  </td>';
				
				
		          echo '<td class="crud-actions">';
		          $filename = PAS_FOLDER . $id_pas.'/documentos/'.$row['file'];
		          if(file_exists($filename) AND $row['file']){
		          	 echo 	'<a id="show_file" href="'.base_url().'assets/gestao_estudos_projetos/pas/'.$id_pas.'/documentos/'.$row['file'].'" class="btn btn-info" style="width: 130px;">Documento</a>';
		          }
	              echo 	'<a href="'.site_url("admin").'/pas_fases_movimentacao/update/'.$id_pas.'/'.$row['id'].'/'.$id_pas_fases.'" class="btn btn-info" style="width: 130px;">Ver & editar</a>';
	              echo 	'<a href="#myModal" class="btn btn-danger" data-toggle="modal" onclick="open_modal('.$row['id'].', '.$id_pas_fases.');" style="width: 130px;">deletar</a>';
	              echo '</td>';
	                echo "</tr>";
	                
	              }
	              
	             // $pediodoTable.= '["'.$statusTitulo.'", new Date('.date('Y,m,d', strtotime($dataProtocolo)).'),new Date('.date('Y,m,d', strtotime(date("Y-m-d"))).') ]';
	    	
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


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
    
		function open_modal(id, id2){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/pas_fases_movimentacao/delete/<?php echo $id_pas ?>/"+id+"/"+id2);
		}


		$(function(){
	 		  $("table").tablesorter({
	 		  onRenderHeader: function(){
	 		      this.prepend('<span class="icon"></span>');
	 		    }, 
	 		    dateFormat: "uk",
	 		  });
	 		});


		
		
	 google.load('visualization', '1.0', { packages:['timeline'], language:'br'}); 
	 
	function drawChart_stock_div2(string) { 
		
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/pas/" + string ,
            data:{position:'teste'},
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
            	var data = new google.visualization.DataTable(response.result);
            	var numRows = data.getNumberOfRows();
            	var colors = [];
    		    var colorMap = response.colorMap;
    		    
    		    colorMap['Hoje'] = 'BLACK';
    		    
    		    for (var i = 0; i < numRows; i++) {
    		        colors.push(colorMap[data.getValue(i, 1)]);
    		    };
    		    
    		    var options_chart = {
    					"title":"Perido", 
    					"avoidOverlappingGridLines":false,
    					"colorByRowLabel":true,
    					colors: colors,
    			}; 
    			
    			var chart = new google.visualization.Timeline(document.getElementById('stock_div1')); 
    			
    			chart.draw(data, options_chart);   
    			
               
            },
            error: function(xhr, status, error) {
                
            }
        });
        
		 
			
	}; 

	function deleteFile(id){
		
		console.log(id);
		
		var url = "<?php echo base_url().'admin/pas_fases_movimentacao/delete_file/'.$id_pas.'/' ?>" + id;
		$.ajax({
		  dataType: "json",
		  url: url
		});
		$( "#show_file" ).fadeOut( "fast", function() {});
		$( "#del_file" ).fadeOut( "fast", function() {});
		
	}
</script>
	
	
	