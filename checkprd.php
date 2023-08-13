<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
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
      <h3>Chi tiết</h3>
      <p> <a href="index.php">Trang chủ</a> / Chi tiết </p>
   </div>

   <section class="search-form">
      <form action="" method="post">
         <!-- <input type="text" name="search" placeholder="Tìm sách..." class="box">
         <input type="submit" name="submit" value="Tìm" class="btn"> -->
      </form>
   </section>

   <section class="products" style="padding-top: 0;">

      <div class="box-container">
         <?php
         if (isset($_GET['prd_id'])) {
            $search_item = $_GET['prd_id'];
            $select_products = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE prd_id = '$search_item'") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_product = mysqli_fetch_assoc($select_products)) {
         ?>
                  <form action="" method="post" class="box">
                    <img src="admin/adimn-img/<?php echo $fetch_product['prd_image']; ?>" alt="" class="image">
                    <div class="name"><?php echo $fetch_product['prd_name']; ?></div>
                    <div class="name"><?php echo $fetch_product['prd_description']; ?></div>
                    <div class="price"><?php echo $fetch_product['prd_price']; ?> VNĐ</div>
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
      <div class="load-more">
        <ul class="control-page">
            <li><a href="orders.php" class=" btn">Trở về</a></li>
        </ul>
      </div>

   </section>









   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>
