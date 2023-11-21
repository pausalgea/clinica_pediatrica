<?php

require '../vendor/autoload.php';

use Clases\Paciente;
use Philo\Blade\Blade;

date_default_timezone_set('Europe/Madrid');

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = "Listado de pacientes";
session_start();

function error($mensaje)
{
    $_SESSION['error'] = $mensaje;
    header('Location:index.php');
    die();
}


$pacientes = (new Paciente())->listarPacientes();
$nombre = $_SESSION['login'];


echo $blade
    ->view()
    ->make('vistaPacientes', compact('titulo', 'encabezado', 'nombre', 'pacientes'))
    ->render();