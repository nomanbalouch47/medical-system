<?php include('include/functions.php'); ?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">
.modal-content {
    background: transparent;
    border: none;
    padding: 0 19px
}

.modal-header {
    border: none
}


.modal-body {
    border: none;
   /* background-color: #ECEFF1;*/
    border-radius: 8px;
}

.modal-footer {
    border: none
}

.btn.focus,
.btn:focus {
    outline: 0;
    box-shadow: none !important
}

.close.focus,
.close:focus {
    outline: 0;
    box-shadow: none !important
}

.fas {
    color: #2972ae;
    margin-bottom: 20px
}

.col-4 {
    padding: 0 15px;
    color: grey
}

.mini-container:hover {
    box-shadow: 0 8px 7px lightgrey;
    color: black
}
</style>
<body >

  <!-- Main content -->
  <div class="main-content">

    
    <!-- Header -->

   <div class="header bg-gradient-primary py-4 py-lg-4 pt-lg-4">
      <div class="container">
        <div class="header-body text-center">
          <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
              <h1 class="text-white display-2">Feel free to drop us your feedback.</h1>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
    <!-- Page content -->
    <div class="container mt--4">

  <!-- form div start -->
   <div class="card card-stats mb-4 mb-lg-0">
   <div class="card-body">
    <!-- <div class="col-xl-12 col-lg-12 col-md-12">
              <h2 class="text-danger">How satisfied are you overall with the support ?</h2>
            </div> -->
   <form>
   <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Name">
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group">
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Father Name">
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group">
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Serial Number">
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group">
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Barcode">
      </div>
    </div>
     
    <div class="col-md-12">
      <div class="form-group">
        <textarea class="form-control form-control-alternative" rows="3" placeholder="Any Other Suggestions ..."></textarea>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
       <div class="modal-body">
            <p class="text-center mt-1 mb-2"><small><strong>How satisfied are you with our customer<br /> support Performance ?</strong></small></p>
            
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-sm-2 mb-md-3 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="false"><span class="nav-link-icon d-block"><i class="far fa-angry"></i></span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="true"><span class="nav-link-icon d-block"><i class="far fa-meh"></i></span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false"><span class="nav-link-icon d-block"><i class="far fa-smile"></i></span></a>
                </li>
              </ul>
           
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
      <button class="btn btn-icon btn-3 btn-primary" type="button">
      <span class="btn-inner--icon"><i class="fa fa-paper-plane"></i></span>
      <span class="btn-inner--text">Send Feedback</span>
    </button>
      </div>
    </div>
    
    

  </div>
  
 
</form>
                




</div>

   
</div>

<!-- form div end -->


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