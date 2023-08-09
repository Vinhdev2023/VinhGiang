<?php
include 'masteradmin/config.php';
if (isset($_GET["prd_id"])) {
    $oldprd_id = $_GET["prd_id"];
    $sql = "SELECT prd_id,`prd_name`,prd_price,prd_quantity,prd_image,
    tbl_product.cate_id,(SELECT `cate_name` 
FROM tbl_category 
WHERE tbl_category.cate_id = tbl_product.cate_id) AS cate_name
FROM tbl_product WHERE prd_id = $oldprd_id;";
    $query = mysqli_query($connect, $sql);
    if (isset($_POST["sbm"])) {
        $sql_delete = "DELETE FROM tbl_product WHERE prd_id = $oldprd_id";
        mysqli_query($connect, $sql_delete);
        header('location: product.php');
    } elseif (isset($_POST["nosbm"])) {
        header('location: product.php');
    }
}
?>
<?php
include 'masteradmin/mainproduct.php';
?>
<li class="active">/ <a href="product.php">Sản Phẩm</a></li>
<li class="active">/ gỡ bỏ sản phẩm</li>
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
                    <th scope="col">Thuộc Danh mục</th>
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
                        <td><img src="adimn-img/<?php echo $row["prd_image"]; ?>" alt="" width="100px"></td>
                        <td><?php echo $row["cate_name"]; ?></td>
                    </tr>
                    <?php $stt++;
                }
                    ?>
            </tbody>
        </table>
        <form action="" method="post">
        <label for="">Xác nhận: </label>
                <button type="submit" name="sbm" class="btn btn-danger">Xoá</button>
                <!-- <button type="submit" name="nosbm" class="btn btn-warning">Không</button> -->
                <a href="product.php" class="btn btn-warning">Trở về</a>
        </form>
    </div>
<?php
include 'masteradmin/footer.php';
?>
