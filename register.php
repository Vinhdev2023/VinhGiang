<?php

include 'config.php';


if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    // $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM tbl_custommer WHERE cus_address = '$email' AND cus_pass = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'Người dùng đã tồn tại!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'MẬT KHẨU NHẬP LẠI KHÔNG ĐÚNG!';
        } else {
            mysqli_query($conn, "INSERT INTO tbl_custommer(cus_username, cus_address, cus_pass) VALUES('$name', '$email', '$cpass')")
                or die('query failed');
            $message[] = 'ĐĂNG KÝ THÀNH CÔNG!';
            header('location:login.php');
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
   <link rel="icon" href="img/icon.png">

    <title>Register</title>

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
            <h3>Đăng Ký</h3>
            <i class="fa-solid fa-user fa-lg" id="icon-people"></i>
            <input type="text" name="name" placeholder="Nhập tên của bạn" required class="box">
            <input type="email" name="email" placeholder="Nhập email của bạn" required class="box">
            <input type="password" name="password" placeholder="Nhập mật khẩu của bạn" required class="box">
            <input type="password" name="cpassword" placeholder="Xác nhận mật khẩu của bạn" required class="box">
            <!-- <select name="user_type" class="box">
                <option value="user">Người dùng</option>
                <option value="admin">Admin</option> 
            </select> -->
            <input type="submit" name="submit" value="Đăng ký ngay bây giờ" class="btn">
            <p>Đã có sẵn tài khoản? <a href="login.php">Đăng nhập ngay bây giờ</a></p>
        </form>

    </div>

</body>

</html>