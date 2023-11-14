<?php

require '../vendor/autoload.php';

use Clases\Usuario;
use Philo\Blade\Blade;


$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Listado de usuarios del sistema';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_GET['login'])) { //si la variable eliminar está definida, significa que el usuario
        // ha pulsado el botón eliminar
        $login=$_GET['login'];
        if($login==$_SESSION['login'])
        {
            echo'<script type="text/javascript">
        alert("No se puede borrar el usuario logeado actualmente");
        </script>';
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
            $usu=new Usuario();
            $usu->eliminarUsuario($login);
            $usuarios=(new Usuario())->listadoUsuarios();
            $nombre=$_SESSION['login'];
            $categoria=(new Usuario())->tipoUsuario($nombre);
            $tipo=$categoria[0];
            echo $blade
            ->view()
            ->make('vistaUsuarios', compact('titulo', 'encabezado', 'tipo','nombre','usuarios'))
            ->render();
        }



    }

        
    