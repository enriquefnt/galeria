<?php

define('FPDF_FONTPATH','../font/');
require('fpdf.php');





class PDF extends FPDF
{
//Pie de página
function Footer()
{
$this->SetY(-10);
$this->SetFont('Arial','IB',12);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
//Creación del objeto de la clase heredada

$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Times','B',18);
$pdf->Cell(40,10,utf8_decode($actiPdf['areaoperativa']),0,1);
$pdf->Output();
?>