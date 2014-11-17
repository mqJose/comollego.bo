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
    <script type="text/javascript" src="js/vendor/jquery.js"></script>
    <script type="text/javascript" src="js/codigoverlineas.js"></script>

</head>
<?php
?>
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
                                <form role="form">
                                    <?php
                                        require_once 'archivodeconexion.php';
                                        $conexion = obtenerconexion();
                                        $query = "select idlinea, nombre, idsindicato from linea";
                                        $registros = mysqli_query($conexion, $query) or die("Error en la consulta sql: ". mysqli_error($conexion));
                                        echo "<select multiple id='selectlinea' class='form-control'>";
                                        while ($fila = mysqli_fetch_array($registros)) {
                                            echo "<option value='".$fila['idlinea']."'>".$fila['nombre']." (Sindicato : ". $fila['idsindicato'] .") ".'</option>';
                                        }
                                        echo '</select>';
                                        mysqli_close($conexion);
                                    ?>
                                    <p>Recorrido:</p>
                                    <div id="listadetramos">
                                        <select multiple id='selecttramos' class="form-control">
                                        </select>
                                    </div>
                                </form>                       
                                <br>
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
