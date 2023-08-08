<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_orders` WHERE customer_id = '$user_id'") or die('query failed');

   mysqli_query($conn, "INSERT INTO `tbl_orders`(customer_id, staff_id, prd_name, prd_price, prd_quantity, prd_image, cart_satus) VALUES('$user_id', '2', '$product_name', '$product_price', '$product_quantity', '$product_image', 'ordering')") or die('query failed');
   $message[] = 'Sản phẩm được thêm vào giỏ!';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   <link rel="icon" href="img/icon.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Cửa Hàng</h3>
      <p> <a href="index.php">Trang Chủ</a> / Cửa Hàng </p>
   </div>

   <section class="products">
      
      <h1 class="title">Sách</h1>
      <?php include 'product/product-shop.php'; ?>

   </section>
   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>