<?php

require '../vendor/autoload.php';


use Clases\Paciente;
use Clases\Asegurado;
use Clases\No_Asegurado;
use Philo\Blade\Blade;


$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Creación de paciente';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje;
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['crear'])) { //si la variable crear está definida, significa que el usuario
        // ha pulsado el botón crear
        
        $fecha_nacimiento=$_POST['fecha_nacimiento'];
        $nombre_paciente=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $DNI=$_POST['DNI'];
        $telefono=$_POST['telefono'];
        $esAsegurado=$_POST['asegurado'];

        $DNILibre=(new Paciente())->comprobarDNILibre($DNI);
        if($DNILibre==true)
        {

            $pac=new Paciente();
            $pac->setDNI($DNI);
            $pac->setNombre($nombre_paciente);
            $pac->setApellidos($apellidos);
            $pac->setFecha_nacimiento($fecha_nacimiento);
            $pac->setTelefono($telefono);



            (new Paciente())->insertarPaciente($pac);
            $pacientes=(new Paciente())->listarPacientes();
            $nombre=$_SESSION['login'];
            $encabezado="Listado de pacientes";

            if($esAsegurado=="si")
            {
                $aseg=new Asegurado();
                $aseg->setN_Seguro($_POST["num_seguro"]);
                $aseg->setDNI($DNI);
                (new Asegurado())->insertarAsegurado($aseg);
            }
            else
            {
                $no_aseg=new No_Asegurado();
                $no_aseg->setN_Seguridad_Social($_POST["num_seguro"]);
                $no_aseg->setDNI($DNI);
                (new No_Asegurado())->insertarNoAsegurado($no_aseg);



            }


            echo $blade
            ->view()
            ->make('vistaPacientes', compact('titulo', 'encabezado','nombre','pacientes'))
            ->render();
        }
        else
        {
            echo $blade
            ->view()
            ->make('vistaCreacionPacientes', compact('titulo', 'encabezado', 'DNILibre'))
            ->render();

        }

    }
    else{

            //$medicos=(new Usuario())->listadoMedicos();
            //$pacientes=(new Paciente())->listarPacientes();
            echo $blade
            ->view()
            ->make('vistaCreacionPacientes', compact('titulo', 'encabezado' ))
            ->render();
        
        
    }