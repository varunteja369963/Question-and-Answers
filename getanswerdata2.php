<?php
session_start();
include_once('connection4.php');
$questionid = $_POST['questionid'];
$answeruuid = $_POST['iaZs23kiclDei92A'];
if ($questionid == "" || $answeruuid == "") {
    echo '1';
    header('location: loginform.html');
    die();
}
$checking_user = $conn->prepare("SELECT `answereduser` FROM `$questionid` WHERE `answeruuid` = ?");
$checking_user->bind_param("i", $answeruuid);
$checking_user->execute();
$result_checking = $checking_user->get_result();
if ($result_checking->num_rows !== 1) {
    echo '1';
    die();
}
else {
    $row_checking = $result_checking->fetch_assoc();
    $answereduser = $row_checking['answereduser'];
    if ($_SESSION['username'] !== $answereduser) {
        echo '2';
        die();
    }
    else {
        $get_answer = $conn->prepare("SELECT `answers` FROM `$questionid` WHERE `answeruuid` = ?");
        $get_answer->bind_param("i", $answeruuid);
        $get_answer->execute();
        $result_answer = $get_answer->get_result();
        if ($result_answer->num_rows !== 1) {
            echo '1';
            die();
        }
        else {
            $row_answer = $result_answer->fetch_assoc();
            $answer = html_entity_decode(stripslashes($row_answer['answers']));
            mysqli_free_result($result_answer);
            echo $answer;
    }
}
}
mysqli_free_result($result_checking);
$conn->close();
?>