<?php
session_start();
if ($_SESSION['logged_in'] != true) {
  echo '1';
  header("location: loginform.html");
  die();
}
?>
<?php
include_once('connection.php');
$hashgroupname = $_POST['cile50xllsy'];
$edited_groupname = $_POST['groupname'];
if ($hashgroupname == "" || $edited_groupname == "") {
    echo '1';
    header("location: loginform.html");
    die();
}
$groupname_match = preg_match("/^[a-z,A-Z,0-9 ]+$/", $edited_groupname);
   if ($groupname_match == 0) {
     echo '2';
     die();
   }
    if (strlen($edited_groupname) < 4 && strlen($edited_groupname) > 25) {
      echo '2';
      die();
    }
$update_maingrouplist = $conn->prepare("UPDATE `maingrouplist` SET `groupname` = ? WHERE `hashgroupname` = ?");
$update_maingrouplist->bind_param("ss", $edited_groupname, $hashgroupname);
$update_maingrouplist->execute();
$update_maingrouplist->close();

$mydb1 = $_SESSION['database'];
mysqli_select_db($conn, $mydb1);

$update_grouplist = $conn->prepare("UPDATE `grouplist` SET `groupname` = ? WHERE `hashgroupname` = ?");
$update_grouplist->bind_param("ss", $edited_groupname, $hashgroupname);
$update_grouplist->execute();
$update_grouplist->close();
echo '3';
$conn->close();
?>