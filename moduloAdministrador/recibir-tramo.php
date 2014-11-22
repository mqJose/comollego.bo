<?php

//echo json_encode($_REQUEST);
require_once 'archivodeconexion.php';
$conexion = obtenerconexion();

mysqli_query($conexion, "INSERT INTO tramo (idtramo, referencia) VALUES ('$_REQUEST[id_tramo]', '$_REQUEST[referencia]')") or die("Problemas al insertar en la base de datos".mysqli_error($conexion));
$idparadas=$_REQUEST["idparada"];
$tiempos=$_REQUEST["tiempo"];
$trazos=$_REQUEST["trazo"];
for ($i=0;$i<count($idparadas);$i++){
	
	mysqli_query($conexion, "INSERT INTO tiene (idtramo, idparada, tiempo, trazo, orden) VALUES ('$_REQUEST[id_tramo]', '$idparadas[$i]',  '$tiempos[$i]',  '$trazos[$i]', $i);") or die("Problemas en el select".mysqli_error($conexion));
}

$nuevos=$_REQUEST["cod_paradas_nuevas"];
$latituds=$_REQUEST["latitud"];
$longituds=$_REQUEST["longitud"];
for ($i=0;$i<count($nuevos);$i++){
	
	mysqli_query($conexion, "INSERT INTO parada (idparada, latitud, longitud) VALUES ('$nuevos[$i]', '$latituds[$i]', '$longituds[$i]');") or die("Problemas en el select".mysqli_error($conexion));
}
//    adicionamos   formado_por
$idpuntos = $_REQUEST["idpuntos"];
$ltps = $_REQUEST["lat_p"];
$lnps = $_REQUEST["lng_p"];
$cod_parada = $_REQUEST["cod_parada"];
///echo "Hola mundo";
///echo "tamanio : ". count($idpuntos);
//echo "tamanioltps : ".count($nuevos);
for($i=0;$i<count($idpuntos);$i++){
	mysqli_query($conexion, "INSERT INTO formado_por (idpunto, idtramo, idparada, orden) VALUES ('$idpuntos[$i]', '$_REQUEST[id_tramo]', '$cod_parada[$i]', '$i');") or die("Problemas en el select".mysqli_error($conexion));
	mysqli_query($conexion, "INSERT INTO punto (idpunto, latitud, longitud) VALUES ('$idpuntos[$i]', '$ltps[$i]', '$lnps[$i]');") or die("Problemas en el select".mysqli_error($conexion));
    /// echo $idpuntos[$i];
	$orden++;
	//$idpuntos++;
}

mysqli_close($conexion);
header('Location: crear-tramo.php');
?>
