<?php
session_start();
include_once('connection1.php');
$hashgroupname = $_POST['hashgroupname'];
$questionuuid = $_POST['questionuuid'];

$select_groupname = $conn->prepare("SELECT shorthashgroupname, createduser FROM grouplist WHERE hashgroupname = ?");
$select_groupname->bind_param("s", $hashgroupname);
$select_groupname->execute();
$result_groupname = $select_groupname->get_result();
$row_groupname = $result_groupname->fetch_assoc();
$createduser = $row_groupname['createduser'];
$shortgroupname = $row_groupname['shorthashgroupname'];
mysqli_free_result($result_groupname);

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
$groupname1 = $shortgroupname;
$groupname1 .= '1';

$groupname2 = $shortgroupname;
$groupname2 .= '2';

$selectpoint1 = $conn->prepare("SELECT askeduser, points, userpointed FROM `$groupname2` WHERE questionuuid = ?");
$selectpoint1->bind_param("s", $questionuuid);
$selectpoint1->execute();
$resultpoint1 = $selectpoint1->get_result();
$rowpoint1 = $resultpoint1->fetch_assoc();
$points1 = (int)$rowpoint1['points'];
$pointeduser = $rowpoint1['userpointed'];
$hashusername = md5($rowpoint1['askeduser']);
mysqli_free_result($resultpoint1);

$exploded_data = explode(",", $pointeduser);
foreach($exploded_data as $pointeddata) {
    if ($pointeddata == $_SESSION['username']) {
        echo '2';
        die();
    }
}

$updatedpoints1 = $points1 + 1;

$updated_pointeduser = $pointeduser;
$updated_pointeduser .= $_SESSION['username'];
$updated_pointeduser .= ',';

$update_points1 = $conn->prepare("UPDATE `$groupname2` SET points = ?, userpointed = ? WHERE questionuuid = ?");
$update_points1->bind_param("iss", $updatedpoints1, $updated_pointeduser, $questionuuid);
if ($update_points1->execute()) { 
    $selectpoint2 = $conn->prepare("SELECT points FROM `$groupname1` WHERE hashusername = ?");
$selectpoint2->bind_param("s", $hashusername);
$selectpoint2->execute();
$resultpoint2 = $selectpoint2->get_result();
$rowpoint2 = $resultpoint2->fetch_assoc();
$points2 = (int)$rowpoint2['points'];
mysqli_free_result($resultpoint2);

$updatedpoints2 = $points2 + 1;

$update_points2 = $conn->prepare("UPDATE `$groupname1` SET points = ? WHERE hashusername = ?");
$update_points2->bind_param("is", $updatedpoints2, $hashusername);
if ($update_points2->execute()) {

    $db3 = $_SESSION['database'];
    mysqli_select_db($conn, $db3);

    $selectpoint3 = $conn->prepare("SELECT points FROM `storingquestions` WHERE uuid = ? AND groupuuid = ?");
    $selectpoint3->bind_param("ss", $questionuuid, $hashgroupname);
    $selectpoint3->execute();
    $resultpoint3 = $selectpoint3->get_result();
    $rowpoint3 = $resultpoint3->fetch_assoc();
    $points3 = (int)$rowpoint3['points'];
    mysqli_free_result($resultpoint3);
    
    $updatedpoints3 = $points3 + 1;
    
    $update_points3 = $conn->prepare("UPDATE `storingquestions` SET points = ? WHERE uuid = ? AND groupuuid = ?");
    $update_points3->bind_param("iss", $updatedpoints3, $questionuuid, $hashgroupname);
    if ($update_points3->execute()) { 
        mysqli_select_db($conn, 'membersinwebsite');
        $selectpoint4 = $conn->prepare("SELECT points FROM `userslist` WHERE hashusername = ?");
        $selectpoint4->bind_param("s", $hashusername);
        $selectpoint4->execute();
        $resultpoint4 = $selectpoint4->get_result();
        $rowpoint4 = $resultpoint4->fetch_assoc();
        $points4 = (int)$rowpoint4['points'];
        mysqli_free_result($resultpoint4);
        
        $updatedpoints4 = $points4 + 1;
        
        $update_points4 = $conn->prepare("UPDATE `userslist` SET points = ? WHERE hashusername = ?");
        $update_points4->bind_param("is", $updatedpoints4, $hashusername);
        if ($update_points4->execute()) {
            echo '1';
}
$update_points4->close();
    }
$update_points3->close();
}
$update_points2->close();
}
$update_points1->close();
$conn->close();
?>