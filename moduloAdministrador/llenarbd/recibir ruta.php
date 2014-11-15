 <?php
//$conexion = mysql_connect("localhost", "root", "123456") or die("Problemas con la conexion");
//mysql_select_db("vico", $conexion) or die("Problemas en la seleccion de la base de datos");
require_once 'archivodeconexion.php';
$conexion = obtenerconexion();

mysqli_query($conexion, "INSERT INTO `vico`.`linea` (`idlinea`, `nombre`, `tipo_transporte`,`idsindicato`) VALUES ('$_REQUEST[codnombre]','$_REQUEST[nombre]' , '$_REQUEST[tipo_transporte]','$_REQUEST[sindicato]')") or die("Problemas en el select".mysqli_error($conexion));
$tramos=$_REQUEST["cod_tramos"];
for ($i=0;$i<count($tramos);$i++){
    mysqli_query($conexion, "INSERT INTO `vico`.`contiene` (`idlinea`, `idtramo`, `orden`) VALUES ('$_REQUEST[codnombre]', '$tramos[$i]', '$i');") or die("Problemas en el select".mysqli_error($conexion));
}
mysqli_close($conexion);
header('Location: crear ruta.php');
?>
