<?php
//Clase usuario.php realizada por Paula Salicio

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

        $resultadoLoginPassword = (new Usuario())->comprobarLoginYPassword($nombre,$pass);//comprobamos que el login y password corresponden
        if($resultadoLoginPassword==false)
        {
        //Nos hemos validado correctamente creamos la sesion de usuario con elnombre de usuario
            $_SESSION['login'] = $nombre;
            $usuarios=(new Usuario())->listadoUsuarios();
            $categoria=(new Usuario())->tipoUsuario($nombre);
            $tipo=$categoria[0];
            if($tipo=="administrativo")
                $encabezado="Gestión administrativo";
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
            $error="Compruebe el login y el password"; //no es correcto el login y/o password

            $encabezado = 'Aplicación web Clínica pediátrica';
            echo $blade
            ->view()
            ->make('vistaLogin', compact('titulo','encabezado', 'error'))
            ->render();
        }
    }
    else
    {
        $usuarios=(new Usuario())->listadoUsuarios();
        $nombre=$_SESSION['login'];
        $categoria=(new Usuario())->tipoUsuario($_SESSION['login']);
        $tipo=$categoria[0];
        if($tipo=="administrativo")
            $encabezado= "Gestión administrativo";
        echo $blade
        ->view()
        ->make('vistaUsuarios', compact('titulo', 'encabezado', 'tipo','nombre','usuarios'))
        ->render();
    }