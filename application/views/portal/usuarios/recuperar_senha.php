<header class="wrap-title">
	<div class="container">
    	<h1 class="page-title">Esqueci minha senha</h1>
		<ol class="breadcrumb">
        	<!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="SGPLAN" href="<?php echo base_url(); ?>home/home" class="home">SGPLAN</a></li>
			<li class="current_item">Esqueci minha senha</li>
		</ol>
	</div>
</header>

<div class="container">
	<div class="row">
	<div class="col-md-8">
		<?php
		      //flash messages
				
			  if(isset($mens)){
		       
	          	echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            	echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            	echo $mens;
	          	echo '</div>';       
		       
		      }
		      echo validation_errors();
		      $attributes = array("class" => "form-horizontal", "id" => "");
	      ?>
		<section>
			<h2 class="section-title">Esqueceu sua senha? Não se preocupe, nós cuidamos de você</h2>

			<p>Selecione qualquer um dos campos que você recorda e nos envie 
			uma requisição para atualizar sua senha. Para maiores dúvidas entre em contato conosco. Os contatos estão logo ali ao lado.</p>

			<?php echo form_open("esqueci_minha_senha", $attributes); ?>		
				<div class="form-group col-lg-12">
		        	<div class="input-group col-lg-8">
						<label for="InputName">Login</label>
						<input id="nome" name="login" type="text" value="<?php echo set_value('login'); ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group col-lg-12">
			        <div class="input-group col-lg-8">
						<label for="InputEmail1">Email</label>
						<input id="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>"  id="email">
					</div>
				</div>
				<button type="submit" class="btn btn-primary pull-right">Submeter</button>
				<div class="clearfix"></div>
			<?php echo form_close(); ?>
		</section>
	</div>

	<div class="col-md-4">
		<section>
			<div class="panel panel-primary">
				<div class="panel-heading"><i class="glyphicon glyphicon-envelope"></i>Informação Adicional</div>
				<div class="panel-body">
						<h4 class="section-title">Contatos</h4>
						<address>
							<strong>SGPLAN</strong><br />
							Setor de Autarquias Norte (SAN)<br /> 
							Quadra 03, Lote “A”<br /> 
							Edifício Núcleo dos Transportes 1º Andar<br />
							Brasília – Distrito Federal (DF)<br />
							CEP: 70.040-902.<br />
							Telefone: (0xx61) 3315-4151/4160 <br />
							Fax: (0xx61) 3315-4087 <br />
							Email: <a href="#">sgplan@dnit.gov.br</a>
						</address>

						<!-- Business Hours -->
						<h4 class="section-title">Horário de Atendimento</h4>
						<ul class="list-unstyled">
							<li><strong>Segunda-Sexta:</strong> 8h - 18h</li>
							<li><strong>Sábado-Domingo:</strong> Fechado</li>
						</ul>
					</div>
				</div>
		</section>
	</div>
</div>
</div> <!-- boxed -->
