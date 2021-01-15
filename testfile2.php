<?php
$conn2=mysqli_connect('localhost','root','','db_medical_sys');






$nj=mysqli_query($conn2,"select * from barcode_setup");
while ($bn=mysqli_fetch_array($nj)) {
        $r = $bn['barcode'];
      }  	

  	echo $new_barcode = $r+1;

  	$new[] = "('$new_barcode')";
//  	INSERT INTO `barcode_setup`(`barcode`) VALUES ('100006')
  //	$ins=mysqli_query($conn2,"INSERT INTO `barcode_setup`(`barcode`) VALUES ('100010')");

$query = mysqli_query($conn2,"INSERT INTO barcode_setup (barcode) VALUES". implode( ',', $new));
$query="";

  	//die($ins);
  	// if($ins)
  	// {
  	// 	echo 'times';
  	// }













//  $get_barcode=mysqli_query($conn2,"select barcode from barcode_setup");
//   $count_rows = mysqli_num_rows($get_barcode);
//   if($count_rows == 0){
    
//     echo $barcode_num = '100001';

//     $ins=mysqli_query($conn2,"insert into barcode_setup(barcode) values ('$barcode_num')");
//     // $insert_data = array(
//     //                 'barcode' => $barcode_num
//     //               );
//     // if($data->insert('barcode_setup',$insert_data))
//     // {
//     //   echo $barcode_num;
//     // }


//   }else{

// $nj=mysqli_query($conn2,"select * from barcode_setup");
// while ($bn=mysqli_fetch_array($nj)) {
//         $r = $bn['barcode'];
//       }  	

//   	echo $new_barcode = $r+1;
// //  	INSERT INTO `barcode_setup`(`barcode`) VALUES ('100006')
//   	$ins=mysqli_query($conn2,"INSERT INTO `barcode_setup`(`barcode`) VALUES ('100007')");

// //     while ($bn=mysqli_fetch_array($get_barcode)) {
// //         $r = $bn['barcode'];
// //       }

// // $barcode_num = $r+1;
// // alert_box($barcode_num);

// //   $ins=mysqli_query($conn2,"insert into barcode_setup(barcode) values ('$barcode_num')");

//}
?>