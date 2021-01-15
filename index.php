<?php 
include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){
  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  //auth_user($loginuser,17);
}
?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
  <!-- Page plugins -->
  <link rel="stylesheet" href="assets/vendor/fullcalendar/dist/fullcalendar.min.css">
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
              <h6 class="h2 text-white d-inline-block mb-0">HOME PAGE</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="index">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">HOME PAGE</li>
                </ol>
              </nav>
            </div>
            <!-- <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <!-- div class row here -->
      <div class="row">
        <div class="col-lg-8">
          <img alt="Image placeholder" src="assets/img/theme/home.jpg" class="img-fluid rounded">
        </div>
        <div class="col-lg-4">
          <div class="card widget-calendar">
            <!-- Card header -->
            <div class="card-header">
              <div class="h5 text-muted mb-1 widget-calendar-year"></div>
              <div class="h3 mb-0 widget-calendar-day"></div>
            </div>
            <!-- Card body -->
            <div class="card-body">
              <div data-toggle="widget-calendar"></div>
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
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/moment/min/moment.min.js"></script>
  <script src="assets/vendor/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="assets/vendor/jvectormap-next/jquery-jvectormap.min.js"></script>
  <script src="assets/js/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.1.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="assets/js/demo.min.js"></script>

</body>
</html>