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
	            Home
	          </a> 	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("gestao_estudos_projetos"); ?>">
	            Gestão de Estudos e Projetos
	          </a> 	          
	        </li>
	        <li class="active">
	          Contratos
	        </li>
	      </ol>
	      <div class="page-header users-header">
    		<h2>
              Contratos
            </h2>
          </div>
          <div class="well well-pas">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            ?>

             <div class="form-group form-inline reset-margin">
             	<?php echo  form_label("Buscar:", "search_string"); ?>
             	<label></label>
			    <input type="text" class="search form-control" placeholder="Oque você está procurando?">
			</div>
			
			
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed  table-hover results">
	            <thead>
	              <tr>
					<th class="yellow header headerSortDown">Contrato</th>
					<th class="yellow header headerSortDown">Empresa Executora</th>
					<th class="yellow header headerSortDown">Quantidade de Lotes Iniciados</th>
					<th class="yellow header headerSortDown">Extensão dos Total do Lotes Iniciados</th>
					<th class="yellow header headerSortDown">Status</th>
				    <tr class="warning no-result">
			      	<td colspan="10"><i class="fa fa-warning"></i>Sem Resultados</td>
			      </tr>
	            </thead>
	            <tbody>
	              <?php
	             
	              foreach($contratos as $row)
	              {
	                echo '<tr>';
					  echo '<td  scope="row" >'.$row['contrato'].'</td>';
					  echo '<td  scope="row" >'.$row['empresa'].'</td>';		
					  echo '<td  scope="row" >'.$row['iniciados'].'</td>';		
					  echo '<td  scope="row" >'.$row['extensao'].'</td>';		
					  echo '<td  scope="row" >'.$row['status'].'</td>';		
			          echo '<td class="crud-actions">';
			          echo '<a href="'.site_url("admin").'/pas/contratos/'.$row['id'].'" class="btn btn-info" style="width: 130px;">EVTEA</a>';
		              echo '</td>';
	              
	                echo "</tr>";
	              }
	              ?>      
	            </tbody>
	          </table>
		  </div> 	           
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
var djConfig = {
        locale: "pt-br",
        parseOnLoad: false,
        packages: [
             {
                 name: 'agsjs',
                 "location":  "<?php echo base_url('assets/portal/js/widget/'); ?>"
             },
        ],
        async: false
    };
	
		
		function open_modal(id){
			$("#actionModal").attr("href", "<?php echo site_url("admin")?>/contratos/delete/"+id);
		}

		$(function(){
		  $("table").tablesorter({
		    onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }
		  });
		});

		$(document).ready(function() {
			App.init();
			
			  $(".search").keyup(function () {
			    var searchTerm = $(".search").val();
			    var listItem = $('.results tbody').children('tr');
			    var searchSplit = searchTerm.replace(/ /g, "'):containsi('");
			    
			  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
			        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
			    }
			  });
			    
			  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
			    $(this).attr('visible','false');
			  });
		
			  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
			    $(this).attr('visible','true');
			  });
		
			  var jobCount = $('.results tbody tr[visible="true"]').length;
			    $('.counter').text(jobCount + ' item');
		
			  if(jobCount == '0') {$('.no-result').show();}
			  else {$('.no-result').hide();}
			});
		});		
	</script>
	