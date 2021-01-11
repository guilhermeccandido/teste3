<header class="wrap-title">
	<div class="container">
    	<h1 class="page-title">Bem vindo <?php echo $usuario[0]['nome']; ?></h1>
		<ol class="breadcrumb">
        	<!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="Home" href="<?php echo base_url(); ?>home/home" class="home">AFURG</a></li>
			<li class="current_item">Usuário</li>
		</ol>
	</div>
</header>

<div class="container">
	<div class="row">
		<div class="col-md-4">
		<h2>Extratos Associação</h2>
			<section>
				<h3>Extratos</h3>
				<table class="table table-striped">
					<thead>
			        	<tr>
			            	<th>#</th>
			                <th>Data Base</th>
			                <th>Extrato</th>
			            </tr>
			        </thead>
			        <tbody>
			        <?php
			        	$count = 1;
			        	//print_r($extratos_cheque);
			        	foreach($extratos_cheque as $item){
				        ?>
				        	<tr>
				            	<td><?php echo $count++; ?></td>
				                <td><?php echo date('d/m/Y', strtotime($item['data_base'])); ?></td>
								<td><a href="<?php echo base_url('extrato/cheque').'/'.$item['id'];?>"><img heigth="25" width="25" src="<?php echo base_url('assets/img/icons').'/pdf.png';?>" /></a></td>
				            </tr>
				        <?php 		
			        	}
			        ?>
					</tbody>
			    </table>	
			</section>
		</div>
		<div class="col-md-8">
			<h2>Extratos Telefonia</h2>
			<?php
				$meses = array( 'jan' => 'Janeiro', 'fev' => 'Fevereiro', 'mar' => 'Março',
								'abr' => 'Abril', 'mai' => 'Maio', 'jun' => 'Junho', 
								'jul' => 'Julho', 'ago' => 'Agosto', 'set' => 'Setembro', 
								'out' => 'Outubro', 'nov' => 'Novembro', 'dez' => 'Dezembro');
			
					if(sizeof($extrato_telefones) > 0){ 			
						foreach($extrato_telefones as $key => $item){
						?>
					<div class="col-md-4">
						<section>
							<h3><?php echo $meses[$key]; ?></h3>
							<table class="table table-striped">
									<thead>
							        	<tr>
							            	<th>#</th>
							                <th>Telefone</th>
							                <th>Extrato</th>
							            </tr>
							        </thead>
							        <tbody>
							        <?php
							        	$count = 1;
							        	//print_r($extratos_cheque);
							        	foreach($item as $row){
								        ?>
								        	<tr>
								            	<td><?php echo $count++; ?></td>
								            	<td><?php echo $row['telefone']; ?></td>
												<td><a href="<?php echo base_url('usuarioclaros/downExtrato').'/'.$key.'/'.$row['telefone'];?>" target="_blank"><img heigth="25" width="25" src="<?php echo base_url('assets/img/icons').'/pdf.png';?>" /></a></td>
								            </tr>
								        <?php 		
							        	}
							        ?>
									</tbody>
							    </table>
						</section>
					</div>				
						<?php 	
						}
					}
			
			?>
			
		</div>
	</div>
</div> <!-- boxed -->
