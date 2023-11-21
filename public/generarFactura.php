<?php
require '../vendor/autoload.php';
use Clases\Factura;
date_default_timezone_set("Europe/Madrid");


$SESSION['DNIP']=$_GET['DNI'];
$SESSION['IDC']=$_GET['id'];

// reference the Dompdf namesface
use Dompdf\Dompdf;

$fac=new Factura();

$dtz = new DateTimeZone("Europe/Madrid"); //Your timezone
$now = new DateTime(date("Y-m-d"), $dtz);

$ahora=$now->format("Y-m-d");
$fac->setFecha($ahora);
$fac->setId_consulta($SESSION['IDC']);



(new Factura())->insertarFactura($fac);




// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
include "factura.php";
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
