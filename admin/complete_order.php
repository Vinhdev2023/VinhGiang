<?php
include 'masteradmin/config.php';

$placed_on = $_GET['time'];
$cus_id = $_GET['cus_id'];

if (isset($_POST['wait_for_confirmation'])) {
    $check_payment = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id' AND payment_status = 'đang chờ xác nhận'"));
    if ($check_payment == 0) {
        $completed = mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
        while ($row = mysqli_fetch_array($completed)) {
            $id = $row['ordd_id'];
            $prd_id = $row['prd_id'];
            $prd_quantity_ord = $row['prd_quantity'];
            number_format($prd_quantity_ord);
            $select_prd = mysqli_query($connect, "SELECT * FROM tbl_product WHERE prd_id = $prd_id");
            while ($item = mysqli_fetch_array($select_prd)) {
                $prd_quantity_in = $item['prd_quantity'];
                number_format($prd_quantity_in);
            }
            $prd_quantity = $prd_quantity_in + $prd_quantity_ord;
            mysqli_query($connect, "UPDATE tbl_product SET prd_quantity = $prd_quantity WHERE prd_id = $prd_id");
            mysqli_query($connect, "UPDATE tbl_order_detail SET payment_status = 'đang chờ xác nhận' WHERE ordd_id = $id");
        }
    }
}

if (isset($_POST['confirmed'])) {
    $check_payment = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id' AND payment_status = 'đã xác nhận' OR payment_status = 'thành công'"));
    if ($check_payment == 0) {
        $completed = mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
        while ($row = mysqli_fetch_array($completed)) {
            $id = $row['ordd_id'];
            $prd_id = $row['prd_id'];
            $prd_quantity_ord = $row['prd_quantity'];
            number_format($prd_quantity_ord);
            $select_prd = mysqli_query($connect, "SELECT * FROM tbl_product WHERE prd_id = $prd_id");
            while ($item = mysqli_fetch_array($select_prd)) {
                $prd_quantity_in = $item['prd_quantity'];
                number_format($prd_quantity_in);
            }
            $prd_quantity = $prd_quantity_in - $prd_quantity_ord;
            mysqli_query($connect, "UPDATE tbl_product SET prd_quantity = $prd_quantity WHERE prd_id = $prd_id");
            mysqli_query($connect, "UPDATE tbl_order_detail SET payment_status = 'đã xác nhận' WHERE ordd_id = $id");
        }
    }else {
        $pending = mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
        while ($row = mysqli_fetch_array($pending)) {
            $id = $row['ordd_id'];
            mysqli_query($connect, "UPDATE tbl_order_detail SET payment_status = 'đã xác nhận' WHERE ordd_id = $id");
        }
    }
}

if (isset($_POST['success'])) {
    $check_payment = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id' AND payment_status = 'thành công' OR payment_status = 'đã xác nhận'"));
    if ($check_payment == 0) {
        $pending = mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
        while ($row = mysqli_fetch_array($pending)) {
            $id = $row['ordd_id'];
            $prd_id = $row['prd_id'];
            $prd_quantity_ord = $row['prd_quantity'];
            number_format($prd_quantity_ord);
            $select_prd = mysqli_query($connect, "SELECT * FROM tbl_product WHERE prd_id = $prd_id");
            while ($item = mysqli_fetch_array($select_prd)) {
                $prd_quantity_in = $item['prd_quantity'];
                number_format($prd_quantity_in);
            }
            $prd_quantity = $prd_quantity_in - $prd_quantity_ord;
            mysqli_query($connect, "UPDATE tbl_product SET prd_quantity = $prd_quantity WHERE prd_id = $prd_id");
            mysqli_query($connect, "UPDATE tbl_order_detail SET payment_status = 'thành công' WHERE ordd_id = $id");
        }
    }else {
        $pending = mysqli_query($connect, "SELECT * FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
        while ($row = mysqli_fetch_array($pending)) {
            $id = $row['ordd_id'];
            mysqli_query($connect, "UPDATE tbl_order_detail SET payment_status = 'thành công' WHERE ordd_id = $id");
        }
    }
}

if (isset($_POST['delete'])) {
    $delete = mysqli_query($connect, "SELECT ordd_id FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
    while ($row = mysqli_fetch_array($delete)) {
        $id = $row['ordd_id'];
        mysqli_query($connect, "DELETE FROM tbl_order_detail WHERE ordd_id = $id");
        mysqli_query($connect, "DELETE FROM tbl_orders WHERE ord_id = $id");
    }
    header('location:order.php');
}

include 'masteradmin/mainorder.php';
?>
<li class="active">/ <a href="order.php">Đơn đang chờ</a></li>
<li class="active">/ Chi tiết đơn hàng</li>
</ol>
</div>
</div>
</div>
</div>
<section class="content-body">
    <table class="table table-success table-hover">
        <thead>
            <tr>
                <th scope="col">Chi tiết</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php
                    $query = mysqli_query($connect, "SELECT DISTINCT placed_on FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Đặt vào: <?php echo $item['placed_on']; ?></p>
                    <?php
                    }
                    $query = mysqli_query($connect, "SELECT DISTINCT cus_name FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Tên: <?php echo $item['cus_name']; ?></p>
                    <?php
                    }
                    $query = mysqli_query($connect, "SELECT DISTINCT cus_number FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Số điện thoại: <?php echo $item['cus_number']; ?></p>
                    <?php
                    }
                    $query = mysqli_query($connect, "SELECT DISTINCT cus_email FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Email: <?php echo $item['cus_email']; ?></p>
                    <?php
                    }
                    $query = mysqli_query($connect, "SELECT DISTINCT cus_address FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Địa chỉ: <?php echo $item['cus_address']; ?></p>
                    <?php
                    }
                    $query = mysqli_query($connect, "SELECT DISTINCT cus_method FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Phương thức thanh toán: <?php echo $item['cus_method']; ?></p>
                    <?php
                    }
                    $query = mysqli_query($connect, "SELECT DISTINCT total_products FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'"); ?>
                    <p>Đơn hàng của khách:
                        <?php
                        while ($item = mysqli_fetch_array($query)) {
                            echo $item['total_products'] . ', ';
                        }
                        ?></p>
                    <?php
                    $query = mysqli_query($connect, "SELECT SUM(total_price) AS total_price FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Tổng: <?php echo $item['total_price']; ?> VNĐ</p>
                    <?php
                    }
                    $query = mysqli_query($connect, "SELECT DISTINCT payment_status FROM tbl_order_detail WHERE placed_on = '$placed_on' AND cus_id = '$cus_id'");
                    while ($item = mysqli_fetch_array($query)) {
                    ?>
                        <p>Trạng thái: <?php if ($item["payment_status"] == 'đang chờ xác nhận') {
                                            echo '<span class="btn btn-danger">' . $item["payment_status"] . '</span>';
                                        } elseif ($item["payment_status"] == 'đã xác nhận') {
                                            echo '<span class="btn btn-warning">' . $item["payment_status"] . '</span>';
                                        }
                                        else {
                                            echo '<span class="btn btn-success">' . $item["payment_status"] . '</span>';
                                        } ?></p>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <form action="" method="post">
        <button class="btn btn-warning" name="wait_for_confirmation">Chờ xác nhận</button>
        <button class="btn btn-warning" name="confirmed">Đã xác nhận</button>
        <button class="btn btn-warning" name="success">Thành công</button>
        <button class="btn btn-danger" name="delete">Xóa Đơn</button>
        <a href="order.php" class="btn btn-light">trở về</a>
    </form>
</section>
<?php
include 'masteradmin/footer.php';
?>