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
  
  #errorclass,#biometricError,#tokenError
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
              <h6 class="h2 text-white d-inline-block mb-0">REGISTRATION</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Register</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 text-right">
                
              <select id="country" onchange="show_pregnancy();" >
                <option value="">- Select token -</option>
                  <?php
                  $country = $data->query("select token_no from tb_tokens ");
                  while ($rows=mysqli_fetch_array($country)) {
                    $country_name = $rows['Name'];
                    echo "<option value='$country_name'>$country_name</option>";
                  
                  }
                  ?>
              </select>        
              <h6 class="h2 text-white d-inline-block mb-0">Now serving: <?php echo $token_prefix.$current_token = get_current_token(); ?>  | In Queue <?php echo tokens_in_queue($process_id); ?> </h6> &nbsp;
              
              <input type="hidden" name="token_number" id="token_number" value="<?php echo $current_token; ?>">
              <input type="hidden" name="processid" value="<?php echo $process_id; ?>">
              <input type="hidden" id="counter" name="counter">
              <input type="submit" name="call_token" class="btn btn-sm btn-neutral" value="New">

            </div>
          </div>
        </div>
      </div>

    </div>
  </form>
    <!-- Page content -->

    <div class="container-fluid mt--6">
                           
      <div class="row">
        <div class="col-lg-6">
          <div class="card-wrapper">

            <!-- Biometric Info -->

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

            <div class="card">

              <!-- Card header -->
              <div class="card-header">
                  <h3 class="mb-0">BIOMETRIC & PICTURE AREA</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <img id="FPImage1" alt="Fingerpint Image" src=".\assets\img\PlaceFinger.bmp" height=400 width=210 align="center" class="img-thumbnail">
                      </div>
                    </div>
                    <div class="col-md-6 ml-n5">
                      <div class="form-group">
                       <video id="video" width="340" height="280" autoplay></video>
                        <button class="btn btn-icon btn-primary" type="button" id="snap" style="float: right;">
                         <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                         <span class="btn-inner--text">Snap Photo</span>
                      </button>
                      </div>

                    </div>
                      
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <canvas id="canvas" width="440" height="270" class="img-thumbnail"></canvas>
                    </div>
                       
                  </div>
                  <!-- <div class="row input-daterange datepicker align-items-center">
                    <div class="col">
                      <div class="form-group">
                        <label class="form-control-label">Connected Devices</label>
                        
                        <form>
                          <select class="form-control" data-toggle="select">
                            <option>select</option>
                            <option>Badges</option>
                            <option>Buttons</option>
                            <option>Cards</option>
                            <option>Forms</option>
                            <option>Modals</option>
                          </select>
                        </form>
                      
                      </div>
                    </div>
                   
                  </div> -->
                </form>
               <button type="button" value="Click to Scan" onclick="captureFP()" class="btn btn-success">Scan</button>

               
             

                <div id="img" style="display:none;"> 
                            <img src="" id="newimg" class="top" /> 
                        </div> 

                <button class="btn btn-icon btn-primary" type="button" id="geeks" >
                  <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                  <span class="btn-inner--text">Save Picture</span>
                </button>
                <div id="img_result"></div>
                <input type="hidden" name="img_name" id="img_name">
               <p id="result"/><p>
              </div>
            </div>

            <!-- General Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">GENERAL INFO</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">Date</label>
                          <input class="form-control" type="text" id="regdate" value="<?php echo $today_date_for_datepicker; ?>" placeholder="dd/mm/yyyy" required>
                          <span class="calendar-grid-58"></span>
                      
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">                     
                          <label class="form-control-label" for="exampleDatepicker">Serial Number</label>
                          <input class="form-control" placeholder="Serial Number" type="text" id="serialnum">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   <!--  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label" for="exampleDatepicker">Key</label>  
                          <input class="form-control" placeholder="Key" type="text" id="key">
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label" for="exampleDatepicker">Agency</label>
                          <select class="form-control"  id="agency">
                                  <?php
                                $agency = $data->query("select agency from tb_agency");
                                while ($rows=mysqli_fetch_array($agency)) {
                                  $agency_name = $rows['agency'];
                                  echo "<option value='$agency_name'>$agency_name</option>";
                                
                                }
                                ?>
                              </select>
                      </div>
                    </div>
                     <div class="col-md-6">
                          <div class="form-group">
                            <form>
                              <label class="form-control-label" for="exampleDatepicker">Country</label>
                              <select class="form-control"  id="country" onchange="show_pregnancy();">
                                  <?php
                                $country = $data->query("select Name from tb_country order by Name ASC");
                                while ($rows=mysqli_fetch_array($country)) {
                                  $country_name = $rows['Name'];
                                  echo "<option value='$country_name'>$country_name</option>";
                                
                                }
                                ?>
                              </select>
                            </form>
                        </div>
                      </div>
                  </div>
                  <!-- Input groups with icon -->
                  <div class="row">
                     <!-- Card body -->
                     
                    <!-- Card body -->
                      <div class="col-md-6">
                          <div class="form-group">
                            <form>
                              <label class="form-control-label" for="exampleDatepicker">Profession</label>
                              <select class="form-control" id="profession">
                                <?php
                                $profession = $data->query("select profession from tb_profession");
                                while ($rows=mysqli_fetch_array($profession)) {
                                  $profession_name = $rows['profession'];
                                  echo "<option value='$profession_name'>$profession_name</option>";
                                
                                }
                                ?>
                              </select>
                            </form>
                        </div>
                      </div>
                       <div class="col-md-3">
                      <div class="form-group">
                            <label class="form-control-label" for="exampleDatepicker">Fees Charged</label>
                            <input class="form-control" placeholder="Fees" id="fees" type="number" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                            <label class="form-control-label" for="exampleDatepicker">Discount</label>
                            <input class="form-control" placeholder="Discount" id="disc" type="number">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                     
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
                <h3 class="mb-0">PASSPORT INFO </h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form method="post" id="import_form" enctype="multipart/form-data">
                  <div class="row">
                     <!-- <div class="col-md-6">
                      <div class="form-group">   
                        <label>Select XML File</label>
                          <input type="file" name="file" id="file" />                     
                          
                      </div>
                    </div> -->
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="button" id="submitdata" class="btn btn-info getppinfo" value="Import" />
                        <input type="button" name="btn_repeat" onclick="repeat_case();" id="btn_repeat" class="btn btn-primary" value="Repeat Case" />

                        <span style="float: right;">
                          <label>Select Counter</label>
                        <select name="counter_no" id="counter_no" class="form-control">
                          <?php
                            if($loginuser==19) {
                          ?>
                              <option value="1">Counter 1</option>
                              <option value="2">Counter 2</option>
                              <option value="3">Counter 3</option>
                          <?php  
                            } 
                            else {
                              $place = $data->query("select counter_no from user_action_rights where user_id='$loginuser' and module_id='$process_id'");
                              while ($rows=mysqli_fetch_array($place)) {
                                $counter_no = $rows['counter_no'];
                                if($counter_no!='0')
                                  echo "<option value='$counter_no' selected=selected>Counter $counter_no</option>";
                              }
                            }
                          ?>
                        </select>
                        </span>

                        
                      </div>
                    </div>
                  </div>
                   </form>
                   <div class='row align-items-center'>
                    
                      
                   </div> 
                  <span id="message"></span>
              </div>
            </div>
            </div>

            <div class="card-wrapper">
            
            <div class="card">
             
              <div class="card-header">
                <h3 class="mb-0">OTHER INFO </h3>
              </div>
             
              <div class="card-body">
                
                   <div class='row align-items-center'>
                    <div class="col-md-4">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">Barcode</label>
                          <?php $bar =barcode_generation(); ?>
                          <input class="form-control" type="text" name="barcode" id="barcode" value="<?php echo $bar; ?>" readonly>
                      </div>
                    </div>
                   <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label">Place of Issue</label>
                       
                          <select class="form-control"  name="placeofissue" id="placeofissue" autofocus='autofocus'>
                             <?php

                                $place = $data->query("select place_of_issue from tb_place_of_issue");
                                while ($rows=mysqli_fetch_array($place)) {
                                  $place_name = $rows['place_of_issue'];
                                  echo "<option value='$place_name'>$place_name</option>";
                                
                                }

                                ?>
                          </select>
                       
                      </div>
                    </div>
                    <div class='col-md-4'>
                      <div class='form-group'>
                        <label class='form-control-label'>PP Issue Date</label>
                        <input class='form-control' type='datetime' placeholder='dd/mm/yyyy' id='ppissuedate' onkeyup='candidate_already_check(event)'>                       
                      </div>
                    </div>

                   </div>
                   
                  <span id="message"></span>  
                     <div class="row align-items-center">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label">Ref: Slip Issue Date</label>
                          <input class="form-control" name="ref_slip_issue_date" placeholder="mm/dd/yyyy" type="date" id="ref_slip_issue_date">
                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label">Ref: Slip Expiry</label>
                          <input class="form-control" name="ref_slip_exp_date" placeholder="mm/dd/yyyy" type="date" id="ref_slip_exp_date">
                        </div>
                      </div>
                       
                     </div>
                  
               
              </div>
            </div>
            </div>


            <!-- Candidate Info -->
            <div class="card-wrapper">
            <!-- Tags -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">CANDIDATE INFO</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <div class="row">
                    
                   
                    
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">CNIC </label>
                        <input class="form-control" placeholder="Enter CNIC Number" id="cnic" type="text" >
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">S/O W/O D/O</label>
                          <select class="form-control" name="d_o" id="d_o" onkeyup="candidate_already_check(event)">
                            <option value="S/O">S/O</option>
                            <option value="W/O">W/O</option>
                            <option value="D/O">D/O</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Father Name / Husband Name</label>
                        <input class="form-control" placeholder="Enter Name" id="sonof" type="text">
                      </div>
                    </div>
                      
                   <!--  <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">D.O.B</label>                        
                        <input class="form-control" placeholder="dd/mm/yyyy" type="text" id="dob">
                      </div>
                    </div> -->
                    <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Phone Number 1</label>
                                <input class="form-control" placeholder="Enter Phone Number" id="phone" type="text">
                              </div>
                             
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Phone Number 2</label>
                                <input class="form-control" placeholder="Enter Phone Number" id="phone1" type="text">
                              </div>
                             
                           </div>
                    
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-control-label">Marital Status</label>
                                  <select class="form-control"  name="mart_status" id="mart_status">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                  </select>
                              </div>
                              
                           </div>
                           <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-control-label" for="exampleFormControlTextarea1">Remarks</label>
                              <textarea class="form-control"  id="remarks" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mb-3" id="preg">
                                  <input class="custom-control-input" id="pregnancy" value="1" type="checkbox">
                                  <label class="custom-control-label" for="pregnancy">Pregnancy Test</label>
                                </div>
                              </div>
                          </div>
                         </div>
                         <div class="col-md-12">
                          <div class="form-group">
                            <h3 class="mb-0">Kindly Fill Up All Field Before Registration</h3><br>
                            <button type="button" id="registration" onclick="cand_registration()" class="btn btn-primary">Register</button>
                            <a href="reports/registration_slip?barcode=<?php echo $bar; ?>" target="_blank">
                              <button type="button" id="printslip" class="btn btn-default">Print</button></a>
                            <a href="registered_user_search" target="_blank"><button type="button" id="search" class="btn btn-warning">Search</button></a>
                            <a href="edit_registration" target="_blank"><button type="button" id="edit" class="btn btn-success">Edit</button></a>

                          </div>
                            <p id="reg_result"></p>
                            <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="errorclass" role="alert">   
                            <span class="alert-text"><strong>Warning!</strong> Please fill out complete form!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                           <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="biometricError" role="alert">   
                            <span class="alert-text"><strong>Warning!</strong> Please Scan Finger!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="alert alert-danger alert-dismissible fade show col-md-offset-2" id="tokenError" role="alert">   
                            <span class="alert-text"><strong>Warning!</strong> Missing Ticket Number!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                        </div>

                  </div>

                </form>
                 
              </div>
            </div>
            </div>
            
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


<!-- passport import area -->
<script>
$(document).ready(function(){
  var counterNum = document.getElementById('counter_no').value;
  document.getElementById("counter").value = counterNum;
});
// function counterSelect() {
//   var counterNum = document.getElementById('counter_no').value;
//   document.getElementById("counter").value = counterNum;
// }

  var counterNum = document.getElementById('counter_no').value;
  $(document).ready(function(){

    $(".getppinfo").click(function(){
          
              $.ajax({
              url:"pp_import.php",
              method:"POST",
              data:{

                counter_no:counterNum
              },  
              beforeSend: function () {
                    $('#submitdata').attr('disabled','disabled'),
                    $('#submitdata').val('Importing...');
              },
                  
              success:function(data)
              {
                    $('#message').html(data);
                    $('#submitdata').attr('disabled', false);
                    $('#submitdata').val('Import');
              }
              
              });
      
      });

  });

// $(document).ready(function(){
//  $('#import_form').on('submit', function(event){
//   event.preventDefault();

//   $.ajax({
//    url:"pp_import.php",
//    method:"POST",
//    data:{
//     formdata : new FormData(this),
//     counter_no : counterNum
//    } 
//    contentType:false,
//    cache:false,
//    processData:false,
//    beforeSend:function(){
//     $('#submit').attr('disabled','disabled'),
//     $('#submit').val('Importing...');
//    },
//    success:function(data)
//    {
//     $('#message').html(data);
//     $('#import_form')[0].reset();
//     $('#submit').attr('disabled', false);
//     $('#submit').val('Import');
//    }
//   })

//   // setInterval(function(){
//   //  $('#message').html('');
//   // }, 5000);

//  });
// });
</script>

<!-- biometric scripts area -->
<script type="text/javascript">

document.getElementById("pregnancy").disabled = true;

function show_pregnancy(){

    var gender = document.getElementById("gender").value;
    if(gender == 'Female'){

      document.getElementById("pregnancy").disabled = false; //.style.display = "block";  
    }else{
      document.getElementById("pregnancy").disabled = true;  
    }
    
      //document.getElementByID('poliodate').style.display = "block";
  }

//camera script
  // Grab elements, create settings, etc.
  var form_name = "Save Picture";
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        //video.src = window.URL.createObjectURL(stream);
        video.srcObject = stream;
        video.play();
    });
}

/* Legacy code below: getUserMedia 
else if(navigator.getUserMedia) { // Standard
    navigator.getUserMedia({ video: true }, function(stream) {
        video.src = stream;
        video.play();
    }, errBack);
} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
    navigator.webkitGetUserMedia({ video: true }, function(stream){
        video.src = window.webkitURL.createObjectURL(stream);
        video.play();
    }, errBack);
} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
    navigator.mozGetUserMedia({ video: true }, function(stream){
        video.srcObject = stream;
        video.play();
    }, errBack);
}
*/
// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
  context.drawImage(video, 0, 0, 440, 270);
});

// function convertCanvasToImage() {
//   var canvas = document.getElementById('canvas');
//   var image = new Image();
//   image.src = canvas.toDataURL("image/png");
//   return image;
// }


$(function() { 

  
            $("#geeks").click(function() { 

              
              
              if(document.getElementById('passport')) {

                html2canvas($("#canvas"), { 
                    onrendered: function(canvas) { 
                        var imgsrc = canvas.toDataURL("image/png"); 
                        //console.log(imgsrc); 
                        $("#newimg").attr('src', imgsrc); 
                        
                        var passport = document.getElementById('passport').value;

                        //$("#img").show(); 
                        var dataURL = canvas.toDataURL(); 
                        $.ajax({ 
                            type: "POST", 
                            url: '././include/functions.php',
                            data: { 
                                form_name : form_name,
                                imgBase64: dataURL,
                                passport: passport 
                            } 
                        }).done(function(data) {
                            $('#img_result').html(data); 
                            //console.log('saved'); 
                        }); 
                    } 
                }); 
                }
            else {
                alert("To Save Candidate Image, Import Passport Info First!");
            } 
            });
            
        }); 
//camera script end


var secugen_lic = "";
var template_1;
document.getElementById("printslip").disabled = true;

function captureFP() {
    CallSGIFPGetData(SuccessFunc, ErrorFunc);
}

function SuccessFunc(result) {
        if (result.ErrorCode == 0) {
            /*  Display BMP data in image tag
                BMP data is in base 64 format 
            */
            if (result != null && result.BMPBase64.length > 0) {
                document.getElementById('FPImage1').src = "data:image/bmp;base64," + result.BMPBase64;
            }
            template_1 = result.TemplateBase64;

            //console.log(template_1);
            
        }
        else {
            alert("Fingerprint Capture Error Code:  " + result.ErrorCode + ".\nDescription:  " + ErrorCodeToString(result.ErrorCode) + ".");
        }
    }

function ErrorFunc(status) {

    /*  
        If you reach here, user is probabaly not running the 
        service. Redirect the user to a page where he can download the
        executable and install it. 
    */
    alert("Check if SGIBIOSRV is running; Status = " + status + ":");

}


function CallSGIFPGetData(successCall, failCall) {
    //var uri = "https://localhost:8000/SGIFPCapture";
    var uri = "https://localhost:8443/SGIFPCapture";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            fpobject = JSON.parse(xmlhttp.responseText);
            successCall(fpobject);
        }
        else if (xmlhttp.status == 404) {
            failCall(xmlhttp.status)
        }
    }
    var params = "Timeout=" + "10000";
    params += "&Quality=" + "50";
    params += "&licstr=" + encodeURIComponent(secugen_lic);
    params += "&templateFormat=" + "ISO";
    params += "&imageWSQRate=" + "0.75";
    xmlhttp.open("POST", uri, true);
    xmlhttp.send(params);

    xmlhttp.onerror = function () {
        failCall(xmlhttp.statusText);
    }
}


function repeat_case(){

  var token_no = document.getElementById('token_number').value;
  window.open("registration_repeat_case?token="+token_no,"_blank");
}
</script>

<script src="assets/js/system_script.js"></script>
<script src="assets/js/secugen.js"></script>
</body>
</html>