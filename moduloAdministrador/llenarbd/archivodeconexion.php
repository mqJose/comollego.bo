<?php
require_once 'config.php';
function obtenerconexion() {
    $conexionnueva = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Problemas con la conexion a la base de datos");
    return $conexionnueva;
}
