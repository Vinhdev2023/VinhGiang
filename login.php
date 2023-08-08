<?php

include 'config.php';
session_start();


if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM tbl_custommer WHERE cus_address = '$email' AND cus_pass = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);
        $_SESSION['user_name'] = $row['cus_username'];
        $_SESSION['user_email'] = $row['cus_address'];
        $_SESSION['user_id'] = $row['cus_id'];
        header('location:index.php');
    } else {
        $message[] = 'Sai email hoặc password!';
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

    <title>Login</title>

    <!-- font awesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- custom css  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


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
    <div class="form-container">

        <form action="" method="post">
            <h3>Đăng Nhập</h3>
            <i class="fa-solid fa-user fa-lg" id="icon-people"></i>
            <input type="email" name="email" placeholder="Nhập email của bạn" required class="box">
            <input type="password" name="password" placeholder="Nhập mật khẩu của bạn" required class="box">
            <input type="submit" name="submit" value="Đăng Nhập" class="btn">
            <p>Chưa có tài khoản? <a href="register.php">Đăng Ký ngay bây giờ</a></p>
            <p>Quên mật khẩu? <a href="re_pass.php">Lấy lại ngay bây giờ</a></p>
        </form>


    </div>

</body>

</html>