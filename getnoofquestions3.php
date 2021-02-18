<?php
session_start();
include_once('connection1.php');
$uuid = $_POST['questionuuid'];
$hashgroupname = $_POST['hashgroupname'];
$selectgroupname = $conn->prepare("SELECT  `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
$selectgroupname->bind_param("s", $hashgroupname);
$selectgroupname->execute();
$resultgroupname = $selectgroupname->get_result();
$rowgroupname = $resultgroupname->fetch_assoc();
$createduser = $rowgroupname['createduser'];
mysqli_free_result($resultgroupname);

  if ($createduser !== $_SESSION['username']) { 
    mysqli_select_db($conn, 'membersinwebsite');
    $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $createduser);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
    mysqli_free_result($result_fridb);
 mysqli_select_db($conn, $created_db);
}

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