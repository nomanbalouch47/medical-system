<?php 
include('include/functions.php'); 
$process_id=2;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,2);
}
?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<body>
  <style type="text/css">
    #verify_fail,#verify_success,#medicalofficer,#biometric_fail
    {
      display: none;
    }
    #errorclass
    {
      display:none;
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
              <h6 class="h2 text-white d-inline-block mb-0">Medical Officer Module</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Medical Officer</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                    <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-warning btn-sm" target="_self">New/Reload</button></li>
                </ol>
              </nav>
            </div>
            
            <div class="col-lg-6 col-5 text-right">
              <h6 class="h2 text-white d-inline-block mb-0">
                <?php
                if(now_serving_rights($loginuser,2)==1){
                  ?>
                  Now serving: <?php echo $token_prefix.$current_token = get_current_token(); ?>
                  <!-- <span id="token_number"></span> -->
                <?php
                }else{
                  $current_token = get_current_token();
                }
                ?>
                <span id="token_number"></span> | In Queue <?php echo tokens_in_queue($process_id); ?> </h6> &nbsp;
        
              <input type="hidden" name="token_number3" id="token_number3" value="<?php echo $current_token; ?>">

              <input type="hidden" name="processid" id="processid" value="<?php echo $process_id; ?>">
            
              <!-- <input type="submit" name="call_token" class="btn btn-sm btn-neutral" value="New"> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="errorclass" role="alert">   
                            <span class="alert-text"><strong>Warning!</strong> Please fill out complete form!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                           <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="verify_fail" role="alert">   
                            <span class="alert-text"><strong>Verification Failed!</strong> No Record Found!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="biometric_fail" role="alert">   
                            <span class="alert-text"><strong>Verification Failed!</strong> Fingerprint Mismatch!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
             <div class="alert alert-success alert-dismissible fade show col-md-offset-2" id="verify_success" role="alert">   
                            <span class="alert-text"><strong>Verification Success!</strong> Candidate Verified!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
      <!-- div class row here -->
      <from>
        <div class="row">
        <div class="col-lg-6">
          <div class="card-wrapper">

            <!-- Biometric Info -->
             <!-- Biometric Info -->
             <div class="card">
              <!-- Card header -->
               <div class="card-header">
                <h3 class="mb-0">BIOMETRIC AREA
                  <input class="form-control" type="text" style="width: 200px; float: right;" name="cand_identity" id="cand_identity" autofocus="autofocus" placeholder="Code or Passport No:">
                  </h3>
                  
                  <p id="cand_template" style="display: none;" ></p>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type='hidden' id=quality size=10 value="100">
                        <img id="FPImage1" alt="Fingerpint Image" height=300 width=210 src=".\assets\img\PlaceFinger.bmp"  class="img-thumbnail">
                      </div>
                      
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <img src="assets/img/profile_thumbnail.jpg" id="cand_img" alt="..." class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  <div class="row input-daterange datepicker align-items-center">
                          
                  </div>
                </form>
                <?php
                if(biometric_rights($loginuser,2) == 1){
                  ?>
                   <button type="button" class="btn btn-success" onclick="CallSGIFPGetData(SuccessFunc1, ErrorFunc); biofunction();">Click to Scan</button>

                <button type="button" value="Click to Match" onclick="matchScore(succMatch, failureFunc)" class="btn btn-success">Verify</button>

                <?php
                }
                ?>
                             
              </div>
            </div>
            <p id="result1"> </p>
            <p id="result2"> </p>


                      <!-- Medical EXAMINATION: GENERAL -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">MEDICAL EXAMINATION</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <h6 class="heading-small text-muted mb-4">GENERAL</h6>
                 <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">HEIGHT</label>
                          <input class="form-control" type="text" id="height" placeholder="Height in meter" value="">
                          <small style="font-style: italic;">*Height in Centi-meters</small>
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">WEIGHT</label>
                          <input class="form-control"  type="text" id="weight" placeholder="Weight in KG" value="" onkeyup="calculate_bmi()">
                          <small style="font-style: italic;">*Weight in KG</small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">BMI</label>
                          <input class="form-control" type="text" id="bmi" name="bmi" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">BP</label>
                          <input class="form-control"  type="text" id="bp" value="120/80">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">PULSE</label>
                          <input class="form-control" type="text" id="pulse" value="70">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">RR</label>
                          <input class="form-control"  type="text" id="rr" value="18">
                      </div>
                    </div>
                  </div>
                  

                  <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label form-control-label">VISUAL ACUITY</label>
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label">UNAIDED</label>
                          <!-- <div class="row">
                            <div class="col-md-6">
                              <label class="form-control-label" for="exampleDatepicker">
                                <span class="lbl-inner--icon"><i class="far fa-eye"></i> Rt.Eye 6</span>
                              </label>
                             
                              <input class="form-control" type="text" id="visual_unaided_rt_eye" value="--">
                            </div>
                            <div class="col-md-6">
                              <label class="form-control-label" for="exampleDatepicker">
                                <span class="lbl-inner--icon"><i class="far fa-eye"></i> Lt.Eye 6/</span>
                              </label>
                              <input class="form-control" type="text" id="visual_unaided_left_eye" value="--">
                            </div>
                          </div> -->
                      </div>

                      </div>

                    <!-- <hr style="width: 1px; height: 100px; background: #e8e2e1; border: none;" /> -->
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">AIDED</label>
                          <!-- <div class="row">
                            <div class="col-md-6">
                              <label class="form-control-label" for="exampleDatepicker">
                                <span class="lbl-inner--icon" style="font-size: 12px;"><i class="far fa-eye"></i> Rt.Eye 20/</span>
                              </label>
                              <input class="form-control" type="text" id="visual_aided_rt_eye" value="20">
                            </div>
                            <div class="col-md-6">
                              <label class="form-control-label" for="exampleDatepicker">
                                <span class="lbl-inner--icon" style="font-size: 12px;"><i class="far fa-eye"></i> Lt.Eye 20/</span>
                              </label>
                              <input class="form-control" type="text" id="visual_aided_left_eye" value="20">
                            </div>
                            
                          </div> -->
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <label for="example-text-input" class="col-md-2 col-form-label form-control-label">DISTANT</label>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Rt.Eye" id="distant_unaided_rt_eye" value="6">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" id="distant_unaided_left_eye" value="6">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                        
                        <div class="row">
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Rt.Eye" id="distant_aided_rt_eye" value="--">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" id="distant_aided_left_eye" value="--">
                          </div>
                        </div>
                      </div>
                      </div>
                  </div>

                  <div class="row">
                    <label for="example-text-input" class="col-md-2 col-form-label form-control-label">NEAR</label>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Rt.Eye" id="near_unaided_rt_eye" value="20">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" id="near_unaided_left_eye" value="20">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                        
                        <div class="row">
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Rt.Eye" value="--" id="near_aided_rt_eye">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" value="--" id="near_aided_left_eye">
                          </div>
                        </div>
                      </div>
                      </div>
                  </div>
                  <div class="row">
                    <label for="example-text-input" class="col-md-2 col-form-label form-control-label">COLOR VISION</label>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="custom-control custom-radio mb-3">
                              <input name="custom-radio-1" class="custom-control-input" id="cv_norm" type="radio" value="NORMAL">
                              <label class="custom-control-label" for="cv_norm">NORMAL</label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="custom-control custom-radio mb-3">
                              <input name="custom-radio-1" class="custom-control-input" id="cv_doubt" type="radio" value="DOUBTFUL">
                              <label class="custom-control-label" for="cv_doubt">DOUBTFUL</label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="custom-control custom-radio mb-3">
                              <input name="custom-radio-1" class="custom-control-input" id="cv_defect" value="DEFECTIVE" type="radio">
                              <label class="custom-control-label" for="cv_defect">DEFECTIVE</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label form-control-label">HEARING</label>
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label">Rt.Ear</label>
                          <div class="row">
                            <div class="col-md-12">
                              <select class="form-control" id="hearing_rt">
                                <option value="Normal">Normal</option>
                                <option value="Doubtful">Doubtful</option>
                                <option value="Defective">Defective</option>
                              </select>
                             
                            </div>
                          </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                         <div class="form-group">                        
                          <label class="form-control-label">Left.Ear</label>
                          <div class="row">
                            <div class="col-md-12">
                              <select class="form-control" id="hearing_left">
                                <option value="Normal">Normal</option>
                                <option value="Doubtful">Doubtful</option>
                                <option value="Defective">Defective</option>
                              </select>
                             
                            </div>
                          </div>
                          </div>

                 
                      </div>
                  </div>
                  </div>
                </form>
                </div>
              </div>

            <!-- MEDICAL EXAMINATION: SYSTEMIC -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">SYSTEMIC</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form>
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label" for="exampleDatepicker">GENERAL APPEARANCE</label>
                        <input class="form-control" type="text" value="nad" id="gen_appearence">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">CARDIOVASCULAR</label>
                        <input class="form-control"  type="text" value="nad" id="cardiov">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label" for="exampleDatepicker">RESPIRATORY</label>
                        <input class="form-control" type="text" value="nad" id="respiratory">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">ENT</label>
                        <input class="form-control"  type="text" value="nad" id="ent">
                      </div>
                    </div>
                  </div>
                  <hr class="my-4" />
                    <h6 class="heading-small text-muted mb-4">GASTRO INTESTINAL</h6>
                    <div class="pl-lg-2">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">                        
                              <label class="form-control-label" for="exampleDatepicker">ABDOMEN (<SPAN><i class="text-warning mb-0"> mass, tenderness</i> )</SPAN></label>
                              <input class="form-control" type="text" value="nad" id="abdomen">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">HERNIA</label>
                              <input class="form-control"  type="text" value="nad" id="hernia">
                          </div>
                        </div>
                      </div>
                    </div>
                    <h6 class="heading-small text-muted mb-4">GENITOURINARY</h6>
                      <div class="pl-lg-2">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">                        
                              <label class="form-control-label" for="exampleDatepicker">HYDROCELE</label>
                              <input class="form-control" type="text" value="nad" id="hydrocele">
                          </div>
                        </div>
                      </div>
                      </div>
                    <hr class="my-4" />
                    <h6 class="heading-small text-muted mb-4">MUSCULOSKELETAL</h6>
                      <div class="pl-lg-2">
                        <div class="row">
                          <div class="col-md-4">
                          <div class="form-group">                        
                            <label class="form-control-label" for="exampleDatepicker">EXTREMITIES</label>
                            <input class="form-control" type="text" value="nad" id="extremeties">
                            </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">                     
                            <label class="form-control-label" for="exampleDatepicker">BACK</label>
                            <input class="form-control"  type="text" value="nad" id="back">
                          </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">                        
                            <label class="form-control-label" for="exampleDatepicker">SKIN</label>
                            <input class="form-control" type="text" value="nad" id="skin">
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">C.N.S</label>
                              <input class="form-control"  type="text" value="nad" id="cns">
                            </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">                     
                            <label class="form-control-label" for="exampleDatepicker">DEFORMITIES</label>
                            <input class="form-control"  type="text" value="nad" id="deformities">
                          </div>
                          </div>
                        </div>
                      </div>
                </form>
              </div>
            </div>


            
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card-wrapper">
            <!-- Passport Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">VERIFICATION AREA</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
               <form>
                  <div class="row">
                  
                    <?php
                      if(barcode_rights($loginuser,2)==1){
                        ?>
                        <div class="col-md-6">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">Barcode</label>
                          <input class="form-control" type="password" name="barcode" id="barcode" onkeyup="get_candidate_record(event,'medicalofficer')">
                      </div>
                    </div>
                        <?php
                      }

                      ?>

                    <?php
                      if(date_search_rights($loginuser,2)==1){
                        ?>
                        <div class="col-md-6">
                          <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">Date</label>
                              <input class="form-control" type="date" id="search_with_date" placeholder="mm/dd/yyyy">
                          </div>
                        </div>
                        <?php
                      }

                      ?>

                    <div class="col-md-6">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">Serial Number</label>
                          <input class="form-control" type="text" id="serial" onkeyup="get_candidate_record(event,'medicalofficer')">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- General Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">CANDIDATE INFO</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                 <form>
                
                  <p id="cand_result"></p>
                  
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                              <label class="form-control-label" for="exampleFormControlTextarea1">Remarks</label>
                              <textarea class="form-control"  id="remarks" rows="3"></textarea>
                            </div>
                    </div>
                  </div>
                </form>
               <!--  <button type="button" id="medicalofficer" class="btn btn-primary" onclick="medicalofficer();">
                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i> Save</span>
                  </button> -->
              
                
              </div>
            </div>

            <!-- MENTAL EXAMINATION: STATUS -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">MENTAL STATUS EXAMINATION</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form>
                  
                <h6 class="heading-small text-muted mb-4">A.</h6>
                <div class="pl-lg-2">
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                        
                      <label class="form-control-label" for="exampleDatepicker">APPEARANCE</label>
                      <input class="form-control" type="text" value="nad" id="appearence">
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">SPEECH</label>
                      <input class="form-control"  type="text" value="nad" id="speech">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                        
                      <label class="form-control-label" for="exampleDatepicker">BEHAVIOUR</label>
                      <input class="form-control" type="text" value="nad" id="behaviour">
                    </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <h6 class="heading-small text-muted mb-4">B.</h6>
                <div class="pl-lg-2">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">COGNITION</label>
                        <input class="form-control"  type="text" value="nad" id="cognition">
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">ORIENTATION</label>
                      <input class="form-control"  type="text" value="nad" id="orientation">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">MEMORY</label>
                      <input class="form-control"  type="text" value="nad" id="memory">
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">CONCENTRATION</label>
                      <input class="form-control"  type="text" value="nad" id="concentration">
                    </div>
                    </div>
                  </div>
                </div>
                  
                <hr class="my-4" />
                <div class="pl-lg-2">
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">C. MOOD</label>
                      <input class="form-control"  type="text" value="nad" id="mood">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">D. THOUGHTS</label>
                      <input class="form-control"  type="text" value="nad" id="thoughts">
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">OTHERS</label>
                      <input class="form-control"  type="text" value="nad" id="others">
                    </div>
                    </div>
                  </div>
                </div>
                  
                </form>
              </div>
            </div>

            <!-- SAVE Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">SAVE INFORMATION</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <div class="row">
                    <?php 
                    if(edit_rights($loginuser,2) == 1){
                      ?>
                      <div class="col-md-8">
                  <button type="button" id="medicalofficer" class="btn btn-primary" onclick="cand_medicalofficer();">
                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i> Save</span>
                  </button>
                    <br>
                  <a href="edit_medicalOfficer" target="_blank">
                    <button type="button" id="edit" class="btn btn-success">Update</button>
                  </a>

                    </div>
                      <?php
                    }
                    ?>
                      
                  </div>
                </form>
              </div>
              <p id="medicalOff_result"></p>
            </div>
          </div>
        </div>
      </div>
      </from>
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
    var template_1 = "";
    var db_template = "";
    var verified_template = "";
    var cand_ident = document.getElementById("cand_identity").value;
    var token_num = document.getElementById("token_number3").value;
    var process_ID = document.getElementById("processid").value;
    
    function biofunction(){

      var cand_ident = document.getElementById("cand_identity").value;
      if(cand_ident == ""){
         alert('Please enter Code or Passport No');
      }else{
        get_biomteric_with_code(cand_ident);
      }
    }

        function matchScore(succFunction, failFunction) {
          
          db_template = document.getElementById("cand_template").innerHTML;

          if(db_template == ""){
           
             document.getElementById("biometric_fail").style.display = "block";

              $(function(){
                 $('#biometric_fail').delay(3000).fadeOut();
                });

          }else{
       
          if (template_1 == "") {
            alert("Please scan finger to verify!!");
            return;
          }
        var uri = "https://localhost:8443/SGIMatchScore";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                fpobject = JSON.parse(xmlhttp.responseText);
                succFunction(fpobject);
            }
            else if (xmlhttp.status == 404) {
                failFunction(xmlhttp.status)
            }
        }

        xmlhttp.onerror = function () {
            failFunction(xmlhttp.status);
        }

        var params = "template1=" + encodeURIComponent(template_1); //user scanned template
        params += "&template2=" + encodeURIComponent(db_template); //db template
        params += "&licstr=" + encodeURIComponent(secugen_lic);
        params += "&templateFormat=" + "ISO";
        xmlhttp.open("POST", uri, false);
        xmlhttp.send(params);

        if(verified_template == "")
        {
          
          document.getElementById("verify_fail").style.display = "block";

          $(function(){
             $('#verify_fail').delay(3000).fadeOut();
            });
          
        }else{

          var cand_ident = document.getElementById("cand_identity").value;
          document.getElementById("verify_success").style.display = "block";
          get_candidate_with_biometric(cand_ident,'medicalofficer');

        }
     }
  }

    function succMatch(result) {
        var idQuality = document.getElementById("quality").value;
      
        if (result.ErrorCode == 0) {
            if (result.MatchingScore >= idQuality)
            {
                verified_template = template_1;               
            }
            else{

            }
                
        }
        else {
            alert("Error Scanning Fingerprint ErrorCode = " + result.ErrorCode);
        }
    }

    function failureFunc(error) {
        alert ("On Match Process, failure has been called");
    }

      function calculate_bmi(){

      var h = document.getElementById("height").value;
      var w = document.getElementById("weight").value;
      //var height_to_meter = h*0.30;
      var height_square = h*h;
      // var bmi =  w/height_square;
      var bmi =  w/height_square*10000;

      document.getElementById("bmi").value = bmi.toFixed(2);
    }

</script>
<script src="assets/js/secugen.js"></script>
<script src="assets/js/system_script.js"></script>
</html>