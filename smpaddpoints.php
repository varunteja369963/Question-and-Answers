<?php
session_start();
include_once('connection4.php');
$questionuuid = $_POST['questionuuid'];
$selectpoint1 = $conn->prepare("SELECT askeduser, points, userpointed FROM `solvemyproblemquestions` WHERE uuid = ?");
$selectpoint1->bind_param("s", $questionuuid);
$selectpoint1->execute();
$resultpoint1 = $selectpoint1->get_result();
if ($resultpoint1->num_rows != 1) { 
    echo 3;
    die();
  } 
  else { 
$rowpoint1 = $resultpoint1->fetch_assoc();
$points1 = (int)$rowpoint1['points'];
$pointeduser = $rowpoint1['userpointed'];
$askeduser = $rowpoint1['askeduser'];
$hashusername = md5($rowpoint1['askeduser']);
  }
mysqli_free_result($resultpoint1);

$exploded_data = explode(",", $pointeduser);
foreach($exploded_data as $pointeddata) {
    if ($pointeddata == $_SESSION['username']) {
        echo 2;
        die();
    }
}

$updatedpoints1 = $points1 + 1;

$updated_pointeduser = $pointeduser;
$updated_pointeduser .= $_SESSION['username'];
$updated_pointeduser .= ',';

$update_points1 = $conn->prepare("UPDATE `solvemyproblemquestions` SET points = ?, userpointed = ? WHERE uuid = ?");
$update_points1->bind_param("iss", $updatedpoints1, $updated_pointeduser, $questionuuid);
if ($update_points1->execute()) { 
      
    mysqli_select_db($conn, 'membersinwebsite');
    $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $askeduser);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
    mysqli_free_result($result_fridb);
 mysqli_select_db($conn, $created_db);
 
    $selectpoint2 = $conn->prepare("SELECT `points` FROM `smpquestions` WHERE uuid = ?");
    $selectpoint2->bind_param("s", $questionuuid);
    $selectpoint2->execute();
    $resultpoint2 = $selectpoint2->get_result();
    $rowpoint2 = $resultpoint2->fetch_assoc();
    $points2 = (int)$rowpoint2['points'];
    mysqli_free_result($resultpoint2);
    $updatedpoints2 = $points2 + 1;
    
    $update_points2 = $conn->prepare("UPDATE `smpquestions` SET points = ? WHERE uuid = ?");
    $update_points2->bind_param("is", $updatedpoints2, $questionuuid);
    if ($update_points2->execute()) {
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
                echo 1;
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