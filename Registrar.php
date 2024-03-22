<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./admin/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./admin/dashboard/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="./index.php"><b>CANAANN</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Crear usuario</p>

      <form action="./php/Crearusuario.php" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="nombre" class="form-control" placeholder="Nombre" name="nombre" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="apellido" class="form-control" placeholder="Apellido" name="apellido" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="telefono" class="form-control" placeholder="Telefono" name="telefono" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Correo Electronico" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span></span>
            </div>
          </div>
        </div>
        <input type="file" name="imagen" required><br><br>
        <div class="row">
          <div class="col-0">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div><br>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Crear cuenta</button>
          </div>
          <!-- /.col -->
          <?php 
            if(isset($_GET['error'])){
                echo '<div class="col-12 alert alert-danger">'.$_GET['error'].'</div>';
            }
          ?>

        </div>
      </form>
      <div class="row">
        <div class="col-6">
          <p class="mb-0">
            <a href="index2.php" class="text-center">Regresar</a>
          </p>
        </div>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./admin/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./admin/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./admin/dashboard/dist/js/adminlte.min.js"></script>

</body>
</html>
