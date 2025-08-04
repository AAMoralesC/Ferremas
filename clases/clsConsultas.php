<?php 

  if ( session_status() != 2 ) {
    include('sesionValor.php'); 
  }
?>
<?php
class clsConsultas extends clsConexion
{
	function generaRestricciones($donde)
	{
		if ($donde)
		{
			$restriccion=" Where ".$donde;
		}
		else
		{
			$restriccion="";
		}
		
		return $restriccion;
	} 

	function generaCampos($campos)
	{
		if ($campos)
		{
			$camposSQl=$campos;
		}
		else
		{
			$camposSQl=" * ";
		}
		
		return $camposSQl;
	}

	function generaOrden($ordenadoPor)
	{
		if ($ordenadoPor)
		{
			$ordenadoPorSQl=" Order By ".$ordenadoPor;
		}
		else
		{
			$ordenadoPorSQl=" ";
		}
		
		return $ordenadoPorSQl;
	}

	function generaColeccionDeResultado($tipoColeccion,$result,$arregloBool)
	{
		$tipoColeccion=strtolower($tipoColeccion);
		$i=0;
		
		if (mysqli_num_rows($result)>0)
		{
			if ($tipoColeccion=="array")
			{
				if (mysqli_num_rows($result)==1)
				{  
					if ($arregloBool)
					{
						$retorno[0]=mysqli_fetch_array($result);   
					}
					else
					{
						$retorno=mysqli_fetch_array($result);
					}
				}
				else
				{
					while ($coleccion=mysqli_fetch_array($result))
					{
						$retorno[$i]=$coleccion;
						$i++;
					}
				}
			}
			elseif ($tipoColeccion=="object")
			{
				if (mysqli_num_rows($result)==1)
				{  
					if ($arregloBool)
					{
						$retorno[0]=mysqli_fetch_object($result);   
					}
					else
					{
						$retorno=mysqli_fetch_object($result);	
					}
				}
				else
				{
					while ($coleccion=mysqli_fetch_object($result))
					{
						$retorno[$i]=$coleccion;
						$i++;
					}
				}
			}
			else
			{
				if (mysqli_num_rows($result)==1)
				{  
					if ($arregloBool)
					{
						$retorno[0]=mysqli_fetch_object($result);   
					}
					else
					{
						$retorno=$retorno=mysqli_fetch_object($result);
					}
				}
				else
				{
					while ($coleccion = mysqli_fetch_object($result))
					{
						$retorno[$i] = $coleccion;
						$i++;
					}
				}
			}
			
			return $retorno;
		}
		else
		{
			return false;
		}
	}
	
	#INICIO LIMPIADOR DE PARAMETROS
	function cleanParameters($params)
	{
		//$params = str_replace("'", " ", $params);	
		$params = str_ireplace("SELECT"," ",$params);
		$params = str_ireplace("COPY"," ",$params);
		$params = str_ireplace("DELETE"," ",$params);
		$params = str_ireplace("DROP"," ",$params);
		$params = str_ireplace("DUMP"," ",$params);
		//$params = str_ireplace(" OR "," ",$params);
		//$params = str_ireplace("LIKE"," ",$params);
		$params = str_ireplace("SLEEP"," ",$params);	
		$params = str_replace("--"," ",$params);
		$params = str_replace("^"," ",$params);
		$params = str_replace("["," ",$params);
		$params = str_replace("]"," ",$params);
		$params = str_replace("[\]"," ",$params);
		//$params = str_replace("!"," ",$params);
		$params = str_replace("¡"," ",$params);
		$params = str_ireplace("UNION"," ",$params);
		//$params = str_ireplace("ALL"," ",$params);
		$params = str_ireplace("NULL"," ",$params);
		$params = str_ireplace("CURRENT_USER"," ",$params);
		
		return $params;
	}
	#FIN LIMPIADOR DE PARAMETROS	
 
	// esta funcion devuelve un arreglo de la coleccion seleccionada 
	function obtieneDatos($campos,$tabla,$donde,$ordenadoPor,$tipoColeccion,$arregloSiEsUno,$debugSQL) 
	// el parametro $donde es la resticcion eje: $donde=' id_carpeta = '.$idcarpeta;
	{    
		// sanitizo los parametros antes de realizar la consulta a la BBDD 
		// mysqli_real_escape_string sirve para eliminar caracteres de uso común para la inyección SQL
		// strip_tags sirve para evitar tag de JavaScript y PHP para uso malicioso
		// preg_replace elimino los \ y los saltos de linea \r \n una vez sanitizados los parametros
		
		$campos = preg_replace('/\\r\\n/', '',$campos);
		$campos = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$campos)));
				
		$tabla = preg_replace('/\\r\\n/', '',$tabla);
		$tabla = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$tabla)));
		
		$donde = preg_replace('/\\r\\n/', '',$donde);		
		$donde = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$donde)));
		
		$donde = $this->cleanParameters($donde);
		
		
		$ordenadoPor = strip_tags(mysqli_real_escape_string($this->link,$ordenadoPor));
		
		$tipoColeccion = strip_tags(mysqli_real_escape_string($this->link,$tipoColeccion));
		
		$arregloSiEsUno = strip_tags(mysqli_real_escape_string($this->link,$arregloSiEsUno));
		
		$debugSQL = strip_tags(mysqli_real_escape_string($this->link,$debugSQL));
		
		// el parametro $tipoColeccion nos servira para decidir k sacaremos array u object eje: $tipoColeccion="array";
		// $bd = new clsConexion();                                       
		// para el parametro $tabla de envia la o las tablas eje1: $tabla="carpeta"; eje2: $tabla= 
		// para el parametro $ordenadoPor es para ordenar la seleccion. eje: $ordenadoPor="order by id_campo"; 
		
		$restriccion = $this->generaRestricciones($donde);             
		
		// para $campos eje1: $campos="*"; eje2 $campos="a.*,b.*"; o campos especificos 
		
		$campos=$this->generaCampos($campos);
		$ordenadoPor=$this->generaOrden($ordenadoPor);
		$sql = "Select ".$campos."  from  ".$tabla."  ".$restriccion."  ".$ordenadoPor;

		//echo $sql;
		
		// $link = $this->bd->clsConexion();
		
		$result = mysqli_query($this->link, $sql);  

		if ($debugSQL)
		{
			echo '<font color="#000000">'.$sql."<br>"; 
			echo mysqli_error($this->link); 
			echo "</font><br>";
		}

		if ($result)
		{
			if (mysqli_num_rows($result) > 0)
			{ 
				//$result=array_map("utf8_decode", $result);		
				//$coleccion = mb_convert_encoding($coleccion, 'UTF-8', 'ISO-8859-1');
				//$retorno=array_map("utf8_decode", $retorno);
				$arreglo = $this->generaColeccionDeResultado($tipoColeccion,$result,$arregloSiEsUno);
				return $arreglo;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function ingresaDatos($campos,$valores,$tabla,$devolverID,$debugSQL)
	{                       
		// sanitizo los parametros antes de realizar la consulta a la BBDD 
		// mysqli_real_escape_string sirve para eliminar caracteres de uso común para la inyección SQL
		// strip_tags sirve para evitar tag de JavaScript y PHP para uso malicioso
		// preg_replace elimino los \ y los saltos de linea \r \n una vez sanitizados los parametros
		
		$campos = preg_replace('/\\r\\n/', '',$campos);
		$campos = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$campos)));
		
		$valores = preg_replace('/\\r\\n/', '',$valores);
		$valores = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$valores)));
			
		$tabla = preg_replace('/\\r\\n/', '',$tabla);
		$tabla = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$tabla)));
		
		$devolverID = strip_tags(mysqli_real_escape_string($this->link,$devolverID));
		
		$debugSQL = strip_tags(mysqli_real_escape_string($this->link,$debugSQL));
		
		//$bd = new clsConexion(); 
		
		$sql = "Insert Into ".$tabla." (".$campos.") values (".$valores." )";
		
		//if ($debugSQL)
		//{ echo $sql."<br>"; }

		$result = mysqli_query($this->link, $sql);

		if ($debugSQL)
		{
			echo $sql."<br>"; 
			echo mysqli_insert_id($this->link); 
			echo "<br>";
		}

		if ($result)
		{ 
			if ($devolverID)
			{
				return mysqli_insert_id($this->link);
			}
			else
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
 
	function actualizaDatos($campos,$tabla,$donde,$debugSQL)
	{		
		// sanitizo los parametros antes de realizar la consulta a la BBDD 
		// mysqli_real_escape_string sirve para eliminar caracteres de uso común para la inyección SQL
		// strip_tags sirve para evitar tag de JavaScript y PHP para uso malicioso
		// preg_replace elimino los \ y los saltos de linea \r \n una vez sanitizados los parametros
		
		$campos = preg_replace('/\\r\\n/', '',$campos);
		$campos = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$campos)));
			
		$tabla = preg_replace('/\\r\\n/', '',$tabla);
		$tabla = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$tabla)));
		
		$donde = preg_replace('/\\r\\n/', '',$donde);		
		$donde = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$donde)));
		
		$donde = $this->cleanParameters($donde);
		
		$debugSQL = strip_tags(mysqli_real_escape_string($this->link,$debugSQL));
		
		//$bd = new clsConexion();
		
		$restriccion = $this->generaRestricciones($donde);
		$sql = "Update ".$tabla." Set ".$campos." ".$restriccion;
		
		//if ($debugSQL)
		//{ echo $sql."<br>"; }
		
		$result = mysqli_query($this->link, $sql);

		if ($debugSQL)
		{
			echo $sql."<br>"; 
			echo mysqli_insert_id($this->link); 
			echo "<br>";
		}

		if ($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function eliminaDatos($tabla,$donde,$debugSQL)
	{
		// sanitizo los parametros antes de realizar la consulta a la BBDD 
		// mysqli_real_escape_string sirve para eliminar caracteres de uso común para la inyección SQL
		// strip_tags sirve para evitar tag de JavaScript y PHP para uso malicioso
		// preg_replace elimino los \ y los saltos de linea \r \n una vez sanitizados los parametros
		
		$tabla = preg_replace('/\\r\\n/', '',$tabla);
		$tabla = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$tabla)));
		
		$donde = preg_replace('/\\r\\n/', '',$donde);
		$donde = preg_replace('/\\\\/', '', strip_tags(mysqli_real_escape_string($this->link,$donde)));
		
		$donde = $this->cleanParameters($donde);
		
		$debugSQL = strip_tags(mysqli_real_escape_string($this->link,$debugSQL));		
		
		//$bd = new clsConexion();
		
		$restriccion = $this->generaRestricciones($donde);
		$sql = "Delete From ".$tabla." ".$restriccion;
		
		//if ($debugSQL)
		//{ echo $sql."<br>"; }
		
		$result = mysqli_query($this->link, $sql);

		if ($debugSQL)
		{
			echo $sql."<br>"; 
			echo mysqli_insert_id($this->link); 
			echo "<br>";
		}

		if ($result)
		{ 
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>