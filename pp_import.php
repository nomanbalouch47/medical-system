<?php
include('include/functions.php');
$output = '';
$counter_number = $_POST['counter_no'];

//$data2 = simplexml_load_file('http://127.0.0.1:8887/Plustek-SecureScan/RMC/CandidatePassports/passport.xml');

  $get_ppinfo = $data->query("SELECT SUBSTRING(dob,1, 2) AS d_year,SUBSTRING(dob,3, 2) AS d_month,SUBSTRING(dob,5, 2) AS d_date,SUBSTRING(pp_expiry_date,1, 2) AS p_year,SUBSTRING(pp_expiry_date,3, 2) AS p_month,SUBSTRING(pp_expiry_date,5, 2) AS p_date,pp_no,nationality,first_name,gender,last_name,cnic,pp_issue_state FROM passport_info where center_id='$center_id' and counter_no='$counter_number' order by id desc limit 1");

  $count_rows = mysqli_num_rows($get_ppinfo);

  if($count_rows > 0){
      $rows = mysqli_fetch_array($get_ppinfo);

      $birthdate = $rows['d_year'].'-'.$rows['d_month'].'-'.$rows['d_date'];
      $expirydate = $rows['p_year'].'-'.$rows['p_month'].'-'.$rows['p_date'];
      
      $ppno = $rows['pp_no'];
      $nation = $rows['nationality'];
      $candidate_name = $rows['first_name'].' '.$rows['last_name'];
      $candidate_cnic = $rows['cnic'];
      $Gender = $rows['gender'];
      $pp_issue_state = $rows['pp_issue_state'];

      $d_o_b = date('Y-m-d', strtotime($birthdate));
      $valid_until = date('Y-m-d', strtotime($expirydate));


      // $pp_img = $data2->Index1->General;
      
      // $str = str_replace("\\", '/', $pp_img);
      // $arr = explode("/", $str);
      // $img_name = $arr[6];

      $Gender = ($Gender == 'M' ? 'Male' : 'False');
 
      $output = "<div class='row align-items-center'>
                    <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label' for='exampleDatepicker'>Passport No </label>
                        <input class='form-control' type='text' id='passport' value='$ppno' readonly>
                      </div>
                    </div>

                    <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label'>Expiry Date</label>
                        <input class='form-control' type='datetime' placeholder='dd/mm/yyyy' id='ppexpirydate' value='$valid_until' readonly>                       
                      </div>
                    </div>

                    <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label'>Nationality</label>
                          <input class='form-control' id='nationality' type='text name='Nationality' value='$nation' readonly>
                      </div>
                    </div>
                  </div>

                  <div class='row align-items-center'>
                   <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label' for='exampleDatepicker'>Name </label>
                        <input class='form-control' type='text' id='candname' value='$candidate_name' readonly>
                      </div>
                    </div>

                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label' >CNIC </label>
                        <input class='form-control' type='text' id='cnic' name='cnic' value='$candidate_cnic' readonly>
                      </div>
                    </div>

                   
                  </div>

                  <div class='row align-items-center'>
                    <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label'>D.O.B</label>
                          <input class='form-control' id='dob' type='text name='dob' value='$d_o_b' readonly>
                      </div>
                    </div>

                    <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label'>Gender</label>
                          <input class='form-control' id='gender' type='text name='gender' value='$Gender' readonly>
                      </div>
                    </div>

                    <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label'>Passport Issue State</label>
                          <input class='form-control' id='issuestate' type='text name='issuestate' value='$pp_issue_state' readonly>
                      </div>
                    </div>

                  </div>";
            // echo "<img src='http://127.0.0.1:8887/Plustek-SecureScan/RMC/Image/$img_name' style='width:100px;height:100px;'><br>";
                  
            //https://chrome.google.com/webstore/detail/web-server-for-chrome/ofhbbkphhbklhfoeikjpcbhemlocgigb/related
            //add plustek securescan image folder in web server folder. test it on given port      
  }else{
    $output = "No Record Found";
  } 

echo $output;

?>