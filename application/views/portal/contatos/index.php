<header class="wrap-title">
	<div class="container">
    	<h1 class="page-title">Contato</h1>
		<ol class="breadcrumb">
        	<!-- Breadcrumb NavXT 5.0.1 -->
			<li class="home"><a title="Go to Open Mind." href="<?php echo base_url(); ?>home/home" class="home">SGPLAN</a></li>
			<li class="current_item">Contato</li>
		</ol>
	</div>
</header>

<div class="container">
	<div class="row">
	<div class="col-md-8">
		<?php
		      //flash messages
		      if(isset($flash_message)){
		        if($flash_message == TRUE)
		        {
		          echo '<div class="alert alert-success alert-dismissible" role="alert">';
		            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		            echo '<strong>Email Enviado!</strong> Agradecemos o seu contato e assim que verificarmos sua mensagem entraremos em contato.';
		          echo '</div>';       
		        }else{
		          echo '<div class="alert alert-danger alert-dismissible" role="alert">';
		            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		            echo '<strong>Oh snap!</strong> Estamos como problemas para entregar sua mensagem, por favor tente mais tarde.';
		          echo '</div>';          
		        }
		      }
		      echo validation_errors();
		      $attributes = array("class" => "form-horizontal", "id" => "");
	      ?>
		<section>
			<h2 class="section-title">Envie uma Mensagem</h2>

			<?php echo form_open("contatos", $attributes); ?>		
				<div class="form-group col-lg-12">
		        	<div class="input-group col-lg-8">
						<label for="InputName">Nome</label>
						<input id="nome" name="nome" type="text" value="<?php echo set_value('nome'); ?>" class="form-control" >
					</div>
				</div>
				<div class="form-group col-lg-12">
			        <div class="input-group col-lg-8">
						<label for="InputEmail1">Email</label>
						<input id="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>"  id="email">
					</div>
				</div>
				<div class="form-group col-lg-12">
			        <div class="input-group col-lg-8">
						<label for="InputMessage">Mensagem</label>
						<textarea class="form-control" id="mensagem" name="mensagem" rows="8"><?php echo set_value('mensagem'); ?></textarea>
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
