<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `tbl_orders` SET prd_quantity = '$cart_quantity' WHERE ord_id = '$cart_id'") or die('query failed');
   $message[] = 'Số lượng đã được cập nhật!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `tbl_orders` WHERE ord_id = '$delete_id'") or die('query failed');
   header('location:cart-notify.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `tbl_orders` WHERE customer_id = '$user_id' AND cart_satus = 'ordering'") or die('query failed');
   header('location:cart-notify.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>
   <link rel="icon" href="img/icon.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Giỏ Hàng</h3>
   <p> <a href="index.php">Trang Chủ</a> / Giỏ Hàng </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Sản phẩm được đặt</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `tbl_orders` WHERE customer_id = '$user_id' AND cart_satus = 'ordering'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart-notify.php?delete=<?php echo $fetch_cart['ord_id']; ?>" class="fas fa-times" onclick="return confirm('Xoá khỏi giỏ hàng?');"></a>
         <img src="admin/adimn-img/<?php echo $fetch_cart['prd_image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['prd_name']; ?></div>
         <div class="price"><?php echo $fetch_cart['prd_price']; ?> VNĐ</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['ord_id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['prd_quantity']; ?>">
            <input type="submit" name="update_cart" value="Cập nhật" class="option-btn">
         </form>
         <div class="sub-total"> Tổng cộng : <span><?php echo $sub_total = ($fetch_cart['prd_quantity'] * $fetch_cart['prd_price']); ?> VNĐ</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">Chưa có sản phẩm nào!</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart-notify.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Xoá tất cả khỏi giỏ hàng?');">Xoá tất cả</a>
   </div>

   <div class="cart-total">
      <p>Tổng cộng : <span><?php echo $grand_total; ?> VNĐ</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">Tiếp tục mua hàng</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Thanh toán</a>
      </div>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
