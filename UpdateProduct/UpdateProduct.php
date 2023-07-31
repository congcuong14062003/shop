<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../createProduct/createproduct.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../Warning/Modal.css?v= <?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
    <title>Sửa sản phẩm - Mạnh Cường Shop</title>
</head>

<body>
    <?php require_once("../connMySQL.php");

    if (isset($_SESSION["messenger"]) && !empty($_SESSION["messenger"])) {
        include("../Warning/Modal.php");
    }
    $id_product = $_REQUEST["id_product"];

    $sql_category = $pdo->prepare("SELECT distinct category FROM product;");
    $sql_category->execute();
    $category = $sql_category->fetchAll(PDO::FETCH_ASSOC);


    $sql_product_update = $pdo->prepare("SELECT * FROM product WHERE id_product = $id_product;");
    $sql_product_update->execute();
    $product_update = $sql_product_update->fetch(PDO::FETCH_ASSOC);
    ?>
    <a href="../HomeLayOut/homelayout.php" class="back-button">
        <i class="fas fa-home"></i>
    </a>

    <div class="container-new-product">
        <form class="form-create-product" action="./UpdateProductAction.php?id_product=<?php echo $id_product ?>" method="post" enctype="multipart/form-data">
            <span>
                <div class="form-container">
                    <h1>Sửa sản phẩm</h1>
                    <label for="product_type_input">Loại hàng:</label>
                    <input type="text" id="product_type_input" placeholder="Sử dụng gợi ý sẽ dễ dang tiếp cận khách hàng hơn" name="product_type" value="<?php echo $product_update["category"] ?>">
                    <select id="product_type_select" onchange="updateInput()">
                        <option value="">Gợi ý loại hàng</option>
                        <?php for ($i = 0; $i < count($category); $i++) { ?>
                            <option value="Điện thoại thông minh">Điện thoại thông minh</option>
                            <option value="Laptop, Máy tính cá nhân">Laptop, Máy tính cá nhân</option>
                            <option value="Thiết bị gia dụng">Thiết bị gia dụng</option>
                            <option value="<?php echo $category[$i]["category"] ?>"><?php echo $category[$i]["category"] ?></option>
                        <?php }   ?>
                    </select>

                    <script>
                        const updateInput = () => {
                            var select = document.getElementById("product_type_select");
                            var inputCategory = document.getElementById("product_type_input");
                            inputCategory.value = select.value;
                        }
                    </script>


                    <label for="product_name">Tên sản phẩm:</label>
                    <input type="text" id="product_name" name="product_name" value="<?php echo $product_update["name_product"] ?>">

                    <label for="product_quantity">Số lượng:</label>
                    <input type="number" id="product_quantity" name="product_quantity" value="<?php echo $product_update["remain"] ?>">

                    <div class="price-container">
                        <div class="price-input">
                            <label for="product_price">Giá gốc:</label>
                            <input type="number" id="product_price" name="product_price" value="<?php echo $product_update["price_root"] ?>">
                        </div>
                        <div class="price-input">
                            <label for="product_sale_price">Giá đã được giảm giá:</label>
                            <input type="number" id="product_sale_price" name="product_sale_price" value="<?php echo $product_update["price"] ?>">
                        </div>
                    </div>

                </div>


                <div class="upload-container">
                    <label for="input-img" class="preview">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Chọn tệp cho sản phẩm</span>
                        <input type="file" name="img_post" hidden id="input-img" />
                        <img src="../Upload/file_media.php?name=<?php echo $product_update["media_link"] ?>" alt="" class="img_preview">
                    </label>

                </div>
            </span>

            <label for="product_desc">Mô tả:</label>
            <textarea id="product_desc" name="product_desc"><?php echo $product_update["description"] ?></textarea>
            <input type="submit" value="Nhấn đồng ý để sửa sản phẩm">
        </form>
    </div>
    <script>
        const inputImg = document.querySelector('#input-img')
        inputImg.addEventListener('input', (e) => {
            let file = e.target.files[0]
            if (!file) return
            // let img = document.createElement('img')
            // img.className = "img_preview"
            document.querySelector(".img_preview").src = URL.createObjectURL(file)
            document.querySelector("#avt_link_img").value = inputImg.value.substring(inputImg.value.lastIndexOf('\\') + 1);
            document.querySelector('.preview').appendChild(img)
        })
        window.onload = function() {
            openModal();
        }
    </script>
</body>

</html>