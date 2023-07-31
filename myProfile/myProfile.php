<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Warning/Modal.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="../Footer/Footer.css">
    <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v= <?php echo time(); ?>">
    <link rel="stylesheet" href="./myProfile.css?=1.0<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php include('../NavbarLayout/Navbar.php'); ?>
    <?php require_once("../connMySQL.php");
    $sql = $pdo->prepare("SELECT* FROM users_acc WHERE id_user = :id_user");
    $sql->bindValue(':id_user', $_SESSION["id_user"], PDO::PARAM_STR);
    $sql->execute();
    $infoUser = $sql->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="body">
        <div class="profile-container">
            <div class="proleft">
                <div class="my-profile">

                    <img src="<?php echo $infoUser["avt_user"]!="https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?   "../Upload/file_media.php?name=" . $infoUser["avt_user"] : "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"?>" alt="" class="img-avt">
                    <div class="name-user">
                        <h3><?php echo $infoUser["acc_name"] ?></h3>
                        <div class="name-user-details">
                            <svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" style="margin-right: 4px;">
                                <path d="M8.54 0L6.987 1.56l3.46 3.48L12 3.48M0 8.52l.073 3.428L3.46 12l6.21-6.18-3.46-3.48" fill="#9B9B9B" fill-rule="evenodd"></path>
                            </svg>
                            <h4>Sửa hồ sơ</h4>
                        </div>
                    </div>
                </div>
                <div class="my-account">
                    <img src="https://down-vn.img.susercontent.com/file/ba61750a46794d8847c3f463c5e71cc4" alt="">
                    <span>Tài khoản của tôi</span>
                </div>
                <a href="" class="hoso">
                    <h4>Hồ sơ</h4>
                </a>
                <a href="../MySoldOrder/MySoldOrder.php" class="hoso donban">
                    <h4>Đơn bán</h4>
                </a>
                <form action="./Logout.php" class="hoso donban">
                    <input class="logout" type="submit" value="Đăng xuất">
                </form>
            </div>
            <div class="proright">
                <div class="b7wtmP">
                    <div class="_66hYBa">
                        <div class="fgdwer">
                            <h1 class="SbCTde">Hồ sơ của tôi</h1>
                            <div class="zptdmA">Quản lý thông tin hồ sơ để bảo mật tài khoản</div>
                        </div>
                        <b class="sodu">Số dư tài khoản: <?php echo number_format($infoUser["money_remain"], 0, ',', '.') ?> đ</b>

                    </div>
                    <div class="R-Gpdg">

                        <form class="form-profile" action="./ProfileAction.php" method="post" enctype="multipart/form-data">
                            <span class="input-profile">
                                <div class="volt8A">
                                    <table class="Zj7UK+">
                                        <tr>
                                            <td class="espR83"><label>Tên đăng nhập</label></td>
                                            <td class="Tmj5Z6">
                                                <div class="_0ZgK9X">
                                                    <div class="W50dp5"><input type="text" name="username" placeholder="" value="<?php echo $infoUser["username"] ?>" class="CMyrTJ"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83"><label>Miêu tả Shop của bạn</label></td>
                                            <td class="Tmj5Z6">
                                                <div>
                                                    <div class="W50dp5"><input type="text" name="desc_shop" placeholder="" value="<?php echo $infoUser["desc_shop"] ?>" class="CMyrTJ"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83"><label>Email</label></td>
                                            <td class="Tmj5Z6">
                                                <div class="_0ZgK9X">
                                                    <div class="W50dp5"><input type="text" name="email" placeholder="" value="<?php echo $infoUser["email"] ?>" class="CMyrTJ"></div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="espR83"><label>Địa chỉ</label></td>
                                            <td class="Tmj5Z6">
                                                <div class="_0ZgK9X">
                                                    <div class="W50dp5"><input type="text" name="address" placeholder="" value="<?php echo $infoUser["address"] ?>" class="CMyrTJ"></div>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83"><label>Số điện thoại</label></td>
                                            <td class="Tmj5Z6">
                                                <div class="_0ZgK9X">
                                                    <div class="W50dp5"><input type="text" placeholder="" name="phone" value="<?php echo $infoUser["phone"] ?>" class="CMyrTJ"></div>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83"><label>Giới tính</label></td>
                                            <td class="Tmj5Z6">
                                                <?php echo $infoUser["gender"] === "true" ?  "Nam" : "Nữ"  ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83"><label>Ngày sinh</label></td>
                                            <td class="Tmj5Z6">
                                                <?php echo date("d/m/Y",  strtotime($infoUser["dob"])) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="espR83"><label>Ảnh đại diện</label></td>
                                            <td class="Tmj5Z6">
                                                <div class="W50dp5"><input id="avt_link_img" disabled type="text" placeholder="" name="img_link" class="CMyrTJ"></div>

                                            </td>
                                        </tr>

                                    </table>

                                </div>

                                <div class="IQPHvE">
                                    <div class="scvgOW">

                                        <div class="container-upload_img">
                                            <label for="input-img" class="preview">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Upload to preview image</span>
                                            </label>
                                            <input type="file" hidden id="input-img" name="img_post" class="upload-file" />
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <tr>
                                <td class="espR83"><label></label></td>
                                <td class="Tmj5Z6"><input type="submit" value="Lưu" class="btn btn-solid-primary btn--m btn--inline" />
                                </td>
                            </tr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require("../Footer/FooterLayout.php") ?>
    <script>
        const inputImg = document.querySelector('#input-img')
        inputImg.addEventListener('input', (e) => {
            let file = e.target.files[0]
            if (!file) return
            let img = document.createElement('img')
            img.className = "img_preview"
            img.src = URL.createObjectURL(file)
            document.querySelector("#avt_link_img").value = inputImg.value.substring(inputImg.value.lastIndexOf('\\') + 1);
            document.querySelector('.preview').appendChild(img)
        })
        window.onload = function() {
            openModal();
        }
    </script>
</body>

</html>