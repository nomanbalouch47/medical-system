<?php
require('code128.php');
include('../include/functions.php');

if(isset($_GET['regno'])){
  $serialno = $_GET['regno'];
  
  $process_query = get_medical_report_pdf($serialno);
}
  // $serialno = '1/2/3/0';
  // $process_query = get_medical_report_pdf($serialno);


	// $pdf = new PDF();
    $pdf=new PDF_Code128();
    $pdf->isFinished = false;
	  $pdf->AddPage('P', 'A4', '0');
    $pdf->isFinished = true;
    // $pdf->Ln(2);
    
    $query_result=mysqli_fetch_array($process_query);
      
      // registration
      $serial_no = $query_result['serial_no'];
      $cand_name = $query_result['candidate_name'];
      $son_of = $query_result['son_of'];
      $pp_no = $query_result['passport_no'];
      $d_o_b = $query_result['d_o_b'];
      $date_o_b=date("d-m-Y",strtotime($d_o_b));
      $place_of_issue = $query_result['place_of_issue'];
      $pp_exp = $query_result['passport_expiry_date'];
      $pp_expiry=date("d-m-Y",strtotime($pp_exp));
      $profession = $query_result['profession'];
      $gender = $query_result['gender'];
      $nationality = $query_result['nationality'];
      $marital_status = $query_result['marital_status'];
      $cnic = $query_result['cnic'];
      $country = $query_result['country'];
      
      $reg_date=date("d-m-Y",strtotime($query_result['reg_date']));
      $barcode_no = $query_result['barcode_no'];
      $candidate_img = $query_result['candidate_img'];
      $medical_status = $query_result['medical_status'];

      // medical
      $height = $query_result['height'];
      $weight = $query_result['weight'];
      $bmi = $query_result['bmi'];
      $bp = $query_result['bp'];
      $pulse = $query_result['pulse'];
      $rr = $query_result['rr'];
      $visual_unaided_rt_eye = $query_result['visual_unaided_rt_eye'];
      $visual_unaided_left_eye = $query_result['visual_unaided_left_eye'];
      $visual_aided_rt_eye = $query_result['visual_aided_rt_eye'];
      $visual_aided_left_eye = $query_result['visual_aided_left_eye'];
      $distant_unaided_rt_eye = $query_result['distant_unaided_rt_eye'];
      $distant_unaided_left_eye = $query_result['distant_unaided_left_eye'];
      $distant_aided_rt_eye = $query_result['distant_aided_rt_eye'];
      $distant_aided_left_eye = $query_result['distant_aided_left_eye'];
      $near_unaided_rt_eye = $query_result['near_unaided_rt_eye'];
      $near_unaided_left_eye = $query_result['near_unaided_left_eye'];
      $near_aided_rt_eye = $query_result['near_aided_rt_eye'];
      $near_aided_left_eye = $query_result['near_aided_left_eye'];
      $color_vision = $query_result['color_vision'];
      $hearing_rt_ear = $query_result['hearing_rt_ear'];
      $hearing_left_ear = $query_result['hearing_left_ear'];
      $appearance = $query_result['appearance'];
      $speech = $query_result['speech'];
      $behavior = $query_result['behavior'];
      $cognition = $query_result['cognition'];
      $orientation = $query_result['orientation'];
      $memory = $query_result['memory'];
      $concentration = $query_result['concentration'];
      $mood = $query_result['mood'];
      $thoughts = $query_result['thoughts'];
      $other = $query_result['other'];
      $general_appearance = $query_result['general_appearance'];
      $cardiovascular = $query_result['cardiovascular'];
      $respiratory = $query_result['respiratory'];
      $ent = $query_result['ent'];
      $abdomen = $query_result['abdomen'];
      $hernia = $query_result['hernia'];
      $hydrocele = $query_result['hydrocele'];
      $extremities = $query_result['extremities'];
      $back = $query_result['back'];
      $skin = $query_result['skin'];
      $cns = $query_result['cns'];
      $deformities = $query_result['deformities'];
      $remarks = $query_result['remarks'];

      // xray result
      $xray_chest = $query_result['xray_chest'];

      // lab result
      $blood_group = $query_result['blood_group'];
      $Haemoglobin = $query_result['Haemoglobin'];
      $Malaria = $query_result['Malaria'];
      $Micro_filariae = $query_result['Micro_filariae'];
      $RBS = $query_result['RBS'];
      
      // LFT
      $BIL = $query_result['BIL'];
      $ALT = $query_result['ALT'];
      $AST = $query_result['AST'];
      $ALK = $query_result['ALK'];
      $Creatinine = $query_result['Creatinine'];
      $HIV = $query_result['HIV'];
      $HBsAg = $query_result['HBsAg'];
      $HCV = $query_result['HCV'];
      $VDRL = $query_result['VDRL'];
      $TPHA = $query_result['TPHA'];
      $sugar = $query_result['sugar'];
      $albumin = $query_result['albumin'];
      $helminthes = $query_result['helminthes'];
      $OVA = $query_result['OVA'];
      $CYST = $query_result['CYST'];
      $polio = $query_result['polio'];
      $polio_date = $query_result['polio_date'];
      $MMR1 = $query_result['MMR1'];
      $mmr1_date = $query_result['mmr1_date'];
      $MMR2 = $query_result['MMR2'];
      $mmr2_date = $query_result['mmr2_date'];
      $meningococcal = $query_result['meningococcal'];
      $meningococcal_date = $query_result['meningococcal_date'];

      $cand_nameUpper = strtoupper($cand_name);
      $son_ofUpper = strtoupper($son_of);
      $nationalityUpper = strtoupper($nationality);
      $place_of_issueUpper = strtoupper($place_of_issue);
      $marital_statusUpper = strtoupper($marital_status);
      $genderUpper = strtoupper($gender);
      $professionUpper = strtoupper($profession);
      $countryUpper = strtoupper($country);

    $code=$barcode_no;
    $today_date = date("d-m-Y");
    $logo="../assets/img/comp_logo/reliance_logo.png";

    // Title
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,40,$pdf->Image($logo,$pdf->GetX(),$pdf->GetY(),26,16),0,0,'L',false);
    $pdf->Cell(149,5,'G.H.C. Code 02/02/07',0,1,'R');
    $pdf->SetFont('Arial','',16);
    $pdf->SetX(75);
    $pdf->Cell(0,5,$countryUpper,0,1,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,5,'Date examined: '.$reg_date.'',0,1,'R');
    $pdf->Ln(1);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(160,7,'CANDIDATE INFORMATION',1,0,'C');
    if($candidate_img) {
      $pdf->Cell(40,7,$pdf->Image('../assets/candidate_image/'.$candidate_img,$pdf->GetX(),$pdf->GetY(),30.78,31),0,1,'L',false);
    } else {
      $pdf->Cell(40,7,$pdf->Image('../assets/img/no_image.jpg',$pdf->GetX(),$pdf->GetY(),30.78,31),0,1,'L',false);
    }
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(16,6,'Name',1,0,'L');
    $pdf->Cell(50,6,$cand_nameUpper,1,0,'L');
    $pdf->Cell(8,6,'S/O',1,0,'L');
    $pdf->Cell(56,6,$son_ofUpper,1,0,'L');
    $pdf->Cell(15,6,'Serial no',1,0,'L');
    $pdf->Cell(15,6,$serial_no,1,1,'L');
    $pdf->Cell(20,6,'Passport no',1,0,'L');
    $pdf->Cell(36,6,$pp_no,1,0,'L');
    $pdf->Cell(10,6,'DOB',1,0,'L');
    $pdf->Cell(23,6,$date_o_b,1,0,'L');
    $pdf->Cell(23,6,'Place of issue',1,0,'L');
    $pdf->Cell(48,6,$place_of_issueUpper,1,1,'L');
    $pdf->Cell(24,6,'Passport expiry',1,0,'L');
    $pdf->Cell(22,6,$pp_expiry,1,0,'L');
    $pdf->Cell(23,6,'Marital status',1,0,'L');
    $pdf->Cell(22,6,$marital_statusUpper,1,0,'L');
    $pdf->Cell(19,6,'Nationality',1,0,'L');
    $pdf->Cell(50,6,$nationalityUpper,1,1,'L');
    $pdf->Cell(18,6,'Profession',1,0,'L');
    $pdf->Cell(48,6,$professionUpper,1,0,'L');
    $pdf->Cell(23,6,'Gender',1,0,'L');
    $pdf->Cell(20,6,$genderUpper,1,0,'L');
    $pdf->Cell(19,6,'ID CARD #',1,0,'L');
    $pdf->Cell(32,6,$cnic,1,1,'L');

    // MEDICAL EXAMINATION: GENERAL
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(116,5,'MEDICAL EXAMINATION: GENERAL',1,0,'C');

    // INVESTIGATION
    $pdf->Cell(75,5,'INVESTIGATION',1,1,'C');

    // MEDICAL EXAMINATION: GENERAL
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(19,5,'Height',1,0,'L');
    $pdf->Cell(20,5,$height,1,0,'L');
    $pdf->Cell(19,5,'Weight',1,0,'L');
    $pdf->Cell(20,5,$weight,1,0,'L');
    $pdf->Cell(18,5,'BMI',1,0,'L');
    $pdf->Cell(20,5,$bmi,1,0,'L');

    // INVESTIGATION
    $pdf->Cell(25,5,'Chest X-Ray',1,0,'L');
    $pdf->Cell(50,5,$xray_chest,1,1,'L');
    
    // MEDICAL EXAMINATION: GENERAL
    $pdf->Cell(19,5,'B.P.',1,0,'L');
    $pdf->Cell(20,5,$bp,1,0,'L');
    $pdf->Cell(19,5,'Pulse',1,0,'L');
    $pdf->Cell(20,5,$pulse,1,0,'L');
    $pdf->Cell(18,5,'RR',1,0,'L');
    $pdf->Cell(20,5,$rr,1,0,'L');

    // LABORATORY Investigation Cell
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(75,5,'LABORATORY INVESTIGATION',1,1,'C');

    // MEDICAL EXAMINATION: GENERAL
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(34,10,'Visual acuity',1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(38,5,'Unaided',1,0,'C');
    $pdf->Cell(38,5,'Aided',1,0,'C');

    // TYPE OF LAB Investigation Cell
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(50,5,'TYPE OF LAB INVESTIGATION',1,0,'C');
    $pdf->Cell(31,5,'RESULTS',1,0,'L');
    $pdf->Ln(5);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(34,5,'',0,0,'L');
    //  Unaided
    $pdf->Cell(20,5,'Rt.Eye',1,0,'C');
    $pdf->Cell(18,5,'Lt.Eye',1,0,'C');
    //  Aided
    $pdf->Cell(20,5,'Rt.Eye',1,0,'C');
    $pdf->Cell(18,5,'Lt.Eye',1,0,'C');
    // TYPE OF LAB Investigation Cell
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(50,5,'BLOOD GROUP',1,0,'L');
    $pdf->Cell(31,5,$blood_group,1,1,'L');

    // MEDICAL EXAMINATION: GENERAL Distant
    $pdf->Cell(34,5,'Distant',1,0,'L');
    //  Unaided
    $pdf->Cell(20,5,$distant_unaided_rt_eye.'/6',1,0,'C');
    $pdf->Cell(18,5,$distant_unaided_left_eye.'/6',1,0,'C');
    //  Aided
    $pdf->Cell(20,5,$distant_aided_rt_eye.'/20',1,0,'C');
    $pdf->Cell(18,5,$distant_aided_left_eye.'/20',1,0,'C');
    
    // TYPE OF LAB Investigation Cell
    $pdf->Cell(50,5,'HAEMOGLOBIN',1,0,'L');
    $pdf->Cell(31,5,$Haemoglobin,1,1,'L');

    // MEDICAL EXAMINATION: GENERAL Near
    $pdf->Cell(34,5,'Near',1,0,'L');
    //  Unaided
    $pdf->Cell(20,5,$near_unaided_rt_eye.'/20',1,0,'C');
    $pdf->Cell(18,5,$near_unaided_left_eye.'/20',1,0,'C');
    //  Aided
    $pdf->Cell(20,5,$near_aided_rt_eye,1,0,'C');
    $pdf->Cell(18,5,$near_aided_left_eye,1,0,'C');

    // TYPE OF LAB Investigation Cell
    $pdf->Cell(81,5,'THICK FILM FOR',1,1,'L');

    // MEDICAL EXAMINATION: GENERAL Color Vision
    $pdf->Cell(34,5,'Color Vision',1,0,'L');
    $pdf->Cell(76,5,$color_vision,1,0,'L');
    // $pdf->Cell(25,6,'Doubtful',1,0,'C');
    // $pdf->Cell(27,6,'Defective',1,0,'C');

    // TYPE OF LAB Investigation Cell
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(50,5,'1. MALARIA',1,0,'L');
    $pdf->Cell(31,5,$Malaria,1,1,'L');
    
    // MEDICAL EXAMINATION: GENERAL
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(34,10,'Hearing',1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(38,5,'Rt.Ear',1,0,'C');
    $pdf->Cell(38,5,'Lt.Ear',1,0,'C');

    // TYPE OF LAB Investigation Cell
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(50,5,'2. MICRO FILARIA',1,0,'L');
    $pdf->Cell(31,5,$Micro_filariae,1,1,'L');

    // MEDICAL EXAMINATION: GENERAL
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(34,5,'',0,0,'L');
    $pdf->Cell(38,5,$hearing_rt_ear,1,0,'C');
    $pdf->Cell(38,5,$hearing_left_ear,1,0,'C');

    // BIOCHEMISTRY
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(81,5,'BIOCHEMISTRY',1,0,'L');
    $pdf->Ln(5);

    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(72,5,'MEDICAL EXAMINATION: Systemic',1,0,'L');
    $pdf->Cell(38,5,'FINDINGS',1,0,'C');

    // TYPE OF LAB Investigation Cell
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(50,5,'R.B.S',1,0,'L');
    $pdf->Cell(31,5,$RBS,1,1,'L');

    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(72,5,'GENERAL APPEARANCE',1,0,'L');
    $pdf->Cell(38,5,$general_appearance,1,0,'C');

    // BIOCHEMISTRY
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(12,5,'L.F.T',1,0,'L');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(69,5,'BIL:'.$BIL.'mg/dl, ALT:'.$ALT.'U/L, AST:'.$AST.'U/L, ALK:'.$ALK.'',1,1,'L');

    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(72,5,'CARDIOVASCULAR',1,0,'L');
    $pdf->Cell(38,5,$cardiovascular,1,0,'C');

    // TYPE OF LAB Investigation Cell
    $pdf->Cell(50,5,'CREATININE',1,0,'L');
    $pdf->Cell(31,5,$Creatinine,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    // $pdf->SetFont('Arial','',10);
    $pdf->Cell(72,5,'RESPIRATORY',1,0,'L');
    $pdf->Cell(38,5,$respiratory,1,0,'C');
    // SEROLOGY
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(81,5,'SEROLOGY',1,1,'L');
    // $pdf->Ln(6);
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(72,5,'ENT',1,0,'L');
    $pdf->Cell(38,5,$ent,1,0,'C');
    // SEROLOGY
    $pdf->Cell(50,5,'HIV I & II',1,0,'L');
    $pdf->Cell(31,5,$HIV,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->Cell(110,5,'GASTRO INTESTINAL',1,0,'L');
    // SEROLOGY
    $pdf->Cell(50,5,'HBs Ag',1,0,'L');
    $pdf->Cell(31,5,$HBsAg,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->Cell(72,5,'ABDOMEN (Mass, tenderness)',1,0,'L');
    $pdf->Cell(38,5,$abdomen,1,0,'C');
    // SEROLOGY
    $pdf->Cell(50,5,'Anti HCV',1,0,'L');
    $pdf->Cell(31,5,$HCV,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->Cell(72,5,'HERNIA',1,0,'L');
    $pdf->Cell(38,5,$hernia,1,0,'C');
    // SEROLOGY
    $pdf->Cell(50,5,'VDRL',1,0,'L');
    $pdf->Cell(31,5,$VDRL,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->Cell(110,5,'GENITOURINARY',1,0,'L');
    // SEROLOGY
    $pdf->Cell(50,5,'TPHA (if VDRL is positive)',1,0,'L');
    $pdf->Cell(31,5,$TPHA,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    // $pdf->SetFont('Arial','',10);
    $pdf->Cell(72,5,'HYDROCELE',1,0,'L');
    $pdf->Cell(38,5,$hydrocele,1,0,'C');
    // URINE
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(81,5,'URINE',1,0,'L');
    $pdf->Ln(5);
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(110,5,'MUSCULOSKELETAL',1,0,'L');
    // URINE
    $pdf->Cell(50,5,'Sugar',1,0,'L');
    $pdf->Cell(31,5,$sugar,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->Cell(72,5,'EXTREMITIES',1,0,'L');
    $pdf->Cell(38,5,$extremities,1,0,'C');
    // URINE
    $pdf->Cell(50,5,'Albumin',1,0,'L');
    $pdf->Cell(31,5,$albumin,1,1,'L');
    
    // $pdf->Ln(6);
    // MEDICAL EXAMINATION: SYSTEMIC
    // $pdf->SetFont('Arial','',8);
    $pdf->Cell(72,5,'BACK',1,0,'L');
    $pdf->Cell(38,5,$back,1,0,'C');
    // STOOL
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(81,5,'STOOL',1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(72,5,'SKIN',1,0,'L');
    $pdf->Cell(38,5,$skin,1,0,'C');
    // STOOL
    $pdf->Cell(81,5,'ROUTINE',1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->Cell(72,5,'C.N.S',1,0,'L');
    $pdf->Cell(38,5,$cns,1,0,'C');
    // STOOL
    $pdf->Cell(50,5,'  Helminthes',1,0,'L');
    $pdf->Cell(31,5,$helminthes,1,1,'L');
    
    // MEDICAL EXAMINATION: SYSTEMIC
    $pdf->Cell(72,5,'DEFORMITIES',1,0,'L');
    $pdf->Cell(38,5,$deformities,1,0,'C');
    // STOOL
    $pdf->Cell(50,5,'  OVA',1,0,'L');
    $pdf->Cell(31,5,$OVA,1,1,'L');

    // MENTAL STATUS EXAMINATION
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(72,5,'MENTAL STATUS EXAMINATION',1,0,'L');
    $pdf->Cell(38,5,'',1,0,'C');
    // STOOL
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(50,5,'  CYST',1,0,'L');
    $pdf->Cell(31,5,$CYST,1,1,'L');
    
    // MENTAL STATUS EXAMINATION
    $pdf->Cell(72,5,'A. Appearance',1,0,'L');
    $pdf->Cell(38,5,$appearance,1,0,'C');
    // STOOL
    // $pdf->SetFont('Arial','',10);
    $pdf->Cell(81,5,'Others',1,1,'L');
    
    // MENTAL STATUS EXAMINATION
    $pdf->Cell(72,5,'Speech',1,0,'L');
    $pdf->Cell(38,5,$speech,1,0,'C');
    // blank cell after stool
    $pdf->Cell(81,5,'',1,1,'L');

    
    // MENTAL STATUS EXAMINATION
    // $pdf->SetFont('Arial','',10);
    $pdf->Cell(72,5,'Behaviour',1,0,'L');
    $pdf->Cell(38,5,$behavior,1,0,'C');
    // VACCINATION STATUS
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(81,5,'VACCINATION STATUS',1,1,'C');
    
    // MENTAL STATUS EXAMINATION
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(72,5,'B. Cognition',1,0,'L');
    $pdf->Cell(38,5,$cognition,1,0,'C');
    // VACCINATION STATUS
    $pdf->Cell(30,5,'TYPE',1,0,'C');
    $pdf->Cell(24,5,'STATUS',1,0,'C');
    $pdf->Cell(27,5,'DATE',1,1,'C');
    
    // MENTAL STATUS EXAMINATION
    $pdf->Cell(72,5,'Orientation',1,0,'L');
    $pdf->Cell(38,5,$orientation,1,0,'C');
    // VACCINATION STATUS
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,5,'POLIO',1,0,'L');
    $pdf->Cell(24,5,$polio,1,0,'C');
    if($polio_date=="0000-00-00")
      $pdf->Cell(27,5,"00-00-0000",1,1,'C');
    else{
      $p_date=date("d-m-Y",strtotime($polio_date));
      $pdf->Cell(27,5,$p_date,1,1,'C');  
    }
    
    // MENTAL STATUS EXAMINATION
    $pdf->Cell(72,5,'Memory',1,0,'L');
    $pdf->Cell(38,5,$memory,1,0,'C');
    // VACCINATION STATUS
    $pdf->Cell(30,5,'MMR1',1,0,'L');
    $pdf->Cell(24,5,$MMR1,1,0,'C');
    if($mmr1_date=="0000-00-00")
      $pdf->Cell(27,5,"00-00-0000",1,1,'C');
    else{
      $mr1_date=date("d-m-Y",strtotime($mmr1_date));
      $pdf->Cell(27,5,$mr1_date,1,1,'C');  
    }
    
    // MENTAL STATUS EXAMINATION
    $pdf->Cell(72,5,'Concentration',1,0,'L');
    $pdf->Cell(38,5,$concentration,1,0,'C');
    // VACCINATION STATUS
    $pdf->Cell(30,5,'MMR2',1,0,'L');
    $pdf->Cell(24,5,$MMR2,1,0,'C');
    if($mmr2_date=="0000-00-00")
      $pdf->Cell(27,5,"00-00-0000",1,1,'C');
    else{
      $mr2_date=date("d-m-Y",strtotime($mmr2_date));
      $pdf->Cell(27,5,$mr2_date,1,1,'C');  
    }
    
    // MENTAL STATUS EXAMINATION
    $pdf->Cell(72,5,'C. Mood',1,0,'L');
    $pdf->Cell(38,5,$mood,1,0,'C');
    // VACCINATION STATUS
    $pdf->Cell(30,5,'Meningococcal',1,0,'L');
    $pdf->Cell(24,5,$meningococcal,1,0,'C');
    if($meningococcal_date=="0000-00-00")
      $pdf->Cell(27,5,"00-00-0000",1,1,'C');
    else{
      $men_date=date("d-m-Y",strtotime($meningococcal_date));
      $pdf->Cell(27,5,$men_date,1,1,'C');  
    }

    // MENTAL STATUS EXAMINATION
    // $pdf->SetFont('Arial','',10);
    $pdf->Cell(72,5,'D. Thoughts',1,0,'L');
    $pdf->Cell(38,5,$thoughts,1,0,'C');
    // VACCINATION STATUS
    $pdf->Cell(81,5,'Others',1,1,'L');
    
    // MENTAL STATUS EXAMINATION
    $pdf->Cell(72,5,'Others',1,0,'L');
    $pdf->Cell(38,5,$other,1,0,'C');
    // VACCINATION STATUS
    $pdf->Cell(81,5,'',1,1,'L');
    
    // REMARKS
    $pdf->Cell(0,4,'REMARKS',0,0,'L');
    $pdf->Ln(0.05);
    $pdf->SetFont('Arial','',9);
    // $pdf->Cell(191,10,'      '.$remarks.'',1,0,'L');
    if($xray_chest=="unfit due to x-ray findings")
    {
      $pdf->Cell(191,10,'The Applicants test for Xray Chest is: ',1,0,'L');
      $pdf->SetFont('Arial','B',9);
      $pdf->Ln(2.5);
      $pdf->SetX(63);
      $pdf->Cell(0,5,'Unfit due to xray findings',0,1,'L');
    }
    elseif($VDRL=="positive")
    {
      $pdf->Cell(191,10,'The Applicants test for VDRL is: ',1,0,'L');
      $pdf->SetFont('Arial','B',9);
      $pdf->Ln(2.5);
      $pdf->SetX(56);
      $pdf->Cell(0,5,'positive',0,1,'L');
    }
    elseif($HCV=="positive")
    {
      $pdf->Cell(191,10,'The Applicants test for Anti HCV is: ',1,0,'L');
      $pdf->SetFont('Arial','B',9);
      $pdf->Ln(2.5);
      $pdf->SetX(61);
      $pdf->Cell(0,5,'positive',0,1,'L');
    }
    elseif($HIV=="positive")
    {
      $pdf->Cell(191,10,'The Applicants test for HIV I & II is: ',1,0,'L');
      $pdf->SetFont('Arial','B',9);
      $pdf->Ln(2.5);
      $pdf->SetX(60);
      $pdf->Cell(0,5,'positive',0,1,'L');
    }
    elseif($HBsAg=="positive")
    {
      $pdf->Cell(191,10,'The Applicants test for HBsAg is: ',1,0,'L');
      $pdf->SetFont('Arial','B',9);
      $pdf->Ln(2.5);
      $pdf->SetX(57);
      $pdf->Cell(0,5,'positive',0,1,'L');
    }
    else
    {
      $pdf->Cell(191,10,' '.$remarks,1,0,'L');
      $pdf->Ln(7.5);
    }
    // $pdf->Ln(3);

        $pdf->Ln(2.5);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(0,6,'Dear Sir/Madam, ',0,0,'L');
        $pdf->Ln(0.05);
        $pdf->Cell(191,24,'',1,0,'L');
        $pdf->SetFont('Arial','',8);
        $pdf->Ln(4);
        
        $pdf->Cell(0,4,'Mentioned above is the medical report for Mr./Ms. '.$cand_nameUpper.'  who is '.$medical_status.' for the above mentioned job according to the GCC criteria.',0,1,'L');
        // The Applicants test for VDRL is positive
        $pdf->Code128(80,261,$code,50,13);
        // $pdf->Write(5,''.$barcode_no.'');
        $pdf->SetXY(50,195);

  $pdf->Output();

?>