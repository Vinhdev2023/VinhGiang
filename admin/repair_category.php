<?php
include 'masteradmin/config.php';
if (isset($_GET["cate_id"])) {
    $cate_idold = $_GET["cate_id"];
    $mysql = "SELECT * FROM tbl_category WHERE cate_id=$cate_idold";
    $query = mysqli_query($connect, $mysql);
    if (isset($_POST['sbm'])) {
        $cate_name = $_POST["cate_name"];
        $sql_update = "UPDATE tbl_category SET
            cate_name = '$cate_name'
            WHERE cate_id = $cate_idold ";
            mysqli_query($connect, $sql_update);

        header('location: category.php');
    } elseif (isset($_POST['nosbm'])) {
        header('location: category.php');
    }
?><?php
    include 'masteradmin/maincategory.php';
    ?>
<li class="active">/ <a href="category.php">Danh Mục</a></li>
<li class="active">/ Cập nhật Danh Mục</li>
</ol>
</div>
</div>
</div>
</div>
<div class="cotainer">
    <table class="table table-success cotainer table-striped">
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
                ?>
        </tbody>
    </table>

    <form method="POST" class="container">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">tên</span>
            <input type="text" id="cate_name" name="cate_name" class="form-control" placeholder="Nick name" aria-label="Nick name" aria-describedby="basic-addon1" value="<?php echo $row["cate_name"]; }} ?>">
        </div>
        <label for="">Xác nhận: </label>
        <button type="submit" name="sbm" class="btn btn-danger">Cập nhật</button>
        <!-- <button type="submit" name="nosbm" class="btn btn-warning">Không</button> -->
        <a href="category.php" class="btn btn-warning">Trở về</a>
    </form>

</div>
<?php
include 'masteradmin/footer.php';
?>
