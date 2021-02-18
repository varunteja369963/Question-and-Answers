<?php
session_start();
   #connecting to database
  include_once('connection1.php');
   $hashgroupname = $_POST['hashgroupname'];
   $question_id = $_POST['question_id'];
   if ($hashgroupname == "" || $question_id == "") {
     echo '2';
     header('location: loginform.html');
   }
   $answer1 = urldecode($_POST['answer']);
   $answer2 = htmlentities($answer1);
   $answer = mysqli_real_escape_string($conn, $answer2);

   $selectgroupname = $conn->prepare("SELECT `createduser`, `shorthashgroupname` FROM `grouplist` WHERE `hashgroupname` = ?");
   $selectgroupname->bind_param("s", $hashgroupname);
   $selectgroupname->execute();
   $resultgroupname = $selectgroupname->get_result();
   $rowgroupname = $resultgroupname->fetch_assoc();
$groupname = $rowgroupname['shorthashgroupname'];
$createduser = $rowgroupname['createduser'];
mysqli_free_result($resultgroupname);
    if ($_SESSION['username'] !== $createduser) {
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
$does_not_matched = true;

do {
  $bef_rand = rand(100000, 999999);
  $select_rand = $conn->prepare("SELECT `answeruuid` FROM `$question_id` WHERE `answeruuid` = ?");
  $select_rand->bind_param("s", $bef_rand);
  $select_rand->execute();
  $result_rand = $select_rand->get_result();
  if ($result_rand->num_rows === 0) {
    $does_not_matched = false;
    $rand = $bef_rand;
  }
}while($does_not_matched);
mysqli_free_result($result_rand);

$insert_answer = $conn->prepare("INSERT INTO `$question_id` (answer, answeruuid, answereduser, dateandtime) 
VALUES (?, ?, ?, ?)
");
 $insert_answer->bind_param("ssss", $answer, $rand, $answereduser, $dateandtime);

 $answereduser = $_SESSION['username'];
 $dateandtime = date('Y-m-d H:i:s');
if ($insert_answer->execute() == TRUE) {
  $groupname2 = $groupname;
  $groupname2 .= '2';
  $selectgroupname = $conn->prepare("SELECT `specificquestion` FROM `$groupname2` WHERE `questionuuid` = ?");
    $selectgroupname->bind_param("s", $question_id);
    $selectgroupname->execute();
    $resultgroupname = $selectgroupname->get_result();
    $rowgroupname = $resultgroupname->fetch_assoc();
    $bef_specificquestion = stripslashes($rowgroupname['specificquestion']);
  $specificquestion = mysqli_real_escape_string($conn, $bef_specificquestion);
mysqli_free_result($resultgroupname);
    $mydatabase = $_SESSION['database']; 
mysqli_select_db($conn, $mydatabase);

$select_repeated = $conn->prepare("SELECT `uuid` FROM `storinganswers` WHERE `uuid` = ? AND `groupuuid` = ?");
$select_repeated->bind_param("ss", $question_id, $hashgroupname);
$select_repeated->execute();
$result_repeated = $select_repeated->get_result();
if($result_repeated->num_rows > 0) {
  echo '1';
}
else { 
    $insertstoringanswers = $conn->prepare("INSERT INTO `storinganswers` (precisequestion, uuid, groupuuid) 
    VALUES (?, ?, ?)");
    $insertstoringanswers->bind_param("sss", $specificquestion, $uuid, $hashgroupname);
    $uuid = $question_id;
    if ($insertstoringanswers->execute()) { 
echo '1';
    }
    $insertstoringanswers->close();
  }
  mysqli_free_result($result_repeated);
}
else {
   echo $conn->error;
}
$insert_answer->close(); 
$conn->close();  
?>
