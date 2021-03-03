<?php 
include('include/functions.php'); 
$process_id=4;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,26);
}
?>

<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
  
  #candidateInfo
  {
    display:none;
  }
</style>
<body>
  
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
              <h6 class="h2 text-white d-inline-block mb-0">Duplicate Lab Sticker</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Print Sticker</a></li>
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
                        
      <!-- div class row here -->

      <div class="row">
        <div class="col-lg-6">
          <div class="card-wrapper">
            <div class="card">
              <!-- Card header -->
              <!-- <div class="card-header">
                <h3 class="mb-0">PASSPORT INFO</h3>
              </div> -->
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <img id="BC_display_image" alt="Barcode Display Image" src="assets/img/barcode_display.jpg" alt="..." class="img-thumbnail" width="500">
                        <input type="hidden" value="<?php echo $loginuser; ?>" name="loginid" id="loginid">
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
              <!-- <div class="card-header">
                <h3 class="mb-0">PASSPORT INFO</h3>
              </div> -->
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">   
                      <label class="form-control-label" for="reg_date">Date</label>                     
                        <input class="form-control datepicker" type="text" placeholder="mm/dd/yyyy" id="reg_date" name="reg_date">
                        <span class="calendar-grid-58"></span>
                      </div>
                      <div class="form-group">                        
                        <label class="form-control-label" for="user_id">Serial Number</label>
                        <input class="form-control" type="text" placeholder="***/*/*" id="serial_no" name="serial_no" onkeyup="change_lab_sticker_attempts(event,'admin');">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="user_id">Users</label>
                        <select class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id="1" tabindex="-1" aria-hidden="true" name="select_user" id="user_id" required="">
                            <?php get_all_users($loginuser); ?>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <p id="barcode_result"></p>

                      <p id="printsticker_result2"></p>
                      <p id="duplicate_sticker2"></p>
                    </div>
                   
                  </div>
                </form>
              </div>
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
<script src="assets/js/system_script.js"></script>
</html>