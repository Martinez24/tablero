e<?php

	// Iniciamos las sesiones de php
	session_start();
	// Se comprueba la existencia de la petición get que corresponde al nombre cerrar_sesion
	if(isset($_GET['cerrar-sesion'])){
		//Destrute la sesión y direcciona al login del sistema
		session_destroy();
		header('Location: ../login.php');
	}
	// Comprueba la existencia de una peticion post que corresponda al nombre login
	if(isset($_POST['login'])){
		// Definimos los datos del servidor y base de datos para establecer conexión con MySQL
		$host = 'localhost';
	    $user = 'root';
	    $password = '';
	    $bd = 'tablero';
	    // Ejecutamos conexión con MySQL
	    $conexion = @mysql_connect($host, $user, $password);
	    //Seleccionamos la base de datos que utilizaremos
	    @mysql_select_db($bd, $conexion);
	    // Extraemos el contenido de la variable $_POST en variables independientes
	    extract($_POST);
	    // Definimos consulta para comprobar la existencia del usuario y contraseña obtenidos
	    // a la vez. seleccionamos el id del usuario que se logea para traer sus datos
	    // y ponerlos en sesión para uso de la aplicación
	    $sql = "SELECT COUNT(email) AS coincidencias, tipo_usuario FROM usuario WHERE email = '$email' AND password = sha1('$password')";
	    // Ejecutamos consulta y obtenemos resultados
	    $resultado = mysql_query($sql);
	    // Obtenemos el contenido de la consulta en un array asociativo
	    $tupla = mysql_fetch_assoc($resultado);
	    // Comprobamos que las coincidencias sean igual a 1 a manera de 
	    // comprobación de la existencia del usuario con respectiva contraseña
	    if($tupla['coincidencias'] == 1){
	    	//Extraemos el contenido de la variable $tupla en variables independientes
	    	extract($tupla);
	    	// Seleccionamos todoa la información del usuario logeado
	    	$sql = "SELECT * FROM usuario tipo_usuario WHERE email = '$email' AND password = sha1('$password')";
	    	$resultado = mysql_query($sql);
	    	$user = mysql_fetch_assoc($resultado);
	    	if($tupla['tipo_usuario']=='ADMIN'){
	    	$_SESSION['usuario'] = $user;
	    	// Finalmente redireccionamos el index de administrador
	    	header('Location: ../index.php');
	    }else{
	    
	    	$_SESSION['usuario'] = $user;
	    	// Finalmente redireccionamos el index de los usuarios
	    	header('Location: ../usuario/index.php');
	    }
	   		} else {
	    	// Si no hay coincidencias direccionamos el login nuevamente
	    	echo '<script language="javascript">
        alert("Intentalo de nuevo, Contraseña o correo incorectos.")
        window.location.href="../login.php";
          </script>';
	    }
	}

?>