<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>CANAANN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
  <?php include("./layouts/header.php"); ?>
    <div class="site-blocks-cover" style="background-image: url(images/hero_1.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            <h1 class="mb-2">Encontrar tus productos perfectos</h1>
            <div class="intro-text text-center text-md-left">
              <p class="mb-4">Descubre un mundo de posibilidades y embárcate en un viaje fascinante con nosotros. En cada paso, te acompañamos con dedicación y pasión</p>
              <p>
                <a href="index.php" class="btn btn-sm btn-primary">Comprar ahora</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm site-blocks-1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="icon-truck"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">ENVÍO GRATIS</h2>
              <p>Prepárate para disfrutar de la comodidad extrema con Envíos Gratis en cada pedido. Lleva tus compras al siguiente nivel y olvídate de los costos adicionales.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="icon mr-4 align-self-start">
              <span class="icon-refresh2"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Productos Destacados</h2>
              <p>Nuestra selección de Productos Destacados está pensada para sorprenderte. Cada artículo es una promesa de excelencia y vanguardia, una invitación a disfrutar de lo último en tendencia y funcionalidad.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
            <div class="icon mr-4 align-self-start">
              <span class="icon-help"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">ATENCIÓN AL CLIENTE</h2>
              <p>Cada momento cuenta y tu tranquilidad es nuestra prioridad. Con nuestro equipo de Atención al Cliente, vivirás una experiencia de soporte sin igual.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Productos Destacados</h2>
          </div>
        </div>
        <div class="row mb-5">
            <?php 
              include('./php/conexion.php');
              // for($i=0;$i<10;$i++){
              //   $conexion->query("insert into productos (nombre, descripcion, precio, imagen, inventario, id_categoria, talla, color)
              //     values (
              //       'Productos $i','Esta es la descripcion', ".rand(10,1000).",'cloth_2.jpg', ".rand(1,100).",'1', 'S', 'Blue'
              //     )")or die ($conexion->error);
              // }
              $limite = 3;
              $totalQuery = $conexion->query('select count(*)from productos')or die ($conexion->error);
              $totalProductos = mysqli_fetch_row($totalQuery);
              $totalBotones = round($totalProductos[0] /$limite);
              if(isset($_GET['limite'])){
                $resultado = $conexion->query("select * from productos where inventario>0 order by id DESC limit ".$_GET['limite'].",".$limite)or die ($conexion->error);
              }else{
                $resultado = $conexion->query("select * from productos where inventario>0 order by id DESC limit ".$limite) or die ($conexion->error);
              }
              
              while($fila = mysqli_fetch_array($resultado)){                
            ?>
            
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="shop-single.php?id=<?php echo $fila ['id'] ;?>">
                      <img src="images/<?php echo $fila ['imagen'] ;?>" alt="<?php echo $fila ['nombre'] ;?>" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id=<?php echo $fila ['id'] ;?>"><?php echo $fila ['nombre'] ;?></a></h3>
                    <p class="mb-0"><?php echo $fila ['descripcion'] ;?></p>
                    <p class="text-primary font-weight-bold">$<?php echo $fila ['precio'] ;?></p>
                  </div>
                </div>
              </div>
            
            <?php } ?>  
        </div>            
      </div>
    </div>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>¡Gran venta!</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-4">
            <?php 
                $limite = 1;
                $totalQuery = $conexion->query('select count(*)from productos')or die ($conexion->error);
                $totalProductos = mysqli_fetch_row($totalQuery);
                $totalBotones = round($totalProductos[0] /$limite);
                if(isset($_GET['limite'])){
                  $resultado = $conexion->query("select * from productos where inventario>0 order by id DESC limit ".$_GET['limite'].",".$limite)or die ($conexion->error);
                }else{
                  $resultado = $conexion->query("select * from productos where inventario>0 order by id DESC limit ".$limite) or die ($conexion->error);
                }
                
                while($fila = mysqli_fetch_array($resultado)){                
              ?>
              
                <div class="col-sm-12 col-lg-12 mb-12" data-aos="fade-up">
                  <div class="block-4 text-center border">
                    <figure class="block-4-image">
                      <a href="shop-single.php?id=<?php echo $fila ['id'] ;?>">
                        <img src="images/<?php echo $fila ['imagen'] ;?>" alt="<?php echo $fila ['nombre'] ;?>" class="img-fluid"></a>
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="shop-single.php?id=<?php echo $fila ['id'] ;?>"><?php echo $fila ['nombre'] ;?></a></h3>
                      <p class="mb-0"><?php echo $fila ['descripcion'] ;?></p>
                      <p class="text-primary font-weight-bold">$<?php echo $fila ['precio'] ;?></p>
                    </div>
                  </div>
                </div>
              
              <?php } ?> 

          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="./index.php">Productos Nuevos</a></h2>
            <p>Sumérgete en nuestra colección de Productos Nuevos, una ventana al futuro del diseño y la funcionalidad. Aquí encontrarás las últimas incorporaciones que están dando de qué hablar en el mercado</p>
            <p><a href="./index.php" class="btn btn-primary btn-sm">Tienda</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- <footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Sell online</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Shopping cart</a></li>
                  <li><a href="#">Store builder</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Mobile commerce</a></li>
                  <li><a href="#">Dropshipping</a></li>
                  <li><a href="#">Website development</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Point of sale</a></li>
                  <li><a href="#">Hardware</a></li>
                  <li><a href="#">Software</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <h3 class="footer-heading mb-4">Promo</h3>
            <a href="#" class="block-6">
              <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
              <h3 class="font-weight-light  mb-0">Finding Your Perfect Shoes</h3>
              <p>Promo from  nuary 15 &mdash; 25, 2019</p>
            </a>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
              </ul>
            </div>

            <div class="block-7">
              <form action="#" method="post">
                <label for="email_subscribe" class="footer-heading">Subscribe</label>
                <div class="form-group">
                  <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
                  <input type="submit" class="btn btn-sm btn-primary" value="Send">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.
            Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
            Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.
            </p>
          </div>
          
        </div>
      </div>
    </footer> -->
    <?php include("./layouts/footer.php"); ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>