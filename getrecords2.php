<?php
session_start();
   include_once('connection4.php');
$group_count = "SELECT MAX(id) AS max FROM `solvemyproblemquestions`";
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