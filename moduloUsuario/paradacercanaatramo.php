<?php
    require_once 'utilidades.php';
    function paradaMasCercanaDeTramo($lat, $lng , $idtramo) {

        require_once 'archivodeconexion.php';
        $conexion = obtenerconexion();

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
                         where idparada IN (
                            select idparada
                            from tiene
                            where tiene.idtramo like '.$idtramo.'
                         )
                         ORDER BY distance ASC');
        $ans = array();
        while ($fila = mysqli_fetch_array($registros)) {
            return $fila['idparada'];
        }
        mysqli_close($conexion);
        return [];
    }
    $idtramo = $_REQUEST['idtramo'];
    $longitud = $_REQUEST['longitud'];
    $latitud = $_REQUEST['latitud'];

    $ans = paradaMasCercanaDeTramo($latitud, $longitud, $idtramo);
    //http://localhost/comollego.bo/moduloUsuario/paradacercanaatramo.php?latitud=-16.512959896594598&longitud=-68.15940553002292&idtramo=5
    echo json_encode($ans);
?>