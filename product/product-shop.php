<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$row_per_page = 9;
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tbl_product"));
$total_page = ceil($total_row / $row_per_page);
$per_row = ($page * $row_per_page) - $row_per_page;
?>
<div class="box-container">

    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE prd_quantity > 0 LIMIT $per_row,$row_per_page ") or die('query failed');
    if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
    ?>
            <form action="" method="post" class="box">
                <img class="image" src="admin/adimn-img/<?php echo $fetch_products['prd_image']; ?>" alt="" width="200px">
                <div class="name"><?php echo $fetch_products['prd_name']; ?></div>
                <div class="name"><?php echo $fetch_products['prd_description']; ?></div>
                <div class="price"><?php echo $fetch_products['prd_price']; ?> VNĐ</div>
                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['prd_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['prd_price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['prd_image']; ?>">
                <input type="submit" value="Thêm vào giỏ" name="add_to_cart" class="btn">
            </form>
    <?php
        }
    } else {
        echo '<p class="empty">Chưa có sản phẩm được thêm vào!</p>';
    }
    ?>

    
</div>
<div class="load-more" style="margin-top: 2rem; text-align:center">

        <ul class="control-page">
            <?php $control_next_page = $page ?>
            <?php $control_back_page = $page ?>
            <li><a href="shop.php?page=<?php if ($control_back_page == 1) {
                                            $control_back_page = 1;
                                        } else {
                                            $control_back_page--;
                                        }
                                        echo $control_back_page; ?>" class="btn btn-outline-danger"> < </a></li>
            <?php
            if ($page < ($total_page - 1)) {
                $show_page = $page + 1;
                if ($page != 1) {
                    $page = $page - 1;
                } else {
                    $show_page++;
                }
            } elseif ($page == ($total_page - 1)) {
                $show_page = $page + 1;
                $page = $page - 1;
            } else {
                $show_page = $total_page;
                $page = $page - 2;
            }
            if ($page <= 0) {
                $page = 1;
            }
            for (; $page <= $show_page; $page++) {
            ?>
                <li><a href="shop.php?page=<?php echo $page; ?>" class="btn btn-outline-danger"><?php echo $page; ?></a></li>
            <?php
            }
            ?>
            <li><a href="shop.php?page=<?php if ($control_next_page > ($total_page - 2)) {
                                            $control_next_page = $total_page;
                                        } else {
                                            $control_next_page++;
                                        }
                                        echo $control_next_page; ?>" class="btn btn-outline-danger"> > </a></li>
        </ul>
    </div>
