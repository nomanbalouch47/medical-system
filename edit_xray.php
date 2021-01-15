<?php 
include('include/functions.php');
?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
  
  #errorclass
  {
  display:none;
  }
</style>
<body>
  <!-- Sidenav -->
  <?php include_once('include/sidebar.php'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
  <?php include_once('include/topnav.php'); ?>
    <!-- Header -->
    <!-- Header -->
    <form>
      <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">X-Ray Result</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Edit X-Ray</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#</li>
                </ol>
              </nav>
            </div>


          </div>
        </div>
      </div>
      </div>
    </form>

    <!-- Page content -->

    <div class="container-fluid mt--6">
      

                          

          
      <div class="row">

        <!-- <div class="col-lg-6">
          <div class="card-wrapper">
            
            <div class="card">
              
              <div class="card-header">
                <h3 class="mb-0">Search Candidate</h3>
              </div>
              
             
              
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                            <input class="form-control" name="search_xray_by_serial" placeholder="Serial Number" type="text">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="search_xray_candidate" value="SEARCH">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            
            </div>
        
            


          
          
          </div>
        </div> -->
         <?php fill_xray_result(); ?> 

         <?php upload_xray_result(); ?> 

        
          <div class="col-lg-12">
            <!-- Candidate Info -->
            <div class="card-wrapper">
          

          <!-- X-Ray Type -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">Edit X-Ray</h3>
              </div>
              <!-- Card body -->
             <!-- <input type="hidden" name="reg_id" value="<?php echo $reg_id; ?>"> -->
              <!-- Card body -->
              <div class="card-body">
                <form method="post" action="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">                        
                          <label class="form-control-label" for="exampleDatepicker">Date</label>
                          <input class="form-control datepicker" type="text" id="xraydate" name="xraydate" value="<?php echo date('m/d/Y',strtotime($xray_date)); ?>">
                          <span class="calendar-grid-58"></span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">                        
                          <label class="form-control-label" for="item_2">X-Ray Chest</label>
                          <select class="form-control" name="xray_chest" id="item_2">
                            <?php
                              // $options = array('lung fields clear' => 'LUNG FIELDS CLEAR', 'unfit due to x-ray findings' => 'Unfit Due to X-Ray Findings.', 'see notes' => 'See Notes' );
                              // foreach ($options as $key => $value) {
                              //     echo $key;
                              //     echo $xray_chest;
                              //     if($value == $xray_chest)
                              //       echo "<option selected='selected' value='".$key."'>".$value."</option>";
                              //     else
                              //       echo "<option value='".$key."'>".$value."</option>";
                              // }

                              if($xray_chest=='lung fields clear') {
                                echo "<option value='$xray_chest' selected>LUNG FIELDS CLEAR</option>";
                                echo "<option value='unfit due to x-ray findings'>Unfit Due to X-Ray Findings.</option>";
                                echo "<option value='see notes'>See Notes</option>";
                              } elseif($xray_chest=='unfit due to x-ray findings') {
                                echo "<option value='$xray_chest' selected=selected>Unfit Due to X-Ray Findings.</option>";
                                echo "<option value='lung fields clear'>LUNG FIELDS CLEAR</option>";
                                echo "<option value='see notes'>See Notes</option>";
                              } else {
                                echo "<option value='see notes'>See Notes</option>";
                                echo "<option value='lung fields clear'>LUNG FIELDS CLEAR</option>";
                                echo "<option value='unfit due to x-ray findings'>Unfit Due to X-Ray Findings.</option>";
                              }
                              
                            ?>
                            <!-- <option value="lung fields clear">LUNG FIELDS CLEAR</option>
                            <option value="unfit due to x-ray findings">Unfit Due to X-Ray Findings.</option>
                            <option value="see notes">"See Notes"</option> -->
                          </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="exampleDatepicker">Remarks </label>
                          <textarea class="form-control" name="xray_notes" rows = "5" cols = "80" id="remarks"><?php echo $xray_notes; ?></textarea>
                      </div>
                    </div>

                    <input type="hidden" name="reg_id" value="<?php echo $reg_id; ?>">

                  <!-- <div class="col-md-6">
                      <div class="form-group">                        
                        <label class="form-control-label">Xray Images</label>
                        
                        <div class="dropzone dropzone-multiple" data-toggle="dropzone" data-dropzone-multiple data-dropzone-url="http://">
                          <div class="fallback">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFileUploadMultiple" multiple>
                              <label class="custom-file-label" for="customFileUploadMultiple">Choose file</label>
                            </div>
                          </div>
                          <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                            <li class="list-group-item px-0">
                              <div class="row align-items-center">
                                <div class="col-auto">
                                  <div class="avatar">
                                    <img class="avatar-img rounded" src="..." alt="..." data-dz-thumbnail>
                                  </div>
                                </div>
                                <div class="col ml--3">
                                  <h4 class="mb-1" data-dz-name>...</h4>
                                  <p class="small text-muted mb-0" data-dz-size>...</p>
                                </div>
                                <div class="col-auto">
                                  <div class="dropdown">
                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      <a href="#" class="dropdown-item" data-dz-remove>
                                        Remove
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>   
                        
                      </div>
                      
                  </div> -->

                  </div>
                  
                  <input type="submit" name="update_xray" class="btn btn-danger" value="Update">
                </form>
              </div>

            <?php edit_xray_info(); ?>
            
            </div>
            </div>
          </div>
          </div>
        </form>
    
      <!-- Footer -->
      <?php 
      include('include/footer_area.php'); ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <?php
include('include/footer.php');
  ?>
</body>
</html>