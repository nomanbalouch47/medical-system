<?php
require('mysql_table.php');
include('../include/functions.php');

if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,36);
}

$process_query = daily_cash_statement();
$discount_query = daily_discount();

class PDF extends PDF_MySQL_Table
{

function Header()
{
    
    // Ensure table header is printed
    parent::Header();
}

function Body()
{
    global $process_query;
    global $discount_query;

    $total=0;
    $this->setFillColor(230,230,230);
    $this->SetFont('Arial','B',11);
   
    $this->SetX(10);
    $this->Cell(50,9,'Particulars',1,0,'L',1);
    $this->Cell(15,9,'Cases',1,0,'L',1);
    $this->Cell(20,9,'Rate',1,0,'L',1);
    $this->Cell(20,9,'Amount',1,0,'L',1);
    $this->Cell(85,9,'Remarks',1,1,'L',1);
    $this->SetX(10);
    $this->SetFont('Arial','',10);
    
    while ($rows = mysqli_fetch_array($process_query)) {

        $country = $rows['country'];
        $cases = $rows['cases'];
        $fee = $rows['fee_charged'];
        $Amount = $fee*$cases;
        $tot_amount = array_sum(array($Amount));
        $total += $tot_amount;

          $this->Cell(50,9,$country,1,0,'L');
          $this->Cell(15,9,$cases,1,0,'R');
          $this->Cell(20,9,$fee,1,0,'R');
          $this->Cell(20,9,number_format($Amount),1,0,'R');
          $this->Cell(85,9,'',1,1,'L');

    }
          $this->SetFont('Arial','B',11);
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
          $this->Cell(85,9,'',1,1,'L');
       

    $this->Ln(6);
}

function Footer()
{
  global $login_name;

  if($this->isFinished){
        $this->Ln(2);
        
        $this->SetFont('Arial','',12);
        $this->Ln(3);
        $this->Cell(140,10, 'Prepared By:', 0, 0);
        
        // $this->Ln(6);
        $this->SetX(36);
        $this->Cell(100,10, ucfirst($login_name), 0, 0);
        
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
    
    $pdf->SetX(70); //The next cell will be set 100 units to the right
    $pdf->Cell(70,0,$medical_lab_title,0,1,'C');
    $pdf->Ln(2);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,6,'Daily Cash Statement',0,1,'C');
    $pdf->Cell(0,6,'Date:'.$today_date_for_datepicker,0,1,'R');
    $pdf->Ln(6);

    $pdf->Body();

 
  $pdf->Output();

?>