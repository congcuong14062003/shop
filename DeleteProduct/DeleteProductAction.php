<?php
session_start();
require_once("../connMySQL.php");
$id_product = $_REQUEST["id_product"];
$sql_delete_product = $pdo->prepare("DELETE FROM product WHERE id_product = $id_product");
$sql_delete_product->execute();
$_SESSION['messenger']="Đã xóa sản phẩm";
header("Location: ../myproduct/myproduct.php");
exit();
?>