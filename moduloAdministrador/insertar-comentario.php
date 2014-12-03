<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// variables de validacion en caso de error
		$denuncianteError = null;
		$emailError = null;
		$contenidoError = null;
		$placa_automovilError = null;
		$idLineaError = null;
		
		// captura de las variables post
		$denunciante = $_POST['nombre'];
		$email = $_POST['email'];
		$contenido = $_POST['contenido'];

		$idLinea = $_POST['idLinea'];

		print($denunciante." - ".$email." - ".$contenido." - ".$idLinea);
		
		// validacion de input
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
		
		// insert de datos
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO comentario (denunciante,email,contenido,idLinea) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($denunciante,$email,$contenido,$idLinea));
			Database::disconnect();
			header("Location: comentario.php");
		}
	}
?>