<?php
require_once('data.php');
?>

<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== "admin") {
    header("location: login.html");
    exit();
}

$uploadDir = __DIR__ . "/images/";

// // ----- MẢNG TĨNH -----
// $data = [
//     ["name"=>"hoa1.jpg","path"=>"../hoadep/hoa1.jpg","description"=>"Hoa hồng đỏ"],
//     ["name"=>"hoa2.png","path"=>"../hoadep/hoa2.png","description"=>"Hoa tulip vàng"]
// ];

// ==================== CREATE ====================
if (isset($_POST["action"]) && $_POST["action"] === "create") {
    $imageName = $_POST["image_name"];
    $description = $_POST["description"];
    $fileTmp = $_FILES["image"]["tmp_name"];
    $target = $uploadDir . $imageName;

    if (move_uploaded_file($fileTmp, $target)) {
        $data[] = [
            "name" => $imageName,
            "path" => "images/" . $imageName,
            "description" => $description
        ];

        // Ghi lại mảng $data vào data.php
        file_put_contents('data.php', '<?php $data = ' . var_export($data, true) . '; ?>');

        $message = "Thêm ảnh thành công!";
    } else {
        $message = "Lỗi khi upload ảnh!";
    }

    header("location: welcomeAdmin.php");
    exit();
}

// ==================== DELETE ====================
if (isset($_GET["delete"])) {
    $name = $_GET["delete"];

    foreach ($data as $key => $item) {
        if ($item["name"] === $name) {
            $filePath = $uploadDir . $item["name"];; // đường dẫn file thực tế
            if (file_exists($filePath)) unlink($filePath); // xóa file
            unset($data[$key]); // xóa khỏi mảng
            break;
        }
    }

    // Re-index mảng
    $data = array_values($data);

    // cần ghi lại:
    file_put_contents('data.php', '<?php $data = ' . var_export($data, true) . '; ?>');
    // Quay lại trang admin
    header("location: welcomeAdmin.php");
    exit();
}

// ==================== UPDATE ====================
if (isset($_POST["action"]) && $_POST["action"] === "update") {
    $oldName = $_POST["old_name"];
    $newName = $_POST["new_name"];
    $description = $_POST["description"];

    foreach ($data as &$item) {
        if ($item["name"] === $oldName) {
            // Đổi tên file nếu khác
            if ($oldName !== $newName) {
                $oldPath = $uploadDir . $oldName;
                $newPath = $uploadDir . $newName;
                if (file_exists($oldPath)) rename($oldPath, $newPath);
                $item["name"] = $newName;
                $item["path"] = "images/" . $newName;
            }
            $item["description"] = $description;
            break;
        }
    }
    unset($item);

    // Ghi lại mảng data
    file_put_contents('data.php', '<?php $data = ' . var_export($data, true) . '; ?>');

    header("location: welcomeAdmin.php");
    exit();
}

?>
