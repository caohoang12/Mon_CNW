<?php
session_start();

// Nếu muốn kiểm tra đăng nhập user, bạn có thể bỏ phần này
if (!isset($_SESSION['username']) || $_SESSION['username'] !== "user") {
    header("location: login.html");
    exit();
}

// Load mảng dữ liệu
require_once('data.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách hoa</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
}
h2 {
    text-align: center;
    margin: 20px 0;
}
.gallery {
    width: 90%;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    padding: 20px;
}
.card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 5px #aaa;
    text-align: center;
}
.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.card .info {
    padding: 10px;
}
.card .info h3 {
    margin: 5px 0;
}
.card .info p {
    color: #555;
    font-size: 14px;
}
</style>
</head>
<body>

<h2>Danh sách các loài hoa</h2>

<div class="gallery">
<?php foreach ($data as $item): ?>
    <div class="card">
        <img src="<?= $item['path'] ?>" alt="<?= $item['name'] ?>">
        <div class="info">
            <h3><?= $item['name'] ?></h3>
            <p><?= $item['description'] ?></p>
        </div>
    </div>
<?php endforeach; ?>
</div>

<a href="logout.php">Đăng xuất</a>

</body>
</html>
