<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador</title>

    <link rel="icon" type="image/png" href="img/maps.png"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        html, body, #mapa {
            height: 100%;
            margin: 0px;
            padding: 0px;
        }
        #mapa{
            height: 30em;
        }
    </style>

    <script type="text/javascript" src="js/nav.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry"></script>
    <script type="text/javascript" src="js/codigo.js"></script>
    <script>
        /*************Aqui obtenemos todas las paradas de la base de datos *********/
    var polilynes=[];
    var paradas=[];
    <?php
        require_once 'archivodeconexion.php';
        $con = obtenerconexion();

        $c_tiene = 0;
        $registros_ti = mysqli_query($con, "select * from tramo") or die("Error en la consulta sql: ". mysqli_error($con));
        while ($regis = mysqli_fetch_array($registros_ti)) {
            $idtramo[$c_tiene] = $regis['idtramo'];
            $referenciatramo[$c_tiene] = $regis['referencia'];
            $c_tiene++;
        }

        //aahora sacamos  el polilyne de cada tramo
        //tendremos polilynes[tramo][pos]
        for($i = 0; $i <= $c_tiene; $i++){
            echo "polilynes[".$i."]=[";
            $registros_ti = mysqli_query($con, "SELECT p.latitud ,p.longitud  FROM formado_por fp, punto p WHERE fp.idtramo LIKE  '".$i."' AND fp.idpunto LIKE p.idpunto ") or die("Error en la consulta sql: ". mysqli_error($con));
            $o=0;
            while($regis = mysqli_fetch_array($registros_ti)){
                if ($o != 0)
                    echo ", ";
                echo "new google.maps.LatLng(".$regis['latitud'].", ".$regis['longitud'].")";
                $o++;
            }
            echo "];\n";
        }
    ?>
    var idtramo_tiene = [<?php
        for($i = 0; $i < $c_tiene; $i++) {
            if ($i != 0)
                echo ", ";
            echo "'$idtramo[$i]'";
        }
    ?>];
        //ahora tratamos de sacar las paradas de cada tramo
        /*
         SELECT p.latitud, p.longitud FROM tiene t, parada p WHERE t.idtramo LIKE  '2' AND t.idparada LIKE p.idparada
         */
    <?php
        for($i=0;$i<$c_tiene;$i++){
            echo "paradas[".$i."]=[";
            $registros_ti = mysqli_query($con, "SELECT p.latitud, p.longitud FROM tiene t, parada p WHERE t.idtramo LIKE  '".$idtramo[$i]."' AND t.idparada LIKE p.idparada") or die("Error en la consulta sql: ". mysqli_error($con));
            $o=0;
            while($regis = mysqli_fetch_array($registros_ti)){
                if ($o != 0)
                    echo ", ";
                echo "new google.maps.LatLng(".$regis['latitud'].", ".$regis['longitud'].")";
                $o++;
            }
            echo "];\n";
        }
    ?>
    </script>
</head>
<body>
    <div id="wrapper">
        <!-- Navegacion -->
<?php
require 'navegacion.php';
?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">Datos de Nueva Ruta</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Contend de Funcionalidad-->
                        <div class="container-fluid">
                            <div class="row" id="panel">
                                <form action="recibir-ruta.php" method="post" role="form">
                                    <div class="form-group">
                                        <label >Nombre: </label>
                                        <input class="form-control" id="referencia" name="nombre" type="text" placeholder="Ingrese Nombre">
                                        <p class="help-block">Ejemplos 398,linea roja, Z</p>
                                    </div>
                                    <?php
                                    require_once 'archivodeconexion.php';
                                    $co = obtenerconexion();
                                    $reggg = mysqli_query($co, "SELECT SUM( s.n ) as nro FROM (SELECT idlinea, COUNT( * ) AS n FROM  `linea` GROUP BY idlinea)s") or die("Error en la consulta sql: ". mysqli_error($co));

                                    while ($rexx = mysqli_fetch_array($reggg)) {
                                        $nro = $rexx['nro'];
                                    }
                                    $nro++;
                                    ?>
                                    <input type="hidden" name="codnombre" id="codnombre"value=<?php echo $nro; ?>>

                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select id="tipo" name="tipo_transporte" class="form-control">
                                            <option value="Bus">Bus</option>
                                            <option value="Micro">Micro</option>
                                            <option value="Minibus">Minibus</option>
                                            <option value="Teleferico">Teleferico</option>
                                        </select>
                                        <p class="help-block">Introdusca el Tipo de Trasporte </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Sindicato </label>
                                        <select  name="sindicato" id="sindicato" class="form-control">
                                            <?php
                                            require_once 'archivodeconexion.php';
                                            $con = obtenerconexion();

                                            $registros = mysqli_query($con, "SELECT nombre ,idsindicato FROM `sindicato` order by nombre asc") or die("Error en la consulta sql: ". mysqli_error($con));
                                            $cantidaddepuntos = 0;
                                            while ($reg = mysqli_fetch_array($registros)) {

                                                $nombre[$cantidaddepuntos] = $reg['nombre'];
                                                $codigo[$cantidaddepuntos] = $reg['idsindicato'];
                                                $cantidaddepuntos++;
                                            }
                                            echo "cantida de puntos   =".$cantidadepuntos;
                                            for($i = 0; $i < $cantidaddepuntos; $i++) {
                                                echo "<option value='".$codigo[$i]."'>".$nombre[$i]."</option>";
                                            }
                                            ?>
                                        </select>
                                        <p class="help-block">En caso de no encontrar el sindicato, Adicione otro Sindicato</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Lista de Tramos para Ruta </label>
                                        <select onChange="seleccionado(this,0)" id="selecttramo" class="form-control">
                                        <?php
                                            /**/
                                            for ($i = 0, $tam = count($idtramo); $i < $tam; $i++) {
                                                echo "<option value='".$idtramo[$i]."'>Tramo ".$idtramo[$i]." ". $referenciatramo[$i]. "</option>";
                                            }
                                        ?>
                                        </select>
                                        <p class="help-block">En caso de no encontrar el Tramo, Adicione otro Tramo</p>
                                    </div>
                                    <button class="btn btn-warning" type="button" onclick="pasar_tramo_a_div()" value="Adicionar Tramo en Ruta">Adicionar Tramo en Ruta</button>
                                    <button type="submit" value="Enviar" class="btn btn-primary">Enviar</button>
                                </form>
                                <br>
                            </div>
                            
                        </div>
                        <div class="container-fluid">
                            <div class=" row panel panel-info">
                                <div class="panel-heading">Panel #Tramos</div>
                                <div class="panel-body" id="panel_cod_tramos"></div>
                            </div>                        
                        </div>
                        <!-- / Contend de Funcionalidad-->
                    </div>
                    <div id="mapa" class="col-lg-8"></div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/vendor/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/vendor/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
