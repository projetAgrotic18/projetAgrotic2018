<!doctype html>
<?php session_start(); ?>
<html >
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Carte PACA</title>

<style>
      .StyleCarte {
        height: 500px;
        width: 800px;
      }
     .ol-popup {
        position: absolute;
        background-color: white;
        padding: 5px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        bottom: 5px;
        left: -50px;
		width: 210px;
		font-size:12px;
      }
      .ol-popup:after, .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
      }
      .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
      }
      .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
      }
      .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 2px;
        right: 8px;
      }
      .ol-popup-closer:after {
        content: "✖";
      }
      </style>
      <script src="http://openlayers.org/en/v3.13.0/build/ol.js" type="text/javascript"></script>
      <script type="text/javascript">
          function masquer_div(id) {
              if (document.getElementById(id).style.display == 'none') 
              {
                  document.getElementById(id).style.display = 'block';
              } else {
                  document.getElementById(id).style.display = 'none';
              }
          }
      </script>        
    </head>
    <body>
        <!-- Entête -->
        <!-- DIV Navigation (Menus) -->
        <?php include('../general/Front/navigation.php'); ?>

		
        <div class="padding" align="center">
            <h2>Carte des exploitations de la région Provence Alpes Côte d'Azur </h2>
            <TABLE> 
	   <TR>
           <TD WIDTH="20%">
               <input align='center' class='btn bouton-sonnaille' type="button" value="Sélectionner les couches" onclick="masquer_div('a_masquer');"/> <br/>   <br/>
               <div class="padding" id="a_masquer" style="display:none;">
                   <input style='cursor:pointer' type="checkbox" value="0" checked onclick="javascript:layerswitch(this)"
                class='Couche1' name="couche0check" id="couche0check"/>
                   <label id="Couche0checkLabel" for="Couche0check"> Open Street Map </label> <br/>

                   <input style='cursor:pointer' type="checkbox" value="1" checked onclick="javascript:layerswitch(this)"
                class="Couche1" name="couche1check" id="couche1check"/>
                   <label id="Couche1checkLabel" for="Couche1check"> Départements </label> <br/>

                   <input style='cursor:pointer' type="checkbox" value="2" onclick="javascript:layerswitch(this)"
                class="Couche2" name="couche2check" id="couche2check"/>
                   <label id="Couche2checkLabel" for="Couche2check"> Avec Libellés  </label> <br/>

                   <input style='cursor:pointer' type="checkbox" value="3" onclick="javascript:layerswitch(this)"
                class="Couche3" name="couche3check" id="couche3check"/>
                   <label id="Couche3checkLabel" for="Couche3check"> Communes </label> <br/>	

                   <input style='cursor:pointer' type="checkbox" value="4" onclick="javascript:layerswitch(this)"
                class="Couche4" name="couche4check" id="couche4check"/>
                   <label id="Couche4checkLabel" for="Couche4check"> Exploitations </label> <br/>

                   <input style='cursor:pointer' type="checkbox" value="5" onclick="javascript:layerswitch(this)"
                class="Couche5" name="couche5check" id="couche5check"/>
                   <label id="Couche5checkLabel" for="Couche5check"> Troupeaux </label> <br/>
               </div>
           </TD>
           <TD WIDTH="70%"> 
               <div id="laCarte" class="StyleCarte">
                   <div id="maPopup" class="ol-popup">
                       <a href="#" id="monPopupCloser" class="ol-popup-closer"></a>
                       <div id="monContenuPopup"></div>
                   </div>
               </div>
           </TD> 
           <TD>
               <input  align='center' class='btn bouton-sonnaille' type="button" value="Visualiser les zones tampons" onclick="masquer_div('zone_tampon');"/> <br/> <br/>
               <div id="zone_tampon" style="display:none;">
                   <input style='cursor:pointer' type="checkbox" value="6" onclick="javascript:layerswitch(this)"
                class="Couche6" name="couche6check" id="couche6check"/>
                   <label id="Couche6checkLabel" for="Couche6check">Toutes les zones tampons </label> <br/><br/>
               </div>
           </TD>
                </TR>
            </TABLE>
        </div>
        <script type="text/javascript">
            var monContainer = document.getElementById('maPopup'); //objet HTML  qui constitue la popup
            var contenuPopup = document.getElementById('monContenuPopup'); //objet HTML qui constitue son contenu
            var monCloser = document.getElementById('monPopupCloser'); //objet HTML qui permet de fermer la popup "X"
            
            var wms=new ol.layer.Tile({
                    extent: [470912,5309234,859045,5641512],
                    visible: false,
                    source: new ol.source.TileWMS({
                        url: 'http://194.199.251.68/cgi-bin/mapserv.exe?map=D:/ms4w/Apache/htdocs/projetAgrotic2018/carte/cartepaca3857.map&',
                        params: {'LAYERS':'zoneprot', 'TILED': true},
                        serverType: 'mapserver'
                        })
                    });
            
            var mesCouches = [
              new ol.layer.Tile({
                source: new ol.source.OSM()
                }),
            new ol.layer.Tile({
                    extent: [470912,5309234,859045,5641512],
                    source: new ol.source.TileWMS({
                        url: 'http://194.199.251.68/cgi-bin/mapserv.exe?map=D:/ms4w/Apache/htdocs/projetAgrotic2018/carte/cartepaca3857.map&',
                        params: {'LAYERS':'departements', 'TILED': true},
                        serverType: 'mapserver'
                        })
                    }),
             new ol.layer.Tile({
                    extent: [470912,5309234,859045,5641512],
                    visible: false,
                    source: new ol.source.TileWMS({
                        url: 'http://194.199.251.68/cgi-bin/mapserv.exe?map=D:/ms4w/Apache/htdocs/projetAgrotic2018/carte/cartepaca3857.map&',
                        params: {'LAYERS':'departementslibelle', 'TILED': true},
                        serverType: 'mapserver'
                    })
             }),
            new ol.layer.Tile({
                    extent: [470912,5309234,859045,5641512],
                    visible: false,
                    source: new ol.source.TileWMS({
                        url: 'http://194.199.251.68/cgi-bin/mapserv.exe?map=D:/ms4w/Apache/htdocs/projetAgrotic2018/carte/cartepaca3857.map&',
                        params: {'LAYERS':'communes', 'TILED': true},
                        serverType: 'mapserver'
                        })
                    }),
           
            new ol.layer.Tile({
                    extent: [470912,5309234,859045,5641512],
                    visible: false,
                    source: new ol.source.TileWMS({
                        url: 'http://194.199.251.68/cgi-bin/mapserv.exe?map=D:/ms4w/Apache/htdocs//projetAgrotic2018/carte/cartepaca3857.map&',
                        params: {'LAYERS':'exploitations', 'TILED': true},
                        serverType: 'mapserver'
                        })
                    }) ,
        new ol.layer.Tile({
                    extent: [470912,5309234,859045,5641512],
                    visible: false,
                    source: new ol.source.TileWMS({
                        url: 'http://194.199.251.68/cgi-bin/mapserv.exe?map=D:/ms4w/Apache/htdocs/projetAgrotic2018/carte/cartepaca3857.map&',
                        params: {'LAYERS':'troupeaux', 'TILED': true},
                        serverType: 'mapserver'
                        })
                    }) ,
                wms
        
        ];
            // Création de l'overlay qui supportera la popup
	       var monOverlay = new ol.Overlay({
               element: monContainer,
               autoPan: true,
               autoPanAnimation: {duration: 250}
           });
   
            // Ajoute un handler pour fermer la popup
            monCloser.onclick = function() {
                monOverlay.setPosition(undefined);
                monCloser.blur();
                // supprime la sélection de la parcelle
                maCarte.removeInteraction(selectSingleClick);
                return false;
            };	
            
      var maCarte = new ol.Map({
        target: 'laCarte',
        layers: mesCouches,
        overlays: [monOverlay],
        view: new ol.View({
          center: ol.proj.fromLonLat([6.2, 44.1]),
          zoom: 7.7
        })
      });
        var mesControls = [
        new ol.control.Attribution({
            collapsible: true,
            label: '?', // label du bouton
            collapsed: true,
            tipLabel: 'Click' //???
        }),
        new ol.control.MousePosition({
            undefinedHTML: 'outside',
            projection: 'EPSG:3857',
            coordinateFormat: function(coord) {return ol.coordinate.format(coord,'{x}, {y}',4);}
        }),
        new ol.control.ScaleLine(),
        new ol.control.Zoom(),
        new ol.control.ZoomSlider(),
        new ol.control.OverviewMap({collapsed: true})
    ];
            
    var coordonnees;
    maCarte.on('singleclick', function(evt){
	    coordonnees = evt.coordinate;
        var resolution = maCarte.getView().getResolution();
        var url = wms.getSource().getGetFeatureInfoUrl(evt.coordinate, resolution, 'EPSG:3857', {'INFO_FORMAT': 'text/plain'});
        maPopup.innerHTML= '<iframe seamless src="' + url + '"frameborder="0"></iframe>';
        monOverlay.setPosition(coordonnees);
	});
    function layerswitch(evt){mesCouches[evt.value].setVisible(evt.checked);}
    
    </script>
  </body>
</html>