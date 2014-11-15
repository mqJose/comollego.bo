<?php
function getBoundaries($lat, $lng, $distance = 0.4, $earthRadius = 6371) {
    $return = array();

    // Los angulos para cada dirección
    $cardinalCoords = array('north' => '0',
        'south' => '180',
        'east' => '90',
        'west' => '270');

    $rLat = deg2rad($lat);
    $rLng = deg2rad($lng);
    $rAngDist = $distance/$earthRadius;

    foreach ($cardinalCoords as $name => $angle)
    {
        $rAngle = deg2rad($angle);
        $rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
        $rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));

        $return[$name] = array('lat' => (float) rad2deg($rLatB),
            'lng' => (float) rad2deg($rLonB));
    }

    return array('min_lat'  => $return['south']['lat'],
        'max_lat' => $return['north']['lat'],
        'min_lng' => $return['west']['lng'],
        'max_lng' => $return['east']['lng']);
}

function buscarParadasCercanas($lat, $lng , $distance) {

    require_once 'archivodeconexion.php';
    $conexion = obtenerconexion();

    /*$registros = mysqli_query($conexion, "select latitud, longitud from parada where idparada like $idparada");
    $fila = mysqli_fetch_assoc($registros);
    $lat = $fila[latitud];
    $lng = $fila[longitud];*/

    $box = getBoundaries($lat, $lng, $distance);
    $registros = mysqli_query($conexion, 'SELECT idparada, ( 6371 * ACOS(
                                             COS( RADIANS(' . $lat . ') )
                                             * COS(RADIANS( latitud ) )
                                             * COS(RADIANS( longitud )
                                             - RADIANS(' . $lng . ') )
                                             + SIN( RADIANS(' . $lat . ') )
                                             * SIN(RADIANS( latitud ) )
                                            )
                               ) AS distance
                     FROM parada
                     WHERE (latitud BETWEEN ' . $box['min_lat'] . ' AND ' . $box['max_lat'] . ')
                     AND (longitud BETWEEN ' . $box['min_lng'] . ' AND ' . $box['max_lng'] . ')
                     HAVING distance < ' . $distance . '
                     ORDER BY distance ASC');
    $ans = array();

    while ($fila = mysqli_fetch_array($registros)) {
        //if ($fila[idparada] != $idparada) {
        $ans[] = $fila[idparada];
        //echo $fila[idparada]."<br>";
        //}
    }
    mysqli_close($conexion);
    return $ans;
}
//buscarParadasCercanas(-16.487259543091792, -68.12157265820133, 0.2);

function tramosQueInicianEn($idparada) {
    require_once 'archivodeconexion.php';
    $conexion = obtenerconexion();
    $registros = mysqli_query($conexion, "select idtramo from tiene where orden = 0 AND idparada like $idparada")  or die("Problemas en el select".mysqli_error($conexion));
    $ans = array();
    while ($fila = mysqli_fetch_array($registros)) {
        $ans[] = $fila[idtramo];
    }
    mysqli_close($conexion);
    return $ans;
}

function tramosQueContiene($idparada) {
    require_once 'archivodeconexion.php';
    $conexion = obtenerconexion();
    $registros = mysqli_query($conexion, "select idtramo from tiene where idparada like $idparada" )  or die("Problemas en el select".mysqli_error($conexion));
    $ans = array();
    while ($fila = mysqli_fetch_array($registros)) {
        $ans[] = $fila[idtramo];
    }
    mysqli_close($conexion);
    return $ans;
}
function tramosQueContienen($idparadaA, $idparadaB) {
    require_once 'archivodeconexion.php';
    $conexion = obtenerconexion();

    $registro = mysqli_query($conexion, "select count(*) cantidad from tramo" )  or die("Problemas en el select".mysqli_error($conexion));
    $fila = mysqli_fetch_assoc($registro);
    $nrodeTramos = $fila[cantidad];

    $ans = array();

    for ($idtramo = 1; $idtramo <= $nrodeTramos; $idtramo++) {
        $registros = mysqli_query($conexion, "select idparada, orden from tiene where idtramo like $idtramo" )  or die("Problemas en el select".mysqli_error($conexion));
        $ordenA = -1;
        $ordenB = -1;
        while ($fila = mysqli_fetch_array($registros)) {
            if ($fila[idparada] == $idparadaA) {
                $ordenA = $fila[orden];
            }
            if ($fila[idparada] == $idparadaB) {
                $ordenB = $fila[orden];
            }
        }
        if ($ordenA != -1 && $ordenB != -1 && ($ordenA < $ordenB))
            $ans[] = $idtramo;
    }
    //for ($i = 0, $tam = count($ans); $i < $tam; $i++ )
    //  echo "Tramo contiene : ". $ans[$i];
    mysqli_close($conexion);
    return $ans;
}

function tramoInicio($idtramo) {
    require_once 'archivodeconexion.php';
    $conexion = obtenerconexion();
    $registros = mysqli_query($conexion, "select idparada from tiene where idtramo like $idtramo AND orden = 0" )  or die("Problemas en el select".mysqli_error($conexion));
    $fila = mysqli_fetch_assoc($registros);
    mysqli_close($conexion);
    return $fila[idparada];
}

function tramoFin($idtramo) {
    require_once 'archivodeconexion.php';
    $conexion = obtenerconexion();
    $registros = mysqli_query($conexion, "select COUNT(*) AS cantidad from tiene where idtramo like $idtramo GROUP BY idtramo" )  or die("Problemas en el select".mysqli_error($conexion));
    $fila = mysqli_fetch_assoc($registros);
    $ultimo = $fila[cantidad] - 1;
    $registros = mysqli_query($conexion, "select idparada from tiene where idtramo like $idtramo AND orden = $ultimo" )  or die("Problemas en el select".mysqli_error($conexion));
    $fila = mysqli_fetch_assoc($registros);
    mysqli_close($conexion);
    return $fila[idparada];
}

function sinRepetidos($array) {
    $container = array();
    $i = 0;
    foreach ($array as $a=>$b)
        if (!in_array($b,$container)){
            $container[$i]=$b;
            $i++;
        }
    return $container;
}

/**************************************  FUNCIONALIDAD PRINCIPAL  *******************************************/
function obtenerOpcionesDeRuta($latitudini, $longitudini, $latitudfin, $longitudfin) {
    $paradasini = buscarParadasCercanas($latitudini, $longitudini, 0.4);
    $paradasfin = buscarParadasCercanas($latitudfin, $longitudfin, 0.4);
    $ans = array();
    $indiceans = 0;
    $unsolotramo = array();
    $found = 0;
    //Primero intentaremos aproximarnos con un solo tramo
    for ($i = 0, $sizeA = count($paradasini); $i < $sizeA; $i++) {
        for ($j = 0, $sizeB = count($paradasfin); $j < $sizeB; $j++) {
            $paradaINI = $paradasini[$i];
            $paradaFIN = $paradasfin[$j];
            $tmp = tramosQueContienen($paradaINI, $paradaFIN);
            for ($k = 0, $tamtmp = count($tmp); $k < $tamtmp; $k++)
                $unsolotramo[$found++] = $tmp[$k];
        }
    }
    //$sinrepetidos = array_unique($unsolotramo); //NO SE POR QUE NO FUNCIONA ESTO
    $sinrepetidos = sinRepetidos($unsolotramo);  // ESTE OTRO ES LENTO :-(
    for ($i = 0, $tam = count($sinrepetidos); $i < $tam; $i++) {
        $ans[$indiceans][0] = $sinrepetidos[$i];
        $indiceans++;
    }

    //Ahora probamos rutas con mas de un tramo
    // Que dios nos proteja
    $tramosINI = array();
    $tramosFIN = array();
    for ($i = 0, $tam = count($paradasini); $i < $tam; $i++) {
        $tmp = tramosQueContiene($paradasini[$i]);
        $tmp = sinRepetidos($tmp);
        for ($j = 0, $tamtmp = count($tmp); $j < $tamtmp; $j++)
            $tramosINI[] = $tmp[$j];
    }
    $tramosINI = sinRepetidos($tramosINI);

    for ($i = 0, $tam = count($paradasfin); $i < $tam; $i++) {
        $tmp = tramosQueContiene($paradasfin[$i]);
        $tmp = sinRepetidos($tmp);
        for ($j = 0, $tamtmp = count($tmp); $j < $tamtmp; $j++)
            $tramosFIN[] = $tmp[$j];
    }
    $tramosFIN = sinRepetidos($tramosFIN);


    for ($i = 0, $tam = count($tramosINI); $i < $tam; $i++) {
        $mivector = array();
        $mivector[] = $tramosINI[$i];
        solve($tramosINI[$i], 3, $mivector, $tramosFIN, $ans);
    }
    return $ans;
}

function solve($ultimotramo, $tramosrestantes, $vector, &$tramosFIN, &$sol) {
    if (in_array($ultimotramo, $tramosFIN)){
        if (count($vector) > 1) // Los de 1 tramo ya estan, este de aca podria estar al revez
            $sol[] = $vector;
        return;
    }
    if ($tramosrestantes == 0){
        return;
    }
    $ultimaparada = tramoFin($ultimotramo);
    $siguientes = tramosQueInicianEn($ultimaparada);
    for ($i = 0, $tam = count($siguientes); $i < $tam; $i++) {
        $sig = $siguientes[$i];
        $nuevovector = $vector;
        $nuevovector[] = $sig;
        solve($sig, $tramosrestantes - 1, $nuevovector, $tramosFIN, $sol);
    }

}

$repuesta = obtenerOpcionesDeRuta(-16.49107143639339, -68.12361996620893, -16.490999423918716, -68.12272947281599);
//$repuesta = obtenerOpcionesDeRuta(-16.497389944487566,-68.13421569764614, -16.50282968529163, -68.12220375984907);
//$repuesta = obtenerOpcionesDeRuta(-16.497389944487566,-68.13421569764614, -16.49945556274807, -68.12888782471418);
for ($i = 0, $tam = count($repuesta); $i < $tam; $i++) {

    for ($j = 0, $tam2 = count($repuesta[$i]); $j < $tam2; $j++){
        echo $repuesta[$i][$j].", ";
    }
    echo "<br>";
}
?>