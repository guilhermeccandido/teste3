<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/status'; ?>">
	            <?php echo ucfirst("status") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$status_status[0]['id_status'] ; ?>">
	          <?php echo ucfirst($this->uri->segment(2));?>
	         </a>
	        </li>
	        <li class="active">
	          Update
	        </li>
	      </ol>
	     <?php
	      //flash messages
	      if($this->session->flashdata('flash_message')){
	        if($this->session->flashdata('flash_message') == 'updated')
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> editado com sucesso.';
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
    		  
    		  $options_status = array();
		      foreach ($status as $row)
		      {
		      	$options_status[$row["id"]] = $row["titulo"];
		      }
    		 
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/status_status/update/".$this->uri->segment(4)."/".$status_status[0]['id_status'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_status" name="id_status"  value="<?php echo $status_status[0]['id_status'] ?>" >
			  <div class="form-group col-lg-12">
			        <div class="input-group col-lg-8">
			        	<?php echo form_dropdown("id_status", $options_status, set_value("id_status"), 'class="form-control"' );?>
			            <span class="input-group-addon">status</span>
			        </div>
			      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="id_status2" name="id_status2" placeholder="Status" value="<?php echo set_value('id_status2') ?  set_value('id_status2') :  $status_status[0]['id_status2']; ?>" >
	              <span class="input-group-addon">Status</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control"  rows="5" placeholder="Descrição" id="descricao" name="descricao"><?php echo set_value('descricao') ?  set_value('descricao') :  $status_status[0]['descricao']; ?></textarea>
	              <span class="input-group-addon">Descrição</span>
	            </div>
	          </div>
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