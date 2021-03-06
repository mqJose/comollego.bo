<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: comentario.php");
	}
	
	if ( !empty($_POST)) {

		$denuncianteError = null;
		$emailError = null;
		$contenidoError = null;
		$placa_automovilError = null;
		$idLineaError = null;
		

		$denunciante = $_POST['nombre'];
		$email = $_POST['email'];
		$contenido = $_POST['contenido'];

		$idLinea = $_POST['idLinea'];

		$valid = true;
		if (empty($denunciante)) {
			$denuncianteError = 'Ingrese su nombre';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Ingrese su Email';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'email invalido';
			$valid = false;
		}
		
		if (empty($contenido)) {
			$contenidoError = 'Ingrese el Contenido';
			$valid = false;
		}

		if (empty($idLinea)) {
			$idLineaError = 'Error en el idLinea';
			$valid = false;
		}
		
		// actualizacion de datos
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE comentario SET denunciante = ?, email = ?, contenido =?, idlinea = ? WHERE idcomentario = ?";
			//print($denunciante." -* ".$email." -* ".$contenido." -* ".$idLinea);
			$q = $pdo->prepare($sql);
			$q->execute(array($denunciante,$email,$contenido,$idLinea,$id));
			Database::disconnect();
			header("Location: comentario.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT denunciante, email, contenido, idlinea FROM comentario WHERE idcomentario = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$denunciante = $data['denunciante'];
		$email = $data['email'];
		$contenido = $data['contenido'];
		$idLinea = $data['idlinea'];
		Database::disconnect();
	}
	//update-comentario.php
?>
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
    <script type="text/javascript" src="js/nav.js"></script>
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
                            <a href="index.php"><i class="fa fa-play fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-play fa-fw"></i> Sindicato<span class="fa arrow"></span></a>
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
                            <a href="#"><i class="fa fa-play fa-fw"></i> Linea<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="crear-ruta.php"> Crear Linea</a>
                                </li>

                                <li>
                                    <a href="ver-lineas.php"> Ver Lineas</a>
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
                            <a href="#"><i class="fa fa-play fa-fw "></i> Tramo<span class="fa arrow"></span></a>
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
                            <a class="active" href="comentario.php"><i class="fa fa-play fa-fw"></i>Comentario</a>
                        </li>
                        <li>
                            <a href="ayuda.php"><i class="fa fa-support fa-fw"></i> Ayuda</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <!-- /.row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Editar Comentario</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    
                    <form class="form-horizontal" action="editar-comentario.php?id=<?php echo $id?>" method="post">
                        <div class="control-group <?php echo !empty($denuncianteError)?'error':'';?>">
                            <label>Nombre</label>
                            <div class="controls">
                            <input class="form-control" name="nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($denunciante)?$denunciante:'';?>">
                            <?php if (!empty($denuncianteError)): ?>
                                <span class="help-inline"><?php echo $denuncianteError;?></span>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                            <label class="control-label">Email </label>
                            <div class="controls">
                            <input class="form-control" name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                            <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                            </div>
                        </div>
                        <div class="control-group <?php echo !empty($contenidoError)?'error':'';?>">
                            <label class="control-label">Contenido </label>
                            <div class="controls">
                            <textarea class="form-control" name="contenido" placeholder="Contenido"><?php echo !empty($contenido)?$contenido:'';?></textarea>
                            <?php if (!empty($emailError)): ?>
                            <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                            </div>
                        </div>
                        <div class="control-group <?php echo !empty($idLineaError)?'error':'';?>">
                            <label class="control-label">Código Linea</label>
                            <div class="controls">
                            <input class="form-control" name="idLinea" type="text"  placeholder="Codigo Linea" value="<?php echo !empty($idLinea)?$idLinea:'';?>">
                            <?php if (!empty($idLineaError)): ?>
                            <span class="help-inline"><?php echo $idLineaError;?></span>
                            <?php endif;?>
                            </div>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <a class="btn btn-default" href="comentario.php">Atras</a>
                        </div>
                    </form>
                </div>
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
