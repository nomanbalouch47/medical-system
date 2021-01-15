<?php
session_start();
include('db.php');

$ip = $_SERVER['REMOTE_ADDR'];
if (! empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

if(isset($_SESSION['user_login']) != ""){

$loginuser = $_SESSION['user_login']['user_id'];
$center_id = $_SESSION['user_login']['center_id'];
$login_name = $_SESSION['user_login']['login_user'];
 
}

date_default_timezone_set("Asia/Karachi");
$time = date("d-m-y h:i:s A");
$today_date = date("Y-m-d");
$current_year =date("Y");
$today_date_for_datepicker = date("m/d/Y");
$today_date_with_time = date("Y-m-d H:i:s");
$title = "Medical System";
$token_prefix= "M";

$data = new Databases;
$Queries = new Queries;

function alert_box($var){
    echo "<script>alert('$var')</script>";
}
function redirect($pgname,$type){
    echo "<script>window.open('$pgname','$type')</script>";
}
function screen_reload(){
    echo "<script>location.reload()</script>";
}

function auth_user($loginID,$moduleID){
  global $data;
  $check_page_rights = $data->query("select * from user_rights where user_id='$loginID' and module_id='$moduleID'");
  $count_rows=mysqli_num_rows($check_page_rights);
  if($count_rows == 0){
    // alert_box("You have no access to this page.");
    redirect('403_error','_self');
  }
}

function auth_user_sideBar($loginID,$moduleID){
  global $data;
  $check_sideBar_rights = $data->query("select * from user_rights where user_id='$loginID' and module_id='$moduleID'");
  $count_rows=mysqli_num_rows($check_sideBar_rights);
  if($count_rows > 0){
    return 1;
  }
}

function edit_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select edit_rights from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and edit_rights='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function delete_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select delete_rights from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and delete_rights='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function biometric_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select biometric_allow from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and biometric_allow='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function b_plus_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select b_plus_rights from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and b_plus_rights='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function status_pending_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select pending_rights from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and pending_rights='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function date_search_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select date_search_rights from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and date_search_rights='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function barcode_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select barcode_verification from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and barcode_verification='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function now_serving_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select now_serving_rights from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and now_serving_rights='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function print_lab_sticker_rights($loginID,$moduleID){
  global $data;
  global $center_id;
  $check_rights = $data->query("select print_lab_sticker from user_action_rights where user_id='$loginID' and module_id='$moduleID' and center_id='$center_id' and print_lab_sticker='1'");
  $count_rows= mysqli_num_rows($check_rights);
  if($count_rows > 0){
    return 1;
  }
}

function show_message($msg_type,$msg)
{
  if($msg_type == 0)
  {
    echo "<br><div class='alert alert-danger alert-dismissible fade show' role='alert'>   
                  <span class='alert-text'><strong>Warning! </strong>$msg</span>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
  }
  elseif($msg_type == 1)
  {

    echo "<br><div class='alert alert-success alert-dismissible fade show col-md-offset-2' role='alert'>   
                            <span class='alert-text'><strong>Success!</strong> $msg</span>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
  }

}

if(isset($_POST['form_name']))
{

    if($_POST['form_name'] == 'Candidate Already Check')
    {

      $passport_number = $_POST['passport_number'];
      $cnic_number = $_POST['cnic_number'];

      $get_cand_result = $data->query("select reg_id,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,reg_date,medical_status from tb_registration where passport_no='$passport_number' || cnic = '$cnic_number'");

      $count_cand_result = mysqli_num_rows($get_cand_result);

      if($count_cand_result > 0){

      $response = "<h4>Candidate Info</h4><table border='1' width='100%'>";
      while($row = mysqli_fetch_array($get_cand_result) ){
            
            $regDate = $row['reg_date'];
            $serial_no = $row['serial_no'];
            $candidate_name = $row['candidate_name'];
            
            if($row['country'] == 'CASE CANCELLED'){
              $medical_status = 'CASE CANCELLED';
            }else{
              $medical_status = $row['medical_status'];
            }
          

          $response .= "<tr>";
          $response .= "<td><b>Examination Date : </b></td><td>".$regDate."</td>";
          $response .= "</tr>";

          $response .= "<tr>";
          $response .= "<td>Serial No :</td><td>".$serial_no."</td>";
          $response .= "</tr>";

          $response .= "<tr>";
          $response .= "<td>Medical Status : </td><td>".$medical_status."</td>";
          $response .= "</tr>";



      }
      $response .= "</table>";

      echo $response;

    }else{

      echo $response = "No Record Found";

    }

    }

    if($_POST['form_name'] == 'Candidate Medical History Check')
    {

      $passport_number = $_POST['passport_number'];
     
      $get_cand_result = $data->query("SELECT t.reg_date,t.serial_no,t.remarks as reg_remarks,m.remarks as med_remarks,s.xray_notes from tb_registration t LEFT JOIN tb_medical m on t.reg_id=m.reg_id LEFT JOIN tb_xray_result s on t.reg_id=s.reg_id WHERE t.passport_no='$passport_number'");

      $count_cand_result = mysqli_num_rows($get_cand_result);

      if($count_cand_result > 0){

      $response = "<h4>Candidate Medical History</h4><table border='1' width='100%'>";
      while($row = mysqli_fetch_array($get_cand_result) ){
            
            $regDate = $row['reg_date'];
            $serial_no = $row['serial_no'];
            $reg_remarks = $row['reg_remarks'];
            $med_remarks = $row['med_remarks'];
            $xray_notes = $row['xray_notes'];
            $medical_status = 'Fit';
          

          $response .= "<tr>";
          $response .= "<td><b>Examination Date : </b></td><td>".$regDate."</td>";
          $response .= "</tr>";

          $response .= "<tr>";
          $response .= "<td>Serial No : </td><td>".$serial_no."</td>";
          $response .= "</tr>";

          $response .= "<tr>";
          $response .= "<td>XRAY Remark : </td><td>".$xray_notes."</td>";
          $response .= "</tr>";

          $response .= "<tr>";
          $response .= "<td>Medical Remarks :</td><td>".$med_remarks."</td>";
          $response .= "</tr>";

          $response .= "<tr>";
          $response .= "<td>Registration Remarks : </td><td>".$reg_remarks."</td>";
          $response .= "</tr>";



      }
      $response .= "</table>";

      echo $response;

    }else{

      echo $response = "No Record Found";

    }

    }
   // FETCHING DATA FROM DB WHEN USER VERIFIES THROUGH BARCODE AND SERIAL NUMBER
    if($_POST['form_name'] == 'Get_Biometric')
    {
       $cand_code = $_POST['cand_code'];
       $get_cand_bio = $data->query("select t.biometric_fingerprint,t.reg_id from tb_registration t where t.reg_date='$today_date' and t.token_no='$cand_code' || t.passport_no='$cand_code'");

       $row = mysqli_fetch_array($get_cand_bio);
       echo $row['biometric_fingerprint'];
    }

    if($_POST['form_name'] == 'Get_Biometric_Repeat_case')
    {
       $cand_code = $_POST['cand_code'];
       $get_cand_bio = $data->query("select t.biometric_fingerprint,t.reg_id from tb_registration t where  t.passport_no='$cand_code'");

       $row = mysqli_fetch_array($get_cand_bio);
       echo $row['biometric_fingerprint'];
    }

    if($_POST['form_name'] == 'Candidate_Info')
    {
       $barcode = $_POST['barcode_num'];
       $serial = $_POST['serial_num'];
       $date_value = date('Y-m-d', strtotime($_POST['date_value']));
       $button_name = $_POST['btn'];
       $process_ID = $_POST['process_ID'];

       if($date_value) {
          $get_cand_data = $data->query("select token_no,reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,candidate_img,pregnancy_test from tb_registration where barcode_no='$barcode' || serial_no = '$serial' and reg_date = '$date_value' and country != 'case-cancelled'");
       }

        else {

          $get_cand_data = $data->query("select token_no,reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,candidate_img,pregnancy_test from tb_registration where barcode_no='$barcode' || serial_no = '$serial' and country != 'case-cancelled'");

       }

      
      $count_result = mysqli_num_rows($get_cand_data);
      if($count_result  == 0)
      {
        echo show_message(0,"No record found.");
        
            ?>
                  <script type="text/javascript">
                     var form_button = '<?php echo $button_name ?>';
                    document.getElementById(form_button).style.display = "none";  
                  </script>
            <?php

      }
      else{

      while ($row_data = mysqli_fetch_array($get_cand_data)) {
        $regid = $row_data['reg_id'];
        $passport_no = $row_data['passport_no'];
        $candidate_name = $row_data['candidate_name'];
        $son_of = $row_data['son_of'];
        $country = $row_data['country'];
        $serial_no = $row_data['serial_no'];
        $barcode = $row_data['barcode_no'];
        $cnic = $row_data['cnic'];
        $pregnancy_test = $row_data['pregnancy_test'];
        $reg_date = $row_data['reg_date'];
        $candimage = $row_data['candidate_img'];
        $token_no = $row_data['token_no'];

        if($pregnancy_test == '1'){
          alert_box("Follow the SOP for Pregnant Female");
        }          
                  
    }

    //biometric token work 13feb2020
    $get_token_queue = $data->query("select q_id from tb_queue_manager where token_no='$token_no' and process_id='$process_ID' and status='Pending' and process_date='$today_date'");
    $row_que = mysqli_fetch_array($get_token_queue);
    $q_id = $row_que['q_id'];

    $insert_token = array(
                'token_no' => mysqli_real_escape_string($data->con, $token_no),
                'process_id' => mysqli_real_escape_string($data->con, $process_ID),
                'q_id' => mysqli_real_escape_string($data->con, $q_id),
                'token_date' => mysqli_real_escape_string($data->con, $today_date)
                
            );

          $data->insert('tb_ongoing_tokens', $insert_token);
    //end

    echo"<div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label'>Examination Date</label>
                          <input class='form-control' type='text' value='$reg_date' id='examination_date' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>                     
                          <label class='form-control-label' for='exampleDatepicker'>Serial Number</label>
                          <input class='form-control' type='text' id='serial_no' value='$serial_no' readonly>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Name</label>  
                          <input class='form-control' type='text' value='$candidate_name' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Father Name</label>  
                          <input class='form-control' type='text' value='$son_of' readonly>
                      </div>
                    </div>
                    </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label' for='exampleDatepicker'>PP No</label>  
                          <input class='form-control' type='text' value='$passport_no' readonly>
                      </div>
                    </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>CNIC</label>  
                          <input class='form-control' type='text' value='$cnic' readonly>
                      </div>
                    </div>
                  </div>
                 
                  <div class='row'>
                   <div class='col-md-6'>
                          <div class='form-group'>
                              <label class='form-control-label' for='exampleDatepicker'>Country</label>
                              <input class='form-control' type='text' value='$country' readonly>                            
                        </div>
                      </div>
                      <div class='col-md-6'>
                          <div class='form-group'>
                              
                              <input class='form-control' type='hidden' value='$regid' name='reg_id' id='reg_id' readonly>

                              <input class='form-control' type='text' value='$token_no' name='cand_token' id='cand_token' readonly>

                        </div>
                      </div>
                  </div>";
                  ?>

                  <script type="text/javascript">
                   
                    document.getElementById('cand_img').src='assets/candidate_image/<?php echo $candimage ?>';
                    var reg_token_no = '<?php echo $token_no ?>';
                    document.getElementById('cand_img').src='assets/candidate_image/<?php echo $candimage ?>';
                    document.getElementById("token_number").innerHTML = reg_token_no;
                  </script>

                  <?php

        if($button_name == "samplecollection")
        {
            $sample_collected = $data->query("select * from sample_collection where reg_id='$regid'");
            $count_result2 = mysqli_num_rows($sample_collected);
            if($count_result2  > 0){
              alert_box("Blood Sample Already Collected.");
            }   
        }

          ?>
                  <script type="text/javascript">
                    var form_button = '<?php echo $button_name ?>';
                    document.getElementById(form_button).style.display = "block";  
                  </script>

                  <?php
                  
    }
  }

  if($_POST['form_name'] == 'Verify Barcode Lab Result')
  {
       $barcode = $_POST['barcode_num'];
       $process_ID = $_POST['process_ID'];

      $get_cand_data = $data->query("select `reg_id`,`sticker_value_2` from tb_lab_sticker where `sticker_value_2`='$barcode'");
      
      $count_result = mysqli_num_rows($get_cand_data);
      if($count_result  == 0)
      {
        // echo show_message(1,"No record found.");
        // echo "<script>alert('hi')</script>";
        ?>
         <script type="text/javascript">
            document.getElementById('barcodeError').style.display = "block";
            document.getElementById('lab_result_form').disabled = true;
            
          </script>

        <?php
      }
      else{

        //check already exist in lab result

         $get_lab_Result = $data->query("select `reg_id`,`barcode` from tb_lab_result where `barcode`='$barcode'");

         $count_num = mysqli_num_rows($get_lab_Result);
         if($count_num > 0){

          ?>
              <script type="text/javascript">
                document.getElementById('alreadyexistError').style.display = "block";
                document.getElementById('lab_result_form').disabled = true;
                
              </script>

          <?php
         }else{

                  while ($row_data = mysqli_fetch_array($get_cand_data)) {
                    $regid = $row_data['reg_id'];
                    $sticker_value_2 = $row_data['sticker_value_2'];
                              
                  }

                    ?>

                      <script type="text/javascript">
                        document.getElementById('barcode').value='<?php echo $sticker_value_2 ?>';
                        document.getElementById('reg_id').value='<?php echo $regid ?>';
                       
                      </script>

                    <?php



          }
                  
      }
  }  

  // if($_POST['form_name'] == 'Candidate Info Lab Result')
  // {
  //      $barcode = $_POST['barcode_num'];
  //      $serial = $_POST['serial_num'];
  //      $search_from = $_POST['search_from'];
  //      $date_value = date('Y-m-d', strtotime($_POST['date_value']));
  //      $process_ID = $_POST['process_ID'];
  //      // echo "<script>alert($search_from)</script>";

  //      if($date_value && $search_from==19) {

  //       // echo "<script>alert('hi')</script>";
              
  //         $get_cand_data = $data->query("select r.token_no,r.reg_id,r.reg_date,r.passport_no,r.candidate_name,r.son_of,
  //                   r.country,r.barcode_no,r.serial_no,r.cnic,r.candidate_img,r.pregnancy_test,s.sticker_value_2 from tb_registration r LEFT JOIN tb_lab_sticker s ON s.reg_id = r.reg_id where r.barcode_no='$barcode' || r.serial_no = '$serial' and r.reg_date = '$date_value' and r.country != 'case-cancelled' ORDER by s.sticker_id DESC LIMIT 1");

  //      } else {

  //       // echo "<script>alert('hi 2')</script>";

  //         $get_cand_data = $data->query("select token_no,reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,candidate_img,pregnancy_test from tb_registration where barcode_no='$barcode' || serial_no = '$serial' and country != 'case-cancelled'");

  //      }

      
  //     $count_result = mysqli_num_rows($get_cand_data);
  //     if($count_result  == 0)
  //     {
  //       echo show_message(0,"No record found.");

  //     }
  //     else{

  //     while ($row_data = mysqli_fetch_array($get_cand_data)) {
  //       $regid = $row_data['reg_id'];
  //       $passport_no = $row_data['passport_no'];
  //       $candidate_name = $row_data['candidate_name'];
  //       $son_of = $row_data['son_of'];
  //       $country = $row_data['country'];
  //       $serial_no = $row_data['serial_no'];
  //       $barcode = $row_data['barcode_no'];
  //       $cnic = $row_data['cnic'];
  //       $pregnancy_test = $row_data['pregnancy_test'];
  //       $reg_date = $row_data['reg_date'];
  //       $candimage = $row_data['candidate_img'];
  //       $sticker_value_2 = $row_data['sticker_value_2'];
  //       $token_no = $row_data['token_no'];

  //       if($pregnancy_test == '1'){
  //         alert_box("Follow the SOP for Pregnant Female");
  //       }          
                  
  //     }

  //     echo"<div class='row'>
  //                 <div class='col-md-6'>
  //                     <div class='form-group'>
  //                       <img src='assets/candidate_image/$candimage' id='cand_img' alt='...' class='img-thumbnail'>
  //                     </div>
  //                   </div>
  //                   </div>
  //                   <div class='row'>
  //                   <div class='col-md-6'>
  //                     <div class='form-group'>                        
  //                         <label class='form-control-label'>Examination Date</label>
  //                         <input class='form-control' type='text' value='$reg_date' id='examination_date' readonly>
  //                     </div>
  //                   </div>
  //                   <div class='col-md-6'>
  //                     <div class='form-group'>                     
  //                         <label class='form-control-label' for='exampleDatepicker'>Serial Number</label>
  //                         <input class='form-control' type='text' id='serial_no' value='$serial_no' readonly>
  //                     </div>
  //                   </div>
  //                 </div>
  //                 <div class='row'>
  //                   <div class='col-md-6'>
  //                     <div class='form-group'>
  //                         <label class='form-control-label'>Name</label>  
  //                         <input class='form-control' type='text' value='$candidate_name' readonly>
  //                     </div>
  //                   </div>
  //                   <div class='col-md-6'>
  //                     <div class='form-group'>
  //                         <label class='form-control-label'>Father Name</label>  
  //                         <input class='form-control' type='text' value='$son_of' readonly>
  //                     </div>
  //                   </div>
  //                   </div>
  //                 <div class='row'>
  //                   <div class='col-md-6'>
  //                     <div class='form-group'>
  //                         <label class='form-control-label' for='exampleDatepicker'>PP No</label>  
  //                         <input class='form-control' type='text' value='$passport_no' readonly>
  //                     </div>
  //                   </div>
  //                    <div class='col-md-6'>
  //                     <div class='form-group'>
  //                         <label class='form-control-label'>CNIC</label>  
  //                         <input class='form-control' type='text' value='$cnic' readonly>
  //                     </div>
  //                   </div>
  //                 </div>
                 
  //                 <div class='row'>
  //                  <div class='col-md-6'>
  //                         <div class='form-group'>
  //                             <label class='form-control-label' for='exampleDatepicker'>Country</label>
  //                             <input class='form-control' type='text' value='$country' readonly>                            
  //                       </div>
  //                     </div>
  //                     <div class='col-md-6'>
  //                         <div class='form-group'>
                              
  //                             <input class='form-control' type='hidden' value='$regid' name='reg_id' id='reg_id' readonly>
  //                       </div>
  //                     </div>
  //                 </div>";
                   /*?>

                   <script type="text/javascript">
                    document.getElementById('barcode').value='<?php echo $sticker_value_2 ?>';
                   </script>

                   <?php */ 
                  
  //     }
  // }


  if($_POST['form_name'] == 'Candidate Info Lab Result')
  {
       $barcode = $_POST['barcode_num'];
       $serial = $_POST['serial_num'];
       $search_from = $_POST['search_from'];
       $date_value = date('Y-m-d', strtotime($_POST['date_value']));
       // $button_name = $_POST['btn'];
       $process_ID = $_POST['process_ID'];
       // echo "<script>alert($search_from)</script>";

       if($date_value && $search_from==19) {

        // echo "<script>alert('hi')</script>";
              
          $get_cand_data = $data->query("select r.token_no,r.reg_id,r.reg_date,r.passport_no,r.candidate_name,r.son_of,r.country,r.serial_no,r.cnic,r.candidate_img,r.pregnancy_test,s.sticker_value_2, l.barcode
          from tb_registration r
          LEFT JOIN tb_lab_sticker s ON s.reg_id = r.reg_id
          LEFT JOIN tb_lab_result l ON (r.reg_id = l.reg_id || l.barcode = s.sticker_value_2)
          where r.serial_no='$serial' and r.reg_date='$date_value' and r.country != 'case-cancelled'");

       } else {

        // echo "<script>alert('hi 2')</script>";

          // $get_cand_data = $data->query("select token_no,reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,candidate_img,pregnancy_test from tb_registration where barcode_no='$barcode' || serial_no = '$serial' and country != 'case-cancelled'");

       }

      
      $count_result = mysqli_num_rows($get_cand_data);
      if($count_result  == 0)
      {
        echo show_message(0,"No record found.");

      }
      else{

      while ($row_data = mysqli_fetch_array($get_cand_data)) {
        $regid = $row_data['reg_id'];
        $passport_no = $row_data['passport_no'];
        $candidate_name = $row_data['candidate_name'];
        $son_of = $row_data['son_of'];
        $country = $row_data['country'];
        $serial_no = $row_data['serial_no'];
        // $barcode = $row_data['barcode_no'];
        $cnic = $row_data['cnic'];
        $pregnancy_test = $row_data['pregnancy_test'];
        $reg_date = $row_data['reg_date'];
        $candimage = $row_data['candidate_img'];
        $sticker_value_2 = $row_data['sticker_value_2'];
        $token_no = $row_data['token_no'];
        $l_barcode = $row_data['barcode'];

        if($pregnancy_test == '1'){
          alert_box("Follow the SOP for Pregnant Female");
        }          
                  
      }

      echo"<div class='row'>
                  <div class='col-md-6'>
                      <div class='form-group'>
                        <img src='assets/candidate_image/$candimage' id='cand_img' alt='...' class='img-thumbnail'>
                      </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label'>Examination Date</label>
                          <input class='form-control' type='text' value='$reg_date' id='examination_date' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>                     
                          <label class='form-control-label' for='exampleDatepicker'>Serial Number</label>
                          <input class='form-control' type='text' id='serial_no' value='$serial_no' readonly>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Name</label>  
                          <input class='form-control' type='text' value='$candidate_name' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Father Name</label>  
                          <input class='form-control' type='text' value='$son_of' readonly>
                      </div>
                    </div>
                    </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label' for='exampleDatepicker'>PP No</label>  
                          <input class='form-control' type='text' value='$passport_no' readonly>
                      </div>
                    </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>CNIC</label>  
                          <input class='form-control' type='text' value='$cnic' readonly>
                      </div>
                    </div>
                  </div>
                 
                  <div class='row'>
                   <div class='col-md-6'>
                          <div class='form-group'>
                              <label class='form-control-label' for='exampleDatepicker'>Country</label>
                              <input class='form-control' type='text' value='$country' readonly>                            
                        </div>
                      </div>
                      <div class='col-md-6'>
                          <div class='form-group'>
                              
                            <input class='form-control' type='hidden' name='reg_id' value='$regid' readonly>                            
                        </div>
                      </div>
                  </div>";

                  if($l_barcode != null){

                    if($sticker_value_2 == $l_barcode){
                      ?>

                    <script type="text/javascript">
                      document.getElementById('alreadyexistError').style.display = "block";
                    </script>

                      <?php
                    }
                  }

                  
                  ?>  
                    
                  <script type="text/javascript">
                    document.getElementById('barcode').value='<?php echo $sticker_value_2 ?>';
                    document.getElementById('reg_id').value='<?php echo $regid ?>';

                  </script>

                  <?php  
                  
      }
  }


  //get candidate info with token no only
  if($_POST['form_name'] == 'Candidate_Info_Biometric'){

    $button_name = $_POST['btn'];
    $cand_code = $_POST['candidatecode'];

    $get_reg_user = $data->query("select reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,candidate_img,pregnancy_test,token_no from tb_registration where token_no='$cand_code' || passport_no='$cand_code' and country != 'case-cancelled'");
    while ($row_data = mysqli_fetch_array($get_reg_user)) {
        $regid = $row_data['reg_id'];
        $passport_no = $row_data['passport_no'];
        $candidate_name = $row_data['candidate_name'];
        $son_of = $row_data['son_of'];
        $country = $row_data['country'];
        $serial_no = $row_data['serial_no'];
        $barcode = $row_data['barcode_no'];
        $cnic = $row_data['cnic'];
        $pregnancy_test = $row_data['pregnancy_test'];
        $reg_date = $row_data['reg_date'];
        $candimage = $row_data['candidate_img'];
        $cand_token = $row_data['token_no'];

        if($pregnancy_test == '1'){
          alert_box("Follow the SOP for Pregnant Female");
        }          
                  
    }
        echo"<div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label'>Examination Date</label>
                          <input class='form-control' type='text' value='$reg_date' id='examination_date' readonly>
                          <input class='form-control' type='hidden' value='$regid' id='reg_id'>
                          <input class='form-control' type='hidden' value='$cand_token' id='cand_token'>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>                     
                          <label class='form-control-label' for='exampleDatepicker'>Serial Number</label>
                          <input class='form-control' type='text' id='serial_no' value='$serial_no' readonly>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Name</label>  
                          <input class='form-control' type='text' value='$candidate_name' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Father Name</label>  
                          <input class='form-control' type='text' value='$son_of' readonly>
                      </div>
                    </div>
                    </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label' for='exampleDatepicker'>PP No</label>  
                          <input class='form-control' type='text' value='$passport_no' readonly>
                      </div>
                    </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>CNIC</label>  
                          <input class='form-control' type='text' value='$cnic' readonly>
                      </div>
                    </div>
                  </div>
                 
                  <div class='row'>
                   <div class='col-md-6'>
                          <div class='form-group'>
                              <label class='form-control-label' for='exampleDatepicker'>Country</label>
                              <input class='form-control' type='text' value='$country' readonly>                            
                        </div>
                      </div>
                      <div class='col-md-6'>
                          <div class='form-group'>
                              
                              <input class='form-control' type='hidden' value='$regid' name='reg_id' id='reg_id' readonly>
                        </div>
                      </div>
                  </div>";
                  ?>

                  <script type="text/javascript">
                   
                    document.getElementById('cand_img').src='assets/candidate_image/<?php echo $candimage ?>';
                  </script>

                  <?php

                  if($button_name == "samplecollection")
                  {
                      $sample_collected = $data->query("select * from sample_collection where reg_id='$regid'");
                      $count_result2 = mysqli_num_rows($sample_collected);
                      if($count_result2  > 0){
                        alert_box("Blood Sample Already Collected.");
                      }   
                  }

                    ?>
                  <script type="text/javascript">
                    var form_button = '<?php echo $button_name ?>';
                    document.getElementById(form_button).style.display = "block";  
                  </script>

                  <?php

  }

    if($_POST['form_name'] == 'Candidate_Info_RepeatCase'){

    $bar =barcode_generation();
    $button_name = $_POST['btn'];
    $cand_code = $_POST['candidatecode'];
    $get_reg_user = $data->query("select * from tb_registration where passport_no='$cand_code'");
    while ($row_data = mysqli_fetch_array($get_reg_user)) {
        $regid = $row_data['reg_id'];
        $passport_no = $row_data['passport_no'];
        $candidate_name = $row_data['candidate_name'];
        $son_of = $row_data['son_of'];
        $serial_no = $row_data['serial_no'];
        $country = $row_data['country'];
        $gender = $row_data['gender'];
        $phone_1 = $row_data['phone_1'];
        $phone_2 = $row_data['phone_2'];
        // $barcode_no = $row_data['barcode_no'];
        $profession = $row_data['profession'];
        $nationality = $row_data['nationality'];
        $relation_type = $row_data['relation_type'];
        $d_o_b = $row_data['d_o_b'];
        $passport_issue_date = $row_data['passport_issue_date'];
        $passport_expiry_date = $row_data['passport_expiry_date'];
        $place_of_issue = $row_data['place_of_issue'];
        $remarks = $row_data['remarks'];
        $marital_status = $row_data['marital_status'];
        $cnic = $row_data['cnic'];
        $agency = $row_data['agency'];
        $pregnancy_test = $row_data['pregnancy_test'];
        $reg_date = $row_data['reg_date'];
        $candimage = $row_data['candidate_img'];
        $enc_code = base64_encode($bar);
                  
    }

    echo "<div class='row' style='padding-left:20px; padding-right:20px;'>
        <div class='col-sm-6 col-md-6 col-lg-6' >
          <div class='card-wrapper'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='mb-0'>PASSPORT INFO</h3>
              </div>
        
              <div class='card-body'>
                <form>
                  <div class='row'>
                     <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label' for='exampleDatepicker'>Barcode</label>
                           <input type='hidden' name='img_name' id='img_name' value='$candimage'>
                          <input class='form-control' type='text' name='barcode' id='barcode' value='$bar' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label' for='exampleDatepicker'>Passport No </label>
                        <input class='form-control' type='text' id='passport' value='$passport_no'>
                      </div>
                    </div>
                  </div>
                  <div id='check_result'></div>
                  <div class='row align-items-center'>
                    <div class='col input-daterange datepicker'>
                      <div class='form-group '>
                        <label class='form-control-label'>Issue Date</label>
                        <input class='form-control' type='text' id='ppissuedate' value='$passport_issue_date'>                      
                      </div>
                    </div>
                    <div class='col input-daterange datepicker'>
                      <div class='form-group'>
                        <label class='form-control-label'>Expiry Date</label>
                        <input class='form-control' type='text' id='ppexpirydate' value='$passport_expiry_date'>                       
                      </div>
                    </div>
                    <div class='col'>
                      <div class='form-group'>
                        <label class='form-control-label'>Place of Issue</label>
                        <input class='form-control' type='text' id='placeofissue' value='$place_of_issue' readonly>                       
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class='card-wrapper'>
            <div class='card'>
             
              <div class='card-header'>
                <h3 class='mb-0'>GENERAL INFO</h3>
              </div>
              <div class='card-body'>
               <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label' for='exampleDatepicker'>Previous Serial No:</label>
                          <input class='form-control' type='text' value='$serial_no' readonly>
                          <span class='calendar-grid-58'></span>
                      
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>                     
                          <label class='form-control-label' for='exampleDatepicker'>Candidate Country</label>
                          <input class='form-control' value='$country' type='text' readonly>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label' for='exampleDatepicker'>Date</label>
                          <input class='form-control' type='text' id='regdate' value='$today_date_for_datepicker'>
                          <span class='calendar-grid-58'></span>
                      
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>                     
                          <label class='form-control-label' for='exampleDatepicker'>Serial Number</label>
                          <input class='form-control' placeholder='Serial Number' type='text' id='serialnum'>
                      </div>
                    </div>
                  </div>
                  <div class='row'>  
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label' for='exampleDatepicker'>Agency</label>
                          <input class='form-control' type='text' id='agency' value='$agency'>
                      </div>
                    </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                         <label class='form-control-label' for='exampleDatepicker'>Profession</label>
                        <input class='form-control' type='text' id='profession' value='$profession'>   
                        </div>
                      </div>
                  </div>
                  
                  <div class='row'>
                      
                       <div class='col-md-3'>
                      <div class='form-group'>
                            <label class='form-control-label' for='exampleDatepicker'>Fees Charged</label>
                            <input class='form-control' placeholder='Fees' id='fees' type='text'>
                      </div>
                    </div>
                    <div class='col-md-3'>
                      <div class='form-group'>
                            <label class='form-control-label' for='exampleDatepicker'>Discount</label>
                            <input class='form-control' placeholder='Discount' id='disc' type='text'>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                     
                  </div>
                
              </div>
              </div>
              </div>
              </div>
              </div>
            
                  <div class='col-sm-6 col-md-6 col-lg-6'>
          <div class='card-wrapper'>
            <div class='card'>
             
              <div class='card-header'>
                <h3 class='mb-0'>CANDIDATE INFO</h3>
              </div>
           <div class='card-body'>
                <form>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label' for='exampleDatepicker'>Name </label>
                        <input class='form-control' placeholder='Enter Name' type='text' id='candname' value='$candidate_name'>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label' for='exampleDatepicker'>CNIC </label>
                        <input class='form-control' placeholder='Enter CNIC Number' id='cnic' type='text' value='$cnic'>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label' for='exampleDatepicker'>Father Name</label>
                        <input type='hidden' name='d_o' id='d_o' value='$relation_type'>
                        <input class='form-control' placeholder='Enter Name' id='sonof' type='text' value='$son_of'>
                      </div>
                    </div>
                      <div class='col-md-6'>
                       <div class='form-group'>
                           <label class='form-control-label' for='exampleDatepicker'>Nationality </label>
                            <input class='form-control' id='nationality' type='text' value='$nationality'>
                              
                        </div>
                      </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label'>D.O.B</label>                        
                        <input class='form-control' type='text' id='dob' value='$d_o_b'>
                      </div>
                    </div>
                    <div class='col-md-6'>
                              <div class='form-group'>
                                <label class='form-control-label' for='exampleDatepicker'>Phone Number 1</label>
                                <input class='form-control' value='$phone_1' id='phone' type='text'>
                              </div>
                             
                           </div>

                           <div class='col-md-6'>
                              <div class='form-group'>
                                <label class='form-control-label' for='exampleDatepicker'>Phone Number 2</label>
                                <input class='form-control' value='$phone_2' id='phone1' type='text'>
                              </div>
                             
                           </div>
                       <div class='col-md-6'>
                              <div class='form-group'>
                                <label class='form-control-label'>Gender</label>
        <input class='form-control' value='$gender' id='gender' type='text' readonly>
                                  
                              </div>
                             
                           </div>
                          <div class='col-md-6'>
                            <div class='form-group'>
                                <label class='form-control-label' for='exampleDatepicker'>Remarks </label>
                                <textarea class='form-control' rows = '5' cols = '80' id='remarks'>
          $remarks
                                </textarea>
                            </div>
                          </div>
                          <div class='col-md-6'>
                              <div class='form-group'>
                                <label class='form-control-label'>Maritial Status</label>
                                  <input class='form-control' value='$marital_status' id='mart_status' type='text'>
                              </div>
                              <div class='form-group'>

                                <div class='custom-control custom-checkbox mb-3' id='preg'>
                                  <input class='custom-control-input' id='pregnancy' value='$pregnancy_test' type='checkbox'>
                                  <label class='custom-control-label' for='pregnancy'>Pregnancy Test</label>
                                </div>
                               
                              </div>
                             
                           </div>
                         </div>
                         <div class='col-md-12'>
                          <div class='form-group'>
                            <h3 class='mb-0'>Kindly Fill Up All Field Before Registration</h3><br>
                             <button type='button' id='registration' onclick='cand_registration()' class='btn btn-primary'>Register</button>
                            <a href='reports/registration_slip?barcode=$bar' target='_blank'>
                            <button type='button' id='printslip' class='btn btn-default'>Print</button></a>
                          </div>
                            <p id='reg_result'></p>
                            <div class='alert alert-danger alert-dismissible fade show col-md-offset-2' id='errorclass' role='alert'>   
                            <span class='alert-text'><strong>Warning!</strong> Please fill out complete form!</span>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>
                           <div class='alert alert-danger alert-dismissible fade show col-md-offset-2' id='biometricError' role='alert'>   
                            <span class='alert-text'><strong>Warning!</strong> Please Scan Finger!</span>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>
                          <div class='alert alert-danger alert-dismissible fade show col-md-offset-2' id='tokenError' role='alert'>   
                            <span class='alert-text'><strong>Warning!</strong> Missing Ticket Number!</span>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>

                        </div>

                  </div>

                </form>
                 
              </div>
            </div>
</div>
</div>";

      
                  ?>

                  <script type="text/javascript">
                   
                    document.getElementById('cand_img').src='assets/candidate_image/<?php echo $candimage ?>';
                  </script>

              
                  <script type="text/javascript">
                    var form_button = '<?php echo $button_name ?>';
                    document.getElementById(form_button).style.display = "block";  
                  </script>

                  <?php

  }

    //get candidate info with biometric only
    if($_POST['form_name'] == 'Candidate_Info_Biometric 2'){

    $button_name = $_POST['btn'];
    $process_ID = $_POST['process_ID'];
    $template = $_POST['template'];
    $row_biometrics = $_POST['row_biometrics'];
    $reg_ID = biometric_matching($row_biometrics,$template,$process_ID);

    $get_reg_user = $data->query("select token_no,reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,candidate_img,pregnancy_test from tb_registration where reg_id='$reg_ID' and country != 'case-cancelled'");
    while ($row_data = mysqli_fetch_array($get_reg_user)) {
        $regid = $row_data['reg_id'];
        $passport_no = $row_data['passport_no'];
        $candidate_name = $row_data['candidate_name'];
        $son_of = $row_data['son_of'];
        $country = $row_data['country'];
        $serial_no = $row_data['serial_no'];
        $barcode = $row_data['barcode_no'];
        $cnic = $row_data['cnic'];
        $pregnancy_test = $row_data['pregnancy_test'];
        $reg_date = $row_data['reg_date'];
        $candimage = $row_data['candidate_img'];
        $token_no = $row_data['token_no'];

        if($pregnancy_test == '1'){
          alert_box("Follow the SOP for Pregnant Female");
        }                       
    }
    //biometric token work 13feb2020
    $get_token_queue = $data->query("select q_id from tb_queue_manager where token_no='$token_no' and process_id='$process_ID' and status='Pending' and process_date='$today_date'");
    $row_que = mysqli_fetch_array($get_token_queue);
    $q_id = $row_que['q_id'];

    $insert_token = array(
                'token_no' => mysqli_real_escape_string($data->con, $token_no),
                'process_id' => mysqli_real_escape_string($data->con, $process_ID),
                'q_id' => mysqli_real_escape_string($data->con, $q_id),
                'token_date' => mysqli_real_escape_string($data->con, $today_date)
                
            );

          $data->insert('tb_ongoing_tokens', $insert_token);
    //end
        echo"<div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label'>Examination Date</label>
                          <input class='form-control' type='text' value='$reg_date' id='examination_date' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>                     
                          <label class='form-control-label' for='exampleDatepicker'>Serial Number</label>
                          <input class='form-control' type='text' id='serial_no' value='$serial_no' readonly>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Name</label>  
                          <input class='form-control' type='text' value='$candidate_name' readonly>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Father Name</label>  
                          <input class='form-control' type='text' value='$son_of' readonly>
                      </div>
                    </div>
                    </div>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label' for='exampleDatepicker'>PP No</label>  
                          <input class='form-control' type='text' value='$passport_no' readonly>
                      </div>
                    </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>CNIC</label>  
                          <input class='form-control' type='text' value='$cnic' readonly>
                      </div>
                    </div>
                  </div>
                 
                  <div class='row'>
                   <div class='col-md-6'>
                          <div class='form-group'>
                              <label class='form-control-label' for='exampleDatepicker'>Country</label>
                              <input class='form-control' type='text' value='$country' readonly>                            
                        </div>
                      </div>
                      <div class='col-md-6'>
                          <div class='form-group'>
                              
                              <input class='form-control' type='hidden' value='$regid' name='reg_id' id='reg_id' readonly>
                        </div>
                      </div>
                  </div>";
                  ?>

                  <script type="text/javascript">
                    var reg_token_no = '<?php echo $token_no ?>';
                    document.getElementById('cand_img').src='assets/candidate_image/<?php echo $candimage ?>';
                    document.getElementById("token_number").innerHTML = reg_token_no;
                  </script>

                  <?php

                  if($button_name == "samplecollection")
                  {
                      $sample_collected = $data->query("select * from sample_collection where reg_id='$regid'");
                      $count_result2 = mysqli_num_rows($sample_collected);
                      if($count_result2  > 0){
                        alert_box("Blood Sample Already Collected.");
                      }   
                  }

                    ?>
                  <script type="text/javascript">
                    var form_button = '<?php echo $button_name ?>';
                    document.getElementById(form_button).style.display = "block";  
                  </script>

                  <?php

  }

  if($_POST['form_name'] == 'Registration')
  {
    $form_values = $_POST['form_values'];
    $ppissuedate = date('Y-m-d', strtotime($form_values['1']));
    $ppexpirydate = date('Y-m-d', strtotime($form_values['2']));
    $slip_expiry = date('Y-m-d',strtotime($form_values['26']));
    $slip_issue_date = date('Y-m-d',strtotime($form_values['28']));
    $dob = date('Y-m-d', strtotime($form_values['16']));
    $token_num = $form_values['22'];

    $registrationdate = date('Y-m-d', strtotime($form_values['11']));
    $reg_insert = array(
                'passport_no' => mysqli_real_escape_string($data->con, $form_values['13']),
                'passport_issue_date' => mysqli_real_escape_string($data->con, $ppissuedate),
                'passport_expiry_date' => mysqli_real_escape_string($data->con, $ppexpirydate),
                'place_of_issue' => mysqli_real_escape_string($data->con, $form_values['3']),
                'reg_date' => mysqli_real_escape_string($data->con, $registrationdate),
                'serial_no' => mysqli_real_escape_string($data->con, $form_values['4']),
                'agency' => mysqli_real_escape_string($data->con, $form_values['7']),
                'country' => mysqli_real_escape_string($data->con, $form_values['14']),
                'profession' => mysqli_real_escape_string($data->con, $form_values['8']),
                'candidate_name' => mysqli_real_escape_string($data->con, $form_values['10']), 
                'relation_type' => mysqli_real_escape_string($data->con, $form_values['27']), 
                'son_of' => mysqli_real_escape_string($data->con, $form_values['12']),
                'cnic' => mysqli_real_escape_string($data->con, $form_values['19']),
                'gender' => mysqli_real_escape_string($data->con, $form_values['17']),
                'phone_1' => mysqli_real_escape_string($data->con, $form_values['5']),
                'phone_2' => mysqli_real_escape_string($data->con, $form_values['6']),
                'd_o_b' => mysqli_real_escape_string($data->con, $dob),
                'nationality' => mysqli_real_escape_string($data->con, $form_values['15']),
                'marital_status' => mysqli_real_escape_string($data->con, $form_values['18']),
                'barcode_no' => mysqli_real_escape_string($data->con, $form_values['0']),
                'biometric_fingerprint' => mysqli_real_escape_string($data->con, $form_values['21']),
                'candidate_img' => mysqli_real_escape_string($data->con, $form_values['25']),
                'fee_charged' => mysqli_real_escape_string($data->con, $form_values['9']),
                'discount' => mysqli_real_escape_string($data->con, $form_values['23']),
                'remarks' => mysqli_real_escape_string($data->con, $form_values['20']),
                'pregnancy_test' => mysqli_real_escape_string($data->con, $form_values['24']),

                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'slip_expiry_date' => mysqli_real_escape_string($data->con, $slip_expiry),
                'slip_issue_date' => mysqli_real_escape_string($data->con, $slip_issue_date),
                'token_no' => mysqli_real_escape_string($data->con,$token_num),
                'center_id' => mysqli_real_escape_string($data->con,$center_id)      
                
            );
     if($data->insert('tb_registration', $reg_insert)){

      $regID = $Queries->find_max_record('reg_id','tb_registration');
      $reg_user = $regID['maxcol'];
      
      $get_all_process = $data->query('select * from medical_process order by process_seq ASC');
      while ($row_process = mysqli_fetch_array($get_all_process)) {

        $proc_id = $row_process['process_id'];

        $cand_process = array(
                'process_id' => mysqli_real_escape_string($data->con, $proc_id),
                'reg_id' => mysqli_real_escape_string($data->con, $reg_user),
                'process_status' => mysqli_real_escape_string($data->con, '0'),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
            );

        $data->insert('candidate_medical_process', $cand_process);
        
      }
      //token update to completion status
      $upd = mysqli_query($data->con,"update tb_queue_manager set status='Completed' where token_no='$token_num' and process_id='1' and process_date='$today_date'");

      $upd_can_process = $data->query("update candidate_medical_process set process_status='1',processed_by='$loginuser',created_on='$today_date_with_time' where process_id='1' and reg_id='$reg_user'");

      $del_ongoing_process=$data->query("delete from tb_ongoing_tokens where token_no='$token_num'");

      ?>
      <script type="text/javascript">
           
            document.getElementById("printslip").disabled = false;
      </script>

    <?php
        echo show_message(1,"Record Saved!");

     }
     else {

        echo show_message(0,"Some error occured. Try Again Later.");
      
     }
  }

  if($_POST['form_name'] == 'Passport Verification'){

    $form_values = $_POST['form_values'];
   // $PPdate = date('Y-m-d', strtotime($form_values['0']));
    $remarks = $form_values['0'];
    $processID = $form_values['1'];
    $regID = $form_values['2'];
    $token_num = $form_values['3'];
    
    $pp_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'verification_notes' => mysqli_real_escape_string($data->con, $remarks),
                'process_id' => mysqli_real_escape_string($data->con, $processID),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)                
            );
     if($data->insert('passport_verification', $pp_insert)){

        //token update to completion status
         $upd = mysqli_query($data->con,"update tb_queue_manager set status='Completed' where token_no='$token_num' and process_id='$processID' and process_date='$today_date'");

        $upd_can_process = $data->query("update candidate_medical_process set process_status='1',processed_by='$loginuser',created_on='$today_date_with_time' where process_id='$processID' and reg_id='$regID'");
        $del_ongoing_process=$data->query("delete from tb_ongoing_tokens where token_no='$token_num'");

          //echo show_message(1,"Record Saved!");
          alert_box('Record Saved!');
          screen_reload();
     }
    else {
          echo show_message(0,"Some error occured. Try Again Later.");
     }

  }


  if($_POST['form_name'] == 'Update Picture') {

    define('UPLOAD_DIR', '../assets/candidate_image/'); 
    $img = $_POST['imgBase64']; 
    $img = str_replace('data:image/png;base64,', '', $img); 
    $img = str_replace(' ', '+', $img); 
    $data = base64_decode($img); 
    $uniqid = uniqid();
    $file = UPLOAD_DIR . $uniqid . '.png'; 
    $file_name = $uniqid.'.png';
    $success = file_put_contents($file, $data); 
    //print $success ? $file : 'Unable to save the file.'; 
    if($success){
      echo show_message(1,"Image Saved!");
      ?>

      <script type="text/javascript">
           
            document.getElementById("img_name").value = '<?php echo $file_name; ?>';
      </script>


      <?php
    }else{
      echo show_message(0,"Error in Saving Image!");
    }

  }



   if($_POST['form_name'] == 'Sample Collection'){

    $form_values = $_POST['form_values'];
    //$SCdate = date('Y-m-d', strtotime($form_values['0']));
    $remarks = $form_values['0'];
    $processID = $form_values['1'];
    $regID = $form_values['2'];
    $token_num = $form_values['3'];
    
    $sc_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'process_id' => mysqli_real_escape_string($data->con, $processID),
                'collection_notes' => mysqli_real_escape_string($data->con, $remarks),
                //'collection_date' => mysqli_real_escape_string($data->con, $SCdate),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
                
            );
     if($data->insert('sample_collection', $sc_insert)){

        //token update to completion status
         $upd = mysqli_query($data->con,"update tb_queue_manager set status='Completed' where token_no='$token_num' and process_id='$processID' and process_date='$today_date'");

        $upd_can_process = $data->query("update candidate_medical_process set process_status='1',processed_by='$loginuser',created_on='$today_date_with_time' where process_id='$processID' and reg_id='$regID'");
        $del_ongoing_process=$data->query("delete from tb_ongoing_tokens where token_no='$token_num'");

          echo show_message(1,"Record Saved!");
     }
    else {
          echo show_message(0,"Some error occured. Try Again Later.");
     }

  }

  if($_POST['form_name'] == 'Issue Report'){
    $form_values = $_POST['form_values'];
    
    $processID = $form_values['0'];
    $regID = $form_values['1'];
    $token_num = $form_values['2'];

    $report_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'process_id' => mysqli_real_escape_string($data->con, $processID),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)         
            );

     if($data->insert('tb_report_issue', $report_insert)){

        $upd_can_process = $data->query("update candidate_medical_process set process_status='1',processed_by='$loginuser',created_on='$today_date_with_time' where process_id='$processID' and reg_id='$regID'");
        $del_ongoing_process=$data->query("delete from tb_ongoing_tokens where token_no='$token_num'");

          echo show_message(1,"Record Saved!");
     }
    else {
          echo show_message(0,"Some error occured. Try Again Later.");
     }


  }

  if($_POST['form_name'] == 'Save Picture'){

    define('UPLOAD_DIR', '../assets/candidate_image/'); 
    $img = $_POST['imgBase64']; 
    $img = str_replace('data:image/png;base64,', '', $img); 
    $img = str_replace(' ', '+', $img); 
    $data = base64_decode($img); 
    $uniqid = uniqid();
    $file = UPLOAD_DIR . $uniqid . '.png'; 
    $file_name = $uniqid.'.png';
    $success = file_put_contents($file, $data); 
    //print $success ? $file : 'Unable to save the file.'; 
    if($success){
      echo show_message(1,"Image Saved!");
      ?>

      <script type="text/javascript">
           
            document.getElementById("img_name").value = '<?php echo $file_name; ?>';
      </script>


      <?php
    }else{
      echo show_message(0,"Error in Saving Image!");
    }

  }

  if($_POST['form_name'] == 'Find Candidate for Report Issue'){

    $barcode_num = $_POST['barcode_num'];
    $button_name = $_POST['btn'];

    $get_cand_data = $data->query("select reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,candidate_img,pregnancy_test from tb_registration where barcode_no='$barcode_num'");
      $count_result = mysqli_num_rows($get_cand_data);
      if($count_result  == 0)
      {
        echo show_message(0,"No record found.");
        
            ?>
                  <script type="text/javascript">
                     var form_button = '<?php echo $button_name ?>';
                    document.getElementById(form_button).style.display = "none";  
                  </script>
            <?php

      }
      else{

      while ($row = mysqli_fetch_array($get_cand_data)) {
          $reg_id = $row['reg_id'];
          $cand_name = $row['candidate_name'];
          $registration_date = $row['reg_date'];
          $son_of = $row['son_of'];
          $serial_no = $row['serial_no'];
          $passport_no = $row['passport_no'];
          $country = $row['country'];
          $cnic_no = $row['cnic'];
          $candidate_img = $row['candidate_img'];
                
    }

    echo "<div class='card-body'>
                <div class='d-flex justify-content-center'>
                    <div class='col-md-6 align-self-center'>
                      <div class='form-group'>
                        <img src='assets/candidate_image/$candidate_img' alt='...' class='img-thumbnail'>
                      </div>
                    </div>
                  </div>
                  
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Name</label>  
                          <input class='form-control' type='text' name='cand_name' value='$cand_name' readonly>
                          <input class='form-control' type='hidden' name='reg_id' id='reg_id' value='$reg_id' readonly>
                      </div>
                    </div>
                     <div class='col-md-6'>
                      <div class='form-group'> 
                        <label class='form-control-label'>Date</label>  
                        <input class='form-control' type='text' name='date' value='$registration_date' readonly>                          
                      </div>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>Father Name</label>  
                          <input class='form-control' type='text' name='f_name' value='$son_of' readonly>
                         
                      </div>
                    </div>
                     <div class='col-md-6'>
                      <div class='form-group'> 
                        <label class='form-control-label'>Serial Number</label>  
                        <input class='form-control' type='text' name='serial' value='$serial_no' readonly>                          
                      </div>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                          <label class='form-control-label'>PP No</label>  
                          <input class='form-control' type='text' name='pp_no' value='$passport_no' readonly>
                          
                      </div>
                    </div>
                     <div class='col-md-6'>
                      <div class='form-group'> 
                        <label class='form-control-label'>Country</label>  
                        <input class='form-control' type='text' name='country' value='$country' readonly>                          
                      </div>
                    </div>
                  </div>

                  
                 
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label class='form-control-label'>CNIC</label>  
                        <input class='form-control' type='text' name='cnic_no' value='$cnic_no' readonly>
                      </div>
                    </div>
                  </div>
                  
                </form>

                
              </div>";


  }

  }

  if($_POST['form_name'] == 'Print Lab Sticker 1'){

    $form_values = $_POST['form_values'];
    $serial_no = $form_values['1'];
    $reg_date = $form_values['2'];
    $regID = $form_values['0'];
    $allowed_stickers = 4;
    // $sticker_barcode_value = $reg_date.$serial_no;
    $sticker_barcode_value = $reg_date.'.'.$regID;
    $barcode_label = date("d-m-Y",strtotime($reg_date));

      $sticker_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'serial_no' => mysqli_real_escape_string($data->con, $serial_no),
                'reg_date' => mysqli_real_escape_string($data->con, $reg_date),
                'sticker_print_by' => mysqli_real_escape_string($data->con, $loginuser),
                'sticker_value_1' => mysqli_real_escape_string($data->con, $sticker_barcode_value),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
                
            );

    for ($j=1; $j <= $allowed_stickers; $j++) {

        $query_result = $data->insert('tb_lab_sticker', $sticker_insert);
    }

    if($query_result){

      for ($p=1; $p <= $allowed_stickers ; $p++) {
        //print sticker
      }
        ?>
            <script language = 'javascript'>
            var TSCObj
            TSCObj = new ActiveXObject("TSCActiveX.TSCLIB")
            TSCObj.ActiveXopenport("TSC TTP-244 Pro") //TSC TTP-244 Pro
            // TSCObj.ActiveXformfeed()
            TSCObj.ActiveXnobackfeed()
            TSCObj.ActiveXsendcommand("SIZE 80 mm, 50 mm")
            TSCObj.ActiveXsendcommand("SPEED 4")
            TSCObj.ActiveXsendcommand("DENSITY 12")
            TSCObj.ActiveXsendcommand("DIRECTION 1")
            TSCObj.ActiveXsendcommand("SET TEAR ON")

            TSCObj.ActiveXclearbuffer()
            //TSCObj.ActiveXbarcode("100", "40", "128", "50", "1", "0", "2", "2", "123456789")
            TSCObj.ActiveXbarcode("150", "80", "128", "150", "0", "0", "2", "2", "<?php echo $sticker_barcode_value; ?>")
            TSCObj.ActiveXprinterfont("180", "240","1","0","2","2","<?php echo $barcode_label; ?>")
            TSCObj.ActiveXprintlabel("3","1")
            TSCObj.ActiveXcloseport()
          </script>

           
        <?php
        //end print sticker
            
        

        echo "<img alt='barcode' src='./barcode/barcode.php?codetype=Code39&size=40&text=".$reg_date."&print=true'>";
        echo "<br>";
        echo show_message(1,"Sticker Sent for Print");

        
    }else{

        echo show_message(0,"Some error occured. Try Again Later.");
    }

  }

  if($_POST['form_name'] == 'Print Lab Sticker 2'){

    //$form_values = $_POST['form_values'];
    $reg_date = $_POST['reg_date'];
    $barcode_sticker1 = $_POST['sticker1'];
    $UserType = $_POST['UserType'];
    //$random_code = rand(10,100); //getRandom(5); //rand(10,100);
    
    /* -random string code-*/
    $input = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    $rand_keys = array_rand($input, 2);
    $random_code = rand(10,100);

    $random_string = $input[$rand_keys[0]].$random_code; //.$input[$rand_keys[1]];
    /**/

    $check_string = $random_string.' -';

    $check_code = $data->query("SELECT serial_no,reg_date,sticker_value_2 FROM tb_lab_sticker WHERE SUBSTRING(sticker_value_2,1,4) = '$random_string' and reg_date='$reg_date'");

    $count_code1 = mysqli_num_rows($check_code);
    
    if($count_code1 > 0){
      //random code already exist

      $rand_keys = array_rand($input, 2);
      $random_code = rand(10,100);
      $random_string = $input[$rand_keys[0]].$random_code;
      
    }




    $allowed_stickers = 1;
    $sticker_barcode_value2 = $random_string.' - '.$reg_date;

    $already_print = $data->query("select sticker_value_2 from tb_lab_sticker where sticker_value_1='$barcode_sticker1' and sticker_value_2 is null");
                      $count_sticker = mysqli_num_rows($already_print);
                      if($UserType == 'admin' || $count_sticker > 0){

                        $upd_sticker = $data->query("update tb_lab_sticker set sticker_value_2 ='$sticker_barcode_value2',sticker_read_by='$loginuser' where sticker_value_1='$barcode_sticker1'");

                          if($upd_sticker ==1){

                            for ($p=1; $p <= $allowed_stickers ; $p++) {

                            ?>
                               <script language = 'javascript'>
                                var TSCObj
                                TSCObj = new ActiveXObject("TSCActiveX.TSCLIB")
                                TSCObj.ActiveXopenport("TSC TTP-244 Pro") //TSC TTP-244 Pro
                                TSCObj.ActiveXnobackfeed()
                                TSCObj.ActiveXsendcommand("SIZE 70 mm, 50 mm")
                                TSCObj.ActiveXsendcommand("SPEED 4")
                                TSCObj.ActiveXsendcommand("DENSITY 12")
                                TSCObj.ActiveXsendcommand("DIRECTION 1")
                                TSCObj.ActiveXsendcommand("SET TEAR ON")
                                TSCObj.ActiveXclearbuffer()
                                // TSCObj.ActiveXnobackfeed()
                                //TSCObj.ActiveXbarcode("100", "40", "128", "50", "1", "0", "2", "2", "123456789")
                                TSCObj.ActiveXbarcode("60", "90", "128", "120", "2", "0", "2", "2", "<?php echo $sticker_barcode_value2; ?>")
                                TSCObj.ActiveXprintlabel("1","1")
                                TSCObj.ActiveXcloseport()
                              </script>
                             <?php
                             }
                              echo "<img alt='barcode' src='./barcode/barcode.php?codetype=Code39&size=40&text=".$sticker_barcode_value2."&print=true'>";
                              echo "<br>";
                              echo show_message(1,"Sticker Sent for Print");
                              
                          }else{

                              echo show_message(0,"Some error occured. Try Again Later.");
                              }
                          
      }

elseif ($count_sticker == 0) {

  $already_print2 = $data->query("select sticker_value_2 from tb_lab_sticker where sticker_value_1='$barcode_sticker1'");
  while($rows =mysqli_fetch_array($already_print2)){

      $sticker_barcode_value23 = $rows['sticker_value_2'];
  }
  
    for ($p=1; $p <= $allowed_stickers ; $p++) {

                            ?>
                              <script language = 'javascript'>
                                var TSCObj
                                TSCObj = new ActiveXObject("TSCActiveX.TSCLIB")
                                TSCObj.ActiveXopenport("TSC TTP-244 Pro") //TSC TTP-244 Pro
                                TSCObj.ActiveXnobackfeed()
                                TSCObj.ActiveXsendcommand("SIZE 70 mm, 50 mm")
                                TSCObj.ActiveXsendcommand("SPEED 4")
                                TSCObj.ActiveXsendcommand("DENSITY 12")
                                TSCObj.ActiveXsendcommand("DIRECTION 1")
                                TSCObj.ActiveXsendcommand("SET TEAR ON")
                                TSCObj.ActiveXclearbuffer()
                                // TSCObj.ActiveXnobackfeed()
                                //TSCObj.ActiveXbarcode("100", "40", "128", "50", "1", "0", "2", "2", "123456789")
                                TSCObj.ActiveXbarcode("60", "90", "128", "120", "2", "0", "2", "2", "<?php echo $sticker_barcode_value23; ?>")
                                TSCObj.ActiveXprintlabel("1","1")
                                TSCObj.ActiveXcloseport()
                              </script>
                             <?php
                             }
                              echo "<img alt='barcode' src='./barcode/barcode.php?codetype=Code39&size=40&text=".$sticker_barcode_value23."&print=true'>";
                              echo "<br>";
                              echo show_message(1,"Sticker Sent for Print");

}

      else{
        echo show_message(0,"Contact Administrator for more print.");   
      }

  }

  if($_POST['form_name'] == 'User Rights')
  {
    
    $user = $_POST['user_id'];

    $get_modules_query = $data->query("SELECT m.module_id,m.module_desc from user_rights r,module_setup m where r.module_id=m.module_id and r.user_id='$user' order by m.module_desc ASC");

    $count_result = mysqli_num_rows($get_modules_query);
    if($count_result  == 0) {
      
      echo "<select class='form-control' name='select_module'>";
        echo "<option value=''>No record found.</option>";
      echo "</select>";

    }
    else {

        echo "<label class='form-control-label' for='item_2'>Select Module</label>";

            echo "<select class='form-control' name='select_module' id='item_3' onchange='get_user_previous_modules($user)'>";
        echo "<option value=''>Select</option>";

            while ($rows = mysqli_fetch_array($get_modules_query)) {
              $module_id = $rows['module_id'];
              $module_name = $rows['module_desc'];

               echo "<option value='$module_id'>$module_name</option>";

                 }
              echo "</select>";

        echo "</div>";
        
      }
  }
  //   if($_POST['form_name'] == 'User Actions')
  // {

  //   $user_id = $_POST['user_id'];
  //   $module_id = $_POST['module_id'];

  //       $check_user=mysqli_query($data->con,"select * from user_action_rights where user_id='$user_id' and module_id='$module_id'");

  //             $count_user=mysqli_num_rows($check_user);
  //             if($count_user == 0)
  //             {
  //                 echo "<label class='form-control-label' for='exampleFormControlSelect2'>Action Rights</label>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='edit' type='checkbox' name='edit_check' value='1' unchecked>
  //                         <label class='custom-control-label' for='edit'>Edit</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='delete' type='checkbox' name='delete_check' value='1' unchecked>
  //                         <label class='custom-control-label' for='delete'>Delete</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='print-labstickers' type='checkbox' name='print_check' value='1' unchecked>
  //                         <label class='custom-control-label' for='print-labstickers'>Print Lab Stickers</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='biometric' type='checkbox' name='biometric_check' value='1' unchecked>
  //                         <label class='custom-control-label' for='biometric'>Biometric Verification</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='barcode' type='checkbox' name='barcod_check' value='1' unchecked>
  //                         <label class='custom-control-label' for='barcode'>Barcode Verification</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='serial_no' type='checkbox' name='serial_no_check' value='1' unchecked>
  //                         <label class='custom-control-label' for='serial_no'>Serial_no Verification</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='now_serving' type='checkbox' name='now_serving_check' value='1' unchecked>
  //                         <label class='custom-control-label' for='now_serving'>Show Now Serving</label>
  //                       </div>

  //                   </div>";

  //             }
  //             else {

  //               while ($rows = mysqli_fetch_array($check_user)) {
                  
  //                 $edit_rights = $rows['edit_rights'];
  //                 $delete_rights = $rows['delete_rights'];
  //                 $barcode_verification = $rows['barcode_verification'];
  //                 $print_lab_sticker = $rows['print_lab_sticker'];
  //                 $biometric_allow = $rows['biometric_allow'];
  //                 $serial_no_rights = $rows['serial_no_rights'];
  //                 $now_serving_rights = $rows['now_serving_rights'];

  //               }

  //               echo "<label class='form-control-label' for='exampleFormControlSelect2'>Action Rights</label>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='edit' type='checkbox' name='edit_check' value='$edit_rights'"; 
  //                         if($edit_rights==1) {
  //                           echo "checked>"; 
  //                           } 
  //                         else {
  //                             echo "unchecked>";
  //                           } 
  //                 echo "<label class='custom-control-label' for='edit'>Edit</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='delete' type='checkbox' name='delete_check' value='$delete_rights'"; 
  //                         if($delete_rights==1) {
  //                           echo "checked>"; 
  //                           } 
  //                         else {
  //                             echo "unchecked>";
  //                           } 
  //                 echo "<label class='custom-control-label' for='delete'>Delete</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='print-labstickers' type='checkbox' name='print_check' value='$print_lab_sticker'"; 
  //                         if($print_lab_sticker==1) {
  //                           echo "checked>"; 
  //                           } 
  //                         else {
  //                             echo "unchecked>";
  //                           } 
  //                 echo "<label class='custom-control-label' for='print-labstickers'>Print Lab Stickers</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='biometric' type='checkbox' name='biometric_check' value='$biometric_allow'"; 
  //                         if($biometric_allow==1) {
  //                           echo "checked>"; 
  //                           } 
  //                         else {
  //                             echo "unchecked>";
  //                           } 
  //                 echo "<label class='custom-control-label' for='biometric'>Biometric Verification</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='barcode' type='checkbox' name='barcod_check' value='$barcode_verification'"; 
  //                         if($barcode_verification==1) {
  //                           echo "checked>"; 
  //                           } 
  //                         else {
  //                             echo "unchecked>";
  //                           } 
  //                 echo "<label class='custom-control-label' for='barcode'>Barcode Verification</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='serial_no' type='checkbox' name='serial_no_check' value='$serial_no_rights'"; 
  //                         if($serial_no_rights==1) {
  //                           echo "checked>"; 
  //                           } 
  //                         else {
  //                             echo "unchecked>";
  //                           } 
  //                 echo "<label class='custom-control-label' for='serial_no'>Serial_no Verification</label>
  //                       </div>
  //                       <div class='custom-control custom-checkbox mb-3'>
  //                         <input class='custom-control-input' id='now_serving' type='checkbox' name='now_serving_check' value='$now_serving_rights'"; 
  //                         if($now_serving_rights==1) {
  //                           echo "checked=checked>"; 
  //                           } 
  //                         else {
  //                             echo "unchecked>";
  //                           } 
  //                 echo "<label class='custom-control-label' for='now_serving'>Show Now Serving</label>";
              
  //           }
      
  // }

  if($_POST['form_name'] == 'User Actions')
  {

    $user_id = $_POST['user_id'];
    $module_id = $_POST['module_id'];

        $check_user=mysqli_query($data->con,"select * from user_action_rights where user_id='$user_id' and module_id='$module_id'");

              $count_user=mysqli_num_rows($check_user);
              if($count_user == 0)
              {
                  echo "<label class='form-control-label' for='exampleFormControlSelect2'>Action Rights</label>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='edit' type='checkbox' name='edit_check' value='1' unchecked>
                          <label class='custom-control-label' for='edit'>Edit</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='delete' type='checkbox' name='delete_check' value='1' unchecked>
                          <label class='custom-control-label' for='delete'>Delete</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='print-labstickers' type='checkbox' name='print_check' value='1' unchecked>
                          <label class='custom-control-label' for='print-labstickers'>Print Lab Stickers</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='biometric' type='checkbox' name='biometric_check' value='1' unchecked>
                          <label class='custom-control-label' for='biometric'>Biometric Verification</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='barcode' type='checkbox' name='barcod_check' value='1' unchecked>
                          <label class='custom-control-label' for='barcode'>Barcode Verification</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='serial_no' type='checkbox' name='serial_no_check' value='1' unchecked>
                          <label class='custom-control-label' for='serial_no'>Serial_no Verification</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='b_plus' type='checkbox' name='b_plus_check' value='1' unchecked>
                          <label class='custom-control-label' for='b_plus'>B +</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='pending' type='checkbox' name='pending_check' value='1' unchecked>
                          <label class='custom-control-label' for='pending'>Pending</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='search_with_date' type='checkbox' name='search_with_date' value='1' unchecked>
                          <label class='custom-control-label' for='search_with_date'>Search with date</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='now_serving' type='checkbox' name='now_serving_check' value='1' unchecked>
                          <label class='custom-control-label' for='now_serving'>Show Now Serving</label>
                        </div>

                    </div>";

              }
              else {

                while ($rows = mysqli_fetch_array($check_user)) {
                  
                  $edit_rights = $rows['edit_rights'];
                  $delete_rights = $rows['delete_rights'];
                  $barcode_verification = $rows['barcode_verification'];
                  $print_lab_sticker = $rows['print_lab_sticker'];
                  $biometric_allow = $rows['biometric_allow'];
                  $serial_no_rights = $rows['serial_no_rights'];
                  $now_serving_rights = $rows['now_serving_rights'];
                  $b_plus_rights = $rows['b_plus_rights'];
                  $pending_rights = $rows['pending_rights'];
                  $search_with_date = $rows['date_search_rights'];

                }

                echo "<label class='form-control-label' for='exampleFormControlSelect2'>Action Rights</label>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='edit' type='checkbox' name='edit_check' value='$edit_rights'"; 
                          if($edit_rights==1) {
                            echo "checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            } 
                  echo "<label class='custom-control-label' for='edit'>Edit</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='delete' type='checkbox' name='delete_check' value='$delete_rights'"; 
                          if($delete_rights==1) {
                            echo "checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            } 
                  echo "<label class='custom-control-label' for='delete'>Delete</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='print-labstickers' type='checkbox' name='print_check' value='$print_lab_sticker'"; 
                          if($print_lab_sticker==1) {
                            echo "checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            } 
                  echo "<label class='custom-control-label' for='print-labstickers'>Print Lab Stickers</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='biometric' type='checkbox' name='biometric_check' value='$biometric_allow'"; 
                          if($biometric_allow==1) {
                            echo "checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            } 
                  echo "<label class='custom-control-label' for='biometric'>Biometric Verification</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='barcode' type='checkbox' name='barcod_check' value='$barcode_verification'"; 
                          if($barcode_verification==1) {
                            echo "checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            } 
                  echo "<label class='custom-control-label' for='barcode'>Barcode Verification</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='serial_no' type='checkbox' name='serial_no_check' value='$serial_no_rights'"; 
                          if($serial_no_rights==1) {
                            echo "checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            } 
                  echo "<label class='custom-control-label' for='serial_no'>Serial_no Verification</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='now_serving' type='checkbox' name='now_serving_check' value='$now_serving_rights'"; 
                          if($now_serving_rights==1) {
                            echo "checked=checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            }           
                  echo "<label class='custom-control-label' for='now_serving'>Show Now Serving</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='b_plus' type='checkbox' name='b_plus_check' value='$b_plus_rights'"; 
                          if($b_plus_rights==1) {
                            echo "checked=checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            }
                  echo "<label class='custom-control-label' for='b_plus'>B + </label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='pending' type='checkbox' name='pending_check' value='$pending_rights'"; 
                          if($pending_rights==1) {
                            echo "checked=checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            }
                  echo "<label class='custom-control-label' for='pending'>Pending</label>
                        </div>
                        <div class='custom-control custom-checkbox mb-3'>
                          <input class='custom-control-input' id='search_with_date' type='checkbox' name='search_with_date' value='$search_with_date'"; 
                          if($search_with_date==1) {
                            echo "checked=checked>"; 
                            } 
                          else {
                              echo "unchecked>";
                            }
                  echo "<label class='custom-control-label' for='search_with_date'>Search with date</label>";

                   

              
            }
      
  }

  if($_POST['form_name'] == 'Update Portion'){

    $reg_id = $_POST['regID'];
    $bplus = $_POST['Bplus'];

    $upd_portion = $data->query("update tb_registration set print_report_portion ='$bplus' where reg_id='$reg_id'");
    if($upd_portion){
      echo show_message(1,"Changed Successfully!");      
    }
    // else{
    //   echo show_message(0,"Some error occured. Try Again Later.");
    // }
    
  }

  if($_POST['form_name'] == 'Update Medical Status'){

    $reg_id = $_POST['regID'];
    $medicalstatus = $_POST['medicalstatus'];

    if($medicalstatus == 'Pending') {

        $upd_portion = $data->query("update tb_registration set medical_status ='$medicalstatus' where reg_id='$reg_id'");

        if($upd_portion){

          $new_status = $data->query("select medical_status from tb_registration where reg_id ='$reg_id'");
          
          while ($rows = mysqli_fetch_array($new_status)) {
            $cand_status = $rows['medical_status'];
          }
          echo $cand_status;

        }else{
          echo show_message(0,"Some error occured. Try Again Later.");
        }
        

    } else {

        medical_status_verify($reg_id);
        $new_status = $data->query("select medical_status from tb_registration where reg_id ='$reg_id'");
        
        while ($rows = mysqli_fetch_array($new_status)) {
          $cand_status = $rows['medical_status'];
        }
        echo $cand_status;

    }

    
  }

  // old 
  if($_POST['form_name'] == 'Lab Result') 
  {

    $form_values = $_POST['form_values'];
    
    $barcode = $form_values['0'];
    $hcv = $form_values['1'];
    $hbs_ag = $form_values['2'];
    $hiv = $form_values['3'];
    $vdrl = $form_values['4'];
    $tpha = $form_values['5'];
    $rbs = $form_values['6'];
    $bil = $form_values['7'];
    $alt = $form_values['8'];
    $ast = $form_values['9'];
    $alk = $form_values['10'];
    $creatinine = $form_values['11'];
    $blood_group = $form_values['12'];
    $haemoglobin = $form_values['13'];
    $malaria = $form_values['14'];
    $micro_filariae = $form_values['15'];
    $sugar = $form_values['16'];
    $albumin = $form_values['17'];
    $helminthes = $form_values['18'];
    $ova = $form_values['19'];
    $cyst = $form_values['20'];
    $tb_test = $form_values['21'];
    $pragnancy_test = $form_values['22'];
    $polio = $form_values['23'];
    $poliodate = $form_values['24'];
    $mmr1 = $form_values['25'];
    $mmr1date = $form_values['26'];
    $mmr2 = $form_values['27'];
    $mmr2date = $form_values['28'];
    $meningococcal = $form_values['29'];
    $meningococcaldate = $form_values['30'];
    $labstatus = $form_values['31'];
    $regID = $form_values['32'];

    
    $lab_result_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'barcode' => mysqli_real_escape_string($data->con, $barcode),
                'HCV' => mysqli_real_escape_string($data->con, $hcv),
                'HBsAg' => mysqli_real_escape_string($data->con, $hbs_ag),
                'HIV' => mysqli_real_escape_string($data->con, $hiv),
                'VDRL' => mysqli_real_escape_string($data->con, $vdrl),
                'TPHA' => mysqli_real_escape_string($data->con, $tpha),
                'RBS' => mysqli_real_escape_string($data->con, $rbs),
                'BIL' => mysqli_real_escape_string($data->con, $bil),
                'ALT' => mysqli_real_escape_string($data->con, $alt),
                'AST' => mysqli_real_escape_string($data->con, $ast),
                'ALK' => mysqli_real_escape_string($data->con, $alk),
                'Creatinine' => mysqli_real_escape_string($data->con, $creatinine),
                'blood_group' => mysqli_real_escape_string($data->con, $blood_group),
                'Haemoglobin' => mysqli_real_escape_string($data->con, $haemoglobin),
                'Malaria' => mysqli_real_escape_string($data->con, $malaria),
                'Micro_filariae' => mysqli_real_escape_string($data->con, $micro_filariae),
                'sugar' => mysqli_real_escape_string($data->con, $sugar),
                'albumin' => mysqli_real_escape_string($data->con, $albumin),
                'helminthes' => mysqli_real_escape_string($data->con, $helminthes),
                'OVA' => mysqli_real_escape_string($data->con, $ova),
                'CYST' => mysqli_real_escape_string($data->con, $cyst),
                'TB' => mysqli_real_escape_string($data->con, $tb_test),
                'pregnancy' => mysqli_real_escape_string($data->con, $pragnancy_test),
                'polio' => mysqli_real_escape_string($data->con, $polio),
                'polio_date' => mysqli_real_escape_string($data->con, $poliodate),
                'MMR1' => mysqli_real_escape_string($data->con, $mmr1),
                'mmr1_date' => mysqli_real_escape_string($data->con, $mmr1date),
                'MMR2' => mysqli_real_escape_string($data->con, $mmr2),
                'mmr2_date' => mysqli_real_escape_string($data->con, $mmr2date),
                'meningococcal' => mysqli_real_escape_string($data->con, $meningococcal),
                'meningococcal_date' => mysqli_real_escape_string($data->con, $meningococcaldate),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id),
                'lab_status' => mysqli_real_escape_string($data->con, $labstatus)
                
            );
      if($data->insert('tb_lab_result', $lab_result_insert)) {
        // update tb_registration medical_status column
         update_medical_status_final($regID);
          // if ($labstatus == 'UNFIT') {
          //   $status_upd = mysqli_query($data->con,"update tb_registration set medical_status='$labstatus'
          //                                        where reg_id='$regID'");
          // } else {

          //     medical_status_verify($regID);
          //   // $status_upd = mysqli_query($data->con,"update tb_registration set medical_status='$labstatus'
          //                                        // where reg_id='$regID'");
          // }

        echo show_message(1,"Record Saved!");
      }
      else 
        echo show_message(0,"Some error occured. Try Again Later.");

  }

    if($_POST['form_name'] == 'Lab Result Update') 
  {

    $form_values = $_POST['form_values'];
    
    $barcode = $form_values['0'];
    $hcv = $form_values['1'];
    $hbs_ag = $form_values['2'];
    $hiv = $form_values['3'];
    $vdrl = $form_values['4'];
    $tpha = $form_values['5'];
    $rbs = $form_values['6'];
    $bil = $form_values['7'];
    $alt = $form_values['8'];
    $ast = $form_values['9'];
    $alk = $form_values['10'];
    $creatinine = $form_values['11'];
    $blood_group = $form_values['12'];
    $haemoglobin = $form_values['13'];
    $malaria = $form_values['14'];
    $micro_filariae = $form_values['15'];
    $sugar = $form_values['16'];
    $albumin = $form_values['17'];
    $helminthes = $form_values['18'];
    $ova = $form_values['19'];
    $cyst = $form_values['20'];
    $tb_test = $form_values['21'];
    $pragnancy_test = $form_values['22'];
    $polio = $form_values['23'];
    $poliodate = date('Y-m-d',strtotime($form_values['24']));
    $mmr1 = $form_values['25'];
    $mmr1date = date('Y-m-d',strtotime($form_values['26']));
    $mmr2 = $form_values['27'];
    $mmr2date = date('Y-m-d',strtotime($form_values['28']));
    $meningococcal = $form_values['29'];
    $meningococcaldate = date('Y-m-d',strtotime($form_values['30']));
    $labstatus = $form_values['31'];
    $regID = $form_values['32'];


    $get_cand_data = $data->query("SELECT * FROM tb_lab_result WHERE (barcode = '$barcode' OR reg_id = '$regID') and barcode != ''");

    $count_result = mysqli_num_rows($get_cand_data);
      if($count_result  == 0)
      {
        // echo show_message(0,"No record found.");
        $lab_result_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'barcode' => mysqli_real_escape_string($data->con, $barcode),
                'HCV' => mysqli_real_escape_string($data->con, $hcv),
                'HBsAg' => mysqli_real_escape_string($data->con, $hbs_ag),
                'HIV' => mysqli_real_escape_string($data->con, $hiv),
                'VDRL' => mysqli_real_escape_string($data->con, $vdrl),
                'TPHA' => mysqli_real_escape_string($data->con, $tpha),
                'RBS' => mysqli_real_escape_string($data->con, $rbs),
                'BIL' => mysqli_real_escape_string($data->con, $bil),
                'ALT' => mysqli_real_escape_string($data->con, $alt),
                'AST' => mysqli_real_escape_string($data->con, $ast),
                'ALK' => mysqli_real_escape_string($data->con, $alk),
                'Creatinine' => mysqli_real_escape_string($data->con, $creatinine),
                'blood_group' => mysqli_real_escape_string($data->con, $blood_group),
                'Haemoglobin' => mysqli_real_escape_string($data->con, $haemoglobin),
                'Malaria' => mysqli_real_escape_string($data->con, $malaria),
                'Micro_filariae' => mysqli_real_escape_string($data->con, $micro_filariae),
                'sugar' => mysqli_real_escape_string($data->con, $sugar),
                'albumin' => mysqli_real_escape_string($data->con, $albumin),
                'helminthes' => mysqli_real_escape_string($data->con, $helminthes),
                'OVA' => mysqli_real_escape_string($data->con, $ova),
                'CYST' => mysqli_real_escape_string($data->con, $cyst),
                'TB' => mysqli_real_escape_string($data->con, $tb_test),
                'pregnancy' => mysqli_real_escape_string($data->con, $pragnancy_test),
                'polio' => mysqli_real_escape_string($data->con, $polio),
                'polio_date' => mysqli_real_escape_string($data->con, $poliodate),
                'MMR1' => mysqli_real_escape_string($data->con, $mmr1),
                'mmr1_date' => mysqli_real_escape_string($data->con, $mmr1date),
                'MMR2' => mysqli_real_escape_string($data->con, $mmr2),
                'mmr2_date' => mysqli_real_escape_string($data->con, $mmr2date),
                'meningococcal' => mysqli_real_escape_string($data->con, $meningococcal),
                'meningococcal_date' => mysqli_real_escape_string($data->con, $meningococcaldate),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id),
                'lab_status' => mysqli_real_escape_string($data->con, $labstatus)
                
            );
        if($data->insert('tb_lab_result', $lab_result_insert)) {
          
            // update tb_registration medical_status column
            update_medical_status_final($regID);

          echo show_message(1,"Record Saved!");
        }
        else{
          echo show_message(0,"Some error occured. Try Again Later.");
        } 

      }
      else{
        

        $upd_record = mysqli_query($data->con,"UPDATE `tb_lab_result` SET `reg_id`='$regID', `HCV`='$hcv',`HBsAg`='$hbs_ag',`HIV`='$hiv',`VDRL`='$vdrl',`TPHA`='$tpha',`RBS`='$rbs',`BIL`='$bil',`ALT`='$alt',`AST`='$ast',`ALK`='$alk',`Creatinine`='$creatinine',`blood_group`='$blood_group',`Haemoglobin`='$haemoglobin',`Malaria`='$malaria',`Micro_filariae`='$micro_filariae',`sugar`='$sugar',`albumin`='$albumin',`helminthes`='$helminthes',`OVA`='$ova',`CYST`='$cyst',`TB`='$tb_test',`pregnancy`='$pragnancy_test',`polio`='$polio',`polio_date`='$poliodate',`MMR1`='$mmr1',`mmr1_date`='$mmr1date',`MMR2`='$mmr2',`mmr2_date`='$mmr2date',`meningococcal`='$meningococcal',`meningococcal_date`='$meningococcaldate', `lab_status` = '$labstatus' WHERE (reg_id='$regID' or barcode='$barcode')");
        if($upd_record){
          update_medical_status_final($regID);
          echo show_message(1,"Record Updated!");
        }else{
          echo show_message(0,"Some Error Occured");
        }

      }
    
  }


  if($_POST['form_name'] == 'Check Lab Sticker'){

    $barcode_sticker1 = $_POST['barcode'];
    $loginID = $_POST['loginID'];
    $UserType = $_POST['UserType'];
    ?>
    <script type="text/javascript">
      var user_type = '<?php echo $UserType ?>';
      var sticker1 = '<?php echo $barcode_sticker1 ?>';
    </script>
    <?php

    $get_barcode_1 = $data->query("select reg_date,serial_no from tb_lab_sticker where sticker_value_1='$barcode_sticker1'");
    $count_rows=mysqli_num_rows($get_barcode_1);

    if($count_rows > 0){

      $barcode_rows = mysqli_fetch_array($get_barcode_1);
      $barcode_value = $barcode_rows['reg_date'];
      $serial_no = $barcode_rows['serial_no'];

                echo"<div class='form-group'>
                        <p>&emsp; Blood Sample OK</p>
                        <p style='display:none;'>&emsp; Serial Number: $serial_no </p>
                        <div class='form-group'>
                        <input type='hidden' value='$barcode_value' id='reg_date'>
                        <input type='hidden' value='$barcode_sticker1' id='barcode_sticker1'>
                        <img alt='barcode' src='./barcode/barcode.php?codetype=Code39&size=40&text=$barcode_value&print=true'>
                      </div>";
                 echo "<div class='form-group'>";
                 if($UserType == 'admin'){

                  echo "<buton type='button' id='allow_duplicate' name='allow_duplicate' class='btn btn-primary' onclick='allow_duplicate_sticker(sticker1);'>Allow Duplicate Lab Sticker</button>";

                 }else{

                  if(print_lab_sticker_rights($loginID,20) == 1){
                  echo "<button type='button' id='printsticker2' name='printsticker2' class='btn btn-primary' onclick='print_sticker2(user_type);'>Print Lab Sticker</button>";  

                                           
                      } 
                 }
                 
                        
                 echo "</div>
                      </div>";  

      //echo "<img alt='barcode' src='./barcode/barcode.php?codetype=Code39&size=40&text=".$barcode_value."&print=true'>";

    }else{
      echo show_message(0,"No Record Found");
    }

  }

  if($_POST['form_name'] == 'Allow Duplicate Lab Sticker'){
    $sticker1 = $_POST['sticker_1'];

    $upd_record = mysqli_query($data->con,"update tb_lab_sticker set sticker_value_2 = null where sticker_value_1 = '$sticker1'");
    if($upd_record){

      echo show_message(1,"Duplicate Print Access Granted");
    }else{
      echo show_message(0,"Some Error Occured");
    }

  }

  if($_POST['form_name'] == 'XRAY'){

    $form_values = $_POST['form_values'];
    //$SCdate = date('Y-m-d', strtotime($form_values['0']));
    //$remarks = $form_values['1'];
    $processID = $form_values['2'];
    $regID = $form_values['3'];
    $token_num = $form_values['1'];
    
    $xray_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'process_id' => mysqli_real_escape_string($data->con, $processID),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
                
            );
     if($data->insert('tb_xray', $xray_insert)){

        //token update to completion status
         $upd = mysqli_query($data->con,"update tb_queue_manager set status='Completed' where token_no='$token_num' and process_id='$processID' and process_date='$today_date'");

        $upd_can_process = $data->query("update candidate_medical_process set process_status='1',processed_by='$loginuser',created_on='$today_date_with_time' where process_id='$processID' and reg_id='$regID'");
        $del_ongoing_process=$data->query("delete from tb_ongoing_tokens where token_no='$token_num'");

          // echo show_message(1,"Candidate Verified for XRAY");
          alert_box('Candidate Verified for XRAY');
          screen_reload();
     }
    else {
          echo show_message(0,"Some error occured. Try Again Later.");
     }

  }

  if($_POST['form_name'] == 'MedicalOfficer'){

    $form_values = $_POST['form_values'];
    $processID = $form_values['1'];
    $regID = $form_values['2'];
    $examinationDate = $form_values['3'];
    $token_num = $form_values['0'];
    $medical_status = 'FIT';
    // if($form_values['45']=='DEFECTIVE'){
    //   $medical_status = 'UNFIT';
    // }
    
    $medical_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $regID),
                'height' => mysqli_real_escape_string($data->con, $form_values['4']),
                'weight' => mysqli_real_escape_string($data->con, $form_values['5']),
                'bmi' => mysqli_real_escape_string($data->con, $form_values['6']),
                'pulse' => mysqli_real_escape_string($data->con, $form_values['8']),
                'rr' => mysqli_real_escape_string($data->con, $form_values['9']),
                'visual_unaided_rt_eye' => mysqli_real_escape_string($data->con, $form_values['10']),
                'visual_unaided_left_eye' => mysqli_real_escape_string($data->con, $form_values['11']),
                'visual_aided_rt_eye' => mysqli_real_escape_string($data->con, $form_values['12']),
                'visual_aided_left_eye' => mysqli_real_escape_string($data->con, $form_values['13']),
                'distant_unaided_rt_eye' => mysqli_real_escape_string($data->con, $form_values['14']),
                'distant_unaided_left_eye' => mysqli_real_escape_string($data->con, $form_values['15']),
                'distant_aided_rt_eye' => mysqli_real_escape_string($data->con, $form_values['16']),
                'distant_aided_left_eye' => mysqli_real_escape_string($data->con, $form_values['17']),
                'near_unaided_rt_eye' => mysqli_real_escape_string($data->con, $form_values['18']),
                'near_unaided_left_eye' => mysqli_real_escape_string($data->con, $form_values['19']),
                'near_aided_rt_eye' => mysqli_real_escape_string($data->con, $form_values['46']),
                'near_aided_left_eye' => mysqli_real_escape_string($data->con, $form_values['47']),
                'color_vision' => mysqli_real_escape_string($data->con, $form_values['45']),
                'hearing_rt_ear' => mysqli_real_escape_string($data->con, $form_values['20']),
                'hearing_left_ear' => mysqli_real_escape_string($data->con, $form_values['21']),
                'appearance' => mysqli_real_escape_string($data->con, $form_values['34']),
                'speech' => mysqli_real_escape_string($data->con, $form_values['35']),
                'behavior' => mysqli_real_escape_string($data->con, $form_values['36']),
                'cognition' => mysqli_real_escape_string($data->con, $form_values['37']),
                'orientation' => mysqli_real_escape_string($data->con, $form_values['38']),
                'memory' => mysqli_real_escape_string($data->con, $form_values['39']),
                'concentration' => mysqli_real_escape_string($data->con, $form_values['40']),
                'mood' => mysqli_real_escape_string($data->con, $form_values['41']),
                'thoughts' => mysqli_real_escape_string($data->con, $form_values['42']),
                'other' => mysqli_real_escape_string($data->con, $form_values['43']),
                'general_appearance' => mysqli_real_escape_string($data->con, $form_values['22']),
                'cardiovascular' => mysqli_real_escape_string($data->con, $form_values['23']),
                'respiratory' => mysqli_real_escape_string($data->con, $form_values['24']),
                'abdomen' => mysqli_real_escape_string($data->con, $form_values['26']),
                'hernia' => mysqli_real_escape_string($data->con, $form_values['27']),
                'hydrocele' => mysqli_real_escape_string($data->con, $form_values['28']),
                'extremities' => mysqli_real_escape_string($data->con, $form_values['29']),
                'back' => mysqli_real_escape_string($data->con, $form_values['30']),
                'skin' => mysqli_real_escape_string($data->con, $form_values['31']),
                'cns' => mysqli_real_escape_string($data->con, $form_values['32']),
                'deformities' => mysqli_real_escape_string($data->con, $form_values['33']),
                'remarks' => mysqli_real_escape_string($data->con, $form_values['44']),
                'process_id' => mysqli_real_escape_string($data->con, $processID),
                'bp' => mysqli_real_escape_string($data->con, $form_values['7']),
                'ent' => mysqli_real_escape_string($data->con, $form_values['25']),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id),
                'medical_status' => mysqli_real_escape_string($data->con, $medical_status)
                
            );
     if($data->insert('tb_medical', $medical_insert)){

        // update tb_registration medical_status column
        if ($medical_status == 'UNFIT') {
          $status_upd = mysqli_query($data->con,"update tb_registration set medical_status='$medical_status'
                                               where reg_id='$regID'");
        } else {

            medical_status_verify($regID);
          // $check_prev = mysqli_query($data->con,"select medical_status from tb_registration where reg_id='$regID'");
          // $row2 = mysqli_fetch_array($check_prev);
          // if($row2['medical_status'] == 'UNFIT'){

          // }else{

          // }
          
          //  $status_upd = mysqli_query($data->con,"update tb_registration set medical_status='FIT'
          //                                       where reg_id='$regID'");
        }

        //token update to completion status
         $upd = mysqli_query($data->con,"update tb_queue_manager set status='Completed' where token_no='$token_num' and process_id='$processID' and process_date='$today_date'");

        $upd_can_process = $data->query("update candidate_medical_process set process_status='1',processed_by='$loginuser',created_on='$today_date_with_time' where process_id='$processID' and reg_id='$regID'");
        $del_ongoing_process=$data->query("delete from tb_ongoing_tokens where token_no='$token_num'");

          alert_box('Record Saved!');
          screen_reload();
     }
    else {
          echo show_message(0,"Some error occured. Try Again Later.");
     }

  }

 

  if($_POST['form_name'] == 'Reset Token'){

  $data->query("delete from tb_queue_manager");
  $data->query("delete from tb_ongoing_tokens");
  $empty_token = $data->query("delete from tb_tokens");
  if($empty_token)
  {
      alert_box("Tokens are reset.");
      redirect('token_status','_self');

  }else
  {
      alert_box("Some error occured. Try Again Later.");
      redirect('token_status','_self');
  }

  }


  if($_POST['form_name'] == 'Feed Back') 
  {

    $barcode = $_POST['barcode'];

    $run_query = $data->query("select candidate_name, serial_no from tb_registration where barcode_no='$barcode'");

    $count_result = mysqli_num_rows($run_query);
    if($count_result  == 0)
      echo show_message(0,"Record not found!");
      else {
        while ($rows = mysqli_fetch_array($run_query)) {
          $cand_name = $rows['candidate_name'];
          $serial = $rows['serial_no'];
        }
        echo "<div class='col-md-8'>
                <div class='form-group'>
                  <label class='form-control-label' for='name'>Name</label>
                  <input type='text' class='form-control' id='name' value='$cand_name' readonly>
                </div>
              </div>"; 
 
      }
  }

  if($_POST['form_name'] == 'Electronic Number') 
  {
    $status=1;
    
    $pp_no = $_POST['pp_no'];
    
        $run_query = $data->query("select eno_id, passport_no, eno, eno_date from tb_eno where passport_no='$pp_no'");

        $count_result = mysqli_num_rows($run_query);
        if($count_result  == 0) {

          $run_query2 = $data->query("select serial_no,candidate_name, reg_date, passport_no, country from tb_registration where passport_no='$pp_no'");
            while ($rows = mysqli_fetch_array($run_query2)) {
              $cand_name = $rows['candidate_name'];
              $reg_date = $rows['reg_date'];
              $passport_no = $rows['passport_no'];
              $country = $rows['country'];
              $serial_no = $rows['serial_no'];
            }
            echo "<div class='row'>
                        <div class='col-md-6'>
                          <div class='form-group'>
                              <label class='form-control-label'>Name</label>  
                              <input class='form-control' type='text' name='cand_name' id='cand_name' value='$cand_name' readonly>
                          </div>
                        </div>
                         <div class='col-md-6'>
                          <div class='form-group'> 
                            <label class='form-control-label'>Date</label>  
                            <input class='form-control' type='text' name='date' id='reg_date' value='$reg_date' readonly>                          
                          </div>
                        </div>
                      </div>
                      
                      <div class='row'>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label' for='exampleDatepicker'>PP No</label>  
                            <input class='form-control' type='text' name='pp_no2' id='pp_no2' value='$passport_no' readonly>
                          </div>
                        </div>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label' for='exampleDatepicker'>Country</label>
                            <input class='form-control' type='text' name='country' id='country' value='$country' readonly>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                      <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label'>Serial No</label>  
                            <input class='form-control' type='text' name='serial_num' id='serial_num' value='$serial_no' readonly>
                          </div>
                        </div>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label'>Status</label>  
                            <input class='form-control' type='text' name='status' id='status' value='$status' readonly>
                          </div>
                        </div>
                      </div>";
                      // alert_box($status);
                      if($status==1) {
                        // check_status($status);
                      
                       echo "<div class='row'>
                              <div class='col-md-6'>
                                <div class='form-group'>
                                  <label class='form-control-label'>Eno</label>  
                                  <input class='form-control' type='text' name='eno' id='eno'>
                                </div>
                              </div>
                              <div class='col-md-6'>
                                <div class='form-group'>
                                  <label class='form-control-label'>Date</label>
                                  <input class='form-control datepicker' placeholder='Select date' type='text' id='enoDate'>
                                </div>
                              </div>
                            </div>";
                      }
                        else {
                          echo show_message(0,"Candidate is unfit!");
                        } 
        }
          // echo show_message(0,"Record not found!");
          else {
            echo show_message(1,"Candidate Already Exist!, Please Upload Screenshot only!");
            echo "<div class='col-md-12'>
                    <div class='form-group'>                        
                      <label class='form-control-label'>Screen Shot</label>
                      <div class='custom-file'>
                        <input type='file' class='custom-file-input' name='fileToUpload' id='fileToUpload'>
                        <input type='hidden' name='passport_num' id='passport_num' value='$pp_no'/>
                        <label class='custom-file-label' for='screenshot'>Select file</label>
                      </div>
                    </div>
                  </div>";
            echo "<button type='submit' id='upload' name='upload_screenshot' class='btn btn-primary'>Upload</button>";
          }
  }

  if($_POST['form_name'] == 'Save Eno') 
  {

    $pp_no2 = $_POST['pp_no2'];
    $eno = $_POST['eno'];
    $enoDate = $_POST['enoDate'];
    $enodate = date('Y-m-d', strtotime($enoDate));

    $eno_insert = array(
                'passport_no' => mysqli_real_escape_string($data->con, $pp_no2),
                'eno' => mysqli_real_escape_string($data->con, $eno),
                'eno_date' => mysqli_real_escape_string($data->con, $enodate),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
              );

    if($data->insert('tb_eno', $eno_insert))
        echo show_message(1,"Record Added!");
      else 
        echo show_message(0,"Some error occured. Try Again Later.");
      
  }

  if($_POST['form_name'] == 'ENO Screenshot') 
  {
    $pp_no = $_POST['pp_no'];
    $screenshot = $_POST['screenshot'];
    // $_FILES['screenshot']['name'];
    alert_box($screenshot);
    
    $fileTMP = $_FILES[$screenshot]['tmp_name'];
    $fileName = basename($screenshot);
    $fileType = $_FILES[$screenshot]['type'];
    $filePath = "assets/candidate_eno/".$fileName;
    alert_box($filePath);
    
    move_uploaded_file($fileTMP,$filePath);
    
    $upd_can_process = $data->query("update tb_eno set screenshot='$filePath',created_by='$loginuser',created_at='$today_date_with_time' where passport_no='$pp_no'");

  }

  if($_POST['form_name'] == 'Send Feed Back') 
  {

    $barcode = $_POST['barcode_num'];
    $feedback = $_POST['feedback'];
    $suggestion = $_POST['suggestion'];

    $send_feedback_insert = array(
                'barcode_no' => mysqli_real_escape_string($data->con, $barcode),
                'feed_back' => mysqli_real_escape_string($data->con, $feedback),
                'comments' => mysqli_real_escape_string($data->con, $suggestion),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
              );

    if($data->insert('candidate_feedback', $send_feedback_insert))
        echo show_message(1,"Thankyou for your feedback!");
      else 
        echo show_message(0,"Some error occured. Try Again Later.");
      
  }

  if($_POST['form_name'] == 'Display Token')
  {
    global $data;
    global $today_date;
    global $token_prefix;

    $token_num = isset($_POST['token_num']);

     
    $get_ongoing_token_query = $data->query("select t.token_no from tb_ongoing_tokens t, medical_process m where m.process_id=t.process_id and token_date='$today_date' order by t.tr_id DESC");

      $rows=mysqli_fetch_array($get_ongoing_token_query);
        $token_no = $rows['token_no'];

        // welcome screen token number
           echo $token_prefix.$token_no;
                // <!-- <script type="text/javascript">
                //    var form_button = 'php echo $token_no ?';
                //   document.getElementById(form_button).style.display = "none";  
                // </script> -->
    }
  
}

function getRandom($n) { 
	$characters = '0123456789abcdefghijKLMNOPQRSTUVWXYZ'; 
	$randomString = ''; 

	for ($i = 0; $i < $n; $i++) { 
		$index = rand(0, strlen($characters) - 1); 
		$randomString .= $characters[$index]; 
	} 

	return $randomString; 
} 

function get_biometric($processid)
{
  global $data;
  global $today_date;
  //$get_record=$data->query("select biometric_fingerprint from tb_registration where reg_date='$today_date'");
  // $get_record=$data->query("select t.biometric_fingerprint,t.reg_id from tb_registration t,tb_queue_manager q where t.reg_date='$today_date' and t.token_no=q.token_no and q.process_id='$processid' and q.status='Pending'");

  $get_record = $data->query("select tr.biometric_fingerprint,tr.reg_id
from tb_queue_manager m,tb_registration tr 
WHERE m.process_id='$processid' 
and m.status='Pending'
and m.process_date = '$today_date'
and m.token_no=tr.token_no
and m.token_no IN(SELECT t.token_no 
from tb_registration t,tb_queue_manager qm,medical_process mp 
WHERE t.token_no = qm.token_no
and t.country != 'case-cancelled'
and qm.process_id = mp.process_id
and mp.process_seq = (select mdp.process_seq-1 from medical_process mdp WHERE mdp.process_id='$processid')
and qm.status='Completed')");
  $rows1 = array();
  while($row = mysqli_fetch_array($get_record)){
    array_push($rows1, $row);
  }
  return $rows1;
}

function get_biometric_2($processid)
{
  global $data;
  global $today_date;
  $get_record=$data->query("select t.biometric_fingerprint,t.reg_id from tb_registration t,tb_queue_manager q where t.reg_date='$today_date' and t.token_no=q.token_no and q.process_id='$processid' and q.status='Pending'");
  $rows1 = array();
  while($row = mysqli_fetch_array($get_record)){
    array_push($rows1, $row);
  }
  return $rows1;
}


 function candidate_xray(){

  global $data;
  global $loginuser;
  global $center_id;

    if(isset($_POST['cand_xray'])){

    $xraydate = date('Y-m-d', strtotime($_POST['xraydate']));
    $xray_chest = $_POST['xrayChest'];
    $serial_no = $_POST['serial'];
    $remarks = $_POST['remarks'];
    $processID = '5';
   // alert_box($_POST['files']['name']);
    //$filename = $_FILES['files']['name'];


    $get_reg_id = $data->query("select reg_id from tb_registration where reg_date='$xraydate' and serial_no='$serial_no'");
    $reg_array = mysqli_fetch_array($get_reg_id);
    $cand_Reg_ID = $reg_array['reg_id'];
    
    $xray_insert = array(
                'reg_id' => mysqli_real_escape_string($data->con, $cand_Reg_ID),
                'xray_chest' => mysqli_real_escape_string($data->con, $xray_chest),
                'xray_notes' => mysqli_real_escape_string($data->con, $remarks),
                'xray_date' => mysqli_real_escape_string($data->con, $xraydate),
                'process_id' => mysqli_real_escape_string($data->con, $processID),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
                
            );
     if($data->insert('tb_xray_result', $xray_insert)){

          

               echo show_message(1,"Record Saved!");
          
     }
    else {
          echo show_message(0,"Some error occured. Try Again Later.");
     }
   }

  }

function get_candidate_for_print_report($serial,$exam_DAte)
{
  global $data;
  $get_cand_record = $data->query("select reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,pregnancy_test,candidate_img,print_report_portion,medical_status from tb_registration where reg_date='$exam_DAte' and serial_no='$serial' and country != 'case-cancelled'");

    $bm = mysqli_num_rows($get_cand_record);
    if($bm == 0){
      alert_box("No record Found");
    }else{

      return $get_cand_record;
    
    }
}

function get_candidate_for_print_report_passport($pp_no)
{
  global $data;

  $get_cand_record = $data->query("select reg_id,reg_date,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,pregnancy_test,candidate_img,print_report_portion,medical_status from tb_registration where passport_no='$pp_no' and country != 'case-cancelled'");

    $bm = mysqli_num_rows($get_cand_record);
    if($bm == 0){
      alert_box("No record Found");
    }else{

      return $get_cand_record;
    
    }
}

function mo_remarks($reg_id){

  global $data;
  $get_mo_remarks = $data->query("select remarks from tb_medical where reg_id='$reg_id'");
  $row_medical = mysqli_fetch_array($get_mo_remarks);
  $mo_remarks = $row_medical['remarks'];

  return $mo_remarks;

}

function xray_remarks($reg_id){

   global $data;
  $get_mo_remarks = $data->query("select xray_notes from tb_xray_result where reg_id='$reg_id'");
  $row_medical = mysqli_fetch_array($get_mo_remarks);
  $xray_remarks = $row_medical['xray_notes'];

  return $xray_remarks;

}

function registration_remarks($reg_id){

  global $data;
  $get_mo_remarks = $data->query("select t.remarks,u.user_name,t.created_at from tb_registration t,user u where t.reg_id='$reg_id' and t.created_by=u.user_id");

  return $get_mo_remarks;

}


function pp_check_notification($reg_id){
  global $data;
  $get_pp_Check = $data->query("select u.user_name,t.created_on from passport_verification t,user u where t.reg_id='$reg_id' and t.created_by=u.user_id");

  return $get_pp_Check;
}

function medical_check_notification($reg_id){
  global $data;
  $get_medical_Check = $data->query("select u.user_name,t.created_at,t.color_vision,t.medical_status from tb_medical t,user u where t.reg_id='$reg_id' and t.created_by=u.user_id");

  return $get_medical_Check;
}

function lab_check_notification($reg_id){
  global $data;
  //52
  $get_lab_Check = $data->query("select u.user_name,t.created_on,t.lab_status from tb_lab_result t,user u,tb_lab_sticker s where s.reg_id='$reg_id' and t.created_by=u.user_id and t.barcode = s.sticker_value_2 order by t.created_on desc limit 1");

 // alert_box($get_lab_Check);

  return $get_lab_Check;
}

function lab_check_sticker($reg_id){
  global $data;
  $get_lab_sticker = $data->query("SELECT t.created_on,u.user_name from tb_lab_sticker t,user u WHERE t.sticker_print_by=u.user_id and t.reg_id='$reg_id'");

  return $get_lab_sticker;
}

function xray_notification($reg_id){
  global $data;
  $get_xray = $data->query("select u.user_name,x.created_at from tb_xray x,user u WHERE x.created_by = u.user_id and x.reg_id='$reg_id'");

  return $get_xray;
}

function xray_result_notification($reg_id){
 global $data;
  $get_xray_result = $data->query("select u.user_name,x.created_on,x.xray_status from tb_xray_result x,user u WHERE x.created_by = u.user_id and x.reg_id='$reg_id'");

  return $get_xray_result;
}

function sample_coll_notification($reg_id){
  global $data;
  $get_sample_coll = $data->query("select u.user_name,x.collection_date from sample_collection x,user u WHERE x.created_by = u.user_id and x.reg_id='$reg_id'");

  return $get_sample_coll; 
}

function report_issuance_notification($reg_id){
  global $data;
  $get_report_issuance = $data->query("select u.user_name,x.created_at from tb_report_issue x,user u WHERE x.created_by = u.user_id and x.reg_id='$reg_id'");

  return $get_sample_coll; 
}

function candidate_history($passport_no){
  global $data;
  $get_cand_history = $data->query("select reg_id,passport_no,candidate_name,son_of,country,barcode_no,serial_no,cnic,reg_date from tb_registration where passport_no='$passport_no'");

  return $get_cand_history;
}

function update_medical_status($reg_id,$status){
  global $data;
  $upd_status = $data->query("update tb_registration set medical_status='$status' where reg_id='$reg_id'");

}

function history()
{
    global $data;
        $process_query = $data->query("select passport_no,passport_issue_date,candidate_name,son_of,gender,d_o_b,cnic,profession,country,nationality,marital_status,place_of_issue,fee_charged,agency,serial_no,reg_date,remarks,medical_status from tb_registration");
        while ($rows = mysqli_fetch_array($process_query)) {
          $CAND_NAME = $rows['candidate_name'];
          $SOF = $rows['son_of'];
          $GENDER = $rows['gender'];
          $DOB = $rows['d_o_b'];
          $CNIC = $rows['cnic'];
          $PROF = $rows['profession'];
          $COUNTRY = $rows['country'];
          $NATIONALITY = $rows['nationality'];
          $M_STATUS = $rows['marital_status'];
          $P_NO = $rows['passport_no'];
          $P_DATE = $rows['passport_issue_date'];
          $POI = $rows['place_of_issue'];
          $FEE_C = $rows['fee_charged'];
          $AGENCY = $rows['agency'];
          $serial_no = $rows['serial_no'];
          $REMARKS = $rows['remarks'];
          $REG_DATE = $rows['reg_date'];
          $medical_status = $rows['medical_status'];
          $regDate=date("d-m-Y",strtotime($REG_DATE));
          $d_o_b=date("d-m-Y",strtotime($DOB));
          $pp_i_date=date("d-m-Y",strtotime($P_DATE));
            echo "<tr>";
              echo "<td>$regDate</td>";
               echo "<td>$P_NO</td>";
               echo "<td>$serial_no</td>";
               echo "<td>$CAND_NAME</td>";
               echo "<td>$SOF</td>";
               echo "<td>$GENDER</td>";
               echo "<td>$d_o_b</td>";
               echo "<td>$CNIC</td>";
               echo "<td>$PROF</td>";
               echo "<td>$COUNTRY</td>";
               echo "<td>$NATIONALITY</td>";
               echo "<td>$M_STATUS</td>";
               echo "<td>$pp_i_date</td>";
               echo "<td>$POI</td>";
               echo "<td>$FEE_C</td>";
               echo "<td>$AGENCY</td>";
               echo "<td>$REMARKS</td>";
               echo "<td>$medical_status</td>";
            echo "</tr>";
        }
}

function get_current_token()
{
    global $data;
    global $today_date;
    global $token_prefix;
    


if(isset($_POST['call_token']))
{
  $curr_token= $_POST['token_number'];
  $process_id= $_POST['processid'];
  $token_no = "";

  //token update to completion status
  $upd = mysqli_query($data->con,"update tb_queue_manager set status='Completed' where token_no='$curr_token' and process_id='$process_id' and process_date='$today_date'");
  
  //old query 

  // select MIN(token_no) as token_no,q_id from tb_queue_manager where process_id='$process_id' and status='Pending' and process_date='$today_date' order by q_id ASC LIMIT 1
$get_token_query = $data->query("select token_no as token_no,q_id from tb_queue_manager where process_id='$process_id' and status='Pending' and process_date='$today_date' order by q_id ASC LIMIT 1");
  $count_rows=mysqli_num_rows($get_token_query);
  if($count_rows == 1)
  {
    while($query_result=mysqli_fetch_array($get_token_query))
          {
           
            $q_id = $query_result['q_id'];
            $token_no = $query_result['token_no'];  
          }

          $insert_token = array(
                'token_no' => mysqli_real_escape_string($data->con, $token_no),
                'process_id' => mysqli_real_escape_string($data->con, $process_id),
                'q_id' => mysqli_real_escape_string($data->con, $q_id),
                'token_date' => mysqli_real_escape_string($data->con, $today_date)
                
            );

          $data->insert('tb_ongoing_tokens', $insert_token);

  }
   return $token_no;
}

if(isset($_POST['new_call_token']))
{
  $curr_token= $_POST['token_number2'];
  $process_id= $_POST['processid'];

  $check_process_done = mysqli_query($data->con,"select * from tb_queue_manager where token_no='$curr_token' and process_id='$process_id' and process_date='$today_date' and status='Completed'");
  $count_process_done = mysqli_num_rows($check_process_done);
  if($count_process_done > 0){

    alert('Already Done');
  
  }else{

    $get_token_query = $data->query("select q_id from tb_queue_manager where token_no='$curr_token' and process_id='$process_id' and status='Pending' and process_date='$today_date'");
     while($query_result=mysqli_fetch_array($get_token_query))
          {
           
            $q_id = $query_result['q_id'];
            //$token_no = $query_result['token_no'];  
          }

          $insert_token = array(
                'token_no' => mysqli_real_escape_string($data->con, $curr_token),
                'process_id' => mysqli_real_escape_string($data->con, $process_id),
                'q_id' => mysqli_real_escape_string($data->con, $q_id),
                'token_date' => mysqli_real_escape_string($data->con, $today_date)
                
            );

          $data->insert('tb_ongoing_tokens', $insert_token);


  }

   return $curr_token;
}

}




function update_token($q_id)
{
  global $data;
  global $today_date;
    $upda = mysqli_query($data->con,"update tb_queue_manager set status='Ongoing' where q_id='$q_id'"); 
  //return $upda;
}


function new_token_call($current_token,$process_id)
{
  if(isset($_POST['call_token']))
  {
    global $data;
    global $today_date;
    $up_token = $data->query("update tb_queue_manager set status='Completed' where token_no='$current_token' and process_id='$process_id' and process_date='$today_date'");
    redirect('./registration','_self');

  }
  
}

function tokens_in_queue($processID)
{
  global $data;
  global $today_date;

  if($processID == 1){

    $get_token_query = $data->query("select count(status) as total_pending from tb_queue_manager WHERE process_id = '$processID' and process_date = '$today_date' and status='Pending'");
  }else{

    $get_token_query = $data->query("select count(*) as total_pending 
from tb_queue_manager m 
WHERE m.process_id='$processID' 
and m.status='Pending'
and m.process_date = '$today_date'
and m.token_no IN(SELECT t.token_no 
from tb_registration t,tb_queue_manager qm,medical_process mp 
WHERE t.token_no = qm.token_no
and t.country != 'case-cancelled'
and qm.process_id = mp.process_id
and mp.process_seq = (select mdp.process_seq-1 from medical_process mdp WHERE mdp.process_id='$processID')
and qm.status='Completed')");
  }
  $row_result = mysqli_num_rows($get_token_query);
  if($row_result == 0){

    $pending_token = '0';

  }else{

    $get_result = mysqli_fetch_array($get_token_query);
    $pending_token = $get_result['total_pending'];

  }
  
  return $pending_token;
}

function token_generation()
{
	global $data;
	global $today_date;
  global $token_prefix;

	if(isset($_POST['generate_token']))
	{
    $token_type="testtype";
		$check_token=mysqli_query($data->con,"select * from tb_tokens where token_date='$today_date'");
		$count_token=mysqli_num_rows($check_token);
		if($count_token == 0)
		{
			//$token_no = "6791";
      $token = rand(100,1000);

			$insert_token = array(
                'token_date' => mysqli_real_escape_string($data->con, $today_date),
                'token_no' => mysqli_real_escape_string($data->con, $token),
                'token_type' => mysqli_real_escape_string($data->con, $token_type)
            );

            if ($data->insert('tb_tokens', $insert_token)) {
                
                $process_query = $data->query("select process_id from medical_process order by process_seq ASC");
                while ($rows = mysqli_fetch_array($process_query)) {
                	
                	$process_data = array(
                		'token_no' => $token,
                		'process_id' => $rows['process_id'],
                    'process_date' => mysqli_real_escape_string($data->con, $today_date),
                		'status' => 'Pending'
                	);
                	$data->insert('tb_queue_manager',$process_data);
                }
                  $process_query2 = $data->query("select q_id from tb_queue_manager where process_id=1 order by q_id DESC LIMIT 1");
                  $column = mysqli_fetch_array($process_query2);
                    $insert_ongoing_tokens = array(
                        'token_no' => $token,
                        'process_id' => 1,
                        'q_id' => $column['q_id'],
                        'token_date' => mysqli_real_escape_string($data->con, $today_date)
                    );
                    $data->insert('tb_ongoing_tokens',$insert_ongoing_tokens);
            }
		}
		else{
			while ($row=mysqli_fetch_array($check_token)) {
				$token = $row['token_no'];
			}
				//$token_no = $token+1;
         $token_no = rand(100,1000);
				
				$check_token=mysqli_query($data->con,"select token_no from tb_tokens where token_date='$today_date' and token_no='$token_no'");
        $count_token=mysqli_num_rows($check_token);

        if($count_token == 0) {

          // echo "<script>alert(' dcsdncsdncklsdvsd vds vcdsjvsdnvs')</script>";

          $insert_token = array(
                    'token_date' => mysqli_real_escape_string($data->con, $today_date),
                    'token_no' => mysqli_real_escape_string($data->con, $token_no),
                    'token_type' => mysqli_real_escape_string($data->con, $token_type)
                );

        } else {
            $token_no = rand(100,1000);

            // echo "<script>alert('duplicate')</script>";

            $insert_token = array(
                    'token_date' => mysqli_real_escape_string($data->con, $today_date),
                    'token_no' => mysqli_real_escape_string($data->con, $token_no),
                    'token_type' => mysqli_real_escape_string($data->con, $token_type)
                );

        }

            if ($data->insert('tb_tokens', $insert_token)) {
                
                $process_query = $data->query("select process_id from medical_process order by process_seq ASC");
                while ($rows = mysqli_fetch_array($process_query)) {
                	
                	$process_data = array(
                		'token_no' => $token_no,
                		'process_id' => $rows['process_id'],
                     'process_date' => mysqli_real_escape_string($data->con, $today_date),
                		'status' => 'Pending'

                	);
                	$data->insert('tb_queue_manager',$process_data);
                }
                $process_query2 = $data->query("select q_id from tb_queue_manager where process_id=1 order by q_id DESC LIMIT 1");
                  $column = mysqli_fetch_array($process_query2);
                    $insert_ongoing_tokens = array(
                        'token_no' => $token_no,
                        'process_id' => 1,
                        'q_id' => $column['q_id'],
                        'token_date' => mysqli_real_escape_string($data->con, $today_date)
                    );
                    $data->insert('tb_ongoing_tokens',$insert_ongoing_tokens);
            }

		}

//pdf
		echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
	                <span class='alert-icon'><i class='ni ni-like-2'></i></span>
	                <span class='alert-text'><strong>Success! </strong>New Ticket $token_prefix$token_no Generated!</span>
	                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
	                  <span aria-hidden='true'>&times;</span>
	                </button>
	              </div>";
 // redirect("./reports/token_print?token=$token_prefix$token",'_blank');
 redirect("./reports/token_text_print?token=$token_prefix$token_no ",'_blank');
	}

}

function barcode_generation()
{
  global $data;
  
  $get_barcode=$data->query("select barcode from barcode_setup");
  $count_rows = mysqli_num_rows($get_barcode);
  if($count_rows == 0){

    $barcode_num = '100001';
    
    $insert_data = array(
                    'barcode' => $barcode_num
                  );
    if($data->insert('barcode_setup',$insert_data))
    {
      echo $barcode_num;
    }


  }else{

    while ($bn=mysqli_fetch_array($get_barcode)) {
        $r = $bn['barcode'];
      }

    $barcode_num = $r+1;
    $insert_data = array(
                    'barcode' => $barcode_num
                  );

    if($data->insert('barcode_setup',$insert_data))
    {
        return $barcode_num;
    }

  }

}

function country_list()
{
  global $data;

  $country = $data->query("select Name from tb_country");
  return $country;
}




// Noman Scripts

function get_registered_user_data()
{
  global $data;
  global $serial_no;
  global $barcode;
  global $reg_id;
  global $passport_no;
  global $passport_issue_date;
  global $passport_expiry_date;
  global $place_of_issue;
  global $reg_date;
  global $agency;
  global $country;
  global $profession;
  global $fee_charged;
  global $candidate_name;
  global $cand_img;
  global $cnic;
  global $son_of;
  global $nationality;
  global $d_o_b;
  global $phone_1;
  global $phone_2;
  global $gender;
  global $marital_status;
  global $remarks;

    if(isset($_POST['search_candidate']))
    {
      $serial_no = $_POST['search_serial_no'];
      
      $search_passport_no = $_POST['search_passport_no'];

      if($_POST['search_date']) {

        // echo "<script>alert('hi')</script>";
          $search_date = date('Y-m-d', strtotime($_POST['search_date']));

      $process_query = $data->query("select reg_id,barcode_no,passport_no,passport_issue_date,passport_expiry_date,place_of_issue,reg_date,agency,country,profession,fee_charged,candidate_name,candidate_img,cnic,son_of,nationality,d_o_b,phone_1,phone_2,gender,marital_status,remarks from tb_registration where serial_no='$serial_no' AND reg_date='$search_date'");

      } else {

          $process_query = $data->query("select reg_id,barcode_no,passport_no,passport_issue_date,passport_expiry_date,place_of_issue,reg_date,agency,country,profession,fee_charged,candidate_name,candidate_img,cnic,son_of,nationality,d_o_b,phone_1,phone_2,gender,marital_status,remarks from tb_registration where passport_no='$search_passport_no'");

      }
        while ($row = mysqli_fetch_array($process_query)) {
          $reg_id = $row['reg_id'];
          $barcode = $row['barcode_no'];
          $passport_no = $row['passport_no'];
          $passport_issueDate = $row['passport_issue_date'];
          $passport_issue_date=date("d-m-Y",strtotime($passport_issueDate));
          $passport_expiryDate = $row['passport_expiry_date'];
          $passport_expiry_date=date("d-m-Y",strtotime($passport_expiryDate));
          $place_of_issue = $row['place_of_issue'];
          $regDate = $row['reg_date'];
          $reg_date=date("d-m-Y",strtotime($regDate));
          $agency = $row['agency'];
          $country = $row['country'];
          $profession = $row['profession'];
          $fee_charged = $row['fee_charged'];
          $candidate_name = $row['candidate_name'];
          $cand_img = $row['candidate_img'];
          $cnic = $row['cnic'];
          $son_of = $row['son_of'];
          $nationality = $row['nationality'];
          $dob = $row['d_o_b'];
          $d_o_b=date("d-m-Y",strtotime($dob));
          $phone_1 = $row['phone_1'];
          $phone_2 = $row['phone_2'];
          $gender = $row['gender'];
          $marital_status = $row['marital_status'];
          $remarks = $row['remarks'];
        }
    }
}





function get_dateBWsearch($to, $from)
{
  global $data;
    $from_strd=date("Y-m-d",strtotime($from));
    $to_strd=date("Y-m-d",strtotime($to));
     $process_query = $data->query("select serial_no,passport_no,passport_issue_date,candidate_name,son_of,gender,d_o_b,cnic,profession,country,nationality,marital_status,place_of_issue,fee_charged,agency,reg_date,remarks,medical_status from tb_registration where (reg_date >= '$from_strd' AND reg_date <= '$to_strd')");
        while ($rows = mysqli_fetch_array($process_query)) {
          $serial_no = $rows['serial_no'];
          $CAND_NAME = $rows['candidate_name'];
          $SOF = $rows['son_of'];
          $GENDER = $rows['gender'];
          $DOB = $rows['d_o_b'];
          $CNIC = $rows['cnic'];
          $PROF = $rows['profession'];
          $COUNTRY = $rows['country'];
          $NATIONALITY = $rows['nationality'];
          $M_STATUS = $rows['marital_status'];
          $P_NO = $rows['passport_no'];
          $P_DATE = $rows['passport_issue_date'];
          $POI = $rows['place_of_issue'];
          $FEE_C = $rows['fee_charged'];
          $AGENCY = $rows['agency'];
          // $KEY_NO = $rows['key_no'];
          $REMARKS = $rows['remarks'];
          $REG_DATE = $rows['reg_date'];
          $medical_status = $rows['medical_status'];
          $regDate=date("d-m-Y",strtotime($REG_DATE));
          $d_o_b=date("d-m-Y",strtotime($DOB));
          $pp_i_date=date("d-m-Y",strtotime($P_DATE));
            echo "<tr>";
               echo "<td>$regDate</td>";
               echo "<td>$P_NO</td>";
               echo "<td>$serial_no</td>";
               echo "<td>$CAND_NAME</td>";
               echo "<td>$SOF</td>";
               echo "<td>$GENDER</td>";
               echo "<td>$d_o_b</td>";
               echo "<td>$CNIC</td>";
               echo "<td>$PROF</td>";
               echo "<td>$COUNTRY</td>";
               echo "<td>$NATIONALITY</td>";
               echo "<td>$M_STATUS</td>";
               echo "<td>$pp_i_date</td>";
               echo "<td>$POI</td>";
               echo "<td>$FEE_C</td>";
               echo "<td>$AGENCY</td>";
               // echo "<td>$KEY_NO</td>";
               echo "<td>$REMARKS</td>";
               echo "<td>$medical_status</td>";
            echo "</tr>";
    }
}


function get_history_pdf($fromdate="",$todate="")
{
  global $data;

  if($fromdate == "" && $todate == "")
  {
    
      $process_query = $data->query("select reg_date,serial_no,passport_no,candidate_name,son_of,country,agency,medical_status from tb_registration LIMIT 0,49");
      
      return $process_query;
  }
  else
  {
      
      $from_strd=date("Y-m-d",strtotime($fromdate));
      $to_strd=date("Y-m-d",strtotime($todate));

      $process_query = $data->query("select reg_date,serial_no,passport_no,candidate_name,son_of,country,agency,medical_status from tb_registration where (reg_date >= '$from_strd' AND reg_date <= '$to_strd')");
      //$rows_array = mysqli_fetch_array($process_query);
      return $process_query;
  }
}

function find_by_passport(){
  global $data;
  if(isset($_POST['btn_find'])){
    $passport_no = $_POST['pp_no'];


    $check_pp = $data->query("select passport_no from tb_registration where passport_no='$passport_no'");
    $count_pp = mysqli_num_rows($check_pp);
    if($count_pp == 0){

      echo show_message(0,"No Record Found!");

    }else{

      $check_record = $data->query("select eno_id, passport_no, eno, eno_date from tb_eno where passport_no='$passport_no'");

        $count_result = mysqli_num_rows($check_record);
        if($count_result  == 0) {

          $run_query2 = $data->query("select serial_no,candidate_name,candidate_img, reg_date, passport_no, country, medical_status from tb_registration where passport_no='$passport_no'");
            while ($rows = mysqli_fetch_array($run_query2)) {
              $cand_name = $rows['candidate_name'];
              $reg_date = $rows['reg_date'];
              $passport_no = $rows['passport_no'];
              $country = $rows['country'];
              $serial_no = $rows['serial_no'];
              $candidate_img = $rows['candidate_img'];
              $medical_status = $rows['medical_status'];
            }
            echo "
            <div class='row'>
              <div class='d-flex justify-content-center'>
                    <div class='col-md-6 align-self-center'>
                      <div class='form-group'>
                        <img src='assets/candidate_image/$candidate_img' alt='...' class='img-thumbnail'>
                      </div>
                    </div>
                  </div>
            </div>
            <div class='row'>
                        <div class='col-md-6'>
                          <div class='form-group'>
                              <label class='form-control-label'>Name</label>  
                              <input class='form-control' type='text' name='cand_name' id='cand_name' value='$cand_name' readonly>
                          </div>
                        </div>
                         <div class='col-md-6'>
                          <div class='form-group'> 
                            <label class='form-control-label'>Date</label>  
                            <input class='form-control' type='text' name='date' id='reg_date' value='$reg_date' readonly>                          
                          </div>
                        </div>
                      </div>
                      
                      <div class='row'>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label' for='exampleDatepicker'>PP No</label>  
                            <input class='form-control' type='text' name='pp_no2' id='pp_no2' value='$passport_no' readonly>
                          </div>
                        </div>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label' for='exampleDatepicker'>Country</label>
                            <input class='form-control' type='text' name='country' id='country' value='$country' readonly>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                      <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label'>Serial No</label>  
                            <input class='form-control' type='text' name='serial_num' id='serial_num' value='$serial_no' readonly>
                          </div>
                        </div>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label'>Status</label>  
                            <input class='form-control' type='text' name='status' id='status' value='$medical_status' readonly>
                          </div>
                        </div>
                      </div>";
                if($medical_status=='FIT') {
                        
                       echo "
                        <form method='post' action='' enctype='multipart/form-data'>
                            <div class='row'>
                              <div class='col-md-6'>
                                <div class='form-group'>
                                  <label class='form-control-label'>Eno</label>  
                                  <input class='form-control' type='text' name='eno' id='eno'>
                                  <input class='form-control' type='hidden' name='pp_no3' id='pp_no3' value='$passport_no'>
                                </div>
                              </div>
                              <div class='col-md-6'>
                                <div class='form-group'>
                                  <label class='form-control-label'>Date</label>
                                  <input class='form-control datepicker' placeholder='Select date' name='eno_date' type='text' id='enoDate'>
                                </div>
                              </div>
                            </div>
                             <div class='col-md-2'>
                                <div class='form-group'>
                                  <button type='submit' id='btn_sub' name='btn_sub' class='btn btn-primary'>Save</button>
                                </div>
                              </div>
                              </form>";
                      }
                      else {

                       // echo "
                       //  <form method='post' action='' enctype='multipart/form-data'>
                       //      <div class='row'>
                       //        <div class='col-md-6'>
                       //          <div class='form-group'>
                       //            <label class='form-control-label'>Eno</label>  
                       //            <input class='form-control' type='text' name='eno' id='eno'>
                       //            <input class='form-control' type='hidden' name='pp_no3' id='pp_no3' value='$passport_no'>
                       //          </div>
                       //        </div>
                       //        <div class='col-md-6'>
                       //          <div class='form-group'>
                       //            <label class='form-control-label'>Date</label>
                       //            <input class='form-control datepicker' placeholder='Select date' name='eno_date' type='text' id='enoDate'>
                       //          </div>
                       //        </div>
                       //      </div>
                       //       <div class='col-md-2'>
                       //          <div class='form-group'>
                       //            <button type='submit' id='btn_sub' name='btn_sub' class='btn btn-primary'>Save</button>
                       //          </div>
                       //        </div>
                       //        </form>";
                      }


        }else{

          $run_query2 = $data->query("select r.candidate_name,e.eno,e.eno_date from tb_eno e,tb_registration r where e.passport_no='$passport_no' and e.passport_no = r.passport_no ");
            while ($rows = mysqli_fetch_array($run_query2)) {
              $cand_name = $rows['candidate_name'];
              $eno = $rows['eno'];
              $eno_date = $rows['eno_date'];
             
            }
            echo "<form method='post' action='include/upload.php' enctype='multipart/form-data'>
                    <div class='row'>
                        <div class='col-md-6'>
                          <div class='form-group'>
                              <label class='form-control-label'>Name:</label>  
                              <input class='form-control' type='text' name='cand_name' id='cand_name' value='$cand_name' readonly>
                          </div>
                        </div>
                         <div class='col-md-6'>
                          <div class='form-group'> 
                            <label class='form-control-label'>ENO:</label>  
                            <input class='form-control' type='text' name='eno' id='eno' value='$eno' readonly>                          
                          </div>
                        </div>
                      </div>
                      
                      <div class='row'>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label' >ENO Date</label>  
                            <input class='form-control' type='text' name='enodate' id='enodate' value='$eno_date' readonly>
                          </div>
                        </div>
                  <div class='col-md-6'>
                    <div class='form-group'>                        
                      <label class='form-control-label'>Screen Shot</label>
                      <input type='file' name='fileToUpload' id='fileToUpload'>
                        
                       
                    </div>
                  </div>
                      </div>
                      <div class='col-md-2'>
                                <div class='form-group'>
                                  <input type='submit' value='Upload Image' name='btn_screenshot'>
                                </div>
                              </div>
                              </form>";

        }

    }

    

  }
}

function biometric_matching($row_biometrics,$template,$porcess_id){

  //$rows1 = get_biometric_2($porcess_id);
  $rows1 = $row_biometrics;
  $temp1_arr = str_split($template);

  $temp_total_matched = 0;
  $registered_id = 0;
    foreach ($rows1 as $key => $value) {
    $total_matched = 0;
      
      $temp2_arr = str_split($value['biometric_fingerprint']);
      $regID = $value['reg_id'];

      $keysOne = array_keys($temp1_arr);
      $keysTwo = array_keys($temp2_arr);

      $min = min(count($temp1_arr), count($temp2_arr));
      
      for($i = 0; $i < $min; $i++) {

          if($temp2_arr[$keysTwo[$i]] == $temp1_arr[$keysOne[$i]]){
            $total_matched++;
          }
      }

      if($total_matched > $temp_total_matched){

        $temp_total_matched = $total_matched;
        $registered_id =  $regID;
      }
      
    }

    return $registered_id;
}

function save_eno(){
  global $data;
  global $loginuser;
  global $center_id;

  if(isset($_POST['btn_sub'])){
     $passport_no = $_POST['pp_no3'];
     $eno_date = $_POST['eno_date'];
     $eno = $_POST['eno'];
    $enodate = date('Y-m-d', strtotime($eno_date));

    $eno_insert = array(
                'passport_no' => mysqli_real_escape_string($data->con, $passport_no),
                'eno' => mysqli_real_escape_string($data->con, $eno),
                'eno_date' => mysqli_real_escape_string($data->con, $enodate),
                'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                'center_id' => mysqli_real_escape_string($data->con, $center_id)
              );

    if($data->insert('tb_eno', $eno_insert))
        echo show_message(1,"Record Saved!");
      else 
        echo show_message(0,"Some error occured. Try Again Later.");
  }
}

//  UBN
function get_daily_report_pdf($regDate,$country_arr)
{
  global $data;
  // global $today_date;
  // $exclude_Case = implode(', ', $country_arr);

    // $process_query = $data->query("select serial_no, passport_no, candidate_name, son_of, country, agency from tb_registration where reg_date = '$today_date' and country not in('$exclude_Case')");
    $reg_date=date("Y-m-d",strtotime($regDate));
    $exclude_Case = implode("','", $country_arr);

    $process_query = $data->query("select serial_no, passport_no, candidate_name, son_of, country, agency from tb_registration where reg_date='$reg_date' and country in('$exclude_Case')");
      
    return $process_query;
}


function onGoing_token()
{
  global $data;
  global $today_date;
  global $token_prefix;
  $get_ongoing_token_query = $data->query("select token_no, process_desc from tb_ongoing_tokens t, medical_process m where m.process_id=t.process_id and token_date='$today_date'");

    while ($rows = mysqli_fetch_array($get_ongoing_token_query)) {
          $token_no = $rows['token_no'];
          $process_name = $rows['process_desc'];
            
            //echo "<tbody>";
              echo "<tr>";                
                echo "<td>$token_prefix$token_no</td>";
                echo "<td>$process_name</td>";
              echo "</tr>";
            //echo "</tbody>";
         
    }
}

function onPending_token()
{
  global $data;
  global $today_date;
  global $token_prefix;
  $get_onPending_token_query = $data->query("select token_no, process_desc, status from tb_queue_manager q, medical_process m where q.process_id=m.process_id and status='Pending' and process_date='$today_date' order by q.q_id ASC");

    while ($rows = mysqli_fetch_array($get_onPending_token_query)) {
          $token_no = $rows['token_no'];
          $process_name = $rows['process_desc'];
          $status = $rows['status'];
            
            //echo "<tbody>";
              echo "<tr>";                
                echo "<td>$token_prefix$token_no</td>";
                echo "<td>$process_name</td>";
                echo "<td>$status</td>";
              echo "</tr>";
            //echo "</tbody>";
        
    }
}

function completed_token()
{
  global $data;
  global $today_date;
  global $token_prefix;
  $get_completed_token_query = $data->query("select token_no, process_desc, status from tb_queue_manager q, medical_process m where q.process_id=m.process_id and status='Completed' and process_date='$today_date'");

    while ($rows = mysqli_fetch_array($get_completed_token_query)) {
          $token_no = $rows['token_no'];
          $process_name = $rows['process_desc'];
          $status = $rows['status'];
            
            //echo "<tbody>";
              echo "<tr>";                
                echo "<td>$token_prefix$token_no</td>";
                echo "<td>$process_name</td>";
                echo "<td>$status</td>";
              echo "</tr>";
            //echo "</tbody>";
        
    }
}

function cand_medical_process()
{
  global $data;
  $get_cand_process_query = $data->query("select r.candidate_name,r.serial_no,r.passport_no, p.process_desc, cm.process_status, u.user_name as processed_by, cm.created_on from tb_registration r, candidate_medical_process cm, medical_process p,user u where cm.process_id=p.process_id and cm.reg_id=r.reg_id and cm.processed_by=u.user_id");
    $i='1';
    while ($rows = mysqli_fetch_array($get_cand_process_query)) {
          $cand_name = $rows['candidate_name'];
          $serial_no = $rows['serial_no'];
          $passport_no = $rows['passport_no'];
          
          $process_name = $rows['process_desc'];
          $process_status = $rows['process_status'];
          $proced_by = $rows['processed_by'];
          $created_on = $rows['created_on'];
            
            //echo "<tbody>";
              echo "<tr>";
                echo "<td>$i</td>";                
                echo "<td>$cand_name</td>";
                echo "<td>$serial_no</td>";
                echo "<td>$passport_no</td>";
                echo "<td>$process_name</td>";
                if($process_status=='0')
                  echo "<td>pending</td>";    
                else if($process_status=='1')
                  echo "<td>completed</td>";
                else
                  echo "<td>in-process</td>";              
                echo "<td>$proced_by</td>";
                echo "<td>$created_on</td>";
              echo "</tr>";
            //echo "</tbody>";
          $i++;
    }
    
}

function get_medical_report_pdf($regid)
{
  global $data;

    $process_query = $data->query("select DISTINCT r.reg_id,r.country,r.candidate_name,r.son_of,r.serial_no,r.passport_no,r.d_o_b,r.place_of_issue,
    r.passport_expiry_date,r.marital_status,r.nationality,r.profession,r.gender,r.cnic,r.medical_status,r.remarks,
    r.barcode_no,r.reg_date,r.candidate_img,m.height,m.weight,m.bmi,m.bp,m.pulse,m.rr,m.visual_unaided_rt_eye,m.visual_unaided_left_eye,
    m.visual_aided_rt_eye,m.visual_aided_left_eye,m.distant_unaided_rt_eye,m.distant_unaided_left_eye,
    m.distant_aided_rt_eye,m.distant_aided_left_eye,m.near_unaided_rt_eye,m.near_unaided_left_eye,
    m.near_aided_rt_eye,m.near_aided_left_eye,m.color_vision,m.hearing_rt_ear,m.hearing_left_ear,
    m.general_appearance,m.cardiovascular,m.respiratory,m.ent,m.abdomen,m.hernia,m.hydrocele,m.extremities,
    m.back,m.skin,m.cns,m.deformities,m.appearance,m.speech,m.behavior,m.cognition,m.orientation,m.memory,
    m.concentration,m.mood,m.thoughts,m.other,x.xray_chest,l.blood_group,l.Haemoglobin,l.Malaria,l.Micro_filariae,
    l.RBS,l.BIL,l.ALT,l.AST,l.ALK,l.Creatinine,l.HIV,l.HBsAg,l.HCV,l.VDRL,l.TPHA,l.sugar,l.albumin,l.helminthes,
    l.OVA,l.CYST,l.polio,l.polio_date,l.MMR1,l.mmr1_date,l.MMR2,l.mmr2_date,l.meningococcal,l.meningococcal_date
    from tb_registration r 
    INNER JOIN tb_medical m on m.reg_id=r.reg_id
      inner JOIN tb_xray_result x on x.reg_id=r.reg_id
      left JOIN tb_lab_sticker s on s.reg_id=r.reg_id
      left join tb_lab_result l on (r.reg_id = l.reg_id || s.sticker_value_2=l.barcode )
    where r.reg_id='$regid'
    order by l.created_on desc 
      limit 1");
      
      return $process_query;
}

// function get_medical_report_pdf($serialno)
// {
//   global $data;

//     $process_query = $data->query("select r.country,r.candidate_name,r.son_of,r.serial_no,r.passport_no,r.d_o_b,r.place_of_issue,
//     r.passport_expiry_date,r.marital_status,r.nationality,r.profession,r.gender,r.cnic,r.medical_status,r.remarks,
//     r.barcode_no,r.reg_date,r.candidate_img,m.height,m.weight,m.bmi,m.bp,m.pulse,m.rr,m.visual_unaided_rt_eye,m.visual_unaided_left_eye,
//     m.visual_aided_rt_eye,m.visual_aided_left_eye,m.distant_unaided_rt_eye,m.distant_unaided_left_eye,
//     m.distant_aided_rt_eye,m.distant_aided_left_eye,m.near_unaided_rt_eye,m.near_unaided_left_eye,
//     m.near_aided_rt_eye,m.near_aided_left_eye,m.color_vision,m.hearing_rt_ear,m.hearing_left_ear,
//     m.general_appearance,m.cardiovascular,m.respiratory,m.ent,m.abdomen,m.hernia,m.hydrocele,m.extremities,
//     m.back,m.skin,m.cns,m.deformities,m.appearance,m.speech,m.behavior,m.cognition,m.orientation,m.memory,
//     m.concentration,m.mood,m.thoughts,m.other,x.xray_chest,l.blood_group,l.Haemoglobin,l.Malaria,l.Micro_filariae,
//     l.RBS,l.BIL,l.ALT,l.AST,l.ALK,l.Creatinine,l.HIV,l.HBsAg,l.HCV,l.VDRL,l.TPHA,l.sugar,l.albumin,l.helminthes,
//     l.OVA,l.CYST,l.polio,l.polio_date,l.MMR1,l.mmr1_date,l.MMR2,l.mmr2_date,l.meningococcal,l.meningococcal_date
//     from tb_registration r,tb_medical m,tb_lab_result l,tb_xray_result x,tb_lab_sticker s
//     where r.reg_id=m.reg_id AND r.reg_id = x.reg_id and l.barcode=s.sticker_value_2 and r.reg_id=s.reg_id and r.reg_id='$serialno'
//     limit 1");
      
//       return $process_query;
// }

function get_medical_lab_report_pdf($barcode_num)
{
  global $data;

    $process_query = $data->query("select candidate_name,serial_no,passport_no,country,phone_1,reg_date,barcode_no,token_no,created_at from tb_registration where barcode_no='$barcode_num'");
    // select candidate_name,serial_no,passport_no,country,reg_date,barcode_no,created_at from tb_registration where barcode_no = '$barcode_num'
      
      return $process_query;
      //return $process_query2;
}

function get_medical_lab_OrganInfo_pdf()
{
  global $data;
  global $center_id;

    $process_query2 = $data->query("select title,address,city,phone_no,phone_no_2,fax_no,email_address from tb_organization where center_id='$center_id'");
      
      return $process_query2;
}


function get_user_created($admin='')
{
  global $data;

  if($admin==19) {
    $get_user_info_query = $data->query("select user_id, user_name, user_password, IF(status = 0, 'In-Active','Active') as status, created_at from user");
  }
  else {
    $get_user_info_query = $data->query("select user_id, user_name, user_password, IF(status = 0, 'In-Active','Active') as status, created_at from user where user_id != 19");
  }
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_info_query)) {
      $user_name = $rows['user_name'];
      $created_at = $rows['created_at'];
      $status = $rows['status'];
      $user_id = $rows['user_id'];
      $pass = $rows['user_password'];
      $passEncoded = base64_encode($pass);

      // <tbody>
        echo "<tr>";
          echo "<td>";
            echo "<span class='text-muted'>$i</span>";
          echo "</td>";
          echo "<td class='table-user'>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>$user_name</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$created_at</span>";
          echo "</td>";
          if($status=='Active') {
            echo "<td class='status'>";
              echo "<span class='badge badge-dot mr-4'><i class='bg-success'></i>$status</span>";
            echo "</td>";
          }
            else {
              echo "<td class='status'>";
                echo "<span class='badge badge-dot mr-4'><i class='bg-danger'></i>$status</span>";
              echo "</td>";
            }
            echo "<td class='table-actions'>";
            
            echo "<a href=user_creation?e_userid=$user_id&&e_username=$user_name&&qa=$passEncoded target=_self class='table-action' data-toggle='tooltip' data-original-title='Edit user'>";
                echo "<i class='fas fa-user-edit'></i>";
            echo "</a>";
            
            if($status=='Active') {

              echo "<a href=user_creation?userid=$user_id&&username=$user_name&&check=inactive target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='In-Active user'>";
                echo "<i class='fas fa-ban'></i>";
            echo "</a>";

            }else{
              echo "<a href=user_creation?userid=$user_id&&username=$user_name&&check=active target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Activate user'>";
                echo "<i class='fas fa-check'></i>";
            echo "</a>";
            }

            echo "<a href=user_creation?uid=$user_id target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Delete user'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";

          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }

}

function populate_user_fields()
{
  global $username;
  global $pass;
  global $user_id;

  if (isset($_GET['e_userid']) && (isset($_GET['e_username'])) && (isset($_GET['qa']))) {
    $username = $_GET['e_username'];
    $passEncoded = $_GET['qa'];
    $user_id = $_GET['e_userid'];
    $pass = base64_decode($passEncoded);

  }
}

function edit_user()
{
  global $data;
  global $username;
  global $pass;
  global $user_id;

  if(isset($_POST['update_user'])) {
    $username = $_POST['u_username'];
    $pass = $_POST['u_password'];
    $pwd_hash = password_hash($pass, PASSWORD_DEFAULT);
      
      $run_Query = $data->query("update user set user_name='$username', user_password='$pwd_hash' where user_id='$user_id'");

      if($run_Query) {
        echo show_message(1,"Record Updated!");
        redirect('./user_creation','_self');
      }
      else
        echo show_message(0,"Update Fail, Try Again Later");
  }
}

function inactive_user()
{
  global $data;
  if (isset($_GET['userid']) && (isset($_GET['username'])) &&(isset($_GET['check']))) {

    $user_id = $_GET['userid'];
    $username = $_GET['username'];
    $check_type = $_GET['check'];

    if($check_type == 'active'){

      if($data->query("update user set status=1 where user_id=$user_id"))
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                        <span class='alert-text'><strong>Successfully! </strong>User $username activated!</span>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
        }
        else {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                      <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                      <span class='alert-text'><strong>Failed! </strong>User $username not exist!</span>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>";
        }

    }else{

      if($data->query("update user set status=0 where user_id=$user_id"))
        {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                        <span class='alert-text'><strong>Successfully! </strong>User $username set to In-Active!</span>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
        }
        else {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                      <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                      <span class='alert-text'><strong>Failed! </strong>User $username not exist!</span>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>";
        }

    }
  }
}

function delete_user()
{
  global $data;
  if (isset($_GET['uid'])) {

    $user_id = $_GET['uid'];

    if($data->query("delete from user where user_id='$user_id'"))
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                    <span class='alert-text'><strong>Successfully! </strong>User Deleted!</span>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
    }
    else {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                  <span class='alert-text'><strong>Failed! </strong>User not exist!</span>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
    }
  }
}

function remove_user_rights()
{
  global $data;
  if (isset($_GET['rightid']) && (isset($_GET['username']))) {

    $right_id = $_GET['rightid'];
    $username = $_GET['username'];

    $run_Query = $data->query("delete from user_rights where right_id='$right_id'");
    if($run_Query)
        echo show_message(0,"$username Rights Deleted!");
      else
        echo show_message(0,"Fail, Try Again Later");
  }
}


function create_new_user()
{
  global $data;
  global $username;
  global $password;
  global $center_id;
  if(isset($_POST['create_user']))
  {
      $username = $_POST['u_username'];
      $password = $_POST['u_password'];
      $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
      $status=1;

    $check_user=mysqli_query($data->con,"select * from user where user_name='$username' and user_password='$pwd_hash'");
    $count_user=mysqli_num_rows($check_user);
    if($count_user == 0)
    {
        $insert_user = array(
              'user_name' => mysqli_real_escape_string($data->con, $username),
              'user_password' => mysqli_real_escape_string($data->con, $pwd_hash),
              'status' => mysqli_real_escape_string($data->con, $status),
              'center_id' => mysqli_real_escape_string($data->con, $center_id)
          );

          if ($data->insert('user', $insert_user)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                    <span class='alert-text'><strong>Success! </strong>New User $username Created!</span>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
                  //echo "<meta http-equiv='refresh' content='0'>";
          }  
    }
    else {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                  <span class='alert-text'><strong>Failed! </strong>User $username Already Created!</span>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
    }
  }
}

// function get_all_users()
// {
//   global $data;
//   $get_username_query = $data->query("select user_id, user_name from user where status=1");
//         echo "<option>select</option>";
//     while ($rows = mysqli_fetch_array($get_username_query)) {
//       $user_id = $rows['user_id'];
//       $user_name = $rows['user_name'];

//       // <select>
//         echo "<option value=$user_id>$user_name</option>";
//       // </select>
//     }
// }

function get_all_users($admin='')
{
  global $data;
  if($admin==19){
    $get_username_query = $data->query("select user_id, user_name from user where status=1");
  } else {
    $get_username_query = $data->query("select user_id, user_name from user where status=1 and user_id!=19");
  }
  
        echo "<option value=''>- select -</option>";
    while ($rows = mysqli_fetch_array($get_username_query)) {
      $user_id = $rows['user_id'];
      $user_name = $rows['user_name'];

      // <select>
        echo "<option value=$user_id>$user_name</option>";
      // </select>
    }
}


function get_user_rights()
{
  global $data;
  $get_user_rights_query = $data->query("select r.right_id,u.user_name,m.module_desc,m.module_id,u.user_id from user_rights r, user u, module_setup m where r.user_id = u.user_id and r.module_id=m.module_id");
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_rights_query)) {
      $right_id = $rows['right_id'];
      $user_name = $rows['user_name'];
      $module_name = $rows['module_desc'];

      // <tbody>
        echo "<tr>";
          echo "<td class=text-muted>";
              echo "<span class=text-muted>&emsp;$i</span>";
            echo "</td>";
          echo "<td class=table-user>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>&emsp;$user_name</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$module_name</span>";
          echo "</td>";
            echo "<td class='table-actions'>";
            echo "<a href=user_role?rightid=$right_id&&username=$user_name target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Remove rights'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";
          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }
}

function create_user_rights()
{
  global $data;
  global $selected_user_id;
  global $center_id;

  if(isset($_POST['save_rights']))
  {
      $selected_user_id = $_POST['select_user'];

      if(!empty($_POST['check_list'])) {
        foreach($_POST['check_list'] as $selected) {

              $insert_rights = array(
              'user_id' => mysqli_real_escape_string($data->con, $selected_user_id),
              'module_id' => mysqli_real_escape_string($data->con, $selected),
              'center_id' => mysqli_real_escape_string($data->con, $center_id)
          );

          $data->insert('user_rights', $insert_rights);
        }

          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                    <span class='alert-text'><strong>Success! </strong>Rights assigned to User!</span>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
      }
        /*else {
          echo "<b>Please Select Atleast One Option.</b>";
        }*/  

  }
}


function get_all_modules()
{
  global $data;
  $get_modules_query = $data->query("select module_id, module_desc from module_setup");
        echo "<option>select</option>";
    while ($rows = mysqli_fetch_array($get_modules_query)) {
      $module_id = $rows['module_id'];
      $module_name = $rows['module_desc'];

      // <select>
        echo "<option value=$module_id>$module_name</option>";
      // </select>
    }
}

function get_user_actions()
{
  global $data;
  $get_user_rights_query = $data->query("SELECT r.action_id,u.user_name,m.module_desc,IF(r.edit_rights = 0, 'No','Yes') as edit_rights,IF(r.delete_rights = 0, 'No','Yes') as delete_rights,IF(r.barcode_verification = 0, 'No','Yes') as generate_barcode,IF(r.print_lab_sticker = 0, 'No','Yes') as print_lab_sticker,IF(r.biometric_allow = 0, 'No','Yes') as allow_biometric,IF(r.serial_no_rights = 0, 'No','Yes') as serial_no_rights,IF(r.now_serving_rights = 0, 'No','Yes') as now_serving_rights from user_action_rights r, user u, module_setup m where r.module_id=m.module_id and r.user_id=u.user_id");
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_rights_query)) {
      $action_id = $rows['action_id'];
      $user_name = $rows['user_name'];
      $module_name = $rows['module_desc'];
      $edit_rights = $rows['edit_rights'];
      $delete_rights = $rows['delete_rights'];
      $generate_barcode_rights = $rows['generate_barcode'];
      $print_lab_sticker = $rows['print_lab_sticker'];
      $biometric_allow = $rows['allow_biometric'];
      $serial_no = $rows['serial_no_rights'];
      $now_serving = $rows['now_serving_rights'];

      // <tbody>
        echo "<tr>";
          echo "<td>";
            echo "<span class=text-muted>&emsp;$i</span>";
          echo "</td>";
          echo "<td class=table-user>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>$user_name</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$module_name</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$edit_rights</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$delete_rights</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$generate_barcode_rights</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$print_lab_sticker</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$biometric_allow</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$serial_no</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$now_serving</span>";
          echo "</td>";
          echo "<td class='table-actions'>";
            echo "<a href=user_role?actionid=$action_id&&username=$user_name target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Remove action'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";
          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }
}

function create_user_action_rights()
{
  global $data;
  global $selected_user_id;
  global $edit_checkbx;
  global $del_checkbx;
  global $print_checkbx;
  global $biometric_checkbx;
  global $barcode_checkbx;
  global $serial_no_checkbx;
  global $now_serving_checkbx;
  global $b_plus_checkbx;
  global $pending_checkbx;
  global $date_checkbx;
  global $center_id;

  if(isset($_POST['save_actions']))
  {
      $selected_user_id = $_POST['select_user'];
      $selected_module_id = $_POST['select_module'];

      if(isset($_POST['edit_check'])) {
        $edit_checkbx = "1"; }
        else
          $edit_checkbx = "0";

      if(isset($_POST['delete_check'])) {
        $del_checkbx = "1"; }
        else
          $del_checkbx = "0";

      if(isset($_POST['print_check'])) {
        $print_checkbx = "1"; }
        else
          $print_checkbx = "0";

      if(isset($_POST['biometric_check'])) {
        $biometric_checkbx = "1"; }
        else
          $biometric_checkbx = "0";

      if(isset($_POST['barcod_check'])) {
        $barcode_checkbx = "1"; }
        else
          $barcode_checkbx = "0";

      if(isset($_POST['serial_no_check'])) {
        $serial_no_checkbx = "1"; }
        else
          $serial_no_checkbx = "0";

      if(isset($_POST['b_plus_check'])) {
        $b_plus_checkbx = "1"; }
        else
          $b_plus_checkbx = "0";

      if(isset($_POST['pending_check'])) {
        $pending_checkbx = "1"; }
        else
          $pending_checkbx = "0";

      if(isset($_POST['now_serving_check'])) {
        $now_serving_checkbx = "1"; }
        else
          $now_serving_checkbx = "0";

      if(isset($_POST['search_with_date'])) {
        $date_checkbx = "1"; }
        else
          $date_checkbx = "0";

  
            $insert_actions = array(
              'user_id' => mysqli_real_escape_string($data->con, $selected_user_id),
              'module_id' => mysqli_real_escape_string($data->con, $selected_module_id),
              'edit_rights' => mysqli_real_escape_string($data->con, $edit_checkbx),
              'delete_rights' => mysqli_real_escape_string($data->con, $del_checkbx),
              'barcode_verification' => mysqli_real_escape_string($data->con, $barcode_checkbx),
              'print_lab_sticker' => mysqli_real_escape_string($data->con, $print_checkbx),
              'biometric_allow' => mysqli_real_escape_string($data->con, $biometric_checkbx),
              'serial_no_rights' => mysqli_real_escape_string($data->con, $serial_no_checkbx),
              'b_plus_rights' => mysqli_real_escape_string($data->con, $b_plus_checkbx),
              'pending_rights' => mysqli_real_escape_string($data->con, $pending_checkbx),
              'now_serving_rights' => mysqli_real_escape_string($data->con, $now_serving_checkbx),
              'date_search_rights' => mysqli_real_escape_string($data->con, $date_checkbx),
              'center_id' => mysqli_real_escape_string($data->con, $center_id)
              
          );    

        $data->insert('user_action_rights', $insert_actions);

          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                  <span class='alert-text'><strong>Success! </strong>Actions assigned to User!</span>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>"; 

  }
    /*else {
      echo "<b>Please Select Atleast One Option.</b>";
    } */
}
// function create_user_action_rights()
// {
//   global $data;
//   global $selected_user_id;
//   global $edit_checkbx;
//   global $del_checkbx;
//   global $print_checkbx;
//   global $biometric_checkbx;
//   global $barcode_checkbx;
//   global $serial_no_checkbx;
//   global $now_serving_checkbx;
//   global $center_id;

//   if(isset($_POST['save_actions']))
//   {
//       $selected_user_id = $_POST['select_user'];
//       $selected_module_id = $_POST['select_module'];

//       if(isset($_POST['edit_check'])) {
//         $edit_checkbx = "1"; }
//         else
//           $edit_checkbx = "0";

//       if(isset($_POST['delete_check'])) {
//         $del_checkbx = "1"; }
//         else
//           $del_checkbx = "0";

//       if(isset($_POST['print_check'])) {
//         $print_checkbx = "1"; }
//         else
//           $print_checkbx = "0";

//       if(isset($_POST['biometric_check'])) {
//         $biometric_checkbx = "1"; }
//         else
//           $biometric_checkbx = "0";

//       if(isset($_POST['barcod_check'])) {
//         $barcode_checkbx = "1"; }
//         else
//           $barcode_checkbx = "0";

//       if(isset($_POST['serial_no_check'])) {
//         $serial_no_checkbx = "1"; }
//         else
//           $serial_no_checkbx = "0";

//       if(isset($_POST['now_serving_check'])) {
//         $now_serving_checkbx = "1"; }
//         else
//           $now_serving_checkbx = "0";

  
//             $insert_actions = array(
//               'user_id' => mysqli_real_escape_string($data->con, $selected_user_id),
//               'module_id' => mysqli_real_escape_string($data->con, $selected_module_id),
//               'edit_rights' => mysqli_real_escape_string($data->con, $edit_checkbx),
//               'delete_rights' => mysqli_real_escape_string($data->con, $del_checkbx),
//               'barcode_verification' => mysqli_real_escape_string($data->con, $barcode_checkbx),
//               'print_lab_sticker' => mysqli_real_escape_string($data->con, $print_checkbx),
//               'biometric_allow' => mysqli_real_escape_string($data->con, $biometric_checkbx),
//               'serial_no_rights' => mysqli_real_escape_string($data->con, $serial_no_checkbx),
//               'now_serving_rights' => mysqli_real_escape_string($data->con, $now_serving_checkbx),
//               'center_id' => mysqli_real_escape_string($data->con, $center_id)
              
//           );    

//         $data->insert('user_action_rights', $insert_actions);

//           echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
//                   <span class='alert-icon'><i class='ni ni-like-2'></i></span>
//                   <span class='alert-text'><strong>Success! </strong>Actions assigned to User!</span>
//                   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//                     <span aria-hidden='true'>&times;</span>
//                   </button>
//                 </div>"; 

//   }
//     /*else {
//       echo "<b>Please Select Atleast One Option.</b>";
//     } */
// }

function remove_user_action_rights()
{
  global $data;
  if (isset($_GET['actionid']) && (isset($_GET['username']))) {

    $action_id = $_GET['actionid'];
    $username = $_GET['username'];

    $run_Query = $data->query("delete from user_action_rights where action_id='$action_id'");
      
      if($run_Query)
        echo show_message(0,"$username Rights Deleted!");
      else
        echo show_message(0,"Fail, Try Again Later");
        
    }

}

function get_data_for_lab_result()
{
  global $data;
  global $serial_no;
  global $barcode;
  global $regid;
  global $passport_no;
  global $passport_issue_date;
  global $passport_expiry_date;
  global $place_of_issue;
  global $reg_date;
  global $agency;
  global $country;
  global $profession;
  global $fee_charged;
  global $candidate_name;
  global $cnic;
  global $son_of;
  global $nationality;
  global $d_o_b;
  global $phone_1;
  global $phone_2;
  global $gender;
  global $marital_status;
  global $remarks;
  // lab result variables
  global $hcv;
  global $hbs_ag;
  global $hiv;
  global $vdrl;
  global $tpha;
  global $rbs;
  global $bil;
  global $alt;
  global $ast;
  global $alk;
  global $creatinine;
  global $blood_group;
  global $haemoglobin;
  global $malaria;
  global $micro_filariae;
  global $sugar;
  global $albumin;
  global $helminthes;
  global $ova;
  global $cyst;
  global $tb_test;
  global $pragnancy_test;
  global $polio;
  global $polio_date;
  global $mmr1;
  global $mmr1_date;
  global $mmr2;
  global $mmr2_date;
  global $meningococcal;
  global $meningococcal_date;
  global $candidate_img;

    if(isset($_POST['search_candidate']))
    {
        $serial_no = $_POST['serial'];
        $search_with_date = date('Y-m-d',strtotime($_POST['search_with_date']));

          $process_query = $data->query("select lr.HCV,lr.HBsAg,lr.HIV,lr.VDRL,lr.TPHA,lr.RBS,lr.BIL,lr.ALT,lr.AST,lr.ALK,lr.Creatinine,lr.blood_group,lr.Haemoglobin,lr.Malaria,lr.Micro_filariae,lr.sugar,
lr.albumin,lr.helminthes,lr.OVA,lr.CYST,lr.TB,lr.pregnancy,lr.polio,lr.polio_date,lr.MMR1,lr.mmr1_date,lr.MMR2,lr.mmr2_date,lr.meningococcal,lr.meningococcal_date,r.reg_id,r.barcode_no,r.passport_no,r.serial_no,r.passport_issue_date,r.passport_expiry_date,r.place_of_issue,r.reg_date,r.agency,r.country,r.profession,r.fee_charged,r.candidate_name,r.cnic,r.son_of,r.nationality,r.d_o_b,r.phone_1,r.phone_2,r.gender,r.marital_status,r.remarks,r.candidate_img
from tb_registration r
INNER JOIN tb_lab_sticker tls on r.reg_id=tls.reg_id
INNER JOIN tb_lab_result lr ON (lr.reg_id=r.reg_id || lr.barcode=tls.sticker_value_2)
where r.serial_no='$serial_no' AND r.reg_date='$search_with_date' AND r.country != 'case-cancelled'
order by lr.created_on asc limit 1");

      
        while ($row = mysqli_fetch_array($process_query)) {
          $regid = $row['reg_id'];
          $barcode = $row['barcode_no'];
          $passport_no = $row['passport_no'];
          $serial_no = $row['serial_no'];
          $passport_issueDate = $row['passport_issue_date'];
          $passport_issue_date=date("d-m-Y",strtotime($passport_issueDate));
          $passport_expiryDate = $row['passport_expiry_date'];
          $passport_expiry_date=date("d-m-Y",strtotime($passport_expiryDate));
          $place_of_issue = $row['place_of_issue'];
          $regDate = $row['reg_date'];
          $reg_date=date("d-m-Y",strtotime($regDate));
          $agency = $row['agency'];
          $country = $row['country'];
          $profession = $row['profession'];
          $fee_charged = $row['fee_charged'];
          $candidate_name = $row['candidate_name'];
          $cnic = $row['cnic'];
          $son_of = $row['son_of'];
          $nationality = $row['nationality'];
          $dob = $row['d_o_b'];
          $d_o_b=date("d-m-Y",strtotime($dob));
          $phone_1 = $row['phone_1'];
          $phone_2 = $row['phone_2'];
          $gender = $row['gender'];
          $marital_status = $row['marital_status'];
          $remarks = $row['remarks'];
          $candidate_img = $row['candidate_img'];
          
          // lab variables
          
          $hcv = $row['HCV'];
          $hbs_ag = $row['HBsAg'];
          $hiv = $row['HIV'];
          $vdrl = $row['VDRL'];
          $tpha = $row['TPHA'];
          $rbs = $row['RBS'];
          $bil = $row['BIL'];
          $alt = $row['ALT'];
          $ast = $row['AST'];
          $alk = $row['ALK'];
          $creatinine = $row['Creatinine'];
          $blood_group = $row['blood_group'];
          $haemoglobin = $row['Haemoglobin'];
          $malaria = $row['Malaria'];
          $micro_filariae = $row['Micro_filariae'];
          $sugar = $row['sugar'];
          $albumin = $row['albumin'];
          $helminthes = $row['helminthes'];
          $ova = $row['OVA'];
          $cyst = $row['CYST'];
          $tb_test = $row['TB'];
          $pragnancy_test = $row['pregnancy'];
          $polio = $row['polio'];
          $polioDate = $row['polio_date'];
          $polio_date=date("m/d/Y",strtotime($polioDate));
          $mmr1 = $row['MMR1'];
          $mmr1Date = $row['mmr1_date'];
          $mmr1_date=date("m/d/Y",strtotime($mmr1Date));
          $mmr2 = $row['MMR2'];
          $mmr2Date = $row['mmr2_date'];
          $mmr2_date=date("m/d/Y",strtotime($mmr2Date));
          $meningococcal = $row['meningococcal'];
          $meningococcalDate= $row['meningococcal_date'];
          $meningococcal_date = date("m/d/Y",strtotime($meningococcalDate));

        }
      }
}


function get_data_by_serial()
{
  global $data;
  global $serial_no;
  global $barcode;
  global $reg_id;
  global $passport_no;
  global $passport_issue_date;
  global $passport_expiry_date;
  global $place_of_issue;
  global $reg_date;
  global $agency;
  global $country;
  global $profession;
  global $fee_charged;
  global $candidate_name;
  global $cnic;
  global $son_of;
  global $nationality;
  global $d_o_b;
  global $phone_1;
  global $phone_2;
  global $gender;
  global $marital_status;
  global $remarks;
  global $cand_img;

    if(isset($_POST['search_candidate']))
    {

      $serial_no = $_POST['search_serial_no'];
      $passport_number = $_POST['search_passport_no'];

      if(isset($_POST['search_with_date'])) {
          $search_with_date = date('Y-m-d',strtotime($_POST['search_with_date']));

          $process_query = $data->query("select reg_id,barcode_no,passport_no,serial_no,passport_issue_date,passport_expiry_date,place_of_issue,reg_date,agency,country,
        profession,fee_charged,candidate_name,cnic,son_of,nationality,d_o_b,phone_1,phone_2,gender,marital_status,remarks,candidate_img
        from tb_registration where serial_no='$serial_no' AND reg_date='$search_with_date'");

      } else {

          $process_query = $data->query("select reg_id,barcode_no,passport_no,serial_no,passport_issue_date,passport_expiry_date,place_of_issue,reg_date,agency,country,
        profession,fee_charged,candidate_name,cnic,son_of,nationality,d_o_b,phone_1,phone_2,gender,marital_status,remarks,candidate_img
        from tb_registration where serial_no='$serial_no' || passport_no='$passport_number'");

      }

        while ($row = mysqli_fetch_array($process_query)) {
          $reg_id = $row['reg_id'];
          $barcode = $row['barcode_no'];
          $passport_no = $row['passport_no'];
          $serial_no = $row['serial_no'];
          $passport_issueDate = $row['passport_issue_date'];
          $passport_issue_date=date("d-m-Y",strtotime($passport_issueDate));
          $passport_expiryDate = $row['passport_expiry_date'];
          $passport_expiry_date=date("d-m-Y",strtotime($passport_expiryDate));
          $place_of_issue = $row['place_of_issue'];
          $regDate = $row['reg_date'];
          $reg_date=date("d-m-Y",strtotime($regDate));
          $agency = $row['agency'];
          $country = $row['country'];
          $profession = $row['profession'];
          $fee_charged = $row['fee_charged'];
          $candidate_name = $row['candidate_name'];
          $cnic = $row['cnic'];
          $son_of = $row['son_of'];
          $nationality = $row['nationality'];
          $dob = $row['d_o_b'];
          $d_o_b=date("d-m-Y",strtotime($dob));
          $phone_1 = $row['phone_1'];
          $phone_2 = $row['phone_2'];
          $gender = $row['gender'];
          $marital_status = $row['marital_status'];
          $remarks = $row['remarks'];
          $cand_img = $row['candidate_img'];
        }
      }
}

// old

function edit_registered_candidate()
{
  global  $data;
   
    if(isset($_POST['update_by_serial_no'])) {

      $serial_no = $_POST['serial_new'];
      $regid = $_POST['regid'];
      $passport_no = $_POST['passport_no'];
      $passport_issue_date = $_POST['passport_issue_date'];
      $pp_i_d_strd=date("Y-m-d",strtotime($passport_issue_date));
      $passport_expiry_date = $_POST['passport_expiry_date'];
      $pp_ex_d_strd=date("Y-m-d",strtotime($passport_expiry_date));
      $place_of_issue = $_POST['place_of_issue'];
      $agency = $_POST['agency'];
      $country = mysqli_real_escape_string($data->con, $_POST['country']);

      $profession = $_POST['profession'];
      $fee_charged = $_POST['fee_charged'];
      $candidate_name = $_POST['candidate_name'];
      $cnic = $_POST['cnic'];
      $son_of = $_POST['son_of'];
      $nationality = $_POST['nationality'];
      $d_o_b = $_POST['d_o_b'];
      $d_o_b_strd=date("Y-m-d",strtotime($d_o_b));
      $phone_1 = $_POST['phone_1'];
      $phone_2 = $_POST['phone_2'];
      $gender = $_POST['gender'];
      $marital_status = $_POST['marital_status'];
      $remarks = $_POST['remarks'];
      $serial_new = $_POST['serial_new'];
      $candidate_img = $_POST['img_name'];

      if($candidate_img) {

          $run_Query = $data->query("update tb_registration set passport_no='$passport_no', passport_issue_date='$pp_i_d_strd', passport_expiry_date='$pp_ex_d_strd', place_of_issue='$place_of_issue', agency='$agency', country='$country', profession='$profession', fee_charged='$fee_charged', candidate_name='$candidate_name', cnic='$cnic', son_of='$son_of', nationality='$nationality', d_o_b='$d_o_b_strd', phone_1='$phone_1', phone_2='$phone_2', gender='$gender', marital_status='$marital_status', remarks='$remarks',serial_no='$serial_new',candidate_img='$candidate_img' where reg_id='$regid'");

      } else {

          $run_Query = $data->query("update tb_registration set passport_no='$passport_no', passport_issue_date='$pp_i_d_strd', passport_expiry_date='$pp_ex_d_strd', place_of_issue='$place_of_issue', agency='$agency', country='$country', profession='$profession', fee_charged='$fee_charged', candidate_name='$candidate_name', cnic='$cnic', son_of='$son_of', nationality='$nationality', d_o_b='$d_o_b_strd', phone_1='$phone_1', phone_2='$phone_2', gender='$gender', marital_status='$marital_status', remarks='$remarks',serial_no='$serial_new' where reg_id='$regid'");

      }
  
      if($run_Query)
        echo show_message(1,"Record Updated");
      else
        echo show_message(0,"Update Fail, Try Again Later");
    }

    if(isset($_POST['update_and_print'])) {

      $serial_no = $_POST['serial_new'];
      $regid = $_POST['regid'];
      $passport_no = $_POST['passport_no'];
      $passport_issue_date = $_POST['passport_issue_date'];
      $pp_i_d_strd=date("Y-m-d",strtotime($passport_issue_date));
      $passport_expiry_date = $_POST['passport_expiry_date'];
      $pp_ex_d_strd=date("Y-m-d",strtotime($passport_expiry_date));
      $place_of_issue = $_POST['place_of_issue'];
      $agency = $_POST['agency'];
      $country = mysqli_real_escape_string($data->con, $_POST['country']);

      $profession = $_POST['profession'];
      $fee_charged = $_POST['fee_charged'];
      $candidate_name = $_POST['candidate_name'];
      $cnic = $_POST['cnic'];
      $son_of = $_POST['son_of'];
      $nationality = $_POST['nationality'];
      $d_o_b = $_POST['d_o_b'];
      $d_o_b_strd=date("Y-m-d",strtotime($d_o_b));
      $phone_1 = $_POST['phone_1'];
      $phone_2 = $_POST['phone_2'];
      $gender = $_POST['gender'];
      $marital_status = $_POST['marital_status'];
      $remarks = $_POST['remarks'];
      $serial_new = $_POST['serial_new'];
      $bar = $_POST['barcode'];
      $candidate_img = $_POST['img_name'];

      if($candidate_img) {

          $run_Query = $data->query("update tb_registration set passport_no='$passport_no', passport_issue_date='$pp_i_d_strd', passport_expiry_date='$pp_ex_d_strd', place_of_issue='$place_of_issue', agency='$agency', country='$country', profession='$profession', fee_charged='$fee_charged', candidate_name='$candidate_name', cnic='$cnic', son_of='$son_of', nationality='$nationality', d_o_b='$d_o_b_strd', phone_1='$phone_1', phone_2='$phone_2', gender='$gender', marital_status='$marital_status', remarks='$remarks',serial_no='$serial_new',candidate_img='$candidate_img' where reg_id='$regid'");

      } else {

          $run_Query = $data->query("update tb_registration set passport_no='$passport_no', passport_issue_date='$pp_i_d_strd', passport_expiry_date='$pp_ex_d_strd', place_of_issue='$place_of_issue', agency='$agency', country='$country', profession='$profession', fee_charged='$fee_charged', candidate_name='$candidate_name', cnic='$cnic', son_of='$son_of', nationality='$nationality', d_o_b='$d_o_b_strd', phone_1='$phone_1', phone_2='$phone_2', gender='$gender', marital_status='$marital_status', remarks='$remarks',serial_no='$serial_new' where reg_id='$regid'");

      }
  
      if($run_Query){
        //echo show_message(1,"Record Updated");
        $encbarcode = $bar;// base64_encode($bar);
        redirect("./reports/registration_slip?barcode=$encbarcode ",'_blank');  
      }
            
      else{
        echo show_message(0,"Update Fail, Try Again Later");
      }
        
      }
    
}

// function edit_registered_candidate()
// {
//   global  $data;
   
//     if(isset($_POST['update_by_serial_no'])) {

//       // $serial_no = $_POST['serial_new'];
//       $regid = $_POST['regid'];
//       $passport_no = $_POST['passport_no'];
//       $passport_issue_date = $_POST['passport_issue_date'];
//       $pp_i_d_strd=date("Y-m-d",strtotime($passport_issue_date));
//       $passport_expiry_date = $_POST['passport_expiry_date'];
//       $pp_ex_d_strd=date("Y-m-d",strtotime($passport_expiry_date));
//       $place_of_issue = $_POST['place_of_issue'];
//       $agency = $_POST['agency'];
//       $country = mysqli_real_escape_string($data->con, $_POST['country']);

//       $profession = $_POST['profession'];
//       $fee_charged = $_POST['fee_charged'];
//       $candidate_name = $_POST['candidate_name'];
//       $cnic = $_POST['cnic'];
//       $son_of = $_POST['son_of'];
//       $nationality = $_POST['nationality'];
//       $d_o_b = $_POST['d_o_b'];
//       $d_o_b_strd=date("Y-m-d",strtotime($d_o_b));
//       $phone_1 = $_POST['phone_1'];
//       $phone_2 = $_POST['phone_2'];
//       $gender = $_POST['gender'];
//       $marital_status = $_POST['marital_status'];
//       $remarks = $_POST['remarks'];
//       $serial_new = $_POST['serial_new'];
//       $candidate_img = $_POST['img_name'];

//       $run_Query = $data->query("update tb_registration set passport_no='$passport_no', passport_issue_date='$pp_i_d_strd', passport_expiry_date='$pp_ex_d_strd', place_of_issue='$place_of_issue', agency='$agency', country='$country', profession='$profession', fee_charged='$fee_charged', candidate_name='$candidate_name', cnic='$cnic', son_of='$son_of', nationality='$nationality', d_o_b='$d_o_b_strd', phone_1='$phone_1', phone_2='$phone_2', gender='$gender', marital_status='$marital_status', remarks='$remarks',serial_no='$serial_new',candidate_img='$candidate_img' where reg_id='$regid'");
  
//       if($run_Query)
//         echo show_message(1,"Record Updated");
//       else
//         echo show_message(0,"Update Fail, Try Again Later");
//     }
// }


function create_new_country()
{
  global $data;
  global $country;

  if(isset($_POST['add_country']))
  {
      $country = $_POST['country_name'];
      $status=1;

        $insert_country = array(
              'Name' => mysqli_real_escape_string($data->con, $country),
              'status' => mysqli_real_escape_string($data->con, $status)
          );

          $runQuery = $data->insert('tb_country', $insert_country);

          if($runQuery)
            echo show_message(1,"Country $country Added");
          else
            echo show_message(0,"Failed, Already Created!");
  }
}

function get_all_countries($loginID,$moduleID)
{
  global $data;

  $can_edit = edit_rights($loginID,$moduleID);
  $can_delete = delete_rights($loginID,$moduleID);
  $get_user_info_query = $data->query("select country_id, Name, IF(status = 0, 'In-active','Active') as status, created_at from tb_country");
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_info_query)) {
      $country = $rows['Name'];
      $created_at = $rows['created_at'];
      $status = $rows['status'];
      $country_id = $rows['country_id'];
      $countryEncoded = base64_encode($country);

      // <tbody>
        echo "<tr>";
          echo "<td>";
            echo "<span class='text-muted'>$i</span>";
          echo "</td>";
          echo "<td class='table-user'>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>$country</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$created_at</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$status</span>";
          echo "</td>";
            echo "<td class='table-actions'>";
            if($can_edit == 1){
              echo "<a href=add_country?c_e_id=$country_id&&c_e_name=$countryEncoded target=_self class='table-action' data-toggle='tooltip' data-original-title='Edit country'>";
                echo "<i class='fas fa-user-edit'></i>";
            echo "</a>";  
            }
            if($can_delete == 1){
              echo "<a href=add_country?c_id=$country_id&&name=$country target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Delete country'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";  
            }
            
          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }

}

function delete_country()
{
  global $data;
  if (isset($_GET['c_id']) && (isset($_GET['name']))) {

    $country_id = $_GET['c_id'];
    $country = $_GET['name'];

    $run_Query = $data->query("update tb_country set status=0 where country_id=$country_id");

    if($run_Query)
      echo show_message(0,"Record Deleted!");
    else
      echo show_message(0,"Update Fail, Try Again Later");
  }
}

function fill_country_text()
{
  global $data;
  global $country_id;
  global $country;

  if (isset($_GET['c_e_id']) && (isset($_GET['c_e_name']))) {

    $country_id = $_GET['c_e_id'];
    $countryEncoded = $_GET['c_e_name'];
    $country = base64_decode($countryEncoded);
  }
}

function edit_country()
{
  global $data;
  global $country_id;
  global $country;

  if(isset($_POST['update_country'])) {
    $country = $_POST['country_name'];
        $run_Query = $data->query("update tb_country set Name='$country' where country_id=$country_id");

        if($run_Query) {
          echo show_message(1,"Record $country Updated!");
          redirect('./add_country','_self');
        }
        else
          echo show_message(0,"Update Fail, Try Again Later");

  }
}

function create_new_profession()
{
  global $data;
  global $profession;

  if(isset($_POST['add_profession']))
  {
      $profession = $_POST['profession_name'];
      $status=1;

        $insert_profession = array(
              'profession' => mysqli_real_escape_string($data->con, $profession),
              'status' => mysqli_real_escape_string($data->con, $status)
          );

          $runQuery = $data->insert('tb_profession', $insert_profession);

          if($runQuery)
            echo show_message(1,"Profession $profession Added");
          else
            echo show_message(0,"Failed, Already Created!");
  }
}

function get_all_profession($loginID,$moduleID)
{
  global $data;
  
  $can_edit = edit_rights($loginID,$moduleID);
  $can_delete = delete_rights($loginID,$moduleID);
  $get_user_info_query = $data->query("select profession_id, profession, IF(status = 0, 'In-active','Active') as status, created_at from tb_profession");
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_info_query)) {
      $profession = $rows['profession'];
      $created_at = $rows['created_at'];
      $status = $rows['status'];
      $profession_id = $rows['profession_id'];
      $pro = base64_encode($profession);

      // <tbody>
        echo "<tr>";
          echo "<td>";
            echo "<span class=text-muted>$i</span>";
          echo "</td>";
          echo "<td class=table-user>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>$profession</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$created_at</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class=text-muted>$status</span>";
          echo "</td>";
          echo "<td class='table-actions'>";
          if($can_edit == 1){
            
            echo "<a href=add_profession?p_e_id=$profession_id&&p_e_name=$pro target=_self class='table-action' data-toggle='tooltip' data-original-title='Edit profession'>";
                echo "<i class='fas fa-user-edit'></i>";
            echo "</a>";
          }
          if($can_delete == 1){
            echo "<a href=add_profession?p_id=$profession_id&&name=$profession target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Delete profession'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";
          }
            
          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }

}

function delete_profession()
{
  global $data;
  if (isset($_GET['p_id']) && (isset($_GET['name']))) {

    $profession_id = $_GET['p_id'];
    $profession = $_GET['name'];

    $run_Query = $data->query("update tb_profession set status=0 where profession_id=$profession_id");

    if($run_Query)
      echo show_message(0,"Record $profession Deleted!");
    else
      echo show_message(0,"Update Fail, Try Again Later");
  }
}

function fill_profession_text()
{
  global $data;
  global $profession_id;
  global $profession;

  if (isset($_GET['p_e_id']) && (isset($_GET['p_e_name']))) {

    $profession_id = $_GET['p_e_id'];
    $professionEncoded = $_GET['p_e_name'];
    $profession = base64_decode($professionEncoded);
  }
}

function edit_profession()
{
  global $data;
  global $profession_id;
  global $profession;

  if(isset($_POST['update_profession'])) {
    $profession = $_POST['profession_name'];
      $run_Query = $data->query("update tb_profession set profession='$profession' where profession_id=$profession_id");

      if($run_Query) {
        echo show_message(1,"Record $profession Updated!");
        redirect("./add_profession","_self");
      }
      else
        echo show_message(0,"Update Fail, Try Again Later");

  }
}

function create_new_agency()
{
  global $data;
  global $agency;

  if(isset($_POST['add_agency']))
  {
      $agency = $_POST['agency_name'];
      $status=1;

        $insert_agency = array(
              'agency' => mysqli_real_escape_string($data->con, $agency),
              'status' => mysqli_real_escape_string($data->con, $status)
          );

          $runQuery = $data->insert('tb_agency', $insert_agency);

          if($runQuery)
            echo show_message(1,"Agency Added");
          else
            echo show_message(0,"Failed, Already Created!");
  }
}

function get_all_agencies($loginID,$moduleID)
{
  global $data;
  $can_edit = edit_rights($loginID,$moduleID);
  $can_delete = delete_rights($loginID,$moduleID);

  $get_user_info_query = $data->query("select agency_id, agency, IF(status = 0, 'In-active','Active') as status, created_at from tb_agency");
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_info_query)) {
      $agency = $rows['agency'];
      $created_at = $rows['created_at'];
      $status = $rows['status'];
      $agency_id = $rows['agency_id'];
      $ag = base64_encode($agency);

      // <tbody>
        echo "<tr>";
          echo "<td>";
            echo "<span class='text-muted'>$i</span>";
          echo "</td>";
          echo "<td class='table-user'>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>$agency</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$created_at</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$status</span>";
          echo "</td>";
            echo "<td class='table-actions'>";
            if($can_edit == 1){
              echo "<a href=add_agency?a_e_id=$agency_id&&a_e_name=$ag target=_self class='table-action' data-toggle='tooltip' data-original-title='Edit agency'>";
                echo "<i class='fas fa-user-edit'></i>";
            echo "</a>";  
            }
            if($can_delete == 1){
              echo "<a href=add_agency?a_id=$agency_id&&name=$agency target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Delete agency'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";  
            }
            
          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }

}

function fill_agency_text()
{
  global $data;
  global $agency_id;
  global $agency;

  if (isset($_GET['a_e_id']) && (isset($_GET['a_e_name']))) {

    $agency_id = $_GET['a_e_id'];
    $agencyEncoded = $_GET['a_e_name'];
    $agency = base64_decode($agencyEncoded);
  }
}

function edit_agency()
{
  global $data;
  global $agency_id;

  if(isset($_POST['update_agency'])) {
    $agency = $_POST['agency_name'];
        $run_Query = $data->query("update tb_agency set agency='$agency' where agency_id='$agency_id'");

        if($run_Query) {
          echo show_message(1,"Record Updated!");
          redirect("./add_agency","_self");
        }
        else
          echo show_message(0,"Update Fail, Try Again Later");

  }
}

function delete_agency()
{
  global $data;
  if (isset($_GET['a_id']) && (isset($_GET['name']))) {

    $agency_id = $_GET['a_id'];
    $agency = $_GET['name'];

    $run_Query = $data->query("update tb_agency set status=0 where agency_id='$agency_id'");

    if($run_Query)
      echo show_message(0,"Record Deleted!");
    else
      echo show_message(0,"Update Fail, Try Again Later");
  }
}

function create_new_nationality()
{
  global $data;
  global $nationality;

  if(isset($_POST['add_nationality']))
  {
      $nationality = $_POST['nationality_name'];
      $status=1;

        $insert_nationality = array(
              'nationality' => mysqli_real_escape_string($data->con, $nationality),
              'status' => mysqli_real_escape_string($data->con, $status)
          );

          $runQuery = $data->insert('tb_nationality', $insert_nationality);

          if($runQuery)
            echo show_message(1,"Nationality Added");
          else
            echo show_message(0,"Failed, Already Created!");
  }
}

function get_all_nationalities($loginID,$moduleID)
{
  global $data;
  $can_edit = edit_rights($loginID,$moduleID);
  $can_delete = delete_rights($loginID,$moduleID);
  $get_user_info_query = $data->query("select nationality_id, nationality, IF(status = 0, 'In-active','Active') as status, created_at from tb_nationality");
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_info_query)) {
      $nationality = $rows['nationality'];
      $created_at = $rows['created_at'];
      $status = $rows['status'];
      $nationality_id = $rows['nationality_id'];
      $nation = base64_encode($nationality);

      // <tbody>
        echo "<tr>";
          echo "<td>";
            echo "<span class='text-muted'>$i</span>";
          echo "</td>";
          echo "<td class='table-user'>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>$nationality</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$created_at</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$status</span>";
          echo "</td>";
            echo "<td class='table-actions'>";
            if($can_edit==1){
              echo "<a href=add_nationality?n_e_id=$nationality_id&&n_e_name=$nation target=_self class='table-action' data-toggle='tooltip' data-original-title='Edit nationality'>";
                echo "<i class='fas fa-user-edit'></i>";
            echo "</a>";  
            }
            if($can_delete ==1){
              echo "<a href=add_nationality?n_id=$nationality_id&&name=$nation target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Delete nationality'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";  
            }
            
          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }

}

function fill_nationality_text()
{
  global $data;
  global $nationality_id;
  global $nationality;

  if (isset($_GET['n_e_id']) && (isset($_GET['n_e_name']))) {

    $nationality_id = $_GET['n_e_id'];
    $nationalityEncoded = $_GET['n_e_name'];
    $nationality = base64_decode($nationalityEncoded);
  }
}

function edit_nationality()
{
  global $data;
  global $nationality_id;

  if(isset($_POST['update_nationality'])) {
    $nationality = $_POST['nationality_name'];
        $run_Query = $data->query("update tb_nationality set nationality='$nationality' where nationality_id='$nationality_id'");

        if($run_Query) {
          echo show_message(1,"Record Updated!");
          redirect("./add_nationality","_self");
        }
        else
          echo show_message(0,"Update Fail, Try Again Later");

  }
}

function delete_nationality()
{
  global $data;
  if (isset($_GET['n_id']) && (isset($_GET['name']))) {

    $nationality_id = $_GET['n_id'];
    $nationality = $_GET['name'];

    $run_Query = $data->query("update tb_nationality set status=0 where nationality_id='$nationality_id'");

    if($run_Query)
      echo show_message(0,"Record Deleted!");
    else
      echo show_message(0,"Update Fail, Try Again Later");
  }
}

function create_new_place_of_issue()
{
  global $data;
  global $place_of_issue;

  if(isset($_POST['add_place_of_issue']))
  {
      $place_of_issue = $_POST['place_of_issue_name'];
      $status=1;

        $insert_place_of_issue = array(
              'place_of_issue' => mysqli_real_escape_string($data->con, $place_of_issue),
              'status' => mysqli_real_escape_string($data->con, $status)
          );

          $runQuery = $data->insert('tb_place_of_issue', $insert_place_of_issue);

          if($runQuery)
            echo show_message(1,"Place Added");
          else
            echo show_message(0,"Failed, Already Created!");
  }
}

function get_all_places($loginID,$moduleID)
{
  global $data;
  $can_edit = edit_rights($loginID,$moduleID);
  $can_delete = delete_rights($loginID,$moduleID);
  $get_user_info_query = $data->query("select place_of_issue_id, place_of_issue, IF(status = 0, 'In-active','Active') as status, created_at from tb_place_of_issue");
    $i=1;
    while ($rows = mysqli_fetch_array($get_user_info_query)) {
      $place_of_issue = $rows['place_of_issue'];
      $created_at = $rows['created_at'];
      $status = $rows['status'];
      $place_of_issue_id = $rows['place_of_issue_id'];
      $place = base64_encode($place_of_issue);

      // <tbody>
        echo "<tr>";
          echo "<td>";
            echo "<span class='text-muted'>$i</span>";
          echo "</td>";
          echo "<td class='table-user'>";
            /*echo "<img class=avatar rounded-circle mr-3>";*/
            echo "<b>$place_of_issue</b>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$created_at</span>";
          echo "</td>";
          echo "<td>";
            echo "<span class='text-muted'>$status</span>";
          echo "</td>";
            echo "<td class='table-actions'>";
            if($can_edit == 1){
              echo "<a href=add_place_of_issue?p_e_id=$place_of_issue_id&&p_e_name=$place target=_self class='table-action' data-toggle='tooltip' data-original-title='Edit place_of_issue'>";
                echo "<i class='fas fa-user-edit'></i>";
            echo "</a>";  
            }
            if($can_delete == 1){
              echo "<a href=add_place_of_issue?p_id=$place_of_issue_id&&name=$place target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Delete place_of_issue'>";
                echo "<i class='fas fa-trash'></i>";
            echo "</a>";  
            }
            
          echo "</td>";
        echo "</tr>";
      // </tbody>
        $i++;
    }

}

function fill_place_of_issue_text()
{
  global $data;
  global $place_of_issue_id;
  global $place_of_issue;

  if (isset($_GET['p_e_id']) && (isset($_GET['p_e_name']))) {

    $place_of_issue_id = $_GET['p_e_id'];
    $placeEncode = $_GET['p_e_name'];
    $place_of_issue = base64_decode($placeEncode);
  }
}

function edit_place_of_issue()
{
  global $data;
  global $place_of_issue_id;

  if(isset($_POST['update_place_of_issue'])) {
    $place_of_issue = $_POST['place_of_issue_name'];
        $run_Query = $data->query("update tb_place_of_issue set place_of_issue='$place_of_issue' where place_of_issue_id='$place_of_issue_id'");

        if($run_Query) {
          echo show_message(1,"Record Updated!");
          redirect("./add_place_of_issue","_self");
        }
        else
          echo show_message(0,"Update Fail, Try Again Later");

  }
}

function delete_place_of_issue()
{
  global $data;
  if (isset($_GET['p_id']) && (isset($_GET['name']))) {

    $place_of_issue_id = $_GET['p_id'];
    $place_of_issue = $_GET['name'];

    $run_Query = $data->query("update tb_place_of_issue set status=0 where place_of_issue_id='$place_of_issue_id'");

    if($run_Query)
      echo show_message(0,"Record Deleted!");
    else
      echo show_message(0,"Update Fail, Try Again Later");
  }
}

function get_selected_countries()
{
  global $data;

  if(isset($_POST['generate_report'])) {

    $cases = $_POST['countries'];

    redirect('reports/daily_registration?cases[]=$cases','_blank');
  }

}

function get_data_medicalOfficer_by_serial()
{
  global $data;
  global $search_by_serial_no;
  global $height;
  global $weight;
  global $bp;
  global $bmi;
  global $pulse;
  global $rr;
  global $visual_unaided_r_eye;
  global $visual_unaided_l_eye;
  global $visual_aided_r_eye;
  global $visual_aided_l_eye;
  global $distant_unaided_r_eye;
  global $distant_unaided_l_eye;
  global $distant_aided_r_eye;
  global $distant_aided_l_eye;
  global $near_unaided_r_eye;
  global $near_unaided_l_eye;
  global $near_aided_r_eye;
  global $near_aided_l_eye;
  global $color_vision;
  global $hearing_r_ear;
  global $hearing_l_ear;
  global $appearance;
  global $speech;
  global $behavior;
  global $cognition;
  global $orientation;
  global $memory;
  global $concentration;
  global $mood;
  global $thoughts;
  global $other;
  global $general_appearance;
  global $cardiovascular;
  global $respiratory;
  global $ent;
  global $abdomen;
  global $hernia;
  global $hydrocele;
  global $extremities;
  global $back;
  global $skin;
  global $cns;
  global $deformities;
  global $reg_date;
  global $remarks;
  global $reg_id;
  global $cand_name;
  global $country;
  global $passport_no;
  global $serial_no;

    if(isset($_POST['search_medical_candidate'])) {
      $search_by_serial_no = $_POST['search_by_serial'];
      $process_query = $data->query("select * from tb_registration r, tb_medical m where r.reg_id=m.reg_id and r.serial_no='$search_by_serial_no'");
        while ($row = mysqli_fetch_array($process_query)) {
          $height = $row['height'];
          $weight = $row['weight'];
          $bmi = $row['bmi'];
          $bp = $row['bp'];
          $pulse = $row['pulse'];
          $rr = $row['rr'];
          $visual_unaided_r_eye = $row['visual_unaided_rt_eye'];
          $visual_unaided_l_eye = $row['visual_unaided_left_eye'];
          $visual_aided_r_eye = $row['visual_aided_rt_eye'];
          $visual_aided_l_eye = $row['visual_aided_left_eye'];
          $distant_unaided_r_eye = $row['distant_unaided_rt_eye'];
          $distant_unaided_l_eye = $row['distant_unaided_left_eye'];
          $distant_aided_r_eye = $row['distant_aided_rt_eye'];
          $distant_aided_l_eye = $row['distant_aided_left_eye'];
          $near_unaided_r_eye = $row['near_unaided_rt_eye'];
          $near_unaided_l_eye = $row['near_unaided_left_eye'];
          $near_aided_r_eye = $row['near_aided_rt_eye'];
          $near_aided_l_eye = $row['near_aided_left_eye'];
          $color_vision = $row['color_vision'];   // not set into variable
          $hearing_r_ear = $row['hearing_rt_ear'];
          $hearing_l_ear = $row['hearing_left_ear'];
          $appearance = $row['appearance'];
          $speech = $row['speech'];
          $behavior = $row['behavior'];
          $cognition = $row['cognition'];
          $orientation = $row['orientation'];
          $memory = $row['memory'];
          $concentration = $row['concentration'];
          $mood = $row['mood'];
          $thoughts = $row['thoughts'];
          $other = $row['other'];
          $general_appearance = $row['general_appearance'];
          $cardiovascular = $row['cardiovascular'];
          $respiratory = $row['respiratory'];
          $ent = $row['ent'];
          $abdomen = $row['abdomen'];
          $hernia = $row['hernia'];
          $hydrocele = $row['hydrocele'];
          $extremities = $row['extremities'];
          $back = $row['back'];
          $skin = $row['skin'];
          $cns = $row['cns'];
          $deformities = $row['deformities'];
          $reg_date = $row['reg_date'];
          $cand_name = $row['candidate_name'];
          $serial_no = $row['serial_no'];
          $passport_no = $row['passport_no'];
          $country = $row['country'];
          $remarks = $row['remarks'];
          $reg_id = $row['reg_id'];
        }
    }
}

function edit_medicalOfficer_candidate()
{
    global  $data;
   
    if(isset($_POST['update_by_serial_number'])) {

      $search_by_serial_no = $_POST['search_by_serial_no'];
      //alert_box($search_by_serial_no);
      $reg_id = $_POST['reg_id'];
      $height = $_POST['height'];
      $weight = $_POST['weight'];
      $bmi = $_POST['bmi'];
      $bp = $_POST['bp'];
      $pulse = $_POST['pulse'];
      $rr = $_POST['rr'];
      $visual_unaided_r_eye = '';//$_POST['visual_unaided_rt_eye'];
      $visual_unaided_l_eye = '';//$_POST['visual_unaided_left_eye'];
      $visual_aided_r_eye = '';//$_POST['visual_aided_rt_eye'];
      $visual_aided_l_eye = '';//$_POST['visual_aided_left_eye'];
      $distant_unaided_r_eye = $_POST['distant_unaided_rt_eye'];
      $distant_unaided_l_eye = $_POST['distant_unaided_left_eye'];
      $distant_aided_r_eye = $_POST['distant_aided_rt_eye'];
      $distant_aided_l_eye = $_POST['distant_aided_left_eye'];
      $near_unaided_r_eye = $_POST['near_unaided_rt_eye'];
      $near_unaided_l_eye = $_POST['near_unaided_left_eye'];
      $near_aided_r_eye = $_POST['near_aided_rt_eye'];
      $near_aided_l_eye = $_POST['near_aided_left_eye'];
      $color_vision = $_POST['color_vision'];   // not set into variable
      $hearing_r_ear = $_POST['hearing_rt_ear'];
      $hearing_l_ear = $_POST['hearing_left_ear'];
      $appearance = $_POST['appearance'];
      $speech = $_POST['speech'];
      $behavior = $_POST['behavior'];
      $cognition = $_POST['cognition'];
      $orientation = $_POST['orientation'];
      $memory = $_POST['memory'];
      $concentration = $_POST['concentration'];
      $mood = $_POST['mood'];
      $thoughts = $_POST['thoughts'];
      $other = $_POST['other'];
      $general_appearance = $_POST['general_appearance'];
      $cardiovascular = $_POST['cardiovascular'];
      $respiratory = $_POST['respiratory'];
      $ent = $_POST['ent'];
      $abdomen = $_POST['abdomen'];
      $hernia = $_POST['hernia'];
      $hydrocele = $_POST['hydrocele'];
      $extremities = $_POST['extremities'];
      $back = $_POST['back'];
      $skin = $_POST['skin'];
      $cns = $_POST['cns'];
      $deformities = $_POST['deformities'];
      //$reg_date = $_POST['reg_date'];
      $remarks = $_POST['remarks'];
      
      if(empty($_FILES['fileToUpload'])){
        $imgname = "";
      } 
      else {
      
        if(isset($_FILES['fileToUpload'])) {

          // echo "<script>alert('hi 435')</script>";

          $target_dir = "assets/candidate_mo/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          // Check if image file is a actual image or fake image

              $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
              if($check != false) {
                  // echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  echo "File is not an image.";
                  $uploadOk = 0;
              }
          
          // Check if file already exists
          if (file_exists($target_file)) {
              // echo "Sorry, file already exists.";
              alert_box("Sorry, file already exists.");
              redirect('edit_medicalOfficer','_self');
              $uploadOk = 0;
          }
          // Check file size
          if ($_FILES["fileToUpload"]["size"] > 500000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
              // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              alert_box("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
              redirect('edit_medicalOfficer','_self');
              $uploadOk = 0;
          }
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              // echo "Sorry, your file was not uploaded.";
              alert_box("Sorry, your file was not uploaded.");
              redirect('edit_medicalOfficer','_self');
          // if everything is ok, try to upload file
          } else {
              $file_name=$_FILES["fileToUpload"]["name"];
              $file_tmp=$_FILES["fileToUpload"]["tmp_name"];
              $ext=pathinfo($file_name,PATHINFO_EXTENSION);
              $filePath = "assets/candidate_mo/".$file_name;
              $imgname=basename($file_name,$ext);
              $newFileName=$imgname.time().".".$ext;
              $newfilePath="assets/candidate_mo/".$newFileName;
              move_uploaded_file($file_tmp=$_FILES["fileToUpload"]["tmp_name"],$newfilePath);
              
            }

          }
      } 

      $run_Query = $data->query("update tb_medical set height='$height', weight='$weight', bmi='$bmi', bp='$bp', pulse='$pulse', rr='$rr', visual_unaided_rt_eye='$visual_unaided_r_eye', visual_unaided_left_eye='$visual_unaided_l_eye', visual_aided_rt_eye='$visual_aided_r_eye', visual_aided_left_eye='$visual_aided_l_eye', distant_unaided_rt_eye='$distant_unaided_r_eye', distant_unaided_left_eye='$distant_unaided_l_eye', distant_aided_rt_eye='$distant_aided_r_eye', distant_aided_left_eye='$distant_aided_l_eye', near_unaided_rt_eye='$near_unaided_r_eye', near_unaided_left_eye='$near_unaided_l_eye', near_aided_rt_eye='$near_aided_r_eye', near_aided_left_eye='$near_aided_l_eye', color_vision='$color_vision', hearing_rt_ear='$hearing_r_ear', hearing_left_ear='$hearing_l_ear', appearance='$appearance', speech='$speech', behavior='$behavior', cognition='$cognition', orientation='$orientation', memory='$memory', concentration='$concentration', mood='$mood', thoughts='$thoughts', other='$other', general_appearance='$general_appearance', cardiovascular='$cardiovascular', respiratory='$respiratory', ent='$ent', abdomen='$abdomen', hernia='$hernia', hydrocele='$hydrocele', extremities='$extremities', back='$back', skin='$skin', cns='$cns', deformities='$deformities', remarks='$remarks',mo_file='$newFileName' where reg_id='$reg_id'");
  
      if($run_Query)
        echo show_message(1,"Record Updated");
      else
        echo show_message(0,"Update Fail, Try Again Later");
    }
}

function get_cand_xray_data()
{
  global $data;
  global $reg_id;
  global $xray_chest;
  global $xray_notes;
  global $xray_date; 

  if(isset($_POST['search_xray_candidate'])) {
    $serial_no = $_POST['search_xray_by_serial'];

    $process_query = $data->query("select * from tb_registration r, tb_xray x where r.reg_id=x.reg_id and r.serial_no='$serial_no'");
    //print_r($process_query);
        while ($row = mysqli_fetch_array($process_query)) {
          $reg_id = $row['reg_id'];
          $xray_chest = $row['xray_chest'];
          $xray_notes = $row['xray_notes'];
          $xray_date = $row['xray_date'];
          //$xray_img = $rows['xray_img'];
        }
        alert_box($xray_chest);
  }
}

function edit_xray_info()
{
  global $data;
  
  if(isset($_POST['update_xray'])) {

    $x_date = $_POST['xraydate'];
    $xray_date = date('Y-m-d', strtotime($x_date));
    //$file = $_POST['file'];
    $xray_chest = $_POST['xray_chest'];
    $xray_notes = $_POST['xray_notes'];
    $reg_id = $_POST['reg_id'];

    $run_Query = $data->query("update tb_xray_result set xray_date='$xray_date',xray_chest='$xray_chest',xray_notes='$xray_notes' where reg_id='$reg_id'");

      if($run_Query) {
        // echo show_message(1,"Record Updated!");
        echo "<script>alert('Record Updated!')</script>";

        update_medical_status_final($reg_id);
        
        redirect("edit_xray", "_self");
      }
      else
        echo show_message(0,"Update Fail, Try Again Later");

  }
}

function get_cand_report() 
{
  global $data;
  global $cand_name;
  global $registration_date;
  global $passport_no;
  global $country;

  if(isset($_POST['find'])) {
    if(isset($_POST['pp_no'])) {
      $passport_no = $_POST['pp_no'];

      $process_query = $data->query("select candidate_name, reg_date, passport_no, country from tb_registration where passport_no='$passport_no'");
        while ($row = mysqli_fetch_array($process_query)) {
          $cand_name = $row['candidate_name'];
          $registration_date = $row['reg_date'];
          $passport_no = $row['passport_no'];
          $country = $row['country'];

        }
    }
  }
}

function get_embassay_report_pdf($ppno)
{
  global $data;

    $process_query = $data->query("select candidate_name, serial_no, passport_no, country, cnic, son_of, profession, place_of_issue, agency, d_o_b, reg_date, created_at from tb_registration where passport_no='$ppno'");
      
      return $process_query;
}

function daily_cash_statement(){
    
    global $data;
    global $today_date;

    $process_query = $data->query("SELECT t.country,count(t.country)as cases,t.fee_charged  FROM tb_registration t where t.reg_date='$today_date' AND t.country!='CASE CANCELLED' GROUP by t.country");  
    return $process_query;
}

function daily_discount(){
  global $data;
  global $today_date;

    $process_query = $data->query("SELECT sum(t.discount)as total_discount from tb_registration t WHERE t.reg_date='$today_date'");  
    return $process_query;
}

function get_daily_eno_report_pdf($enoDate)
{
  global $data;
    $process_query = $data->query("select r.reg_date, r.serial_no, e.eno_date, r.passport_no, r.candidate_name, e.eno from tb_registration r, tb_eno e where r.passport_no=e.passport_no and e.eno_date ='$enoDate' order by r.serial_no ASC");
      
    return $process_query;
}

function eno_history()
{    
    global $data;
                
    $process_query = $data->query("select r.reg_date, r.serial_no, r.candidate_name, e.screenshot, e.passport_no, e.eno, e.eno_date from tb_eno e, tb_registration r where e.passport_no=r.passport_no LIMIT 0,49");
    while ($rows = mysqli_fetch_array($process_query)) {
      $reg_date = $rows['reg_date'];
      $serial_no = $rows['serial_no'];
      $candidate_name = $rows['candidate_name'];
      $screenshot = $rows['screenshot'];
      $passport_no = $rows['passport_no'];
      $eno = $rows['eno'];
      $eno_date = $rows['eno_date'];

        echo "<tr>";                
          echo "<td>$reg_date</td>";
          echo "<td>$serial_no</td>";
          echo "<td>$candidate_name</td>";
          echo "<td>$passport_no</td>";
          echo "<td>$eno</td>";
          echo "<td>$eno_date</td>";
          echo "<td>
                  <div class='avatar-group'>
                    <a href='assets/candidate_eno/$screenshot' target='_blank' class='avatar avatar-sm rounded-circle' data-toggle='tooltip' data-original-title='View'>
                      <img alt='Image placeholder' src='assets/candidate_eno/$screenshot'>
                    </a>
                  </div>
                </td>";
        echo "</tr>";                    
      
    }

}

function cand_report_issuance_record() 
{
  global $data;
  global $cand_name;
  global $registration_date;
  global $son_of;
  global $serial_no;
  global $passport_no;
  global $country;
  global $cnic_no;
  global $reg_id;

  if(isset($_POST['find'])) {
    if(isset($_POST['barcode'])) {
      $barcode = $_POST['barcode'];

      $process_query = $data->query("select reg_id,reg_date,passport_no,candidate_name,son_of,country,serial_no,cnic from tb_registration where barcode_no='$barcode'");
        while ($row = mysqli_fetch_array($process_query)) {
          $reg_id = $row['reg_id'];
          $cand_name = $row['candidate_name'];
          $registration_date = $row['reg_date'];
          $son_of = $row['son_of'];
          $serial_no = $row['serial_no'];
          $passport_no = $row['passport_no'];
          $country = $row['country'];
          $cnic_no = $row['cnic'];

        }
    }
  }
}

function organization_history()
{    
    global $data;
                
    $process_query = $data->query("select center_id,title,address,phone_no,phone_no_2,fax_no,email_address,email_address_2,logo,IF(status=0,'In-Active','Active') as status,transdate from tb_organization");
    $i=1;
    while ($rows = mysqli_fetch_array($process_query)) {
      $center_id = $rows['center_id'];
      $name = $rows['title'];
      $address = $rows['address'];
      $phone_no = $rows['phone_no'];
      $phone_no_2 = $rows['phone_no_2'];
      $fax_no = $rows['fax_no'];
      $email_address = $rows['email_address'];
      $email_address_2 = $rows['email_address_2'];
      $logo = $rows['logo'];
      $status = $rows['status'];
      $transdate = $rows['transdate'];
      $nameEncoded = base64_encode($name);
      $addressEncoded = base64_encode($address);

        echo "<tr>";                
          echo "<td>$i</td>";
          echo "<td>$name</td>";
          echo "<td>$address</td>";
          echo "<td>$phone_no</td>";
          echo "<td>$phone_no_2</td>";
          echo "<td>$fax_no</td>";
          echo "<td>$email_address</td>";
          echo "<td>$email_address_2</td>";
                if($status=='Active') {
                  echo "<td class='status'>";
                    echo "<span class='badge badge-dot mr-4'><i class='bg-success'></i>$status</span>";
                  echo "</td>";
                }
                  else {
                    echo "<td class='status'>";
                      echo "<span class='badge badge-dot mr-4'><i class='bg-danger'></i>$status</span>";
                    echo "</td>";
                  }
                echo "<td>$transdate</td>";
                echo "<td>
                  <div class='avatar-group'>
                    <a href='assets/img/comp_logo/$logo' target='_blank' class='avatar avatar-sm rounded-circle' data-toggle='tooltip' data-original-title='View'>
                      <img alt='Image' src='assets/img/comp_logo/$logo'>
                    </a>
                  </div>
                </td>";
                echo "<td class='table-actions'>";
                echo "<a href=add_organization?c_id=$center_id&&e_name=$nameEncoded&&addr=$addressEncoded&&phone_no=$phone_no&&phone_no_2=$phone_no_2&&fax_no=$fax_no&&email_address=$email_address&&email_address_2=$email_address_2&&logo=$logo target=_self class='table-action' data-toggle='tooltip' data-original-title='Edit organization'>";
                    echo "<i class='fas fa-user-edit'></i>";
                echo "</a>";
                echo "<a href=add_organization?c_d_id=$center_id&&name=$name target=_self class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Delete organization'>";
                    echo "<i class='fas fa-trash'></i>";
                echo "</a>";
              echo "</td>";
        echo "</tr>";                    
      $i++;
    }

}

function create_organization()
{
  global $data;
  global $name;
  global $address;
  global $phone_no;
  global $phone_no_2;
  global $fax_no;
  global $email_address;
  global $email_address_2;
  global $logo;

  if(isset($_POST['add_organization']))
  {
    $target_dir = "assets/img/comp_logo/";
    $target_file = $target_dir . basename($_FILES["LogoUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $name = $_POST['title'];
      $address = $_POST['address'];
      $phone_no = $_POST['phone_no'];
      $phone_no_2 = $_POST['phone_no_2'];
      $fax_no = $_POST['fax_no'];
      $email_address = $_POST['email_address'];
      $email_address_2 = $_POST['email_address_2'];
      $status=1;
      $check = getimagesize($_FILES["LogoUpload"]["tmp_name"]);
        if($check !== false) {
            echo show_message(1,"File is an image - " . $check["mime"] . ".");
            $uploadOk = 1;
        } else {
            echo show_message(0,"File is not an image!");
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo show_message(0,"Sorry, file already exists!");
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["LogoUpload"]["size"] > 500000) {
            echo show_message(0,"Sorry, your file is too large!");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo show_message(0,"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo show_message(0,"Sorry, your file was not uploaded!");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["LogoUpload"]["tmp_name"], $target_file)) {

                $logo = basename($_FILES["LogoUpload"]["name"]);
                
            } else {
                echo show_message(0,"Error in uploading Logo!");
                echo redirect('./add_organization','_self');
            }
        
        $insert_organization = array(
              'title' => mysqli_real_escape_string($data->con, $name),
              'address' => mysqli_real_escape_string($data->con, $address),
              'phone_no' => mysqli_real_escape_string($data->con, $phone_no),
              'phone_no_2' => mysqli_real_escape_string($data->con, $phone_no_2),
              'fax_no' => mysqli_real_escape_string($data->con, $fax_no),
              'email_address' => mysqli_real_escape_string($data->con, $email_address),
              'email_address_2' => mysqli_real_escape_string($data->con, $email_address_2),
              'logo' => mysqli_real_escape_string($data->con, $logo),
              'status' => mysqli_real_escape_string($data->con, $status)
          );
          $runQuery = $data->insert('tb_organization', $insert_organization);

          if($runQuery)
            echo show_message(1,"Organization Added");
          else
            echo show_message(0,"Failed, Already Created!");
  }
}

}

function fill_organization_text()
{
  global $data;
  global $center_id;
  global $name;
  global $address;
  global $phone_no;
  global $phone_no_2;
  global $fax_no;
  global $email_address;
  global $email_address_2;
  global $logo;

  if (isset($_GET['c_id']) || (isset($_GET['e_name'])) || (isset($_GET['addr'])) || (isset($_GET['phone_no'])) || (isset($_GET['phone_no_2'])) || (isset($_GET['fax_no'])) || (isset($_GET['email_address'])) || (isset($_GET['email_address_2'])) || (isset($_GET['logo']))) {

    $center_id = $_GET['c_id'];
    $titleDecode = $_GET['e_name'];
    $addressDecoded = $_GET['addr'];
    $phone_no = $_GET['phone_no'];
    $phone_no_2 = $_GET['phone_no_2'];
    $fax_no = $_GET['fax_no'];
    $email_address = $_GET['email_address'];
    $email_address_2 = $_GET['email_address_2'];
    $logo = $_GET['logo'];
    $name = base64_decode($titleDecode);
    $address = base64_decode($addressDecoded);
  }
}

function edit_organization()
{
  global $data;
  global $center_id;

  if(isset($_POST['update_organization'])) {
    $name = $_POST['title'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];
    $phone_no_2 = $_POST['phone_no_2'];
    $fax_no = $_POST['fax_no'];
    $email_address = $_POST['email_address'];
    $email_address_2 = $_POST['email_address_2'];
    // $logo = $_POST['logo'];
    $target_dir = "assets/img/comp_logo/";
    $target_file = $target_dir . basename($_FILES["LogoUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(empty($_FILES["LogoUpload"]["name"])) {
        $run_Query = $data->query("update tb_organization set title='$name',address='$address',phone_no='$phone_no',phone_no_2='$phone_no_2',fax_no='$fax_no',email_address='$email_address',email_address_2='$email_address_2' where center_id='$center_id'");
        if($run_Query) {
          echo show_message(1,"Record Updated!");
          redirect("./add_organization","_self");
        }
        else
          echo show_message(0,"Update Fail, Try Again Later");
      }
      else {
        $check = getimagesize($_FILES["LogoUpload"]["tmp_name"]);
        if($check !== false) {
            echo show_message(1,"File is an image - " . $check["mime"] . ".");
            $uploadOk = 1;
        } else {
            echo show_message(0,"File is not an image!");
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo show_message(0,"Sorry, file already exists!");
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["LogoUpload"]["size"] > 500000) {
            echo show_message(0,"Sorry, your file is too large!");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo show_message(0,"Sorry, only JPG, JPEG, PNG & GIF files are allowed!");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo show_message(0,"Sorry, your file was not uploaded!");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["LogoUpload"]["tmp_name"], $target_file)) {

                $logo = basename($_FILES["LogoUpload"]["name"]);
                
            } else {
                echo show_message(0,"Error in uploading Logo!");
                echo redirect('./add_organization','_self');
            }
        
            $run_Query = $data->query("update tb_organization set title='$name',address='$address',phone_no='$phone_no',phone_no_2='$phone_no_2',fax_no='$fax_no',email_address='$email_address',email_address_2='$email_address_2',logo='$logo' where center_id='$center_id'");

            if($run_Query) {
              echo show_message(1,"Record Updated!");
              redirect("./add_organization","_self");
            }
            else
              echo show_message(0,"Update Fail, Try Again Later");
          }
          
      }
        

  }
}

function delete_organization()
{
  global $data;
  if (isset($_GET['c_d_id'])) {
    $center_id = $_GET['c_d_id'];

    $run_Query = $data->query("update tb_organization set status=0 where center_id='$center_id'");

    if($run_Query) {
      echo show_message(0,"Record Deleted!");
      redirect("./add_organization","_self");
    }
    else
      echo show_message(0,"Update Fail, Try Again Later");
  }
}

// function daily_status_report_dateBWsearch($to,$from,$portion,$country)
// {    
//   global $data;

//     $to_strd=date("Y-m-d",strtotime($to));
//     $from_strd=date("Y-m-d",strtotime($from));
//     $result_string = "'" . str_replace(",", "','", $country) . "'";

//     echo "<div class='col-md-8'><div class='alert alert-secondary alert-dismissible fade show' role='alert'>
//                   <span class='alert-icon'><i class='ni ni-like-2'></i></span>
//                   <span class='alert-text'><strong>Success! </strong>You have searched for: <strong> $to, $from, $portion, $result_string</strong></span>
//                   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//                     <span aria-hidden='true'>&times;</span>
//                   </button>
//                 </div></div>";

//     if($portion == "A-B") {
//       $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date,print_report_portion,medical_status from tb_registration where (reg_date >= '$to_strd' AND reg_date <= '$from_strd') and country IN($result_string) order by print_report_portion DESC");

//       while ($rows = mysqli_fetch_array($process_query)) {
//           $REG_DATE = $rows['reg_date'];
//           $Reg_date=date("d-m-Y",strtotime($REG_DATE));
//           $SERIAL = $rows['serial_no'];
//           $CAND_NAME = $rows['candidate_name'];
//           $SOF = $rows['son_of'];
//           $PP_NO = $rows['passport_no'];
//           $COUNTRY = $rows['country'];
//           $AGENCY = $rows['agency'];
//           $PRP = $rows['print_report_portion'];
//           $MEDICAL_STATUS = $rows['medical_status'];
          
//             echo "<tr>";                
//                echo "<td>$Reg_date</td>";
//                echo "<td>$SERIAL</td>";
//                echo "<td>$CAND_NAME</td>";
//                echo "<td>$SOF</td>";
//                echo "<td>$PP_NO</td>";
//                echo "<td>$COUNTRY</td>";
//                echo "<td>$AGENCY</td>";
//                echo "<td>$PRP</td>";
//                echo "<td>$MEDICAL_STATUS</td>";
//             echo "</tr>";
//       }
//     }

//     else {
//       $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where (reg_date >= '$to_strd' AND reg_date <= '$from_strd') and print_report_portion='$portion' and country IN($result_string)");

//         while ($rows = mysqli_fetch_array($process_query)) {
//           $REG_DATE = $rows['reg_date'];
//           $Reg_date=date("d-m-Y",strtotime($REG_DATE));
//           $SERIAL = $rows['serial_no'];
//           $CAND_NAME = $rows['candidate_name'];
//           $SOF = $rows['son_of'];
//           $PP_NO = $rows['passport_no'];
//           $COUNTRY = $rows['country'];
//           $AGENCY = $rows['agency'];
//           $PRP = $rows['print_report_portion'];
//           $MEDICAL_STATUS = $rows['medical_status'];
         
          
//             echo "<tr>";                
//                echo "<td>$Reg_date</td>";
//                echo "<td>$SERIAL</td>";
//                echo "<td>$CAND_NAME</td>";
//                echo "<td>$SOF</td>";
//                echo "<td>$PP_NO</td>";
//                echo "<td>$COUNTRY</td>";
//                echo "<td>$AGENCY</td>";
//                echo "<td>$PRP</td>";
//                echo "<td>$MEDICAL_STATUS</td>";
//             echo "</tr>"; 
//         }
//     }

// }

function daily_status_report_dateBWsearch($to='',$from='',$portion,$country)
{    
  global $data;

    $to_strd=date("Y-m-d",strtotime($to));
    $from_strd=date("Y-m-d",strtotime($from));
    $result_string = "'" . str_replace(",", "','", $country) . "'";

    echo "<div class='col-md-8'><div class='alert alert-secondary alert-dismissible fade show' role='alert'>
                  <span class='alert-icon'><i class='ni ni-like-2'></i></span>
                  <span class='alert-text'><strong>Success! </strong>You have searched for: <strong> $to, $from, $portion, $result_string</strong></span>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div></div>";

    if($portion == "A-B") {
      $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date,print_report_portion,medical_status from tb_registration where (reg_date >= '$to_strd' AND reg_date <= '$from_strd') and country IN($result_string) order by print_report_portion DESC");

      while ($rows = mysqli_fetch_array($process_query)) {
          $REG_DATE = $rows['reg_date'];
          $Reg_date=date("d-m-Y",strtotime($REG_DATE));
          $SERIAL = $rows['serial_no'];
          $CAND_NAME = $rows['candidate_name'];
          $SOF = $rows['son_of'];
          $PP_NO = $rows['passport_no'];
          $COUNTRY = $rows['country'];
          $AGENCY = $rows['agency'];
          $PRP = $rows['print_report_portion'];
          $MEDICAL_STATUS = $rows['medical_status'];
          
            echo "<tr>";                
               echo "<td>$Reg_date</td>";
               echo "<td>$SERIAL</td>";
               echo "<td>$CAND_NAME</td>";
               echo "<td>$SOF</td>";
               echo "<td>$PP_NO</td>";
               echo "<td>$COUNTRY</td>";
               echo "<td>$AGENCY</td>";
               echo "<td>$PRP</td>";
               echo "<td>$MEDICAL_STATUS</td>";
            echo "</tr>";
      }
    } 

    else if($portion == "B") {
        $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where print_report_portion='$portion' and country IN($result_string)");

        while ($rows = mysqli_fetch_array($process_query)) {
          $REG_DATE = $rows['reg_date'];
          $Reg_date=date("d-m-Y",strtotime($REG_DATE));
          $SERIAL = $rows['serial_no'];
          $CAND_NAME = $rows['candidate_name'];
          $SOF = $rows['son_of'];
          $PP_NO = $rows['passport_no'];
          $COUNTRY = $rows['country'];
          $AGENCY = $rows['agency'];
          $PRP = $rows['print_report_portion'];
          $MEDICAL_STATUS = $rows['medical_status'];
         
          
            echo "<tr>";                
               echo "<td>$Reg_date</td>";
               echo "<td>$SERIAL</td>";
               echo "<td>$CAND_NAME</td>";
               echo "<td>$SOF</td>";
               echo "<td>$PP_NO</td>";
               echo "<td>$COUNTRY</td>";
               echo "<td>$AGENCY</td>";
               echo "<td>$PRP</td>";
               echo "<td>$MEDICAL_STATUS</td>";
            echo "</tr>"; 
        }
    }

    else {
      $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where (reg_date >= '$to_strd' AND reg_date <= '$from_strd') and print_report_portion='$portion' and country IN($result_string)");

        while ($rows = mysqli_fetch_array($process_query)) {
          $REG_DATE = $rows['reg_date'];
          $Reg_date=date("d-m-Y",strtotime($REG_DATE));
          $SERIAL = $rows['serial_no'];
          $CAND_NAME = $rows['candidate_name'];
          $SOF = $rows['son_of'];
          $PP_NO = $rows['passport_no'];
          $COUNTRY = $rows['country'];
          $AGENCY = $rows['agency'];
          $PRP = $rows['print_report_portion'];
          $MEDICAL_STATUS = $rows['medical_status'];
         
          
            echo "<tr>";                
               echo "<td>$Reg_date</td>";
               echo "<td>$SERIAL</td>";
               echo "<td>$CAND_NAME</td>";
               echo "<td>$SOF</td>";
               echo "<td>$PP_NO</td>";
               echo "<td>$COUNTRY</td>";
               echo "<td>$AGENCY</td>";
               echo "<td>$PRP</td>";
               echo "<td>$MEDICAL_STATUS</td>";
            echo "</tr>"; 
        }
    }

}


function daily_status_history() 
{    
    global $data;
                
        $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration LIMIT 0,49");
        while ($rows = mysqli_fetch_array($process_query)) {
          $REG_DATE = $rows['reg_date'];
          $Reg_date=date("d-m-Y",strtotime($REG_DATE));
          $SERIAL = $rows['serial_no'];
          $CAND_NAME = $rows['candidate_name'];
          $SOF = $rows['son_of'];
          $PP_NO = $rows['passport_no'];
          $COUNTRY = $rows['country'];
          $AGENCY = $rows['agency'];
          $PRP = $rows['print_report_portion'];
          $MEDICAL_STATUS = $rows['medical_status'];
          
            echo "<tr>";                
               echo "<td>$Reg_date</td>";
               echo "<td>$SERIAL</td>";
               echo "<td>$CAND_NAME</td>";
               echo "<td>$SOF</td>";
               echo "<td>$PP_NO</td>";
               echo "<td>$COUNTRY</td>";
               echo "<td>$AGENCY</td>";
               echo "<td>$PRP</td>";
               echo "<td>$MEDICAL_STATUS</td>";
            echo "</tr>";                       
          
        }

}

// function daily_status_report_pdf($fromdate="",$todate="",$portion,$countries="")
// {
//   global $data;
//   if($fromdate == "" && $todate == "" && $countries == "" && $portion == "A-B")
//   {
//       $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date, print_report_portion,medical_status from tb_registration order by print_report_portion DESC");
//       //SELECT DISTINCT MONTHNAME(t.reg_date) from tb_registration t  GROUP by t.medical_status,MONTH(t.reg_date) ORDER by t.reg_date ASC
//   }
//   else
//   {
//       $to_strd=date("Y-m-d",strtotime($todate));
//       $from_strd=date("Y-m-d",strtotime($fromdate));
//       $result_string = "'" . str_replace(",", "','", $countries) . "'";
//       if($portion == 'A') {
//         //printing A records of all dates
//         $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date,print_report_portion,medical_status from tb_registration where print_report_portion='A' and (reg_date >= '$to_strd' AND reg_date <= '$from_strd')  and country IN($result_string) order by serial_no");
//         //old query
//         // $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where print_report_portion='A' and country IN($result_string) order by print_report_portion DESC");
//       } else if($portion == 'B'){
//         //first printing B records of all dates
//         $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date,print_report_portion,medical_status from tb_registration where print_report_portion='B' and (reg_date >= '$to_strd' AND reg_date <= '$from_strd')  and country IN($result_string) order by serial_no");
//       } else {
//         // echo "<script>alert('hi B')</script>";
//         $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where (reg_date >= '$to_strd' AND reg_date <= '$from_strd') and print_report_portion='B' and country IN($result_string) order by serial_no");
//       }
//       /*$process_query = $data->query("select r.passport_no, r.candidate_name, r.son_of, r.cnic, r.country, r.agency, r.serial_no, r.reg_date, r.print_report_portion, l.lab_status, m.medical_status, x.xray_status from tb_registration r, tb_lab_result l, tb_xray_result x, tb_medical m where r.reg_id=m.reg_id and r.reg_id=x.reg_id and r.country IN($result_string) group by print_report_portion DESC");*/
//       //$rows_array = mysqli_fetch_array($process_query);
//   }
//   return $process_query;
// }

function daily_status_report_pdf($fromdate="",$todate="",$portion,$countries="")
{
  global $data;

  if($fromdate == "" && $todate == "" && $countries == "" && $portion == "A-B")
  {

      $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date, print_report_portion,medical_status from tb_registration order by print_report_portion DESC");
      //SELECT DISTINCT MONTHNAME(t.reg_date) from tb_registration t  GROUP by t.medical_status,MONTH(t.reg_date) ORDER by t.reg_date ASC

  }
  else
  {

      $to_strd=date("Y-m-d",strtotime($todate));
      $from_strd=date("Y-m-d",strtotime($fromdate));
      $result_string = "'" . str_replace(",", "','", $countries) . "'";

      if($portion == 'A') {
        //printing A records of all dates
        $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date,print_report_portion,medical_status from tb_registration where print_report_portion='A' and (reg_date >= '$to_strd' AND reg_date <= '$from_strd')  and country IN($result_string) order by serial_no");
        //old query
        // $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where print_report_portion='A' and country IN($result_string) order by print_report_portion DESC");
      } else if($portion == 'B'){
        //first printing B records of all dates
        $process_query = $data->query("select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date,print_report_portion,medical_status from tb_registration where print_report_portion='B' and country IN($result_string) order by serial_no");
        // old query
        // select passport_no,candidate_name,son_of,country,agency,serial_no,reg_date,print_report_portion,medical_status from tb_registration where print_report_portion='B' and (reg_date >= '$to_strd' AND reg_date <= '$from_strd')  and country IN($result_string) order by serial_no
      } else {
        // echo "<script>alert('hi B')</script>";
        $process_query = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where print_report_portion='B' and country IN($result_string) order by serial_no");

        
      }

      
      /*$process_query = $data->query("select r.passport_no, r.candidate_name, r.son_of, r.cnic, r.country, r.agency, r.serial_no, r.reg_date, r.print_report_portion, l.lab_status, m.medical_status, x.xray_status from tb_registration r, tb_lab_result l, tb_xray_result x, tb_medical m where r.reg_id=m.reg_id and r.reg_id=x.reg_id and r.country IN($result_string) group by print_report_portion DESC");*/
      //$rows_array = mysqli_fetch_array($process_query);  
  }
  
  return $process_query;
}


function daily_status_report_pdf_A($fromdate="",$todate="",$portion="",$countries=""){
  global $data;
      $to_strd=date("Y-m-d",strtotime($todate));
      $from_strd=date("Y-m-d",strtotime($fromdate));
      $result_string = "'" . str_replace(",", "','", $countries) . "'";

  $process_query_for_A = $data->query("select passport_no, candidate_name, son_of, country, agency, serial_no, reg_date, print_report_portion, medical_status from tb_registration where print_report_portion='A' and (reg_date >= '$to_strd' AND reg_date <= '$from_strd')  and country IN($result_string) order by serial_no");
  return $process_query_for_A;

}

function login(){

  global $data;
  if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $isvalid=0;

    $check_user = $data->query("select * from user where user_name='$username'");
    while ($row=mysqli_fetch_array($check_user)) {

          $user_password = $row['user_password'];

          if(password_verify($password,$user_password)) {
            
            $login_id = $row['user_id'];
            $login_name = $row['user_name'];
            $center_id = $row['center_id'];
            $status = $row['status'];
            $isvalid = 1;
            
          }
        }

      if($isvalid == 1){

        if($status == 1){

           $login_array = $arrayName = array(
          'user_id' => $login_id,
          'login_user' => $login_name,
          'center_id' => $center_id,
           );

          $_SESSION['user_login'] = $login_array;

          echo  show_message(1,"Logged In");
          redirect('index','_self');

        }else{
          //inactive user
          echo show_message(0,"User Inactive");
        }

      }else{
        echo show_message(0,"Invalid Credentials");
      }


  }

}
function get_monthly_report_pdf($months_arr,$year)
{
  global $data;
  global $current_year;

    if($months_arr==1) {
       $process_query = $data->query("select medical_status,count(t.medical_status) as total,MONTHNAME(t.reg_date) as MONTH,YEAR(t.reg_date) as Years from tb_registration t WHERE YEAR(t.reg_date)='$year' and t.medical_status !='Pending' GROUP by MONTHNAME(t.reg_date),t.medical_status ORDER by MONTH(t.reg_date),t.medical_status ASC");
        
      return $process_query;
    }
    else {
      $result_string = "'" . str_replace(",", "','", $months_arr) . "'";

      // $process_query = $data->query("select medical_status,count(t.medical_status) as total,YEAR(t.reg_date) as years from tb_registration t WHERE YEAR(t.reg_date) in ($result_string) GROUP by t.medical_status,YEAR(t.reg_date) ORDER by t.reg_date ASC");
    $process_query = $data->query("select medical_status,count(t.medical_status) as total,MONTHNAME(t.reg_date) as MONTH,YEAR(t.reg_date) as Years from tb_registration t WHERE MONTHNAME(t.reg_date) in ($result_string) and YEAR(t.reg_date)=$year AND t.medical_status != 'Pending' GROUP by MONTHNAME(t.reg_date),t.medical_status ORDER by MONTH(t.reg_date),t.medical_status ASC");
        
      return $process_query;
    }
  
}

function get_quarterly_report_pdf($quarter_type)
{
  global $data;
  global $current_year;
    if($quarter_type==1) {
       $process_query = $data->query("select medical_status,count(t.medical_status) as total,MONTHNAME(t.reg_date) as MONTH,YEAR(t.reg_date) as Years from tb_registration t WHERE MONTHNAME(t.reg_date) in ('January','February','March') and YEAR(t.reg_date)='$current_year' AND t.medical_status != 'Pending' GROUP by MONTHNAME(t.reg_date),t.medical_status ORDER by MONTH(t.reg_date),t.medical_status ASC");
       return $process_query;

    }
    elseif ($quarter_type == 2){

      $process_query = $data->query("select medical_status,count(t.medical_status) as total,MONTHNAME(t.reg_date) as MONTH,YEAR(t.reg_date) as Years from tb_registration t WHERE MONTHNAME(t.reg_date) in ('April','May','June') and YEAR(t.reg_date)='$current_year' AND t.medical_status != 'Pending' GROUP by MONTHNAME(t.reg_date),t.medical_status ORDER by MONTH(t.reg_date),t.medical_status ASC");
       return $process_query;
      
    }
    elseif ($quarter_type == 3){
     
     $process_query = $data->query("select medical_status,count(t.medical_status) as total,MONTHNAME(t.reg_date) as MONTH,YEAR(t.reg_date) as Years from tb_registration t WHERE MONTHNAME(t.reg_date) in ('July','August','September') and YEAR(t.reg_date)='$current_year' AND t.medical_status != 'Pending' GROUP by MONTHNAME(t.reg_date),t.medical_status ORDER by MONTH(t.reg_date),t.medical_status ASC");
       return $process_query;

    }
    elseif ($quarter_type == 4) {

      $process_query = $data->query("select medical_status,count(t.medical_status) as total,MONTHNAME(t.reg_date) as MONTH,YEAR(t.reg_date) as Years from tb_registration t WHERE MONTHNAME(t.reg_date) in ('October','November','December') and YEAR(t.reg_date)='$current_year' AND t.medical_status != 'Pending' GROUP by MONTHNAME(t.reg_date),t.medical_status ORDER by MONTH(t.reg_date),t.medical_status ASC");
       return $process_query;
    }
  
}

function get_yearly_report_pdf($years_arr)
{
  global $data;
  global $today_date;
  $result_string = "'" . str_replace(",", "','", $years_arr) . "'";

    // $process_query = $data->query("select medical_status,count(t.medical_status) as total,YEAR(t.reg_date) as years from tb_registration t WHERE YEAR(t.reg_date) in ($result_string) GROUP by t.medical_status,YEAR(t.reg_date) ORDER by t.reg_date ASC");
  $process_query = $data->query("select medical_status,count(t.medical_status) as total,YEAR(t.reg_date) as years from tb_registration t WHERE YEAR(t.reg_date) in ($result_string) and t.medical_status != 'Pending' and t.medical_status != 'In Process' GROUP by t.medical_status,YEAR(t.reg_date) ORDER by t.medical_status ASC");
      
    return $process_query;
}

function get_summary_report_pdf($years_arr=""){
  global $data;
  global $today_date;
  $result_string = "'" . str_replace(",", "','", $years_arr) . "'";

    // $process_query = $data->query("select medical_status,count(t.medical_status) as total,YEAR(t.reg_date) as years from tb_registration t WHERE YEAR(t.reg_date) in ($result_string) GROUP by t.medical_status,YEAR(t.reg_date) ORDER by t.reg_date ASC");
  $process_query = $data->query("select MONTHNAME(t.reg_date) as monthname,Month(t.reg_date) as month,YEAR(t.reg_date) as year
from tb_registration t
where YEAR(t.reg_date) in ($result_string) 
GROUP by Month(t.reg_date)");
      
    return $process_query;

}

function get_summary_report_month_pdf($month,$year){
  global $data;
  global $today_date;

  $process_query2 = $data->query("select  t.reg_date,count(*) as total_registration
from tb_registration t
where Month(t.reg_date) = '$month'
and YEAR(t.reg_date) = '$year' 
GROUP by t.reg_date");
      
  return $process_query2;

}

function get_searched_lab_record($search_by_date) 
{    
  global $data;

    $search_by_date_strd=date("Y-m-d",strtotime($search_by_date));
    
     $process_query = $data->query("select r.reg_date,r.serial_no,l.ALT from tb_lab_result l, tb_registration r where r.reg_date='$search_by_date_strd' and l.barcode=r.barcode_no");

        while ($rows = mysqli_fetch_array($process_query)) {
          $REG_DATE = $rows['reg_date'];
          $SERIAL_NO = $rows['serial_no'];
          $ALT = $rows['ALT'];
          
            echo "<tr>";                
               echo "<td>$REG_DATE</td>";
               echo "<td>$SERIAL_NO</td>";
               echo "<td>$ALT</td>";
            echo "</tr>";                    
    }

}

function get_lab_register_report_pdf($resultDate)
{
  global $data;

    $res_date=date("Y-m-d",strtotime($resultDate));

      // $process_query = $data->query("select r.serial_no,r.candidate_name,l.HCV,l.HBsAg,l.HIV,l.VDRL,l.TPHA,l.RBS,l.BIL,l.ALT,l.AST,l.ALK,l.Creatinine,l.blood_group,l.Haemoglobin,l.Malaria,l.Micro_filariae,l.sugar,l.albumin,l.helminthes,l.OVA,l.CYST,l.TB,l.pregnancy from tb_lab_result l, tb_registration r where r.reg_date='$res_date'");

      $process_query = $data->query("select DISTINCT SUBSTRING(l.barcode,1,4) as code,r.serial_no,r.candidate_name,l.HCV,l.HBsAg,l.HIV,l.VDRL,l.TPHA,l.RBS,l.BIL,l.ALT,l.AST,l.ALK,l.Creatinine,l.blood_group,l.Haemoglobin,l.Malaria,l.Micro_filariae,l.sugar,l.albumin,l.helminthes,l.OVA,l.CYST,l.TB,l.pregnancy from tb_registration r INNER JOIN tb_lab_sticker s on s.reg_id = r.reg_id INNER join tb_lab_result l on (l.reg_id = r.reg_id || s.sticker_value_2 = l.barcode) where r.reg_date='$res_date' order by r.serial_no ASC");

    return $process_query;
    
}

function get_process_details() 
{    
  global $data;
  global $today_date;

     $process_query = $data->query("select r.token_no,r.candidate_name,p.process_desc,q.status from tb_queue_manager q, tb_registration r, medical_process p where q.process_id=p.process_id and r.token_no=q.token_no and q.process_date='$today_date'");
        $i=1;
        while ($rows = mysqli_fetch_array($process_query)) {
          $token_no = $rows['token_no'];
          $candidate_name = $rows['candidate_name'];
          $process_desc = $rows['process_desc'];
          $status = $rows['status'];
          
            echo "<tr>";
               echo "<td>$i</td>";            
               echo "<td>$candidate_name</td>";
               echo "<td>$token_no</td>";
               echo "<td>$process_desc</td>";
               echo "<td>$status</td>";
            echo "</tr>";
        $i++;    
    }

}

function get_slip_expiry_report_pdf($regDate,$country_arr)
{
  global $data;
  global $today_date;

    $reg_date=date("Y-m-d",strtotime($regDate));
    // $arr=array($country_arr);
    $countries = implode("','",$country_arr);


      $process_query = $data->query("select passport_no,serial_no,place_of_issue,slip_issue_date,slip_expiry_date,remarks from tb_registration where reg_date='$reg_date' and country in('$countries') order by serial_no");

    return $process_query;
    
}

function get_summary_report_repeat_pdf()
{
  global $data;
  global $today_date;
  // $result_string = "'" . str_replace(",", "','", $years_arr) . "'";

    // $process_query = $data->query("select medical_status,count(t.medical_status) as total,YEAR(t.reg_date) as years from tb_registration t WHERE YEAR(t.reg_date) in ($result_string) GROUP by t.medical_status,YEAR(t.reg_date) ORDER by t.reg_date ASC");
  $process_query = $data->query("select t.country,count(*) as total_registration
                            from tb_registration t where t.country LIKE 'repeat%'
                            GROUP by t.country");
      
    return $process_query;

}


function get_daily_summary_report_pdf(){
  global $data;
  global $today_date;

//      old
//     $process_query2 = $data->query("select t.country,count(*) as total_registration
// from tb_registration t
// where t.reg_date = '$today_date' and t.country NOT LIKE 'repeat%'
// GROUP by t.country");

    $process_query2 = $data->query("select t.country,count(*) as total_registration
from tb_registration t
where t.reg_date = '$today_date'
GROUP by t.country");
      
  return $process_query2;

}

function get_code_list_report_pdf($codeDate)
{
  global $data;
    $process_query = $data->query("select distinct serial_no,SUBSTRING(sticker_value_2,1,5)as code from tb_lab_sticker where reg_date ='$codeDate' and sticker_value_2 is not null order by serial_no");

    return $process_query;

//  total cout countries with serial prefex
//       $process_query2 = "select count(*) as total,SUBSTRING(serial_no,5,1) as country_code from tb_lab_sticker 
// GROUP by SUBSTRING(serial_no,5,1)"
    
}

function selectCandidateResults()
{
  global $data;

  $mo_medical_status="";
  $x_medical_status="";
  $l_medical_status="";
  $r_a = array();
  $r_b = array();
  $mo_a = array();
  $mo_b = array();
  $x_a = array();
  $x_b = array();
  $l_a = array();
  $l_b = array();

    $reg_users = mysqli_query($data->con,"select reg_id,serial_no,reg_date,passport_no,medical_status from tb_registration where passport_no IN('JS5193501','XM1800802','GY6174811','CJ1717951','AN5167812','BF3947491','FA1518012')");

    foreach ($reg_users as $key => $value) {

      $reg_id = $value['reg_id'];
      $r_b[$reg_id] = $reg_id;
      $r_b['reg_medical_status'] = $value['medical_status'];
      array_push($r_a,$r_b);
      // $reg_id = 381;

      // Medical Officer
      $mo_result = mysqli_query($data->con,"SELECT `reg_id`,`medical_status` FROM `tb_medical` WHERE reg_id='$reg_id'");

      $mo_count = mysqli_num_rows($mo_result);

      if($mo_count > 0) {

        while($row = mysqli_fetch_array($mo_result) ){
            // $mo_b['mo'] = "MO results";
            $mo_b[$reg_id] = $row['reg_id'];
            $mo_b['medical_status'] = $row['medical_status'];
            array_push($mo_a,$mo_b);
        }

      }

      // Xray Result
      $x_result = mysqli_query($data->con,"SELECT `reg_id`,`xray_status` FROM `tb_xray_result` WHERE `reg_id`='$reg_id'");

      $x_count = mysqli_num_rows($x_result);

      if($x_count > 0) {

        while($row = mysqli_fetch_array($x_result) ){
            // $x_b = "xray results";
            $x_b[$reg_id] = $row['reg_id'];
            $x_b['xray_status'] = $row['xray_status'];
            array_push($x_a,$x_b);
        }

      }

      // Lab Sticker
      $s_result = mysqli_query($data->con,"SELECT `reg_id`,`sticker_value_2` FROM `tb_lab_sticker` WHERE `reg_id`='$reg_id'");

      $s_count = mysqli_num_rows($s_result);

      if($s_count > 0) {

        while($row = mysqli_fetch_array($s_result) ){
            $s_reg_id = $row['reg_id'];
            $s_sticker_value_2 = $row['sticker_value_2'];

            if($s_sticker_value_2 != null) {

              // Lab Result
              $l_result = mysqli_query($data->con,"SELECT `barcode`,`lab_status` FROM `tb_lab_result` WHERE `barcode`='$s_sticker_value_2'");

              $l_count = mysqli_num_rows($l_result);

              if($l_count > 0) {

                while($row = mysqli_fetch_array($l_result) ){
                    // $l_b = "lab results";
                    $l_b[$reg_id] = $row['barcode'];
                    $l_b['lab_status'] = $row['lab_status'];
                    array_push($l_a,$l_b);

                }

              }
            }

        }
      }

  }
      print_r($r_a);
      echo "<br><br>";
      print_r($mo_a);
      echo "<br><br>";
      print_r($x_a);
      echo "<br><br>";
      print_r($l_a);

}

function medical_status_verify($reg_id)
{
  global $data;

  $mo_medical_status="";
  $x_medical_status="";
  $l_medical_status="";


      // Medical Officer
      $mo_result = mysqli_query($data->con,"SELECT `reg_id`,`medical_status` FROM `tb_medical` WHERE reg_id='$reg_id'");

      $mo_count = mysqli_num_rows($mo_result);

      if($mo_count > 0) {

        while($row = mysqli_fetch_array($mo_result) ){
            $mo_reg_id = $row['reg_id'];
            $mo_medical_status = $row['medical_status'];
        }

      }

      // Xray Result
      $x_result = mysqli_query($data->con,"SELECT `reg_id`,`xray_status` FROM `tb_xray_result` WHERE `reg_id`='$reg_id'");

      $x_count = mysqli_num_rows($x_result);

      if($x_count > 0) {

        while($row = mysqli_fetch_array($x_result) ) {
            $x_reg_id = $row['reg_id'];
            $x_medical_status = $row['xray_status'];
        }

      }

      // Lab Sticker
      $s_result = mysqli_query($data->con,"SELECT `reg_id`,`sticker_value_2` FROM `tb_lab_sticker` WHERE `reg_id`='$reg_id'");

      $s_count = mysqli_num_rows($s_result);

      if($s_count > 0) {

        while($row = mysqli_fetch_array($s_result) ){
            $s_reg_id = $row['reg_id'];
            $s_sticker_value_2 = $row['sticker_value_2'];

            if($s_sticker_value_2 != null) {

              // Lab Result
              $l_result = mysqli_query($data->con,"SELECT `barcode`,`lab_status` FROM `tb_lab_result` WHERE `barcode`='$s_sticker_value_2'");

              $l_count = mysqli_num_rows($l_result);

              if($l_count > 0) {

                while($row = mysqli_fetch_array($l_result) ){
                    $l_barcode = $row['barcode'];
                    $l_medical_status = $row['lab_status'];

                }

              }
            }

        }
      }

      if($mo_medical_status == "FIT" && $x_medical_status == "FIT" && $l_medical_status == "FIT"){
                         
            update_medical_status_script($reg_id,'FIT');
            // echo "<script>alert('fit')</script>";
            
         }
         elseif ($mo_medical_status == "FIT" && $x_medical_status == "FIT" && $l_medical_status == ""){

            update_medical_status_script($reg_id,'In Process');
            // echo "<script>alert('in Process1')</script>";
            
         }
         elseif ($mo_medical_status == "FIT" && $x_medical_status == "" && $l_medical_status == "FIT"){

            update_medical_status_script($reg_id,'In Process');
            // echo "<script>alert('in Process2')</script>";
            
         }
         elseif ($mo_medical_status == "FIT" && $x_medical_status == "FIT" && $l_medical_status == "UNFIT"){

            update_medical_status_script($reg_id,'UNFIT');
            // echo "<script>alert('in Process3')</script>";
            
         }
         elseif ($mo_medical_status == "FIT" && $x_medical_status == "UNFIT" && $l_medical_status == "FIT"){

            update_medical_status_script($reg_id,'UNFIT');
            // echo "<script>alert('in Process4')</script>";
            
         }
         elseif ($mo_medical_status == "" && $x_medical_status == "FIT" && $l_medical_status == "FIT"){

            update_medical_status_script($reg_id,'In Process');
            // echo "<script>alert('in Process5')</script>";
            
         }
         elseif ($mo_medical_status == "" && $x_medical_status == "" && $l_medical_status == "FIT"){

            update_medical_status_script($reg_id,'In Process');
            // echo "<script>alert('in Process5')</script>";
            
         }
         elseif ($mo_medical_status == "UNFIT" || $x_medical_status == "UNFIT" || $l_medical_status == "UNFIT"){

            update_medical_status_script($reg_id,'UNFIT');
            // echo "<script>alert('pending')</script>";
            
         }
         else{

            update_medical_status_script($reg_id,'In Process');
            // echo "<script>alert('In Process6')</script>";
            
         }

}

function update_medical_status_script($reg_id,$status){
  global $data;
  $upd_status = $data->query("update tb_registration set medical_status='$status' where reg_id='$reg_id'");

}


function update_medical_status_final($regid){
  //29/12/2020 by zaid:
  global $data;

  $get_results = $data->query("SELECT distinct tr.serial_no,tr.passport_no,tr.reg_date,tr.reg_id,tm.medical_status as mo_status,xr.xray_status,tlr.lab_status,tr.medical_status 
FROM tb_registration tr
left JOIN tb_medical tm on tm.reg_id=tr.reg_id
left JOIN tb_xray_result xr on xr.reg_id=tr.reg_id
left JOIN tb_lab_sticker tsr on tsr.reg_id=tr.reg_id
left join tb_lab_result tlr on tsr.sticker_value_2=tlr.barcode

where tr.reg_id = '$regid'");


while($row=mysqli_fetch_array($get_results)){


  if($row['xray_status'] == 'UNFIT' || $row['lab_status'] == 'UNFIT'){

    $upd_status=mysqli_query($data->con,
      "update tb_registration set medical_status='UNFIT' where reg_id='".$row['reg_id']."'");

  }elseif($row['xray_status'] == 'FIT' && $row['lab_status'] == 'FIT'){

    $upd_status=mysqli_query($data->con,"update tb_registration set medical_status='FIT' where reg_id='".$row['reg_id']."'");

  }else{

  }

}




}


function fill_xray_result()
{
  global $data;
  global $center_id;
  global $xray_chest;
  global $xray_notes;
  global $reg_id;
  global $xray_date;

  if (isset($_GET['e_xray_chest']) || (isset($_GET['e_xray_date']))) {

    
    $xray_chestDecode = $_GET['e_xray_chest'];
    $xray_notesDecode = $_GET['e_xray_notes'];
    $reg_idDecode = $_GET['e_reg_id'];
    $xray_date = $_GET['e_xray_date'];
    
    $xray_chest = base64_decode($xray_chestDecode);
    $xray_notes = base64_decode($xray_notesDecode);
    $reg_id = base64_decode($reg_idDecode);
    
  }
}


function upload_xray_result() {

  global $data;

  if(isset($_POST["cand_xray"])) {

    $serial = $_POST['serial2'];
    $xd=$_POST['xraydate2'];

      $exp_date = $_POST['xraydate2'];
      $exp_dat = str_replace('/', '-', $exp_date);
      $xray_date = date("Y-m-d",strtotime($exp_dat));
      $loginuser = $_POST['loginid'];
      $center_id = $_POST['center_id'];




        $record_check = $data->query("SELECT xr.reg_id FROM `tb_xray_result` xr 
                                        INNER JOIN tb_registration reg ON reg.reg_id = xr.reg_id
                                        WHERE reg.serial_no='$serial' AND reg.reg_date='$xray_date'");
        $count_rows = mysqli_num_rows($record_check);
            if($count_rows==0) {
                echo "<script>alert('No Record Found')</script>";
                echo "<script>window.open('xray_result','_self')</script>";
            }
            else {

            $reg_arr = mysqli_fetch_array($record_check);
            $regId = $reg_arr['reg_id'];
            
            $previous_records = $data->query("SELECT * FROM `tb_xray_result` WHERE `reg_id`='$regId'");
            $check_rows = mysqli_num_rows($previous_records);

            if($check_rows > 0) {

              // echo show_message(1, "Record already exist!");

              echo '<div class="modal fade" id="modal-default" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-" role="document">
        <div class="modal-content" style="width:900px;">
          <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Candidate Previous Record</h6>
            <button type="button" class="btn btn-link  ml-auto" id="closeModal" onclick="closeModal()" data-dismiss="modal">Close</button>
          </div>
          <div class="modal-body">
            <div class="table-responsive py-2">
              <table class="table table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>S#</th>
                    <th>Xray Chest</th>
                    <th>Xray Notes</th>
                    <th>Xray Date</th>
                    <th>Created On</th>
                    <th>Xray Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>';
          
            $i = 1;
            while ($row_data = mysqli_fetch_array($previous_records)) {

                $reg_id = $row_data['reg_id'];
                $xray_chest = $row_data['xray_chest'];
                $xray_notes = $row_data['xray_notes'];
                $xray_date = $row_data['xray_date'];
                $created_on = $row_data['created_on'];
                $xray_status = $row_data['xray_status'];

                $xray_chestEncoded = base64_encode($xray_chest);
                $xray_notesEncoded = base64_encode($xray_notes);
                $reg_idEncoded = base64_encode($reg_id);

                // echo '<script>alert("Previous record found!")</script>';
                echo "<tr>";                
                       echo "<td>$i</td>";
                       echo "<td>$xray_chest</td>";
                       echo "<td>$xray_notes</td>";
                       echo "<td>$xray_date</td>";
                       echo "<td>$created_on</td>";
                       echo "<td>$xray_status</td>";
                       if($loginuser==19) {
                          echo "<td><a href=edit_xray?e_xray_chest=$xray_chestEncoded&&e_xray_notes=$xray_notesEncoded&&e_reg_id=$reg_idEncoded&&e_xray_date=$xray_date target=_blank class='table-action' data-toggle='tooltip' data-original-title='Edit Xray'>";
                          echo "<i class='fas fa-user-edit'></i>";
                          echo "</a></td>";
                       } else {

                          echo "<td></td>";

                       }
                echo "</tr>";
                
                
               $i++;           
              }

            echo '</tbody>
                  </table>
                  </div>
                  </div>
                </div>
              </div>';
            echo "</div><script>$(document).ready(function() { $('#modal-default').modal('show'); });</script>";

           }
      
      }

    
  }

}


// function upload_xray_result() {

//   global $data;

//   if(isset($_POST["cand_xray"])) {

//     $serial = $_POST['serial2'];
//     $xd=$_POST['xraydate2'];

//       $exp_date = $_POST['xraydate2'];
//       $exp_dat = str_replace('/', '-', $exp_date);
//       $xray_date = date("Y-m-d",strtotime($exp_dat));
//       $loginuser = $_POST['loginid'];
//       $center_id = $_POST['center_id'];


//         $record_check = $data->query("SELECT xr.reg_id FROM `tb_xray_result` xr 
//                                         INNER JOIN tb_registration reg ON reg.reg_id = xr.reg_id
//                                         WHERE reg.serial_no='$serial' AND reg.reg_date='$xray_date'");
//         $count_rows = mysqli_num_rows($record_check);
//             if($count_rows==0) {
//                 echo "<script>alert('No Record Found')</script>";
//                 echo "<script>window.open('xray_result','_self')</script>";
//             }
//             else {

//             $reg_arr = mysqli_fetch_array($record_check);
//             $regId = $reg_arr['reg_id'];
            
//             $previous_records = $data->query("SELECT * FROM `tb_xray_result` WHERE `reg_id`='$regId'");
//             $check_rows = mysqli_num_rows($previous_records);

//             if($check_rows > 0) {
//               echo show_message(1, "Record already exist!");
//               echo '<div class="modal fade" id="modal-default" tabindex="-1" role="dialog">
//       <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
//         <div class="modal-content">
//           <div class="modal-header">
//             <h6 class="modal-title" id="modal-title-default">Candidate Previous Record</h6>
//             <button type="button" class="btn btn-link  ml-auto" id="closeModal" onclick="closeModal()" data-dismiss="modal">Close</button>
//           </div>
//           <div class="modal-body">
//             <div class="table-responsive py-2">
//               <table class="table table-flush">
//                 <thead class="thead-light">
//                   <tr>
//                     <th>S#</th>
//                     <th>Xray Chest</th>
//                     <th>Xray Notes</th>
//                     <th>Xray Date</th>
//                     <th>Created On</th>
//                     <th>Xray Status</th>
//                   </tr>
//                 </thead>
//                 <tbody>';
          
//             $i = 1;
//             while ($row_data = mysqli_fetch_array($previous_records)) {
                
//                 $xray_chest = $row_data['xray_chest'];
//                 $xray_notes = $row_data['xray_notes'];
//                 $xray_date = $row_data['xray_date'];
//                 // $process_name = "Xray Result";
//                 $created_on = $row_data['created_on'];
//                 $xray_status = $row_data['xray_status'];

//                 // echo '<script>alert("Previous record found!")</script>';
//                 echo "<tr>";                
//                        echo "<td>$i</td>";
//                        echo "<td>$xray_chest</td>";
//                        echo "<td>$xray_notes</td>";
//                        echo "<td>$xray_date</td>";
//                        echo "<td>$created_on</td>";
//                        echo "<td>$xray_status</td>";
//                       echo "</tr>";
                
//                $i++;           
//               }

//             echo '</tbody>
//                   </table>
//                   </div>
//                   </div>
//                 </div>
//               </div>';
//             echo "</div><script>$(document).ready(function() { $('#modal-default').modal('show'); });</script>";

//            }
      
//       }

    
//   }

// }


?>