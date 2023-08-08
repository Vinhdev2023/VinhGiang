<?php
include 'masteradmin/config.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 1;
}
$row_per_page = 10;
$total_row = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_order_detail"));
$total_page = ceil($total_row / $row_per_page);
$per_row = ($page * $row_per_page) - $row_per_page;

$quenry = mysqli_query($connect, "SELECT * FROM tbl_custommer WHERE NOT cus_message = ''");

?>
<?php
include 'masteradmin/maincus.php';
?>
<li class="active">/ Liên hệ khách hàng</li>
</ol>
</div>
</div>
</div>
</div>
<section class="content-body">
    <table class="table table-success table-hover">
        <thead>
            <tr>
                <th scope="col">Stt</th>
                <th scope="col">email</th>
                <th scope="col">số điện thoại</th>
                <th scope="col">lời nhắn</th>
                <th scope="col" colspan="2">Tùy chỉnh</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 1;
            while ($row = mysqli_fetch_array($quenry)) {
            ?>
                <tr>
                    <th scope="row">1</th>
                    <td><?php echo $row['cus_address'] ?></td>
                    <td><?php echo $row['cus_phone'] ?></td>
                    <td><?php echo $row['cus_message'] ?></td>
                    <td><a href="#" class="btn btn-warning" type="submit">Trả lời</a></td>
                    <td><a href="delete_comment.php?id=<?php echo $row['cus_id'] ?>" class="btn btn-danger" type="submit" onclick="return confirm('Xác nhận xóa')">Xóa liên hệ</a></td>
                </tr>
            <?php $stt++;
            } ?>
        </tbody>
    </table>
    <ul class="control-page">
    <?php $control_next_page = $page ?>
    <?php $control_back_page = $page ?>
        <li>
            <a href="custommer.php?page=<?php if ($control_back_page == 1) {
        $control_back_page = 1;
        echo $control_back_page;
    } else {
        $control_back_page--;
        echo $control_back_page;
    } ?>" class="btn btn-outline-danger">back</a>
        </li>
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
        <li><a href="custommer.php?page=<?php echo $page; ?>" class="btn btn-outline-danger"><?php echo $page; ?></a></li>
    <?php
    }
    ?>
        <li>
            <a href="custommer.php?page=<?php
    if ($control_next_page == 1) {
        echo $control_next_page;
    }
    elseif ($control_next_page > ($total_page-2)) {
        $control_next_page = $total_page;
        echo $control_next_page;
    } else {
        $control_next_page++;
        echo $control_next_page;
    }
     ?>" class="btn btn-outline-danger">next</a>
        </li>
    </ul>
</section>
<?php
include 'masteradmin/footer.php';
?>