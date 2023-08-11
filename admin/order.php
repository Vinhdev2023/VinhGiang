<?php
include 'masteradmin/config.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 1;
}
$row_per_page = 10;
$total_row = mysqli_num_rows(mysqli_query($connect,"SELECT DISTINCT placed_on FROM tbl_order_detail"));
$total_page = ceil($total_row / $row_per_page);
$per_row = ($page * $row_per_page) - $row_per_page;
$query = mysqli_query($connect, "SELECT DISTINCT cus_id, cus_name, cus_number, cus_email, placed_on,payment_status FROM tbl_order_detail LIMIT $per_row,$row_per_page");
include 'masteradmin/mainorder.php';
?>
<li class="active">/ Đơn đang chờ</li>
</ol>
</div>
</div>
</div>
</div>
<section class="content-body">
    <table class="table table-success table-hover">
        <thead>
            <tr>
                <th scope="col">stt</th>
                <th scope="col">Họ và Tên</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">email</th>
                <!-- <th scope="col">Phương thức thanh toán</th> -->
                <!-- <th scope="col">địa chỉ</th> -->
                <!-- <th scope="col">sản phẩm đặt mua</th> -->
                <!-- <th scope="col">Tổng</th> -->
                <th scope="col">Đặt vào</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" colspan="2">Tùy chỉnh</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $stt = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <th scope="row"><?php echo $stt; ?></th>
                    <td><?php echo $row["cus_name"]; ?></td>
                    <td><?php echo $row["cus_number"]; ?></td>
                    <td><?php echo $row["cus_email"]; ?></td>
                    <!-- <td><?php echo $row["cus_method"]; ?></td> -->
                    <!-- <td><?php echo $row["cus_address"]; ?></td> -->
                    <!-- <td><?php echo $row["total_products"]; ?></td> -->
                    <!-- <td><?php  echo $row["total_price"]; ?> VNĐ</td> -->
                    <td><?php echo $row["placed_on"]; ?></td>
                    <td><?php
                    if ($row["payment_status"] == 'đang chờ xác nhận') {
                        echo '<span class="btn btn-danger">' . $row["payment_status"] . '</span>';
                    } elseif ($row["payment_status"] == 'đã xác nhận') {
                        echo '<span class="btn btn-warning">' . $row["payment_status"] . '</span>';
                    } elseif ($row["payment_status"] == 'thành công') {
                        echo '<span class="btn btn-success">' . $row["payment_status"] . '</span>';
                    } else {
                        echo '<span class="btn btn-danger">' . $row["payment_status"] . '</span>';
                    }
                    ?></td>
                    <td><a href="complete_order.php?time=<?php echo $row["placed_on"]; ?>&cus_id=<?php echo $row["cus_id"]; ?>" class="btn btn-warning" type="submit" name="repair">Chi tiết</a></td>
                </tr>
            <?php $stt++;
            } ?>
        </tbody>
    </table>
    <ul class="control-page">
    <?php $control_next_page = $page ?>
    <?php $control_back_page = $page ?>
    <li><a href="order.php?page=<?php if ($control_back_page == 1) {
        $control_back_page = 1;
        echo $control_back_page;
    } else {
        $control_back_page--;
        echo $control_back_page;
    } ?>" class="btn btn-outline-danger">back</a></li>
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
    <li><a href="order.php?page=<?php echo $page; ?>" class="btn btn-outline-danger"><?php echo $page; ?></a></li>
    <?php
    }
    ?>
    <li><a href="order.php?page=<?php
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
     ?>" class="btn btn-outline-danger">next</a></li>
</ul>
</section>
<?php
include 'masteradmin/footer.php';
?>