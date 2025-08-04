<?php
include_once("../clases/template.php");
include_once("../clases/clsConexion.php");
include_once("../clases/clsConsultas.php");
include_once("../clases/clsLogin.php");

$objLogin = new clsLogin();
$T=new Template();
$T->set_file(array("Salida" => "login.html"));


    session_start();

    //session_destroy();
    if(isset($_POST['ingresar']))
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            $T->set_var(array("Mensaje"=>"Usuario o contraseña incorrectos<br> Intente nuevamente."));
        }
        else
        {
            if(isset($_POST['rut_usuario']) && isset($_POST['clave_usuario'])) 
            {
                $username = $_POST['rut_usuario'];
                $password = $_POST['clave_usuario'];
                
                if($UsuarioActivo=$objLogin->validaIngreso($username,$password)) 
                {
                    session_start();
                    $_SESSION['usuario']= $UsuarioActivo->nombre." ".$UsuarioActivo->apellidoP;
                    $_SESSION['id_usuario']= $UsuarioActivo->id_usuario;
                    $_SESSION['id_cargo']= $UsuarioActivo->id_cargo;
                    header('Location: ../pedidos/');
                    exit();
                } 
                else 
                {
                    $T->set_var(array("Mensaje"=>"UsuarError de CSRF: Token no válido"));
                }
            }
            else {
                //echo 2;
            }
        }
    }
    else
    {
        $token = bin2hex(random_bytes(32)); // Genera un token aleatorio de 32 bytes
    
        // Almacena el token en la sesión para validación posterior
        $_SESSION['csrf_token'] = $token;
        $T->set_var(array("csrf_token"=>$token));

    }
   
    



$T->parse("Salida","Salida");
$T->p("Salida");
?>