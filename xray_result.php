<?php 
include('include/functions.php');
$process_id=5;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  $center_id = $_SESSION['user_login']['center_id'];
  auth_user($loginuser,18);
}
?>

<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<body>
    <style type="text/css">
    #verify_fail,#verify_success
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
 
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">X-Ray Result</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">X-Ray</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                </ol>
              </nav>
            </div>
            
          </div>
        </div>
      </div>
    </div>

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
             <div class="alert alert-success alert-dismissible fade show col-md-offset-2" id="verify_success" role="alert">   
                            <span class="alert-text"><strong>Verification Success!</strong> Candidate Verified!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
      <!-- div class row here -->

      <div class="row">
        <div class="col-lg-8">
        <div class="card-wrapper">
  
   
    
         <div class="card">
            <div class="card-header">
              <h3 class="mb-0">X-Ray Result</h3>
            </div>
           
           <div class="card-body">
            <form method="post" action="include/upload_xray.php" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">                        
                    <label class="form-control-label" for="exampleDatepicker">Date</label>
                    <input class="form-control" type="date" placeholder="mm/dd/yyyy" id="xraydate" name="xraydate">
                    <span class="calendar-grid-58"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">                        
                    <label class="form-control-label">Serial No</label>
                    <input class="form-control" type="text" name="serial" id="serial">     
                    <input type="hidden" name="loginid" id="loginid" value="<?php echo $loginuser; ?>">
                    <input type="hidden" name="center_id" id="center_id" value="<?php echo $center_id; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">                        
                    <label class="form-control-label">Xray Images</label>
                  
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="files" name="files[]" lang="en" multiple>
                      <label class="custom-file-label" for="files">Select file</label>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">                        
                    <label class="form-control-label" for="item_2">X-Ray Chest</label>
                    <select class="form-control" name="xrayChest" id="xrayChest" required="required">
                      <option value="">-- select --</option>
                      <option value="lung fields clear">LUNG FIELDS CLEAR</option>
                      <option value="unfit due to x-ray findings">Unfit Due to X-Ray Findings.</option>
                      <option value="see notes">"See Notes"</option>
                    </select>
                </div>
             
                <div class="form-group">
                  <label class="form-control-label" for="exampleFormControlTextarea1">Remarks</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remarks"></textarea>
                </div>
              </div>
          
            </div>
            
        <!--     <button type="button" id="samplecollection" class="btn btn-primary">
              <span class="btn-inner--icon"><i class="ni ni-check-bold"></i> Save</span>
            </button> -->
            <input type="submit" name="cand_xray1" id="xray" class="btn btn-primary" value="Save" style="float: right;">
              <!-- <span class="btn-inner--icon"><i class="ni ni-check-bold"></i> Save</span> -->
            </form>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="gallery">
                  </div>
                  <!-- <button onclick="resetFile()">Reset file</button> -->
                </div>
              </div>
            </div>
            
            </div>
        </div>
        <?php upload_xray_result(); ?>
      </div>
      </div>
      <div class="col-lg-4">
        <div class="card-wrapper">
         <div class="card">
            <div class="card-header">
              <h3 class="mb-0">Search X-Ray Result</h3>
            </div>
           
           <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data">
              <div class="row">
              <div class="col-md-6">
                <div class="form-group">                        
                    <label class="form-control-label" for="exampleDatepicker">Date</label>
                    <input class="form-control" type="date" placeholder="mm/dd/yyyy" id="xraydate2" name="xraydate2">
                    <span class="calendar-grid-58"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">                        
                    <label class="form-control-label">Serial No</label>
                    <input class="form-control" type="text" name="serial2" id="serial2"> 
                    <input type="hidden" name="loginid" id="loginid" value="<?php echo $loginuser; ?>">
                    <input type="hidden" name="center_id" id="center_id" value="<?php echo $center_id; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <input type="submit" name="cand_xray" id="xray" class="btn btn-primary" value="Search" style="float: right;">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
          <div class="col-lg-6">
            <div class="card-wrapper">
              <div class="card">
              <img src="" id="profile-img-tag" width="600px" />  
              </div>
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
  function closeModal() {
    document.getElementById('modal-default').style.display = "none";
  }
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

//     $(function() {
//     // Multiple images preview in browser
//     var imagesPreview = function(input, placeToInsertImagePreview) {

//         if (input.files) {
//             var filesAmount = input.files.length;

//             for (i = 0; i < filesAmount; i++) {
//                 var reader = new FileReader();

//                 reader.onload = function(event) {
//                     $($.parseHTML('<img class="img-thumbnail" style="width: 350px; height: 300px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
//                 }

//                 reader.readAsDataURL(input.files[i]);
//             }
//             $(".remove").click(function(){
//             //$(this).parent(".img-thumbnail").remove();
//             // $('.img-thumbnail').removeAttr('src');
//             $('.img-thumbnail').attr('src','').remove();
//             document.getElementById('files').value = "";
//             // $('.img-thumbnail').attr('src','').remove();
            
//             // $('#files').val('');
//             // $('#files').val("");
//           });
//         }

//     };

//     $('#files').on('change', function() {
//         imagesPreview(this, 'div.gallery');
//     });
// });

// function resetFile() {
//   document.getElementById("files").value = "";
// }

$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $('<img class=img-thumbnail style=width:100px; height:100px; id=i src='+e.target.result+' name='+file.name+'>' +
            "<br><span class='btn btn-danger' id=i>Remove</span><p></p>").insertAfter("#files");
          $(".btn-danger").click(function(){

            document.getElementById("files").value="";
            $('#i').attr('src','').remove();
            document.getElementById("i").style.display = "none";

            });
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

</script>
</html> 