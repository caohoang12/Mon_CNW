<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['username']) || $_SESSION['username'] !== "admin") {
    header("location: login.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Admin - CRUD Ảnh Hoa (Mảng Tĩnh)</title>
<style>
body { font-family: Arial; background: #eef2f3; }
h2 { text-align:center; margin-top:20px; }
.logout { text-align:center; margin-bottom:20px; }
.logout a { padding:8px 15px; background:#ff4d4d; color:white; border-radius:6px; text-decoration:none; }
.logout a:hover { background:#cc0000; }

.form-box { width:50%; margin:20px auto; background:white; padding:20px; border-radius:10px; box-shadow:0 0 5px #aaa; }
table { width:85%; margin:30px auto; border-collapse:collapse; background:white; }
th, td { border:1px solid #ccc; padding:10px; text-align:center; }
img { width:120px; }
</style>
</head>
<body>

<h2>Quản lý ảnh hoa – ADMIN (Mảng Tĩnh)</h2>

<div class="logout">
    <a href="logout.php">Đăng xuất</a>
</div>

<?php
    require_once('data.php');
?>

<?php if (isset($message)) echo "<p style='text-align:center;color:green;'>$message</p>"; ?>

<!-- FORM CREATE -->
<div class="form-box">
<h3>Thêm ảnh mới</h3>
<form action="handle_admin.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="create">
    <label>Chọn ảnh:</label><br>
    <input type="file" name="image" required><br><br>

    <label>Tên ảnh (có đuôi, vd: hoa3.jpg):</label><br>
    <input type="text" name="image_name" required><br><br>

    <label>Mô tả:</label><br>
    <textarea name="description" rows="3" style="width:100%;" required></textarea><br><br>

    <button type="submit">Thêm ảnh</button>
</form>
</div>

<!-- BẢNG LIST -->
<h2>Danh sách ảnh</h2>
<table>
<tr>
    <th>Ảnh</th>
    <th>Tên ảnh</th>
    <th>Mô tả</th>
    <th>Hành động</th>
</tr>
<?php foreach ($data as $item): ?>
<tr>
    <td><img src="<?= $item['path'] ?>" alt="<?= $item['name'] ?>"></td>
    <td><?= $item['name'] ?></td>
    <td><?= $item['description'] ?></td>
    <td>
        <a href="?edit=<?= $item['name'] ?>">Sửa</a> |
         <a href="handle_admin.php?delete=<?= $item['name'] ?>" onclick="return confirm('Xóa ảnh?');">Xóa</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<!-- FORM UPDATE -->
<?php
if (isset($_GET["edit"])) {
    $name = $_GET["edit"];
    $editItem = null;
    foreach ($data as $item) {
        if ($item["name"] === $name) { $editItem = $item; break; }
    }
    if ($editItem):
?>
<div class="form-box">
<h3>Sửa ảnh</h3>
<form action="handle_admin.php" method="POST">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="old_name" value="<?= $editItem['name'] ?>">

    <label>Tên ảnh:</label>
    <input type="text" name="new_name" value="<?= $editItem['name'] ?>" required><br><br>

    <label>Mô tả:</label>
    <textarea name="description" rows="3" style="width:100%;" required><?= $editItem['description'] ?></textarea><br><br>

    <button type="submit">Cập nhật</button>
</form>
</div>
<?php endif; } ?>

</body>
</html>
