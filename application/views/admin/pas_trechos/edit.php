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
	         <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2)."/".$pas_trechos[0]['id_pas'] ; ?>">
	          <?php echo str_replace("_", " ", ucfirst("trechos")) ;?>
	         </a>
	        </li>
	        <li class="active">
	          <?php echo "Lote ".$pas['lote']; ?>
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
    		  
    		  $options_estados = array();
		      foreach ($estados as $row)
		      {
		      	$options_estados[$row["id"]] = $row["uf"];
		      }
		      
		      $rodo = set_value('rodovia') ?  set_value('rodovia') :  $pas_trechos[0]['rodovia']; 
		      //form validation
		      echo validation_errors();
    	     ?>
		 <div class="row">
          <div class="col-lg-8">
			 <?php echo form_open("admin/pas_trechos/update/".$this->uri->segment(4)."/".$pas_trechos[0]['id_pas'] , $attributes); ?>
		     <fieldset>
			 <legend>Editar</legend>
			  <input class="form-control" type="hidden" id="id_pas" name="id_pas"  value="<?php echo $pas_trechos[0]['id_pas'] ?>" >
			  <input class="form-control" type="hidden" id="coordenadas" name="coordenadas"  value="<?php echo $pas_trechos[0]['coordenadas'];?>" >
			  <input class="form-control" type="hidden" id="erro" name="erro"  value="<?php echo $pas_trechos[0]['erro'];?>" >
			  <div class="form-group col-lg-12">
		        <div class="input-group col-lg-8">
		        	<?php echo form_dropdown("id_estados", $options_estados, set_value("id_estados") ?  set_value('id_estados') :  $pas_trechos[0]['id_estados'], 'class="form-control"' );?>
		            <span class="input-group-addon">UF</span>
		        </div>
		      </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
		     	 <?php echo form_dropdown("rodovia", array() , $rodo , 'class="form-control" placeholder="Rodovia"  ' );?>
	              <span class="input-group-addon">Rodovia</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="trecho" name="trecho" placeholder="trecho" value="<?php echo set_value('trecho') ?  set_value('trecho') :  $pas_trechos[0]['trecho']; ?>" >
	              <span class="input-group-addon">Trecho</span>
	            </div>
	          </div>
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="subtrecho" name="subtrecho" placeholder="Subtrecho" value="<?php echo set_value('subtrecho') ?  set_value('subtrecho') :  $pas_trechos[0]['subtrecho']; ?>" >
	              <span class="input-group-addon">Subtrecho</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="km_inicial" name="km_inicial" placeholder="Km Inicial" onchange="soma();" onfocus="soma();"  value="<?php echo set_value('km_inicial') ?  set_value('km_inicial') :  $pas_trechos[0]['km_inicial']; ?>" >
	              <span class="input-group-addon">Km Inicial</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="km_final" name="km_final" placeholder="Km Final"  onchange="soma();" onfocus="soma();"  value="<?php echo set_value('km_final') ?  set_value('km_final') :  $pas_trechos[0]['km_final']; ?>" >
	              <span class="input-group-addon">Km Final</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="extensao" name="extensao" placeholder="Extensão"  onfocus="soma();" value="<?php echo set_value('extensao') ?  set_value('extensao') :  $pas_trechos[0]['extensao']; ?>" >
	              <span class="input-group-addon">Extensão</span>
	            </div>
	          </div>
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="snv" name="snv" placeholder="SNV" value="<?php echo set_value('snv') ?  set_value('snv') :  $pas_trechos[0]['snv']; ?>" >
	              <span class="input-group-addon">SNV</span>
	            </div>
	          </div>	 
	          <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <input class="form-control" type="text" id="snv_versao" name="snv_versao" placeholder="SNV Versão" value="<?php echo set_value('snv_versao') ?  set_value('snv_versao') :  $pas_trechos[0]['snv_versao']; ?>" >
	              <span class="input-group-addon">SNV Versão</span>
	            </div>
	          </div>         
			  <div class="form-group col-lg-12">
		     	 <div class="input-group col-lg-8">
	              <textarea class="form-control" rows="5" placeholder="Observações" id="observacoes" name="observacoes"><?php echo set_value('observacoes') ?  set_value('observacoes') :  $pas_trechos[0]['observacoes']; ?></textarea>
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
		  <div class="col-lg-4">
			   <script src="https://js.arcgis.com/3.27/"></script>
			   <div id="map"></div>
		  	
		  </div>		   
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

<script type="text/javascript">


function soma() {
	var a = $('#km_inicial').val(); 
    var b = $('#km_final').val();
    
    var result;
    
	a = a.replace(",", ".");
	b = b.replace(",", ".");
	
	$('#km_inicial').val(a);
	$('#km_final').val(b);
	
	result = b-a;
	result = Math.abs(result);

	$("#coordenadas").val('');
    $('#extensao').val(result.toFixed(1));
    $( "#extensao" ).trigger( "click" );
}

function open_modal(mens){


	var mensagem = mens;


	$(".modal-body").text(mensagem);
	$('#myModal').modal('show');
	
	console.log(mensagem);
}

$('select[name=rodovia]').on({
    change: function(){
    	$("#coordenadas").val('');
		$( "#extensao" ).trigger( "click" );
	}
   
});	


function isValidDate(s) {
	  var bits = s.split('-');
	  var d = new Date(bits[0], bits[1] - 1, bits[2]);
	  
	  if((d.getMonth() + 1) == bits[1] && d.getFullYear() == bits[0] && d.getFullYear() >= 2000 ){
		  console.log(bits[0], bits[1] - 1, bits[2]);
		  return true ;	   
	  }
	} 

$('#data_base').on({
  change: function(){
	    if(isValidDate($('#data_base').val())){
	    	$( "#extensao" ).trigger( "click" );
		} 
	}
 
});


$('select[name=id_estados]').on({
    change: function(){

    	var uf   = $('select[name=id_estados] option:selected').text(),
		   el   = $('select[name=rodovia]');
		  el.find('option').remove();
		  el.prepend('<option value="">Select</option>');
		  el.attr('disabled');    
		  $.getJSON('https://servicos.dnit.gov.br/dnitgeo/SNV/MapServer/0/query?where=sg_uf+%3D+%27'+uf+'%27&text=&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&relationParam=&outFields=vl_br&returnGeometry=false&maxAllowableOffset=&geometryPrecision=&outSR=&returnIdsOnly=false&returnCountOnly=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&returnZ=false&returnM=false&gdbVersion=&returnDistinctValues=true&f=pjson' 
		  ,
		 
		  function( data ) {
			  for (var i = data['features'].length - 1; i >= 0; i--) {
				
				el.prepend($('<option>', { 
			        value: data['features'][i]['attributes']['vl_br'],
			        text : data['features'][i]['attributes']['vl_br'] 
			    }));
		      };
			});
		  $("#coordenadas").val('');
		  $( "#extensao" ).trigger( "click" );	
	}
   
});


	var	uf   = $('select[name=id_estados] option:selected').text(),
	el   = $('select[name=rodovia]');
	el.find('option').remove();
	el.prepend('<option value="<?php echo  $rodo ?>"><?php echo $rodo ?></option>');
	el.attr('disabled');    
	 $.getJSON('https://servicos.dnit.gov.br/dnitgeo/SNV/MapServer/0/query?where=sg_uf+%3D+%27'+uf+'%27&text=&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&relationParam=&outFields=vl_br&returnGeometry=false&maxAllowableOffset=&geometryPrecision=&outSR=&returnIdsOnly=false&returnCountOnly=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&returnZ=false&returnM=false&gdbVersion=&returnDistinctValues=true&f=pjson' 
	,
	
	function( data ) {
		  for (var i = data['features'].length - 1; i >= 0; i--) {
			
			el.prepend($('<option>', { 
		        value: data['features'][i]['attributes']['vl_br'],
		        text : data['features'][i]['attributes']['vl_br'] 
		    }));
	   };
	   
	   
	});

		
	
	var map;
    dojo.require("esri.geometry.Polyline");
    dojo.require("esri.graphic");
    dojo.require("esri.symbols.SimpleLineSymbol");
    dojo.require("esri.layers.FeatureLayer");
    dojo.require("esri.tasks.FeatureSet");
    dojo.require("esri.renderers.SimpleRenderer");
    dojo.require("esri.InfoTemplate");
    dojo.require("dojox.widget.ColorPicker");
    dojo.require("dojo.parser");
    dojo.require("dijit.registry");

	   
	  
	  require([	"esri/map", 
	     	  	"esri/geometry/Extent", 
	     	  	"esri/geometry/Polyline",
	     	  	"esri/layers/ArcGISDynamicMapServiceLayer",   
	     	  	"dojo/dom", 
	     	  	"dojo/on", 
	     	  	"dojo/query", 
	     	  	"dojo/_base/array",  
	     	  	"dojo/domReady!"], function (Map, Extent, Polyline,  ArcGISDynamicMapServiceLayer, dom, on, query, arrayUtils  ) {
	        
	        initialExtent = new Extent({
	            xmin: -16079904.766291741,
	            ymin: -7007746.75318313,
	            xmax: 2705259.30506818,
	            ymax: 2316347.705153331,
	            "spatialReference": {
	                "wkid": 102100
	            }
	        });
	       
	        map = new Map("map", {
	            basemap: "topo",  
	            extent: initialExtent,
	            autoResize: true,
	        });

	        if($("#coordenadas").val() !== ''){

		        
	        	var jsArray =  <?php echo $pas_trechos[0]['coordenadas'] ? $pas_trechos[0]['coordenadas'] : '[]' ;?>;
				

				var singlePathPolyline = new esri.geometry.Polyline({ "paths": jsArray, "spatialReference": { "wkid": 4326 } });
                var i = singlePathPolyline.paths.length - 1;
                var p = parseInt((singlePathPolyline.paths[i].length - 1) / 2);
                var point = singlePathPolyline.getPoint(i, p);

                var url = "https://servicos.dnit.gov.br/vgeo?lat=" + point.y + "&lon=" + point.x;
                var graphic = new esri.Graphic(singlePathPolyline, null, { "id" : 1, "ObjectID": 100, "DNIT": "<a href=\"" + url + "\"  target='_blank'>mais detalhes</a>" });
                
                
                criarLayer(graphic, 'teste');

                map.setExtent(singlePathPolyline.getExtent());
							    	    
		    }
	        	        
			extNode = dom.byId("extensao");
			console.log(extNode);

	        on( extNode, "click", function () {
	        	try {

					
	        		
	                var km_inicial = $('#km_inicial').val();
	                var km_final = $('#km_final').val();
	                var uf = $('select[name=id_estados] option:selected').text();
	                var br = $('select[name=rodovia] option:selected').text();
	                var ext = $('#extensao').val();

	                km_inicial = km_inicial*1;
	                km_final = km_final*1;
	            	
	                if(km_inicial !== "" && 
	    	                km_final !== "" && 
	    	                km_inicial !== ext &&
	    	                km_final > km_inicial && 
	    	                uf !== "" &&
	    	                br !== "Select" &&
	    	                br !== ""){

	                	
	                	
	                	var obj = {
                	            uf: uf,
                	            br: br,
                	            tipo: "B",
                	            km_inicial: km_inicial,
                	            km_final: km_final

                	    };
	                	
		                	
		          $.ajax({
		                    type: "GET",
		                    url: "https://servicos.dnit.gov.br/dadospnct/webservicesnv/service/snv/SegmentarLinhaSNV",
		                   // data: JSON.stringify(obj),
						   data:{br: br, uf: uf, sgTipoTrecho: "B", kmInicial: km_inicial,kmFinal: km_final, dataReferencia: formatDate(new Date())},
		                    dataType: "json",
							//crossDomain: true,						
		                    success: function (resp) {
		                        console.log(resp)
										                       
		                        if (resp.attributes && resp.attributes.DsErro.indexOf("no error") === -1) {
		                            km_final_erro = rresp.attributes.KmFinal;
		                            $('#erro').val(resp.attributes.DsErro);
		                            
		                        }
		                       
		                        $("#coordenadas").val(JSON.stringify(resp.geometry.paths));
		                        
		                        var singlePathPolyline = new Polyline({ "paths": resp.geometry.paths, "spatialReference": { "wkid": 4326 } });
		                        var i = singlePathPolyline.paths.length - 1;
		                        var p = parseInt((singlePathPolyline.paths[i].length - 1) / 2);
		                        var point = singlePathPolyline.getPoint(i, p);

		                        var url = "http://servicos.dnit.gov.br/vgeo?lat=" + point.y + "&lon=" + point.x;
		                        var graphic = new esri.Graphic(singlePathPolyline, null, { "id" : 1, "ObjectID": 100, "DNIT": "<a href=\"" + url + "\"  target='_blank'>mais detalhes</a>" });

		                        clearGraphics();
		                        criarLayer(graphic, resp.attributes.DsVersaoSnv);

		                        $("#snv_versao").val(resp.attributes.DsVersaoSnv);

		                        map.setExtent(singlePathPolyline.getExtent());
		                       
		                    },
		                    error: function (xhr, status, error) {
		                        alert('Update Error occurred - ' + error);
		                    }
		                });
		            }
	                
	                
	                
	            } catch (e) {
	                console.log(e);
	            }
	        });

	    });

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month, year].join('-');
}
	  function changeRenderer(featureLayer) {
		  
	        var symbol = null;
	        var cor = '#336699';

        switch (featureLayer.geometryType) {
            case 'esriGeometryPolyline':
                symbol = new esri.symbol.SimpleLineSymbol(esri.symbol.SimpleLineSymbol.STYLE_SOLID, new dojo.Color(cor), 5);
                break;
        }
        if (symbol) {
            featureLayer.setRenderer(new esri.renderer.SimpleRenderer(symbol));
        }
        return featureLayer;
     }
	     
    
	  
	  function criarLayer(graphic, nm_versao) {
	        var featureCollection = {
	            "layerDefinition": null,
	            "featureSet": {
	                "features": [graphic],
	                "geometryType": "esriGeometryPolyline"
	            }
	        };
	        featureCollection.layerDefinition = {
	            "geometryType": "esriGeometryPolyline",
	            "objectIdField": "ObjectID",
	            "drawingInfo": {
	                "renderer": {
	                    "Simple Renderer": {
	                        "symbol": {
	                            "Style": "esriSLSSolid",
	                            "Color": [255, 0, 0, 1],
	                            "width": 3
	                        },
	                        "Label": null,
	                        "Description": null
	                    },
	                    "Transparency": 0
	                }
	            },
	            "fields": [{
	                "name": "ObjectID",
	                "alias": "ObjectID",
	                "type": "esriFieldTypeOID"
	            }, {
	                "name": "url",
	                "alias": "url",
	                "type": "esriFieldTypeString"
	            }]
	        };


	        var infoTemplate = new esri.InfoTemplate("Details", "${*}");
	        var featureLayer = new esri.layers.FeatureLayer(featureCollection, {
	            infoTemplate: infoTemplate,
	            className: nm_versao
	        });

	        dojo.connect(featureLayer, 'onClick', function (evt) {
	            map.infoWindow.setFeatures([evt.graphic]);
	            
	        });
	        map.addLayer(changeRenderer(featureLayer));

	    }
	 


	  function clearMap() {
		    for(i in map._layers) {
		        if(map._layers[i]._path != undefined) {
		            try {
		            	map.removeLayer(map._layers[i]);
		            }
		            catch(e) {
		                console.log("problem with " + e + map._layers[i]);
		            }
		        }
		    }
		}

	  function clearGraphics() {
	        map.graphics.clear();
	        var graphicLayerIds = map.graphicsLayerIds;
	        var len = graphicLayerIds.length;
	        for (var i = 0; i < len; i++) {
	            var gLayer = map.getLayer(graphicLayerIds[i]);
	            gLayer.clear();
	        }

	    }

</script>