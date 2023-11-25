
<?php
//Clase index.php realizada por Paula Salicio
//primer fichero que se va a ejecutar en el servidor


require '../vendor/autoload.php';

use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = 'Aplicación web';
$encabezado = 'Aplicación web Clínica pediátrica';

echo $blade
    ->view()
    ->make('vistaLogin', compact('titulo', 'encabezado'))
    ->render();