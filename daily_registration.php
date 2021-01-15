<?php include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,32);
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
              <h6 class="h2 text-white d-inline-block mb-0">Daily Registration Report</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
                  
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
        <div class="col-lg-6">
          <div class="card-wrapper">
            <!-- User Creation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">Countries</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="reports/daily_registration">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">Select Date</label>
                        <input class="form-control datepicker" name="reg_date" placeholder="mm/dd/yyyy" type="text" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label" for="user-name">Select Countries</label>  
                          <select class="form-control" data-toggle="select" name="countries[]" multiple="multiple" required="">
                              <?php
                              $p_o_i = $data->query("select Name from tb_country order by created_at DESC");
                              while ($bm=mysqli_fetch_array($p_o_i)) {
                                $place_o_i = $bm['Name'];
                                  echo "<option value=$place_o_i>$place_o_i</option>";
                              }
                              ?>
                          </select>
                      </div>
                    </div>
                    <!--  -->
                  </div>
                  <button type="submit" name="generate_report" class="btn btn-default">Generate Report</button>
                 
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

</html>