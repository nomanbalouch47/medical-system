<?php
require('mysql_table.php');
include('../include/functions.php');


if (isset($_GET['data'])) {

    $a = $_GET['data'];
    echo $a;

} else {

    echo 'error';
}


/*class PDF extends PDF_MySQL_Table
{*/

/*function Header()
{
    // Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'RELIANCE MEDICAL LAB',0,1,'C');
    $this->Ln();
    $this->Cell(55,5,'Code 02/02/07',1,0);
    $this->Cell(0,6,'RAWALPINDI',0,1,'C');
    $this->Cell(25, 5, 'Date', 0, 0);
    $this->Ln();
    $this->Cell(0,6,'From:  --- To: ',0,1,'C');
    $this->Ln();
    $this->Cell(55, 5, 'DATE', 0, 0);
	$this->Cell(58, 5, 'SERIAL #', 0, 0);
	$this->Cell(25, 5, 'NAME', 0, 0);
	$this->Cell(52, 5, 'S/D/W/O', 0, 0);
	$this->Cell(55, 5, 'PP/CNIC #', 0, 0);
	$this->Cell(58, 5, 'COUNTRY', 0, 0);
	$this->Cell(55, 5, 'AGENCY', 0, 0);
	$this->Cell(55, 5, 'STATUS', 0, 0);
	$this->Line(10, 30, 200, 30);
    //$this->Cell();
    $this->Ln(10);
    // Ensure table header is printed
    parent::Header();
}*/



/*function getPDF_Data($process_query)
{
  //$lines = file($file);
  $obj = object($process_query);
	global $data;
	//$data = $process_query;
  $data = array();
  foreach($obj as $o)
        $data[] = explode(';',trim($o));
    return $data;	

	
}
}*/


	//global $pdf;
/*	$pdf = new PDF();
	$pdf->AddPage('L', 'Legal', '0');*/
	//$pdf->Header();
	//$pdf->getPDF_Data();
/*	$pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,4,$company_name,0,1,'C');
    $pdf->Ln();
    $pdf->Cell(40,6,'Code 02/02/07',1,0);
    $pdf->Cell(245,2,'RAWALPINDI',0,0,'C');
    $pdf->Cell(10, 2, 'Date', 0, 1, 'R');
    $pdf->Ln(2.4);
    $pdf->Cell(0,4,'From:  --- To: ',0,1,'C');
    $pdf->Ln();*/
    
    // horizontal line
/*    $pdf->Line(10, 30, 345, 30);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(20, 8, 'DATE', 1,0 );
  	$pdf->Cell(25, 8, 'SERIAL #', 1, 0);
  	$pdf->Cell(95, 8, 'NAME', 1, 0);
  	$pdf->Cell(85, 8, 'S/D/W/O', 1, 0);
  	$pdf->Cell(30, 8, 'PP/CNIC #', 1, 0);
  	$pdf->Cell(30, 8, 'COUNTRY', 1, 0);
  	$pdf->Cell(30, 8, 'AGENCY', 1, 0);
  	$pdf->Cell(20, 8, 'STATUS', 1, 0);*/
  	
    //$pdf->Cell();
/*    $pdf->Ln(3);
    $data = getPDF_Data();
    while ($rows = mysqli_fetch_array($data)) {
          $date = $rows['reg_date'];
          $serial_no = $rows['serial_no'];
          $cand_name = $rows['candidate_name'];
          $son_of = $rows['son_of'];
          $pp_no = $rows['passport_no'];
          $country = $rows['country'];
          $agency = $rows['agency'];
          $status = 'FIT';

          $pdf->SetFont('Arial','',10);
          $pdf->Cell(20, 8, '$date', 1,0 );
          $pdf->Cell(25, 8, '$serial_no', 1, 0);
          $pdf->Cell(95, 8, '$cand_name', 1, 0);
          $pdf->Cell(85, 8, '$son_of', 1, 0);
          $pdf->Cell(30, 8, '$pp_no', 1, 0);
          $pdf->Cell(30, 8, '$country', 1, 0);
          $pdf->Cell(30, 8, '$agency', 1, 0);
          $pdf->Cell(20, 8, '$status', 1, 0);*/

/*            $pdf->Cell('$date',20,'DATE','L');
            $pdf->Cell('$serial_no',40,'SERIAL #');
            $pdf->Cell('$cand_name',40,'NAME');
            $pdf->Cell('$son_of',40,'S/D/W/O');
            $pdf->Cell('$pp_no',40,'PP/CNIC #');
            $pdf->Cell('$country',40,'COUNTRY');
            $pdf->Cell('$agency',40,'AGENCY');
            $pdf->Cell('$status',40,'STATUS');*/
    // }

    	
		//$pdf->Output();

// Connect to database
//$link = mysqli_connect('localhost','root','','db_medical_sys');

// First table: output all columns
//$pdf->Table($link,'select * from tb_registration');
//$pdf->AddPage();
//$arrData = get_dateBWpdf();
/*foreach ($variable as $key => $value) {
	# code...
}*/
// Second table: specify 3 columns
/*$pdf->Cell('reg_date',20,'DATE','L');
$pdf->Cell('serial_no',40,'SERIAL #');
$pdf->Cell('candidate_name',40,'NAME');
$pdf->Cell('son_of',40,'S/D/W/O');
$pdf->Cell('passport_no',40,'PP/CNIC #');
$pdf->Cell('country',40,'COUNTRY');
$pdf->Cell('agency',40,'AGENCY');
$pdf->Cell('FIT',40,'STATUS');*/


/*$prop = array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);*/
//$pdf->Table($link,'select u_name, format(u_registered,0) as u_registered, u_id from tbl_users order by u_name limit 0,10',$prop);

?>