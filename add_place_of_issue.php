<?php include('include/functions.php'); 
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,15);
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
              <h6 class="h2 text-white d-inline-block mb-0">Add Place of Issue</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="index">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Place of Issue</li>
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
                <h3 class="mb-0">Add New Place of Issue</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <?php fill_place_of_issue_text(); ?>
                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                      <!-- <div class="form-group">
                          <label class="form-control-label" for="user-name">User Name</label>  
                          <input class="form-control" type="text">
                      </div> -->

                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input class="form-control" placeholder="Place Name" name="place_of_issue_name" type="text" value="<?php echo $place_of_issue; ?>" required>
                        </div>
                      </div>
                    </div>
                    <!--  -->
                  </div>
                <input type="submit" class="btn btn-success" name="add_place_of_issue" value="Add">
                <input type="submit" class="btn btn-danger" name="update_place_of_issue" value="Update">
                </form>
                <?php edit_place_of_issue(); ?>
              </div>
            </div>
            <?php delete_place_of_issue(); ?>
          </div>
          <?php create_new_place_of_issue(); ?>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <!-- Card header -->

            <div class="card-header">
              <h3 class="mb-0">View Place of Issue</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive py-2">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>S#</th>
                    <th>Place of Issue</th>
                    <th>Created at</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>              
                    <?php get_all_places($loginuser,15); ?>
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