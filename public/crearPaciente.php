<?php
//Clase crearPaciente.php realizada por Paula Salicio
require '../vendor/autoload.php';


use Clases\Paciente;
use Clases\Asegurado;
use Clases\No_Asegurado;
use Philo\Blade\Blade;


$views = '../views'; //variables para usar en las plantillas de blade
$cache = '../cache';
$blade = new Blade($views, $cache);
$titulo = '';
$encabezado = 'Creación de paciente';
session_start();

    function error($mensaje)
    {
        $_SESSION['error'] = $mensaje; //funcion para controlar errorres
        header('Location:index.php');
        die();
    }
    
    if (isset($_POST['crear'])) { //si la variable crear está definida, significa que el usuario
        // ha pulsado el botón crear del formulario
        
        $fecha_nacimiento=$_POST['fecha_nacimiento'];
        $nombre_paciente=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $DNI=$_POST['DNI'];
        $telefono=$_POST['telefono'];
        $esAsegurado=$_POST['asegurado'];

        $DNILibre=(new Paciente())->comprobarDNILibre($DNI); //comprobamos que el dni del paciente esté libre
        if($DNILibre==true)
        {

            $pac=new Paciente();
            $pac->setDNI($DNI);
            $pac->setNombre($nombre_paciente);
            $pac->setApellidos($apellidos);
            $pac->setFecha_nacimiento($fecha_nacimiento);
            $pac->setTelefono($telefono);



            (new Paciente())->insertarPaciente($pac); //insertamos los datos en la BBDD
            $pacientes=(new Paciente())->listarPacientes();
            $nombre=$_SESSION['login'];
            $encabezado="Listado de pacientes";

            if($esAsegurado=="si") //si el paciente es asegurado
            {
                $aseg=new Asegurado();
                $aseg->setN_Seguro($_POST["num_seguro"]);
                $aseg->setDNI($DNI);
                (new Asegurado())->insertarAsegurado($aseg);
            }
            else //si es no asegurado
            {
                $no_aseg=new No_Asegurado();
                $no_aseg->setN_Seguridad_Social($_POST["num_seguro"]);
                $no_aseg->setDNI($DNI);
                (new No_Asegurado())->insertarNoAsegurado($no_aseg);



            }


            echo $blade //llamada a las plantillas blade
            ->view()
            ->make('vistaPacientes', compact('titulo', 'encabezado','nombre','pacientes'))
            ->render();
        }
        else
        {
            echo $blade //llamada a las plantillas blade
            ->view()
            ->make('vistaCreacionPacientes', compact('titulo', 'encabezado', 'DNILibre'))
            ->render();

        }

    }
    else{

            
            echo $blade //llamada a las plantillas blade
            ->view()
            ->make('vistaCreacionPacientes', compact('titulo', 'encabezado' ))
            ->render();
        
        
    }