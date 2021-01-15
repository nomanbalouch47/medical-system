<?php
require('mysql_table.php');
include('../include/functions.php');


if(isset($_POST['quarterly_report'])) {

  if(isset($_POST['quarter'])){

    $quarter_type = $_POST['quarter'];
    $process_query = get_quarterly_report_pdf($quarter_type);

  }
}else{

     redirect('../yearly_monthly_report','_self');
}

class PDF extends PDF_MySQL_Table
{

function Header()
{
    global $years_arr;
    global $current_year;
    $this->Ln(15);
    $image1="../assets/img/comp_logo/reliance_logo.png";
    $today_date = date("d-m-Y");
    //$year = date("Y");
    $title = "RELIANCE MEDICAL LAB";
    $this->SetFont('Arial','B',14);
    $this->SetX(40);
    $this->Cell(130,10,$title,0,0,'C');
    $this->SetX(40);
    $this->Cell(130,30,'',1,0,'C');
    $this->Ln(6);
    $this->SetFont('Arial','U',12);
    $this->SetX(40);
    $this->Cell(130,30,'Quarterly Report '.$current_year.'',0,0,'C');
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
    $first_quarter = array("January","February","March");
    $second_quarter = array("April","May","June");
    $third_quarter = array("July","August","September");
    $fourth_quarter = array("October","November","December");

    if($quarter_type == 1){

      $quarter_months = $first_quarter;
    
    }elseif ($quarter_type == 2) {
      
      $quarter_months = $second_quarter;
    }
    elseif ($quarter_type == 3) {
      
      $quarter_months = $third_quarter;
    }
    elseif ($quarter_type == 4) {
      
      $quarter_months = $fourth_quarter;
    }

      foreach($quarter_months as $month_name){
          $result_total=0;
          $pdf->SetFont('Arial','B',12);
          $pdf->SetX(40);    
          $pdf->Cell(130, 8, ''.$month_name.' - '.$current_year.'',1,1,'C',1);


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

 
  $pdf->Output();

?>