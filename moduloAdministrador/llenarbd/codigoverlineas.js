var map;
var lineaactual;//Linea que se esta graficando actualmente
var tramoactual;//Tramo de la lineaactual que se esta graficando actualmente

//Variables para las animaciones del tramo
var offset;
var timer;

var idtramo;       //Vector // Id del iesimo tramo
var referencia;    //Vector // referencia iesimo tramo
var linea = [];    //Vector(Vector) linea[nrotramo][nropunto]

function initialize() {
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(-16.5, -68.15)
    };
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

    var selectlinea = document.getElementById("selectlinea");
    var selecttramos = document.getElementById("selecttramos");
    google.maps.event.addDomListener(selectlinea, 'change', actualizarMapa);
    //google.maps.event.addDomListener(selecttramos, 'change', actualizarTramo);
}

function actualizarTramo() {
    var selecttramos = document.getElementById("selecttramos");
    var tramo = selecttramos.selectedIndex;
    if (tramo >= 0 && linea[tramo])
        dibujarTramo(linea[tramo]);
}

function actualizarMapa(){
    var selectlinea = document.getElementById("selectlinea");
    var idlinea = selectlinea[selectlinea.selectedIndex].value;
    var parametros = {
        "idlinea" : idlinea
    };
    $.ajax({
        data: parametros,
        url: 'obtenertramosdelinea.php',
        type: 'post',
        success: obtenerTramosDeLinea
    });

}

function obtenerTramosDeLinea(respuesta) {
    if (!respuesta) return;

    /****************PARTE LOGICA******************/
    var resp = eval(respuesta);
    idtramo = [];
    referencia = [];
    for (var i = 0; i < resp.length; i++) {
        idtramo.push(resp[i]['idtramo']);
        referencia.push(resp[i]['referencia']);
    }
    linea = [];
    for (var i = 0; i < idtramo.length; i++) {
        var parametros = {
            "idtramo" : idtramo[i]
        };
        $.ajax({
            data: parametros,
            url: 'obtenerpuntosdetramo.php',
            type: 'post',
            async: false,//Super IMPORTANTE!!! SI NO, SE PUSHEA MAL
            success: function(respuesta2) {
                var puntos = eval(respuesta2);
                var latlngpuntos = [];
                for (var j = 0; j < puntos.length; j++)
                    latlngpuntos.push(new google.maps.LatLng(puntos[j][0], puntos[j][1]));
                linea.push(latlngpuntos);
            }
        });
    }


    /****************PARTE GRAFICA******************/
    var poligonodelalinea = [];
    for (var i = 0; i < linea.length; i++)
        for (var j = 0; j < linea[i].length; j++)
            poligonodelalinea.push(linea[i][j]);
    dibujarLinea(poligonodelalinea);


    var contenidotramos = "<select id='selecttramos' size="+referencia.length+" style='width: 100%' onchange='actualizarTramo()'>";
    for (var i = 0; i < referencia.length; i++) {
        contenidotramos += "<option>" + referencia[i] + "</option>"
    }
    contenidotramos += "</select>"
    document.getElementById("listadetramos").innerHTML = contenidotramos;

    document.getElementById("selecttramos").selectedIndex = 0;
    actualizarTramo();
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

        strokeColor: 'black',

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