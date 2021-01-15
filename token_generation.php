<?php
error_reporting(0);
include('include/functions.php'); ?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<body >
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content ">
    <!-- Topnav -->
        <?php include_once('include/topnav.php'); ?>
    <!-- Header -->
    <!-- Header -->
    <div class="header  bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0"><a class="navbar-brand" href="index.php">
               
               </a></h6>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Registration</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                </ol>
              </nav> -->
            </div>

           <!--  <div class="col-lg-6 col-5 text-center">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--9">
      <!-- div class row here -->

      <form method="post" action="">
      <div class="row justify-content-center">


        <div class="col-lg-6 card-wrapper ct-example">
        
          <!-- Styles --> 
          <div class="col-xl-12 col-lg-12 col-md-12">
              <h1 class="text-white display-2 text-center">Welcome to<br> Reliance Medical Lab</h1>
              <!-- <p class="text-lead text-white">D-975, Block D, Satellite Town, Rawalpindi<br/>Phone: 051494213123, 05183128812, Fax: 0514942133 <br> Email: admin@reliancemc.pk</p> -->
            </div>
          <div class="card">

            <div class="card-header">
              <h3 class="mb-0">New Ticket</h3>
            </div>

            <div class="card-body">
               <div class="row">
  
                
               <div class="col-md-6">
                  <button class="btn btn-icon btn-primary" type="submit" name="generate_token">
                    <span class="btn-inner--icon"><i class="ni ni-zoom-split-in"></i></span>
                    <span class="btn-inner--text">Medical</span>
                  </button> 
               </div> 

                <div class="col-md-6">
                  <button class="btn btn-icon btn-primary" type="submit" name="generate_token">
                    <span class="btn-inner--icon"><i class="ni ni-collection"></i></span>
                    <span class="btn-inner--text">Report Collection</span>
                  </button> 
               </div> 

                    

              
              </div>
               
               
              
              
            </div>
          </div>
           <?php token_generation(); ?>
        </div>
      </div>
    </form>
     
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