<?php
$servername='localhost';
$username='root';
$password='';
      $db = 'searchanderror';
      #connecting database
      static $conn;
      if ($conn == NULL){ 
      $conn = new mysqli($servername, $username, $password, $db); 
      }
      return $conn;
 ?>