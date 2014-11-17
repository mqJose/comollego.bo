<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Cómollego.bo</title>

    <link rel="icon" type="image/png" href="img/maps.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script type="text/javascript" src="js/jquery.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=geometry"></script>
    <script type="text/javascript">
        var lat_i;
        var lng_i;
        var lat_f;
        var lng_f;
        var transporte;
        var linea;
        var parada=[];
        var tiene;
        <?php
            $tipo = $_REQUEST['tipo_transporte'];
            echo "transporte='".$tipo ."';";
            $inicio=$_REQUEST["inicio"];
            echo "lat_i=".$inicio[0] .";";
            echo "lng_i=".$inicio[1] .";";
            $final=$_REQUEST["final"];
            echo "lat_f=".$final[0] .";";
            echo "lng_f=".$final[1] .";";
            $dir=$_REQUEST["direccion"];
            echo "direccion_i='".$dir[0]."';\n";
            echo "direccion_f='".$dir[1]."';\n";
        ?>
        if(!(transporte === 'WALKING') &&  distancia_de_dos_LatLngs(new google.maps.LatLng(lat_i, lng_i),new google.maps.LatLng(lat_f, lng_f)) < 200){
            if(confirm("La distancia a su destino es menor a 200 mts. \n ¿Desea calcular los pasos para llegar a pie?")) {
                transporte = 'WALKING';

            }
        }
        function distancia_de_dos_LatLngs(a,b){
            return google.maps.geometry.spherical.computeDistanceBetween(a,b);
        }
    </script>
    <script type="text/javascript" src="codigo  lista de rutas.js"></script>
</head>
<body>
<header role="navigation" class="navbar navbar-fixed-top bs-docs-nav">
    <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <nav class="navbar navbar-inverse encabezado">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".minavbar">
                        <span class="sr-only">Navegacion</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand space"><img src="img/logo7.1-mini.png" alt="Cómollego.bo"></a>
                    <div class="collapse navbar-collapse minavbar col-sm-5 col-md-5 col-lg-5" role="navigation">
                        <ul class="nav navbar-nav">
                            <li><a href="#"></a></li>
                            <li><a href="#">Denuncias</a></li>
                            <li><a href="#">Servicios</a></li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Elementos<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Sindicatos</a></li>
                                    <li><a href="#">Lineas</a></li>
                                    <li><a href="#">Rutas</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Buscar">
                            </div>
                            <button type="submit" class="btn btn-info"><img src="img/buscar.png"></button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<aside class="contenedor-lateral col-xs-12 col-sm-12 col-md-4 col-lg-3 ">


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 infor">
        <div class="container-fluid">
            <div class="row">
                <br>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos de la consulta</h3>
                    </div>
                    <div class="panel-body">
                        <label  style="width: 20%;float: left;">Inicio:</label>
                        <label  style="width: 77%;float: left;"><?php  echo $dir[0]; ?></label>
                        <br>
                        <label  style="width: 20%;float: left;">Final:</label>
                        <label  style="width: 77%;float: left;"><?php  echo $dir[1]; ?></label>
                        <br>
                        <label  style="width: 20%;float: left;">Tipo:</label>
                        <label  style="width: 77%;float: left;"><?php  if($tipo=='WALKING')echo "A PIE";
                            if($tipo=='PUBLICO')echo "TRANSPORTE PUBLICO";
                            if($tipo=='DRIVING')echo "MOVILIDAD PRIVADA"; ?></label>
                        <br>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Resultados</h3>
                    </div>
                    <div class="panel-body">
                        <div id="ruta">Cargando...</div>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div >
                        <div id="detallesdelaruta">Seleccione una ruta ...</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</aside>
<section class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
    <!--Ingresar en este contenedor el mapa de la aplicacion-->
    <div id="mapa" style="height: 35em"></div>
    <!--end Mapa-->
</section>
<footer class="pie ">
    <p>Derechos reservados de Grupo 8 de INF-281</p>
</footer>

<script>window.jQuery || document.write('<script src="js/vendor/jquery.js"><\/script>')</script>
<script type="text/javascript" src="js/vendor/bootstrap.js"></script>
<script src="js/main.js"></script>
</body>
</html>