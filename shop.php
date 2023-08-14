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

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_orders` WHERE customer_id = '$user_id' AND prd_name = '$product_name' AND cart_satus = 'ordering'") or die('query failed');

   $select_user = mysqli_query($conn, "SELECT * FROM `tbl_user`") or die('query failed');
   while ($item = mysqli_fetch_array($select_user)) {
      $a[] = $item['user_id'];
   }
   $e = array_rand($a, 1);
   $staff_id = $a[$e];

   if (mysqli_num_rows($check_cart_numbers) == 0) {
      mysqli_query($conn, "INSERT INTO `tbl_orders`(customer_id, staff_id, prd_name, prd_price, prd_quantity, prd_image, cart_satus) VALUES('$user_id', '$staff_id', '$product_name', '$product_price', '$product_quantity', '$product_image', 'ordering')") or die('query failed');
      $message[] = 'Sản phẩm được thêm vào giỏ!';
   } else {
      $item= mysqli_fetch_assoc($check_cart_numbers);
      $oldprd_quantity = $item['prd_quantity'];
      $newprd_quantity = $product_quantity + $oldprd_quantity;
      mysqli_query($conn, "UPDATE `tbl_orders` SET prd_quantity = '$newprd_quantity' WHERE customer_id = '$user_id' AND prd_name = '$product_name'") or die('query failed');
      $message[] = 'Sản phẩm được thêm vào giỏ!';
   }
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
      <p> <a href="index.php">Trang Chủ</a> / <?php if (isset($_GET['cate'])) {
         $id = $_GET['cate'];
         $cate = mysqli_query($conn , "SELECT * FROM tbl_category WHERE cate_id = '$id'");
         $item = mysqli_fetch_assoc($cate);
         echo $item['cate_name'];
      }else {
         echo 'Cửa Hàng';
      } ?> </p>
   </div>
   
   <section class="products">
      <h1 class="title">Sách</h1>
      
      <div class="container" style="font-size: 20px;">
      <?php $cate_query = mysqli_query($conn , "SELECT * FROM tbl_category"); ?>
         <ul style="display: flex; gap: 55px; justify-content: center; margin: 10px 0px 15px 0px;">
            <li><a href="shop.php"> Tất cả </a> </li>
            <?php while($item = mysqli_fetch_array($cate_query)){ ?>
            <li><a href="shop.php?cate=<?php echo $item['cate_id'] ?>"> <?php echo $item['cate_name'] ?> </a> </li>
            <?php } ?>
         </ul>
      </div>

      <?php include 'product/product-shop.php'; ?>

      
   </section>
   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>