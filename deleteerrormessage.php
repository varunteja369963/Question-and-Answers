<?php
include_once('connection2.php');
$id = $_GET['id'];
$delete = $conn->prepare("DELETE FROM `errorlogs` WHERE `id` = ?");
$delete->bind_param("i", $id);
if ($delete->execute()) {
    echo '1';
}
$conn->close();
?>