<?php
include 'admin/masteradmin/config.php';
$sql_product = "SELECT * FROM tbl_product WHERE prd_quantity > 0 LIMIT 9 ";
$query = mysqli_query($connect, $sql_product);

?>
<?php while ($row = mysqli_fetch_array($query)) { ?>
    

<form action="" method="post" class="box">
        <img class="image" src="admin/adimn-img/<?php echo $row["prd_image"]; ?>" alt="" width="197px">
        <input type="number" min="1" name="product_quantity" value="1" class="qty">
        <h3><?php echo $row["prd_name"]; ?></h3>
        <h3><?php echo $row["prd_price"]; ?> VNĐ</h3>
        <input type="hidden" name="product_name" value="<?php echo $row["prd_name"]; ?>">
        <input type="hidden" name="product_price" value="<?php echo $row["prd_price"]; ?>">
        <input type="hidden" name="product_image" value="<?php echo $row["prd_image"]; ?>">
        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
    </form>
<?php } ?>
