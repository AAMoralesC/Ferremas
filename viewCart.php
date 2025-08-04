<?php
// Include the configuration file
require_once 'config.php';

// Initialize shopping cart class
include_once 'Cart.class.php';
$cart = new Cart;

if($_GET['money'] =='DOLLAR')
{
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
<title>Ver Carrito</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<!-- Core theme CSS (includes Bootstrap)-->
<link href="css/styles.css" rel="stylesheet" />
<!-- jQuery library -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

<script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Carrito con falla, vuelva a cargar.');
        }
    });
}
</script>
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
    <h1>CARRITO DE COMPRA</h1>
	<div class="row">
		<div class="cart">
			<div class="col-12">
				<div class="table-responsive">
					<table class="table table-striped cart">
						<thead>
							<tr>
                                <th width="10%"></th>
								<th width="35%">Productos</th>
								<th width="15%">Precio</th>
								<th width="15%">Cantidad</th>
								<th width="20%">Total</th>
								<th width="5%"> </th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        if($cart->total_items() > 0){
                            // Get cart items from session
                            $cartItems = $cart->contents();
                            foreach($cartItems as $item){
                                $proImg = !empty($item["image"])?'images/products/'.$item["image"]:'images/demo-img.png';
                        ?>
							<tr>
                                <td><img src="<?php echo $proImg; ?>" alt="..."></td>
								<td><?php echo $item["name"]; ?></td>
								<td><?php echo CURRENCY_SYMBOL.$item["price"].' '.CURRENCY; ?></td>
								<td><input class="form-control" type="number" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"/></td>
								<td><?php echo CURRENCY_SYMBOL.$item["subtotal"].' '.CURRENCY; ?></td>
								<td><button class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de eliminar producto?')?window.location.href='cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>':false;" title="Remove Item"><i class="itrash"></i> </button> </td>
							</tr>
						<?php } }else{ ?>
							<tr><td colspan="6"><p>Tu carrito esta vacio.....</p></td>
						<?php } ?>
						<?php if($cart->total_items() > 0){ ?>
							<tr>
                                <td></td>
								<td></td>
								<td></td>
								<td><strong>Carrtio Total</strong></td>
								<td><strong><?php echo CURRENCY_SYMBOL.$cart->total().' '.CURRENCY; ?></strong></td>
								<td></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col mb-2">
				<div class="row">
					<div class="col-sm-12  col-md-6">
						<a href="all.php" class="btn btn-block btn-secondary"><i class="ialeft"></i>Agregar mas productos</a>
					</div>
					<div class="col-sm-12 col-md-6 text-right">
						<?php if($cart->total_items() > 0){ ?>
						<a href="checkout.php" class="btn btn-block btn-primary">Pagar<i class="iaright"></i></a>
						<?php } ?>
					</div>
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