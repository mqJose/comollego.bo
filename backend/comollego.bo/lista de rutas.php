<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script type="text/javascript" >
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=geometry"></script>
     <script type="text/javascript">
     var lat_i;
     var lng_i;
     var lat_f;
     var lng_f;
     var transporte;
     var linea;
     var parada=[];
     var tiene;
        <?php 
            $tipo = $_REQUEST['tipo_transporte']; 
            echo "transporte='".$tipo ."';"; 
            $inicio=$_REQUEST["inicio"];
            echo "lat_i=".$inicio[0] .";"; 
            echo "lng_i=".$inicio[1] .";"; 
            $final=$_REQUEST["final"];
            echo "lat_f=".$final[0] .";"; 
            echo "lng_f=".$final[1] .";"; 
            $dir=$_REQUEST["direccion"];
            echo "direccion_i='".$dir[0]."';\n"; 
            echo "direccion_f='".$dir[1]."';\n"; 
        ?>
        if(distancia_de_dos_LatLngs(new google.maps.LatLng(lat_i, lng_i),new google.maps.LatLng(lat_f, lng_f))<200){
            if(confirm("la distancia de   su meta es menor  a 200  metros puede a llegar a pie \n desea calcular los pasos para llegar a pie??"))
                transporte='WALKING';
        }
        if(transporte==='PUBLICO'){
            //primero creamos  una funcion para  hallar una distancia entre dos puntos y en metros sin  redondear
            <?php
                function getDistance($lat1, $long1, $lat2, $long2)
                {
                $earth = 6378137; //km change accordingly
                //$earth = 3960; //miles

                //Point 1 cords
                $lat1 = deg2rad($lat1);
                $long1= deg2rad($long1);

                //Point 2 cords
                $lat2 = deg2rad($lat2);
                $long2= deg2rad($long2);

                //Haversine Formula
                $dlong=$long2-$long1;
                $dlat=$lat2-$lat1;
                $sinlat=sin($dlat/2);
                $sinlong=sin($dlong/2);
                $a=($sinlat*$sinlat)+cos($lat1)*cos($lat2)*($sinlong*$sinlong);
                $c=2*asin(min(1,sqrt($a)));
                $d=$earth*$c;
                return $d;
                } 
                echo "console.log('la distancia inicio y final es :'+".getDistance($inicio[0], $inicio[1], $final[0], $final[1]).");\n";
                
            ?>
            
            <?php
                $con = mysqli_connect("localhost", "root", "123456", "vico") or die("Problemas con la conexion a la base de datos");
                $registros = mysqli_query($con, "select * from parada") or die("Error en la consulta sql: ". mysqli_error($con));
                $cantidaddepuntos = 0;

                while ($reg = mysqli_fetch_array($registros)) {
                    $id[$cantidaddepuntos] = $reg['idparada'];
                    $lat[$cantidaddepuntos] = $reg['latitud'];
                    $lng[$cantidaddepuntos] = $reg['longitud'];
                    $cantidaddepuntos++;
                }
                //ahora  tenemos  un vector de distancia $cantidadepuntos 
                //con valores $id,$lat,$lng
                //$id y distancia
                //d_i distancia inicio con id_i id inicio
                //d_f distancia final  con id_f id final
                $l=0;
                for($i=0;$i<$cantidaddepuntos;$i++){
                    $id_i[$l]=$id[$i];
                    $d_i[$l]=getDistance($inicio[0], $inicio[1], $lat[$i], $lng[$i]);
                    $id_f[$l]=$id[$i];
                    $d_f[$l]=getDistance($final[0], $final[1], $lat[$i], $lng[$i]);
                    $l++;
                }
                //ahora ordenamos por distancia
                for($i=0;$i<$l;$i++){
                    for($j=$i+1;$j<$l;$j++){
                        if($d_i[$j]<$d_i[$i]){
                            //codigo
                            $aux_i=$id_i[$i];
                            $id_i[$i]=$id_i[$j];
                            $id_i[$j]=$aux_i;
                            //distancia
                            $aux_d=$d_i[$i];
                            $d_i[$i]=$d_i[$j];
                            $d_i[$j]=$aux_d;
                        }
                    }
                }
                //ahora mostramos  por console
                for($i=0;$i<$l;$i++){
                    echo "console.log('cod_i ='+".$id_i[$i]."+'      distancia ='+".$d_i[$i].");";
                }
            ?>
            var puntos =  [<?php
                for($i = 0; $i < $cantidaddepuntos; $i++) {
                    if ($i != 0)
                        echo ",\n";
                    echo "new google.maps.LatLng($lat[$i], $lng[$i])";
                }?>
            ];
            console.log("cantidad de puntos   totales   = "+puntos.length);
            var idd= [<?php
                for($i = 0; $i < $cantidaddepuntos; $i++) {
                    if ($i != 0)
                    echo ", ";
                    echo "\"$id[$i]\"";
                }?>
            ];
            var p_sercanas_i=[];
            var id_i=[];
            for(var i=0;i<puntos.length;i++){
                if(distancia_de_dos_LatLngs(puntos[i],new google.maps.LatLng(lat_i, lng_i))<400){
                    p_sercanas_i.push(puntos[i]);
                    id_i.push(idd[i]);
                }
            }
            var p_sercanas_f=[];
            var id_f=[];
            for(var i=0;i<puntos.length;i++){
                if(distancia_de_dos_LatLngs(puntos[i],new google.maps.LatLng(lat_f, lng_f))<400){
                    p_sercanas_f.push(puntos[i]);
                    id_f.push(idd[i]);
                }
            }
            //ahora   definimos las  lineas que tienen a las paradas sercanas  a inicio
            //var ppp=1;
            <?php
                 
                $var_php = "1";
                $con = mysqli_connect("localhost", "root", "123456", "vico") or die("Problemas con la conexion a la base de datos");
                $registros = mysqli_query($con, "SELECT idparada FROM  `tiene` WHERE idlinea LIKE  '".$var_php."'") or die("Error en la consulta sql: ". mysqli_error($con));
                $cantidaddepuntos = 0;

                while ($reg = mysqli_fetch_array($registros)) {
                    $id[$cantidaddepuntos] = $reg['idparada'];
                    $cantidaddepuntos++;
                }
                echo "console.log('cantidad de puntos ='+". $cantidaddepuntos.");\n";
            ?>
            var prueva =  [<?php
                for($i = 0; $i < $cantidaddepuntos; $i++) {
                    if ($i != 0)
                        echo ",\n";
                    echo $id[$i];
                }?>
            ];
            console.log("prueva****************");
            console.log(prueva);
            // 
        }
        function distancia_de_dos_LatLngs(a,b){
            return google.maps.geometry.spherical.computeDistanceBetween(a,b);
        }
     </script>
     <script type="text/javascript" src="codigo  lista de rutas.js"></script>
</head>
<body>
    <div id="logo" style="float:top;width:100%;height:10%;"><img src="img/logo.jpg" width="10%" height="100%"><img src="img/logo.jpg" width="90%" height="100%"></div>
    <div id="panel" style="float:left;width:25%;height:90%;">
        <label  style="width: 20%;float: left;">Inicio :</label>
        <label  style="width: 77%;float: left;"><?php  echo $dir[0]; ?></label>
        <p>
        <label  style="width: 20%;float: left;">Final :</label>
        <label  style="width: 77%;float: left;"><?php  echo $dir[1]; ?></label>
        <p>
        <label  style="width: 20%;float: left;">por :</label>
        <label  style="width: 77%;float: left;"><?php  if($tipo=='WALKING')echo "A pie"; if($tipo=='PUBLICO')echo "transporte publico";if($tipo=='DRIVING')echo "transporte privado"; ?></label>
        <div id="ruta"></div>
        <div id="div1"></div>
        <div id="div2"></div>
        <div id="div3"></div>
    </div>
    <div id="mapa" style="float:left;width:75%;height:90%;"> </div>
</body>
</html>
<!--  -->