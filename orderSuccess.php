<?php

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

if(empty($_REQUEST['id'])){
    header("Location: index.php");
}
$order_id = base64_decode($_REQUEST['id']);


/** Token de la transacción */
$token = filter_input(INPUT_POST, 'token_ws');

$request = array(
    "token" => filter_input(INPUT_POST, 'token_ws')
);
        

$curl = curl_init();
$url='https://webpay3gint.transbank.cl/rswebpaytransaction/api/webpay/v1.0/transactions/'.$token;
$TbkApiKeyId='597055555532';
$TbkApiKeySecret='579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
$method='PUT';
$data='';

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        'Tbk-Api-Key-Id: '.$TbkApiKeyId.'',
        'Tbk-Api-Key-Secret: '.$TbkApiKeySecret.'',
        'Content-Type: application/json'
      ),
    ));
    
    
$response2 = curl_exec($curl);
$response =json_decode($response2); 
//$url_tbk = $response->url;
$estatus_pago = $response->status;
$card_number= $response->card_detail->card_number;
curl_close($curl);


$mensaje_alerta='';
$alerta='';
if($estatus_pago=='AUTHORIZED')
{
	$mensaje_alerta='Su pago ha sido realizado con éxito. Tarjeta terminada en: '.$card_number;
	$alerta='alert-success';
}
else
{
	$mensaje_alerta='Su pago no ha sido realizado, favor contacte a soporte tecnico.';
	$alerta='alert-danger';
}






// Include the database connection file
require_once 'dbConnect.php';

// Fetch order details from the database
$sqlQ = "SELECT r.*, c.first_name, c.last_name, c.email, c.phone, c.address FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id WHERE r.id=?";
$stmt = $db->prepare($sqlQ);
$stmt->bind_param("i", $db_id);
$db_id = $order_id;
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
	$orderInfo = $result->fetch_assoc();
}else{
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Estado Orden</title>
<meta charset="utf-8">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom style -->
<link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>ESTADO ORDEN</h1>
	<div class="col-12">
		<?php if(!empty($orderInfo)){ ?>
			<div class="col-md-12">
				<div class="alert <?php echo $alerta; ?>"><?php echo $mensaje_alerta; ?></div>
			</div>
			
			<!-- Order status & shipping info -->
			<div class="row col-lg-12 ord-addr-info">
				<div class="hdr">Información de pedido</div>
				<p><b>Referencia ID:</b> #<?php echo $orderInfo['id']; ?></p>
				<p><b>Total:</b> <?php echo CURRENCY_SYMBOL.$orderInfo['grand_total'].' '.CURRENCY; ?></p>
				<p><b>Fecha de compra:</b> <?php echo $orderInfo['created']; ?></p>
				<p><b>Comprador/a:</b> <?php echo $orderInfo['first_name'].' '.$orderInfo['last_name']; ?></p>
				<p><b>Email:</b> <?php echo $orderInfo['email']; ?></p>
				<p><b>Celular:</b> <?php echo $orderInfo['phone']; ?></p>
                <p><b>Dirección:</b> <?php echo $orderInfo['address']; ?></p>
			</div>
			
			<!-- Order items -->
			<div class="row col-lg-12">
				<table class="table table-hover cart">
					<thead>
					  <tr>
                        <th width="10%"></th>
						<th width="45%">Productos</th>
						<th width="15%">Precio</th>
						<th width="10%">Cantidad</th>
						<th width="20%">Sub Total</th>
					  </tr>
					</thead>
					<tbody>
                    <?php
                    // Get order items from the database
                    $sqlQ = "SELECT i.*, p.name, p.price FROM order_items as i LEFT JOIN products as p ON p.id = i.product_id WHERE i.order_id=?";
                    $stmt = $db->prepare($sqlQ);
                    $stmt->bind_param("i", $db_id);
                    $db_id = $order_id;
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if($result->num_rows > 0){ 
                        while($item = $result->fetch_assoc()){
                            $price = $item["price"];
                            $quantity = $item["quantity"];
                            $sub_total = ($price*$quantity);
                            $proImg = !empty($item["image"])?'images/products/'.$item["image"]:'images/demo-img.png';
                    ?>
						<tr>
                            <td><img src="<?php echo $proImg; ?>" alt="..."></td>
							<td><?php echo $item["name"]; ?></td>
							<td><?php echo CURRENCY_SYMBOL.$price.' '.CURRENCY; ?></td>
							<td><?php echo $quantity; ?></td>
							<td><?php echo CURRENCY_SYMBOL.$sub_total.' '.CURRENCY; ?></td>
						</tr>
                    <?php
                        }
                    }
                    ?>
					</tbody>
				</table>
			</div>
            
            <div class="col mb-2">
				<div class="row">
					<div class="col-sm-12  col-md-6">
						<a href="index.php" class="btn btn-block btn-primary"><i class="ialeft"></i>Seguir comprando</a>
					</div>
				</div>
			</div>
		<?php }else{ ?>
		<div class="col-md-12">
			<div class="alert alert-danger">Tu pedido no se proceso correctamente!</div>
		</div>
		<?php } ?>
	</div>
</div>
</body>
</html>