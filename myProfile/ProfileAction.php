<?php
session_start();
require_once("../connMySQL.php");
$userID = $_SESSION["id_user"];
if (count($_POST) > 0) {
    $username = $_POST['username'];
    $desc_shop = $_POST['desc_shop'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $sql_info = $pdo->prepare("UPDATE users_acc SET username = '$username',
                            desc_shop = '$desc_shop',
                            email = '$email',
                            address = '$address',
                            phone = '$phone'
                            WHERE id_user = $userID
                            ");
    $sql_info->execute();


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

        $avt_name = $_FILES["img_post"]["name"];
        $sql_update_img = $pdo->prepare("UPDATE users_acc SET avt_user = '$avt_name'
                            WHERE id_user = $userID");
        $sql_update_img->execute();
    }
    $_SESSION['messenger'] = "Cập nhật thông tin thành công";
    header("Location: ../myProfile/myProfile.php");
    exit();
} else {
    $_SESSION['messenger'] = "Thất bại! Do lỗi bất định khi tải dữ liệu lên SERVER";
    header("Location: ../myProfile/myProfile.php");
}
