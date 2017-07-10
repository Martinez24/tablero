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
    //Consulta para colocar los acentos requeridos en los registros 
    mysql_query("SET NAMES 'utf8'");
    // Ejecutamos conexión con MySQL
    $conexion = @mysql_connect($host, $user, $password);

    // Seleccionamos la base de datos que utilizaremos
    @mysql_select_db($bd, $conexion);
    // Se comprueba la existencia de la petición get que corresponde al nombre editar_marca_id
    //Consulta para colocar los acentos requeridos en los registros 
    mysql_query("SET NAMES 'utf8'");
    if(isset($_GET['ver_proyecto_id'])){
        // Extraemos el contenido de la variable $_GET en variables independientes
        extract($_GET);
        $sql = "SELECT m.modelo, m.nombre as maquina, c.nombre,e.id_estado, e.estado as destino, pr.id_proyecto, pr.fecha_entrega, pr.fecha_creacion, pr.etiqueta as etiqueta from proyecto pr INNER JOIN cliente c on c.id_cliente = pr.id_cliente INNER JOIN maquina m on m.id_maquina = pr.id_maquina inner join estado e on e.id_estado = c.estado where pr.id_proyecto = $ver_proyecto_id";

        $resultado = mysql_query($sql, $conexion);
        $tarea = mysql_fetch_assoc($resultado);
        $proyectos = array();
        $sql ="SELECT d.nombre as departamento, p.nombre as personal, pr.etiqueta as proyecto, t.id_tarea, t.fecha_entrega, t.fecha_inicio, t.observacion, t.reporte as status, t.fecha_nueva as fecha_reprogramada from tarea t inner join departamento d on d.id_departamento = t.id_departamento inner join personal p on p.Nombre = t.id_personal inner join proyecto pr on pr.id_proyecto = t.id_proyecto where pr.id_proyecto =$ver_proyecto_id";
        $resultado = mysql_query($sql, $conexion);
        //Mientras haya productos en el resultado se agregarán al arreglo de productos
        while ($proyecto = mysql_fetch_assoc($resultado)) {
            $proyectos[]=$proyecto;
        }
        include('index_reprogramar.php');
        exit;
    }
    if(isset($_GET['editar_tarea_id'])){
        // Extraemos el contenido de la variable $_GET en variables independientes
        extract($_GET);
        $sql = "SELECT d.nombre as departamento, p.nombre as personal, pr.id_proyecto, pr.etiqueta as proyecto, t.id_tarea, t.fecha_entrega, t.fecha_inicio, t.observacion, t.reporte as status, t.fecha_nueva as fecha_reprogramada from tarea t inner join departamento d on d.id_departamento = t.id_departamento inner join personal p on p.Nombre = t.id_personal inner join proyecto pr on pr.id_proyecto = t.id_proyecto WHERE t.id_tarea = $editar_tarea_id";
        $resultado = mysql_query($sql, $conexion);
        $fecha = mysql_fetch_assoc($resultado);
        $fechas[]=$fecha;
        include('editar_fecha.php');
    }

    if(isset($_POST['guardar_edicion'])){   
        extract($_POST);
        $fecha['id_tarea'] = $id_tarea;
        $sql = "UPDATE tarea SET fecha_nueva = '$fecha_nueva' WHERE id_tarea = $tarea_id";
        $resultado = mysql_query($sql, $conexion);
        if($resultado == 1)
            header("Location: reprogramar.php?ver_proyecto_id=$proyecto_id");
    }

    function pr($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }