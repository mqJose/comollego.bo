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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">ComoLlego.bo - Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Administrador 1</strong>
                                    <span class="pull-right text-muted">
                                        <em>Ayer</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Administrador 1</strong>
                                    <span class="pull-right text-muted">
                                        <em>Ayer</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Administrador 1</strong>
                                    <span class="pull-right text-muted">
                                        <em>Ayer</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Leer Todos los Mensajes</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tarea 1</strong>
                                        <span class="pull-right text-muted">40% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Completo (Procesado)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tarea 2</strong>
                                        <span class="pull-right text-muted">20% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Completo</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tarea 3</strong>
                                        <span class="pull-right text-muted">60% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Completo (Precaucion)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tarea 4</strong>
                                        <span class="pull-right text-muted">80% Completo</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Completo (Peligro)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Todas las Tareas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> Nuevo Comentario
                                    <span class="pull-right text-muted small">4 minutos ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 Nuevo Followers
                                    <span class="pull-right text-muted small">12 minutos ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Mensajes Enviados
                                    <span class="pull-right text-muted small">4 minutos ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> Nueva Tarea
                                    <span class="pull-right text-muted small">4 minutos ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Reiniciar Servicio
                                    <span class="pull-right text-muted small">4 minutos ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Todas las Alertas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Sindicato<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">                              
                                <li>
                                    <a href="crear-sindicato.php">Crear Sindicato</a>
                                </li>
                                <li>
                                    <a href="">Eliminar Sindicato</a>
                                </li>
                                <li>
                                    <a href="#">Modificar Sindicato</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="active" href="#"><i class="fa fa-edit fa-fw"></i> Linea<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="active" href="crear-ruta.php"> Crear Ruta</a>
                                </li>
                                <li>
                                    <a href="#"> Eliminar Ruta</a>
                                </li>
                                <li>
                                    <a href="#"> Modificar Ruta</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Tramo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="crear-tramo.php"> Crear Tramo</a>
                                </li>
                                <li>
                                    <a href="#"> Eliminar Tramo</a>
                                </li>
                                <li>
                                    <a href="#"> Modificar Tramo</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="ayuda.php"><i class="fa fa-dashboard fa-fw"></i> Ayuda</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Datos de Nueva Ruta</h3>
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
                                        <select onChange="seleccionado(this,0)" id="selecttramo">
                                        <?php
                                            /**/
                                            for ($i = 0, $tam = count($idtramo); $i < $tam; $i++) {
                                                echo "<option value='".$idtramo[$i]."'>Tramo ".$idtramo[$i]." ". $referenciatramo[$i]. "</option>";
                                            }
                                        ?>
                                        </select>
                                        <p class="help-block">En caso de no encontrar el Tramo, Adicione otro Tramo</p>
                                    </div>
                                    <button class="btn btn-primary" type="button" onclick="pasar_tramo_a_div()" value="Adicionar Tramo en Ruta">Adicionar Tramo en Ruta</button>
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
