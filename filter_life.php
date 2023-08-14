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
   <title>Life</title>
   <link rel="icon" href="admin/adimn-img/icon.png">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Thể loại</h3>
      <p> <a href="index.php">Trang chủ</a> / Cuộc sống </p>
   </div>


   <section class="products" style="padding-top: 0;">
   <h1 class="title" style="margin-top: 2rem;">Sách</h1>
      <div class="container" style="font-size: 20px;">
         <ul style="display: flex; gap: 55px; justify-content: center; margin: 10px 0px 15px 0px;">
            <li><a href="filter_manga.php"> Manga </a> </li> 
            <li><a href="filter_mystery.php"> Truyện trinh thám </a> </li>
            <li><a href="filter_romance.php"> Truyện tình cảm </a> </li>
            <li><a href="filter_life.php"> Truyện về cuộc sống </a> </li>
         </ul>
      </div>
      <div class="box-container">
         <?php      
            $select_products = mysqli_query($conn, "SELECT * FROM tbl_product WHERE cate_id = '4'") or die('query failed');
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
         
         ?>
         
      </div>
      <div class="load-more">
        <ul class="control-page">
            <li><a href="shop.php" class=" btn">Trở về</a></li>
        </ul>
      </div>

   </section>









   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>
