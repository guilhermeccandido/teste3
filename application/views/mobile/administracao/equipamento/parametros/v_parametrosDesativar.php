<?php if(!$this->session->userdata('logged_in')) $this->load->view('/mobile/v_principal'); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div data-role="page" id="pageParametroDesativar" data-theme="a">
    <div data-role="content" data-theme="a">  
    <p>Para desativar um parâmetro, marque-o. Para reativar a coleta do parâmetro, desmarque-o. Para confirmar as alterações pressione Salvar.</p>
    <form name="formparam" id="formparam" method="post" action="<?php echo base_url(); ?>mobile/desativarParametros">               
       
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
            <legend>Meteorológicos:</legend>		
            <?php 
            if($desativados == false){
                
                foreach($meteorologicos as $meteo){
                    echo '<input type="checkbox" name="parametros[]" id="'.$meteo['id_parametro'].'" value="'.$meteo['id_parametro'].'" />
		    	     <label for="'.$meteo['id_parametro'].'"> '.$meteo['nome'].'</label>';
                }
            }
            
            if($desativados != false){
            
                foreach($meteorologicos as $meteo){
                    $desativado = 0;
                    foreach($desativados as $parametroDesativado){
                        if($parametroDesativado['id_parametro'] == $meteo['id_parametro']) $desativado = 1;
                    }
                    
                    if($desativado){
                        echo '<input type="checkbox" name="parametros[]" id="'.$meteo['id_parametro'].'" value="'.$meteo['id_parametro'].'" checked="checked" />
		    	         <label for="'.$meteo['id_parametro'].'"> '.$meteo['nome'].'</label>';
                    }
                    
                    if(!$desativado){
                        echo '<input type="checkbox" name="parametros[]" id="'.$meteo['id_parametro'].'" value="'.$meteo['id_parametro'].'" />
		    	         <label for="'.$meteo['id_parametro'].'"> '.$meteo['nome'].'</label>';
                    }
                    
                }
            }
           
            ?>  
                </fieldset>
			</div>                   
       
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
            <legend>Oceanográficos <small>(implementação futura)</small>:</legend>			                        
            <?php 
            
            if($desativados == false){
                
                foreach($oceanograficos as $oceano){
                    echo '<input type="checkbox" name="parametros[]" id="'.$oceano['id_parametro'].'" value="'.$oceano['id_parametro'].'" />
		    	    <label for="'.$oceano['id_parametro'].'"> '.$oceano['nome'].'</label>';
                }
            }
            
            if($desativados != false){
            
                foreach($oceanograficos as $oceano){
                    $desativado = 0;
                    foreach($desativados as $parametroDesativado){                        
                        if($parametroDesativado['id_parametro'] == $oceano['id_parametro']) $desativado = 1;
                    }
                    
                    if($desativado){
                        echo '<input type="checkbox" name="parametros[]" id="'.$oceano['id_parametro'].'" value="'.$oceano['id_parametro'].'" checked="checked" />
		    	         <label for="'.$oceano['id_parametro'].'"> '.$oceano['nome'].'</label>';
                    }
                    
                    if(!$desativado){
                        echo '<input type="checkbox" name="parametros[]" id="'.$oceano['id_parametro'].'" value="'.$oceano['id_parametro'].'" />
		    	         <label for="'.$oceano['id_parametro'].'"> '.$oceano['nome'].'</label>';
                    }
                    
                }
            }
            
            ?>
                </fieldset>
			</div>
			                                    
        <input type="hidden" name="id_boia" value="<?php echo $boia; ?>" />
        <input class="submit" type="submit" name="salvar" value="Salvar" data-icon="check" data-iconpos="right" />
    </form>
    <a href="<?php echo base_url();?>mobile/opcoesAdmin/sensores" data-role="button" data-transition="slide" data-icon="arrow-l" data-iconpos="left">
        Voltar</a>
    </div>
</div>
</body>
</html>