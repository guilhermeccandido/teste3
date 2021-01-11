<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title></title>
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/mobile-themes/tema.min.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css" />
  
  <!-- jQuery and jQuery Mobile -->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

</head>
<body>
<!-- Home -->
<div data-role="page" id="page1">
    <div data-theme="a" data-role="header">
        <h3>
            SiMCosta
        </h3>
    </div>
	<h3 class="tituloSecundario">
		Fundeio <?php echo $boia.'<br />'; if(!empty($datas)) echo 'Dados Meteorologicos: '.$datas['data'].' '.$datas['hora']. '<br> Dados Oceanograficos: '.$datas['dataOceano'].' '.$datas['horaOceano']; ?>
	</h3>
	<?php if(!empty($dadosParametros)){ ?>
	<table>
		<tr>
			<th colspan="3">Meteorológicos</th>
		</tr>
		<tr>
			<td>Temperatura do Ar (C°)</td>
			<td></td>
			<td><?php echo $dadosParametros['temperatura_ar']; ?></td>
		</tr>
		<tr>
			<td>Direção do Vento (°)</td>
			<td></td>
			<td><?php echo $dadosParametros['direcao_vento']; ?></td>		
		</tr>
		<tr>
			<td>Velocidade do Vento (m/s)</td>
			<td></td>
			<td><?php echo $dadosParametros['velocidade_vento']; ?></td>
		</tr>
		<tr>
			<td>Pressão Atmosférica (mbar)</td>
			<td></td>
			<td><?php echo $dadosParametros['pressao_atmosferica']; ?></td>
		</tr>
		<tr>
			<td>Precipitação Pluviom. (mm)</td>
			<td></td>
			<td><?php echo $dadosParametros['precipitacao_pluviometrica']; ?></td>
		</tr>
		<tr>
			<td>Conc. de CO<sub>2</sub> (ppm)</td>
			<td></td>
			<td><?php echo $dadosParametros['concentracao_co2']; ?></td>
		</tr>
		<tr>
			<td>Radiação Solar (Wm<sup>2</sup>)</td>
			<td></td>
			<td><?php echo $dadosParametros['radiacao_solar']; ?></td>
		</tr>
		<tr>
			<td>Umidade Rel. do Ar (%)</td>
			<td></td>
			<td><?php echo $dadosParametros['umidade_relativa_ar']; ?></td>
		</tr>
		
	</table>

	<br />
	
	<table>
		<tr>
			<th colspan="3">Oceanográficos</th>
		</tr>
		<tr>
			<td>Temperatura do Água (C°)</td>
			<td></td>
			<td><?php echo $dadosParametros['temperatura_agua']; ?></td>
		</tr>
		<tr>
			<td>Salinidade</td>
			<td></td>
			<td><?php echo $dadosParametros['salinidade']; ?></td>
		</tr>
		<tr>
			<td>Profundidade (m)</td>
			<td></td>
			<td><?php echo $dadosParametros['profundidade']; ?></td>
		</tr>
		<tr>
			<td>Turbidez (NTU)</td>
			<td></td>
			<td><?php echo $dadosParametros['turbidez']; ?><td>
		</tr>
		<tr>
			<td>CDOM (QSDE)</td>
			<td></td>
			<td><?php echo $dadosParametros['cdom']; ?></td>
		</tr>
		<tr>
			<td>Clorofila-a (µg/l)</td>
			<td></td>
			<td><?php echo $dadosParametros['fluor']; ?></td>
		</tr>
		<tr>
			<td>O<sub>2</sub> Dissolvido (ml/l)</td>
			<td></td>
			<td><?php echo $dadosParametros['o2_dissolvido']; ?></td>
		</tr>
		<tr>
			<td>O<sub>2</sub> Saturado (ml/l)</td>
			<td></td>
			<td><?php echo $dadosParametros['o2_saturado']; ?></td>
		</tr>		
		<tr>
			<td>Nitrato (µM)</td>
			<td></td>
			<td><?php echo $dadosParametros['nitrato']; ?></td>
		</tr>
		<tr>
			<td>ph (Total)</td>
			<td></td>
			<td><?php echo $dadosParametros['ph']; ?></td>
		</tr>		
		<tr>
			<td>Altura de ondas (m)</td>
			<td></td>
			<td><?php echo $dadosParametros['awac_ondas_altura']; ?></td>
		</tr>
		<tr>
			<td>Perfil de Corrente (m/s)</td>
			<td></td>
			<td><?php echo $dadosParametros['awac_ondas_periodo']; ?></td>
		</tr>
		<tr>
			<td>Direção da Corrente (°)</td>
			<td></td>
			<td><?php echo $dadosParametros['direcao_corrente']; ?></td>
		</tr>
		<tr>
			<td>Velocidade Corrente (cm/s)</td>
			<td></td>
			<td><?php echo $dadosParametros['velocidade_corrente']; ?></td>
		</tr>
	</table>
	<?php } ?>
        <a data-role="button" data-rel="back" data-theme="b" data-icon="arrow-l" data-iconpos="left">
            Voltar
        </a>
</div>
</body>
</html>
