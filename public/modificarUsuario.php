<?php
//Clase modificarUsuario.php realizada por Paula Salicio

require '../vendor/autoload.php';

use Clases\Usuario;
use Philo\Blade\Blade;


$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Modificación de usuario';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['modificar'])) { //si la variable modificar está definida, significa que el usuario
        // ha pulsado el botón modificar del formulario
        $login=$_POST['loginAModificar'];
        $usu=new Usuario();
        $usu->modificarUsuario($_POST['password'],$_POST['tipo'],$_POST['nombre'],$_POST['apellidos'],$_POST['DNI'],$login);
        $usuarios=(new Usuario())->listadoUsuarios();
        $nombre=$_SESSION['login'];
        $categoria=(new Usuario())->tipoUsuario($nombre);
        $tipo=$categoria[0];
        echo $blade
        ->view()
        ->make('vistaUsuarios', compact('titulo', 'encabezado', 'tipo','nombre','usuarios'))
        ->render();


    }
    else{

        if(isset($_GET['login']))
        {
            $login=$_GET['login'];
            echo $blade
            ->view()
            ->make('vistaModificacionUsuarios', compact('titulo', 'encabezado', 'login'))
            ->render();
        }
        
    }

