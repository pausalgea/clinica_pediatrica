<?php

require '../vendor/autoload.php';

use Clases\Consulta;
use Clases\Paciente;
use Clases\Usuario;
use Philo\Blade\Blade;


$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Modificación de consulta';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['modificar'])) { //si la variable modificar está definida, significa que el usuario
        // ha pulsado el botón modificar
        $id=$_POST['consultaAModificar'];
        $con=new Consulta();
        $con->modificarConsulta($_POST['fecha'],$_POST['hora'],$_POST['login_medico'],$_POST['DNI'],$id);
        $consultas=(new Consulta())->listadoConsultas();
        $nombre=$_SESSION['login'];

        echo $blade
        ->view()
        ->make('vistaConsultas', compact('titulo', 'encabezado','nombre','consultas'))
        ->render();


    }
    else{

        if(isset($_GET['id']))
        {
            $id_consulta=$_GET['id'];
            $medicos=(new Usuario())->listadoMedicos();
            $pacientes=(new Paciente())->listarPacientes();
            echo $blade
            ->view()
            ->make('vistaModificacionConsultas', compact('titulo', 'encabezado', 'id_consulta','medicos','pacientes'))
            ->render();
        }
        
    }