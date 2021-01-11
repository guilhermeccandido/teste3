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
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$id_pas; ?>">
	          <?php echo ucfirst('Atividades');?>
	         </a>
	        </li>
	        <li class="active">
	          <?php echo 'LOTE '.$lote; ?>
	        </li>
	      </ol> 
	      <?php
	      //flash messages
	      if(isset($flash_message)){
	        if($flash_message == TRUE)
	        {
	          echo '<div class="alert alert-success alert-dismissible" role="alert">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo '<strong>Parabéns!</strong> novo registro adicionado com sucesso.';
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
    
			  $options_fases = array();
		      foreach ($fases as $row)
		      {
		      	$options_fases[$row["id"]] = $row["titulo"];
		      }

		      $options_responsavel = array();
		      foreach ($responsaveis as $row)
		      {
		      	$options_responsavel[$row["id_usuario"]] = $row["nome"];
		      }

		      $options_prioridade = array();
		      foreach ($prioridades as  $row)
		      {
		      	$options_prioridade[$row["id"]] = $row["titulo"];
		      }
		      
		      
		      //$options_ativo = array('ativo' => 'Ativo', 'inativo' => 'Inativo');
		      
		      //$options_status = array('Elaboração' => 'Elaboração', 'Análise' => 'Análise', 'Revisão' => 'Revisão' );
		      
		      //form validation
		      echo validation_errors();
			?>
		 <div class="row">
          <div class="col-lg-10">
         	<?php echo form_open("admin/pas_fases/add/".$id_pas, $attributes); ?>
		     <fieldset>
		     <legend>Adicionar</legend>
			  <input class="form-control" type="hidden" id="id_pas" name="id_pas"  value="<?php echo $id_pas; ?>" >
			  <input class="form-control" type="hidden" id="data_ini" name="data_ini"  value="<?php echo $data_ini; ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_fases", $options_fases, set_value("id_fases") ? set_value("id_fases") : $id_fase, 'class="form-control"' );?>
		            <span class="input-group-addon">Atividade</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_responsavel", $options_responsavel, set_value("id_responsavel") ? set_value("id_responsavel") :  $id_responsavel , 'class="form-control"' );?>
		            <span class="input-group-addon">Responsável</span>
		        </div>
		      </div>		      
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="date" id="data_ini_planejada" name="data_ini_planejada"  placeholder="Data Início Planejada" value="<?php echo $data_ini_planejada; ?>" >
		            <span class="input-group-addon">Previsão Início</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<input class="form-control" type="text" id="prazo" name="prazo"  placeholder="Prazo" value="<?php echo set_value('prazo'); ?>" >
		            <span class="input-group-addon">Prazo</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_prioridade", $options_prioridade, set_value("id_prioridade") , 'class="form-control"' );?>
		            <span class="input-group-addon">Prioridade</span>
		        </div>
		      </div>			  
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<textarea class="form-control"  rows="5" id="observacoes" name="observacoes" placeholder="Observações" ><?php echo set_value('observacoes'); ?></textarea>
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


<script type="text/javascript">  

$(document).ready(function() {
	calcPrazo();
	
});

function calcPrazo(exist = null){
	var 
	id_pas   = $('#id_pas').val(),
	id_fases   = $('select[name=id_fases] option:selected').val();
  if(exist){
  }else{
	  $.getJSON('<?php echo base_url("admin/pas").'/';?>get_pas_prazos_by_id_pas_id_fase/'+id_pas+'/'+id_fases
	  ,
	  function( data ) {
		  console.log(data['result']);
		  $('#prazo').val(data['result']);
		}); 
  }; 		     
  
};			



$('select[name=id_fases]').on({
    change: function(){
    	calcPrazo();
	}
   
});	

</script>	
	   