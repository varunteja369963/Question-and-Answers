<?php
session_start();
include_once('connection4.php');
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

$create_storing_question = "CREATE TABLE IF NOT EXISTS `solvemyproblemquestions`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `precisequestion` VARCHAR(250) NOT NULL,
    `uuid` VARCHAR(32) NOT NULL,
    `question` TEXT NOT NULL,
    `tags` TEXT NOT NULL,
    `askeduser` VARCHAR(30) NOT NULL,
    `dateandtime` TIMESTAMP NOT NULL,
    `points` INT NOT NULL DEFAULT 0, 
    `userpointed` TEXT
    )";
    $conn->query($create_storing_question);

$select = $conn->prepare("SELECT `uuid` FROM `solvemyproblemquestions` WHERE `uuid` = ?");
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
     $insert_questions_details = $conn->prepare("INSERT INTO `solvemyproblemquestions` 
     (precisequestion, uuid, question, tags, askeduser, dateandtime) 
     VALUES (?, ?, ?, ?, ?, ?)
     ");
     $insert_questions_details->bind_param("ssssss", $specificquestion, $uuid, $question, $tags, $askeduser, $dateandtime);
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
      
        $insertstoringquestions = $conn->prepare("INSERT INTO `smpquestions` (precisequestion, uuid) 
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