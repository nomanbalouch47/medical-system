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
              <h6 class="h2 text-white d-inline-block mb-0">LAB PENDING CASES</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Lab Pending Cases</a></li>
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
              <h3 class="mb-0">LAB PENDING CASES</h3><br>
            
              <form method="post" action="">
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-2">
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
                        <input type="submit" class="btn btn-default" name="search" value="SEARCH">
                      </div>
                    </div>
              </form>

                  <div class="col-md-4">
                  </div>              
              
                </div>  
            
          </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>Date</th> 
                    <th>Serial No</th> 
                    <th>Disease</th> 
                    <th>Cut of Value</th> 
                    <th>Patient Value</th> 
                    <th>Repeat Date</th> 
                    <th>Final Status</th> 
                    <th>Fax Date</th> 
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>Date</th> 
                    <th>Serial No</th> 
                    <th>Disease</th> 
                    <th>Cut of Value</th> 
                    <th>Patient Value</th> 
                    <th>Repeat Date</th> 
                    <th>Final Status</th> 
                    <th>Fax Date</th> 
                    <th>Action</th>
                  </tr>
                </tfoot>
                 
                <tbody>
                    <?php
                      for($k=1; $k<10; $k++){
                          ?>
                      <tr class="clone"> 
                          <td>01/01/2020</td> 
                          <td>01/S/001</td>
                          <td>ALT</td> 
                          <td><input type="text" class="form-control" style="width: 80px;" name="cut_of_value" value=""></td> 
                          <td><input type="text" class="form-control" style="width: 80px;" name="patient_value" value=""></td>  
                          <td><input type="text" class="form-control" style="width: 80px;" name="repeat_date" value=""></td> 
                          <td><input type="text" class="form-control" style="width: 80px;" name="final_status" value=""></td> 
                          <td><input type="text" class="form-control" style="width: 80px;" name="fax_date" value=""></td> 
                          
                          <td><button id="btn" class="btn btn-2 btn-success btn-save">Save</button></td>
                      </tr>

                          <?php
                      }
                  ?> 
                <!-- Updated by N  -->
                 <?php
                     
                      // if(isset($_POST['search']))
                      // {
                      //   if(isset($_POST['search_by_date']))
                      //   {
                      //       $search_by_date = $_POST['search_by_date'];
                      //       get_searched_lab_record($search_by_date);
                      //   }
                      // }
                      // else
                      // {
                      //     //redirect('./lab_pending_cases','_self'); 
                      // }
                      
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

<script type="text/javascript">
    (function ($) {
        $('body').on('click','.btn-save', function (e) {
            e.preventDefault();
            var row = $(this).parents('tr.clone');
            
            var cut_of_value = row.find('[name^=cut_of_value]').val();
            var patient_value = row.find('[name^=patient_value]').val();
            var repeat_date = row.find('[name^=repeat_date]').val();
            var final_status = row.find('[name^=final_status]').val();
            var fax_date = row.find('[name^=fax_date]').val();

            console.log(cut_of_value,patient_value,repeat_date,final_status,fax_date);
            // $.ajax({
            //         url:"{{ route('StockController.update') }}",
            //         method:"POST",
            //         data:{
            //             productID:pro_id,
            //             onHand:onhand,
            //             warehouseID:wh_id,
            //             in_stock:in_stock,
            //             out_stock:out_stock,
            //             reason:reason,
            //             _token:_token,
            //             },
            //         success:function(result)
            //         {
            //          $("#stock_result2").html(result);
            //         }
            //        })
})
    })(jQuery)
</script>

</body>

</html>