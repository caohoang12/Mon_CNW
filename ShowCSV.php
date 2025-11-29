<?php
$filename = "65HTTT_Danh_sach_diem_danh.csv";

// Kiểm tra file có tồn tại không
if (!file_exists($filename)) {
    die("File không tồn tại!");
}

// Mở file CSV
$csvFile = fopen($filename, "r");

// Đọc dòng đầu tiên để lấy header
$headers = fgetcsv($csvFile);

$data = [];
while (($row = fgetcsv($csvFile)) !== FALSE) {
    $data[] = $row;
}

fclose($csvFile);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Danh sách điểm danh</title>
<style>
body { font-family: Arial; background: #f5f5f5; padding: 20px; }
table { border-collapse: collapse; width: 100%; background: #fff; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background-color: #eee; }
tr:nth-child(even) { background-color: #f9f9f9; }
</style>
</head>
<body>

<h2>Danh sách điểm danh</h2>

<table>
    <tr>
        <?php foreach ($headers as $header): ?>
            <th><?= htmlspecialchars($header) ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($data as $row): ?>
        <tr>
            <?php foreach ($row as $cell): ?>
                <td><?= htmlspecialchars($cell) ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
