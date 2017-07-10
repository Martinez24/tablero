
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
            Detalle
            <small>Gestión</small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <a href="sqlGestion.php?imprimir=<?php echo $gestion['id_proyecto']; ?>" class="btn btn-success pull-right"><i class="fa fa-print"></i> Imprimir tarea</a>
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Cliente: <?php echo $gestion['nombre'];?>
                <small class="pull-right">Fecha: <?php echo date('d/m/Y');?></small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <h5>Datos de cliente</h5>
                <address>
                <b>Nombre de la máquina:</b><?php echo $gestion['maquina'];?><br>
                <b>Modelo de la máquina:</b> <?php echo $gestion['modelo'];?><br>
                <b>Nombre del cliente:</b> <?php echo $gestion['nombre'];?><br>
                <b>Destino:</b> <?php echo $gestion['destino'];?><br>
                <b>Fecha de creación: </b><?php echo $gestion['fecha_creacion'];?><br>
                <b>Fecha de entrega: </b><?php echo $gestion['fecha_entrega'];?><br>
                <b>Identificador del proyecto: </b><?php echo $gestion['etiqueta'];?><br>
                </address>
            </div>
            <!--<div class="col-sm-4 invoice-col">
              <h5>Vendedor:</h5>
              <address>
                <b>Nombre:</b> <?php echo $venta['usuario_nombre'];?><br>
                <b>Correo Electrónico:</b><?php echo $venta['usuario_email'];?><br>
              </address>
            </div>-->
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <h5>Departamentos relacionados al proyecto</h5>
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Estado del departamento</th>
                  <th>Observación</th>
                  <th>Fecha de inicio del proyecto</th>
                  <th>Fecha de entrega del proyecto</th>
                  <th>Área involucrada</th>
                  <th>Personal involucrado</th>
                  <th>Identificador del proyecto</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $prioridad_color = array(   
                   'Retraso' => '#FFEE58',   
                   'Tiempo' => '#B2FF59'  
                     );
                    if(count($tareas) > 0){
                      foreach ($tareas as $index => $tarea) {
                      echo "<tr bgcolor=' ".$prioridad_color[$tarea['status']]."'>";
                      echo "<td>".$tarea['usuario']."</td>";
                      echo "<td>".$tarea['status']."</td>";
                      echo "<td>".$tarea['observacion']."</td>";
                      echo "<td>".$tarea['fecha_inicio']."</td>";
                      echo "<td>".$tarea['fecha_entrega']."</td>";
                      echo "<td>".$tarea['departamento']."</td>";
                      echo "<td>".$tarea['personal']."</td>";
                      echo "<td>".$tarea['proyecto']."</td>";
                      echo "</tr>";
                      }
                    } else {
                      echo "<tr><td><span>No hay departamentos agregados</span></td></tr>";
                    }                    
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
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
    <script src="assets/plugins/format-number/jquery.format-number.plugin.js"></script>
  </body>
</html>
