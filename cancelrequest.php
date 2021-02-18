<?php
session_start();
#connecting database 
include_once('connection1.php');
$hashusername = $_POST['axiy2wi3'];
if ($hashusername == "") {
    echo '1';
    die();
}
$myfriendname = "";
$selectfrienddetails = "SELECT `requestgotname` FROM `friendrequestgot`";
$resultfrienddetails = $conn->query($selectfrienddetails);
while ($rowfrienddetails = mysqli_fetch_assoc($resultfrienddetails)) {
    $match_name = md5(md5($rowfrienddetails['requestgotname']));
    if ($match_name === $hashusername) {
        $myfriendname = $rowfrienddetails['requestgotname'];
        break;
    }
}
mysqli_free_result($resultfrienddetails);
if ($myfriendname == "") {
    echo '3';
    die();
}
$delete = "DELETE FROM `friendrequestgot` WHERE `requestgotname` = '$myfriendname'";
$conn->query($delete);

mysqli_select_db($conn, 'membersinwebsite');
$select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
$select_fridb->bind_param("s", $myfriendname);
$select_fridb->execute();
$result_fridb = $select_fridb->get_result();
$row_fridb = $result_fridb->fetch_assoc();
$created_db = $row_fridb['databasename'];
mysqli_free_result($result_fridb);
mysqli_select_db($conn, $created_db);

$delete2 = "DELETE FROM `friendrequestsent` WHERE `requestsendedname` = '".$_SESSION['username']."'";
if ($conn->query($delete2)) { 
    echo '2';
}
$conn->close();
?>
