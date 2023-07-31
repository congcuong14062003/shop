<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Footer/Footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="./SearchLayout.css?v= <?php echo time(); ?>">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">

    <title>Kết quả tìm kiếm - Mạnh Cường Shop</title>
</head>

<body>
    <?php include('../NavbarLayout/Navbar.php');
    require_once("../connMySQL.php");
    $keyword = $_REQUEST["keyword"];
    $sql_search = $pdo->prepare("SELECT * FROM product p inner join users_acc u on p.id_user = u.id_user  WHERE CONCAT(name_product, ' ', category, ' ', description,' ',username) LIKE '%" . str_replace(' ', '%', $keyword) . "%' ORDER BY total_sold DESC");
    $sql_search->execute();
    $result_search =  $sql_search->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="box-product-home box-home">
            <div class="header">
                <h4>Các đề xuất và tìm kiếm</h4>
            </div>
            <div class="col-content lts-product">
                <?php for ($i = 0; $i < count($result_search); $i++) { ?>
                    <a href="../ProductDetails/ProductDetailsLayout.php?id_product=<?php echo $result_search[$i]["id_product"] ?>">
                        <div class="item">
                            <div class="img">
                                <img src="../Upload/file_media.php?name=<?php echo $result_search[$i]["media_link"] ?>" alt="">
                            </div>
                            <!-- <div class="sticker sticker-left">
                                <span><img src="https://hoanghamobile.com/Content/web/sticker/apple.png" title="Chính hãng Apple"></span>
                            </div> -->
                            <div class="info">
                                <h3 class="title"><?php echo $result_search[$i]["name_product"] ?></h3>
                                <span class="price">
                                    <strong><?php echo number_format($result_search[$i]["price"]) ?>₫ <s><?php echo number_format($result_search[$i]["price_root"]) ?>₫</s></strong>
                                </span>

                            </div>


                            <div class="note">
                                <span class="bag">KM</span> <label> <?php echo ($result_search[$i]["total_sold"]) ?> đã bán</label>
                            </div>

                        </div>
                    </a>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php require("../Footer/FooterLayout.php") ?>
</body>

</html>