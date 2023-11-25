<?php //Clase crearConsulta.php realizada por Paula Salicio

require '../vendor/autoload.php';

use Clases\Consulta;

use Clases\Paciente;
use Clases\Usuario;
use Philo\Blade\Blade;


$views = '../views'; //variables para usar en las plantillas de blade
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Creación de consulta';
session_start();

    function error($mensaje) //funcion para controlar errorres
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['crear'])) { //si la variable crear está definida, significa que el usuario
        // ha pulsado el botón crear del formulario, recuperamos valores del formulario
        
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
        $login_medico=$_POST['login_medico'];
        $DNI=$_POST['DNI'];
        $consultaLibre=(new Consulta())->comprobarConsultaLibre($fecha,$hora,$login_medico); //comprobamos si la fecha y hora elegida están disponibles para crear la consulta
        if($consultaLibre==true)
        {

            $con=new Consulta();
            $con->setFecha($fecha);
            $con->setHora($hora);
            $con->setLogin_medico($login_medico);
            $con->setDNI($DNI);
            (new Consulta())->insertarConsulta($con);  //insertamos la consulta
            $consultas=(new Consulta())->listadoConsultas();
            $nombre=$_SESSION['login'];
            $encabezado="Listado de consultas para esta semana"; //llamamos a la vista blade vistaConsultas
            echo $blade
            ->view()
            ->make('vistaConsultas', compact('titulo', 'encabezado','nombre','consultas'))
            ->render();
        }
        else
        {
            
            $medicos=(new Usuario())->listadoMedicos(); //el dia y la hora escogidos no están disponibles
            $pacientes=(new Paciente())->listarPacientes();
            echo $blade
            ->view()
            ->make('vistaCreacionConsultas', compact('titulo', 'encabezado', 'consultaLibre','medicos','pacientes'))
            ->render();

        }

    }
    else{

            $medicos=(new Usuario())->listadoMedicos(); //mostramos en vistaCreacionConsultas el listado de médicos y pacientes
            $pacientes=(new Paciente())->listarPacientes();
            echo $blade
            ->view()
            ->make('vistaCreacionConsultas', compact('titulo', 'encabezado','medicos','pacientes' ))
            ->render();
        
        
    }