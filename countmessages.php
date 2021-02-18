<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("location: loginform.html");
    die();
}
if ($_SESSION['logged_in'] != true) {
  header("location: loginform.html");
  die();
}
include_once('connection1.php');
$friname = $_POST['friendname'];
if ($friname == "") {
    
    die();
}
$select = "SELECT MAX(id) AS max FROM `$friname`";
$result = $conn->query($select);
$row = $result->fetch_assoc();
echo $row['max'];
mysqli_free_result($result);
$conn->close();
?>