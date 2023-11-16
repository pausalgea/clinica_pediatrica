<?php

require '../vendor/autoload.php';

use Clases\paciente;
use Philo\Blade\Blade;


$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Listado de pacientes del sistema';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_GET['DNI'])) { //si la variable eliminar está definida, significa que el usuario
        // ha pulsado el botón eliminar
        $DNI_paciente=$_GET['DNI'];

            $pac=new Paciente();
            $pac->eliminarPaciente($DNI_paciente);
            $pacientes=(new paciente())->listarPacientes();
            $nombre=$_SESSION['login'];

            echo $blade
            ->view()
            ->make('vistaPacientes', compact('titulo', 'encabezado', 'nombre','pacientes'))
            ->render();
        }



    

        
    