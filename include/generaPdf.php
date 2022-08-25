<?php

define('FPDF_FONTPATH','../font/');
require('fpdf.php');

include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';



//$query = $pdo->prepare('call `saltaped_actividades-promo`.paraInfPdf('.$_GET['id'].');');

$query = $pdo->prepare('call `saltaped_actividades-promo`.paraInfPdf(133);');
    	$query->execute();
    	$actiPdf = $query->fetch();	




$pdf=new FPDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,utf8_decode($actiPdf['descri']),1,0,'L');
$pdf->Ln();
$pdf->Cell(40,10,utf8_decode($actiPdf['areaoperativa']),0,1);
$pdf->AddPage();
$pdf->SetFont('Helvetica','BU',32);
$pdf->Cell(0,40, utf8_decode($actiPdf['locale']),1);
$pdf->Ln(60);
$pdf->Cell(0,50,utf8_decode($actiPdf['descri']),1,2,'L',0);
//$pdf->Output(utf8_decode($actiPdf['titulo']).'.pdf','I');
$pdf->Output();
?>

