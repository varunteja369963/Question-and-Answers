<?php
include_once('connection.php');
date_default_timezone_set('Asia/Kolkata');
if (isset($_COOKIE['username'])) {
    unset($_COOKIE['username']);
    unset($_COOKIE['database']);
    setcookie("username", null, -1, '/');
    setcookie("database", null, -1, '/');
header('location: loginform.html');
}   
$username_in_link = $_POST['username'];
    $key = $_REQUEST['key'];
    $confirmcode = $_REQUEST['verificationcode'];
    if ($username_in_link == "" || $key == "" || $confirmcode == "") {      
    header('location: errorpage.html');
    die();            
        }
        if ($key !== md5($username_in_link)) {
            header('location: errorpage.html');
            die();
        }

        $delete_row = $conn->prepare("DELETE FROM `resetpassword` WHERE `username` = ? AND `confirmationcode` = ?");
        $delete_row->bind_param("ss", $username_in_link, $confirmcode);
        $delete_row->execute();

$password1 = urldecode($_POST['password1']);
$password2 = urldecode($_POST['password2']);
if ($password1 !== $password2){
    echo '1';
    die();
}
else if ((strlen($password1) < 4 || strlen($password1) > 30) && (strlen($password2) < 4 || strlen($password2))) {
    echo '1';
    die();
}
else {
    $password_bef = hash("sha256", $password1);
    $password = mysqli_real_escape_string($conn, $password_bef);
    $update = $conn->prepare("UPDATE `userslist` SET `hashpassword` = ? WHERE `username` = ? AND `hashusername` = ?");
    $update->bind_param("sss", $password, $username_in_link, $key);
    $update->execute();
    $update->close();
    echo '2';
}
$conn->close();
?>