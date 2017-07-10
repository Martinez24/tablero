<?php
/** Controlador de acciones del modulo de Usuarios **/
$host = 'localhost';
$user = 'root';
$password = '';
$bd = 'tablero';
$conexion = @mysql_connect($host, $user, $password);
@mysql_select_db($bd, $conexion);
//Comprueba la existencia de una petición
//Guarda un usuario nuevo
if(isset($_POST['guardar_nuevo'])){
	extract($_POST);
	$fecha_creacion = date('Y-m-d');
	$fecha_modificacion = date('Y-m-d');
	$sql = "INSERT INTO usuario(nombre, email, tipo_usuario, password, fecha_creacion, fecha_modificacion, activo) VALUES('$nombre', '$email', '$tipo_usuario', sha1('$password'), '$fecha_creacion', '$fecha_modificacion', 1)";
	$resultado = mysql_query($sql, $conexion);
	if($resultado == 1)
		header("Location: index_usuarios.php");
	exit;
	}
if(isset($_POST['guardar_edicion'])){
		// Extraemos el contenido de la variable $_POST en variables independientes
		extract($_POST);
		$activo = isset($estatus) == TRUE ? TRUE : FALSE;
		$fecha_modificacion = date('Y-m-d');
		//Valida si hay cambio en el password para actualizarlo sí es necesario
		if($password != '')
			$sql = "UPDATE usuario SET nombre='$nombre', email='$email', tipo_usuario='$tipo_usuario', password=sha1('$password'), fecha_modificacion='$fecha_modificacion', activo='$activo' WHERE id_empleado = $usuario_id";
		else
			$sql = "UPDATE usuario SET nombre='$nombre', email='$email', tipo_usuario='$tipo_usuario', fecha_modificacion='$fecha_modificacion', activo='$activo' WHERE id_empleado = $usuario_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_usuarios.php");
		exit;
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre editar_usuario_id
	if(isset($_GET['editar_usuario_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "SELECT * FROM usuario WHERE id_empleado = $editar_usuario_id";
		$resultado = mysql_query($sql, $conexion);
		$usuario = mysql_fetch_assoc($resultado);
		include('editar_usuario.php');
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre eliminar_usuario_id
	if(isset($_GET['eliminar_usuario_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "DELETE FROM usuario WHERE id_empleado = $eliminar_usuario_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_usuarios.php");
		else
			echo "ERROR";
		exit;
	}

	function pr($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}