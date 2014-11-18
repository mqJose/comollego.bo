var map;
var directionsService = new google.maps.DirectionsService();
var rutaactual;
var offset;
var marker_i;
var marker_f;
var tramo=0;
var rutatotal;
var polilyne_t=[];
var cod_tramos=[];
var marker_paradas=[];
var timer;
function initialize() {
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(-16.5, -68.15)
    };
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
}
function placeMarker(e,pos, map,titulo) {
    if(e===1){
        if(marker_i)
            marker_i.setMap(null);
        marker_i = new google.maps.Marker({
            position: pos,
            map: map,
            title:titulo,
            draggable:false
        });
        var popup = new google.maps.InfoWindow({
            content: "   Inicio   "
        });

        //popup.open(map,marker_i);

        map.panTo(pos);//pociciona el  mapa sobre el marker
    }
    else{
        if(marker_f)
            marker_f.setMap(null);
        marker_f = new google.maps.Marker({
            position: pos,
            map: map,
            title:titulo,
            draggable:false
        });
    }
}
function pasar_tramo_a_div()
{
    if(tramo>0 && tramo<=idtramo_tiene.length){
        console.log("adicionamos a la lista el tramo "+tramo);
        if(rutatotal)
            rutatotal.setMap(null);
        cod_tramos.push(""+tramo);
        for(var i=0;i<polilynes[tramo].length;i++)
            polilyne_t.push(polilynes[tramo][i]);
        rutatotal = new google.maps.Polyline({
            path: polilyne_t,
            strokeOpacity: 2.0,
            strokeColor: 'blue'
        });
        rutatotal.setMap(map);
        //en la variable c creamos la tabla q se mostrara 
        //  en la variable cc nos ayudara  a pasar los datos  la  base de datos
        var c="<i>lista de tramos que tendra la nueva ruta</i><b><table border =1px style='width: 100%;'>";
        c=c+"<tr><td><i>nro </i></td><td><i>tramo</i></td></tr>";
        for(var i=0;i<cod_tramos.length;i++){
            c=c+"<tr><td>"+(i+1)+"</td><td> Tramo "+cod_tramos[i]+"</td></tr>";

            //var selecttramo = document.getElementById("selecttramo");
            //c=c+"<tr><td>"+(i+1)+"</td><td>" + selecttramo.options[selecttramo.selectedIndex].innerHTML + "</td></tr>";
        }
        c=c+"</table>";
        c=c+"<select multiple  name ='cod_tramos[]' style='display:none'>";
        for(var i=0;i<cod_tramos.length;i++){
            c=c+"<option value='"+cod_tramos[i]+"'selected='true' >codparadas nuevas</option>";
        }
        c=c+"</select>";
        document.getElementById("panel_cod_tramos").innerHTML =c;
    }
    else alert("el tramo no fue seleccionado");
    tramo=-1;
    if (rutaactual)
        rutaactual.setMap(null);
}

function seleccionado(ele,p) {
    clearInterval(timer);
    var n = ele.options[ele.selectedIndex].value;

    for(var i=0;i<marker_paradas.length;i++)
        marker_paradas[i].setMap(null);
    marker_paradas=[];
    for(var i=0;i<paradas[n-1].length;i++){
        marker_paradas.push(
            new google.maps.Marker({
                position: paradas[n-1][i],
                map: map
            })
        );
        marker_paradas[i].setIcon('http://www.rubipamplona.com/img/marker.png');
    }


    tramo  = n;
    if (rutaactual)
        rutaactual.setMap(null);
    placeMarker(1,polilynes[n][0], map,"Inicio");
    placeMarker(2,polilynes[n][polilynes[n].length-1], map,"Final");
    rutaactual = new google.maps.Polyline({
        path: polilynes[n],
        //geodesic: true,
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
    rutaactual.setMap(map);
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
    var icons = rutaactual.get('icons');
    icons[0].offset = offset + 'px';
    rutaactual.set('icons', icons);
}
google.maps.event.addDomListener(window, 'load', initialize);