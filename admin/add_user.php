<?php

include 'masteradmin/config.php';
?>

<?php
// $sql = "SELECT * FROM product";

if (isset($_POST["sbm"]) && isset($_POST["username"]) && isset($_POST["user_pass"]) && isset($_POST["user_level"])) {
    $username = $_POST["username"];
    $user_pass = md5($_POST["user_pass"]);
    $user_re_pass = md5($_POST["user_re_pass"]);
    $fulname = $_POST["fulname"];
    $user_level = $_POST["user_level"];
    if ($user_level == 0) {
        $errors = '<div class="alert alert-danger text-center">Quyền Tài Khoản chưa chọn !</div>';
    } elseif ($user_pass == $user_re_pass) {
        $checkUsername = mysqli_num_rows(mysqli_query($connect, "
        SELECT username FROM tbl_user WHERE username='$username'
        "));
        $checkIDuser = mysqli_num_rows(mysqli_query($connect, "
        SELECT user_id FROM tbl_user WHERE user_id=$user_id
        "));
        if ($checkUsername == 0 && $checkIDuser == 0) {
            $sql = "INSERT INTO tbl_user
            (username, user_pass, fulname, user_level)
            VALUE
            ('$username', '$user_pass', '$fulname', $user_level)";
            $query = mysqli_query($connect, $sql);
            header('location: user.php');
        } else {
            $errors = '<div class="alert alert-danger text-center">Tên hoặc Mã Tài Khoản Bị Trùng !</div>';
        }
    } else {
        $errors = '<div class="alert alert-danger text-center">Mật Khẩu Không Khớp !</div>';
    }
}
include 'masteradmin/mainmember.php';
?>
<li class="active">/ <a href="user.php">User</a></li>
<li class="active">/ Add user</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($errors)) {
        echo $errors;
    }
    ?>
    <form method="POST" class="container">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">tên</span>
            <input type="text" id="username" name="username" class="form-control" placeholder="Nick name" aria-label="Nick name" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Mật khẩu</span>
            <input type="password" id="user_pass" name="user_pass" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nhập lại Mật khẩu</span>
            <input type="password" id="user_re_pass" name="user_re_pass" class="form-control" placeholder="re password" aria-label="re password" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Tên đầy đủ (không bắt buộc)</span>
            <input type="text" id="fulname" name="fulname" class="form-control" placeholder="Full name" aria-label="Full name" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Quyền</span>
            <select class="form-select" id="user_level" name="user_level" aria-label="Default select example">
                <option value="0" selected>Cấp Độ Quyền Hạn</option>
                <option value="1">Admin</option>
                <option value="2">Nhân Viên</option>
                <!-- <option value="3"></option> -->
            </select>
        </div>






        <button type="submit" class="btn btn-success" name="sbm">Thêm thành viên</button>
        <a href="user.php" class="btn btn-light">Về trang trước</a>
    </form>



<?php
include_once('masteradmin/footer.php');
?>
