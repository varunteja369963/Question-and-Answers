<?php
session_start();
include_once('connection2.php');
$message1 = urldecode($_POST['errormessage']);
$message = mysqli_real_escape_string($conn, $message1);
$path1 = urldecode($_POST['path']);
$path = mysqli_real_escape_string($conn, $path1);

$insert = $conn->prepare("INSERT INTO `errorlogs2` (errormessage, errorpath, gotdate) VALUES (?, ?, ?)");
$insert->bind_param("sss", $message, $path, $gotdate);
$gotdate = date("Y/m/d h:i:s");
$insert->execute();
$insert->close();
$conn->close();
?>