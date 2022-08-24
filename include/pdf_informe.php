<?php
define('FPDF_FONTPATH','../font/');
require('fpdf.php');

include __DIR__ . '/../include/conect.php';
include __DIR__ . '/../include/funciones.php';
//include __DIR__ . '/../font/';


$pdf=new PDF();
$pdf->Open();
$title='Actividad: ';
$pdf->SetTitle($title);
$pdf->SetAuthor('Referente');
$pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt');
$pdf->PrintChapter(2,'THE PROS AND CONS','20k_c2.txt');
$pdf->Output();
?>
