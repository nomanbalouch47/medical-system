<?php include('include/functions.php'); ?>

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
              <h6 class="h2 text-white d-inline-block mb-0">Organization Module</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="index">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Organization Module</li>
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
                <h3 class="mb-0">Add Organization</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <?php fill_organization_text(); ?>
                <form method="post" action="" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group"> 
                          <input class="form-control" type="text" placeholder="Title" name="title" value="<?php echo $name; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <input class="form-control" type="text" placeholder="Phone no" name="phone_no" value="<?php echo $phone_no; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <input class="form-control" type="text" placeholder="Phone no2" name="phone_no_2" value="<?php echo $phone_no_2; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">                        
                        <input class="form-control" type="text" placeholder="Fax no" name="fax_no" value="<?php echo $fax_no; ?>"> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <input class="form-control" type="text" placeholder="Email" name="email_address" value="<?php echo $email_address; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">                     
                        <input class="form-control" type="text" placeholder="Email 2" name="email_address_2" value="<?php echo $email_address_2; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">                        
                          <label class="form-control-label">Logo Upload</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="LogoUpload" id="LogoUpload" lang="en" value="<?php echo $logo; ?>">
                            <label class="custom-file-label">Select file <SPAN><i class="text-warning mb-0"><?php echo $logo; ?></i></SPAN></label>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <?php
                      if (empty($logo)) {
                        echo "<label class='form-control-label'><SPAN><i class='text-warning mb-0'>Logo Preview Area</i></SPAN></label>";
                      }
                        else {
                      ?>
                           <img id="Logo" alt="Logo Image" src=".\assets\img\comp_logo\<?php echo $logo; ?>" height=200 width=200 align="center" class="img-thumbnail">
                      <?php
                        }
                      ?> 
                      </div>  
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="form-control-label">Address</label>
                        <textarea class="form-control" name="address" rows="4"><?php echo $address; ?></textarea>
                      </div>
                    </div>
                  </div>
                <input type="submit" class="btn btn-success" name="add_organization" value="Add">
                <input type="submit" class="btn btn-danger" name="update_organization" value="Update">
                </form>
                <?php edit_organization(); ?>
              </div>
            </div>
            <?php delete_organization(); ?>
          </div>
          <?php create_organization(); ?>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <!-- Card header -->

            <div class="card-header">
              <h3 class="mb-0">Oranization</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive py-2">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>S#</th>
                    <th>Title</th>
                    <th>Address</th>
                    <th>Phone no</th>
                    <th>Phone no2</th>
                    <th>Fax no</th>
                    <th>Email</th>
                    <th>Email 2</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Logo</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>              
                    <?php organization_history(); ?>
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