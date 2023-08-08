<?php

include 'masteradmin/config.php';
if (isset($_GET["username"])) {
    $username = $_GET["username"];
    if (isset($_POST["sbm"])) {
        $sql_update = "DELETE FROM tbl_user WHERE username = '$username'";
        mysqli_query($connect, $sql_update);
        header('location: user.php');
    } elseif (isset($_POST['nosbm'])) {
        header('location: user.php');
    }
}?><?php
include 'masteradmin/mainmember.php';
?>
<li class="active">/ <a href="user.php">User</a></li>
<li class="active">/ Delete user</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
        $result = $connect->query($sql);
        $query = mysqli_query($connect, $sql);
        if ($result->num_rows > 0) { ?>
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">stt</th>
                        <th scope="col">Mã Thành viên</th>
                        <th scope="col">Tên Thành Viên</th>
                        <th scope="col">tên đầy đủ</th>
                        <th scope="col">quyền</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <th scope="row"><?php echo $stt; ?></th>
                            <td><?php echo $row["user_id"] ?></td>

                            <td><?php echo $row["username"] ?></td>
                            <td><?php echo $row["fulname"] ?></td>
                            <td><?php
                                if ($row["user_level"] == 1) {
                                    echo '<p class="btn btn-warning">admin</p>';
                                }
                                ?></td>

                        </tr>
                <?php $stt++;
                    }
                } ?>
                </tbody>
                </table>
                <form method="post" class="d-flex justify-content-center">
                    <label for="" style="font-size: 30px;">Có xóa Không: </label>
                    <button type="submit" name="sbm" class="btn btn-danger">Có</button>
                    <button type="submit" name="nosbm" class="btn btn-warning">Không</button>
                    <a href="user.php" class="btn btn-light">Về trang cũ</a>
                </form>
    </div>


<?php
include 'masteradmin/footer.php';
?>