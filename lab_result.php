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
?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
  
  #errorclass,#barcodeError,#alreadyexistError,#polio_date,#meningco_date,#mmr2_date,#mmr1_date,#barcodeSuccess
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
                  <li class="breadcrumb-item"><a href="#">LAB RESULT</a></li>
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
        <span class="alert-text"><strong>Warning!</strong>  Invalid Lab Sticker!  </span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

          <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="alreadyexistError" role="alert">   
        <span class="alert-text"><strong>Warning!</strong> Result Already Uploaded! </span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="alert alert-success alert-dismissible fade show col-md-offset-2" id="barcodeSuccess" role="alert">   
        <span class="alert-text"><strong>Success!</strong> Candidate Verified!</span>
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
              <!-- <div class="card-header">
                <h3 class="mb-0">Search Candidate</h3>
              </div> -->
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="" onkeypress="return event.keyCode != 13;">
                  <div class="row">
                    <!-- <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Barcode</label>
                        
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                            <input class="form-control" name="barcode" id="barcode" placeholder="Barcode" type="password">

                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Barcode</label>
                        <input type="hidden" name="search_from" id="search_from" value="<?php echo $process_id; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
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
                    </div>
                    <?php

                      if(date_search_rights($loginuser,19)==1){
                        ?>
                        <!-- <input type="hidden" name="search_from" id="search_from" value="<?php echo $process_id; ?>">
                        
                        <input type="hidden" name="processid" id="processid" value="<?php echo $process_id; ?>"> -->
                        <div class="col-md-4">
                          <div class="form-group">
                            <a href="search_lab_result" target="_blank"><button class="btn btn-icon btn-primary" type="button" id="snap" style="float: right;">
                             <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                             <span class="btn-inner--text">Edit</span>
                          </button></a>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">Date</label>
                              <input class="form-control" type="date" id="search_with_date" placeholder="mm/dd/yyyy">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">                     
                              <label class="form-control-label" for="exampleDatepicker">Serial Number</label>
                              <input class="form-control" type="text" id="serial" onkeyup="get_candidate_record_lab_result(event)">
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
                          <option value="positive">Positive</option>
                          <option value="negative">Negative</option>
                          <option value="see notes">See Notes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">HBsAg</label>
                        <select class="form-control" name="hbs_ag" id="hbs_ag">
                          <option value="positive">Positive</option>
                          <option value="negative">Negative</option>
                          <option value="see notes">See Notes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                        
                        <label class="form-control-label">HIV 1.2</label>
                        <select class="form-control" name="hiv" id="hiv">
                          <option value="positive">Positive</option>
                          <option value="negative">Negative</option>
                          <option value="see notes">See Notes</option>
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
                          <option value="positive">Positive</option>
                          <option value="negative">Negative</option>
                          <option value="see notes">See Notes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label">TPHA (<SPAN><i class="text-warning mb-0">if VDRL is positive</i> )</SPAN></label>
                        <select class="form-control" name="tpha" id="tpha">
                          <option value="positive">Positive</option>
                          <option value="negative">Negative</option>
                          <option value="see notes">See Notes</option>
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
                        <input class="form-control" type="text" name="rbs" id="rbs">
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
                        <input class="form-control" type="text" placeholder="Normal Range 0.05-1.20" name="bil" id="bil">
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                        
                        <label class="form-control-label">ALT (<SPAN><i class="text-warning mb-0"> U/L</i> )</SPAN></label>
                        <input class="form-control" type="text" placeholder="Normal Range 10-40 U/L" name="alt" id="alt">
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">AST (<SPAN><i class="text-warning mb-0"> U/L</i> )</SPAN></label>
                        <input class="form-control"  type="text" placeholder="Normal Range 10-40 U/L" name="ast" id="ast">
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label">ALK (<SPAN><i class="text-warning mb-0">PO4 U/L</i> )</SPAN></label>
                        <input class="form-control"  type="text" placeholder="Normal Range 100-200 U/L" name="alk" id="alk">
                      </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">                     
                          <label class="form-control-label">Creatinine</label>
                          <input class="form-control"  type="text" placeholder="Normal Range 0.05-1.20" name="creatinine" id="creatinine">
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
                          <option value="A+">A+</option>
                          <option value="B+">B+</option>
                          <option value="AB+">AB+</option>
                          <option value="A-">A-</option>
                          <option value="B-">B-</option>
                          <option value="AB-">AB-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label" for="exampleDatepicker">Haemoglobin</label>
                        <input class="form-control"  type="text" placeholder="Normal Range 12-17 g/dl" name="haemoglobin" id="haemoglobin">
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
                              <option value="absent">Absent</option>
                              <option value="present">Present</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">                     
                            <label class="form-control-label">Micro filariae</label>
                            <select class="form-control" name="micro_filariae" id="micro_filariae" >
                              <option value="absent">Absent</option>
                              <option value="present">Present</option>
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
                        <option value="negative">Negative</option>
                        <option value="positive">Positive</option>
                        <option value="see notes">See Notes</option>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label">Albumin</label>
                      <select class="form-control" name="albumin" id="albumin">
                        <option value="negative">Negative</option>
                        <option value="positive">Positive</option>
                        <option value="see notes">See Notes</option>
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
                          <option value="absent">Absent</option>
                          <option value="present">Present</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">OVA</label>
                        <select class="form-control" name="ova" id="ova">
                          <option value="absent">Absent</option>
                          <option value="present">Present</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">                     
                      <label class="form-control-label">CYST</label>
                      <select class="form-control" name="cyst" id="cyst">
                        <option value="absent">Absent</option>
                        <option value="present">Present</option>
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
                        <option value="absent">Absent</option>
                        <option value="present">Present</option>
                      </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <label class="form-control-label">Pregnancy Test (<SPAN><i class="text-warning mb-0"> for females</i> )</SPAN></label>
                        <select class="form-control" name="pragnancy_test" id="pragnancy_test">
                          <option value="- - - - - -">- - - - - - - - - - - - -</option>
                          <option value="negative">Negative</option>
                          <option value="positive">Positive</option>
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
                      <select class="form-control" id="polio" onchange="show_polio_date()">
                        <option value="non-vaccinated">Non Vaccinated</option>
                        <option value="vaccinated">Vaccinated</option>
                      </select>
                    </div>
                    </div>
                    <div class="col-md-4" id="polio_date">
                      <div class="form-group">                        
                        <label class="form-control-label">Date</label>
                        <input class="form-control datepicker" type="text" id="poliodate" value="<?php echo $today_date_for_datepicker; ?>">
                      </div>
                    </div>
                  </div>

                    <!-- <p id="date_polio"></p> -->
                    <div class="row">
                    <div class="col-md-4" >
                      <div class="form-group">                     
                        <label class="form-control-label">MMR1</label>
                        <select class="form-control" id="mmr1"  onchange="show_mmr1()">
                          <option value="non-vaccinated">Non Vaccinated</option>
                          <option value="vaccinated">Vaccinated</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-4" id="mmr1_date">
                      <div class="form-group">                        
                        <label class="form-control-label">Date</label>
                        <input class="form-control datepicker" type="text" id="mmr1date" value="<?php echo $today_date_for_datepicker; ?>">
                      </div>
                    </div>
                    </div>
                  
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">MMR2</label>
                        <select class="form-control" id="mmr2" onchange="show_mmr2()">
                          <option value="non-vaccinated">Non Vaccinated</option>
                          <option value="vaccinated">Vaccinated</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4" id="mmr2_date">
                      <div class="form-group">                        
                        <label class="form-control-label">Date</label>
                        <input class="form-control datepicker" type="text" id="mmr2date" value="<?php echo $today_date_for_datepicker; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <label class="form-control-label">Meningococcal</label>
                        <select class="form-control" id="meningococcal" onchange="show_meningco()">
                          <option value="non-vaccinated">Non Vaccinated</option>
                          <option value="vaccinated">Vaccinated</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4" id="meningco_date">
                      <div class="form-group">                        
                        <label class="form-control-label" for="exampleDatepicker">Date</label>
                        <input class="form-control datepicker" type="text" id="meningococcaldate" value="<?php echo $today_date_for_datepicker; ?>">
                      </div>
                    </div>
                  </div>
                </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <h3 class="mb-0">Kindly Check all the fields before <strong>&ensp; Save Result</strong> </h3><br>  
                      <button name="lab_result_form" id="lab_result_form" class="btn btn-icon btn-primary my-2" onclick="lab_result();" type="button">
                        <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                        <span class="btn-inner--text">Save Result</span>
                      </button>
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