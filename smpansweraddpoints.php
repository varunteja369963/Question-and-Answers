<?php
session_start();
include_once('connection4.php');

$questionuuid = $_POST['questionuuid'];
$answeruuid = $_POST['ca3ka9zqkdi'];
$selectpoint1 = $conn->prepare("SELECT answereduser, points, pointeduser FROM `$questionuuid` WHERE answeruuid = ?");
$selectpoint1->bind_param("i", $answeruuid);
$selectpoint1->execute();
$resultpoint1 = $selectpoint1->get_result();
if ($resultpoint1->num_rows < 1) {
echo '3';
die();
}
else { 
$rowpoint1 = $resultpoint1->fetch_assoc();
$points1 = (int)$rowpoint1['points'];
$hashusername = md5($rowpoint1['answereduser']);
$pointeduser1 = $rowpoint1['pointeduser'];
}
mysqli_free_result($resultpoint1);

$exploded_data = explode(",", $pointeduser1);
foreach($exploded_data as $pointeddata) {
    if ($pointeddata == $_SESSION['username']) {
        echo '2';
        die();
    }
}

$updatedpoints1 = $points1 + 1;

$updated_pointeduser1 = $pointeduser1;
$updated_pointeduser1 .= $_SESSION['username'];
$updated_pointeduser1 .= ',';

$update_points1 = $conn->prepare("UPDATE `$questionuuid` SET points = ?, pointeduser = ? WHERE answeruuid = ?");
$update_points1->bind_param("iss", $updatedpoints1, $updated_pointeduser1, $answeruuid);
if ($update_points1->execute()) { 
    mysqli_select_db($conn, 'membersinwebsite');
    $selectpoint3 = $conn->prepare("SELECT points FROM `userslist` WHERE hashusername = ?");
    $selectpoint3->bind_param("s", $hashusername);
    $selectpoint3->execute();
    $resultpoint3 = $selectpoint3->get_result();
    $rowpoint3 = $resultpoint3->fetch_assoc();
    $points3 = (int)$rowpoint3['points'];
    mysqli_free_result($resultpoint3);
    
    $updatedpoints3 = $points3 + 1;
    
    $update_points3 = $conn->prepare("UPDATE `userslist` SET points = ? WHERE hashusername = ?");
    $update_points3->bind_param("is", $updatedpoints3, $hashusername);
    if ($update_points3->execute()) {
        $selectpoint4 = $conn->prepare("SELECT smppoints FROM `userslist` WHERE hashusername = ?");
        $selectpoint4->bind_param("s", $hashusername);
        $selectpoint4->execute();
        $resultpoint4 = $selectpoint4->get_result();
        $rowpoint4 = $resultpoint4->fetch_assoc();
        $points4 = (int)$rowpoint4['smppoints'];
        mysqli_free_result($resultpoint4);
        
        $updatedpoints4 = $points4 + 1;
        
        $update_points4 = $conn->prepare("UPDATE `userslist` SET smppoints = ? WHERE hashusername = ?");
        $update_points4->bind_param("is", $updatedpoints4, $hashusername);
        if ($update_points4->execute()) {
            echo '1';
}
$update_points4->close();
}
$update_points3->close();
}
$update_points1->close();
$conn->close();
?>