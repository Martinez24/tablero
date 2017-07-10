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
		$sql = "INSERT INTO sucursal(nombre, estado, ciudad, telefono, direccion) VALUES('$nombre', '$estado', '$municipio', '$telefono', '$direccion')";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_sucursales.php");
		else
			echo '<script language="javascript">
        alert("Intentalo de nuevo, la sucursal '.$nombre.' ya existe.")
        window.location.href="index_sucursales.php";
          </script>';
		exit;
	}
	// Comprueba la existencia de una peticion post que corresponda al nombre guardar_edicion
	if(isset($_POST['guardar_edicion'])){
		// Extraemos el contenido de la variable $_POST en variables independientes
		extract($_POST);
		$sql = "UPDATE sucursal SET nombre ='$nombre', estado = '$estado', ciudad = '$municipio', telefono = '$telefono', direccion = '$direccion' WHERE id_sucursal = $sucursal_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_sucursales.php");
		exit;
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre editar_marca_id
	if(isset($_GET['editar_sucursal_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "SELECT * FROM sucursal WHERE id_sucursal = $editar_sucursal_id";
		$resultado = mysql_query($sql, $conexion);
		$sucursal = mysql_fetch_assoc($resultado);
		include('editar_sucursal.php');
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre eliminar_marca_id
	if(isset($_GET['eliminar_sucursal_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "DELETE FROM sucursal WHERE id_sucursal = $eliminar_sucursal_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_sucursales.php");
		else
			echo "ERROR";
		exit;
	}

	function pr($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}