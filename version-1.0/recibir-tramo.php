<?php
require_once 'archivodeconexion.php';
$conexion = obtenerconexion();

mysqli_query($conexion, "INSERT INTO `vico`.`tramo` (`idtramo`, `referencia`) VALUES ('$_REQUEST[id_tramo]', '$_REQUEST[referencia]')") or die("Problemas al insertar en la base de datos".mysqli_error($conexion));
$idparadas=$_REQUEST["idparada"];
$tiempos=$_REQUEST["tiempo"];
$trazos=$_REQUEST["trazo"];
for ($i=0;$i<count($idparadas);$i++){
	
	mysqli_query($conexion, "INSERT INTO `vico`.`tiene` (`idtramo`, `idparada`, `tiempo`, `trazo`) VALUES ('$_REQUEST[id_tramo]', '$idparadas[$i]',  '$tiempos[$i]',  '$trazos[$i]');") or die("Problemas en el select".mysqli_error($conexion));
}

$nuevos=$_REQUEST["cod_paradas_nuevas"];
$latituds=$_REQUEST["latitud"];
$longituds=$_REQUEST["longitud"];
for ($i=0;$i<count($nuevos);$i++){
	
	mysqli_query($conexion, "INSERT INTO `vico`.`parada` (`idparada`, `latitud`, `longitud`) VALUES ('$nuevos[$i]', '$latituds[$i]', '$longituds[$i]');") or die("Problemas en el select".mysqli_error($conexion));
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
	mysqli_query($conexion, "INSERT INTO `vico`.`formado_por` (`idpunto`, `idtramo`, `idparada`, `orden`) VALUES ('$idpuntos[$i]', '$_REQUEST[id_tramo]', '$cod_parada[$i]', '$i');") or die("Problemas en el select".mysqli_error($conexion));
	mysqli_query($conexion, "INSERT INTO `vico`.`punto` (`idpunto`, `latitud`, `longitud`) VALUES ('$idpuntos[$i]', '$ltps[$i]', '$lnps[$i]');") or die("Problemas en el select".mysqli_error($conexion));
    /// echo $idpuntos[$i];
	$orden++;
	//$idpuntos++;
}
/*
/*
$idpuntos=$_REQUEST["idpuntos"];
$ltps=$_REQUEST["lat_p"];
$lnps=$_REQUEST["lng_p"];
$orden=0;
$cod_parada=$_REQUEST["cod_parada"];
for($i=0;$i<count($latps);$i++){
	mysql_query("INSERT INTO `vico`.`formado_por` (`idpunto`, `idtramo`, `idparada`, `orden`) VALUES ('$idpuntos[$i]', '$_REQUEST[id_tramo]', '$cod_parada[$i]', '$orden');", $conexion) or die("Problemas en el select".mysql_error());
	mysql_query("INSERT INTO `vico`.`punto` (`idpunto`, `latitud`, `longitud`) VALUES ('$idpuntos[$i]', '$latps[$i]', '$lnps[$i]');", $conexion) or die("Problemas en el select".mysql_error());
	$orden++;
	//$nro_puntos++;
}
*/
//mysqli_close($conexion);
header('Location: crear-tramo.php');
?>
