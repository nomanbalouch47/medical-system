<?php include('include/functions.php'); ?>
<!DOCTYPE html>
<html>
<?php
include_once('include/head.php');
?>
<style type="text/css">

#myList{
    /*width:80px; height:90px; color:#AAA; margin:50px auto; font:bold 14px/24px Arial,sans-serif; text-decoration:none; display:block; position:relative;*/
    text-align:center;
    display: inline-flex;
    padding-left: 380px;
  }
.emoji-1:hover{
  width: 120px;
  opacity: 2;
}
.emoji-2:hover{
  width: 120px;
  opacity: 2;
}
.emoji-3:hover{
  width: 120px;
  opacity: 2;
}
img{
  opacity: 0.8;
}

li{
  list-style: none;
  text-decoration: none;
}
/*.emoji-1:hover{
    width: 200px;
    height: 200px;
}*/
/*#myList li:hover img{
    display:block;
}*/

</style>
<body>
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

   <form onkeypress="return event.keyCode != 13;">
    <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label class="form-control-label" for="barcode">Barcode Number</label>
        <input class="form-control" placeholder="Barcode" id="barcode" type="text" onkeyup="candidate_record_check(event)">
      </div>
    </div>
   
    <p id="serial_name" style="width: 600px">
    </p>

    <div class="col-md-12">
      <div class="form-group">
        <p class="text-center mt-1 mb-2"><small><strong>How satisfied are you with our customer<br/> support Performance ?</strong></small></p>   
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <ul id="myList">
          <li id="good" value="10">
              <img class="emoji-1" src="assets/img/feedback_emojis/happy.png" width="100px" />
          </li>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <li id="satisfied" value="5">
              <img class="emoji-2" src="assets/img/feedback_emojis/satisfactory.png" width="100px" />
          </li>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <li id="need_for_improve" value="2">
              <img class="emoji-3" src="assets/img/feedback_emojis/need_for_improvement.png" width="100px" />
          </li>
        </ul>
          
      </div>
     <p style="text-align: center; font-weight: bold; padding-left: 30px;" id="myfeedback"></p>
    </div>
  
    <br>
    <br>
    <br>
    <br>

    <div class="col-md-12" style="margin-top: 90px;">
      <div class="form-group">
        <textarea class="form-control form-control-alternative" rows="3" id="suggestion" placeholder="Any Other Suggestions ..."></textarea>
      </div>
    </div>


    <div class="col-md-12">
      <div class="form-group float-right">
      <button class="btn btn-icon btn-3 btn-primary" id="feedback" onclick="cand_feedback(event)" type="button">
      <span class="btn-inner--icon"><i class="fa fa-paper-plane"></i></span>
      <span class="btn-inner--text">Send Feedback</span>
      </button>
      </div>
    </div>
    
    </div>
  <p id="cand_feed_result"></p>
  </form>

  <input type="hidden" id="feedback_value">

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
<script type="text/javascript">
 $("li").click(function() {
      var feed = $(this).attr("value");
      document.getElementById("feedback_value").value = feed;
      //var feedback_result = document.getElementById("feedback_value").value;
      if(feed == 10){
        document.getElementById("myfeedback").innerHTML = "Good";
      }else if(feed == 5){
        document.getElementById("myfeedback").innerHTML = "Satisfied";
      }else if(feed == 2){
        document.getElementById("myfeedback").innerHTML = "Need for Improvement";
      }   
  });
</script>
<script src="assets/js/system_script.js"></script>
</body>

</html>