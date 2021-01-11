  
<div class="row">
	<div class="main">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed">
		    <thead>
		    	<tr>
		        	<th class="header">Movimento Anterior</th>
		        	<th class="header">Data</th>
		        	<th class="header">Avaliação</th>
	    		</tr>
		    </thead>
			<tbody>
				<tr>
	    			<td>
	    				<?php echo $movimento[0]['status'] ?>
	    			</td>
	    			<td>
	    				<?php echo $movimento[0]['data_protocolo'] ?>
	    			</td>
	    			<td>
	    				<?php echo $movimento[0]['avaliacao'] ?>
	    			</td>
	    		</tr>
	    		<tr>
	    			<td colspan="3">
	    				<?php echo $movimento[0]['descricao'] ?>
	    			</td>
	    		</tr>
			</tbody>
			</table>
			<?php
			$fileName = (file_exists( PAS_FOLDER . $movimento[0]['id_pas'] .'/documentos/'.$movimento[0]['file'] ) && $movimento[0]['file'] != '') ? PAS_FOLDER . $movimento[0]['id_pas'] .'/documentos/'.$movimento[0]['file'] : '';
				if($fileName){
			?>
					<a href="<?php echo base_url('assets/gestao_estudos_projetos/pas/'.$movimento[0]['id_pas'].'/documentos/'.$movimento[0]['file']); ?>">
						<img src="<?php echo base_url('assets/img/icons/doc.png');?>" width="64"  height="64" />
					</a>
			<?php 		
				}
			?>
		</div>
	</div>
</div>  	  
	
	
	