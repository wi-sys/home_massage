<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shop_name = $_POST['shop_name'];
    $shop_address = $_POST['shop_address'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    $shop_pic = null;
    if (!empty($_FILES['shop_pic']['tmp_name'])) {
        $file_tmp = $_FILES['shop_pic']['tmp_name'];
        $shop_pic = file_get_contents($file_tmp); // อ่านไฟล์เป็น Binary
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO shop (shop_name, shop_address, shop_pic) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssb', $shop_name, $shop_address, $null);
    mysqli_stmt_send_long_data($stmt, 2, $shop_pic); // ส่งข้อมูล Binary ไปที่คอลัมน์ BLOB
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // ส่งกลับไปยังหน้าหลักของแอดมิน
    header("location: homeadmin.php");
    exit();
} else {
    echo "ไม่สามารถเข้าถึงหน้านี้โดยตรง";
}
?>
