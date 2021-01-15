<?php

include('include/functions.php');

if(isset($_GET['token']) && ($_GET['process_id']) && ($_GET['reg_id'])){

		$token_num = $_GET['token'];
		$processID = $_GET['process_id'];
		$regID = $_GET['reg_id'];

	 //token update to completion status
         $upd = mysqli_query($data->con,"update tb_queue_manager set status='Completed' where token_no='$token_num' and process_id='$processID' and process_date='$today_date'");

        $upd_can_process = $data->query("update candidate_medical_process set process_status='1',processed_by='$loginuser',created_on='$today_date_with_time' where process_id='$processID' and reg_id='$regID'");
        $del_ongoing_process=$data->query("delete from tb_ongoing_tokens where token_no='$token_num'");

        if($upd && $upd_can_process && $del_ongoing_process){
        	echo "Success";
        }

}
?>