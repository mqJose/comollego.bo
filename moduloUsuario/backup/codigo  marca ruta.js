
var directionsService = new google.maps.DirectionsService();
var map;
var marker_inicio;
var marker_final;
var strictBounds;
var offset;
var polilyne=[];
var color =['red','yellow','blue','orange'];
var timer;
function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    strictBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-16.665980383551183, -68.32150823974615),
      new google.maps.LatLng(-16.437434498196055,-68.03036419677738 )
  );
    var mapOptions = {
        zoom: 14,
         minZoom :  12 ,//maxZoom :  16 ,
        center:new google.maps.LatLng((lat_i+lat_f)/2,  (lng_i+lng_f)/2)
    }
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
    //* para restringir    la busqueda  solo bolivia
    var opt = {
        bounds:strictBounds,
        componentRestrictions: {country: 'bol'}
    };
    placeMarker(marker_inicio,new google.maps.LatLng(lat_i, lng_i), map,"INICIO");
    placeMarker(marker_final,new google.maps.LatLng(lat_f, lng_f), map,"FINAL")
    map.panTo(new google.maps.LatLng(lat_i, lng_i));
    /****************restringimos el movimiento solo para  lapaz*****/
    google.maps.event.addListener(map,'dragend',function(){

        if(strictBounds.contains(map.getCenter()))return;
        var c = map.getCenter();
        var x = c.lng();
        var y = c.lat();
        var maxX = strictBounds.getNorthEast().lng();
        var maxY = strictBounds.getNorthEast().lat();
        var minX = strictBounds.getSouthWest().lng();
        var minY = strictBounds.getSouthWest().lat();
        if(x < minX) x = minX;
        if(x > maxX) x = maxX;
        if(y < minY) y = minY;
        if(y > maxY) y = maxY;
        map.setCenter(new google.maps.LatLng(y, x));
    });
    calcular_ruta();
    //directionsDisplay.setMap(map);
    //directionsDisplay.setPanel(document.getElementById('ruta'));

}
function placeMarker(e,pos, map,titulo) {
    e = new google.maps.Marker({
        position: pos,
        map: map,
        title:titulo,
        draggable:false
    });
    map.panTo(pos);//pociciona el  mapa sobre el marker   
}
function calcular_ruta(){
    for(var i=0;i<pl.length;i++){
        apie(i);
    }
}
function apie(i){
    
    pasos = new google.maps.Polyline({
      path: pl[i],
      geodesic: true,
      strokeOpacity: 0.0,
      strokeColor: 'blue',
      icons: [{
        icon: {
             
          path:google.maps.SymbolPath.CIRCLE,
          fillColor: 'red',
          fillOpacity:1,
          strokeOpacity: 1,
          strokeWeight: 1.5,
          scale: 3

        },
        repeat: '10px'
      }],
      map: map,
    });
    offset = 0;
    start();
}
function start() {
    timer = setInterval(function() {
        animacion();
    }, 50);
}
  function animacion() {
    if(offset== 9) 
      offset= 0;
     else 
      offset++;
    var icons = pasos.get('icons');
    icons[0].offset = offset + 'px';
    pasos.set('icons', icons); 
  }
google.maps.event.addDomListener(window, 'load', initialize);