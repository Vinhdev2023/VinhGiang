<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    include 'masteradmin/security.php';
    header('location: dashboard.php');
} else {
    header('location: login.php');
}

// header('location: dashboard.php');
?>
