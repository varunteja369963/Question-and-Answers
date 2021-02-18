<?php
include_once('connection1.php');
$select_max = "SELECT MAX(id) AS maximum FROM `userdatabase`";
$result_max = $conn->query($select_max);
$row_max = $result_max->fetch_assoc();
$insertid = $row_max['maximum'];
if ($insertid === 0) {
 echo 'nothing found';
 die();
}
else {
  $select = "SELECT `databasename` FROM `userdatabase` WHERE `id` = $insertid";
  $result = $conn->query($select);
  $row = $result->fetch_assoc();
  $databasename = $row['databasename'];
  $substring = substr($databasename, 9);
  $num = (int)$substring;
  if ($num > 1000) {
    echo '1';
  }
  else {
 echo 'nothing found';
  }
}
$conn->close();
?>