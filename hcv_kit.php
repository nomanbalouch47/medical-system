<?php include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,16);
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
              <h6 class="h2 text-white d-inline-block mb-0">HCV COLLECTION</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">HCV Kit</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
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
              <h3 class="mb-0">HCV KIT</h3><br>
            
              <form method="post" action="">
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-2">
                      <label class="form-control-label" for="exampleDatepicker">Date</label>
                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                            <input class="form-control datepicker" name="search_by_date" placeholder="mm/dd/yyyy" type="text" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Control</label>
                        <input class="form-control" placeholder="control value" type="text" name="control">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">CAL</label>
                        <input class="form-control" placeholder="cal value" type="text" name="cal">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">S.A</label>
                        <input class="form-control" placeholder="s.a value" type="text" name="s_a">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">OPD</label>
                        <input class="form-control" placeholder="opd value" type="text" name="opd">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">RIR</label>
                        <input class="form-control" placeholder="rir value" type="text" name="rir">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Total Test</label>
                        <input class="form-control" placeholder="total test value" type="text" name="total_test">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Available</label>
                        <input class="form-control" placeholder="S.A value" type="text" name="s_a">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Balance</label>
                        <input class="form-control" placeholder="balance value" type="text" name="balance">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">KIT Add</label>
                        <input class="form-control" placeholder="kit value" type="text" name="opd">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Received</label>
                        <input class="form-control" placeholder="received value" type="text" name="opd">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Balance</label>
                        <input class="form-control" placeholder="balance value" type="text" name="balance_2">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Sig</label>
                        <input class="form-control" placeholder="sig value" type="text" name="opd">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-default" name="search" value="ADD">
                      </div>
                    </div>
                  </div> 

              </form>
            
          </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>DATE</th>
                    <th>CONTROL</th>
                    <th>CAL</th>
                    <th>S.A</th>
                    <th>OPD</th>
                    <th>RIR</th>
                    <th>TOTAL TEST</th>
                    <th>AVAILABLE</th>
                    <th>BALANCE</th>
                    <th>KIT ADD</th>
                    <th>RECEIVED</th>
                    <th>BALANCE</th>
                    <th>SIG</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>DATE</th>
                    <th>CONTROL</th>
                    <th>CAL</th>
                    <th>S.A</th>
                    <th>OPD</th>
                    <th>RIR</th>
                    <th>TOTAL TEST</th>
                    <th>AVAILABLE</th>
                    <th>BALANCE</th>
                    <th>KIT ADD</th>
                    <th>RECEIVED</th>
                    <th>BALANCE</th>
                    <th>SIG</th>
                  </tr>
                </tfoot>
                 
                <tbody>
                <!-- Updated by N  -->
                 <?php
                     
                     /* if(isset($_POST['search']))
                      {
                        if(isset($_POST['to']) && ($_POST['from']))
                        {
                            $to = $_POST['to'];
                            $from = $_POST['from'];
                            
                            get_dateBWsearch($to, $from);
                           
                        }
                        else
                        {
                            alert_box("Please select dates first!");
                        }
                      }
                      else
                      {
                          history();  
                      }*/
                      
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