<?php
include 'masteradmin/config.php';
$sql_cate = "SELECT * FROM tbl_category ORDER BY cate_id ASC";
$query_cate = mysqli_query($connect, $sql_cate);
$sql_pubc = "SELECT * FROM tbl_pubc ORDER BY pubc_id ASC";
$query_pubc = mysqli_query($connect, $sql_pubc);
if (isset($_GET["prd_id"])) {
    $oldprd_id = $_GET["prd_id"];
    $sql = "SELECT prd_id,`prd_name`,prd_price,prd_quantity,prd_image,
    tbl_product.cate_id,(SELECT `cate_name` 
    FROM tbl_category 
    WHERE tbl_category.cate_id = tbl_product.cate_id) AS cate_name, prd_description,(SELECT `pubc_name`
    FROM tbl_pubc
    WHERE tbl_pubc.pubc_id = tbl_product.pubc_id) AS pubc_name, pubc_id
    FROM tbl_product WHERE prd_id = $oldprd_id;";
    $query = mysqli_query($connect, $sql);
    
    if (isset($_POST['sbm'])) {
        $prd_name = $_POST['prd_name'];
        $prd_price = $_POST['prd_price'];
        $prd_quantity = $_POST['prd_quantity'];
        $cate_id = $_POST['cate_id'];
        $prd_description = $_POST['prd_description'];
        $pubc_id = $_POST['pubc_id'];
        $prd_image = $_FILES['prd_image']['name'];
        $tmp_image = $_FILES['prd_image']['tmp_name'];
        if ($prd_image == '') {
            $rowimg = mysqli_fetch_array($query);
            $prd_image = $rowimg["prd_image"];
        }
        $sql_update = "UPDATE tbl_product SET
            prd_name = '$prd_name',
            prd_price = $prd_price,
            prd_quantity = $prd_quantity,
            prd_image = '$prd_image',
            cate_id = $cate_id,
            prd_description = '$prd_description',
            pubc_id = $pubc_id
            WHERE prd_id = $oldprd_id";
        mysqli_query($connect, $sql_update);
        move_uploaded_file($tmp_image, 'adimn-img/' . $prd_image);

        header('location: product.php');
    } elseif (isset($_POST['nosbm'])) {
        header('location: product.php');
    }
?>
    <?php
    include 'masteradmin/mainproduct.php';
    ?>
    <li class="active">/ <a href="product.php">Sản Phẩm</a></li>
    <li class="active">/ Cập nhật thông tin sản phẩm</li>
    </ol>
    </div>
    </div>
    </div>
    </div>
    <div class="container">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">stt</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Thuộc Loại</th>
                    <th scope="col">nhà xuất bản</th>
                    <th scope="col">Mô tả</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <th scope="row"><?php echo $stt; ?></th>
                        <td><?php echo $row["prd_name"]; ?></td>
                        <td><?php echo $row["prd_price"]; ?> VND</td>
                        <td><?php echo $row["prd_quantity"]; ?></td>
                        <td><img src="adimn-img/<?php echo $row["prd_image"]; ?>" alt="mất ảnh rồi" width="100px"></td>
                        <td><?php echo $row["cate_name"]; ?></td>
                        <td><?php echo $row["pubc_name"] ?></td>
                        <td><?php echo $row["prd_description"]; ?></td>
                    </tr>
                    <?php $stt++;
                    ?>
            </tbody>
        </table>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Tên Sản Phẩm</span>
                            <input type="text" id="prd_name" name="prd_name" class="form-control" placeholder="Full name" aria-label="Full name" aria-describedby="basic-addon1" value="<?php echo $row["prd_name"]; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Giá</span>
                            <input type="number" id="prd_price" name="prd_price" class="form-control" placeholder="price" aria-label="price" aria-describedby="basic-addon1" value="<?php echo $row["prd_price"]; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Số lượng</span>
                            <input type="number" id="prd_quantity" name="prd_quantity" class="form-control" placeholder="number" aria-label="number" aria-describedby="basic-addon1" value="<?php echo $row["prd_quantity"]; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">mô tả sản phẩm</span>
                            <textarea type="text" id="prd_description" name="prd_description" class="form-control" placeholder="num" aria-label="num" aria-describedby="basic-addon1" rows="4"><?php echo $row["prd_description"]; ?></textarea>

                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text btn btn-danger" id="basic-addon1">chọn ảnh</span>
                            <input type="file" id="prd_image" name="prd_image" class="form-control" placeholder="num" aria-label="num" aria-describedby="basic-addon1" accept="image/*">
                            <img src="adimn-img/<?php echo $row["prd_image"]; ?>" alt="mất ảnh rồi" width="150px">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">loại</span>
                            <select class="form-select" id="cate_id" name="cate_id" aria-label="Default select example">
                                <?php while ($rowcate = mysqli_fetch_array($query_cate)) {
                                ?>
                                    <option value="<?php echo $rowcate["cate_id"]; ?>" <?php if ($row["cate_id"] ==  $rowcate["cate_id"]) {
                                        echo 'selected';
                                    } ?>><?php echo $rowcate["cate_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">nhà xuất bản</span>
                                <select class="form-select" id="pubc_id" name="pubc_id" aria-label="Default select example"><?php while ($rowpubc = mysqli_fetch_array($query_pubc)) { ?>
                                    <option value="<?php echo $rowpubc["pubc_id"]; ?>" <?php  if ($row["pubc_id"] ==  $rowpubc["pubc_id"]) {
                                     echo 'selected';
                                    } ?>><?php echo $rowpubc["pubc_name"]; ?></option>
                                <?php } ?>
                                </select>
                        </div>
                        
                        <?php }} ?>
                    </div>
                </div>
            </div>



            <label for="">Có cập nhật không</label>
            <button type="submit" name="sbm" class="btn btn-danger">Có</button>
            <button type="submit" name="nosbm" class="btn btn-warning">Không</button>
            <a href="product.php" class="btn btn-light">Về trang cũ</a>
        </form>
        <!-- <a href="add_product.php" class="btn btn-success">Thêm sản phẩm mới</a> -->
    </div>
    <script>
        CKEDITOR.replace('prd_description');
    </script>
    <?php
    include 'masteradmin/footer.php';
    ?>