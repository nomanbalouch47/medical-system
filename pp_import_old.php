<?php
include('include/functions.php');
$output = '';

// if(isset($_FILES['file']['name']) &&  $_FILES['file']['name'] != '')
// {
//  $valid_extension = array('xml');
//  $file_data = explode('.', $_FILES['file']['name']);
//  $file_extension = end($file_data);
//  if(in_array($file_extension, $valid_extension))
//  {

  //http://127.0.0.1:8887/CandidatePassports/zaigg.xml

  //$data2 = simplexml_load_file($_FILES['file']['tmp_name']);
  $data2 = simplexml_load_file('http://127.0.0.1:8887/Plustek-SecureScan/RMC/CandidatePassports/passport.xml');

  //  $pp_info_insert = array(
  //               'scanned_date' => mysqli_real_escape_string($data->con, $data2->Index1->Date),
  //               'scanned_time' => mysqli_real_escape_string($data->con, $data2->Index1->Time),
  //               'first_name' => mysqli_real_escape_string($data->con, $data2->Index1->FirstName),
  //               'last_name' => mysqli_real_escape_string($data->con, $data2->Index1->LastName),
  //               'dob' => mysqli_real_escape_string($data->con, $data2->Index1->DateofBirth),
  //               'gender' => mysqli_real_escape_string($data->con, $data2->Index1->Gender),
  //               'pp_no' => mysqli_real_escape_string($data->con, $data2->Index1->DocumentNumber),
  //               'nationality' => mysqli_real_escape_string($data->con, $data2->Index1->Nationality),
  //               'valid_until' => mysqli_real_escape_string($data->con, $data2->Index1->ValidUntil),
  //               'image_path' => mysqli_real_escape_string($data->con, $data2->Index1->General),
                
  //             );
  // $result = $data->insert('candidate_passport_info', $pp_info_insert);
  // Commented because we dont need to insert pp info into db.Can be uncommented for further action.

  $ppno = $data2->Index1->DocumentNumber;
  $nation = $data2->Index1->Nationality;
  $candidate_name = $data2->Index1->FirstName.' '.$data2->Index1->LastName;
  $Gender = $data2->Index1->Gender;
  $d_o_b = date('Y-m-d', strtotime($data2->Index1->DateofBirth));
  $valid_until = date('Y-m-d', strtotime($data2->Index1->ValidUntil));
  $pp_img = $data2->Index1->General;
  
  $str = str_replace("\\", '/', $pp_img);
  $arr = explode("/", $str);
  $img_name = $arr[6];

  $Gender = ($Gender == 'M' ? 'Male' : 'False');
  if(isset($data2))
  {

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
                   <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label' for='exampleDatepicker'>Name </label>
                        <input class='form-control' type='text' id='candname' value='$candidate_name' readonly>
                      </div>
                    </div>

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
                  </div>";
            // echo "<img src='http://127.0.0.1:8887/Plustek-SecureScan/RMC/Image/$img_name' style='width:100px;height:100px;'><br>";
                  
            //https://chrome.google.com/webstore/detail/web-server-for-chrome/ofhbbkphhbklhfoeikjpcbhemlocgigb/related
            //add plustek securescan image folder in web server folder. test it on given port      
  }
// }
//  else
//  {
//   $output = '<div class="alert alert-warning">Invalid File</div>';
//  }
// }
// else
// {
//  $output = '<div class="alert alert-warning">Please Select XML File</div>';
// }

echo $output;

?>