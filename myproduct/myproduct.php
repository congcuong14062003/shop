<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Footer/Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="../Warning/Modal.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="./myproduct.css?=1.0<?php echo time(); ?>">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">


    <title>Cửa hàng của bạn - Mạnh Cường Shop</title>
</head>

<body>
    <?php
    if (isset($_SESSION["messenger"]) && !empty($_SESSION["messenger"])) {
        include("../Warning/Modal.php");
    }

    include('../NavbarLayout/Navbar.php');
    require_once("../connMySQL.php");
    $userID = count($_REQUEST) > 0 ? $_REQUEST["user_id"] :  $_SESSION["id_user"];
    $sql_info_product = $pdo->prepare("SELECT * FROM product left join users_acc on product.id_user = users_acc.id_user where users_acc.id_user =  '$userID'");
    $sql_info_product->execute();
    $products = $sql_info_product->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="box-product-home box-home">
            <?php
            if (count($_REQUEST) > 0 && $_REQUEST["user_id"] != $_SESSION["id_user"]) {
                echo '<div class="header">
                        <h4>Cửa hàng của ' . $products[0]['username'] . '</h4>
                      </div>
                        <br>

                        <a href="../chatBox/Inbox.php?userID='.$_REQUEST["user_id"].'">
                            <button class="new-product">
                            <i class="fa-brands fa-facebook-messenger"></i></i> Chat ngay
                            </button>
                        </a>';
            } else {
                echo '<div class="header">
                            <h4>Cửa hàng của tôi</h4>
                        </div>
                        <br>
                        <a href="../createProduct/createproduct.php">
                            <button class="new-product">
                                <i class="fa-solid fa-plus"></i> Thêm sản phẩm
                            </button>
                        </a>
                        <a href="../MySoldOrder/MySoldOrder.php" class="btn-booking"><i class="fa-solid fa-list" style="color: #ffffff;"></i>Kiểm tra đơn đặt hàng</a>';
            };
            ?>


            <div class="col-content lts-product">

                <?php

                for ($i = count($products) - 1; $i >= 0; $i--) {
                ?>
                    <div class="item">
                        <?php if (count($_REQUEST) <= 0) { ?>
                            <i class="fa-solid fa-ellipsis-vertical menu_my_product"></i>
                            <div class="product">
                                <div class="product-options">
                                    <span><i class="fa-solid fa-wrench"></i><a href="../UpdateProduct/UpdateProduct.php?id_product=<?php echo $products[$i]["id_product"] ?>">Sửa sản phẩm</a></span>
                                    <span><i class="fa-sharp fa-solid fa-trash"></i><a href="../DeleteProduct/DeleteProductAction.php?id_product=<?php echo $products[$i]["id_product"] ?>">Xóa sản phẩm</a></span>
                                </div>
                            </div>
                        <?php } ?>
                        <a href="../ProductDetails/ProductDetailsLayout.php?id_product=<?php echo $products[$i]["id_product"] ?>">

                            <div class="img">

                                <img class="img_product" src="<?php echo   $products[$i]["media_link"] !== NULL ? "../Upload/file_media.php?name=" . $products[$i]["media_link"]  : "https://gaixinhbikini.com/wp-content/uploads/2022/09/52321187927_023da6d2ec_o.jpg" ?>" alt="Ảnh sản phẩm">

                            </div>


                            <div class="info">
                                <a class="title"><?php echo $products[$i]['name_product']; ?></a>
                                <span class="price">
                                    <s><strong><?php echo number_format($products[$i]['price_root']); ?>₫</strong></s>
                                    <strong><?php echo number_format($products[$i]['price']); ?>₫</strong>
                                </span>
                            </div>

                            <div class="note">

                                <span class="bag">KM</span>
                                <label><?php echo $products[$i]['total_sold']; ?> đã bán</label>
                            </div>
                        </a>

                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
    <?php require("../Footer/FooterLayout.php") ?>
    <script>
        const labelMenu = document.querySelectorAll(".menu_my_product")
        const Menu = document.querySelectorAll(".product")
        labelMenu.forEach((item, index) => {
            item.addEventListener("click", (event) => {
                event.stopPropagation();
                Menu[index].classList.toggle("active");
            })
        })
        window.onload = function() {
            openModal();
        }
    </script>
</body>

</html>