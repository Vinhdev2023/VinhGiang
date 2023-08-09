<?php
include 'masteradmin/config.php';
if (isset($_POST["sbm"])) {

    $cate_name = $_POST["cate_name"];
    if ($cate_name == "") {
        $errors = '<div class="alert alert-danger text-center">Không có thông tin!</div>';
    } else {
        $checkcate_name = mysqli_num_rows(mysqli_query($connect, "
        SELECT cate_name FROM tbl_category WHERE cate_name='$cate_name'
        "));
        if ($checkcate_name == 0) {
            $sql = "INSERT INTO tbl_category
            (cate_name)
            VALUE
            ('$cate_name')";
            $query = mysqli_query($connect, $sql);
            header('location: category.php');
        } else {
            $errors = '<div class="alert alert-danger text-center">Thông tin Bị Trùng !</div>';
        }
    }
} elseif (isset($_POST["reset"])) {
    header('location: category.php');
}
?>
<?php
include 'masteradmin/maincategory.php';
?>
<li class="active">/ <a href="category.php">Danh Mục</a></li>
<li class="active">/ Thêm Danh Mục</li>
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
            <span class="input-group-text" id="basic-addon1">tên danh mục</span>
            <input id="cate_name" name="cate_name" type="text" class="form-control" placeholder="tên danh mục" aria-label="tên danh mục" aria-describedby="basic-addon1">
        </div>
        <button type="submit" class="btn btn-success" name="sbm">Thêm danh mục</button>
        <!-- <button type="submit" class="btn btn-warning" name="reset">Sửa lại</button> -->
        <a href="category.php" class="btn btn-warning">Trở về</a>
    </form>
</div>
<?php
include 'masteradmin/footer.php';
?>
