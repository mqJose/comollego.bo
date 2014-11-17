<?php
    $idtramo= $_REQUEST['idtramo'];
    require_once 'archivodeconexion.php';
    $con = obtenerconexion();
    $query = "select latitud, longitud from formado_por fp, punto p where fp.idtramo like $idtramo and fp.idpunto = p.idpunto order by orden";
    $registros = mysqli_query($con, $query) or die("Problemas con la query : ".mysqli_error($con));
    while ($fila = mysqli_fetch_array($registros)) {
        $punto[0] = $fila['latitud'];
        $punto[1] = $fila['longitud'];
        $ans[] = $punto;
    }
    if ($ans)//Si no esta vacio
        echo json_encode($ans);

?>