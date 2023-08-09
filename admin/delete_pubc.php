<?php
include 'masteradmin/config.php';
if (isset($_GET["pubc_id"])) {
    $pubc_id = $_GET["pubc_id"];
    $mysql = "SELECT * FROM tbl_pubc WHERE pubc_id=$pubc_id";
    $query = mysqli_query($connect, $mysql);
    if (isset($_POST["sbm"])) {
        $sql_update = "DELETE FROM tbl_pubc WHERE pubc_id = $pubc_id";
        mysqli_query($connect, $sql_update);
        header('location: pubc.php');
    } elseif (isset($_POST['nosbm'])) {
        header('location: pubc.php');
    }
}
?>
<?php
include 'masteradmin/mainpubc.php';
?>
<li class="active">/ <a href="pubc.php">nhà xuất bản</a></li>
<li class="active">/ Xóa nhà xuất bản</li>
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
                <th scope="col">Tên Danh mục</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $stt = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <th scope="row"><?php echo $stt; ?></th>
                    <td><?php echo $row["pubc_name"]; ?></td>
                </tr>
            <?php $stt++;
            } ?>
        </tbody>
    </table>
    <form action="" method="post">
        <label for="" style="font-size: 30px;">Xác nhận: </label>
        <button type="submit" name="sbm" class="btn btn-danger">Xoá</button>
        <!-- <button type="submit" name="nosbm" class="btn btn-warning">Không</button> -->
        <a href="pubc.php" class="btn btn-warning">Trở về</a>
    </form>
</div>
<?php
include 'masteradmin/footer.php';
?>
