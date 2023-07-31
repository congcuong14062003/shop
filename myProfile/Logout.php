<?php 
    session_start(); // Bắt đầu phiên làm việc

    // Xóa tất cả các biến session
    session_unset();
    // Hủy phiên làm việc
    session_destroy();
    header("Location: ../LoginLayout/loginlayout.php");
    exit();
