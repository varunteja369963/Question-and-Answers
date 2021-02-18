<?php
session_start();
if (isset($_COOKIE['username'])){ 
    if (isset($_SESSION['logged_in'])) {
     check();
      }
      else {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['database'] = $_COOKIE['database'];
        $_SESSION['logged_in'] = true;
        check();
      }
    }
    else {
      echo '1';
    }

function check() {
    include_once('connection1.php');
    $hashgroupname = $_POST['hashgroupname'];
    if ($hashgroupname == "") {
        echo '1';
        die();
    }
    $selectgroupname = $conn->prepare("SELECT `hashgroupname` FROM `grouplist` WHERE `hashgroupname` = ?");
    $selectgroupname->bind_param("s", $hashgroupname);
    $selectgroupname->execute();
    $resultgroupname = $selectgroupname->get_result();
    $rowgroupname = $resultgroupname->fetch_assoc();
    $count = mysqli_num_rows($resultgroupname);
    if ($count != 1) {
      echo '2';
    }
    else {
        echo '3';
    }
    mysqli_free_result($resultgroupname);
    $conn->close();
}
?>