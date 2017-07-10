<?php include('../login/validarsesion.php');?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GPA | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
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
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
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
           Reprogramación de 
            <small>Tarea</small>
          </h1>          
        </section>
        <!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
              <img src="../assets/img/plasma.PNG" width="350">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Cliente: <?php echo $tarea['nombre'];?>
                <small class="pull-right">Fecha: <?php echo date('d/m/Y');?></small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
           <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Etiqueta del proyecto </th>
                    <th>Modelo de la máquina</th>
                    <th>Nombre de la máquina</th>
                    <th>Nombre del cliente</th>
                    <th>Destino</th>
                    <th>Fecha de Entrega</th>                    
                    <th>Fecha de Creación</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    echo "<tr>";
                    echo "<td>".$tarea['etiqueta']."</td>";
                    echo "<td>".$tarea['modelo']."</td>";
                    echo "<td>".$tarea['maquina']."</td>";
                    echo "<td>".$tarea['nombre']."</td>";
                    echo "<td>".$tarea['destino']."</td>";
                    echo "<td>".$tarea['fecha_entrega']."</td>";
                    echo "<td>".$tarea['fecha_creacion']."</td>";
                    echo "</tr>";
                 
                ?>
                </tbody>
              </table>
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
                  <th></th>
                  <th>Estado del departamento</th>
                  <th>Observación</th>
                  <th>Fecha de inicio del proyecto</th>
                  <th>Fecha de entrega del proyecto</th>
                  <th>Nueva fecha de entrega de proyecto</th>
                  <th>Área involucrada</th>
                  <th>Personal involucrado</th>
                  <th>Identificador del proyecto</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(count($proyectos) > 0){
                      foreach ($proyectos as $index => $proyecto) {
                      echo "<tr>";
                      echo "<td><a href='reprogramar.php?editar_tarea_id=".$proyecto['id_tarea']."' class='btn btn-rounded btn-primary ver-proyecto' title='Reprogramar Fecha' ><i class='fa fa-calendar'></i></a></td>";;
                      echo "<td>".$proyecto['status']."</td>";
                      echo "<td>".$proyecto['observacion']."</td>";
                      echo "<td>".$proyecto['fecha_inicio']."</td>";
                      echo "<td>".$proyecto['fecha_entrega']."</td>";
                      echo "<td>".$proyecto['fecha_reprogramada']."</td>";
                      echo "<td>".$proyecto['departamento']."</td>";
                      echo "<td>".$proyecto['personal']."</td>";
                      echo "<td>".$proyecto['proyecto']."</td>";
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
    <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/dist/js/demo.js"></script>
    <script src="../assets/js/jquery.selectedoption.plugin.js"></script>
    <script src="../assets/plugins/format-number/jquery.format-number.plugin.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.money').formatNumber();
      });
    </script>
  </body>
</html>
