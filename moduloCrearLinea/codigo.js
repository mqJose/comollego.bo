var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var puntos = [];
function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var LaPaz= new google.maps.LatLng(-16.50524499495991, -68.1295895576477);
    var mapOptions = {
        zoom: 17,
        center: LaPaz
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    google.maps.event.addListener(map, 'click', function (event) {
        adicionarMarca(event.latLng);
    });
    directionsDisplay.setMap(map);
}
function adicionarMarca(posicion){
    /*var marca = new google.maps.Marker({
        position: posicion,
        map: map,
        draggable: true
    });*/
    puntos.push(posicion);
    if (puntos.length >= 2)
        dibujarRuta();
}

function dibujarRuta() {
    llenarTabla();
    var n = puntos.length;
    var start = puntos[0];
    var end = puntos[n - 1];
    //console.log("start : " + start);
    //console.log("end : " + end);


    var waypts = [];
    /*
    var checkboxArray = document.getElementById('waypoints');
    for (var i = 0; i < checkboxArray.length; i++) {
        if (checkboxArray.options[i].selected == true) {
            waypts.push({
                location:checkboxArray[i].value,
                stopover:true});
        }
    }*/
    for (var i = 0; i < n; i++)
        waypts.push({
            location: puntos[i]
            //, stopover: true
        });

    var request = {
        origin: start,
        destination: end,
        waypoints: waypts,
          //optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.WALKING
    };
    directionsService.route(request, function(response, status) {
        console.log("respuesta : " + status);
        if (status == google.maps.DirectionsStatus.OK) {

            directionsDisplay.setDirections(response);
           /* var route = response.routes[0];

            var summaryPanel = document.getElementById('directions_panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
                var routeSegment = i + 1;
                summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
                summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }*/
        }
    });

}
function llenarTabla() {
    var listapuntos = document.getElementById("cajapuntos");
    var contenido = "<select multiple size='30'>";

    for (var i = 0; i < puntos.length; i++) {
        contenido += "<option>"+puntos[i].toString()+"</option>"
    }
    contenido += "</select>";
    listapuntos.innerHTML = contenido;
}
google.maps.event.addDomListener(window, 'load', initialize);