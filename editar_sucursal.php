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
            <small> Sucursal</small>
          </h1>
        </section>
        <section class="content">
          <div class="col-lg-6">
             <div class="row">
              <div class="panel">
                <div class="panel-heading"></div>
                <div class="panel-body">
                  <form method="post" action="sucursales.php" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="sucursal_id" value="<?php echo $sucursal['id_sucursal'];?>">
                    <div class="form-group">
                      <label for="nombre">Nombre de la sucursal</label>
                      <input type="text" name="nombre" required id="nombre" placeholder="Ej: GPA" class="form-control" value="<?php echo $sucursal['nombre'];?>" autofocus>
                        </div>
                              <div class="form-con">
                                    <dd>Estado:</dd>
                                    <dd>
                                        <select class="form-control" id="estado" name="estado">
                                            <option class="form-group" value="0">Selecciona Uno...</option>
                                        </select>
                                    </dd>
                                    </div>
                                          <div class="form-group">
                                           <dd>Ciudad:</dd>
                                    <dd>
                                        <select class="form-control" id="municipio" name="municipio">
                                            <option value="0">Selecciona Uno...</option>
                                        </select>
                                    </dd>    
                                    </div>
                                    <div class="form-group">
                                      <label for="telefono">Teléfono</label>
                                         <input type="number" name="telefono" required id="telefono" placeholder="Ej: 044-477-896-58-78" class="form-control" value="<?php echo $sucursal['telefono'];?>" autofocus>
                                            </div>
                                    <div class="form-group">
                                       <label for="direccion">Dirección</label>
                                         <input type="text" name="direccion" required id="direccion" placeholder="Ej: Mariano Escobedo #213, Olivos" class="form-control" value="<?php echo $sucursal['direccion'];?>" autofocus>
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
  cargar_estados();
  $("#estado").change(function(){dependencia_municipio();});
  $("#municipio").attr("disabled",true);
});

function cargar_estados()
{
  $.get("cargar_estado.php", function(resultado){
    if(resultado == false)
    {
      alert("Error");
    }
    else
    {
      $('#estado').append(resultado);     
    }
  }); 
}
function dependencia_municipio()
{
  var code = $("#estado").val();
  $.get("dependencia_municipio.php", { code: code },
    function(resultado)
    {
      if(resultado == false)
      {
        alert("Error");
      }
      else
      {
        $("#municipio").attr("disabled",false);
        document.getElementById("municipio").options.length=1;
        $('#municipio').append(resultado);     
      }
    }

  );
}
</script>
  </body>
</html>
