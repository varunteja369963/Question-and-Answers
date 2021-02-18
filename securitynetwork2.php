<?php
session_start();
if (isset($_COOKIE['username'])) { 
if (isset($_SESSION['logged_in'])) {
echo '2';
  }
  else {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['database'] = $_COOKIE['database'];
    $_SESSION['logged_in'] = true;
    echo '2';
  }
}
else {
  echo '1';
}
?>