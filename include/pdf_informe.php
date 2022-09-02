<?php

define('FPDF_FONTPATH','../font/');
require('fpdf.php');


include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';
include __DIR__ . '/../include/clases.php';

$query = $pdo->prepare('call `saltaped_actividades-promo`.paraInfPdf(133);');
    	$query->execute();
    	$actiPdf = $query->fetch();	

$sql='call fotosActividad(133);';
$imagenesActividad = $pdo_ub->query($sql);
//$totalImagenes = $imagenesActividad->rowCount();

$title= utf8_decode('Informe de actividad de Promoción');
$texto= utf8_decode($actiPdf['descri']);



$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,7,utf8_decode('Actividad: '.$actiPdf['titulo']),0,0);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,7,utf8_decode('Área Operativa: '.$actiPdf['areaoperativa']),0,0);
$pdf->Ln();
$pdf->Cell(0,7,utf8_decode('Fecha: '.$actiPdf['fecha']),0,0);
$pdf->Ln();

$pdf->Cell(0,7,utf8_decode('Lugar: '.$actiPdf['locale']),0,0);
$pdf->Ln();
$pdf->Cell(0,7,utf8_decode('Tema principal: '.$actiPdf['temas']),0,0);
if (isset($actiPdf['modalidades'])) {
	$pdf->Ln();
$pdf->Cell(0,7,utf8_decode('Modalidad: '.$actiPdf['modalidades']),0,0);
}
$pdf->Ln();
$pdf->Cell(0,7,utf8_decode('Dirigido a: '.$actiPdf['participantes']),0,'L');
$pdf->WriteHTML('<div><p align="center">'.$texto.'<br>Participaron '.$actiPdf['total'].' personas. </p></div>');
$pdf->Ln(15);

$pdf->SetFont('Arial','B',12);
//$pdf->Cell(25);
$pdf->Cell(0,7,utf8_decode('Imágenes:'),0,0,'B');
$current_x = $pdf->GetX();
$current_y = $pdf->GetY();
$count=0;
$xy=10;

foreach ($imagenesActividad as $imagen): 
if ($count > (0-1) && $count < 3) {
	$pdf->Image($imagen['archivo'],$xy ,$current_y+9, 58, 38 );
}
$count =$count+1;
$xy = $xy+60;
endforeach;

$pdf->SetY($current_y+58);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,7,utf8_decode('Referente: '.$actiPdf['referente']),0,0);
$pdf->Ln();
$pdf->Output();
?>