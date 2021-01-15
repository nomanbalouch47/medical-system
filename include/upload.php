<?php
include('db.php');
$today_date_with_time = date("Y-m-d H:i:s");
$data = new Databases;
$target_dir = "../assets/candidate_eno/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["btn_screenshot"])) {
    $eno = $_POST['eno'];

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $imgname = basename($_FILES["fileToUpload"]["name"]);
        $upd_can_process = $data->query("update tb_eno set screenshot='$imgname',created_at='$today_date_with_time' where eno='$eno'");
        if($upd_can_process){
            echo "<script>alert('Screenshot Uploaded')</script>";
            echo "<script>window.open('../electronic_number','_self')</script>";
        }
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "<script>alert('Error in uploading screenshot')</script>";
            echo "<script>window.open('../electronic_number','_self')</script>";
    }
}
?>