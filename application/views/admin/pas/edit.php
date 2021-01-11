<div class="container top">
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
	          <a href="<?php echo site_url("admin").'/pas'; ?>">
	            EVTEAS
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
		      
		      $options_status = array(	'Ativo' => 'Ativo', 
		      							'Cancelado' => 'Cancelado',
		      							'Planejado' => 'Planejado',
		      							'Paralizado' => 'Paralizado',
		      							'Concluído' => 'Concluído', 
		      							'Suspenso' => 'Suspenso');
		      
		      $options_responsavel = array();
		      foreach ($responsaveis as $row)
		      {
		      	$options_responsavel[$row["id_usuario"]] = $row["nome"];
		      }
		      
		      $options_contratos = array();
		      foreach ($contratos as $row)
		      {
		      	$options_contratos[$row["id"]] = $row["contrato"];
		      }
		      
		      $options_prazos = array();
		      foreach ($prazos as $row)
		      {
		      	$options_prazos[$row["id"]] = $row["titulo"];
		      }
		      
		      $options_local_execucao  = array();
		      foreach ($local_execucao as $row)
		      {
		      	$options_local_execucao[$row["id"]] = $row["titulo"];
		      }
		      
    		  /*
    		  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }	
    		  <?php 
				     echo '<div class="form-group col-lg-12">';
					 echo '<div class="input-group col-lg-8">';
		    		 echo form_dropdown('id_', $options_, $pas[0]['id_'] , 'class="form-control"' );
		    		 echo '<span class="input-group-addon">XXXXXXXXX</span>';			
				     echo '</div>';
				     echo '</div>';	
			  ?>
    		  */
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/pas/update/".$this->uri->segment(4), $attributes); ?>	      		
		     <fieldset>
			 <legend>
			 <?php 
	    		$tituloTrecho = '';
	    		$first = true;
	    		foreach($trechos as $item){
	    			if($first){
	    				$first = false;
	    				$tituloTrecho .= $item['uf'].' BR-'.$item['rodovia'];
	    			}else{
	    				$tituloTrecho .= ' / '.$item['uf'].' BR-'.$item['rodovia'];
	    			}	
	    			
	    			
	    		}
	    		echo $pas[0]['titulo'] ? $pas[0]['titulo'] : $tituloTrecho ;
	    	?>
			 </legend>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="titulo" value="<?php echo set_value('titulo') ?  set_value('titulo') : $pas[0]['titulo']; ?>" >
	              <span class="input-group-addon">titulo</span>
	              <div class="input-group-btn">
	              	<button href="#myModal"  type="button" class="btn btn-default" aria-label="Help" data-toggle="modal" onclick="open_modal('titulo');"  >
	              		<span class="glyphicon glyphicon-question-sign"></span>
	              	</button>
				  </div>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="lote" name="lote" placeholder="Lote" value="<?php echo set_value('lote') ?  set_value('lote') : $pas[0]['lote']; ?>" >
	              <span class="input-group-addon">Lote</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_responsavel", $options_responsavel, set_value("id_responsavel") ? set_value("id_responsavel") : $pas[0]["id_responsavel"] , 'data-live-search="true" class="form-control"' );?>
		            <span class="input-group-addon">Responsável</span>
		        </div>
		      </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="ordem_servico" name="ordem_servico" placeholder="Ordem de Serviço" value="<?php echo set_value('ordem_servico') ?  set_value('ordem_servico') : $pas[0]['ordem_servico']; ?>" >
	              <span class="input-group-addon">Ordem de Serviço</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
		     	  <?php echo form_dropdown("id_contrato", $options_contratos, set_value("id_contrato") ? set_value("id_contrato") : $pas[0]["id_contrato"] , 'data-live-search="true" class="form-control"' );?>
	              <span class="input-group-addon">Contrato</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_pas_prazos", $options_prazos, set_value("id_pas_prazos") ? set_value("id_pas_prazos") : $pas[0]["id_pas_prazos"] , 'class="form-control"' );?>
		            <span class="input-group-addon">Cronograma</span>
		        </div>
		      </div>
	          <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("status", $options_status, set_value("status") ? set_value("status") :  $pas[0]['status'], 'class="form-control"' );?>
		            <span class="input-group-addon">Situação do Lote</span>
		        </div>
		      </div>		      
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_ini_pas" name="data_ini_pas" placeholder="Data Inicial PAS" value="<?php echo set_value('data_ini_pas') ?  set_value('data_ini_pas') : $pas[0]['data_ini_pas']; ?>" >
	              <span class="input-group-addon">Data Inicial (Edital)</span>
	              <div class="input-group-btn">
	              	<button href="#myModal"  type="button" class="btn btn-default" aria-label="Help" data-toggle="modal" onclick="open_modal('data_ini_pas');"  >
	              		<span class="glyphicon glyphicon-question-sign"></span>
	              	</button>
				  </div>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_ini_pas" name="data_ini_planejada" placeholder="Data Inicial Planejada"  value="<?php echo set_value('data_ini_planejada') ?  set_value('data_ini_planejada') : $pas[0]['data_ini_planejada']; ?>" >
	              <span class="input-group-addon">Data Inicial (Planejada)</span>
	              <div class="input-group-btn">
	              	<button href="#myModal"  type="button" class="btn btn-default" aria-label="Help" data-toggle="modal" onclick="open_modal('data_ini_planejada');" >
	              		<span class="glyphicon glyphicon-question-sign"></span>
	              	</button>
				  </div>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <?php echo form_dropdown("id_local_execucao", $options_local_execucao, set_value("id_local_execucao") ? set_value("id_local_execucao") :  $pas[0]['id_local_execucao'], 'class="form-control"' );?>
	              <span class="input-group-addon">Local da Execução</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-12">
	              <textarea class="form-control" rows="5" placeholder="Descrição" id="descricao" name="descricao"><?php echo set_value('descricao') ?  set_value('descricao') :  $pas[0]['descricao']; ?></textarea>		
	              <span class="input-group-addon">Descrição</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-12">
	              <textarea class="form-control" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $pas[0]['observacoes']; ?></textarea>		
	              <span class="input-group-addon">Observações</span>
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
    	<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			 <div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3>Ajuda</h3>
			  </div>
			  <div class="modal-body">
			    
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			  </div>
			</div>
	       </div>
	     </div>
	     
	   </div>
</div>

<script>
	$(document).ready(
			function () { 
				var editor = CKEDITOR.replace( 'observacoes',
		 				{
							toolbar :
							 [
							 ['Source','-','Save','NewPage','Preview','-','Templates'],
							 ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
							 ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
							 ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
							 '/',
							 ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
							 ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
							 ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
							 ['Link','Unlink','Anchor'],
							 ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
							 '/',
							 ['Styles','Format','Font','FontSize'],
							 ['TextColor','BGColor'],
							 ['Maximize', 'ShowBlocks','-','About']
							 ],
							extraPlugins : 'uicolor',
							
			 			});
	 			
				var editor2 = CKEDITOR.replace( 'descricao',
		 				{
							toolbar :
							 [
							 ['Source','-','Save','NewPage','Preview','-','Templates'],
							 ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
							 ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
							 ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
							 '/',
							 ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
							 ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
							 ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
							 ['Link','Unlink','Anchor'],
							 ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
							 '/',
							 ['Styles','Format','Font','FontSize'],
							 ['TextColor','BGColor'],
							 ['Maximize', 'ShowBlocks','-','About']
							 ],
							extraPlugins : 'uicolor',
							
			 			});						
				
				CKEDITOR.editorConfig = function( config ) {
					config.extraPlugins = 'pastefromexcel';
					config.extraPlugins = 'qrc';
					config.extraPlugins = 'templates';
				};  

				get_lista_prazos();
	});

	$('select[name=id_contrato]').on({
	    change: function(){
	    	get_lista_prazos();
		}
	   
	});	
	
	function open_modal(id){

		var mensagem = '';
		
		if(id == 'titulo'){
			mensagem = 'O título é gerado automaticamente baseado nos dados de entrada dos trechos. Para gerar um novo título, edite o campo correspondente.';	
		}else if(id == 'data_ini_pas'){
			mensagem = 'Essa é a data inicial do registro baseada na data aferida pelo Edital. A data inicial de início pe baseada no primeiro movimento do primeiro produto.';

		}else if(id == 'data_ini_planejada'){	
			mensagem = 'Essa é a data inicial planejada. A data inicial de início pe baseada no primeiro movimento do primeiro produto.';
			
		}

		$(".modal-body").text(mensagem);
		console.log(mensagem);
	}

	$('select[name=id_contrato]').on({
	    change: function(){
	    	get_lista_prazos();
		}
	   
	});	

	function get_lista_prazos(){
		
		elFocus   = $('select[name=id_contrato]');
		  el   		= $('select[name=id_pas_prazos]');
		  $.getJSON('<?php echo base_url().'admin/pas_prazos/get_list_prazos_by_contrato/' ?>' + elFocus.val() 
		  ,
		 
		  function( data ) {
			  el.find('option').remove();
			  el.attr('disabled');
			  for (var i = data['result'].length - 1; i >= 0; i--) {
				
				el.prepend($('<option>', { 
			        value: data['result'][i]['id'],
			        text : data['result'][i]['titulo'] 
			    }));
		      };
			});
	}

</script>



















	