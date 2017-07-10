<?php include('login/validarsesion.php');?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
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
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon"/>
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
            Usuarios
            <small></small>
          </h1>
        </section>
        <section class="content">
      <div class="col-lg-12">
         <div class="row">
          <div class="panel">
            <div class="panel-heading">
<!--Aplicación de modal con Bootstrap -->
            <button class="btn btn-danger" data-toggle="modal" data-target="#miventana">Agregar usuario</button>
            </div>
            <div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4>Agregar Usuario</h4>
                  </div>
                  <div class="modal-body">
<!--Inicia formulario de agregar usuario-->
                    <section class="content">
                             <div class="row">
                              <div class="panel">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                  <form method="post" action="usuarios.php" enctype="multipart/form-data" id="form">
                                    <div class="form-group">
                                      <label for="nombre">Nombre</label>
                                      <input type="text" name="nombre" required id="nombre" placeholder="Ej: Juan" class="form-control" autofocus>
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Correo Electrónico</label>
                                      <input type="email" name="email" required id="email" placeholder="Ej: juan@gmail.com" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Tipo de Usuario</label>
                                      <select name="tipo_usuario" required class="form-control">
                                        <option value="ADMIN">Administrador</option>
                                        <option value="USUARIO">Usuario</option>
                                        <option value="DIR">Director</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="password">Contraseña</label>
                                      <input type="password" name="password" required id="password" class="form-control">
                                    </div>
                                    <input type="submit" name="guardar_nuevo" value="Guardar" class="btn btn-primary">
                                  </form>
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
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Tipo de Usuario</th>
                    <th>Creado</th>
                    <th>Estatus</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $host = 'localhost';
                  $user = 'root';
                  $password = '';
                  $bd = 'tablero';
                  $conexion = @mysql_connect($host, $user, $password);
                  @mysql_select_db($bd, $conexion);
                  $sql = "SELECT * FROM usuario order by nombre ";
                  $resultado = mysql_query($sql, $conexion);
                  while ($usuario = mysql_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td><a href='usuarios.php?editar_usuario_id=".$usuario['id_empleado']."' class='btn btn-rounded btn-primary editar-usuario'><i class='fa fa-pencil'></i></a></td>";
                    echo "<td><a href='usuarios.php?eliminar_usuario_id=".$usuario['id_empleado']."' class='btn btn-primary eliminar-usuario'><i class='fa fa-trash eliminar-usuario'></i></a></td>";
                    echo "<td>".$usuario['nombre']."</td>";
                    echo "<td>".$usuario['email']."</td>";
                    echo "<td>".($usuario['tipo_usuario']=='ADMIN'?'Administrador':'Usuario')."</td>";
                    echo "<td>".$usuario['fecha_creacion']."</td>";
                    echo "<td>".($usuario['activo']==1?'Activo':'Inactivo')."</td>";
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
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
    <script src="assets/js/jquery.selectedoption.plugin.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.eliminar-usuario').click(function(evt){
          evt.preventDefault();
          var url = $(this).attr('href');          
          if(confirm("¿Estás seguro de querer eliminar este usuario?")){
            console.log(url);
            window.location.href = url;
          }
        });
      });
    </script>
  </body>
</html>
