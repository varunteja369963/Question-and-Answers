<?php
session_start();
header('location: aboutme.php?q='.md5($_SESSION['username']));
?>