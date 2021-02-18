<?php
session_start();
  if (!isset($_SESSION['logged_in'])) {
      header('location: loginform.html');
       die();
     }
     include_once('connection1.php');
     $select = "SELECT COUNT(*) AS count FROM `friendrequestgot`";
     $result = $conn->query($select);
     $row = $result->fetch_assoc();
     echo $row['count'];
$conn->close();
?>