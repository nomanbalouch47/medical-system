<?php 
include('include/functions.php');
$process_id=1;

if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,1);
}
?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
  
  #errorclass,#biometricError,#tokenError,#registration,#verify_fail,#verify_success
  {
    display:none;
  }
</style>
<script src= 
"https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"> 
    </script> 
<body>
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
  <?php include_once('include/topnav.php'); ?>
    <!-- Header -->
    <!-- Header -->
    
<form method="post" action="">
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">REGISTRATION - Repeat Cases</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Register</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                </ol>
              </nav>
            </div>

            <?php
            if(isset($_GET['token']))
            {
              $token_number = $_GET['token'];
            }
            ?>
            <div class="col-lg-6 col-5 text-right">
              <h6 class="h2 text-white d-inline-block mb-0">Now serving: <?php echo $token_prefix.$token_number; ?></h6>
              <input type="hidden" name="token_number" id="token_number" value="<?php echo $token_number; ?>">
              <input type="hidden" name="processid" value="<?php echo $process_id; ?>">
              <!-- <input type="submit" name="call_token" class="btn btn-sm btn-neutral" value="New"> -->
            </div>
          </div>
        </div>
      </div>

    </div>
  </form>
    <!-- Page content -->

    <div class="container-fluid mt--6">
                        <div class="alert alert-success alert-dismissible fade show col-md-offset-2" id="verify_success" role="alert">   
                            <span class="alert-text"><strong>Verification Success!</strong> Candidate Verified!</span>
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
 <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
          <div class="card-wrapper">

            <!-- Biometric Info -->
            <form method="post" action="">
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">BIOMETRIC AREA
                 
                  </h3>
                  
                  <p id="cand_template" style="display: none;"></p>
              </div>

            </form>
              <!-- Card body -->
              <form>
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
                </form>
                <?php
                if(biometric_rights($loginuser,1) == 1){
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
            



          </div>


        </div>

            <div class="col-sm-6 col-md-6 col-lg-6">
          <div class="card-wrapper">

            <!-- Biometric Info -->
            
            <div class="card">
              <!-- Card header -->
              
              <div class="card-header">
                <h3 class="mb-0">
                  </h3>
                  
                 
              </div>

              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                         <label class="form-control-label" >Passport No:</label>
                       <input class="form-control" type="text"  name="cand_identity" id="cand_identity" autofocus="autofocus" placeholder="Passport No:" onkeyup="get_repeat_case2(event)">
                      </div>
                      
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" >Country</label>
                              <select class="form-control"  id="country">
                                <option value="">Select</option>
                                  <?php
                                $country = $data->query("select Name from tb_country order by Name ASC");
                                while ($rows=mysqli_fetch_array($country)) {
                                  $country_name = $rows['Name'];
                                  echo "<option value='$country_name'>$country_name</option>";
                                
                                }
                                ?>
                              </select>
                      </div>
                    </div>
                  
                  

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label">Ref: Slip Issue Date</label>
                            <input class="form-control" name="ref_slip_issue_date" placeholder="dd/mm/yyyy" type="text" id="ref_slip_issue_date">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label">Ref: Slip Expiry</label>
                            <input class="form-control" name="ref_slip_exp_date" placeholder="dd/mm/yyyy" type="text" id="ref_slip_exp_date">
                          </div>
                        </div>

                  </div>
                </form>
                     
                     
              </div>
             
             
              </div>
            </div>
          
        </div>
      
       <p id="cand_result"></p>
         

            
      </div>
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


<!-- biometric scripts area -->
<script type="text/javascript">

    var template_1 = "";
    var db_template = "";
    var verified_template = "";
    var cand_ident = document.getElementById("cand_identity").value;
    var process_ID = document.getElementById("processid").value;
    document.getElementById("pregnancy").disabled = true;
    document.getElementById("printslip").disabled = true;

    
      // get_repeat_case2(event,cand_ident);
    
    

    
    function biofunction(){

      var cand_ident = document.getElementById("cand_identity").value;
      if(cand_ident == ""){
         alert('Please enter Code or Passport No');
      }else{
        //get_biomteric_with_code(cand_ident);
        get_biomteric_repeat_case(cand_ident);
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
          get_repeat_case(cand_ident);
          
           $(function(){
             $('#verify_success').delay(5000).fadeOut();
            });
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

function show_pregnancy(){

    var gender = document.getElementById("gender").value;
    if(gender == 'Female'){

      document.getElementById("pregnancy").disabled = false; //.style.display = "block";  
    }else{
      document.getElementById("pregnancy").disabled = true;  
    }
  }


</script>
<script src="assets/js/secugen.js"></script>
<script src="assets/js/system_script.js"></script>
</body>
</html>