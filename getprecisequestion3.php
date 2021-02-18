<?php
session_start();
include_once('connection5.php');
$questionid = $_POST['questionid'];
if($questionid == "") {
    echo '1';
    header('location: loginform.html');
    die();
}
$select_precise = $conn->prepare("SELECT `precisequestion`, `askeduser` FROM `shareideaquestions` WHERE `uuid` = ?");
$select_precise->bind_param("s", $questionid);
$select_precise->execute();
$result_precise = $select_precise->get_result();
if ($result_precise->num_rows !== 1) {
    echo '1';
}
else {
    $row_precise = $result_precise->fetch_assoc();
    if ($_SESSION['username'] !== $row_precise['askeduser']) {
        echo '1';
        die();
    }
    $precise = html_entity_decode(stripslashes($row_precise['precisequestion']));
    mysqli_free_result($result_precise);
    echo $precise;
}

$conn->close();
?>