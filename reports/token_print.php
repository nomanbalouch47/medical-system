<?php
require('mysql_table.php');
include('../include/functions.php');

global $token;
// alert($token);
if(isset($_GET['token'])) 
{
  $token = $_GET['token'];
}

// print_r($token);


class PDF extends PDF_MySQL_Table
{ 


}
  $process_query2 = get_medical_lab_OrganInfo_pdf();
  $query_result2=mysqli_fetch_array($process_query2);
  $address = $query_result2['address'];
  $medical_lab_title = $query_result2['title'];
  $phone_no = $query_result2['phone_no'];
  $phone_no_2 = $query_result2['phone_no_2'];
  $fax_no = $query_result2['fax_no'];

  $logo="../assets/img/comp_logo/reliance_logo.png";
  $pdf = new FPDF('P','mm',array(76,70));
	$pdf->AddPage('P','','');
  $pdf->Ln(-9);
  $pdf->SetFont('Arial','B',14);
  $pdf->SetX(20);
  $pdf->Cell(30,8,$pdf->Image($logo,$pdf->GetX(),$pdf->GetY(),30,8),0,0,'C',false);
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',10);
  $pdf->SetX(13);
  $pdf->Cell(60,5,$medical_lab_title,0,1);
  // $pdf->Cell(60,5,"RELIANCE MEDICAL LAB", 0, 1);
  $pdf->Ln(3);
  $pdf->SetX(27);
  $pdf->SetFont('Arial','',9);
  // $pdf->SetX(35);
  $pdf->Cell(20,5,'Token No',0,1);
  $pdf->Ln(3);
  $pdf->SetFont('Arial','B',36);
  $pdf->SetX(18);
  $pdf->Cell(20,5,$token,0,1);
  $pdf->SetFont('Arial','',9);
  
  $pdf->Ln();
  $pdf->SetX(16);
  $date_time=date("d-m-Y    h:i:sa",strtotime($today_date_with_time));
  $pdf->Cell(30,5,$date_time,0,0);
  $pdf->Ln(16);
  $pdf->SetFont('Arial','',7);
  $pdf->SetX(18);
  $pdf->Cell(20,2,'Powered By: Inspedium Corp',0,0);
  $pdf->Ln(3);
  $pdf->SetX(22);
  $pdf->Cell(20,1,'www.inspedium.com',0,0);
  // $pdf->SetX(25);
  // $pdf->Cell(20,3,'',0,1);
  // $pdf->Ln();
  // $pdf->Cell(20,0,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _',0,0);
  // echo "<script>window.print();</script>";
  
  // Download the pdf with token_no
   $pdf->Output("token.pdf",'D');
    //$dir='../token_pdf/';
   //$pdf->Output($dir.'/'.$token.".pdf","D");
   //$pdf->Output();
  // echo $str;
   // echo "<script>window.onload=function(){window.print()};</script>";
   // $filename="/home/user/public_html/test.pdf";
   // $pdf->Output($filename,'F');



  // if($token) {
    
  //   //echo "<script>window.print()</script>";
  //   //echo "<script>window.print();</script>";
  // }
  
?>