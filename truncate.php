<?php
session_start();
include_once('connection1.php');
$friendname = $_POST['friendname'];
$truncate = "TRUNCATE TABLE `$friendname`";
$conn->query($truncate);
$conn->close();
?>