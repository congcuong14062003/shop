<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Footer/Footer.css">

    <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Warning/Modal.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./productdetail.css?v= <?php echo time(); ?>">
    <link href='https://fonts.googleapis.com/css?family=Lato|Roboto:400,900' rel='stylesheet' type='text/css'>
    <title>Sản phẩm - Mạnh Cường Shop</title>
</head>

<body>
    <?php
    include('../NavbarLayout/Navbar.php');
    require_once("../connMySQL.php");
    $productID = $_REQUEST['id_product'];
    $userID = $_SESSION["id_user"];
    //Lấy thông tin sản phẩm theo id sản phẩm
    $sql_info_product = $pdo->prepare("SELECT * FROM product left join users_acc on product.id_user = users_acc.id_user where product.id_product = $productID;");
    $sql_info_product->execute();
    $products = $sql_info_product->fetch(PDO::FETCH_ASSOC);

    //Lấy thông tin chính mình theo id user đã lưu trong session
    $sql_info_me = $pdo->prepare("SELECT * FROM users_acc where id_user  = $userID");
    $sql_info_me->execute();
    $my_user = $sql_info_me->fetch(PDO::FETCH_ASSOC);



    //Lấy thông tin của các nhận xét theo id sản phẩm
    $sql_feedback = $pdo->prepare("SELECT * FROM product_rate 
                                        LEFT JOIN users_acc on product_rate.id_customer = users_acc.id_user 
                                        WHERE   product_rate.id_product=$productID;");
    $sql_feedback->execute();
    $result_fb = $sql_feedback->fetchAll(PDO::FETCH_ASSOC);

    //Lấy sao trung bình 
    $sql_rating = $pdo->prepare("SELECT ROUND(AVG(rate), 1) AS avg_rate
                                    FROM product_rate 
                                    WHERE product_rate.id_product = $productID;");
    $sql_rating->execute();
    $result_rating = $sql_rating->fetch(PDO::FETCH_ASSOC);;
    ?>



    <div class="detail-main">
        <div class="detail-container">
            <span class="media-product">
                <img src="<?php echo   $products["media_link"] !== NULL ? "../Upload/file_media.php?name=" . $products["media_link"]  : "https://gaixinhbikini.com/wp-content/uploads/2022/09/52321187927_023da6d2ec_o.jpg" ?>" class="media-item">
            </span>
            <div class="detail-product">
                <span>
                    <header class="title-product"><?php echo $products['name_product'] ?> </header>
                    <div class="status-product">
                        <div class="rate">
                            <span class="number-rate"><?php echo $result_rating["avg_rate"] ?></span>
                            <?php
                            $avg_rate = $result_rating["avg_rate"];
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $avg_rate) {
                                    echo '<i class="fa-sharp fa-solid fa-star"></i>';
                                } else {
                                    echo '<i class="fa-sharp fa-regular fa-star"></i>';
                                }
                            }
                            ?>
                        </div>


                        <div class="total-sold">
                            <b><?php echo $products['total_sold'] ?></b> đã bán
                        </div>
                        <div class="total-remain">
                            <b><?php echo $products['remain'] <= 0 ? 0 : $products['remain'] ?></b> tồn kho
                        </div>
                    </div>
                    <div class="prices-product"><?php echo number_format($products['price']) ?><small>₫</small> <s><?php echo number_format($products['price_root']) ?>₫</s></div>
                </span>
                <div class="sales">
                    <h4>Mã giảm giá của Shop:</h4> <i>Giảm <?php echo number_format($products['price_root'] -  $products['price']) ?>₫</s></i>
                </div>
                <div class="sales">
                    <h4>Loại mặt hàng: </h4>
                    <h4> <?php echo $products['category'] ?></h4>
                </div>
                <span>
                    <div class="ship">
                        <b>Vận chuyển: </b>
                        <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/74f3e9ac01da8565c3baead996ed6e2a.png" alt="" class="free-ship-icon">
                        <small>Miễn phí vận chuyển trên toàn quốc</small>
                    </div>
                    <div class="quantity">
                        <h3>Số lượng: </h3>
                        <div class="quantity-input">
                            <button class="btn-minus">-</button>
                            <input type="text" class="amount" value="1" title="Số lượng mua" />
                            <button class="btn-plus">+</button>
                        </div>
                    </div>
                    <?php if ($id_user == $products["id_user"]) { ?>
                        <button class="buy-btn" disabled style="cursor:not-allowed;" title="Bạn không thể mua sản phẩm của mình">Mua Ngay</button>
                    <?php } else { ?>
                        <button class="buy-btn">Mua Ngay</button>
                    <?php } ?>
                </span>
            </div>
        </div>
        <div class="info-seller">
            <span class="info-shop">
                <img src="<?php echo $products["avt_user"]!="https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?   "../Upload/file_media.php?name=" . $products["avt_user"] : "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?>" alt="Ảnh người bán không có sẵn" class="avt-seller">
                <div class="seller-container">
                    <p class="name-seller"><?php echo   $products["username"] ?></p>
                    <p class="des-shop"><?php echo   $products["desc_shop"] ?></p>
                    <span class="inview_shop">
                        <?php if ($id_user != $products["id_user"]) { ?>
                            <a href="../chatBox/Inbox.php?userID=<?php echo $products["id_user"] ?>" class="btn10">
                                <i class="fa-sharp fa-solid fa-comments" style="color: #ffffff;"></i>
                            </a>

                        <?php }  ?>

                        <a href="../myproduct/myproduct.php?user_id=<?php echo $products["id_user"] ?>" class="btn10">
                            <i class="fa-solid fa-shop" style="color: #ffffff;"></i>
                            <span>Ghé xem shop</span>
                        </a>
                    </span>
                </div>
            </span>
        </div>
        <div class="description-main">
            <h1 class="title-desc">Mô tả sản phẩm</h1>
            <div class="description-container">
                <?php echo '<p>' . $products["description"] . '</p>' ?>
            </div>
        </div>


        <form class="feedback-main" method="post" action="./ProductFeedbackAction.php?id_product=<?php echo  $productID ?>">
            <h1 class="feedback-header">Nhận xét & Đánh giá</h1>
            <div class="rate-per">
                <span class="rate-count-main"><i>Đánh giá:</i> <?php echo $result_rating["avg_rate"] ?>/5</span>
                <span class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5" title="5 sao"></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" title="4 sao"></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" title="3 sao"></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" title="2 sao"></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1" title="1 sao"></label>
                </span>
            </div>
            <div class="feedback-container">
                <div class="fb-container">
                    <?php if ($id_user != $products["id_user"]) { ?>
                        <h1>Viết nhận xét của bạn</h1>
                        <span class="fb-area">
                            <img src="<?php echo $my_user["avt_user"]!="https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?   "../Upload/file_media.php?name=" . $my_user["avt_user"] : "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?>" alt="" class="my-avt">
                            <input id="review" name="review" placeholder="Viết nhận xét"></input>

                        </span>
                    <?php } ?>



                    <ul class="feed-back-review">
                        <?php for ($i = count($result_fb) - 1; $i >= 0; $i--) {
                        ?>
                            <li class="fb-item">
                                <img class="avatar-user-fb" src="<?php echo $result_fb[$i]["avt_user"]!="https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?   "../Upload/file_media.php?name=" . $result_fb[$i]["avt_user"] : "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?>" alt="Avatar">
                                <div class="content-fb">
                                    <h3 class="name-user-fb"><?php echo $result_fb[$i]["username"] ?>
                                        <div class="rate_desc">
                                            <?php
                                            for ($j = 1; $j <= 5; $j++) {
                                                if ($j <= $result_fb[$i]["rate"]) {
                                                    echo '<i class="fa-sharp fa-solid fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa-sharp fa-regular fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <p><?php echo  date("d/m/Y", strtotime($result_fb[$i]["time_curr"])) ?></p>
                                    </h3>
                                    <h4 class="comment-fb"><?php echo $result_fb[$i]["feedback"] ?></h4>
                                </div>
                            </li>
                        <?php }; ?>
                    </ul>

                </div>
            </div>
        </form>
    </div>


    <div class="modal-product">
        <form class="modal-content" method="post" action="./ProductOrderAction.php?id_product=<?php echo $products['id_product'] ?>">
            <span class="close">&times;</span>
            <h2 class="title-order">Đơn hàng của bạn</h2>
            <h3 class="label-order">Mã đơn hàng: MCS<?php echo $products['id_product'] ?></h3>
            <h3 class="product-name-order"><label> Tên sản phẩm:</label> <i> <?php echo $products['name_product'] ?></i></h3>
            <label for="name">Tên người mua:</label>
            <input type="text" id="name" value="<?php echo $my_user['username'] ?>" disabled>
            <label class="label-order" for="phone">Số điện thoại:</label>
            <input type="text" id="phone" value="<?php echo $my_user['phone'] ?>" disabled>
            <label class="label-order" for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" value="<?php echo $my_user['address'] ?>" disabled>
            <span>
                <h3 class="prices-order">Giá: <input name="bill-price" value="<?php echo number_format($products['price'], 0); ?>" disabled>₫
                </h3>
                <h3 class="prices-order">Số lượng: <input class="bill-amount" name="bill-amount" value="1" style="margin-right: 10px">
                </h3>
                <h3 class="prices-order">Phí vận chuyển: <input name="bill-price-trans" value="0" disabled>₫
                </h3>
                <h3 class="prices-order">Thành tiền: <input class="bill-total-price" name="bill-total-price" value="0" disabled>₫
                </h3>
            </span>
            <input class="btn-pay" type="submit" value="Thanh toán">
        </form>
    </div>
    <?php require("../Footer/FooterLayout.php") ?>
    <script>
        document.title = '<?php echo $products['name_product'] ?>';
        const priceProduct = '<?php echo ($products['price']); ?>';
    </script>
    <script src="./ProductDetails.js"></script>

</body>

</html>