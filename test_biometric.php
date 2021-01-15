<?php
include('include/functions.php'); 
//user template
//valid matched 157
$template1 = "Rk1SACAyMAAAAAEIAAABBAEsAMUAxQEAAABZJ0CwABX4AEDGAC51AEAuADYfAECHAD0HAEDMAD/xAEBHAEAcAEBPAEkaAEDqAFJuAEDoAHvjAEB1AIMNAEDIAJFxAECdAJf7AEBrAJieAEDUAKfeAICnAK7sAIB1ALcUAEDwALpeAEDQAMfZAECMANHuAEC3ANzRAEAQANyqAEBYAN6uAIBvAOIfAEDhAOvQAEA9AOspAIB4AO0TAICsAO1RAICHAO3NAEBYAPIuAEB+APWsAEAjAPssAIA9AQilAEB8AQu7AIAsARAfAIBpARWnAIDhARfKAEDZARjJAEBzARmuAECUARq9AAAA";

$template3="Rk1SACAyMAAAAAECAAABBAEsAMUAxQEAAABJJkAtADiHAEBBAEOHAEB9AEz7AEApAGaWAECAAGqAAECzAHvnAIDNAITnAECHAJD4AEByAJr+AEAXAKChAEC9AKFnAEChAKhsAEAdAKukAIB6ALb2AECkALdsAEAcAL2oAIBvAM0AAEDGAM5fAED4ANDUAEAUANGoAECZANFoAIA/ANSvAIDhAOFnAICUAOVkAEAjAOiuAIB3AOuqAIDjAO95AEDvAPaKAEANAPiuAEBUAPm9AEBJAPm7AIB9AQnRAICPAQvgAIA4AQ7AAEAYARG4AEAiARO7AEArARbHAEDPARgAAAAA";


//invalid
//$template1 = "Rk1SACAyMAAAAADqAAABBAEsAMUAxQEAAABeIkCYAA/1AEB2ABADAECUABF7AICsABNxAEC+ABVpAECSAB19AEBxACwHAECoAEvjAEDIAE1dAEAuAFQpAEB6AGj4AECIAHJ7AEC1AHzUAIBzAH4BAECOAIXUAECeAIrNAEAzAJEuAECsAJLNAIBjAJ4hAEDeAJ/UAICeAKNMAEC1ALPNAECXALhNAIB5ALrMAECXAL7GAEDYAMBUAEBzAMO9AEBtAM+zAEC8ANLKAEB2ANm1AECaAORAAEDHAO3HAIBlAO0wAIDEARbAAAAA";

//$template1 ="Rk1SACAyMAAAAADwAAABBAEsAMUAxQEAAABeI0C0ACAAAECIADYDAEAuAD4iAEDpAEL+AEChAEeAAEA0AEinAECtAFT7AEC1AFp7AEBpAGQQAEA8AHgcAEDtAH30AEApAH8mAEDaAILxAEANAIMuAEC6AJl9AEBrAKkcAECWAKsHAEDUAKzuAED2ALZpAICnALv4AEBnAL2qAEDbAMjoAEBbANIpAEBZANaxAIB6ANclAEDJAOHhAECZAOMAAIDyAOTkAIDBAPBhAICEAP4wAICgAP7XAICQAQMeAECbAQO1AICkARfAAEBWAR06AAAA";

//valid
//$template1= "Rk1SACAyMAAAAAC6AAABBAEsAMUAxQEAAAA6GkBiACAUAIDPAC0EAICoAC8KAEBWAEkYAEDaAE/4AEBXAFmaAECnAF77AEDAAHV7AEAkAIQhAEDDAIX1AECBAIgHAEBBAIwcAEDmAJZ1AEBHAJcaAEDnAL/qAEByANEQAEDMANlzAECbAOEAAEBsAOWgAEDWAOznAICqAPfvAIB4AQQYAEDVAQreAICgAQ95AECeARjnAICcAR98AAAA"; 

//db template
$template2 = "Rk1SACAyMAAAAADwAAABBAEsAMUAxQEAAABdI0BUABqYAEDZAB/xAECnACX4AEC5AD1xAEAfAEQiAEB5AEgGAEA4AEsbAEBIAEwQAEC/AE2JAEDEAFUAAEDcAIrhAEDvAIrjAEBlAI0NAEC4AJpuAECQAKD7AEBeAKCgAEDIALLgAICbALbrAIBoAMEXAEDkAMVeAICQAM55AEDGANHaAECCANnsAECSANneAECtAOXUAEBLAOmzAIBkAO4kAEDYAPTRAICiAPVRAIB8APeyAEAvAP0sAIDyAQDWAIBFAQEpAEAXAQ4wAIDaARzMAAAA";

$rows1 = get_biometric_2(3);
//print_r($rows1[0]['biometric_fingerprint']);


$temp1_arr = str_split($template3);

count($temp1_arr);

$temp2_arr = str_split($template2);

count($temp2_arr);


$matched_result = array();
$temp_total_matched = 0;
foreach ($rows1 as $key => $value) {
$total_matched = 0;
//echo $value['biometric_fingerprint'];

	$temp2_arr = str_split($value['biometric_fingerprint']);
	$regID = $value['reg_id'];

	$keysOne = array_keys($temp1_arr);
	$keysTwo = array_keys($temp2_arr);

	$min = min(count($temp1_arr), count($temp2_arr));
	//echo $min;
	//$total_matched = 0;
	for($i = 0; $i < $min; $i++) {
	    // echo $temp1_arr[$keysOne[$i]] . "<br>";
	    // echo $temp2_arr[$keysTwo[$i]] . "<br><br>";
	    if($temp2_arr[$keysTwo[$i]] == $temp1_arr[$keysOne[$i]]){
	    	$total_matched++;
	    }
	}
	//temp = 0, matched = 143
	//temp = 143, matched = 147
	//temp = 147, matched = 100
	//temp = 147, matched 65
	// echo $total_matched;
	// echo "jjjjjjj";
	if($total_matched > $temp_total_matched){

		$temp_total_matched = $total_matched;
		//echo $temp_total_matched;
		$registered_id =  $regID;
	}
	// else{
	// 	echo $temp_total_matched;
	// }

	
	array_push($matched_result, $total_matched);
	echo "<br>";
	//echo $regID;
	echo "<br>";
	
}
echo $registered_id;
print_r($matched_result);
//echo max($matched_result);

// $keysOne = array_keys($temp1_arr);
// $keysTwo = array_keys($temp2_arr);

// $min = min(count($temp1_arr), count($temp2_arr));
// //echo $min;
// $total_matched = 0;
// for($i = 0; $i < $min; $i++) {
//     // echo $temp1_arr[$keysOne[$i]] . "<br>";
//     // echo $temp2_arr[$keysTwo[$i]] . "<br><br>";
//     if($temp2_arr[$keysTwo[$i]] == $temp1_arr[$keysOne[$i]]){
//     	$total_matched++;
//     }
// }

//echo $total_matched;


?>