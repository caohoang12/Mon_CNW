<?php
$host = '127.0.0.1';
$port = 3307;
$db = 'cse485_web';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

// TODO 1: Tạo đối tượng PDO để kết nối CSDL 

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "thất bại";
    echo $e->getMessage();
}

// === LOGIC THÊM SINH VIÊN (XỬ LÝ FORM POST) ===
// TODO 2: Kiểm tra xem form đã được gửi đi (method POST) và có 'ten_sinh_vien' không
    if(isset($_POST['ten_sinh_vien'])){

        // TODO 3: Lấy dữ liệu 'ten_sinh_vien' và 'email' từ $_POST 
        $name = $_POST['ten_sinh_vien'];
        $email = $_POST['email'];

        // TODO 4: Viết câu lệnh SQL INSERT với Prepared Statement (dùng dấu ?) 
        $sql = "insert into sinhvien(ten_sinh_vien, email) values(?,?)";

        // TODO 5: Chuẩn bị (prepare) và thực thi (execute) câu lệnh 
        $stm = $pdo->prepare($sql);
        $stm->execute([$name,$email]);

        // TODO 6: (Tùy chọn) Chuyển hướng về chính trang này để "làm mới" 
        // header("location: chapter4.php");
        // exit();
        header("location: chapter4.php");
    }

// === LOGIC LẤY DANH SÁCH SINH VIÊN (SELECT) ===
// TODO 7: Viết câu lệnh SQL SELECT * 
$sql_select = "SELECT * FROM sinhvien ORDER BY ngay_tao DESC"; 

// TODO 8: Thực thi câu lệnh SELECT (không cần prepare vì không có tham số) 
$stmt_select = $pdo->query($sql_select);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>PHT Chương 4 - Website hướng dữ liệu</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Thêm Sinh Viên Mới (Chủ đề 4.3)</h2>
    <form action="chapter4.php" method="POST">
        Tên sinh viên: <input type="text" name="ten_sinh_vien" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Thêm</button>
    </form>
    <h2>Danh Sách Sinh Viên (Chủ đề 4.2)</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên Sinh Viên</th>
            <th>Email</th>
            <th>Ngày Tạo</th>
        </tr>
        <?php
            
            while($gan = $stmt_select->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                    echo "<td>" . $gan['id'] . "</td>";
                    echo "<td>" . $gan['ten_sinh_vien'] . "</td>";
                    echo "<td>" . $gan['email'] . "</td>";
                    echo "<td>" . $gan['ngay_tao'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>

</html>
