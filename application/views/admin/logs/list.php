    <div class="container top">
		  <ul class="breadcrumb">
	        <li>
	          <a href="<?php echo site_url("admin"); ?>">
	            <?php echo ucfirst($this->uri->segment(1));?>
	          </a> 
	          
	        </li>
	        <li class="active">
	          <?php echo ucfirst($this->uri->segment(2));?>
	        </li>
	      </ul>
	      <div class="page-header users-header">
    		<h2>
              <?php echo ucfirst($this->uri->segment(2));?>
              <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
            </h2>
          </div>
	  <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array("class" => "form-inline reset-margin", "id" => "myform");
           
            //save the columns names in a array that we will use as filter         
            $options_logs = array();    
            foreach ($logs as $array) {
              foreach ($array as $key => $value) {
                $options_logs[$key] = $key;
              }
              break;
            }

            echo form_open("admin/logs", $attributes);
     
              echo form_label("Buscar:", "search_string");
              echo form_input("search_string", $search_string_selected);

              echo form_label("Ordenar por:", "order");
              echo form_dropdown("order", $options_logs, $order, 'class="span2"');

              $data_submit = array("name" => "mysubmit", "class" => "btn btn-primary", "value" => "Go");

              $options_order_type = array("Asc" => "Asc", "Desc" => "Desc");
              echo form_dropdown("order_type", $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
            	<th class="header">#</th>
				<th class="yellow header headerSortDown">trecho</th>
				<th class="yellow header headerSortDown">Velocidade</th>
				<th class="yellow header headerSortDown">Hodometro trecho</th>
				<th class="yellow header headerSortDown">GPS Velocidade</th>
				<th class="yellow header headerSortDown">GPS Hodometro</th>
				<th class="yellow header headerSortDown">GPS Latitude</th>
				<th class="yellow header headerSortDown">GPS Longitude</th>
				<th class="yellow header headerSortDown">GPS Altitude</th>
				<th class="yellow header headerSortDown">GPS Erro</th>
				<th class="yellow header headerSortDown">GPS Qnt. Satelites</th>
				<th class="yellow header headerSortDown">GPS X</th>
				<th class="yellow header headerSortDown">GPS Y</th>
				<th class="yellow header headerSortDown">GPS Azimute</th>
				<th class="yellow header headerSortDown">GPS_NMEA_GPRMC </th>
				<th class="yellow header headerSortDown">GPS_NMEA_GPGGA</th>
				<th class="yellow header headerSortDown">Frame Cam.1</th>
				<th class="yellow header headerSortDown">Frame Cam.2</th>
				<th class="yellow header headerSortDown">Tempo Cam.1</th>
				<th class="yellow header headerSortDown">Tempo Cam.2</th>
				<th class="yellow header headerSortDown">Data Hora</th>
				<th class="yellow header headerSortDown">Tempo Log</th>
				<th class="yellow header headerSortDown">Barometro Pressao</th>
				<th class="yellow header headerSortDown">Barametro Temperatura</th>
				<th class="yellow header headerSortDown">Barametro Altitude</th>
				<th class="yellow header headerSortDown">IRI INTERNO</th>
				<th class="yellow header headerSortDown">IRI EXTERNO</th>
				<th class="yellow header headerSortDown">Ext. Log</th>
				<th class="yellow header headerSortDown">Perimetro Urbano</th>
				<th class="yellow header headerSortDown">Sinalizacao Vert, Dir.</th>
				<th class="yellow header headerSortDown">Sinalizacao Vert, Esq.</th>
				<th class="yellow header headerSortDown">Acesso Direita</th>
				<th class="yellow header headerSortDown">Acesso Esquerda</th>
				<th class="yellow header headerSortDown">Tipo Revestimento</th>
				<th class="yellow header headerSortDown">Log Original</th>
				<th class="yellow header headerSortDown">Odometro</th>
				<th class="yellow header headerSortDown">Flecha Int</th>
				<th class="yellow header headerSortDown">Flacha Ext</th>
				
	    				</tr>
	            </thead>
	            <tbody>
	              <?php
	              foreach($logs as $row)
	              {
	                echo '<tr>';
	                echo '<td>'.$row['ID_LOG'].'</td>';
					echo '<td>'.$row['ID_TRECHO'].'</td>';
					echo '<td>'.$row['VELOCIDADE'].'</td>';
					echo '<td>'.$row['HODOMETRO_TRECHO'].'</td>';
					echo '<td>'.$row['GPS_VELOCIDADE'].'</td>';
					echo '<td>'.$row['GPS_HODOMETRO'].'</td>';
					echo '<td>'.$row['GPS_LATITUDE'].'</td>';
					echo '<td>'.$row['GPS_LONGITUDE'].'</td>';
					echo '<td>'.$row['GPS_ALTITUDE'].'</td>';
					echo '<td>'.$row['GPS_ERRO'].'</td>';
					echo '<td>'.$row['GPS_QTDE_SATELITES'].'</td>';
					echo '<td>'.$row['GPS_X'].'</td>';
					echo '<td>'.$row['GPS_Y'].'</td>';
					echo '<td>'.$row['GPS_AZIMUTE'].'</td>';
					echo '<td>'.$row['GPS_NMEA_GPRMC'].'</td>';
					echo '<td>'.$row['GPS_NMEA_GPGGA'].'</td>';
					echo '<td>'.$row['FRAME_CAMERA_1'].'</td>';
					echo '<td>'.$row['FRAME_CAMERA_2'].'</td>';
					echo '<td>'.$row['TEMPO_CAMERA_1'].'</td>';
					echo '<td>'.$row['TEMPO_CAMERA_2'].'</td>';
					echo '<td>'.$row['DATA_HORA'].'</td>';
					echo '<td>'.$row['TEMPO_LOG'].'</td>';
					echo '<td>'.$row['BAROMETRO_PRESSAO'].'</td>';
					echo '<td>'.$row['BAROMETRO_TEMPERATURA'].'</td>';
					echo '<td>'.$row['BAROMETRO_ALTITUDE'].'</td>';
					echo '<td>'.$row['IRI_INTERNO'].'</td>';
					echo '<td>'.$row['IRI_EXTERNO'].'</td>';
					echo '<td>'.$row['EXTENSAO_LOG'].'</td>';
					echo '<td>'.$row['PERIMETRO_URBANO'].'</td>';
					echo '<td>'.$row['SINALIZACAO_VERT_DIREITA'].'</td>';
					echo '<td>'.$row['SINALIZACAO_VERT_ESQUERDA'].'</td>';
					echo '<td>'.$row['ACESSO_DIREITA'].'</td>';
					echo '<td>'.$row['ACESSO_ESQUERDA'].'</td>';
					echo '<td>'.$row['TIPO_REVESTIMENTO'].'</td>';
					echo '<td>'.$row['ID_LOG_ORIGINAL'].'</td>';
					echo '<td>'.$row['odometro'].'</td>';
					echo '<td>'.$row['Flecha_Int'].'</td>';
					echo '<td>'.$row['Flecha_Ext'].'</td>';
					
	          echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/logs/update/'.$row['ID_LOG'].'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/logs/delete/'.$row['ID_LOG'].'" class="btn btn-danger">delete</a>
                </td>';
                echo "</tr>";
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>        </div>