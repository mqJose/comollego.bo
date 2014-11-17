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
    $inicio=$_REQUEST["inicio"];
    echo "lat_i=".$inicio[0] .";";
    echo "lng_i=".$inicio[1] .";";
    $final=$_REQUEST["final"];
    echo "lat_f=".$final[0] .";";
    echo "lng_f=".$final[1] .";";
    $dir=$_REQUEST["direccion"];
    echo "direccion_i='".$dir[0]."';\n";
    echo "direccion_f='".$dir[1]."';\n";
    //ahora sacamos el recorrido de  el camino
    $camino=$_REQUEST["camino"];
?>
//creamos las funciones  q utilizaremos
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
            
                return $h;
            
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
            
                if($i==1)
                    return $a;
                else
                    return $b;
            
            
        }
    ?>

    //ahora sacamos  las pociciones  [a,b] q se tomara del tramo  $v
    <?php
    //primero realizamos la coneccion
        require_once 'archivodeconexion.php';
        $con = obtenerconexion();
        echo "console.log(".count($camino).");";
        for($i=0;$i<count($camino);$i++){
            if($i==0)
                $v[$i][0]=pos_serca($con,$camino[$i],$inicio[0],$inicio[1]);
            else 
                $v[$i][0]=pos_serca($con,$camino[$i-1],$camino[$i],2);
            if(($i+1)==count($camino))
                 $v[$i][1]=pos_serca($con,$camino[$i],$final[0],$final[1]);
            else 
                 $v[$i][1]=pos_serca($con,$camino[$i],$camino[$i+1],1);
        }
        echo "console.log(".$v[0][0]."----".$v[0][1].")";
        //ahora sacamos el polilyne de cada tramo en $pl
        echo "var pl=[";
        $n = 0;
        for($i=0;$i<count($camino);$i++){
            if($i!=0)
                echo",";
            echo "[";
            for($j=$v[$i][0];$j<=$v[$i][1];$j++){
                $tramo = mysqli_query($con, "SELECT  p.latitud, p.longitud FROM formado_por fp, punto p WHERE fp.idtramo LIKE  '".$camino[$i]."' AND fp.idpunto LIKE p.idpunto and fp.idparada like '".($j+1)."';") or die("Error en la consulta sql: ". mysqli_error($con));
                while ($reg = mysqli_fetch_array($tramo)) {
                    if($n!=0)echo",";
                    echo "new google.maps.LatLng(".$reg['latitud'].", ".$reg['longitud'].")";
                    $n++;
                }
            }
            echo "]\n";
        }
        echo "];\n";

    ?>
function distancia_de_dos_LatLngs(a,b){
    return google.maps.geometry.spherical.computeDistanceBetween(a,b);
}
function atras(){
    window.history.back();
}
</script>
<script type="text/javascript" src="codigo  marca ruta.js"></script>
</head>
<body>
<div id="logo" style="float:top;width:100%;height:10%;"><img src="img/logo.jpg" width="10%" height="100%"><img src="img/logo.jpg" width="90%" height="100%"></div>
<div id="panel" style="float:left;width:25%;height:90%;">
    <INPUT type="button" onclick="atras()"value="Atras"style="width: 100%;float: left;">
    <label  style="width: 20%;float: left;">Inicio :</label>
    <label  style="width: 77%;float: left;"><?php  echo $dir[0]; ?></label>
    <p>
        <label  style="width: 20%;float: left;">Final :</label>
        <label  style="width: 77%;float: left;"><?php  echo $dir[1]; ?></label>
    <p>
        <label  style="width: 20%;float: left;">por :</label>
        <label  style="width: 77%;float: left;">TRANSPORTE PUBLICO</label>
    <div id="ruta"></div>
    <form name ="formulario1"action="marca ruta.php" method="get">
        <div id="posicion_i"></div>
        <div id="posicion_f"></div>
        <div id="direccion"></div>
        <div id="camino"></div>
    </form>
</div>
<div id="mapa" style="float:left;width:75%;height:90%;"> </div>
</body>
</html>
<!--  -->