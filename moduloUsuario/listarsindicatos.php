<?php
    require_once 'archivodeconexion.php';
    $con = obtenerconexion();
    $query = "SELECT * FROM sindicato";
    $registros = mysqli_query($con, $query) or die("Problemas en la consulta".mysqli_error($con));
    echo "<label>Sindicatos:</label>";
    while ($fila = mysqli_fetch_array($registros)) {
        echo "<pre class=\"btn-block\">".$fila['nombre']."</pre>";
    }
    mysqli_close($con);
?>