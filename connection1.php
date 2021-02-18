<?php
$servername='localhost';
$username='root';
$password='';
      $db = $_SESSION['database'];
      #connecting database
      static $conn;
      if ($conn == NULL){ 
      $conn = new mysqli($servername, $username, $password, $db); 
      }
      return $conn;
 ?>