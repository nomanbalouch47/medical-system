<?php 
include('include/functions.php');
$process_id=5;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,3);
}
?>

<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<body>
    <style type="text/css">
    #verify_fail,#verify_success,#xray,#biometric_fail
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
    <!-- Form for Token System -->
   <form method="post" action=""> 
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">X-Ray Module</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">X-Ray</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-warning btn-sm" target="_self">New/Reload</button></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <h6 class="h2 text-white d-inline-block mb-0">
                <?php
                if(now_serving_rights($loginuser,3)==1){
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

<div class="row">
        <div class="col-lg-6">
          <div class="card-wrapper">

            <!-- Biometric Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">BIOMETRIC AREA
                  <input class="form-control" type="text" style="width: 200px; float: right;" name="cand_identity" id="cand_identity" autofocus="autofocus" >
                  </h3>
                  
                  <p id="cand_template" style="display: none;" ></p>
              </div>
              <!-- Card body -->
              <div class="card-body">
                
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
               <?php
                if(biometric_rights($loginuser,3) == 1){
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

            <!-- Candidate Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">CANDIDATE INFO</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                 
                
                  <p id="cand_result"></p>
                  
               
                
              
              
                  <button type="button" class="btn btn-success" id="xray" onclick="xray_verified();">Verified</button>
              </div>
               <p id="xray_result"></p>
            </div>
            <!-- End Candidate Info -->
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
              <form onkeypress="return event.keyCode != 13;">
              <div class="card-body">
          
                  <div class="row">

                     <?php
                      if(barcode_rights($loginuser,3)==1){
                        ?>
                        <div class="col-md-6">
                    <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">Barcode</label>
                          <input class="form-control" type="password" name="barcode" id="barcode" onkeyup="get_candidate_record(event,'xray')">
                      </div>
                    </div>
                        <?php
                      }

                      ?>

                      <?php
                      if(date_search_rights($loginuser,3)==1){
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
                          <input class="form-control" type="text" id="serial" onkeyup="get_candidate_record(event,'xray')">
                      </div>
                    </div>
                  </div>
            
              </div>
              </form>
            </div>

              </div>
            </div>
            <?php //echo candidate_xray(); ?>
<!--             <img src="" id="profile-img-tag" width="600px" /> -->
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
          get_candidate_with_biometric(cand_ident,'xray');

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

</script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#file").change(function(){
        readURL(this);
    });
</script>
<script src="assets/js/secugen.js"></script>
<script src="assets/js/system_script.js"></script>
</html>