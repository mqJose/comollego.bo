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
        $paradas =mysqli_query($con, "select p.latitud,p.longitud from parada p, tiene t where t.idparada like p.idparada and t.idtramo like '$reg[idtramo]' order by t.tiempo asc") or die("Error en la consulta sql: ". mysqli_error($con));
        $max=-1;//distancia minima a  fin
        $min=999999999;//distancia minima a inicio
        $yx=0;
        $in=110;
        $fi=110;
        //tratamos de restringir todos los tramos que cumplen el sentido de recorido
        $gl=0;
        while($rx = mysqli_fetch_array($paradas)){
            $d=getDistance($inicio[0],$inicio[1],$rx['latitud'],$rx['longitud']);
            if($d<$min){
                $in=$yx;
                $min=$d;
                $gl=1;
                $max=-1;
                $fi=110;
            }
            if($gl=1){
                $d=getDistance($inicio[0],$inicio[1],$rx['latitud'],$rx['longitud']);
                if($d<$max){
                    $fi=$yx;
                    $max=$d;
                }
            }
            $yx++;
        }
        //if($in<$fi){//con esto  cumplimos el sentido y solo adicionamos las rutas que  cumplan
            $trm[$n]=$reg['idtramo'];
            $n++;
        //}
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
    //ahora tratamos de sacar  los pasos a base de tramos para cada posible solucion
    $sl=0;//y en soluciones  guardamos todo
    echo "var sol=[";
    for($i=0;$i<$n;$i++){
        //echo "console.log('-------------------------------------------------------');\n";
        //echo "console.log('uno  '+".$i.");\n";
        //echo "console.log(".d_serca($con,$trm[$i],$inicio[0],$inicio[1]).");\n";
        $pq=0;
        $marka=pos_serca($con,$trm[$i],$inicio[0],$inicio[1]);
        if($marka>-1){
            //echo"console.log('1 *********'+".($i+1)."+'**********');\n";
            //en aqui decimos que la primera  ruta cumple con p_i<200   y p_f<200
            //echo"console.log('marka '+".$marka.");\n";
            $sw=1;
            $s_x[0]=$trm[$i];
            if(pos_serca($con,$trm[$i],$final[0],$final[1])>$marka){
                if($sl!=0)
                    echo ",\n";
                echo "[";
                for($h=0;$h<$sw;$h++){
                     if($h!=0)
                        echo ",";
                    echo "'".$s_x[$h]."'";
                     //$sol[$sl][$h]=$s_x[$h];
                }
                echo "]";
                $sl++;
            }
            else{
                //echo "console.log('  tramos  2----------');\n";
                //sacamos nueva marka
                for($j=0;$j<$n;$j++){
                    if($i!=$j){
                        $marka1=pos_p_tr($con,$trm[$i],$trm[$j],1);
                        //echo"console.log('  ____________'+".($j+1)."+'');\n";
                        //echo"console.log(".$marka."+'   ********* mark **********'+".$marka1.");\n";
                        if($marka<$marka1){
                             //echo"console.log('  marka1 '+".$marka1.");\n";
                            //$marka=pos_p_tr($con,$trm[$i],$trm[$j],2);
                            $sw=2;
                            $s_x[1]=$trm[$j];
                            if(pos_serca($con,$trm[$j],$final[0],$final[1])>$marka1){
                                if($sl!=0)
                                    echo ",\n";
                                echo "[";
                                for($h=0;$h<$sw;$h++){
                                     if($h!=0)
                                        echo ",";
                                    echo "'".$s_x[$h]."'";
                                     //$sol[$sl][$h]=$s_x[$h];
                                }
                                echo "]";
                                $sl++;
                            }

                            else{
                                 //echo "console.log('      tramos  3----------');";
                                //en el caso de 3  tramos
                                for($k=0;$k<$n;$k++){
                                    if($j!=$k&&$i!=$k){
                                        $marka2=pos_p_tr($con,$trm[$j],$trm[$k],1);
                                        if($marka1<$marka2){
                                            //echo"console.log('      3 *********'+".($k+1)."+'**********');\n";
                                            //echo"console.log('      marka2 '+".$marka2.");\n";
                                            //$marka=pos_p_tr($con,$trm[$j],$trm[$k],2);
                                            $sw=3;
                                            $s_x[2]=$trm[$k];
                                            if(pos_serca($con,$trm[$k],$final[0],$final[1])>$marka2){
                                                if($sl!=0)
                                                    echo ",\n";
                                                echo "[";
                                                for($h=0;$h<$sw;$h++){
                                                     if($h!=0)
                                                        echo ",";
                                                    echo "'".$s_x[$h]."'";
                                                     //$sol[$sl][$h]=$s_x[$h];
                                                }
                                                echo "]";
                                                $sl++;
                                                //echo "console.log('SIIIIIIIIIIIIIII');\n";
                                            }
                                            else{
                                                //en el caso de 4  tramos
                                            }
                                        }//else echo"console.log('no 2');\n";
                                    }
                                }
                            }
                        }//else echo"console.log('no 1');\n";
                    }
                }
            }

            if($pq!=0){
                if($sl!=0)
                    echo ",\n";
                echo "[";
                for($h=0;$h<$sw;$h++){
                     if($h!=0)
                        echo ",";
                    echo "'".$s_x[$h]."'";
                     //$sol[$sl][$h]=$s_x[$h];
                }
                echo "]";
                $sl++;
            }
        }
    }
    echo "];";
    ?>
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