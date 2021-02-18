<?php
session_start();
setcookie("username", $_SESSION['username'], time() + (86400 * 30), "/");
setcookie("database", $_SESSION['database'], time() + (86400 * 30), "/");
echo '1';
?>