<?php
$idlinea= $_REQUEST['idlinea'];
if (!$idlinea) exit;
require_once 'archivodeconexion.php';

$con = obtenerconexion();

$query = "select tramo.idtramo, referencia
from contiene, tramo
where contiene.idtramo like tramo.idtramo
and idlinea like $idlinea order by orden";

$registros = mysqli_query($con, $query) or die("Problemas con la query : ".mysqli_error($con));
while ($fila = mysqli_fetch_array($registros)) {
    $tmp['idtramo'] = $fila['idtramo'];
    $tmp['referencia'] = $fila['referencia'];
    $ans[] = $tmp;
}
if ($ans)//Si no esta vacio
    echo json_encode($ans);

?>