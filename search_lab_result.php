<?php 

include('include/functions.php');
$process_id=19;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,19);
}
if(date_search_rights($loginuser,19)==1){
?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
  
  #errorclass,#barcodeError,#polio_date,#meningco_date,#mmr2_date,#mmr1_date
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
              <h6 class="h2 text-white d-inline-block mb-0">LAB MODULE</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">UPDATE LAB RESULT</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-warning btn-sm" target="_self">New/Reload</button></li>
                </ol>
              </nav>
            </div>

            <p id="barcode_verification_response"></p>


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

      <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="barcodeError" role="alert">   
        <span class="alert-text"><strong>Warning!</strong> Record already exist, Please contact administration! </span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

                          

      <?php get_data_for_lab_result(); ?>    
      <div class="row">

        <div class="col-lg-6">
          <div class="card-wrapper">
            <!-- Passport Info -->
            <div class="card">
              <!-- Card header -->
              <!-- <div class="card-header">
                <h3 class="mb-0">Search Candidate</h3>
              </div> -->
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <!-- <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Barcode</label>
                      </div>
                    </div> -->
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                            <input class="form-control" name="barcode" id="barcode" placeholder="Barcode" type="password" onkeyup="verfiy_barcode_lab_result(event)">

                        </div>
                        <input type="hidden" name="reg_id" id="reg_id">
                        <input type="hidden" name="processid" id="processid" value="<?php echo $process_id; ?>">
                      </div>
                    </div> -->
                    <input class="form-control" name="barcode" id="barcode" value="<?php echo $barcode; ?>" placeholder="Barcode" type="hidden">

                    <?php

                      if(date_search_rights($loginuser,19)==1){
                        ?>
                        
                        
                        <div class="col-md-4">
                          <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">Date</label>
                              <input class="form-control" type="date" id="search_with_date" name="search_with_date" placeholder="mm/dd/yyyy" required="">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">Serial Number</label>
                              <input class="form-control" type="text" id="serial" name="serial" required="">
                          </div>
                        </div>

                        <div class="col-md-2">
                        <div class="form-group">
                          <label class="form-control-label" for="exampleDatepicker"></label>
                          <input type="submit" class="btn btn-primary" name="search_candidate" value="SEARCH">
                        </div>
                      </div>



                        <?php
                      }

                      ?>
                    
                    

                  </div>
                </form>
              </div>
            
            </div>
            <?php

            if(date_search_rights($loginuser,19)==1){

            ?>
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
                        <img src="assets/candidate_image/<?php echo $candidate_img ?>" id="cand_img" alt="..." class="img-thumbnail">
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                          <label class="form-control-label">Examination Date</label>
                          <input class="form-control" type="text" value="<?php echo $reg_date; ?>" id="examination_date" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">Serial Number</label>
                          <input class="form-control" type="text" id="serial_no" value="<?php echo $serial_no; ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Name</label>  
                          <input class="form-control" type="text" value="<?php echo $candidate_name; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Father Name</label>  
                          <input class="form-control" type="text" value="<?php echo $son_of; ?>" readonly>
                      </div>
                    </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label" for="exampleDatepicker">PP No</label>  
                          <input class="form-control" type="text" value="<?php echo $passport_no; ?>" readonly>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">CNIC</label>  
                          <input class="form-control" type="text" value="<?php echo $cnic; ?>" readonly>
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                   <div class="col-md-6">
                          <div class="form-group">
                              <label class="form-control-label" for="exampleDatepicker">Country</label>
                              <input class="form-control" type="text" value="<?php echo $country; ?>" readonly>                            
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              
                            <input class="form-control" type="hidden" name="reg_id" id="reg_id" value="<?php echo $regid; ?>" readonly>                            
                        </div>
                      </div>
                  </div>
                  
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
            <?php
              }

            ?>
          <!-- MEDICAL EXAMINATION: GENERAL -->
          <form method="post" action="">
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">SEROLOGY</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                  <div class="pl-lg-2">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                        
                        <label class="form-control-label">HCV</label>
                        <select class="form-control" name="hcv" id="hcv">
                          <?php
                            if($hcv=='positive') {
                              echo "<option value='$hcv' selected=selected>$hcv</option>";
                              echo "<option value='negative'>Negative</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } elseif($hcv=='negative') {
                              echo "<option value='$hcv' selected=selected>$hcv</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } else {
                              echo "<option value='see notes'>See Notes</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='negative'>Negative</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">HBsAg</label>
                        <select class="form-control" name="hbs_ag" id="hbs_ag">
                          <?php
                            if($hbs_ag=='positive') {
                              echo "<option value='$hbs_ag' selected=selected>$hbs_ag</option>";
                              echo "<option value='negative'>Negative</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } elseif($hbs_ag=='negative') {
                              echo "<option value='$hbs_ag' selected=selected>$hbs_ag</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } else {
                              echo "<option value='see notes'>See Notes</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='negative'>Negative</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                        
                        <label class="form-control-label">HIV 1.2</label>
                        <select class="form-control" name="hiv" id="hiv">
                          <?php
                            if($hiv=='positive') {
                              echo "<option value='$hiv' selected=selected>$hiv</option>";
                              echo "<option value='negative'>Negative</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } elseif($hiv=='negative') {
                              echo "<option value='$hiv' selected=selected>$hiv</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } else {
                              echo "<option value='see notes'>See Notes</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='negative'>Negative</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="pl-lg-2">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                        
                        <label class="form-control-label">VDRL</label>
                        <select class="form-control" name="vdrl" id="vdrl">
                          <?php
                            if($vdrl=='positive') {
                              echo "<option value='$vdrl' selected=selected>$vdrl</option>";
                              echo "<option value='negative'>Negative</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } elseif($vdrl=='negative') {
                              echo "<option value='$vdrl' selected=selected>$vdrl</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } else {
                              echo "<option value='see notes'>See Notes</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='negative'>Negative</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label">TPHA (<SPAN><i class="text-warning mb-0">if VDRL is positive</i> )</SPAN></label>
                        <select class="form-control" name="tpha" id="tpha">
                          <?php
                            if($tpha=='positive') {
                              echo "<option value='$tpha' selected=selected>$tpha</option>";
                              echo "<option value='negative'>Negative</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } elseif($tpha=='negative') {
                              echo "<option value='$tpha' selected=selected>$tpha</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } else {
                              echo "<option value='see notes'>See Notes</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='negative'>Negative</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                </div>
              

            <!-- MEDICAL EXAMINATION: SYSTEMIC -->
            
              <!-- Card header -->
              <div class="pl-lg-4">
                <h3 class="mb--1">BIOCHEMISTRY</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <div class="pl-lg-2">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">                        
                        <label class="form-control-label">R.B.S</label>
                        <input class="form-control" type="text" name="rbs" value="<?php echo $rbs; ?>" id="rbs">
                    </div>
                  </div>
                </div>
                </div>

                <hr class="my-4" />
                <label class="form-control-label">L.F.T</label><br><br>
                  <div class="pl-lg-2">
                    <div class="row">
                      <div class="col-md-4">
                      <div class="form-group">                        
                        <label class="form-control-label">BIL (<SPAN><i class="text-warning mb-0"> mg/dl</i> )</SPAN></label>
                        <input class="form-control" type="text" placeholder="Normal Range 0.05-1.20" value="<?php echo $bil; ?>" name="bil" id="bil">
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                        
                        <label class="form-control-label">ALT (<SPAN><i class="text-warning mb-0"> U/L</i> )</SPAN></label>
                        <input class="form-control" type="text" placeholder="Normal Range 10-40 U/L" value="<?php echo $alt; ?>" name="alt" id="alt">
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">AST (<SPAN><i class="text-warning mb-0"> U/L</i> )</SPAN></label>
                        <input class="form-control"  type="text" placeholder="Normal Range 10-40 U/L" value="<?php echo $ast; ?>" name="ast" id="ast">
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label">ALK (<SPAN><i class="text-warning mb-0">PO4 U/L</i> )</SPAN></label>
                        <input class="form-control"  type="text" placeholder="Normal Range 100-200 U/L" value="<?php echo $alk; ?>" name="alk" id="alk">
                      </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">                     
                          <label class="form-control-label">Creatinine</label>
                          <input class="form-control"  type="text" placeholder="Normal Range 0.05-1.20" value="<?php echo $creatinine; ?>" name="creatinine" id="creatinine">
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            
         
              <!-- Card body -->
              <div class="card-body">
                  <div class="pl-lg-2">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">Blood group</label>
                        <select class="form-control" name="blood_group" id="blood_group">
                          <?php
                           $blood_arr = array('A+','B+','AB+','A-','B-','AB-','O+','O-');
                           foreach ($blood_arr as $key => $value) {
                             if($blood_group==$value) {
                                echo "<option value='$blood_group' selected=selected>$blood_group</option>";
                             } else {
                                echo "<option value='$value'>$value</option>";
                             }
                             
                           }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">Haemoglobin</label>
                        <input class="form-control"  type="text" placeholder="Normal Range 12-17 g/dl" value="<?php echo $haemoglobin; ?>" name="haemoglobin" id="haemoglobin">
                      </div>
                    </div>
                  </div>
                </div>

                  <hr class="my-4" />
                  <h5 class="mb--1">THICK FILM FOR</h5><br>
                    <div class="pl-lg-2">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">                     
                            <label class="form-control-label">Malaria</label>
                            <select class="form-control" name="malaria" id="malaria">
                              <?php
                                if($malaria=='absent') {
                                  echo "<option value='$malaria' selected=selected>$malaria</option>";
                                  echo "<option value='present'>Present</option>";
                                } else {
                                  echo "<option value='$malaria' selected=selected>$malaria</option>";
                                  echo "<option value='absent'>Absent</option>";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">                     
                            <label class="form-control-label">Micro filariae</label>
                            <select class="form-control" name="micro_filariae" id="micro_filariae" >
                              <?php
                                if($micro_filariae=='absent') {
                                  echo "<option value='$micro_filariae' selected=selected>$micro_filariae</option>";
                                  echo "<option value='present'>Present</option>";
                                } else {
                                  echo "<option value='$micro_filariae' selected=selected>$micro_filariae</option>";
                                  echo "<option value='absent'>Absent</option>";
                                }
                              ?>
                            </select>
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

            <!-- MENTAL EXAMINATION: STATUS -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">URINE</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                        
                      <label class="form-control-label">Sugar</label>
                      <select class="form-control" name="sugar" id="sugar">
                        <?php
                          if($sugar=='positive') {
                            echo "<option value='$sugar' selected=selected>$sugar</option>";
                            echo "<option value='negative'>Negative</option>";
                            echo "<option value='see notes'>See Notes</option>";
                          } elseif($sugar=='negative') {
                            echo "<option value='$sugar' selected=selected>$sugar</option>";
                            echo "<option value='positive'>Positive</option>";
                            echo "<option value='see notes'>See Notes</option>";
                          } else {
                            echo "<option value='see notes'>See Notes</option>";
                            echo "<option value='positive'>Positive</option>";
                            echo "<option value='negative'>Negative</option>";
                          }
                        ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label">Albumin</label>
                      <select class="form-control" name="albumin" id="albumin">
                        <?php
                          if($albumin=='positive') {
                            echo "<option value='$albumin' selected=selected>$albumin</option>";
                            echo "<option value='negative'>Negative</option>";
                            echo "<option value='see notes'>See Notes</option>";
                          } elseif($albumin=='negative') {
                            echo "<option value='$albumin' selected=selected>$albumin</option>";
                            echo "<option value='positive'>Positive</option>";
                            echo "<option value='see notes'>See Notes</option>";
                          } else {
                            echo "<option value='see notes'>See Notes</option>";
                            echo "<option value='positive'>Positive</option>";
                            echo "<option value='negative'>Negative</option>";
                          }
                        ?>
                      </select>
                    </div>
                    </div>
                  </div>
                </div>

              </div>



            <!-- MENTAL EXAMINATION: STATUS -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">STOOL</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">Helminthes</label>
                        <select class="form-control" name="helminthes" id="helminthes">
                          <?php
                            if($helminthes=='absent') {
                              echo "<option value='$helminthes' selected=selected>$helminthes</option>";
                              echo "<option value='present'>Present</option>";
                            } else {
                              echo "<option value='$helminthes' selected=selected>$helminthes</option>";
                              echo "<option value='absent'>Absent</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">OVA</label>
                        <select class="form-control" name="ova" id="ova">
                          <?php
                            if($ova=='absent') {
                              echo "<option value='$ova' selected=selected>$ova</option>";
                              echo "<option value='present'>Present</option>";
                            } else {
                              echo "<option value='$ova' selected=selected>$ova</option>";
                              echo "<option value='absent'>Absent</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label">CYST</label>
                      <select class="form-control" name="cyst" id="cyst">
                        <?php
                          if($cyst=='absent') {
                            echo "<option value='$cyst' selected=selected>$cyst</option>";
                            echo "<option value='present'>Present</option>";
                          } else {
                            echo "<option value='$cyst' selected=selected>$cyst</option>";
                            echo "<option value='absent'>Absent</option>";
                          }
                        ?>
                      </select>
                    </div>
                    </div>
                    
                  </div>
                </div>

              </div>

              <!-- MENTAL EXAMINATION: STATUS -->
            <div class="card">
              <!-- Card header -->
              <!-- <div class="card-header">
                <h3 class="mb-0">STOOL</h3>
              </div> -->
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                        
                      <label class="form-control-label">T.B. Test</label>
                      <select class="form-control" name="tb_test" id="tb_test">
                        <?php
                          if($tb_test=='absent') {
                            echo "<option value='$tb_test' selected=selected>$tb_test</option>";
                            echo "<option value='present'>Present</option>";
                          } else {
                            echo "<option value='$tb_test' selected=selected>$tb_test</option>";
                            echo "<option value='absent'>Absent</option>";
                          }
                        ?>
                      </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label">Pregnancy Test (<SPAN><i class="text-warning mb-0"> for females</i> )</SPAN></label>
                        <select class="form-control" name="pragnancy_test" id="pragnancy_test">
                          <?php
                            if($pragnancy_test=='positive') {
                              echo "<option value='$pragnancy_test' selected=selected>$pragnancy_test</option>";
                              echo "<option value='negative'>Negative</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } elseif($pragnancy_test=='negative') {
                              echo "<option value='$pragnancy_test' selected=selected>$pragnancy_test</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='see notes'>See Notes</option>";
                            } else {
                              echo "<option value='- - - - - -'>- - - - - - - - - - - - -</option>";
                              echo "<option value='positive'>Positive</option>";
                              echo "<option value='negative'>Negative</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">VACCINATION STATUS</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">                        
                      <label class="form-control-label">Polio</label>
                      <select class="form-control" id="polio" name="polio" onchange="show_polio_date()">
                        <?php
                          if($polio=='non-vaccinated') {
                            echo "<option value='$polio' selected=selected>$polio</option>";
                            echo "<option value='vaccinated'>Vaccinated</option>";
                          } else {
                            echo "<option value='$polio' selected=selected>$polio</option>";
                            echo "<option value='non-vaccinated'>Non Vaccinated</option>";
                          }
                        ?>
                      </select>
                    </div>
                    </div>
                    <?php
                      if($polio=='vaccinated') {
                    ?>
                      <div class="col-md-4">
                        <div class="form-group">                        
                          <label class="form-control-label">Date</label>
                          <input class="form-control datepicker" type="text" id="poliodate" value="<?php echo $polio_date; ?>">
                        </div>
                      </div>
                    <?php
                      } else {
                    ?>
                      <div class="col-md-4" id="polio_date">
                        <div class="form-group">                        
                          <label class="form-control-label">Date</label>
                          <input class="form-control datepicker" type="text" id="poliodate" value="<?php echo $today_date_for_datepicker; ?>">
                        </div>
                      </div>
                    <?php
                      }
                    ?>
                    
                  </div>

                    <!-- <p id="date_polio"></p> -->
                    <div class="row">
                    <div class="col-md-4" >
                      <div class="form-group">                     
                        <label class="form-control-label">MMR1</label>
                        <select class="form-control" id="mmr1" name="mmr1"  onchange="show_mmr1()">
                          <?php
                            if($mmr1=='non-vaccinated') {
                              echo "<option value='$mmr1' selected=selected>$mmr1</option>";
                              echo "<option value='vaccinated'>Vaccinated</option>";
                            } else {
                              echo "<option value='$mmr1' selected=selected>$mmr1</option>";
                              echo "<option value='non-vaccinated'>Non Vaccinated</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <?php
                      if($polio=='vaccinated') {
                    ?>
                      <div class="col-md-4">
                        <div class="form-group">                        
                          <label class="form-control-label">Date</label>
                          <input class="form-control datepicker" type="text" id="mmr1date" value="<?php echo $mmr1_date; ?>">
                        </div>
                      </div>
                    <?php
                      } else {
                    ?>
                      <div class="col-md-4" id="mmr1_date">
                        <div class="form-group">                        
                          <label class="form-control-label">Date</label>
                          <input class="form-control datepicker" type="text" id="mmr1date" value="<?php echo $today_date_for_datepicker; ?>">
                        </div>
                      </div>
                    <?php
                      }
                    ?>
                    
                    </div>
                  
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">MMR2</label>
                        <select class="form-control" id="mmr2" name="mmr2" onchange="show_mmr2()">
                          <?php
                            if($mmr2=='non-vaccinated') {
                              echo "<option value='$mmr2' selected=selected>$mmr2</option>";
                              echo "<option value='vaccinated'>Vaccinated</option>";
                            } else {
                              echo "<option value='$mmr2' selected=selected>$mmr2</option>";
                              echo "<option value='non-vaccinated'>Non Vaccinated</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <?php
                      if($polio=='vaccinated') {
                    ?>
                      <div class="col-md-4">
                        <div class="form-group">                        
                          <label class="form-control-label">Date</label>
                          <input class="form-control datepicker" type="text" id="mmr2date" value="<?php echo $mmr2_date; ?>">
                        </div>
                      </div>
                    <?php
                      } else {
                    ?>
                      <div class="col-md-4" id="mmr2_date">
                        <div class="form-group">                        
                          <label class="form-control-label">Date</label>
                          <input class="form-control datepicker" type="text" id="mmr2date" value="<?php echo $today_date_for_datepicker; ?>">
                        </div>
                      </div>
                    <?php
                      }
                    ?>
                    
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">Meningococcal</label>
                        <select class="form-control" id="meningococcal" name="meningococcal" onchange="show_meningco()">
                          <?php
                            if($meningococcal=='non-vaccinated') {
                              echo "<option value='$meningococcal' selected=selected>$meningococcal</option>";
                              echo "<option value='vaccinated'>Vaccinated</option>";
                            } else {
                              echo "<option value='$meningococcal' selected=selected>$meningococcal</option>";
                              echo "<option value='non-vaccinated'>Non Vaccinated</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <?php
                      if($polio=='vaccinated') {
                    ?>
                      <div class="col-md-4">
                        <div class="form-group">                        
                          <label class="form-control-label">Date</label>
                          <input class="form-control datepicker" type="text" id="meningococcaldate" value="<?php echo $meningococcal_date; ?>">
                        </div>
                      </div>
                    <?php
                      } else {
                    ?>
                      <div class="col-md-4" id="meningco_date">
                      <div class="form-group">                        
                        <label class="form-control-label" for="exampleDatepicker">Date</label>
                        <input class="form-control datepicker" type="text" id="meningococcaldate" value="<?php echo $today_date_for_datepicker; ?>">
                      </div>
                    </div>
                    <?php
                      }
                    ?>
                    
                  </div>
                </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <h3 class="mb-0">Kindly Check all the fields before <strong>update</strong> </h3><br>  
                       <input type="button" name="lab_result_form" id="lab_result_form" class="btn btn-danger" value="Update Result" onclick="lab_result_update();">
                    </div>
                  </div>
                  <p id="respond_lab_result"></p>

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
<script type="text/javascript">
  
  function show_polio_date(){

    document.getElementById("polio_date").style.display = "block";
      //document.getElementByID('poliodate').style.display = "block";
  }
  function show_mmr1(){

    document.getElementById("mmr1_date").style.display = "block";
      //document.getElementByID('poliodate').style.display = "block";
  }
  function show_mmr2(){

    document.getElementById("mmr2_date").style.display = "block";
      //document.getElementByID('poliodate').style.display = "block";
  }
  function show_meningco(){

    document.getElementById("meningco_date").style.display = "block";
      //document.getElementByID('poliodate').style.display = "block";
  }
</script>

<script src="assets/js/system_script.js"></script>
</body>
</html>
<?php
}
?>