<?php
$conexion = mysql_connect("localhost", "root", "123456") or die("Problemas con la conexion");
mysql_select_db("vico", $conexion) or die("Problemas en la seleccion de la base de datos");
mysql_query("INSERT INTO `vico`.`linea` (`idlinea`, `nombre`, `tipo_transporte`,`idsindicato`) VALUES ('$_REQUEST[codnombre]','$_REQUEST[nombre]' , '$_REQUEST[tipo_transporte]','$_REQUEST[sindicato]')", $conexion) or die("Problemas en el select".mysql_error());
$idparadas=$_REQUEST["idparada"];
$tiempos=$_REQUEST["tiempo"];
$tipos=$_REQUEST["tipo_parada"];
$trazo=$_REQUEST["trazo"];
for ($i=0;$i<count($idparadas);$i++){
	
	mysql_query("INSERT INTO `vico`.`tiene` (`idlinea`, `idparada`, `tiempo`, `tipo`, `trazo`) VALUES ('$_REQUEST[codnombre]', '$idparadas[$i]',  '$tiempos[$i]',  '$tipos[$i]','$trazo[$i]');", $conexion) or die("Problemas en el select".mysql_error());
}

$nuevos=$_REQUEST["cod_paradas_nuevas"];
$latituds=$_REQUEST["latitud"];
$longituds=$_REQUEST["longitud"];
for ($i=0;$i<count($nuevos);$i++){
	
	mysql_query("INSERT INTO `vico`.`parada` (`idparada`, `latitud`, `longitud`) VALUES ('$nuevos[$i]', '$latituds[$i]', '$longituds[$i]');", $conexion) or die("Problemas en el select".mysql_error());
}
mysql_close($conexion);
header('Location: crear ruta.php');
?>
