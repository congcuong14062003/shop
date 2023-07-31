<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="./navbarLayout.css?v= <?php echo time(); ?>">
    <title>homelayout</title>
</head>

<body>
    <?php if (isset($_SESSION["messenger"]) && !empty($_SESSION["messenger"])) {
        include("../Warning/Modal.php");
    }
    ?>
    <header id="header">
        <div class="top-navigation">
            <div class="container">
                <ul>
                    <?php if (count($_SESSION) <= 1) { ?>
                        <li><a id="login-modal" href="../LoginLayout/loginlayout.php">Đăng nhập</a></li>
                    <?php } else {
                        require_once("../connMySQL.php");
                        $id_user = $_SESSION['id_user'];
                        $sql_info_user = $pdo->prepare("SELECT * FROM users_acc WHERE id_user = $id_user");
                        $sql_info_user->execute();
                        $info_user = $sql_info_user->fetch(PDO::FETCH_ASSOC); ?>
                        <a id="login-modal" href="../myProfile/myProfile.php">
                            <li>
                                <img src="<?php echo $info_user["avt_user"] != "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" ?   "../Upload/file_media.php?name=" . $info_user["avt_user"] : "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" ?>" alt="" class="avt">
                                <?php echo $info_user["username"] ?>
                            </li>
                        </a>
                        <li>
                            <a class="chat" href="../chatBox/Inbox.php?userID=1">
                                <i class="fa-solid fa-comments" style="color: #ffffff;"></i>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="heading">
            <div class="container">
                <div class="logo">
                    <a href="../HomeLayOut/homelayout.php" title="CÔNG TY CỔ PHẦN XÂY DỰNG VÀ ĐẦU TƯ THƯƠNG MẠI HOÀNG HÀ">
                        <img src="../assets/logo.png" alt="CÔNG TY CỔ PHẦN XÂY DỰNG VÀ ĐẦU TƯ THƯƠNG MẠI HOÀNG HÀ">
                    </a>
                </div>

                <div class="search-box">
                    <form method="get" action="../Search/SearchLayOut.php?keyword=" onsubmit="return submitSearch(this);" enctype="application/x-www-form-urlencoded">
                        <div class="border">
                            <input type="text" id="kwd" name="keyword" placeholder="Hôm nay bạn cần tìm gì?" autocomplete="off">
                            <button type="submit" class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

                <div class="order-tools">
                    <div class="item check-order">
                        <?php if (count($_SESSION) === 0) { ?>
                            <a id="btnCheckOrder" href="../LoginLayout/loginlayout.php">';
                            <?php } else { ?>
                                <a id="btnCheckOrder" href="../myorder/myorder.php">;
                                <?php } ?>
                                <span class="icon"><i class="fa-sharp fa-solid fa-truck-fast"></i></span>
                                <span class="text">Kiểm tra đơn hàng</span>
                                </a>
                    </div>
                    <div class="item cart">
                        <?php if (count($_SESSION) === 0) { ?>
                            <a href="../LoginLayout/loginlayout.php">
                            <?php } else { ?>
                                <a href="../myproduct/myproduct.php">
                                <?php } ?>
                                <i class="fa-solid fa-shop"></i>
                                <span id="cart-total">Cửa hàng của bạn</span>
                                </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav">
            <div class="nav-container">
                <ul class="nav-container-list">
                    <li class="nav-container-items">
                        <!-- <a href="/dien-thoai-di-dong" class="linknav" target="_self">
                            <span>Điện thoại</span>
                        </a>
                        <div class="sub-container">
                        </div> -->
                    </li>
                </ul>
            </div>
        </div>

    </header>
    <script>
        window.onload = function() {
            openModal();
        }
    </script>
</body>

</html>