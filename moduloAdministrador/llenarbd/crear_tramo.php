<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script type="text/javascript" src="accionenlaces.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry"></script>
    <script type="text/javascript" src="codigo - tramo.js"></script>
    <script>
        /*************Aqui obtenemos todas las paradas de la base de datos *********/
            <?php
            include_once 'archivodeconexion.php';
            $con = obtenerconexion();

            $registros = mysqli_query($con, "select * from parada") or die("Error en la consulta sql: ". mysqli_error($con));
            $cantidaddepuntos = 0;

            while ($reg = mysqli_fetch_array($registros)) {
                
                $lat[$cantidaddepuntos] = $reg['latitud'];
                $lng[$cantidaddepuntos] = $reg['longitud'];
                $id[$cantidaddepuntos] = $reg['idparada'];
                $cantidaddepuntos++;
            }
            $registros = mysqli_query($con, "select * from punto") or die("Error en la consulta sql: ". mysqli_error($con));
            $nropuntos = 0;

            while ($reg = mysqli_fetch_array($registros)) {
                $nropuntos++;
            }
            ?>
        var nropuntos=<?php echo $nropuntos;?>;//en esta   variable se guarda la cantidad de puntos
        var paradas =  [<?php
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
            echo "\"$id[$i]\"";
        }
        ?>];
        <?php
            
            $reggg = mysqli_query($con, "SELECT SUM( s.n ) as nro FROM (SELECT idtramo, COUNT( * ) AS n FROM  `tramo` GROUP BY idtramo)s") or die("Error en la consulta sql: ". mysqli_error($con));
            while ($rexx = mysqli_fetch_array($reggg)) {
                $nro = $rexx['nro'];
            }
            $nro++;
        ?>
        var idtramo=""+<?php echo $nro;?>;
        /*************Aqui obtenemos todas las paradas de la base de datos   en puntos  y  id *********/
        function guarda_tramo() {
            alert("la  el tramo ya fue guardado ya fue guardada  en nuesta base de datos");
        }
    </script>
</head>
<body>
<div id="logo" style="float:top;width:100%;height:10%;"><img src="img/logo.jpg" width="100%" height="100%"></div>
<div id="panel" style="float:left;width:10%;height:90%;">
    <table>
        <tr>
            <td></td>
            <td><strong><input type="button" onclick="inicio()" value="INICIO" style='width:140px; height:25px'></strong></td>
        </tr>
        <tr>
            <td></td>
            <td><strong><input type="button" onclick="crear_tramo()" value="CREAR TRAMO" style='width:140px; height:25px'></strong></td>
        </tr>
        <tr>
            <td></td>
            <td><strong><input type="button" onclick="crear_ruta()" value="CREAR RUTA" style='width:140px; height:25px'></strong></td>
        </tr>

        <tr>
            <td ></td>
            <td><strong><input type="button" onclick="crear_sindicato()" value="CREAR SINDICATO" style='width:140px; height:25px'></strong></td>
        </tr>

        <tr>
            <td ></td>
            <td><strong><input type="button" onclick="ayuda()" value="AYUDA" style='width:140px; height:25px'></strong></td>
        </tr>
    </table>

</div>

<div id="mapa" style="float:left;width:60%;height:90%;"></div>
<div id="panel" style="float:left;width:30%;height:90%;">
    <form action="recibir tramo.php" method="post">
        <fieldset>
            <legend>datos de nuevo tramo</legend>
            <b>
                <label  style="width: 55%;float: left;">codtramo : <?php echo $nro; ?></label>
                <br>
                <label >Referencia: </label>
                <input type="text" name="referencia" id="referencia" required>

                <input type="hidden" name="id_tramo" id="id_tramo"value=<?php echo $nro; ?>>
                <b>
                    <div id="panel_de_paradas" style="float:left;width:100%;height:70%;"></div>
        </fieldset>
        <P>
            <INPUT type="submit" onclick="guarda_tramo();"value="Guardar Tramo" >
    </form>
</div>

</body>
</html>
