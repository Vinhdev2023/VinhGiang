<?php

include 'masteradmin/config.php';

$usernameold = $_GET["username"];
$sql = "SELECT * FROM tbl_user WHERE username='$usernameold'";
$row = mysqli_fetch_array(mysqli_query($connect, $sql));
if (isset($_POST["sbm"])) {
    $username = $_POST["username"];
    $user_pass = md5($_POST["user_pass"]);
    $user_re_pass = md5($_POST["user_re_pass"]);
    $fulname = $_POST["fulname"];
    $user_level = $_POST["user_level"];
    if ($user_level == 0) {
        $errors = '<div class="alert alert-danger text-center">Chưa chọn cấp độ quyền hạn !</div>';
    }
    elseif ($user_pass == '') {
        $errors = '<div class="alert alert-danger text-center">Chưa nhập mật Khẩu  mới !</div>';
    }
    elseif ($user_pass == $user_re_pass) {
        $sql_update = "UPDATE tbl_user SET
            username = '$username',
            user_pass = '$user_pass',
            fulname = '$fulname',
            user_level = $user_level
            WHERE username='$usernameold';";
        mysqli_query($connect, $sql_update);
        header('Location: user.php');
    } elseif ($user_re_pass == '') {
        $errors = '<div class="alert alert-danger text-center">Chưa xác Nhận Mật Khẩu !</div>';
    } else {
        $errors = '<div class="alert alert-danger text-center">Mật Khẩu Không Khớp !</div>';

    }
}elseif (isset($_POST["nosbm"])) {
    header('Location: user.php');
}?><?php
include 'masteradmin/mainmember.php';
?>
<li class="active">/ <a href="user.php">User</a></li>
<li class="active">/ repair user</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php
        if (isset($errors)) {
            echo $errors;
        }
        ?>

        <div class="container">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">stt</th>
                        <th scope="col">Mã Thành viên</th>
                        <th scope="col">Tên Thành Viên</th>
                        <th scope="col">tên đầy đủ</th>
                        <th scope="col">quyền</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>

                    <tr>
                        <th scope="row"><?php echo $stt; ?></th>
                        <td><?php echo $row["user_id"] ?></td>
                        <td><?php echo $row["username"] ?></td>
                        <td><?php echo $row["fulname"] ?></td>
                        <td><?php
                            if ($row["user_level"] == 1) {
                                echo '<p class="btn btn-danger">admin</p>';
                            }elseif ($row["user_level"] == 2) {
                                echo '<p class="btn btn-warning">Nhân viên</p>';
                            }
                            ?></td>


                    </tr>

                </tbody>
            </table>
            <form method="POST" class="container">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">tên</span>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Nick name" aria-label="Nick name" aria-describedby="basic-addon1" value="<?php echo $row["username"] ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Mật khẩu</span>
                    <input type="password" id="user_pass" name="user_pass" class="form-control" placeholder="new password" aria-label="new password" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nhập lại Mật khẩu</span>
                    <input type="password" id="user_re_pass" name="user_re_pass" class="form-control" placeholder="re password" aria-label="re password" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Tên đầy đủ (không bắt buộc)</span>
                    <input type="text" id="fulname" name="fulname" class="form-control" placeholder="Full name" aria-label="Full name" aria-describedby="basic-addon1" value="<?php echo $row["fulname"] ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Quyền</span>
                    <select class="form-select" id="user_level" name="user_level" aria-label="Default select example">
                        <option value="1" <?php if ($row["user_level"] == 1) {echo 'selected';} ?>>Admin</option>
                        <option value="2" <?php if ($row["user_level"] == 2) {echo 'selected';} ?>>Nhân viên</option>
                        <!-- <option value="3"></option> -->
                    </select>

                </div>

                <label for="">Xác nhận: </label>
                <button type="submit" name="sbm" class="btn btn-danger">Cập nhật</button>
                <!-- <button type="submit" name="nosbm" class="btn btn-warning">Không</button> -->
                <a href="user.php" class="btn btn-warning">Trở về</a>
            </form>
        </div>
    </div>

<?php
include 'masteradmin/footer.php';
?>
