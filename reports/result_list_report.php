<?php
require('mysql_table.php');
include('../include/functions.php');

$process_query = daily_cash_statement();
$discount_query = daily_discount();

class PDF extends PDF_MySQL_Table
{

function Header()
{
    
    $this->SetFont('Arial','B',16);
    $this->setFillColor(210,230,230);
    $this->SetX(55);
    // $this->Cell(100,11,' RELIANCE MEDICAL LAB ',0,1,'C',1);
    $this->Ln(3);
    // $this->SetFont('Arial','B',14);
    $this->Cell(70,2,"Result List Report",0,0,'L');
    $this->SetFont('Arial','',12);
    $this->Cell(0,4,'Operator ID: 02/02/07',0,1,'R');
    // $this->Ln(2);

    $this->SetFont('Arial','B',12);
    $this->Cell(0,6,'Unreleased',0,0,'L');
    $this->SetFont('Arial','',12);
    $this->Cell(0,6,'System serial number: 65284',0,1,'R');
    
    $this->Ln(4);

    // $this->setFillColor(230,230,230);
    $this->SetFont('Arial','B',11);
   
    $this->SetX(7);
    $this->Cell(16,9,'C / P','T',0,'C');
    $this->Cell(16,9,'Module','T',0,'C');
    $this->Cell(20,9,'SID','T',0,'C');
    $this->Cell(20,9,'Name','T',0,'C');
    $this->Cell(20,9,'Assay','T',0,'C');
    $this->Cell(50,9,'Result','T',0,'C');
    $this->Cell(14,9,'Flags','T',0,'C');
    $this->Cell(12,9,'Code','T',0,'C');
    $this->Cell(29,9,'Date / Time','T',0,'C');
    $this->Ln(9);
    // $this->Ln(2);
          // $this->SetX(-5);
          $this->SetY(34);
          $this->SetX(5.5);
          $this->Cell(160,1,'____________________________________________________________________________________________',0,'L');
          $this->SetY(35);
          $this->SetX(5.5);
          $this->Cell(160,1,'____________________________________________________________________________________________',0,'L');
          // $this->Cell(16,2,'',0,'L');
          $this->Ln(2.3);
    // Ensure table header is printed
    parent::Header();
}

function Body()
{
    global $process_query;
    global $discount_query;

    $total=0;
    // $this->setFillColor(230,230,230);
    // $this->SetFont('Arial','B',11);
   
    // $this->SetX(7);
    // $this->Cell(16,9,'C / P',1,0,'C',1);
    // $this->Cell(16,9,'Module',1,0,'C',1);
    // $this->Cell(20,9,'SID',1,0,'C',1);
    // $this->Cell(20,9,'Name',1,0,'C',1);
    // $this->Cell(25,9,'Assay',1,0,'C',1);
    // $this->Cell(45,9,'Result',1,0,'C',1);
    // $this->Cell(14,9,'Flags',1,0,'C',1);
    // $this->Cell(12,9,'Code',1,0,'C',1);
    // $this->Cell(29,9,'Date / Time',1,1,'C',1);
    // $this->SetX(10);
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
        // $x = $this->GetX();
        // $y = $this->GetY();
        // // $this->SetX(7);
        //   $this->SetXY($x - 3, $y);
        //   $this->SetFont('Arial','',11);
        //   $this->MultiCell(20,9,'H790/1',1,'L');
        //   $this->SetXY($x + 17, $y);
        //   $this->MultiCell(16,9,'1',1,'L');
        //   $this->SetXY($x + 33, $y);
        //   $this->MultiCell(20,9,'1/P',1,'L');
        //   $this->SetXY($x + 53, $y);
        //   $this->MultiCell(20,9,'',1,'R');
        //   $this->SetXY($x + 73, $y);
        //   $this->MultiCell(25,9,'SyphilisTP',1,'L');
        //   $this->SetXY($x + 98, $y);
        //   $this->MultiCell(45,9,'0.07 S/CO Nonreactive',1,'L');
        //   $this->SetXY($x + 143, $y);
        //   $this->MultiCell(14,9,'',1,'L');
        //   $this->SetXY($x + 157, $y);
        //   $this->MultiCell(12,9,'',1,'L');
        //   $this->SetXY($x + 169, $y);
        //   $this->MultiCell(25,9,'31.12.2020 12:52',1,'L');
        //   $this->Ln(0);

          $j=1;
          $k=1;
          for($i=1; $i<200; $i++) {

            $this->SetX(7);
            
            if($i%4==0){
              
              $this->Cell(19,9,'H790/'.$k.' ','R',0,'C');
              $this->Cell(7,9,'1','L',0,'C');
              $this->Cell(26,9,'  '.$k.'/P','L',0,'C');
              if($j==1){
                
                
                $this->Cell(20,9,'','L',0,'C');
                $this->Cell(20,9,'SyphilisTP','L',0,'C');
                $this->Cell(50,9,'0.07 S/CO Nonreactive','L',0,'C');
                $this->Cell(14,9,'','L',0,'C');
                $this->Cell(12,9,'','L',0,'C');
                $this->Cell(25,9,'31.12.2020 12:52','L',1,'L');
              } elseif($j==2){
                // $this->Cell(16,9,'H790/1'.' ','R',0,'R');
                // $this->Cell(16,9,'1','L',0,'C');
                // $this->Cell(20,9,'1/P','L',0,'C');
                $this->Cell(20,9,'','L',0,'C');
                $this->Cell(20,9,'HBsAgQ2','L',0,'C');
                $this->Cell(50,9,'0.17 S/CO Nonreactive','L',0,'C');
                $this->Cell(14,9,'','L',0,'C');
                $this->Cell(12,9,'','L',0,'C');
                $this->Cell(25,9,'31.12.2020 12:52','L',1,'L');
              } elseif($j==3){
                // $this->Cell(16,9,'H790/1'.' ','R',0,'R');
                // $this->Cell(16,9,'1','L',0,'C');
                // $this->Cell(20,9,'1/P','L',0,'C');
                $this->Cell(20,9,'','L',0,'C');
                $this->Cell(20,9,'Anti-HCV','L',0,'C');
                $this->Cell(50,9,'0.16 S/CO Nonreactive','L',0,'C');
                $this->Cell(14,9,'','L',0,'C');
                $this->Cell(12,9,'','L',0,'C');
                $this->Cell(25,9,'31.12.2020 12:52','L',1,'L');
              }
               elseif($j==4){
                // $this->Cell(16,9,'H790/1'.' ','R',0,'R');
                // $this->Cell(16,9,'1','L',0,'C');
                // $this->Cell(20,9,'1/P','L',0,'C');
                $this->Cell(20,9,'','L',0,'C');
                $this->Cell(20,9,'_HIV Ag/Ab','L',0,'C');
                $this->Cell(50,9,'0.15 S/CO Nonreactive','L',0,'C');
                $this->Cell(14,9,'','L',0,'C');
                $this->Cell(12,9,'','L',0,'C');
                $this->Cell(25,9,'31.12.2020 12:52','L',1,'L');
                $j=0;
                $k++;
              }
              $j++;
              // $k++;
              
            }
            
          }
          // $this->SetXY($x + 169, $y);

          //discount section
          // $disc_row = mysqli_fetch_array($discount_query);
          // $total_disc = $disc_row['total_discount'];
          // $this->SetX(7);
          // $this->Cell(20,9,'Discount',1,0,'L');
          // $this->Cell(16,9,'',1,0,'L');
          // $this->Cell(20,9,'',1,0,'L');
          // $this->Cell(20,9,number_format($total_disc),1,0,'R');
          // $this->Cell(85,9,'',1,1,'L');

          //total section
          // $this->Cell(20,9,'Cash in Hand',1,0,'L');
          // $this->Cell(15,9,'',1,0,'L');
          // $this->Cell(20,9,'',1,0,'L');
          // $this->Cell(20,9,number_format($total-$total_disc),1,0,'R');
          // $this->Cell(85,9,'',1,1,'L');
       

    // $this->Ln(6);
}

function Footer()
{
  global $login_name;

  if($this->isFinished){
        $this->Ln(4);
        $this->SetFont('Arial','',11);

        // $this->Ln(20);
        $this->SetY(-15); // 15
        $this->Cell(140,10, "Printed on: 31.12.2020 2:30:24PM", 0, 0);
        $this->SetX(95);
        $this->SetFont('Arial','B',14);
        $this->Cell(140,10, "ARCHITECT", 0, 0);
        $this->SetX(175);
        $this->SetFont('Arial','',11);
        $this->Cell(30,7,'Page '.$this->PageNo().' of {nb}'.$this->AliasNbPages().'',0,0,'R');


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



      $process_query2 = get_medical_lab_OrganInfo_pdf();
      $query_result2=mysqli_fetch_array($process_query2);
      $address = $query_result2['address'];
      $medical_lab_title = $query_result2['title'];
      $phone_no = $query_result2['phone_no'];
      $phone_no_2 = $query_result2['phone_no_2'];
      $fax_no = $query_result2['fax_no'];

    // Title
    // $pdf->SetFont('Arial','B',14);
    // // $pdf->Ln(2);
    
    // $pdf->SetX(10); //The next cell will be set 100 units to the right
    // $pdf->Cell(70,2,"Result List Report",0,0,'L');
    // $pdf->SetFont('Arial','',12);
    // $pdf->Cell(0,4,'Operator ID: 02/02/07',0,1,'R');
    // // $pdf->Ln(2);

    // $pdf->SetFont('Arial','B',12);
    // $pdf->Cell(0,6,'Unreleased',0,0,'L');
    // $pdf->SetFont('Arial','',12);
    // $pdf->Cell(0,6,'System serial number: 65284',0,1,'R');
    // $pdf->Ln(6);

    $pdf->Body();

 
  $pdf->Output();

?>