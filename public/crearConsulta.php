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
$encabezado = 'Creación de consulta';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['crear'])) { //si la variable crear está definida, significa que el usuario
        // ha pulsado el botón crear
        
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
        $login_medico=$_POST['login_medico'];
        $DNI=$_POST['DNI'];
        $consultaLibre=(new Consulta())->comprobarConsultaLibre($fecha,$hora);
        if($consultaLibre==true)
        {

            $con=new Consulta();
            $con->setFecha($fecha);
            $con->setHora($hora);
            $con->setLogin_medico($login_medico);
            $con->setDNI($DNI);
            (new Consulta())->insertarConsulta($con);
            $consultas=(new Consulta())->listadoConsultas();
            $nombre=$_SESSION['login'];
            $encabezado="Listado de consultas para esta semana";
            echo $blade
            ->view()
            ->make('vistaConsultas', compact('titulo', 'encabezado','nombre','consultas'))
            ->render();
        }
        else
        {
            echo $blade
            ->view()
            ->make('vistaCreacionConsultas', compact('titulo', 'encabezado', 'consultaLibre'))
            ->render();

        }

    }
    else{

            $medicos=(new Usuario())->listadoMedicos();
            $pacientes=(new Paciente())->listarPacientes();
            echo $blade
            ->view()
            ->make('vistaCreacionConsultas', compact('titulo', 'encabezado','medicos','pacientes' ))
            ->render();
        
        
    }