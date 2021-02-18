<?php
include_once 'friendrequest.php';
  session_start();
$servername='127.0.0.1';
$username='root';
$password='password';
$db = $_SESSION['username'];
#connecting database
static $conn;
if ($conn == NULL){ 
$conn = new mysqli($servername, $username, $password, $db); 
}
if(isset($_POST['addfriend'])) {
    $createfriendslist = "CREATE TABLE IF NOT EXISTS friendslist (
        id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        friendid INT(4) NOT NULL,
        friendname VARCHAR(30) NOT NULL,
        friendmobileno VARCHAR(10) NOT NULL
        )";
        $conn->query($createfriendslist);
        $selectdb1 = mysqli_select_db($conn, $username);
        $conn->query($selectdb1);
        $selected = "SELECT * FROM userslist WHERE id = $id";
$resulted = $conn->query($selected);
$rowed = $resulted->fetch_assoc();
$friendid = $rowed['id'];
$friendusername = $rowed['username']; 
$friendmobileno = $rowed['mobileno'];
$selectdb2 = mysqli_select_db($username, $conn);
$conn->query($selectdb2);
        $insert = $conn->prepare("INSERT INTO friendslist (friendid, friendname, friendmobileno) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $friendid, $friendusername, $friendmobileno);
        $insert->execute();
        $insert->close();
}
$delete1 = "DELETE FROM friendrequestlist WHERE id = $id";
$conn->query($delete1);
$delete2 = "DELETE FROM friendrequestedlist WHERE id = $id";
$conn->query($delete2);
?>