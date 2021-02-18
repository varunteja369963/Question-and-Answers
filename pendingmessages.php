<?php 
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('location: loginform.html');
     die();
   }
   include_once('connection1.php');
$total = 0;   
   $frnd_array = array();
   $select = "SELECT `friendname` FROM `friendslist`";
   if ($result = $conn->query($select)) {
       if ($result->num_rows > 0) {  
   while($row = $result->fetch_assoc()) {
       array_push($frnd_array, $row['friendname']);
   }
   mysqli_free_result($result);
   foreach($frnd_array as $frnd_name) {
       $select2 = "SELECT COUNT(*) AS count FROM `$frnd_name` WHERE `sent` = 0";
       $result2 = $conn->query($select2);
       $row2 = $result2->fetch_assoc();
       $total = $total + $row2['count'];
   }
   mysqli_free_result($result2);
}
   }
echo $total;
   $conn->close();
?>