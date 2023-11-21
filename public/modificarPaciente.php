<?php

require '../vendor/autoload.php';

use Clases\Paciente;
use Philo\Blade\Blade;


$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Modificación de paciente';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['modificar'])) { //si la variable modificar está definida, significa que el usuario
        // ha pulsado el botón modificar
        $DNI=$_POST['DNI'];
        $con=new Paciente();

        $con->modificarPaciente($_POST['nombre'],$_POST['apellidos'],$_POST['fecha_nacimiento'],$_POST['telefono'],$DNI);
        $pacientes=(new Paciente())->listarPacientes();
        $nombre=$_SESSION['login'];
         $encabezado = 'Listado de pacientes';

        echo $blade
        ->view()
        ->make('vistaPacientes', compact('titulo', 'encabezado','nombre','pacientes'))
        ->render();


    }
    else{

        if(isset($_GET['DNI']))
        {
            $DNI=$_GET['DNI'];
            $pacientes=(new Paciente())->listarPacientes();
            echo $blade
            ->view()
            ->make('vistaModificacionPacientes', compact('titulo', 'encabezado', 'DNI','pacientes'))
            ->render();
        }
        
    }