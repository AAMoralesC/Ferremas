<?
class clsConexion
{
	function __construct()
	{	
		
		if (!($this->link = mysqli_connect("localhost", "cto81888", "MtMfwSsZWrfVCQLHztSX", "cto81888_carrito")))
		{
			header('Location: ../error/');
			exit();
		}
		
		if (!mysqli_select_db($this->link, "cto81888_carrito"))
		{
			header('Location: ../error/');
			exit();
		}

		mysqli_set_charset($this->link, "utf8");
		
		return $this->link;	   
	}	 
}
?>
