<?php
include 'connect.php';

$memid = mysqli_real_escape_string($conn, $_POST["memid"]);
$fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
$maddress = mysqli_real_escape_string($conn, $_POST["maddress"]);
$tel = mysqli_real_escape_string($conn, $_POST["tel"]);
$pass = mysqli_real_escape_string($conn, $_POST["pass"]);

$upload_dir = "uploads/"; // กำหนดโฟลเดอร์เก็บรูป

// ตรวจสอบว่าโฟลเดอร์ uploads มีอยู่หรือไม่ ถ้าไม่มีให้สร้าง
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// ตรวจสอบว่ามีไฟล์อัปโหลดหรือไม่
if (!empty($_FILES["filetoupload"]["name"])) {
    $file_name = basename($_FILES["filetoupload"]["name"]);
    $target_file = $upload_dir . $file_name;
    
    // ตรวจสอบและอัปโหลดไฟล์
    if (move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file)) {
        $sql = "UPDATE member SET fullname='$fullname', maddress='$maddress', tel='$tel', pass='$pass', pic='$file_name' WHERE memid='$memid'";
    } else {
        die("<div class='container text-danger fs-4 mt-4'>อัปโหลดไฟล์ไม่สำเร็จ!</div>");
    }
} else {
    $sql = "UPDATE member SET fullname='$fullname', maddress='$maddress', tel='$tel', pass='$pass' WHERE memid='$memid'";
}

// ทำการอัปเดตฐานข้อมูล
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('แก้ไขข้อมูลสำเร็จ'); window.location='users.php';</script>";
} else {
    echo "<div class='container text-danger fs-4 mt-4'>เกิดข้อผิดพลาด: " . mysqli_error($conn) . "</div>";
}

mysqli_close($conn);
?>
