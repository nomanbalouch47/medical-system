<?php 
include('include/functions.php');
$process_id=1;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,27);
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
    <form>
      <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Registration Update</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Edit Registration</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-warning btn-sm" target="_self">New/Reload</button></li>
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
                    <?php
                      if(date_search_rights($loginuser,27)==1){
                        ?>
                        
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="input-group input-group-merge">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                              </div>
                                <input class="form-control" type="date" id="search_with_date" placeholder="mm/dd/yyyy">
                            </div>
                          </div>
                        </div>
                        
                    <?php
                      }

                      ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                            <input class="form-control" name="search_serial_no" placeholder="Serial Number" type="text">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                            <input class="form-control" name="search_passport_no" placeholder="Passport Number" type="text">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="search_candidate" value="SEARCH">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            <?php get_data_by_serial(); ?>
            </div>


          <!-- Passport Info -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">PASSPORT INFO</h3>
              </div>
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">Barcode</label>
                          <input class="form-control" type="text" name="barcode" value="<?php echo $barcode; ?>" readonly>
                          <input class="form-control" type="hidden" name="regid" value="<?php echo $reg_id; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Passport No (<SPAN><i class="text-warning mb-0">required</i> )</SPAN></label>
                        <input class="form-control" type="text" name="passport_no" placeholder="Passport Number" value="<?php echo $passport_no; ?>" required>
                      </div>
                    </div>
                  </div>
                  <div id="check_result"></div>
                  <div class="row input-daterange datepicker align-items-center">
                    <div class="col">
                      <div class="form-group">
                        <label class="form-control-label">Issue Date</label>
                        <input class="form-control" type="datetime" name="passport_issue_date" placeholder="Passport Issue Date" value="<?php echo $passport_issue_date; ?>">                       
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label class="form-control-label">Expiry Date</label>
                        <input class="form-control" type="datetime" name="passport_expiry_date" placeholder="Passport Expiry Date" value="<?php echo $passport_expiry_date; ?>">                       
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label class="form-control-label">Place of Issue</label>
                          <select class="form-control"  name="place_of_issue" id="placeofissue">
                             <?php
                                $place = $data->query("select place_of_issue from tb_place_of_issue");
                                while ($rows=mysqli_fetch_array($place)) {
                                  $place_name = $rows['place_of_issue'];
                                  if($place_name==$place_of_issue)
                                    echo "<option value='$place_name' selected=selected>$place_name</option>";
                                  else
                                    echo "<option value='$place_name'>$place_name</option>";
                                }
                                ?>
                          </select>
                      </div>
                    </div>
                  </div>
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
           
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">Date</label>
                          <input class="form-control" type="text" name="reg_date" value="<?php echo $reg_date; ?>" readonly>
                          <span class="calendar-grid-58"></span>
                      
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label" for="exampleDatepicker">Agency (<SPAN><i class="text-warning mb-0">required</i> )</SPAN></label>
                          <!-- <input class="form-control" placeholder="Agency" name="agency"  value="<?php echo $agency; ?>" type="text" required> -->
                          <select class="form-control" data-toggle="select" name="agency">
                                <?php
                                $nationality_name = $data->query("select agency from tb_agency");
                                while ($bm2=mysqli_fetch_array($nationality_name)) {
                                  $agency_name = $bm2['agency'];
                                  if($agency_name==$agency)
                                    echo "<option value='$agency_name' selected=selected>$agency_name</option>";
                                  else
                                    echo "<option value='$agency_name'>$agency_name</option>";
                                }
                                ?>
                              </select>
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
                        
                            <label class="form-control-label" for="exampleDatepicker">Country</label>
                            <select class="form-control" name="country">
                              <?php
                              $country_n = $data->query("select Name from tb_country");
                              while ($bm=mysqli_fetch_array($country_n)) {
                                $country_name = $bm['Name'];
                                if($country_name==$country)
                                  echo "<option value='$country_name' selected=selected>$country_name</option>";
                                else
                                  echo "<option value='$country_name'>$country_name</option>";
                              }
                              ?>
                            </select>
                     
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                        
                            <label class="form-control-label" for="exampleDatepicker">Profession</label>
                            <select class="form-control" data-toggle="select" name="profession">
                              <?php
                              $prof = $data->query("select profession from tb_profession");
                              while ($bm=mysqli_fetch_array($prof)) {
                                $country2 = $bm['profession'];
                                if($country2==$profession)
                                  echo "<option value='$country2' selected=selected>$country2</option>";
                                else
                                  echo "<option value='$country2'>$country2</option>";
                              }
                              ?>
                            </select>
                       
                        </div>
                      </div>
                  </div>
                  <!-- Input groups with icon -->
                  <div class="row">
                     <!-- Card body -->
                     <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Serial Number</label>
                        <input class="form-control" placeholder="Serial Number" name="serial_new" type="text" value="<?php echo $serial_no; ?>">
                      </div>
                      </div>
                    <!-- Card body -->
                      
                      <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Fees Charged</label>
                        <input class="form-control" placeholder="Fees" name="fee_charged" type="text" value="<?php echo $fee_charged; ?>">
                      </div>
                      </div>
                  </div>
                  <div class="row">
                     
                  </div>
             
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card-wrapper">

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
               
                  <div class="row">

                    <div class="col-md-12">
                      <div class="form-group">
                       <video id="video" width="340" height="280" autoplay></video>
                        <button class="btn btn-icon btn-primary" type="button" id="snap" style="float: right;">
                         <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                         <span class="btn-inner--text">Snap Photo</span>
                      </button>
                      </div>

                    </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <canvas id="canvas" width="440" height="270" class="img-thumbnail"></canvas>
                          <button class="btn btn-icon btn-primary" type="button" id="geeks" >
                          <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                          <span class="btn-inner--text">Save Picture</span>
                        </button>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <img src="assets/candidate_image/<?php echo $cand_img ?>" alt="..." class="img-thumbnail">
                          <label class="form-control-label" for="exampleDatepicker">Candidate (<SPAN><i class="text-warning mb-0">current picture</i> )</SPAN></label>
                      </div>
                      </div>
                      <div id="img" style="display:none;"> 
                          <img src="" id="newimg" class="top" /> 
                      </div>
                      <div class="col-md-12">
                        <div id="img_result"></div>
                      </div>
                    <input type="hidden" name="img_name" id="img_name">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Name (<SPAN><i class="text-warning mb-0">required</i> )</SPAN></label>
                        <input class="form-control" placeholder="Enter Name" name="candidate_name" type="text" value="<?php echo $candidate_name; ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">CNIC (<SPAN><i class="text-warning mb-0">required</i> )</SPAN></label>
                        <input class="form-control" placeholder="Enter CNIC Number" name="cnic" type="text" value="<?php echo $cnic; ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Father Name</label>
                        <input class="form-control" placeholder="Enter Name" name="son_of" type="text" value="<?php echo $son_of; ?>">
                      </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label" >Nationality</label>
                          <input class="form-control" placeholder="Nationality" name="nationality" type="text" value="<?php echo $nationality; ?>">
                        </div>
                      
                      </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">D.O.B</label>                        
                        <input class="form-control datepicker" placeholder="mm/dd/yyyy" name="d_o_b" type="text" value="<?php echo $d_o_b; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Phone Number 1</label>
                                <input class="form-control" placeholder="Enter Phone Number" name="phone_1" type="text" value="<?php echo $phone_1; ?>">
                              </div>
                             
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Phone Number 2</label>
                                <input class="form-control" placeholder="Enter Phone Number" name="phone_2" type="text" value="<?php echo $phone_2; ?>">
                              </div>
                             
                           </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-control-label">Gender</label>
                                  <select class="form-control" data-toggle="select" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                              </div>
                             
                           </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="exampleDatepicker">Remarks </label>
                                <textarea class="form-control"  name="remarks" rows="3"><?php echo $remarks; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="form-control-label">Maritial Status</label>
                                  <select class="form-control" data-toggle="select" name="marital_status" value="<?php echo $marital_status; ?>">
                                    <?php
                                      if($marital_status=='Married') {
                                        echo "<option value='$marital_status' selected=selected>$marital_status</option>";
                                        echo "<option value='Single'>Single</option>";
                                      }
                                        else {
                                          echo "<option value='$marital_status' selected=selected>$marital_status</option>";
                                          echo "<option value='Married'>Married</option>";
                                        }
                                    ?>
                                  </select>
                              </div>                         
                           </div>
                         </div>
                         <div class="col-md-12">
                          <div class="form-group">
                            <h3 class="mb-0">Kindly Check all the fields before <strong>update</strong> </h3><br>  
                             <input type="submit" name="update_by_serial_no" class="btn btn-danger" value="Update">
                             <input type="submit" name="update_and_print" class="btn btn-primary" value="Update & Print">
                          </div>
                      

                        </div>
               
                 
                </div>    
              </div>
            </div>
          </div>
          </div>
            </form>
       <?php edit_registered_candidate(); ?>
    
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
<script>
  //camera script
  // Grab elements, create settings, etc.
  var form_name = "Update Picture";
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
                html2canvas($("#canvas"), { 
                    onrendered: function(canvas) { 
                        var imgsrc = canvas.toDataURL("image/png"); 
                        //console.log(imgsrc); 
                        $("#newimg").attr('src', imgsrc); 
                        //$("#img").show(); 
                        var dataURL = canvas.toDataURL(); 
                        $.ajax({ 
                            type: "POST", 
                            url: '././include/functions.php',
                            data: { 
                                form_name : form_name,
                                imgBase64: dataURL 
                            } 
                        }).done(function(data) {
                            $('#img_result').html(data); 
                            //console.log('saved'); 
                        }); 
                    } 
                }); 
            }); 
        }); 
//camera script end
</script>
</body>
</html>