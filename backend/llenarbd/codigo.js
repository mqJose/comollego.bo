
var vector_markes=[];
var trazo=[];
var v_pol=[];
var map;
var directionsService = new google.maps.DirectionsService();
var rutaactual;
var valores;
var pos;
var poly_guardado=[];
var timer;
var marker_i;
var marker_f;
function initialize() {
    alert("alerta");
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(-16.5, -68.15)
    };
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
}
function placeMarker(e,pos, map,titulo) {
    if(e===1){
        if(marker_i)marker_i.setMap(null);
        marker_i = new google.maps.Marker({
            position: pos,
            map: map,
            title:titulo,
            draggable:false
        });
    }
    else{
        if(marker_f)marker_f.setMap(null);
        marker_f = new google.maps.Marker({
            position: pos,
            map: map,
            title:titulo,
            draggable:false
        });
    }
    //map.panTo(pos);//pociciona el  mapa sobre el marker   
}
function mueve_marke(x,y){
    if(y===trazo.length){
        clearInterval(timer);
        rutaactual.setMap(map);
        timer = setInterval(function() {
            //tiempo
        }, 100);
        clearInterval(timer);
        console.log("detenemos timer");
    }
    if(trazo[y]!='linea'){
         if(x>-1&&y<vector_markes.length){
            var pol=[];
            var request = {
                origin: vector_markes[x],
                destination: vector_markes[y],
                travelMode: google.maps.TravelMode.DRIVING
            };
             directionsService.route(request, function(response, status) {
                if(status == google.maps.DirectionsStatus.OK){
                    for(var j = 0; j < response.routes[0].overview_path.length; j++) 
                        pol.push(response.routes[0].overview_path[j]);
                    v_pol[x]=pol;
                    if (rutaactual)
                            rutaactual.setMap(null);
                    var pl=[];
                    for(var u = 0 ; u < v_pol.length ; u++){
                        for(var w=0 ; w < v_pol[u].length ; w++ )pl.push(v_pol[u][w]);
                    }
                    rutaactual = new google.maps.Polyline({ 
                        path: pl
                    });
                    console.log("*************");
                    console.log(vector_markes[y]);
                    console.log("------------");
                    console.log(pl[pl.length-1]);
                    
                    console.log("pasa "+y);
                    //clearInterval(timer);
                    rutaactual.setMap(map);
                    mueve_marke(x+1,y+1);
                    pasar_paradas_a_div();
                    poly_guardado[valores]=pl;
                }
            });
         }
    }
    else {
        v_pol[x]=[];
        v_pol[x].push( vector_markes[y]);
        
        if (rutaactual)
            rutaactual.setMap(null);
        var pl=[];
        for(var u = 0 ; u < v_pol.length ; u++){
            for(var w=0 ; w < v_pol[u].length ; w++ )
                pl.push(v_pol[u][w]);
        }
        rutaactual = new google.maps.Polyline({ 
            path: pl
        });
        timer = setInterval(function() {
            //tiempo
        }, 100);
        //clearInterval(timer);
        rutaactual.setMap(map);
        mueve_marke(x+1,y+1);
        pasar_paradas_a_div();
        poly_guardado[valores]=pl;
    }

}
function pasar_paradas_a_div()
{
    /************************pasamoslos datos a los  selectedmultiple para tiene**********/
    //console.log("Pasamos rutas a div");
}
function seleccionado(ele,p){
    valores = ele.options[ele.selectedIndex].value;
    if(poly_guardado[valores]){
        console.log("guardado");
        if (rutaactual)
            rutaactual.setMap(null);
        rutaactual = new google.maps.Polyline({ 
            path: poly_guardado[valores]
        });
        placeMarker(1,poly_guardado[valores][0],map,"INICIO");
        placeMarker(2,poly_guardado[valores][poly_guardado[valores].length-1],map,"FINAL");
        rutaactual.setMap(map);
    }
    else{
        vector_markes=[];
        trazo=[];
        v_pol=[];
        rutaactual;
        pos=0;
        for(var i=0;i<idtramo_tiene.length;i++){
            if(""+valores===idtramo_tiene[i]){
                for(var j=0;j<id.length;j++){
                    if(idparada[i]===id[j]){
                        trazo.push(trazo_t[i]);
                        vector_markes.push(puntos[j]);
                    }
                }
            }
        }
        placeMarker(1,vector_markes[0],map,"INICIO");
        placeMarker(2,vector_markes[vector_markes.length-1],map,"FINAL");
        mueve_marke(0,1);
    }
   
}

google.maps.event.addDomListener(window, 'load', initialize);