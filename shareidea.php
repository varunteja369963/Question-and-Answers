<?php
session_start();
include_once('connection5.php');
date_default_timezone_set('Asia/Kolkata');  

$tags_before = $_POST['selected_tags'];
$tags = trim(preg_replace('/\s\s+/', ' ', $tags_before));

$specificquestion1 = urldecode($_POST['precise_question']);
$specificquestion2 = htmlentities($specificquestion1);
$specificquestion = mysqli_real_escape_string($conn, $specificquestion2);

$uuid = md5($specificquestion);

$question1 = urldecode($_POST['question']);
$question2 = htmlentities($question1);   
$question = mysqli_real_escape_string($conn, $question2);

$yearstake1 = urldecode($_POST['yearstake']);
$yearstake2 = htmlentities($yearstake1);   
$yearstake = mysqli_real_escape_string($conn, $yearstake2);

$participation1 = urldecode($_POST['participation']);
$participation2 = htmlentities($participation1);   
$participation = mysqli_real_escape_string($conn, $participation2);

$requirements1 = urldecode($_POST['requirements']);
$requirements2 = htmlentities($requirements1);   
$requirements = mysqli_real_escape_string($conn, $requirements2);

$investement1 = urldecode($_POST['investement']);
$investement2 = htmlentities($investement1);   
$investement = mysqli_real_escape_string($conn, $investement2);

$create_storing_question = "CREATE TABLE IF NOT EXISTS `shareideaquestions`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `precisequestion` VARCHAR(250) NOT NULL,
    `uuid` VARCHAR(32) NOT NULL,
    `question` TEXT NOT NULL,
    `tags` TEXT NOT NULL,
    `askeduser` VARCHAR(30) NOT NULL,
    `dateandtime` TIMESTAMP NOT NULL,
    `points` INT NOT NULL DEFAULT 0,
    `yearstake` VARCHAR(20) NOT NULL,
    `participation` VARCHAR(20) NOT NULL,
    `requirements` VARCHAR(20) NOT NULL,
    `investement` VARCHAR(20) NOT NULL, 
    `userpointed` TEXT
    )";
    $conn->query($create_storing_question);

$select = $conn->prepare("SELECT `uuid` FROM `shareideaquestions` WHERE `uuid` = ?");
if ($select) { 
 $select->bind_param("s", $uuid);
$select->execute();
$result = $select->get_result(); 
    if ($result->num_rows > 0) { 
        mysqli_free_result($result);
       echo '2';
        die();
    }
    else {
        mysqli_free_result($result);
    }
}
     $insert_questions_details = $conn->prepare("INSERT INTO `shareideaquestions` 
     (precisequestion, uuid, question, tags, askeduser, dateandtime, yearstake, participation, requirements, investement) 
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
     ");
     $insert_questions_details->bind_param("ssssssssss", 
     $specificquestion, $uuid, $question, $tags, $askeduser, $dateandtime, $yearstake, $participation, $requirements, $investement);
     $dateandtime = date("Y:m:d H:i:sa");
     $askeduser = $_SESSION['username'];

 if ($insert_questions_details->execute() == TRUE) { 
     $lastid = $conn->insert_id;
    $create_table = "CREATE TABLE IF NOT EXISTS `$uuid`(
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        answers TEXT NOT NULL,
        answeruuid INT NOT NULL,
        dateandtime TIMESTAMP NOT NULL,
        answereduser VARCHAR(30) NOT NULL,
        points INT NOT NULL DEFAULT 0, 
        pointeduser TEXT
    )";
    if ($conn->query($create_table)) {
        $mydatabase = $_SESSION['database'];
        mysqli_select_db($conn, $mydatabase);      
      
        $insertstoringquestions = $conn->prepare("INSERT INTO `siquestions` (precisequestion, uuid) 
        VALUES (?, ?)");
        $insertstoringquestions->bind_param("ss", $specificquestion, $uuid);
        if ($insertstoringquestions->execute()) { 
    echo $uuid;
        }
        $insertstoringquestions->close();        
    } 
 }
 $insert_questions_details->close();
 $conn->close();
?>