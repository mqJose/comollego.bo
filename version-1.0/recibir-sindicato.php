<?php
require_once 'archivodeconexion.php';
$con = obtenerconexion();

mysqli_query($con, "INSERT INTO `vico`.`sindicato` (`nombre`, `direccion`, `telefono`) VALUES ('$_REQUEST[nombre]', '$_REQUEST[direccion]', '$_REQUEST[telefono]');") or die("Problemas en el select".mysqli_error($con));
mysql_close($conexion);
header('Location: crear-sindicato.php');
?>
