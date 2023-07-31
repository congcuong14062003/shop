<?php
session_start();
require_once("../connMySQL.php");
$id_orders = $_REQUEST["id_orders"];

$sql_cancle_bill = $pdo->prepare("SELECT id_orders, buyer.id_user as buyer_id, seller.id_user as saler_id, total,
                                        product.price, product.remain, product.total_sold ,
                                        product_id,
                                        buyer.money_remain as buyer_money,
                                        seller.money_remain as saler_money
                                FROM product
                                    LEFT JOIN my_orders ON product.id_product = my_orders.product_id
                                    LEFT JOIN users_acc AS buyer ON my_orders.user_id = buyer.id_user
                                    LEFT JOIN users_acc AS seller ON product.id_user = seller.id_user
                                    WHERE id_orders = $id_orders");
$sql_cancle_bill->execute();
$cancle_bill = $sql_cancle_bill->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem các giá trị trong kết quả truy vấn tồn tại trước khi gán chúng vào các biến
if (
    isset($cancle_bill["product_id"]) && isset($cancle_bill["buyer_id"]) && isset($cancle_bill["saler_id"])
    && isset($cancle_bill["total"]) && isset($cancle_bill["price"]) && isset($cancle_bill["remain"])
    && isset($cancle_bill["total_sold"]) && isset($cancle_bill["buyer_money"]) && isset($cancle_bill["saler_money"])
) {

    $product_id = $cancle_bill["product_id"]; // The id of the buyer
    $buyer_id = $cancle_bill["buyer_id"]; // The id of the buyer
    $saler_id = $cancle_bill["saler_id"]; // The id of the seller
    $total = $cancle_bill["total"]; // The total cost of the order
    $price = $cancle_bill["price"]; // The price per unit of the product
    $remain = $cancle_bill["remain"]; // The remaining quantity of the product
    $total_sold = $cancle_bill["total_sold"]; // The total quantity of the product sold
    $buyer_money = $cancle_bill["buyer_money"]; // The amount of money the buyer has remaining
    $saler_money = $cancle_bill["saler_money"];
    $money_trans = $total * $price;

    //Trả hàng cho người bán
    $sql_back_sold = $pdo->prepare("UPDATE product 
                                        SET total_sold = ($total_sold-$total), 
                                            remain = ($remain+$total)
                                        WHERE id_product = $product_id;");
    $sql_back_sold->execute();


    $sql_back_money = $pdo->prepare("UPDATE users_acc 
                                        SET money_remain = CASE 
                                                            WHEN id_user = $buyer_id THEN ($buyer_money+$money_trans )
                                                            WHEN id_user = $saler_id THEN ($saler_money-$money_trans )
                                                            ELSE money_remain
                                                        END
                                        WHERE id_user IN ($buyer_id, $saler_id);");
    $sql_back_money->execute();

    $sql_delete_orders = $pdo->prepare("DELETE FROM my_orders WHERE id_orders = $id_orders");
    $sql_delete_orders->execute();

    $_SESSION['messenger'] = "Bạn đã hủy đơn hàng thành công";
    header("Location: ./myorder.php");
    exit();
} else {
    $_SESSION['messenger'] = "Lỗi bất định";
    header("Location: ./myorder.php");
    //     // Xử lý lỗi khi kết quả truy vấn không tồn tại hoặc các giá trị bị thiếu
}
