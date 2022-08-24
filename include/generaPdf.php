<?php

define('FPDF_FONTPATH','../font/');
require('fpdf.php');

//include __DIR__ . '/../include/conect.php';
//include __DIR__ . '/../include/funciones.php';


$pdf=new FPDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Mi primera pagina pdf con FPDF!');
$pdf->Output();
?>