<div class="container top">
	      <ol class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("home"); ?>">
	            <?php echo ucfirst("home");?>
	          </a>	          
	        </li>
	        <li>
	          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
	            <?php echo 'relatório Gerencial';?>
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
    		  /*
    		  $options_ = array();
		      foreach ($VARIAVELFROMCONTROLLER as $row)
		      {
		      	$options_[$row["id"]] = $row["titulo"];
		      }	
    		  <?php 
				     echo '<div class="form-group col-lg-12">';
					 echo '<div class="input-group col-lg-8">';
		    		 echo form_dropdown('id_', $options_, $relatorio_gerencial[0]['id_'] , 'class="form-control"' );
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
			 <?php echo form_open("admin/relatorio_gerencial/update/".$this->uri->segment(4), $attributes); ?>	      		
		     <fieldset>
			 <legend>Editar</legend>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Relatório Gerencial" value="<?php echo $relatorio_gerencial[0]['titulo']; ?>" >
	              <span class="input-group-addon">Relatório Gerencial</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_ini" name="data_ini" placeholder="Data Início" value="<?php echo $relatorio_gerencial[0]['data_ini']; ?>" >
	              <span class="input-group-addon">Data Início</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_fim" name="data_fim" placeholder="Data Fim" value="<?php echo $relatorio_gerencial[0]['data_fim']; ?>" >
	              <span class="input-group-addon">Data Fim</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="descricao" name="descricao" placeholder="Descrição" value="<?php echo $relatorio_gerencial[0]['descricao']; ?>" >
	              <span class="input-group-addon">Descrição</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" id="relatorio"  name="relatorio"  type="file">
	              <span class="input-group-addon">Relatório</span>
	            </div>
	            <?php
	             	$filename = RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$relatorio_gerencial[0]['id'].'/pdf/'.$relatorio_gerencial[0]['relatorio'];
	             	$arrayFile = explode('.', $filename);
	             	$fileType = end($arrayFile);
	             	
	            	if(file_exists($filename)  AND $relatorio_gerencial[0]['relatorio'] != ''){
	            ?>	
	            	<div id="relatorioEdit"> 
		            	<a href="<?php  echo base_url().'assets/relatorios_gerenciais/'.$relatorio_gerencial[0]['id'].'/pdf/'.$relatorio_gerencial[0]['relatorio']; ?>">
							<img src="<?php echo base_url()."assets/img/icons/relatorio.jpg" ?>" style="width:50px;" />
						</a>
						<a href="#"  onclick="deleteFile('relatorio', '#relatorioEdit');">
							<img src="<?php echo base_url()."assets/img/icons/delete.ico" ?>" style="width:50px;" />
						</a>
					</div>
	            <?php 		
	            	}
	            ?>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" id="portifolio"  name="portifolio"  type="file">
	              <span class="input-group-addon">Portifólio</span>
	            </div>
	            <?php
	             	$filename = RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$relatorio_gerencial[0]['id'].'/pdf/'.$relatorio_gerencial[0]['portifolio'];
	             	$arrayFile = explode('.', $filename);
	             	$fileType = end($arrayFile);
	             	
	            	if(file_exists($filename)  AND $relatorio_gerencial[0]['portifolio'] != ''){
	            ?>	
	            	<div id="portifolioEdit"> 
		            	<a href="<?php  echo base_url().'assets/relatorios_gerenciais/'.$relatorio_gerencial[0]['id'].'/pdf/'.$relatorio_gerencial[0]['portifolio']; ?>">
							<img src="<?php echo base_url()."assets/img/icons/portifolio.jpg" ?>" style="width:50px;" />
						</a>
						<a href="#"  onclick="deleteFile('portifolio', '#portifolioEdit');">
							<img src="<?php echo base_url()."assets/img/icons/delete.ico" ?>" style="width:50px;" />
						</a>
					</div>
	            <?php 		
	            	}
	            ?>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" id="carta"  name="carta"  type="file">
	              <span class="input-group-addon">Carta</span>
	            </div>
	            <?php
	             	$filename = RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$relatorio_gerencial[0]['id'].'/pdf/'.$relatorio_gerencial[0]['carta'];
	             	$arrayFile = explode('.', $filename);
	             	$fileType = end($arrayFile);
	             	
	            	if(file_exists($filename)  AND $relatorio_gerencial[0]['carta'] != ''){
	            ?>	
	            	<div id="cartaEdit"> 
		            	<a href="<?php  echo base_url().'assets/relatorios_gerenciais/'.$relatorio_gerencial[0]['id'].'/pdf/'.$relatorio_gerencial[0]['carta']; ?>">
							<img src="<?php echo base_url()."assets/img/icons/carta.jpg" ?>" style="width:50px;" />
						</a>
						<a href="#"  onclick="deleteFile('carta', '#cartaEdit');">
							<img src="<?php echo base_url()."assets/img/icons/delete.ico" ?>" style="width:50px;" />
						</a>
					</div>
	            <?php 		
	            	}
	            ?>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" id="colecao"  name="colecao"  type="file">
	              <span class="input-group-addon">Arquivo Comprimido</span>
	            </div>
	            <?php
	             	$filename = RELATORIOS_GERENCIAIS_AA4_FOLDER.'/'.$relatorio_gerencial[0]['id'].'/colecao/'.$relatorio_gerencial[0]['colecao'];
	             	$arrayFile = explode('.', $filename);
	             	$fileType = end($arrayFile);
	             	
	            	if(file_exists($filename)  AND $relatorio_gerencial[0]['colecao'] != ''){
	            ?>	
	            	<div id="colecaoEdit"> 
		            	<a href="<?php  echo base_url().'assets/relatorios_gerenciais/'.$relatorio_gerencial[0]['id'].'/pdf/'.$relatorio_gerencial[0]['colecao']; ?>">
							<img src="<?php echo base_url()."assets/img/icons/rar.jpg" ?>" style="width:50px;" />
						</a>
						<a href="#"  onclick="deleteFile('colecao', '#colecaoEdit');">
							<img src="<?php echo base_url()."assets/img/icons/delete.ico" ?>" style="width:50px;" />
						</a>
					</div>
	            <?php 		
	            	}
	            ?>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" type="textarea" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo $relatorio_gerencial[0]['observacoes']; ?></textarea>		
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
	   </div>
</div>

<script  type="text/javascript" >


	function deleteFile(id, idElement){
		
		console.log(id);
		
		var url = "<?php echo base_url().'admin/relatorio_gerencial/delete_file/'.$relatorio_gerencial[0]['id'].'/' ?>" + id;
		$.ajax({
		  dataType: "json",
		  url: url,
		  success: $( idElement ).fadeOut( "fast", function() {})
		});
		
	}
	
</script>	