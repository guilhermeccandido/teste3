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
	          <a href="#">Update</a>
	        </li>
	      </ol>
	     <?php
	      //flash messages
	      if($this->session->flashdata('flash_message')){
	        if($this->session->flashdata('flash_message') == 'updated')
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> usuario editado com sucesso.';
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
		     <?php echo form_open("admin/usuarios/update/".$this->uri->segment(4), $attributes); ?>
		     <fieldset>
		     <legend>Editar</legend>	  
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">	
		              <input  class="form-control" type="text" id="" name="instituicao" value="<?php echo $usuario[0]['instituicao']; ?>" >
		              <span class="input-group-addon">Instituição</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">	
		              <input  class="form-control" type="text" id="" name="login" value="<?php echo $usuario[0]['login']; ?>" >
		              <span class="input-group-addon">Login</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">	
		              <input  class="form-control" type="text" id="" name="nome" value="<?php echo $usuario[0]['nome']; ?>" >
		              <span class="input-group-addon">Nome</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">	
		              <?php echo form_dropdown("id_local_execucao", $options_local, set_value("id_local_execucao") ? set_value("id_local_execucao") : $usuario[0]['id_local_execucao'], 'class="form-control"  id="id_local_execucao"' );?>
		              <span class="input-group-addon">Local</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">	
		              <input class="form-control" type="text" id="" name="email" value="<?php echo $usuario[0]['email']; ?>" >
		              <span class="input-group-addon">Email</span>
		            </div>
		          </div>
		          <div class="form-group col-lg-12">
		            <div class="input-group col-lg-8">	
		              <input class="form-control" type="password" id="senha" name="senha" value="" >
		              <span class="input-group-addon">Senha</span>
		            </div>
		          </div>
		          <?php
		          /* 
		          <div class="control-group">
		            <label for="inputError" class="control-label">Senha</label>
		            <div class="controls">
		              <input type="text" id="" name="senha" value="<?php echo $usuario[0]['senha']; ?>" >
		              <!--<span class="help-inline">Woohoo!</span>-->
		            </div>
		          </div>
		          <div class="control-group">
		            <label for="inputError" class="control-label">Token</label>
		            <div class="controls">
		              <input type="text" id="" name="tokensenha" value="<?php echo $usuario[0]['tokensenha']; ?>" >
		              <!--<span class="help-inline">Woohoo!</span>-->
		            </div>
		          </div><div class="control-group">
		            <label for="inputError" class="control-label">Ativo</label>
		            <div class="controls">
		              <input type="text" id="" name="ativo" value="<?php echo $usuario[0]['ativo']; ?>" >
		              <!--<span class="help-inline">Woohoo!</span>-->
		            </div>
		          </div>
		          */
		          ?>
	          <div class="form-group">
	          	<div class="col-lg-6">
		            <button class="btn btn-primary" type="submit">Salvar Modificações</button>
		            <button class="btn btn-default" type="reset">Cancelar</button>
		        </div>
	          </div>
	        </fieldset>
    
	      <?php echo form_close(); ?>        
	      </div>
	    </div>
	  </div>