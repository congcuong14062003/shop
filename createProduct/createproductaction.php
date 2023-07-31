<?php
session_start();
require_once("../connMySQL.php");
$userID = $_SESSION["id_user"];

$productType = $_POST['product_type'];
$productName = $_POST['product_name'];
$productQuan = $_POST['product_quantity'];
$productPrice = $_POST['product_price'];
$productSales = $_POST['product_sale_price'];
$productDesc = $_POST['product_desc'];
$media_product_name = $_FILES["img_post"]["name"];
if (!empty($media_product_name) && !empty($productType) && !empty($productName) && !empty($productQuan) && !empty($productPrice) && !empty($productSales) && !empty($productDesc)) {
    $sql_info_product = $pdo->prepare("INSERT INTO product(id_user, name_product, category,media_link, description, price,price_root, total_sold, remain)
    VALUES($userID, '$productName', '$productType','$media_product_name', '$productDesc', '$productSales', '$productPrice' , 0,  '$productQuan')");
    $sql_info_product->execute();
   $file_name = $_FILES["img_post"]["name"];
    $file_size = $_FILES["img_post"]["size"];
    $file_tmp = $_FILES["img_post"]["tmp_name"];
    $file_type = $_FILES["img_post"]["type"];

    $fp = fopen($file_tmp, 'r');
    $data = fread($fp, filesize($file_tmp));
    $data = addslashes($data);
    fclose($fp);
    $sql_media = $pdo->prepare("INSERT INTO images (name, size, type, data) VALUES ('$file_name', '$file_size', '$file_type', '$data')");
    $sql_media->execute();
    $_SESSION['messenger'] = "Thêm sản phẩm thành công";
    header("Location: ../myproduct/myproduct.php");
    exit();
} else {
    $_SESSION['messenger'] = "Lỗi bất định, kiểm tra các thông tin và thử lại";
    header("Location: ../createProduct/createproduct.php");
    exit();
}
