<?php include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,31);
}
?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>

<body>
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include_once('include/topnav.php'); ?>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">CANDIDATE-TOKEN PROCESS DETAILS</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Process Details</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
		<li class="breadcrumb-item active" aria-current="page">
                    <a href='candidate_token_process_details'><button class="btn btn-warning btn-sm" target="_self">New/Reload</button></li></a>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <!-- div class row here -->

      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">CANDIDATE-TOKEN PROCESS DETAILS</h3><br>
            
          </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>S#</th>
                    <th>NAME</th>
                    <th>TOKEN NO</th>
                    <th>PROCESS</th>
                    <th>STATUS</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>S#</th>
                    <th>NAME</th>
                    <th>TOKEN NO</th>
                    <th>PROCESS</th>
                    <th>STATUS</th>
                  </tr>
                </tfoot>
                 
                <tbody>
                <!-- Updated by N  -->
                 <?php
                    get_process_details();
                     
                  ?>
                </tbody>
              </table>
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

</html>