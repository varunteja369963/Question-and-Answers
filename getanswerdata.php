<?php
session_start();
include_once('connection1.php');
$questionid = $_POST['questionid'];
$answeruuid = $_POST['iaZs23kiclDei92A'];
if ($questionid == "" || $answeruuid == "") {
    echo '1';
    header('location: loginform.html');
    die();
}

$hashgroupname = $_POST['hashgroupname'];
$select_user = $conn->prepare("SELECT `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
$select_user->bind_param("s", $hashgroupname);
$select_user->execute();
$result_user = $select_user->get_result();
$row_user = $result_user->fetch_assoc();
$createduser = $row_user['createduser'];

if ($createduser !== $_SESSION['username']) { 
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
        $get_answer = $conn->prepare("SELECT `answer` FROM `$questionid` WHERE `answeruuid` = ?");
        $get_answer->bind_param("i", $answeruuid);
        $get_answer->execute();
        $result_answer = $get_answer->get_result();
        if ($result_answer->num_rows !== 1) {
            echo '1';
            die();
        }
        else {
            $row_answer = $result_answer->fetch_assoc();
            $answer = html_entity_decode(stripslashes($row_answer['answer']));
            mysqli_free_result($result_answer);
            echo $answer;
    }
}
}
mysqli_free_result($result_checking);
$conn->close();
?>