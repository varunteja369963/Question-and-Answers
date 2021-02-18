<?php
session_start();
  include_once('connection4.php');
    $uuid = $_POST['question_uuid'];
    if ($uuid == "") {
      echo '2';
      header('location: loginform.html');
      die();
    }
if (!isset($_SESSION['logged_in'])) {
  echo '2';
  die();
}
    $selectgroupname = $conn->prepare("SELECT `precisequestion` FROM `solvemyproblemquestions` WHERE `uuid` = ?");
    $selectgroupname->bind_param("s", $uuid);
    $selectgroupname->execute();
    $resultgroupname = $selectgroupname->get_result();
    $rowgroupname = $resultgroupname->fetch_assoc();
    $bef_specificquestion = stripslashes($rowgroupname['precisequestion']);
  $specificquestion = mysqli_real_escape_string($conn, $bef_specificquestion);
mysqli_free_result($resultgroupname);
$does_not_matched = true;
do {
    $bef_rand = rand(100000, 999999);
    $select_rand = $conn->prepare("SELECT `answeruuid` FROM `$uuid` WHERE `answeruuid` = ?");
    $select_rand->bind_param("s", $bef_rand);
    $select_rand->execute();
    $result_rand = $select_rand->get_result();
    if ($result_rand->num_rows == 0) {
      $does_not_matched = false;
      $rand = $bef_rand;
    }
  }while($does_not_matched);
mysqli_free_result($result_rand);

     $insert_answer = $conn->prepare("INSERT INTO `$uuid` (answers, answeruuid, dateandtime, answereduser) VALUES (?, ?, ?, ?)");  
     $insert_answer->bind_param("ssss", $answer, $rand, $dateandtime, $answereduser);

     $answer1 = urldecode($_POST['answer']);
     $answer2 = htmlentities($answer1);
     $answer = mysqli_real_escape_string($conn, $answer2);


     $dateandtime = date("Y:m:d H:i:s");
         $answereduser = $_SESSION['username'];
if ($insert_answer->execute() == TRUE) {

    $mydatabase = $_SESSION['database'];
mysqli_select_db($conn, $mydatabase);

$select_repeated = $conn->prepare("SELECT `uuid` FROM `smpanswers` WHERE `uuid` = ?");
$select_repeated->bind_param("s", $uuid);
$select_repeated->execute();
$result_repeated = $select_repeated->get_result();
if($result_repeated->num_rows > 0) {
  echo '1';
}
else { 
    $insertstoringanswers = $conn->prepare("INSERT INTO `smpanswers` (precisequestion, uuid) 
    VALUES (?, ?)");
    $insertstoringanswers->bind_param("ss", $specificquestion, $uuid);
    if ($insertstoringanswers->execute()) { 
echo '1';
    }
    $insertstoringanswers->close();
} 
mysqli_free_result($result_repeated);
}
$insert_answer->close();
$conn->close();  
?>