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
                //echo "console.log('la distancia inicio y final es :'+".getDistance($inicio[0], $inicio[1], $final[0], $final[1]).");\n";
                function pos_serca($con,$t,$i,$f)//$i  latitud  $f longitud  $t tramo
                {
                    require_once 'archivodeconexion.php';
                    $con = obtenerconexion();
                    $min=99999999;
                    $tramo = mysqli_query($con, "select p.latitud,p.longitud from parada p, tiene t where t.idparada like p.idparada and t.idtramo like '".$t."' ") or die("Error en la consulta sql: ". mysqli_error($con));
                    $c=0;
                    while ($reg = mysqli_fetch_array($tramo)) {
                        $d=getDistance($i,$f,$reg['latitud'],$reg['longitud']);
                        if($d<$min){
                            $min=$d;
                            $h=$c;
                        }

                        $c++;
                    }
                    if($min<400)
                        return $h;
                    else return -1;
                }
                //la pocicion del punto i  entre    tr1  y tr2   con i   q varia entre 1  y 2
                function pos_p_tr($con,$tr1,$tr2,$i){
                    $min=99999999;
                    $tramo1 = mysqli_query($con, "select p.latitud,p.longitud from parada p, tiene t where t.idparada like p.idparada and t.idtramo like '".$tr1."' ") or die("Error en la consulta sql: ". mysqli_error($con));
                    $x=0;
                    $y=0;
                    while ($reg1 = mysqli_fetch_array($tramo1)) {
                        $tramo2 = mysqli_query($con, "select p.latitud,p.longitud from parada p, tiene t where t.idparada like p.idparada and t.idtramo like '".$tr2."' ") or die("Error en la consulta sql: ". mysqli_error($con));
                        while ($reg2 = mysqli_fetch_array($tramo2)) {
                            $d=getDistance($reg1['latitud'],$reg1['longitud'],$reg2['latitud'],$reg2['longitud']);
                            if($d<$min){
                                $min=$d;
                                $a=$x;
                                $b=$y;
                            }
                            $y++;
                        }
                        $x++;
                    }
                    if($min<400){
                        if($i===1)
                            return $a;
                        else
                            return $b;
                    }
                    else return -1;
                }
            ?>

            ///fin de creacion de funciones
            <?php

            require_once 'archivodeconexion.php';
            $con = obtenerconexion();
            $tramo = mysqli_query($con, "select idtramo from tramo") or die("Error en la consulta sql: ". mysqli_error($con));
            $n = 0;
            //en aqui sacamos todos los id de tramos
            while ($reg = mysqli_fetch_array($tramo)) {
                $trm[$n]=$reg['idtramo'];
                $n++;
            }
            //ahora  tenemos  los tramso que cumplen   el sentido
            // en $trm  con tamaño  &n
            echo "var poo=[";
            for($i=0;$i<$n;$i++){
                if($i!=0)
                    echo ",";
                echo $trm[$i];
            }
            echo "];\n";
            //ahora simulamos que en el vector $v tenemos los posibles tramos  tramos ordenados por tiempo  q esta en $t con $n tamaño del vector
            $n=4;
            $v[0][0]='1';
            $v[1][0]='2';
            $v[2][0]='3';
            $v[3][0]='8';
            $v[3][1]='9';
            $t[0]=13.51;
            $t[1]=18.01;
            $t[2]=24.03;
            $t[3]=25;
            //echo "['1'],['3'],['4']";
            //echo "];";
            //ahora pasamos  las variables a javascript  por echo
            //pasamos v
            echo "var v=[";
            for($i=0;$i<$n;$i++){
                if($i!=0)echo ",";
                echo "[";
                for($j=0;$j<count($v[$i]);$j++){
                    if($j!=0)
                        echo",";
                    echo "'".$v[$i][$j]."'";
                }
                echo"]";
            }
            echo"];";
            //pasamos t
            echo "var t=[";
            for($i=0;$i<$n;$i++){
                if($i!=0)echo ",";
                echo $t[$i];
            }
            echo "]";
            ?>
        }
        function tramos_y_tiempos(ojs){
            return ojs;
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
    <form name ="formulario1"action="marca ruta.php" method="get">
        <fieldset>
            <label  style="width: 20%;float: left;">Inicio :</label>
            <label  style="width: 77%;float: left;"><?php  echo $dir[0]; ?></label>
            <p>
                <label  style="width: 20%;float: left;">Final :</label>
                <label  style="width: 77%;float: left;"><?php  echo $dir[1]; ?></label>
            <p>
                <label  style="width: 20%;float: left;">por :</label>
                <label  style="width: 77%;float: left;"><?php  if($tipo=='WALKING')echo "A pie"; if($tipo=='PUBLICO')echo "transporte publico";if($tipo=='DRIVING')echo "transporte privado"; ?></label>
            <div id="ruta"></div>
            <div id="posicion_i"></div>
            <div id="posicion_f"></div>
            <div id="direccion"></div>
            <div id="camino"></div>
        </fieldset>
    </form>
</div>
<div id="mapa" style="float:left;width:75%;height:90%;"> </div>
</body>
</html>
<!--  -->