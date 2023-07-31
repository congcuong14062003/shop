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
$productID = $_REQUEST['id_product'];
$sql_Update_product = $pdo->prepare("UPDATE product 
                                    SET name_product = '$productName', 
                                        category = '$productType',
                                        description = '$productDesc', 
                                        price = '$productSales', price_root = '$productPrice', 
                                        remain = '$productQuan' WHERE id_product = $productID");
$sql_Update_product->execute();
if ($_FILES["img_post"]["name"] != "") {
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
    $sql_Update_product_img = $pdo->prepare("UPDATE product 
                                    SET media_link = '$file_name'
                                        WHERE id_product = $productID");
    $sql_Update_product_img->execute();
}
$_SESSION['messenger'] = "Đã sửa sản phẩm";
header("Location: ../myproduct/myproduct.php");
exit();
