<?php
include_once("../clases/template.php");
include_once("../clases/clsConexion.php");
include_once("../clases/clsConsultas.php");
include_once("../clases/clsLogin.php");

$objLogin = new clsLogin();
$T=new Template();
$T->set_file(array("Salida" => "listado_tour.html"));
$T->set_block("Salida","listaTour","listaTourT");

   
session_start();
if(isset($_SESSION['usuario']))
{
    if($datos_tour=$objLogin->obtienePedidos())
    {
        foreach($datos_tour as $p_datos_tour)
        {
            $T->set_var(array("nombre"=>$p_datos_tour->first_name." ".$p_datos_tour->last_name,
                              "email"=>$p_datos_tour->email,
                              "celular"=>$p_datos_tour->phone,
                              "direccion"=>$p_datos_tour->address,
                              "estado"=>$p_datos_tour->status,
                              "total"=>$p_datos_tour->grand_total
            )); //

            $T->parse("listaTourT","listaTour",true);
        }
    }
    
    
    
    $T->set_var(array("usuario"=>$_SESSION['usuario']));
}
else
{
    header('Location: index.php');
    exit();
}




$T->parse("Salida","Salida");
$T->p("Salida");
?>