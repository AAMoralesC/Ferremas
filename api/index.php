<?php 

if(isset($_GET['TOKEN']))
{
	// Instanciamos la conexion a la BD
	require_once '../dbConnect.php';
	$token =$_GET['TOKEN'];
	$sqlQ1 = "SELECT * FROM token WHERE hash='$token' and status=1 ";
	$stmt1 = $db->prepare($sqlQ1);
	$stmt1->execute();
	$result1 = $stmt1->get_result();

	if($result1->num_rows == 1)
	{
		switch ($_GET['METHOD']) 
		{
			case 'GET':
				// Realizamos la consulta a la tabla producto
				$sqlQ = "SELECT * FROM products";
				$stmt = $db->prepare($sqlQ);
				$stmt->execute();
				$result = $stmt->get_result();

				//Inicializamos nuestro arreglo
				$itemMain=array();
				$itemMain["Products"]=array();

				//capturamos el tipo de moneda solicitada por parametro
				$currency_get= strtoupper($_GET['CURRENCY']);
				
				//Preguntamos si la cantidad de registros encontrados es mayor a 0
				if($result->num_rows > 0)
				{
					//Recorremos el arreglo con los resultados entregados
					while ($row = $result->fetch_assoc()) 
					{
					    //Importamos las variables del arreglo
					    extract($row);
					    
					    if($currency_get == "USD")// Si la moneda es dolar realizamos la respectiva division
					    {
					    	//Consumimos la api del banco central y nos traemos el valor del dolar del día
					    	$DOLAR=890.70;
					    	//Pasamos el valor de la base de datos en peso a dolares
					    	$price = $price/$DOLAR;
					    	$price = number_format($price,2,",","");
					    }

					    $itemProducts=array(
					    	"id"=> $id,
					    	"name"=>$name,
					    	"image" => "https://ferremas.toledofarias.cl/images/products/".$image,
					    	"description"=>$description,
					    	"price"=> $price,
					    	"currency" => $currency_get,
					    	"created"=>$created,
					    	"modified" =>$modified,
					    	"status"=>$status
					    );
					    // Agregamos el producto al arreglo
					    array_push($itemMain["Products"], $itemProducts);
					}
					// enviamos codigo de exito
					http_response_code(200);
					// imprimimos el resultado y los codificamos en json
					echo json_encode($itemMain);
				}
				else
				{
					//http_response_code(204);
					echo json_encode(array("message"=> "No Products Found."));
					
				}
				break;
			
			default:
				http_response_code(404);
				break;
		}
	}
	else
	{
		echo json_encode(array("message"=> "Invalid Token."));
	}
}
else
{
	echo json_encode(array("message"=> "Token Not Found."));	
}

?>



