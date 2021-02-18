<?php
 include_once('connection.php');
        session_start();
$username = $_POST['username'];
if (!preg_match("/^[a-z,A-Z,0-9 ]+$/", $username)) {
    echo '1';
    die();
}

if (strlen($username) < 4 || strlen($username) > 30) {
	echo '1';
	die();
}

if ($username == '' || $_POST['password'] == '') {
    echo '5';
    header('location: loginform.html');
    die();
}

$username1 = mysqli_real_escape_string($conn, $_POST['username']);
$password1 = mysqli_real_escape_string($conn, hash('sha256', $_POST['password']));
$select = $conn->prepare("SELECT `username`, `hashpassword`, `databasename` FROM `userslist` WHERE `username` = ? AND `hashpassword` = ?");
$select->bind_param("ss", $username1, $password1);
$select->execute();
$result = $select->get_result();
if ($result->num_rows === 1){
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $username1;
    $_SESSION['logged_in'] = true;
    $_SESSION['database'] = $row['databasename'];
    echo '4';
mysqli_free_result($result);
}  
    else {
        $select2 = $conn->prepare("SELECT `username` FROM `userslist` WHERE `username` = ?");
        $select2->bind_param("s", $username1);
        $select2->execute();
    $result2 = $select2->get_result();
    if ($result2->num_rows !== 1) {
        echo '2';
mysqli_free_result($result2);        
        die();
    }
    else {
        $select3 = $conn->prepare("SELECT `hashpassword` FROM `userslist` WHERE `hashpassword` = ?");
        $select3->bind_param("s", $password1);
        $select3->execute();
    $result3 = $select3->get_result();
    if ($result3->num_rows !== 1) {
        echo '3';
    }
}
mysqli_free_result($result2);
mysqli_free_result($result3);    
}
    $conn->close();
    ?>
