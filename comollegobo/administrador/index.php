<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adicionar nuevas lineas</title>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script type="text/javascript">
        <?php
        $con = mysqli_connect("localhost", "root", "superusuario", "comollego") or die("Problemas con la conexion a la base de datos");
        $registros = mysqli_query($con, "select * from parada") or die("Error en la consulta sql: ". mysqli_error($con));
        $cantidaddepuntos = 0;

        while ($reg = mysqli_fetch_array($registros)) {
            $id[$cantidaddepuntos] = $reg['idparada'];
            $lat[$cantidaddepuntos] = $reg['latitud'];
            $lng[$cantidaddepuntos] = $reg['longitud'];
            $cantidaddepuntos++;
        }
        ?>
        var puntos =  [<?php
        for($i = 0; $i < $cantidaddepuntos; $i++) {
            if ($i != 0)
                echo ",\n";
            echo "new google.maps.LatLng($lat[$i], $lng[$i])";
        }
        ?>];
        var id = [<?php
        for($i = 0; $i < $cantidaddepuntos; $i++) {
            if ($i != 0)
            echo ", ";
            echo "$id[$i]";
        }
        ?>];
    </script>
</head>
<body>

</body>
</html>