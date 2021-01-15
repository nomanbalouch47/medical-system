<?php include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,33);
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
              <h6 class="h2 text-white d-inline-block mb-0">MEDICAL</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Daily Status Report</a></li>
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
              <h3 class="mb-0">Daily Status Report</h3><br>
            
              <form method="post" action="">
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">To</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                            <input class="form-control datepicker" name="to" placeholder="mm/dd/yyyy" type="text">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">From</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                            <input class="form-control datepicker" name="from" placeholder="mm/dd/yyyy" type="text">
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Select Portion</label>
                          <select class="form-control"  name="portion">
                            <option value="A-B">A & B</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label">Select Countries</label>  
                        <select class="form-control" data-toggle="select" name="countries[]" multiple="multiple">
                            <?php
                            $p_o_i = $data->query("select Name from tb_country order by Name ASC");
                            while ($bm=mysqli_fetch_array($p_o_i)) {
                              $place_o_i = $bm['Name'];
                                echo "<option value='$place_o_i'>$place_o_i</option>";
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div class="form-group">  
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-success" name="search" value="SEARCH">
                      </div>
                    </div>
              </form>



              
                  <div class="col-md-2">
                    <div class="form-group">  
                    </div>
                    <div class="form-group float-right">
                        
                    <?php

                        if(isset($_POST['to']) && isset($_POST['from']) && isset($_POST['portion']) && isset($_POST['countries']))
                        {
                            $to = $_POST['to'];
                            $from = $_POST['from'];
                            $portion = $_POST['portion'];
                            $countries = $_POST['countries'];
                            $country = implode(',',$countries);
                         //   echo $country;

                      ?>
                     <a href="reports/daily_status_report?from=<?php echo $from; ?>&&to=<?php echo $to; ?>&&portion=<?php echo $portion; ?>&&country=<?php echo $country; ?>" target='_blank'><input type="button" class="btn btn-default" name="pdf_report" value="PDF"></a>
                      <?php

                        }else
                        {
                          ?>
                      <a href="reports/daily_status_report" target='_blank'><input type="button" class="btn btn-default" name="pdf_report" value="PDF"></a>
                          <?php

                        }
                    ?>
                      
                    </div>
                  </div>
              
                </div> 
            
          </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>REG DATE</th>
                    <th>SERIAL NO</th>
                    <th>CANDIDATE NAME</th>
                    <th>SON OF</th>
                    <th>PASSPORT NO</th>
                    <th>COUNTRY</th>
                    <th>AGENCY</th>
                    <th>PORTION</th>
                    <th>MEDICAL STATUS</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>REG DATE</th>
                    <th>SERIAL NO</th>
                    <th>CANDIDATE NAME</th>
                    <th>SON OF</th>
                    <th>PASSPORT NO</th>
                    <th>COUNTRY</th>
                    <th>AGENCY</th>
                    <th>PORTION</th>
                    <th>MEDICAL STATUS</th>
                  </tr>
                </tfoot>
                 
                <tbody>
                <!-- Updated by N  -->
                 <?php
                     
                      if(isset($_POST['search']))
                      {
                        if(isset($_POST['portion']))
                        {
                            $to = $_POST['to'];
                            $from = $_POST['from'];
                            $portion = $_POST['portion'];
                            $countries = $_POST['countries'];
                            $country = implode(',',$countries);

                            // echo $to.$from.$portion.$country;
                            
                            daily_status_report_dateBWsearch($to,$from,$portion,$country);
                           
                        }
                        else
                        {
                            alert_box("Please select all fields!");
                        }
                      }
                      else
                      {
                          daily_status_history();  
                      }
                      
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