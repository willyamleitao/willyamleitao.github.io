<?
  // Tratando os dados
$strGoogleMaps  = $objConfig->strGoogleMaps;
$vetGoogleMaps  = explode("#",$strGoogleMaps);
$numLatitude  = $vetGoogleMaps[0];
$numLongitude = $vetGoogleMaps[1];
$codZoom    = $vetGoogleMaps[2];
$mapType    = $vetGoogleMaps[3];
?>

<style>
  .embed-container { position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    max-width: 100%;
  } 
  .embed-container iframe, 
  .embed-container object, 
  .embed-container embed { position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>

<div id="side-container">
  <ul>
    <br clear="both" />
    <li class="dir-label">From:</li>
    <li><input id="from" type="text" value="jardim da penha"/></li>
  </ul>
  <div>
    <input onclick="Rota.tracaRota();" type=button value="Go!"/>
  </div>
  <div id="rota_container"></div>
</div>


<div id="map_canvas" class='embed-container'></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp&language=pt-BR"></script> 

<script>
  var Rota = {
    // Variaável com a posição inicial
    latOrigem: new google.maps.LatLng(115, 117),
    
    // HTML Nodes
    mapContainer: document.getElementById('map_canvas'),
    dirContainer: document.getElementById('rota_container'),
    from: document.getElementById('from'),

    // API Objects
    dirService: new google.maps.DirectionsService(),
    dirRenderer: new google.maps.DirectionsRenderer(),
    map: null,

    
    showDirections: function(dirResult, dirStatus) {
      if(Rota.from.value == '') {
        alert("Digite um endereço válido");
        return;
      }
      if (dirStatus != google.maps.DirectionsStatus.OK) {
        alert('Falha ao encontrar o endereço: ' + Rota.from.value);
        return;
      }

      // Show directions
      Rota.dirRenderer.setMap(Rota.map);
      Rota.dirRenderer.setPanel(Rota.dirContainer);
      Rota.dirRenderer.setDirections(dirResult);
    },

    tracaRota: function() {
      var fromStr = Rota.from.value;

      var dirRequest = {
        origin: fromStr,
        destination: Rota.latOrigem,
        travelMode: google.maps.DirectionsTravelMode.DRIVING,
        unitSystem: google.maps.DirectionsUnitSystem.METRIC,
        provideRouteAlternatives: true
      };
      Rota.dirService.route(dirRequest, Rota.showDirections);
    },

    init: function() {
      var latLng = Rota.latOrigem;
      Rota.map = new google.maps.Map(Rota.mapContainer, {
        zoom: 15,
        scrollwheel: false,
        scaleControl: false,
        draggable: false,
        center    : latLng,
        styles:[
        {
          "featureType": "landscape",
          "stylers": [
          {
            "hue": "#F600FF"
          },
          {
            "saturation": 0
          },
          {
            "lightness": 0
          },
          {
            "gamma": 1
          }
          ]
        },
        {
          "featureType": "road.highway",
          "stylers": [
          {
            "hue": "#DE00FF"
          },
          {
            "saturation": -4.6000000000000085
          },
          {
            "lightness": -1.4210854715202004e-14
          },
          {
            "gamma": 1
          }
          ]
        },
        {
          "featureType": "road.arterial",
          "stylers": [
          {
            "hue": "#FF009A"
          },
          {
            "saturation": 0
          },
          {
            "lightness": 0
          },
          {
            "gamma": 1
          }
          ]
        },
        {
          "featureType": "road.local",
          "stylers": [
          {
            "hue": "#FF0098"
          },
          {
            "saturation": 0
          },
          {
            "lightness": 0
          },
          {
            "gamma": 1
          }
          ]
        },
        {
          "featureType": "water",
          "stylers": [
          {
            "hue": "#EC00FF"
          },
          {
            "saturation": 72.4
          },
          {
            "lightness": 0
          },
          {
            "gamma": 1
          }
          ]
        },
        {
          "featureType": "poi",
          "stylers": [
          {
            "hue": "#7200FF"
          },
          {
            "saturation": 49
          },
          {
            "lightness": 0
          },
          {
            "gamma": 1
          }
          ]
        }
        ]
      });

      // Marcador
      marker = new google.maps.Marker({ 
        position: Rota.latOrigem, 
        map: Rota.map,
        animation: google.maps.Animation.DROP
      });
    }
  };

  // Onload handler to fire off the app.
  google.maps.event.addDomListener(window, 'load', Rota.init);

</script>