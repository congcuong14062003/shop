<?php
$servername = "localhost";
$userNameMSQ = "root";
$passwordMSQ = "MyNewPass";
$dsn = "mysql:host=localhost;dbname=store";

try {
    $pdo = new PDO($dsn, $userNameMSQ, $passwordMSQ);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Kết nối đến cơ sở dữ liệu thất bại: ' . $e->getMessage();
}
