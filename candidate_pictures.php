<?php include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,43);
}
?>

<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<body>
  <style type="text/css">
    #danger,#success,#warning,#success_msg
    {
      display: none;
    }
  </style>
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel" aria-hidden="true">
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
              <h6 class="h2 text-white d-inline-block mb-0">Candidate Pictures</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-warning btn-sm" target="_self">New/Reload</button>
                  </li>
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
      <!-- div class row here -->
      <div class="alert alert-success alert-dismissible fade show col-md-offset-2" id="success_msg" role="alert">   
        <span class="alert-text"><strong> Success!</strong> Candidate Images Exist!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="alert alert-danger alert-dismissible fade show" id="danger" role="alert">
        <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
        <span class="alert-text"><strong>Danger!</strong>  No Record Found!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="alert alert-warning alert-dismissible fade show" id="warning" role="alert">
        <span class="alert-icon"><i class="ni ni-bell-55"></i></span>
        <span class="alert-text"><strong>Warning!</strong>  Record exists, but Images not found!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      
      <div id="success" class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;"><div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;"><div class="swal2-header"><ul class="swal2-progresssteps" style="display: none;"></ul><div class="swal2-icon swal2-error" style="display: none;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div><div class="swal2-icon swal2-question" style="display: none;"><span class="swal2-icon-text">?</span></div><div class="swal2-icon swal2-warning" style="display: none;"><span class="swal2-icon-text">!</span></div><div class="swal2-icon swal2-info" style="display: none;"><span class="swal2-icon-text">i</span></div><div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;"><div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div><span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div> <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div><div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div></div><img class="swal2-image" style="display: none;"><h2 class="swal2-title" id="swal2-title" style="display: flex;">Success</h2><button type="button" class="swal2-close" style="display: none;">×</button></div><div class="swal2-content"><div id="swal2-content" style="display: block;"> Candidate Images Found!</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
        <button class="swal2-confirm btn btn-success" onclick="closeSccessModal()" type="button">
          <span class="btn-inner--icon"><i class="ni ni-like-2"></i></span>
          <span class="btn-inner--text">OK</span>
        </button>
        <button type="button" class="swal2-cancel" aria-label="" style="display: none;">Cancel</button></div><div class="swal2-footer" style="display: none;"></div></div></div>


      <div class="row">
        <div class="col-lg-4">
          <div class="card-wrapper">
            <!-- User Creation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">Passport Number</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input class="form-control" name="passport_no" placeholder="Passport Number" type="text" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <button name="candidate_detail" class="btn btn-icon btn-primary ml-4" type="submit">
                          <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                          <span class="btn-inner--text">Search</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <?php candidate_details(); ?>
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
  function closeSccessModal() {
    document.getElementById('success').style.display = "none";
  }
</script>

</html>