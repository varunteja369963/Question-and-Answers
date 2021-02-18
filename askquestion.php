<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
 echo '4';
 header('location: loginform.html');
  die();
}
include_once('connection1.php');
date_default_timezone_set('Asia/Kolkata');  
   //start: getting groupname from grouplist
   $checking_groupname = $_POST['hashgroupname'];
if ($checking_groupname == "" || $_POST['selected_tags'] == "" || $_POST['question'] == "" || $_POST['precise_question'] == "") {
  echo '4';
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

    $selectgroupname = $conn->prepare("SELECT `shorthashgroupname`, `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
    $selectgroupname->bind_param("s", $checking_groupname);
    $selectgroupname->execute();
    $resultgroupname = $selectgroupname->get_result();
    $count = mysqli_num_rows($resultgroupname);
    if ($count != 1) {
      echo '1';
      mysqli_free_result($resultgroupname);
      die();
    }
    else { 
    $rowgroupname = $resultgroupname->fetch_assoc();      
   $createduser = $rowgroupname['createduser'];
   $shorthashgroupname = $rowgroupname['shorthashgroupname'];
   mysqli_free_result($resultgroupname);   
    }
   //end: getting groupname from grouplist
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
   $shorthashgroupname1 = $shorthashgroupname;
   $shorthashgroupname1 .= '1';
   
   $shorthashgroupname2 = $shorthashgroupname;
   $shorthashgroupname2 .= '2';

   $selectspecific = "SELECT `questionuuid` FROM `$shorthashgroupname2`";
   $resultspecific = $conn->query($selectspecific);
   if ($resultspecific) { 
   while ($rowspecific = $resultspecific->fetch_assoc()) {
   if (substr($rowspecific['questionuuid'], 0, 32) == $before_questionuuid) {
     echo '2';
   mysqli_free_result($resultspecific);        
     die();
   }
  }
   }
     $rand = rand (100000, 999999);
     $questionuuid = $before_questionuuid;
     $questionuuid .= $rand;
  
  $createtable = "CREATE TABLE IF NOT EXISTS `$shorthashgroupname2`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tags` TEXT NOT NULL,
    `specificquestion` TEXT NOT NULL,
    `questionuuid` VARCHAR(38) NOT NULL,
    `question` TEXT NOT NULL,
    `askeduser` VARCHAR(30) NOT NULL,
    `askedtime` DATETIME NOT NULL,
   `points` INT DEFAULT 0 NOT NULL,
    `userpointed` TEXT
    )";
  $conn->query($createtable);

  $shorthashgroupname2 = $shorthashgroupname;
  $shorthashgroupname2 .= '2';
 
  $insert = $conn->prepare ("INSERT INTO `$shorthashgroupname2`(tags, specificquestion, questionuuid, question, askeduser, askedtime) VALUES (?, ?, ?, ?, ?, ?)"); 
  $insert->bind_param("ssssss", $tags, $specificquestion, $questionuuid, $question, $askeduser, $askedtime);  
$askeduser = $_SESSION['username'];
$askedtime = date('Y-m-d H:i:s');

if ($insert->execute()) {
  $createanswer = "CREATE TABLE IF NOT EXISTS `$questionuuid`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `answer` TEXT NOT NULL,
    `answeruuid` INT NOT NULL,
    `answereduser` VARCHAR(30) NOT NULL,
    `dateandtime` DATETIME NOT NULL,
    `points` INT DEFAULT 0 NOT NULL,
    `userpointed` TEXT
    )";
    if ($conn->query($createanswer)) {
        $mydatabase = $_SESSION['database'];
        mysqli_select_db($conn, $mydatabase);      
    
      
        $insertstoringquestions = $conn->prepare("INSERT INTO `storingquestions`(precisequestion, uuid, groupuuid, place) 
        VALUES (?, ?, ?, ?)");
        $insertstoringquestions->bind_param("ssss", $specificquestion, $questionuuid, $groupuuid, $place);
        $groupuuid = $checking_groupname;
        $place = 1;
        if ($insertstoringquestions->execute()) { 
    echo '3';
        }
        else {
          echo $conn->error;
          echo 'error';
        }
        $insertstoringquestions->close();
    }
   
} 
$insert->close();
$conn->close(); 
?>
