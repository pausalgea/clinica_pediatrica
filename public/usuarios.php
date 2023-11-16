<?php

require '../vendor/autoload.php';

use Clases\Usuario;
use Clases\Consulta;
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


    if(!isset($_SESSION['login']))
    {    
        $nombre = $_POST['login'];
        $pass = $_POST['password'];
        if (strlen($nombre) == 0 || strlen($pass) == 0) {
            error("Error, El nombre o la contraseña no pueden contener solo espacios en blancos.");
        }

        $resultadoLoginPassword = (new Usuario())->comprobarLoginYPassword($nombre,$pass);
        if($resultadoLoginPassword==false)
        {
        //Nos hemos validado correctamente creamos la sesion de usuario con elnombre de usuario
            $_SESSION['login'] = $nombre;
            $usuarios=(new Usuario())->listadoUsuarios();
            $categoria=(new Usuario())->tipoUsuario($nombre);
            $tipo=$categoria[0];
            if($tipo!="médico")
            {
                echo $blade
                ->view()
                ->make('vistaUsuarios', compact('titulo', 'encabezado', 'tipo','nombre','usuarios'))
                ->render();
            }
            else
            {
                $consultas = (new Consulta())->listadoConsultasMedico($nombre);
                $encabezado="Listado de consultas para esta semana";
                echo $blade
                ->view()
                ->make('vistaUsuarios', compact('titulo', 'encabezado', 'tipo', 'nombre', 'consultas'))
                ->render();

            }



        }

        else
        {
            
            unset($_POST['login']);
            echo "nos hemos validado mal";
            error("Error, Nombre de usuario o password incorrecto");
            header('Location:index.php');
        }
    }
    else
    {
        $usuarios=(new Usuario())->listadoUsuarios();
        $nombre=$_SESSION['login'];
        $categoria=(new Usuario())->tipoUsuario($_SESSION['login']);
        $tipo=$categoria[0];
        echo $blade
        ->view()
        ->make('vistaUsuarios', compact('titulo', 'encabezado', 'tipo','nombre','usuarios'))
        ->render();
    }




