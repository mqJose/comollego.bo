var map;
var tramoactual;
var offset;
var timer;

var lineaactual;
function initialize() {
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(-16.5, -68.15)
    };
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

    var selectlinea = document.getElementById("selectlinea");
    google.maps.event.addDomListener(selectlinea, 'change', actualizarMapa);
}
function actualizarMapa(){
    var selectlinea = document.getElementById("selectlinea");
    var idlinea = selectlinea[selectlinea.selectedIndex].value;
    var parametros = {
        "idtramo" : idlinea
    };
    $.ajax({
        data: parametros,
        url: 'coordenadastramo.php',
        type: 'post',
        success: function(respuesta) {
            if (!respuesta) return;
            var puntos = eval(respuesta);
            var poligono = [];
            for (var i = 0; i < puntos.length; i++) {
                poligono[i] = new google.maps.LatLng(puntos[i][0], puntos[i][1]);
            }
            dibujarLinea(poligono);
        }
    });
}
function dibujarLinea(poligono){
    if (lineaactual)
        lineaactual.setMap(null);
    lineaactual = new google.maps.Polyline({
        path: poligono,
        strokeColor: 'blue',
        strokeOpacity: 0.6,
        strokeWeight: 7.0,
        map: map
    });
}


function dibujarTramo(poligono) {
    clearInterval(timer);

    if (tramoactual) // Si existe el poligono actual
        tramoactual.setMap(null);

    tramoactual = new google.maps.Polyline({
        path: poligono,
        strokeOpacity: 0.0,

        strokeColor: 'red',

        icons: [{
            icon: {
                path: 'M -1,1 0,0 1,1',
                strokeOpacity: 1,
                strokeWeight: 1.5,
                scale: 6
            },
            repeat: '10px'
        }],

        map: map
    });
    offset = 0;
    start();
    //tramoactual.setMap(map);
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
    var icons = tramoactual.get('icons');
    icons[0].offset = offset + 'px';
    tramoactual.set('icons', icons);
}
google.maps.event.addDomListener(window, 'load', initialize);

//EOF :D