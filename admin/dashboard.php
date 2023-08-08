<?php
include 'masteradmin/config.php';
include 'masteradmin/maindashboard.php';
// include_once('masteradmin/maindashboard.php');
?>
<li class="active">/ Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content-body">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="smallbox  bg-info-subtle">
                    <div class="inner">
                            <h3><?php echo mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tbl_product")); ?></h3>
                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                            </svg>
                        </div>
                        <a href="product.php" class="bg-info" style="width: 100%;text-align:center;border-radius:0 0 0.25rem 0.25rem;">
                         chi tiết
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="smallbox bg-danger-subtle">
                    <div class="inner ">
                            <h3><?php echo mysqli_num_rows(mysqli_query($connect, "SELECT DISTINCT cus_id, cus_name, placed_on FROM tbl_order_detail")); ?></h3>
                            <p>Đơn hàng</p>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                            </svg>
                        </div>
                        <a href="order.php" class="bg-danger" style="width: 100%;text-align:center;border-radius:0 0 0.25rem 0.25rem;">
                        chi tiết
                        
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="smallbox bg-warning-subtle">
                    <div class="inner">
                            <h3><?php echo mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tbl_user")); ?></h3>
                            <p>Thành viên</p>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                            </svg>
                        </div>
                        <a href="user.php" class="bg-warning" style="width: 100%;text-align:center;border-radius:0 0 0.25rem 0.25rem;">
                        chi tiết
                        
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="smallbox ">
                    <div class="inner">
                                <h3><?php  ?>0</h3>
                                <p>Thống kê</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0 0 13.277-5.5zM2 13.292A8 8 0 0 1 7.5.015v7.778l-5.5 5.5zM8.5.015V7.5h7.485A8.001 8.001 0 0 0 8.5.015z" />
                                </svg>
                            </div>
                        <a href="total.php" class="bg-secondary-subtle" style="width: 100%;text-align:center;border-radius:0 0 0.25rem 0.25rem;">
                         chi tiết
                           
                        </a>
                    </div>
                </div>
            </div>

        </div>

<?php
include_once('masteradmin/footer.php');
?>