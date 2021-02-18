<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
   echo '1';        
    header('location: loginform.html');
         die();
       }
include_once('connection1.php');
$groupname = $_POST['hashgroupname'];
$questionid = $_POST['questionid'];
if($groupname == "" || $questionid == "") {
    echo '1';
    header('location: loginform.html');
    die();
}
$selectgroupname = $conn->prepare("SELECT `shorthashgroupname` FROM `grouplist` WHERE `hashgroupname` = ?");
$selectgroupname->bind_param("s", $groupname);
$selectgroupname->execute();
$resultgroupname = $selectgroupname->get_result();
$count = mysqli_num_rows($resultgroupname);
if ($count !== 1) {
  echo '1';
mysqli_free_result($resultgroupname);  
  die();
}
else {
$rowgroupname = $resultgroupname->fetch_assoc();    
    $shorthashgroupname = $rowgroupname['shorthashgroupname'];
    $shorthashgroupname .= '2';
mysqli_free_result($resultgroupname);    
}
$select_precise = $conn->prepare("SELECT `specificquestion`, `askeduser` FROM `$shorthashgroupname` WHERE `questionuuid` = ?");
$select_precise->bind_param("s", $questionid);
$select_precise->execute();
$result_precise = $select_precise->get_result();
if ($result_precise->num_rows !== 1) {
    echo '1';
}
else {
    $row_precise = $result_precise->fetch_assoc();
    if ($_SESSION['username'] !== $row_precise['askeduser']) {
        echo '1';
        die();
    }
    $precise = html_entity_decode(stripslashes($row_precise['specificquestion']));
    mysqli_free_result($result_precise);
    echo $precise;
}

$conn->close();
?>