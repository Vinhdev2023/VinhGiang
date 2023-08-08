<?php 
include 'masteradmin/config.php';

$total_ord_pen = mysqli_num_rows(mysqli_query($connect, "SELECT DISTINCT placed_on FROM tbl_order_detail WHERE payment_status = 'pending'"));
$total_ord_com = mysqli_num_rows(mysqli_query($connect, "SELECT DISTINCT placed_on FROM tbl_order_detail WHERE payment_status = 'completed'"));
$total_pen = mysqli_query($connect, "SELECT SUM(total_price) AS total_paying FROM tbl_order_detail WHERE payment_status = 'pending'");
$total_com = mysqli_query($connect, "SELECT SUM(total_price) AS total_paid FROM tbl_order_detail WHERE payment_status = 'completed'");
$total_prd_quantity = mysqli_query($connect, "SELECT SUM(prd_quantity) AS prd_paid FROM tbl_order_detail WHERE payment_status = 'completed'");

?>
<?php include 'masteradmin/maintotal.php'; ?>
<li class="active">/ Thống kê</li>
</ol>
</div>
</div>
</div>
</div>
<section class="content-body">
    <table class="table table-success table-hover">
        <thead>
            <tr>
                <th scope="col">Số đơn chưa thanh toán</th>
                <th scope="col">Số đơn đã thanh toán</th>
                <th scope="col">Tổng số tiền chưa thanh toán</th>
                <th scope="col">Tổng số tiền đã thanh toán</th>
                <th scope="col">Tổng số sách đã bán</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo number_format($total_ord_pen); ?></td>
                <td><?php echo number_format($total_ord_com); ?></td>
                <td><?php while ($item = mysqli_fetch_array($total_pen)) {
                    echo number_format($item['total_paying']);
                }?> VNĐ</td>
                <td><?php while ($row = mysqli_fetch_array($total_com)) {
                    echo number_format($row['total_paid']);
                }?> VNĐ</td>
                <td><?php while ($item = mysqli_fetch_array($total_prd_quantity)) {
                    echo number_format($item['prd_paid']);
                }?> cuốn/bộ</td>
            </tr>
        </tbody>
    </table>
</section>
<?php include 'masteradmin/footer.php'; ?>