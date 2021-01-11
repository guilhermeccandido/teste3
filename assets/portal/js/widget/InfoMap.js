define([
    "dojo/_base/declare",
    "dojo/_base/lang",
        "esri/InfoTemplate",
        "esri/graphic",
        "esri/graphicsUtils",
        "esri/tasks/IdentifyParameters",
        "esri/tasks/IdentifyTask",
        "dojo/_base/array",
        "dojo/_base/Color",
        "dojo/on",
        "dojo/dom-style",
        "dojo/_base/fx",
        "dojo/fx/easing",
        "dojo/dom",
], function (declare, lang, InfoTemplate, Graphic, graphicsUtils, IdentifyParameters,IdentifyTask, arrayUtils, Color, on, domStyle, fx, easing, dom) {
    return declare("DNIT.InfoMapa", null, {
        // Locals
        map: null,
        popup: null,
        infoTemplate: null,
        constructor: function (options) {
            lang.mixin(this, options);
            var that = this;

            on(this.map, "Click", function (evt) {

                that._executaConsulta(evt);
            });
        },
        _executaConsulta: function (evt) {
            //altera o ponteiro do mouse.
            var that = this;
            that.map.setMapCursor('wait');
            //  this.setMapCursor('wait');
            var point = evt.mapPoint;
            var layerFields = [];
            //TODO: Estudar os parametros                    
            var layers = dojo.map(that.map.layerIds, function (layerId) {
                return that.map.getLayer(layerId);
            }); //Create an array of all layers in the map
            layers = dojo.filter(layers, function (layer) {
                //verifica as layers visiveis com o id maior que -1
                var list = [];
                if (layer.visibleLayers !== undefined) {
                    list = layer.visibleLayers.filter(function (layerInfo) { return layerInfo > -1; });
                };
                return list.length > 0 && layer.getImageUrl && layer.visible;
            }); //Only dynamic layers have the getImageUrl function. Filter so you only query visible dynamic layers

            var tasks = dojo.map(layers, function (layer) {
                var ids = layer.layerInfos.filter(function (layerInfo) { return layerInfo.defaultVisibility && layerInfo.subLayerIds === null }).map(function (layerInfo) { return layerInfo.id });
                //chama a função que pesquisa os filds da layer
                if (ids.length > 0) {
                    dojo.map(ids, function (id) {
                        $.ajax({
                            type: "POST",
                            url: layer.url + id,
                            data: { f: "json" },
                            dataType: "jsonp",
                            async: false,
                            callbackParamName: "callback"
                        }).then(function (resp) { layerFields.push(resp); });
                    });
                }
                return ((ids.length > 0 && layer.visible) && { tasks: new IdentifyTask(layer.url), ids: ids });
            }); //map each visible dynamic layer to a new identify task, using the layer url
            var tasks = tasks.filter(function (obj) {
                return obj !== false;
            });
            var defTasks = dojo.map(tasks, function (task) {
                return new dojo.Deferred();
            }); //map each identify task to a new dojo.Deferred
            var dlTasks = new dojo.DeferredList(defTasks); //And use all of these Deferreds in a DeferredList

            dlTasks.then(function (r) { that._showResults(r, layerFields, point) }); //chain showResults onto your DeferredList
            //Parametros de identificação
            var identifyParams = new IdentifyParameters();
            identifyParams.tolerance = 3;
            identifyParams.returnGeometry = true;
            identifyParams.layerOption = IdentifyParameters.LAYER_OPTION_VISIBLE;
            identifyParams.width = that.map.width;
            identifyParams.height = that.map.height;
            identifyParams.geometry = point;
            identifyParams.mapExtent = that.map.extent;
            for (i = 0; i < tasks.length; i++) { //Use 'for' instead of 'for...in' so you can sync tasks with defTasks
                try {
                    identifyParams.layerIds = tasks[i].ids;//passa para o identifyparams os ids das layers visiveis (ativadas)
                    if (tasks[i].ids.length > 0) {
                        tasks[i].tasks.execute(identifyParams, defTasks[i].callback, defTasks[i].errback); //Execute each task                                  
                    }
                } catch (e) {
                    that.map.setMapCursor('default');
                    defTasks[i].errback(e); //If you get an error for any task, execute the errback
                }
            }
            that.map.setMapCursor('default');
        },

        _showResults: function (r, resultFields, point) {
            var that = this;
            var results = [];
            r = arrayUtils.filter(r, function (result) {
                return r[0];
            }); //filter out any failed tasks
            for (i = 0; i < r.length; i++) {
                 if (r[i][0] === true) {
                results = results.concat(r[i][1]);
                }
            }
            results = arrayUtils.filter(results, function (e) { return (e && (!dojo.isArray(e) && r !== null)); });

            var arr = arrayUtils.map(results, function (result) {
                var feature = result.feature;
                feature.geometry.spatialReference = that.map.spatialReference;
                // falta montar um t		
                var infoTemplate = new InfoTemplate();
                // foreach para mais funcionalidades
                infoTemplate.setTitle(resultFields[0].name);
                infoTemplate.setContent(that._montarTemplate(feature, resultFields[0].fields));
                
                feature.setInfoTemplate(infoTemplate)
                return feature;
            });

            that.map.infoWindow.setFeatures(arr);
            that.map.infoWindow.show(point);
            that.map.setMapCursor('default');
        },
        _montarTemplate: function (graphic, fields) {
            var that = this;
            var text = "";
            var attributes = graphic.attributes;

            for (var i = 0; i < fields.length; i++) {
                if (fields[i].type === "esriFieldTypeDate") {
                    text += "<b>" + fields[i].alias.replace(/_/g, " ") + "</b> : " + that._formatarData(attributes[fields[i].alias]) + "<br/>";
                } else if (attributes[fields[i].alias] === null || attributes[fields[i].alias] === "") {
                    text += "<b>" + fields[i].alias.replace(/_/g, " ").toUpperCase() + "</b> : <br/>";
                } else if (fields[i].type === "esriFieldTypeString") {
                    text += "<b>" + fields[i].alias.replace(/_/g, " ").toUpperCase() + "</b> : " + (attributes[fields[i].alias] !== undefined ? attributes[fields[i].alias] : '') + "<br/>";
                } else {
                    if (attributes[fields[i].alias] === false) {
                        text += "<b>" + fields[i].alias.replace(/_/g, " ").toUpperCase() + "</b> : Não <br/>";
                    } else if (attributes[fields[i].alias] === true) {
                        text += "<b>" + fields[i].alias.replace(/_/g, " ").toUpperCase() + "</b> : Sim <br/>";

                    } else {
                        text += "<b>" + fields[i].alias.replace(/_/g, " ").toUpperCase() + "</b> : " + attributes[fields[i].alias] + "<br/>";
                    }
                }
            }
            return text;
        }
    });
});



