<?php
session_start();      // Bắt đầu session để thao tác
session_unset();      // Xóa tất cả biến trong $_SESSION
session_destroy();    // Hủy session hiện tại
header("Location: login.html"); // Quay về trang login
exit();
?>
