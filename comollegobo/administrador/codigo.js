var directionsService = new google.maps.DirectionsService();
var nro_id;

var nueva_ruta=[];
var nuevos_id=[];

var vector_markes=[];
function initialize() {
    var mapOptions = {
        zoom: 14,
        center: puntos[0]
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    marcamos_paradas(puntos,id);


    nro_id = puntos.length + 1;
    google.maps.event.addListener(map, 'click', function(e) {
        var marcador = new google.maps.Marker({
            position: e.latLng,
            map: map,
            title: "" + nro_id,
            draggable:true
        });

        nro_id++;

        google.maps.event.addListener(marcador, 'click', function()
        {
            alert(marcador.title);
        });

        vector_markes.push(marcador);
        trasamos_rutas_de_markes();
        google.maps.event.addListener(marcador, 'dragend', trasamos_rutas_de_markes);

    });
}
function minimo(a, b){ if (a < b) return a; return b;}
var rutaactual;
function trasamos_rutas_de_markes()
{
    if (vector_markes.length >= 2) {
        var pol = [];

        //console.log("Tamaño : " + vector_markes.length);
        var rutaprocesada = false;
        var i = 0;
        while (true) {
            var ini = i;
            var fin = minimo(ini + 9, vector_markes.length - 1);

            //console.log(ini + " - " + fin);
            var start = vector_markes[ini].getPosition();
            var end = vector_markes[fin].getPosition();

            var waypts = [];
            for (var k = ini + 1; k <= (fin - 1); k++) {
                waypts.push({
                    location: vector_markes[k].getPosition()
                });
                //console.log(" - " + k + " - ");
            }
            var request;
            if (waypts.length > 0) {
                request = {
                    origin: start,
                    destination: end,
                    waypoints: waypts,
                    //optimizeWaypoints: true,//No poner por que modifica el orden de los waypoints
                    travelMode: google.maps.TravelMode.DRIVING
                };
            } else {
                request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING
                };
            }

            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    for (var j = 0; j < response.routes[0].overview_path.length; j++) {
                        pol.push(response.routes[0].overview_path[j]);
                    }
                    if (fin == (vector_markes.length - 1))
                        rutaprocesada = true; // Aqui marcamos que ya termino de procesar todos los puntos
                }
            });

            if (fin == (vector_markes.length - 1)) {
                break;
            }
            i = fin;
        }

        //ahora dibujamos el polyline
        function dibujarPolyline() {
            if (rutaprocesada) {
                if (rutaactual)
                    rutaactual.setMap(null);
                rutaactual = new google.maps.Polyline({
                    path: pol
                });
                rutaactual.setMap(map);
                // console.log("tamaño del POL que se dibujo : " + pol.length);
            } else {
                setTimeout(dibujarPolyline, 200);
            }
        }

        dibujarPolyline();
    }
}

function marcamos_paradas(a,b) {
    for(var i=0;i<a.length;i++) {
        placeMarker(a[i], map, b[i]);
    }
}
function placeMarker(pos, map, x) {
    var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title:x,
        draggable:true
    });
    google.maps.event.addListener(marker, 'click', function() {
        //Aqui debemos adicionar a la lista
        //alert(x);
        vector_markes.push(marker);
        trasamos_rutas_de_markes();

    });
}
google.maps.event.addDomListener(window, 'load', initialize);