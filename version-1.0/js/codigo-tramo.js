var directionsService = new google.maps.DirectionsService();
var nro_id;
///  YA TENEMOS  PUNTO =[] DIONDE  SE SACA  LOS PUNTOS DE PARADAS DE LA BD
//   YA TENERMOS  ID=[]    DONDE SE SACA LOS ID DE LAS PARADAS  QUE ESTAN EN PUNTOS
var nueva_ruta=[];
var nuevos_id=[];
var vector_markes=[];//todos los markes q  se encuentran en  el mapa
var tiempo=[];// para  manejar los tiempos de una aparada  hasta  la siguente
var rutaactual; //esta variable es para  trabajar  con el poliline
var v_pol=[];// tratamos de  crear una vector  de polilines que tiene la polilinea entre dos paradas
var trazo=[];//el trazo generalmente se  el tipo recorido que tendra desde la parada actual hasta la parada anteriro  si es linea  o generado de  una ruta de google 
function initialize() {
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(-16.5, -68.15)
    };
    map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
    marcamos_paradas(paradas,id);//  en este  lugar se marcan las   paradas  de la base de datos
    nro_id = paradas.length + 1;
    google.maps.event.addListener(map, 'click', function(e) {
        placeMarker(e.latLng,map,(""+nro_id),true);//   true  dise que    creara  una nueva parada 
        nro_id++;
        trasamos_rutas_de_markes();
    });
    if(vector_markes.length!=0)
        pasar_paradas_a_div();
    //alert("se le aconseja primero llenar los dados de nombre \n tipo de trasporte y sindicato para adicionar las paradazzzz");
}
function marcamos_paradas(a,b) {
    var marker;
    for(var i=0;i<a.length;i++) {
        placeMarker(a[i], map, b[i],false);//  false dise que   solo pintara una parada de la base de datos
    }
}
function marker_prueva(pos){
    var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title:"prueva",
        draggable:true,
        animation:google.maps.Animation.drop
    });
    marker.setIcon('http://www.rubipamplona.com/img/marker.png');
}
function placeMarker(pos, map, x,f) {
    var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title:x,
        draggable:f,
        animation:google.maps.Animation.drop
    });
    if(f)
        marker.setIcon('https://maps.gstatic.com/intl/es_ALL/mapfiles/ms/micons/cabs.png');
    else
        marker.setIcon('http://www.rubipamplona.com/img/marker.png');

    google.maps.event.addListener(marker, 'click', function() {
        //Aqui debemos adicionar a la lista
        if(!f){
            if(confirm("desea adicionar  la parada de  la base de datos \n a su ruta?????\n aceptar = SI\n cancelar = NO")){
                adicionar(marker);
                click_derecho(marker);
            }
        }
        trasamos_rutas_de_markes();

    });
    if(f){
        adicionar(marker);
        /*************************draged es cuando se arrastra el marke   en el mapa*/
        google.maps.event.addListener(marker, 'dragend',function()
        {
            if(vector_markes.length !=1)
            {
                var p=0;
                for(var i = 0 ; i < vector_markes.length ; i++ )
                    if(marker.title===vector_markes[i].title)p=i;
                mueve_marke(p-1,p);
                mueve_marke(p,p+1);
            }
        });
        /**************************fin de draged    ***********/
        /*************************adicionamos acciona  clic derecho del maus*************/
        click_derecho(marker);
        /*************************fi de accion clic derecho del maus********************/
    }
}
function actualiza()
{
    for(var i = 1 ;i < vector_markes.length ; i++ )
        mueve_marke(i-1,i);
}
function mueve_marke(x,y){
    if(trazo[y]!='linea'){
        if(x>-1&&y<vector_markes.length){
            var pol=[];
            var request = {origin: vector_markes[x].getPosition(),destination: vector_markes[y].getPosition(),travelMode: google.maps.TravelMode.DRIVING};
            directionsService.route(request, function(response, status) {
                if(status == google.maps.DirectionsStatus.OK){
                    tiempo[x+1]=response.routes[0].legs[0].duration.value;
                    for(var j = 0; j < response.routes[0].overview_path.length; j++)
                        pol.push(response.routes[0].overview_path[j]);
                    v_pol[x]=pol;
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
                    rutaactual.setMap(map);
                    pasar_paradas_a_div();
                }
            });
        }
    }
    else {//  en esta parte cambiamos  si es teleferico
        v_pol[x]=[];
        v_pol[x].push( vector_markes[x].getPosition());
        v_pol[x].push( vector_markes[y].getPosition());
        if(y>0)tiempo[x+1]=google.maps.geometry.spherical.computeDistanceBetween(vector_markes[x].getPosition(),vector_markes[y].getPosition())*0.25;
        if (rutaactual)
            rutaactual.setMap(null);
        var pl=[];
        for(var u = 0 ; u < v_pol.length ; u++){
            for(var w=0 ; w < v_pol[u].length ; w++ )pl.push(v_pol[u][w]);
        }
        rutaactual = new google.maps.Polyline({
            path: pl
        });
        rutaactual.setMap(map);
        pasar_paradas_a_div();
    }
}
function adicionar(a)
{
    var b=true;
    for(var i=0;i<vector_markes.length;i++)
        if(vector_markes[i]===a)b=false;

    if(b)
        vector_markes.push(a);

    else {
        if(confirm("la parada ya esta dicionada en su ruta desea adicionarlo otra ves a   su  ruta ????\n se le aconseja no repetir  paradas"))
            vector_markes.push(a);
    }
}
function click_derecho(marker){
    /*************************adicionamos acciona  clic derecho del maus*************/
    google.maps.event.addListener(marker, "rightclick", function() {
        //en esta parte tenemos     que   modificar el  tipo de trazo o si se eliminara el marker
        if(confirm("menu de marcador  " + marker.title +"?  \n   aceptar = cambiar trazo   \n cancelar = eliminar marcador")){
            var t;
            if (confirm("desea cambiar  el trazo del marcador " + marker.title +" con respecto de al anterior \n markador  aceptar = ruta de google\n cancelar = linea recta"))
                t="ruta";
            else
                t="linea";
            if(vector_markes.length !=1){
                var p=0;
                for(var i = 0 ; i < vector_markes.length ; i++ )
                    if(marker.title===vector_markes[i].title)p=i;
                trazo[p]=t;
                if(p-1>-1)
                    mueve_marke(p-1,p);
                else
                    pasar_paradas_a_div();
            }
        }
        else {
            alert("La funcion  eliminar no se creo todavia");
        }
    });
    /*************************fi de accion clic derecho del maus********************/
}
function pasar_paradas_a_div()
{

    var cc="<select multiple  name ='idpuntos[]' style='display:none'>";
    var lt="<select multiple  name ='lat_p[]' style='display:none'>";
    var ln="<select multiple  name ='lng_p[]' style='display:none'>";
    var cod_parada="<select multiple  name ='cod_parada[]' style='display:none'>";
    var pl=[];
    var nr_pt = nropuntos;
    var orden=0;
    for(var u = 0 ; u < v_pol.length ; u++) {
        for(var w=0 ; w < v_pol[u].length ; w++ ){
            pl.push(v_pol[u][w]);
            cc=cc+"<option value='"+nr_pt+"'selected='true' >IDpunto</option>";
            lt=lt+"<option value='"+v_pol[u][w].lat()+"'selected='true' >latitud punto</option>";
            ln=ln+"<option value='"+v_pol[u][w].lng()+"'selected='true' >longitud punto</option>";
            cod_parada=cod_parada+"<option value='"+vector_markes[u+1].title+"'selected='true' >longitud punto</option>";
            //console.log("tiene "+nr_pt +"  "+idtramo+" "+vector_markes[u+1].title+"  "+orden);
            //console.log("puntos "+nr_pt+"   "+v_pol[u][w].lat()+"    "+v_pol[u][w].lng());
            //console.log("--------------------------------------------------------------------------");
            //orden++;
            nr_pt++;
            //marker_prueva(v_pol[u][w]);
        }
    }
    cod_parada=cod_parada+"</select>";
    lt=lt+"</select>";
    ln=ln+"</select>";
    cc=cc+"</select>";
    cc=cc+lt+ln+cod_parada;
    /************************pasamos la tabla formado_por ********************************/

    /************************pasamoslos datos a los  selectedmultiple para tiene**********/
    cc=cc + "<select multiple  name ='idparada[]' style='display:none'>"; // AQUI MODIFIQUE
    var tt=0;
    for(var i=0;i<vector_markes.length;i++){
        cc=cc+"<option value='"+vector_markes[i].title+"'selected='true' >IDPARADA</option>";
    }
    cc=cc+"</select>";
    cc+="<select multiple  name ='tiempo[]' style='display:none'>";
    for(var i=0;i<vector_markes.length;i++){
        tt=tt+tiempo[i];
        cc=cc+"<option value='"+(tt/60)+"'selected='true' >TIEMPO</option>";
    }
    cc=cc+"</select>";
    /**********************************PASAMOS TRAZO**************************************/
    cc+="<select multiple  name ='trazo[]' style='display:none'>";
    for(var i=0;i<vector_markes.length;i++){
        cc=cc+"<option value='"+trazo[i]+"'selected='true' >trazo</option>";
    }
    cc=cc+"</select>";

    /***********************hasta aqui terminamos de pasar los datos de tiene*************/
    /***********************adicionamos  latitud y longitud de  una  parada***************/
    cc+="<select multiple name ='latitud[]' style='display:none'>";
    for(var i=0;i<vector_markes.length;i++){
        tt=tt+tiempo[i];
        //console.log(vector_markes[i]);
        if(vector_markes[i].draggable)cc=cc+"<option value='"+vector_markes[i].getPosition().lat()+"'selected='true' >latitud</option>";
    }
    cc=cc+"</select>";
    cc+="<select multiple name='longitud[]' style='display:none'>";
    for(var i=0;i<vector_markes.length;i++){
        tt=tt+tiempo[i];
        if(vector_markes[i].draggable)cc=cc+"<option value='"+vector_markes[i].getPosition().lng()+"'selected='true' >longitud</option>";
    }
    cc=cc+"</select>";
    cc+="<select multiple name='cod_paradas_nuevas[]'>";
    for(var i=0;i<vector_markes.length;i++){
        if(vector_markes[i].draggable)cc=cc+"<option value='"+vector_markes[i].title+"'selected='true' >codparadas nuevas</option>";
    }
    cc=cc+"</select>";
    /**************************terminamos de adicionar las latitudes y longitudes***************/
    cc+="<h5>Tiempo de Tramo: "+(tt/60)+"</h5>";
    cc+="<h5>#Paradas: "+vector_markes.length+"</h5>";
    cc+="<table class='table table-striped table-hover'><thead>";
    cc=cc+"<tr><th>#</th><th>Minutos</th><th>Trazo</th></tr></thead><tbody>";
    var t=0;
    for(var i=0;i<vector_markes.length;i++){
        t=t+tiempo[i];
        cc=cc+"<tr><td>"+vector_markes[i].title+"</td><td>"+(t/60)+"</td><td>"+trazo[i]+"</td></tr>";
    }
    cc=cc+"</tbody></table>";
    document.getElementById("panel_de_paradas").innerHTML =cc;
}

function trasamos_rutas_de_markes()
{   trazo.push("ruta");
    tiempo.push(0);
    if(vector_markes.length != 1)
        mueve_marke(vector_markes.length-2,vector_markes.length-1);
    else  {
        pasar_paradas_a_div();
    }
}

google.maps.event.addDomListener(window, 'load', initialize);
