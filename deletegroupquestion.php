<?php
session_start();
include_once('connection1.php');

$hashgroupname = $_POST['groupname'];
$questionid = $_POST['questionid'];

if ($hashgroupname == "" || $questionid == "") {
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
 $shorthashgroupname = $conn->prepare("SELECT `createduser`, `shorthashgroupname` FROM `grouplist` WHERE `hashgroupname` = ?");
 $shorthashgroupname->bind_param("s", $hashgroupname);
 $shorthashgroupname->execute();
 $resulthashgroupname = $shorthashgroupname->get_result();
 if ($resulthashgroupname->num_rows > 0) { 

  $rowhashgroupname = $resulthashgroupname->fetch_assoc();
  $groupname = $rowhashgroupname['shorthashgroupname'];
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
    $groupname2 = $groupname;
    $groupname2 .= '2';
  $check_question = $conn->prepare("SELECT `askeduser` FROM `$groupname2` WHERE `questionuuid` = ?");
  $check_question->bind_param("s", $questionid);
  $check_question->execute();
  $result_groupname = $check_question->get_result();
      if ($result_groupname->num_rows > 0) {
       $row_groupname = $result_groupname->fetch_assoc();
       if ($_SESSION['username'] !== $row_groupname['askeduser']) {
           echo '1';
           die();
       }
       else {
           $delete_question = $conn->prepare("DELETE FROM `$groupname2` WHERE `questionuuid` = ?");
           $delete_question->bind_param("s", $questionid);
           $delete_question->execute();
           $delete_question->close();

           $delete_answer_table = "DROP TABLE `$questionid`";
           $conn->query($delete_answer_table);
if ($_SESSION['username'] !== $createduser) { 
mysqli_select_db($conn, $_SESSION['database']);
}
           $delete_question2 = $conn->prepare("DELETE FROM `storingquestions` WHERE `uuid` = ? AND `groupuuid` = ?");
           $delete_question2->bind_param("ss", $questionid, $hashgroupname);
           $delete_question2->execute();
           $delete_question2->close();

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