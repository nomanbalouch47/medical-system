<?php include('include/db.php');

$data = new Databases;

$record_exist = $data->query("SELECT * FROM `tb_registration`");

foreach ($record_exist as $value) {
	$result = $data->query("SELECT * FROM `tb_registration` WHERE passport_no='$value[passport_no]'");
	// print_r($result);
	if($result->num_rows > 1) {
		$count = $result->num_rows - 1;

		for($e = 0; $e < $count; $e++){
			$result = $data->query("DELETE  FROM `tb_registration` WHERE passport_no='$value[passport_no]' AND reg_id = '$value[reg_id]' ");
			if($result) {
				echo "delete";
			}
		}
	}

}

?>