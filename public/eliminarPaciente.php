<?php

require '../vendor/autoload.php';

use Clases\Consulta;
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
    
    if (isset($_GET['id'])) { //si la variable eliminar está definida, significa que el usuario
        // ha pulsado el botón eliminar
        $id_consulta=$_GET['id'];

            $con=new Consulta();
            $con->eliminarConsulta($id_consulta);
            $consultas=(new Consulta())->listadoConsultas();
            $nombre=$_SESSION['login'];
            $encabezado="Listado de consultas para esta semana";

            echo $blade
            ->view()
            ->make('vistaConsultas', compact('titulo', 'encabezado', 'nombre','consultas'))
            ->render();
        }



    

        
    