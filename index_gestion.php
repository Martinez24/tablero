<?php include('login/validarsesion.php');?>
<?php
  date_default_timezone_set('America/Mexico_City');
  //session_start();
     if(!isset($_SESSION['tarea'])){
    $_SESSION['tarea'] = array('proyecto' => NULL, 'gestiones' => array());
    $tarea = $_SESSION['tarea'];
  } else {
    $tarea = $_SESSION['tarea'];
  }
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $bd = 'tablero';
  $conexion = @mysql_connect($host, $user, $password);
  @mysql_select_db($bd, $conexion);
 
?>
<!DOCTYPE html>
<html lang="es">
  <head>
     <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon"/>
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
            Gestión
            <small> Punto de gestión de proyectos</small>
          </h1>
          <div class="row">
            <div class="col-md-12 text-right">
              <a href="#" class="btn btn-success" id="agregar-proyecto"><i class="fa fa-plus"> Agregar Proyecto</i></a>
              <a href="#" class="btn btn-success" id="agregar-tarea"><i class="fa fa-plus-square"> Agregar Tarea</i></a>
              <a href="gestiones.php?cancelar_tarea" class="btn btn-danger"><i class="fa fa-times-circle-o"> Cancelar</i></a>
            </div>
          </div>
        </section>
        <!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> <?php echo (isset($tarea['proyecto']['etiqueta'])?$tarea['proyecto']['etiqueta']:"Selecciona un Proyecto");?>
                <small class="pull-right">Fecha: <?php echo date('d/m/Y');?></small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-6 invoice-col" id="info-proyecto">
            <?php
              if(isset($tarea['proyecto']['etiqueta'])){
                echo "<h5 >Datos del proyecto</h5>";
                echo "<address>";
                echo "<b>Etiqueta del proyecto: </b>".$tarea['proyecto']['etiqueta']."<br>";
                echo "<b>Modelo de la máquina: </b>".$tarea['proyecto']['modelo']."<br>";
                echo "<b>Nombre de la máquina: </b>".$tarea['proyecto']['maquina']."<br>";
                echo "<b>Nombre del cliente: </b>".$tarea['proyecto']['nombre']."<br>";
                echo "<b>Destino: </b>".$tarea['proyecto']['destino']."<br>";
                echo "<b>Fecha entrega: </b>".$tarea['proyecto']['fecha_entrega']."<br>";
                echo "<b>Fecha creación: </b>".$tarea['proyecto']['fecha_creacion']."<br>";
                echo "</address>";
              }
            ?>
            </div>
            <img src="assets/img/gpa.png" width="150">
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Usuario</th>
                     <th>Fecha de inicio</th>
                      <th>Fecha entrega</th>
                      <th>Observación</th>
                      <th>Estado del área</th>
                      <th>Departamento</th>
                      <th>Nombre de la persona en cargo</th>
                      <th>Nombre del proyecto</th>                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php  
                    $prioridad_color = array(   
                   'Retraso' => '#FFEE58',   
                   'Tiempo' => '#B2FF59'  
                     );   
                   if(count($tarea['gestiones']) > 0){
                      foreach ($tarea['gestiones'] as $index => $gestion) {
                        echo "<tr  bgcolor=' ". $prioridad_color[$gestion['reporte']] ."' class='tarea'>";
                  //Conexion a la base de datos
                  $conexion = @mysql_connect($host, $user, $password);
                  @mysql_select_db($bd, $conexion);
                  //Consulta para departamento, personal, proyecto
                  $sql= "SELECT d.nombre as id_departamento, p.nombre as id_personal,pr.etiqueta as id_proyecto from proyecto INNER join departamento d on d.id_departamento = '".$gestion['id_departamento']."' INNER JOIN proyecto pr ON pr.id_proyecto = '".$gestion['id_proyecto']."' INNER JOIN personal p on p.Nombre = '".$gestion['id_personal']."' WHERE pr.id_proyecto =".$gestion['id_proyecto'];  
                  //Vista de los datos 
                        echo "<td>".$_SESSION['usuario']['nombre']."</td>";
                        echo "<td>".$gestion['fecha_inicio']."</td>";
                        echo "<td>".$gestion['fecha_entrega']."</td>";
                        echo "<td>".$gestion['observacion']."</td>";
                        echo "<td>".$gestion['reporte']."</td>";
                  //Ejecutamos la consulta para visualizar los caracteres de departamento, personal y proyecto.
                        $resultado = mysql_query($sql, $conexion);
                        $gestion = mysql_fetch_assoc($resultado);
                        echo "<td>".$gestion['id_departamento']."</td>";
                        echo "<td>".$gestion['id_personal']."</td>";
                        echo "<td>".$gestion['id_proyecto']."</td>";
                        echo "<td><a href='gestiones.php?eliminar_tarea=".$index."' class='btn btn-sm btn-danger'><i class='fa fa-times'></i></a></td>";
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

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
              <a href="gestiones.php?guardar_tarea" class="btn btn-success pull-right" id="guardar-tarea"><i class="fa fa-check-circle-o"></i> Guardar Tarea
              </a>
              <!--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
              </button>-->
            </div>
          </div>
        </section>
        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
      </footer>
    </div><!-- ./wrapper -->
    <!--MODALES-->
    <div class="modal fade" id="proyecto-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Busca un proyecto</h4>
          </div>
            <form class="form-horizontal" id="form-selecciona-proyecto" method="post" action="gestiones.php">
              <div class="modal-body">
                  <fieldset>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Proyecto</label>
                        <div class="col-lg-10">
                          <select name="proyecto_id" class="form-control">
                            <?php
                                $sql = "SELECT * FROM proyecto ORDER BY etiqueta";
                                $resultado = mysql_query($sql, $conexion);
                                while ($proyecto = mysql_fetch_assoc($resultado)) {
                                  echo "<option value='".$proyecto['id_proyecto']."'>".$proyecto['etiqueta']."</option>";
                                }
                              ?>
                          </select>
                        </div> 
                      </div>
                    </div>
                  </fieldset>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Agregar Proyecto" name="agrega_proyecto">
              </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="tarea-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Agregar tarea</h4>
          </div>
            <form class="form-horizontal" id="form-agrega-tarea" method="post" action="gestiones.php">
               <div class="modal-body">
                  <fieldset>
                    <div class="col-md-12">
                      <div class="form-group">
                       <label class="col-lg-2 control-label">Departamento</label>
                        <div class="col-lg-10">
                          <select name="departamento_id" class="form-control" id="departamento_id">
                      
                              <option value="id_departamento"> </option>;
                            
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Encargado del departamento</label>
                        <div class="col-lg-10">
                          <select name="personal_id" class="form-control" id="personal_id">
                          <option value="id_personal"></option>;
                          </select>
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="col-lg-2 control-label">Proyecto</label>
                        <div class="col-lg-10">
                          <select name="proyecto_id" class="form-control" id="id_proyecto">
                            <?php
                                $sql = "SELECT * FROM proyecto  ORDER BY etiqueta";
                                $resultado = mysql_query($sql, $conexion);
                                while ($proyecto = mysql_fetch_assoc($resultado)) {
                                  echo "<option value='".$proyecto['id_proyecto']."'>".$proyecto['etiqueta']."</option>";
                                }
                              ?>
                          </select>
                        </div>  
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Fecha de inicio</label>
                          <div class="col-lg-10">
                            <input type="date" name="fecha_inicio" required id="fecha_inicio" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                         <label class="col-lg-2 control-label">Fecha de entrega</label>
                          <div class="col-lg-10">
                           <input type="date" name="fecha_entrega" required id="fecha_entrega" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                         <label class="col-lg-2 control-label">Observación</label>
                        <textarea name="observacion" rows="10" cols="30" class="form-control">Observaciones del área...</textarea>
                      </div>
                      <label class="col-lg-2 control-label">Estado del área:</label>
                      <div class="radio col-lg-2">
                        <input type="radio" name="reporte" required id ="reporte" value="Retraso"> En retraso 
                      </div>
                      <div class="radio col-lg-2">
                        <input type="radio" name="reporte" required="reporte" value="Tiempo"> En tiempo
                      </div>
                    </div>
                  </fieldset>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-success" value="Agregar Tarea" name="agrega_tarea">
              </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    <!--MODALES-->
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
    <script src="assets/js/parsley.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#agregar-proyecto').click(function(){
          $('#proyecto-modal').modal('show');
        });
        $('#agregar-tarea').click(function(){
          $('#tarea-modal').modal('show');
        });
        $('#guardar-tarea').click(function(evt){
          evt.preventDefault();
          var url = $(this).attr('href');
          var proyecto  = $('#info-proyecto').children().length > 0 ? true: false;
          var tarea = $('.tarea').length;
          if(proyecto == false){
            alert("Para guardar necesitas agregar un proyecto");
            return;
          }
          if(tarea <= 0){
            alert("Agrega al menos un departamento al proyecto antes de guardar");
            return; 
          } else {
            window.location.href = url;
          }
        });
        $('#form-agrega-tarea').parsley('validate');
      });
    </script>
    <script type="text/javascript">
$(document).ready(function(){
  cargar_departamentos();
  $("#departamento_id").change(function(){dependencia_personal();});
  $("#personal_id").attr("disabled",true);
});

function cargar_departamentos()
{
  $.get("cargar_departamento.php", function(resultado){
    if(resultado == false)
    {
      alert("Error");
    }
    else
    {
      $('#departamento_id').append(resultado);     
    }
  }); 
}
function dependencia_personal()
{
  var code = $("#departamento_id").val();
  $.get("dependencia_personal.php", { code: code },
    function(resultado)
    {
      if(resultado == false)
      {
        alert("Error");
      }
      else
      {
        $("#personal_id").attr("disabled",false);
        document.getElementById("personal_id").options.length=1;
        $('#personal_id').append(resultado);     
      }
    }

  );
}
</script>
  </body>
</html>