<?php
session_start();

unset($_SESSION['username']);
unset($_SESSION['userpass']);

// session_destroy();
header('location:index.php');