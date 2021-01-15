<?php
// require('mysql_table.php');
include('../include/functions.php');
require('code128.php');

//error_reporting(0);

if (isset($_GET['barcode'])) {
   
   $barcode_num = $_GET['barcode'];
}

$process_query = get_medical_lab_report_pdf($barcode_num);
  //print_r($process_query2);



class PDF extends PDF_Code128
{

//$pdf2 = new PDF_Code128();

function Header()
{
    $today_date = date("d-m-Y");
    $image1="../assets/img/comp_logo/reliance_logo.png";

    $process_query2 = get_medical_lab_OrganInfo_pdf();
    $query_result2=mysqli_fetch_array($process_query2);
      $address = $query_result2['address'];
      $phone_no = $query_result2['phone_no'];
      $phone_no_2 = $query_result2['phone_no_2'];
      $fax_no = $query_result2['fax_no'];
      $email_addr = $query_result2['email_address'];
     

    // Title
    $this->SetFont('Arial','',11);
    //$this->Image($image1,10,10,15);
    $this->Ln(18);
    //$this->Cell(0,20,$this->Image($image1,$this->GetX(),$this->GetY(),109.78),0,1,'R',false);

    $this->SetX(70); //The next cell will be set 100 units to the right
    $this->Cell(40,0,$this->Image($image1,$this->GetX(),$this->GetY(),70,20),0,0,'C',false);
    //$this->Cell(70,0,$this->Image($image1),0,0,'C',true);
    $this->Ln(20);
    $this->Ln(20);

    //$this->Cell(149,5,'G.H.C. Code 02/02/07',0,1,'R');
    $this->SetFont('Arial','U',14);
    $this->Cell(0,6,$address,0,1,'C');
    $this->Cell(0,6,'Phone: '.$phone_no.', '.$phone_no_2.', Fax: '.$fax_no.'',0,1,'C');
    $this->Cell(0,6,'Email: '.$email_addr.'',0,1,'C');
    $this->Ln(6);

        /*$this->SetFont('Arial','',11);
        $this->Cell(0,5,'Date examined: '.$today_date.'',0,1,'R');*/
    

    // horizontal line
      $this->Ln(2);
      $this->Line(30, 95, 180, 95);
      $this->Ln(6);
    // Ensure table header is printed
    parent::Header();
}

function Body()
{
    global $serial_no;
    global $cand_nameUpper;
    global $countryUpper;    
    global $pp_no;
    global $time;
    global $phone_1;

    
    $this->SetFont('Arial','',11);
    //$this->Cell(169,7,'CANDIDATE INFORMATION',1,1,'C');
    //$this->Cell(40,7,$this->Image($image1,$this->GetX(),$this->GetY(),30.78,42.78),0,1,'L',false);
    //$this->SetFont('Arial','',9);
    $this->SetX(15);
    $this->Cell(60,7,'Candidate Name',1,0,'L');
    $this->Cell(120,7,$cand_nameUpper,1,1,'L');
    $this->SetX(15);
    $this->Cell(60,7,'Passport Number',1,0,'L');
    $this->Cell(120,7,$pp_no,1,1,'L');
    $this->SetX(15);
    $this->Cell(60,7,'Country',1,0,'L');
    $this->Cell(120,7,$countryUpper,1,1,'L');
    $this->SetX(15);
    $this->Cell(60,7,'Mobile Number',1,0,'L');
    $this->Cell(120,7,$phone_1,1,1,'L');
    $this->SetX(15);
    $this->Cell(60,7,'Reporting Date',1,0,'L');
    $this->Cell(120,7,'After 2 Working Days',1,1,'L');
    $this->SetX(15);
    $this->Cell(60,7,'Reporting Time',1,0,'L');
    $this->Cell(120,7,'3.00 PM',1,1,'L');   

    $this->Ln(6);
}

function Footer()
{
    global $serial_no;
    global $cand_nameUpper;
    global $countryUpper;
    global $pp_no;
    global $reg_date;
    global $barc;
    global $token_no;
    $exam_date=date("d-m-Y",strtotime($reg_date));
    $image1="../assets/img/bar-code.jpg";
    $code=$barc;
       

  if($this->isFinished){
        $this->Ln(2);
        //$this->Cell(0,10,'',1,1,'L');
        $this->SetFont('Arial','',12);
        //$this->Cell(0,4,'Dear Sir/Madam, ',0,0,'L');
        //$this->Ln(0.05);
        //$this->Cell(200,20,'',0,0,'L');
       
        

        // $this->SetX(120);
        // $this->Code128(40,0,$code,70,33);
        // $this->SetY(190);
        // //$this->Write(5,$code);
        $this->SetX(110);
        $this->Code128(110,150,$code,70,22);
        $this->Ln(21);
        //$this->SetX(190);
        //$this->SetXY(50,145);
        $this->SetX(110);
        $this->SetX(130);
        $this->SetFont('Arial','',14);
        $this->Write(5,''.$code.'');

        // $this->SetX(120); //The next cell will be set 100 units to the right
        // $this->Cell(40,0,$this->Image($image1,$this->GetX(),$this->GetY(),70,33),0,1,'C',false);
        // $this->SetY(190);

        $this->SetX(15);
        $this->Ln(16);
        $this->Cell(4,10,"........................................................................................................................................", 0, 1);
        $this->Ln(20);
        $this->SetFont('Arial','',10);
        $this->Cell(12,7,$token_no,0,1,'R');

        $this->SetFont('Arial','',14);
        
        $this->SetX(15);
        $this->Cell(60,7,'Candidate Name',1,0,'L');
        $this->Cell(120,7,$cand_nameUpper,1,1,'L');
        $this->SetX(15);
        $this->Cell(60,7,'Passport Number',1,0,'L');
        $this->Cell(120,7,$pp_no,1,1,'L');
        $this->SetX(15);
        $this->Cell(60,7,'Country',1,0,'L');
        $this->Cell(120,7,$countryUpper,1,1,'L');
        $this->SetX(15);
        $this->Cell(60,7,'Serial Number',1,0,'L');
        $this->Cell(120,7,$serial_no,1,1,'L');
        $this->SetX(15);
        $this->Cell(60,7,'Examination Date',1,0,'L');
        $this->Cell(120,7,$exam_date,1,1,'L');
        $this->SetX(15);
        


        $this->Ln(16);   
        $this->SetX(30);
        $this->Cell(15,10, 'Lab  ', 0, 0);
        $this->Cell(15,12, '', 1, 0);
        $this->SetX(80);
        $this->Cell(18,10, 'X-Ray    ', 0, 0);
        $this->Cell(15,12, '', 1, 0);
        $this->SetX(140);
        $this->Cell(15,10, 'MO   ', 0, 0);
        $this->Cell(15,12, '', 1, 1);
        $this->Ln(6);
/*        $this->SetX(15);
        $this->Cell(10,10, 'Serial No: ', 0, 0);
        //$this->SetFont('','B',12);
        $this->SetFont('Courier','U',12);
        $this->Cell(62,10,'      '.$serial_no.'     ',0,0, 'C');
        $this->SetX(110);
        $this->SetFont('Arial','',12);
        $this->Cell(130,10, 'Examination Date: ', 0, 0);
        $this->SetFont('Courier','U',12);
        $this->SetX(110);
        $this->Cell(130,10,'    '.$reg_date.'   ',0,1, 'C');
        $this->SetX(15);
        $this->SetFont('Arial','',12);
        $this->Cell(15,10, 'Name:   ', 0, 0);
        $this->SetFont('Courier','U',12);
        $this->Cell(52,10,'      '.$cand_nameUpper.'     ',0,0, 'C');
        $this->SetX(110);
        $this->SetFont('Arial','',12);
        $this->Cell(15,10, 'Passport No: ', 0, 0);
        $this->SetFont('Courier','U',12);
        $this->Cell(101,10,'    '.$pp_no.'    ',0,0, 'C');*/
    // Ensure table footer is printed
    parent::Footer();
  }
}

}
	$pdf = new PDF();
    $pdf->isFinished = false;
	$pdf->AddPage('P', 'A4', '0');
    $pdf->isFinished = true;
    
    // horizontal line
    //  $pdf->Line(10, 30, 345, 30);
    $pdf->Ln(3);
    
    $query_result=mysqli_fetch_array($process_query);
      $serial_no = $query_result['serial_no'];
      $cand_name = $query_result['candidate_name'];
      $country = $query_result['country'];
      $phone_1 = $query_result['phone_1'];
      $pp_no = $query_result['passport_no'];
      $reg_date = $query_result['reg_date'];
      $time = $query_result['created_at'];
        $barc = $query_result['barcode_no'];
       $token_no = $query_result['token_no'];

      $cand_nameUpper = strtoupper($cand_name);
      $countryUpper = strtoupper($country);

      //$pdf->SetFont('Arial','',10);
      $pdf->Body();

 
  $pdf->Output();

?>