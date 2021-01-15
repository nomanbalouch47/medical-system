<?php

$con=mysqli_connect('localhost','root','','db_medical_sys');

$temp1 = $_GET['temp1'];

$runq= mysqli_query($con,"insert into bio_test(image_1)values('$temp1')");
if($runq)
{
	echo "saved";
}else{
	echo "error";
}



?>