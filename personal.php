<?php
	/**
	 * Archivo para el control acciones en el módulo de personal
	 * acciones como guardar, eliminar y editar
	**/
	// Definimos los datos del servidor y base de datos para establecer conexión con MySQL
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$bd = 'tablero';
	// Ejecutamos conexión con MySQL
	$conexion = @mysql_connect($host, $user, $password);
	// Seleccionamos la base de datos que utilizaremos
	@mysql_select_db($bd, $conexion);
	// Comprueba la existencia de una peticion post que corresponda al nombre guardar_nuevo
	if(isset($_POST['guardar_nuevo'])){
		// Extraemos el contenido de la variable $_POST en variables independientes
		extract($_POST);
		$sql = "INSERT INTO personal(Nombre, departamento, correo) VALUES('$nombre', '$departamento_id', '$correo')";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_personal.php");
		else 
			echo '<script language="javascript">
        alert("Intentalo de nuevo, correo o nombre del personal ya existen.")
        window.location.href="index_personal.php";
          </script>';
		exit;
	}
	// Comprueba la existencia de una peticion post que corresponda al nombre guardar_edicion
	if(isset($_POST['guardar_edicion'])){
		// Extraemos el contenido de la variable $_POST en variables independientes
		extract($_POST);
		$sql = "UPDATE personal SET Nombre ='$nombre', departamento = '$departamento_id', correo = '$correo' WHERE id_personal = $personal_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_personal.php");
		exit;
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre editar_marca_id
	if(isset($_GET['editar_personal_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "SELECT * FROM personal WHERE id_personal = $editar_personal_id";
		$resultado = mysql_query($sql, $conexion);
		$personal = mysql_fetch_assoc($resultado);
		include('editar_personal.php');
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre eliminar_marca_id
	if(isset($_GET['eliminar_personal_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "DELETE FROM personal WHERE id_personal = $eliminar_personal_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_personal.php");
		else
			echo "ERROR";
		exit;
	}

	function pr($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}