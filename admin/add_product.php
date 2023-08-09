<?php
include 'masteradmin/config.php';
$sql_cate = "SELECT * FROM tbl_category ORDER BY cate_id ASC";
$query_cate = mysqli_query($connect, $sql_cate);
$sql_pubc = "SELECT * FROM tbl_pubc ORDER BY pubc_id ASC";
$query_pubc = mysqli_query($connect, $sql_pubc);
if (isset($_POST["sbm"])) {
    $prd_name = $_POST['prd_name'];
    $prd_price = $_POST['prd_price'];
    $prd_quantity = $_POST['prd_quantity'];
    $cate_id = $_POST['cate_id'];
    $prd_description = $_POST['prd_description'];
    $pubc_id = $_POST['pubc_id'];
    $prd_image = $_FILES['prd_image']['name'];
    $tmp_image = $_FILES['prd_image']['tmp_name'];
    $checkprdname = mysqli_num_rows(mysqli_query($connect,"
    SELECT prd_name FROM tbl_product WHERE prd_name='$prd_name'
    "));
    if ($prd_name =="" || $prd_price =="" || $prd_quantity =="" || $cate_id =="" || $pubc_id =="" || $prd_image =="") {
        $errors = '<div class="alert alert-danger text-center">Thiếu thông tin hoặc không có thông tin!</div>';
    } else {
        if ($checkprdname == 0) {
            $sql_insert = "INSERT INTO tbl_product
            (prd_name, prd_price, prd_quantity, prd_image, cate_id, prd_description, pubc_id)
            VALUE
            ('$prd_name', $prd_price, $prd_quantity, '$prd_image', $cate_id, '$prd_description', $pubc_id)";
            mysqli_query($connect, $sql_insert);
            move_uploaded_file($tmp_image, 'adimn-img/'.$prd_image);
            header('location: product.php');
        } else {
            $errors = '<div class="alert alert-danger text-center">Tên hoặc Mã Sản Phẩm Bị Trùng !</div>';
    
        }
    }
    
    
    
} elseif (isset($_POST["nosbm"])) {
    header('location: product.php');
}
?>
<?php
include 'masteradmin/mainproduct.php';
?>
<li class="active">/ <a href="product.php">Sản Phẩm</a></li>
<li class="active">/ thêm sản phẩm mới</li>
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
<div class="cotainer">
    <form action="" method="post" class="container" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Tên Sản Phẩm</span>
            <input type="text" id="prd_name" name="prd_name" class="form-control" placeholder="Full name" aria-label="Full name" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Giá</span>
            <input type="number" id="prd_price" name="prd_price" class="form-control" placeholder="price" aria-label="price" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Số lượng</span>
            <input type="number" id="prd_quantity" name="prd_quantity" min="1" class="form-control" placeholder="num" aria-label="num" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text btn btn-danger" id="basic-addon1">chọn ảnh</span>
            <input type="file" id="prd_image" name="prd_image" class="form-control" placeholder="num" aria-label="num" aria-describedby="basic-addon1" accept="image/*">
            <!-- <img src="adimn-img/..." alt="chọn một ảnh"> -->
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">mô tả sản phẩm</span>
            <textarea type="text" id="prd_description" name="prd_description" class="form-control" placeholder="num" aria-label="num" aria-describedby="basic-addon1"></textarea>
            
<script>
CKEDITOR.replace('prd_description');
</script>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">loại</span>
            <select class="form-select" id="cate_id" name="cate_id" aria-label="Default select example">
                <option value="" selected>chọn thể loại</option>
                <?php while ($rowcate = mysqli_fetch_array($query_cate)) {
                ?>
                    <option value="<?php echo $rowcate["cate_id"]; ?>"><?php echo $rowcate["cate_name"]; ?></option>
                <?php
                } ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">nhà xuất bản</span>
            <select class="form-select" id="pubc_id" name="pubc_id" aria-label="Default select example">
                <option value="" selected>chọn nhà xuất bản</option>
                <?php while ($rowpubc = mysqli_fetch_array($query_pubc)) {
                ?>
                    <option value="<?php echo $rowpubc["pubc_id"]; ?>"><?php echo $rowpubc["pubc_name"]; ?></option>
                <?php
                } ?>
            </select>
        </div>
        <label for="">Xác nhận: </label>
        <button type="submit" name="sbm" class="btn btn-danger">Thêm</button>
        <!-- <button type="submit" name="nosbm" class="btn btn-warning">Trở về</button> -->
        <a href="product.php" class="btn btn-warning">Trở về</a>
    </form>
</div>
<?php
include 'masteradmin/footer.php';
?>
