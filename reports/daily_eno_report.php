<?php
require('mysql_table.php');
include('../include/functions.php');

if(isset($_POST['generate_report'])) {

  $enoDate = date('Y-m-d', strtotime($_POST['eno_date']));
  $process_query = get_daily_eno_report_pdf($enoDate);

}

class PDF extends PDF_MySQL_Table
{

function Header()
{
    global $enoDate;
    $today_date = date("d-m-Y");
    // Title
    $this->SetFont('Arial','',14);
    $this->setFillColor(210,230,230);
    $this->SetX(120);
    $this->SetX(10);
    $this->Ln();
    $this->SetX(52);
    $this->Cell(100,8,' RELIANCE MEDICAL LAB ',0,1,'C',1);
    $this->SetX(70);
    $this->setFillColor(230,230,230);
    $this->SetX(65);
    $this->Cell(70,6,' E.No Daily Updating List ',0,0,'C',1);
    $this->Ln(1);
    $this->SetFont('Arial','',10);
    $this->SetX(125);
    $this->Cell(52,4,' Date: ',0,0,'R');
    $eno_date=date("d-m-Y",strtotime($enoDate));
    $this->Cell(60,4, $eno_date,0,0,'L');
    $this->SetFont('Arial','',12);
    $this->Cell(280,5,$today_date,0,0,'R');
    $this->Ln(6);
    $this->SetFont('Arial','',11);
    $this->SetX(6);
    $this->Cell(6, 9, '#', 1, 0,'',1);
    $this->Cell(20, 9, 'Date', 1, 0,'',1);
    $this->Cell(18, 9, 'S.No', 1, 0,'',1);
    $this->Cell(20, 9, "Web Date", 1, 0,'',1);
    $this->Cell(50, 9, 'Name', 1, 0,'',1);
    $this->Cell(30, 9, 'PP.No', 1, 0,'',1);
    $this->Cell(25, 9, 'E.No', 1, 0,'',1);
    $this->Cell(28, 9, 'Remarks', 1, 0,'',1);
    
    $this->Ln(9);
    // Ensure table header is printed
    parent::Header();
}

function Footer()
{
  if($this->isFinished){
        $this->Ln(4);
        $this->SetFont('Arial','',11);

        // $this->Ln(20);
        $this->SetY(-23);
        $this->Cell(140,10, "  ______________", 0, 0);
        $this->SetX(85);
        $this->Cell(140,10, "  ______________", 0, 0);
        $this->SetX(160);
        $this->Cell(140,10, "______________", 0, 0);

        $this->Ln(5);
        $this->Cell(100,10, '      Prepared By ', 0, 0);
        $this->SetX(85);
        $this->Cell(100,10, '      Verified By ', 0, 0);
        $this->SetX(160);
        $this->Cell(100,10, '     Updated By ', 0, 1);

        $this->Cell(330,10,'Page '.$this->PageNo().' of {nb}'.$this->AliasNbPages().'',0,0,'L');

    // Ensure table footer is printed
    parent::Footer();
  }
}

}
    $pdf = new PDF();
    $pdf->isFinished = false;
    $pdf->AddPage('P', 'A4', '0');
    $pdf->isFinished = true;
    // horizontal line
    //  $pdf->Line(10, 30, 345, 30);
    // $pdf->Ln(3);
    if(isset($process_query)) {
      $i=1;
      while ($rows=mysqli_fetch_array($process_query)) {
            
            $reg_date = $rows['reg_date'];
            $serial_no = $rows['serial_no'];
            $candidate_name = $rows['candidate_name'];
            $pp_no = $rows['passport_no'];
            $eno = $rows['eno'];

            $regDate=date("d-m-Y",strtotime($reg_date));
            $cand_nameUpper = strtoupper($candidate_name);

            $pdf->SetFont('Arial','',9);
            $pdf->SetX(6);
            $pdf->Cell(6, 8, $i, 1, 0);
            $pdf->Cell(20, 8, $regDate, 1, 0);
            $pdf->Cell(18, 8, $serial_no, 1, 0);
            $pdf->Cell(20, 8, '', 1, 0);

              if($pdf->GetStringWidth($cand_nameUpper) >= 50 && $pdf->GetStringWidth($cand_nameUpper) <= 62){
                  $pdf->SetFont('Arial','',7);
                  $pdf->MultiCell(50,8,$cand_nameUpper,1,'',0);
                  $pdf->Ln(-8);
                  $pdf->SetX(120);
              
              } elseif($pdf->GetStringWidth($cand_nameUpper) > 65){
                  $pdf->SetFont('Arial','',7);
                  $pdf->MultiCell(50,4,$cand_nameUpper,1,'',0);
                  $pdf->Ln(-8);
                  $pdf->SetX(120);
              }else{

                  $pdf->ClippedCell(50,8,$cand_nameUpper,1,'C');
              }
              $pdf->SetFont('Arial','',9);
            // $pdf->ClippedCell(50, 8, $cand_nameUpper, 1,0);
            $pdf->Cell(30, 8, $pp_no, 1, 0);
            $pdf->Cell(25, 8, $eno, 1, 0);
            $pdf->Cell(28, 8, '', 1, 1);
            if($i==26)
            {
              $pdf->AddPage('P', 'A4', '0');
            }
            $i++;
        }
      }
        else {
          redirect('../daily_eno_report','_self');
        }
 
  $pdf->Output();

?>