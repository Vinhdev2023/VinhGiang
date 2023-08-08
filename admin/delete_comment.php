<?php
include 'masteradmin/config.php';

if (isset($_GET['id'])) {
    $cus_id = $_GET['id'];
    mysqli_query($connect, "UPDATE tbl_custommer SET
    cus_message = ''
    WHERE cus_id = $cus_id");
    header('location: custommer.php');
} else {
    header('location: custommer.php');
}
?>