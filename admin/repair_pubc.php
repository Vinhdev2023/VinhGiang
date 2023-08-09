
<?php
include 'masteradmin/config.php';
if (isset($_GET["pubc_id"])) {
    $pubc_id = $_GET["pubc_id"];
    $mysql = "SELECT * FROM tbl_pubc WHERE pubc_id=$pubc_id";
    $query = mysqli_query($connect, $mysql);
    if (isset($_POST['sbm'])) {
        $pubc_name = $_POST["pubc_name"];
        $sql_update = "UPDATE tbl_pubc SET
            pubc_name = '$pubc_name'
            WHERE pubc_id = $pubc_id";
            mysqli_query($connect, $sql_update);

        header('location: pubc.php');
    } elseif (isset($_POST['nosbm'])) {
        header('location: pubc.php');
    }
}
?><?php
include 'masteradmin/mainpubc.php';
?>
<li class="active">/ <a href="pubc.php">nhà xuất bản</a></li>
<li class="active">/ Cập nhật nhà xuất bản</li>
</ol>
</div>
</div>
</div>
</div>
<table class="table table-success cotainer table-striped">
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
                ?>
        </tbody>
    </table>

    <form method="POST" class="container">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">tên</span>
            <input type="text" id="pubc_name" name="pubc_name" class="form-control" placeholder="Nick name" aria-label="Nick name" aria-describedby="basic-addon1" value="<?php echo $row["pubc_name"]; } ?>">
        </div>
        <label for="">Xác nhận: </label>
        <button type="submit" name="sbm" class="btn btn-danger">Cập nhật</button>
        <!-- <button type="submit" name="nosbm" class="btn btn-warning">Không</button> -->
        <a href="pubc.php" class="btn btn-warning">Trở về</a>
    </form>
<?php
include 'masteradmin/footer.php';
?>
