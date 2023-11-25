<?php
//Clase Factura.php realizada por Paula Salicio
//en esta clase vamos a generar el formato que va a tener el pdf del archivo factura
use Clases\Paciente;
use Clases\Factura;

//tenemos una imagen con el logo dela clinica, hacemos una conversión a formato base64 de la imagen
$nombreImagen = "images/LogoFactory.jpg";
$imagenBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($nombreImagen));

$datosPaciente=(new Paciente)->datosPaciente($SESSION['DNIP']);
$datosFactura=(new Factura)->datosFactura($SESSION['IDC']);

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
    <title>Factura
    </title>   
</head>
<body>

<img src="<?php echo $imagenBase64 ?>" alt="logo clinica" height="15%">
<hr>


<h1><u>Factura</u></h1>

<button type="button" class="btn btn-secondary">Nº Factura: <?php foreach($datosFactura as $datosF){ echo $datosF->n_factura;}?></button>

<button type="button" class="btn btn-secondary">Fecha: <?php foreach($datosFactura as $datosF){
$arFecha = explode('-',$datosF->fecha);  
    //invertimos el array fecha, para obtener la fecha en formato dd-mm-YY
    $arInvFecha = array_reverse($arFecha);
    //pegamos los elementos del array mediante la -
    $final = implode('-',$arInvFecha);
    
    echo $final;}?></button>



<h1><u>Consulta</u></h1>
<button type="button" class="btn btn-secondary btn-lg">Id de consulta: <?php foreach($datosFactura as $datosF){ echo $datosF->id_consulta;}?></button>

<h1><u>Paciente</u></h1>
<button type="button" class="btn btn-secondary">Nombre: <?php foreach($datosPaciente as $datosP){ echo $datosP->nombre;}?></button>

<button type="button" class="btn btn-secondary">Apellidos: <?php foreach($datosPaciente as $datosP){ echo $datosP->apellidos;}?></button>

<button type="button" class="btn btn-secondary">DNI: <?php foreach($datosPaciente as $datosP){ echo $datosP->DNI;}?></button>

<button type="button" class="btn btn-secondary">Teléfono: <?php foreach($datosPaciente as $datosP){ echo $datosP->telefono;}?></button>

<h1><u>Importe</u></h1>
<button type="button" class="btn btn-secondary">Importe: <?php foreach($datosPaciente as $datosP){ echo $datosF->importe." € (IVA incluido)";}?></button>




</body>
</html>