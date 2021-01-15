<?php
include('include/functions.php');

if(isset($_POST['form_name'] == 'Registration'))
{
	$myarray = $_POST['form_values'];
	print_r($myarray);
}



// if(isset($_POST['form_name'] == 'Registration'))
// {
// 	$form_name = $_POST['form_name'];
// 	$barcode = $_POST['barcode'];
// 	$PPIssueDate = $_POST['PPIssueDate'];
// 	$PPIssueCountry = $_POST['PPIssueCountry'];
// 	$serialno = $_POST['serialno'];
// 	$key = $_POST['key'];
// 	$agency = $_POST['agency'];
// 	$profession = $_POST['profession'];
// 	$fee = $_POST['fee'];
// 	$candidatename = $_POST['candidatename'];
// 	$regdate = $_POST['regdate'];
// 	$sonof = $_POST['sonof'];
// 	$passportno = $_POST['passportno'];
// 	$country = $_POST['country'];
// 	$nationality = $_POST['nationality'];
// 	$dob = $_POST['dob'];
// 	$gender = $_POST['gender'];
// 	$Maritial_status = $_POST['Maritial_status'];
// 	$cnic = $_POST['cnic'];
// 	$remarks = $_POST['remarks'];
// 	$biometric_temp = $_POST['biometric_temp'];


	
// 	$i = array(
//                 'token_no' => mysqli_real_escape_string($data->con, $token_no),
//                 'process_id' => mysqli_real_escape_string($data->con, $process_id),
//                 'q_id' => mysqli_real_escape_string($data->con, $q_id)
//             );

//           $data->insert('tb_ongoing_tokens', $insert_token);



// }

?>