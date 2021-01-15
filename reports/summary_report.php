<?php
require('mysql_table.php');
include('../include/functions.php');


// if(isset($_POST['yearly_report'])) {
    
     //$_POST['years'];
    // $years_arr = implode(',',$years);

//     $process_query = get_yearly_report_pdf($years_arr);

// } else {

//      //echo 'show record upto 50 rows';
//      redirect('../yearly_monthly_report','_self');
// }

$years = array(date('Y')); //$_POST['years'];
$years_arr = implode(',',$years);
$process_query = get_summary_report_pdf($years_arr);


  //print_r($process_query);

class PDF extends PDF_MySQL_Table
{

function Header()
{
    global $years_arr;
    $this->Ln(15);
    $image1="../assets/img/comp_logo/reliance_logo.png";
    $today_date = date("d-m-Y");
    $year = date("Y");
    $title = "RELIANCE MEDICAL LAB";
    $this->SetFont('Arial','B',14);
    $this->SetX(40);
    $this->Cell(130,10,$title,0,0,'C');
    $this->SetX(40);
    $this->Cell(130,30,'',1,0,'C');
    $this->Ln(6);
    $this->SetFont('Arial','U',12);
    $this->SetX(40);
    $this->Cell(130,30,'Yearly Report '.$years_arr.'',0,0,'C');
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
    $i=2;
    $total=0;
    $pdf->setFillColor(210,230,230);
    // $pdf->Ln(15);

    foreach ($years as $query_year){
      $result_total=0;
      $pdf->SetFont('Arial','B',12);
      $pdf->SetX(40);    
      $pdf->Cell(130, 8, '  Year - '.$query_year,1,1,'C',1);
      

      // foreach($process_query as $my_rows) {
    
      //       $my_year = $my_rows['years'];
      //       if($my_year == $query_year){
      //         $my_total = $my_rows['total'];
      //           $query_total = array_sum(array($my_total));
      //          $result_total += $query_total;
      //       }
      // }

      $sum_total_yearly=0;
      foreach ($process_query as $que_result) {
          
         
          $que_year = $que_result['year'];


          if($que_year == $query_year){

            $que_month = $que_result['monthname'];
            $query_month = $que_result['month'];
            
            $pdf->SetFont('Arial','B',11);
            $pdf->setFillColor(230,230,230);
            $pdf->SetX(40);
            $pdf->Cell(130, 7,$que_month.' - '.$que_year, 1, 1,'C',1);
            
            $pdf->SetX(40);
            $pdf->Cell(65, 7,'Date', 1, 0,'C');
            $pdf->Cell(65, 7,'No of Registration', 1, 1,'C');
            $pdf->SetX(40);


            // $pdf->SetFont('Arial','C',10);
            // $pdf->SetX(40);
            $sum_total_monthly=0;
            $process_query2 = get_summary_report_month_pdf($query_month,$que_year);
            foreach ($process_query2 as $que_result2) {
              

              $pdf->SetFont('Arial','',10);
              $reg_date = $que_result2['reg_date'];
              $total_registration = $que_result2['total_registration'];
              
              $sum_monthly = array_sum(array($total_registration));
              $sum_total_monthly += $sum_monthly;

              $regdate=date("d-m-Y",strtotime($reg_date));

              $pdf->SetX(40);
              $pdf->Cell(65, 7,$regdate, 1, 0,'C');
              $pdf->Cell(65, 7,$total_registration, 1, 1,'C');
              //$pdf->Cell(130, 7,$reg_date.' - '.$total_registration, 1, 1,'C');

            }
            $sum_yearly = array_sum(array($sum_total_monthly));
            $sum_total_yearly += $sum_yearly;

            $month_days=cal_days_in_month(CAL_GREGORIAN,$query_month,$que_year);
            $per_day_avg = $sum_total_monthly/$month_days;

            $pdf->SetX(40);
            $pdf->Cell(65, 7,'Total Registration: '.$sum_total_monthly, 1, 0,'C');
            $pdf->Cell(65, 7,'Per Day Average: '.round($per_day_avg,2), 1, 1,'C');
            $pdf->Ln(10);
            



            // if($medical_status == 'FIT'){
            //   $total_fit = $que_result['total'];
            //   $fit_percentage = ($total_fit/$result_total)*100;
            //   $pdf->Cell(44, 7, ''.round($fit_percentage,2).'%', 1, 1,'R');
            
            // }
            // elseif($medical_status == 'UNFIT'){
            //   $total_unfit = $que_result['total'];
            //   $unfit_percentage = ($total_unfit/$result_total)*100;
            //   $pdf->Cell(44, 7, ''.round($unfit_percentage,2).'%', 1, 1,'R');
            // }      
        
          }
          
      }
 
          $per_month_avg = $sum_total_yearly/365;
          $pdf->SetX(40);
          $pdf->Cell(65, 7,'Total Year Registration: '.$sum_total_yearly, 1, 0,'C',1);
          $pdf->Cell(65, 7,'Per Month Average: '.round($per_month_avg,2), 1, 1,'C',1);

          $pdf->Ln(10);

    }

 
  $pdf->Output();

?>