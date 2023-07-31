<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./myorder.css?=1.0<?php echo time(); ?>">
    <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="../Footer/Footer.css">
    <link rel="stylesheet" href="../Warning/Modal.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">

    <title>Đơn của bạn - Mạnh Cường Shop</title>
</head>

<body>
    <?php
    include('../NavbarLayout/Navbar.php');
    require_once("../connMySQL.php");
    $userID = $_SESSION["id_user"];
    $statement_product = $pdo->prepare("SELECT * FROM product left join my_orders on product.id_product = my_orders.product_id where my_orders.user_id =$userID");
    $statement_product->execute();
    $product = $statement_product->fetchAll(PDO::FETCH_ASSOC);


    ?>

    <div class="container">
        <div class="container">
            <div class="box-product-home box-home">
                <div class="header">
                    <h4>Đơn hàng của bạn</h4>
                </div>
                <div class="col-content lts-product">
                    <?php $total_prices = 0;
                    for ($i = count($product) - 1; $i >= 0; $i--) {
                        $total_prices += ($product[$i]['price'] * $product[$i]['total']);

                    ?>

                        <div class="item">
                            <div class="img-product">
                                <img src="<?php echo   $product[$i]["media_link"] !== NULL ? "../Upload/file_media.php?name=" . $product[$i]["media_link"]  : "https://gaixinhbikini.com/wp-content/uploads/2022/09/52321187927_023da6d2ec_o.jpg" ?>" alt="iPhone 14 Pro Max (256GB) - Chính hãng VN/A" title="iPhone 14 Pro Max (256GB) - Chính hãng VN/A">
                            </div>
                            <div class="info">
                                <p class="title" title="iPhone 14 Pro Max (256GB) - Chính hãng VN/A"><?php echo $product[$i]['name_product'] ?></p>
                                <div class="price">
                                    <strong>Giá sản phẩm: <i><?php echo number_format($product[$i]['price'])  ?>đ</i> </strong>
                                </div>
                            </div>
                            <span class="info-bill">
                                <div class="amount_buy">Số lượng: <b><?php echo number_format($product[$i]['total'])  ?></b></div>
                                <a class="see-inview" href="../ProductDetails/ProductDetailsLayout.php?id_product=<?php echo $product[$i]["id_product"] ?>"><button class="product-details">Xem trực tiếp</button></a>
                            </span>
                            <a href="./deleteMyOrder.php?id_orders=<?php echo $product[$i]["id_orders"] ?>"><i class="fa-sharp fa-solid fa-trash" title="Xóa đơn hàng"></i></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="sum-total-my--order">Thành tiền: <i><b><?php echo number_format($total_prices)  . '₫'; ?> </b></i> </div>
            </div>
        </div>
        <?php require("../Footer/FooterLayout.php") ?>
</body>

</html>