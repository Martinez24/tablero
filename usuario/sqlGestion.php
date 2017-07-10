<?php
/** 
*Archivo de consultas para el modulo de gestiones
**/
date_default_timezone_set('America/Mexico_City');
session_start();
//Definimos los datos del servidor para conectarse a la base de da datos correspondiente
$host = 'localhost';
$user = 'root';
$password = '';
$bd = 'tablero';
$conexion = @mysql_connect($host, $user, $password);
mysql_select_db($bd, $conexion);
mysql_query("SET NAMES 'utf8'");
if(isset($_GET['ver_gestion'])){
        $proyecto_id = $_GET['ver_gestion'];
        verGestion($proyecto_id);
    }
    if(isset($_GET['imprimir'])){
        $proyecto_id = $_GET['imprimir'];
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $bd = 'tablero';
        $conexion = @mysql_connect($host, $user, $password);
        @mysql_select_db($bd, $conexion);
        //Esta consulta permite visualizar los datos del proyecto 
        $sql = "SELECT m.modelo, m.nombre as maquina, c.nombre,e.id_estado, e.estado as destino, pr.id_proyecto, pr.fecha_entrega, pr.fecha_creacion, pr.etiqueta as etiqueta from proyecto pr INNER JOIN cliente c on c.id_cliente = pr.id_cliente INNER JOIN maquina m on m.id_maquina = pr.id_maquina inner join estado e on e.id_estado = c.estado WHERE id_proyecto =$proyecto_id";
        //echo $sql;exit;
        $resultado = mysql_query($sql, $conexion);
        $gestion = mysql_fetch_assoc($resultado);
        $tareas = array();
        //Esta consulta permite visualizar los datos de los departamentos
        $sql ="SELECT d.nombre as departamento, p.nombre as personal, pr.etiqueta as proyecto, t.fecha_entrega, t.fecha_inicio, t.observacion,t.usuario, t.reporte as status, t.fecha_nueva as fecha_reprogramada from tarea t inner join departamento d on d.id_departamento = t.id_departamento inner join personal p on p.Nombre = t.id_personal inner join proyecto pr on pr.id_proyecto = t.id_proyecto where pr.id_proyecto =$proyecto_id";
        $resultado = mysql_query($sql, $conexion);
        mysql_query("SET NAMES 'utf8'");
        //Mientras haya productos en el resultado se agregarán al arreglo de productos
        while ($tarea = mysql_fetch_assoc($resultado)) {
            $tareas[]=$tarea;
        }
        include('gestion_impresion.php');
        exit;
    }
    if(isset($_GET['reporte'])){
        header("Content-Type: application/vnd.ms-excel");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=reporte_tareas_".date('Y-m-d').".xls");
        $sql = "SELECT m.modelo, m.nombre as maquina, c.nombre,e.id_estado, e.estado as destino, pr.id_proyecto, pr.fecha_entrega, pr.fecha_creacion, pr.etiqueta as etiqueta from proyecto pr INNER JOIN cliente c on c.id_cliente = pr.id_cliente INNER JOIN maquina m on m.id_maquina = pr.id_maquina inner join estado e on e.id_estado = c.estado";
        $resultado = mysql_query($sql, $conexion);
        $render = '<head>
                    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
                    </head>
                    <table border="1">
                <thead>
                  <tr>
                    <th>Modelo de la Máquina</th>
                    <th>Nombre de la Máquina</th>
                    <th>Nombre del cliente</th>
                    <th>Destino</th>
                    <th>Fecha Entrega</th>
                    <th>Fecha creación</th>
                    <th>Identificador del proyecto</th>
                  </tr>
                </thead>
                <tbody>';
        while ($tarea= mysql_fetch_assoc($resultado)) {
            $render.= "<tr>";
            $render.= "<td>".$tarea['modelo']."</td>";
            $render.= "<td>".$tarea['nombre']."</td>";
            $render.= "<td>".$tarea['maquina']."</td>";
            $render.= "<td>".$tarea['nombre']."</td>";
            $render.= "<td>".$tarea['destino']."</span></td>";
            $render.= "<td>".$venta['fecha_entrega']."</td>";
            $render.= "<td>".$venta['fecha_creacion']."</td>";
            $render.= "<td>".$venta['etiqueta']."</td>";
            $render.= "</tr>";
        }
        $render.= "</tbody></table>";
        print($render);
    }
    /**
     * Función para obtener la información pertienente a la venta y mmostrarla en vista
     * @param entero $compra_id ID de la compra
     * @return void
    **/
    function verGestion($proyecto_id){        
   $host = 'localhost';
        $user = 'root';
        $password = '';
        $bd = 'tablero';
        $conexion = @mysql_connect($host, $user, $password);
        @mysql_select_db($bd, $conexion);
        mysql_query("SET NAMES 'utf8'");
        $sql = "SELECT m.modelo, m.nombre as maquina, c.nombre,e.id_estado, e.estado as destino, pr.id_proyecto, pr.fecha_entrega, pr.fecha_creacion, pr.etiqueta as etiqueta from proyecto pr INNER JOIN cliente c on c.id_cliente = pr.id_cliente INNER JOIN maquina m on m.id_maquina = pr.id_maquina inner join estado e on e.id_estado = c.estado WHERE id_proyecto =".$proyecto_id;
        //echo $sql;exit;
        $resultado = mysql_query($sql, $conexion);
        $gestion = mysql_fetch_assoc($resultado);
        $tareas = array();
        $sql ="SELECT d.nombre as departamento, p.nombre as personal, pr.etiqueta as proyecto, t.fecha_entrega, t.fecha_inicio, t.observacion, t.usuario, t.reporte as status from tarea t inner join departamento d on d.id_departamento = t.id_departamento inner join personal p on p.Nombre = t.id_personal inner join proyecto pr on pr.id_proyecto = t.id_proyecto where pr.id_proyecto = ".$proyecto_id;
        $resultado = mysql_query($sql, $conexion);
        //Mientras haya productos en el resultado se agregarán al arreglo de productos
        while ($tarea = mysql_fetch_assoc($resultado)) {
            $tareas[]=$tarea;
        }
        include('ver_gestion.php');
        exit;
    }
    /*function pr($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }*/

?>