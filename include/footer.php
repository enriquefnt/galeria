<?php

define('FPDF_FONTPATH','../font/');
require('fpdf.php');
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';
include __DIR__ . '/../include/clases.php';

$query = $pdo->prepare('call `saltaped_actividades-promo`.paraInfPdf(133);');
    	$query->execute();
    	$actiPdf = $query->fetch();	

$title= $actiPdf['titulo'];


$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);
$pdf->Cell(40,10,utf8_decode($actiPdf['areaoperativa']),0,0);
$pdf->Ln();
$pdf->SetFont('Times','',12);
$pdf->Cell(40,10,utf8_decode($actiPdf['descri']),0,0);
$pdf->Output();
?>