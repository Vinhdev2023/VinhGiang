<?php
include 'masteradmin/config.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 1;
}
$row_per_page = 15;
$total_row = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_pubc"));
$total_page = ceil($total_row / $row_per_page);
$per_row = ($page * $row_per_page) - $row_per_page;
$sql = "SELECT * FROM tbl_pubc LIMIT $per_row,$row_per_page;";
$query = mysqli_query($connect, $sql);
?>
<?php
include 'masteradmin/mainpubc.php';
?>
<li class="active">/ Danh sách nhà xuất bản</li>
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
                <th scope="col">Tên nhà xuất bản</th>
                <th scope="col" colspan="2">Tùy chỉnh</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <th scope="row"><?php echo $stt; ?></th>
                    <td><?php echo $row["pubc_name"]; ?></td>

                    <td><a href="repair_pubc.php?pubc_id=<?php echo $row["pubc_id"]; ?>" class="btn btn-warning" type="submit" name="repair">Sửa</a></td>
                    <td><a href="delete_pubc.php?pubc_id=<?php echo $row["pubc_id"]; ?>" class="btn btn-danger" type="submit" name="delete">Xóa</a></td>
                </tr>
            <?php $stt++;
            } ?>
        </tbody>

    </table>
<a href="add_pubc.php" class="btn btn-success">Thêm tên nhà xuất bản mới</a>
<ul class="control-page">
<?php $control_next_page = $page ?>
<?php $control_back_page = $page ?>
    <li><a href="pubc.php?page=<?php if ($control_back_page == 1) {
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
    <li><a href="pubc.php?page=<?php echo $page; ?>" class="btn btn-outline-danger"><?php echo $page; ?></a></li>
    <?php
    }
    ?>
    <li><a href="pubc.php?page=<?php if ($control_next_page > ($total_page-2)) {
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