<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script type="text/javascript" >
        function inicio(){
            setTimeout("location.href='index.php'", 50);
        }
        function crear_tramo(){
            setTimeout("location.href='crear_tramo.php'", 50);
        }
        function crear_ruta(){
            setTimeout("location.href='crear ruta.php'", 50);
        }
        function crear_sindicato(){
            setTimeout("location.href='crear sindicato.php'", 50);
        }
        function ayuda(){
            setTimeout("location.href='ayuda.php'", 50);
        }
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry"></script>
     <script type="text/javascript" src="codigo.js"></script>
     <script>
        /*************Aqui obtenemos todas las paradas de la base de datos *********/
            <?php
                $con = mysqli_connect("localhost", "root", "123456", "vico") or die("Problemas con la conexion a la base de datos");
                $registros = mysqli_query($con, "select * from parada") or die("Error en la consulta sql: ". mysqli_error($con));
                $cantidaddepuntos = 0;
                while ($reg = mysqli_fetch_array($registros)) {
                    
                    $lat[$cantidaddepuntos] = $reg['latitud'];
                    $lng[$cantidaddepuntos] = $reg['longitud'];
                    $id[$cantidaddepuntos] = $reg['idparada'];
                    $cantidaddepuntos++;
                }

                //  obtenemos  los tramos
                //cantidad de  tramos en $c_tramo
                //ahora obtenemos datos de tiene
                //cantidad de tiene   en $c_tiene
                $c_tiene=0;
                $registros_ti = mysqli_query($con, "select * from tiene") or die("Error en la consulta sql: ". mysqli_error($con));
                while ($regis = mysqli_fetch_array($registros_ti)) {                    
                    $idtramo[$c_tiene] = $regis['idtramo'];
                    $idparada[$c_tiene] = $regis['idparada'];
                    $trazo[$c_tiene] = $regis['trazo'];
                    $c_tiene++;
                }
            ?>
        /*************Aqui obtenemos todas las paradas de la base de datos *********/
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
                echo "\"$id[$i]\"";
            }
        ?>];
        //ahora obtenemos los valores de tiene
        var idtramo_tiene = [<?php
            for($i = 0; $i < $c_tiene; $i++) {
                if ($i != 0)
                    echo ", ";
                echo "'$idtramo[$i]'";
            }
        ?>];
        var idparada = [<?php
            for($i = 0; $i < $c_tiene; $i++) {
                if ($i != 0)
                    echo ", ";
                echo "'$idparada[$i]'";
            }
        ?>];
        var trazo_t = [<?php
            for($i = 0; $i < $c_tiene; $i++) {
                if ($i != 0)
                    echo ", ";
                echo "'$trazo[$i]'";
            }
        ?>];
        function guarda_ruta() {
            console.log(tramo);
            alert("la  Ruta ya fue guardada  en nuesta base de datos");
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
             <form action="recibir ruta.php" method="post">
                 <fieldset>
                    <legend>Datos de nuevo sindicato</legend>
                    <label  style="width: 15%;float: left;">Nombre :</label>
                    <input type="text" style="width: 25%;float: left;"name="nombre" id="nombre" ><i>   (introdusca el codigo de la linea por <br> ejemplos 398,linea roja-z,663) </i>
                     <?php
                    $co = mysqli_connect("localhost", "root", "123456", "vico") or die("Problemas con la conexion a la base de datos");
                    $reggg = mysqli_query($co, "SELECT SUM( s.n ) as nro FROM (SELECT idlinea, COUNT( * ) AS n FROM  `linea` GROUP BY idlinea)s") or die("Error en la consulta sql: ". mysqli_error($co));
                    

                    while ($rexx = mysqli_fetch_array($reggg)) {
                        $nro = $rexx['nro'];
                        
                    }
                    $nro++;
                    ?>
                    <input type="hidden" name="codnombre" id="codnombre"value=<?php echo $nro; ?>>
                    <p>
                    <label  style="width: 15%;float: left;">tipo</label>
                    <select id="tipo" name="tipo_transporte" style="width: 25%;float: left;"onclick="actualiza();">
                        <option value="Bus">Bus</option>
                        <option value="Micro">Micro</option>
                        <option value="Minibus">Minibus</option>
                        <option value="Teleferico">Teleferico</option>
                    </select><i>(introdusca el tipo de trasporte al que<br>pertenese el trasporte) </i>
                    <p>
                    <label style="width: 15%;float: left;">sindicato </label>
                    <SELECT  name="sindicato" style="width: 25%;float: left;" id="sindicato" >
                       <?php
                        $con = mysqli_connect("localhost", "root", "123456", "vico") or die("Problemas con la conexion a la base de datos");
                        $registros = mysqli_query($con, "SELECT nombre ,idsindicato FROM `sindicato` order by nombre asc") or die("Error en la consulta sql: ". mysqli_error($con));
                        $cantidaddepuntos = 0;
                        while ($reg = mysqli_fetch_array($registros)) {
                            
                            $nombre[$cantidaddepuntos] = $reg['nombre'];
                            $codigo[$cantidaddepuntos] = $reg['idsindicato'];
                            $cantidaddepuntos++;
                        }
                        echo "cantida de puntos   =".$cantidadepuntos;
                        for($i = 0; $i < $cantidaddepuntos; $i++) {
                            echo "<option value='$codigo[$i]'>$nombre[$i]</option>";
                        }
                        ?>

                    </SELECT> <i>(si no encuentra el sindicato adecuado<br>tiene que crear un nuevo sindicado ) </i>
                    <b>
                    <label style="width: 100%;float: left;">lista de tramos que  usted puede usar en la creacion de  su ruta </label>
                    <b>
                    <SELECT    style="width: 100%;float: left;"  onChange="seleccionado(this,0)">
                       <?php
                            $con = mysqli_connect("localhost", "root", "123456", "vico") or die("Problemas con la conexion a la base de datos");
                            $registros = mysqli_query($con, "SELECT idtramo  FROM `tramo` ") or die("Error en la consulta sql: ". mysqli_error($con));
                            $cantidaddepuntos = 0;
                            while ($reg = mysqli_fetch_array($registros)) {
                                
                                $id_t[$cantidaddepuntos] = $reg['idtramo'];
                                $cantidaddepuntos++;
                            }
                            for($i = 0; $i < $cantidaddepuntos; $i++) {
                                echo "<option value='$id_t[$i]'>tramo    ".$id_t[$i]."</option>";
                            }
                        ?>
                    </select>
                    <div id="prueva" >  </div>
                    <i>(si no encuentra el tramo necesario para su ruta puede crear un nuevo tramo ) </i>
                    <b>
                    <div id="panel_de_paradas" style="float:left;width:100%;height:70%;"></div>
                </fieldset>
                <P>
                <INPUT type="submit" onclick="guarda_ruta();"value="Enviar" ><INPUT type="reset">
            </form>
        </div>
    
</body>
</html>
