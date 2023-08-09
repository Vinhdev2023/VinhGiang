<?php

include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}else {
    $user_id = $_SESSION['user_id'];
}

if (isset($_POST['submit'])) {
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $re_pass = mysqli_real_escape_string($conn, md5($_POST['re_pass']));
    $old_pass = mysqli_real_escape_string($conn, md5($_POST['old_pass']));

    $select_users = mysqli_query($conn, "SELECT * FROM tbl_custommer WHERE cus_id = '$user_id' AND cus_pass = '$old_pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0 && $new_pass == $re_pass) {

        mysqli_query($conn, "UPDATE tbl_custommer SET cus_pass = '$new_pass' WHERE cus_id = '$user_id'") or die('query failed');
        // $row = mysqli_fetch_assoc($select_users);
        // $_SESSION['user_name'] = $row['cus_username'];
        // $_SESSION['user_email'] = $row['cus_address'];
        // $_SESSION['user_id'] = $row['cus_id'];
        // header('location:login.php');
        $message[] = 'Đổi mật khẩu thành công!';
    } else {
        $message[] = 'Mật khẩu cũ không chính xác hoặc mật khẩu mới không trùng khớp!';
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
            <h3>Đổi mật khẩu</h3>
            <i class="fa-solid fa-user fa-lg" id="icon-people"></i>\
            <input type="password" name="old_pass" placeholder="Nhập mật khẩu cũ của bạn" required class="box">
            <input type="password" name="new_pass" minlength="8" placeholder="Nhập mật khẩu mới của bạn" required class="box">
            <input type="password" name="re_pass" placeholder="Nhập lại mật khẩu mới của bạn" required class="box">
            <input type="submit" name="submit" value="Đổi mật khẩu" class="btn">
            <p>Đổi mật khẩu thành công! <a href="index.php">trở lại</a></p>
        </form>


    </div>

</body>

</html>
