<?php
session_start();
include_once('connection.php');
$hashusername = $_POST['axiy2wi3'];
$hashmypassword = $_POST['aic2eyz3'];
if ($hashusername == "" || $hashmypassword == "") {
    echo '1';
    die();
}
$get_id = "SELECT `username` FROM `userslist`";
$result_id = $conn->query($get_id);
while($rowid = $result_id->fetch_assoc()) {
  $hash_match = md5(md5($rowid['username']));
   if ($hash_match === $hashusername) {
$friendname = $rowid['username'];
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
$friname = "";
$selectfrienddetails = "SELECT `requestsendedname` FROM `friendrequestsent`";
$resultfrienddetails = $conn->query($selectfrienddetails);
while($rowfrienddetails = $resultfrienddetails->fetch_assoc()) {
    $match_hash = md5(md5($rowfrienddetails['requestsendedname']));
    if ($match_hash === $hashusername) {
        $friname = $rowfrienddetails['requestsendedname'];
        break;
    }
}
mysqli_free_result($resultfrienddetails);
if ($friname == "") {
    $selectfriend = $conn->prepare("SELECT `friendname` FROM `friendslist` WHERE `friendname` = ?");
    $selectfriend->bind_param("s", $friendname);
    $selectfriend->execute();
    $resultfriend = $selectfriend->get_result(); 
    if ($resultfriend->num_rows === 1) {
    mysqli_free_result($resultfriend);

    $delete1 = $conn->prepare("DELETE FROM `friendslist` WHERE `friendname` = ?");
    $delete1->bind_param("s", $friendname);
    if ($delete1->execute()) { 
    $delete2 = "DROP TABLE `$friendname`";
     $conn->query($delete2);

     mysqli_select_db($conn, 'membersinwebsite');
      $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
      $select_fridb->bind_param("s", $friendname);
      $select_fridb->execute();
      $result_fridb = $select_fridb->get_result();
      $row_fridb = $result_fridb->fetch_assoc();
      $created_db = $row_fridb['databasename'];
      mysqli_free_result($result_fridb);
   mysqli_select_db($conn, $created_db);

    $delete3 = $conn->prepare("DELETE FROM `friendslist` WHERE `friendname` = ?");
    $delete3->bind_param("s", trim($myname));
    if ($delete3->execute()) { 
      $delete4 = "DROP TABLE `$myname`";
      $conn->query($delete4);
        echo '2';
    }
    $delete3->close();
    }
    $delete1->close();
      die();
    }
    else {
        echo '2';
        die();
    }    
}
$delete = "DELETE FROM `friendrequestsent` WHERE `requestsendedname` = '$friname'";
$conn->query($delete);

mysqli_select_db($conn, 'membersinwebsite');
      $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
      $select_fridb->bind_param("s", $friname);
      $select_fridb->execute();
      $result_fridb = $select_fridb->get_result();
      $row_fridb = $result_fridb->fetch_assoc();
      $created_db = $row_fridb['databasename'];
      mysqli_free_result($result_fridb);
   mysqli_select_db($conn, $created_db);

$delete2 = "DELETE FROM `friendrequestgot` WHERE `requestgotname` = '".$_SESSION['username']."'";
if ($conn->query($delete2)) {
    echo '3';
}
$conn->close();
?>
