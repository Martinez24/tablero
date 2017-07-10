<?php
	/**
	 * Archivo para el control acciones en el módulo de Marcas
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
		$sql = "INSERT INTO departamento(nombre, empresa) VALUES('$nombre', '$empresa')";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_departamento.php");
		else 
			echo '<script language="javascript">
        alert("El departamento '.$nombre.' ya existe.")
        window.location.href="index_departamento.php";
          </script>';
		exit;
	}
	// Comprueba la existencia de una peticion post que corresponda al nombre guardar_edicion
	if(isset($_POST['guardar_edicion'])){
		// Extraemos el contenido de la variable $_POST en variables independientes
		extract($_POST);
		$sql = "UPDATE departamento SET nombre ='$nombre', empresa = '$empresa' WHERE id_departamento = $departamento_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_departamento.php");
		exit;
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre editar_marca_id
	if(isset($_GET['editar_departamento_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "SELECT * FROM departamento WHERE id_departamento = $editar_departamento_id";
		$resultado = mysql_query($sql, $conexion);
		$departamento = mysql_fetch_assoc($resultado);
		include('editar_departamento.php');
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre eliminar_marca_id
	if(isset($_GET['eliminar_departamento_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "DELETE FROM departamento WHERE id_departamento = $eliminar_departamento_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_departamento.php");
		else
			echo "ERROR";
		exit;
	}

	function pr($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}