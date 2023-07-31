<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Footer/Footer.css">

    <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="./MySoldOrder.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">

    <title>Danh sách khách hàng - Mạnh Cường Shop</title>
</head>

<body>
    <?php include('../NavbarLayout/Navbar.php');
    $userID = $_SESSION["id_user"];
    require_once("../connMySQL.php");
    $sql_get_list_bill = $pdo->prepare("SELECT my_orders.status_orders, users_acc.username, users_acc.address, users_acc.phone, 
                                                my_orders.id_orders, product.name_product, my_orders.total, product.price, 
                                                (product.price*my_orders.total) as total_money, created_at  
                                        FROM my_orders 
                                        INNER JOIN users_acc ON my_orders.user_id = users_acc.id_user 
                                        INNER JOIN product ON my_orders.product_id = product.id_product
                                        WHERE product.id_user =  $userID;");
    $sql_get_list_bill->execute();
    $list_bill = $sql_get_list_bill->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class="container">
        <!-- <div class="check-order-form">
            <h1>Kiểm tra đơn hàng của bạn</h1>
            <form onsubmit="return validFormCheckOrder(this);">
                <input name="__RequestVerificationToken" type="hidden" value="">
                <div class="input">
                    <input type="text" id="OrderID" name="OrderID" title="Mã đơn hàng" placeholder="Vui lòng nhập mã đơn hàng *" data-required="1">
                </div>
                <div class="button">
                    <button type="submit">TRA CỨU</button>
                </div>
            </form>
        </div> -->
        <div class="container">
            <div class="box-product-home box-home">
                <div class="header">
                    <h4>Đơn hàng đã được bán</h4>
                </div>
                <div class="col-content lts-product">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên mặt hàng</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Thành tiền</th>
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Ngày đặt</th>
                                <th>Số điện thoại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_all = 0;
                            for ($i = count($list_bill) - 1; $i >= 0; $i--) { ?>
                                <tr>
                                    <td>MS<?php echo $list_bill[$i]["id_orders"] ?></td>
                                    <td><?php echo $list_bill[$i]["name_product"] ?></td>
                                    <td><?php echo  number_format($list_bill[$i]["total"]) ?></td>
                                    <td><?php echo  number_format($list_bill[$i]["price"]) ?>đ</td>
                                    <td><?php echo  number_format($list_bill[$i]["total_money"]) ?>đ</td>
                                    <td><?php echo $list_bill[$i]["username"] ?></td>
                                    <td><?php echo $list_bill[$i]["address"] ?></td>
                                    <td><?php echo  date("d/m/Y", strtotime($list_bill[$i]["created_at"])) ?></td>
                                    <td><?php echo $list_bill[$i]["phone"] ?></td>
                                </tr>

                            <?php $total_all += $list_bill[$i]["total_money"];
                            } ?>


                        </tbody>
                    </table>
                </div>
                <div class="sum-total-my--order">Thành tiền: <b> <?php echo number_format($total_all)   ?>₫ </b></div>
            </div>
        </div>
        <?php require("../Footer/FooterLayout.php") ?>
</body>

</html>