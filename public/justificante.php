<?php
use Clases\Paciente;
use Clases\Medico;
use Clases\Consulta;

$nombreImagen = "images/LogoFactory.jpg";
$imagenBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($nombreImagen));

$datosPaciente=(new Paciente)->datosPaciente($SESSION['DNIP']);
$datosConsulta=(new Consulta)->datosConsulta($SESSION['IDC']);
$datosMedico=(new Medico)->datosMedico($SESSION['LOGINM']);

?>


<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Justificante
    </title>   
</head>
<body>

<img src="<?php echo $imagenBase64 ?>" alt="logo clinica" height="15%">
<hr>
<h1><u>Justificante de asistencia</u></h1>
<h3 class="rounded">
El paciente <?php foreach($datosPaciente as $datosP){ echo $datosP->nombre." ".$datosP->apellidos;}?> 
con DNI <?php echo $datosP->DNI; ?>
 acudió el día <?php foreach($datosConsulta as $datosC){ 
    $arFecha = explode('-',$datosC->fecha);  
    //ahora inviertes el array fecha
    $arInvFecha = array_reverse($arFecha);
    //Por último pegas los elementos del array mediante la -
    $final = implode('-',$arInvFecha);
    
    echo $final." a las ".$datosC->hora;}?> 
 horas siendo asistido por Dr <?php foreach($datosMedico as $datosM){ echo $datosM->nombre." ".$datosM->apellidos;}?>
</h3>  
<i class="align-text-bottom">
Justificante generado el <?php echo date("d-m-Y H:i:s");?></i>

</body>
</html>
