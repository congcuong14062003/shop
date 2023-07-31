<?php
session_start();
require_once("../connMySQL.php");
$userID = $_SESSION["id_user"];
$productID = $_REQUEST["id_product"];
$total_amount = $_REQUEST["bill-amount"];

$sql_check_id = $pdo->query("SELECT product.id_user, remain
                                FROM product where product.id_product = $productID");
$sql_check_id->execute();
$saleIdCheck = $sql_check_id->fetch(PDO::FETCH_ASSOC);

if ($saleIdCheck["remain"] < $total_amount) {
    $_SESSION['messenger'] = "Đơn hàng của bạn vượt quá số lượng sản phẩm tồn kho! Số lượng tồn kho: " . $saleIdCheck["remain"];
    header("Location: ./ProductDetailsLayout.php?id_product=$productID");
    exit();
} else {
    // if ($saleIdCheck['id_user'] == $userID) {
    //     echo "Bạn không thể mua sản phẩm của chính mình";
    // } else 
    if ($saleIdCheck['remain'] <= 0) {
        $_SESSION['messenger']  = "Xin lỗi vì sản phẩm này đã hết hàng";
        header("Location: ./ProductDetailsLayout.php?id_product=$productID");
        exit();
    } else {
        $time_curr = date("Y-m-d H:i:s");
        $sql_add_order = $pdo->prepare("INSERT INTO my_orders(user_id, total, product_id, created_at) VALUES ($userID, $total_amount , $productID, '$time_curr')");
        $sql_add_order->execute();



        // lấy các thông tin cần thiết
        $sql_get_bill = $pdo->prepare("SELECT 
        (product.total_sold + my_orders.total) AS sold,
        (product.remain - my_orders.total) AS remain_product,
        buyer.money_remain AS buyer_money,
        seller.money_remain AS seller_money,
        product.price,
        buyer.id_user AS buyer_id,
        seller.id_user AS seller_id
        FROM product
        LEFT JOIN my_orders ON product.id_product = my_orders.product_id
        LEFT JOIN users_acc AS buyer ON my_orders.user_id = buyer.id_user
        LEFT JOIN users_acc AS seller ON product.id_user = seller.id_user
        WHERE product.id_product = $productID;");
        $sql_get_bill->execute();
        $result_get_bill = $sql_get_bill->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($result_get_bill); $i++) {
            $sold  = $result_get_bill[$i]['sold'];
            $remain = $result_get_bill[$i]["remain_product"];
            $BuyerID = $result_get_bill[$i]["buyer_id"];
            $SalerID = $result_get_bill[$i]["seller_id"];
            $trans_money = $total_amount * $result_get_bill[$i]['price'];
            $buyer_money = $result_get_bill[$i]["buyer_money"] - $trans_money;
            $saler_money = $result_get_bill[$i]["seller_money"] + $trans_money;
        }
        $sql_update_sold = $pdo->prepare("UPDATE product 
                                    SET total_sold = $sold, 
                                        remain = $remain
                                    WHERE id_product = $productID;");
        $sql_update_sold->execute();


        $sql_update_money = $pdo->prepare("UPDATE users_acc 
                                    SET money_remain = CASE 
                                                        WHEN id_user = $BuyerID THEN $buyer_money 
                                                        WHEN id_user = $SalerID THEN $saler_money
                                                        ELSE money_remain
                                                    END
                                    WHERE id_user IN ($BuyerID, $SalerID);");
        $sql_update_money->execute();
        $_SESSION['messenger']  = "Đặt hàng thành công";
        header("Location: ../myorder/myorder.php");
        exit();
    }
}
