<?php

include 'config.php';

session_start();
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
unset($_SESSION['user_id']);


header('location:login.php');

?>