<?php 
include('include/backup_script.php');
      
$now = date('Y-m-d');
// $dir = "%USERPROFILE%";
// $dir = getenv('HOMEDRIVE').getenv('HOMEPATH').'\Downloads';
// $path = dirname($dir);
// echo $now.' '.$path;
// if($now>)

$host = "localhost";
$user = "root";
$pass = "";
$name = "db_medical_sys";

$mysqli = new mysqli($host,$user,$pass,$name);

// $databases = array("db_medical_sys","db_medical_sys_khaleej","db_medical_sys_frontier","db_medical_sys_gcc","db_medical_sys_horizon","db_medical_sys_global");

$databases = array("db_medical_sys","db_medical_sys_khaleej");

echo $db_count = count($databases);

// get previous database record
$record_exist = $mysqli->query("SELECT `last_backup` FROM `db_backup_stats` ORDER BY `id` DESC");
$count_rows = mysqli_num_rows($record_exist);
  
  if($count_rows == 0){

    for($i = 0; $i < $db_count ; $i++) {
      echo 'db: '.$databases[$i];
      $file_name = EXPORT_DATABASE('localhost','root','',$databases[$i]);
    
      if($file_name != '') {
           
          $res = $mysqli->query("INSERT INTO `db_backup_stats`(`backup_file_name`,`last_backup`) VALUES ('$file_name','$now')");
          if($res) {
            echo "record saved!";
          } else {
            echo "failed to save record!";
          }
      }
      else {
        echo "file not saved!";
      }
    }
  }
  else {

    $row = mysqli_fetch_array($record_exist);
    $last_backup = $row['last_backup'];
    // echo $now.' '.$last_backup;
      // check the current date is greater than previous backup date, download the 
    if($now > $last_backup) {
      
      for($i = 0; $i < $db_count ; $i++) {
        echo 'else db: '.$databases[$i];
        $file_name = EXPORT_DATABASE('localhost','root','',$databases[$i]);
        
        if($file_name != '') {
            
            $res = $mysqli->query("INSERT INTO `db_backup_stats`(`backup_file_name`,`last_backup`) VALUES ('$file_name','$now')");
            if($res) {
              echo "record saved!";
            } else {
              echo "fail to save record!";
            }
        }
        else {
          echo "file not saved!";
        }
      }
    }
  }
  
?>