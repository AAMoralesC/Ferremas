<?php
class clsAppCodTrauma
{
	
	public function ingresaRegistroEmergencia($id_tipo_emergencia,$cantidad_ambar,$cantidad_rubia,$cantidad_negra,$descripcion_emergencia,$id_usuario)
	{
		$ObjConsultas=new clsConsultas();
		$tabla=" pedido ";
		$campos=" tipo_pedido,cantidad_ambar,cantidad_rubia,cantidad_negra,descripcion,fecha,id_usuario";
		$valores=" '$id_tipo_emergencia','$cantidad_ambar','$cantidad_rubia','$cantidad_negra','$descripcion_emergencia',NOW(),'$id_usuario'";
		$devolverID=true;
		$debugSQL=false;
		if ($id=$ObjConsultas->ingresaDatos($campos,$valores,$tabla,$devolverID,$debugSQL))
		{
			return $id;
		}
		else
		{
			return false;
		}
	}

	public function registroUsuario($rut,$nombre,$apellidoP,$id_cargo,$id_especialidad,$direccion,$correo,$celular,$clave)
	{
		$PassEncriptada = hash_hmac('md5',$clave,'secret');	
		$ObjConsultas=new clsConsultas();
		$tabla=" usuario ";
		$campos=" rut,nombre,apellidoP,id_cargo,id_especialidad,direccion,email,telefono,clave";
		$valores=" '$rut','$nombre','$apellidoP','$id_cargo','$id_especialidad','$direccion','$correo','$celular','$PassEncriptada'";
		$devolverID=true;
		$debugSQL=false;
		if ($id=$ObjConsultas->ingresaDatos($campos,$valores,$tabla,$devolverID,$debugSQL))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function obtieneListadoDeEmergencias()
	{
		$ObjConsultas=new clsConsultas();
		$campos="*";
		$tabla=" pedido ";
		$donde=false; 
		$ordenadoPor=" fecha ASC";
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

	public function obtieneListadoCargos()
	{
		$ObjConsultas=new clsConsultas();
		$campos="*";
		$tabla=" cargo ";
		$donde=false; 
		$ordenadoPor=" nombre_cargo ASC";
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

	public function obtieneListadoEspecialidad()
	{
		$ObjConsultas=new clsConsultas();
		$campos="*";
		$tabla=" especialidad ";
		$donde=false; 
		$ordenadoPor=" nombre_especialidad ASC";
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

	public function obtieneListadoEmergencias()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" *";
		$tabla=" pedido";
		$donde=false; 
		$ordenadoPor=" fecha DESC";
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

	public function obtieneStock()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" *";
		$tabla=" producto";
		$donde=false; 
		$ordenadoPor=" id_producto ASC";
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

	public function obtieneUsuariosTurno()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" b.id_usuario,b.telefono";
		$tabla=" conformacion_turno a, usuario b";
		$donde=" a.id_turno=1 and b.id_usuario=a.id_usuario "; 
		$ordenadoPor=false;
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

	public function ingresaUsuariosSeguimientos($id_emergencia,$id_usuario)
	{
		
		$ObjConsultas=new clsConsultas();
		$tabla=" alerta ";
		$campos=" id_emergencia,id_usuario";
		$valores=" '$id_emergencia','$id_usuario'";
		$devolverID=false;
		$debugSQL=false;
		if ($id=$ObjConsultas->ingresaDatos($campos,$valores,$tabla,$devolverID,$debugSQL))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function obtieneListadoDeUsuariosNotificados($id_emergencia)
	{
		$ObjConsultas=new clsConsultas();
		$campos=" b.nombre,b.apellidoP,a.responde";
		$tabla=" alerta a, usuario b";
		$donde=" a.id_emergencia='$id_emergencia' and b.id_usuario=a.id_usuario "; 
		$ordenadoPor=false;
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


	public function actualizaEstado($id_emergencia, $id_usuario)
   {
        $ObjConsultas=new clsConsultas();
		$tabla=" alerta ";
		$campos=" responde = 'si' ";
		$donde = " id_emergencia = '$id_emergencia' AND id_usuario = '$id_usuario'";
		$debugSQL=false;
		if ($id=$ObjConsultas->actualizaDatos($campos,$tabla,$donde,$debugSQL))
		{
		   return true;
		}
		else
		{
		   return false;
		}
		
	}

	public function obtieneSumaDeLitroRubia()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" SUM(cantidad_rubia) as suma";
		$tabla=" pedido";
		$donde=false; 
		$ordenadoPor=false;
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=false;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos->suma;
		}
		else
		{
			return false;
		}
	}
	

	public function obtieneSumaDeLitroNegra()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" SUM(cantidad_negra) as suma";
		$tabla=" pedido";
		$donde=false; 
		$ordenadoPor=false;
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=false;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos->suma;
		}
		else
		{
			return false;
		}
	}


	public function obtieneSumaDeLitroAmbar()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" SUM(cantidad_ambar) as suma";
		$tabla=" pedido";
		$donde=false; 
		$ordenadoPor=false;
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=false;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos->suma;
		}
		else
		{
			return false;
		}
	}


	public function obtieneStockDeLitroRubia()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" stock";
		$tabla=" producto";
		$donde="id_producto=2"; 
		$ordenadoPor=false;
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=false;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos->stock;
		}
		else
		{
			return false;
		}
	}


	public function obtieneStockDeLitroNegra()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" stock";
		$tabla=" producto";
		$donde="id_producto=1"; 
		$ordenadoPor=false;
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=false;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos->stock;
		}
		else
		{
			return false;
		}
	}


	public function obtieneStockDeLitroAmbar()
	{
		$ObjConsultas=new clsConsultas();
		$campos=" stock";
		$tabla=" producto";
		$donde="id_producto=3"; 
		$ordenadoPor=false;
		$tipoColeccion="object";
		$siEsUnSoloDatoSaqueIgualArreglo=false;
		$debugSQL=false;
		if ($datos=$ObjConsultas->obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$siEsUnSoloDatoSaqueIgualArreglo,$debugSQL))
		{
			return $datos->stock;
		}
		else
		{
			return false;
		}
	}
	
}
?>