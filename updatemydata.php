<?php
session_start();
include_once('connection.php');
$answer1 = urldecode($_POST['answer']);
$answer2 = preg_replace("/[ ]/", "&nbsp;", $answer1);
$answer = mysqli_real_escape_string($conn, $answer2);
$num = $_POST['num'];
if ($num === '1') {
  $column = 'aboutyourself';
}
else if ($num === '2') {
    $column = 'greateststrength';
}
else if ($num === '3') {
    $column = 'greatestweakness';
}
else if ($num === '4') {
    $column = 'diffsituations';
}
else if ($num === '5') {
    $column = 'seeyourself';
}
else if ($num === '6') {
    $column = 'teamplayer';
}
else if ($num === '7') {
    $column = 'disagreement';
}
else if ($num === '8') {
    $column = 'longandshortgoal';
}
else if ($num === '9') {
    $column = 'hobbies';
}
else if ($num === '10') {
    $column = 'whenyoustart';
}
else {
    echo '2';
    die();
}
$insert_quote = $conn->prepare("UPDATE `userslist` SET `$column` = ? WHERE username = ?");
$insert_quote->bind_param("ss", $answer, $_SESSION['username']);
if ($insert_quote->execute()) {
    echo '1';
}
else {
    echo '2';
}
$insert_quote->close();
$conn->close();
?>