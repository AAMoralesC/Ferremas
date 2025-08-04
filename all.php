<?php
function obtieneValorDolar()
{
    $week_ago=date("Y-m-d");
    $today=date("Y-m-d");
    $url="https://si3.bcentral.cl/SieteRestWS/SieteRestWS.ashx?user=andr.moralesc@duocuc.cl&pass=Apibanco1&firstdate=2024-07-04&lastdate=2024-07-05&timeseries=F073.TCO.PRE.Z.D&function=GetSeries";
    $json_data =file_get_contents($url);
    $response_data = json_decode($json_data);
    $valor = $response_data->Series->Obs[0]->value;
    return $valor;
}
// Include the database connection file
require_once 'dbConnect.php';

// Initialize shopping cart class
include_once 'Cart.class.php';
$cart = new Cart;

// Fetch products from the database
$sqlQ = "SELECT * FROM products";
$stmt = $db->prepare($sqlQ);
$stmt->execute();
$result = $stmt->get_result();



if($_GET['money'] =='DOLLAR')
{
   $valor_dolar=obtieneValorDolar();
   define('CURRENCY', 'USD');
   define('CURRENCY_SYMBOL', '$'); 
}
else
{
   define('CURRENCY', 'CL');
   define('CURRENCY_SYMBOL', '$'); 
}


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
    <form id="principal" name="principal" action="all.php">
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
                        <button class="btn btn-outline-dark" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            <a href="viewCart.php">
                             <span class="badge bg-dark text-white ms-1 rounded-pill">(<?php echo ($cart->total_items() > 0)?$cart->total_items().' Items':0; ?>)</span></a>
                        </button>
                    </form>
                    <div class="ms-3">
                        <select id="money" name="money" onchange="document.forms[0].submit();">
                            <option>Seleccione Moneda</option>
                            <option>PESOS</option>
                            <option>DOLLAR</option>
                        </select>
                    </div>  
                </div>
            </div>
        </nav>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">Todos los Productos<br><br>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">                   

                       <?php
                    if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $proImg = !empty($row["image"])?'images/products/'.$row["image"]:'images/demo-img.png';
                        ?> 
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $proImg; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row["name"]; ?></h5>
                                    <!-- Product price-->
                                    <?php 
                                    if($_GET['money'] =='DOLLAR')
                                    {
                                      
                                      $nuevo_valor=$row["price"] / $valor_dolar;
                                      echo CURRENCY_SYMBOL.number_format($nuevo_valor,2).' '.CURRENCY;
                                    }
                                    else
                                    {
                                       echo CURRENCY_SYMBOL.$row["price"].' '.CURRENCY; 
                                    }
                                     ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                               <div class="text-center"> <a href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>" class="btn btn-primary bi-cart-fill"> Agregar</a></div>
                            </div>
                        </div>
                    </div>
                     <?php } }else{ ?>
                <p>Product(s) not found.....</p>
                <?php } ?>
                    
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
    </form>
    </body>
</html>
