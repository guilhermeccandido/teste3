    <div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 
	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            <?php echo ucfirst($this->uri->segment(2));?>
	          </a> 
	          
	        </li>
	        <li class="active">
	          <a href="#">New</a>
	        </li>
	      </ol>  
	      <?php
	      //flash messages
	      if(isset($flash_message)){
	        if($flash_message == TRUE)
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> novo  usuario criado com sucesso.';
	          echo '</div>';       
	        }else{
	          echo '<div class="alert alert-danger alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Oh snap!</strong> mude algumas coisas e tente novamente.';
	          echo '</div>';          
	        }
	      }
	      ?> 
		    <?php
		      //form data
		      $attributes = array("class" => "form-horizontal", "id" => "");
				      
		      $options_local = array();
		      foreach($local as $row){
		      	$options_local[$row['id']] = $row['titulo'];
		      }
		      
		      //form validation
		      echo validation_errors();
		      
		      
		     ?>
		 <div class="row">
          <div class="col-lg-10">		     
		     <?php echo form_open("admin/usuarios/add", $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" placeholder="Instituição" type="text" id="instituicao" name="instituicao" value="<?php echo set_value('instituicao'); ?>" >
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" placeholder="Login" type="text" id="" name="login" value="<?php echo set_value('login'); ?>" >
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" placeholder="Nome" type="text" id="" name="nome" value="<?php echo set_value('nome'); ?>" >
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <?php echo form_dropdown("id_local_execucao", $options_local, set_value("id_local_execucao"), 'class="form-control"  id="id_local_execucao"' );?>
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" placeholder="Email" type="text" id="" name="email" value="<?php echo set_value('email'); ?>" >
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-lg-6">
		              <input class="form-control" placeholder="Senha" type="text" id="" name="senha" value="<?php echo set_value('senha'); ?>" >
		            </div>
		          </div>
		          <?php
		          /*
		          <div class="control-group">
		            <label for="inputError" class="control-label">Token</label>
		            <div class="controls">
		              <input class="form-control" placeholder="" type="text" id="" name="tokensenha" value="<?php echo set_value('tokensenha'); ?>" >
		            </div>
		          </div><div class="control-group">
		            <label for="inputError" class="control-label">Ativo</label>
		            <div class="controls">
		              <input class="form-control" placeholder="" type="text" id="" name="ativo" value="<?php echo set_value('ativo'); ?>" >
		            </div>
		          </div>
		          */
		          ?>
	          <div class="form-group">
	          	<div class="col-lg-6">
		            <button class="btn btn-primary" type="submit">Save changes</button>
		            <button class="btn btn-default" type="reset">Cancel</button>
	          	</div>
	          </div>
	        </fieldset>
	
	      <?php echo form_close(); ?>       
	     </div>
	   </div>
	 </div>