<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   <link rel="icon" href="img/icon.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Đơn Hàng</h3>
   <p> <a href="index.php">Trang Chủ</a> / Đơn Hàng </p>
</div>

<section class="placed-orders">

   <h1 class="title">Đơn hàng đã đặt</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT DISTINCT placed_on FROM `tbl_order_detail` WHERE cus_id = '$user_id'") or die('query failed');
         
         if(mysqli_num_rows($order_query) > 0){
            for ($i=0; $i < mysqli_num_rows($order_query); $i++) {
               while ($fetch_orders = mysqli_fetch_array($order_query)) {
                  $placed_on = $fetch_orders['placed_on'];
                  $prd_name_ord_query = mysqli_query($conn, "SELECT DISTINCT cus_name FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
                  $cus_number_ord_query = mysqli_query($conn, "SELECT DISTINCT cus_number FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
                  $cus_email_ord_query = mysqli_query($conn, "SELECT DISTINCT cus_email FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
                  $cus_address_ord_query = mysqli_query($conn, "SELECT DISTINCT cus_address FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
                  $cus_method_ord_query = mysqli_query($conn, "SELECT DISTINCT cus_method FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
                  $total_products_ord_query = mysqli_query($conn, "SELECT DISTINCT total_products, prd_id FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
                  $total_price_ord_query = mysqli_query($conn, "SELECT SUM(total_price) AS total_price FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
                  $payment_status_ord_query = mysqli_query($conn, "SELECT DISTINCT payment_status FROM `tbl_order_detail` WHERE cus_id = '$user_id' AND placed_on = '$placed_on'") or die('query failed');
      ?>
      <div class="box">
         <p> Đặt hàng vào : <span><?php          
         echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Tên : <span><?php while ($fetch_orders = mysqli_fetch_array($prd_name_ord_query)) {
         echo $fetch_orders['cus_name'];} ?></span> </p>
         <p> Số điện thoại : <span><?php while ($fetch_orders = mysqli_fetch_array($cus_number_ord_query)) {
         echo $fetch_orders['cus_number'];} ?></span> </p>
         <p> Email : <span><?php while ($fetch_orders = mysqli_fetch_array($cus_email_ord_query)) {
          echo $fetch_orders['cus_email'];} ?></span> </p>
         <p> Địa chỉ : <span><?php while ($fetch_orders = mysqli_fetch_array($cus_address_ord_query)) {
          echo $fetch_orders['cus_address'];} ?></span> </p>
         <p> Phương thức thanh toán : <span><?php while ($fetch_orders = mysqli_fetch_array($cus_method_ord_query)) {
         echo $fetch_orders['cus_method'];} ?></span> </p>
         <p> Đơn hàng của bạn : <span><?php while ($fetch_orders = mysqli_fetch_array($total_products_ord_query)) { ?>
            <a href="checkprd.php?prd_id=<?php echo $fetch_orders['prd_id'] ?>"><?php echo $fetch_orders['total_products'].', '; ?></a>
         <?php
         } ?></span> </p>
         <p> Tổng giá : <span><?php while ($fetch_orders = mysqli_fetch_array($total_price_ord_query)) {
         echo $fetch_orders['total_price'];} ?> VNĐ</span> </p>
         <p> Trạng thái : <span style="color:<?php while ($fetch_orders = mysqli_fetch_array($payment_status_ord_query)) {
         if ($fetch_orders["payment_status"] == 'đang chờ xác nhận' || $fetch_orders["payment_status"] == 'đã hủy đơn') {
            echo 'red';
        } elseif ($fetch_orders["payment_status"] == 'đã xác nhận') {
            echo 'blue';
        } else {
            echo 'green';
        } ?>;"><?php echo $fetch_orders['payment_status'];} ?></span> </p>
         </div>
      <?php
               }}
      }else{
         echo '<p class="empty">Chưa có đơn hàng nào!</p>';
      }
      ?>
   </div>

</section>





<!-- ,NOW() AS placed_on, (
            SELECT cus_phone FROM `tbl_custommer` WHERE tbl_custommer.cus_id = tbl_order_detail.cus_id
         ) AS number,(
            SELECT cus_address FROM `tbl_custommer` WHERE tbl_custommer.cus_id = tbl_order_detail.cus_id
         ) AS email -->


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
