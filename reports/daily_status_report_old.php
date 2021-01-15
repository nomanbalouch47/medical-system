<?php
require('mysql_table.php');
include('../include/functions.php');


if (isset($_GET['portion'])) {

    $from_date = $_GET['from'];
    $to_date = $_GET['to'];
    $portion = $_GET['portion'];
    $countries = $_GET['country'];

    if(empty($from_date)) { $from_date = $today_date; }

    $process_query = daily_status_report_pdf($from_date,$to_date,$portion,$countries);
    if($portion=='A-B'){
      $process_query_for_A = daily_status_report_pdf_A($from_date,$to_date,$portion,$countries); 
    }
    // print_r($process_query);
    $f_date=date("d-m-Y",strtotime($from_date));
    $t_date=date("d-m-Y",strtotime($to_date));

} else {
     //echo 'show record upto 50 rows';
     $process_query = daily_status_report_pdf();
}

  $process_query_organization = get_medical_lab_OrganInfo_pdf();
  while ($rows=mysqli_fetch_array($process_query_organization)) {
          
          $title = $rows['title'];
          $city = $rows['city'];     // $rows['address'];

          $titleUpper = strtoupper($title);
          $cityUpper = strtoupper($city);
    }
//print_r($rowsData);

class PDF extends PDF_MySQL_Table
{

function Header()
{
    global $f_date;
    global $t_date;
    global $titleUpper;
    global $cityUpper;
    $today_date = date("d-m-Y");
    // Title
    // $this->Ln(6);
    $this->SetFont('Arial','B',18);
    $this->setFillColor(230,230,230);
    $this->SetX(120);
    $this->Cell(120,9,$titleUpper,0,1,'C',1);
    $this->Ln(1);
    // Code Section
    $this->SetFont('Arial','',14);
    $this->Cell(45,8,'Code 02/02/07',1,0, 'C',1);
    // Sub Title
    $this->SetFont('Arial','B',16);
    $this->setFillColor(210,230,230);
    $this->SetX(120);
    $this->Cell(120,9,$cityUpper,0,0,'C',1);
    $this->SetFont('Arial','',14);
    $this->SetX(300);
    // $this->Cell(20,5,$today_date,0,0,'R');
    $this->Ln(10);
    $this->Cell(0,6,'From: '.$t_date.' --- To: '.$f_date.'',0,1,'C');
    // Page number
    $this->SetFont('Arial','',12);
    $this->Cell(595,8,'Page '.$this->PageNo().' of {nb}'.$this->AliasNbPages().'',0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','',14);
    $this->setFillColor(230,230,230);
    $this->Cell(20, 9, 'DATE', 1, 0,'',1);
    $this->Cell(35, 9, 'SERIAL #', 1, 0,'',1);
    $this->Cell(70, 9, 'NAME', 1, 0,'',1);
    $this->Cell(60, 9, 'S/D/W/O', 1, 0,'',1);
    $this->Cell(35, 9, 'PP #', 1, 0,'',1);
    $this->Cell(40, 9, 'COUNTRY', 1, 0,'',1);
    $this->Cell(50, 9, 'AGENCY', 1, 0,'',1);
    $this->Cell(22, 9, 'STATUS', 1, 0,'',1);
    
    $this->Ln(9);
    // Ensure table header is printed
    parent::Header();
}

function Footer()
{
  if($this->isFinished){
        $this->Ln(6);

    //$this->Line(10, 30, 60, 30);
    // Ensure table footer is printed
    parent::Footer();
  }
}

}
  $pdf = new PDF();
  $pdf->isFinished = false;
  $pdf->AddPage('L', 'Legal', '0');
  $pdf->isFinished = true;
  global $portion;  

    $pdf->setFillColor(210,230,230);
    if($portion=='B') {
        $pdf->SetFont('Arial','',12);
        $pdf->Ln(1);
        $pdf->Cell(332, 8,'Portion  B', 1, 1,'',1);
        $pdf->Ln(1);
        $i=1;
        while ($rows=mysqli_fetch_array($process_query)) {
          
          $date = $rows['reg_date'];
          $reg_date=date("d-m-Y",strtotime($date));
          $serial_no = $rows['serial_no'];
          $cand_name = $rows['candidate_name'];
          $son_of = $rows['son_of'];
          $pp_no = $rows['passport_no'];
          $country = $rows['country'];
          $agency = $rows['agency'];
          $print_report_portion = $rows['print_report_portion'];
          $medical_status = $rows['medical_status'];
          $cand_nameUpper = strtoupper($cand_name);
          $son_ofUpper = strtoupper($son_of);
          $countryUpper = strtoupper($country);

            
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20, 8, $reg_date, 1,0);
            $pdf->Cell(35, 8, $serial_no, 1, 0);
            $pdf->ClippedCell(70, 8, $cand_nameUpper, 1, 0);
            $pdf->ClippedCell(60, 8, $son_ofUpper, 1, 0);
            $pdf->Cell(35, 8, $pp_no, 1, 0);
            if($pdf->GetStringWidth($countryUpper) > 65){
            $pdf->SetFont('Arial','',7);
            // $pdf->SetMargins(0,1);
            $pdf->setFillColor(210,230,230);
            $pdf->SetX(230);
            $pdf->MultiCell(40,2.35,$countryUpper,1,'C',1);
            $pdf->Ln(-7);
            $pdf->SetFont('Arial','',9);
            }else{
                // $this->Ln(-7);
                $pdf->SetX(230);
                $pdf->Cell(40,8,$countryUpper,1,'C');
            }
            // $pdf->Cell(40, 8, $countryUpper, 1, 0);
            $pdf->Cell(50, 8, $agency, 1, 0);
            $pdf->Cell(22, 8, $medical_status, 1, 1);
            if($i==14)
            {
              $pdf->AddPage('L', 'Legal', '0');
            }
            $i++;
    }
    // $pdf->Ln(8);
  }
    
      elseif($portion=='A')
      {

      $pdf->SetFont('Arial','',12);
      $pdf->Ln(1);
      $pdf->Cell(332, 8,'Portion  A', 1, 1,'',1);
      $pdf->Ln(1);
      $i=1;
      while ($rows=mysqli_fetch_array($process_query)) {
      
      $date = $rows['reg_date'];
      $reg_date=date("d-m-Y",strtotime($date));
      $serial_no = $rows['serial_no'];
      $cand_name = $rows['candidate_name'];
      $son_of = $rows['son_of'];
      $pp_no = $rows['passport_no'];
      $country = $rows['country'];
      $agency = $rows['agency'];
      $print_report_portion = $rows['print_report_portion'];
      $medical_status = $rows['medical_status'];

      $cand_nameUpper = strtoupper($cand_name);
      $son_ofUpper = strtoupper($son_of);
      $countryUpper = strtoupper($country);

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20, 8, $reg_date, 1,0);
        $pdf->Cell(35, 8, $serial_no, 1, 0);
        $pdf->ClippedCell(70, 8, $cand_nameUpper, 1, 0);
        $pdf->ClippedCell(60, 8, $son_ofUpper, 1, 0);
        $pdf->Cell(35, 8, $pp_no, 1, 0);
        if($pdf->GetStringWidth($countryUpper) > 65){
            $pdf->SetFont('Arial','',7);
            // $pdf->SetMargins(0,1);
            $pdf->setFillColor(210,230,230);
            $pdf->SetX(230);
            $pdf->MultiCell(40,2.35,$countryUpper,1,'C',1);
            $pdf->Ln(-7);
            $pdf->SetFont('Arial','',9);
            }else{
                // $this->Ln(-7);
                $pdf->SetX(230);
                $pdf->Cell(40,8,$countryUpper,1,'C');
            }
            // $pdf->Cell(40, 8, $countryUpper, 1, 0);
        $pdf->Cell(50, 8, $agency, 1, 0);
        $pdf->Cell(22, 8, $medical_status, 1, 1);
          if($i==14)
            {
              $pdf->AddPage('L', 'Legal', '0');
            }
            $i++;
      }
      // $pdf->Ln(8);
    }
    else
      {

        //when user selects both A-B

        $pdf->SetFont('Arial','',12);
        $pdf->Ln(1);
        $pdf->Cell(332, 8,'Portion  B', 1, 1,'',1);
        $pdf->Ln(1);
        $i=1;
        while ($rows=mysqli_fetch_array($process_query)) {
        
        $date = $rows['reg_date'];
        $reg_date=date("d-m-Y",strtotime($date));
        $serial_no = $rows['serial_no'];
        $cand_name = $rows['candidate_name'];
        $son_of = $rows['son_of'];
        $pp_no = $rows['passport_no'];
        $country = $rows['country'];
        $agency = $rows['agency'];
        $print_report_portion = $rows['print_report_portion'];
        $medical_status = $rows['medical_status'];
        $cand_nameUpper = strtoupper($cand_name);
        $son_ofUpper = strtoupper($son_of);
        $countryUpper = strtoupper($country);

        if($print_report_portion=='B') {
          $pdf->SetFont('Arial','',10);
          $pdf->Cell(20, 8, $reg_date, 1,0);
          $pdf->Cell(35, 8, $serial_no, 1, 0);
          $pdf->ClippedCell(70, 8, $cand_nameUpper, 1, 0);
          $pdf->ClippedCell(60, 8, $son_ofUpper, 1, 0);
          $pdf->Cell(35, 8, $pp_no, 1, 0);
          if($pdf->GetStringWidth($countryUpper) > 45){
            $pdf->SetFont('Arial','',7);
            // $pdf->SetMargins(0,1);
            $pdf->setFillColor(210,230,230);
            $pdf->SetX(230);
            $pdf->MultiCell(40,2.35,$countryUpper,1,'C',1);
            $pdf->Ln(-7);
            $pdf->SetFont('Arial','',9);
            }else{
                // $this->Ln(-7);
                $pdf->SetX(230);
                $pdf->Cell(40,8,$countryUpper,1,'C');
            }
            // $pdf->Cell(40, 8, $countryUpper, 1, 0);
          $pdf->Cell(50, 8, $agency, 1, 0);
          $pdf->Cell(22, 8, $medical_status, 1, 1);

        }
        // if($i==14)
        //     {
        //       $pdf->AddPage('L', 'Legal', '0');
        //     }
        //     $i++;
       
      }
      // $pdf->Ln(8);

        $pdf->SetFont('Arial','',12);
        $pdf->Ln(1);
        $pdf->Cell(332, 8,'Portion  A', 1, 1,'',1);
        $pdf->Ln(1);

        foreach ($process_query_for_A as $rows2) {
        
          $date2 = $rows2['reg_date'];
          $reg_date2=date("d-m-Y",strtotime($date2));
          $serial_no2 = $rows2['serial_no'];
          $cand_name2 = $rows2['candidate_name'];
          $son_of2 = $rows2['son_of'];
          $pp_no2 = $rows2['passport_no'];
          $country2 = $rows2['country'];
          $agency2 = $rows2['agency'];
          $print_report_portion2 = $rows2['print_report_portion'];
          $medical_status2 = $rows2['medical_status'];
          $cand_nameUpper2 = strtoupper($cand_name2);
          $son_ofUpper2 = strtoupper($son_of2);
          $countryUpper2 = strtoupper($country2);

          if($print_report_portion2=='A') {
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20, 8, $reg_date2, 1,0);
            $pdf->Cell(35, 8, $serial_no2, 1, 0);
            $pdf->ClippedCell(70, 8, $cand_nameUpper2, 1, 0);
            $pdf->ClippedCell(60, 8, $son_ofUpper2, 1, 0);
            $pdf->Cell(35, 8, $pp_no2, 1, 0);
            if($pdf->GetStringWidth($countryUpper2) > 45){
            $pdf->SetFont('Arial','',7);
            // $pdf->SetMargins(0,1);
            $pdf->setFillColor(210,230,230);
            $pdf->SetX(230);
            $pdf->MultiCell(40,4,$countryUpper2,1,'L',1);
            $pdf->Ln(-8);
            $pdf->SetFont('Arial','',9);
            }else{
                // $this->Ln(-7);
                $pdf->SetX(230);
                $pdf->Cell(40,8,$countryUpper2,1,'C');
            }
            // $pdf->Cell(40, 8, $countryUpper, 1, 0);
            $pdf->SetX(270);
            $pdf->Cell(50, 8, $agency2, 1, 0);
            $pdf->Cell(22, 8, $medical_status2, 1, 1);

          }
          // if($i==14)
          //   {
          //     $pdf->AddPage('L', 'Legal', '0');
          //   }
            $i++;
        }
        // $pdf->Ln(20);

    }
      $pdf->SetY(180);
      $pdf->Cell(140,10, "_______________________", 0, 0);
      $pdf->Cell(130,10, "_______________________", 0, 0);
      $pdf->Cell(15,10, "____________________________", 0, 0);
      $pdf->Ln(5);
      $pdf->Cell(140,10, '           Prepared By ', 0, 0);
      $pdf->Cell(130,10, '           Checked By ', 0, 0);
      $pdf->Cell(195,10, '           Authorised Signature ', 0, 0);
  
  $pdf->Output();

?>