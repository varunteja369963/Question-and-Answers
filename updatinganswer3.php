<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
 echo '2';
  die();
}
include_once('connection5.php');
$question_id = $_POST['question_id'];
$iaZs23kiclDei92A = $_POST['iaZs23kiclDei92A'];
if ($question_id == "" || $iaZs23kiclDei92A == "") {
    echo '2';
    header('location: loginform.html');
    die();
}
$answer1 = urldecode($_POST['answer']);
$answer2 = htmlentities($answer1);
$answer = mysqli_real_escape_string($conn, $answer2);

$select_answered = $conn->prepare("SELECT `answereduser` FROM `$question_id` WHERE `answeruuid` = ?");
$select_answered->bind_param("i", $iaZs23kiclDei92A);
$select_answered->execute();
$result_answered =  $select_answered->get_result();
if ($result_answered->num_rows !== 1) {
    echo '2';
    die();
}
else {
    $row_answered = $result_answered->fetch_assoc();
    if ($_SESSION['username'] !== $row_answered['answereduser']) {
        echo '1';
        die();
    }
    else {
        $update_answer = $conn->prepare("UPDATE `$question_id` SET `answers` = ? WHERE `answeruuid` = ?");
        $update_answer->bind_param("si", $answer, $iaZs23kiclDei92A);
        if ($update_answer->execute()) {
            echo '3';
        }
        $update_answer->close();
    }
}
mysqli_free_result($result_answered);
$conn->close();
?>