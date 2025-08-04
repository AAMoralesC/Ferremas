<?php
// Include the database connection file
require_once 'dbConnect.php';

// Initialize shopping cart class
include_once 'Cart.class.php';
$cart = new Cart;


?>



<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FerreMas</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php"><img src="images/logo.jpeg" width="150" height="50" class= alt="ferremas"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        
                        <li class="nav-item"><a class="nav-link" href="us.php">Nosotros</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="all.php">Todos los productos</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Populares</a></li>
                                <li><a class="dropdown-item" href="#!">Nuevos</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" action="viewCart.php">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Carrito
                             <span class="badge bg-dark text-white ms-1 rounded-pill">(<?php echo ($cart->total_items() > 0)?$cart->total_items().' Items':0; ?>)</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">Nosotros<br><br>
                <div class="row ">                   

                       <p>La industria de la construcción y ferretería en Chile ha experimentado un crecimiento sostenido desde la década de los 50, impulsada
por el desarrollo urbano y la expansión de infraestructuras. Esto ha generado una demanda creciente de herramientas, materiales
de construcción y accesorios diversos, como taladros, martillos, tornillos, pinturas, materiales eléctricos, etc. Este auge ha llevado
al surgimiento de múltiples fabricantes y la aparición de diversas marcas que ofrecen un amplio abanico de opciones para satisfacer
los gustos y necesidades de los clientes.</p>
                    
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-2 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Toledo-Morales-Bascuñan-Contreras 2024</p></div>
            <div class="text-center"><div class="justify-content-evenly"><img class="figure-img" src="images/webpay.png" width="200px"></div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
