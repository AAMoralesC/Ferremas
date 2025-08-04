<?php
class clsLogin
{


	public function validaIngreso($rut,$clave)
	{
		$PassEncriptada = hash_hmac('md5',$clave,'secret'); 
		$ObjConsultas=new clsConsultas();
		$campos=false;
		$tabla=" usuario ";
		$donde=" rut = '".$rut."' and clave='".$PassEncriptada."' "; 
		$ordenadoPor=false;
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=false;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos;
		}
		else
		{
			return false;
		}
	}
	
	


	public function obtienePedidos()
	{
		$ObjConsultas=new clsConsultas();
		$campos="r.*, c.first_name, c.last_name, c.email, c.phone, c.address";
		$tabla=" orders as r LEFT JOIN customers as c ON c.id = r.customer_id ";
		$donde=false; 
		$ordenadoPor=" c.created DESC";
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=true;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos;
		}
		else
		{
			return false;
		}
	}

}
?>