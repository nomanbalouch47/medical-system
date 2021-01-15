<?php
include('include/functions.php');

//update_medical_status_final(1425);

$get_results = mysqli_query($data->con,"SELECT distinct tr.serial_no,tr.passport_no,tr.reg_date,tr.reg_id,tm.medical_status as mo_status,xr.xray_status,tlr.lab_status,tr.medical_status	
FROM tb_registration tr
INNER JOIN tb_medical tm on tm.reg_id=tr.reg_id
inner JOIN tb_xray_result xr on xr.reg_id=tr.reg_id
left JOIN tb_lab_sticker tsr on tsr.reg_id=tr.reg_id
left join tb_lab_result tlr on (tlr.reg_id=tr.reg_id || tsr.sticker_value_2=tlr.barcode)

where tr.reg_id='1947'");

while($row=mysqli_fetch_array($get_results)){


	if($row['xray_status'] == 'UNFIT' || $row['lab_status'] == 'UNFIT'){

		echo '<br>';
		echo $row['reg_id'];
		echo ' Final Status : UNFIT';
		echo '<br>';

		$upd_status=mysqli_query($data->con,
			"update tb_registration set medical_status='UNFIT' where reg_id='".$row['reg_id']."'");

	}elseif($row['xray_status'] == 'FIT' && $row['lab_status'] == 'FIT'){

		echo '<br>';
		echo $row['reg_id'];
		echo ' Final Status : FIT';
		echo '<br>';
		$upd_status=mysqli_query($data->con,"update tb_registration set medical_status='FIT' where reg_id='".$row['reg_id']."'");

	}else{

		echo '<br>';
		echo $row['reg_id'];
		echo ' Final Status : INPROCESS';
		echo '<br>';

	}

}

?>