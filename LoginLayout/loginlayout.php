<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./loginlayout.css?v=1.0<?php echo time(); ?>">
    <link rel="stylesheet" href="../Warning/Modal.css?v= <?php echo time(); ?>">
    <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">

    <title>Đăng nhập - Mạnh Cường Shop</title>
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
                <div class="split">
                    <img src="../assets/logo.png" alt="">
                </div>
                <div class="login-content-body">
                    <h1>Đăng nhập</h1>
                


                    <div class="internal">


                        <form method="post" action="./LoginAction.php">
                            <input name="__RequestVerificationToken" type="hidden" value="">
                            <input type="hidden" name="ReturnUrl" value="/">
                            <div class="row">
                                <div class="label">Tài khoản</div>
                                <div class="input">
                                    <input type="text" name="UserName" id="UserName">
                                </div>
                            </div>

                            <div class="row">
                                <div class="label">Mật khẩu</div>
                                <div class="input">
                                    <input type="password" name="password" id="password">
                                </div>
                            </div>

                            <div class="row check">
                                <input type="checkbox">
                                <label class="checkbox-ctn">Nhớ đăng nhập
                                </label>
                            </div>

                            <div class="row">
                                <div class="button-group">
                                    <button class="btn btn-submit" type="submit">ĐĂNG NHẬP</button>
                                    <a class="btn btn-link ajax-content" href="../SignupLayout/signuplayout.php">ĐĂNG KÝ</a>
                                </div>
                            </div>

                            <div class="row">
                                <p class="forgotpass"><a class="ajax-content" href="">Quên mật khẩu?</a></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <a href="../HomeLayOut/homelayout.php" class="button-x">
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