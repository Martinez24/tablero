<?php include('../login/validarsesion.php');?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Consulta de proyectos| Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.css">
    <!-- jQuery 2.1.4 -->
    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--COMPONENTES PARA PLUGIN SELECT2-->
    <link rel="stylesheet" href="../assets/plugins/select2/select2.min.css">
    <script src="../assets/plugins/select2/select2.full.min.js"></script>
    <link href="../assets/plugins/pnotify/css/pnotify.custom.min.css" rel="stylesheet">
    <script src="../assets/plugins/pnotify/js/pnotify.custom.min.js"></script>
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">

    <div class="wrapper">

      <?php
        include('header.php');
      ?>
      <!-- MENU -->
      <?php
        include('menu.php');
      ?>

      <!-- MENU -->
      <div class="content-wrapper" id="content"> 
        <section class="content-header">
          <h1>
            Consulta de
            <small>Proyectos</small>
          </h1>
        </section>
        <section class="content">
      <div class="col-lg-12">
         <div class="row">
          <div class="panel">
            <div class="panel-heading">
<!--Aplicación de modal con Bootstrap -->
            </div>
            <div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">    
                  </div>
                  <div class="modal-body">
<!--Inicia formulario de agregar usuario-->

                    <section class="content">
                             <div class="row">
                              <div class="panel">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                </div>
                              </div>
                            </div>
                        </section>
<!Termina Formulario-->
                  </div>
                </div>
              </div>
            </div>

            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th></th> 
                    <th></th>
                    <th>Etiqueta del proyecto </th>
                    <th>Modelo de la máquina</th>
                    <th>Nombre de la máquina</th>
                    <th>Nombre del cliente</th>
                    <th>Destino</th>
                    <th>Fecha Entrega</th>                    
                    <th>Fecha Creación</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $host = 'localhost';
                  $user = 'root';
                  $password = '';
                  $bd = 'tablero';
                  $conexion = @mysql_connect($host, $user, $password);
                  //Consulta para colocar los acentos requeridos en los registros 
                  mysql_query("SET NAMES 'utf8'");
                  @mysql_select_db($bd, $conexion);
                  $sql = "SELECT m.modelo, m.nombre as maquina, c.nombre,e.id_estado, e.estado as destino, pr.id_proyecto, pr.fecha_entrega, pr.fecha_creacion, pr.etiqueta as etiqueta from proyecto pr INNER JOIN cliente c on c.id_cliente = pr.id_cliente INNER JOIN maquina m on m.id_maquina = pr.id_maquina inner join estado e on e.id_estado = c.estado";
                  $resultado = mysql_query($sql, $conexion);
                  while ($proyecto = mysql_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td><a href='consultas.php?ver_proyecto_id=".$proyecto['id_proyecto']."' class='btn btn-rounded btn-primary ver-proyecto' title='Ver proyecto' ><i class='fa fa-eye'></i></a></td>";
                    echo "<td><a href='reprogramar.php?ver_proyecto_id=".$proyecto['id_proyecto']."' class='btn btn-rounded btn-primary ver-proyecto' title='Reprogramar Fecha' ><i class='fa fa-calendar'></i></a></td>";
                    echo "<td>".$proyecto['etiqueta']."</td>";
                    echo "<td>".$proyecto['modelo']."</td>";
                    echo "<td>".$proyecto['maquina']."</td>";
                    echo "<td>".$proyecto['nombre']."</td>";
                    echo "<td>".$proyecto['destino']."</td>";
                    echo "<td>".$proyecto['fecha_entrega']."</td>";
                    echo "<td>".$proyecto['fecha_creacion']."</td>";
                    echo "</tr>";
                  }
                  function pr($var){
                    echo "<pre>";
                    print_r($var);
                    echo "</pre>";
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
  </div><!-- /.content-wrapper -->
      <footer class="main-footer">
      </footer>
    </div><!-- ./wrapper -->
    <!-- Slimscroll -->
    <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/dist/js/demo.js"></script>
    <script src="../assets/js/jquery.selectedoption.plugin.js"></script>
  </body>
</html>