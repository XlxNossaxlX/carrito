<?php 
  session_start();
  include "../php/conexion.php";
  if(!isset($_SESSION['datos_login'])){
    header("Location: ../index.php");
  }
  $arregloUsuario = $_SESSION['datos_login'];
  $resultado = $conexion->query("SELECT ventas.*, usuario.nombre, usuario.telefono, usuario.email FROM ventas 
  INNER JOIN usuario ON ventas.id_usuario = usuario.id
  WHERE ventas.id_usuario =".$arregloUsuario['id_usuario'])or die($conexion->error);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pedidos</title>
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
            <h1 class="m-0 text-dark">Tus compras</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div id="accordion">
        <?php
            while($f=mysqli_fetch_array($resultado)){            
        ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $f['id'] ;?>">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id'] ;?>" aria-expanded="true" aria-controls="collapseOne">
                        <?php echo $f['fecha'].'-'.$f['nombre'] ;?>
                    </button>
                </h5>
                </div>

                <div id="collapse<?php echo $f['id'] ;?>" class="collapse" aria-labelledby="heading<?php echo $f['id'] ;?>" data-parent="#accordion">
                <div class="card-body">
                    <p>Nombre cliente: <?php echo $f['nombre'] ;?></p>
                    <p>Email cliente: <?php echo $f['email'] ;?></p>
                    <p>Telefono: <?php echo $f['telefono'] ;?></p>
                    <p>Status: <b><?php echo $f['status'] ;?></b></p>
                    <p class="h6" >Datos de envio</p>
                    <?php 
                        $re = $conexion->query("SELECT * FROM envios 
                        INNER JOIN ventas ON envios.id_venta = ventas.id 
                        where ventas.id_usuario = ".$arregloUsuario['id_usuario']." AND envios.id_venta = ".$f['id'])or die($conexion->error);
                        if ($re && $re->num_rows > 0) {
                            $fila=mysqli_fetch_row($re);
                        ?>
                        <p>Direccion: <?php echo $fila[3] ;?></p>
                        <p>Estado: <?php echo $fila[4] ;?></p>
                        <p>C.P: <?php echo $fila[5] ;?></p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Talla</th>
                                    <th>Color</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>                            
                                <?php 
                                    $re = $conexion->query("SELECT productos_venta.*, productos.nombre, productos.talla, productos.color
                                    from productos_venta inner join productos on productos_venta.id_producto=productos.id
                                    INNER JOIN ventas ON productos_venta.id_venta = ventas.id
                                    WHERE ventas.id_usuario =".$arregloUsuario['id_usuario']) or die($conexion->error); 
                                    while ($f2 = mysqli_fetch_array($re)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $f2['id'] ;?></td>
                                        <td><?php echo $f2['nombre'] ;?></td>
                                        <td><?php echo number_format($f2['precio'],2,'.','') ;?></td>
                                        <td><?php echo $f2['talla'] ;?></td>
                                        <td><?php echo $f2['color'] ;?></td>
                                        <td><?php echo $f2['cantidad'] ;?></td>
                                        <td><?php echo $f2['subtotal'] ;?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>                
                </div>
                </div>
            </div>
        <?php } ?>
       </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

</body>
</html>
