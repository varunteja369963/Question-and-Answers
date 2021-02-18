<?php
session_start();
if (session_destroy()){
    if (isset($_COOKIE['username'])) {
        unset($_COOKIE['username']);
        unset($_COOKIE['database']);
        setcookie("username", null, -1, '/');
        setcookie("database", null, -1, '/');
    header('location: loginform.html');
    }
}
?>