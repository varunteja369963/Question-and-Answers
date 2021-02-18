<?php
session_start();
include_once('connection.php');
require 'Cloudinary.php';
require 'Uploader.php';
require 'Helpers.php';
require 'Api.php';
require 'Error.php';
require 'config-cloud.php';
if (!isset($_SESSION['username'])) {
    header('location: loginform.html');
    echo '1';
    die();
}

$select_pic = $conn->prepare("SELECT `profileaddr` FROM `userslist` WHERE `username` = ?");
$select_pic->bind_param("s", $_SESSION['username']);
$select_pic->execute();
$result_pic = $select_pic->get_result();
$row_pic = $result_pic->fetch_assoc();
$picurl = $row_pic['profileaddr'];
mysqli_free_result($result_pic);

if ($picurl == NULL) { 

$filename = $_FILES['profile_pic_file']['name'];
$fileSize = $_FILES['profile_pic_file']['size'];
$filetmpname = $_FILES['profile_pic_file']['tmp_name'];

$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
$detectedType = exif_imagetype($filetmpname);

   if (! in_array($detectedType, $allowedTypes)) {
        echo '2';
        die();
    }

    if ($fileSize > 2000000) {
        echo '3';
        die();
    }

    $imgsrc = realpath($filetmpname);
    function compress($source, $destination, $quality) {
    
        $info = getimagesize($source);
    
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
    
        imagejpeg($image, $destination, $quality);
    
        return $destination;
    }
    
    $source_img = $imgsrc;
    $destination_img = 'destination.jpg';
    
    $file_path = compress($source_img, $destination_img, 90);
    
   $username = $_SESSION['username'];
   $public_id = $username . 'pic';

       
        $result = \Cloudinary\Uploader::upload($file_path, array( "folder" => "sabiduria_profile_pics/$username", "public_id" => $public_id));
        $imageurl = $result['secure_url'];
     
            if ($result) {
          $imagepath = mysqli_real_escape_string($conn, $imageurl);
           $insert = $conn->prepare("UPDATE `userslist` SET `profileaddr` = ? WHERE `username` = ?");
           $insert->bind_param("ss", $imagepath, $username);
           if ($insert->execute()) {
            echo '4';
           }
           $insert->close();
           }
 else {
     echo '5';
        } 
}

else {

    $filename = $_FILES['profile_pic_file']['name'];
    $fileSize = $_FILES['profile_pic_file']['size'];
    $filetmpname = $_FILES['profile_pic_file']['tmp_name'];
    
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($filetmpname);
    
       if (! in_array($detectedType, $allowedTypes)) {
        echo '2';
        die();
        }
    
        if ($fileSize > 2000000) {
            echo '3';
        die();
        }

    $imgsrc = realpath($filetmpname);
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

$source_img = $imgsrc;
$destination_img = 'destination.jpg';

$file_path = compress($source_img, $destination_img, 90);

       $username = $_SESSION['username'];
       $public_id = $username . 'pic';     
       
            $result = \Cloudinary\Uploader::upload($file_path, array( "folder" => "sabiduria_profile_pics/$username", "public_id" => $public_id));
         $imageurl = $result['secure_url'];
     
            if ($result) {
          $imagepath = mysqli_real_escape_string($conn, $imageurl);

                $update = $conn->prepare("UPDATE `userslist` SET `profileaddr` = ? WHERE `username` = ?");
                $update->bind_param("ss", $imagepath, $username);
                if ($update->execute()) {
                    echo '4';
                }
                $update->close();
    
            } else {
               echo '5';
            }
        } 
$conn->close();
?>