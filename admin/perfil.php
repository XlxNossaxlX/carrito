<?php
  session_start();
  include "../php/conexion.php";
  if(!isset($_SESSION['datos_login'])){
    header("Location: ../index.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  $resultado = $conexion->query("
  SELECT usuario.id, usuario.nombre, usuario.telefono, usuario.email, usuario.password, usuario.img_perfil, usuario.nivel
  FROM usuario where id =". $arregloUsuario['id_usuario']) or die($conexion->error);
  $f = mysqli_fetch_assoc($resultado);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php include "./layouts/header.php" ;?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuario</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <table class="table">
          <thead>
            <tr>
              <th>Foto de perfil</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Rol</th>
            </tr>
          </thead>
          <tbody><tr>
              <td>
                <img src="../images/users/<?php echo $f['img_perfil'];?>" width="50px" height="50px" alt="<?php echo $f['nombre'];?>"/>
              </td>
              <td>
              <?php echo $f['nombre'];?>
              </td>
              <td><?php echo $f['telefono'];?></td>
              <td><?php echo $f['email'];?></td>
              <td><?php echo $f['nivel'];?></td>
              <td>
                <button class="btn btn-primary btn-small btnEditar" 
                data-id="<?php echo $f['id'];?>"
                data-nombre="<?php echo $f['nombre'];?>"
                data-telefono="<?php echo $f['telefono'];?>"
                data-email="<?php echo $f['email'];?>"
                data-nivel="<?php echo $f['nivel'];?>"
                data-toggle="modal" data-target="#modalEditar">
                  <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-danger btn-small btnEliminar" 
                data-id="<?php echo $f['id'];?>"
                data-toggle="modal" data-target="#modalEliminar">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="../php/insertarusuario.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Insertar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="from-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" placeholder="nombre" id="nombre" class="form-control" require>
            </div>
            <div class="from-group">
              <label for="telefono">Telefono</label>
              <input type="text" name="telefono" placeholder="telefono" id="telefono" class="form-control" require>
            </div>
            <div class="from-group">
              <label for="email">Email</label>
              <input type="email" name="email" placeholder="email" id="email" class="form-control" require>
            </div>
            <div class="from-group">
              <label for="password">Contraseña</label>
              <input type="password" name="password" placeholder="contraseña" id="password" class="form-control" require>
            </div>
            <div class="from-group">
              <label for="nivel">Rol</label>
              <select name="nivel" id="nivel" class="form-control" require>
                <option value="admin">Admin</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <div class="from-group">
              <label for="imagen">Imagen</label>
              <input type="file" name="imagen" id="imagen" class="form-control" require>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Eliminar -->
  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            ¿Desea eliminar el usuario?
            
            </div>
            <div class="modal-footer">
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
            </div>
            
        </div>
    </div>
  </div>
<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="../php/editarusuario.php" method="POST" enctype="multipart/form-data" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalEditardalLabel">Editar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idEdit" name="id">
          <div class="form-group">
            <label for="nombreEdit">Nombre</label>
            <input type="text" name="nombre" placeholder="nombre" id="nombreEdit" class="form-control" require>
          </div>
          <div class="form-group">
            <label for="telefonoEdit">Teléfono</label>
            <input type="text" name="telefono" placeholder="telefono" id="telefonoEdit" class="form-control" require>
          </div>
          <div class="form-group">
            <label for="emailEdit">Email</label>
            <input type="email" name="email" placeholder="email" id="emailEdit" class="form-control" require>
          </div>
          <div class="form-group">
            <label for="nivelEdit">Rol</label>
            <select name="nivel" placeholder="nivel" id="nivelEdit" class="form-control" require>
              <option value="cliente">Cliente</option>
              <!-- <option value="admin">Admin</option> -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar </button>
        </div>
      </form>
    </div>
  </div>
</div>


  <?php include "./layouts/footer.php" ;?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./dashboard/plugins/moment/moment.min.js"></script>
<script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./dashboard/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dashboard/dist/js/demo.js"></script>
<script>
  $(document).ready(function(){
    var idEliminar = -1;
    var idEditarUsuario = -1;
    var fila;
    $(".btnEliminar").click(function(){
      idEliminar = $(this).data('id');
      fila = $(this).parent('td').parent('tr'); 
    });
    $(".eliminar").click(function(){
      $.ajax({
        url: '../php/eliminarusuario.php',
        method:'POST',
        data:{
          id:idEliminar
        }
      }).done(function(res){
         $(fila).fadeOut(1000);
      });      
    });
    $(".btnEditar").click(function(){
      idEditar = $(this).data('id');
      var nombre = $(this).data('nombre');
      var telefono = $(this).data('telefono');
      var email = $(this).data('email');
      var nivel = $(this).data('nivel');
      $("#nombreEdit").val(nombre);
      $("#telefonoEdit").val(telefono);
      $("#emailEdit").val(email);
      $("#nivelEdit").val(nivel);
      $("#idEdit").val(idEditar);
    });
  });
</script>
</body>
</html>
