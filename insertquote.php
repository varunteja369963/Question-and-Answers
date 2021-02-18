<?php
session_start();
include_once('connection.php');
$quote = mysqli_real_escape_string($conn, $_POST['quote']);
$insert_quote = $conn->prepare("UPDATE `userslist` SET quote = ? WHERE username = ?");
$insert_quote->bind_param("ss", $quote, $_SESSION['username']);
if ($insert_quote->execute()) {
    echo 1;
}
else {
    echo 2;
}
$conn->close();
?>