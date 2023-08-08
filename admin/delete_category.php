<?php
include 'masteradmin/config.php';
if (isset($_GET["cate_id"])) {
    $cate_id = $_GET["cate_id"];
    $mysql = "SELECT * FROM tbl_category WHERE cate_id=$cate_id";
    $query = mysqli_query($connect, $mysql);
    if (isset($_POST["sbm"])) {
        $sql_update = "DELETE FROM tbl_category WHERE cate_id = $cate_id";
        mysqli_query($connect, $sql_update);
        header('location: category.php');
    } elseif (isset($_POST['nosbm'])) {
        header('location: category.php');
    }
?>
<?php
include 'masteradmin/maincategory.php';
?>
<li class="active">/ <a href="category.php">Danh Mục</a></li>
<li class="active">/Xóa Danh Mục</li>
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
                <th scope="col">Mã Danh mục</th>
                <th scope="col">Tên Danh mục</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $stt = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <th scope="row"><?php echo $stt; ?></th>
                    <td><?php echo $row["cate_id"]; ?></td>
                    <td><?php echo $row["cate_name"]; ?></td>
                </tr>
            <?php $stt++;
            }} ?>
        </tbody>
    </table>
    <form action="" method="post">
        <label for="" style="font-size: 30px;">Có xóa Không: </label>
        <button type="submit" name="sbm" class="btn btn-danger">Có</button>
        <button type="submit" name="nosbm" class="btn btn-warning">Không</button>
        <a href="category.php" class="btn btn-light">Về trang cũ</a>
    </form>
</div>
<?php
include 'masteradmin/footer.php';
?>