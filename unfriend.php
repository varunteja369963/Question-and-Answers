<?php
session_start();
include_once('connection.php');
$hashpassword = $_POST['axiy2wi3'];
$hashmypassword = $_POST['aic2eyz3'];
if ($hashpassword == "" || $hashmypassword == "") {
  echo '1';
  header("location: loginform.html");
  die();
}

$get_id = "SELECT `username` FROM `userslist`";
$result_id = $conn->query($get_id);
while($rowid = $result_id->fetch_assoc()) {
  $hash_match = md5(md5($rowid['username']));
   if ($hash_match === $hashpassword) {
$friname = $rowid['username'];
    break;
   }
}
mysqli_free_result($result_id);

$get_myid = "SELECT `username` FROM `userslist`";
$result_myid = $conn->query($get_myid);
while($rowmyid = $result_myid->fetch_assoc()) {
  $hash_mymatch = md5(md5($rowmyid['username']));
   if ($hash_mymatch === $hashmypassword) {
    $myname = $rowmyid['username'];
    break;
   }
}
mysqli_free_result($result_myid);

$mydb3 = $_SESSION['database'];
mysqli_select_db($conn, $mydb3);

$selectfriend = $conn->prepare("SELECT `friendname` FROM `friendslist` WHERE `friendname` = ?");
$selectfriend->bind_param("s", $friname);
$selectfriend->execute();
$resultfriend = $selectfriend->get_result(); 
if ($resultfriend->num_rows !== 1) {
  echo '2';
  die();
}
mysqli_free_result($resultfriend);

$delete1 = $conn->prepare("DELETE FROM `friendslist` WHERE `friendname` = ?");
$delete1->bind_param("s", $friname);
if ($delete1->execute()) {
$delete2 = "DROP TABLE `$friname`";
 $conn->query($delete2);

 mysqli_select_db($conn, 'membersinwebsite');
 $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
 $select_fridb->bind_param("s", $friname);
 $select_fridb->execute();
 $result_fridb = $select_fridb->get_result();
 $row_fridb = $result_fridb->fetch_assoc();
 $created_db = $row_fridb['databasename'];
 mysqli_free_result($result_fridb);
mysqli_select_db($conn, $created_db);

$delete3 = $conn->prepare("DELETE FROM `friendslist` WHERE `friendname` = ?");
$delete3->bind_param("s", $myname);
if ($delete3->execute()) {  
  $delete4 = "DROP TABLE `$myname`";
  $conn->query($delete4);
    echo '3';
}
$delete3->close();
}
$delete1->close();
$conn->close();
?>