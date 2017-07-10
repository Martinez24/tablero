<?php include('login/validarsesion.php');?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GPA | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.css">
    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--COMPONENTES PARA PLUGIN SELECT2-->
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <link href="assets/plugins/pnotify/css/pnotify.custom.min.css" rel="stylesheet">
    <script src="assets/plugins/pnotify/js/pnotify.custom.min.js"></script>
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
            Reprogramar 
            <small> Fecha</small>
          </h1>
        </section>
        <section class="content">
          <div class="col-lg-6">
            <div class="row">
              <div class="panel">
                <div class="panel-heading"></div>
                  <div class="panel-body">
                    <div class="panel-body">
                      <table class="table">
                        <thead><h3>Información <small>de la tarea</small></h3>
                      <tr>
                        <th>ID</th>
                        <th>Departamento involucrado </th>
                        <th>Personal Involucrado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha entrega</th>
                      </tr>
                        </thead>
                        <tbody>
                          <?php
                              echo "<tr>";
                             echo "<td>".$fecha['id_tarea']."</td>";
                              echo "<td>".$fecha['departamento']."</td>";
                              echo "<td>".$fecha['personal']."</td>";
                              echo "<td>".$fecha['fecha_inicio']."</td>";
                              echo "<td>".$fecha['fecha_entrega']."</td>";
                              echo "</tr>";                           
                          ?>
                        </tbody>
                      </table>
                     </div>
                  <form method="post" action="reprogramar.php" enctype="multipart/form-data" id="form">
                  <input type="hidden" name="tarea_id" value="<?php echo $fecha['id_tarea'];?>">
                  <input type="hidden" name="proyecto_id" value="<?php echo $fecha['id_proyecto'];?>">
                   Ingresa la nueva fecha de entrega para este departamento.
                  <div class="form-group">
                        <label for="fecha_nueva">Nueva Fecha</label>
                          <input type="date" name="fecha_nueva" required id="fecha_nueva" placeholder="" class="form-control" autofocus>
                      </div>                 
                       <input type="submit" name="guardar_edicion" value="Guardar" class="btn btn-primary">
                  </form>
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
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
    <script src="assets/js/jquery.selectedoption.plugin.js"></script>
    <script src="assets/js/parsley.js"></script>
  </body>
</html>
