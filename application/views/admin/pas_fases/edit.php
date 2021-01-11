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
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$pas_fases[0]['id_pas'] ; ?>">
	          <?php echo ucfirst('atividades');?>
	         </a>
	        </li>
	        <li class="active">
	          <?php echo 'LOTE '.$lote; ?>
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
		      
		      //$options_status = array('Elaboração' => 'Elaboração', 'Análise' => 'Análise', 'Revisão' => 'Revisão');
		      
		      //$options_ativo = array('ativo' => 'Ativo', 'inativo' => 'Inativo');
		      
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-10">
			 <?php echo form_open("admin/pas_fases/update/".$this->uri->segment(4)."/".$pas_fases[0]['id_pas'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_pas" name="id_pas"  value="<?php echo $pas_fases[0]['id_pas'] ?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_fases", $options_fases, set_value("id_fases") ? set_value("id_fases") :  $pas_fases[0]["id_fases"], 'class="form-control"' );?>
		            <span class="input-group-addon">Atividade</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_responsavel", $options_responsavel, set_value("id_responsavel") ? set_value("id_responsavel") : $pas_fases[0]["id_responsavel"] , 'class="form-control"' );?>
		            <span class="input-group-addon">Responsável</span>
		        </div>
		      </div>
		      <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_ini" name="data_ini" placeholder="Data Início" value="<?php echo set_value('data_ini') ?  set_value('data_ini') :  $pas_fases[0]['data_ini']; ?>" >
	              <span class="input-group-addon">Início Edital</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_fim" name="data_fim" placeholder="Data Fim" value="<?php echo set_value('data_fim') ?  set_value('data_fim') :  $pas_fases[0]['data_fim']; ?>" >
	              <span class="input-group-addon">Data Fim Edital</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_ini_planejada" name="data_ini_planejada" placeholder="Data Início" value="<?php echo set_value('data_ini_planejada') ?  set_value('data_ini_planejada') :  $pas_fases[0]['data_ini_planejada']; ?>" >
	              <span class="input-group-addon">Início Planejado</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="date" id="data_fim_planejada" name="data_fim_planejada" placeholder="Data Fim PLanejada" value="<?php echo set_value('data_fim_planejada') ?  set_value('data_fim_planejada') :  $pas_fases[0]['data_fim_planejada']; ?>" >
	              <span class="input-group-addon">Data Fim Planejado</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="prazo" name="prazo" placeholder="Prazo" value="<?php echo set_value('prazo') ?  set_value('prazo') :  $pas_fases[0]['prazo']; ?>" >
	              <span class="input-group-addon">Prazo</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_prioridade", $options_prioridade, set_value("id_prioridade") ? set_value("id_prioridade") :  $pas_fases[0]["id_prioridade"], 'class="form-control"' );?>
		            <span class="input-group-addon">Prioridade</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $pas_fases[0]['observacoes']; ?></textarea>
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
	calcPrazo(<?php echo set_value('prazo') ?  set_value('prazo') :  $pas_fases[0]['prazo']; ?>);
	
});

$('select[name=id_fases]').on({
    change: function(){
    	calcPrazo();
	}
   
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

</script>	

