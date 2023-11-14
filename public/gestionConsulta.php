<?php

require '../vendor/autoload.php';

use Clases\Consulta;
use Philo\Blade\Blade;
date_default_timezone_set('Europe/Madrid');

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = "Listado de consultas para esta semana";
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    } 


        $consultas=(new Consulta())->listadoConsultas();
        $nombre=$_SESSION['login'];
        
        
        echo $blade
        ->view()
        ->make('vistaConsultas', compact('titulo', 'encabezado','nombre','consultas'))
        ->render();
    