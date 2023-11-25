<?php
//Clase login.php realizada por Paula Salicio

require '../vendor/autoload.php';

use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = 'Login usuario';
$encabezado = 'Formulario de login de usuarios';

echo $blade
    ->view()
    ->make('vistaLogin', compact('titulo', 'encabezado'))
    ->render();