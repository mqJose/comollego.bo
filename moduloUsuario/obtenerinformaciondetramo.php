<?php


    $idtramo= $_REQUEST['idtramo'];
    require_once 'archivodeconexion.php';
    require_once 'utilidades.php';
    $con = obtenerconexion();
    $query = "select latitud, longitud from formado_por fp, punto p where fp.idtramo like $idtramo and fp.idpunto = p.idpunto order by orden";
    $registros = mysqli_query($con, $query) or die("Problemas con la query 1 : ".mysqli_error($con));
    while ($fila = mysqli_fetch_array($registros)) {
        $punto[0] = $fila['latitud'];
        $punto[1] = $fila['longitud'];
        $ans[] = $punto;
    }
    $query = "select referencia from tramo where idtramo like $idtramo";
    $registro = mysqli_query($con, $query) or die("Problemas con la query 2: ".mysqli_error($con));
    $respuestaquery = mysqli_fetch_assoc($registro);


    $query = "select nombre from contiene, linea where linea.idlinea = contiene.idlinea && idtramo like ".$idtramo;
    $registros = mysqli_query($con, $query) or die("Problemas en la consulta:".mysqli_error($con));
    while ($fila = mysqli_fetch_array($registros)) {
        $lineas[] = $fila['nombre'];
    }
    $lineas = sinRepetidos($lineas);


    $salida['referencia'] = $respuestaquery['referencia'];
    $salida['puntos'] = $ans;
    $salida['lineas'] = $lineas;

    if ($ans)//Si no esta vacio
        echo json_encode($salida);

    mysqli_close($con);
?>