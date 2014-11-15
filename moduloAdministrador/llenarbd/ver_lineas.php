<!DOCTYPE html>

<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script type="text/javascript" src="accionenlaces.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="codigoverlineas.js"></script>

</head>
<body>

<?php
require 'barrasuperior.php';
require 'panelizquierdo.php';
?>

<div id="mapa" style="float:left;width:60%;height:90%;"></div>

<div id = "panel" style = "float:left;width:30%;height:90%;">
    <form>
        <fieldset>
            <legend>Desplegar Lineas:</legend>
            <?php
                require_once 'archivodeconexion.php';
                $conexion = obtenerconexion();
                $query = "select idlinea, nombre, idsindicato from linea";
                $registros = mysqli_query($conexion, $query) or die("Error en la consulta sql: ". mysqli_error($conexion));
                echo "<select id='selectlinea'  style='width:100%;' >";
                while ($fila = mysqli_fetch_array($registros)) {
                    echo "<option value='".$fila['idlinea']."'>".$fila['nombre']." (Sindicato : ". $fila['idsindicato'] .") ".'</option>';
                }
                echo '</select>';
                mysqli_close($conexion);
            ?>
            <div id="salidas">Aqui van las respuestas del server</div>
        </fieldset>
    </form>
</div>

</body>
</html>
