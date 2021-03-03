<?php 
include('include/functions.php'); 
$process_id=20;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,20);
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
              <h6 class="h2 text-white d-inline-block mb-0">Print Lab Sticker Module</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Print Lab Sticker</a></li>
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
                          <input class="form-control" type="text" placeholder="Date" id="search_by_date" name="search_by_date" value="<?php echo $time; ?>">
                          <span class="calendar-grid-58"></span>
                      </div>

                      <?php
                      if(barcode_rights($loginuser,20)==1){
                        ?>
                        
                      <div class="form-group">                        
                          <input class="form-control" type="password" placeholder="********" id="sticker_barcode" name="sticker_barcode" onkeyup="check_lab_sticker(event,'user');">
                          
                      </div>
                   
                        <?php
                      }

                      ?>
                     
                    </div>
                    

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <p id="barcode_result"></p>

                      <p id="printsticker_result2"></p>
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