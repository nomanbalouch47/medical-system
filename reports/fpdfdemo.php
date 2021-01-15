<?php 
include_once('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
	$pdf->SetFont('Arial','',18);
    $pdf->Cell(0,6,'RELIANCE MEDICAL LAB',0,1,'C');
    $pdf->Ln();
    $pdf->Cell(55,5,'Code 02/02/07',1,0);
    $pdf->Cell(0,6,'RAWALPINDI',0,1,'C');
    $pdf->Cell(25, 5, 'Date', 0, 0);
    $pdf->Ln();
    $pdf->Cell(0,6,'From:  --- To: ',0,1,'C');
    $pdf->Ln();
    $pdf->Cell(55, 5, 'DATE', 0, 0);
	$pdf->Cell(58, 5, 'SERIAL #', 0, 0);
	$pdf->Cell(25, 5, 'NAME', 0, 0);
	$pdf->Cell(52, 5, 'S/D/W/O', 0, 0);
	$pdf->Cell(55, 5, 'PP/CNIC #', 0, 0);
	$pdf->Cell(58, 5, 'COUNTRY', 0, 0);
	$pdf->Cell(55, 5, 'AGENCY', 0, 0);
	$pdf->Cell(55, 5, 'STATUS', 0, 0);
	$pdf->Line(10, 30, 200, 30);
    $pdf->Cell();
    $pdf->Ln(10);
$pdf->SetFont('Arial', '', 11);

$pdf->Cell(55, 5, 'Reference Code', 0, 0);
$pdf->Cell(58, 5, ': 23423', 0, 0);
$pdf->Cell(25, 5, 'Date', 0, 0);
$pdf->Cell(52, 5, ': 2019-12-24 12:55:30 AM', 0, 0);
$pdf->Ln(5);

$pdf->Cell(55, 5, 'Amount', 0, 0);
$pdf->Cell(58, 5, ': 2300', 0, 0);
$pdf->Cell(25, 5, 'Channel', 0, 0);
$pdf->Cell(52, 5, ': WEB', 0, 0);
$pdf->Ln(5);
$pdf->Cell(55, 5, 'Status', 0, 0);
$pdf->Cell(58, 5, ': 1', 0, 0);
$pdf->Line(10, 30, 200, 30);

$pdf->Ln(15);  //Line break
$pdf->Cell(55, 5, 'Product ID', 0, 0);
$pdf->Cell(58, 5, ': 1110112', 0, 0);
$pdf->Ln(5);
$pdf->Cell(55, 5, 'Tax Amount', 0, 0);
$pdf->Cell(58, 5, ': 0', 0, 0);
$pdf->Ln(5);
$pdf->Cell(55, 5, 'Product Service Charge', 0, 0);
$pdf->Cell(58, 5, ': 0', 0, 0);
$pdf->Ln(5);
$pdf->Cell(55, 5, 'Product Delivery Charge', 0, 0);
$pdf->Cell(58, 5, ': 0', 0, 0);
$pdf->Ln(5);

$pdf->Line(10, 60, 200, 60);
$pdf->Ln(10);  //Line break
$pdf->Cell(55, 5, 'Paid by', 0, 0);
$pdf->Cell(58, 5, ':  Noman', 0, 0);
$pdf->Ln(5);
$pdf->Line(155, 75, 195, 75);
$pdf->Ln(5);  //Line break
$pdf->Cell(140, 5, '', 0, 0);
$pdf->Cell(50, 5, ':  Signature', 0, 0, 'C');

$pdf->Output();

?>