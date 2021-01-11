<div class="container top">
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
	            <?php echo ucfirst("atividades") ;?>
	          </a> 	          
	        </li>
	        <li>
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$id_pas."/".$pas_fases_movimentacao[0]['id_pas_fases'] ; ?>">
	          <?php echo ucfirst('movimentacao');?>
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
		      $attributes = array("class" => "form-horizontal", "id" => "", "enctype" => "multipart/form-data");
    		  
		      $options_status = array();
		      $js_status = array();
		      foreach ($status as $row)
		      {
		      	$options_status[$row["id"]] = $row["titulo"];
		      	$js_status[$row["id"]] = $row["composicao"];
		      }
		      
    		  $options_avaliacoes = array();
		      foreach ($avaliacoes as $row)
		      {
		      	$options_avaliacoes[$row["id"]] = $row["titulo"];
		      }
    		 
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/pas_fases_movimentacao/update/".$id_pas."/". $this->uri->segment(5)."/".$pas_fases_movimentacao[0]['id_pas_fases'] , $attributes); ?>
		     <fieldset>
			 <legend><?php echo 'LOTE:'.$lote.' – '.'ATIVIDADE '.$fases[0]['grupo'].' – '.$fases[0]['titulo']; ?></legend>
			  <input class="form-control" type="hidden" id="id_pas_fases" name="id_pas_fases"  value="<?php echo $pas_fases_movimentacao[0]['id_pas_fases'] ?>" >			  
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_status", $options_status, set_value("id_status") ?  set_value('id_status') :  $pas_fases_movimentacao[0]['id_status'] , 'class="form-control" id="id_status"' );?>
		            <span class="input-group-addon">Status/Movimentação</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_avaliacoes", $options_avaliacoes, set_value('id_avaliacoes') ?  set_value('id_avaliacoes') :  $pas_fases_movimentacao[0]['id_avaliacoes'] , 'class="form-control"  id="id_avaliacoes"' );?>
		            <span class="input-group-addon">Avaliacoes</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_protocolo" name="data_protocolo" placeholder="Data Ocorrência" value="<?php echo set_value('data_protocolo') ?  set_value('data_protocolo') :  $pas_fases_movimentacao[0]['data_protocolo']; ?>" >
	              <span class="input-group-addon">Data da Ocorrência</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="time" id="time_protocolo" name="time_protocolo" placeholder="Hora Ocorrência" value="<?php echo set_value('time_protocolo') ?  set_value('time_protocolo') :  $pas_fases_movimentacao[0]['time_protocolo']; ?>" >
	              <span class="input-group-addon">Hora da Ocorrência</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" rows="5" placeholder="Descrição" id="descricao" name="descricao"><?php echo set_value('descricao') ?  set_value('descricao') :  $pas_fases_movimentacao[0]['descricao']; ?></textarea>
	              <span class="input-group-addon">Descrição</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="file" id="file" name="file" placeholder="File" value="<?php echo set_value('file') ?  set_value('file') :  $pas_fases_movimentacao[0]['file']; ?>" >
	              <span class="input-group-addon">File</span>
	            </div>
	            <?php
	             	$filename = PAS_FOLDER . $id_pas.'/documentos/'.$pas_fases_movimentacao[0]['file'];
	             	$arrayFile = explode('.', $filename);
	             	$fileType = end($arrayFile);
	             	
	            	if(file_exists($filename) AND $pas_fases_movimentacao[0]['file']){
	            ?>	
	            	<div id="fileEdit"> 
		            	<a href="<?php  echo base_url().'assets/gestao_estudos_projetos/pas/'.$id_pas.'/documentos/'.$pas_fases_movimentacao[0]['file']; ?>">
							<img src="<?php echo base_url()."assets/img/icons/".$fileType.".jpg" ?>" style="width:50px;" />
						</a>
						<a href="#myModal" type="button" aria-label="Deletar" data-toggle="modal" >
							<img src="<?php echo base_url()."assets/img/icons/delete.ico" ?>" style="width:50px;" />
						</a>
					</div>
	            <?php 		
	            	}
	            ?>
	          </div>
	          <div class="form-group">
	          	<div class="col-lg-6">
	            	<button class="btn btn-primary" type="submit">Salvar Modificações</button>
	            	<button class="btn btn-default" type="reset">Cancelar</button>
    			</div>
	          </div>
	        </fieldset>
	      <?php echo form_close(); ?>
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
				    <a id ="actionModal" type="button"  onclick="deleteFile(<?php echo $this->uri->segment(5); ?>);" href="#" data-dismiss="modal" class="btn btn-danger">Deletar</a>
				    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				  </div>
				</div>
		       </div>
		     </div>
    	</div>
	   </div>
</div>

<script  type="text/javascript" >
<?php
	$js_array = json_encode($js_status);
	echo "var js_array = ". $js_array . ";\n";
	
?>
	
	var a = js_array[$('#id_status').val()];
	if( a == 'Simples'){

	     $("#id_avaliacoes").prop('disabled', true);
	     $("#id_avaliacoes").val($("#id_avaliacoes option:first").val());
	     
	 } else{
		 $("#id_avaliacoes").prop('disabled', false);
		 
	 }

	
	$('#id_status').on({
	    change: function(){

		     var a = js_array[$('#id_status').val()];
		     if( a == 'Simples'){

			     $("#id_avaliacoes").prop('disabled', true);
			     $("#id_avaliacoes").val($("#id_avaliacoes option:first").val());
			     
			 } else{
				 $("#id_avaliacoes").prop('disabled', false);
				 
			 }
		}
	   
	});

	function deleteFile(id){
		
		var url = "<?php echo base_url().'admin/pas_fases_movimentacao/delete_file/'.$id_pas.'/' ?>" + id;
		$.ajax({
		  dataType: "json",
		  url: url,
		  success: $( "#fileEdit" ).fadeOut( "fast", function() {})
		});
		
	}
	
	
	
</script>	 









