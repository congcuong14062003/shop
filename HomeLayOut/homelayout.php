<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./homelayout.css?=1.0<?php echo time(); ?>">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Footer/Footer.css">
    <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="../Warning/Modal.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap&subset=vietnamese" rel="stylesheet">
    <title>Trang chủ - Mạnh Cường Shop</title>
</head>

<body>

    <?php require_once("../connMySQL.php");
    include('../NavbarLayout/Navbar.php');
    $sql_product_suggest = $pdo->prepare("SELECT * FROM product;");
    $sql_product_suggest->execute();
    $product_suggest = $sql_product_suggest->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Thêm các thẻ HTML sau vào trang của bạn -->
    <!-- <section class="slideshow-container">
        <div class="slideshow">
            <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/04/05/sale-samsung-s23-sr-01.jpg" alt="Image 1">
            <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/04/05/redmi-note-12-series-kv-mono_638162853134260252.jpg" alt="Image 2">
            <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/04/03/smartrok.png" alt="Image 3">
        </div>
        <div class="prev">
            <i class="fa-solid fa-circle-arrow-left"></i>
        </div>
        <div class="next">
            <i class="fa-solid fa-circle-arrow-right"></i>
        </div>
        <div class="slideshow-content">
            <div class="slideshow-content-list">
                <div class="slideshow-content-items active">
                    <h2>Apple iPhone 14 Pro Max</h2>
                    <p>Giá chỉ từ 26.090.000</p>
                </div>
            </div>
            <div class="slideshow-content-list">
                <div class="slideshow-content-items">
                    <h2>Apple iPhone 14 Pro Max</h2>
                    <p>Giá chỉ từ 26.090.000</p>
                </div>
            </div>
            <div class="slideshow-content-list">
                <div class="slideshow-content-items">
                    <h2>Apple iPhone 14 Pro Max</h2>
                    <p>Giá chỉ từ 26.090.000</p>
                </div>
            </div>
            <div class="slideshow-content-list">
                <div class="slideshow-content-items">
                    <h2>Apple iPhone 14 Pro Max</h2>
                    <p>Giá chỉ từ 26.090.000</p>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="container">
            <div class="quick-sales">
                <div class="quick-sales-items">
                    <a href="" class="quick-sales-link">
                        <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/04/05/sanphamhot-s20-fe.png" alt="" class="quick-sales-img">
                    </a>
                </div>
                <div class="quick-sales-items">
                    <a href="" class="quick-sales-link">
                        <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/04/03/group-47.png" alt="" class="quick-sales-img">
                    </a>
                </div>
                <div class="quick-sales-items">
                    <a href="" class="quick-sales-link">
                        <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/04/05/group-131.png" alt="" class="quick-sales-img">
                    </a>
                </div>
                <div class="quick-sales-items">
                    <a href="" class="quick-sales-link">
                        <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2023/03/17/group-47.png" alt="" class="quick-sales-img">
                    </a>
                </div>
            </div>
        </div>
    </section> -->
    <section>
        <div class="container">
            <div class="flash-sales">
                <div class="header-flash-sales">
                    <h3>F
                        <i class="fa-solid fa-bolt-lightning"></i>
                        ASH SALE ONLINE
                    </h3>



                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="content">
            <div class="carousel">
                <?php
                $sql_flash_sale = $pdo->prepare("SELECT *, (price_root - price) as trans_money
                                                FROM product
                                                ORDER BY trans_money DESC limit 15;");
                $sql_flash_sale->execute();
                $flash_sale = $sql_flash_sale->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < count($flash_sale); $i++) { ?>
                    <div class="carousel-item">
                        <a href="../ProductDetails/ProductDetailsLayout.php?id_product=<?php echo $flash_sale[$i]["id_product"] ?>" class="carausel-item">
                            <img src="<?php echo   $flash_sale[$i]["media_link"] !== NULL ? "../Upload/file_media.php?name=" . $flash_sale[$i]["media_link"]  : "https://gaixinhbikini.com/wp-content/uploads/2022/09/52321187927_023da6d2ec_o.jpg" ?>" alt="" class="img-carausel-item">
                            <h3 class="name_product">
                                <?php echo substr($flash_sale[$i]["name_product"], 0, 50) . '...' ?></h3>
                            <span class="price">
                                <strong><?php echo  number_format($flash_sale[$i]["price"]) ?>₫</strong>
                                <strike><?php echo  number_format($flash_sale[$i]["price_root"]) ?>₫</strike>
                            </span>
                            <h3 class="sold"><?php echo $flash_sale[$i]["total_sold"] ?> đã bán</h3>
                        </a>
                    </div>
                <?php } ?>


            </div>
            <div class="prev prev-items">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </div>
            <div class="next next-items">
                <i class="fa-solid fa-circle-arrow-right"></i>
            </div>
        </div>



        <div class="flash-sales">
            <div class="header-flash-sales">
                <h3 class="top_product">TOP SẢN PHẨM
                </h3>



            </div>
        </div>
        <ul class="list_product">
            <?php for ($i = count($product_suggest) - 1; $i >= 0; $i--) { ?>
                <li>
                    <a href="../ProductDetails/ProductDetailsLayout.php?id_product=<?php echo $product_suggest[$i]["id_product"] ?>" class="carausel-item">
                        <img src="<?php echo   $product_suggest[$i]["media_link"] !== NULL ? "../Upload/file_media.php?name=" . $product_suggest[$i]["media_link"]  : "https://gaixinhbikini.com/wp-content/uploads/2022/09/52321187927_023da6d2ec_o.jpg" ?>" alt="" class="img-carausel-item">
                        <span class="if_product">

                            <h3 class="name_product">
                                <?php echo substr($product_suggest[$i]["name_product"], 0, 50) . '...' ?></h3>
                            <span class="price">
                                <strong><?php echo  number_format($product_suggest[$i]["price"]) ?>₫</strong>
                                <strike><?php echo  number_format($product_suggest[$i]["price_root"]) ?>₫</strike>
                            </span>
                            <h3 class="sold"><?php echo $product_suggest[$i]["total_sold"] ?> đã bán</h3>
                        </span>
                    </a>
                </li>
            <?php } ?>
    </div>
    </div>
    <?php include("../Footer/FooterLayout.php") ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!-- Cuối cùng, thêm mã JavaScript sau để kích hoạt tính năng trượt ảnh -->
    <script src="./homelayout.js?v=<?php echo time()?>"></script>
    <script>
        window.onload = function() {
            openModal("<?php echo $_SESSION['messenger'] ?>");
        }
    </script>
</body>

</html>