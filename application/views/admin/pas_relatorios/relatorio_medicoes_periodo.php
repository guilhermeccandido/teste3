<?php
	foreach($link_acessos as $item){
		
		if( $item[key($item)] == $this->uri->segment(2)) {
			$acesso = $item['acesso'];
			break;
		}else{
			$acesso = 'visualizar';
		}
	}

	$relatorio = 'Lote;Produto;Status;Data;Descrição;'."\n";
	foreach($pas as $row)
	{
		$relatorio .= $row['lote'].';'.$row['titulo'].';'.$row['status'].';'.$row['data_protocolo'].';'.$row['descricao'].';'."\n";
		 
	}
	$nameFile  = 'resumo_medicoes_periodo_'.date('Y-m-d').'.csv';
	file_put_contents(PAS_RELATORIOS_FOLDER . $nameFile , utf8_decode($relatorio));
	 
	
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
	          <a href="<?php echo base_url() .'gestao_estudos_projetos'; ?>">
	            <?php echo ucfirst('Gestão de Estudos e Projetos');?>
	          </a>
	        </li> 
			<li>
	          <a href="<?php echo base_url('gestao_estudos_projetos/relatorios'); ?>">
	            Relatórios Físicos
	          </a>
	        </li>  		
	        <li class="active">
	          Resumo EVTEAS
	        </li>
	      </ol>
	    
	    	<h3>Baixar Relatório</h3>
			
				
		   <?php
			   if(isset($flash_message)){
			   	if($flash_message == TRUE)
			   	{	
			   		?>
			   		<a href="<?php echo base_url('assets/gestao_estudos_projetos/pas/relatorios').'/'.$nameFile ?>"><img src="<?php echo base_url('assets/img/icons/xls.png');?>" width="64"  height="64" /></a>
			   		<?php
			   	}else{
			   		echo '<div class="alert alert-danger alert-dismissible" role="alert">';
			   		echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			   		echo '<strong>Ocorreu algum problema na consulta ou não existem registros para o período.';
			   		echo '</div>';
			   	}
			   }
			   $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
			   
			   echo validation_errors();
		   ?>	
          <div class="well well-pas">
            
			<?php echo form_open("pas_relatorios/relatorio_medicoes_periodo", $attributes); ?>
             <div class="form-group form-inline reset-margin">
	             <label>Data Inicial:</label>
	             <input class="form-control" type="date" id="data_ini" name="data_ini"  placeholder="Data Inicial" value="<?php echo set_value('data_ini'); ?>" >
	             <label>Data Final:</label>
	             <input class="form-control" type="date" id="data_fim" name="data_fim"  placeholder="Data Final" value="<?php echo set_value('data_fim'); ?>" >
	             <button class="btn btn-primary" type="submit">Enviar</button>
			</div>
			<?php echo form_close(); ?>
			
          </div>
          <div class="table-responsive">
	          <table class="table table-striped table-bordered table-condensed  table-hover results">
	            <thead>
	              <tr>
					<th class="yellow header headerSortDown">Lote</th>
					<th class="yellow header headerSortDown">Produto</th>
					<th class="yellow header headerSortDown">Status</th>
					<th class="yellow header headerSortDown">Data</th>
					<th class="yellow header headerSortDown">Descrição</th>
				  </tr>
	            </thead>
	            <tbody>
	           <?php
				  
	              foreach($pas as $row)
	              {
	              	echo '<tr>';
	              		echo '<td>'.$row['lote'].'</td>';
	              		echo '<td>'.$row['titulo'].'</td>';
	              		echo '<td>'.$row['status'].'</td>';
	              		echo '<td>'.$row['data_protocolo'].'</td>';
	              		echo '<td>'.$row['descricao'].'</td>';
	              	echo '</tr>';
	              
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


<script type="text/javascript"> 
	$(document).ready(function() {
		App.init();
		
	});

	
	

 	$(function(){
		  $("table").tablesorter({
		    onRenderHeader: function(){
		      this.prepend('<span class="icon"></span>');
		    }
		  });
		});

 	
</script>
	
