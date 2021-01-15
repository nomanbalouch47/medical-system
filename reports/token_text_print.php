<?php
require('mysql_table.php');
include('../include/functions.php');

global $token;
// alert($token);
if(isset($_GET['token'])) 
{
  $token = $_GET['token'];
}

  $process_query2 = get_medical_lab_OrganInfo_pdf();
  $query_result2=mysqli_fetch_array($process_query2);
  $address = $query_result2['address'];
  $medical_lab_title = $query_result2['title'];
  $phone_no = $query_result2['phone_no'];
  $phone_no_2 = $query_result2['phone_no_2'];
  $fax_no = $query_result2['fax_no'];



$file = "token.txt";
$myfile = fopen($file, "w") or die("Unable to open file!");   
fwrite($myfile, "Reliance Medical Lab");
fwrite($myfile, "\n");
fwrite($myfile, "\n");
fwrite($myfile, "\t \t \t Token #: ".$token);
// fwrite($myfile, "\n");
// fwrite($myfile, "\t \t".$date_time);
// fwrite($myfile, "\n");
// fwrite($myfile, "Powered By: Inspedium Corp");
// fwrite($myfile, "\n");
// fwrite($myfile, "www.inspedium.com");

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/html");
readfile($file);

?>