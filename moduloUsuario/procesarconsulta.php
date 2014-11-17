<?php
/*Tiene que ser tramos que pertenecen por lo menos a alguna linea*/
//obtenerOpcionesDeRuta(-16.52380997396528, -68.15124448345159, -16.504344054815466, -68.13121436158326);
    require_once 'utilidades.php';
    $latini = $_REQUEST['latitudini'];
    $lngini = $_REQUEST['longitudini'];
    $latfin = $_REQUEST['latitudfin'];
    $lngfin = $_REQUEST['longitudfin'];
    $respuesta = obtenerOpcionesDeRuta($latini, $lngini, $latfin, $lngfin);

    echo json_encode($respuesta);
?>