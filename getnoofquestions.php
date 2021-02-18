<?php
session_start();
include_once('connection5.php');
$uuid = $_POST['questionuuid'];
$select_maxid = "SELECT MAX(id) AS max FROM `$uuid`";
if ($result_maxid = $conn->query($select_maxid)) {
    $row = $result_maxid->fetch_assoc();
    $max_id = $row['max'];
    if ($max_id == "") {
        echo 0;
    }
    else {
    echo $max_id;
    }
}
else {
    echo 0;
}
$conn->close();
?>