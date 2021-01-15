<?php include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,24);
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
  <form method="post" action="">
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Ticket Status</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-warning btn-sm" target="_self">Refresh</button></li>     

                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">  
              <input type="button" name="reset" id="tokenreset" onclick="reset_token()" class="btn btn-sm btn-warning" value="Reset Token">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>


  <!-- Page content -->


  <div class="container-fluid mt--6">
    <div id="token_status">
      <!-- Table -->
      <div class="row">


        <div class="col-lg-4">
          <div class="card">
            <!-- Card header -->

            <div class="card-header">
              <h3 class="mb-0">COMPLETED</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive py-2">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th> 
                    <th>Name</th>
                    <th>STATUS</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php
                      completed_token();
                  ?>     
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <!-- Card header -->

            <div class="card-header">
              <h3 class="mb-0">PENDING</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive py-2">
              <table class="table  table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th> 
                    <th>Name</th>
                    <th>STATUS</th> 
                  </tr>
                </thead>
                <tbody>
                 <?php 
                    onPending_token();
                  ?>               
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <div class="col-lg-4">
          <div class="card">
            <!-- Card header -->

            <div class="card-header">
              <h3 class="mb-0">IN PROCESS</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>NAME</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    onGoing_token();
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


<script src="assets/js/system_script.js"></script>
</body>

</html>