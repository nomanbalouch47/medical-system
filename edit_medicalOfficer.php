<?php 
include('include/functions.php');
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
<style type="text/css">
  
  #errorclass
  {
  display:none;
  }
</style>
<body>
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
  <?php include_once('include/topnav.php'); ?>
    <!-- Header -->
    <!-- Header -->
    <form>
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
                </ol>
              </nav>
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

                          

          
      <div class="row">

        <div class="col-lg-6">
          <div class="card-wrapper">
            <!-- Passport Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">Search Candidate</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                            <input class="form-control" name="search_by_serial" placeholder="Serial Number" type="text">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="search_medical_candidate" value="SEARCH">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            
            </div>
        <?php get_data_medicalOfficer_by_serial(); ?>

          <!-- MEDICAL EXAMINATION: GENERAL -->
          <?php edit_medicalOfficer_candidate(); ?>
          <form method="post" action="" enctype="multipart/form-data">
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">MEDICAL EXAMINATION</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">

                  <h6 class="heading-small text-muted mb-4">GENERAL</h6>
                 <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">HEIGHT</label>
                          <input class="form-control" type="text" name="height" value="<?php echo $height; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">WEIGHT</label>
                          <input class="form-control"  type="text" name="weight" value="<?php echo $weight; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">BMI</label>
                          <input class="form-control" type="text" name="bmi" value="<?php echo $bmi; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">BP</label>
                          <input class="form-control"  type="text" name="bp" value="<?php echo $bp; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">PULSE</label>
                          <input class="form-control" type="text" name="pulse" value="<?php echo $pulse; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">RR</label>
                          <input class="form-control"  type="text" name="rr" value="<?php echo $rr; ?>">
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
                                <span class="lbl-inner--icon"><i class="far fa-eye"></i> Rt.Eye</span>
                              </label>
                             
                              <input class="form-control" type="text" name="visual_unaided_rt_eye" value="<?php echo $visual_unaided_r_eye; ?>">
                            </div>
                            <div class="col-md-6">
                              <label class="form-control-label" for="exampleDatepicker">
                                <span class="lbl-inner--icon"><i class="far fa-eye"></i> Lt.Eye</span>
                              </label>
                              <input class="form-control" type="text" name="visual_unaided_left_eye" value="<?php echo $visual_unaided_l_eye; ?>">
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
                                <span class="lbl-inner--icon"><i class="far fa-eye"></i> Rt.Eye</span>
                              </label>
                              <input class="form-control" type="text" name="visual_aided_rt_eye" value="<?php echo $visual_aided_r_eye; ?>">
                            </div>
                            <div class="col-md-6">
                              <label class="form-control-label" for="exampleDatepicker">
                                <span class="lbl-inner--icon"><i class="far fa-eye"></i> Lt.Eye</span>
                              </label>
                              <input class="form-control" type="text" name="visual_aided_left_eye" value="<?php echo $visual_aided_l_eye; ?>">
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
                            <input class="form-control" type="text" placeholder="Rt.Eye" name="distant_unaided_rt_eye" value="<?php echo $distant_unaided_r_eye; ?>">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" name="distant_unaided_left_eye" value="<?php echo $distant_unaided_l_eye; ?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                        
                        <div class="row">
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Rt.Eye" name="distant_aided_rt_eye" value="<?php echo $distant_aided_r_eye; ?>">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" name="distant_aided_left_eye" value="<?php echo $distant_aided_l_eye; ?>">
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
                            <input class="form-control" type="text" placeholder="Rt.Eye" name="near_unaided_rt_eye" value="<?php echo $near_unaided_r_eye; ?>">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" name="near_unaided_left_eye" value="<?php echo $near_unaided_l_eye; ?>">
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                        
                        <div class="row">
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Rt.Eye" name="near_aided_rt_eye" value="<?php echo $near_aided_r_eye; ?>">
                          </div>
                          <div class="col-md-6">
                            <input class="form-control" type="text" placeholder="Lt.Eye" name="near_aided_left_eye" value="<?php echo $near_aided_l_eye; ?>">
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
                              <!-- <input type="text" name="abv" value="<?php echo $color_vision; ?>"> -->
                              <input name="color_vision" class="custom-control-input" id="customRadio5" type="radio" value="1" <?php echo ($color_vision == 1) ? 'checked' : '' ; ?> >
                              <label class="custom-control-label" for="customRadio5">NORMAL</label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="custom-control custom-radio mb-3">
                              <input name="color_vision" class="custom-control-input" id="customRadio6" type="radio" value="2" <?php echo ($color_vision == 2) ? 'checked' : '' ; ?> >
                              <label class="custom-control-label" for="customRadio6">DOUBTFUL</label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="custom-control custom-radio mb-3">
                              <input name="color_vision" class="custom-control-input" id="customRadio7" type="radio" value="3" <?php echo ($color_vision == 3) ? 'checked' : '' ; ?> >
                              <label class="custom-control-label" for="customRadio7">DEFECTIVE</label>
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
                            <div class="col-md-6">
                              <input class="form-control" type="text" name="hearing_rt_ear" value="<?php echo $hearing_r_ear; ?>">
                            </div>
                          </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label">Lt.Ear</label>
                          <div class="row">
                            <div class="col-md-6">
                              <input class="form-control" type="text" name="hearing_left_ear" value="<?php echo $hearing_l_ear; ?>">
                            </div>
                          </div>
                      </div>
                      </div>
                  </div>
                  </div>

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

                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label" for="exampleDatepicker">GENERAL APPEARANCE</label>
                        <input class="form-control" type="text" name="general_appearance" value="<?php echo $general_appearance; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">CARDIOVASCULAR</label>
                        <input class="form-control"  type="text" name="cardiovascular" value="<?php echo $cardiovascular; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label" for="exampleDatepicker">RESPIRATORY</label>
                        <input class="form-control" type="text" name="respiratory" value="<?php echo $respiratory; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">ENT</label>
                        <input class="form-control"  type="text" name="ent" value="<?php echo $ent; ?>">
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
                              <input class="form-control" type="text" name="abdomen" value="<?php echo $abdomen; ?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">HERNIA</label>
                              <input class="form-control"  type="text" name="hernia" value="<?php echo $hernia; ?>">
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
                              <input class="form-control" type="text" name="hydrocele" value="<?php echo $hydrocele; ?>">
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
                            <input class="form-control" type="text" name="extremities" value="<?php echo $extremities; ?>">
                            </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">                     
                            <label class="form-control-label" for="exampleDatepicker">BACK</label>
                            <input class="form-control"  type="text" name="back" value="<?php echo $back; ?>">
                          </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">                        
                            <label class="form-control-label" for="exampleDatepicker">SKIN</label>
                            <input class="form-control" type="text" name="skin" value="<?php echo $skin; ?>">
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">C.N.S</label>
                              <input class="form-control"  type="text" name="cns" value="<?php echo $cns; ?>">
                            </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">                     
                            <label class="form-control-label" for="exampleDatepicker">DEFORMITIES</label>
                            <input class="form-control"  type="text" name="deformities" value="<?php echo $deformities; ?>">
                          </div>
                          </div>
                        </div>
                      </div>

              </div>
            </div>
          </div>
        </div>
        
          <div class="col-lg-6">
            <!-- Candidate Info -->
            <div class="card-wrapper">
          
          <!-- General Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">CANDIDATE INFO</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">

                
                  <p id="cand_result"></p>
                  
                  <div class="row">
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label' for='exampleDatepicker'>Examination Date</label>
                          <input class='form-control datepicker' type='text' id='medicaldate' name="reg_date" value="<?php echo $reg_date; ?>" readonly>
                          <span class='calendar-grid-58'></span>
                      
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Name </label>
                        
                          <input class='form-control datepicker' type='text' id="name" name="name" value="<?php echo $cand_name; ?>" readonly>
                          
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class='col-md-6'>
                      <div class='form-group'>                        
                          <label class='form-control-label' for='exampleDatepicker'>Serial No</label>
                          <input class='form-control datepicker' type='text' id='serial_no' name="serial_no" value="<?php echo $serial_no; ?>" readonly>
                          <span class='calendar-grid-58'></span>
                      
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label class='form-control-label' for='exampleDatepicker'>Passport No</label>
                          <input class='form-control datepicker' type='text' id='Passport' name="Passport" value="<?php echo $passport_no; ?>" readonly>
                          <span class='calendar-grid-58'></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Remarks </label>
                          <textarea class="form-control" rows = "5" cols = "80" id="remarks" name="remarks" value="<?php echo $remarks; ?>" readonly>
                          </textarea>
                      </div>
                    </div>
                  </div>

               <!--  <button type="button" id="medicalofficer" class="btn btn-primary" onclick="medicalofficer();">
                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i> Save</span>
                  </button> -->
              
                <p id="medicalOff_result"></p>
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

                  
                <h6 class="heading-small text-muted mb-4">A.</h6>
                <div class="pl-lg-2">
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                        
                      <label class="form-control-label" for="exampleDatepicker">APPEARANCE</label>
                      <input class="form-control" type="text" name="appearance" value="<?php echo $appearance; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">SPEECH</label>
                      <input class="form-control"  type="text" name="speech" value="<?php echo $speech; ?>">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                        
                      <label class="form-control-label" for="exampleDatepicker">BEHAVIOUR</label>
                      <input class="form-control" type="text" name="behavior" value="<?php echo $behavior; ?>">
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
                        <input class="form-control"  type="text" name="cognition" value="<?php echo $cognition; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">ORIENTATION</label>
                      <input class="form-control"  type="text" name="orientation" value="<?php echo $orientation; ?>">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">MEMORY</label>
                      <input class="form-control"  type="text" name="memory" value="<?php echo $memory; ?>">
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">CONCENTRATION</label>
                      <input class="form-control"  type="text" name="concentration" value="<?php echo $concentration; ?>">
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
                      <input class="form-control"  type="text" name="mood" value="<?php echo $mood; ?>">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">D. THOUGHTS</label>
                      <input class="form-control"  type="text" name="thoughts" value="<?php echo $thoughts; ?>">
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label" for="exampleDatepicker">OTHERS</label>
                      <input class="form-control"  type="text" name="other" value="<?php echo $other; ?>">
                    </div>
                    <div class="form-group">                     
                      <input class="form-control"  type="hidden" name="search_by_serial_no" value="<?php echo $search_by_serial_no; ?>">
                      <input class="form-control"  type="hidden" name="reg_id" value="<?php echo $reg_id; ?>">
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label">Upload Medical File</label>
                        
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload" lang="en">
                          <label class="custom-file-label" for="fileToUpload">Select file</label>
                        </div>   
                        
                      </div>
                    </div>
                  </div>
                </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <h3 class="mb-0">Kindly Check all the fields before <strong>update</strong> </h3><br>  
                       <input type="submit" name="update_by_serial_number" class="btn btn-danger" value="Update">
                    </div>
                  </div>

              </div>
            </div>
            </div>
          </div>
          </div>
        </form>
    
      <!-- Footer -->
      <?php 
      include('include/footer_area.php'); ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <?php
include('include/footer.php');
  ?>
</body>
</html>