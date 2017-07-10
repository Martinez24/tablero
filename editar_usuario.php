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
            Editar
            <small> usuario</small>
          </h1>
        </section>
        <section class="content">
          <div class="col-lg-6">
             <div class="row">
              <div class="panel">
                <div class="panel-heading"></div>
                <div class="panel-body">
                  <form method="post" action="usuarios.php" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="usuario_id" value="<?php echo $usuario['id_empleado'];?>">
                    <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" name="nombre" required id="nombre" placeholder="Ej: Juan" class="form-control" value="<?php echo $usuario['nombre'];?>" autofocus>
                    </div>
                    <div class="form-group">
                      <label for="email">Correo Electrónico</label>
                      <input type="email" name="email" required id="email" placeholder="Ej: juan@gmail.com" class="form-control" value="<?php echo $usuario['email'];?>">
                    </div>
                    <div class="form-group">
                      <label for="email">Tipo de Usuario</label>
                      <select name="tipo_usuario" required class="form-control" id="tipo">
                        <option value="ADMIN">Administrador</option>
                        <option value="USUARIO">Usuario</option>
                        <option value="DIR">Director</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="estatus">Estatus</label>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="estatus" id="estatus"> Activo
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password">Nueva Contraseña</label>
                      <input type="password" name="password" id="password" class="form-control">
                      <small>(Sí no requiere cambio de contraseña, deje vacio este campo)</small>
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
    <script type="text/javascript">
      $(document).ready(function(){
        var activo = <?php echo $usuario['activo'];?>;
        if(activo == 1){
          $('#estatus').attr('checked','checked');
        }
        var tipo_usuario = "<?php echo $usuario['tipo_usuario'];?>";
        $('#tipo').val(tipo_usuario);
        $('#form').parsley('validate');
      });
    </script>
  </body>
</html>
