<?php
//Clase generarFactura.php realizada por Paula Salicio
//En esta clase mediante DOMPdf vamos a obtener el pdf de la factura

require '../vendor/autoload.php';
use Clases\Factura;
use Dompdf\Dompdf;
date_default_timezone_set("Europe/Madrid");

$SESSION['DNIP']=$_GET['DNI']; //con sesiones obtenemos los valores GET para pasarlos a factura.php
$SESSION['IDC']=$_GET['id'];


$fac=new Factura();

$dtz = new DateTimeZone("Europe/Madrid"); 
$now = new DateTime(date("Y-m-d"), $dtz);

$ahora=$now->format("Y-m-d");
$fac->setFecha($ahora);
$fac->setId_consulta($SESSION['IDC']);

(new Factura())->insertarFactura($fac); //insertamos factura en la tabla factura

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
include "factura.php"; //usamos el formato de factura.php para crear la factura
$html = ob_get_clean();
$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('factura.pdf',['Attachment'=>true]);

unset($SESSION['DNIP']);
unset($SESSION['IDC']);
