<?php
require('mysql_table.php');
include('../include/functions.php');


if(isset($_POST['year'])) {

  if(isset($_POST['all_months'])){

    $all_months = $_POST['all_months'];
    $year = $_POST['year'];
    $process_query = get_monthly_report_pdf($all_months,$year);

  }else{

    $months = $_POST['months'];
    $year = $_POST['year'];
    $months_arr = implode(',',$months);
    $process_query = get_monthly_report_pdf($months_arr,$year);

  }
}else{

     redirect('../yearly_monthly_report','_self');
}

class PDF extends PDF_MySQL_Table
{

function Header()
{
    global $years_arr;
    global $year;
    $this->Ln(15);
    $image1="../assets/img/comp_logo/reliance_logo.png";
    $today_date = date("d-m-Y");
    $title = "RELIANCE MEDICAL LAB";
    $this->SetFont('Arial','B',14);
    $this->SetX(40);
    $this->Cell(130,10,$title,0,0,'C');
    $this->SetX(40);
    $this->Cell(130,30,'',1,0,'C');
    $this->Ln(6);
    $this->SetFont('Arial','U',12);
    $this->SetX(40);
    $this->Cell(130,30,'Monthly Report '.$year.'',0,0,'C');
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
    $pdf->setFillColor(230,230,230);
    global $all_months;
    $month_array = array("January","February","March","April","May","June","July","August","September","October","November","December");

    if($all_months == 1){

      foreach($month_array as $month_name){
          $result_total=0;
          $pdf->SetFont('Arial','B',12);
          $pdf->SetX(40);    
          $pdf->Cell(130, 8, ''.$month_name.' - '.$year.'',1,1,'C',1);


          foreach($process_query as $my_rows) {
    
            $my_month = $my_rows['MONTH'];
            if($my_month == $month_name){
              $my_total = $my_rows['total'];
                $query_total = array_sum(array($my_total));
               $result_total += $query_total;
            }
          }

          foreach($process_query as $que_result) {
          
          $que_month = $que_result['MONTH'];
          $total = $que_result['total'];

          if($que_month == $month_name){

            $medical_status = $que_result['medical_status'];
            
            $pdf->SetFont('Arial','',10);
            $pdf->SetX(40);
            $pdf->Cell(44, 7,$medical_status, 1, 0,'C');
            $pdf->Cell(42, 7,$total, 1, 0,'R');

            if($medical_status == 'FIT'){
              $total_fit = $que_result['total'];
              $fit_percentage = ($total_fit/$result_total)*100;
              $pdf->Cell(44, 7, ''.round($fit_percentage,2).'%', 1, 1,'R');
            
            }
            elseif($medical_status == 'UNFIT'){
              $total_unfit = $que_result['total'];
              $unfit_percentage = ($total_unfit/$result_total)*100;
              $pdf->Cell(44, 7, ''.round($unfit_percentage,2).'%', 1, 1,'R');
            }      
        
          }
          
      }
 

          $pdf->SetX(40);
          $pdf->Cell(44, 7, 'TOTAL', 1, 0,'C');
          $pdf->SetFont('Arial','B',10);
          $pdf->Cell(42, 7,$result_total, 1, 0,'R');
          $pdf->Cell(44, 7, '', 1, 1,'R');
          $pdf->Ln(10);
      }

    }else{

      foreach ($months as $query_month){
      $result_total=0;
      $pdf->SetFont('Arial','B',12);
      $pdf->SetX(40);    
      $pdf->Cell(130, 8, ''.$query_month.' - '.$year.'',1,1,'C',1);
      

      foreach($process_query as $my_rows) {
    
            $my_month = $my_rows['MONTH'];
            if($my_month == $query_month){
              $my_total = $my_rows['total'];
                $query_total = array_sum(array($my_total));
               $result_total += $query_total;
            }
      }

    
      foreach($process_query as $que_result) {
          
          $que_month = $que_result['MONTH'];
          $total = $que_result['total'];

          if($que_month == $query_month){

            $medical_status = $que_result['medical_status'];
            
            $pdf->SetFont('Arial','',10);
            $pdf->SetX(40);
            $pdf->Cell(44, 7,$medical_status, 1, 0,'C');
            $pdf->Cell(42, 7,$total, 1, 0,'R');

            if($medical_status == 'FIT'){
              $total_fit = $que_result['total'];
              $fit_percentage = ($total_fit/$result_total)*100;
              $pdf->Cell(44, 7, ''.round($fit_percentage,2).'%', 1, 1,'R');
            
            }
            elseif($medical_status == 'UNFIT'){
              $total_unfit = $que_result['total'];
              $unfit_percentage = ($total_unfit/$result_total)*100;
              $pdf->Cell(44, 7, ''.round($unfit_percentage,2).'%', 1, 1,'R');
            }      
        
          }
          
      }
 

          $pdf->SetX(40);
          $pdf->Cell(44, 7, 'TOTAL', 1, 0,'C');
          $pdf->SetFont('Arial','B',10);
          $pdf->Cell(42, 7,$result_total, 1, 0,'R');
          $pdf->Cell(44, 7, '', 1, 1,'R');
          $pdf->Ln(10);



    }

    }
  $pdf->Output();

?>