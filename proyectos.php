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
		$sql = "INSERT INTO proyecto(id_maquina, etiqueta, fecha_entrega, id_cliente) 
		VALUES('$maquina_id', '$etiqueta','$fecha_entrega', '$cliente_id')";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_proyecto.php");
		else 
			echo '<script language="javascript">
        alert("Intentalo de nuevo, la etiqueta '.$etiqueta.' ya existe.")
        window.location.href="index_proyecto.php";
          </script>';
		exit;
	}
	// Comprueba la existencia de una peticion post que corresponda al nombre guardar_edicion
	if(isset($_POST['guardar_edicion'])){
		// Extraemos el contenido de la variable $_POST en variables independientes
		extract($_POST);
		$sql = "UPDATE proyecto 
		SET id_maquina ='$maquina_id', etiqueta = '$etiqueta', fecha_entrega = '$fecha_entrega', id_cliente = '$cliente_id'
		 WHERE id_proyecto = $proyecto_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_proyecto.php");
		exit;
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre editar_marca_id
	if(isset($_GET['editar_proyecto_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "SELECT * FROM proyecto WHERE id_proyecto = $editar_proyecto_id";
		$resultado = mysql_query($sql, $conexion);
		$proyecto = mysql_fetch_assoc($resultado);
		include('editar_proyecto.php');
	}
	// Se comprueba la existencia de la petición get que corresponde al nombre eliminar_marca_id
	if(isset($_GET['eliminar_proyecto_id'])){
		// Extraemos el contenido de la variable $_GET en variables independientes
		extract($_GET);
		$sql = "DELETE FROM proyecto WHERE id_proyecto = $eliminar_proyecto_id";
		$resultado = mysql_query($sql, $conexion);
		if($resultado == 1)
			header("Location: index_proyecto.php");
		else
			echo "ERROR";
		exit;
	}

	function pr($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}