<?php
session_start();
include_once('connection1.php');
$groupname = $_POST['grpname'];

$select_grp = $conn->prepare("SELECT `createduser`, `shorthashgroupname` FROM `grouplist` WHERE hashgroupname = ?");
$select_grp->bind_param("s", $groupname);
$select_grp->execute();
$result_grp = $select_grp->get_result();
if($result_grp->num_rows !== 1) {
    echo '3';
}
else {
    $row_grp = $result_grp->fetch_assoc();
    $shorthashgroupname = $row_grp['shorthashgroupname'];
    $shorthashgroupname .= '1';
    $createduser = $row_grp['createduser'];
}
mysqli_free_result($result_grp);

if ($_SESSION['username'] !== $createduser) {
    mysqli_select_db($conn, 'membersinwebsite');
    $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $createduser);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
    mysqli_free_result($result_fridb);
 mysqli_select_db($conn, $created_db);
}
$select_friend = "SELECT `username` FROM `$shorthashgroupname`";
$result_friend = $conn->query($select_friend);
if ($result_friend->num_rows > 1) {
    echo '1';
}
else {
    echo '2';
}
$conn->close();
?>