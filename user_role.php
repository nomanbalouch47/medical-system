<?php
include('include/functions.php');
if(isset($_SESSION['user_login']) == ""){

  alert_box("Please Login to continue");
  redirect('login','_self');
}else{
  $loginuser = $_SESSION['user_login']['user_id'];
  auth_user($loginuser,10);
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
              <h6 class="h2 text-white d-inline-block mb-0">User Role</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="index">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User Role</li>
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

      <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">User Rights</h3>
              </div>
              <?php create_user_rights(); ?>
            <?php create_user_action_rights(); ?>
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="item_1">Select User</label>
                      <select class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id="1" tabindex="-1" aria-hidden="true" name="select_user" id="item_1" onchange="get_user_modules()" required="">
                        <?php get_all_users($loginuser); ?>
                      </select>
                    </div>
                    <label class="form-control-label" for="exampleFormControlSelect2">Module Rights</label>

                      <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="1" id=registration>
                        <label class=custom-control-label for=registration><span class="badge badge-warning badge-lg">Registration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="16" id='registration_history'>
                        <label class=custom-control-label for=registration_history>Registration History - <span class="badge badge-warning">Registration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="27" id='edit_registration'>
                        <label class=custom-control-label for=edit_registration>Edit Registration - <span class="badge badge-warning">Registration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="17" id='passport_verification'>
                        <label class=custom-control-label for=passport_verification><span class="badge badge-success badge-lg">Passport Verification</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="2" id='medical'>
                        <label class=custom-control-label for=medical><span class="badge badge-danger badge-lg">Medical</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="3" id='xray'>
                        <label class=custom-control-label for=xray><span class="badge badge-info badge-lg">XRAY</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="18" id='xray_result'>
                        <label class=custom-control-label for=xray_result>XRAY Result - <span class="badge badge-info">XRAY</span></label>
                     </div>
                       <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="6" id='report_issuance'>
                        <label class=custom-control-label for=report_issuance><span class="badge badge-success badge-lg">Report Issuance</span></label>
                     </div>
                    
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="7" id='sample_collection'>
                        <label class=custom-control-label for=sample_collection><span class="badge badge-danger badge-lg">Sample Collection</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="42" id='administration'>
                        <label class=custom-control-label for=administration><span class="badge badge-primary badge-lg">Administration </span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="45" id='change_medical_status'>
                        <label class=custom-control-label for=change_medical_status>Change Medical Status - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="4" id='user_creation'>
                        <label class=custom-control-label for=user_creation>User Creation - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="8" id='dashboard'>
                        <label class=custom-control-label for=dashboard>Dashboard - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="10" id='user_role'>
                        <label class=custom-control-label for=user_role>User Role - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="11" id='country_setup'>
                        <label class=custom-control-label for=country_setup>Country Setup - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="12" id='profession_setup'>
                        <label class=custom-control-label for=profession_setup>Profession Setup - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="13" id='agency_setup'>
                        <label class=custom-control-label for=agency_setup>Agency Setup - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="14" id='nationality_setup'>
                        <label class=custom-control-label for=nationality_setup>Nationality Setup - <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="15" id='place_of_issue'>
                        <label class=custom-control-label for=place_of_issue>Place of Issue Setup - <span class="badge badge-primary">Administration</span></label>
                     </div>

                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="28" id='lab'>
                        <label class=custom-control-label for=lab><span class="badge badge-primary badge-lg">LAB</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="19" id='lab_result'>
                        <label class=custom-control-label for=lab_result>LAB Result - <span class="badge badge-primary">LAB</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="20" id='print_sticker'>
                        <label class=custom-control-label for=print_sticker>Print Lab Sticker - <span class="badge badge-primary">LAB</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="26" id='print_duplicate_sticker'>
                        <label class=custom-control-label for=print_duplicate_sticker>Print Duplicate Lab Sticker - <span class="badge badge-primary">LAB</span> | <span class="badge badge-primary">Administration</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="21" id='print_report'>
                        <label class=custom-control-label for=print_report><span class="badge badge-danger badge-lg">Print Report</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="22" id='token_generation'>
                        <label class=custom-control-label for=token_generation><span class="badge badge-primary">Token Generation</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="24" id='token_status'>
                        <label class=custom-control-label for=token_status><span class="badge badge-primary">Token Status</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="25" id='candidate_medical'>
                        <label class=custom-control-label for=candidate_medical><span class="badge badge-danger">Candidate Medical Status</span></label>
                     </div>

                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="43" id='candidate_pictures'>
                        <label class=custom-control-label for=candidate_pictures><span class="badge badge-primary">Candidate Pictures</span></label>
                     </div>
                     
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="29" id='eno'>
                        <label class=custom-control-label for=eno><span class="badge badge-primary badge-lg">ENO</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="23" id='electronic_number'>
                        <label class=custom-control-label for=electronic_number>Electronic Number - <span class="badge badge-primary">ENO</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="30" id='eno_screenshots'>
                        <label class=custom-control-label for=eno_screenshots>ENO Screenshots - <span class="badge badge-primary">ENO</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="31" id='cand_token_process'>
                        <label class=custom-control-label for=cand_token_process><span class="badge badge-primary">Candidate Token Process</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="5" id='report_printing'>
                        <label class=custom-control-label for=report_printing><span class="badge badge-warning badge-lg">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="32" id='daily_registration_register_report'>
                        <label class=custom-control-label for=daily_registration_register_report>Daily Registration Register - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="33" id='daily_status_report'>
                        <label class=custom-control-label for=daily_status_report>Daily Status Report - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="34" id='monthly_yearly_report'>
                        <label class=custom-control-label for=monthly_yearly_report>Monthly/Yearly Report - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="35" id='daily_eno_report'>
                        <label class=custom-control-label for=daily_eno_report>Daily ENO Report - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="36" id='daily_cash_statement'>
                        <label class=custom-control-label for=daily_cash_statement>Daily Cash Statement - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="37" id='lab_register_report'>
                        <label class=custom-control-label for=lab_register_report>Lab Register Report - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="38" id='yearly_summary_report'>
                        <label class=custom-control-label for=yearly_summary_report>Yearly Summary Report - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="39" id='daily_summary_report'>
                        <label class=custom-control-label for=daily_summary_report>Daily Summary Report - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="40" id='reference_slip_expiry_report'>
                        <label class=custom-control-label for=reference_slip_expiry_report>Reference Slip Expiry - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     <div class='custom-control custom-checkbox mb-3'>
                        <input class=custom-control-input type=checkbox name="check_list[]" value="41" id='code_list_report'>
                        <label class=custom-control-label for=code_list_report>Code List - <span class="badge badge-warning">Reports</span></label>
                     </div>
                     
                    </div>
                    <div class="col-md-6">
                      
                      <div class="form-group">
                        <p id="item_2"></p>
                      </div>
                      
                      <div class="form-group">
                        <p id="item_4"></p>
                      </div>
                    
                    </div>
                    
                  </div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-success" name="save_rights">Save Rights</button>
                      <button type="submit" class="btn btn-default" name="save_actions">Save Actions</button>
                    </div>
                </form>
              </div>
            </div>
            
            <?php remove_user_action_rights(); ?>
            <?php remove_user_rights(); ?>

        <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <!-- Card header -->

            <div class="card-header">
              <h3 class="mb-0">Module Rights</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive py-2">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>Serial #</th>
                    <th>&emsp; User</th>
                    <th>Module</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>              
                    <?php get_user_rights(); ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <div class="card">
            <!-- Card header -->

            <div class="card-header">
              <h3 class="mb-0">Actions On Modules</h3>
              <!-- <p class="text-sm mb-0">
                This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
              </p> -->
            </div>
            <div class="table-responsive py-2">
              <table class="table table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>
                    <th>Serial #</th>
                    <th>&emsp;User</th>
                    <th>Module</th>
                    <th>Edit Rights</th>
                    <th>Delete Rights</th>
                    <th>Barcode Verification</th>
                    <th>Print Lab Sticker</th>
                    <th>Allow Biometric</th>
                    <th>Serial # Verification</th>
                    <th>Now Serving Allow</th>
                    <th>Search with Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>              
                    <?php get_user_actions(); ?>
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
<script src="assets/js/system_script.js"></script>
</html>