<?php
session_start();
include_once('connection1.php');

$hashgroupname = $_POST['groupname'];
$questionid = $_POST['questionid'];
$answeruuid = $_POST['answeruuid'];

if ($hashgroupname == "" || $questionid == "" || $answeruuid == "") {
    echo '1';
    header('location: loginform.html');
    die();
}
else { 
if (!isset($_SESSION['logged_in'])) {
  echo '1';
  header('location: loginform.html');
  die();
}
else {
 $shorthashgroupname = $conn->prepare("SELECT `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
 $shorthashgroupname->bind_param("s", $hashgroupname);
 $shorthashgroupname->execute();
 $resulthashgroupname = $shorthashgroupname->get_result();
 if ($resulthashgroupname->num_rows > 0) { 

  $rowhashgroupname = $resulthashgroupname->fetch_assoc();
$createduser = $rowhashgroupname['createduser'];

if ($_SESSION['username'] !== $createduser) {
    mysqli_select_db($conn, 'membersinwebsite');
    $select_db = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_db->bind_param("s", $createduser);
    $select_db->execute();
    $result_db = $select_db->get_result();

    if ($result_db->num_rows > 0) {
        $row_db = $result_db->fetch_assoc();
        $created_db = $row_db['databasename'];
        mysqli_select_db($conn, $created_db);
    }
    else {
        echo '1';
        die();
    }
}
    
  $check_question = $conn->prepare("SELECT `answereduser` FROM `$questionid` WHERE `answeruuid` = ?");
  $check_question->bind_param("s", $answeruuid);
  $check_question->execute();
  $result_groupname = $check_question->get_result();
      if ($result_groupname->num_rows > 0) {
       $row_groupname = $result_groupname->fetch_assoc();
       if ($_SESSION['username'] !== $row_groupname['answereduser']) {
           echo '1';
           die();
       }
       else {
           $delete_question = $conn->prepare("DELETE FROM `$questionid` WHERE `answeruuid` = ?");
           $delete_question->bind_param("s", $answeruuid);
           $delete_question->execute();
           $delete_question->close();

if ($_SESSION['username'] !== $createduser) { 
mysqli_select_db($conn, $_SESSION['database']);
}

           $delete_question3 = $conn->prepare("DELETE FROM `storinganswers` WHERE `uuid` = ? AND `groupuuid` = ?");
           $delete_question3->bind_param("ss", $questionid, $hashgroupname);
           $delete_question3->execute();
           $delete_question3->close();
           echo '2';
       }
      }
      else {
          echo '1';
      }
    }
    else {
      echo '1';
    }
}
}
$conn->close();
?>