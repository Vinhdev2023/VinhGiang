<?php
include 'masteradmin/config.php';
if (isset($_GET['ordd_id'])) {
    $ordd_id = $_GET['ordd_id'];
    mysqli_query($connect, "DELETE FROM tbl_order_detail WHERE ordd_id = $ordd_id");
    mysqli_query($connect, "DELETE FROM tbl_orders WHERE ord_id = $ordd_id");
    header('location: order.php');
} else {
    header('location: order.php');
}
?>