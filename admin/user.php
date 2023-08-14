<?php
include 'masteradmin/config.php';
include 'masteradmin/mainmember.php';

?>
<li class="active">/ User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM tbl_user ORDER BY user_level ASC";
    $result = $connect->query($sql);
    $query = mysqli_query($connect, $sql);
    if ($result->num_rows > 0) { ?>
        <div class="container">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">stt</th>
                        <th scope="col">Mã Thành viên</th>
                        <th scope="col">Tên Thành Viên</th>
                        <th scope="col">tên đầy đủ</th>
                        <th scope="col">quyền</th>
                        <th scope="col" colspan="2">Tùy chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <th scope="row"><?php echo $stt; ?></th>
                            <td><?php echo $row["user_id"]; ?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["fulname"]; ?></td>
                            <td><?php
                                if ($row["user_level"] == 1) {
                                    echo '<p class="btn btn-danger">admin</p>';
                                }elseif ($row["user_level"] == 2) {
                                    echo '<p class="btn btn-warning">Nhân viên</p>';
                                }
                                ?></td>
                            <td><a href="repair_user.php?username=<?php echo $row["username"]; ?>" class="btn btn-warning" type="submit" name="repair" >Sửa</a></td>
                            <td><a href="delete_user.php?username=<?php echo $row["username"]; ?>" class="btn btn-danger"  type="submit" name="delete">Xóa</a></td>
                        </tr>
                    <?php $stt++;
                    } ?>
                </tbody>
            </table>
            <a href="add_user.php" class="btn btn-success">Thêm thành viên mới</a>
        </div>
    <?php } ?>


<?php
include_once('masteradmin/footer.php');
?>