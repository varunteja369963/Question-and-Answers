
<?php
 session_start();
include_once('connection.php');
$hashgroupname = $_POST['grpname'];
 $hashname = $_POST['cyke3lx93ja3lnkczldyb'];
 if ($hashgroupname == "" || $hashname == "") {
     echo '1';
     header('location: loginform.html');
     die();
 }  

 $friend_name = "";
 $get_id = "SELECT `username`, `hashusername`, `gmail` FROM `userslist`";
$result_id = $conn->query($get_id);
while($rowid = $result_id->fetch_assoc()) {
  $hash_match = md5(md5($rowid['username']));
   if ($hash_match === $hashname) {
$friend_name = $rowid['username'];
$hashusername = $rowid['hashusername'];
$frigmail = $rowid['gmail'];
    break;
   }
}
mysqli_free_result($result_id);
if ($friend_name == "") {
    echo '2';
    die();
}

$change_to_my_db = $_SESSION['database'];
mysqli_select_db($conn, $change_to_my_db);

$adding_user = $_SESSION['username'];
 $select_group_details = $conn->prepare("SELECT `groupname`, `shorthashgroupname`, `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
 $select_group_details->bind_param("s", $hashgroupname);
 $select_group_details->execute();
 $result_group_details = $select_group_details->get_result();
 if ($result_group_details->num_rows === 1) { 
  $row_group_details = $result_group_details->fetch_assoc();
        $groupname = $row_group_details['groupname'];
        $shorthashgroupname = $row_group_details['shorthashgroupname'];
        $createduser = $row_group_details['createduser'];
        $present_time = date("Y-m-d H:i:s");
        $shorthashgroupname1 = $shorthashgroupname;
        $shorthashgroupname1 .= '1';
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

 $select_group_name = $conn->prepare("SELECT `username` FROM `$shorthashgroupname1` WHERE `username` = ?");
 $select_group_name->bind_param("s", $friend_name);
 $select_group_name->execute();
 $result_group_name = $select_group_name->get_result();
 if ($result_group_name->num_rows >= 1) {
     echo '3';
     die();
 }
 mysqli_free_result($result_group_name);

 $insert_friend_details = $conn->prepare("INSERT INTO `$shorthashgroupname1`(username, hashusername, gmail, createdtime) VALUES (?, ?, ?, ?)");
$insert_friend_details->bind_param("ssss", $friend_name, $hashusername, $frigmail, $present_time);
if ($insert_friend_details->execute()) {
    mysqli_select_db($conn, 'membersinwebsite');
    $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $friend_name);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
    mysqli_free_result($result_fridb);
 mysqli_select_db($conn, $created_db);

 $insert_group_details  = $conn->prepare( "INSERT INTO `grouplist` (groupname, shorthashgroupname, hashgroupname, createduser, addeduser) VALUES (?, ?, ?, ?, ?)");
 $insert_group_details->bind_param("sssss", $groupname, $shorthashgroupname, $hashgroupname, $createduser, $adding_user);
if ($insert_group_details->execute()) {
   echo '4';
}
$insert_group_details->close();
}
$insert_friend_details->close();
 }
 else {
     echo '2';
 }
 mysqli_free_result($result_group_details);
 $conn->close();
?>
