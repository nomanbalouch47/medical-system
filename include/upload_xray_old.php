<?php
include('db.php');
//error_reporting(0);
$today_date_with_time = date("Y-m-d H:i:s");
$data = new Databases;
global $reg_id;

if(isset($_POST["cand_xray"])) {
    $serial = $_POST['serial'];
    $xd=$_POST['xraydate'];


      $exp_date = $_POST['xraydate'];
      $exp_dat = str_replace('/', '-', $exp_date);
      $xray_date = date("Y-m-d",strtotime($exp_dat));
    // echo "<script>alert('$xray_dte')</script>";
    $xray_chest = $_POST['xrayChest'];
    $serial_no = $_POST['serial'];
    $remarks = $_POST['remarks'];
    $loginuser = $_POST['loginid'];
    $center_id = $_POST['center_id'];
    
    $xray_status = 'FIT';
    if($xray_chest == 'unfit due to x-ray findings')
    {
        $xray_status = 'UNFIT';
    }
    $processID = '5';


        $record_check = $data->query("select reg_id from tb_registration where serial_no='$serial' and reg_date='$xray_date'");
        $count_rows = mysqli_num_rows($record_check);
            if($count_rows==0) {
                echo "<script>alert('No Record Found')</script>";
                echo "<script>window.open('../xray_result','_self')</script>";
            }else{

            
            $get_reg_id = $data->query("select reg_id from tb_registration where reg_date='$xray_date' and serial_no='$serial_no'");
            $reg_array = mysqli_fetch_array($get_reg_id);
            $cand_Reg_ID = $reg_array['reg_id'];
            
            $xray_insert = array(
                        'reg_id' => mysqli_real_escape_string($data->con, $cand_Reg_ID),
                        'xray_chest' => mysqli_real_escape_string($data->con, $xray_chest),
                        'xray_notes' => mysqli_real_escape_string($data->con, $remarks),
                        'xray_date' => mysqli_real_escape_string($data->con, $xray_date),
                        'process_id' => mysqli_real_escape_string($data->con, $processID),
                        'created_by' => mysqli_real_escape_string($data->con, $loginuser),
                        'center_id' => mysqli_real_escape_string($data->con, $center_id),
                        'xray_status' => mysqli_real_escape_string($data->con, $xray_status)

                        
                    );
            $data->insert('tb_xray_result', $xray_insert);
    
$error=array();
$extension=array("jpeg","jpg","png","gif");
foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
    $file_name=$_FILES["files"]["name"][$key];
    $file_tmp=$_FILES["files"]["tmp_name"][$key];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    $filePath = "../assets/candidate_xray/".$file_name;

    if(in_array($ext,$extension)) {
        if(!file_exists($filePath)) {
            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],$filePath);

            
            $insert_xray_slip = array(
                'reg_id' => mysqli_real_escape_string($data->con, $cand_Reg_ID),
                'xray_slips' => mysqli_real_escape_string($data->con, $filePath)
            );
            $data->insert('tb_xray_slips', $insert_xray_slip);
        }
        else {
            
            $filename=basename($file_name,$ext);
            $newFileName=$filename.time().".".$ext;
            $newfilePath="../assets/candidate_xray/".$newFileName;
            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],$newfilePath);
            $insert_xray_slip = array(
                'reg_id' => mysqli_real_escape_string($data->con, $cand_Reg_ID),
                'xray_slips' => mysqli_real_escape_string($data->con, $newfilePath)
            );
            $data->insert('tb_xray_slips', $insert_xray_slip);
        }
    }
    else {
        array_push($error,"$file_name, ");
    }
    
}
      }
echo "<script>alert('Xray Result Uploaded')</script>";
echo "<script>window.open('../xray_result','_self')</script>";
    
}

?>