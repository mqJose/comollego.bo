<?php
$conexion = mysql_connect("localhost", "root", "123456") or die("Problemas con la conexion");
mysql_select_db("vico", $conexion) or die("Problemas en la seleccion de la base de datos");
mysql_query("INSERT INTO `vico`.`linea` (`idlinea`, `nombre`, `tipo_transporte`,`idsindicato`) VALUES ('$_REQUEST[codnombre]','$_REQUEST[nombre]' , '$_REQUEST[tipo_transporte]','$_REQUEST[sindicato]')", $conexion) or die("Problemas en el select".mysql_error());
$tramos=$_REQUEST["cod_tramos"];
for ($i=0;$i<count($tramos);$i++){
	mysql_query("INSERT INTO `vico`.`contiene` (`idlinea`, `idtramo`) VALUES ('$_REQUEST[codnombre]', '$tramos[$i]');", $conexion) or die("Problemas en el select".mysql_error());
}
mysql_close($conexion);
header('Location: crear ruta.php');
?>
