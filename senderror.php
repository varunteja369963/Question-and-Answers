<?php
session_start();
include_once('connection.php');
$message1 = urldecode($_POST['errormessage']);
$message = mysqli_real_escape_string($conn, $message1);
$path1 = urldecode($_POST['path']);
$path = mysqli_real_escape_string($conn, $path1);
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
else {
    $sername = "";
}
$select = $conn->prepare("SELECT `gmail` FROM `userslist` WHERE `username` = ?");
$select->bind_param("s", $username);
$select->execute();
$result = $select->get_result();
$row = $result->fetch_assoc();
$gmail = $row['gmail'];
mysqli_free_result($result);
mysqli_select_db($conn, 'searchanderror');
$insert = $conn->prepare("INSERT INTO `errorlogs` (username, gmail, errormessage, errorpath, gotdate) VALUES (?, ?, ?, ?, ?)");
$insert->bind_param("sssss", $username, $gmail, $message, $path, $gotdate);
$gotdate = date("Y/m/d h:i:s");
$insert->execute();
$insert->close();
$conn->close();
?>