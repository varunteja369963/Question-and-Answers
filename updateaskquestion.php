<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
  header('location: loginform.html');
 echo '2';
  die();
}
include_once('connection1.php');
   //start: getting groupname from grouplist
   $checking_groupname = $_POST['hashgroupname'];
$questionid = $_POST['questionid'];
if ($checking_groupname == "" || $questionid == "") {
  echo '2';
  header('location: loginform.html');
  die();
}
   $tags_before = $_POST['selected_tags'];
   $tags = trim(preg_replace('/\s\s+/', ' ', $tags_before));

   $specificquestion1 = urldecode($_POST['precise_question']);
   $specificquestion2 = htmlentities($specificquestion1);
   $specificquestion = mysqli_real_escape_string($conn, $specificquestion2);

   $before_questionuuid = md5($specificquestion);

   $question1 = urldecode($_POST['question']);
   $question2 = htmlentities($question1);   
   $question = mysqli_real_escape_string($conn, $question2);

   $iframe_content1 = urldecode($_POST['iframe_content']);
   $iframe_content2 = htmlentities($iframe_content1);
   $iframe_content = mysqli_real_escape_string($conn, $iframe_content2);
     
    $selectgroupname = $conn->prepare("SELECT `shorthashgroupname`, `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
    $selectgroupname->bind_param("s", $checking_groupname);
    $selectgroupname->execute();
    $resultgroupname = $selectgroupname->get_result();
    $rowgroupname = $resultgroupname->fetch_assoc();
    $count = mysqli_num_rows($resultgroupname);
    if ($count !== 1) {
      echo '1';
    mysqli_free_result($resultgroupname);      
      die();
    }
   $createduser = $rowgroupname['createduser'];
   $shorthashgroupname = $rowgroupname['shorthashgroupname'];
   mysqli_free_result($resultgroupname);
   
   //end: getting groupname from grouplist
   if ($_SESSION['username'] !== $createduser) {
     echo '2';
}

$shorthashgroupname2 = $shorthashgroupname;
$shorthashgroupname2 .= '2';

$update_question = $conn->prepare("UPDATE `$shorthashgroupname2` SET tags = ?, specificquestion = ?, question = ? WHERE questionuuid = ?");
$update_question->bind_param("ssss",  $tags, $specificquestion, $question, $questionid);
if ($update_question->execute()) {
    echo '3';
}
$update_question->close();
$conn->close();
?>