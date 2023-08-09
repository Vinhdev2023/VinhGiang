<?php
// session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $admin = '<div class="back-admin"><a href="admin/index.php">admin</a></div>';
}
if (isset($admin)) {
    echo $admin;
}
?>
<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>
<header class="header">

    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="https://www.google.com.vn/" class="fa-brands fa-google"></a>
                <a href="https://www.facebook.com/" class="fa-brands fa-facebook"></a>
                <a href="https://www.youtube.com/" class="fa-brands fa-youtube"></a>
            </div>
            <?php
            if (isset($login)) {
                echo $login;
            }
            ?>
        </div>
    </div>


    <div class="header-2">
        <div class="flex">
            <a href="index.php" class="logo">Books Store</a>

            <nav class="navbar">
                <a href="index.php">Trang Chủ</a>
                <a href="about.php">Về chúng tôi</a>
                <a href="shop.php">Cửa hàng</a>
                <a href="contact.php">Liên hệ</a>
                <a href="orders.php">Các đơn đặt</a>
            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="search_page.php" class="fas fa-search"></a>
                <div id="user-btn" class="fas fa-user"></div>


                <?php include 'cart/cart.php'; ?>
                <!-- cart -->
            </div>

            <?php if (isset($user_id)) { ?>

                <div class="user-box">
                    <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                    <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                    <p><a href="logout.php" class="delete-btn">Đăng xuất</a></p>
                    <p><a href="reset_pass.php" class="delete-btn">Đổi mật khẩu</a></p>
                </div>

            <?php } ?>

        </div>
    </div>

</header>