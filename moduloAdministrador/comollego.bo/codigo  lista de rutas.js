
var directionsService = new google.maps.DirectionsService();
var map;
var marker_inicio;
var marker_final;
var strictBounds;
var pasos_i=[];
var marker_saltarin;
var offset;
var polilyne=[];
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
function placeMarker_prueva(e,pos, map,titulo) {
    e = new google.maps.Marker({
        position: pos,
        map: map,
        title:titulo,
        draggable:false
    });
    e.setIcon('http://www.rubipamplona.com/img/marker.png');
    map.panTo(pos);//pociciona el  mapa sobre el marker   
}
function marcamos_paradas_sercanas(){
    console.log("cantida de puntos sercanos a inicio= "+p_sercanas_i.length);
    for(var i=0;i<p_sercanas_i.length;i++){
         var m;
        placeMarker_prueva(m,p_sercanas_i[i],map,id_i[i]);
    }
    console.log("cantida de puntos sercanos a final= "+p_sercanas_f.length);
    for(var i=0;i<p_sercanas_f.length;i++){
         var m;
        placeMarker_prueva(m,p_sercanas_f[i],map,id_f[i]);
    }
}
function calcular_ruta(){
    if(transporte==='PUBLICO'){
        console.log("publicooooooooooooooo");
        marcamos_paradas_sercanas();
    }
    else{
        var travel;
        if(transporte==='WALKING')travel=google.maps.TravelMode.WALKING;
        else travel=google.maps.TravelMode.DRIVING;
        var start = new google.maps.LatLng(lat_i, lng_i);
        var end = new google.maps.LatLng(lat_f, lng_f);
        var request = {
            origin: start,
            destination: end
            ,travelMode: travel
        };
        directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK)
            //directionsDisplay.setDirections(response);//  en esta parte  colocamos a  el panel la linea  y los pasos
            var route = response.routes[0];
            var c="";
            for (var i = 0; i < route.legs.length; i++) {
                if(transporte==='WALKING')c+="<i>Las rutas a pie están en versión beta. Ten cuidado. – En esta<br>ruta puede que no haya aceras o pasos para peatones.</i><br>";
                c+="<br>***********************************************************************************<br>";
                c=c+"********"+route.legs[i].distance.text+"- aproximadamente "+route.legs[i].duration.text+"********";
                c+="<br>********************PASOS*********************************************<br>";
                c=c+"<select  size='"+route.legs[i].steps.length+"'  style='width: 100%;float: left;' onChange='seleccionado(this)''>";
                for(var pp=0;pp<route.legs[i].steps.length;pp++){
                    pasos_i.push(route.legs[i].steps[pp]);
                    //console.log(route.legs[i].steps[pp]);
                    //console.log("-------------");
                    //console.log(route.legs[i].steps[pp].start_location);
                    //console.log("**************\n");
                    c=c+"<option value='"+pp+"' >"+(pp+1)+"  .-   "+route.legs[i].steps[pp].instructions+"</option>";
                }
                c=c+"</select>";
                document.getElementById("div1").innerHTML=c;
            }
            /////ahora creamos el poliline
            for(var j = 0; j < response.routes[0].overview_path.length; j++){ 
                polilyne.push(response.routes[0].overview_path[j]);
                
            }
            //en esta parte tenemos que  ver  que a  pie o a en auto
            apie();
            //document.getElementById("div1").innerHTML="<INPUT type='button' onclick='selecciona_paso(0)' value='PASOS de  INICIO hasta FINAL'style='width: 100%;float: left;'>";
        });
    }
}
function apie(){
    console.log(polilyne.length),
    pasos = new google.maps.Polyline({
      path: polilyne,
      geodesic: true,
      strokeOpacity: 0.0,
      strokeColor: 'red',
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
function seleccionado(ele){
    var valores = ele.options[ele.selectedIndex].value;
    console.log(pasos_i[valores]);

    console.log(valores);
    if(marker_saltarin)
        marker_saltarin.setMap(null);
    marker_saltarin  = new google.maps.Marker({
        position: pasos_i[valores].start_location,
        map: map,
        title:"prueva",
         animation:google.maps.Animation.BOUNCE
    });
    var popup = new google.maps.InfoWindow({
        content: pasos_i[valores].instructions
    });

    popup.open(map,marker_saltarin);
     map.panTo(pasos_i[valores].start_location);
}
function crear_marke_saltarin(){

}
google.maps.event.addDomListener(window, 'load', initialize);