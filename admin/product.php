<?php
include 'masteradmin/config.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 1;
}
$row_per_page = 3;
$total_row = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_product"));
$total_page = ceil($total_row / $row_per_page);
$per_row = ($page * $row_per_page) - $row_per_page;
$sql = "SELECT prd_id,`prd_name`,prd_price,prd_quantity,prd_image,(SELECT `cate_name` 
FROM tbl_category 
WHERE tbl_category.cate_id = tbl_product.cate_id) AS cate_name, prd_description,(SELECT `pubc_name`
FROM tbl_pubc
WHERE tbl_pubc.pubc_id = tbl_product.pubc_id) AS pubc_name
FROM tbl_product ORDER BY prd_id DESC LIMIT $per_row,$row_per_page;";
$query = mysqli_query($connect, $sql);
?>
<?php
include 'masteradmin/mainproduct.php';
?>
<li class="active">/ Sản Phẩm</li>
</ol>
</div>
</div>
</div>
</div>
<div class="container">
    <table class="table table-success table-hover">
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
                <th scope="col" colspan="2">Tùy chỉnh</th>
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
                    <td><img src="adimn-img/<?php echo $row["prd_image"]; ?>" alt="ảnh mất rồi" width="100px"></td>
                    <td><?php echo $row["cate_name"]; ?></td>
                    <td><?php  echo $row["pubc_name"]; ?></td>
                    <td><?php echo $row["prd_description"]; ?></td>
                    <td><a href="repair_product.php?prd_id=<?php echo $row["prd_id"]; ?>" class="btn btn-warning" type="submit" name="repair">Sửa</a></td>
                    <td><a href="delete_product.php?prd_id=<?php echo $row["prd_id"]; ?>" class="btn btn-danger" type="submit" name="delete">Xóa</a></td>
                </tr>
            <?php $stt++;
            } ?>
        </tbody>

    </table>
<a href="add_product.php" class="btn btn-success">Thêm sản phẩm mới</a>
<ul class="control-page">
<?php $control_next_page = $page ?>
<?php $control_back_page = $page ?>
    <li><a href="product.php?page=<?php if ($control_back_page == 1) {
        $control_back_page = 1;
    } else {
        $control_back_page--;
    }
     echo $control_back_page; ?>" class="btn btn-outline-danger">back</a></li>
    <?php
    if ($page < ($total_page-1)) {
        $show_page = $page+1;
        if ($page != 1) {
            $page = $page-1;
        } else {
            $show_page++;
        }
    }elseif ($page == ($total_page-1)) {
        $show_page = $page+1;
        $page = $page-1;

    }
    else {
        $show_page = $total_page;
        $page = $page-2;
    }
    if ($page <= 0) {
        $page = 1;
    }
    for (; $page <= $show_page; $page++) {
    ?>
    <li><a href="product.php?page=<?php echo $page; ?>" class="btn btn-outline-danger"><?php echo $page; ?></a></li>
    <?php
    }
    ?>
    <li><a href="product.php?page=<?php if ($control_next_page > ($total_page-2)) {
        $control_next_page = $total_page;
    } else {
        $control_next_page++;
    }
     echo $control_next_page; ?>" class="btn btn-outline-danger">next</a></li>
</ul>
</div>
<?php
include 'masteradmin/footer.php';
?>