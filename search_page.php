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
   <title>search page</title>
   <link rel="icon" href="admin/adimn-img/icon.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Tìm kiếm</h3>
      <p> <a href="index.php">Trang chủ</a> / Tìm kiếm </p>
   </div>

   <section class="search-form">
      <form action="" method="post">
         <input type="text" name="search" placeholder="Tìm sách..." class="box">
         <input type="submit" name="submit" value="Tìm" class="btn">
      </form>
   </section>

   <section class="products" style="padding-top: 0;">

      <div class="box-container">
         <?php
         if (isset($_POST['submit']) && $_POST['search'] != '') {
            $search_item = $_POST['search'];
            $select_products = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE prd_name LIKE '%{$search_item}%'") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_product = mysqli_fetch_assoc($select_products)) {
         ?>
                  <form action="" method="post" class="box">
                     <img src="admin/adimn-img/<?php echo $fetch_product['prd_image']; ?>" alt="" class="image">
                     <div class="name"><?php echo $fetch_product['prd_name']; ?></div>
                     <div class="price"><?php echo $fetch_product['prd_price']; ?> VNĐ</div>
                     <input type="number" class="qty" name="product_quantity" min="1" value="1">
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['prd_name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['prd_price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['prd_image']; ?>">
                     <input type="submit" class="btn" value="Thêm vào giỏ" name="add_to_cart">
                  </form>
         <?php
               }
            } else {
               echo '<p class="empty">Không có kết quả được tìm thấy!</p>';
            }
         } else {
            echo '<p class="empty">Hãy tìm kiếm gì đó!</p>';
         }
         ?>
      </div>


   </section>









   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>
