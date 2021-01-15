<?php
require('mysql_table.php');
include('../include/functions.php');


if (isset($_GET['from']) && ($_GET['to'])) {

    $from_date = $_GET['from'];
    $to_date = $_GET['to'];

    $process_query = get_history_pdf($from_date,$to_date);

} else {

     //echo 'show record upto 50 rows';
     $process_query = get_history_pdf();
}


//print_r($rowsData);

class PDF extends PDF_MySQL_Table
{

function Header()
{
    global $from_date;
    global $to_date;
    // global $city;
    // global $pdf_subtitle_reg_history;
    $today_date = date("d-m-Y");

    $process_query2 = get_medical_lab_OrganInfo_pdf();
    $query_result2=mysqli_fetch_array($process_query2);
    $address = $query_result2['address'];
    $city = $query_result2['city'];
    $medical_lab_title = $query_result2['title'];
    $phone_no = $query_result2['phone_no'];
    $phone_no_2 = $query_result2['phone_no_2'];
    $fax_no = $query_result2['fax_no'];

    // Title
    // $this->Ln(5);
    $this->SetFont('Arial','',18);
    $this->setFillColor(230,230,230);
    $this->SetX(133);
    $this->Cell(90,9,$medical_lab_title,0,1,'C',1);
    $this->Ln(1);
    // Code Section
    $this->SetFont('Arial','',14);
    $this->Cell(45,8,'Code 02/02/07',1,0, 'C',1);
    // Sub Title
    $this->SetFont('Arial','',16);
    $this->setFillColor(210,230,230);
    $this->SetX(133);
    $this->Cell(90,7,$city,0,0,'C',1);
    $this->SetFont('Arial','',14);
    $this->SetX(300);
    $this->Cell(20,5,$today_date,0,0,'R');
    $this->Ln(8);
    
    if($from_date=="" || $to_date=="")
    {
      $this->Cell(0,6,'From:  --- To:  ',0,1,'C');
    }
    else {
      $fromDate=date("d-m-Y",strtotime($from_date));
      $toDate=date("d-m-Y",strtotime($to_date));
      $this->Cell(0,6,'From: '.$fromDate.' --- To: '.$toDate.'',0,1,'C');  
    }
    
    // Page number
    $this->SetFont('Arial','',12);
    $this->Cell(595,8,'Page '.$this->PageNo().' of {nb}'.$this->AliasNbPages().'',0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','',14);
    $this->setFillColor(230,230,230);
    $this->Cell(20, 9, 'DATE', 1, 0,'',1);
    $this->Cell(30, 9, 'SERIAL #', 1, 0,'',1);
    $this->Cell(70, 9, 'NAME', 1, 0,'',1);
    $this->Cell(60, 9, 'S/D/W/O', 1, 0,'',1);
    $this->Cell(35, 9, 'PP/CNIC #', 1, 0,'',1);
    $this->Cell(40, 9, 'COUNTRY', 1, 0,'',1);
    $this->Cell(50, 9, 'AGENCY', 1, 0,'',1);
    $this->Cell(25, 9, 'STATUS', 1, 0,'',1);
    
    $this->Ln(9);
    // Ensure table header is printed
    parent::Header();
}

function Footer()
{
  if($this->isFinished){
      $this->Ln(6);

      $this->SetY(200);
      $this->Cell(140,10, "_______________________", 0, 0);
      $this->Cell(130,10, "_______________________", 0, 0);
      $this->Cell(15,10, "____________________________", 0, 0);
      $this->Ln(5);
      $this->Cell(140,10, '           Prepared By ', 0, 0);
      $this->Cell(130,10, '           Checked By ', 0, 0);
      $this->Cell(195,10, '           Authorised Signature ', 0, 0);
              // $this->AddPage('L', 'Legal', '0');

    //$this->Line(10, 30, 60, 30);
    // Ensure table footer is printed
    parent::Footer();
  }
}

// function Footer()
// {
//   if($this->isFinished){
//         $this->Ln(6);

//     //$this->Line(10, 30, 60, 30);
//     // Ensure table footer is printed
//     parent::Footer();
//   }
// }

}
  $pdf = new PDF();
  $pdf->isFinished = false;
  $pdf->AddPage('L', 'Legal', '0');
  $pdf->isFinished = true;
    
    // horizontal line
    //  $pdf->Line(10, 30, 345, 30);
    // $pdf->Ln(3);
    while ($rows=mysqli_fetch_array($process_query)) {
          
          $date = $rows['reg_date'];
          $serial_no = $rows['serial_no'];
          $cand_name = $rows['candidate_name'];
          $son_of = $rows['son_of'];
          $pp_no = $rows['passport_no'];
          $country = $rows['country'];
          $agency = $rows['agency'];
          $status = $rows['medical_status'];

          $cand_nameUpper = strtoupper($cand_name);
          $son_ofUpper = strtoupper($son_of);
          $countryUpper = strtoupper($country);
          $regDate=date("d-m-Y",strtotime($date));

          $pdf->SetFont('Arial','',10);
          $pdf->Cell(20, 7, $regDate, 1,0 );
          $pdf->Cell(30, 7, $serial_no, 1, 0);
          $pdf->ClippedCell(70,7,$cand_nameUpper,1,0);
          // $pdf->Cell(70, 7, $cand_nameUpper, 1, 0);
          $pdf->ClippedCell(60, 7, $son_ofUpper, 1, 0);
          $pdf->Cell(35, 7, $pp_no, 1, 0);
          $pdf->Cell(40, 7, $countryUpper, 1, 0);
          $pdf->Cell(50, 7, $agency, 1, 0);
          $pdf->Cell(25, 7, $status, 1, 1);
      }

      // $pdf->Cell(140,10, "", 0, 0);
      // $pdf->SetY(180);
      // $pdf->Cell(140,10, "_______________________", 0, 0);
      // $pdf->Cell(130,10, "_______________________", 0, 0);
      // $pdf->Cell(15,10, "____________________________", 0, 0);
      // $pdf->Ln(5);
      // $pdf->Cell(140,10, '           Prepared By ', 0, 0);
      // $pdf->Cell(130,10, '           Checked By ', 0, 0);
      // $pdf->Cell(195,10, '           Authorised Signature ', 0, 0);
  // $pdf->Footer();
  $pdf->Output();

?>