<?php
include_once 'db.php';

$data = new Databases;

$process_id=1;
$today_date = date("Y-m-d");


function update_token($q_id)
{
	global $data;
  	global $today_date;
	$upda = mysqli_query($data->con,"update tb_queue_manager set status='Ongoing' where q_id='$q_id'");	
	return $upda;
}

function get_current_token($process_id)
{
  global $data;
  global $today_date;

  $get_token_query = $data->query("select MIN(token_no) as token_no,q_id from tb_queue_manager where process_id='$process_id' and status='Pending' and process_date='$today_date' order by q_id ASC LIMIT 1");
  $count_rows=mysqli_num_rows($get_token_query);
  if($count_rows == 1)
  {
    while($query_result=mysqli_fetch_array($get_token_query))
          {
            $token_no = $query_result['token_no'];
            $q_id = $query_result['q_id'];

         // $update_token = mysqli_query($data->con,"update tb_queue_manager set status='Ongoing' where q_id='1'"); 
          
          }

  }
 // // alert_box($q_id);
 //  return $q_id;

update_token($q_id);

}


get_current_token($process_id);





// $get_token_query = $data->query("select MIN(token_no) as token_no,q_id from tb_queue_manager where process_id='$process_id' and status='Pending' and process_date='$today_date' order by q_id ASC LIMIT 1");
// $count_rows=mysqli_num_rows($get_token_query);
// if($count_rows == 1)
// {
// 	while($query_result=mysqli_fetch_array($get_token_query))
// 			  {
// 			  	$token_no = $query_result['token_no'];
// 			  	$q_id = $query_result['q_id'];

// 			  $upda = mysqli_query($data->con,"update tb_queue_manager set status='Ongoing' where q_id='$q_id'");	
			  
// 			  }

// }
			  
			  

			// $upd_token = $data->query("update tb_queue_manager set status='Ongoing' where q_id='$q_id'");
			// echo $token_no;
			// echo $q_id;








// function new_token_call($process_id,$token_no=""){

// global $data;
// $today_date = date("Y-m-d");
	
// 	if($token_no != "")
// 	{
// 		$complete_token= $data->query("update tb_queue_manager set status='Completed' where token_no='$current_token' and process_id='$process_id' and process_date='$today_date'");
// 		if($complete_token)
// 		{
// 			$get_token_query = $data->query("select MIN(token_no) as token_no,q_id from tb_queue_manager where process_id='$process_id' and status='Pending' and process_date='$today_date' order by q_id ASC LIMIT 1");
// 			  $query_result=mysqli_fetch_array($get_token_query);
// 			  $token_no = $query_result['token_no'];
// 			  $q_id = $query_result['q_id'];

// 			$upd_token = $data->query("update tb_queue_manager set status='Ongoing' where q_id='$q_id'");
// 			echo $token_no;
// 		}


// 	}
// 	else{
// 			$get_token_query = $data->query("select MIN(token_no) as token_no,q_id from tb_queue_manager where process_id='$process_id' and status='Pending' and process_date='$today_date' order by q_id ASC LIMIT 1");
// 			  $query_result=mysqli_fetch_array($get_token_query);
// 			  $token_no = $query_result['token_no'];
// 			  $q_id = $query_result['q_id'];

// 			$upd_token = $data->query("update tb_queue_manager set status='Ongoing' where q_id='$q_id'");
// 			echo $token_no;

// 	}


// }

// $process_id=1;
// //$token_no=1001;
// echo new_token_call($process_id,$token_no);