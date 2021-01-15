<?php 
include('include/functions.php'); 
$process_id=6;
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,6);
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
<body>
  
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
        <?php include_once('include/topnav.php'); ?>
    <!-- Header -->
    <!-- Header -->
    <form method="post" action="" >
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Report Issuance</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Reports Module</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-warning btn-sm" target="_self">New/Reload</button></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <h6 class="h2 text-white d-inline-block mb-0">
                <?php
                if(now_serving_rights($loginuser,6)==1){
                  ?>
                  Now serving: <?php echo $token_prefix.$current_token = get_current_token(); ?>
                <?php
                }else{
                  $current_token = get_current_token();
                }
                ?>
                | In Queue <?php echo tokens_in_queue($process_id); ?> </h6> &nbsp;
              
              <input type="hidden" name="token_number" id="token_number" value="<?php echo $current_token; ?>">
              <input type="hidden" name="processid" value="<?php echo $process_id; ?>">
              <input type="submit" name="call_token" class="btn btn-sm btn-neutral" value="New">
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
              
             
              <p id="find_result"></p>
              
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
               <form onkeypress="return event.keyCode != 13;">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                     
                        <input class="form-control" type="password" placeholder="Barcode" id="barcode" name="barcode">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="button" id="find" name="find" onclick="find_candidate();" class="btn btn-primary" value="Find">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group float-right">
                        <button type="button" id="issuereport" name="issuereport" onclick="issue_report();" class="btn btn-primary">Issue Report</button>
                      </div>
                    </div>
                  </div>
                     <p id="report_issue"></p>
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