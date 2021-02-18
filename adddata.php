<?php
 session_start();
date_default_timezone_set('Asia/Kolkata');  
include_once('connection1.php');
$before_msg1 = urldecode($_POST['msg']);
$before_msg2 = htmlentities($before_msg1);
$msg =  mysqli_real_escape_string($conn, $before_msg2);
$friendname = $_POST['friendname'];

    $insert = $conn->prepare("INSERT INTO $friendname (chat, place, sendedtime) VALUES (?, ?, ?)");
        $insert->bind_param("sss",$chat, $place, $sendedtime);
        $chat = $msg;
        $place = 1;
    $sendedtime = date('Y-m-d H:i:s');
    $insert->execute();
    $insert->close();
$myusername = $_SESSION['username'];

mysqli_select_db($conn, 'membersinwebsite');
$select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
$select_fridb->bind_param("s", $friendname);
$select_fridb->execute();
$result_fridb = $select_fridb->get_result();
$row_fridb = $result_fridb->fetch_assoc();
$created_db = $row_fridb['databasename'];
mysqli_free_result($result_fridb);
mysqli_select_db($conn, $created_db);

    $insertmine = $conn->prepare("INSERT INTO `$myusername` (chat, place, sendedtime) VALUES (?, ?, ?)");
    $insertmine->bind_param("sss", $chat, $place, $sendedtime);
    $chat = $msg;
    $place = 2;
    $sendedtime = date('Y-m-d H:i:s');
   $insertmine->execute();
    $insertmine->close();
    $conn->close();
?>