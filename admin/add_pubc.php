<?php
include 'masteradmin/config.php';
if (isset($_POST["sbm"])) {
    $pubc_name = $_POST["pubc_name"];
    if ($pubc_name == "") {
        $errors = '<div class="alert alert-danger text-center">Không có thông tin!</div>';
    } else {
        
        $checkcate_name = mysqli_num_rows(mysqli_query($connect, "
        SELECT pubc_name FROM tbl_pubc WHERE pubc_name='$pubc_name'
        "));
        if ($checkcate_name == 0) {
        $sql = "INSERT INTO tbl_pubc
            (pubc_name)
            VALUE
            ('$pubc_name')";
            $query = mysqli_query($connect, $sql);
            header('location: pubc.php');
        }else {
            $errors = '<div class="alert alert-danger text-center">Thông tin Bị Trùng !</div>';
        }
    }
    
    
}elseif (isset($_POST["reset"])) {
    header('location: pubc.php');
}
?>
<?php
include 'masteradmin/mainpubc.php';
?>
<li class="active">/ <a href="pubc.php">nhà xuất bản</a></li>
<li class="active">/ Thêm nhà xuất bản</li>
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
    <form action="" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">tên nhà xuất bản</span>
            <input id="pubc_name" name="pubc_name" type="text" class="form-control" placeholder="tên nhà xuất bản" aria-label="tên nhà xuất bản" aria-describedby="basic-addon1">
        </div>
        <button type="submit" class="btn btn-success" name="sbm">Thêm nhà xuất bản</button>
        <button type="submit" class="btn btn-warning" name="reset">Sửa lại</button>
        <a href="pubc.php" class="btn btn-light">Về trang cũ</a>
    </form>
</div>
<?php
include 'masteradmin/footer.php';
?>