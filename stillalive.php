<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include_once('connection1.php');
$dbLastActivity = date("Y-m-d h:i:s");
$update = $conn->prepare("UPDATE `userstatus` SET `friendonline` = ?  WHERE `id` = 0");
$update->bind_param("s", $dbLastActivity);
$update->execute();
$update->close();
$conn->close();
?>
