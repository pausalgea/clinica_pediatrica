<?php
//Clase generarJustificante.php realizada por Paula Salicio
//En esta clase mediante DOMPdf vamos a obtener el pdf del justificante
// reference the Dompdf namespace
use Dompdf\Dompdf;
require '../vendor/autoload.php';

$SESSION['DNIP']=$_GET['DNI'];
$SESSION['IDC']=$_GET['id_consulta'];
$SESSION['LOGINM']=$_GET['login'];


// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
include "justificante.php";
$html = ob_get_clean();
$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('justificante.pdf',['Attachment'=>true]);

unset($SESSION['DNIP']);
unset($SESSION['IDC']);
unset($SESSION['LOGINM']);

