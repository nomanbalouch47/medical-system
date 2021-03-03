<?php
require('mysql_table.php');
include('../include/functions.php');


if(isset($_POST['generate_report'])){

  $reg_date = $_POST['reg_date'];
  $country_arr = $_POST['countries'];

  // print_r($country_arr);

  $search_date = date("d-m-Y",strtotime($_POST['reg_date']));

  $process_query = get_daily_report_pdf($reg_date,$country_arr);

}

  //print_r($process_query);

class PDF extends PDF_MySQL_Table
{

function Header()
{
    /*global $pdf_title_reg_history;
    global $pdf_addr_daily_reg;
    global $pdf_subtitle_reg_history;*/
    $image1="../assets/img/comp_logo/reliance_logo.png";
    // $today_date = date("d-m-Y");
    global $search_date;
    $process_query2 = get_medical_lab_OrganInfo_pdf();
    $query_result2=mysqli_fetch_array($process_query2);
    $address = $query_result2['address'];
    $city = $query_result2['city'];
    $medical_lab_title = $query_result2['title'];
    $phone_no = $query_result2['phone_no'];
    $phone_no_2 = $query_result2['phone_no_2'];
    $fax_no = $query_result2['fax_no'];
    //$image1 = "../assets/img/comp_logo/".$query_result2['logo'];

    // Title
    $this->SetFont('Arial','',14);
    $this->SetX(140);
    $this->Cell(40,0,$this->Image($image1,$this->GetX(),$this->GetY(),70,20),0,0,'C',false);
    $this->setFillColor(210,230,230);
    $this->SetX(10);
    $this->Cell(65,7,$medical_lab_title,0,1,'L',1);
    $this->Cell(100,6,$address,0,1,'L',1);
    $this->Cell(35,6,$city,0,0,'L',1);
    $this->SetX(270);
    $this->Cell(60,10,' Daily Registration Report ',1,0,'R',1);
    $this->Ln();
    // Code Section
    $this->SetFont('Arial','',12);
    $this->Cell(45,8,'Center Code 02/02/07',0,0, 'L');
    // Sub Title
    $this->Ln(3);
    $this->SetFont('Arial','',14);
    $this->Cell(300,5,$search_date,0,0,'R');
    $this->Ln(8);
    // Page number
    $this->Ln();
    $this->SetFont('Arial','',12);
    $this->setFillColor(230,230,230);    
  	$this->Cell(30, 9, 'SERIAL NO', 1, 0,'',1);
  	$this->Cell(90, 9, 'NAME', 1, 0,'',1);
  	$this->Cell(80, 9, "FATHER'S NAME", 1, 0,'',1);
  	$this->Cell(35, 9, 'PASSPORT NO', 1, 0,'',1);
    $this->Cell(50, 9, 'AGENCY', 1, 0,'',1);
  	$this->Cell(50, 9, 'COUNTRY', 1, 0,'',1);
  	
    $this->Ln(6);
    // Ensure table header is printed
    parent::Header();
}

function Footer()
{
  if($this->isFinished){
        $this->Ln(6);
        $this->SetY(200);
        $this->Cell(330,10,'Page '.$this->PageNo().' of {nb}'.$this->AliasNbPages().'',0,0,'R');

    // Ensure table footer is printed
    parent::Footer();
  }
}

}
	$pdf = new PDF();
  $pdf->isFinished = false;
	$pdf->AddPage('L', 'Legal', '0');
  $pdf->isFinished = true;
    
    // horizontal line
    //  $pdf->Line(10, 30, 345, 30);
    $pdf->Ln(3);
    while ($rows=mysqli_fetch_array($process_query)) {
          
          $serial_no = $rows['serial_no'];
          $cand_name = $rows['candidate_name'];
          $son_of = $rows['son_of'];
          $pp_no = $rows['passport_no'];
          $agency = $rows['agency'];
          $country = $rows['country'];

          $cand_nameUpper = strtoupper($cand_name);
          $son_ofUpper = strtoupper($son_of);
          $countryUpper = strtoupper($country);

          $pdf->SetFont('Arial','',10);
         
          $pdf->Cell(30, 8, $serial_no, 1, 0);
          $pdf->Cell(90, 8, $cand_nameUpper, 1, 0);
          $pdf->Cell(80, 8, $son_ofUpper, 1, 0);
          $pdf->Cell(35, 8, $pp_no, 1, 0);
          $pdf->Cell(50, 8, $agency, 1, 0);
          $pdf->Cell(50, 8, $countryUpper, 1, 1);
          
        }
 
  $pdf->Output();

?>