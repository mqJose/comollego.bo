
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
    };

    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

    //* para restringir    la busqueda  solo bolivia
    var opt = {
        bounds:strictBounds,
        componentRestrictions: {country: 'bol'}
    };
    placeMarker(marker_inicio,new google.maps.LatLng(lat_i, lng_i), map,"INICIO");
    placeMarker(marker_final,new google.maps.LatLng(lat_f, lng_f), map,"FINAL");
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

function calcular_ruta(){
    if(transporte==='PUBLICO'){
        var parametros = {
            "latitudini" : lat_i,
            "longitudini": lng_i,
            "latitudfin" : lat_f,
            "longitudfin": lng_f
        };
        $.ajax({
            data: parametros,
            url: 'procesarconsulta.php',
            type: 'post',
            async: false,//Super IMPORTANTE!!! SI NO, SE PUSHEA MAL
            success: porTransportePublico
        });
    }
    else{
        var travel;
        if(transporte==='WALKING')travel=google.maps.TravelMode.WALKING;
        else travel=google.maps.TravelMode.DRIVING;
        var start = new google.maps.LatLng(lat_i, lng_i);
        var end = new google.maps.LatLng(lat_f, lng_f);
        var request = {
            origin: start,
            destination: end,
            travelMode: travel
        };
        directionsService.route(request, function(response, status) {
            var route;
            if (status == google.maps.DirectionsStatus.OK)
            //directionsDisplay.setDirections(response);//  en esta parte  colocamos a  el panel la linea  y los pasos
                route = response.routes[0];
            var c = "";
            for (var i = 0; i < route.legs.length; i++) {
                if (transporte === 'WALKING')
                    c += "<i>Las rutas a pie están en versión beta. Ten cuidado. – En esta<br>ruta puede que no haya aceras o pasos para peatones.</i><br>";

                c = c + "<label>Distancia(Aprox.):</label>" + route.legs[i].distance.text;
                c += "<br>";
                c = c + "<label>Tiempo(Aprox.):</label>" + route.legs[i].duration.text;

                c=c+"<select  size='"+route.legs[i].steps.length+"'  style='width: 100%;float: left;' onChange='seleccionado(this)''>";


                for(var pp=0;pp<route.legs[i].steps.length;pp++){
                    pasos_i.push(route.legs[i].steps[pp]);
                    c=c+"<option value='"+pp+"' >"+(pp+1)+"  .-   "+route.legs[i].steps[pp].instructions+"</option>";
                }
                c=c+"</select>";
                document.getElementById("ruta").innerHTML=c;
            }
            for(var j = 0; j < response.routes[0].overview_path.length; j++){
                polilyne.push(response.routes[0].overview_path[j]);
            }
            //en esta parte tenemos que  ver  que a  pie o a en auto
            dibujarAnimacion();
            //document.getElementById("div1").innerHTML="<INPUT type='button' onclick='selecciona_paso(0)' value='PASOS de  INICIO hasta FINAL'style='width: 100%;float: left;'>";
        });
    }
}
var alternativas = [];
var referenciatramo = [];
var tramo = [];
var lineaspasanportramo = [];
function porTransportePublico(respuesta) {

    alternativas = eval(respuesta);
    tramo = [];
    referenciatramo = [];

    /*llenamos el contenido en pantalla*/
    var cad = "";

    if (alternativas.length > 0) {
        cad = "Se encontraron " + alternativas.length + " posibles rutas:";
        cad += "<select id='selectalternativas' style='width: 100%' onchange='actualizarAlternativa()'>";
        for (var i = 0; i < alternativas.length; i++)
            cad += "<option value = " + i + "> Opcion " + (i + 1) + "</option>";
        cad += "</select>";
        document.getElementById("ruta").innerHTML = cad;
        actualizarAlternativa();
    } else {
        cad = "No se encontraron resultados tendra que usar un TAXI";
        document.getElementById("ruta").innerHTML = cad;
    }

}

var lineasquepasanportramo = [];

function actualizarAlternativa() {
    if (!alternativas.length)return;
    var alternativaseleccionada = document.getElementById("selectalternativas").selectedIndex;
    if (alternativaseleccionada < 0 || alternativaseleccionada >= alternativas.length) alternativaseleccionada = 0;
    var tienetramos = alternativas[alternativaseleccionada];

    if (tramoactual)
        tramoactual.setMap(null);
    if (timer)
        clearInterval(timer);


    poligono = [];
    for (var i = 0; i < tienetramos.length; i++) {
        var tt = tienetramos[i];
        if (!tramo[tt]) {
            console.log("Se va a pedir tramo: " + tt);
            var parametros = {
                "idtramo" : tt
            };
            $.ajax({
                data: parametros,
                url: 'obtenerinformaciondetramo.php',
                dataType: 'json',
                type: 'post',
                async: false,//Desactivar asincrono, Super IMPORTANTE!!! SI NO salen errores incontrolables
                success: function (resp) {
                    tramo[tt] = resp['puntos'];
                    referenciatramo[tt] = resp['referencia'];
                    lineaspasanportramo[tt] = resp['lineas'];
                    //console.log("lineas que pasan por el tramo "+ tt + " son : " + lineaspasanportramo[tt].toString());
                },
                error: function(){
                    alert("ERROR al obtener informacion de tramo");
                }
            });
        }
        if (tramo[tt]) {
            var puntos = tramo[tt];
            for (var j = 0; j < puntos.length; j++) {
                poligono.push(new google.maps.LatLng(puntos[j][0], puntos[j][1]));
            }
        }
    }

    var detalles = "<select class='form-control' id = 'selecttramo' size="+tienetramos.length+" onchange = 'dibujarTramo();'>";
    lineasquepasanportramo = [];

    for (var i = 0; i < tienetramos.length; i++) {
        detalles += "<option  value = " + tienetramos[i] + ">" +(i+1)+" .- "+ referenciatramo[tienetramos[i]] +"</option>";
        console.log("LINEAS DEL TRAMO : " + lineaspasanportramo[tienetramos[i]]);
        lineasquepasanportramo.push(lineaspasanportramo[tienetramos[i]]);
    }
    detalles += "<option  value = " + tienetramos[tienetramos.length - 1] + "></option>";


    detalles += "</select>";
    document.getElementById("detallesdelaruta").innerHTML = detalles;

    dibujarLinea(poligono);
}

var lineaactual;
var tramoactual;
function dibujarTramo() {
    var selecttramo = document.getElementById("selecttramo");
    var tramoseleccionado = selecttramo[selecttramo.selectedIndex].value;
    var puntos = tramo[tramoseleccionado];
    poligono = [];
    for (var i = 0; i < puntos.length; i++) {
        poligono.push(new google.maps.LatLng(puntos[i][0], puntos[i][1]));
    }

    trazarTramo(poligono);
    document.getElementById("lieneasdisponibles").innerHTML = lineasquepasanportramo[selecttramo.selectedIndex];


}

function dibujarLinea(poligono) {
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


function trazarTramo(poligono) {

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
    start2();
    if (poligono && poligono.length > 0)
        map.panTo(poligono[0]);
    //tramoactual.setMap(map);
}
var timer;
function start2() {
    timer = setInterval(function() {
        animacion2();
    }, 50);
}
function animacion2() {
    if(offset== 9)
        offset= 0;
    else
        offset++;
    var icons = tramoactual.get('icons');
    icons[0].offset = offset + 'px';
    tramoactual.set('icons', icons);
}



function dibujarAnimacion(){

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
        map: map
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
function tramos_seleccionados(ele){
    //en esta parte creamos el div para pasar los tramos para mostrarlos en muestra marca_ruta .php
    var valores = ele.options[ele.selectedIndex].value;//valores  nos da el que es seleccionado
    var c="<select multiple  name ='inicio[]' style='display:none'>";//style='display:none'
    c=c+"<option value='"+lat_i+"' selected='true' >inicio</option>";
    c=c+"<option value='"+lng_i+"' selected='true' >inicio</option>";
    c=c+"</select>";
    document.getElementById("posicion_i").innerHTML=c;
    var c="<select multiple  name ='final[]' style='display:none'>";//style='display:none'
    c=c+"<option value='"+lat_f+"' selected='true' >final</option>";
    c=c+"<option value='"+lng_f+"' selected='true' >final</option>";
    c=c+"</select>";
    document.getElementById("posicion_f").innerHTML=c;
    //ahora pasamos las direcciones
    c="<select multiple  name ='direccion[]' style='display:none'>";
    c=c+"<option value='"+direccion_i+"' selected='true' >direccion inicio</option>";
    c=c+"<option value='"+direccion_f+"' selected='true' >direccion final</option>";
    c=c+"</select>";
    document.getElementById("direccion").innerHTML=c;
    //ahora pasamos los tramos por la cual pasa el camino
    c="<select multiple  name ='camino[]' style='display:none'>";
    for(var i=0;i<v[valores].length;i++)
        c=c+"<option value='"+v[valores][i]+"' selected='true' >"+v[valores][i]+"</option>";
    c=c+"</select>";
    document.getElementById("camino").innerHTML=c;
    document.forms.formulario1.submit();
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
        title:"PASO INTERMEDIO",
        animation: google.maps.Animation.BOUNCE
    });
    var popup = new google.maps.InfoWindow({
        content: pasos_i[valores].instructions,
    });

    popup.open(map, marker_saltarin);
    map.panTo(pasos_i[valores].start_location);
}

google.maps.event.addDomListener(window, 'load', initialize);