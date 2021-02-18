<?php
$servername='127.0.0.1';
      $username='root';
      $password='';
      $db = 'solvemyproblem';
      #connecting database
      static $conn;
      if ($conn == NULL){ 
      $conn = new mysqli($servername, $username, $password, $db); 
      }
      return $conn;
 ?>