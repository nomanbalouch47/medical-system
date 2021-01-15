<?php
require('mysql_table.php');
include('../include/functions.php');

if (isset($_POST['generate_report'])) {

    $regDate = $_POST['reg_date'];
    $country_arr = $_POST['countries'];

    $search_date = date("d-m-Y",strtotime($_POST['reg_date']));
    
    // $country = implode(',',$country_arr);

    $process_query = get_slip_expiry_report_pdf($regDate,$country_arr);

    //print_r($process_query);

} else {

    redirect('../medical_slip_expiry_report','_self');
}

class PDF extends PDF_MySQL_Table
{

function Header()
{
    //$this->
    // Ensure table header is printed
    parent::Header();
}

function Body()
{
    global $process_query;

    // $total=0;
    
    $this->SetFont('Times','B',10);
    $this->setFillColor(210,230,230);
    $this->SetX(10);
    $this->Cell(25, 15,'',1,0,'',1);
    $this->SetX(20);
    $this->Cell(5,11, 'PASSPORT', 0, 0,'C');
    $this->Ln(2);
    $this->SetX(20);
    $this->Cell(5,15,'NO.',0,0,'C');
    $this->Ln(-2);
    $this->SetX(35);
    $this->Cell(20,15,'S.NO.',1,0,'C',1);
    $this->SetX(55);
    $this->Cell(30, 15,'',1,0,'',1);
    $this->SetX(48);
    $this->Cell(45,11, 'PLACE OF', 0, 0,'C');
    $this->Ln(2);
    $this->SetX(55);
    $this->Cell(30,15,'ISSUE',0,0,'C');
    $this->Ln(-2);
    $this->SetX(85);
    $this->Cell(30, 15,'',1,0,'',1);
    $this->SetX(85);
    $this->Cell(25,11,'SLIP ISSUE ',0,0,'C');
    $this->Ln(2);
    $this->SetX(82);
    $this->Cell(30,15,'DATE',0,0,'C');
    $this->Ln(-2);
    $this->SetX(110);
    $this->Cell(25,15,'SLIP EXPIRY',1,0,'C',1);
    $this->Cell(45,15,'COMMENTS',1,0,'C',1);
    $this->Cell(20,15,'STATUS',1,1,'C',1);
    $this->SetX(10);
    $this->SetFont('Arial','',9);
    
    while ($rows = mysqli_fetch_array($process_query)) {

        $passport_no = $rows['passport_no'];
        $serial_no = $rows['serial_no'];
        $place_of_issue = $rows['place_of_issue'];
        $slip_issue_date = $rows['slip_issue_date'];
        $slip_expiry_date = $rows['slip_expiry_date'];
        $remarks = $rows['remarks'];

        $slip_issue_date_strd=date("d/m/Y",strtotime($slip_issue_date));
        $slip_expiry_date_strd=date("d/m/Y",strtotime($slip_expiry_date));
        
        // $x = $this->GetX();
        // $y = $this->GetY();
          // $this->Ln(2);
          $this->MultiCell(25,8,$passport_no,1,'C');
          $this->Ln(-8);
          $this->SetX(35);
          $this->MultiCell(20,8,$serial_no,1,'C');
          $this->Ln(-8);
          $this->SetX(55);
          $this->MultiCell(30,8,$place_of_issue,1,'C');
          $this->Ln(-8);
          $this->SetX(85);
          $this->MultiCell(25,8,$slip_issue_date_strd,1,'C');
          $this->Ln(-8);
          $this->SetX(110);
          $this->MultiCell(25,8,$slip_expiry_date_strd,1,'C');
          $this->Ln(-8);
          // $this->SetFont('Arial','',9);
          $remarksUpper = strtoupper($remarks);
          if($this->GetStringWidth($remarksUpper) > 65){
          $this->SetFont('Arial','',7);
          // $pdf->SetMargins(0,1);
          $this->setFillColor(210,230,230);
          $this->SetX(135);
          $this->MultiCell(45,4,$remarksUpper,1,'C',1);
          $this->Ln(-8);
          $this->SetFont('Arial','',9);
          }else{
              // $this->Ln(-7);
              $this->SetX(135);
              $this->ClippedCell(45,8,$remarksUpper,1,'C');
          }
          // $this->SetX(140);
          // $this->MultiCell(40,9,$remarksUpper,1,'C',0);
          $this->SetX(180);
          $this->MultiCell(20,8,'',1,'C');
          // $this->Ln(-9);
          // $this->Ln(-1);
          // $this->Ln(9);
          //  $this->Ln(18);
          //$this->Ln(-9);

    }
          /*$this->SetFont('Arial','B',11);
          $this->Cell(50,9,'Total Receipts',1,0,'L');
          $this->Cell(15,9,'',1,0,'L');
          $this->Cell(20,9,'',1,0,'L');
          $this->Cell(20,9,number_format($total),1,0,'R');
          $this->Cell(85,9,'',1,1,'L');

          //discount section
          $disc_row = mysqli_fetch_array($discount_query);
          $total_disc = $disc_row['total_discount'];
          $this->Cell(50,9,'Discount',1,0,'L');
          $this->Cell(15,9,'',1,0,'L');
          $this->Cell(20,9,'',1,0,'L');
          $this->Cell(20,9,number_format($total_disc),1,0,'R');
          $this->Cell(85,9,'',1,1,'L');

          //total section
          $this->Cell(50,9,'Cash in Hand',1,0,'L');
          $this->Cell(15,9,'',1,0,'L');
          $this->Cell(20,9,'',1,0,'L');
          $this->Cell(20,9,number_format($total-$total_disc),1,0,'R');
          $this->Cell(85,9,'',1,1,'L');*/
       

    $this->Ln(6);
}

function Footer()
{
  global $login_name;

  if($this->isFinished){
        $this->Ln(2);
        
        /*$this->SetFont('Arial','',12);
        $this->Ln(3);
        $this->Cell(140,10, 'Prepared By:', 0, 0);
        
        $this->Ln(6);
        $this->Cell(100,10, ucfirst($login_name), 0, 0);*/
        
    // Ensure table footer is printed
    parent::Footer();
  }
}

}
	  $pdf = new PDF();
    $pdf->isFinished = false;
	  $pdf->AddPage('P', 'A4', '0');
    $pdf->isFinished = true;
    global $medical_lab_title;
    // $today_date = date("d-m-Y");

      $process_query2 = get_medical_lab_OrganInfo_pdf();
      $query_result2=mysqli_fetch_array($process_query2);
      $address = $query_result2['address'];
      $medical_lab_title = $query_result2['title'];
      $phone_no = $query_result2['phone_no'];
      $phone_no_2 = $query_result2['phone_no_2'];
      $fax_no = $query_result2['fax_no'];

    // Title
    $pdf->SetFont('Arial','B',14);
    $pdf->Ln(2);
    $pdf->setFillColor(210,230,230);
    $pdf->SetX(70); //The next cell will be set 100 units to the right
    $pdf->Cell(70,10,$medical_lab_title,0,1,'C',1);
    $pdf->Ln(2);

    $pdf->SetFont('Arial','',12);
    $pdf->setFillColor(230,230,230);
    $pdf->Ln(-1);
    $pdf->SetX(65);
    $pdf->Cell(80,8,'Medical Slip Expiry List',0,1,'C',1);
    $pdf->Cell(0,6,'Date:'.$search_date,0,1,'R');
    $pdf->Ln(6);

    $pdf->Body();

 
  $pdf->Output();

?>