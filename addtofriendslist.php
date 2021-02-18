<?php
session_start();

##########   members in website  #########

include_once('connection.php');

##########   members in website  #########

$hashusername = $_POST['axiy2wi3'];

//START: setting sessions if not logged in and exiting if not valid request
if (isset($_COOKIE['username'])){ 
    if (isset($_SESSION['logged_in'])) {
      }
      else {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['database'] = $_COOKIE['database'];
        $_SESSION['logged_in'] = true;
      }
    }
    else { 
      echo '1';
    header("location: loginform.html");
    die();
    }
  //END: setting sessions if not logged in and exiting if not valid request

//START: checking for valid redirection
if ($hashusername == "") {
    echo '1';
    header('location: loginform.html');
    die();
}
//END: checking for valid redirection

$get_id = "SELECT `id`, `username` FROM `userslist`";
$result_id = $conn->query($get_id);
while($rowid = $result_id->fetch_assoc()) {
  $hash_match = md5(md5($rowid['username']));
   if ($hash_match === $hashusername) {
    $id = $rowid['id'];
    break;
   }
}
mysqli_free_result($result_id);

$mydb = $_SESSION['database'];
mysqli_select_db($conn, $mydb);

$selectfrienddetails = $conn->prepare("SELECT `requestgotid`, `requestgotname`, `requestgotgmail`
 FROM `friendrequestgot` WHERE `requestgotid` = ?");
 $selectfrienddetails->bind_param("s", $id);
 $selectfrienddetails->execute();
$resultfrienddetails = $selectfrienddetails->get_result();
if ($resultfrienddetails->num_rows !== 1) {
    echo '2';
    mysqli_free_result($resultfrienddetails);
    die();
}
else {
$rowfrienddetails = mysqli_fetch_assoc($resultfrienddetails);
$friid = $rowfrienddetails['requestgotid'];
$friname = $rowfrienddetails['requestgotname'];
$frigmail = $rowfrienddetails['requestgotgmail'];
}
mysqli_free_result($resultfrienddetails);
$insertfriend = $conn->prepare("INSERT INTO `friendslist`
(friendid, friendname, friendgmail) VALUES (?, ?, ?)");
$insertfriend->bind_param("sss", $friid, $friname, $frigmail);
if ($insertfriend->execute()){
$delete = "DELETE FROM `friendrequestgot` WHERE `requestgotid` = '$id'";
$conn->query($delete);

$createfriend = "CREATE TABLE IF NOT EXISTS `$friname`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `chat` TEXT NOT NULL,
    `place` TINYINT(1) NOT NULL,
    `sent` TINYINT(1) NOT NULL default 0,    
    `sendedtime` DATETIME NOT NULL
    )";
    $conn->query($createfriend);

mysqli_select_db($conn, 'membersinwebsite');
$select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
$select_fridb->bind_param("s", $friname);
$select_fridb->execute();
$result_fridb = $select_fridb->get_result();
$row_fridb = $result_fridb->fetch_assoc();
$created_db = $row_fridb['databasename'];
mysqli_free_result($result_fridb);
mysqli_select_db($conn, $created_db);
    
    $getting_my_id = $conn->prepare("SELECT `requestsendedid`, `requestsendedgmail` FROM `friendrequestsent` WHERE `requestsendedname` = ?");
$getting_my_id->bind_param("s", $_SESSION['username']);
$getting_my_id->execute();
$result_of_my_id = $getting_my_id->get_result();
$row_of_my_id = $result_of_my_id->fetch_assoc();
$got_my_id = $row_of_my_id['requestsendedid'];
$mygmail = $row_of_my_id['requestsendedgmail'];
mysqli_free_result($result_of_my_id);
$insertmine= $conn->prepare("INSERT INTO `friendslist`
(friendid, friendname, friendgmail) VALUES (?, ?, ?)");
$insertmine->bind_param("sss", $got_my_id, $myname, $mygmail);
$myname = $_SESSION['username'];
if ($insertmine->execute()){
    $delete2 = "DELETE FROM `friendrequestsent` WHERE `requestsendedid` = '$got_my_id'";
    $conn->query($delete2);

    $createfriend2 = "CREATE TABLE IF NOT EXISTS `$myname`(
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `chat` TEXT NOT NULL,
        `place` TINYINT(1) NOT NULL,
        `sent` TINYINT(1) NOT NULL default 0,
        `sendedtime` DATETIME NOT NULL
        )";
        if ($conn->query($createfriend2)) {
            echo '3';
        }
}
$insertmine->close();
}
$insertfriend->close();
$conn->close();
?>