<?php
include_once('connection.php');
date_default_timezone_set('Asia/Kolkata');   
 $username = urldecode($_POST['username']);
 $gmail = urldecode($_POST['gmail']);
 $select1 = $conn->prepare("SELECT `username` FROM `userslist` WHERE `username` = ? AND `gmail` = ?");
 $select1->bind_param("ss", $username, $gmail);
 $select1->execute();
 $result1 = $select1->get_result();
 if ($result1->num_rows === 1) {
    $rand_valid = true;
    do {
        $bef_randno = rand(10000000, 99999999);
    $select_rand = $conn->prepare("SELECT `confirmationcode` FROM `resetpassword` WHERE `confirmationcode` = ?");
    $select_rand->bind_param("s", $bef_randno);
    $select_rand->execute();
    $result_rand = $select_rand->get_result(); 
    if ($result_rand->num_rows === 0) { 
      $randno = $bef_randno;
      $rand_valid = false;
     }
    }while($rand_valid);
    mysqli_free_result($result_rand);
$dateandtime = date("Y/m/d h:i:s");
    $insert = $conn->prepare("INSERT INTO `resetpassword` (username, gmail, confirmationcode, sentdate) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $username, $gmail, $randno, $dateandtime);
    if ($insert->execute()) {
        echo '1';
    }
    $insert->close();
 }
 else {
    $select2 = $conn->prepare("SELECT `username` FROM `userslist` WHERE `username` = ?");
    $select2->bind_param("s", $username);
    $select2->execute(); 
    $result2 = $select2->get_result();
    if ($result2->num_rows !== 1) {
        echo '2';
        die();
    }  
    else {
        $select3 = $conn->prepare("SELECT `username` FROM `userslist` WHERE `gmail` = ?");
        $select3->bind_param("s", $gmail); 
        $select3->execute(); 
        $result3 = $select3->get_result();
        if ($result3->num_rows !== 1) {
            echo '3';
            die();
        }
    }
 }
$conn->close();
?>