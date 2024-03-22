<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="./dashboard/dist/img/logo2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">CANAANN</span>
  </a>
<!-- Navbar -->
<nav class="main-header">
  <ul class="navbar-nav">
    <li class="">
      <a class="nav-link no-text-decoration" data-widget="pushmenu" href="#" style="margin-left: -44px; background: none; color: black; text-decoration: none !important; border-bottom: 1px solid black !important;"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../images/users/<?php echo $arregloUsuario['imagen']; ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="./perfil.php" class="d-block"><?php echo $arregloUsuario['nombre']; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="./index.php" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Inicio</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./miscompras.php" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Compras</p>
          </a>
        </li>
        <?php if ($arregloUsuario['nivel'] == 'admin') { ?>
        <li class="nav-item">
          <a href="./pedidos.php" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Pedidos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./productos.php" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>Productos</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./cupones.php" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>Cupones</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./usuarios.php" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Usuarios</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./correos.php" class="nav-link">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Enviar Correos</p>
          </a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a href="../index.php" class="nav-link">
            <i class="nav-icon fas fa-store"></i>
            <p>Tienda</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../php/cerrar_sesion.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Cerrar Sesión</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>