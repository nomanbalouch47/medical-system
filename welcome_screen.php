<?php include('include/functions.php'); ?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');

?>
<!-- <style type="text/css">
  #token_num{
     display:none;
  }
</style> -->
<body style="background-color: #4964a6 !important;">

  <!-- Main content -->
  <div class="main-content">
    
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-7 pt-lg-7" style="margin-top: -88px;">
      <div class="container">
        <div class="header-body text-center">
          <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
              
              <a class="navbar-brand" href="index.php">
               <img src="assets/img/comp_logo/reliance_logo.png" class="navbar-brand-img welcome_bg" alt="..." width="150px">
               </a>
              <!-- <p class="text-lead text-white">D-975, Block D, Satellite Town, Rawalpindi<br/>Phone: 051494213123, 05183128812, Fax: 0514942133 <br> Email: admin@reliancemc.pk</p> -->
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
    <!-- Page content -->
    <div class="container mt--7">
      <!-- div class row here -->
      <div class="row justify-content-center">
        <!-- <div class="col-xl-4 col-lg-4 col-md-4">
          <div class="card card-profile bg-secondary mt-2">
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-8">
                <h1 class="display-1">2001</h1>
                <h3 class="display-3">Served</h3>
              </div>
             
            </div>
          </div>
        </div> -->
         <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="card card-profile bg-secondary mt-2">
            <div class="card-body pt-7 px-5" style="
    padding-top: 24px !important;
">
              <div class="text-center mb-10">
                <h3 class="display-3" >Now Serving</h3>
                <h1 class="display-1"  style="font-size: 150px;" id="token_num"></h1>
              </div>
             
            </div>
          </div>
        </div>

         <!-- <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="card card-profile bg-secondary mt-2">
            <div class="card-body pt-7 px-5">
              <div class="text-center mb-8">
                <h3 class="display-3">Next</h3>
                <h1 class="display-1">1002</h1>
              </div>
             
            </div>
          </div>
        </div> -->
      </div>

      <!-- <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div> -->
      <!-- Footer -->

    </div>

  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <?php
include_once('include/footer.php');
  ?>
<script src="assets/js/system_script.js"></script>
</body>

<script type="text/javascript">

var myVar = setInterval(myTimer, 3000);

function myTimer() {
  // var d = new Date();
  // document.getElementById("token_num").innerHTML = d.toLocaleTimeString();
  onGoing_display_tokens();
}

</script>

</html>