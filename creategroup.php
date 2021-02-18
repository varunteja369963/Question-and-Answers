<?php
session_start();
if ($_SESSION['logged_in'] != true) {
  echo '4';
  header("location: loginform.html");
  die();
}
?>
<?php
include_once('connection.php');
   $everything_ok = true;
   $groupname = $_POST['groupname'];
   if ($groupname == "") {
    echo '4';
    header("location: loginform.html");
    die();
   }
   $groupname_match = preg_match("/^[a-z,A-Z,0-9 ]+$/", $groupname);
   if ($groupname_match == 0) {
     echo '1';
     $everything_ok = false;
     die();
   }
    if (strlen($groupname) < 4 && strlen($groupname) > 25) {
      echo '1';
     $everything_ok = false;      
      die();
    }
   
   if (preg_match("/(____)+/", $groupname)) {
     echo '1';
     $everything_ok = false;     
     die();
   }
   if ($everything_ok) {
    $select_username = $conn->prepare("SELECT `hashusername`, `gmail` FROM `userslist` WHERE `username` = ?");
    $select_username->bind_param("s", $_SESSION['username']);
    $select_username->execute();
    $result_username = $select_username->get_result();
    $row_result = $result_username->fetch_assoc();
    if ($result_username->num_rows != 1) {
      echo '4';
      mysqli_free_result($result_username);
      header('location: loginform.html');
      die();
    }
    else {
      $hashusername = $row_result['hashusername'];
      $mygmail = $row_result['gmail'];
      mysqli_free_result($result_username);      
    }
     $group_name_valid = true; 
     do { 
    $hashgroupname = hash('sha256', $groupname);
    $rand_no = rand(100000, 999999);
    $copy_hash_groupname = $hashgroupname;
    $copy_hash_groupname .= $rand_no;

     $selectgrp = $conn->prepare("SELECT `hashgroupname` FROM `maingrouplist` WHERE `hashgroupname` = ?");
     $selectgrp->bind_param("s", $copy_hash_groupname);
     $selectgrp->execute();
    $resultgrp = $selectgrp->get_result();
    if ($rowgrp = $resultgrp->fetch_assoc()) { 
    if ($rowgrp->num_rows > 0) {
      $group_name_valid = true;
    }
    else {
      $group_name_valid = false;
      $shorthashgroupname = md5($hashgroupname);
      $shorthashgroupname .= $rand_no;
      $hashgroupname .= $rand_no;
    }
  }
  else {
    $group_name_valid = false;
    $shorthashgroupname = md5($hashgroupname);
    $shorthashgroupname .= $rand_no;
    $hashgroupname .= $rand_no;
  }
} while($group_name_valid);
mysqli_free_result($resultgrp);      

    $createduser = $_SESSION['username'];
    $insert_groupname_in_main = $conn->prepare( "INSERT INTO `maingrouplist` (groupname, shorthashgroupname, hashgroupname, createduser) VALUES (?, ?, ?, ?)");
    $insert_groupname_in_main->bind_param("ssss", $groupname, $shorthashgroupname, $hashgroupname, $createduser);
    $insert_groupname_in_main->execute();
    $insert_groupname_in_main->close();
  
     $connecting1 = $_SESSION['database'];
     mysqli_select_db($conn, $connecting1);
     $groupname1 = $shorthashgroupname;
   $groupname1 .= '1';

       $insertgroupname = $conn->prepare( "INSERT INTO `grouplist` (groupname, shorthashgroupname, hashgroupname, createduser, addeduser) VALUES (?, ?, ?, ?, ?) ");
       $insertgroupname->bind_param("sssss", $groupname, $shorthashgroupname, $hashgroupname, $createduser, $createduser);

       if ($insertgroupname->execute()) {
           $creategrpname1 = "CREATE TABLE IF NOT EXISTS `$groupname1` (
                        `id` INT unsigned AUTO_INCREMENT PRIMARY KEY,
                        `username` VARCHAR(30) NOT NULL,
                        `hashusername` VARCHAR(32) NOT NULL,
                        `gmail` VARCHAR(200) NOT NULL,
                        `points` INT NOT NULL DEFAULT 0,
                        `createdtime` DATETIME NOT NULL
           )";
           $conn->query($creategrpname1);
  
           $insertgroupname1 = $conn->prepare("INSERT INTO `$groupname1` (username, hashusername, gmail, createdtime) VALUES (?, ?, ?, ?)");
           $insertgroupname1->bind_param("ssss",$username, $hashusername, $mygmail, $date);
           $username = $_SESSION['username'];
           $date = date('Y-m-d H:i:s');
          if ($insertgroupname1->execute()) {
            echo '2';
          }
          else {
            echo '3';
          }
          $insertgroupname1->close();
       }
       $insertgroupname->close();
      }
$conn->close();
?>
