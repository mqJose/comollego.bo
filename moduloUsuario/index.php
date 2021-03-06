<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Cómollego.bo</title>

    <link rel="icon" type="image/png" href="img/maps.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        html, body,section, .mapa{
            height: 98%;
        }
        .mapa{
            padding-top: 20px;
        } 
        
    </style>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>
    <script type="text/javascript" src="codigo.js"></script>
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
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <aside class="contenedor-lateral col-xs-12 col-sm-12 col-md-4 col-lg-3 ">
    </br>
    <div class="btn-group btn-group-lg contenedor">
        <button type="button" class="btn btn-default" onclick="tipo_transporte='PUBLICO'; actualiza_div_oculto();console.log(tipo_transporte)" title="TRANSPORTE PUBLICO">
            <img src="img/img3.png" >
        </button>

        <button type="button" class="btn btn-default" onclick="tipo_transporte='WALKING'; actualiza_div_oculto();console.log(tipo_transporte)" title="A PIE">
            <img src="img/img1.png">
        </button>

        <button type="button" class="btn btn-default" onclick="tipo_transporte='DRIVING'; actualiza_div_oculto();console.log(tipo_transporte)" title="TRANSPORTE PRIVADO">
            <img src="img/img4.png">
        </button>


    </div>
    <div class="contend col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="height: 31em">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" role="form" action="listarrutas.php" method="get">
                <br>
                <div class="form-group">
                    <label class="col-xs-2 col-sm-2 col-md-3 col-lg-3 control-label" for="inicio">
                        <img src="img/start.png">
                    </label>
                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                        <input type="text" class="form-control" id="inicio" onClick="mm(0)" placeholder="Desde" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 col-sm-2 col-md-3 col-lg-3 control-label" for="final">
                        <img src="img/end.png">
                    </label>
                    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                        <input type="text" class="form-control" id="final" onClick="mm(1)" placeholder="Hasta" required>
                    </div>
                </div>
                <div class="btn-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="submit" class="btn btn-primary btn-block" value="Buscar">
                </div>
                <div id="oculto" style='display:none'></div>
            </form>
        </div>
    </div>

</aside>
<section class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
    <!--Ingresar en este contenedor el mapa de la aplicacion-->



    <div id="mapa" style="height: 41em"></div>
    <!--end Mapa-->
</section>
<footer class="pie navbar navbar-fixed-bottom bs-docs-nav">
    <p>Derechos reservados de Grupo 8 de INF-281</p>      
</footer>

<script>window.jQuery || document.write('<script src="js/vendor/jquery.js"><\/script>')</script>
<script type="text/javascript" src="js/vendor/bootstrap.js"></script>
<script src="js/main.js"></script>       
</body>
</html>