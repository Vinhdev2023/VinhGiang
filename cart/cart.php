<?php
include 'config.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}else {
    header('location: login.php');
}
if(isset($user_id)){
    $order_query = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_orders WHERE customer_id = '$user_id'"));
    $order_detail_query = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_order_detail WHERE cus_id = '$user_id'"));
    $cart = $order_query - $order_detail_query;
}
?>
<a href="cart-notify.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo number_format($cart); ?>)</span></a>