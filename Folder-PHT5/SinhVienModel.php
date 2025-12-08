<?php
    // Tệp Model sẽ chứa tất cả logic truy vấn CSDL
    // TODO 1: Viết 1 hàm tên là getAllSinhVien()
    // Hàm này nhận 1 tham số là $pdo (đối tượng PDO)
    // Bên trong hàm, thực thi câu lệnh SELECT * FROM sinhvien
    // Hàm trả về kết quả (dùng fetchAll) 
    function getAllSinhVien($pdo){ // return mang 2 chieu
        $sql_select = "select * from sinhvien";
        $stmt = $pdo->query($sql_select);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // TODO 2: Viết 1 hàm tên là addSinhVien()
    // Hàm này nhận 3 tham số: $pdo, $ten, $email
    // Bên trong hàm, thực thi câu lệnh INSERT (dùng Prepared Statement) 
    function addSinhVien($pdo, $ten, $email){
        $sql_add = "insert into sinhvien(ten_sinh_vien,email) values(?,?)";
        $stmt = $pdo->prepare($sql_add);

        $stmt->execute([$ten,$email]);
    }
?>  
