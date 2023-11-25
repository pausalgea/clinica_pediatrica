<?php
//Clase crearusuario.php realizada por Paula Salicio

require '../vendor/autoload.php';

use Clases\Medico;
use Clases\Usuario;
use Philo\Blade\Blade;


$views = '../views'; //variables para usar en las plantillas de blade
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Creación de un nuevo usuario';
session_start();

    function error($mensaje) //funcion para controlar errorres
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['crear'])) { //si la variable crear está definida, significa que el usuario
        // ha pulsado el botón crear
        $login=$_POST['loginACrear'];
        $loginLibre=(new Usuario())->comprobarLoginLibre($login);
        if($loginLibre==true) //comprobamos que el login esté disponible
        {
            $pass=$_POST['password'];
            $tipo=$_POST['tipo'];
            $nombreU=$_POST['nombre'];
            $apellidos=$_POST['apellidos'];
            $dni=$_POST['DNI'];
            $usuarioNuevo=new Usuario();
            $usuarioNuevo->setLogin($login);
            $usuarioNuevo->setPassword($pass);
            $usuarioNuevo->setTipo($tipo);
            $usuarioNuevo->setNombre($nombreU);
            $usuarioNuevo->setApellidos($apellidos);
            $usuarioNuevo->setDNI($dni);
            (new Usuario())->insertarUsuario($usuarioNuevo);
            if($tipo=="médico") //si el usuario es tipo médico hacemos un insert a la tabla médico
            {
                $medicoNuevo=new Medico();
                $medicoNuevo->setLogin($login);
                $medicoNuevo->setDNI($dni);
                $medicoNuevo->setNombre($nombreU);
                $medicoNuevo->setApellidos($apellidos);
                (new Medico())->insertarMedico($medicoNuevo);

            }
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
            echo $blade
            ->view()
            ->make('vistaCreacionUsuarios', compact('titulo', 'encabezado', 'loginLibre'))
            ->render();
        }
        
        


    }
    else{

            echo $blade
            ->view()
            ->make('vistaCreacionUsuarios', compact('titulo', 'encabezado'))
            ->render();
        
        
    }