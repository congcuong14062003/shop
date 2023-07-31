<?php
session_start();
require_once("../connMySQL.php");
$id_user  = $_SESSION["id_user"];
$id_product = $_REQUEST["id_product"];
$sql_check_buy = $pdo->prepare("SELECT user_id FROM my_orders WHERE product_id = $id_product AND user_id = $id_user;");
$sql_check_buy->execute();
$result_check_buy = $sql_check_buy->fetch(PDO::FETCH_ASSOC);
if ($result_check_buy["user_id"] == $id_user) {
    $rating = $_REQUEST["rating"];
    $review = $_REQUEST["review"];
    $time = date("Y-m-d H:i:s");
    if (!empty($rating)) {
        $sql_rating = $pdo->prepare("INSERT INTO product_rate (id_product, rate, id_customer, feedback, time_curr) 
                                    VALUES ($id_product,$rating,$id_user,'$review','$time')");
        $sql_rating->execute();
        header("Location: ../ProductDetails/ProductDetailsLayout.php?id_product=$id_product");
        exit();
    } else {
        $_SESSION['messenger'] = "Bạn chưa đánh giá hoặc nhận xét!";
        header("Location: ../ProductDetails/ProductDetailsLayout.php?id_product=$id_product");
        exit();
    }
} else {
    $_SESSION['messenger'] = "Bạn không thể đánh giá hay nhận xét khi chưa mua sản phẩm này! ";
    header("Location: ../ProductDetails/ProductDetailsLayout.php?id_product=$id_product");
    exit();
}
