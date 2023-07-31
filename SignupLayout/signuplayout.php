<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Warning/Modal.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="./signuplayout.css?v=1.0<?php echo time(); ?>">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">

    <title>Đăng kí - Mạnh Cường Shop</title>
</head>

<body>
    <?php
  if (isset($_SESSION["messenger"]) && !empty($_SESSION["messenger"])) {
    include("../Warning/Modal.php");
}
    ?>
    <div class="container">
        <div class="form-login">
            <div class="login-img">
                <img src="https://hoanghamobile.com/Content/web/img/login-bg.png" alt="">
            </div>
            <div class="login-content">
                <div class="login-content-body">
                    <div class="header-sign-up">
                        <h2>Đăng ký tài khoản</h2>
                        <p>Chú ý các nội dung có dấu * bạn cần phải nhập</p>
                    </div>
                    <form method="post" action="./signupAction.php">
                        <div class="form-controls">
                            <label>Tài khoản:</label>
                            <div class="controls">
                                <input type="text" name="accountName" id="UserName" placeholder="Tài khoản *" data-required="1">
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Họ tên:</label>
                            <div class="controls">
                                <input type="text" name="userName" id="Title" placeholder="Họ tên *" data-required="1">
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Mật khẩu:</label>
                            <div class="controls">
                                <input type="password" name="PasswordHash" id="PasswordHash" placeholder="Mật khẩu *" data-required="1">
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Nhập lại mật khẩu:</label>
                            <div class="controls">
                                <input type="password" name="SecurityStamp" id="SecurityStamp" placeholder="Nhập lại mật khẩu *" data-required="1">
                            </div>
                        </div>



                        <div class="form-controls">
                            <label>Email:</label>
                            <div class="controls">
                                <input type="email" name="Email" id="Email" placeholder="Email *" data-required="1">
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Giới tính:</label>
                            <div class="controls">
                                <label class="radio-ctn">
                                    <input type="radio" name="Sex" value="true">
                                    <span class="checkmark"></span>
                                    <span><strong>Nam</strong></span>
                                </label>

                                <label class="radio-ctn">
                                    <input type="radio" name="Sex" value="false">
                                    <span class="checkmark"></span>
                                    <span><strong>Nữ</strong></span>
                                </label>
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Ngày tháng năm sinh:</label>
                            <div class="controls">
                                <input type="date" name="UserBirthDate" id="UserBirthDate" placeholder="Ngày tháng năm sinh">
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Điện thoại:</label>
                            <div class="controls">
                                <input type="number" name="PhoneNumber" id="PhoneNumber" placeholder="Điện thoại *" data-required="1">
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Địa chỉ:</label>
                            <div class="controls">
                                <input type="text" name="Address" id="Address" placeholder="Địa chỉ *" data-required="1">
                            </div>
                        </div>


                        <div class="form-controls">
                            <label>Mô tả:</label>
                            <div class="controls">
                                <input type="text" name="desc_shop" id="des" placeholder="Mô tả cửa hàng của bạn *" data-required="1">
                            </div>
                        </div>

                        <div class="form-controls">
                            <label>Số dư:</label>
                            <div class="controls">
                                <input type="text" name="money_remain" id="des" placeholder="Nhập số dư bạn muốn nạp *" data-required="1">
                            </div>
                        </div>
                        <div class="form-controls">
                            <div class="controls submit-controls">
                                <input type="submit" value="ĐĂNG KÝ TÀI KHOẢN"></input>
                            </div>
                        </div>
                        <div class="form-controls">
                            <div class="submit-controls">
                                <p><strong>Bằng việc đăng kí này, bạn đã chấp nhận các chính sách của Mạnh Cường Shop</strong></p>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <a href="../LoginLayout/loginlayout.php" class="button-x">
                <i class="fa-solid fa-circle-minus"></i>
            </a>
        </div>

    </div>
    <script>
        window.onload = function() {
            openModal();
        }
    </script>
</body>

</html>