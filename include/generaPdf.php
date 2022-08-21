<?php
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';
//include_once('fpdf.php');


require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
?>