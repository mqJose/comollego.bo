<?php
$idtramo = $_REQUEST['idtramo'];
require_once 'archivodeconexion.php';
require_once 'utilidades.php';
$con = obtenerconexion();
$query = "select idlinea from contiene where idtramo like ".$idtramo;
$registros = mysqli_query($con, $query) or die("Problemas en la consulta:".mysqli_error($con));
while ($fila = mysqli_fetch_array($registros)) {
    $ans[] = $fila['idlinea'];
}
$ans = sinRepetidos($ans);
echo json_encode($ans);
mysqli_close($con);
?>