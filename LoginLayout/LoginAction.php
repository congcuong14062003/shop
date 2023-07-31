<?php
session_start();
require_once("../connMySQL.php");

if (!empty($_POST['UserName']) && !empty($_POST['password'])) {
    $acc_name = $_POST['UserName'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users_acc WHERE acc_name = :acc_name AND passwords = :password";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':acc_name', $acc_name, PDO::PARAM_STR);
    $statement->bindValue(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $account_name_user = $user['acc_name'];
        $id_user = $user['id_user'];
        $_SESSION['account_name_user'] = "$account_name_user";
        $_SESSION['id_user'] = $id_user;
        $_SESSION['messenger'] = "Đăng nhập thành công!";
        header("Location: ../HomeLayOut/homelayout.php");
        exit();
    } else {
        $_SESSION['messenger'] = "Tên đăng nhập hoặc mật khẩu không chính xác";
        header("Location: ../LoginLayout/loginlayout.php");
    }
} else {
    $_SESSION['messenger'] =  "Vui lòng nhập tên người dùng và mật khẩu";
    header("Location: ../LoginLayout/loginlayout.php");
}
