<?php 
include('include/functions.php'); 
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,23);
}
?>

<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
  #eno_date{
    /*display: none;*/
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
              <h6 class="h2 text-white d-inline-block mb-0">Electronic Number</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Electronic Number Module</a></li>
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

            <!-- Biometric Info -->
             <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">CANDIDATE INFO</h3>
              </div>
              <!-- Card body -->
              
              <div class="card-body">
                
                
                  <?php find_by_passport(); ?>

                   <?php save_eno(); ?>
                 
                
                    
                  </p>
                  <p id="cand_info2"></p>
                  
                    
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
                <h3 class="mb-0">Verification</h3>
              </div> -->
              <!-- Card body -->
             
              <!-- Card body -->
              <div class="card-body">
               <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <input class="form-control" type="text" placeholder="Passport Number" name="pp_no" id="pp_no">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <button type="submit" id="btn_find" name="btn_find" class="btn btn-primary">Find</button>
                      </div>
                    </div>
                   
                  </div>
                </form>
                
                <p id="save_eno_result">

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