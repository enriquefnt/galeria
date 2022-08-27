<?php

define('FPDF_FONTPATH','../font/');
require('fpdf.php');
include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';
include __DIR__ . '/../include/clases.php';

$query = $pdo->prepare('call `saltaped_actividades-promo`.paraInfPdf(133);');
    	$query->execute();
    	$actiPdf = $query->fetch();	

$title= utf8_decode('Informe de actividad de Promoción');
$texto= utf8_decode($actiPdf['descri']);


$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,utf8_decode('Área Operativa: '.$actiPdf['areaoperativa']),0,0);
$pdf->Ln();
$pdf->Cell(0,8,utf8_decode('Lugar: '.$actiPdf['locale']),0,0);
$pdf->Ln();
$pdf->Cell(0,8,utf8_decode('Tema principal: '.$actiPdf['temas']),0,0);
if (isset($actiPdf['modalidades'])) {
	$pdf->Ln();
$pdf->Cell(0,8,utf8_decode('Modalidad: '.$actiPdf['modalidades']),0,0);
}
$pdf->Ln();
$pdf->Multicell(0,5,utf8_decode('  '.$actiPdf['descri']),0,'L');
$pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
//$pdf->WriteHTML("<div style='text-align: justify;'".$texto."</div>");


$pdf->Image('../imagenes/cierreLM.jpg',10 ,98, 55, 38 );
$pdf->Image('../imagenes/IMG-20220801-WA0038.jpg',70 ,98, 55, 38 );
$pdf->Image('../imagenes/IMG-20220801-WA0047.jpg',130 ,98, 55, 38 );
$pdf->Output();
?>