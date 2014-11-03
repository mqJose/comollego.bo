<?php
$conexion = mysql_connect("localhost", "root", "123456") or die("Problemas con la conexion");
mysql_select_db("vico", $conexion) or die("Problemas en la seleccion de la base de datos");
mysql_query("INSERT INTO `vico`.`tramo` (`idtramo`) VALUES ('$_REQUEST[id_tramo]')", $conexion) or die("Problemas en el select".mysql_error());
$idparadas=$_REQUEST["idparada"];
$tiempos=$_REQUEST["tiempo"];
$trazos=$_REQUEST["trazo"];
for ($i=0;$i<count($idparadas);$i++){
	
	mysql_query("INSERT INTO `vico`.`tiene` (`idtramo`, `idparada`, `tiempo`, `trazo`) VALUES ('$_REQUEST[id_tramo]', '$idparadas[$i]',  '$tiempos[$i]',  '$trazos[$i]');", $conexion) or die("Problemas en el select".mysql_error());
}

$nuevos=$_REQUEST["cod_paradas_nuevas"];
$latituds=$_REQUEST["latitud"];
$longituds=$_REQUEST["longitud"];
for ($i=0;$i<count($nuevos);$i++){
	
	mysql_query("INSERT INTO `vico`.`parada` (`idparada`, `latitud`, `longitud`) VALUES ('$nuevos[$i]', '$latituds[$i]', '$longituds[$i]');", $conexion) or die("Problemas en el select".mysql_error());
}
//    adicionamos   fromado_por

$idpuntos=$_REQUEST["idpuntos"];
$ltps=$_REQUEST["lat_p"];
$lnps=$_REQUEST["lng_p"];
$cod_parada=$_REQUEST["codparada"];
$orden=0;
for($i=0;$i<count($idpuntos);$i++){
	mysql_query("INSERT INTO `vico`.`formado_por` (`idpunto`, `idtramo`, `idparada`, `orden`) VALUES ('$idpuntos[$i]', '$_REQUEST[id_tramo]', '$idpunto[$i]', '1');", $conexion) or die("Problemas en el select".mysql_error());
	//mysql_query("INSERT INTO `vico`.`formado_por` (`idpunto`, `idtramo`, `idparada`, `orden`) VALUES ('".idpunto."', '$_REQUEST[id_tramo]', '".$idpunto[$i]."', '".$orden."');", $conexion) or die("Problemas en el select".mysql_error());
	$orden++;
	$idpuntos++;
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
mysql_close($conexion);
header('Location: crear_tramo.php');
?>
