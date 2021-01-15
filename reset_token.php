<?php
include('include/functions.php');
	
  $today_date = date("Y-m-d");

  if($data->query("delete from tb_tokens where token_date != '$today_date'")){

  	if($data->query("delete from tb_queue_manager where process_date != '$today_date'")){

  		if($data->query("delete from tb_ongoing_tokens where token_date != '$today_date'")){

  			echo 'Tokens are reset';

  		}

  	}

  }
  
?>

<script>
setTimeout(function () { window.location.reload(); }, 600*60*1000);
// reset in 10 hours from current datetime
// just show current time stamp to see time of last refresh.
//document.write(new Date());
</script>