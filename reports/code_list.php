<?php
require('mysql_table.php');
include('../include/functions.php');

if(isset($_POST['generate_report'])) {

  $codeDate = date('Y-m-d', strtotime($_POST['code_date']));
  $process_query = get_code_list_report_pdf($codeDate);
   // print_r($process_query);
}

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

    // $total=0;
    $this->setFillColor(230,230,230);
    $this->SetFont('Arial','B',11);
   
    $this->SetX(20);
    $this->Cell(10,9,'S#',1,0,'C',1);
    $this->Cell(40,9,'Serial No',1,0,'C',1);
    $this->Cell(20,9,'Code',1,0,'C',1);
    $this->Ln(9);
    $this->SetX(20);
    $this->SetFont('Arial','',10);
    $i=1;
    while ($rows = mysqli_fetch_array($process_query)) {

        $serial_no = $rows['serial_no'];
        $sticker_value_2 = $rows['code'];

      if($i>38)
      {
        if($i==39)
        {
          $this->Ln(-237);
          $this->SetFont('Arial','B',11);
          $this->SetX(120);
          $this->Cell(10,9,'S#',1,0,'C',1);
          $this->Cell(40,9,'Serial No',1,0,'C',1);
          $this->Cell(20,9,'Code',1,1,'C',1);
        }
          $this->SetFont('Arial','',10);
          $this->SetX(120);
          $this->Cell(10,6,$i,1,0,'C');
          $this->Cell(40,6,$serial_no,1,0,'C');
          $this->Cell(20,6,$sticker_value_2,1,1,'C');
      }
      else{
        $this->SetX(20);
        $this->Cell(10,6,$i,1,0,'C');
        $this->Cell(40,6,$serial_no,1,0,'C');
        $this->Cell(20,6,$sticker_value_2,1,1,'C');
      }

      $i++;

    }

    // $this->Ln(6);
}

function Footer()
{
  global $login_name;

  if($this->isFinished){
        $this->Ln(2);
        
    // Ensure table footer is printed
    parent::Footer();
  }
}

}
	  $pdf = new PDF();
    $pdf->isFinished = false;
	  $pdf->AddPage('P', 'A4', '0');
    $pdf->isFinished = true;
    // global $medical_lab_title;
    global $codeDate;
    $code_date=date("d-m-Y",strtotime($codeDate));
    $month_name = date('F');

    $pdf->setFillColor(210,230,230);

      $process_query2 = get_medical_lab_OrganInfo_pdf();
      $query_result2=mysqli_fetch_array($process_query2);
      $address = $query_result2['address'];
      $medical_lab_title = $query_result2['title'];
      $phone_no = $query_result2['phone_no'];
      $phone_no_2 = $query_result2['phone_no_2'];
      $fax_no = $query_result2['fax_no'];

    // Title
    $pdf->SetFont('Arial','B',16);
    $pdf->Ln(2);
    
    $pdf->SetX(60); //The next cell will be set 100 units to the right
    $pdf->Cell(90,9,$medical_lab_title,0,1,'C',1);
    $pdf->Ln(1);
    $pdf->setFillColor(230,230,230);
    $pdf->SetFont('Arial','',12);
    $pdf->SetX(78);
    $pdf->Cell(55,6,'Code List : ',1,0,'L',1);
    $pdf->SetX(115);
    $pdf->Cell(2,6,$code_date,0,1,'C');
    $pdf->Ln(10);

    $pdf->Body();
 
  $pdf->Output();

?>