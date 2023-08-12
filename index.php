<?php
session_start();

include 'config.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}


if (!isset($user_id)) {
    $login = '<p><a href="login.php">Đăng Nhập</a> | <a href="register.php">Đăng ký</a></p>';
}

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['user_id'])) {

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_orders` WHERE customer_id = '$user_id'") or die('query failed');

        mysqli_query($conn, "INSERT INTO `tbl_orders`(customer_id, staff_id, prd_name, prd_price, prd_quantity, prd_image, cart_satus) VALUES('$user_id', '2', '$product_name', '$product_price', '$product_quantity', '$product_image', 'ordering')") or die('query failed');
        $message[] = 'Sản phẩm được thêm vào giỏ!';
    } else {
        header('location: login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Book shop</title>
</head>

<body>



    <?php include 'header.php'; ?>
    <section class="home">

        <div class="content">
            <h3>Bạn cô đơn ư? Đừng lo lắng. Mọi cuốn sách đều sẵn sàng kết thân với bạn!</h3>
            <a href="about.php" class="white-btn">Khám Phá Thêm</a>
        </div>

    </section>

    <section class="products">

        <h1 class="title">Sản Phẩm</h1>

        <div class="box-container">
            <?php include 'product/product-home.php'; ?>

        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center">

            <a href="shop.php" class="option-btn">Thêm</a>
        </div>

    </section>

    <section class="home-contact">

      <div class="content">
         <h3>Có bất kỳ câu hỏi nào?</h3>
         <p>Đừng ngại ngần mà đặt câu hỏi cho chúng tôi!</p>
         <a href="contact.php" class="white-btn">Liên Hệ</a>
      </div>

   </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>
