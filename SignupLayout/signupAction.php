<?php
session_start();
require_once("../connMySQL.php");

$inputs = array(
    'accountName' => $_POST['accountName'],
    'userName' => $_POST['userName'],
    'PasswordHash' => $_POST['PasswordHash'],
    'SecurityStamp' => $_POST['SecurityStamp'],
    'Email' => $_POST['Email'],
    'Sex' => $_POST['Sex'],
    'UserBirthDate' => $_POST['UserBirthDate'],
    'PhoneNumber' => $_POST['PhoneNumber'],
    'Description' => $_POST['desc_shop'],
    'Address' => $_POST['Address'],
    'MoneyRemaining' => $_POST['money_remain']
);

if (count(array_filter($inputs)) !== count($inputs)) {
    $_SESSION['messenger'] = "Vui lòng nhập đầy đủ";
    header('Location: ../SignupLayout/signuplayout.php');
    exit();
} else {
    if ($inputs["PasswordHash"]  != $inputs["SecurityStamp"]) {
        $_SESSION['messenger'] = 'Mật khẩu không trùng khớp';
        header('Location: ../SignupLayout/signuplayout.php');
        exit();
    } else {
        $checkUserName = $pdo->prepare("SELECT * FROM users_acc WHERE acc_name = :acc_name");
        $checkUserName->bindParam(':acc_name', $inputs["accountName"], PDO::PARAM_STR);
        $checkUserName->execute();
        $checkresult = $checkUserName->fetchAll(PDO::FETCH_ASSOC);

        if (count($checkresult) === 0) {
            $sql = $pdo->prepare("INSERT INTO users_acc (acc_name, username,email, gender, dob, passwords, address, phone, desc_shop,money_remain) VALUES (:acc_name,:name_user, :email, :gender, :dob, :user_password, :user_address, :phone_number, :desc_acc,:money_user);");
            $sql->bindParam(':acc_name', $inputs["accountName"], PDO::PARAM_STR);
            $sql->bindParam(':name_user', $inputs["userName"], PDO::PARAM_STR);
            $sql->bindParam(':email', $inputs["Email"], PDO::PARAM_STR);
            $sql->bindParam(':gender', $inputs["Sex"], PDO::PARAM_STR);
            $sql->bindParam(':dob', $inputs["UserBirthDate"], PDO::PARAM_STR);
            $sql->bindParam(':user_password', $inputs["PasswordHash"], PDO::PARAM_STR);
            $sql->bindParam(':user_address', $inputs["Address"], PDO::PARAM_STR);
            $sql->bindParam(':phone_number', $inputs["PhoneNumber"], PDO::PARAM_STR);
            $sql->bindParam(':desc_acc', $inputs["Description"], PDO::PARAM_STR);
            $sql->bindParam(':money_user', $inputs["MoneyRemaining"], PDO::PARAM_STR);

            $sql->execute();
            $_SESSION['messenger'] = "Tạo tài khoản thành công";
            header('Location: ../LoginLayout/loginlayout.php');
            exit();
            exit;
        } else {
            $_SESSION['messenger'] = "Tài khoản đã được tạo trước đó";
            header('Location: ../SignupLayout/signuplayout.php');
            exit();
        }
    }
}
