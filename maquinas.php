<?php
	/**
	 * Archivo para el control acciones en el módulo de sucursales
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
		$sql = "INSERT INTO maquina(nombre, modelo, sucursal) VALUES('$nombre', '$modelo', '$sucursal')";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_maquinas.php");
		exit;
	}
	// Comprueba la existencia de una peticion post que corresponda al nombre guardar_edicion
	if(isset($_POST['guardar_edicion'])){
		// Extraemos el contenido de la variable $_POST en variables independientes
		extract($_POST);
		$sql = "UPDATE maquina SET nombre ='$nombre', modelo = '$modelo', sucursal = '$sucursal' WHERE id_maquina = $maquina_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_maquinas.php");
		exit;
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre editar_marca_id
	if(isset($_GET['editar_maquina_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "SELECT * FROM maquina WHERE id_maquina = $editar_maquina_id";
		$resultado = mysql_query($sql, $conexion);
		$maquina = mysql_fetch_assoc($resultado);
		include('editar_maquina.php');
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre eliminar_marca_id
	if(isset($_GET['eliminar_maquina_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "DELETE FROM maquina WHERE id_maquina = $eliminar_maquina_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_maquinas.php");
		else
			echo "ERROR";
		exit;
	}

	function pr($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}