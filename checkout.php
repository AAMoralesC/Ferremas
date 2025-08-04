<?php
// Include the configuration file
require_once 'config.php';

// Initialize shopping cart class
include_once 'Cart.class.php';
$cart = new Cart;

// If the cart is empty, redirect to the products page
if($cart->total_items() <= 0){
    header("Location: index.php");
}

// Get posted form data from session
$postData = !empty($_SESSION['postData'])?$_SESSION['postData']:array();
unset($_SESSION['postData']);

// Get status message from session
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}

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
<title>Pago</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
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
<div class="container">
	<h1>Realizar Pago</h1>
	<div class="col-12">
		<div class="checkout">
			<div class="row">
				<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
				<div class="col-md-12">
					<div class="alert alert-success"><?php echo $statusMsg; ?></div>
				</div>
				<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
				<div class="col-md-12">
					<div class="alert alert-danger"><?php echo $statusMsg; ?></div>
				</div>
				<?php } ?>
				
				<div class="col-md-4 order-md-2 mb-4">
					<h4 class="d-flex justify-content-between align-items-center mb-3">
						<span class="text-muted">Tu Carrito</span>
						<span class="badge badge-secondary badge-pill"><?php echo $cart->total_items(); ?></span>
					</h4>
					<ul class="list-group mb-3">
                    <?php
                    if($cart->total_items() > 0){
                        // Get cart items from session
                        $cartItems = $cart->contents();
                        foreach($cartItems as $item){
                    ?>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
						  <div>
							<h6 class="my-0"><?php echo $item["name"]; ?></h6>
							<small class="text-muted"><?php echo CURRENCY_SYMBOL.$item["price"]; ?>(<?php echo $item["qty"]; ?>)</small>
						  </div>
						  <span class="text-muted"><?php echo CURRENCY_SYMBOL.$item["subtotal"]; ?></span>
						</li>
					<?php } } ?>
						<li class="list-group-item d-flex justify-content-between">
						  <span>Total (<?php echo CURRENCY; ?>)</span>
						  <strong><?php echo CURRENCY_SYMBOL.$cart->total(); ?></strong>
						</li>
					</ul>
					<a href="index.php" class="btn btn-sm btn-info">+ agregar items</a>
				</div>
				<div class="col-md-8 order-md-1">
					<h4 class="mb-3">Contacto Comprador</h4>
					<form method="post" action="cartAction.php">
						 
						<div class="row">
							<div class="col-md-6 mb-3">
							  <label for="first_name">Nombre</label>
							  <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo !empty($postData['first_name'])?$postData['first_name']:''; ?>" required>
							</div>
							<div class="col-md-6 mb-3">
							  <label for="last_name">Apellido</label>
							  <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo !empty($postData['last_name'])?$postData['last_name']:''; ?>" required>
							</div>
						</div>
						<div class="mb-3">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" required>
						</div>
						<div class="mb-3">
							<label for="phone">Celular</label>
							<input type="text" class="form-control" id="phone" name="phone" value="<?php echo !empty($postData['phone'])?$postData['phone']:''; ?>" required>
						</div>
						<div class="mb-3">
							<label for="last_name">Dirección</label>
							<input type="text" class="form-control" id="address" name="address" value="<?php echo !empty($postData['address'])?$postData['address']:''; ?>" required>
						</div>
						<input type="hidden" name="action" value="placeOrder"/>
						<input class="btn btn-success btn-block" type="submit" id="checkoutSubmit"  name="checkoutSubmit" value="Realizar Pago">
						<br><br>
						<div class="container-fluid"><div class="justify-content-evenly"><img class="figure-img" src="images/webpay.png" width="300px"></div></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
 <footer class="py-2 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Toledo-Morales-Bascuñan-Contreras 2024</p></div>
            <div class="text-center"><div class="justify-content-evenly"><img class="figure-img" src="images/webpay.png" width="200px"></div></div>
        </footer>
</body>
</html>