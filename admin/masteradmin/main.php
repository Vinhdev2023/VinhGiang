<?php
include 'security.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="adimn-img/icon.png">
    <link rel="stylesheet" href="admincss/admin-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="ckeditor/ckeditor.js"></script>
    <script src="adminjs/script.js"></script>
    <title>Book shop | admin</title>
</head>

<body>
    <div class="bigmenu">
        <div class="head-container">
            <a href="../index.php" class="linkblock head-row">
                <img src="adimn-img/icon.png" alt="" class=" img-fluin">
                <span class="link">Book shop</span>
            </a>
        </div>
        <div id="menu-admin-container">
            <div id="menu-admin-row">
                <div class="admin-info">
                    <div class="img-admin">
                        <img src="adimn-img/143086968_2856368904622192_1959732218791162458_n.png" alt="" class="img-fluin">
                    </div>
                    <div class="link-info">
                        <ul class="listmenu-1">
                            <li class="list-ful limenu">
                                <a href="user.php" class="link"><?php echo $_SESSION['username'] ?></a>
                                <ul class="listmenu-2">
                                    <li><a href="logout.php">đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="form-inline">
                    <div class="inp-group">
                        <input type="text" class="inp-style" aria-label="Search">

                        <div>
                            <button class="btn-style">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div> -->