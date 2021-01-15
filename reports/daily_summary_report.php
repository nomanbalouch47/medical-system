<?php
require('mysql_table.php');
include('../include/functions.php');



  // $years = array('2020'); //$_POST['years'];
// $years_arr = implode(',',$years);
// $process_query = get_summary_report_year_pdf();


  //print_r($process_query);

class PDF extends PDF_MySQL_Table
{

function Header()
{

  $process_query2 = get_medical_lab_OrganInfo_pdf();
    $query_result2=mysqli_fetch_array($process_query2);
    $address = $query_result2['address'];
    $city = $query_result2['city'];
    $medical_lab_title = $query_result2['title'];
    $phone_no = $query_result2['phone_no'];
    $phone_no_2 = $query_result2['phone_no_2'];
    $fax_no = $query_result2['fax_no'];

    
    global $year;
    $this->Ln(15);
    $image1="../assets/img/comp_logo/reliance_logo.png";
    $today_date = date("d-m-Y");
    $year = date("Y");
    // $title = "RELIANCE MEDICAL LAB";
    $this->SetFont('Arial','B',14);
    $this->SetX(40);
    $this->Cell(130,10,$medical_lab_title,0,0,'C');
    $this->SetX(40);
    $this->Cell(130,30,'',1,0,'C');
    $this->Ln(6);
    $this->SetFont('Arial','U',12);
    $this->SetX(40);
    $this->Cell(130,30,'Daily Report '.$today_date.'',0,0,'C');
    $this->Ln(35);
    // Ensure table header is printed
    parent::Header();
}

function Footer()
{
  if($this->isFinished) {
        $this->Ln(4);
        $this->Cell(230,10,'Page '.$this->PageNo().' of {nb}'.$this->AliasNbPages().'',0,0,'R');

    // Ensure table footer is printed
    parent::Footer();
  }
}

}
  $pdf = new PDF();
  $pdf->isFinished = false;
  $pdf->AddPage('P', 'A4', '');
  $pdf->isFinished = true;
    
    // $month_year = date('F Y', strtotime('2020-01-13'));
      $month_name = date('F');
      $month_num = date('n');
  
    $process_query2 = get_daily_summary_report_pdf();

            $pdf->SetFont('Arial','B',12);
            $pdf->setFillColor(230,230,230);
            $pdf->SetX(40);    
            $pdf->Cell(130, 8, $month_name.' '.$year,1,1,'C',1);
            $pdf->SetX(40);
            $pdf->Cell(65, 7,'Country', 1, 0,'C');
            $pdf->Cell(65, 7,'No of Registration', 1, 1,'C');
            $sum_total_daily=0;
  
  while ($rows=mysqli_fetch_array($process_query2)) {
          
          $country = $rows['country'];
          $total_registration = $rows['total_registration'];

          $sum_daily = array_sum(array($total_registration));
          $sum_total_daily += $sum_daily;
          
            $pdf->SetFont('Arial','',10);
            $pdf->SetX(40);
            $pdf->Cell(65, 7,$country, 1, 0,'C');
            $pdf->Cell(65, 7,$total_registration, 1, 1,'C');  
          
    }
    // $month_days=cal_days_in_month(CAL_GREGORIAN,$month_num,$year);
    // $per_day_avg = $sum_total_daily/$month_days;
    // $pdf->setFillColor(240,240,240);
    // $pdf->SetX(40);
    // $pdf->Cell(65, 7,'Total Registration: '.$sum_total_daily, 1, 0,'C',1);
    // $pdf->Cell(65, 7,'Per Day Average: '.round($per_day_avg,2), 1, 1,'C',1);
    // $pdf->Ln(10);

    //   $pdf->SetFont('Arial','B',12);
    //   $pdf->setFillColor(230,230,230);
    //   $pdf->SetX(40);    
    //   $pdf->Cell(130, 8,$month_name.' '.$year,1,1,'C',1);
    //   $pdf->SetX(40);
    //   $pdf->Cell(65, 7,'Country', 1, 0,'C');
    //   $pdf->Cell(65, 7,'No of Registration', 1, 1,'C');
    //   $sum_total_repeated_daily=0;

    // $process_query = get_summary_report_repeat_pdf();

    // while ($rows=mysqli_fetch_array($process_query)) {
    //     $country = $rows['country'];
    //     $total_registration = $rows['total_registration'];

    //       $sum_daily = array_sum(array($total_registration));
    //       $sum_total_repeated_daily += $sum_daily;
       
    //         $pdf->SetFont('Arial','',10);
    //         $pdf->SetX(40);
    //         $pdf->Cell(65, 7,$country, 1, 0,'C');
    //         $pdf->Cell(65, 7,$total_registration, 1, 1,'C'); 
            
    // }
    // $month_days=cal_days_in_month(CAL_GREGORIAN,$month_num,$year);
    // $per_day_avg = $sum_total_repeated_daily/$month_days;
    // $pdf->setFillColor(240,240,240);
    // $pdf->SetX(40);
    // $pdf->Cell(65, 7,'Total Repeated Registration: '.$sum_total_repeated_daily, 1, 0,'C',1);
    // $pdf->Cell(65, 7,'Per Day Average: '.round($per_day_avg,2), 1, 1,'C',1);
    // $pdf->Ln(10);
    // $pdf->Ln(10);


      $grand_total=$sum_total_daily;
      // $month_days=cal_days_in_month(CAL_GREGORIAN,$month_num,$year);
      
      // $per_day_avg = $grand_total/$month_days;
      $pdf->setFillColor(240,240,240);
      $pdf->SetX(40);
      $pdf->Cell(65, 7,'Total Registrations ', 1, 0,'C',1);
      $pdf->Cell(65, 7,$grand_total, 1, 1,'C',1);
      $pdf->Ln(10);

 
  $pdf->Output();

?>