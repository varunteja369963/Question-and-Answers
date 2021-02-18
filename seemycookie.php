<?php
session_start();
if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['database'] = $_COOKIE['database'];
    $_SESSION['logged_in'] = true;
    echo '1';
}
else {
    echo '2';
    echo 'something';
}
?>