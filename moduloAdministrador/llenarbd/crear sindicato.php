<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script type="text/javascript" src="accionenlaces.js"></script>
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
    <div id="panel" style="float:left;width:90%;height:90%;">
        <form action="recibir sindicato.php" method="get">
             <fieldset>
                <legend>Datos de nuevo sindicato</legend>
                <label  style="width: 15%;float: left;">Nombre :</label>
                <input type="text" style="width: 25%;float: left;"name="nombre" id="nombre" ><i>   (introdusca  el nombre del sindicato ejemplo simon bolivar, exposur) </i>
                <?php
                    require_once 'archivodeconexion.php';
                    $co = obtenerconexion();

                    $reggg = mysqli_query($co, "SELECT SUM( s.n ) as nro FROM (SELECT idsindicato, COUNT( * ) AS n FROM  `sindicato` GROUP BY idsindicato)s") or die("Error en la consulta sql: ". mysqli_error($co));
                    

                    while ($rexx = mysqli_fetch_array($reggg)) {
                        
                        $nro = $rexx['nro'];
                        
                    }
                    $nro++;
                ?>
                <input type="hidden" name="idsindicato" id="idsindicato"value=<?php echo $nro; ?>>
                <p>
                <label  style="width: 15%;float: left;">Direccion :</label>
                <input type="text" style="width: 25%;float: left;"name="direccion" id="direccion" ><i>   (introdusca  una direccion detallada del donde se encuentra  las oficinas <br>ejemplo calle aguilar nro 23 zona 16 de julio el alto) </i>
                <p>
                <label  style="width: 15%;float: left;">Telefono :</label>
                <input type="text" style="width: 25%;float: left;"name="telefono" id="telefono" ><i>   (introdusca los numeros de referencia separados por comas ejemplo. <br>(76543210,1234567) en casod e no tener estos datos  deje el espacio vacio ) </i>
            </fieldset>
            <P>
            <INPUT type="submit" value="Guardar" ><INPUT type="reset">
                <p>
                <i>lista de sindicatos que actualmente estan en nuestra  base de datos</i>
                <?php
                require_once 'archivodeconexion.php';

                $con = obtenerconexion();
                $registros = mysqli_query($con, "SELECT * FROM `sindicato` order by idsindicato asc") or die("Error en la consulta sql: ". mysqli_error($con));
                $cantidaddepuntos = 0;
                while ($reg = mysqli_fetch_array($registros)) {
                    
                    $ids[$cantidaddepuntos] = $reg['idsindicato'];
                    $nombres[$cantidaddepuntos] = $reg['nombre'];
                    $direccions[$cantidaddepuntos] = $reg['direccion'];
                    $telefonos[$cantidaddepuntos] = $reg['telefono'];
                    $cantidaddepuntos++;
                }
                echo "<table border =1px style='width: 100%;'>";
                echo "<tr> <td><i>codigo</i></td> <td><i>nombre</i></td> <td><i>direccion</i></td> <td><i>telefono</i></td> </tr>";
                for($i = 0; $i < $cantidaddepuntos; $i++) {
                    echo "<tr><td>".$ids[$i]."</td><td>".$nombres[$i]."</td><td>".$direccions[$i]."</td><td>".$telefonos[$i]."</td></tr>";
                }
                echo "</table>";
                ?>
        </form>
    </div>
</body>
</html>
