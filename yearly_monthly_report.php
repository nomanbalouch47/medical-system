<?php include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,34);
}
?>

<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
  
  #months_select
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
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Monthly | Yearly | Quarterly Report</h6>
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
                <h3 class="mb-0">Monthly Report</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="reports/monthly_report" target="_blank">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">Select Year</label>
                        <select class="form-control" data-toggle="select" name="year" onchange="show_months()" required>
                          <option value="">Select</option>
                          <?php
                            $year = $data->query("select DISTINCT extract(year from reg_date) as Year from tb_registration order by Year ASC");
                            while ($bm=mysqli_fetch_array($year)) {
                              $years = $bm['Year'];
                              echo "<option value=$years>$years</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6" id="months_select">
                      <div class="form-group">
                        <label class="form-control-label">Select Months</label>
                        <select class="form-control" data-toggle="select" name="months[]" multiple="multiple">
                          <?php
                            $month = $data->query("select DISTINCT MONTHNAME(reg_date) as MONTH from tb_registration order by MONTH(reg_date) ASC");
                            while ($bm=mysqli_fetch_array($month)) {
                              $months = $bm['MONTH'];
                              echo "<option value=$months>$months</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input" id="customCheck1" name="all_months" value="1" type="checkbox">
                          <label class="custom-control-label" for="customCheck1"><SPAN><i class="text-warning mb-0">Select All</i></SPAN></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="monthly_report" class="btn btn-default">Monthly Report</button>
                 
                </form>
                
              </div>

            </div>

            <!-- User Creation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">Quarterly Report</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="reports/quarterly_report" target="_blank">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="form-control-label">Select Quarter</label>
                        <select class="form-control" data-toggle="select" name="quarter" required>
                          <option value="1">1st Quarter</option>
                          <option value="2">2nd Quarter</option>
                          <option value="3">3rd Quarter</option>
                          <option value="4">4th Quarter</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="quarterly_report" class="btn btn-default">Quarterly Report</button>
                 
                </form>
                
              </div>

            </div>

          </div>

        </div>

        <div class="col-lg-6">
          <div class="card-wrapper">
            <!-- User Creation -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">Yearly Report</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="reports/yearly_report" target="_blank">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">Select Years</label>
                        <select class="form-control" data-toggle="select" name="years[]" multiple="multiple" required>
                          <?php
                            $year = $data->query("select DISTINCT extract(year from reg_date) as Year from tb_registration order by Year ASC");
                            while ($bm=mysqli_fetch_array($year)) {
                              $years = $bm['Year'];
                              echo "<option value=$years>$years</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="yearly_report" class="btn btn-default">Yearly Report</button>
                
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
  <script type="text/javascript">
  
  function show_months(){
    document.getElementById("months_select").style.display = "block";
      //document.getElementByID('poliodate').style.display = "block";
  }
</script>
</body>

</html>