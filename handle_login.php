<?php
    // TODO 1: (Cực kỳ quan trọng) Khởi động session
    // Phải gọi hàm này TRƯỚC BẤT KỲ output HTML nào
    // Gợi ý: Dùng hàm session_...()
    session_start();

    // TODO 2: Kiểm tra xem người dùng đã nhấn nút "Đăng nhập" (gửi form) chưa
    // Gợi ý: Dùng hàm isset() để kiểm tra sự tồn tại của $_POST['username'] 
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(isset($_POST['username']) == true && isset($_POST['password']) == true){
        if($username == "admin" && $password == "123"){
            $_SESSION['username'] = $username;
            header("location: welcome.php"); // trang chủ
            exit();
        }
        else{
            header("location: login.html?error=1"); //login
            exit();
        }
    }

    else{
        header("location: login.html");
        exit();
    }
?>