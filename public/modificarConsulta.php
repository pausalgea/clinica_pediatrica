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
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
        $login_medico=$_POST['login_medico'];
        $DNI=$_POST['DNI'];
        $con=new Consulta();
        $consultaLibre=$con->comprobarConsultaLibre($fecha,$hora,$login_medico);
        if($consultaLibre==true)
        {
            (new Consulta())->modificarConsulta($fecha,$hora,$login_medico,$DNI,$id);
            $consultas=(new Consulta())->listadoConsultas();
            $nombre=$_SESSION['login'];

            echo $blade
            ->view()
            ->make('vistaConsultas', compact('titulo', 'encabezado','nombre','consultas'))
            ->render();
        }
        else
        {
            $id_consulta=$id;
            $medicos=(new Usuario())->listadoMedicos();
            $pacientes=(new Paciente())->listarPacientes();
            echo $blade
            ->view()
            ->make('vistaModificacionConsultas', compact('titulo', 'encabezado', 'consultaLibre','id_consulta','medicos','pacientes'))
            ->render();
        }


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