<?php 
include('include/functions.php'); 
$process_id=4;
error_reporting(0);
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,21);
}
?>

<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<body>

  <style type="text/css">
    #b_plus_container,#pending_container
    {
      display: none;
    }
  </style>
  
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
        <?php include_once('include/topnav.php'); ?>
    <!-- Header -->
    <!-- Header -->
    <form method="post" action="">
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Reports Module</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Print Report</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <?php
  $lab_progress = 0;
  $medical_progress = 0;
  $xray_progress = 0;
  $medicalstatus="";
  $labstatus ="";
  $xray_status ="";
 if(isset($_POST['find'])){

    $serial = $_POST['serial'];
    $exam_DAte = date('Y-m-d', strtotime($_POST['examination_date']));

    $get_cand_record = get_candidate_for_print_report($serial,$exam_DAte);

  }

if(isset($_POST['find2'])){

  $pp_no = $_POST['passport'];
  
   $get_cand_record = get_candidate_for_print_report_passport($pp_no);
}

 while ($row_data = mysqli_fetch_array($get_cand_record)){
        $regid = $row_data['reg_id'];
        $passport_no = $row_data['passport_no'];
        $candidate_name = $row_data['candidate_name'];
        $son_of = $row_data['son_of'];
        $country = $row_data['country'];
        $serial_no = $row_data['serial_no'];
        $barcode = $row_data['barcode_no'];
        $cnic = $row_data['cnic'];
        $reg_date = $row_data['reg_date'];
        $cand_img = $row_data['candidate_img'];
        $portion_value = $row_data['print_report_portion'];

      }

  $row_medical = registration_remarks($regid);
  while($row_data1 = mysqli_fetch_array($row_medical)){
        $reg_remarks = $row_data1['remarks'];
        $user_name = $row_data1['user_name'];
        $reg_created_at = $row_data1['created_at'];
  }

  $pp_check = pp_check_notification($regid);
  while($row_data2 = mysqli_fetch_array($pp_check)){
        $pp_user_name = $row_data2['user_name'];
        $pp_created_at = $row_data2['created_on'];
  }

  $medical_check = medical_check_notification($regid);
  $count_medical_check = mysqli_num_rows($medical_check);
  if($count_medical_check > 0){
    $medical_progress =100;
    while($row_data3 = mysqli_fetch_array($medical_check)){
        $color_vision = $row_data3['color_vision'];
        $medical_user_name = $row_data3['user_name'];
        $medical_created_at = $row_data3['created_at'];
        $medicalstatus = $row_data3['medical_status'];
    }
    // if($color_vision == 'DEFECTIVE'){

    // }
  }
  

  $lab_sticker = lab_check_sticker($regid);
  if($lab_sticker){
    $lab_progress = $lab_progress+50;

    while($row_data4 = mysqli_fetch_array($lab_sticker)){
        $sticker_user_name = $row_data4['user_name'];
        $sticker_created_at = $row_data4['created_on'];
        
    }

  }
  

  $lab_check = lab_check_notification($regid);
  $count_lab_check = mysqli_num_rows($lab_check);
  if($count_lab_check > 0){
    $lab_progress = $lab_progress+50;

    while($row_data4 = mysqli_fetch_array($lab_check)){
        $lab_user_name = $row_data4['user_name'];
        $lab_created_at = $row_data4['created_at'];
        $labstatus = $row_data4['lab_status'];
        
    }    
  }
  

  $xray_check = xray_notification($regid);
  $count_xray_check = mysqli_num_rows($xray_check);
  if($count_xray_check > 0){
    $xray_progress = $xray_progress+50;
    while($row_data5 = mysqli_fetch_array($xray_check)){
        $xray_user_name = $row_data5['user_name'];
        $xray_created_at = $row_data5['created_at'];
    }  
  }
  

  $xray_result = xray_result_notification($regid);
  $count_xray_result = mysqli_num_rows($xray_result);
  if($count_xray_result > 0){
     $xray_progress = $xray_progress+50;
      while($row_data5 = mysqli_fetch_array($xray_result)){
        $xray_result_user_name = $row_data5['user_name'];
        $xray_result_created_at = $row_data5['created_on'];
        $xray_status = $row_data5['xray_status'];
    }
  }
 

  $sample_result = sample_coll_notification($regid);
  while($row_data6 = mysqli_fetch_array($sample_result)){
        $sample_user_name = $row_data6['user_name'];
        $sample_created_at = $row_data6['collection_date'];
  }

  $report_issuance_Result = report_issuance_notification($regid);
  while($row_data6 = mysqli_fetch_array($sample_result)){
        $sample_user_name = $row_data6['user_name'];
        $sample_created_at = $row_data6['created_at'];
  }

  $count_cand_record=0;
  $cand_hist = candidate_history($passport_no);
  $count_hist = mysqli_num_rows($cand_hist);
  if($count_hist > 1){

    $count_cand_record = $count_hist;
    // while($row_hist = mysqli_fetch_array($cand_hist)){

    // }
  }

  ?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
                        
      <!-- div class row here -->

      <div class="row">
        <div class="col-lg-6">
          <div class="card-wrapper">

 <div class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body">
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                  
                </div>
            </div>
            <!-- Biometric Info -->
             <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">CANDIDATE INFO</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form action="" method="post">
                  <div class="d-flex justify-content-center">
                    <div class="col-md-6 align-self-center">
                      <div class="form-group">
                        <img src="assets/candidate_image/<?php echo $cand_img ?>" alt="..." class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <input class="form-control datepicker" type="text" placeholder="Date" id="examination_date" name="examination_date">
                          <span class="calendar-grid-58"></span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <input class="form-control" type="text" placeholder="Serial Number" id="serial" name="serial">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <input class="form-control" type="text" placeholder="Passport Number" id="pp_no" name="passport">
                      </div>
                    </div>
                  </div>
                    
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Name</label>  
                          <input class="form-control" type="text" name="cand_name" id="cand_name" value="<?php echo $candidate_name; ?>" readonly>
                          <input type="hidden" name="regid" id="regid" value="<?php echo $regid; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">Father Name</label>  
                        <input class="form-control" type="text" name="f_name" id="f_name" value="<?php echo $son_of; ?>" readonly>
                      </div>
                    </div>
                   </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">PP No</label>  
                        <input class="form-control" type="text" name="pp_no" id="passport_number" value="<?php echo $passport_no; ?>" readonly>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">CNIC</label>  
                        <input class="form-control" type="text" name="cnic_no" id="cnic_no" value="<?php echo $cnic; ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Country</label>
                        <input class="form-control" type="text" name="country" value="<?php echo $country; ?>" id="country" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Serial No</label>  
                          <input class="form-control" type="text" name="serial_no" id="serial_no" value="<?php echo $serial_no; ?>" readonly>
                          
                      </div>
                    </div>
                  </div>
                                    
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleFormControlTextarea1">X-Ray Remarks</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?php echo xray_remarks($regid); ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleFormControlTextarea1">MO Remarks</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?php echo mo_remarks($regid); ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">Registration Remarks</label>
                        <textarea class="form-control" rows="3" disabled><?php echo $reg_remarks; ?></textarea>
                      </div>
                    </div>
                  </div>
              
            <!--     <button type="button" id="printReport" class="btn btn-primary">
                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i> Save</span>
                  </button> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card-wrapper">
            <!-- Passport Info -->
            <div class="card">
              <!-- Card header -->
              <!-- <div class="card-header">
                <h3 class="mb-0">PASSPORT INFO</h3>
              </div> -->
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
              
                  <div class="row">
                    
                    <div class="col-md-2" style="padding-left: 15px;">
                      <div class="form-group">
                        <button type="submit" id="find" name="find" class="btn btn-primary">Find</button>
                      </div>
                    </div>
                    <div class="col-md-4" style="padding-left: 3px;">
                      <div class="form-group pull-left">
                        <button type="submit" id="find2" name="find2" class="btn btn-primary">Find with Passport</button>
                      </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px;">
                      <div class="form-group pull-left">
                        <a href="reports/medical_officer_report?serialno=<?php echo $serial_no; ?>" target="_blank"><button type="button" id="print" name="print" class="btn btn-primary">Print</button></a>
                      </div>
                    </div>

                    <div class="col-md-2" style="padding-left: 0px;">
                      <div class="form-group">
                        <button type="button" id="history" name="history" class="btn btn-primary" onclick="check_candidate_history()">History</button>
                        <?php if($count_cand_record > 1){
                          echo $count_hist.' Times';
                        }  ?>
                      </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 1px;">
                      <div class="form-group">
                        <a href="reports/embassay_report?ppno=<?php echo $passport_no; ?>" target="_blank"><button type="button" id="embassy_slip" name="embassy_slip" class="btn btn-success">Embassy Slip</button></a>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <?php
                  if(b_plus_rights($loginuser,21) == 1){
                  ?>
                    
                    <div class="col-md-6">
                      <span class="h1 font-weight-bold mb-0">B+</span>
                      
                      <label class="custom-toggle">
                        <input type="checkbox" value="bplus" id="bplus" <?php if ($portion_value == 'B'){?> checked="checked" <?php } ?> onchange="set_portion();">
                        <span class="custom-toggle-slider rounded-circle"></span>
                      </label>
                    </div>

                  <?php
                    }
                  ?>

                  <?php
                  if(status_pending_rights($loginuser,21) == 1){
                  ?>
                    <div class="col-md-6">
                      <span class="h2 font-weight-bold mb-0">Pending</span>
                      <label class="custom-toggle">
                        <input type="checkbox" value="Pending" id="pending" onclick="pending_status();">
                        <span class="custom-toggle-slider rounded-circle"></span>
                      </label>
                    </div>

                  <?php
                   }
                  ?>
                    <p id="portion_update"></p>
                  

                  
                  </div>
                </form>

              </div>
            </div>

            
    
      <div class="card">

        <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Candidate Status</h3>
          </div>
             
        <!-- Card body -->
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-2">
                  <h1><label>Status: &emsp;</label></h1>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <h1 class="display-2">
                    <?php
                       if($medicalstatus == 'FIT' && $xray_status == 'FIT' && $labstatus == 'FIT'){
                         
                          update_medical_status($regid,'FIT');
                          echo "<div class='badge badge-success d-block' id='medical_status'>FIT 
                                </div>";
                       }
                       elseif ($medicalstatus == "" || $xray_status == "" || $labstatus == ""){

                          update_medical_status($regid,'Pending');
                          echo "<div class='badge badge-danger d-block' id='medical_status'>Pending 
                                </div>";
                       }
                       elseif ($medicalstatus == 'Pending' || $xray_status == 'Pending' || $labstatus == 'Pending'){

                          update_medical_status($regid,'In Process');
                          echo "<div class='badge badge-danger d-block' id='medical_status'>In Process 
                                </div>";
                       }
                       else{

                          update_medical_status($regid,'UNFIT');
                          echo "<div class='badge badge-danger d-block' id='medical_status'>UNFIT 
                                </div>";
                        
                       }
                      ?>
                 
                  </h1>
                  </div>
                </div>
              </div>
            <div class="row">
              
            <div class="col-md-6">
              <div class="progress-wrapper">
                <div class="progress-info">
                  <div class="progress-label">
                    <i class="fa fa-plus-square text-info"></i>
                    <span class="rounded">LAB</span>
                  </div>
                  <div class="progress-percentage">
                    <span><?php echo $lab_progress; ?>%</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lab_progress.'%'; ?>;"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="progress-wrapper">
                <div class="progress-info">
                  <div class="progress-label">
                    <i class="fa fa-file-medical-alt text-green"></i>
                    <span class="rounded">MEDICAL</span>
                  </div>
                  <div class="progress-percentage">
                    <span><?php echo $medical_progress; ?>%</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $medical_progress.'%'; ?>"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="progress-wrapper">
                <div class="progress-info">
                  <div class="progress-label">
                    <i class="fa fa-x-ray text-danger"></i>
                    <span class="rounded">X-RAY</span>
                  </div>
                  <div class="progress-percentage">
                    <span><?php echo $xray_progress; ?>%</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $xray_progress.'%'; ?>"></div>
                </div>
              </div>
            </div>
           <!--  <div class="col-md-6">
              <div class="progress-wrapper">
                <div class="progress-info">
                  <div class="progress-label">
                    <span class="rounded">Task completed</span>
                  </div>
                  <div class="progress-percentage">
                    <span>59%</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 59%;"></div>
                </div>
              </div>
            </div> -->
            
          </div>
          </form>
        </div>
      </div>


          <!-- <- Timeline card ->
          <div class="card">
            <-- Card header ->
            <div class="card-header">
              <-- Title ->
              <h5 class="h3 mb-0">Latest notifications</h5>
            </div>
            <-- Card body ->
            <div class="card-body">
              <form>
              <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="fa fa-user-plus text-orange"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">Registration</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>2 hrs ago</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">Registration by noman</h6>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="fa fa-fingerprint text-green"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">PP Check</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>15-Jan-2019</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">PP checked by Ali</h6>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="ni ni-circle-08"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">Picture Scannig</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>15-Jan-2019</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">Picture Edit by Ali</h6>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="fa fa-file-medical-alt text-green"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">Medical Examination</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>15-Jan-2019</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">Medical examination by Ali</h6>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="fa fa-plus-square text-danger"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">Lab Results</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>15-Jan-2019</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">Lab by Mani</h6>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="fa fa-x-ray text-info"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">X-Ray Findings</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>15-Jan-2019</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">X-Ray Values Edited by Ali</h6>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="fa fa-vials text-danger"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">Blood Sample</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>15-Jan-2019</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">Blood sample taken by Ali</h6>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step badge-info">
                    <i class="fa fa-file text-orange"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <span class="text-muted text-sm font-weight-bold">Report Issue</span>
                      </div>
                      <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i>15-Jan-2019</small>
                      </div>
                    </div>
                    <h6 class="text-sm mt-1 mb-0">Report Issue by Ali</h6>
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div> -->
    
      <!-- Card header -->
      <div class="card-header">
        <!-- Title -->
        <h5 class="h3 mb-0">Notifications</h5>
      </div>
      <!-- Card body -->
        <div class="row">
          <div class="col-lg-6">
          <div style="width: 19rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Registration</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Registration by <?php echo $user_name; ?></span>
                        <span class="text-nowrap"><?php echo $reg_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-user-plus text-orange"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
            
          <div class="col-lg-6">
          <div style="width: 18.5rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">PP Check</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">PP checked by <?php echo $pp_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $pp_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-fingerprint text-danger"></i>
                    </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
          <div style="width: 19rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Medical Examination</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Medical examination by <?php echo $medical_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $medical_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-file-medical-alt text-orange"></i>
                    </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          </div>

          <div class="col-lg-6">
          <div style="width: 18.5rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Picture</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Picture Taken by: <?php echo $user_name; ?></span>
                        <span class="text-nowrap"><?php echo $reg_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="ni ni-circle-08 text-orange"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <br>
        <div class="row">
        <div class="col-lg-6">
          <div style="width: 18.5rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Lab Sticker</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Sticker Printed by <?php echo $sticker_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $sticker_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-plus-square text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>

          <div class="col-lg-6">
          <div style="width: 19rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Lab Results</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Result Updated by <?php echo $lab_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $lab_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-plus-square text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>          
        <br>
        <div class="row">
          <div class="col-lg-6">
          <div style="width: 18.5rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">X-Ray Verification</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Verified By <?php echo $xray_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $xray_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-x-ray text-orange"></i>
                    </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          </div>

          <div class="col-lg-6">
          <div style="width: 18.5rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">X-Ray Result</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Result Updated by <?php echo $xray_result_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $xray_result_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-x-ray text-orange"></i>
                    </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
          <div style="width: 19rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Blood Sample</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Sample Collected by <?php echo $sample_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $sample_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-vials text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
            
          <div class="col-lg-6">
          <div style="width: 18.5rem;">
            <div class="card card-stats mb-4 mb-lg-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Report Issue</h5>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap mr-2">Report Issued by <?php echo $sample_user_name; ?></span>
                        <span class="text-nowrap"><?php echo $sample_created_at; ?></span>
                      </p>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fa fa-file text-orange"></i>
                    </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <br>



          </div>
        </div>

      </div>

      <!-- Footer -->
      <?php 
      include_once('include/footer_area.php'); ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <?php
include_once('include/footer.php');
  ?>
</body>
<script type="text/javascript">
 function pending_status(){

  //var current_status = document.getElementById("medical_status").innerHTML;

  if(document.getElementById("pending").checked == true)
  {

    document.getElementById("medical_status").innerHTML  = 'Pending'; 
  }else{
    document.getElementById("medical_status").innerHTML  = 'In Process'; 
  }
 } 
</script>
<script src="assets/js/system_script.js"></script>
</html>