<?php
require('mysql_table.php');
include('../include/functions.php');

if(isset($_GET['ppno'])){

  $ppno = $_GET['ppno'];
  $process_query = get_embassay_report_pdf($ppno);
}
    
  //print_r($process_query2);

class PDF extends PDF_MySQL_Table
{

function Header()
{
    
    // Ensure table header is printed
    parent::Header();
}

function Body()
{
    global $serial_no;
    global $cand_nameUpper;
    global $countryUpper; 
    global $reg_date;   
    global $pp_no;
    global $f_nameUpper;
    global $cnic; 
    global $profession;   
    global $p_o_i;
    global $agency;
    global $d_o_b;
    $DOB=date("d-m-Y",strtotime($d_o_b));
    $regDate=date("d-m-Y",strtotime($reg_date));
    $this->setFillColor(230,230,230);
    $this->SetFont('Arial','B',12);
   
    $this->SetX(10);
    $this->Cell(30,9,'Date',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$regDate,1,0,'L');
    $this->SetFont('Arial','B',12);
    $this->Cell(30,9,'Serial No.',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$serial_no,1,1,'L');
    $this->SetFont('Arial','B',12);
    $this->SetX(10);
    $this->Cell(30,9,'Name',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$cand_nameUpper,1,0,'L');
    $this->SetFont('Arial','B',12);
    $this->Cell(30,9,'CNIC',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$cnic,1,1,'L');
    $this->SetFont('Arial','B',12);
    $this->SetX(10);
    $this->Cell(30,9,'Father Name',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$f_nameUpper,1,0,'L');
    $this->SetFont('Arial','B',12);
    $this->Cell(30,9,'Passport No.',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$pp_no,1,1,'L');
    $this->SetFont('Arial','B',12);
    $this->SetX(10);
    $this->Cell(30,9,'Profession',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$profession,1,0,'L');
    $this->SetFont('Arial','B',12);
    $this->Cell(30,9,'Place of Issue',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$p_o_i,1,1,'L');
    $this->SetFont('Arial','B',12);
    $this->SetX(10);
    $this->Cell(30,9,'Agency',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$agency,1,0,'L');
    $this->SetFont('Arial','B',12);
    $this->Cell(30,9,'DOB',1,0,'L',1);
    $this->SetFont('Arial','',11);
    $this->Cell(65,9,$DOB,1,1,'L');
       

    $this->Ln(6);
}

function Footer()
{

  if($this->isFinished){
        $this->Ln(2);
        
        $this->SetFont('Arial','',10);
        $this->Ln(20);
        $this->Cell(140,10, "____________________________________", 0, 0);
        
        $this->Ln(5);
        $this->Cell(100,10, '           Authorised Signature & Stamp ', 0, 0);
        
        $this->Ln(40);
        $this->Cell(100,10, '***Note***Please report to embassay after 6 working days. ', 0, 0);
        
    // Ensure table footer is printed
    parent::Footer();
  }
}

}
	$pdf = new PDF();
    $pdf->isFinished = false;
	$pdf->AddPage('P', 'A4', '0');
    $pdf->isFinished = true;

    $today_date = date("d-m-Y");
    global $medical_lab_title;

    $query_result=mysqli_fetch_array($process_query);
      $serial_no = $query_result['serial_no'];
      $cand_name = $query_result['candidate_name'];
      $f_name = $query_result['son_of'];
      $country = $query_result['country'];
      $cnic = $query_result['cnic'];
      $agency = $query_result['agency'];
      $p_o_i = $query_result['place_of_issue'];
      $profession = $query_result['profession'];
      $pp_no = $query_result['passport_no'];
      $reg_date = $query_result['reg_date'];
      $d_o_b = $query_result['d_o_b'];
      $time = $query_result['created_at'];      

      $cand_nameUpper = strtoupper($cand_name);
      $f_nameUpper = strtoupper($f_name);
      $countryUpper = strtoupper($country);



    $process_query2 = get_medical_lab_OrganInfo_pdf();
    $query_result2=mysqli_fetch_array($process_query2);
      $address = $query_result2['address'];
      $medical_lab_title = $query_result2['title'];
      $phone_no = $query_result2['phone_no'];
      $phone_no_2 = $query_result2['phone_no_2'];
      $fax_no = $query_result2['fax_no'];
      //$email_addr = $query_result2['email_address'];

    // Title
    $pdf->SetFont('Arial','B',18);
    $pdf->setFillColor(210,230,230);
    $pdf->Ln(10);
    
    $pdf->SetX(50); //The next cell will be set 100 units to the right
    $pdf->Cell(110,9,$medical_lab_title,0,1,'C',1);
    // $pdf->Ln();

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,6,$address,0,0,'C');
    $pdf->Ln(5);
    $pdf->SetX(10);
    $pdf->Cell(0,6,'Phone: '.$phone_no.', '.$phone_no_2.', Fax: '.$fax_no.'',0,1,'C');
    $pdf->Ln(6);
    $pdf->setFillColor(230,230,230);
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(0,10,''.$countryUpper.'',1,1,'C',1);
    $pdf->Ln(2);
    $pdf->Ln(3);

    $pdf->Body();

 
  $pdf->Output();

?>