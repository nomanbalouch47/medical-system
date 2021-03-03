<?php
require('mysql_table.php');
include('../include/functions.php');


if (isset($_POST['generate_report']) && ($_POST['result_date']) && ($_POST['custom_radio_2'])) {

    $resultDate = $_POST['result_date'];
    $serial_code = $_POST['custom_radio_2'];

    
    $process_query = get_lab_register_report_pdf($resultDate);

    //print_r($process_query);

} else {

    redirect('../lab_register_report','_self');
}


class PDF extends PDF_MySQL_Table
{

function Header()
{
    $this->Ln(10);
    global $resultDate;
    global $serial_code;

    $process_query2 = get_medical_lab_OrganInfo_pdf();
    while ($rows=mysqli_fetch_array($process_query2)) {
      $title = $rows['title'];
    }

    $res_date=date("d-m-Y",strtotime($resultDate));
    // Title
    $this->SetFont('Arial','B',18);
    $this->setFillColor(210,230,230);
    $this->SetX(8);
    $this->SetFont('Arial','B',14);
    $this->Cell(45,8,'Code 02/02/07',1,0, 'C',1);
    $this->SetX(93);
    $this->Cell(90,9,$title,0,0,'C',1);
    $this->SetFont('Arial','B',14);
    $this->SetX(230);
    $this->Cell(50,8,'Lab Register',1,0,'C',1);
    $this->Ln();
    $this->SetFont('Arial','',11);
    $this->Cell(270,5,'Results Dated: '.$res_date,0,0,'R');
    $this->Ln(3);
    $this->Ln();

    $this->setFillColor(230,230,230);
    $this->SetX(5);
    $this->Cell(15,22,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetFont('Arial','B',8);
    $this->SetX(5);
    $this->Cell(15, 35, $serial_code, 0, 0,'L');
    $this->Ln(14);
    $this->SetX(20);
    $this->Cell(32, 22,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(20);
    $this->Cell(32, 35, 'Name', 0, 0,'C');
    $this->Ln(14);
    $this->SetX(52);
    $this->Cell(10, 22,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(52);
    $this->Cell(10, 35, 'RBS', 0, 0);
    $this->Ln(12);
    $this->Ln(2);
    $this->SetX(62);
    $this->Cell(15, 22,'',1,0,'',1);
    $this->Ln(-12);
    $this->SetX(62);
    $this->Cell(18, 35, 'Serum', 0, 0);
    $this->Ln(6);
    $this->SetX(61.5);
    $this->Cell(18, 30, 'Creatinine', 0, 0);
    $this->Ln(6);
    $this->SetX(62);
    $this->Cell(18, 25, 'mg/dl', 0, 0);
    // $this->Ln(2);
    $this->SetX(77);
    $this->Cell(12, 22,'',1,0,'',1);
    $this->Ln(-12);
    $this->SetX(77);
    $this->Cell(12, 35, 'VDRL/', 0, 0);
    $this->Ln(4);
    $this->SetX(77);
    $this->Cell(12, 34, 'TPHA', 0, 0);
    $this->Ln(6);
    $this->Ln(2);
    $this->SetX(89);
    $this->Cell(37, 8,'',1,0,'',1);
    $this->SetX(86);
    $this->Cell(45, 8, 'L.F.T', 0, 0,'C');
    $this->Ln(8);
    $this->SetX(89);
    $this->Cell(13, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(89);
    $this->Cell(13, 32, 'Serum', 0, 0);
    $this->Ln(6);
    $this->SetX(89);
    $this->Cell(13, 27, 'Bilirubin', 0, 0);
    $this->Ln(6);
    $this->SetX(89);
    $this->Cell(13, 22, 'mg/dl', 0, 0);
    $this->Ln(2);
    $this->SetX(102);
    $this->Cell(8, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(102);
    $this->Cell(8, 32, 'ALT', 0, 0);
    $this->Ln(6);
    $this->SetX(102);
    $this->Cell(8, 27, 'U/L', 0, 0);
    $this->Ln(6);
    $this->Ln(2);
    $this->SetX(110);
    $this->Cell(8, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(110);
    $this->Cell(8, 32, 'AST', 0, 0);
    $this->Ln(6);
    $this->SetX(110);
    $this->Cell(8, 27, 'U/L', 0, 0);
    $this->Ln(6);
    $this->Ln(2);
    $this->SetX(118);
    $this->Cell(8, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(118);
    $this->Cell(8, 32, 'ASK', 0, 0);
    $this->Ln(6);
    $this->SetX(118);
    $this->Cell(8, 27, 'PO4', 0, 0);
    $this->Ln(6);
    $this->SetX(118);
    $this->Cell(8, 22, 'U/L', 0, 0);
    $this->Ln(6);
    $this->Ln(-12);
    $this->SetX(126);
    $this->Cell(35, 8,'',1,0,'',1);
    $this->SetX(126);
    $this->Cell(35, 8, 'BLOOD', 0, 0,'C');
    $this->Ln(8);
    $this->SetX(126);
    $this->Cell(10, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(126);
    $this->Cell(10, 32, 'HB', 0, 0);
    $this->Ln(6);
    $this->SetX(126);
    $this->Cell(10, 27, 'g/dl', 0, 0);
    $this->Ln(8);
    $this->SetX(136);
    $this->Cell(25, 6,'',1,0,'',1);
    $this->SetX(136);
    $this->Cell(25, 6, 'Thick Film', 0, 0,'C');
    $this->Ln(6);
    $this->SetX(136);
    $this->Cell(13, 8,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(136);
    $this->Cell(13, 32, 'Malarial', 0, 0);
    $this->Ln(6);
    $this->SetX(136);
    $this->Cell(13, 26, 'Parasite', 0, 0);
    $this->Ln(8);
    $this->SetX(149);
    $this->Cell(12, 8,'',1,0,'',1);
    $this->Ln(-14);
    // $this->SetFont('Arial','B',7);
    $this->SetX(149);
    $this->Cell(12, 32, 'Micro-', 0, 0);
    $this->Ln(6);
    $this->SetX(149);
    $this->Cell(12, 26, 'filaria', 0, 0);
    $this->Ln(-6);
    // $this->SetFont('Arial','B',8);
    $this->SetX(161);
    $this->Cell(11, 22,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(161);
    $this->Cell(11, 35, 'Blood', 0, 0);
    $this->Ln(6);
    $this->SetX(161);
    $this->Cell(11, 30, 'Group', 0, 0);
    $this->Ln(8);
    $this->SetX(172);
    $this->Cell(24, 8,'',1,0,'',1);
    $this->SetX(170);
    $this->Cell(30, 8, 'ELISA', 0, 0,'C');
    $this->Ln(8);
    $this->SetX(172);
    $this->Cell(8, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(172);
    $this->Cell(8, 32, 'HBs', 0, 0);
    $this->Ln(6);
    $this->SetX(172);
    $this->Cell(8, 27, 'Ag', 0, 0);
    $this->Ln(8);
    $this->SetX(180);
    $this->Cell(8, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(180);
    $this->Cell(8, 32, 'HIV', 0, 0);
    $this->Ln(6);
    $this->SetX(180);
    $this->Cell(8, 27, '1,2', 0, 0);
    $this->Ln(8);
    $this->SetX(188);
    $this->Cell(8, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(188);
    $this->Cell(8, 32, 'Anti', 0, 0);
    $this->Ln(6);
    $this->SetX(188);
    $this->Cell(8, 27, 'HCV', 0, 0);
    $this->SetX(196);
    $this->Cell(36, 8,'',1,0,'',1);
    $this->SetX(196);
    $this->Cell(36, 8, 'URINE', 0, 0,'C');
    $this->Ln(8);
    $this->SetX(196);
    $this->Cell(10, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(196);
    $this->Cell(10, 32, 'Sugar', 0, 0);
    $this->Ln(14);
    $this->SetX(206);
    $this->Cell(13, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(206);
    $this->Cell(13, 32, 'Albumin', 0, 0);
    $this->Ln(14);
    $this->SetX(219);
    $this->Cell(13, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(219);
    $this->Cell(13, 32, 'Bile', 0, 0);
    $this->Ln(6);
    $this->SetX(219);
    $this->Cell(13, 27, 'Salt/', 0, 0);
    $this->Ln(6);
    $this->SetX(219);
    $this->Cell(13, 22, 'pigment', 0, 0);
    $this->Ln(-6);
    $this->SetX(232);
    $this->Cell(20, 8,'',1,0,'',1);
    $this->SetX(232);
    $this->Cell(20, 8, 'STOOL', 0, 0,'C');
    $this->Ln(8);
    $this->SetX(232);
    $this->Cell(10, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(232);
    $this->Cell(10, 32, 'OVA', 0, 0);
    $this->Ln(14);
    $this->SetX(242);
    $this->Cell(10, 14,'',1,0,'',1);
    $this->Ln(-14);
    $this->SetX(242);
    $this->Cell(10, 32, 'Cyst', 0, 0);
    $this->Ln(6);
    $this->SetX(252);
    $this->Cell(15, 22,'',1,0,'',1);
    $this->SetX(252);
    $this->Cell(15, 8, 'Pregn-', 0, 0);
    $this->Ln(5);
    $this->SetX(252);
    $this->Cell(15, 5, 'ancy', 0, 0);
    $this->Ln(-8);
    $this->SetX(252);
    $this->Cell(15, 28, 'Test', 0, 0);
    $this->Ln(6);
    $this->SetX(252);
    $this->Cell(15, 22, '(Females', 0, 0);
    $this->Ln(6);
    $this->SetX(252);
    $this->Cell(15, 16, 'Only)', 0, 0);
    $this->Ln(-9);
    $this->SetX(267);
    $this->Cell(14, 22,'',1,0,'',1);
    $this->SetX(267);
    $this->Cell(14, 8, 'TB', 0, 0);
    $this->Ln(6);
    $this->SetX(267);
    $this->Cell(14, 5, 'Test', 0, 0);
    
    $this->Ln(16);
    // Ensure table header is printed
    parent::Header();
}

function Footer()
{
  if($this->isFinished){
        $this->Ln(14);
        $this->SetFont('Arial','',11);
        $this->SetY(-21);
        $this->SetX(216);
        $signature="../assets/img/lab_register_signature.png";
        $this->Cell(80,40,$this->Image($signature,$this->GetX(),$this->GetY(),32,18),0,0,'L',false);
        $this->SetY(-13);
        $this->SetX(180);
        $this->Cell(80,10,"Checked By   _______________________",0,0,'R');
        $this->Ln(5);
        $this->Cell(535,3,'Page '.$this->PageNo().' of {nb}'.$this->AliasNbPages().'',0,0,'C');

    //$this->Line(10, 30, 60, 30);
    // Ensure table footer is printed
    parent::Footer();
  }
}

}
  $pdf = new PDF();
  $pdf->isFinished = false;
  $pdf->AddPage('L', 'A4', '');
  $pdf->isFinished = true;
    
    while ($rows=mysqli_fetch_array($process_query)) {
          $barcode = $rows['code'];
          $serial_no = $rows['serial_no'];
          $cand_name = $rows['candidate_name'];
          $HCV = $rows['HCV'];
          $HBsAg = $rows['HBsAg'];
          $HIV = $rows['HIV'];
          $VDRL = $rows['VDRL'];
          $TPHA = $rows['TPHA'];
          $RBS = $rows['RBS'];
          $BIL = $rows['BIL'];
          $ALT = $rows['ALT'];
          $AST = $rows['AST'];
          $ALK = $rows['ALK'];
          $Creatinine = $rows['Creatinine'];
          $blood_group = $rows['blood_group'];
          $Haemoglobin = $rows['Haemoglobin'];
          $Malaria = $rows['Malaria'];
          $Micro_filariae = $rows['Micro_filariae'];
          $sugar = $rows['sugar'];
          $albumin = $rows['albumin'];
          $helminthes = $rows['helminthes'];
          $OVA = $rows['OVA'];
          $CYST = $rows['CYST'];
          $pregnancy = $rows['pregnancy'];
          $TB = $rows['TB'];

          $cand_nameUpper = strtoupper($cand_name);

          $pdf->SetFont('Arial','',9);
          $pdf->SetX(5);
          if($serial_code=="S.No") {
            $pdf->Cell(15, 6, $serial_no, 1,0,'C');
          } else {  
            $pdf->Cell(15, 6, $barcode, 1,0,'C');
          }
          // $pdf->Cell(32, 6, $cand_nameUpper, 1, 0,'C');
          // $remarksUpper = strtoupper($remarks);
          if($pdf->GetStringWidth($cand_nameUpper) < 38){
          $pdf->SetFont('Arial','',7);
          // $pdf->SetMargins(0,1);
          // $pdf->setFillColor(210,230,230);
          $pdf->SetX(20);
          $pdf->MultiCell(32,6,$cand_nameUpper,1,'C');
          $pdf->Ln(-6);
          $pdf->SetFont('Arial','',9);
          $pdf->SetX(52);
          }
          elseif($pdf->GetStringWidth($cand_nameUpper) >= 38){
          $pdf->SetFont('Arial','',7);
          // $pdf->SetMargins(0,1);
          // $pdf->setFillColor(210,230,230);
          $pdf->SetX(20);
          $pdf->MultiCell(32,3,$cand_nameUpper,1,'C');
          $pdf->Ln(-6);
          $pdf->SetFont('Arial','',9);
          $pdf->SetX(52);
          }
          // else{
          //     // $this->Ln(-7);
          //     $pdf->SetX(25);
          //     $pdf->Cell(32,6,$cand_nameUpper,1,'C');
          // }
          $pdf->Cell(10, 6, $RBS, 1, 0,'C');
          $pdf->Cell(15, 6, $Creatinine, 1, 0,'C');
          if($VDRL=='positive' || $TPHA == 'positive') {
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(12, 6, '+VE'.'/ +VE', 1, 0,'C');
          }
          else {
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(12, 6, '-VE'.'/ -VE', 1, 0,'C');
          }
          
          $pdf->Cell(13, 6, $BIL, 1, 0,'C');
          $pdf->Cell(8, 6, $ALT, 1, 0,'C');
          $pdf->Cell(8, 6, $AST, 1, 0,'C');
          $pdf->Cell(8, 6, $ALK, 1, 0,'C');
          $pdf->Cell(10, 6, $Haemoglobin, 1, 0,'C');
          $pdf->Cell(13, 6, $Malaria, 1, 0,'C');
          $pdf->Cell(12, 6, $Micro_filariae, 1, 0,'C');
          $pdf->Cell(11, 6, $blood_group, 1, 0,'C');
          if($HBsAg=='positive') {
            $pdf->Cell(8, 6, '+VE', 1, 0,'C');
          }
          else {
            $pdf->Cell(8, 6, '-VE', 1, 0,'C');
          }
          if($HIV=='positive') {
            $pdf->Cell(8, 6, '+VE', 1, 0,'C');
          }
          else {
            $pdf->Cell(8, 6, '-VE', 1, 0,'C');
          }
          if($HCV=='positive') {
            $pdf->Cell(8, 6, '+VE', 1, 0,'C');
          }
          else {
            $pdf->Cell(8, 6, '-VE', 1, 0,'C');
          }
          if($sugar=='positive') {
            $pdf->Cell(10, 6, '+VE', 1, 0,'C');
          }
          else {
            $pdf->Cell(10, 6, '-VE', 1, 0,'C');
          }
          if($albumin=='positive') {
            $pdf->Cell(13, 6, '+VE', 1, 0,'C');
          }
          else {
            $pdf->Cell(13, 6, '-VE', 1, 0,'C');
          }
          $pdf->Cell(13, 6, '-VE', 1, 0,'C');  // not clear
          $pdf->Cell(10, 6, $OVA, 1, 0,'C');
          $pdf->Cell(10, 6, $CYST, 1, 0,'C');
          $pdf->Cell(15, 6, $pregnancy, 1, 0,'C');
          $pdf->Cell(14, 6, $TB, 1, 1,'C');
        }

  //$pdf->Footer();
  $pdf->Output();

?>