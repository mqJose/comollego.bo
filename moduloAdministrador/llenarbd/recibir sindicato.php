<?php
$conexion = mysql_connect("localhost", "root", "123456") or die("Problemas con la conexion");
mysql_select_db("vico", $conexion) or die("Problemas en la seleccion de la base de datos");
mysql_query("INSERT INTO `vico`.`sindicato` (`idsindicato`, `nombre`, `direccion`, `telefono`) VALUES ('$_REQUEST[idsindicato]', '$_REQUEST[nombre]', '$_REQUEST[direccion]', '$_REQUEST[telefono]');", $conexion) or die("Problemas en el select".mysql_error());
mysql_close($conexion);
header('Location: crear sindicato.php');
?>
