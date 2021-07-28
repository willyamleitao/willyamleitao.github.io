<?
	// Tratando os dados
	$strGoogleMaps	= $objConfig->strGoogleMaps;
	$vetGoogleMaps 	= explode("#",$strGoogleMaps);
	$numLatitude	= $vetGoogleMaps[0];
	$numLongitude	= $vetGoogleMaps[1];
	$codZoom		= $vetGoogleMaps[2];
	$mapType		= $vetGoogleMaps[3];
?>

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
<div id="map_canvas"></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp&language=pt-BR"></script> 

<script>
    var Rota = {
    // Variaável com a posição inicial
    latOrigem: new google.maps.LatLng(<?=$numLatitude?>, <?=$numLongitude?>),
    
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
        zoom      : <?=$codZoom?>,
        mapTypeId : '<?=$mapType?>',
        center    : latLng,
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