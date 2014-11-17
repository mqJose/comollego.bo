
var directionsService = new google.maps.DirectionsService();
var map;
var marker_inicio;
var marker_final;
var click;
var seleccionado;
var strictBounds;
var tipo_transporte = "PUBLICO";
function initialize() {
    console.log("no   sueño");
    directionsDisplay = new google.maps.DirectionsRenderer();
    strictBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-16.665980383551183, -68.32150823974615),
        new google.maps.LatLng(-16.437434498196055,-68.03036419677738 )
    );
    var mapOptions = {
        zoom: 14,
        minZoom :  12 ,//maxZoom :  16 ,
        center:new google.maps.LatLng(-16.5,  -68.15)
    }
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
    //* para restringir    la busqueda  solo bolivia
    var opt = {
        bounds:strictBounds,
        componentRestrictions: {country: 'bol'}
    };
    geocoder = new google.maps.Geocoder();
    //*****  auto completar  inicio
    var inicio = document.getElementById('inicio');
    var autocomplete = new google.maps.places.Autocomplete(inicio,opt);
    adicionar_autocomplete(autocomplete);
    //******   
    //*****  auto completar fin
    var fin = document.getElementById('final');
    var autocompletef = new google.maps.places.Autocomplete(fin,opt);
    adicionar_autocomplete(autocompletef)
    /****************  auto conpletar final ************/
    directionsDisplay.setPanel(document.getElementById('directions_panel'));
    google.maps.event.addListener(map, 'click', function(e) {
        click = 1;
        placeMarker(e.latLng, map);
        actualiza_div_oculto();
    });

    /****************restringimos el movimiento solo para  lapaz*****/
    google.maps.event.addListener(map,'dragend',function(){

        if(strictBounds.contains(map.getCenter()))return;
        var c = map.getCenter();
        var x = c.lng();
        var y = c.lat();
        console.log("**********************");
        console.log(x+"               "+y);
        var maxX = strictBounds.getNorthEast().lng();
        var maxY = strictBounds.getNorthEast().lat();
        var minX = strictBounds.getSouthWest().lng();
        var minY = strictBounds.getSouthWest().lat();
        if(x < minX) x = minX;
        if(x > maxX) x = maxX;
        if(y < minY) y = minY;
        if(y > maxY) y = maxY;
        console.log(x+"               "+y);
        map.setCenter(new google.maps.LatLng(y, x));
    });

}
function actualiza(){
    console.log("Actualiza");
}
function solo_lapaz(e){//placeMarker(e.latLng, map,e.latLng);
    if(strictBounds.contains(e))return true;
    else{
        alert("este lugar esta fuera de lapaz!!!!!!!!!!!!!!\ncomollebo.bo esta restringido solo para lapaz");
        if(seleccionado==0) document.getElementById("inicio").value="";
        else document.getElementById("final").value="";
        seleccionado=3;
        return false;
    }
}
function placeMarker(pos, map) {
    if(seleccionado===3)return;
    if(seleccionado===0){
        if(marker_inicio!=null)
            marker_inicio.setMap(null);
        marker_inicio = new google.maps.Marker({
                position: pos,
                map: map,
                title:"INICIO",
                draggable:true}
        );
        google.maps.event.addListener(marker_inicio, 'dragend',function(){
            map.panTo(pos);
            geocoder.geocode({'latLng': marker_inicio.getPosition(),'region': 'bol'}
                , function(results) {
                    while(results.length===0);
                    document.getElementById("inicio").value=(results[0].formatted_address);
                    actualiza_div_oculto();
                });
        });
        map.panTo(pos);//pociciona el  mapa sobre el marker
        geocoder.geocode({'latLng': pos,'region': 'bol'}
            , function(results) {
                if(click===1){
                    while(results.length===0);
                    document.getElementById("inicio").value=(results[0].formatted_address);
                    actualiza_div_oculto();
                    click=0;
                }
            });
    }
    else{
        if(marker_final!=null)
            marker_final.setMap(null);
        marker_final = new google.maps.Marker({
                position: pos,
                map: map,
                title:"FINAL",
                draggable:true}
        );
        google.maps.event.addListener(marker_final, 'dragend',function(){
            map.panTo(pos);
            geocoder.geocode({'latLng': marker_final.getPosition(),'region': 'bol'}
                , function(results) {
                    while(results.length===0);
                    document.getElementById("final").value=(results[0].formatted_address);
                    actualiza_div_oculto();
                });
        });
        map.panTo(pos);//pociciona el  mapa sobre el marker
        geocoder.geocode({'latLng': pos,'region': 'bol'}
            , function(results) {
                if(click===1){
                    while(results.length===0);
                    document.getElementById("final").value=(results[0].formatted_address);
                    actualiza_div_oculto();
                    click=0;
                }
            });
    }
    seleccionado=3;

}
function actualiza_div_oculto(){
    console.log("actualizamos div  asdf");
    console.log("tipo_transporte" + tipo_transporte);
    var cc = "</select>";
    cc+="<input type='text' name='tipo_transporte' value='" + tipo_transporte + "'>";
    if(marker_inicio){
        cc+="<select multiple  name ='inicio[]'>";
        cc+="<option value='"+marker_inicio.getPosition().lat()+"'selected='true' >latitud inicio</option>";
        cc+="<option value='"+marker_inicio.getPosition().lng()+"'selected='true' >longitud inicio</option>";
    }
    cc=cc+"</select>";
    if(marker_final){
        cc+="<select multiple  name ='final[]'>";
        cc+="<option value='"+marker_final.getPosition().lat()+"'selected='true' >longitud</option>";
        cc+="<option value='"+marker_final.getPosition().lng()+"'selected='true' >longitud</option>";
    }
    cc=cc+"</select>";
    cc+="<select multiple  name ='direccion[]'>";
    if(marker_inicio)
        cc+="<option value='"+ document.getElementById("inicio").value+"'selected='true' >"+document.getElementById("inicio").value+" inicio</option>";
    if(marker_final)
        cc+="<option value='"+ document.getElementById("final").value+"'selected='true' >"+document.getElementById("final").value+"</option>";
    cc=cc+"</select>";
    document.getElementById("oculto").innerHTML = cc;

}
function mm(i){
    seleccionado=i;
    if(i===0)document.getElementById("inicio").select();
    else document.getElementById("final").select();
}
function adicionar_autocomplete(autocomplete){
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        //console.log("respuesta  "+solo_lapaz(place.geometry.location));
        if(solo_lapaz(place.geometry.location)){
            if (!place.geometry)
                return;
            if (place.geometry.viewport)
                map.fitBounds(place.geometry.viewport);
            else {
                placeMarker(place.geometry.location,map);
                map.setCenter(place.geometry.location);
                map.setZoom(17);

            }
        }
        actualiza_div_oculto();
        b=0;

    });
}
google.maps.event.addDomListener(window, 'load', initialize);