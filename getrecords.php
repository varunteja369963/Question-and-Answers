<?php
session_start();
   include_once('connection1.php');
   $hashgroupname = $_POST['groupname'];
   $selectgroupname = $conn->prepare("SELECT shorthashgroupname, createduser FROM `grouplist` WHERE hashgroupname = ?");
   $selectgroupname->bind_param("s", $hashgroupname);
   $selectgroupname->execute();
   $resultgroupname = $selectgroupname->get_result();
   $rowgroupname = $resultgroupname->fetch_assoc();
   $createduser = $rowgroupname['createduser'];
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
$shorthashgroupname2 = $rowgroupname['shorthashgroupname'];
$shorthashgroupname2 .= '2';
mysqli_free_result($resultgroupname);
$group_count = "SELECT MAX(id) AS max FROM `$shorthashgroupname2`";
if ($result_group_count = $conn->query($group_count)) {
$row_group_count = $result_group_count->fetch_assoc();
$max = $row_group_count['max'];
mysqli_free_result($result_group_count);
echo $max;   
}
 else {
     echo 'nothing';
 }
$conn->close();
?>