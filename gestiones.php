<?php
    /**
     * Archivo para el control acciones en el módulo de Ventas
     * acciones como guardar y eliminar
    **/
    // Llamamos al archivo al cúal vamos a utilizar para ver tareas.
    require 'sqlGestion.php';
    // Definimos la zona horaria
    date_default_timezone_set('America/Mexico_City');
    // Iniciamos las sesiones de php
    session_start();
       if(!isset($_SESSION['tarea'])){
    $_SESSION['tarea'] = array('proyecto' => NULL, 'gestiones' => array());
    $tarea = $_SESSION['tarea'];
  } else {
    $tarea = $_SESSION['tarea'];
  }
    // Definimos los datos del servidor y base de datos para establecer conexión con MySQL
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $bd = 'tablero';
    // Ejecutamos conexión con MySQL
    $conexion = @mysql_connect($host, $user, $password);
    // Comprueba la existencia de una peticion post que corresponda al nombre guardar_nuevo
    @mysql_select_db($bd, $conexion);
    //Consulta para colocar los acentos requeridos en los registros 
    mysql_query("SET NAMES 'utf8'");
    // Se comprueba la existencia de la petición post que corresponde al nombre agrega_proyecto
    if($_POST['agrega_proyecto']){
        extract($_POST);
        $sql = "SELECT m.modelo, m.nombre as maquina, c.nombre,e.id_estado, e.estado as destino, pr.id_proyecto, pr.fecha_entrega, pr.fecha_creacion, pr.etiqueta as etiqueta from proyecto pr INNER JOIN cliente c on c.id_cliente = pr.id_cliente INNER JOIN maquina m on m.id_maquina = pr.id_maquina inner join estado e on e.id_estado = c.estado WHERE id_proyecto = $proyecto_id";
        $resultado = mysql_query($sql, $conexion);
        $proyecto = mysql_fetch_assoc($resultado);
        $tarea['proyecto'] = $proyecto;
        $_SESSION['tarea'] = $tarea;
        header("Location: index_gestion.php");
    }
    // Se comprueba la existencia de la petición post que corresponde al nombre agrega_tarea
   if($_POST['agrega_tarea']){
        // Extraemos el contenido de la variable $_POST en variables independientes
        extract($_POST);
        $gestion['id_departamento'] = $departamento_id;
        $gestion['id_personal'] = $personal_id;
        $gestion['id_proyecto'] = $proyecto_id;
        $gestion['fecha_inicio'] = $fecha_inicio;
        $gestion['fecha_entrega'] = $fecha_entrega;
        $gestion['observacion'] = $observacion;
        $gestion['reporte'] = $reporte;
        $tarea['gestiones'][] = $gestion;
        $_SESSION['tarea']= $tarea; 
        header("Location: index_gestion.php");

    }
    // Se comprueba la existencia de la petición get que corresponde al nombre eliminar_tarea para quitar alguna tarea de la gestión
   if(isset($_GET['eliminar_tarea'])){
        //Rescatamos el indice 
        $index_tarea = $_GET['eliminar_tarea'];
        //Eliminamos la tarea del arreglo de productos
        $gestion = $tarea['gestiones'][$index_tarea];
        unset($tarea['gestiones'][$index_tarea]);
        $_SESSION['tarea']= $tarea;
        header("Location: index_gestion.php");
    }
    // Se comprueba la existencia de la petición get que corresponde al nombre cancelar_venta
    if(isset($_GET['cancelar_tarea'])){
          $_SESSION['tarea'] = array('proyecto' => NULL, 'gestiones' => array());
        header("Location: index_gestion.php");
    }
   //la petición get que corresponde al nombre guardar_venta
   if(isset($_GET['guardar_tarea'])){
        extract($gestion=$tarea['gestiones']);  
         // Por cada tarea guardaremos un registro relacionado ala getion     
         foreach ($tarea['gestiones'] as $index => $gestion) {
            print_r($tarea['gestiones']);
         // Por cada departamento guardaremos un registro relacionado al proyecto
            $sql = "INSERT INTO tarea(estatus, id_departamento, id_personal, id_proyecto, fecha_inicio, fecha_entrega, observacion, reporte, usuario)
            VALUES(1,".$gestion['id_departamento'].", '".$gestion['id_personal']."', ".$gestion['id_proyecto'].", '".$gestion['fecha_inicio']."', '".$gestion['fecha_entrega']."', '".$gestion['observacion']."', '".$gestion['reporte']."', '".$_SESSION['usuario']['nombre']."')";
            $resultado = mysql_query($sql, $conexion); 
            $proyecto_id = $gestion['id_proyecto'];   
            if($resultado != 1){
                echo "ERROR AL GUARDAR LA TAREA";
                exit;
            }
        }
            // Limpiamos sesión de la tarea
        $_SESSION['tarea'] = array('proyecto' => NULL, 'gestiones' => array());
        // Redireccionamos a la vista de la tarea generada
        header("Location:sqlGestion.php?ver_gestion=$proyecto_id");   
    }
?>