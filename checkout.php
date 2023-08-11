<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['order_btn'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
   $placed_on = date('d-M-Y H:i:s');

   $cus_fullname = $_POST['name'];
   $cus_phone = $_POST['number'];
   $cus_address = $_POST['email'];
   $cus_method = $_POST['method'];
   $cus_street = $_POST['street'];
   $cus_city = $_POST['city'];
   $cus_country = $_POST['country'];
   $cus_pin_code = $_POST['pin_code'];

   // $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `tbl_orders` WHERE customer_id = '$user_id' AND cart_satus = 'ordering'") or die('query failed');
   if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
         $cart_products = $cart_item['prd_name'] . ' (' . $cart_item['prd_quantity'] . ') ';
         $sub_total = ($cart_item['prd_price'] * $cart_item['prd_quantity']);
         $prd_quantity = $cart_item['prd_quantity'];
         $cart_total += $sub_total;
         $prd_name = $cart_item['prd_name'];
         $ord_id = $cart_item['ord_id'];

         $product_query = mysqli_query($conn, "SELECT prd_id FROM tbl_product WHERE prd_name = '$prd_name'") or die('query failed');
         if (mysqli_num_rows($product_query) == 1) {
            while ($prd_item = mysqli_fetch_array($product_query)) {
               $prd_id = $prd_item['prd_id'];
            }
         }

         // $total_products = implode(', ', $cart_products);

         $order_query = mysqli_query($conn, "SELECT * FROM `tbl_order_detail` WHERE cus_name = '$name' AND cus_number = '$number' AND cus_email = '$email' AND cus_method = '$method' AND cus_address = '$address' AND total_products = '$cart_products' AND total_price = '$sub_total'") or die('query failed');

         if ($sub_total == 0) {
            $message[] = 'Giỏ hàng của bạn chưa có sản phẩm nào!';
         } else {
            mysqli_query($conn, "INSERT INTO `tbl_order_detail`(ordd_id, cus_id, cus_name, cus_number, cus_email, cus_method, cus_address, total_products, prd_id,prd_name, prd_quantity, total_price, placed_on, payment_status) VALUES($ord_id,'$user_id', '$name', '$number', '$email', '$method', '$address', '$cart_products','$prd_id','$prd_name', $prd_quantity, '$sub_total', '$placed_on', 'đang chờ xác nhận')") or die('query failed');
               $message[] = 'Đơn hàng đặt thành công!';
               mysqli_query($conn, "UPDATE `tbl_orders` SET cart_satus = 'ordered' WHERE customer_id = '$user_id' AND cart_satus = 'ordering'") or die('query failed');
               mysqli_query($conn, "UPDATE `tbl_custommer` SET 
               cus_fullname = '$cus_fullname',
               cus_phone = '$cus_phone',
               cus_address = '$cus_address',
               cus_method = '$cus_method',
               cus_street = '$cus_street',
               cus_city = '$cus_city',
               cus_country = '$cus_country',
               cus_pin_code = '$cus_pin_code'
               WHERE cus_id = '$user_id'") or die('query failed');
               header('location: orders.php');
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   <link rel="icon" href="img/icon.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Thanh Toán</h3>
      <p> <a href="home.php">Trang Chủ</a> / Thanh Toán </p>
   </div>

   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `tbl_orders` WHERE customer_id = '$user_id' AND cart_satus = 'ordering'") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
         while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = ($fetch_cart['prd_price'] * $fetch_cart['prd_quantity']);
            $grand_total += $total_price;
      ?>
            <p> <?php echo $fetch_cart['prd_name']; ?> <span>(<?php echo $fetch_cart['prd_price'] . 'VNĐ' . ' x ' . $fetch_cart['prd_quantity']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">Giỏ hàng của bạn chưa có sản phẩm nào!</p>';
      }
      ?>
      <div class="grand-total"> Tổng cộng : <span><?php echo $grand_total; ?>VNĐ</span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post">
         <?php 
         $select_cus = mysqli_query($conn, "SELECT * FROM tbl_custommer WHERE cus_id = '$user_id'");
         $fetch_cus = mysqli_fetch_assoc($select_cus);
         ?>
         <h3>Thông tin thanh toán</h3>
         <div class="flex">
            <div class="inputBox">
               <span>Họ và tên :</span>
               <input type="text" name="name" required placeholder="Nhập họ và tên" value="<?php echo $fetch_cus['cus_fullname']; ?>">
            </div>
            <div class="inputBox">
               <span>Số điện thoại :</span>
               <input type="number" name="number" required placeholder="Nhập số điện thoại" value="<?php echo $fetch_cus['cus_phone']; ?>">
            </div>
            <div class="inputBox">
               <span>Email :</span>
               <input type="email" name="email" required placeholder="Nhập email" value="<?php echo $fetch_cus['cus_address'] ?>">
            </div>
            <div class="inputBox">
               <span>Phương thức thanh toán :</span>
               <select name="method">
                  <option value="Tiền mặt" <?php if($fetch_cus['cus_method'] == 'Tiền mặt'){echo 'selected';} ?>>Tiền mặt</option>
                  <option value="Thẻ tín dụng" <?php if($fetch_cus['cus_method'] == 'Thẻ tín dụng'){echo 'selected';} ?>>Thẻ tín dụng</option>
                  <option value="Paypal" <?php if($fetch_cus['cus_method'] == 'Paypal'){echo 'selected';} ?>>Paypal</option>
                  <option value="Momo" <?php if($fetch_cus['cus_method'] == 'Momo'){echo 'selected';} ?>>Momo</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Địa chỉ :</span>
               <input type="text" name="street" required placeholder="Nhập địa chỉ" value="<?php echo $fetch_cus['cus_street'] ?>">
            </div>
            <div class="inputBox">
               <span>Thành phố :</span>
               <input type="text" name="city" required placeholder="Nhập tên thành phố" value="<?php echo $fetch_cus['cus_city'] ?>">
            </div>
            <div class="inputBox">
               <span>Quốc gia :</span>
               <input type="text" name="country" required placeholder="Nhập tên quốc gia" value="<?php echo $fetch_cus['cus_country'] ?>">
            </div>
            <div class="inputBox">
               <span>Mã Zip :</span>
               <input type="number" min="0" name="pin_code" required placeholder="Nhập zip code" value="<?php echo $fetch_cus['cus_pin_code'] ?>">
            </div>
         </div>
         <input type="submit" value="Đặt hàng" class="btn" name="order_btn">
      </form>

   </section>









   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>
